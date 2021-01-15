<?php
session_start();


include 'partials/header.php';
include 'config/db.php';
$errors = [];

//Validate user data
if (isset($_POST['submit'])){
    $conn = connect('commentProject');
    $name = htmlspecialchars(trim(mysqli_real_escape_string($conn,$_POST['name'])));
    $surname = htmlspecialchars(trim(mysqli_real_escape_string($conn,$_POST['surname'])));
    $email = htmlspecialchars(trim(mysqli_real_escape_string($conn,$_POST['email'])));
    $phone = htmlspecialchars(trim(mysqli_real_escape_string($conn,$_POST['phone'])));
    $password1 = htmlspecialchars(trim(mysqli_real_escape_string($conn,$_POST['password1'])));
    $password2 = htmlspecialchars(trim(mysqli_real_escape_string($conn,$_POST['password2'])));
    if (empty($name)){
        array_push($errors,"Name is required!");
    }elseif (strlen($name)>15 || strlen($name)<5){
        array_push($errors,"Name should be 5 to 15 symbols!");
    }
    if (empty($surname)){
        array_push($errors,"Surname is required!");
    }elseif (strlen($surname)>19 || strlen($surname)<9){
        array_push($errors,"Surname should be 9 to 19 symbols!");
    }
    if (empty($email)){
        array_push($errors,"Email is required!");
    }
    if (empty($phone)){
        array_push($errors,"Phone is required!");
    }elseif (strlen($phone)!==9){
        array_push($errors,"Phone number should be 9 digits!");
    }
    if (empty($password1)){
        array_push($errors,"Password is required!");
    }
    if (empty($password2)){
        array_push($errors,"Second password is required!");
    }
    if ($password1!==$password2){
        array_push($errors,"Passwords don't match!");
    }
    $hashedPassword = password_hash($password1,PASSWORD_DEFAULT);
    if (count($errors)==0){
        $conn = connect('commentProject');
        $query = "insert into users(name, surname, email, phone,password) values('$name','$surname','$email','$phone','$hashedPassword')";
        $answer = mysqli_query($conn,$query);
        if ($answer){
            echo "true";
        }else{
            if (mysqli_errno($conn)=='1062'){
                array_push($errors,'Email already in use!');
            }
           echo mysqli_errno($conn);
        }
        mysqli_close($conn);
    }
}
//Validation end!

?>


<div class="container">
    <h3 class="text-center">Register</h3>
    <?php
    if (!count($errors)>0){
        echo "";
    }else{
        echo "<div class='alert alert-dark'>";
        foreach ($errors as $error){
            echo $error;
            echo "<br>";
        }
        echo "</div>";
    }
    ?>
    <form class="mt-3" action="" method="post">
        <div class="input-group mb-2">
            <input type="text" class="form-control" name="name" value="<?php echo empty($_POST['name']) ? "" : $_POST['name']; ?>" placeholder="Name" aria-describedby="basic-addon1">
            <input type="text" class="form-control" name="surname" value="<?php echo empty($_POST['surname']) ? "" : $_POST['surname']; ?>" placeholder="Surname" aria-describedby="basic-addon1">
        </div>
        <div class="input-group mb-2">
            <input type="text" class="form-control" name="email" value="<?php echo empty($_POST['email']) ? "" : $_POST['email']; ?>" placeholder="Email" aria-describedby="basic-addon1">
            <input type="text" class="form-control" name="phone" value="<?php echo empty($_POST['phone']) ? "" : $_POST['phone']; ?>" placeholder="Phone" aria-describedby="basic-addon1">
        </div>
        <div class="input-group mb-2">
            <input type="password" class="form-control" name="password1" placeholder="Password" aria-describedby="basic-addon1">
            <input type="password" class="form-control" name="password2" placeholder="Repeat password" aria-describedby="basic-addon1">
        </div>
        <div class="text-center mt-4">
            <button type="submit" name="submit" class="btn btn-primary btn-lg">Sign up</button>
        </div>
    </form>
</div>

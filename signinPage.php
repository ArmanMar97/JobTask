<?php
include 'partials/header.php';
include 'config/db.php';
$errors = [];
$success = [];

if (isset($_SESSION['user'])){
    print_r($_SESSION['user']);
}

if (isset($_POST['submit'])){
    $email = htmlspecialchars(trim($_POST['email']));
    $password= htmlspecialchars(trim($_POST['password']));
    if (empty($email)){
        array_push($errors,"Email is required!");
    }
    if (empty($password)){
        array_push($errors,"Password is required!");
    }

    if (count($errors)==0){
        $conn = connect('commentProject');
        $emailEscaped = mysqli_real_escape_string($conn,$email);
        $passwordEscaped = mysqli_real_escape_string($conn,$password);
        $query = "SELECT * FROM users WHERE email='$emailEscaped'";
        $answer = mysqli_query($conn,$query);
        if (mysqli_num_rows($answer) == 1){
            $userData = mysqli_fetch_assoc($answer);
            $pass = $userData['password'];
            if (password_verify($passwordEscaped,$pass)){
                if ($userData['role']=='admin'){
                    $_SESSION['user'] = $userData;
                    $_SESSION['isAdmin'] = true;
                    unset($_POST);
                    header('Location:/JobTask/index.php');
                    array_push($success,'Welcome admin!');
                }else{
                    array_push($success,'You are successfully logged in!');
                    unset($_POST);
                    $_SESSION['user'] = $userData;
                    header('Location:/JobTask/index.php');
                }
            }else{
                array_push($errors,'Wrong credentials!');
                unset($_POST);
            }
        }else{
            echo mysqli_errno($conn);
        }
        mysqli_close($conn);
    }
}






?>

<div class="container">
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
    <?php
    if (!count($success)>0){
        echo "";
    }else{
        echo "<div class='alert alert-success'>";
        foreach ($success as $item){
            echo $item;
            echo "<br>";
        }
        echo "</div>";
    }
    ?>
    <form class="mt-3" action="" method="post">
        <div class="input-group mx-auto mb-2 w-50">
            <input type="text" class="form-control" name="email" value="<?php echo empty($_POST['email']) ? "" : $_POST['email']; ?>" placeholder="Email" aria-describedby="basic-addon1">
        </div>
        <div class="input-group mx-auto mb-2 w-50">
            <input type="text" class="form-control" name="password" value="" placeholder="Password" aria-describedby="basic-addon1">
        </div>
        <div class="text-center mt-4">
            <button type="submit" name="submit" class="btn btn-primary btn-lg">Sign in</button>
        </div>
    </form>
</div>

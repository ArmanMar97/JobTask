<?php
include "partials/header.php";
include "functions.php";
loadComments();
$errors = [];
$success = [];

if (isset($_GET['order']) || isset($_GET['category'])){
    $order = $_GET['order'];
//    $category = $_GET['category'];
    loadComments($order);
}else{
    $order = "desc";
}



if (isset($_SESSION['user'])){
    $_SESSION['connectedToDb'] = true;
    $commentAuthorName = $_SESSION['user']['name'];
    $commentAuthorId = $_SESSION['user']['id'];
    $commentAuthorEmail = $_SESSION['user']['email'];
}

if (!isset($_SESSION['connectedToDb'])){
    createUsersTable();
    createCommentsTable();
    $_SESSION['connectedToDb'] = true;
}

if (isset($_POST['submit'])){
    if (isset($_SESSION['user'])){
        $commentCategory = htmlspecialchars(trim($_POST['category']));
        $commentTitle = htmlspecialchars(trim($_POST['title']));
        $commentContent = htmlspecialchars(trim($_POST['comment']));

        if ($commentCategory == "Select Category"){
            array_push($errors,"Please choose category!");
        }
        if (empty($commentTitle)){
            array_push($errors,"Comment title field is required!");
        }elseif (strlen($commentTitle)>56){
            array_push($errors,"Comment title is too long!");
        }
        if (empty($commentContent)){
            array_push($errors,"Comment field is required!");
        }
        else if (strlen($commentContent)<25 || strlen($commentContent>256)){
            array_push($errors,"Comment should be between 25 to 256 symbols!");
        }
        if(count($errors)==0){
            $conn = connect('commentProject');
            $commentCategory = mysqli_real_escape_string($conn,$commentCategory);
            $commentTitle = mysqli_real_escape_string($conn,$commentTitle);
            $commentContent = mysqli_real_escape_string($conn,$commentContent);
            $query = "insert into comments(category, title, content, authorEmail,authorId,authorName) values('$commentCategory','$commentTitle','$commentContent','$commentAuthorEmail','$commentAuthorId','$commentAuthorName')";
            $answer = mysqli_query($conn,$query);
            if ($answer){
                echo "true";
                array_push($success,'Your comment has been sent!');
                unset($_POST);
                header('Location:/JobTask/index.php');
            }else{
                if (mysqli_errno($conn)=='1062'){
                    array_push($errors,'User with this credentials is already in use!');
                }
                echo mysqli_errno($conn);
            }
            mysqli_close($conn);
        }
    }
}


?>

<div class="container">
    <h3 class="text-center">Comments</h3>
    <div class="dropdown">
        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
            Sort By
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <li><a class="dropdown-item" href="?order=asc">Ascending</a></li>
            <li><a class="dropdown-item" href="?order=desc">Descending</a></li>
        </ul>
    </div>
    <div class="dropdown mt-2">
        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
            Filter By Category
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <li><a class="dropdown-item" href="?category=sport">Sport</a></li>
            <li><a class="dropdown-item" href="?category=science">Science</a></li>
            <li><a class="dropdown-item" href="?category=space">Space</a></li>
        </ul>
    </div>
    <div class="d-flex justify-content-center mt-4 mb-100">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Recent Comments</h4>
                    </div>
                    <?php if (isset($comments)){
                        foreach ($comments as $comment){
                            $date = substr($comment[9],0,10);
                            echo "<div class='comment-widgets m-b-20'>";
                            echo "<div class='d-flex flex-row comment-row'>";
                            echo "<div class='comment-text w-100'>";
                            echo "<h5>$comment[6]</h5>";
                            echo "<span>$date</span>";
                            echo "<br>";
                            echo "<span>Title: $comment[2]</span>";
                            echo "<br>";
                            echo "<span>Category: $comment[1]</span>";
                            echo "<p class='m-b-5 m-t-10'>$comment[3]</p>";
                            echo "</div>";
                            echo "</div>";
                            echo "</div>";
                        }
                    }
                    ?>
                </div>
                <?php
                if (!count($comments)){
                    echo "<h3 class='my- text-center'>No comments!</h3>";
                }
                ?>
            </div>

        </div>
    </div>
    <h3 class="text-center">Leave a comment!</h3>
    <?php
    if (isset($errors)){
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
    }
    if (isset($success)){
        if (count($success)>0){
            echo  "<div class='alert alert-success'>";
            echo $success[0];
            echo "</div>";
        }
    }
    ?>
    <form action="" method="post">
        <select class="form-select mb-2" name="category" aria-label="Default select example">
            <option selected>Select Category</option>
            <option value="Sport">Sport</option>
            <option value="Science">Science</option>
            <option value="Space">Space</option>
        </select>
        <div class="input-group mb-2">
            <input type="text" class="form-control" name="title" value="<?php echo empty($_POST['title']) ? "" : $_POST['title']; ?>" placeholder="Comment title" aria-label="Username" aria-describedby="basic-addon1">
        </div>
        <div class="form-group mb-2">
            <textarea class="form-control" name="comment" id="" cols="30" rows="10"  style="resize: none" placeholder="Enter comment"></textarea>
        </div>
        <!--        <div class="form-group mb-3">-->
        <!--            <label for="exampleFormControlFile1">Attach your file!</label><br>-->
        <!--            <input type="file" name="file" accept="image/x-png, image/gif, image/jpeg" class="form-control-file"">-->
        <!--        </div>-->
        <div class="text-center">
            <button <?php echo isset($_SESSION['user']) ? "" : "disabled" ; ?> type="<?php echo isset($_SESSION['user']) ? "submit" : "button" ; ?>" name="submit" class="btn btn-primary btn-lg">Leave comment</button>
        </div>
    </form>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>



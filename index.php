<?php
session_start();
include 'partials/header.php';
include 'db.php';

if (!isset($_SESSION['connectedToDb'])){
    createUsersTable();
    createCommentsTable();
    $_SESSION['connectedToDb'] = true;
}

?>

<div class="container">
    <h3 class="text-center mt-2">Leave a comment!</h3>
    <form action="postComment.php" method="post">
        <select class="form-select mb-2" name="category" aria-label="Default select example">
            <option selected>Select comment Category</option>
            <option value="Sport">Sport</option>
            <option value="Science">Science</option>
            <option value="Space">Space</option>
        </select>
        <div class="input-group mb-2">
            <input type="text" class="form-control" name="title" placeholder="Comment title" aria-label="Username" aria-describedby="basic-addon1">
        </div>
        <div class="form-group mb-2">
            <textarea class="form-control" name="comment" id="" cols="30" rows="10"  style="resize: none"></textarea>
        </div>
        <div class="form-group mb-3">
            <label for="exampleFormControlFile1">Attach your file!</label><br>
            <input type="file" name="file" accept="image/x-png, image/gif, image/jpeg" class="form-control-file"">
        </div>
        <div class="text-center">
            <button disabled type="submit" class="btn btn-primary btn-lg">Send</button>
        </div>
    </form>
</div>






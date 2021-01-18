<?php
include "partials/header.php";
include "functions.php";

if (!isset($_SESSION['isModerator'])){
    header('Location:/JobTask/index.php');
    exit();
}

if (isset($comments)){
    loadDisabledComments();
}
if (isset($_GET['UnblockCommentById'])){
    $commentToBlock = $_GET['UnblockCommentById'];
    UnblockComment($commentToBlock);
}


?>


<div class="container">
    <h3 class="text-center">Moderator Page</h3>
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
                            echo "<a href='?UnblockCommentById=$comment[0]'><i class='fas fa-lock-open py-2'></i></a>";
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
                    echo "<h3 class='my-4 text-center'>No comments!</h3>";
                }
                ?>
            </div>

        </div>
    </div>



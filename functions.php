<?php
$comments = [];

function loadComments($order = "desc"){
    $conn = connect('commentProject');
    if ($conn){
        global $comments;
        $query = "SELECT * FROM comments where allowed='0' ORDER BY id $order ";
        $answer = mysqli_query($conn,$query);
        $comments = mysqli_fetch_all($answer);
    }
    else{
        echo "Error fetching comments!";
    }
}
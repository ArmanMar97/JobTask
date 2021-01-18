<?php
include "config/db.php";
$comments = [];
$users = [];

function loadComments($order = "desc"){
    $conn = connect('commentProject');
    if ($conn){
        global $comments;
        $query = "SELECT * FROM comments where allowed='1' ORDER BY id $order ";
        $answer = mysqli_query($conn,$query);
        $comments = mysqli_fetch_all($answer);
    }
    else{
        echo "Error fetching comments!";
    }
}
function loadDisabledComments($order = "desc"){
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


function loadUsers(){
    $conn = connect('commentProject');
    if ($conn){
        global $users;
        $query = "SELECT * FROM users WHERE role='user' or(role='moderator') ";
        $answer = mysqli_query($conn,$query);
        $users = mysqli_fetch_all($answer);
    }
    else{
        echo "Error fetching comments!";
    }
}


function blockUser($id){
    $conn = connect('commentProject');
    if ($conn){
        $query = "UPDATE `users` SET `isblocked`='1' WHERE `id`='$id'";
        $answer = mysqli_query($conn,$query);
        if ($answer){
            header('Location:/JobTask/adminPage.php');
            echo "User $id is blocked";
        }else{
            echo "error blocking user";
            header('Location:/JobTask/adminPage.php');
        }
    }
    else{
        echo "Error connecting to database!";
    }
}


function UnblockUser($id){
    $conn = connect('commentProject');
    if ($conn){
        $query = "UPDATE `users` SET `isblocked`='0' WHERE `id`='$id'";
        $answer = mysqli_query($conn,$query);
        if ($answer){
            header('Location:/JobTask/adminPage.php');
        }else{
            echo "Error unblocking user!";
            header('Location:/JobTask/adminPage.php');
        }
    }
    else{
        echo "Error connecting to database!";
    }
}

function setModerator($id){
    $conn = connect('commentProject');
    if ($conn){
        $query = "UPDATE `users` SET `role`='moderator' WHERE `id`='$id'";
        $answer = mysqli_query($conn,$query);
        if ($answer){
            header('Location:/JobTask/adminPage.php');
        }else{
            echo "Error unblocking user!";
            header('Location:/JobTask/adminPage.php');
        }
    }
    else{
        echo "Error connecting to database!";
    }
}

function deleteModerator($id){
    $conn = connect('commentProject');
    if ($conn){
        $query = "UPDATE `users` SET `role`='user' WHERE `id`='$id'";
        $answer = mysqli_query($conn,$query);
        if ($answer){
            header('Location:/JobTask/adminPage.php');
        }else{
            echo "Error unblocking user!";
            header('Location:/JobTask/adminPage.php');
        }
    }
    else{
        echo "Error connecting to database!";
    }
}

function UnblockComment($id){
    $conn = connect('commentProject');
    if ($conn){
        $query = "UPDATE `comments` SET `allowed`='1' WHERE `id`='$id'";
        $answer = mysqli_query($conn,$query);
        if ($answer){
            header('Location:/JobTask/moderatorPage.php');
        }else{
            echo "Error unblocking user!";
            header('Location:/JobTask/moderatorPage.php');
        }
    }
    else{
        echo "Error connecting to database!";
    }
}
<?php
session_start();
include 'db.php';

if (!isset($_POST['submit'])){
    $category = $_POST['category'];
    $title = $_POST['title'];
    $comment = $_POST['comment'];
    $file = $_POST['file'];
}

//var_dump($category);
var_dump($title);
var_dump($category);
var_dump($comment);
var_dump($file);

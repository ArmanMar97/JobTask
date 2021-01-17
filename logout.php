<?php
session_start();
unset($_SESSION['user']);
if (isset($_SESSION['isAdmin'])){
    unset($_SESSION['isAdmin']);
}
header('Location:./index.php');
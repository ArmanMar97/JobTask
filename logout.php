<?php
session_start();
unset($_SESSION['user']);
if (isset($_SESSION['isAdmin'])){
    unset($_SESSION['isAdmin']);
}
if (isset($_SESSION['isModerator'])){
    unset($_SESSION['isModerator']);
}
header('Location:./index.php');
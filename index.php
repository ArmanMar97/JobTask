<?php
session_start();
include 'db.php';

//if (!isset($_SESSION['tableCreated'])){
    createUsersTable();
    createCommentsTable();
//    $_SESSION['tableCreated'] = true;
//}




?>





<?php
include "partials/header.php";
include "functions.php";

if (!isset($_SESSION['isAdmin'])){
    header('Location:/JobTask/index.php');
    exit();
}

loadUsers();

if (isset($_GET['BlockById'])){
    $userToBlock = $_GET['BlockById'];
    blockUser($userToBlock);
}

if (isset($_GET['UnblockById'])){
    $userToUnblock = $_GET['UnblockById'];
    UnblockUser($userToUnblock);
}

if (isset($_GET['setModerator'])){
    $userToSetModerator = $_GET['setModerator'];
    setModerator($userToSetModerator);
}

if (isset($_GET['deleteModerator'])){
    $userToDeleteFromModerator = $_GET['deleteModerator'];
    deleteModerator($userToDeleteFromModerator);
}


?>

<div class="container-fluid px-1">
    <h2>Admin Page</h2>
    <div class="grid">
        <div class="grid-box text-center"><strong>Name</strong>
            <?php
            if (isset($users)) {
                foreach ($users as $user){
                    echo "<p>$user[1]</p>";
                }
            }
            ?>
        </div>
        <div class="grid-box text-center"><strong>Surname</strong>
            <?php
            if (isset($users)) {
                foreach ($users as $user){
                    echo "<p>$user[2]</p>";
                }
            }
            ?>
        </div>
        <div class="grid-box text-center"><strong>Email</strong>
            <?php
            if (isset($users)) {
                foreach ($users as $user){
                    echo "<p>$user[3]</p>";
                }
            }
            ?>
        </div>
        <div class="grid-box text-center"><strong>Phone</strong>
            <?php
            if (isset($users)) {
                foreach ($users as $user){
                    echo "<p>$user[4]</p>";
                }
            }
            ?>
        </div>
        <div class="grid-box text-center"><strong>Register Date</strong>
            <?php
            if (isset($users)) {
                foreach ($users as $user){
                    echo "<p>$user[8]</p>";
                }
            }
            ?>
        </div>
        <div class="grid-box text-center"><strong>ID</strong>
            <?php
            if (isset($users)) {
                foreach ($users as $user){
                    echo "<p>$user[0]</p>";
                }
            }
            ?>
        </div>
        <div class="grid-box text-center"><strong>IsModerator</strong>
            <?php
            if (isset($users)) {
                foreach ($users as $user){
                    if ($user[5]=='user'){
                        echo "<p><a href='?setModerator=$user[0]' style='padding-left:4px' '>Set Moderator</a></p>";
                    }else{
                        echo "<p><a href='?deleteModerator=$user[0]' style='padding-left:4px' '>Delete Moderator</a></p>";
                    }
                }
            }
            ?>
        </div>
        <div class="grid-box text-center"><strong>Block User</strong>
            <?php
            if (isset($users)){
                foreach ($users as $user){
                    if ($user[7]=='0'){
                        echo "<br>";
                        echo "<a href='?BlockById=$user[0]'><i class='fas fa-lock py-2'></i></a>";
                    }else{
                        echo "<br>";
                        echo "<a href='?UnblockById=$user[0]'><i class='fas fa-lock-open py-2'></i></a>";
                    }
                }
            }
            ?>
        </div>
    </div>
</div>


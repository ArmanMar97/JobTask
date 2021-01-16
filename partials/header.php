<?php
session_start();
?>



<title>Comment Page</title>
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Nanum+Gothic&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
<link rel="stylesheet" href="./assets/main.css">

<nav class="navbar navbar-expand navbar-light bg-light mb-2">
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item ">
                <a class="nav-link" href="./index.php">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="./registerPage.php"/register>Register</a>
            </li>
                <?php
                if (isset($_SESSION['user'])){
                    echo "<li class='nav-item'>";
                    echo "<a class='nav-link' href='./logout.php'>Log out</a>";
                    echo "</li>";
                }else{
                    echo "<li class='nav-item'>";
                    echo "<a class='nav-link' href='./signinPage.php'>Sign in</a>";
                    echo "</li>";
                }
                ?>
        </ul>
    </div>
</nav>
<?php
include 'partials/header.php';
include 'config/db.php';
$errors = [];







?>

<div class="container">
    <form class="mt-3" action="" method="post">
        <div class="input-group mx-auto mb-2 w-50">
            <input type="text" class="form-control" name="email" value="<?php echo empty($_POST['email']) ? "" : $_POST['email']; ?>" placeholder="Email" aria-describedby="basic-addon1">
        </div>
        <div class="input-group mx-auto mb-2 w-50">
            <input type="text" class="form-control" name="password" value="<?php echo empty($_POST['password']) ? "" : $_POST['password']; ?>" placeholder="Password" aria-describedby="basic-addon1">
        </div>
        <div class="text-center mt-4">
            <button type="submit" name="submit" class="btn btn-primary btn-lg">Sign in</button>
        </div>
    </form>
</div>

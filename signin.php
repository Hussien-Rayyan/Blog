<?php
    session_start();
    require 'config/constans.php';
    $username_email = $_SESSION['signin-data']['username_email'] ?? null ; 
    $password = $_SESSION['signin-data']['password'] ?? null ;
    unset($_SESSION['signin-data']) ;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>
    <!-- Css Files -->
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;1,500;1,900&display=swap" rel="stylesheet">
</head>
<body>
    <section class="form-section">
        <div class="container form-section-container">
            <h2> Sign In</h2>
            <?php if(isset($_SESSION['signup-success'])) : ?>
                <div class="alert-message success">
            <p>
                <?= $_SESSION['signup-success']; 
                unset($_SESSION['signup-success']); ?>
            </p>
        </div>
            <?php elseif(isset($_SESSION['signin'])) : ?>
                <div class="alert-message erorr">
            <p>
                <?= $_SESSION['signin']; 
                unset($_SESSION['signin']); ?>
            </p>
        </div>
            <?php endif ?>
        <form action="<?= ROOT_URL ?>signin-logic.php" method="POST">
            <input type="text" name="username_email" value="<?= $username_email ?>" placeholder="Username Or Email ">
            <input type="password" name="password" value="<?= $password ?>"  placeholder=" Password">
            <button type="submit" name="submit" class="btn">Sign In</button>
            <small>Don't Have Account ? <a href="signup.php">Sign Up</a></small>
        </form>
    </div>
    </section>
</body>
</html>
<?php
    session_start();
    require 'config/constans.php';
    // GET BACK FORM DATA IF THERE WAS A Registration ERORR 
    $firstname = $_SESSION['signup-data']['firstname'] ?? null; 
    $lastname = $_SESSION['signup-data']['lastname'] ?? null; 
    $username = $_SESSION['signup-data']['username'] ?? null; 
    $email = $_SESSION['signup-data']['email'] ?? null; 
    $createpassword = $_SESSION['signup-data']['createpassword'] ?? null; 
    $confirmpassword = $_SESSION['signup-data']['confirmpassword'] ?? null; 
    // Delete Signup Date Session 
    unset($_SESSION['signup-data']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <!-- Css Files -->
    <link rel="stylesheet" href="<?= ROOT_URL ?>css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;1,500;1,900&display=swap" rel="stylesheet">
</head>
<body>
    <section class="form-section">
        <div class="container form-section-container">
            <h2> Sign Up</h2>
            <?php if(isset($_SESSION['signup'])): ?>
                <div class="alert-message erorr">
                <p>
                <?= $_SESSION['signup'];
                unset($_SESSION['signup']); ?>
                </p>
                </div>
                <?php endif ?>
        <form action="<?= ROOT_URL ?>signup-logic.php" enctype="multipart/form-data" method="POST">
            <input type="text" value="<?= $firstname ?>" name="firstname"  placeholder="First Name">
            <input type="text" value="<?= $lastname ?>" name="lastname" placeholder="Last Name">
            <input type="text" value="<?= $username ?>" name="username" placeholder="User Name">
            <input type="email" value="<?= $email ?>" name="email" placeholder=" Email">
            <input type="password" value="<?= $createpassword ?>" name="createpassword" placeholder="Create Password">
            <input type="password" value="<?= $confirmpassword ?>" name="confirmpassword" placeholder="Confirm Password">
            <div class="form-control">
                <label for="avatar">User Avatar</label>
                <input type="file" name="avatar" id="avatar">
            <button type="submit" name="submit" class="btn">Sign Up</button>
            <small>Already Have An Account ? <a href="signin.php">Sign In</a></small>
        </form>
    </div>
    </section>
</body>
</html>
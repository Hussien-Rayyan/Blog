<?php
    require 'config/database.php';
    // fetch Current User From Database 
    if(isset($_SESSION['user-id'])) {
        $id = filter_var($_SESSION['user-id'] , FILTER_SANITIZE_NUMBER_INT);
        $query = "SELECT avatar FROM users WHERE id=$id";
        $result = mysqli_query($con , $query);
        $avatar = mysqli_fetch_assoc($result);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog</title>
    <!-- Css Files -->
    <link rel="stylesheet" href="<?= ROOT_URL?>css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;1,500;1,900&display=swap" rel="stylesheet">
</head>
<body>
    <nav>
        <div class="container nav-container">
            <a href="index.php" class="nav-logo">Blog</a>
            <ul class="nav-items">
                <li><a href="<?= ROOT_URL ?>blog.php">blog</a></li>
                <li><a href="<?= ROOT_URL ?>services.php">Services</a></li>
                <li><a href="<?= ROOT_URL ?>contact.php">Contact</a></li>
                <?php if(isset($_SESSION['user-id'])) : ?>
                    <li class="nav-profile">
                    <div class="avatar">
                        <img src="<?= ROOT_URL .'images/' . $avatar['avatar'] ?>" alt="User Avatar">
                    </div>
                    <ul>
                        <li><a href="<?= ROOT_URL ?>admin/index.php">Dashboard</a></li>
                        <li><a href="<?= ROOT_URL ?>logout.php">Log Out</a></li>
                    </ul>
                </li>
                <?php else : ?>
                <li><a href="<?= ROOT_URL ?>signin.php">Sign In</a></li>
                <?php endif ?>
            </ul>
            <button id="open-nav-btn"><i class="fa fa-bars"></i></button>
            <button id="close-nav-btn"><i class="fa fa-xmark"></i></button>
        </div>
    </nav>
    <!-- End Of Nav  -->
    <script src="<?= ROOT_URL ?>js/main.js"></script>
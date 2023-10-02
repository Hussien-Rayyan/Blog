<?php
    require '../partials/header.php';
    // Check User Status 
    if(!isset($_SESSION['user-id'])) {
        header('location:' . ROOT_URL . 'signin.php');
        die();  
    }




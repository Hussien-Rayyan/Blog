<?php
    session_start();
    require 'config/constans.php';
    // Destory All Sessions and Rediret  User To Login Page
    session_destroy();
    header('location: '. ROOT_URL );
    die();
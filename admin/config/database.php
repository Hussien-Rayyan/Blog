<?php
    session_start();
    require 'constans.php';
    // Coneect To The Database 
    $con = new mysqli(DB_HOST, DB_USER ,  DB_PASS ,DB_NAME );
    if(mysqli_errno($con)) { 
        die(mysqli_erorr($con));
    }

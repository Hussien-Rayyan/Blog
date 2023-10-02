<?php
    include 'partials/header.php';
    if(isset($_POST['submit'])) {
        // get update form database
        $id = filter_var($_POST['id'] , FILTER_SANITIZE_NUMBER_INT);
        $firstname = filter_var($_POST['firstname'] , FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $lastname = filter_var($_POST['lastname'] , FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $is_admin = filter_var($_POST['userrole'] , FILTER_SANITIZE_NUMBER_INT);
        // Check For Valid Inputs 
        if(!$firstname || !$lastname) {
            $_SESSION['edit-user'] = "invailed Form Input on Edit Page.";
        } else {
            // Update User 
            $query = "UPDATE users SET firstname='$firstname' , lastname='$lastname' , is_admin='$is_admin'
            WHERE id=$id  LIMIT 1";
            $result = mysqli_query($con , $query);
            if(mysqli_errno($con)) {
                $_SESSION['edit-user'] = "Faild To Update User $first $lastname";
            } else {
                $_SESSION['edit-user-success'] = "User $firstname $lastname Updated Successfully";
            }
        }
    }
    header ('location: ' . ROOT_URL . 'admin/mange-users.php');
    die();
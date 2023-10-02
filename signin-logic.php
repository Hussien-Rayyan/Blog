<?php 
    session_start();
    require 'config/database.php';
    if(isset($_POST['submit'])) {
        // Get Form Data
        $username_email =filter_var($_POST['username_email'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $password =filter_var($_POST['password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        if(!$username_email) {
            $_SESSION['signin'] = "Username Or Email Required";
        } elseif (!$password) {
            $_SESSION['signin'] = "Password Required";
        } else {
            // Fetch User From Database 
            $fetch_user_query = "SELECT * FROM users WHERE username='$username_email' OR email='$username_email'";
            $fetch_user_result = mysqli_query($con , $fetch_user_query);
            if (mysqli_num_rows($fetch_user_result) == 1) {
                // Convert The Record Into Assoc Array
                $user_record =mysqli_fetch_assoc($fetch_user_result);
                $db_password =$user_record['password'];
                // Compare From Password With Database Password
                if(password_verify($password ,$db_password)) {
                    // set session From Access Control
                    $_SESSION['user-id'] = $user_record['id'];
                    // set session If User Is An Admin
                    if($user_record['is_admin'] == 1) {
                        $_SESSION['user_is_admin'] = true;
                    }
                    // Log User In 
                    header('location:' . ROOT_URL .'admin/');
                } else {
                    $_SESSION['signin'] ="Please Check Your Password";
                }
            } else {
                $_SESSION['signin'] ="User Not Found";
            }
        }
        // If Any Problem , Redirect Back To Signin Page With Login data
        if(isset($_SESSION['signin'])) {
            $_SESSION['signin-data'] = $_POST;
            header('location: ' . ROOT_URL . 'signin.php');
            die();
        }
    } else {
        header ('location:' . ROOT_URL . 'signin.php');
        die();
    }
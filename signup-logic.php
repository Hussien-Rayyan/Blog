<?php
    session_start();
    require 'config/database.php';
    if(isset($_POST['submit'])) {
        $firstname = filter_var($_POST['firstname'] , FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $lastname = filter_var($_POST['lastname'] , FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $username = filter_var($_POST['username'] , FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $email = filter_var($_POST['email'] , FILTER_VALIDATE_EMAIL);
        $createpassword = filter_var($_POST['createpassword'] , FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $confirmpassword = filter_var($_POST['confirmpassword'] , FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $avatar = $_FILES['avatar'];
        // validate input values 
        if (!$firstname) {
            $_SESSION['signup'] = "Plese Enter Your First Name";
        } elseif (!$lastname) {
            $_SESSION['signup'] = "Plese Enter Your Last Name";
        } elseif (!$username) {
            $_SESSION['signup'] = "Plese Enter Your user Name";
        } elseif (!$email) {
            $_SESSION['signup'] = "Plese Enter Your Email";
        } elseif (strlen($createpassword) < 8 || strlen($confirmpassword) < 8) {
            $_SESSION['signup'] = "Password Shoud Be 8+ Characters";
        } elseif (!$avatar['name']) {
            $_SESSION['signup'] = "Plese Add Avatar";
        } else {
            // Check Of Password Don't Match 
            if($createpassword !== $confirmpassword ) {
                $_SESSION['signup'] = "Password Do Not Match";
            } else {
                // Hash Password 
                $hashed_password = password_hash($createpassword , PASSWORD_DEFAULT);
                // Check If User Name Or Email Exist In Database 
                $user_check_query = "SElECT * FROM users WHERE username = '$username' OR email='$email'";
                $user_check_result = mysqli_query ($con , $user_check_query);
                if (mysqli_num_rows($user_check_result) > 0) {
                    $_SESSION['signup'] = "Username Or Email Already Exist";
                } else {
                    // Work On Avatar
                    // Raname Avatar
                    $time = time(); /* Make Each Image Name Unique Using Current Timestamp */
                    $avatar_name = $time . $avatar ['name'];
                    $avatar_tmp_name =$avatar ['tmp_name'];
                    $avatar_destination_path = 'images/'. $avatar_name ;
                    // Make Sure Files Is An Image 
                    $allowed_files =['png' , 'jpg' , 'jpeg'];
                    $extention = explode('.' , $avatar_name);
                    $extention = end($extention);
                    if(in_array($extention ,$allowed_files)) {
                        // Make Sure Is Image Is Not Too Large  (1mb+)
                        if($avatar['size'] < 20000000 ){
                            // Upload Avatar 
                            move_uploaded_file($avatar_tmp_name , $avatar_destination_path);
                        }
                        else {
                            $_SESSION['signup'] = "File Size To Big . Shoud Be Less Than 1Mb";
                        }
                    } else {
                        $_SESSION['signup'] = "File Shoud Be Png , Jpg , Jpeg";
                    }
                }
            }
        } 
        // Redirect To Signup Page If There Was Any Problem 
        if (isset($_SESSION['signup'])){
            // Pass From Data Back To SignUP Page
            $_SESSION['signup-data'] = $_POST;
            header('location:' . ROOT_URL . 'signup.php');
            die();
        } else {
            // Insert New User In Users Table 
            $insert_user_query = "INSERT INTO users SET firstname='$firstname' , lastname='$lastname' , username='$username' , email='$email' , password='$hashed_password' , avatar='$avatar_name' , is_admin=0";
            $insert_user_result = mysqli_query($con , $insert_user_query);
            if(!mysqli_errno($con)) {
                // redirect To Login Page With Success Message
                $_SESSION['signup-success'] = "Registration Successful . Please Log In";
                header('location:' . ROOT_URL . 'signin.php');
                // die();
            }
        }
        } else {
            // If Button Wasn't Clicked ,Bounce Back To Signup Page
            header('location: '. ROOT_URL .'signup.php');
            die();       
    }

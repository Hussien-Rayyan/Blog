<?php
    session_start();
    require 'config/database.php';
    // Get Form Data Was Submit Btn  Clicked 
    if(isset($_POST['submit'])) {
        $firstname = filter_var($_POST['firstname'] , FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $lastname = filter_var($_POST['lastname'] , FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $username = filter_var($_POST['username'] , FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $email = filter_var($_POST['email'] , FILTER_VALIDATE_EMAIL);
        $createpassword = filter_var($_POST['createpassword'] , FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $confirmpassword = filter_var($_POST['confirmpassword'] , FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $is_admin = filter_var($_POST['userrole'] , FILTER_SANITIZE_NUMBER_INT);
        $avatar = $_FILES['avatar'];
        // validate input values 
        if (!$firstname) {
            $_SESSION['add-user'] = "Please Enter Your First Name";
        } elseif (!$lastname) {
            $_SESSION['add-user'] = "Please Enter Your Last Name";
        } elseif (!$username) {
            $_SESSION['add-user'] = "Please Enter Your user Name";
        } elseif (!$email) {
            $_SESSION['add-user'] = "Please Enter Your Email";
        } elseif (strlen($createpassword) < 8 || strlen($confirmpassword) < 8) {
            $_SESSION['add-user'] = "Password Shoud Be 8+ Characters";
        } elseif (!$avatar['name']) {
            $_SESSION['add-user'] = "Please Add Avatar";
        } else {
            // Check Of Password Don't Match 
            if($createpassword !== $confirmpassword ) {
                // 
                $_SESSION['add-user'] = "Password Do Not Match";
            } else {
                // Hash Password 
                $hashed_password = password_hash($createpassword , PASSWORD_DEFAULT);
                // Check If User Name Or Email Exist In Database 
                $user_check_query = "SElECT * FROM users WHERE username = '$username' OR email='$email'";
                $user_check_result = mysqli_query ($con , $user_check_query);
                if (mysqli_num_rows($user_check_result) > 0) {
                    $_SESSION['add-user'] = "Username Or Email Already Exist";
                } else {
                    // Work On Avatar
                    // Raname Avatar
                    $time = time(); /* Make Each Image Name Unique Using Current Timestamp */
                    $avatar_name = $time . $avatar ['name'];
                    $avatar_tmp_name =$avatar ['tmp_name'];
                    $avatar_destination_path = '../images/'. $avatar_name ;
                    // Make Sure Files Is An Image 
                    $allowed_files =['png' , 'jpg' , 'jpeg'];
                    $extention = explode('.' , $avatar_name);
                    $extention = end($extention);
                    if(in_array($extention ,$allowed_files)) {
                        // Make Sure Is Image Is Not Too Large  (1mb+)
                        if($avatar['size'] < 1000000 ){
                            // Upload Avatar 
                            move_uploaded_file($avatar_tmp_name , $avatar_destination_path);
                        }
                        else {
                            $_SESSION['add-user'] = "File Size To Big . Shoud Be Less Than 1Mb";
                        }
                    } else {
                        $_SESSION['add-user'] = "File Shoud Be Png , Jpg , Jpeg";
                    }
                }
            }
        } 
        // Redirect To add-user Page If There Was Any Problem 
        if (isset($_SESSION['add-user'])){
            // Pass From Data Back To add-user Page
            $_SESSION['add-user-data'] = $_POST;
            header('location:' . ROOT_URL . '/admin/add-user.php');
            die();
        } else {
            // Insert New User In Users Table 
            $insert_user_query = "INSERT INTO users SET firstname='$firstname' , lastname='$lastname' ,
            username='$username' , email='$email' , password='$hashed_password' , avatar='$avatar_name' , is_admin=$is_admin";
            $insert_user_result = mysqli_query($con , $insert_user_query);
            if(!mysqli_errno($con)) {
                // redirect To Manage Users Page With Success Message
                $_SESSION['add-user-success'] = "New User $firstname $lastname Added Seccessfully";
                header('location:' . ROOT_URL . 'admin/mange-users.php');
                // die();
            }
        }
        } else {
            // If Button Wasn't Clicked ,Bounce Back To Add User Page
            header('location: '. ROOT_URL .'admin/add-user.php');
            die();       
    }
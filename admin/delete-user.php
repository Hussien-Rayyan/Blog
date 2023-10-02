<?php
    // require 'config/database.php';
    include 'partials/header.php';
    if(isset($_GET['id'])) {
        $id = filter_var($_GET['id'] , FILTER_SANITIZE_NUMBER_INT);
        
        // Fetch user from database
        $query = "SELECT * FROM users WHERE id=$id" ;
        $result =mysqli_query($con , $query);
        $user =mysqli_fetch_assoc($result);

        // make sure we got back one user 
        if(mysqli_num_rows($result) == 1 ) {
            $avatar_name = $user['avatar'];
            $avatar_path = '../images/' . $avatar_name;
            // Delete images is available 
            if($avatar_path) {
                unlink($avatar_path);
            }
        }
        // fetch all thunmbnails of users posts and delete them
        $thumbnails_query = "SELECT thumbnail FROM posts WHERE author_id=$id";
        $thumbnails_resulet =mysqli_query($con , $thumbnails_query);
        if(mysqli_errno($thumbnails_resulet) > 0) {
            while($thumbnail = mysqli_fetch_assoc($thumbnails_resulet)) {
                $thumbnail_path = '../images/' . $thumbnail['thumbnail'];
                // delete thumbnail from images folder is exist
                if ($thumbnail_path) {
                    unlink($thumbnail_path);
                }
            }
        } 
        // Delete users from database 
        $delete_user_query = "DELETE FROM users WHERE id=$id";
        $delete_user_result = mysqli_query($con , $delete_user_query);
        if(mysqli_errno($con)) {
            $_SESSION['delete-user'] = "Faild To Delete User";
        } else {
            $_SESSION['delete-user-success'] = "{$user['firstname']} {$user['lastname']} Deleted Successfully" ;
        }
    }
    header ('location: ' . ROOT_URL . 'admin/mange-users.php');
    die();
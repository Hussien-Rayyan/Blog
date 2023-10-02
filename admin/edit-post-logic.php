<?php
    include 'partials/header.php';
    if(isset($_POST['submit'])) {
        // get update form database
        $id = filter_var($_POST['id'] , FILTER_SANITIZE_NUMBER_INT);
        $previous_thumbnail_name = filter_var($_POST['previous_thumbnail_name'],
        FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $title = filter_var($_POST['title'] , FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $body = filter_var($_POST['body'] , FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $is_featured = filter_var($_POST['is_featured'] , FILTER_SANITIZE_NUMBER_INT);
        $category_id = filter_var($_POST['category_id'] , FILTER_SANITIZE_NUMBER_INT);
        $thumbnail = $_FILES['thumbnail'];
        // set is featured to 0 if it was unchecked 
        $is_featured = $is_featured == 1 ?: 0 ;
        // Check and viladate inputs values
        if(!$title) {
            $_SESSION['edit-post'] = "Couldn't Update Post . Inviled Form Data On Edit Post Page title.";
        } elseif (!$category_id) {
            $_SESSION['edit-post'] = "Couldn't Update Post . Inviled Form Data On Edit Post Page. cat";
        } elseif (!$body) {
            $_SESSION['edit-post'] = "Couldn't Update Post . Inviled Form Data On Edit Post Page. body";
        } else {
            // delete existing thumbnail is new thumbnail is available
            if($thumbnail['name']) {
                $previous_thumbnail_path = '../images/' . $previous_thumbnail_name ;
                if($previous_thumbnail_path) {
                    unlink($previous_thumbnail_path);
                }
                     // Work On thumbnail
                    // Raname thumbnail
                    $time = time(); /* Make Each Image Name Unique Using Current Timestamp */
                    $thumbnail_name = $time . $thumbnail['name'];
                    $thumbnail_tmp_name =$thumbnail['tmp_name'];
                    $thumbnail_destination_path = '../images/'. $thumbnail_name ;
                    // Make Sure Files Is An Image 
                    $allowed_files =['png' , 'jpg' , 'jpeg'];
                    $extention = explode('.' , $thumbnail_name);
                    $extention = end($extention);
                    if (in_array($extention , $allowed_files)) {
                        // Make Sure Is Image Is Not Too Large  (2mb+)
                        if($thumbnail['size'] < 2000000 ) {
                            // Upload thumbnail 
                            move_uploaded_file($thumbnail_tmp_name , $thumbnail_destination_path);
                        } else {
                            $_SESSION['edit-post'] = "File Size To Big . Shoud Be Less Than 2Mb";
                        }
                    } else {
                        $_SESSION['edit-post'] = "File Shoud be Png , Jpg , Jpeg";
                }
            }
        }
            // Redirect To mange-post Page If There Was Any Problem 
            if ($_SESSION['edit-post']){
                // Pass From Data Back To edit-post Page
                $_SESSION['edit-post-data'] = $_POST;
                header('location:' . ROOT_URL . 'admin/');
                die();
            } else {
                // Set is featured of all posts to 0 if is featured for this post is 1
                if ($is_featured == 1) {
                    $zero_all_is_featured_query ="UPDATE posts SET is_featured=0";
                    $zero_all_is_featured_result=mysqli_query($con , $zero_all_is_featured_query);
                }
                // Set thumbnail name if a new one uplpaded ,else keep older thumbnail name 
                $thumbnail_to_insert = $thumbnail_name ?? $previous_thumbnail_name ;
                // Insert New post In posts Table 
                $query = "UPDATE posts SET title='$title' , body='$body' , thumbnail='$thumbnail_to_insert'
                ,category_id=$category_id ,is_featured=$is_featured WHERE id=$id LIMIT 1 ";
                $result =mysqli_query($con , $query);
            }
                if(!mysqli_errno($con)) {
                    // redirect To mange post Page With Success Message
                    $_SESSION['edit-post-success'] = " post Updated Seccessfully";
                }
            }
    header('location: '. ROOT_URL .'admin/');
    die(); 
    
<?php
    include 'partials/header.php';
    // Get Form Data Was Submit Btn  Clicked 
    if(isset($_POST['submit'])) {
        $author_id = $_SESSION['user-id'];
        $title = filter_var($_POST['title'] , FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $body = filter_var($_POST['body'] , FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $category_id = filter_var($_POST['category'] , FILTER_SANITIZE_NUMBER_INT);
        $is_featured = filter_var($_POST['is_featured'] , FILTER_SANITIZE_NUMBER_INT);
        $thumbnail = $_FILES['thumbnail'];
        // Set is featured to 0 if unchecked 
        $is_featured =$is_featured == 1 ? : 0 ;
        // validate input values 
        if (!$title) {
            $_SESSION['add-post'] ="Please Enter Post Title";
        } elseif (!$body) {
            $_SESSION['add-post'] = " Enter Post Body";
        } elseif (!$category_id) {
            $_SESSION['add-post'] = "Select Post Category";
        } elseif (!$thumbnail['name']) {
            $_SESSION['add-post'] = "Choose Post Thumbnail";
        } else {
                // Work On thumbnail
                // Raname thumbnail
                $time = time(); /* Make Each Image Name Unique Using Current Timestamp */
                $thumbnail_name = $time . $thumbnail['name'];
                $thumbnail_tmp_name =$thumbnail['tmp_name'];
                $thumbnail_destination_path = '../images/' . $thumbnail_name ;
                // Make Sure Files Is An Image 
                $allowed_files = ['png' , 'jpg' , 'jpeg'];
                $extention = explode('.' , $thumbnail_name);
                $extention = end($extention);
                if(in_array($extention ,$allowed_files)) {
                    // Make Sure Is Image Is Not Too Large  (2mb+)
                    if($thumbnail['size'] < 2000000 ) {
                        // Upload thumbnail 
                        move_uploaded_file($thumbnail_tmp_name , $thumbnail_destination_path); 
                    } else {
                        $_SESSION['add-post'] = "File Size To Big . Shoud Be Less Than 2Mb";
                }
            } else {
                    $_SESSION['add-post'] = "File Shoud be Png , Jpg , Jpeg";
        }
    }
        // Redirect To add-post Page If There Was Any Problem 
        if (isset($_SESSION['add-post'])){
            // Pass From Data Back To add-post Page
            $_SESSION['add-post-data'] = $_POST;
            header('location:' . ROOT_URL . '/admin/add-post.php');
            die();
        } else {
            // Set is featured of all posts to 0 if is featured for this post is 1
            if ($is_featured == 1) {
                $zero_all_is_featured_query ="UPDATE posts SET is_featured= 0";
                $zero_all_is_featured_result=mysqli_query($con , $zero_all_is_featured_query);
            }
            // Insert New post In posts Table 
            $query = "INSERT INTO posts( title , body , thumbnail ,author_id ,category_id ,is_featured) 
            VALUES ('$title', '$body' , '$thumbnail_name' , $author_id , $category_id , $is_featured ) ";
            // $query = "INSERT INTO posts SET title='$title' , body='$body' , thumbnail='$thumbnail_name' ,author_id=$author_id ,category_id=$category_id ,is_featured=$is_featured ";
            $result = mysqli_query($con , $query);
            if(!mysqli_errno($con)) {
                // redirect To mange post Page With Success Message
                $_SESSION['add-post-success'] = "New post Added Seccessfully";
                header('location:' . ROOT_URL . 'admin/');
                die();
            }
        }
    }
header('location: '. ROOT_URL .'admin/add-post.php');
die(); 

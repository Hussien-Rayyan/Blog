<?php
    include 'partials/header.php';
    if(isset($_GET['id'])) {
        $id = filter_var($_GET['id'] , FILTER_SANITIZE_NUMBER_INT);
        
        // Fetch posts from database in order to delete thumbnail from folder
        $query = "SELECT * FROM posts WHERE id=$id" ;
        $result =mysqli_query($con , $query);
        
        // make sure only one recored/post featched 
        if(mysqli_num_rows($result) == 1 ) {
            $post =mysqli_fetch_assoc($result);
            $thumbnail_name = $post['thumbnail'];
            $thumbnail_path = '../images/' . $thumbnail_name;
            // Delete images is available 
            if($thumbnail_path) {
                unlink($thumbnail_path);

                $delete_post_query = "DELETE FROM posts WHERE id=$id LIMIT 1";
                $delete_post_result = mysqli_query($con , $delete_post_query);
                if(!mysqli_errno($con)) {
                    $_SESSION['delete-post-success'] = "{$post['title']} Post Deleted Successfully" ;
                } else {
                    $_SESSION['delete-post'] = "Faild To Delete Post";
                }
            }
        }
    }
    header ('location: ' . ROOT_URL . 'admin/');
    die();
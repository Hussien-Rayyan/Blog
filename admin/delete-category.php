<?php
    include 'partials/header.php';
    if(isset($_GET['id'])) {
        $id = filter_var($_GET['id'] , FILTER_SANITIZE_NUMBER_INT);
        // update category id of posts belong to this category to id of uncategorized category
        $update_query = "UPDATE posts SET category_id=7 WHERE category_id=$id";
        $update_resulet =mysqli_query($con , $update_query);
        if(!mysqli_errno($con)) {
                // Delete categories from database 
            $query = "DELETE FROM categories WHERE id=$id LIMIT 1";
            $result = mysqli_query($con , $query);
            $_SESSION['delete-category-success'] = "Category Deleted Successfully" ;
        }
    }
    header ('location: ' . ROOT_URL . 'admin/mange-categories.php');
    die();

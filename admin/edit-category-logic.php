<?php
    include 'partials/header.php';
    if(isset($_POST['submit'])) {
        // get update form database
        $id = filter_var($_POST['id'] , FILTER_SANITIZE_NUMBER_INT);
        $title = filter_var($_POST['title'] , FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $description = filter_var($_POST['description'] , FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        // Check For Valid Inputs 
        if(!$title || !$description) {
            $_SESSION['edit-category'] = "invailed Form Input on Edit Category Page.";
        } else {
            // Update category 
            $query = "UPDATE categories SET title='$title' , description='$description' WHERE id=$id  LIMIT 1";
            $result = mysqli_query($con , $query);
            if(mysqli_errno($con)) {
                $_SESSION['edit-category'] = "Couldn't Update Category $title";
            } else {
                $_SESSION['edit-category-success'] = "Category $title Updated Successfully";
            }
        }
    }
    header ('location: ' . ROOT_URL . 'admin/mange-categories.php');
    die();
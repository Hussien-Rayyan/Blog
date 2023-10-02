<?php
    include 'partials/header.php';
    if(isset($_POST['submit'])) {
        // Get form data 
        $title = filter_var($_POST['title'] , FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $description = filter_var($_POST['description'] , FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if(!$title) {
            $_SESSION['add-category'] ="Enter Title";
        } elseif(!$description) {
            $_SESSION['add-category'] ="Enter Description";
        }
        // Redirect back to add category page with form data if there was inviled input
        if(isset($_SESSION['add-category'])) {
            $_SESSION['add-category-data'] = $_POST;
            header('location: ' . ROOT_URL . 'admin/add-category.php');
            die();
        } else {
            // Insert category into database
            $_query ="INSERT INTO categories(title , description) VALUES ('$title' , '$description')";
            $result =mysqli_query($con , $_query);
            if(mysqli_errno($con)) {
                $_SESSION['add-category']= "Couldn't Add Category";
                header('location: ' . ROOT_URL . 'admin/add-category.php');
                die();
            } else {
                $_SESSION['add-category-success']= "Category $title Added Successfully";
                header('location: ' . ROOT_URL . 'admin/mange-categories.php');
                die();
            }
        }
    }

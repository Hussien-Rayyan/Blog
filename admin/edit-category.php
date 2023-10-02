<?php
    include 'partials/header.php';

    if (isset($_GET['id'])) {
        $id = filter_var($_GET['id'] , FILTER_SANITIZE_NUMBER_INT);
        // fetch category from database 
        $query = "SELECT * FROM categories WHERE id=$id";
        $result = mysqli_query($con , $query);
        if(mysqli_num_rows($result) == 1)  {
            $category =mysqli_fetch_assoc($result);
        }
    } else {
        header ('location: ' . ROOT_URL . 'admin/mange-categories.php');
        die();
    }
?>
    <section class="form-section">
        <div class="container form-section-container">
            <h2> Edit Category</h2>
        <form action="<?= ROOT_URL?>admin/edit-category-logic.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" value="<?= $category['id'] ?>"  name="id">
            <input type="text" value="<?= $category['title'] ?>"  name="title" placeholder="Title ">
            <textarea  rows="4" name="description" placeholder="Description"><?= $category['description'] ?></textarea>
            <button type="submit" name="submit" class="btn">Update Category</button>
        </form>
    </div>
    </section>
    <!-- Footer -->
<?php
    include '../partials/footer.php';
?>

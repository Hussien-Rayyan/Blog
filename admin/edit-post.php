<?php
    include 'partials/header.php';
        // fetch category from database 
        $category_query = "SELECT * FROM categories";
        $categories = mysqli_query($con , $category_query);


        // Fetch post data from database if id is set 
        if(isset($_GET['id'])) {
            $id = filter_var($_GET['id'] , FILTER_SANITIZE_NUMBER_INT);
            $query = "SELECT * FROM posts WHERE id=$id";
            $result = mysqli_query($con , $query);
            $post =mysqli_fetch_assoc($result);
        } else {
            header ('location: ' . ROOT_URL . 'admin/');
            die();
        }
    ?>

    <section class="form-section ">
        <div class="container form-section-container">
            <h2> Edit Post</h2>
        <form action="<?= ROOT_URL?>admin/edit-post-logic.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" value="<?= $post['id'] ?>" name="id">
            <input type="hidden" value="<?= $post['thumbnail'] ?>" name="previous_thumbnail_name">
            <input type="text" value="<?= $post['title'] ?>" name="title" placeholder="Title ">
            <select name="category_id">
            <?php while($category = mysqli_fetch_assoc($categories)) : ?>
                <option value="<?= $category['id'] ?>"> <?= $category['title'] ?></option>
                <?php endwhile ?> 
            </select>
            <textarea  rows="10" placeholder="Body" name="body"> <?= $post['body'] ?></textarea>
            <div class="form-control inline">
                <input type="checkbox" checked id="is_featured" value="1" name="is_featured">
                <label for="is_featured">Featuerd</label>
            </div>
            <div class="form-control">
                <label for="thumbnail">Change Thumbnail</label>
                <input type="file" name="thumbnail" id="thumbnail">
            </div>
            <button type="submit" name="submit" class="btn">Update Post</button>
        </form>
    </div>
    </section>
    <!-- Footer -->
<?php
    include '../partials/footer.php';
?>

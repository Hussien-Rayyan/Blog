<?php
    include 'partials/header.php';
    // fetch categories from database 
    $query = "SELECT * FROM categories ";
    $categories = mysqli_query($con ,$query); 
    // get back form data if form was inviled
    $title = $_SESSION['add-post-data']['title'] ?? null ;
    $body = $_SESSION['add-post-data']['body'] ?? null ;
    // Deleta Form data Session  
    unset($_SESSION['add-post-data']);
    ?>



    <section class="form-section ">
    <?php if(isset($_SESSION['user_is_admin'])) :?>
        <div class="container form-section-container">
            <h2> Add Post</h2>
            <?php if(isset($_SESSION['add-post'])) : ?>
                <div class="alert-message erorr">
                    <p>
                        <?= $_SESSION['add-post'];
                        unset($_SESSION['add-post']); ?>
                    </p>
                </div>
            <?php endif ?>
        <form action="<?= ROOT_URL ?>admin/add-post-logic.php" enctype="multipart/form-data" method="POST">
            <input type="text" name="title" value="<?= $title ?>" placeholder="Title ">
            <select name="category">
                <?php while($category = mysqli_fetch_assoc($categories)) : ?>
                <option value="<?= $category['id'] ?>"> <?= $category['title'] ?></option>
                <?php endwhile ?>
            </select>
            <textarea  rows="10" name="body" placeholder="Body"><?= $body ?></textarea>
            <?php if(isset($_SESSION['user_is_admin'])) : ?>
            <div class="form-control inline">
                <input type="checkbox" name="is_featured" value="1" checked id="is_featured">
                <label for="is_featured">Featuerd</label>
            </div>
            <?php endif ?>
            <div class="form-control">
                <label for="thumbnail">Add Thumbnail</label>
                <input type="file" name="thumbnail" value="<?= $thumbnail ?>" id="thumbnail">
            </div>
            <button type="submit" name="submit" class="btn">Add Post</button>
        </form>
    </div>
    <?php else : ?>
                    <?php
                        header('location: '. ROOT_URL);
                        die();  
                    ?>
                        <?php endif ?>
    </section>
    <!-- Footer -->
<?php
    include '../partials/footer.php';
?>

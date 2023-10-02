<?php
    include 'partials/header.php';
    // Get back form data if invaild 
    $title = $_SESSION['add-category-data']['title'] ?? null ;
    $description = $_SESSION['add-category-data']['description'] ?? null ;
    // Deleta Session Data 
    unset($_SESSION['add-category-data']);
?>
    <section class="form-section">
<?php if(isset($_SESSION['user_is_admin'])) :?>
        <div class="container form-section-container">
            <h2> Add Category</h2>
            <?php if(isset($_SESSION['add-category'])) : ?>
                        <div class="alert-message erorr container">
                            <p>
                                <?= $_SESSION['add-category'];
                                unset($_SESSION['add-category']); ?>
                            </p>
                        </div>
                    <?php endif ?> 
        <form action="<?= ROOT_URL ?>admin/add-category-logic.php" method="POST">
            <input type="text" name="title" value="<?=$title?>" placeholder="Title ">
            <textarea  rows="4" name="description" placeholder="Description"><?=$description?></textarea>
            <button type="submit" name="submit" class="btn">Add Category</button>
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

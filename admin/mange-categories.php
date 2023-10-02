<?php
    include 'partials/header.php';

    // Fetch category from database
    $query = "SELECT * FROM categories ORDER BY title";
    $categories =mysqli_query($con , $query);

?>

    <section class="dashboard">
    <?php if(isset($_SESSION['user_is_admin'])) :?>
            <?php if(isset($_SESSION['add-category-success'])) : ?>
                <div class="alert-message success container margin-top">
                    <p>
                        <?= $_SESSION['add-category-success'];
                        unset($_SESSION['add-category-success']); ?>
                    </p>
                </div>
                <!-- Update Category Was Successfully  -->
                <?php elseif(isset($_SESSION['edit-category-success'])) : ?>
                <div class="alert-message success container margin-top">
                    <p>
                        <?= $_SESSION['edit-category-success'];
                        unset($_SESSION['edit-category-success']); ?>
                    </p>
                </div> 
                <!-- Update Category Was not Successfully an erorr message  -->
                <?php elseif(isset($_SESSION['edit-category'])) : ?>
                <div class="alert-message erorr container margin-top">
                    <p>
                        <?= $_SESSION['edit-category'];
                        unset($_SESSION['edit-category']); ?>
                    </p>
                </div>
                <!-- Delete Category Was  Successfully   -->
                <?php elseif(isset($_SESSION['delete-category-success'])) : ?>
                <div class="alert-message success container margin-top">
                    <p>
                        <?= $_SESSION['delete-category-success'];
                        unset($_SESSION['delete-category-success']); ?>
                    </p>
                </div>
            <?php endif ?> 
        <div class="container dashboard-container">
            <button class="sidebar-toggle" id="show-sidebar-btn"><i class="fa-solid fa-angles-right"></i></button>
            <button class="sidebar-toggle" id="hide-sidebar-btn"><i class="fa-solid fa-angles-left"></i></button>
            <aside>
                <ul>
                    <li><a href="add-post.php"><i class="fa fa-pencil"></i><h5>Add Post</h5></a></li>
                    <li><a href="index.php"><i class="fa-solid fa-address-card"></i><h5>Manage Post</h5></a></li>
                    
                    <?php if(isset($_SESSION['user_is_admin'])) :?>
                    <li><a href="add-user.php"><i class="fa-solid fa-user-plus"></i><h5>Add User</h5></a></li>
                    <li><a href="mange-users.php"><i class="fa fa-user-gear"></i><h5>Manage User</h5></a></li>
                    <li><a href="add-category.php"><i class="fa-solid fa-pen-to-square"></i><h5>Add Category</h5></a></li>
                    <li><a href="mange-categories.php" class="active"><i class="fa-solid fa-list-check"></i><h5>Manage Category</h5></a></li>
                    <?php endif ?>
                </ul>
            </aside>
            <main>
                <h2>Manage Category</h2>
                <?php if(mysqli_num_rows($categories) > 0 ) : ?>
                <table>
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php while($category = mysqli_fetch_assoc($categories)) : ?>
                        <tr>
                            <td><?= "{$category['title']}" ?> </td>
                            <td><a href="<?= ROOT_URL ?>admin/edit-category.php?id=<?= $category['id']?>" class="btn sm">Edit</a></td>
                            <td><a href="<?= ROOT_URL ?>admin/delete-category.php?id=<?= $category['id']?>" class="btn sm danger">Delete</a></td>
                        </tr>
                        <?php endwhile ?>
                    </tbody>
                </table>
                <?php else : ?>
                    <div class="alert-message erorr">
                        <?= "No Categories Found" ?>
                        <?php endif ?>
                    </div>
            </main>
        </div>
        <?php else : ?>
                    <?php
                        header('location: '. ROOT_URL);
                        die();  
                    ?>
                        <?php endif ?>
    </section>
    <?php
        include '../partials/footer.php';
    ?>

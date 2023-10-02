<?php
    include 'partials/header.php';
    // Fetch current user's posts from database
    $current_user_id= $_SESSION['user-id'];
    $query = "SELECT id , title ,category_id FROM posts WHERE author_id=$current_user_id ORDER BY id DESC";
    $posts =mysqli_query($con , $query);
?>
    <section class="dashboard">
    <?php if(isset($_SESSION['add-post-success'])) : ?>
                <div class="alert-message success margin-top container">
                    <p>
                        <?= $_SESSION['add-post-success'];
                        unset($_SESSION['add-post-success']); ?>
                    </p>
                </div>
            <?php endif ?>
        <div class="container dashboard-container">
        <button class="sidebar-toggle" id="show-sidebar-btn"><i class="fa-solid fa-angles-right"></i></button>
        <button class="sidebar-toggle" id="hide-sidebar-btn"><i class="fa-solid fa-angles-left"></i></button>
            <aside>
                <ul>
                    <li><a href="add-post.php"><i class="fa fa-pencil"></i><h5>Add Post</h5></a></li>
                    <li><a href="index.php" class="active"><i class="fa-solid fa-address-card"></i><h5>Manage Post</h5></a></li>
                    <?php if(isset($_SESSION['user_is_admin'])) :?>
                    <li><a href="add-user.php"><i class="fa-solid fa-user-plus"></i><h5>Add User</h5></a></li>
                    <li><a href="mange-users.php"><i class="fa fa-user-gear"></i><h5>Manage User</h5></a></li>
                    <li><a href="add-category.php"><i class="fa-solid fa-pen-to-square"></i><h5>Add Category</h5></a></li>
                    <li><a href="mange-categories.php"><i class="fa-solid fa-list-check"></i><h5>Manage Category</h5></a></li>
                    <?php endif ?>
                </ul>
            </aside>
            <main>
                <h2>Manage Posts</h2>
                <!-- Show If Edit Post Was not Successfully   -->
                <?php if(isset($_SESSION['edit-post'])) : ?>
                <div class="alert-message erorr">
                    <p>
                        <?= $_SESSION['edit-post'];
                        unset($_SESSION['edit-post']); ?>
                    </p>
                </div>
                <!-- Show If Edit Post Was Successfully   -->
                <?php elseif(isset($_SESSION['edit-post-success'])) : ?>
                <div class="alert-message success">
                    <p>
                        <?= $_SESSION['edit-post-success'];
                        unset($_SESSION['edit-post-success']); ?>
                    </p>
                </div>
                <!-- Show If Delete Post Was not Successfully   -->
                <?php elseif(isset($_SESSION['delete-post'])) : ?>
                <div class="alert-message erorr">
                    <p>
                        <?= $_SESSION['delete-post'];
                        unset($_SESSION['delete-post']); ?>
                    </p>
                </div>
                <!-- Show If Delete Post Was Successfully   -->
                <?php elseif(isset($_SESSION['delete-post-success'])) : ?>
                <div class="alert-message success">
                    <p>
                        <?= $_SESSION['delete-post-success'];
                        unset($_SESSION['delete-post-success']); ?>
                    </p>
                </div>
            <?php endif ?>
                <?php if(mysqli_num_rows($posts) > 0 ) : ?>
                <table>
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php while($post = mysqli_fetch_assoc($posts)) : ?>
                        <?php
                        // <!-- Get Category title of each post from categories table  -->
                        $category_id = $post['category_id'];
                        $category_query = "SELECT title FROM categories WHERE id=$category_id";
                        $category_result =mysqli_query($con , $category_query);
                        $category = mysqli_fetch_assoc($category_result);
                        ?>
                        <tr>
                            <td><?= "{$post['title']}" ?>.</td>
                            <td><?= "{$category['title']}" ?></td>
                            <td><a href="<?= ROOT_URL ?>admin/edit-post.php?id=<?= $post['id']?>" class="btn sm">Edit</a></td>  
                            <td><a href="<?= ROOT_URL ?>admin/delete-post.php?id=<?= $post['id']?>" class="btn sm danger">Delete</a></td>  
                        </tr>
                        <?php endwhile ?>
                    </tbody>
                </table>
                <?php else : ?>
                    <div class="alert-message erorr">
                        <?= "No Posts Found" ?>
                        <?php endif ?>
                    </div>
            </main>
        </div>
    </section>
    <?php
        include '../partials/footer.php';
    ?>

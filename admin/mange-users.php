<?php
    include 'partials/header.php';
        // fetch users from database but not current user 
    $current_admin_id = $_SESSION['user-id'];
    $query = "SELECT * FROM users WHERE NOT id=$current_admin_id";
    $users =mysqli_query($con , $query);
    
    
?>

    <section class="dashboard">
    <?php if(isset($_SESSION['user_is_admin'])) :?>
                <!-- Show If Add User Wss Successful  -->
            <?php if(isset($_SESSION['add-user-success'])) : ?>
                <div class="alert-message success margin-top">
                    <p>
                        <?= $_SESSION['add-user-success'];
                        unset($_SESSION['add-user-success']); ?>
                    </p>
                </div> 
            <?php elseif(isset($_SESSION['delete-user'])) : ?>
        <!-- Show If Delete User Was Not Successful  -->
                <div class="alert-message erorr margin-top">
                    <p>
                        <?= $_SESSION['delete-user'];
                        unset($_SESSION['delete-user']); ?>
                    </p>
                </div>
            <?php elseif(isset($_SESSION['delete-user-success'])) : ?>
        <!-- Show If Delete User Was Successful  -->
                <div class="alert-message success margin-top">
                    <p>
                        <?= $_SESSION['delete-user-success'];
                        unset($_SESSION['delete-user-success']); ?>
                    </p>
                </div>
        <!-- Show If edit User Was Successful  -->
        <?php elseif(isset($_SESSION['edit-user-success'])) : ?>
                <div class="alert-message success container margin-top">
                    <p>
                        <?= $_SESSION['edit-user-success'];
                        unset($_SESSION['edit-user-success']); ?>
                    </p>
                </div>
            <?php elseif(isset($_SESSION['edit-user'])) : ?>
        <!-- Show If edit User Wss Successful  -->
                <div class="alert-message erorr margin-top">
                    <p>
                        <?= $_SESSION['edit-user'];
                        unset($_SESSION['edit-user']); ?>
                    </p>
                </div>
            <?php endif ?>
        <div class="container dashboard-container">
            <button class="sidebar-toggle" id="show-sidebar-btn"><i class="fa-solid fa-angles-right"></i></button>
            <button class="sidebar-toggle" id="hide-sidebar-btn"><i class="fa-solid fa-angles-left"></i></button>
            <aside>
                <ul>
                    <li>
                        <a href="add-post.php">
                            <i class="fa fa-pencil"></i>
                            <h5>Add Post</h5>
                        </a>
                    </li>
                    <li>
                        <a href="index.php">
                            <i class="fa-solid fa-address-card"></i>
                            <h5>Manage Post</h5>
                        </a>
                    </li>
                    
                    <?php if(isset($_SESSION['user_is_admin'])) :?>
                    <li>
                        <a href="add-user.php">
                            <i class="fa-solid fa-user-plus"></i>
                            <h5>Add User</h5>
                        </a>
                    </li>
                    <li>
                        <a href="mange-users.php" class="active">
                            <i class="fa fa-user-gear"></i>
                            <h5>Manage User</h5>
                        </a>
                    </li>
                    <li>
                        <a href="add-category.php">
                            <i class="fa-solid fa-pen-to-square"></i>
                            <h5>Add Category</h5>
                        </a>
                    </li>
                    <li>
                        <a href="mange-categories.php">
                            <i class="fa-solid fa-list-check"></i>
                            <h5>Manage Category</h5>
                        </a>
                    </li>
                    <?php endif ?>
                </ul>
            </aside>
            <main>
                <h2>Manage Users</h2>
                <?php if(mysqli_num_rows($users) > 0 ) : ?>
                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>User Name</th>
                            <th>Edit</th>
                            <th>Delete</th>
                            <th>Admin</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($user = mysqli_fetch_assoc($users)) : ?>
                            <tr>
                            <td><?= "{$user['firstname']} {$user['lastname']}" ?></td>
                            <td><?= "{$user['username']}" ?> </td>
                            <td><a href="<?= ROOT_URL ?>admin/edit-user.php?id=<?= $user['id']?>" class="btn sm">Edit</a></td>
                            <td><a href="<?= ROOT_URL ?>admin/delete-user.php?id=<?= $user['id']?>" class="btn sm danger">Delete</a></td>
                            <td><?=$user['is_admin'] ? 'Yes' : ' No' ?></td>
                        </tr>
                        <?php endwhile ?>
                    </tbody>
                </table>
                <?php endif ?>
                <?php else : ?>
                    <?php
                        header('location: '. ROOT_URL);
                        die();  
                    ?>
                        <?php endif ?>
            </main>
        </div>
    </section>
    <?php
        include '../partials/footer.php';
    ?>

<?php
    include 'partials/header.php';
    // Get Back Form Data If There Was An Erorr 
    $firstname = $_SESSION['add-user-data']['firstname'] ?? null ;
    $lastname = $_SESSION['add-user-data']['lastname'] ?? null ;
    $username = $_SESSION['add-user-data']['username'] ?? null ;
    $email = $_SESSION['add-user-data']['email'] ?? null ;
    $createpassword = $_SESSION['add-user-data']['createpassword'] ?? null ;
    $confirmpassword = $_SESSION['add-user-data']['confirmpassword'] ?? null ;
    // Deleta Session Data 
    unset($_SESSION['add-user-data']);
?>

    <section class="form-section ">
        <div class="container form-section-container">
            <h2> Add User</h2>
            <?php if(isset($_SESSION['add-user'])) : ?>
                <div class="alert-message erorr">
                    <p>
                        <?= $_SESSION['add-user'];
                        unset($_SESSION['add-user']); ?>
                    </p>
                </div>
            <?php endif ?>
<?php if(isset($_SESSION['user_is_admin'])) :?>
        <form action="<?= ROOT_URL ?>admin/add-user-logic.php" enctype="multipart/form-data" method="POST">
            <input type="text" placeholder="First Name" value="<?=$firstname?>" name="firstname">
            <input type="text" placeholder="Last Name" value="<?=$lastname?>" name="lastname">
            <input type="text" placeholder="User Name" value="<?=$username?>" name="username">
            <input type="email" placeholder=" Email" value="<?=$email?>" name="email">
            <input type="password" placeholder="Create Password" value="<?=$createpassword?>" name="createpassword">
            <input type="password" placeholder="Confirm Password" value="<?=$confirmpassword?>" name="confirmpassword">
            <select name="userrole">
                <option value="0">Author</option>
                <option value="1">Admin</option>
            </select>
            <div class="form-control">
                <label for="avatar">Add Avatar</label>
                <input type="file" name="avatar" id="avatar">
            </div>
            <button type="submit" name="submit" class="btn">Add User</button>
        </form>
        <?php else : ?>
                    <?php
                        header('location: '. ROOT_URL);
                        die();  
                    ?>
                        <?php endif ?>
    </div>
    </section>
    <!-- Footer -->
<?php
    include '../partials/footer.php';
?>

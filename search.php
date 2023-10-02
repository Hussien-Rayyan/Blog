<?php
    include 'partials/header.php';
    if(isset($_GET['search']) && isset($_GET['submit'])) {
        $search = filter_var($_GET['search'] , FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $query = "SELECT * FROM posts WHERE title LIKE'%$search%' ORDER BY date_time DESC";
        $posts = mysqli_query($con ,$query);
    } else {
        header('location: ' . ROOT_URL . 'blog.php');
        die();
    }
?>
<?php if(mysqli_num_rows($posts) > 0) : ?>
<div class="posts section-extra-margin ">
        <div class="container posts-container">
            <?php while ($post = mysqli_fetch_assoc($posts)) :?>
            <article class="post">
                <div class="post-thumbnail">
                    <img src="./images/<?= $post['thumbnail'] ?>" alt="post thumbnail">
                </div>
                <div class="post-info">
                <?php
                    // Fetch category From Categories Table Using Category id of post
                    $category_id = $post['category_id'];
                    $category_query = "SELECT * FROM categories WHERE id=$category_id";
                    $category_result =mysqli_query($con , $category_query);
                    $category =mysqli_fetch_assoc($category_result);
                    $category_title =$category['title'];
                ?>
                    <a href="<?= ROOT_URL?>category-post.php?id=<?= $post['category_id']?>" class="category-btn"><?= $category['title'] ?></a>
                    <h2 class="post-title"><a href="<?= ROOT_URL?>posts.php?id=<?= $post['id']?>"><?= $post['title'] ?></a></h2>
                    <p class="post-body"><?= substr($post['body'] ,0 ,150) ?> ...</p>
                    <div class="post-author">
                    <?php
                        // Fetch author From users Table Using author id of post
                    $author_id = $post['author_id'];
                    $author_query = "SELECT * FROM users WHERE id=$author_id";
                    $author_result =mysqli_query($con , $author_query);
                    $author =mysqli_fetch_assoc($author_result);
                    ?>
                        <div class="post-author-avatar">
                            <img src="./images/<?= $author['avatar'] ?>">
                        </div>
                        <div class="post-author-info">
                            <h5>  By : <?= "{$author['firstname']} {$author['lastname']}" ?></h5>
                            <small> <?= date("M d, Y - H:i" , strtotime($post['date_time'])) ?></small>
                        </div>
                    </div>
                </div>
            </article>
            <?php endwhile ?>
        </div>
    </div>
    <?php else : ?>
        <div class="alert-message erorr lg"><p>No Posts Found</p></div>
    <?php endif ?>
    <section class="category-buttons">
        <div class="container category-buttons-container">
            <?php
        // Fetch category From Categories Table Using Category id of post
                    $all_categories_query = "SELECT * FROM categories";
                    $all_categories =mysqli_query($con , $all_categories_query);
                ?>
                        <?php while ($category = mysqli_fetch_assoc($all_categories)) :?>
                            <a href="<?= ROOT_URL ?>category-post.php?id=<?= $category['id']?>" class="category-btn"><?= $category['title']?></a>
                        <?php endwhile ?>
        </div>
    </section>
    <?php
        include 'partials/footer.php';
    ?>
<?php
    include 'partials/header.php';
    // Fetch Post From Database if id is set 
    if(isset($_GET['id'])) {
        $id = filter_var($_GET['id'] ,FILTER_SANITIZE_NUMBER_INT);
        $query = "SELECT * FROM posts WHERE id=$id";
        $result =mysqli_query($con , $query);
        $post = mysqli_fetch_assoc($result);
    } else {
        header('location: ' . ROOT_URL . 'blog.php');
    }
?>
    <!-- Singlepost -->
    <section class="singlepost">
        <div class="singlepost-container container">
            <h2><?=$post['title'] ?></h2>
            <?php
            // Fetch author From users Table Using author id of post
                    $author_id = $post['author_id'];
                    $author_query = "SELECT * FROM users WHERE id=$author_id";
                    $author_result =mysqli_query($con , $author_query);
                    $author =mysqli_fetch_assoc($author_result);
                    ?>
                    <div class="post-author">
                        <div class="post-author-avatar">
                            <img src="./images/<?= $author['avatar'] ?>">
                        </div>
                <div class="post-author-info">
                    <h5>  By : <?= "{$author['firstname']} {$author['lastname']}" ?></h5>
                    <small> <?= date("M d, Y - H:i" , strtotime($post['date_time'])) ?></small>
                </div>
            </div>
            <div class="singlepost-thumbnail">
                <img src="./images/<?= $post['thumbnail']?>" alt="Post Thumbnail">
            </div>
            <p><?= $post['body'] ?></p>
        </div>
    </section>
    <!-- Start Footer  -->
    <?php
        include 'partials/footer.php';
    ?>




    <!-- Start Footer  -->
    <footer>
        <div class="footer-socials">
            <a href="https://youtube.com/@ELMokhtas-Hussien" target="_blank" class="fab fa-youtube fa-2x"></a>
            <a href="" target="_blank"  class="fab fa-facebook fa-2x"></a>
            <a href="" target="_blank" class="fab fa-instagram fa-2x"></a>
            <a href="" target="_blank" class="fab fa-twitter fa-2x"></a>
            <a href="" target="_blank" class="fab fa-linkedin fa-2x"></a>
        </div>
        <div class="container footer-container">
            <article>
                <h4>Category</h4>
                <ul>
                    <li><a href="#">Business</a></li>
                    <li><a href="#">Since & Technology</a></li>
                    <li><a href="#">Economics</a></li>
                    <li><a href="#">Front End</a></li>
                    <li><a href="#">back End</a></li>
                </ul>
            </article>
            <article>
                <h4>Support</h4>
                <ul>
                    <li><a href="#">Online Support</a></li>
                    <li><a href="#">Phone Support</a></li>
                    <li><a href="#">Social Support</a></li>
                    <li><a href="#">Gmail Support</a></li>
                    <li><a href="#">back End</a></li>
                </ul>
            </article>
            <article>
                <h4>Category</h4>
                <ul>
                <?php
                    $all_categories_query = "SELECT * FROM categories";
                    $all_categories =mysqli_query($con , $all_categories_query);
                ?>
                        <?php while ($category = mysqli_fetch_assoc($all_categories)) :?>
                            <li><a href="<?= ROOT_URL ?>category-post.php?id=<?= $category['id']?>"><?= $category['title']?></a></li>
                        <?php endwhile ?>
                </ul>
            </article>
            <article>
                <h4>PeramLinks</h4>
                <ul>
                    <li><a href="blog.php">Blog</a></li>
                    <li><a href="posts.php">Post</a></li>
                    <li><a href="contact.php">Contact Us</a></li>
                    <li><a href="about.php">About</a></li>
                    <li><a href="services.php"> Services</a></li>
                </ul>
            </article>
        </div>
        <div class="footer-copyright">
            <small> Copyright &copy; <a href="#">El Mokhtas</a> 2023</small>
        </div>
    </footer>
    <!-- Javascript Files  -->
    <script src="<?= ROOT_URL ?>js/main.js"></script>
</body>
</html>
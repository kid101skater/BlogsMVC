<div class="side_nav">
    <center>
        <h2>Blog Site</h3>
    </center>
    <img src="images/trumpet.png" class="img-responsive" alt="blogs nav logo">
    <ul class="list-unstyled side_nav_ul">
        <li><bold><a href="index.php">Home ></a></bold></li>
        <?php if ($loggedIn == 'true'): ?>
            
                <li><bold><a href="#">My Blogs ></a></bold></li>
                <li><bold><a href="#">Create Blog ></a></bold></li>
                <li><bold><a href="#">About Us ></a></bold></li>
                <li><bold><a href="#">Log Out ></a></bold></li>
            
            <?php else: ?>
                <li><bold><a href="#">Become A Blogger ></a></bold></li>
                <li><bold><a href="#">About Us ></a></bold></li>
                <li><bold><a href="#">Log In ></a></bold></li>
            
        <?php endif; ?>
    </ul>
</div>
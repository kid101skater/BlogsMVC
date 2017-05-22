<center>
    <h2>Blog Site</h3>
</center>

<img src="<?= $BASE ?>/images/trumpet.png" class="img-responsive" alt="blogs nav logo">
<ul class="list-unstyled side_nav_ul">
    <li><bold><a href="<?= $BASE ?>/">Home ></a></bold></li>
    <?php if ($loggedIn === null): ?>
        
            <li><bold><a href="<?= $BASE ?>/Register">Become A Blogger ></a></bold></li>
            <li><bold><a href="<?= $BASE ?>/About">About Us ></a></bold></li>
            <li><bold><a href="<?= $BASE ?>/Login">Log In ></a></bold></li>
        
        <?php else: ?>
            <li><bold><a href="<?= $BASE ?>/MyBlogs">My Blogs ></a></bold></li>
            <li><bold><a href="<?= $BASE ?>/CreateBlog">Create Blog ></a></bold></li>
            <li><bold><a href="<?= $BASE ?>/About">About Us ></a></bold></li>
            <li><bold><a href="<?= $BASE ?>/Logout">Log Out ></a></bold></li>
        
    <?php endif; ?>
</ul>
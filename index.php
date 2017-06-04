<?php
require("../../../other/blogs_config.php");

    try
    {
        // get the db obj
        $dbh = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
    }
    catch(PDOException $e)
    {
        echo $e->getMessage();
    }
    //Require the autoload file
    error_reporting('E_ALL');
    require_once('vendor/autoload.php');
    session_start();
    
    //Create an instance of the Base class
    $f3 = Base::instance();
    
    //Default route
    $f3->route('GET|POST /', function($f3) {
        
        $db = new Database();
        $users = $db->getUsersWithPosts();
        $users_noposts = $db->getUsersWithoutPosts();
        $f3->set('PageTitle', "Blogs");
        $f3->set('loggedIn', $_SESSION['username']);
        
        $f3->set('users', $users);
        $f3->set('noPostUsers', $users_noposts);
        
        $f3->set('sidenav','pages/SideNav.html'); // give side nav data
        
        echo Template::instance()->render('pages/home.html');
        
    });
    
    $f3->route('GET /About', function($f3)
    {
        $f3->set('PageTitle', 'About Us');
        $f3->set('loggedIn', $_SESSION['username']);
        $f3->set('sidenav','pages/SideNav.html'); // give side nav data
        
        echo Template::instance()->render('pages/aboutus.html');
    });
    
    $f3->route('GET|POST /Login', function($f3)
    {
        $db = new Database();
        if (isset($_POST['user']) and isset($_POST['pword']))
        {
            $result = $db->Authenticate($_POST['user'], $_POST['pword']);
            if($result == 1)
            {
                $_SESSION['username'] = $_POST['user'];
            }
        
        }
        $f3->set('PageTitle', 'Login');
        $f3->set('loggedIn', $_SESSION['username']);
        $f3->set('sidenav','pages/SideNav.html'); // give side nav data
        
        echo Template::instance()->render('pages/login.html');
    });
    
    $f3->route('GET /Logout', function($f3)
              {
                session_destroy();
                $f3->reroute('/');
              });
    
    $f3->route('GET|POST /CreateBlog', function($f3)
               {
                if($_SESSION['username'] == null)
                {
                    $f3->reroute('/Login');
                }
                $db = new Database();
                $user = $db->getUserFromUserName($_SESSION['username']);
                if(isset($_POST['title']) and isset($_POST['entry']))
                {
                    if($_POST['title'] !== '' && $_POST['title'] !== null && $_POST['entry'] !== '' && $_POST['entry'] !== null)
                    {
                        if($_POST['postID'] === null || $_POST['postID'] === "")
                        {
                            $db->CreatePost($_POST['title'], $_POST['entry'], $user->getUserID());
                        }
                        else
                        {
                            $db->UpdatePost($_POST['postID'], $_POST['title'], $_POST['entry']);
                        }
                        $f3->reroute('/MyBlogs');
                    }
                }
                $title = $_POST['title'];
                $entry = $_POST['entry'];
                if($_SESSION['PostID'] !== null)
                {
                    $post = $db->getBlogPostFromID($_SESSION['PostID']);
                    $title = $post->getPostTitle();
                    $entry = $post->getPostData();
                    $postID = $_SESSION['PostID'];
                    $_SESSION['PostID'] = null;
                }
                
                $f3->set('PageTitle', 'New Post');
                $f3->set('loggedIn', $_SESSION['username']);
                $f3->set('title', $title);
                $f3->set('entry', $entry);
                $f3->set('postID', $postID);
                $f3->set('sidenav','pages/SideNav.html'); // give side nav data
                
                echo Template::instance()->render('pages/createblog.html');
               });
    
    $f3->route('GET /MyBlogs', function($f3)
               {
                $db = new Database();
                $user = $db->getUserFromUserName($_SESSION['username']);
                $BlogPosts = $db->getUsersBlogPosts($user->getUserID());
                $f3->set('PageTitle', 'My Blogs');
                $f3->set('loggedIn', $_SESSION['username']);
                $f3->set('Posts', $BlogPosts);
                $f3->set('sidenav','pages/SideNav.html'); // give side nav data
                
                echo Template::instance()->render('pages/myblogs.html');
               });
    
    $f3->route('GET /Delete/@blogID', function($f3, $params)
               {
                $blogID = $params['blogID'];
                $db = new Database();
                $user = $db->getUserFromUserName($_SESSION['username']);
                $db->DeletePost($blogID, $user->getUserID());
                $f3->reroute('../MyBlogs');
               });
    
    $f3->route('GET /Update/@postID', function($f3, $params)
               {
                $postID= $params['postID'];
                $db = new Database();
                $_SESSION['PostID'] = $postID;
                $f3->reroute('../CreateBlog');
               });
    
    $f3->route('GET|POST|PUT /Register', function($f3)
    {
        $db = new Database();
        if(isset($_POST['user']) and isset($_POST['email']) and isset($_POST['pword']) and isset($_POST['verify']))
        {
            if($_POST['pword'] === $_POST['verify'] && $_POST['pword'] !== null && $_POST['pword'] !== '')
            {
                if(isset($_FILES["fileToUpload"]))
                       {
                    $pic = $_FILES["fileToUpload"]["name"];
                    $target_dir = "profilephotos/";
                    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
                     if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {

                     }
                       }
                       else
                       {
                        $pic = "profile_default.png";
                       }
                $db->RegisterUser($_POST['user'], $_POST['pword'], $_POST['email'], $_POST['bio'], $pic);
                $_SESSION['username'] = $_POST['user'];
                $f3->reroute('/');
            }
        }
        $f3->set('PageTitle', 'Become a blogger');
        $f3->set('Username', $_POST['user']);
        $f3->set('Email', $_POST['email']);
        $f3->set('Password', $_POST['pword']);
        $f3->set('Verify', $_POST['verify']);
        $f3->set('Pic', $_POST['fileToUpload']);
        $f3->set('Bio', $_POST['bio']);
        $f3->set('loggedIn', $_SESSION['username']);
        $f3->set('sidenav','pages/SideNav.html'); // give side nav data
        
        echo Template::instance()->render('pages/register.html');
    });
    
    $f3->route('GET /@username', function($f3,$params)
    {
        $user_name = $params['username'];
        $db = new Database();
        $user = $db->getUserFromUserName($user_name);
        $BlogPosts = $db->getUsersBlogPosts($user->getUserID());
        if($BlogPosts == null || $BlogPosts[0] == null)
        {
            $f3->set('hasPosts', 'false');
        }
        else
        {
            $f3->set('hasPosts', 'true');
        }
        $f3->set('PageTitle', $user_name . ' Blog');
        $f3->set('loggedIn', $_SESSION['username']);
        $f3->set('_user', $user);
        $f3->set('posts', $BlogPosts);
        $f3->set('sidenav','pages/SideNav.html'); // give side nav data
        
        echo Template::instance()->render('pages/blog.html');
    });

    $f3->route('GET /Post/@postID', function($f3,$params)
    {
        $postID = $params['postID'];
        $db = new Database();
        $BlogPosts = $db->getBlogPostFromID($postID);
        $User = $db->getUserFromBlogPost($postID);
        $f3->set('PageTitle', $BlogPosts->getPostTitle());
        $f3->set('post', $BlogPosts);
        $f3->set('user', $User);
        $f3->set('loggedIn', $_SESSION['username']);
        $f3->set('sidenav','pages/SideNav.html'); // give side nav data
        
        echo Template::instance()->render('pages/post.html');
    });
    //Run fat free
    $f3->run();
    
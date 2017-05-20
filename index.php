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
    $f3->route('GET /', function($f3) {
    try
    {
        // get the db obj
        $dbh = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
    }
    catch(PDOException $e)
    {
        echo $e->getMessage();
    }
    $sql = "SELECT Users.UserID, Users.Username, Users.Bio, Users.ProfilePic,MAX(Posts.PostID), Posts.Title, Posts.Excerpt, Posts.PostDate FROM Users, Posts NATURAL JOIN User_Posts_JT WHERE User_Posts_JT.jt_UserID = Users.UserID AND User_Posts_JT.jt_PostID = Posts.PostID GROUP BY Users.UserID";

    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll();

    $users[] = new HomePageUser(null, null, null, null, null, null, null, null);
    $counter = 0;
    foreach($result as $row)
    {
        //$UserID, $UserName, $Bio, $ProfilePic, $PostID, $PostTitle, $PostData, $PostDate
        $users[$counter] = new HomePageUser($row['UserID'], $row['Username'], $row['Bio'], $row['ProfilePic'], $row['PostID'], $row['Title'], $row['Excerpt'], $row['PostDate']);
        //print_r($row);
        $counter = $counter + 1;
    }
        
        $f3->set('PageTitle', "Blogs");
        $f3->set('loggedIn', 'false');
        
        $f3->set('users', $users);
        
        $f3->set('sidenav','pages/SideNav.html'); // give side nav data
        /* Set the homepage information
         *  Each blogger has a portrait image, name, a link to their blogs page,
         *  a count of their blog posts,
         *  and an excerpt to their most recent blog (if there is any).
        */
        
        echo Template::instance()->render('pages/home.html');
        
    });
    
    $f3->route('GET /About', function($f3)
    {
        $f3->set('PageTitle', 'About Us');
        $f3->set('loggedIn', 'false');
        $f3->set('sidenav','pages/SideNav.html'); // give side nav data
        
        echo Template::instance()->render('pages/aboutus.html');
    });
    
    $f3->route('GET /@username', function($f3,$params)
    {
        $user_name = $params['username'];
        $db = new Database();
        //$user = $db->getSingleUserProfile(1);
        //$user = new User(null, null, null, null);
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
        $f3->set('loggedIn', 'false');
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
        $f3->set('loggedIn', 'false');
        $f3->set('sidenav','pages/SideNav.html'); // give side nav data
        
        echo Template::instance()->render('pages/post.html');
    });
    //Run fat free
    $f3->run();
    
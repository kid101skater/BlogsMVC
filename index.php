<?php
require("../../../other/config.php");

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
        $f3->set('loggedIn', 'false');
        
        $f3->set('sidenav','pages/SideNav.html'); // give side nav data
        /* Set the homepage information
         *  Each blogger has a portrait image, name, a link to their blogs page,
         *  a count of their blog posts,
         *  and an excerpt to their most recent blog (if there is any).
        */
        
        echo Template::instance()->render('pages/home.html');
        
    });

    //Run fat free
    $f3->run();
    
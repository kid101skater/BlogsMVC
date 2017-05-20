<?php
    //Require the autoload file
    error_reporting('E_ALL');
    require_once('vendor/autoload.php');
    session_start();
    
    //Create an instance of the Base class
    $f3 = Base::instance();
    
    //Default route
    $f3->route('GET /', function($f3) {
        
        /* Set the homepage information
         *  Each blogger has a portrait image, name, a link to their blogs page,
         *  a count of their blog posts,
         *  and an excerpt to their most recent blog (if there is any).
        */
        
        echo Template::instance()->render('pages/home.html');
        
    });

    //Run fat free
    $f3->run();
    
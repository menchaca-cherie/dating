
<?php

//Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

//Start session
//session_start();

//Require the autoload File
require_once ('vendor/autoload.php');

//Create an instance of the base class
$f3 = Base::instance();
//echo gettype($f3); example of what type is $f3

//Define a default route /
$f3->route('GET /', function(){

    $view = new Template();
    echo $view->render('views/home.html');
});
//Define a route for Personal Information
$f3->route('GET /personal', function(){
    //echo "Personal Information";

    $view = new Template();
    echo $view->render('views/personal.html');
});
//Define a route for Profile
$f3->route('POST /profile', function(){


    $view = new Template();
    echo $view->render('views/profile.html');
});
$f3->route('POST /interest', function(){
    //echo "Profile";

    $view = new Template();
    echo $view->render('views/interest.html');
});


//Run fat free
$f3->run();
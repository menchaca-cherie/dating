<?php

//Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

//Require the autoload File
require_once('vendor/autoload.php');

//Start session
session_start();


//Create an instance of the base class
$f3 = Base::instance();
//echo gettype($f3); example of what type is $f3

//creat an instance of the base class
$cons = new Controllers($f3);


//Define a default route /
$f3->route('GET /', function () {

    $GLOBALS['cons']->home();
});
//Define a route for Personal Information
$f3->route('GET|POST /personal', function ($f3) {
    //echo "Personal Information";
    $GLOBALS['cons']->personal();
});
//Define a route for Profile
$f3->route('GET|POST /profile', function ($f3) {
    $GLOBALS['cons']->profile();
});
$f3->route('GET|POST /interest', function ($f3) {
    //echo "Profile";

    $GLOBALS['cons']->interest();

});
$f3->route('GET|POST /summary', function () {

    $GLOBALS['cons']->summary();

});

//Run fat free
$f3->run();
<?php

//Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);
//Start session
session_start();

//Require the autoload File
require_once ('vendor/autoload.php');
require_once ('model/data-layer.php');
require_once ('model/validation.php');
//Create an instance of the base class
$f3 = Base::instance();
//echo gettype($f3); example of what type is $f3

//Define a default route /
$f3->route('GET /', function(){

    $view = new Template();
    echo $view->render('views/home.html');
});
//Define a route for Personal Information
$f3->route('GET|POST /personal', function($f3){
    //echo "Personal Information";
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        var_dump($_POST);

        //Get the data
        $first = $_POST['first'];
        $last = $_POST['last'];
        $age = $_POST['age'];
        $phone = $_POST['phone'];
        $gender = $_POST['gender'];
        $f3->set('firstName', $first);
        $f3->set('lastName', $last);
        $f3->set('age', $age);
        $f3->set('phone', $phone);
        $f3->set('userGender', $gender);
        //if data is valid in first
//    if(validName($name))
//    {
//        $_SESSION['name'] = $_POST['name'];
//    }
//    else
//    {
//        $f3->set('errors["name"]', 'Please enter your name with alphabets');
//    }
    }
    //Add genders data to hive
    $f3->set('genders', getGender());
    $view = new Template();
    echo $view->render('views/personal.html');
});
//Define a route for Profile
$f3->route('GET|POST /profile', function($f3){
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        var_dump($_POST);
        //Get the data
        $email = $_POST['email'];
        $state = $_POST['state'];
        $seeking = $_POST['seeking'];
        $bio = $_POST['bio'];
        $f3->set('userState', $state);
        $f3->set('email', $email);
        $f3->set('userSeeking', $seeking);
        $f3->set('bio', $bio);
    }

    //Add states data to hive
    $f3->set('states', getState());
    $f3->set('seekings', getSeeking());

    $view = new Template();
    echo $view->render('views/profile.html');
});
$f3->route('GET|POST /interest', function($f3){
    //echo "Profile";
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        var_dump($_POST);
        //Get the data
        $indoor = $_POST['indoor'];
        $outdoor = $_POST['outdoor'];
        $f3->set('interestIndoor', $indoor);
        $f3->set('interestOutdoor', $outdoor);

    }
    //Add states data to hive
    $f3->set('indoor', getIndoorInterest());
    $f3->set('outdoor', getOutdoorInterest());


    $view = new Template();
    echo $view->render('views/interest.html');
});
$f3->route('GET|POST /summary', function(){

    if(empty($_POST['interest']))
    {
        $interest = "";
    }
    else{
        $interest = implode(", ", $_POST['interest']);
    }
    $_SESSION['interest'] = $interest;
    $view = new Template();
    echo $view->render('views/summary.html');
});

//Run fat free
$f3->run();
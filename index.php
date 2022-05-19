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


        //Get the data
        $first = $_POST['first'];
        $last = $_POST['last'];
        $age = $_POST['age'];
        $phone = $_POST['phone'];

        $f3->set('firstName', $first);
        $f3->set('lastName', $last);
        $f3->set('age', $age);
        $f3->set('phone', $phone);

        $gender = "";
        if(isset($_POST['gender'])){
            $gender = $_POST['gender'];
        }
    }
        //if data is valid in first
    if(validName($first))
    {
        $_SESSION['first'] = $first;
    }
    else
    {
        $f3->set('errors["first"]', 'Please enter your first name with letters.');
    }
    if(validName($last))
    {
        $_SESSION['last'] = $last;
    }
    else
    {
        $f3->set('errors["last"]', 'Please enter your last name with letters.');
    }
    if(validAge($age))
    {
        $_SESSION['first'] = $age;
    }
    else
    {
        $f3->set('errors["age"]', 'Please enter your age.');
    }
    if(validPhone($phone))
    {
        $_SESSION['phone'] = $phone;
    }
    else
    {
        $f3->set('errors["phone"]', 'Please enter your telephone number.');
    }
    if(validGender($gender))
    {
        $_SESSION['gender'] = $gender;
    }
    else
    {
        $f3->set('errors["gender"]', 'Gender selection is invalid');
    }

    //Redirect to order2 route if there are no errors
    if(empty($f3->get('errors'))) {
        header('location: profile');
    }



    //Add genders data to hive
    $f3->set('genders', getGender());
    $view = new Template();
    echo $view->render('views/personal.html');
});
//Define a route for Profile
$f3->route('GET|POST /profile', function($f3){
    if($_SERVER['REQUEST_METHOD'] == 'POST') {

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

        //Get the data
        $indoor = $_POST['indoor'];
        $outdoor = $_POST['outdoor'];
        $f3->set('interestIndoor', $indoor);
        $f3->set('interestOutdoor', $outdoor);

    }
    //Add interest data to hive
    $f3->set('indoorInterest', getIndoorInterest());
    $f3->set('outdoorInterest', getOutdoorInterest());


    $view = new Template();
    echo $view->render('views/interest.html');
});
$f3->route('GET|POST /summary', function(){

    if(empty($_POST['indoorActs'])) {
        $indoorInts = "no indoor interest selected";
    }
    else {
        $indoorInts = implode(", ", $_POST['indoorInts']);
    }
    $_SESSION['indoorInts'] = $indoorInts;


    if(empty($_POST['outdoorInts'])) {
        $indoorActs = "no outdoor interest selected";
    }
    else {
        $outdoorInts = implode(", ", $_POST['outdoorInts']);
    }
    $_SESSION['outdoorInts'] = $outdoorInts;

    $view = new Template();
    echo $view->render('views/summary.html');
});

//Run fat free
$f3->run();
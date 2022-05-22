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
        //first
        $first = $_POST['first'];
        $f3->set('firstName', $first);

        //require
        $first = isset($_POST['first']) ? $_POST['first'] : "";
        //If data is first name is valid
        //if data is valid
        if(validName($first))
        {
            $_SESSION['first'] = $first;
        }
        else
        {
            $f3->set('errors["first"]', 'Please enter your first name with letters.');
        }

        //last
        $last = $_POST['last'];
        $f3->set('lastName', $last);
        $last = isset($_POST['last']) ? $_POST['last'] : "";
        if(validName($last))
        {
            $_SESSION['last'] = $last;
        }
        else
        {
            $f3->set('errors["last"]', 'Please enter your last name with letters.');
        }

        //age
        $age = $_POST['age'];
        $f3->set('age', $age);
        $age = isset($_POST['age']) ? $_POST['age'] : "";
        if(validAge($age))
        {
            $_SESSION['age'] = $age;
        }
        else
        {
            $f3->set('errors["age"]', 'Please enter your age.');
        }

        //phone
        $phone = $_POST['phone'];
        $f3->set('phone', $phone);
        $phone = isset($_POST['phone']) ? $_POST['phone'] : "";
        if(validPhone($phone))
        {
            $_SESSION['phone'] = $phone;
        }
        else
        {
            $f3->set('errors["phone"]', 'Please enter your telephone number.');
        }

        //gender
        $gender = $_POST['gender'];
        $f3->set('gender', $gender);
        $gender = isset($_POST['gender']) ? $_POST['gender'] : "";
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
        $f3->set('email', $email);
        $email = isset($_POST['email']) ? $_POST['email'] : "";
        if(validEmail($email))
        {
            $_SESSION['email'] = $email;
        }
        else
        {
            $f3->set('errors["email"]', 'Please enter a valid email.');
        }
        //Redirect to order2 route if there are no errors
        if(empty($f3->get('errors'))) {
            header('location: interest');
        }


        $state = $_POST['state'];
        $f3->set('userState', $state);
        $_SESSION['state'] = $state;

        $seeking = $_POST['seeking'];
        $f3->set('userSeeking', $seeking);
        $_SESSION['seeking'] = $seeking;

        $bio = $_POST['bio'];
        $f3->set('bio', $bio);
        $_SESSION['bio'] = $bio;
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

        $indoorInts = $_POST['indoorInts'];
        $f3->set('indoorInts', $indoorInts);
        $indoorInts = isset($_POST['indoorInt']) ? $_POST['indoorInt'] : "";

        //$indoorInts = "";
        if(isset($indoorInts)){
            if(validIndoor($indoorInts)){
                if (empty($_POST['indoorInts'])) {
                   $_SESSION['indoorInts'] = 'None selected from indoor interest.';
                }
                else {
                    $_SESSION['indoorInts'] = $indoorInts;
                }
            }
        }else{
            $f3->set('errors["indoorInts"]', 'No, spoofing please.');
        }


            header('location: interest');




//        $outdoorInt = $_POST['outdoorInt'];
//        $f3->set('outdoorInt', $outdoorInt);
//        $outdoorInts = isset($_POST['outdoorInts']) ? $_POST['outdoorInts'] : "";
//
//        if(validOutdoor($outdoorInts))
//        {
//        $_SESSION['outdoorInts'] = $outdoorInts;
//        }
//        else
//        {
//            $f3->set('errors["outdoorInts"]', 'Please select any outdoor interest.');
//        }
//
//        header('location: summary');




    }
    //Add interest data to hive
    $f3->set('indoorInterest', getIndoorInterest());
    $f3->set('outdoorInterest', getOutdoorInterest());


    $view = new Template();
    echo $view->render('views/interest.html');
});
$f3->route('GET|POST /summary', function(){


    $view = new Template();
    echo $view->render('views/summary.html');
});

//Run fat free
$f3->run();
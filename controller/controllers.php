<?php

class Controllers
{
    private $_f3;
    function __construct($f3)
    {
        $this->_f3 = $f3;
    }
    function home()
    {
        $view = new Template();
        echo $view->render('views/home.html');
    }
    function personal()
    {
        var_dump($_POST);
        //Add genders data to hive
        $this->_f3->set('genders', DataLayer::getGenders());

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {


            //Get the data
            //first
            $first = $_POST['first'];
            $this->_f3->set('firstName', $first);

            //last
            $last = $_POST['last'];
            $this->_f3->set('lastName', $last);

            //age
            $age = $_POST['age'];
            $this->_f3->set('age', $age);

            //phone
            $phone = $_POST['phone'];
            $this->_f3->set('phone', $phone);

            $gender = "";
            if(isset($_POST['gender'])){
                $gender = $_POST['gender'];
            }

            //$premium = isset($_POST['premium']) ? $_POST['premium'] : "";

            //require

            //If data is first name is valid
            //if data is valid
            if (Validation::validName($first)) {

//                if(isset($premium))
//                {
//                    // create new premium object
//                    $premium = new Premium();
//                } else
//                {
//                    // create new membership object
//                    $membership = new Membership();
//                }

                $membership = new Membership();
                //Add the first name to the membership
                $membership->setFirst($first);

                //Store the order in the session array
                $_SESSION['membership'] = $membership;


                //store it in the session array
                $_SESSION['first'] = $first;

            } else {
                $this->_f3->set('errors["first"]', 'Please enter your first name with letters.');
            }



            if (Validation::validName($last)) {

                //Add the last name to the membership
                $membership->setLast($last);

                //Store the membership in the session array
                $_SESSION['membership'] = $membership;
                //store it in the session array
                $_SESSION['last'] = $last;

            } else {
                $this->_f3->set('errors["last"]', 'Please enter your last name with letters.');
            }

            if (Validation::validAge($age)) {

                //Add the age to the membership
                $membership->setAge($age);

                //Store the membership in the session array
                $_SESSION['membership'] = $membership;

                //store it in the session array
                $_SESSION['age'] = $age;



            } else {
                $this->_f3->set('errors["age"]', 'Please enter your age.');
            }



            if (Validation::validPhone($phone)) {

                //Add the food to the order
                $membership->setPhone($phone);

                //Store the membership in the session array
                $_SESSION['membership'] = $membership;

                //store it in the session array
                $_SESSION['phone'] = $phone;

            } else {
                $this->_f3->set('errors["phone"]', 'Please enter your telephone number.');
            }

            if (Validation::validGender($gender)) {
                //Add the food to the order
                $membership->setGender($gender);

                //Store the membership in the session array
                $_SESSION['membership'] = $membership;

                //store it in the session array
                $_SESSION['gender'] = $gender;

                $_SESSION['membership']->setGender($gender);
            } else {
                $this->_f3->set('errors["gender"]', 'Gender selection is invalid');
            }

            //Redirect to order2 route if there are no errors
            if (empty($this->_f3->get('errors'))) {
                header('location: profile');
            }

        }

        //Add genders data to hive
        $this->_f3->set('genders', DataLayer::getGenders());

        $view = new Template();
        echo $view->render('views/personal.html');
    }
    function profile()
    {
        var_dump($_POST);
        //Get the data


        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        //state
        $state = "";
        if(isset($_POST['state'])){
            $state = $_POST['state'];
        }
        $_SESSION['state'] = $state;

        $_SESSION['membership']->setState($state);


        //seeking
        $seeking = "";
        if(isset($_POST['seeking'])){
            $seeking = $_POST['seeking'];
        }
        //store it in the session array
        $_SESSION['seeking'] = $seeking;

        $_SESSION['membership']->setSeeking($seeking);

        //bio
        $bio = "";
        if(isset($_POST['bio'])){
            $bio = $_POST['bio'];
        }

        $_SESSION['bio'] = $bio;
        $_SESSION['membership']->setBio($bio);

        $email = "";
        if(isset($_POST['email'])){
            $email = $_POST['email'];
        }
        //store it in the session array
        $_SESSION['email'] = $email;

            if (Validation::validEmail($email)) {
                $_SESSION['membership']->setEmail($email);
            } else {
                $this->_f3->set('errors["email"]', 'Please enter a valid email.');
            }
            //Redirect to order2 route if there are no errors
            if (empty($this->_f3->get('errors'))) {
                header('location: interest');
            }

        }

        //Add states data to hive
        $this->_f3->set('states',DataLayer::getState());
        $this->_f3->set('seekings',DataLayer::getSeeking());

        $view = new Template();
        echo $view->render('views/profile.html');
    }
    function interest()
    {
        //Add interest data to hive
        $this->_f3->set('indoorInterest', DataLayer::getIndoorInterest());
        $this->_f3->set('outdoorInterest', DataLayer::getOutdoorInterest());

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $indoorInts = "";

            if (empty($_POST['indoorInts'])) {
                $indoorInts = "no indoor activities selected";
            } else {
                $indoorInts = implode(", ", $_POST['indoorInts']);

//                if (!validIndoor($_POST['indoorInts'])) {
//
//                    //$f3->set('errors["indoorInts"]', 'No spoofing please!');
//                    var_dump($_POST);
//                }
            }
            //Create a new membership object
            $premium = new Premium();

            //Add the food to the order
            $premium->setIndoorInts((array)$indoorInts);

            //Store the membership in the session array
            $_SESSION['premium'] = $premium;

            //store it in the session array
            $_SESSION['indoorInts'] = $indoorInts;
            $_SESSION['premium']->setIndoorInts((array)$indoorInts);


            $outdoorInts = "";
            if (empty($_POST['outdoorInts'])) {
                $outdoorInts = "no outdoor activities selected";
            } else {
                $outdoorInts = implode(", ", $_POST['outdoorInts']);

//                if (!validOutdoor($_POST['outdoorInts'])) {
//
//                    //$f3->set('errors["outdoorInts"]', 'No spoofing please!');
//                    var_dump($_POST);
//                }
            }
            $_SESSION['premium']->setOutdoorInts((array)$outdoorInts);
            header('location: summary');

        }


        $view = new Template();
        echo $view->render('views/interest.html');
    }
    function summary()
    {
//        echo "<pre>";
//        var_dump($_SESSION);
//        echo"<pre>";

        $view = new Template();
        echo $view->render('views/summary.html');

        //clear the session array
        session_destroy();
    }



}

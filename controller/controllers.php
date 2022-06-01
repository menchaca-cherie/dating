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
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            var_dump($_POST);

            //Get the data
            //first
            $first = $_POST['first'];
            $this->_f3->set('firstName', $first);

            //require
            $first = isset($_POST['first']) ? $_POST['first'] : "";
            //If data is first name is valid
            //if data is valid
            if (Validation::validName($first)) {
                //Create a new membership object
                $membership = new Membership();

                //Add the first name to the membership
                $membership->setFirst($first);

                //Store the membership in the session array
                $_SESSION['membership'] = $membership;

                //store it in the session array
                $_SESSION['first'] = $first;

            } else {
                $this->_f3->set('errors["first"]', 'Please enter your first name with letters.');
            }

            //last
            $last = $_POST['last'];
            $this->_f3->set('lastName', $last);
            $last = isset($_POST['last']) ? $_POST['last'] : "";
            if (Validation::validName($last)) {
                //Create a new membership object
                $membership = new Membership();

                //Add the last name to the membership
                $membership->setLast($last);

                //Store the membership in the session array
                $_SESSION['membership'] = $membership;

                //store it in the session array
                $_SESSION['last'] = $last;

            } else {
                $this->_f3->set('errors["last"]', 'Please enter your last name with letters.');
            }

            //age
            $age = $_POST['age'];
            $this->_f3->set('age', $age);
            $age = isset($_POST['age']) ? $_POST['age'] : "";
            if (Validation::validAge($age)) {
                //Create a new membership object
                $membership = new Membership();

                //Add the food to the order
                $membership->setAge($age);

                //Store the membership in the session array
                $_SESSION['membership'] = $membership;

                //store it in the session array
                $_SESSION['age'] = $age;

            } else {
                $this->_f3->set('errors["age"]', 'Please enter your age.');
            }

            //phone
            $phone = $_POST['phone'];
            $this->_f3->set('phone', $phone);
            $phone = isset($_POST['phone']) ? $_POST['phone'] : "";
            if (Validation::validPhone($phone)) {
                //Create a new membership object
                $membership = new Membership();

                //Add the food to the order
                $membership->setPhone($phone);

                //Store the membership in the session array
                $_SESSION['membership'] = $membership;

                //store it in the session array
                $_SESSION['phone'] = $phone;
            } else {
                $this->_f3->set('errors["phone"]', 'Please enter your telephone number.');
            }

            //gender
            $gender = $_POST['gender'];
            $this->_f3->set('gender', $gender);
            $gender = isset($_POST['gender']) ? $_POST['gender'] : "";
            if (Validation::validGender($gender)) {
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
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            //Get the data
            $email = $_POST['email'];
            $this->_f3->set('email', $email);
            $email = isset($_POST['email']) ? $_POST['email'] : "";
            if (Validation::validEmail($email)) {
                //Create a new membership object
                $membership = new Membership();

                //Add the food to the order
                $membership->setEmail($email);

                //Store the membership in the session array
                $_SESSION['membership'] = $membership;

                //store it in the session array
                $_SESSION['email'] = $email;
            } else {
                $this->_f3->set('errors["email"]', 'Please enter a valid email.');
            }
            //Redirect to order2 route if there are no errors
            if (empty($this->_f3->get('errors'))) {
                header('location: interest');
            }


            $state = $_POST['state'];
            $this->_f3->set('userState', $state);
            //Create a new membership object
            $membership = new Membership();

            //Add the food to the order
            $membership->setState($state);

            //Store the membership in the session array
            $_SESSION['membership'] = $membership;

            //store it in the session array
            $_SESSION['state'] = $state;

            $seeking = $_POST['seeking'];
            $this->_f3->set('userSeeking', $seeking);
            //Create a new membership object
            $membership = new Membership();

            //Add the food to the order
            $membership->setSeeking($seeking);

            //Store the membership in the session array
            $_SESSION['membership'] = $membership;

            //store it in the session array
            $_SESSION['seeking'] = $seeking;

            $bio = $_POST['bio'];
            $this->_f3->set('bio', $bio);
            //Create a new membership object
            $membership = new Membership();

            //Add the food to the order
            $membership->setBio($bio);

            //Store the membership in the session array
            $_SESSION['membership'] = $membership;

            //store it in the session array
            $_SESSION['bio'] = $bio;
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
        $this->_f3->set('indoorInterest',DataLayer::getIndoorInterest());
        $this->_f3->set('outdoorInterest',DataLayer::getOutdoorInterest());

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $indoorInts = $_POST['indoorInts'];
            $this->_f3->set('indoorInts', $indoorInts);
            //$indoorInts = isset($_POST['indoorInt']) ? $_POST['indoorInt'] : "";
            $indoorInts = "";
            if (empty($_POST['indoorInts'])) {
                $indoorActs = "no indoor activities selected";
            } else {
                $indoorInts = implode(", ", $_POST['indoorInts']);

//                if (!validIndoor($_POST['indoorInts'])) {
//
//                    //$f3->set('errors["indoorInts"]', 'No spoofing please!');
//                    var_dump($_POST);
//                }
            }
            $_SESSION['membership']->setIndoorInts($indoorInts);


            $outdoorInts = $_POST['outdoorInts'];
            $this->_f3->set('outdoorInts', $outdoorInts);
            //$outdoorInts = isset($_POST['outdoorInts']) ? $_POST['outdoorInts'] : "";
            $outdoorInts = "";
            if (empty($_POST['outdoorInts'])) {
                $indoorActs = "no outdoor activities selected";
            } else {
                $outdoorInts = implode(", ", $_POST['outdoorInts']);

//                if (!validOutdoor($_POST['outdoorInts'])) {
//
//                    //$f3->set('errors["outdoorInts"]', 'No spoofing please!');
//                    var_dump($_POST);
//                }
            }
            $_SESSION['membership']->setOutdoorInts($outdoorInts);
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

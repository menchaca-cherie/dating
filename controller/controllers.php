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
        //Add genders data to hive
        $this->_f3->set('genders', DataLayer::getGenders());

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            var_dump($_POST);

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

            $gender = isset($_POST['gender']) ? $_POST['gender'] : "";

            //require

            //If data is first name is valid
            //if data is valid
            if (Validation::validName($first)) {



                if(isset($premium) == "checked")
                {
                    $premium = new Premium();
                } else
                {
                    // create new membership object
                    $membership = new Membership();
                }

                //Add the first name to the membership
                $membership->setFirst($first);

                //Store the membership in the session array
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

            //gender


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


        $view = new Template();
        echo $view->render('views/personal.html');
    }
    function profile()
    {
        //Get the data
        $email = $_POST['email'];
        $this->_f3->set('email', $email);

        //state
        $state = $_POST['state'];
        $this->_f3->set('userState', $state);

        //seeking
        $seeking = $_POST['seeking'];
        $this->_f3->set('userSeeking', $seeking);

        //bio
        $bio = $_POST['bio'];
        $this->_f3->set('bio', $bio);

        //Add states data to hive
        $this->_f3->set('states',DataLayer::getState());
        $this->_f3->set('seekings',DataLayer::getSeeking());

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

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

            //Add the food to the order
            $membership->setState($state);
            //Store the membership in the session array
            $_SESSION['membership'] = $membership;
            //store it in the session array
            $_SESSION['state'] = $state;
            $_SESSION['membership']->setState($state);


            //Add the food to the order
            $membership->setSeeking($state);
            //Store the membership in the session array
            $_SESSION['membership'] = $membership;
            //store it in the session array
            $_SESSION['seeking'] = $seeking;
            $_SESSION['membership']->setSeeking($seeking);

            //Add the food to the order
            $membership->setBio($bio);
            //Store the membership in the session array
            $_SESSION['membership'] = $membership;
            //store it in the session array
            $_SESSION['bio'] = $bio;
            $_SESSION['membership']->setBio($bio);


        }



        $view = new Template();
        echo $view->render('views/profile.html');
    }
    function interest()
    {
        //Add interest data to hive
        $this->_f3->set('indoorInterest',DataLayer::getIndoorInterest());
        $this->_f3->set('outdoorInterest',DataLayer::getOutdoorInterest());

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $indoorInts = "";
            //create new premium object
            $premium = new Premium();

            //Add the indoor interest to the premium
            $premium->setIndoorInts((array)$indoorInts);

            //Store the membership in the session array
            $_SESSION['premium'] = $premium;

            //store it in the session array
            $_SESSION['indoorInts'] = $indoorInts;

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

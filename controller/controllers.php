<?php

/**
 * This class represents the controller for $_f3 that will be passed through the index for routing
 * for the following functions
 * home, personal, profile, interest, summary
 */
class Controllers
{
    /**This field will be passed through the index
     * @var $_f3
     */
    private $_f3;

    /**This is the constructor for $_f3
     * @param $f3
     */
    function __construct($f3)
    {
        $this->_f3 = $f3;
    }

    /**This function is for the home page
     * @return void
     */
    function home()
    {
        $view = new Template();
        echo $view->render('views/home.html');
    }

    /**This function is for the personal page
     * that will hold the following from the membership(profile) and premium(profile)->for these members it
     * will be placed in the object for the below fields
     * first, last, age, phone, gender, and if the premium is checked
     * @return void
     */
    function personal()
    {
        var_dump($_POST);


        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['premium'])) {
                $profile = new Premium();
            } else {
                $profile = new Membership();
            }
            //set the object to $profile
            $_SESSION['profile'] = $profile;


            $first = $_POST['first'];
            $this->_f3->set('firstName', $first);
            //If data is first name is valid
            //if data is valid
            if (Validation::validName($first)) {
                //first
                $profile->setFirst($first);

                //Store the membership in the session array
                $_SESSION['profile'] = $profile;

                //store it in the session array
                $_SESSION['first'] = $first;
                $_SESSION['profile']->setFirst('first');

            } else {
                $this->_f3->set('errors["first"]', 'Please enter your first name with letters.');
            }


            //last
            $last = $_POST['last'];
            $this->_f3->set('lastName', $last);

            if (Validation::validName($last)) {
                $profile->setLast($last);

                //Store the membership in the session array
                $_SESSION['profile'] = $profile;

                //store it in the session array
                $_SESSION['last'] = $last;
                $_SESSION['profile']->setLast('last');

            } else {
                $this->_f3->set('errors["last"]', 'Please enter your last name with letters.');
            }

            //age
            $age = $_POST['age'];
            $this->_f3->set('age', $age);

            if (Validation::validAge($age)) {
                //Add the food to the order
                $profile->setAge($age);

                //Store the membership in the session array
                $_SESSION['profile'] = $profile;

                //store it in the session array
                $_SESSION['age'] = $age;
                $_SESSION['profile']->setAge($age);
            } else {
                $this->_f3->set('errors["age"]', 'Please enter your age.');
            }

            //phone
            $phone = $_POST['phone'];
            $this->_f3->set('phone', $phone);
            if (Validation::validPhone($phone)) {
                $profile->setPhone($phone);

                //Store the membership in the session array
                $_SESSION['profile'] = $profile;

                //store it in the session array
                $_SESSION['phone'] = $phone;
                $_SESSION['profile']->setPhone('phone');

            } else {
                $this->_f3->set('errors["phone"]', 'Please enter your telephone number.');
            }
            $gender = "";
            if (isset($_POST['gender'])) {
                $gender = $_POST['gender'];
            }

            if (Validation::validGender($gender)) {
                $profile->setGender($gender);

                //Store the membership in the session array
                $_SESSION['profile'] = $profile;

                //store it in the session array
                $_SESSION['gender'] = $gender;
                $_SESSION['profile']->setGender($gender);

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

    /**This function profile provides the following for the class membership or premium
     * state, email, seeking, and bio and will render the page to either summary if membership (profile) or
     * premium(profile)
     * @return void
     */
    function profile()
    {
        var_dump($_POST);
        //Get the data


        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //state
            $state = "";
            if (isset($_POST['state'])) {
                $state = $_POST['state'];
            }
            //store it in the session array
            $_SESSION['state'] = $state;
            $_SESSION['profile']->setState($state);


            //seeking
            $seeking = "";
            if (isset($_POST['seeking'])) {
                $seeking = $_POST['seeking'];
            }

            //store it in the session array
            $_SESSION['seeking'] = $seeking;
            $_SESSION['profile']->setSeeking($seeking);


            //bio
            $bio = "";
            if (isset($_POST['bio'])) {
                $bio = $_POST['bio'];
            }

            $_SESSION['bio'] = $bio;
            $_SESSION['profile']->setBio($bio);


            $email = "";
            if (isset($_POST['email'])) {
                $email = $_POST['email'];
            }
            //store it in the session array
            $_SESSION['email'] = $email;

            if (Validation::validEmail($email)) {

                $_SESSION['profile']->setEmail($email);

            } else {
                $this->_f3->set('errors["email"]', 'Please enter a valid email.');
            }

            if (empty($this->_f3->get('errors'))) {
                if ($_SESSION['profile'] instanceof premium) {
                    header('location: interest');
                } else {
                    header('location: summary');
                }
            }


        }

        //Add states data to hive
        $this->_f3->set('states', DataLayer::getState());
        $this->_f3->set('seekings', DataLayer::getSeeking());

        $view = new Template();
        echo $view->render('views/profile.html');

    }

    /**The interest function will provide you with having to select your interest indoor/outdoor
     * if premium is selected and then render the summary page
     * @return void
     */
    function interest()
    {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $indoorInts = "";

            if (empty($_POST['indoorInts'])) {
                $indoorInts = "none selected";
            }
            // User selected indoor activities
            else {
                // Get interests from post array
                $userIndoorInt = $_POST['indoorInts'];

                // If indoor are valid, convert to string
                if (Validation::validIndoor($userIndoorInt)) {
                    $indoorInts = implode(", ", $userIndoorInt);
                }
                else {
                    $this->_f3->set('errors["indoor"]', 'You spoofed me!');
                }
            }

            $outdoorInts = "";
            if (empty($_POST['outdoorInts'])) {
                $outdoorInts = "none selected";
            }
            // User selected indoor activities
            else {
                // Get interests from post array
                $userOutdoorInt = $_POST['outdoorInts'];

                // If condiments are valid, convert to string
                if (Validation::validOutdoor($userOutdoorInt)) {
                    $outdoorInts = implode(", ", $userOutdoorInt);
                }
                else {
                    $this->_f3->set('errors["outdoor"]', 'You spoofed me!');
                }
            }
            //Redirect to summary route if there are no errors
            if (empty($this->_f3->get('errors'))) {

                $_SESSION['profile']->setIndoorInts($indoorInts);
                $_SESSION['profile']->setOutdoorInts($outdoorInts);

                header("location: summary");
            }

        }
        //Add interest data to hive
        $this->_f3->set('indoorInterest', DataLayer::getIndoorInterest());
        $this->_f3->set('outdoorInterest', DataLayer::getOutdoorInterest());


        $view = new Template();
        echo $view->render('views/interest.html');
    }
    /** The summary function will render the fields to either membership(profile) or premium with interest
     * membership will hold first, last, age, gender, seeking, bio, and state
     * premium will holder all above and interests ->indoor/outdoor
     */
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
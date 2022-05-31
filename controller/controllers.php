<?php

class Controllers
{
    private $f3;
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
                //Create a new membership object
                $membership = new Membership();

                //Add the food to the order
                $membership->setGender($gender);

                //Store the membership in the session array
                $_SESSION['membership'] = $membership;

                //store it in the session array
                $_SESSION['gender'] = $gender;
            } else {
                $this->_f3->set('errors["gender"]', 'Gender selection is invalid');
            }

            //Redirect to order2 route if there are no errors
            if (empty($this->_f3->get('errors'))) {
                header('location: profile');
            }

        }

        //Add genders data to hive
        $this->_f3->set('genders', DataLayer::getGender());
        $view = new Template();
        echo $view->render('views/personal.html');
    }


}

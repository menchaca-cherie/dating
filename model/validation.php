<?php

/* dating/model/validation.php
* Validate user input from the dating app
*/
//validate name
class Validation
{
    static function validName($name)
    {
        if ($name=="") {
            return false;
        }
        else if (is_numeric($name)) {
            return false;
        }
        else {
            return true;
        }
    }
//validate age
    static function validAge($age)
    {
        if ($age=="") {
            return false;
        }
        else if (!is_numeric($age)) {
            return false;
        }
        else if ($age >= 18  && $age <= 118) {
            return true;
        }

    }
//validate phone
    static function validPhone($phone)
    {
        return strlen($phone) == 10;
    }
//validate email
    static function validEmail($email)
    {
        if(filter_var($email, FILTER_VALIDATE_EMAIL)){
            return true;
        }
        else{
            return false;
        }
    }
    static function validGender($gender)
    {
        return in_array($gender, DataLayer::getGenders());// will return true if it is in getGender()
    }
//valid interest
    static function validIndoor($indoorInt)
    {
        return in_array($indoorInt, DataLayer::getIndoorInterest());
    }

    static function validOutdoor($outdoorInt)
    {
        return in_array($outdoorInt, DataLayer::getOutdoorInterest());
    }

}


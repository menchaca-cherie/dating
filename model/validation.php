<?php

/* dating/model/validation.php
* Validate user input from the dating app
*/
//validate name
function validName($name)
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
function validAge($age)
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
function validPhone($phone)
{
    return strlen($phone) == 10;
}
//validate email
function validEmail($email)
{
    if(filter_var($email, FILTER_VALIDATE_EMAIL)){
        return true;
    }
    else{
        return false;
    }
}
function validGender($gender)
{
    return in_array($gender, getGender());// will return true if it is in getGender()
}
//valid interest
function validIndoor($indoorInt)
{
    return in_array($indoorInt, getIndoorInterest());
}

function validOutdoor($outdoorInt)
{
    return in_array($outdoorInt, getOutdoorInterest());
}


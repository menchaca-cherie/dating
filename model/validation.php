<?php

/* dating/model/validation.php
* Validate user input from the dating app
*/
//validate name
class Validation
{
    /**Static function validation for validName
     * @param $name
     * @return bool
     */
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
    /**Static function validation for validAge
     * @param $age
     * @return bool
     */
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
    /**Static function validation for validPhone
     * @param $phone
     * @return bool
     */
    //validate phone
    static function validPhone($phone)
    {
        return strlen($phone) == 10;
    }
    /**Static function validation for validEmail
     * @param $email
     * @return bool
     */
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

    /**This function checks if the gender is valid
     * @param $gender
     * @return bool
     */
    static function validGender($gender)
    {
        return in_array($gender, DataLayer::getGenders());// will return true if it is in getGender()
    }
    //valid interest

    /**This function checks if the indoor interest is valid
     * @param $userIndoorArray
     * @return bool
     */
    static function validIndoor($userIndoorIntArray)
    {
        $validIndoorArray = DataLayer::getIndoorInterest();

        //Make sure each user selection is in the array of valid options
        foreach ($userIndoorIntArray as $userIndoorInt) {
            if (!in_array($userIndoorInt, $validIndoorArray)) {
                return false;
            }
        }
        return true;
    }

    /**This checks if the outdoor interest is valid
     * @param $userOutdoorArray
     * @return bool
     */
    static function validOutdoor($userOutdoorIntArray)
    {

        $validOutdoorArray = DataLayer::getOutdoorInterest();

        //Make sure each user selection is in the array of valid options
        foreach($userOutdoorIntArray as $userOutdoorInt) {
        if (!in_array($userOutdoorInt, $validOutdoorArray)) {
                return false;
            }
        }

        return true;
    }

}


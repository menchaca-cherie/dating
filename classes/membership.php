<?php

//TODO: Add a description to each method

/**
 * This class represents all members of the dating forms.
 */
class Membership{

    private $_first;
    private $_last;
    private $_age;
    private $_phone;
    private $_gender;
    private $_email;
    private $_state;
    private $_seeking;
    private $_bio;

    //constructor
    public function __construct()
    {
        $this->_first = "";
        $this->_last = "";
        $this->_age = "";
        $this->_phone = "";
        $this->_gender = "";
        $this->_email = "";
        $this->_state = "";
        $this->_seeking = "";
        $this->_bio = "";
    }
    //getters and setters for each

    public function getFirst(): string
    {
        return $this->_first;
    }

    /**Return the first name for dating
     * @param string $first
     */
    public function setFirst(string $first): void
    {
        $this->_first = $first;
    }
    public function getLast(): string
    {
        return $this->_last;
    }

    /**Return the last name for dating
     * @param string $last
     */
    public function setLast(string $last): void
    {
        $this->_last = $last;
    }

    public function getAge(): int
    {
        return $this->_age;
    }

    /**Return the age for dating
     * @param int $age
     */
    public function setAge(int $age): void
    {
        $this->_last = $age;
    }
    public function getGender(): string
    {
        return $this->_gender;
    }
    /**Return the gender for dating
     * @param string $gender
     */
    public function setGender(string $gender): void
    {
        $this->_gender = $gender;
    }
    //phone
    public function getPhone(): string
    {
        return $this->_phone;
    }
    /**Return the phone for dating
     * @param string $phone
     */
    public function setPhone(string $phone): void
    {
        $this->_phone = $phone;
    }
    public function getEmail(): string
    {
        return $this->_email;
    }
    /**Return the email for dating
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->_email = $email;
    }
    public function getState(): string
    {
        return $this->_state;
    }
    /**Return the state for dating
     * @param string $state
     */
    public function setState(string $state): void
    {
        $this->_state = $state;
    }
    public function getSeeking(): string
    {
        return $this->_seeking;
    }
    /**Return the gender seeking for dating
     * @param string $seeking
     */
    public function setSeeking(string $seeking): void
    {
        $this->_seeking = $seeking;
    }
    public function getBio(): string
    {
        return $this->_bio;
    }
    /**Return the bio for dating
     * @param string $bio
     */
    public function setBio(string $bio): void
    {
        $this->_bio = $bio;
    }


}
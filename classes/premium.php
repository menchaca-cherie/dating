<?php
class Premium extends Membership
{
    private $_indoorInts;
    private $_outdoorInts;

    //constructor
    public function __construct()
    {
        $this->_indoorInts = "";
        $this->_outdoorInts = "";
    }

    public function getIndoorInts(): Array
    {
        return $this->_indoorInts;
    }

    /**Return the indoorInts for dating
     * @param Array $indoorInts
     */
    public function setIndoorInts(Array $indoorInts): void
    {
        $this->_indoorInts = $indoorInts;
    }

    public function getOutdoorInts(): Array
    {
        return $this->_outdoorInts;
    }

    /**Return the first name for dating
     * @param Array $outdoorInts
     */
    public function setOutdoorInts(Array $outdoorInts): void
    {
        $this->_outdoorInts = $outdoorInts;
    }
}
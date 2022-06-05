<?php

/**
 * This class represents the Premium class that extends Membership
 */
class Premium extends Membership
{
    /**These are the fields for premium
     * indoorInts and outdoorInts
     * @var string
     */
    private $_indoorInts;
    private $_outdoorInts;

    //constructor

    /**
     * This is the constructor for the following
     * indoorInts and outdoorInts
     */
    public function __construct()
    {
        $this->_indoorInts = "";
        $this->_outdoorInts = "";
    }

    /**This function gets the indoorInts
     * @return string
     */

    public function getIndoorInts(): string
    {
        return $this->_indoorInts;
    }

    /**This function sets the IndoorInts
     * @param string $indoorInts
     * @return void
     */
    public function setIndoorInts(string $indoorInts): void
    {
        $this->_indoorInts = $indoorInts;
    }

    /**This function gets the outdoorInts
     * @return string
     */

    public function getOutdoorInts(): string
    {
        return $this->_outdoorInts;
    }

    /**This function sets the OutdoorInts
     * @param string $outdoorInts
     * @return void
     */
    public function setOutdoorInts(string $outdoorInts): void
    {
        $this->_outdoorInts = $outdoorInts;
    }
}
<?php

/*dating/model/ data-layer2.php
 *Returns data for the dating app
 */

//Get the meals for the order form
function getGender()
{
    return array("male", "female", "non-binary");
}

//function getState()
//{
//    return array("Alabama", "Alaska", "Arizona", "Arkansas", "California",
//        "Colorado", "Connecticut", "Delaware", "District of Columbia",
//        "Florida", "Georgia", "Hawaii", "Idaho", "Illinois", "Indiana",
//        "Iowa", "Kansas", "Kentucky", "Louisiana", "Maine", "Maryland",
//        "Massachusetts", "Michigan", "Minnesota", "Mississippi", "Missouri",
//        "Montana", "Nebraska", "Nevada", "New Hampshire", "New Jersey",
//        "New Mexico", "New York", "North Carolina", "North Dakota", "Ohio",
//        "Oklahoma", "Oregon", "Pennsylvania", "Rhode Island", "South Carolina",
//        "South Dakota", "Tennessee", "Texas", "Utah", "Vermont", "Virginia",
//        "Washington", "West Virginia", "Wisconsin", "Wyoming");
//}

function getSeeking()
{
    return array("male", "female", "non-binary");
}
function getIndoorInterest()
{
    return array("read", "netflix and chill", "cooking", "knitting/crochet", "puzzle", "playing cards", "video games", "clean");
}
function getOutdoorInterest()
{
    return array("hiking", "biking", "walking", "shopping", "beach", "trips", "sports", "camping");
}

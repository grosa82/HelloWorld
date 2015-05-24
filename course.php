<?php
class Course {
    public $id = 0;
    public $name = "";
    public $code = "";
    public $section = 0;
    public $time_begin = "";
    public $time_end = "";
    public $weekday = "";
    public $color = "";

    function hasOnThisDay($day) {
    	$day--;
        if (strpos($this->weekday, "$day") !== false)
    		return true;
    	else
    		return false;
    }
}
?> 
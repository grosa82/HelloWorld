<?php
	function msg($message)
	{
		echo "<p>PHP: $message</p>";
	}
	function redirect($url)
	{
		header("Location: $url");
		die();
	}
	function getUserId()
	{
		if (isset($_SESSION["user"]))
			return (int)$_SESSION["user"];
		else
			return 1;
	}
	function setUserId($id)
	{
		if ($id == 0)
			unset($_SESSION["user"]);
		else
			$_SESSION["user"] = (int)$id;
	}
	function getColor($id)
	{
		$color = array("#00A0B1", "#2E8DEF", "#A700AE", "#643EBF", "#BF1E4B", "#DC572E", "#00A600", "#0A5BC4");
		return $color[$id];
	}
    function getWeekDays($days)
	{
		$dowMap = array('Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat');
		$result = "";
		for ($i = 0; $i < strlen($days); $i++) 
		{
			$result = $result . $dowMap[$days[$i]] . " ";
		}
		return $result;
	}
	function getWeekDay($day)
	{
		$day = $day - 1;
		$dowMap = array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');
		return $dowMap[$day];
	}
	function getHourOptions(){
		$html = "";
		for ($i = 7; $i < 22; $i++)
		{
			$val = "$i";
			$option = "";

			if ($i < 10)
				$val = "0" . $i;
			if ($i > 12)
				$option = ($i - 12) . " PM";
			else
				$option = $i . " AM";
			$html = $html . "<option value='$val'>$option</option>\n";
		}
		echo $html;
	}
	function getMinuteOptions(){
		$html = "";
		for ($i = 0; $i < 60; $i++)
		{
			$val = "$i";
			if ($i < 10)
				$val = "0" . $i;
			$html = $html . "<option value='$val'>$val</option>\n";
		}
		echo $html;
	}
	function getCalendarHours(){
		$html = "";
		for ($i = 0; $i < 16; $i++)
		{
			$pixel = $i * 30;
			$hour = $i + 6;
			if ($i > 0) {
				$html = $html . "<div class='line' style='top: " . $pixel . "px'></div>\n";
				$html = $html . "<div class='hour' style='top: " . $pixel . "px'>$hour:00</div>\n";
			}
		}
		echo $html;
	}
	function hasSameDay($days1, $days2){
		for ($i = 0; $i < strlen($days1); $i++){
			for ($j = 0; $j < strlen($days2); $j++){
				if (substr($days1, $i, 1) == substr($days2, $j, 1))
				{
					return true;
				}
			}	
		}
		return false;		
	}
?>
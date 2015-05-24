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
		if (isset($SESSION["user"]))
			return (int)$SESSION["user"];
		else
			return 0;
	}
	function setUserId($id)
	{
		if ($id == 0)
			unset($SESSION["user"]);
		else
			$SESSION["user"] = (int)$id;
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
?>
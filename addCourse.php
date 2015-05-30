<?php
	session_start();
	header('Content-type: application/json');
	include "functions.php";
	include "scheduleClasses.php";

	// creates an object to store the final message
	$message = new Message();

	// get user id
	$user_id = getUserId();

	// process the form
	$name = $_POST["name"];
	$code = $_POST["code"];
	$section = $_POST["section"];
	$hour_begin = $_POST["hour_begin"];
	$minute_begin = $_POST["minute_begin"];
	$hour_end = $_POST["hour_end"];
	$minute_end = $_POST["minute_end"];
	$weekday = $_POST["weekday"];

	if ($name == "" || $code == "" || $section == "")
	{
		$message->content = "All the fields are required";
		$message->success = false;
	}
	else
	{
		// check if end time is greater than begin time
		$begin_time = "$hour_begin:$minute_begin:00";
		$end_time = "$hour_end:$minute_end:00";

		if (strtotime($end_time) > strtotime($begin_time)) 
		{
			include "open_connection.php";

			$stmt = $pdo->prepare("insert into course (code, id_user, name, section, time_begin,"
				." time_end, weekday) values (:code, :user_id, :name, :section,"
				." :begin_time, :end_time, :weekday_val)");
			$stmt->bindValue(':code', $code, PDO::PARAM_STR);
			$stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
			$stmt->bindValue(':name', $name, PDO::PARAM_STR);
			$stmt->bindValue(':section', $section, PDO::PARAM_INT);
			$stmt->bindValue(':begin_time', $begin_time, PDO::PARAM_STR);
			$stmt->bindValue(':end_time', $end_time, PDO::PARAM_STR);
			$stmt->bindValue(':weekday_val', $weekday, PDO::PARAM_STR);

			if ($stmt->execute()) {
				$message->content = "Course added successfully";
				$message->success = true;
			} else {
				$message->content = "Error executing query";
				$message->success = false;
			}

			include "close_connection.php";	
		}
		else
		{
			$message->content = "End time must be greater than begin time";
			$message->success = false;
		}
	}
	
	echo json_encode($message);
?>
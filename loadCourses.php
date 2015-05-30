<?php
	session_start();
	header('Content-type: application/json');
	include "scheduleClasses.php";
   	include "functions.php";
   	include "open_connection.php";

   	$courses = array();
   	$stmt = $pdo->prepare("SELECT id, name, code, section, time_begin, time_end, weekday FROM course where id_user = :id_user");
	$stmt->bindValue(':id_user', getUserId(), PDO::PARAM_INT);
				
	$stmt->execute();

	$color_id = 0;
				
	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

		// for each line on the database creates an object course
		$course = new Course();
		$course->id = $row["id"];
		$course->name = $row["name"];
		$course->code = $row["code"];
		$course->section = $row["section"];
		$course->time_begin = $row["time_begin"];
		$course->time_end = $row["time_end"];
		$course->weekday = $row["weekday"];
		$course->weekdayName = getWeekDays($row["weekday"]);
		$course->color = getColor($color_id);

		// calculate size of the box for week schedule
		$to_time = strtotime($course->time_end);
		$from_time = strtotime($course->time_begin);
		$minutes = round(($to_time - $from_time) / 60, 0);
		$hour = intval(date('H', $from_time)) - 6;
		$minute = intval(date('i', $from_time));
		$course->topMargin = ($hour * 30) + (round(($minute / 60) * 30, 0));
		$course->height = round($minutes / 2, 0);

		// add course to the array
		$courses[] = $course;

		if ($color_id == 7)
			$color_id = 0;
		else
			$color_id++;
	}
	include "close_connection.php";


	// check for conflicts
	foreach ($courses as $keyX => $valueX) {
		foreach ($courses as $keyY => $valueY) {
			if (hasSameDay($valueX->weekday, $valueY->weekday) && $valueX->id != $valueY->id)
			{
				$end_x = strtotime($valueX->time_end);
				$begin_x = strtotime($valueX->time_begin);
				$end_y = strtotime($valueY->time_end);
				$begin_y = strtotime($valueY->time_begin);

				if ($begin_x == $begin_y || $end_x == $end_y || ($begin_y >= $begin_x && $end_y <= $end_x) ||
					($begin_y <= $begin_x && $end_y >= $begin_x) || ($begin_y <= $end_x && $end_y > $end_x) ||
					($begin_y <= $begin_x && $end_y >= $end_x))
				{
					$valueX->conflicted = true;
					$valueY->conflicted = true;
				}
			}
		}
	}

	echo json_encode($courses);
?>
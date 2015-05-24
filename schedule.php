<?php
	include "header.php";
	include "functions.php";

	// get user id
	$user_id = $SESSION["id_user"];

	if (!isset($user_id))
		$user_id = 1;

	// process the form
	if (isset($_POST["posted"]))
	{
		$name = $_POST["name"];
		$code = $_POST["code"];
		$section = $_POST["section"];
		$hour_begin = $_POST["hour_begin"];
		$minute_begin = $_POST["minute_begin"];
		$hour_end = $_POST["hour_end"];
		$minute_end = $_POST["minute_end"];
		$weekday = $_POST["weekday"];
		

		if (!isset($name) || !isset($code) || !isset($section) ||
			!isset($hour_begin) || !isset($minute_begin) || !isset($hour_end) ||
			!isset($minute_end) || !isset($weekday))
		{
			echo "<h2><span class='label label-danger'>All the fields are required</span></h2>";
		}
		else
		{
			// check if end time is greater than begin time
			$begin_time = "$hour_begin:$minute_begin:00";
			$end_time = "$hour_end:$minute_end:00";

			if (strtotime($end_time) > strtotime($begin_time)) 
			{
	  			$weekday_val = implode("", $weekday);
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
				$stmt->bindValue(':weekday_val', $weekday_val, PDO::PARAM_STR);

				if ($stmt->execute()) {
		    		echo "<h2><span class='label label-success'>Course added successfully</span></h2>";

		    		unset($name);
		    		unset($section);
		    		unset($code);
		    		unset($hour_begin);
		    		unset($minute_begin);
		    		unset($hour_end);
		    		unset($minute_end);
		    		unset($weekday);

				} else {
					echo "<h2><span class='label label-danger'>Error executing query</span></h2>";
				}

				include "close_connection.php";	
			}
			else
			{
				echo "<h2><span class='label label-danger'>End time must be greater than begin time</span></h2>";
			}
		}
	}
?>

<link rel="stylesheet" href="schedule.css" />

<div class="page-header">
	<h2>New courses</h2>
</div>

<div class="row">
	<form action="schedule.php" method="post">
		<table>
			<tbody>
				<tr>
					<td>
						Course name
					</td>
					<td>
						<input type="text" name="name" value="<?php echo "$name" ?>" />
					</td>
				</tr>
				<tr>
					<td>
						Course code
					</td>
					<td>
						<input type="text" name="code" value="<?php echo "$code" ?>" />
					</td>
				</tr>
				<tr>
					<td>
						Course section
					</td>
					<td>
						<input type="text" name="section" value="<?php echo "$section" ?>" />
					</td>
				</tr>
				<tr>
					<td>
						Time begin
					</td>
					<td>
						<select name="hour_begin">
							<?php
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
									echo "<option value='$val'>$option</option>";
								}
							?>
						</select>
						h&nbsp;&nbsp;
						<select name="minute_begin">
							<?php
								for ($i = 0; $i < 60; $i++)
								{
									$val = "$i";
									if ($i < 10)
										$val = "0" . $i;
									echo "<option value='$val'>$val</option>";
								}
							?>
						</select>
						m
					</td>
				</tr>
				<tr>
					<td>
						Time end
					</td>
					<td>
						<select name="hour_end">
							<?php
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
									echo "<option value='$val'>$option</option>";
								}
							?>
						</select>
						h&nbsp;&nbsp;
						<select name="minute_end">
							<?php
								for ($i = 0; $i < 60; $i++)
								{
									$val = "$i";
									if ($i < 10)
										$val = "0" . $i;
									echo "<option value='$val'>$val</option>";
								}
							?>
						</select>
						m
					</td>
				</tr>
				<tr>
					<td>
						Frequency
					</td>
					<td>
						<input type="checkbox" name="weekday[]" value="0" /> Sunday<br />
						<input type="checkbox" name="weekday[]" value="1" /> Monday<br />
						<input type="checkbox" name="weekday[]" value="2" /> Tuesday<br />
						<input type="checkbox" name="weekday[]" value="3" /> Wednesday<br />
						<input type="checkbox" name="weekday[]" value="4" /> Thursday<br />
						<input type="checkbox" name="weekday[]" value="5" /> Friday<br />
						<input type="checkbox" name="weekday[]" value="6" /> Saturday<br />
					</td>
				</tr>
				<td colspan="2">
					<button class="btn btn-primary" type="submit">Add course</button>
				</td>
			</tbody>
		</table>
		<input type="hidden" name="posted" value="1" />	
	</form>
</div>

<div class="page-header">
	<h2>My Courses</h2>
</div>

<div class="row">
	<table class="table table-striped">
        <thead>
            <tr>
                <th>Course Name</th>
                <th>Code</th>
                <th>Section</th>
                <th>Start</th>
                <th>End</th>
                <th>Days</th>
            </tr>
        </thead>
        <tbody>
            <?php
            	include "course.php";
            	include "open_connection.php";

            	$courses = array();

            	$stmt = $pdo->prepare("SELECT name, code, section, time_begin, time_end, weekday FROM course where id_user = :id_user");
				$stmt->bindValue(':id_user', $user_id, PDO::PARAM_INT);
				
				$stmt->execute();

				$color_id = 0;
				
				while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

					$course = new Course();
					$course->id = $row["id"];
					$course->name = $row["name"];
					$course->code = $row["code"];
					$course->section = $row["section"];
					$course->time_begin = $row["time_begin"];
					$course->time_end = $row["time_end"];
					$course->weekday = $row["weekday"];
					$course->color = getColor($color_id);

	    			print "<tr><td>".$course->name."</td><td>".$course->code."</td><td>".
   						$course->section."</td><td>".$course->time_begin."</td>".
   						"<td>".$course->time_end."</td><td>".getWeekDays($course->weekday)."</td></tr>";

	    			$courses[] = $course;

	    			if ($color_id == 7)
	    				$color_id = 0;
	    			else
	    				$color_id++;
	    		}

	    		include "close_connection.php";
            ?>
        </tbody>
    </table>
</div>

<div class="page-header">
	<h2>Week schedule</h2>
</div>

<div class="week">
	<div class="hours">
		<?php
			for ($i = 0; $i < 16; $i++)
			{
				$pixel = $i * 30;
				$hour = $i + 6;
				if ($i > 0) {
					echo "<div class='line' style='top: " . $pixel . "px'></div>\n";
					echo "<div class='hour' style='top: " . $pixel . "px'>$hour:00</div>\n";
				}
			}
		?>
	</div>

	<?php
		// weekdays
		for ($i = 1; $i <= 7; $i++)
		{
			echo "<div class='weekday'>".getWeekDay($i)."\n";
			// courses
			foreach ($courses as $key => $value) {
				// calculate size of the box
				$to_time = strtotime($value->time_end);
				$from_time = strtotime($value->time_begin);
				$minutes = round(($to_time - $from_time) / 60, 0);
				$height = round($minutes / 2, 0);
				$hour = intval(date('H', $from_time)) - 6;
				$minute = intval(date('i', $from_time));
				$top = ($hour * 30) + (round(($minute / 60) * 30, 0));

				if ($value->hasOnThisDay($i))
					echo "<div class='course' style='height: ".$height."px; top: ".$top."px; background-color: ".$value->color."'>".$value->code."</div>";		
			}
			echo "</div>";
		}
	?>
	<!--
	<div class="weekday">
		Monday
		<div class="course" style="height: 30px; top: 90px; background-color: <?php echo $color[0] ?>">CS308</div>
		<div class="course" style="height: 30px; top: 127px; background-color: <?php echo $color[1] ?>">CS237</div>
		<div class="course" style="height: 30px; top: 240px; background-color: <?php echo $color[2] ?>">FDREL200</div>
		<div class="course" style="height: 45px; top: 277px; background-color: <?php echo $color[3] ?>">CS313</div>
	</div>
	<div class="weekday">
		Tuesday
		<div class="course" style="height: 30px; top: 90px; background-color: <?php echo $color[0] ?>">CS308</div>
	</div>
	<div class="weekday">
		Wednesday
		<div class="course" style="height: 30px; top: 90px; background-color: <?php echo $color[0] ?>">CS308</div>
		<div class="course" style="height: 30px; top: 127px; background-color: <?php echo $color[1] ?>">CS237</div>
		<div class="course" style="height: 30px; top: 240px; background-color: <?php echo $color[2] ?>">FDREL200</div>
		<div class="course conflict" style="height: 45px; top: 277px; background-color: red" title="Conflict between CS313 and FDWLD101">CS313</div>
		<div class="course conflict" style="height: 45px; top: 300px; background-color: red" title="Conflict between CS313 and FDWLD101">FDWLD101</div>
	</div>
	<div class="weekday">
		Thursday
	</div>
	<div class="weekday">
		Friday
		<div class="course" style="height: 30px; top: 90px; background-color: <?php echo $color[0] ?>">CS308</div>
		<div class="course" style="height: 30px; top: 127px; background-color: <?php echo $color[1] ?>">CS237</div>
	</div>
	<div class="weekday">
		Saturday
	</div>
	-->

</div>

<?php
	include "footer.php";
?>
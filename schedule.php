<?php
	include "header.php";
	$color = array("#00A0B1", "#2E8DEF", "#A700AE", "#643EBF", "#BF1E4B", "#DC572E", "#00A600", "#0A5BC4");

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
		$weekday_val = implode("", $weekday);

		include "open_connection.php";

		$sql = "insert into course (code, id_user, name, section, time_begin,"
			." time_end, weekday) values ('$code', '$user_id', '$name', '$section',"
			." '$hour_begin:$minute_begin', '$hour_end:$minute_end', '$weekday_val')";

		if ($conn->query($sql) === TRUE) {
    		echo "New record created successfully";
		} else {
    		echo "Error: " . $sql . "<br>" . $conn->error;
		}

		include "close_connection.php";
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
						<input type="text" name="name" />
					</td>
				</tr>
				<tr>
					<td>
						Course code
					</td>
					<td>
						<input type="text" name="code" />
					</td>
				</tr>
				<tr>
					<td>
						Course section
					</td>
					<td>
						<input type="text" name="section" />
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
									$val = "";
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
									$val = "";
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
					<button type="submit">Add course</button>
				</td>
			</tbody>
		</table>
		<input type="hidden" name="posted" value="1" />	
	</form>
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
	<div class="weekday">
		Sunday
	</div>
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
</div>

<?php
	include "footer.php";
?>
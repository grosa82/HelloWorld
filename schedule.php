<?php
	include "header.php";
	include "functions.php";	
?>

<link rel="stylesheet" href="schedule.css" />

<div class="page-header">
	<h2>New course</h2>
</div>

<div class="row">
	<form id="myForm">
		<table style="border-spacing: 10px; border-collapse: separate;">
			<tbody>
				<tr>
					<td style="width: 140px;">Course name</td>
					<td><input type="text" id="name" name="name" /></td>
				</tr>
				<tr>
					<td>Course code</td>
					<td><input type="text" id="code" name="code" /></td>
				</tr>
				<tr>
					<td>Course section</td>
					<td><input type="text" id="section" name="section" /></td>
				</tr>
				<tr>
					<td>Time begin/end</td>
					<td><select id="hour_begin"><?php getHourOptions(); ?></select>&nbsp;h&nbsp;<select id="minute_begin"><?php getMinuteOptions(); ?></select>&nbsp;m&nbsp;&nbsp;-&nbsp;
						<select id="hour_end"><?php getHourOptions(); ?></select>&nbsp;h&nbsp;<select id="minute_end"><?php getMinuteOptions(); ?></select>&nbsp;m</td>
				</tr>
				<tr>
					<td>Frequency</td>
					<td>
						<input type="checkbox" class="day" value="0" /> Sunday&nbsp;
						<input type="checkbox" class="day" value="1" /> Monday&nbsp;
						<input type="checkbox" class="day" value="2" /> Tuesday&nbsp;
						<input type="checkbox" class="day" value="3" /> Wednesday&nbsp;
						<input type="checkbox" class="day" value="4" /> Thursday&nbsp;
						<input type="checkbox" class="day" value="5" /> Friday&nbsp;
						<input type="checkbox" class="day" value="6" /> Saturday
					</td>
				</tr>
			</tbody>
		</table>

		<br />
		<button class="btn btn-primary" type="button" onclick="addCourse()">Add new course</button>&nbsp;&nbsp;<span class="msg label" id="msg"></span> 
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
                <th>Remove</th>
            </tr>
        </thead>
        <tbody id="courses">
        </tbody>
    </table>
    <span class="msg label" id="msg2"></span> 
</div>

<div class="page-header">
	<h2>Week schedule</h2>
</div>

<div class="week">
	<div class="hours"><?php getCalendarHours(); ?></div>
	<?php
		// weekdays
		for ($i = 1; $i <= 7; $i++)
			echo "<div class='weekday' id='weekday_" . ($i - 1) . "'>".getWeekDay($i)."</div>\n";
	?>
</div>
<img src="park.gif" title="Ah, ah, ah! Conflict found" style="float: right; display: none;" id="park" />
<script type="text/javascript" src="schedule.js"></script>
<?php include "footer.php"; ?>
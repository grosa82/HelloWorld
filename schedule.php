<?php
	include "header.php";
	$color = array("#00A0B1", "#2E8DEF", "#A700AE", "#643EBF", "#BF1E4B", "#DC572E", "#00A600", "#0A5BC4");
?>

<link rel="stylesheet" href="schedule.css" />

<div class="page-header">
	<h2>New courses</h2>
</div>

<div class="row">
	<form action="schedule.cpp" method="post">
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
			</tbody>
		</table>	
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
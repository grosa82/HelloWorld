<?php
	include "header.php";
	$color = array("#00A0B1", "#2E8DEF", "#A700AE", "#643EBF", "#BF1E4B", "#DC572E", "#00A600", "#0A5BC4");
?>

<style>
.week{
	display: inline-block;
	width: 750px; 
	height: 480px; 
	background-color: #f3f3f3;
	position: relative;
}
.weekday{
	width: 100px;
	height: 480px;
	border: 1px solid #d3d3d3;
	float: left;
	position: relative;
	vertical-align: text-top;
	color: gray;
	text-align: center;
}
.hours{
	width: 50px;
	height: 480px;
	float: left;
	position: relative;
	background-color: white;
}
.hour{
	width: 50px;
	height: 20px;
	position: absolute;
	left: 0px;
	top: 0px;
	font-size: 10px;
	color: black;
	text-align: center;
	vertical-align: middle;	
}
.course{
	width: 98px;
	position: absolute;
	left: 0px;
	font-size: 10px;
	color: white;
	font-weight: bold;
	border-radius: 6px;
	border: 1px solid white;
}
.conflict{
	opacity: 0.8;
	border: 3px dotted black;
	cursor: help;
	border-radius: 6px;
	background-image: url('alert.png');
    background-repeat: no-repeat;
    background-position: bottom; 	
}
.line{
	width: 750px;
	position: absolute;
	left: 0px;
	border-top: 1px dashed #d3d3d3;
	height: 1px;
}
</style>

<div class="page-header">
	<h2>Week Schedule</h2>
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
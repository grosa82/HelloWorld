<?php
	include "header.php";

	if ((!isset($_SESSION["vote"]) && isset($_POST["smartPhone"])) || (!isset($_COOKIE["vote"]) && isset($_POST["smartPhone"])))
	{
		$smartPhone = $_POST["smartPhone"];
		$internet = $_POST["internet"];
		$laptop = $_POST["laptop"];
		$major = $_POST["major"];

		$answers = $smartPhone."|".$internet."|".$laptop."|".$major."\n";

		$myfile = fopen("data.txt", "a");
		fwrite($myfile, $answers); 
		fclose($myfile);

		$_SESSION["vote"] = true;
		setcookie("vote", "true", time() + 2000);

		echo "<h3><span class='label label-success'>Your vote was computed successfully</span></h3>";
	}
	else if (!isset($_POST["smartPhone"]) && (isset($_SESSION["vote"]) || isset($_COOKIE["vote"])))
	{
		echo "<h3><span class='label label-info'>Check the results below</span></h3>";
	}
	else
	{
		echo "<h3><span class='label label-danger'>Sorry, your vote was already computed</span></h3>";
	}
?>

<div class="page-header">
	<h1>Survey Statistics</h1>
</div>

<table style="width: 100%; border-spacing: 10px; border-collapse: separate;">
<tr>
	<td style="text-align: center;">
		<div class="panel panel-primary">
		    <div class="panel-heading">
		        <h3 class="panel-title">The Best Smartphone</h3>
		    </div>
		    <div class="panel-body">
				<canvas id="myChart1" width="300" height="300"></canvas>
		    </div>
		</div>
	</td>
	<td style="text-align: center;">
		<div class="panel panel-primary">
		    <div class="panel-heading">
		        <h3 class="panel-title">Internet Speed (Mbps)</h3>
		    </div>
		    <div class="panel-body">
				<canvas id="myChart2" width="300" height="300"></canvas>
		    </div>
		</div>
	</td>
</tr>
<tr>
	<td style="text-align: center;">
		<div class="panel panel-primary">
		    <div class="panel-heading">
		        <h3 class="panel-title">The Best Laptop Brand</h3>
		    </div>
		    <div class="panel-body">
				<canvas id="myChart3" width="300" height="300"></canvas>
		    </div>
		</div>
	</td>
	<td style="text-align: center;">
		<div class="panel panel-primary">
		    <div class="panel-heading">
		        <h3 class="panel-title">Majors</h3>
		    </div>
		    <div class="panel-body">
				<canvas id="myChart4" width="300" height="300"></canvas>
		    </div>
		</div>
	</td>
</tr>
</table>

<?php

	$listSmartPhones = array("Blackberry" => 0, "Galaxy" => 0, "HTC One" => 0, "iPhone" => 0, "Nexus" => 0, "Sony Xperia" => 0);
	$listLaptops = array("Apple" => 0, "Asus" => 0, "Dell" => 0, "HP" => 0, "Lenovo" => 0, "Toshiba" => 0);
	$listInternet = array("01 - 05" => 0, "05 - 10" => 0, "10 - 20" => 0, "20 - 50" => 0, "50+" => 0);
	$listMajor = array("Computer Science" => 0, "Computer Engineering" => 0, "Eletrical Engineering" => 0, "Software Engineering" => 0, "Other" => 0);

	$handle = fopen("data.txt", "r");
	if ($handle) {
	    while (($line = fgets($handle)) !== false) 
	    {
	        $parts = explode("|", $line);

	        $smartPhoneVal = $parts[0];
	        $laptopVal = $parts[2];
	        $internetVal = $parts[1];
	        $majorVal = str_replace("\n", "", $parts[3]);

	        foreach ($listSmartPhones as $key => $value) {
	        	if ($key == $smartPhoneVal)
	        		$listSmartPhones[$key] = $value + 1;
	        }

	        foreach ($listLaptops as $key => $value) {
	        	if ($key == $laptopVal)
	        		$listLaptops[$key] = $value + 1;
	        }

			foreach ($listInternet as $key => $value) {
	        	if ($key == $internetVal)
	        		$listInternet[$key] = $value + 1;
	        }

	        foreach ($listMajor as $key => $value) {
	        	if ($key == $majorVal)
	        		$listMajor[$key] = $value + 1;
	        }	        
	    }
	    fclose($handle);
	} 
	else 
	{
		echo "<h3><span class='label label-danger'>Sorry, we couldn't read our data to show you the results. We apologize.</span></h3>";	      
	} 
?>

<script type="text/javascript" src="chart.js"></script>
<script type="text/javascript">
	var smartPhoneData = [
	<?php
		$color = array("#A4C400", "#1BA1E2", "#F472D0", "#F0A30A", "#76608A", "#87794E");
		$i = 0;
		foreach ($listSmartPhones as $key => $value) {
		  	echo "{ value: $value, color: '$color[$i]', highlight: '$color[$i]', label: '$key' }";
		   	$i++;
		   	if ($i != count($listSmartPhones))
		   		echo ",";
		}
	?>
	];
	var internetData = [
	<?php
		$i = 0;
		foreach ($listInternet as $key => $value) {
		  	echo "{ value: $value, color: '$color[$i]', highlight: '$color[$i]', label: '$key' }";
		   	$i++;
		   	if ($i != count($listInternet))
		   		echo ",";
		}
	?>
	];
	var laptopData = [
	<?php
		$i = 0;
		foreach ($listLaptops as $key => $value) {
		  	echo "{ value: $value, color: '$color[$i]', highlight: '$color[$i]', label: '$key' }";
		   	$i++;
		   	if ($i != count($listLaptops))
		   		echo ",";
		}
	?>
	];
	var majorData = [
	<?php
		$i = 0;
		foreach ($listMajor as $key => $value) {
		  	echo "{ value: $value, color: '$color[$i]', highlight: '$color[$i]', label: '$key' }";
		   	$i++;
		   	if ($i != count($listMajor))
		   		echo ",";
		}
	?>
	];
    
    var smartPhonePieChart = new Chart(document.getElementById("myChart1").getContext("2d")).Pie(smartPhoneData);
    var internetPieChart = new Chart(document.getElementById("myChart2").getContext("2d")).Pie(internetData);
    var laptopPieChart = new Chart(document.getElementById("myChart3").getContext("2d")).Pie(laptopData);
    var majorPieChart = new Chart(document.getElementById("myChart4").getContext("2d")).Pie(majorData);
</script>

<div class="page-header">
	
</div>

<?php include "footer.php"; ?>
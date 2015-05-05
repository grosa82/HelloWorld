<?php 
	include "header.php";
	if (isset($_SESSION["vote"]))
	{
		header("Location: survey_result.php");
 	} 
 ?>

<div class="page-header">
	<h1>Survey</h1>
</div>

<input type="button" value="I just want to see the results" class="btn btn-primary" onclick="location.href='survey_result.php'" />

<hr />

<form method="post" action="survey_result.php">

<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">Question 1</h3>
    </div>
    <div class="panel-body">
        <h3>In your opnion what is the best smartphone?</h3>
		<input type="radio" name="smartPhone" value="Blackberry" checked>&nbsp;&nbsp;Blackberry<br />
		<input type="radio" name="smartPhone" value="Galaxy">&nbsp;&nbsp;Galaxy<br />
		<input type="radio" name="smartPhone" value="HTC One">&nbsp;&nbsp;HTC One<br />
		<input type="radio" name="smartPhone" value="iPhone">&nbsp;&nbsp;iPhone<br />
		<input type="radio" name="smartPhone" value="Nexus">&nbsp;&nbsp;Nexus<br />
		<input type="radio" name="smartPhone" value="Sony Xperia">&nbsp;&nbsp;Sony Xperia<br />
    </div>
</div>

<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">Question 2</h3>
    </div>
    <div class="panel-body">
        <h3>In your opnion what is the best laptop brand?</h3>
		<input type="radio" name="laptop" value="Apple" checked>&nbsp;&nbsp;Apple<br />
		<input type="radio" name="laptop" value="Asus">&nbsp;&nbsp;Asus<br />
		<input type="radio" name="laptop" value="Dell">&nbsp;&nbsp;Dell<br />
		<input type="radio" name="laptop" value="HP">&nbsp;&nbsp;HP<br />
		<input type="radio" name="laptop" value="Lenovo">&nbsp;&nbsp;Lenovo<br />
		<input type="radio" name="laptop" value="Toshiba">&nbsp;&nbsp;Toshiba<br />
    </div>
</div>

<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">Question 3</h3>
    </div>
    <div class="panel-body">
        <h3>What is the speed of your internet connection? (Mbps)</h3>
		<input type="radio" name="internet" value="01 - 05" checked>&nbsp;&nbsp;01 - 05<br />
		<input type="radio" name="internet" value="05 - 10">&nbsp;&nbsp;05 - 10<br />
		<input type="radio" name="internet" value="10 - 20">&nbsp;&nbsp;10 - 20<br />
		<input type="radio" name="internet" value="20 - 50">&nbsp;&nbsp;20 - 50<br />
		<input type="radio" name="internet" value="50+">&nbsp;&nbsp;50+<br />
    </div>
</div>

<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">Question 4</h3>
    </div>
    <div class="panel-body">
        <h3>What is your major?</h3>
		<input type="radio" name="major" value="Computer Science" checked>&nbsp;&nbsp;Computer Science<br />
		<input type="radio" name="major" value="Computer Engineering">&nbsp;&nbsp;Computer Engineering<br />
		<input type="radio" name="major" value="Eletrical Engineering">&nbsp;&nbsp;Eletrical Engineering<br />
		<input type="radio" name="major" value="Software Engineering">&nbsp;&nbsp;Software Engineering<br />
		<input type="radio" name="major" value="Other">&nbsp;&nbsp;Other<br />
    </div>
</div>

<input type="submit" value="Send my answers" class="btn btn-success" />

</form>

<div class="page-header">
	
</div>

<?php include "footer.php" ?>
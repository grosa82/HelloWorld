<?php
	session_start();
	include "functions.php";
	setUserId(0);
	unset($_SESSION["name"]);
	redirect("login.php");
?>
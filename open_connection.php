<?php
	$servername = getenv('OPENSHIFT_MYSQL_DB_HOST');
	$username = getenv('OPENSHIFT_MYSQL_DB_USERNAME');
	$password = getenv('OPENSHIFT_MYSQL_DB_PASSWORD');
	$port = getenv('OPENSHIFT_MYSQL_DB_PORT');
	$dbname = getenv('OPENSHIFT_APP_NAME');

	//echo phpinfo();

	try 
	{
    	$pdo = new PDO("mysql:host=".$servername.";dbname=".$dbname.";port=".$port, $username, $password);
    	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    	$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	} 
	catch(PDOException $err) 
	{
    	die($err->getMessage());
	}
?>
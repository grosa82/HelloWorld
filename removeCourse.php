<?php
	session_start();
	header('Content-type: application/json');
	include "open_connection.php";
	include "functions.php";
	include "scheduleClasses.php";

	$message = new Message();

	$stmt = $pdo->prepare("delete from course where id = :id and id_user = :id_user");
	$stmt->bindValue(':id', $_POST["id"], PDO::PARAM_INT);
	$stmt->bindValue(':id_user', getUserId(), PDO::PARAM_INT);

	if ($stmt->execute()){
		$message->success = true;
		$message->content = "Course removed";
	}
	else
	{
		$message->content = "Error: Course was not removed";	
	}

	include "close_connection.php";
	echo json_encode($message);
?>
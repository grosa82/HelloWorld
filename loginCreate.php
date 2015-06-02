<?php
	include "functions.php";	
	require "password.php";

	setUserId(0);

	$action;

	// get the action
	if (isset($_POST["action"]))
		$action = $_POST["action"];

	if (isset($action))
	{
		// open a new connection to the database
		include "open_connection.php";
		
		// check if user wants to login or to create a new account
		if ($action == "Create")
		{
			// get data to create an account
			$name = $_POST["name"];
			$confirm = $_POST["confirm"];
			$email = $_POST["email"];
			$password = $_POST["password"];

			if ($password == $confirm)
			{
				$password = password_hash($password, PASSWORD_DEFAULT);
				// create a new account
				$stmt = $pdo->prepare("insert into user (name, email, password) values (:name, :email, :password)");
				$stmt->bindValue(':name', $name, PDO::PARAM_STR);
				$stmt->bindValue(':email', $email, PDO::PARAM_STR);
				$stmt->bindValue(':password', $password, PDO::PARAM_STR);
				$stmt->execute();

				if ($stmt){
					echo "<h2><span class='label label-success'>Account created, now log in</span></h2>";	
					$action = "Enter";
				}
				else
					echo "<h2><span class='label label-danger'>Error creating account</span></h2>";	
			}
			else
			{
				echo "<h2><span class='label label-danger'>Password does not match</span></h2>";		
			}
		}
		else
		{
			$email = $_POST["loginEmail"];
			$password = $_POST["loginPassword"];

			// try to login
			$stmt = $pdo->prepare("select id, name, password from user where email = :email");
			$stmt->bindValue(':email', $email, PDO::PARAM_STR);
			$stmt->execute();

			while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
				if (password_verify($password, $row["password"]))
				{
					setUserId($row["id"]); 
					$_SESSION["name"] = $row["name"];
				}
			}

			if (getUserId() == 0)
				echo "<h2><span class='label label-danger'>User not found</span></h2>";
			else
				redirect("schedule.php");
		}

		// close the connection with the database		
		include "close_connection.php";
	}
?>
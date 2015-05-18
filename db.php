<?php
	include "header.php";
	$servername = getenv('OPENSHIFT_MYSQL_DB_HOST');
	$username = getenv('OPENSHIFT_MYSQL_DB_USERNAME');
	$password = getenv('OPENSHIFT_MYSQL_DB_PASSWORD');
	$port = getenv('OPENSHIFT_MYSQL_DB_PORT');
	$dbname = "php";

	// Create connection

	$conn = new mysqli($servername, $username, $password, $dbname, $port);

	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}

	$sql = "SELECT id, name, email FROM user order by name";
	$result = $conn->query($sql);
?>

<table border="1">
<tbody>
<?php
	if ($result->num_rows > 0) {
	    // output data of each row
	    while($row = $result->fetch_assoc()) {
	        echo "<tr><td>" . $row["id"]. "</td><td>" . $row["name"]. "</td><td>" . $row["email"]. "</td></tr>";
	    }
	} else {
	    echo "0 results";
	}
	$conn->close();
?>
</tbody>
</table> 
<?php
	include "footer.php";
?>
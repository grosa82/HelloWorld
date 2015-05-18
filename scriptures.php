<?php
	include "header.php";
	include "open_connection.php";

	$book = "Enos";
	if (isset($_POST["book"]))
		$book = $_POST["book"];

	$sql = "SELECT book FROM Scriptures order by book";
	$result = $conn->query($sql);
?>

<form method="post" action="scriptures.php">
	<select name="book">

	<?php
		if ($result->num_rows > 0) {
		    // output data of each row
		    while($row = $result->fetch_assoc()) {

		    	if ($book == $row["book"])
					echo "<option selected>".$row["book"]."</option>";
				else
		        	echo "<option>".$row["book"]."</option>";
		    }
		} 
	?>

	</select>

	<button type="submit">Search</button>

</form>
<br /><br />
<br />
<?php

	if (!isset($book))
		$sql = "SELECT id, book, chapter, verse, content FROM Scriptures order by book";
	else
		$sql = "SELECT id, book, chapter, verse, content FROM Scriptures where book = '$book' order by book";
	
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
	    // output data of each row
	    while($row = $result->fetch_assoc()) {
	        echo "<p><span style='font-weight: bold;'>".$row["book"]." ".$row["chapter"].":".$row["verse"]." - </span>\"" . $row["content"]. "\"</p>";
	    }
	} else {
	    echo "0 results";
		
	}
	include "close_connection.php";
	include "footer.php";
?>


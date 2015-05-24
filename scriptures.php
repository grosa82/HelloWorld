<?php
	include "header.php";
	include "open_connection.php";

	$book = "Enos";
	if (isset($_POST["book"]))
		$book = $_POST["book"];

	$stmt = $pdo->prepare("SELECT book FROM Scriptures order by book");
	//$stmt->bindValue(':id', $id, PDO::PARAM_INT);
	$stmt->execute();
?>

<form method="post" action="scriptures.php">
	<select name="book">
	<?php
	    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { 
	    	if ($book == $row["book"])
				echo "<option selected>".$row["book"]."</option>";
			else
	        	echo "<option>".$row["book"]."</option>";
	    }
	?>
	</select>

	<button type="submit">Search</button>

</form>
<br /><br />
<br />
<?php

	if (!isset($book))
		$stmt = $pdo->prepare("SELECT id, book, chapter, verse, content FROM Scriptures order by book");
	else
	{
		$stmt = $pdo->prepare("SELECT id, book, chapter, verse, content FROM Scriptures where book = :book order by book");
		$stmt->bindValue(':book', $book, PDO::PARAM_STR);
	}

	$stmt->execute();

    // output data of each row
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<p><span style='font-weight: bold;'>".$row["book"]." ".$row["chapter"].":".$row["verse"]." - </span>\"" . $row["content"]. "\"</p>";
    }

	include "close_connection.php";
	include "footer.php";
?>


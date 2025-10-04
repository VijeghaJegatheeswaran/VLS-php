<?php
    require_once('Config.php'); 
    session_start();

    $subject=$_SESSION["subject"];
   
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" href="Style/style.css">
</head>
<body>

<div class="container">
<div class="logout"> <a class="logout_text" href="dashboard.php" >Back</a></div>
<br><br>
    <?php
        echo "<h1>".$subject." FILES</h1><br>";
		?>
    <?php
			$sql = "SELECT * FROM files WHERE subject='$subject'";
			$result = mysqli_query($conn,$sql);
			echo "<table class='filetable'>";
			while($row = mysqli_fetch_row($result)){
				echo "<tr>";
				echo "<td class='filetabletd'>";
				echo $row[1];
				echo "</td>";
				echo "<td class='filetabletd'>";
				echo "<a class='meterial_text' href='Uploads/$row[1]' target=_blank> Open File </a>";
				echo "</td>";
				echo "<td class='filetabletd'>";
				echo "<a class='meterial_text' href='Uploads/$row[1]' download> Download File </a>";
				echo "</td>";
				echo "</tr>";
			
      }
      echo "</table>";
      $conn->close();
		?>
   
    </div>

</body>
</html>    
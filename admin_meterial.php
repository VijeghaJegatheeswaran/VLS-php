<?php
    require_once('Config.php'); 
	session_start();

    $subject=$_SESSION["subject"];
	$sqlErr=$fileformatErr=$fileexistErr=$upload="";


if (isset($_POST['submit'])) {
    $file_name = $_FILES['file']['name'];
    $file_tmp = $_FILES['file']['tmp_name'];
    $file_type = $_FILES['file']['type'];
	$file_path="Uploads/".$file_name;
	
	$accepted_format=array("pdf"=>"application/pdf");
	
	if(!file_exists($file_path)){
		if(in_array($file_type,$accepted_format)){
			move_uploaded_file($file_tmp,$file_path);
			  $sql = "INSERT INTO files (file_name, file_path,subject) VALUES ('$file_name','$file_path','$subject')";
			  
			  if(mysqli_query($conn,$sql)){
				  $upload="File uploaded successfuly";
				 
			  }
			  else{
				  $sqlErr="Unable to upload the file.!";
			  }
			
		}
		else{
			   $fileformatErr="File format not supported.!";		
		}
	}
	else{
		 $fileexistErr="File Already Exists.!";	  
	}
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
   
    <title>Admin Meterial</title>
    <link rel="stylesheet" href="Style/admin.css">
</head>

<body>

    <div class="container">
	<div class="logout"> <a class="logout_text" href="admin_dashboard.php" >Back</a></div>
	<br><br>
        <?php
        echo "<h1>".$subject."</h1><br>";
		?>
		<p class="error"><?php echo $upload ?></p>
		<p class="error"><?php echo $fileformatErr ?></p>
		<p class="error"><?php echo $fileexistErr ?></p>
        <form action="admin_meterial.php" method="post" enctype="multipart/form-data">
            <label for="file">Select File:</label>
            <input type="file" name="file" id="file" required>
            <button type="submit" name="submit">Upload</button>
        </form>
		<h1>FILES</h1>
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
				echo "<td class='filetabletd'>";
				echo "<a class='meterial_text' href='delete_file.php?file_id=$row[0]&file_name=$row[1]'> Delete File </a>";
				echo "</td>";
				echo "</tr>";
			}
			echo "</table>";
			$conn->close();
		?>
		
    </div>

</body>

</html>

<?php
    require_once('Config.php'); 
    $fileid =  $_GET['file_id'];
    $filename =  $_GET['file_name'];

    $sql = "DELETE FROM files WHERE file_id='$fileid'";
	mysqli_query($conn,$sql);

    unlink('Uploads/'.$filename);

    header("Location:admin_meterial.php");

?>
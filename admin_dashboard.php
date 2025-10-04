<?php
  session_start();
  if(isset($_POST["ENGLISH"])){
    $_SESSION["subject"]="ENGLISH";
    header("Location:admin_meterial.php");
  }
  else if(isset($_POST["COMBINED_MATHS"])){
    $_SESSION["subject"]="COMBINED_MATHS";
    header("Location:admin_meterial.php");
  }
  else if(isset($_POST["CHEMISTRY"])){
    $_SESSION["subject"]="CHEMISTRY";
    header("Location:admin_meterial.php");
  }
  else if(isset($_POST["PHYSICS"])){
    $_SESSION["subject"]="PHYSICS";
    header("Location:admin_meterial.php");
  }
  else if(isset($_POST["ICT"])){
    $_SESSION["subject"]="ICT";
    header("Location:admin_meterial.php");
  } 
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" href="Style/admin.css">
</head>
<body>
  <div class="dashboard_container">
  
    <div class="logout"> <a class="logout_text" href="logout.php" >Logout</a></div>
    <br><br>
    <center>
    <h1>SELECT THE SUBJECT</h1>
    <div class="subject">
      <form action="admin_dashboard.php" method="post">
      <input type="submit" class="sub_button" name="ENGLISH" value="ENGLISH">  
      <form>
    </div>


    <div class="subject">
      <form action="admin_dashboard.php" method="post">
      <input type="submit" class="sub_button" name="COMBINED_MATHS" value="COMBINED_MATHS">  
      <form>
    </div>


    <div class="subject">
      <form action="admin_dashboard.php" method="post">
      <input type="submit" class="sub_button" name="CHEMISTRY" value="CHEMISTRY">  
      <form>
    </div>


    <div class="subject">
      <form action="admin_dashboard.php" method="post">
      <input type="submit" class="sub_button" name="PHYSICS" value="PHYSICS">  
      <form>
    </div>


    <div class="subject">
      <form action="admin_dashboard.php" method="post">
      <input type="submit" class="sub_button" name="ICT" value="ICT">  
      <form>
    </div>
</center>

  </div>
</body>
</html>    
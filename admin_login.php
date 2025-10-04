<?php
  require_once('Config.php');
  $loginErr="";
  if(isset($_POST['admin_login'])){
    $admin_name=$_POST['admin_name'];
    $admin_password=$_POST['admin_password'];
    $sql="SELECT admin_id,admin_password FROM admin WHERE admin_name='$admin_name' AND admin_password='$admin_password'";
    $result=$conn->query($sql);
    if($result->num_rows>0){
      session_start();
      $row=$result->fetch_assoc();
      $_SESSION["a_id"]=$row["admin_id"];
      $_SESSION["a_name"]=$row["admin_name"];
      header("Location:admin_dashboard.php");
    }
    else{
      $loginErr="Invalid username or password";
    }
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Login Page</title>
  <link rel="stylesheet" href="Style/admin.css">
</head>
<body>



<div class="container">
  <h1>ADMIN LOGIN</h1>
  <p class="error">
  <?php echo $loginErr ?></p>
  <form class="form" action="admin_login.php" method="post">
   
    <div class="form-group">
      <h4>USERNAME:</h4>
      <input type="text" id="admin_name" name="admin_name" required>
  	</div>	

    
    <div class="form-group">
     <h4>PASSWORD:</h4>
      <input type="password" id="admin_password" name="admin_password" >
	  </div>
 

    <input type="submit" class="button" name="admin_login" value="LOGIN">
  
  </form>

<br><br>
<a href="login.php" >User ? LOGIN</a>
<div class="logout"> <a class="logout_text" href="index.php" >Back</a></div>
</div>

</body>
</html>

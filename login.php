<?php
  require_once('Config.php');
  $loginErr="";
  if(isset($_POST['login'])){
    $username=$_POST['username'];
    $password=$_POST['password'];
    $sql="SELECT user_id,userpassword FROM user WHERE username='$username' AND userpassword='$password'";
    $result=$conn->query($sql);
    if($result->num_rows>0){
      session_start();
      $row=$result->fetch_assoc();
      $_SESSION["u_id"]=$row["user_id"];
      $_SESSION["u_name"]=$row["username"];
      header("Location:dashboard.php");
    }
    else{
      $loginErr="Invalid username or password";
    }
  }
  $conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Login Page</title>
  <link rel="stylesheet" href="Style/style.css">
</head>
<body>



<div class="container">
  <h1>LOGIN</h1>
  <p class="error">
  <?php echo $loginErr ?></p>
  <form class="form" action="login.php" method="post">
   
    <div class="form-group">
      <h4>USERNAME:</h4>
      <input type="text" id="username" name="username" required>
  	</div>	

    
    <div class="form-group">
     <h4>PASSWORD:</h4>
      <input type="password" id="password" name="password" >
	  </div>
 

    <input type="submit" class="button" name="login" value="login">
  
  </form>
  <br><br>
  <a href="passwordchange.php" class="reset-link">Forgot Password</a>

<br><br>
<a href="register.php" >New User ? Register</a>
<div class="logout"> <a class="logout_text" href="index.php" >Back</a></div>
</div>



</body>
</html>

6<?php
require_once('Config.php');    
$unameErr=$passwordErr = $repasswordErr=$curuserErr = "";
$uname =$password = $repassword = "";

if(isset($_POST["register"])){
  
  $uname = $_POST["uname"];
  $password = $_POST["password"];
  $repassword = $_POST["repassword"];
 
  //name validation 
  if(empty($uname)){
    $nameErr = "NAME IS REQUIRED ";
  }
  
  
  if(empty($password)){
    $passwordErr = "Password is required ";
  }
  else{
    $uppercase = preg_match('@[A-z]@',$password);
    $specialChars = preg_match('/|^\w]/',$password);
    
    if(strlen($password) < 8 || strlen($password) > 20){
      $passwordErr =" password must contain be between 8 and 20 characters ";
      $password ="";
    }
    elseif(!$uppercase){
      $passwordErr ="password must contain at least one upercase ";
      $password ="";
    }
    elseif(!$specialChars){
      $passwordErr ="password must contain at least one special characters ";
      $password ="";
    }
    else{
      $password = test_input($password);
    }
  }
  if ($password !== $repassword) {
  $repasswordErr = "Passwords do not match.";
 }
  $curusersql = " SELECT username,userpassword FROM user
          WHERE username ='$uname'";
  $curuserres = mysqli_query($conn, $curusersql);

  if(mysqli_num_rows($curuserres)>0){
    $curuserErr ="username already Exits .!";
  }
  else{
    if($unameErr == "" && $passwordErr == "" && $repasswordErr=="" && $curuserErr =="")
    {
      
      $sql =" INSERT INTO user
      (username,userpassword)
      VALUES 
      ('$uname','$password')";
      
      $result =  mysqli_query($conn,$sql);
      if($result){
        header("location:Login.php");
      }
      else{
        echo " Registration Fails".mysqli_error($conn);
      }
    }
  }
}
function test_input($data){
  $data = trim($data);
  $data = stripcslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Register Page</title>
  <link rel="stylesheet" href="Style/style.css">
</head>
<body>

<div class="container">
<div class="logout"> <a class="logout_text" href="logout.php" >Back</a></div>    
  <h1>REGISTER</h1>
  <form class="form" action="register.php" method="post">
    <div class="form-group">
    <p class="error"><?php echo $curuserErr ?></p>
      <h4>Username:</h4><p class="error"><?php echo $unameErr ?></p>
      <input type="text" id="username" name="uname" required>
    </div>


    <div class="form-group">
      <h4 >Password:</h4> <p class="error"><?php echo $passwordErr ?></p>
      <input type="password" id="password" name="password" required>
    </div>
    <div class="form-group">
      <h4 >Reenter Password:</h4> <p class="error"><?php echo $repasswordErr ?></p>
      <input type="password" id="password" name="repassword" required>
    </div>


    <input type="submit" class="button" name="register" value="Register">
    <br><br>
	<a href="login.php">Already have account?Login</a>
  </form>
</div>

</body>
</html>

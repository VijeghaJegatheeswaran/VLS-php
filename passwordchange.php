<?php
  require('Config.php');
  $loginErr=$passwordErr="";
  if(isset($_POST['reset'])){
    $uname=$_POST["username"];
    $password=$_POST["newpassword"];
    $repassword=$_POST["repassword"];
    $sql="SELECT user_id,userpassword FROM user WHERE username='$uname'";
    $result=$conn->query($sql);


    if($result->num_rows>0){


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
      }
      if($password!==$repassword){
        $passwordErr="Passwords do not match.";
      }
    }
    else{
      $loginErr="Invalid username";
    }


    if($loginErr == "" && $passwordErr == "" )
    {
      
      $sql ="UPDATE user SET userpassword='$password' WHERE username='$uname'";
      
      $result =  mysqli_query($conn,$sql);
      if($result){
        header("location:Login.php");
      }
      else{
        echo " Password Reset Fails".mysqli_error($conn);
      }
    }

  }
  $conn->close();
 

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Password change</title>
  <link rel="stylesheet" href="Style/style.css">
</head>
<body>

<div class="container">
  <h1>RESET</h1>
  <br>
  <p class="error"><?php echo $loginErr ?></p>
  <form class="form" action="passwordchange.php" method="post">
    <div class="form-group">
      <h4>Username:</h4>
      <input type="text" id="username" name="username" required>
    </div>

    <div class="form-group">
      <h4 >New Password:</h4><br>
      <input type="password" id="password" name="newpassword" required>
    </div>
    <div class="form-group">
      <h4 >Reenter Password:</h4><br>
      <p class="error"><?php echo $passwordErr ?></p>
      <input type="password" id="password" name="repassword" required>
    </div>


    <input type="submit" class="button" name="reset" value="Reset">
  </form>
  <div class="logout"> <a class="logout_text" href="login.php" >Back</a></div>
</div>

</body>
</html>

<?php
session_start();
if(isset($_POST['submit'])){
  $DB_servername="localhost";
  $DB_username="root";
  $DB_password="";
  $DB_Name="test";
  $connection=mysqli_connect($DB_servername,$DB_username,$DB_password,$DB_Name);

  if(!$connection)
  {
  die("Failed".mysqli_connect_error());
  }
  $username=$_POST['email'];
  $pasword=$_POST['password'];
  
  if(empty($_POST['email']))
  {
      $emailError="*Email field must be field";
  }
  else{
      $email=$_POST['email'];
  }
  if(empty($_POST['password']))
  {
      $passError="*Password field must be field";
  }
  else{
      $pasword=$_POST['password'];
  }
  if(!isset($emailError) && !isset($passError))
  {
  $login="SELECT * FROM user_login WHERE email='$username' && password='$pasword'";
  $result1=mysqli_query($connection,$login);
  $v= mysqli_fetch_assoc($result1);
  if($result1)
  {
      $_SESSION['email']=$v['email'];
      
      header('location:emp.php');
  }  
  }
  else{
        echo "error"; 
  }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login Page</title>
    <style>
    body{
      
      background-size: cover;
      background-position: center;
      background-color: rgb(191, 202, 206);  
    }
  input{
      height: 35px;
      margin-bottom: 15px;
      width: 330px;
      border: 0.5px solid rgb(224, 219, 219);
      border-radius: 5px;   
    }
  input[type=submit]{
      background-color:rgb(151, 154, 156);
      width: auto;
      color: rgb(9, 9, 9);
      border-radius: 5px;
  }
  form{
      width: 338px;   
      background-color: rgb(239, 238, 238);
      padding: 10px 20px;
      border: 2px solid rgb(91, 125, 138);
      border-radius: 5px;
      margin:  auto; 
    }

  p{
      color:white;
      font-size: 15px;
    }

  h1{
      color:rgb(51, 185, 238) ;
      margin-bottom: 30px;
    }
    </style>
</head>
<body>
   
    <div>
        <form action="" method="post">
                Email:
                <input type="email" name="email" value="<?php echo isset($email)?$email:"";?>">
                <span style="color:white"> <?php echo isset($emailError)?$emailError:"";?></span>
                <span style="color:white"> <?php echo isset($duplicate)?$duplicate:"";?></span><br>
                Password:<br>
                <input type="password" name="password" value="<?php echo isset($pasword)?$pasword:"";?>">
                <span style="color:white"> <?php echo isset($passError)?$passError:"";?></span><br>
                <center><input type="submit" name="submit" value="Login"></center><br><br>
        </form>
        </div>
    
</body>
</html>
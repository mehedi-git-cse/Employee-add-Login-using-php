<?php 
$DB_servername="localhost";
$DB_username="root";
$DB_password="";
$DB_Name="test";

$connection=mysqli_connect($DB_servername,$DB_username,$DB_password,$DB_Name);
if(!$connection){
  die("Failed".mysqli_connect_error());
}

if(isset($_POST['submit'])){

    $name = $_POST['name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $gender = $_POST['gender'];
    $date = $_POST['date'];
    $salary = $_POST['salary'];
    $session = "Admin";

    if(isset($connection)){
      $query1="INSERT INTO `emp`( `name`, `email`, `mobile`, `gender`, `date`, `salary`, `updateby`, `createby`, `editby`, `deleteby`) VALUES ('$name','$email','$mobile','$gender','$date','$salary','$session','$session','$session','$session')";
      $result=mysqli_query($connection,$query1);
      
      if($result)
      {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            header('Location: emp.php');
            exit;
          }
      }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Info</title>
    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css">
<!-- Optional theme -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap-theme.min.css" >
</head>
<body>
     <div class="container">
      <nav class="navbar navbar-default">
        <div class="container-fluid">
          <!-- Brand and toggle get grouped for better mobile display -->
          <div class="navbar-header">
            <a class="navbar-brand" href="#">Employee Table</a>
          </div>
        </div><!-- /.container-fluid -->
      </nav>
    </div>
    <div class="container">
      <!-- Button trigger modal -->
<button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModalCenter">
  Add Employee
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Add Employee</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?=$_SERVER['PHP_SELF'];?>" method="post">

          <div class="form-group">
            <label for="exampleInputEmail1">Name</label>
            <input type="text" name="name" class="form-control"  id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Name">
            <span style="color:red"> </span><br>
          </div>

          <div class="form-group">
            <label for="exampleInputEmail1">Email</label>
            <input type="email" name="email" class="form-control"   id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
            <span style="color:red"> <?php echo isset($emailError)?$emailError:"";?></span>
            <span style="color:red"> <?php echo isset($duplicate)?$duplicate:"";?></span><br>
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
          </div>

          <div class="form-group">
            <label for="exampleInputPassword1">Mobile</label>
            <input type="number" name="mobile" class="form-control" id="exampleInputPassword1"   placeholder="Mobile">
          </div>

          <div class="form-group">
            <label for="exampleInputPassword1">Gender</label>     
            <select class="form-select" aria-label="Default select example" name="gender">
            <option value="male">Male</option>
            <option value="Female">Female</option>
            </select>
          </div>
      
          <div class="form-group">
            <label for="exampleInputPassword1">Date of Birth</label>
            <input type="date" name="date" class="form-control"   id="exampleInputPassword1" placeholder="Date of Birth">
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Salary</label>
            <input type="number" name="salary" class="form-control" id="exampleInputPassword1" placeholder="Salary">
          </div>
         
          <!-- <div class="form-check">
          <label for="exampleInputPassword1">Status</label> <br>
          <input class="form-check-input" type="radio" name="flexRadioDefault"  value="1" id="flexRadioDefault1"/>
          <label class="form-check-label" for="flexRadioDefault1"> Active </label>
          </div>

          <div class="form-check">
            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" checked/>
            <label class="form-check-label" for="flexRadioDefault2">Passive </label>
          </div> -->

          <button type="submit" name="submit" class="btn btn-primary" value="Submit Form">Submit</button>
          </form>
         </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    </div>
  </div>
</div>
</div>

<div class="container">
  <?php
        $sql = "select * from emp";
        $result = mysqli_query($connection, $sql) or die("failed");
        $output = "";
        if(mysqli_num_rows($result)>0){
           
           
           $th= " <table class='table'><th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Gender</th>
            <th>Date</th>
            <th>Salary</th>
            ";

            while($row = mysqli_fetch_assoc($result)){
                $output= $output."<tr>
                  <td>{$row['id']}</td>
                  <td>{$row['name']}</td>
                  <td>{$row['email']}</td>
                  <td>{$row['gender']}</td>
                  <td>{$row['date']}</td>
                  <td>{$row['salary']}</td></tr>
                  ";
                  }
                  mysqli_close($connection);
                  echo $th ."<br>";
                  echo $output;
          }
?></table> 
</div>

<!-- Latest compiled and minified JavaScript -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" ></script>
<script src="https://code.jquery.com/jquery-3.6.4.js"></script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</body>
</html>
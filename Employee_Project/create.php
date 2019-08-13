<?php
    include("db_con.php");
    if(isset($_POST["fname"]) && isset($_POST["lname"]) && isset($_POST["sex"]) && isset($_POST["email"]) && isset($_POST["addr"])){
        @$fname = $_POST['fname'];
        @$lname = $_POST['lname'];
        @$sex = $_POST['sex'];
        @$email = $_POST['email'];
        @$addr = $_POST['addr'];
    $sql = "insert into main_tb(first_name,last_name,sex,email,addr) values('$fname','$lname','$sex','$email','$addr')";
    $result = mysqli_query($con,$sql);
    header("location: index.php");
        exit();
    }
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add New Employee</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
<p>Add New Employee<p>
    <div class="container">
                <div class="row">
                    <div class="col-md-6">
                         <form action="create.php" method="post">
                            <div class="form-group">
                                <label for="fname">First Name:</label>
                                <input type="text" class="form-control" id="fname" placeholder="Enter First Name" name="fname"> 
                            </div>
                            <div class="form-group">
                                <label for="lname">Last Name:</label>
                                <input type="text" class="form-control" id="lname" placeholder="Enter Last Name" name="lname">            
                            </div>
                            <div class="form-group">
                                <label for="sex">Sex</label>
                                <select class="form-control" id="sex" name="sex">
                                    <option>Male</option>
                                    <option>Female</option>                             
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="text" class="form-control" id="email" placeholder="Enter Your Email" name="email" >                       
                            </div>
                            <div class="form-group">
                                <label for="addr">Your Address:</label>
                                <input type="addr" class="form-control" id="addr" placeholder="Enter First Name" name="addr" >   
                            </div>
                          <button type="submit" class="btn btn-primary" style="padding:10px 50px;">ADD</button>
                          <button type="reset" class="btn btn-danger" style="padding:10px 50px;">Cancle</button>
                        </form>                    
                    </div>
                    <div class="col-md-6">
                      <div class="photo"  >Upload Your Photo</div>
                    </div>
                </div>    
    </div>     
</body>
</html>
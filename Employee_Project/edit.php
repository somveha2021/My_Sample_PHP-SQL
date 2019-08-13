<?php 
        //connect to database
            include("db_con.php");
        //check field 
            if(isset($_GET['id']) && !empty($_GET['id'])){
                $id = $_GET['id'];   
                $sql="select * from main_tb where id= $id";
                $result = mysqli_query($con,$sql);
                $row = mysqli_fetch_array($result);
            }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Data</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<p>Edit Data<p>
    <div class="container">
                <div class="row">
                    <div class="col-md-6">
                         <form action="update.php" method="post">
                            <div class="form-group">
                                <input type="hidden" name="id" value="<?php echo $id;?>">
                                <label for="fname">First Name:</label>
                                <input type="text" class="form-control" id="fname" placeholder="Enter First Name" 
                                name="fname" value="<?php echo $row['first_name'];  ?>"> 
                            </div>
                            <div class="form-group">
                                <label for="lname">Last Name:</label>
                                <input type="text" class="form-control" id="lname" placeholder="Enter Last Name" 
                                name="lname" value="<?php echo $row['last_name'];  ?>">            
                            </div>
                            <div class="form-group">
                                <label for="sex">Sex</label>
                                <select class="form-control" id="sex" name="sex" value="<?php echo $row['sex'];  ?>">
                                    <option>Male</option>
                                    <option>Female</option>                             
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="text" class="form-control" id="email" placeholder="Enter Your Email" name="email" value="<?php echo $row['email'];  ?>" >                       
                            </div>
                            <div class="form-group">
                                <label for="addr">Your Address:</label>
                                <input type="addr" class="form-control" id="addr" placeholder="Enter First Name" name="addr" value="<?php echo $row['addr'];  ?>" >   
                            </div>
                         <a href="index.php" class="btn btn-primary" style="padding:10px 50px;">Update</a>
                         <a href="index.php" class="btn btn-danger" style="padding:10px 50px;">Cancel</a>
                        
                        </form>                    
                    </div>
                    <div class="col-md-6">
                      <div class="photo"  >Upload Your Photo</div>
                    </div>
                </div>    
    </div>       
</body>
</html>
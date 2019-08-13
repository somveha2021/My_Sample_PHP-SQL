<!DOCTYPE html>
<html lang="en">
<head>
  <title>Employees Details</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  <style>
    .page-header h2{
       background-color: Blue;
       color: white;
       width:50%;
       height:50px;
       text-align:Center;
       padding: 5px 5px;
       border-radius:10px;
       font-family: "Time Newroman";
    }
    .page-header h2:hover{
        background-color: pink;
        color: black;
    } 
    .page-header p{
        color: red;
        font-family: "Monotype Corsiva";
        font-size: 30px;
    }
  
  </style>
</head>
<body>
<div class="container">
   <div class="row">
        <div class="col-md-8">
            <div class="page-header">
            <h2>Employees Details</h2>
            <p>Please Check Your information</p>
            </div>
            <hr>
                <?php
                        include_once('config.php');
                        $id=$_GET['id'];
                        $sqlEmp = "SELECT * FROM employees WHERE id=$id";
                        $result = $pdo->query($sqlEmp);
                            if($result){    
                              
                    ?>
                    <?php 
                        if($result ->rowCount()>0){
                            while($row = $result->fetch()){
                    ?>
                        <h2 style="font-family:Time Newroman">ID: <strong style="color:red"><?php echo $row['id'];?></strong></h2>
                        <h2 style="font-family:Time Newroman">Name: <strong style="color:red"><?php echo $row['name'];?></strong></h2>
                        <h2 style="font-family:Time Newroman">Address: <strong style="color:red"><?php echo $row['addr'];?></strong></h2>
                        <h2 style="font-family:Time Newroman">Salary: <strong style="color:red"><?php echo $row['salary'];?></strong></h2>

                    <?php
                                }
                            }
                        }
                    ?>
                    <hr>
        <a href="index.php" class="btn btn-primary"> Back</a>
        
        </div>
        <div class="col-md-4">
                        <h1>Your Photo</h1>
        
        </div>
   
   
   </div>

</div>
           
            

</body>
</html>


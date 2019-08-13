<?php
$id=$name=$address=$salary='';
include_once('config.php');
$id = $_GET['id'];
?>

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
  .col-md-8{
    font-size:20px;
  }
  h2{
    margin:30px auto;  
    text-align:center;
    background-color:#621765;
    color:white;
    height:50px;
    width:50%;
    padding:10px;
    font-family:"Adobe Heiti Std R";
  }
  </style>
</head>
<body>

<?php
$sql ="SELECT * FROM employees WHERE id=$id";
$result= $pdo->query($sql);
if($result){
    if($result->rowCount() > 0){
        while($row = $result->fetch()){
             $id = $row['id'];
             $name = $row['name'];
             $address = $row['address'];
             $salary = $row['salary'];
             $photo=$row['photo'];
        }
    }
}
?>
<div class="container">
          <h2>Reading Employees Name</h2>
          <div class="row">
            <div class="col-md-4">
              <img style="width:100%;" src="upload/<?php echo $photo; ?>">
            </div>

          <div class="col-md-8"> 
              <div class="form-group">
                <label>ID:</label>
                <p class="form-control-static"><strong style="color:red;"><?php echo $id; ?></strong></p>
              </div>

            <div class="form-group">
              <label>Name:</label>
              <p class="form-control-static"><strong style="color:red;"><?php echo $name; ?></strong></p>
            </div>

            <div class="form-group">
              <label>Address:</label>
              <p class="form-control-static"><strong style="color:red;"><?php echo $address; ?></strong></p>
            </div>

            <div class="form-group">
              <label>Salary:</label>
              <p class="form-control-static"><strong style="color:red;"><?php echo $salary; ?></p>
            </div>


          <p><a href="index.php" class="btn btn-primary">Back</a></p>
          </div>
  
</div>



</body>
</html>
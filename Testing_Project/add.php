<?php
include("db_con.php");
if(isset($_POST["name"]) && isset($_POST["addr"]) && isset($_POST["tel"])){
    @$name = $_POST['name'];
    @$addr = $_POST['addr'];
    @$tel = $_POST['tel'];
$sql = "insert into tb_student(stu_name,stu_addr,stu_tel) values('$name','$addr','$tel')";
$result = mysqli_query($con,$sql);
echo $addr;

}
   

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add new data</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</head>
<div class="container">
    <h1>Add new data</h1>

    <form action="add.php" method="post" class="was-validated">
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" id="name" placeholder="Enter Name" name="name" required>
            <div class="valid-feedback">Valid.</div>
            <div class="invalid-feedback">Please fill out this field.</div>
        </div>
        <div class="form-group">
            <label for="addr">Address:</label>
            <input type="addr" class="form-control" id="addr" placeholder="Enter Address" name="addr" required>
            <div class="valid-feedback">Valid.</div>
            <div class="invalid-feedback">Please fill out this field.</div>
        </div>
        <div class="form-group">
            <label for="tel">Tel:</label>
            <input type="text" class="form-control" id="tel" placeholder="Enter Phone Number" name="tel" required>
            <div class="valid-feedback">Valid.</div>
            <div class="invalid-feedback">Please fill out this field.</div>
        </div>
        <input type="submit" class="btn btn-info" value="ADD">
        <a class="btn btn-secondary" href="index.php">List Data</a>
    </form>
</div>

<body>
    
</body>
</html>
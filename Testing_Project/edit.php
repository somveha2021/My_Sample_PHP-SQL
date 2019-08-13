<?php 
include('db_con.php');
if(isset($_GET["id"]) && !empty($_GET["id"])){
    @$id = $_GET["id"];
    $sql = "select * from tb_student where id= $id";
    $result = mysqli_query($con,$sql);
    // $row = mysqli_fetch_array($result);

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

</head>
<body>
    <div class="container">
        <h1>Edit Data</h1>
        <form action="update.php" method="post" class="was-validated">
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" id="name" placeholder="Enter Name" name="name" required value="<?php echo $row["name"];?>">
            <div class="valid-feedback">Valid.</div>
            <div class="invalid-feedback">Please fill out this field.</div>
        </div>
        <div class="form-group">
            <label for="addr">Address:</label>
            <input type="addr" class="form-control" id="addr" placeholder="Enter Address" name="addr" required value="<?php echo $row["addr"];?>">
            <div class="valid-feedback">Valid.</div>
            <div class="invalid-feedback">Please fill out this field.</div>
        </div>
        <div class="form-group">
            <label for="tel">Tel:</label>
            <input type="text" class="form-control" id="tel" placeholder="Enter Phone Number" name="tel" required value="<?php echo $row["tel"];?>">
            <div class="valid-feedback">Valid.</div>
            <div class="invalid-feedback">Please fill out this field.</div>
        </div>
        <input type="submit" class="btn btn-info" value="UPDATE">
       
    </form>
    
    
    
    </div>



</body>
</html>
<?php
// Include config file
include_once('config.php');
$id=$_GET['id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <title>Update Employees Name</title>
    <style>
    body{
      font-family:"Time Newroman";
    }
    .col-md-8 h2{
      text-align:center;
      background-color:#E724F0;
      color:white;
      height:50px;
      padding:10px;
      border-radius:5px;
    }
    
    </style>
</head>
<body>
          <?php
          // Attempt select query execution
          $sql = "SELECT * FROM employees WHERE id=$id";
          $result = $pdo->query($sql);
          if($result){
          if($result->rowCount() > 0){
            while($row = $result->fetch()){
            
              $id = $row['id'];
              $name = $row['name'];
              $address = $row['address'];
              $salary = $row['salary'];    
                     }
                 }
              }    
          ?>
            <?php
                if(isset($_POST['btnsave'])){
                  $id = $_POST['id'];
                  $name = $_POST['name'];
                  $address = $_POST['address'];
                  $salary = $_POST['salary'];
                // Check input errors before inserting in database
                //if(empty($name_err) && empty($address_err) && empty($salary_err)){
                  // Prepare an update statement
                  $sql = "UPDATE employees SET name=:name, address=:address, salary=:salary WHERE id=:id";
                  if($stmt = $pdo->prepare($sql)){
                      // Bind variables to the prepared statement as parameters
                      $stmt->bindParam(":id", $param_id);
                      $stmt->bindParam(":name", $param_name);
                      $stmt->bindParam(":address", $param_address);
                      $stmt->bindParam(":salary", $param_salary);
                      
                      
                      // Set parameters
                      $param_name = $name;
                      $param_address = $address;
                      $param_salary = $salary;
                      $param_id = $id;
                      
                      // Attempt to execute the prepared statement
                      if($stmt->execute()){
                          // Records updated successfully. Redirect to landing page
                          header("location: index.php");
                          exit();
                      } else{
                          echo "Something went wrong. Please try again later.";
                      }
                  }
                }
            ?>  
  <div class="container">
      <div class="row">
          <div class="col-md-4">
                <h2>Your Photo</h2>
          </div>
          <div class="col-md-8">
              <h2 style>Update Employees Name</h2>
              <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                  <div class="form-group">
                      <label for="name">Name:</label>
                      <input type="text" class="form-control" id="name" name="name" value="<?php echo $name; ?>">
                      <span class="help-block"></span>
                  </div>
                  <div class="form-group">
                      <label for="address">Address:</label>
                      <textarea class="form-control" id="address" name="address"><?php echo $address; ?></textarea>
                      <span class="help-block"></span>
                  </div>
                  <div class="form-group">
                      <label for="salary">Salary:</label>
                      <input type="text" class="form-control" id="salary" name="salary" value="<?php echo $salary; ?>">
                      <span class="help-block"></span>
                  </div>
                  <input type="hidden" name="id" value="<?php echo $id; ?>">
                  <button type="submit" class="btn btn-primary" name="btnsave">Update</button>
                  <a href="index.php" class="btn btn-danger">Cancel</a>
            </form>
          </div>
      </div>
  </div>
</body>
</html>
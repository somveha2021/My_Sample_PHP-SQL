<?php
                        include_once('config.php');
                        $id=$_GET['id'];
                        $sql = "SELECT * FROM employees WHERE id=$id";
                        $result = $pdo->query($sql);
                            if($result){    
            
                        if($result ->rowCount()>0){
                            while($row = $result->fetch()){
                               $id=$row['id'];
                               $name=$row['name'];
                               $address=$row['addr'];
                               $salary=$row['salary'];
                                }
                            }
                        }
                    ?>
        <?php
if(isset($_POST['save'])){
    $id=$_POST['id'];
    $name=$_POST['name'];
    $address=$_POST['address'];
    $salary=$_POST['salary'];
     // Prepare an update statement
     $sql = "UPDATE employees SET name=:name, addr=:address, salary=:salary WHERE id=:id";
 
     if($stmt = $pdo->prepare($sql)){
         // Bind variables to the prepared statement as parameters
         $stmt->bindParam(":name", $param_name);
         $stmt->bindParam(":address", $param_address);
         $stmt->bindParam(":salary", $param_salary);
         $stmt->bindParam(":id", $param_id);
         
         // Set parameters
         $param_name = $name;
         $param_address = $address;
         $param_salary = $salary;
         $param_id = $id;
         
         //Attempt to execute the prepared statement
         if($stmt->execute()){
             // Records updated successfully. Redirect to landing page
             header("location: index.php");
             exit();
         } else{
             echo "Something went wrong. Please try again later.";
         }
     }
    }
    // Close statement
    unset($stmt);
 // Close connection
 unset($pdo);
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
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-8">
        <h2>Update Employees List</h2>
        <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                <div class="form-group">
                <label for="Name">Name:</label>
                <input type="text" class="form-control" id="text" placeholder="Enter Name" name="name" value="<?php echo $name;?>">
                </div>
                <div class="form-group">
                <label for="address">Address:</label>
                <input type="address" class="form-control" id="address" placeholder="Enter address" name="address"value="<?php echo $address;?>" >
                </div>
                <div class="form-group">
                <label for="salary">Salary:</label>
                <input type="text" class="form-control" id="salary" placeholder="Enter Salary" name="salary"value="<?php echo $salary;?>">
                </div>
                <input type="hidden" name="id"value="<?php echo $id;?>">
                <div class="checkbox">
                <label><input type="checkbox" name="remember"> Remember me</label>
                </div>
                <input type="submit" name="save" class="btn btn-success" value="Update">
               <a href="index.php" class="btn btn-danger">Back</a>
            </form>
        </div>            
        <div class="col-md-4">
                    <h1>Pictiure Upload</h1>
        </div>
    </div>
</div>
</body>
</html>


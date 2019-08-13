<?php
	// Include config file
 include_once('config.php'); 
	$name=$address=$salary="";
	$name_err=$address_err=$salary_err="";
	
	
// Processing form data when form is submitted
		if($_SERVER["REQUEST_METHOD"]=="POST"){
		
		// Validate name
			$input_name = trim($_POST["name"]);
				if(empty($input_name)){
				$name_err = "Pleas enter an name";
			}else{
				$name = $input_name;
			}
			
			// Validate address
			$input_address = trim($_POST["address"]);
			if(empty($input_address)){
				$address_err = "Pleas enter an name";
			}else{
				$address = $input_address;
			}
			
			// Validate salary
			$input_salary = trim($_POST["salary"]);
			if(empty($input_salary)){
				$salary_err = "Pleas enter an name";
			}else{
				$salary = $input_salary;
			}
						
		
		 // ត្រួតពិនិត្យ​ error មុន​ពេល​បញ្ចូល​ទិន្ន​ន័យ​ទៅ​ក្នុង​ table user
		if(empty($name_err)&& empty($address_err)&& empty($salary_err)){
			
			
			//Upload Image		
						
				// Check if file was uploaded without errors
				if(isset($_FILES["photo"]) && $_FILES["photo"]["error"] == 0){
					$allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
					$filename = $_FILES["photo"]["name"];
					$filetype = $_FILES["photo"]["type"];
					$filesize = $_FILES["photo"]["size"];
				
					// Verify file extension
					$ext = pathinfo($filename, PATHINFO_EXTENSION);
					if(!array_key_exists($ext, $allowed)) die("Error: Please select a valid file format.");
				
					// Verify file size - 5MB maximum
					$maxsize = 5 * 1024 * 1024;
					if($filesize > $maxsize) die("Error: File size is larger than the allowed limit.");
				
					// Verify MYME type of the file
					if(in_array($filetype, $allowed)){
						// Check whether file exists before uploading it
						if(file_exists("upload/" . $filename)){
							echo $filename . " is already exists.";
						} else{
							move_uploaded_file($_FILES["photo"]["tmp_name"], "upload/" . $filename);
						   // echo "Your file was uploaded successfully.";
						} 
					} else{
						echo "Error: There was a problem uploading your file. Please try again."; 
					}
				} else{
					echo "Error: " . $_FILES["photo"]["error"];
				}
			
			// End Upload Image			
			
			// Prepare an insert statement
			$sql = "INSERT INTO employees (name,address,salary,photo) VALUES (:name,:address,:salary,:photo)" ;
			
			if($stmt = $pdo->prepare($sql)){
				
				// Bind variables to the prepared statement as parameters
				   $stmt->bindParam(":name", $param_name);
				   $stmt->bindParam(":address", $param_address);
				   $stmt->bindParam(":salary", $param_salary);
				   $stmt->bindParam(":photo", $param_photo);
				   
				         // Set parameters
						 $param_name = $name;
						 $param_address = $address;
						 $param_salary = $salary;
						 $param_photo =$filename;
					
						 // Attempt to execute the prepared statement
				  if($stmt->execute()){
					// Records created successfully. Redirect to landing page
					header("location: index.php");
					exit();
					// echo "Hello Success !";
				} else{
					echo "Something went wrong. Please try again later.";
				}
				   
			}
			  // Close statement
        unset($stmt);
			
		}
	// 	   // Close connection
     unset($pdo);
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>New Employees</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

  <style type="text/css">
    
        
        .page-header a{
            margin-top: 12px;
            font-family:"Time Newroman";
        }
       
    </style>
</head>
<body>
<div class="wrapper">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="page-header clearfix">
                <a href="#"class="btn btn-success"><h2>Insert New Employees</h2></a>
				</div>
                    <form action="create.php" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="name"><b>Name:</b></label>
                            <input type="text" class="form-control" id="name" placeholder="Pleas enter name" name="name" required>
                            <div class="valid-feedback">Valid.</div>
                            <div class="invalid-feedback">Please enter name again.</div>
                        </div>
                        <div class="form-group">
                            <label for="address"><b>Address:</b></label>
                            <input type="text" class="form-control" id="address" placeholder="Pleas enter address" name="address" required>
                            <div class="valid-feedback">Valid.</div>
                            <div class="invalid-feedback">Please enter address again.</div>
                        </div>
                        <div class="form-group">
                            <label for="salary"><b>Salary:</b></label>
                            <input type="text" class="form-control" id="salary" placeholder="Pleas enter salary" name="salary" required>
                            <div class="valid-feedback">Valid.</div>
                            <div class="invalid-feedback">Please enter salary again.</div>
                        </div>
                        <div class="form-group">
                            <label for="salary">Image Profile:</label>
                            <input type="file" name="photo" id="fileSelect">
                        </div>
						<div class="form-group">
						<input type="submit" class="btn btn-success"value="Submit">
                        <a href="index.php" class="btn btn-danger">Back</a>
						</div>	                      
                    </form>
            </div>
            <div class="col-md-6">
                <h2>Please Upload Your Photo</h2>
            </div>
        </div>
    </div>
</div>
</div>

</body>
</html>
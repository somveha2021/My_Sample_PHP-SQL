<?php 
// Connect to Database
include_once('config.php'); 
$fname=$lname=$email=$password="";
$lname_err=$fname_err=$email_err=$password_err="";
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
   
    // Validate address
    $input_fname = trim($_POST["fname"]);
    if(empty($input_fname)){
        $fname_err = "Please enter an Last Name.";     
    } else{
        $fname = $input_fname;
    }
    // Validate address
    $input_lname = trim($_POST["lname"]);
    if(empty($input_lname)){
        $lname_err = "Please enter an Last Name.";     
    } else{
        $lname = $input_lname;
    }
    // Validate address
    $input_email = trim($_POST["email"]);
    if(empty($input_email)){
        $email_err = "Please enter an Email.";     
    } else{
        $email = $input_email;
    }
    // Validate address
    $input_password = trim($_POST["pass"]);
    if(empty($input_password)){
        $password_err = "Please enter password.";     
    } else{
        $password = $input_password;
    }
    // ត្រួតពិនិត្យ​ error មុន​ពេល​បញ្ចូល​ទិន្ន​ន័យ​ទៅ​ក្នុង​ table user
    if(empty($fname_err) && empty($lname_err) && empty($email_err) && empty($password_err)){
    // Prepare an insert statement
        $sql = "INSERT INTO users_tb (first_name, last_name,email, password) VALUES (:fname,:lname,:email,:pass)";
 
        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":fname", $param_fname);
            $stmt->bindParam(":lname", $param_lname);
            $stmt->bindParam(":email", $param_email);
            $stmt->bindParam(":pass", $param_password);
            
            // Set parameters
            $param_fname = $fname;
            $param_lname = $lname;
            $param_email = $email;
            $param_password=$password;
            
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
    // Close connection
    unset($pdo);
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <title>Create new user</title>

    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>

</head>
<body>
<div class="wrapper">
<div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
            <h3>Insert New User</h3>
            <hr>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">   
                    <div class="form-group">
                        <label>First Name</label>
                        <input type="text" name="fname" class="form-control">  
                        <span><?php echo $fname_err; ?></span>                  
                    </div>
                    <div class="form-group">
                        <label>Last Name</label>
                        <input type="text" name="lname" class="form-control"> 
                        <span class="help-block"><?php echo $lname_err;?></span>                   
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="mail" name="email" class="form-control">                    
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="pass" class="form-control">                    
                    </div>


                  

                    <!-- <input type="submit" class="btn btn-primary" value="Save"> -->
                    <input type="submit" class="btn btn-primary" value="Submit">
                    <a href="index.php" class="btn btn-default">Cancel</a>
    
                </form>          
            
            </div>    
        
        </div>

</div>
</div>





    

    



</body>
</html>
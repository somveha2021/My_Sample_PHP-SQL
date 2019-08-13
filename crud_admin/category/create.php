<?php 
// Include config file
include_once('config.php');
include_once ('config/session.php'); 
// Save Category
$cname=$icon="";
$cname_err=$icon_err="";
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
   
    // Validate address
    $input_cname = trim($_POST["cname"]);
    if(empty($input_cname)){
        $cname_err = "Please enter an Category.";     
    } else{
        $cname = $input_cname;
    }
    // Validate address
    $input_icon = trim($_POST["icon"]);
    if(empty($input_icon)){
        $icon_err = "Please enter an Last Name.";     
    } else{
        $icon = $input_icon;
    }
    // ត្រួតពិនិត្យ​ error មុន​ពេល​បញ្ចូល​ទិន្ន​ន័យ​ទៅ​ក្នុង​ table user
    if(empty($cname_err) && empty($icon_err)){
    // Prepare an insert statement
        $sql = "INSERT INTO category (name, icon,status) VALUES (:cname,:icon,:status)";
 
        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":cname", $param_cname);
            $stmt->bindParam(":icon", $param_icon);
            $stmt->bindParam(":status", $param_status);
      
            
            // Set parameters
            $param_cname = $cname;
            $param_icon = $icon;
            $param_status = trim($_POST["status"]);
           
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Records created successfully. Redirect to landing page
                header("location: ../home.php?page=category&frm=index");
                exit();
                // echo "Hello Success !";
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        // unset($stmt);
    }
    // Close connection
    // unset($pdo);
}
?>



<h1 class="h3 mb-2 text-gray-800">Create Category</h1>                            
<form action="category/create.php" method="post">   
    <div class="form-group">
        <label>Category Name</label>
        <input type="text" name="cname" class="form-control">  
        <span><?php echo $cname_err; ?></span>                  
    </div>
    <div class="form-group">
        <label>Icon</label>
        <input type="text" name="icon" class="form-control"> 
        <span class="help-block"><?php echo $icon_err;?></span>                   
    </div>
    <div class="form-group">
        <label>Status</label>
    <select name="status" id="status" class="form-control">
        <option value="1">Active</option>
        <option value="0">Disactive</option>

    </select>
                                            
    </div>
                                     

                  

    <!-- <input type="submit" class="btn btn-primary" value="Save"> -->
    <input type="submit" class="btn btn-primary" value="Create">
    <a href="index.php" class="btn btn-default">Cancel</a>
    
</form>



<script>
// Disable form submissions if there are invalid fields
(function() {
'use strict';
window.addEventListener('load', function() {
    // Get the forms we want to add validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
    form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {
        event.preventDefault();
        event.stopPropagation();
        }
        form.classList.add('was-validated');
    }, false);
    });
}, false);
})();
</script>
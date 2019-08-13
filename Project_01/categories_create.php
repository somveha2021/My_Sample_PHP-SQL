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
                header("location: categories.php");
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
  <title>Create Category</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Custom fonts for this template -->
<link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

<!-- Custom styles for this template -->
<link href="css/sb-admin-2.min.css" rel="stylesheet">

<!-- Custom styles for this page -->
<link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">


  <style type="text/css">
    
        
        .page-header a{
            margin-top: 12px;
            font-family:"Time Newroman";
        }
       
    </style>
</head>
<body>
<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    <?php include_once('includes/sidebar.php'); ?>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <?php include_once('includes/topbar.php'); ?>
            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid">
        
                <div class="row">
                    <div class="col-md-6">
                        <div class="page-header clearfix">
                            <a href="#"class="btn btn-success"><h2>Insert New Categories</h2></a>
                        </div>
                            <form action="create.php" method="POST" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="cname"><b>Categorees Name:</b></label>
                                    <input type="text" class="form-control" id="cname" placeholder="Pleas enter category name" name="cname" required>
                                    <div class="valid-feedback">Valid.</div>
                                    <div class="invalid-feedback">Please enter category name again.</div>
                                </div>
                                <div class="form-group">
                                    <label for="icon"><b>Icon:</b></label>
                                    <input type="text" class="form-control" id="icon" placeholder="Pleas enter Icon" name="icon" required>
                                    <div class="valid-feedback">Valid.</div>
                                    <div class="invalid-feedback">Please enter icon again.</div>
                                </div>
                                <div class="form-group">
                                                    <label>Status</label>
                                                <select name="status" id="status" class="form-control">
                                                    <option value="1">Active</option>
                                                    <option value="0">Disactive</option>

                                                </select>
                                                    
                                                </div>
                            
                            
                                <div class="form-group">
                                <input type="submit" class="btn btn-success"value="Submit">
                                <a href="categories.php" class="btn btn-danger">Back</a>
                                </div>	                      
                            </form>
                    </div>
                    <div class="col-md-6">
                        <h2>Categories List</h2>
                    </div>
                    </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
            <div class="copyright text-center my-auto">
                <span>Copyright &copy; Your Website 2019</span>
            </div>
            </div>
        </footer>
        <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Bootstrap core JavaScript-->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="vendor/datatables/jquery.dataTables.min.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script src="js/demo/datatables-demo.js"></script>
</body>
</html>
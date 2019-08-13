<?php 
// Include config file
include_once('config.php');
include_once ('config/session.php'); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>CRUD ADMIN</title>
    <?php include_once('style.php'); ?>
</head>
<body>
<!-- Header -->
    <?php include_once('header.php'); ?>
<!-- End Header -->

<!-- Nav -->
    <?php include_once('nav.php'); ?>
<!-- End Nav -->
<div class="container" style="margin-top:10px">
    <div class="row">
        <!-- Left Slidebar -->
            <?php include_once('sidebar.php'); ?>
        <!-- End Left Sidebar -->

        <div class="col-sm-8">    

            <?php 
                $page=$frm="";
                @$page=$_GET['page'];  
                @$frm=$_GET['frm']; 
                if(file_exists('home.php')){
                    if (file_exists($page)) {
                        if(file_exists($page.'/'.$frm.'.php')){
                            include_once($page.'/'.$frm.'.php');
                        }else {
                            echo "File $frm not exist.";
                        }
                    } else {
                        echo "The directory $page not exists.";
                    }
                }                
                                
            ?>  
            <br>
        </div>

    </div>
</div>
<!-- Footer -->
    <?php include_once('footer.php'); ?>
<!-- End Footer -->

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
<?php 
// Include config file
include_once('config.php');
include_once ('config/session.php'); 
?>
<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="">
<meta name="author" content="">

<title>All Categories</title>

<!-- Custom fonts for this template -->
<link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

<!-- Custom styles for this template -->
<link href="css/sb-admin-2.min.css" rel="stylesheet">

<!-- Custom styles for this page -->
<link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">




<style type="text/css">
    .wrapper{
        width: 650px;
        margin: 0 auto;
    }
    .page-header h2{
        margin-top: 0;
    }
    table tr td:last-child a{
        margin-right: 15px;
    }
</style>
<script type="text/javascript">
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();   
    });
</script>

</head>

<body id="page-top">

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

            <!-- Page Heading -->
            <!-- <h1 class="h3 mb-2 text-gray-800">Tables</h1> -->
            

            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                <h4 class="m-0 font-weight-bold text-primary float-left">Category List</h4>
                <!-- <a  class="float-right"href="">Add New</a> -->
                <a href="categories_create.php" class="btn btn-success btn-sm btn-icon-split float-right">
                    <span class="icon text-white-50">
                    <i class="fas fa-plus"></i>
                    </span>
                    <span class="text">Add New Category</span>
                </a>


                </div>
                <div class="card-body">
                <div class="table-responsive">
                
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <?php
                    // Attempt select query execution
                    $sql = "SELECT * FROM category";
                    $result = $pdo->query($sql);
                    if($result){
                    if($result->rowCount() > 0){
                    ?>

                    <thead>
                        <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Icon</th>
                    
                        <th>Action</th>
                        </tr>
                    </thead>

                    <tfoot>
                        <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Icon</th>
                    
                        <th>Action</th>
                        </tr>
                    </tfoot>

                    <tbody>
                        <?php
                        while($row = $result->fetch()){
                        ?>    
                            <tr class="success">
                                <td><?php echo $row['category_id']?></td>
                                <td><a href="read.php?id=<?php echo $row['category_id']; ?>" title='Detail <?php echo $row['name']?>' data-toggle='tooltip' ><?php echo $row['name']?></a></td>
                                <td><?php echo $row['icon']?></td>
                                
                                <td>
                                    <a href="read.php?id=<?php echo $row['category_id']; ?>" class="btn btn-info btn-circle btn-sm">
                                        <i class="fas fa-info-circle"></i>
                                    </a>
                                    <!-- <a href="read.php?id=<?php echo $row['category_id']; ?>" title='View Record' data-toggle='tooltip'><span class='glyphicon glyphicon-eye-open'></span> Read</a> -->
                                    <!-- <a href="update.php?id=<?php echo $row['category_id']; ?>" title='Update Record' data-toggle='tooltip'><span class='glyphicon glyphicon-pencil'></span>Update</a> -->
                                    <a href="update.php?id=<?php echo $row['category_id']; ?>" class="btn btn-success btn-circle btn-sm">
                                        <i class="fas fa-check"></i>
                                    </a>
                                    <a class='btn btn-danger btn-circle btn-sm' href="delete.php?id=<?php echo $row['category_id']; ?>" title='Delete Record' data-toggle='tooltip'><i class="fas fa-trash"></i></a>
                                </td>

                            </tr>
        
                            <?php
                        }
                        }
                    }
        
                                        // Close connection
                                        unset($pdo);
                        ?>
                        </tbody>


                    </table>
                </div>
                </div>
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

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>
<!-- Logout Modal-->
<?php include_once('includes/logout_model.php') ?>

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
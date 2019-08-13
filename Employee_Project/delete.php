<?php
        include("db_con.php");
            if(isset($_GET['id']) && !empty($_GET['id'])){
                $id = $_GET['id'];
     // sql to delete a record
            
            $sql = "DELETE FROM main_tb WHERE id=$id";

            if (mysqli_query($con, $sql)) {
                // echo "Record deleted successfully";
            } else {
                echo "Error deleting record: " . mysqli_error($con);
            }
            mysqli_close($con);
           
            }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Record</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 700px;
            margin: 0 auto;
        }
       
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h1>Delete Record</h1>
                    </div>
                    <form action="delete.php" method="post">
                        <div class="alert alert-danger fade in">
                            <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>"/>
                            <h2>Your Record has been Deleted successfully</h2><br>
                            
                            <h3>
                                <a href="index.php" class="btn btn-success">OK</a>         
                                
                            </h3>
                        </div>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>
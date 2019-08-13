<?php
// Include config file
include_once('config.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Employees List</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

   <style type="text/css">
        body{
          font-family:"Time Newroman";
        }
        /* .wrapper{
            width: 650px;
            margin: 0 auto; */
        }
        /* .page-header h2{
            margin-top: 0; */
        }
        table tr td:last-child a{
            margin-right: 15px;
        }
        .wrapper .page-header h2{
          background-color: #CD3818;
          width:30%;
          height:50px;
          padding:10px;
          text-align: center;
          border-radius: 5px;
          color: white;
          font-size:32px;
        }
        .wrapper .page-header a{
          padding:10px;
          color: white;
          font-size:18px;
        }
        
    </style>
    <script type="text/javascript">
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
        });
    </script>
</head>
<body>
<div class="wrapper">
    <div class="container">
        <div class="page-header clearfix">
            <h2 class="pull-left">Employees List</h2>
            <a href="create.php" class="btn btn-primary pull-right">Add Employees</a>
        </div>
        <div class="tbl-employee">
            <table class="table">
                <?php
                  // Attempt select query execution
                  $sql = "SELECT * FROM employees";
                  $result = $pdo->query($sql);
                  if($result){
                    if($result->rowCount() > 0){
                ?>
                <thead > 
                  <tr class="info" style="font-size:14px  ">
                    <th>ID</th>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Salary</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                   while($row = $result->fetch()){
                ?>    
                  <tr>
                    <td><?php echo $row['id']?></td>
                    <td><a href="read.php?id=<?php echo $row['id']; ?>" title='Detail <?php echo $row['name']?>' data-toggle='tooltip' ><img style="width:32px;" src="upload/<?php echo $row['photo']?>"> <?php echo $row['name']?></a></td>
                    <td><?php echo $row['address']?></td>
                    <td><?php echo $row['salary']?></td>
                    <td>
                    <a href="read.php?id=<?php echo $row['id']; ?>" title='View Record' data-toggle='tooltip'><span class='glyphicon glyphicon-eye-open'></span></a>
                    <a href="update.php?id=<?php echo $row['id']; ?>" title='Update Record' data-toggle='tooltip'><span class='glyphicon glyphicon-pencil'></span></a>
                    <a href="delete.php?id=<?php echo $row['id']; ?>" title='Delete Record' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a>
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
</body>
</html>
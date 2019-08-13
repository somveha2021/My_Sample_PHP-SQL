<!DOCTYPE html>
<html lang="en">
<head>
  <title>Employees List</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<body>
<div class="wrpper">
<div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="page-header clearfix">
                    <h1 class="pull-left">Employees List</h1>
                    <a href="add.php" class="btn btn-primary pull-right"> Add Employees</a>
                </div>
            
            
        <table class="table">
            <?php
                include_once('config.php');
                $sqlEmp = "SELECT * FROM employees";
                $result = $pdo->query($sqlEmp);
                    if($result){    
            ?>
            <thead>
                <tr class="info">
                    <th>ID</th>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Salary</th>
                    <th>Action</th>
                </tr>
            </thead>
           
            <tbody>
            <?php 
                if($result ->rowCount()>0){
                    while($row = $result->fetch()){
            ?>
                    
                <tr>
                    <td><?php echo $row['id'] ?></td>
                    <td><?php echo $row['name'] ?></td>
                    <td><?php echo $row['addr'] ?></td>
                    <td><?php echo $row['salary'] ?></td>
                    <th>
                    
                    <a href='read.php?id="<?php echo  $row['id'];?>"' title='View Record' data-toggle='tooltip'><span class='glyphicon glyphicon-eye-open'></span></a>
                    <a href='update.php?id="<?php echo $row['id'];?>"' title='Update Record' data-toggle='tooltip'><span class='glyphicon glyphicon-pencil'></span></a>
                    <a href='delete.php?id="<?php echo $row['id'];?>"' title='Delete Record' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a>
                    
                    </th>
                </tr> 
            </tbody>
            <?php
                        }
                    }
                }
            ?>
         </table>
         </div>
        </div>
            
</div>
</div>
</body>
</html>


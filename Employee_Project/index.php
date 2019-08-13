<?php
//Connect to Database
    include("db_con.php");
//Select To Table
    $sql ="select * from main_tb";
//Execute On Table
    $result = mysqli_query($con,$sql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Employee List</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Employee List</h1>
           <a href="create.php" class="btn btn-success" style="margin-left:900px;">Add New Employee</a> 
           <hr> 
                <table class="table table-hover table-bordered">
                    <thead>
                         <tr>
                            <th>ID</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Sex</th>
                            <th>Email</th>
                            <th>Address</th>
                            <th>Option</th>
                         </tr>
                     
                    </thead>
                    <tbody>
                    
                    <?php   
            //Loop record in table
        while($row = mysqli_fetch_array($result)){
                        echo "<tr>";
                            echo "<td>". $row["id"]."</td>";
                            echo "<td>". $row["first_name"]."</td>";
                            echo "<td>". $row["last_name"]."</td>";
                            echo "<td>". $row["sex"]."</td>";
                            echo "<td>". $row["email"]."</td>";
                            echo "<td>". $row["addr"]."</td>";
                            echo "<td>";
                                echo "<a href='view.php?id=". $row["id"]."'><button class='btn btn-primary' style='margin-right:10px';>View</button></a>";
                                echo "<a href='edit.php?id=". $row["id"]."'><button class='btn btn-success' style='margin-right:10px';>Edit</button></a>";
                                echo "<a href='delete.php?id=". $row["id"]."'><button class='btn btn-danger' style='margin-right:10px';>Delete</button></a>";
                            echo "</td>";
                        echo "</tr>";
                    }
                     ?>
                    </tbody>
                </table>
        </div>
    </div>
</div>  
</body>
</html>
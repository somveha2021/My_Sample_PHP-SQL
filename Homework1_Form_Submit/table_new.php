<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>
<body>
                <?php    
                     @$sid=$_GET['sid'];
                     @$sname=$_GET['sname'];
                     @$sgender=$_GET['sgender'];
                     @$sdob=$_GET['sdob'];
                     @$spob=$_GET['spob'];
                ?>



<div class="container">
  <h2>Information Of Student</h2>
       
  <table class="table table-hover table-bordered">
    <thead>
      <tr>
        <th>Studnet ID</th>
        <th>Student Name</th>
        <th>Gender</th>
        <th>Date Of birth</th>
        <th>Place Of birth</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td><?php echo $sid ?></td>
        <td><?php echo $sname ?></td>
        <td><?php echo $sgender ?></td>
        <td><?php echo $sdob ?></td>
        <td><?php echo $spob ?></td>
      </tr>
      
    </tbody>
  </table>
</div>

</body>
</html>

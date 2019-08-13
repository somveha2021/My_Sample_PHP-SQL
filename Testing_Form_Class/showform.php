<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">

<style>
.table-dark {
  color: #fff;
  background-color: #663300;
}

.table-dark th,
.table-dark td,
.table-dark thead th {
  border-color: #FF860D;
}
h1{
    text-align: center;
}

</style>
</head>
<body>

<?php 
@$Username=$_GET['Username'];
@$email=$_GET['email'];
@$password=$_GET['password'];
@$password=$_GET['password'];


?>
<div class="container">
  <h1>Your Information Here</h1>
 
<table class="table table-dark">
  <thead>
    <tr>
      <th>USER NAME</th>
      <th>EMSIL</th>
      <th>PASSWORD</th>
      <th>COMFIRM PASSWORD</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row"><?php echo $Username ?></th>
      <td><?php echo  $email ?></td>
      <td><?php echo $password ?></td>
      <td><?php echo $password ?></td>
    </tr>
    <tr>
    <th scope="row"><?php echo $Username ?></th>
      <td><?php echo  $email ?></td>
      <td><?php echo $password ?></td>
      <td><?php echo $password ?></td>
    </tr>
    <tr>
    <th scope="row"><?php echo $Username ?></th>
      <td><?php echo  $email ?></td>
      <td><?php echo $password ?></td>
      <td><?php echo $password ?></td>
    </tr>
    <tr>
    <th scope="row"><?php echo $Username ?></th>
      <td><?php echo  $email ?></td>
      <td><?php echo $password ?></td>
      <td><?php echo $password ?></td>
    </tr>
    <tr>
    <th scope="row"><?php echo $Username ?></th>
      <td><?php echo  $email ?></td>
      <td><?php echo $password ?></td>
      <td><?php echo $password ?></td>
    </tr>
    <tr>
    <th scope="row"><?php echo $Username ?></th>
      <td><?php echo  $email ?></td>
      <td><?php echo $password ?></td>
      <td><?php echo $password ?></td>
    </tr>            
  </tbody>
</table>

</div>
</body>
</html>


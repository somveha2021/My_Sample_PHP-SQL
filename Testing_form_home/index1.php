<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Testing Database</title>
</head>
<body>
<?php
$con = mysqli_connect("localhost","root","","db_student");
 if(!$con){
     die (" Connection Failed");
 }else{
     echo ("Connection Successfully!");
 }

 $sql = "select std_id,std_name,std_pob,std_dob from tb_student";
 $result =mysqli_query ($con,$sql);

while($row = mysqli_fetch_assoc($result)){
    echo "ID".$row["std_id"];
    echo "Name".$row["std_name"];
    echo "POB".$row["std_pob"];
    echo "DOB".$row["std_dob"];
}



?>
    






</body>
</html>
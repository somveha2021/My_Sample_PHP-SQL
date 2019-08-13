<?php 
include("db_con.php");
if(!empty($_POST['id'])){
    @$id =$_POST['id'];
    @$fname =$_POST['fname'];
    @$lname =$_POST['lname'];
    @$sex =$_POST['sex'];
    @$email =$_POST['email'];
    @$addr =$_POST['addr'];

    $sql = " update main_tb set first_name = '$fname',last_name = '$lname' , sex ='$sex', email ='$email' , addr = '$addr' where id = $id";
    mysqli_query($con,$sql);
    header("location: index.php");
        }
    ?>
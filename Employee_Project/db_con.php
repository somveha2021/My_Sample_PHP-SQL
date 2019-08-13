<?php 
define("HOSTNAME","localhost");
define("USERNAME","root");
define("PASSWORD","");
define("DBNAME","employee_db");


$con = mysqli_connect(HOSTNAME,USERNAME,PASSWORD,DBNAME);
    if(!$con){
        die("Connection Failed");
    }
?>


<?php 
define("HOSTNAME","localhost");
define("USERNAME","root");
define("PASSWORD","");
define("DBNAME","db_student");


$con = mysqli_connect(HOSTNAME,USERNAME,PASSWORD,DBNAME);
    if(!$con){
        die("Connection Failed");
    }
?>
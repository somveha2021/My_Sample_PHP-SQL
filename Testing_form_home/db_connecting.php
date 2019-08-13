
<?php

define("HOSTNAME","localhost");

define("USERNAME","root");

define("PASSWORD","");

define("DBNAME","somveha");


$con = mysqli_connect(HOSTNAME,USERNAME,PASSWORD,DBNAME);
  if(!$con){
        die("Connecting Failed");
}else{
    echo "Connecting Has Successfully!";
}

$sql = "insert into tb_student (name,tel,address) values ('reaksa','099788787','PP');";
mysqli_query($con,$sql);
 echo " </br>  Record Complated!";

?>
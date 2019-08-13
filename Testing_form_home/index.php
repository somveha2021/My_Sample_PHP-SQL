<?php   
    if(isset($_POST['username'])  && isset($_POST['password'])){

        if(@!empty($_POST['username']) && @!emty($_POST['password'])){
            @$user=$_POST['username'];
            @$pwd=$_POST['password'];
             if($user="somveha" && $pwd="123"){
                 header("location:sample/Testing_form_home/success_form.php");
             }else {
                 echo "incorrect username and password";
             }
        }
    }



?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PHP Sample From ReanIT YouTube</title>
</head>
<body>
    <h1>Please Enter UserName and Password!</h1>
    <form action="index.php" method="Post">
        <input type="text"  name="username" placeholder="Enter Username"/>
        <input type="password" name="password" placeholder="Enter Password"/>
        <input type="submit" value="Login"/>
    
    </form>



</body>
</html>
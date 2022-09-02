<?php

session_start();
if(!isset($_SESSION['registersuccess']))
{
    header('Location:index.php');
    exit();
}
else
{
 unset($_SESSION['registersuccess']);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    
    <div class="container23">
    <h1>QUIZZER</h1> 
    <h1>Thanks for joining us!</h1>
    <a href="index.php">Log in now!</a>
    </div>

</body>
</html>
<style>
    .container23{
        
        margin-top:230px;
        display:flex;
        justify-content:center;
        align-items:center;
        flex-direction:column;

    }
    a:link{
    color:black;
    text-decoration:none;
    font-size:20px;
    background-color:rgb(117, 230, 255);
    padding:10px;
    color:white;
    margin:20px;
    border-radius:10px;
    }
    a:visited{
    color:white;
    }
    h1{
        margin:10px;
    }
</style>

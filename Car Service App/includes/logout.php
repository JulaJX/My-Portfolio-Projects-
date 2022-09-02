<?php
/*Zamykanie sesji sledzenia zalogowania skutkujące przekierowaniem na index.php i wylogowaniem użytkownika*/
session_start();    
unset($_SESSION['userid']);
unset($_SESSION['useremail']);
unset($_SESSION['username']);
unset($_SESSION['userphone']);
unset($_SESSION['error']);
if(isset($_SESSION['instance'])){unset($_SESSION['instance']);}
if(isset($_SESSION['instance2'])){unset($_SESSION['instance2']);}
if(isset($_SESSION['instance3'])){unset($_SESSION['instance3']);}
unset($_SESSION['logged']);
header('Location:../index.php');
/*---------------------------------------------------------------------------------------------------------*/
?>
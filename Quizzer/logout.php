<?php
/*Zamykanie sesji sledzenia zalogowania skutkujące przekierowaniem na index.php i wylogowaniem użytkownika*/
session_start();    
unset($_SESSION['logged']);
header('Location:index.php');
/*---------------------------------------------------------------------------------------------------------*/
?>
<?php
$dbHostName= "sql4.5v.pl";
$dbHostUser="julekpro100_quizerphpjj";
$dbHostPasswd="reah5jgz2u";
$dbName="julekpro100_quizerphpjj";
// $dbHostName= "localhost";
// $dbHostUser="root";
// $dbHostPasswd="";
// $dbName="quizbaza";

$mysqli = new mysqli($dbHostName, $dbHostUser, $dbHostPasswd,$dbName);

if($mysqli->connect_error){
    printf("connect failed: %s\n",$mysqli->connect_error);
    exit();
}


?>
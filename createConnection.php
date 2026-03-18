<?php

$servername="localhost";//assigning servername
$username= "root";      //"root" for common users
$password= "";          //No password
$dbname= "JotWise";   //assign database named "JotWise"

$conn= new mysqli($servername, $username, $password, $dbname);
//Creating connection with existing database named "JotWise"

if($conn!= true)
{
    die("Connection Failed.");
    //print string before exiting
}
?>
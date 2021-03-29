<?php 

$servername = "localhost";
$username = "root";
$password = "";
$database = "notes";

// creating connection

$conn = mysqli_connect($servername,$username,$password,$database);

if(!$conn){
    die("sorry, failed to connect ".mysqli_connect_error());
}



?>
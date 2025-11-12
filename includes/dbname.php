<?php
$server="localhost";
$username="root";
$password="";
$dbname="cms";

$conn=mysqli_connect($server,$username,$password,$dbname);
if(!$conn){
    echo "not connect with the server";
}

?>
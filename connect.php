<?php
$host="localhost";
$user="root";
$pass="";
$dbname="WCR";

$conn=new mysqli( $host, $user, $pass);

if($conn->connect_error)
{
    die("connection failed: ".$conn->connect_error);
}
$sql="CREATE DATABASE IF NOT EXISTS $dbname";
$conn_res=$conn->query($sql);
if(!$conn_res)
{
    echo "error creating database";
}
$conn->select_db($dbname);
$sql="CREATE TABLE IF NOT EXISTS user(
user_id int(15) PRIMARY KEY AUTO_INCREMENT,
username VARCHAR(20) NOT NULL,
phoneno INT(10) NOT NULL,
email VARCHAR(100) NOT NULL,
password VARCHAR(20) NOT NULL)";
if($conn->query($sql)===FALSE)
{
   die("error creating table: $conn->error");
}
?>
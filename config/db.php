<?php 


$host = 'localhost';
$username = 'root';
$password = '';
$database = 'phpprojectdb';

$db = mysqli_connect($host, $username, $password, $database) or die ('no connection');

// Check connection
if (mysqli_connect_errno())
{
echo "Failed to connect to MySQL: " . mysqli_connect_error();
}





?>
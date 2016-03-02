<?php

$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "internship";

/*$servername = "db4free.net";
$username = "dbtektons";
$password = "dbtektons";
$dbname = "dbtektons";  */


// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
//echo "Connected successfully";
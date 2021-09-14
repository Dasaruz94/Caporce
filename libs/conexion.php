<?php
/**
 * Created by PhpStorm.
 * User: Daniel
 * Date: 11/01/16
 * Time: 9:47
 */
/*
$mysqli = new mysqli("localhost", "root", "", "caporce");
if ($mysqli->connect_errno) {
    echo "Fallo al contenctar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
echo $mysqli->host_info . "\n";

$mysqli = new mysqli("localhost", "root", "", "caporce", 3306);
if ($mysqli->connect_errno) {
    echo "Fallo al contenctar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

echo $mysqli->host_info . "\n";
*/

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "capor_caporce";

// Create connection
$mysqli = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$mysqli) {
    die("Connection failed: " . mysqli_connect_error());
}



?>
<?php 
// Hostname
$host = "localhost";
// Username
$uname = "root";
// Password
$pw = "";
// Database Name
$dbname = "invoice_db";

try{
    $conn = new MySQLi($host, $uname, $pw, $dbname);
}catch(Exception $e){
    echo "Database Connection Failed: <br>";
    print_r($e->getMessage());
    exit;
}
?>
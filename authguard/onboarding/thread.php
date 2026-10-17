
<?php

// Connection parameters

// $host = '127.0.0.1';

$host = 'localhost';
$username = 'c2589746c_system';
$password = 'oZkUfA$8%]+^Z;s=';
$database = 'c2589746c_humani';

// Create connection
$connect = new mysqli($host, $username, $password, $database);

// Check connection
if ($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
}
?>

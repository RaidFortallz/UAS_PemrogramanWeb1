<?php

$host = "localhost"; 
$user = "root"; 
$pass = ""; 
$db_name = "uas_web"; 

try {
    $conn = new PDO("mysql:host=$host;dbname=$db_name", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
} catch (PDOException $e) {
    die("Koneksi gagal: " . $e->getMessage());
}

?>
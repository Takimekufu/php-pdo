<?php

$host = '127.0.0.1';
$user = 'root';
$password = '';
$charset = 'utf8mb4';
$dsn = "mysql:host=$host;charset=$charset";

$conn = new PDO($dsn, $user, $password);
return $conn;
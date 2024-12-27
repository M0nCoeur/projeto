<?php

$host = 'localhost';
$dbname = 'gameverse';
$username = 'root';
$password = '';

try {
    $conn = new PDO('mysql:host=localhost;dbname=gameverse', 'root', '');
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Falha na conexão com o banco de dados: " . $e->getMessage());
}

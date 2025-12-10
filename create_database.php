<?php
// Ideiglenes script az adatbázis létrehozásához

$host = '127.0.0.1';
$username = 'root';
$password = '';
$database = 'kulonleges_lenyek_katasztere';

try {
    $pdo = new PDO("mysql:host=$host", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $sql = "CREATE DATABASE IF NOT EXISTS `$database` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci";
    $pdo->exec($sql);
    
    echo "Az adatbázis sikeresen létrehozva: $database\n";
} catch (PDOException $e) {
    echo "Hiba az adatbázis létrehozásakor: " . $e->getMessage() . "\n";
}

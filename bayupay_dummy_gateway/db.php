<?php
$host = 'mysql';       // Docker Compose service name
$dbname = 'bayupay_db';
$user = 'bayupay_user';
$pass = 'bayupay_pass';

try {
    $db = new PDO("mysql:host=$host;port=3306;dbname=$dbname;charset=utf8mb4", $user, $pass);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Create table if not exists
    $db->exec("
    CREATE TABLE IF NOT EXISTS transactions (
        id INT AUTO_INCREMENT PRIMARY KEY,
        seller_ref VARCHAR(255),
        fpx_ref VARCHAR(255),
        name VARCHAR(255),
        email VARCHAR(255),
        phone VARCHAR(50),
        amount DECIMAL(10,2),
        status VARCHAR(50),
        kod_transaksi VARCHAR(255),
        bank VARCHAR(50),
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP
    )
    ");
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

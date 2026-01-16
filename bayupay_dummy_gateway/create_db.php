<?php
require 'db.php';

// Create table if it does not exist, with SID & ITN
try {
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
        sid VARCHAR(50) DEFAULT 'SIDTEST',
        itn VARCHAR(50) DEFAULT 'IMPORT123',
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP
    )
    ");

    echo "Table created successfully (or already exists).";

} catch (PDOException $e) {
    die("Table creation failed: " . $e->getMessage());
}

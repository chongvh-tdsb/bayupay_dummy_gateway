<?php
$host = 'mysql';
$dbname = 'bayupay_db';
$user = 'bayupay_user';
$pass = 'bayupay_pass';

try {
    $db = new PDO("mysql:host=$host;port=3306;dbname=$dbname;charset=utf8mb4", $user, $pass);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Drop table if exists (only if you are ok with clearing old data)
    $db->exec("DROP TABLE IF EXISTS transactions");

    // Recreate table with sid & itn
    $db->exec("
    CREATE TABLE transactions (
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

    echo "Table created successfully with SID & ITN!";
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

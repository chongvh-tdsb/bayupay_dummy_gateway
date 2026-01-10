<?php
// Connect to SQLite
$db = new PDO('sqlite:' . __DIR__ . '/bayupay.db');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Create transactions table without fpx_type and created_at
$db->exec("
CREATE TABLE IF NOT EXISTS transactions (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    seller_ref TEXT,
    fpx_ref TEXT,
    name TEXT,
    email TEXT,
    phone TEXT,
    amount REAL,
    status TEXT,
    transaksi_kod TEXT,
    bank TEXT
)
");

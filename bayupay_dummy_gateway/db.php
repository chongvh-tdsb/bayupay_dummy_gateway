<?php
$db = new PDO('sqlite:' . __DIR__ . '/bayupay.db');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
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
    bank TEXT,
    fpx_type TEXT,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
)
");

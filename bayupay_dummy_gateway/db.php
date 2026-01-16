<?php
$host = 'mysql';
$dbname = 'bayupay_db';
$user = 'bayupay_user';
$pass = 'bayupay_pass';

try {
    $db = new PDO("mysql:host=$host;port=3306;dbname=$dbname;charset=utf8mb4", $user, $pass);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

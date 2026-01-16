<?php
require 'db.php';
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

// Handle preflight request
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') exit;

// Bearer token check
$headers = getallheaders();
$auth = $headers['Authorization'] ?? '';
if (!preg_match('/Bearer\s(\S+)/', $auth, $m) || $m[1] !== 'test-api') {
    http_response_code(401);
    echo json_encode(['error'=>'Unauthorized']);
    exit;
}

// Get parameters from URL
$sid = $_GET['sid'] ?? '';
$itn = $_GET['itn'] ?? '';
$rn  = $_GET['rn']  ?? '';

if (!$sid || !$itn || !$rn) {
    http_response_code(400);
    echo json_encode(['error'=>'Missing sid, itn or rn']);
    exit;
}

// Query transaction
$stmt = $db->prepare("
    SELECT seller_ref, fpx_ref AS fpx_seller_reference, name, email, phone, 
           amount AS payment_amount, kod_transaksi AS transaction_data, 
           status AS transaction_status, created_at 
    FROM transactions 
    WHERE seller_ref=? AND sid=? AND itn=?
");
$stmt->execute([$rn, $sid, $itn]);
$data = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$data) {
    http_response_code(404);
    echo json_encode(['error'=>'Transaction not found']);
    exit;
}

// Return JSON
echo json_encode([
    'seller_ref' => $data['seller_ref'],
    'fpx_seller_reference' => $data['fpx_seller_reference'],
    'name' => $data['name'],
    'email' => $data['email'],
    'phone' => $data['phone'],
    'payment_amount' => $data['payment_amount'],
    'transaction_data' => $data['created_at'],
    'transaction_status' => $data['transaction_status']
], JSON_PRETTY_PRINT);

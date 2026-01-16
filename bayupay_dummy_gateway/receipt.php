<?php
require 'db.php';

$d = $_POST;

// Basic validation
if (!isset($d['rn'], $d['amount'], $d['bank'], $d['transaction_status'], $d['sid'], $d['itn'])) {
    echo "Invalid request.";
    exit;
}

// Generate kod_transaksi (50 chars)
function generateKodTransaksi($data) {
    $str = ($data['rn'] ?? '') . '|' . ($data['amount'] ?? 0) . '|' . ($data['transaction_status'] ?? 'PENDING') . '|' . time();
    return substr(hash('sha256', $str), 0, 50);
}

$fpxRef = 'BPX' . date('YmdHis');
$kodTransaksi = generateKodTransaksi($d);

// Insert transaction
$stmt = $db->prepare("
INSERT INTO transactions 
(seller_ref, fpx_ref, name, email, phone, amount, status, kod_transaksi, bank, sid, itn)
VALUES (?,?,?,?,?,?,?,?,?,?,?)
");
$stmt->execute([
    $d['rn'] ?? '',
    $fpxRef,
    $d['co_name'] ?? '',
    $d['email'] ?? '',
    $d['tel_no'] ?? '',
    $d['amount'] ?? 0,
    $d['transaction_status'] ?? 'PENDING',
    $kodTransaksi,
    $d['bank'] ?? '',
    $d['sid'] ?? 'SIDTEST',
    $d['itn'] ?? 'IMPORT123'
]);
?>
<!DOCTYPE html>
<html>
<head>
<title>Payment Receipt</title>
<style>
body{font-family:Arial;background:#f5f5f5}.box{width:450px;margin:60px auto;background:#fff;padding:20px;border-radius:8px}.success{color:green}.failed{color:red}.pending{color:orange}button{width:100%;padding:12px;margin-top:20px}
</style>
</head>
<body>
<div class="box">
<h3>Payment Receipt</h3>
<p>Order ID: <?= htmlspecialchars($d['rn']) ?></p>
<p>Transaction Ref: <?= htmlspecialchars($fpxRef) ?></p>
<p>Name: <?= htmlspecialchars($d['co_name'] ?? '') ?></p>
<p>Amount: RM <?= htmlspecialchars($d['amount']) ?></p>
<p>Bank: <?= htmlspecialchars($d['bank']) ?></p>
<p>Status: <span class="<?= strtolower(str_replace(' ','-',$d['transaction_status'])) ?>"><?= htmlspecialchars($d['transaction_status']) ?></span></p>

<form method="get" action="<?= htmlspecialchars($d['bounce'] ?? '/') ?>">
<input type="hidden" name="kod_transaksi" value="<?= htmlspecialchars($kodTransaksi) ?>">
<button>Back to Main Page</button>
</form>
</div>
</body>
</html>

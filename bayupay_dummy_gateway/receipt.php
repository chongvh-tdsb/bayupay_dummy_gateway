<?php
require 'db.php';

function generateTransaksiKod($data){
    return base64_encode(json_encode([
        'order'=>$data['rn'] ?? '',
        'amount'=>$data['amount'] ?? 0,
        'status'=>$data['transaction_status'] ?? 'PENDING',
        'time'=>time()
    ]));
}

$d = $_POST ?: $_GET;

$rn = $d['rn'] ?? '';
$co_name = $d['co_name'] ?? '';
$email = $d['email'] ?? '';
$tel_no = $d['tel_no'] ?? '';
$amount = $d['amount'] ?? 0;
$bank = $d['bank'] ?? '';
$fpx_type = $d['fpx_type'] ?? '';
$transaction_status = $d['transaction_status'] ?? 'PENDING';
$bounce = $d['bounce'] ?? '/';

$fpxRef = 'BPX'.date('YmdHis');
$transaksiKod = generateTransaksiKod($d);

// Insert transaction
$stmt = $db->prepare("
INSERT INTO transactions 
(seller_ref,fpx_ref,name,email,phone,amount,status,transaksi_kod,bank,fpx_type)
VALUES (?,?,?,?,?,?,?,?,?,?,?)
");
$stmt->execute([
    $rn,
    $fpxRef,
    $co_name,
    $email,
    $tel_no,
    $amount,
    $transaction_status,
    $transaksiKod,
    $bank,
    $fpx_type
]);
?>
<!DOCTYPE html>
<html>
<head>
<title>Payment Receipt</title>
<style>
body{font-family:Arial;background:#f5f5f5}
.box{width:450px;margin:60px auto;background:#fff;padding:20px;border-radius:8px}
.success{color:green}.failed{color:red}.pending{color:orange}
button{width:100%;padding:12px;margin-top:20px}
</style>
</head>
<body>
<div class="box">
<h3>Payment Receipt</h3>
<p>Order ID: <?= htmlspecialchars($rn) ?></p>
<p>Transaction Ref: <?= htmlspecialchars($fpxRef) ?></p>
<p>Name: <?= htmlspecialchars($co_name) ?></p>
<p>Amount: RM <?= htmlspecialchars($amount) ?></p>
<p>Bank: <?= htmlspecialchars($bank) ?> (<?= htmlspecialchars($fpx_type) ?>)</p>
<p>Status: <span class="<?= strtolower(str_replace(' ','-',$transaction_status)) ?>"><?= htmlspecialchars($transaction_status) ?></span></p>
<form method="get" action="<?= htmlspecialchars($bounce) ?>">
<input type="hidden" name="transaksi_kod" value="<?= htmlspecialchars($transaksiKod) ?>">
<button>Back to Main Page</button>
</form>
</div>
</body>
</html>

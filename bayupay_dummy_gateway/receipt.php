<?php
require 'db.php';
function generateTransaksiKod($data){return base64_encode(json_encode(['order'=>$data['rn'],'amount'=>$data['amount'],'status'=>$data['transaction_status'],'time'=>time()]));}
$d=$_POST;
$fpxRef='BPX'.date('YmdHis');
$transaksiKod=generateTransaksiKod($d);
$stmt = $db->prepare("
INSERT INTO transactions 
(seller_ref, fpx_ref, name, email, phone, amount, status, transaksi_kod, bank, fpx_type)
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
");
$stmt->execute([
    $seller_ref,
    $fpx_ref,
    $co_name,
    $email,
    $tel_no,
    $amount,
    $status,
    $transaksi_kod,
    $bank,
    $fpx_type,
]);

?>
<!DOCTYPE html>
<html>
<head>
<title>Payment Receipt</title>
<style>body{font-family:Arial;background:#f5f5f5}.box{width:450px;margin:60px auto;background:#fff;padding:20px;border-radius:8px}.success{color:green}.failed{color:red}.pending{color:orange}button{width:100%;padding:12px;margin-top:20px}</style>
</head>
<body>
<div class="box">
<h3>Payment Receipt</h3>
<p>Order ID: <?= $d['rn'] ?></p>
<p>Transaction Ref: <?= $fpxRef ?></p>
<p>Name: <?= $d['co_name'] ?></p>
<p>Amount: RM <?= $d['amount'] ?></p>
<p>Bank: <?= $d['bank'] ?> (<?= $d['fpx_type'] ?>)</p>
<p>Status: <span class="<?= strtolower(str_replace(' ','-',$d['transaction_status'])) ?>"><?= $d['transaction_status'] ?></span></p>
<form method="get" action="<?= $d['bounce'] ?>">
<input type="hidden" name="transaksi_kod" value="<?= $transaksiKod ?>">
<button>Back to Main Page</button>
</form>
</div>
</body>
</html>

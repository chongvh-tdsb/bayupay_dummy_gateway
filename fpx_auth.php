<?php $d = $_POST; ?>
<!DOCTYPE html>
<html>
<head>
<title>FPX Authorisation Simulator</title>
<style>body{font-family:Arial;background:#f5f5f5}.box{width:420px;margin:80px auto;background:#fff;padding:20px;border-radius:8px}button{width:100%;padding:12px;margin-top:10px;font-size:15px}.success{background:#28a745;color:#fff}.pending{background:#ffc107}.failed{background:#dc3545;color:#fff}</style>
</head>
<body>
<div class="box">
<h3><?= $d['bank'] ?> FPX Simulator</h3>
<p>Account Type: <b><?= $d['fpx_type'] ?></b></p>
<p>Select Payment Result:</p>
<form method="post" action="receipt.php">
<?php foreach ($d as $k=>$v): ?>
<input type="hidden" name="<?= $k ?>" value="<?= htmlspecialchars($v) ?>">
<?php endforeach ?>
<input type="hidden" name="transaction_status" id="status">
<button class="success" onclick="setStatus('SUCCESSFUL')">SUCCESSFUL</button>
<button class="pending" onclick="setStatus('PENDING FOR AUTHORIZER TO APPROVE')">PENDING FOR AUTHORIZER TO APPROVE</button>
<button class="failed" onclick="setStatus('UNSUCCESSFUL')">UNSUCCESSFUL</button>
</form>
</div>
<script>function setStatus(s){document.getElementById('status').value=s;}</script>
</body>
</html>

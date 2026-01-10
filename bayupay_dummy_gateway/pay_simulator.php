<?php $d = $_GET; ?>
<!DOCTYPE html>
<html>
<head>
<title>FPX Payment Simulator</title>
<style>body{font-family:Arial;background:#f5f5f5}.box{width:420px;margin:80px auto;background:#fff;padding:20px;border-radius:8px}select,button{width:100%;padding:10px;margin-top:10px}</style>
</head>
<body>
<div class="box">
<h3>FPX Online Banking Simulator</h3>
<p>Order: <b><?= $d['rn'] ?></b></p>
<p>Amount: RM <?= $d['amount'] ?></p>
<form method="post" action="fpx_auth.php">
<?php foreach ($d as $k=>$v): ?>
<input type="hidden" name="<?= $k ?>" value="<?= htmlspecialchars($v) ?>">
<?php endforeach ?>
<label>FPX Type</label>
<select name="fpx_type" required>
<option value="">-- Select Type --</option>
<option value="PERSONAL">Personal</option>
<option value="BUSINESS">Business</option>
</select>
<label>Bank</label>
<select name="bank" required>
<option value="">-- Select Bank --</option>
<option value="MAYBANK">Maybank</option>
<option value="CIMB">CIMB Bank</option>
<option value="RHB">RHB Bank</option>
<option value="PUBLIC">Public Bank</option>
<option value="HLB">Hong Leong Bank</option>
</select>
<button>Proceed to Payment</button>
</form>
</div>
</body>
</html>

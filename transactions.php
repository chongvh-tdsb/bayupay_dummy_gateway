<?php
require 'db.php';
$rows=$db->query("SELECT * FROM transactions ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC);
?>
<table border="1" cellpadding="6">
<tr><th>ID</th><th>Order</th><th>Amount</th><th>Status</th><th>Bank</th><th>Type</th><th>Date</th></tr>
<?php foreach($rows as $r): ?>
<tr>
<td><?= $r['id'] ?></td>
<td><?= $r['seller_ref'] ?></td>
<td><?= $r['amount'] ?></td>
<td><?= $r['status'] ?></td>
<td><?= $r['bank'] ?></td>
<td><?= $r['fpx_type'] ?></td>
<td><?= $r['created_at'] ?></td>
</tr>
<?php endforeach; ?>
</table>

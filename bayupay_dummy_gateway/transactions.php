<?php
require 'db.php';

// Fetch all transactions
$rows = $db->query("SELECT * FROM transactions ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC);

// Function to get CSS class for status
function statusClass($status) {
    $s = strtolower(str_replace(' ', '-', $status));
    switch ($s) {
        case 'successful': return 'success';
        case 'pending-for-authorizer-to-approve': return 'pending';
        case 'unsuccessful': return 'failed';
        default: return '';
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Transactions List</title>
    <style>
        body { font-family: Arial; background: #f5f5f5; padding: 20px; }
        table { border-collapse: collapse; width: 100%; background: #fff; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
        th { background: #eee; }
        tr:nth-child(even) { background: #f9f9f9; }

        /* Status colors */
        .success { color: #28a745; font-weight: bold; }
        .pending { color: #ffc107; font-weight: bold; }
        .failed  { color: #dc3545; font-weight: bold; }
    </style>
</head>
<body>
<h2>Transactions</h2>
<table>
    <tr>
        <th>ID</th>
        <th>Order</th>
        <th>Amount (RM)</th>
        <th>Status</th>
        <th>Bank</th>
        <th>Date</th>
    </tr>
    <?php foreach ($rows as $r): ?>
    <tr>
        <td><?= htmlspecialchars($r['id']) ?></td>
        <td><?= htmlspecialchars($r['seller_ref']) ?></td>
        <td><?= htmlspecialchars($r['amount']) ?></td>
        <td class="<?= statusClass($r['status']) ?>"><?= htmlspecialchars($r['status']) ?></td>
        <td><?= htmlspecialchars($r['bank']) ?></td>
        <td><?= htmlspecialchars($r['created_at'] ?? '-') ?></td>
    </tr>
    <?php endforeach; ?>
</table>
</body>
</html>

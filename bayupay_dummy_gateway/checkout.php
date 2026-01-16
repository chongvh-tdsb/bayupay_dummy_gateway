<?php
// Allow POST
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') exit;

$input = file_get_contents('php://input');
$post = json_decode($input, true) ?? $_POST;

// Validate required fields
if (!isset($post['rn'], $post['amount'], $post['sid'], $post['itn'])) {
    echo "Missing required fields";
    exit;
}

// Instead of header redirect, use auto-submit POST form to pay_simulator.php
?>
<!DOCTYPE html>
<html>
<head><title>Redirecting to FPX Simulator...</title></head>
<body>
<form id="fpxForm" method="post" action="pay_simulator.php">
<?php foreach ($post as $k => $v): ?>
    <input type="hidden" name="<?= htmlspecialchars($k) ?>" value="<?= htmlspecialchars($v) ?>">
<?php endforeach; ?>
</form>
<script>document.getElementById('fpxForm').submit();</script>
<p>Redirecting...</p>
</body>
</html>

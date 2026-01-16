<?php
// Allow any origin for testing purposes
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

// Handle preflight request
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    exit(0);
}

// Get POST data
$input = file_get_contents('php://input');
$data = json_decode($input, true);

// If JSON was sent, use it; otherwise fallback to $_POST
$post = $data ?? $_POST;

// Validate SID & ITN
if (!isset($post['sid'], $post['itn']) || $post['sid'] !== 'SIDTEST' || $post['itn'] !== 'IMPORT123') {
    echo 'Invalid SID or ITN';
    exit;
}

// Instead of header redirect, use a POST form that auto-submits
?>
<!DOCTYPE html>
<html>
<head>
    <title>Redirecting to FPX Simulator...</title>
</head>
<body>
<form id="fpxForm" method="post" action="pay_simulator.php">
<?php foreach ($post as $k => $v): ?>
    <input type="hidden" name="<?= htmlspecialchars($k) ?>" value="<?= htmlspecialchars($v) ?>">
<?php endforeach; ?>
</form>
<script>
    document.getElementById('fpxForm').submit();
</script>
<p>Redirecting to FPX simulator...</p>
</body>
</html>

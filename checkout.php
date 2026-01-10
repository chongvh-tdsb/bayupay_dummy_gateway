<?php
// Get POST data
$input = file_get_contents('php://input');
$data = json_decode($input, true);

// If JSON was sent, use it; otherwise fallback to $_POST
$post = $data ?? $_POST;

// Check Authorization header
$headers = getallheaders();
$auth = $headers['Authorization'] ?? '';
if (!preg_match('/Bearer\s(\S+)/', $auth, $m) || $m[1] !== 'BAYUPAY_TEST_TOKEN_123') {
    http_response_code(401);
    echo 'Unauthorized';
    exit;
}

// Validate SID & ITN
if (!isset($post['sid'], $post['itn']) || $post['sid'] !== 'SIDTEST' || $post['itn'] !== 'IMPORT123') {
    echo 'Invalid SID or ITN';
    exit;
}

// Redirect to FPX simulator
header("Location: pay_simulator.php?" . http_build_query($post));
exit;

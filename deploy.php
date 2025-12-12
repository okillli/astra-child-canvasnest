<?php
/**
 * GitHub Webhook Listener - Auto Deploy Theme from GitHub
 * Access: https://canvasnest.co.uk/deploy.php
 */

// Security token - MUST MATCH GitHub webhook secret
$webhook_secret = 'oki123xyz789def456lli';

// Get the webhook payload
$payload = file_get_contents('php://input');
$signature = isset($_SERVER['HTTP_X_HUB_SIGNATURE_256']) ? $_SERVER['HTTP_X_HUB_SIGNATURE_256'] : '';

// Verify the signature
$hash = 'sha256=' . hash_hmac('sha256', $payload, $webhook_secret);

if (!hash_equals($hash, $signature)) {
    http_response_code(403);
    die('Unauthorized');
}

// Decode the JSON payload
$data = json_decode($payload, true);

// Only deploy on pushes to main branch
if ($data['ref'] === 'refs/heads/main') {
    $theme_dir = '/home/u977687187/public_html/wp-content/themes/astra-child-canvasnest';

    // Change to theme directory and pull latest code
    chdir($theme_dir);
    $output = shell_exec('git pull origin main 2>&1');

    // Log the deployment
    $log = date('Y-m-d H:i:s') . " - Deployment executed\n" . $output . "\n---\n";
    file_put_contents($theme_dir . '/deploy.log', $log, FILE_APPEND);

    http_response_code(200);
    echo json_encode(['status' => 'success', 'message' => 'Deployment completed']);
} else {
    http_response_code(200);
    echo json_encode(['status' => 'skipped', 'message' => 'Not main branch']);
}
?>

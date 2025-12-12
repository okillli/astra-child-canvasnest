<?php
/**
 * GitHub Webhook Auto-Deploy Handler
 * Canvas Nest Theme - Hostinger Deployment
 *
 * IMPORTANT: Place this file at: /public_html/deploy-webhook.php
 * (NOT in the theme directory - put it in your site root)
 *
 * GitHub Webhook URL: https://canvasnest.co.uk/deploy-webhook.php
 */

// Enable error logging
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/webhook-errors.log');

// Configuration
define('WEBHOOK_SECRET', 'oki123xyz789def456lli'); // Must match GitHub webhook secret
define('THEME_PATH', __DIR__ . '/wp-content/themes/astra-child-canvasnest');
define('LOG_FILE', __DIR__ . '/webhook-deploy.log');

// Log helper function
function logMessage($message) {
    $timestamp = date('Y-m-d H:i:s');
    file_put_contents(LOG_FILE, "[$timestamp] $message\n", FILE_APPEND);
}

// Start logging
logMessage("=== Webhook received ===");
logMessage("Remote IP: " . ($_SERVER['REMOTE_ADDR'] ?? 'unknown'));

// Get the request payload
$payload = file_get_contents('php://input');

if (empty($payload)) {
    logMessage("ERROR: Empty payload received");
    http_response_code(400);
    die(json_encode(['error' => 'Empty payload']));
}

// Verify GitHub signature
$signature = $_SERVER['HTTP_X_HUB_SIGNATURE_256'] ?? '';

if (empty($signature)) {
    logMessage("ERROR: No signature header found");
    http_response_code(403);
    die(json_encode(['error' => 'No signature']));
}

// Calculate expected signature
$expected_signature = 'sha256=' . hash_hmac('sha256', $payload, WEBHOOK_SECRET);

// Verify signature matches
if (!hash_equals($expected_signature, $signature)) {
    logMessage("ERROR: Invalid signature");
    logMessage("Expected: $expected_signature");
    logMessage("Received: $signature");
    http_response_code(403);
    die(json_encode(['error' => 'Invalid signature']));
}

logMessage("✓ Signature verified");

// Decode the payload
$data = json_decode($payload, true);

if (!$data) {
    logMessage("ERROR: Invalid JSON payload");
    http_response_code(400);
    die(json_encode(['error' => 'Invalid JSON']));
}

// Check if this is a push to main branch
$ref = $data['ref'] ?? '';
logMessage("Event ref: $ref");

if ($ref !== 'refs/heads/main') {
    logMessage("Skipping: Not a push to main branch");
    http_response_code(200);
    die(json_encode(['status' => 'skipped', 'message' => 'Not main branch']));
}

logMessage("✓ Push to main branch detected");

// Check if theme directory exists
if (!is_dir(THEME_PATH)) {
    logMessage("ERROR: Theme directory not found at " . THEME_PATH);
    http_response_code(500);
    die(json_encode(['error' => 'Theme directory not found']));
}

// Change to theme directory
chdir(THEME_PATH);
logMessage("Changed to directory: " . THEME_PATH);

// Execute git pull
logMessage("Executing: git pull origin main");
$output = [];
$return_code = 0;

exec('git pull origin main 2>&1', $output, $return_code);

$output_string = implode("\n", $output);
logMessage("Git output:\n" . $output_string);
logMessage("Return code: $return_code");

// Check if git pull was successful
if ($return_code === 0) {
    logMessage("✓ Deployment successful!");

    // Optional: Clear WordPress cache if you have caching plugins
    // You can add cache clearing logic here

    http_response_code(200);
    echo json_encode([
        'status' => 'success',
        'message' => 'Theme deployed successfully',
        'output' => $output_string,
        'timestamp' => date('Y-m-d H:i:s')
    ]);
} else {
    logMessage("ERROR: Git pull failed with code $return_code");
    http_response_code(500);
    echo json_encode([
        'status' => 'error',
        'message' => 'Git pull failed',
        'output' => $output_string,
        'return_code' => $return_code
    ]);
}

logMessage("=== Webhook processing complete ===\n");
?>

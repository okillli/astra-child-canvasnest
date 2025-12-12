<?php
/**
 * Diagnostic Script for GitHub Webhook Auto-Deploy
 * Upload to: /public_html/diagnose.php
 * Access: https://canvasnest.co.uk/diagnose.php
 *
 * This will help us understand why git pull isn't working
 */

header('Content-Type: text/plain');

echo "=== GITHUB WEBHOOK DIAGNOSTICS ===\n\n";

// 1. Check theme directory
$theme_dir = '/home/u977687187/public_html/wp-content/themes/astra-child-canvasnest';
echo "1. THEME DIRECTORY CHECK\n";
echo "Path: $theme_dir\n";
echo "Exists: " . (is_dir($theme_dir) ? 'YES' : 'NO') . "\n";
echo "Readable: " . (is_readable($theme_dir) ? 'YES' : 'NO') . "\n";
echo "Writable: " . (is_writable($theme_dir) ? 'YES' : 'NO') . "\n\n";

// 2. Check if git is initialized
echo "2. GIT INITIALIZATION CHECK\n";
$git_dir = $theme_dir . '/.git';
echo ".git exists: " . (is_dir($git_dir) ? 'YES' : 'NO') . "\n\n";

// 3. Check git status
echo "3. GIT STATUS\n";
chdir($theme_dir);
$output = shell_exec('git status 2>&1');
echo $output . "\n\n";

// 4. Check git remote
echo "4. GIT REMOTE CHECK\n";
$output = shell_exec('git remote -v 2>&1');
echo $output . "\n\n";

// 5. Check git branch
echo "5. CURRENT BRANCH\n";
$output = shell_exec('git branch 2>&1');
echo $output . "\n\n";

// 6. Try git fetch (safer than pull)
echo "6. GIT FETCH TEST\n";
$output = shell_exec('git fetch origin 2>&1');
echo $output . "\n\n";

// 7. Check for deploy.log
echo "7. DEPLOY LOG CHECK\n";
$log_file = $theme_dir . '/deploy.log';
echo "deploy.log exists: " . (file_exists($log_file) ? 'YES' : 'NO') . "\n";
if (file_exists($log_file)) {
    echo "deploy.log writable: " . (is_writable($log_file) ? 'YES' : 'NO') . "\n";
    echo "\nLast 20 lines of deploy.log:\n";
    echo shell_exec("tail -20 $log_file");
}
echo "\n\n";

// 8. Check file permissions
echo "8. FILE PERMISSIONS\n";
$output = shell_exec("ls -la $theme_dir 2>&1 | head -20");
echo $output . "\n\n";

// 9. Check current user
echo "9. CURRENT USER/PROCESS\n";
echo "User running this script: " . shell_exec('whoami') . "\n";
echo "Process info: " . shell_exec('id') . "\n\n";

// 10. Test git pull with full output
echo "10. DETAILED GIT PULL TEST\n";
echo "Attempting git pull...\n";
$output = shell_exec('cd ' . $theme_dir . ' && git pull origin main 2>&1');
echo $output . "\n\n";

// 11. Check if files were created
echo "11. RECENT FILE CHANGES\n";
echo "Files modified in last hour:\n";
$output = shell_exec("find $theme_dir -type f -mmin -60 2>&1 | head -20");
echo $output . "\n\n";

echo "=== END DIAGNOSTICS ===\n";
echo "\nGenerated: " . date('Y-m-d H:i:s');
?>

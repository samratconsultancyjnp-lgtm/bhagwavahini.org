<?php
/**
 * Laravel Migration Runner
 * Use this to run migrations when you don't have SSH access.
 * DELETE THIS FILE AFTER USE.
 */

// Define the root path
$rootPath = __DIR__;

// Load Autoloader
if (!file_exists($rootPath . '/vendor/autoload.php')) {
    die('Vendor directory not found.');
}
require $rootPath . '/vendor/autoload.php';

// Bootstrap Laravel
$app = require_once $rootPath . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);

echo "<h1>Laravel Migration Utility</h1>";
echo "<pre>";

try {
    echo "Running Migrations...\n";
    $exitCode = $kernel->call('migrate', ['--force' => true]);
    
    if ($exitCode === 0) {
        echo "\nSUCCESS: Migrations completed successfully.\n";
    } else {
        echo "\nERROR: Migration failed with exit code: " . $exitCode . "\n";
    }
} catch (Exception $e) {
    echo "ERROR: " . $e->getMessage();
}

echo "</pre>";
echo '<a href="/">Go to Home</a>';

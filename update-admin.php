<?php
/**
 * Laravel Admin User Creator/Updater
 * Usage: Upload to root and visit in browser, then DELETE IMMEDIATELY.
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
$app->make(Illuminate\Contracts\Http\Kernel::class)->handle(Illuminate\Http\Request::capture());

use App\Models\User;
use Illuminate\Support\Facades\Hash;

echo "<h1>Admin Account Update Utility</h1>";
echo "<pre>";

$email = 'admin@bhagva.org';
$password = 'Bhagva@2026!'; // You can change this here if needed

try {
    $user = User::where('email', $email)->first();

    if ($user) {
        echo "User found. Updating password and admin status...\n";
        $user->password = Hash::make($password);
        $user->is_admin = 1;
        $user->save();
        echo "SUCCESS: Admin password updated.\n";
    } else {
        echo "User not found. Creating new admin user...\n";
        User::create([
            'name' => 'Administrator',
            'email' => $email,
            'password' => Hash::make($password),
            'is_admin' => 1
        ]);
        echo "SUCCESS: New admin user created.\n";
    }

    echo "\n<b>Credentials for Live Site:</b>\n";
    echo "Email: " . $email . "\n";
    echo "Password: " . $password . "\n";

} catch (Exception $e) {
    echo "ERROR: " . $e->getMessage();
}

echo "</pre>";
echo '<a href="/login">Go to Login</a>';

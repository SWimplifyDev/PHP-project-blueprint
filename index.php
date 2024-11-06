<?php
// Start the session if you need session management
session_start();

// Autoload classes (if you're using Composer, otherwise you might need a custom autoloader)
require __DIR__ . '/vendor/autoload.php';

// Load contollers' classes
require __DIR__ . '/app/Controllers/HomeController.php';

// Include routing configuration
require __DIR__ . '/config/routes.php';

// Error handling (optional)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Define base URL
define('BASE_URL', '/');

// Handle the request using routes in routes.php
// The `routes.php` file handles routing, so no further logic is needed here.

?>
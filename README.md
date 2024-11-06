# PHP Project Structure

```
project-root/
├── app/                      # Main application code (business logic, MVC structure)
│   ├── Controllers/          # Controllers handle requests
│   ├── Models/               # Database models and business logic
│   ├── Views/                # View files (if using custom or MVC views)
│   └── Services/             # Reusable service classes or helper functions
│
├── assets/                   # Public assets (CSS, JS, images)
│   ├── css/
│   ├── js/
│   └── images/
│
├── config/                   # Configuration files
│   ├── app.php               # Application-wide settings (app name, debug mode, etc.)
│   ├── database.php          # Database configuration
│   └── routes.php            # Routes for the application
│
├── storage/                  # For cache, logs, and uploaded files
│   ├── cache/                # Caching files for faster loading
│   ├── logs/                 # Logs for debugging
│   └── uploads/              # User-uploaded files
│
├── vendor/                   # Composer dependencies (auto-generated)
│
├── index.php                 # Entry point for the application
├── .env                      # Environment variables (database, API keys, etc.)
├── .htaccess                 # Rewrite rules and server configuration
├── .gitignore                # Exclude sensitive files from Git
├── composer.json             # Composer dependencies
├── README.md                 # Project documentation
└── LICENSE                   # License information
```

# Setting up first files

## Access file
Before you start with `.htaccess` file, make sure you have run this command on apache:
```bash
sudo a2enmod rewrite
```

`.htaccess`
```bash
# Enable Rewrite Engine
RewriteEngine On

# Remove .php extension if the file exists
RewriteCond %{REQUEST_FILENAME}.php -f
RewriteRule ^([^\.]+)$ $1.php [L]

# Restrict access to specific directories
RewriteRule ^(app|config|storage)($|/) - [F,L]

# Route all requests to index.php if no file or directory exists
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^(.*)$ index.php [L]

# Custom Error Documents
ErrorDocument 403 /404.php
```

## Views

Lest start with adding some views on `Views` folder

```
project-root/
├── app/                      # Main application code (business logic, MVC structure)
│   ├── Controllers/          # Controllers handle requests
│   ├── Models/               # Database models and business logic
│   ├── Views/                # View files for each page
│   │   ├── home.php          # Homepage view file
│   │   ├── page1.php         # View file for Page 1
│   │   └── page2.php         # View file for Page 2
│   └── Services/    
```

`home.php` example
```php
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle?></title>
</head>
<body>
    <h1>This is HOME</h1>
</body>
</html>
```

## Controllers

Now that we have got our views ready, we can write some controllers for those as well

```
project-root/
├── app/                      # Main application code (business logic, MVC structure)
│   ├── Controllers/          # Controllers handle requests
│   │   └── HomeController.php # Controller for handling the homepage and related actions
│   ├── Models/               # Database models and business logic
│   ├── Views/                # View files for each page
│   │   ├── home.php          # Homepage view file
│   │   ├── page1.php         # View file for Page 1
│   │   └── page2.php         # View file for Page 2
│   └── Services/       
```

`HomeController.php`
```php
<?php

namespace App\Controllers;

class HomeController {
    public static function showHome() {
        $pageTitle = 'Company | Home';
        include __DIR__ . '/../Views/home.php';
        
    }
}

?>
```

## Config routing

Now we can move into `routes.php` and starting routing pages for our application
```
├── config/                   # Configuration files
│   ├── app.php               # Application-wide settings (app name, debug mode, etc.)
│   ├── database.php          # Database configuration
│   └── routes.php            # Routes for the application
```

`routes.php`
```php
<?php

use App\Controllers\HomeController;

$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

switch ($requestUri) {
    case '/':
        HomeController::showHome();
        break;

    default:
        http_response_code(404);
        echo '404 Page Not Fund!';
        break;
}

?>
```

## Index the entry point

Finally we finished with the `index.php` file:
```
├── index.php                 # Entry point for the application
├── .env                      # Environment variables (database, API keys, etc.)
├── .htaccess                 # Rewrite rules and server configuration
├── .gitignore                # Exclude sensitive files from Git
├── composer.json             # Composer dependencies
├── README.md                 # Project documentation
└── LICENSE                   # License information
```

`index.php`
```php
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
```
<?php

namespace App\Controllers;

class HomeController {
    public static function showHome() {
        $pageTitle = 'Company | Home';
        include __DIR__ . '/../Views/home.php';
        
    }
}

?>
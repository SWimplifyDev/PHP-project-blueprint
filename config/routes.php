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
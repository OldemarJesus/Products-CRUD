<?php 
declare(strict_types=1);

require("/product-managament-v2/vendor/autoload.php");

use Oldemar\ProductManagamentV2\Controller\ProductController;

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("HTTP/1.1 405 Method Not Allowed");
    echo "405 Method Not Allowed";
    return;
}

if (count($_POST) < 1) {
    header("HTTP/1.1 400 Bad Request");
    echo "400 Bad Request";
    return;
}

if (!key_exists("id", $_POST)) {
    header("HTTP/1.1 422 Unprocessable Entity");
    echo "422 Unprocessable Entity\n";
    echo "Missing value\n";
    return;
}

if (empty($_POST["id"])) {
    header("HTTP/1.1 422 Unprocessable Entity");
    echo "id key should not be null\n";
    return;
}

$status_code = (new ProductController())->removeProduct((int)$_POST["id"]);

if($status_code == 422){
    header("HTTP/1.1 422 Unprocessable Entity");
    echo "422 Unprocessable Entity\n";
    echo "Something on controller\n";
    return;
}

if($status_code == 200){
    header("HTTP/1.1 200 OK");
    echo "200 Deleted";
    return;
}

header("HTTP/1.1 500 Internal Server Error");
echo "500 Internal Server Error\n";
return;
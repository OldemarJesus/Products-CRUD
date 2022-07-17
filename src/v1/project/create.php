<?php

declare(strict_types=1);

require("/product-managament-v2/vendor/autoload.php");

use Oldemar\ProductManagamentV2\Controller\ProductController;

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("HTTP/1.1 405 Method Not Allowed");
    echo "405 Method Not Allowed";
    return;
}

//validate
if (count($_POST) < 3) {
    header("HTTP/1.1 400 Bad Request");
    echo "400 Bad Request";
    return;
}

if (!key_exists("name", $_POST) || !key_exists("price", $_POST) || !key_exists("stock", $_POST)) {
    header("HTTP/1.1 422 Unprocessable Entity");
    echo "422 Unprocessable Entity";
    return;
}

if (empty($_POST["name"])) {
    header("HTTP/1.1 422 Unprocessable Entity");
    echo "name key should not be null\n";
    return;
}

if (empty($_POST["price"])) {
    header("HTTP/1.1 422 Unprocessable Entity");
    echo "price key should not be null\n";
    return;
}

if (empty($_POST["stock"])) {
    header("HTTP/1.1 422 Unprocessable Entity");
    echo "stock key should not be null\n";
    return;
}

// create
$controller = new ProductController();

$data = [
    "name"=>$_POST["name"],
    "price"=>$_POST["price"],
    "stock"=>$_POST["stock"]
];

$status_code = $controller->addProduct($data);

if ($status_code == 201) {
    header("HTTP/1.1 201 Created");
    echo "201 Created\n";
    return;
}

if ($status_code == 422) {
    header("HTTP/1.1 422 Unprocessable Entity");
    echo "422 Unprocessable Entity\n";
    return;
}

if ($status_code == 500) {
    header("HTTP/1.1 422 Unprocessable Entity");
    echo "500 Internal Server Error\n";
    echo "Maybe something wrong in Controller\n";
    return;
}

header("HTTP/1.1 500 Internal Server Error");
echo "500 Internal Server Error\n";
return;

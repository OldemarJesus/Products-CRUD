<?php

declare(strict_types=1);

require("/product-managament-v2/vendor/autoload.php");

use Oldemar\ProductManagamentV2\Controller\ProductController;

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    header("HTTP/1.1 405 Method Not Allowed");
    echo "405 Method Not Allowed";
    return;
}

try {
    $controller = new ProductController();
    $data = $controller->allProduct();

    $result = array();

    foreach ($data as $productObj => $product) {
        $arr = [
            "id" => $product->getID(),
            "name" => $product->getNAME(),
            "price" => $product->getPRICE(),
            "stock" => $product->getSTOCK(),
            "created_at" => date('Y-m-d H:i:s', $product->getCREATED_AT()),
            "updated-at" => date('Y-m-d H:i:s', $product->getUPDATED_AT())
        ];

        array_push($result, $arr);
    }

    $result = json_encode($result);

    header("Content-Type: application/json");
    echo $result;
    return;
} catch (\Throwable $th) {
    //throw $th;
    header("HTTP/1.1 500 Internal Server Error");
    echo "500 ", $th->getMessage(), "\n";
    return;
}

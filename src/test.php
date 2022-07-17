<?php
declare(strict_types=1);

require("/product-managament-v2/vendor/autoload.php");

use Oldemar\ProductManagamentV2\Controller\ProductController;
use Oldemar\ProductManagamentV2\Entity\ProductEntity;

$controler = new ProductController();
// echo "<pre>", var_dump(print($controler->addProduct())), "</pre>";
// echo "<pre>", var_dump(($controler->findByID(2))), "</pre>";
// $product = new ProductEntity();
// $product = $controler->findByID(1);
// echo "ID: ", $product->getID();
// echo "NAME: ", $product->getNAME();

// echo "Table:\t Products\n";
// echo "\tID\t  \tNAME\t  \tPRICE\t  \tSTOCK\t ";
// echo "\n";
// echo "\t", $product->getID() , "\t";
// echo "\t", $product->getNAME() , "\t";
// echo "\t", $product->getPRICE() , "\t";
// echo "\t", $product->getSTOCK() , "\t ";
// $product = $controler->findByID(2);
// echo "\n";
// echo "\t", $product->getID() , "\t";
// echo "\t", $product->getNAME() , "\t";
// echo "", $product->getPRICE() , "\t";
// echo "\t", $product->getSTOCK() , "\t ";

echo "<pre>", var_dump($controler->allProduct()), "</pre>";


print("\n\n\nFinished");
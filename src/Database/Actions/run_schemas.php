<?php
declare(strict_types=1);

require("/product-managament-v2/vendor/autoload.php");

use Oldemar\ProductManagamentV2\Database\Database;


$database = new Database();

$database->runSchemas();

print("Tables statements executed");
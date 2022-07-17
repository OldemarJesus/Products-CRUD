<?php
namespace Oldemar\ProductManagamentV2\Database;

use Oldemar\ProductManagamentV2\Database\Schemas\ProductSchema;
use PDO;

class Database {

    public static function getConnection(): PDO{
        $pdo = new PDO('sqlite:/product-managament-v2/src/Database/database.sqlite3');
        return $pdo;
    }

    public function runSchemas(): void{
        $pdo = Database::getConnection();

        ProductSchema::run($pdo); // Will create product table
    }
}
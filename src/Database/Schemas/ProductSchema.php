<?php

namespace Oldemar\ProductManagamentV2\Database\Schemas;

use PDO;

class ProductSchema
{

    public static function run(PDO $pdo): void
    {
        $statement = '
        CREATE TABLE products(
            product_id INTEGER PRIMARY KEY AUTOINCREMENT,
              product_name TEXT NOT NULL,
              product_price INTEGER NOT NULL,
              product_stock INTEGER NOT NULL,
              created_at timestamp  NOT NULL,
              updated_at timestamp  NOT NULL  DEFAULT CURRENT_TIMESTAMP
        );
        ';

        $select_table_stmt = '
        SELECT 
            name
        FROM 
            sqlite_schema
        WHERE 
            type ="table" AND 
            name NOT LIKE "sqlite_%" AND
            name = "products";
        ';

        $stmt = $pdo->prepare($select_table_stmt);

        $stmt -> execute();  

        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $exist = count($res) > 0 ? true : false;

        if($exist == 1){
            $pdo->exec("DROP TABLE products");
        }

        $pdo->exec($statement);
        
        return;
    }
}

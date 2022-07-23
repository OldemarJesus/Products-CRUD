<?php

namespace Oldemar\ProductManagamentV2\Model;

use Oldemar\ProductManagamentV2\Database\Database;
use Oldemar\ProductManagamentV2\Entity\ProductEntity;
use PDO;

class ProductModel
{

    public function add(ProductEntity $product): bool
    {
        $database = Database::getConnection();

        // validate
        if (is_null($product->getNAME()) || is_null($product->getPRICE() || is_null($product->getSTOCK()))) {
            return false;
        }

        $name = $product->getNAME();
        $price = (int)($product->getPRICE() * 100);
        $stock = $product->getSTOCK();

        // insert to database
        $statement = 'INSERT INTO products (product_name,product_price, product_stock, updated_at, created_at)
        VALUES(:names, :price, :stock, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);';

        $stmt = $database->prepare($statement);

        /* bind params */
        $stmt->bindParam(':names', $name, PDO::PARAM_STR);
        $stmt->bindParam(':price', $price, PDO::PARAM_INT);
        $stmt->bindParam(':stock', $stock, PDO::PARAM_INT);

        $res = $stmt->execute();

        return $res;
    }

    public function update(ProductEntity $product): bool
    {
        $database = Database::getConnection();

        // validate
        if (is_null($product->getNAME()) || is_null($product->getPRICE() || is_null($product->getSTOCK()) || is_null($product->getID()))) {
            return false;
        }

        $id = $product->getID();
        $name = $product->getNAME();
        $price = (int)($product->getPRICE() * 100);
        $stock = $product->getSTOCK();

        // insert to database
        $statement = '
        UPDATE products 
        SET 
            product_name = :name, 
            product_price = :price, 
            product_stock = :stock, 
            updated_at = CURRENT_TIMESTAMP
        WHERE
            products.product_id == :id;
        ';

        $stmt = $database->prepare($statement);

        /* bind params */
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':price', $price, PDO::PARAM_INT);
        $stmt->bindParam(':stock', $stock, PDO::PARAM_INT);

        $res = $stmt->execute();

        return $res;
    }

    public function find(int $id): ProductEntity
    {
        $database = Database::getConnection();

        $statement = '
        SELECT
            products.product_id as id,
            products.product_name as name,
            products.product_price as price,
            products.product_stock as stock

            FROM products

            WHERE products.product_id == ?
            LIMIT 1';

        $stmt = $database->prepare($statement);

        $stmt->execute([$id]);

        $res = $stmt->fetch();

        if (count($res) <= 0) {
            return null;
        }

        $product = new ProductEntity();

        $product->setID($res["id"]);
        $product->setNAME($res["name"]);
        $product->setSTOCK($res["stock"]);
        $product->setPRICE($res["price"]);

        return $product;
    }

    public function all(): array
    {
        $database = Database::getConnection();
        $productArr = array();

        $statement = '
        SELECT
            products.product_id as id,
            products.product_name as name,
            products.product_price as price,
            products.product_stock as stock,
            products.created_at as created_at,
            products.updated_at as updated_at

            FROM products';

        $stmt = $database->prepare($statement);

        $stmt->execute();

        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (count($res) <= 0) {
            return array();
        }

        foreach ($res as $row => $data) {
            $product = new ProductEntity();

            $product->setID($data["id"]);
            $product->setNAME($data["name"]);
            $product->setPRICE($data["price"] / 100);
            $product->setSTOCK($data["stock"]);
            $product->setCREATED_AT((int)strtotime($data["created_at"]));
            $product->setUPDATED_AT((int)strtotime($data["updated_at"]));

            array_push($productArr, $product);
        }

        return $productArr;
    }

    public function delete(int $id): bool
    {
        $database = Database::getConnection();

        $statement = '
        DELETE FROM products
        WHERE products.product_id == ?;';

        $stmt = $database->prepare($statement);
        
        return $stmt->execute([$id]);;
    }
}

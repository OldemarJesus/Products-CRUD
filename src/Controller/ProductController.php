<?php
namespace Oldemar\ProductManagamentV2\Controller;

use Exception;
use Oldemar\ProductManagamentV2\Entity\ProductEntity;
use Oldemar\ProductManagamentV2\Model\ProductModel;
use TypeError;

class ProductController{

    public function addProduct($data = null): int{

        // $data = [
        //     "name"=>"Fernando",
        //     "price"=>1599,
        //     "stock"=>150
        // ];

        //validate
        if(is_null($data) || is_null($data["name"]) || is_null($data["price"]) || is_null($data["stock"])){
            return "Missing Values";
        }

        try{
        // Create Product Intance
        $product = new ProductEntity();

        // Assign values
        $product->setNAME($data["name"]);
        $product->setPRICE(floatval($data["price"]));
        $product->setSTOCK((int)$data["stock"]);

        }catch(TypeError $e){
            return 422;
        }

        // Insert op
        try{
        $model = new ProductModel();
        $status = $model->add($product);
        }catch(Exception $e){
            return 500;
        }

        return $status == 1 ? 201 : 422;
    }

    public function findByID(int $id): ProductEntity{
        $model = new ProductModel();

        $product = new ProductEntity();

        $product = $model->find($id);

        return $product;
    }

    public function allProduct(): array{
        $model = new ProductModel();

        return $model->all();
    }

    public function removeProduct(int $id): int{
        if(is_null($id)){
            return 422;
        }

        $status = (new ProductModel())->delete($id);

        if($status == true){
            return 200;
        }

        return 422;
    }
}
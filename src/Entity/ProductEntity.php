<?php
namespace Oldemar\ProductManagamentV2\Entity;

class ProductEntity {
    private int $ID;
    private string $NAME;
    private int $PRICE;
    private int $STOCK;
    private int $CREATED_AT;
    private int $UPDATED_AT;

    /**
     * Getter & Setter for ID
     */
    public function setID(int $id): void{
        if(is_numeric($id)){
            $this->ID = $id;
        }
    }
    public function getID(): int{
        return $this->ID;
    }

    /**
     * Getter & Setter for NAME
     */
    public function setNAME(string $name): void{
        if(!is_null($name)){
            $this->NAME = $name;
        }
    }
    public function getNAME(): string{
        return $this->NAME;
    }

    /**
     * Getter & Setter for PRICE
     */
    public function setPRICE(float $price): void{
        if(is_numeric($price)){
            $this->PRICE = $price * 100;
        }
    }
    public function getPRICE(): float{
        return $this->PRICE/100;
    }

    /**
     * Getter & Setter for STOCK
     */
    public function setSTOCK(int $stock): void{
        if(is_numeric($stock)){
            $this->STOCK = $stock;
        }
    }
    public function getSTOCK(): int{
        return $this->STOCK;
    }

    /**
     * Getter & Setter for CREATED_AT
     */
    public function setCREATED_AT(int $created_at): void{
        if(is_numeric($created_at)){
            $this->CREATED_AT = $created_at;
        }
    }
    public function getCREATED_AT(): int{
        return $this->CREATED_AT;
    }

    /**
     * Getter & Setter for UPDATED_AT
     */
    public function setUPDATED_AT(int $updated_at): void{
        if(is_numeric($updated_at)){
            $this->UPDATED_AT = $updated_at;
        }
    }
    public function getUPDATED_AT(): int{
        return $this->UPDATED_AT;
    }
}
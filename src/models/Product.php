<?php
#namespace Junior\Model;

abstract class Product {
  private $sku;
  private $name;
  private $price;
  public static $children = array ("Furniture", "DVD", "Book");

  public function __construct($sku = 0, $name = false, $price = 0){
    $this->sku = $sku;
    $this->name = $name;
    $this->price = $price;
  }

  public function setSku($sku){
    $this->sku = $sku;
  }

  public function setName($name){
    $this->name = $name;
  }

  public function setPrice($price){
    $this->price = $price;
  }


  public function getSku(){
    return $this->sku;
  }

  public function getName(){
    return $this->name;
  }

  public function getPrice(){
    return $this->price;
  }

  public abstract function printProductInfo();
  public abstract function getSQLDeleteSyntax();
  public abstract function getSQLAddSyntax();
}
?>

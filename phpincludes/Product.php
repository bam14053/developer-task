<?php
#namespace Junior\Model;

abstract class Product {
  private $sku;
  private $name;
  private $price;

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
}
?>

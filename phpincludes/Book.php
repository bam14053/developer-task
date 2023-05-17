<?php

#namespace Junior\Model;

class Book extends Product{
  private $weight;

  public function setWeight($weight){
    $this->weight = $weight;
  }

  public function getWeight(){
    return $this->weight;
  }

  public function getSQLDeleteSyntax(){
    return "DELETE Book, Product from Book
    INNER JOIN Product ON Book.SKU = Product.SKU WHERE Product.SKU = '" . $this->getSku() . "'";
  }

  public function printProductInfo(){
    return "Weight: " . $this->weight . "KG";
  }

  public function getSQLAddSyntax(){
    return "INSERT INTO Book (SKU, Weight) VALUES ('".$this->getSku()."', ".$this->getWeight().")";
  }

}

?>

<?php

#namespace Junior\Model;

class Dvd extends Product{
  private $size;

  public function setSize($size){
    $this->size = $size;
  }

  public function getSize(){
    return $this->size;
  }

  public function getSQLDeleteSyntax(){
    return "DELETE DVD, Product from DVD
    INNER JOIN Product ON DVD.SKU = Product.SKU WHERE Product.SKU = '" . $this->getSku() . "'";
  }

  public function printProductInfo(){
    return "Size: " . $this->size . " MB";
  }

  public function getSQLAddSyntax(){
    return "INSERT INTO DVD (SKU, Size) VALUES ('".$this->getSku()."', ".$this->getSize().")";
  }

}

?>

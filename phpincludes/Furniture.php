<?php

#namespace Junior\Model;

class Furniture extends Product{
  private $height;
  private $width;
  private $length;

  public function setHeight($height){
    $this->height = $height;
  }

  public function setWidth($width){
    $this->width = $width;
  }

  public function setLength($length){
    $this->length = $length;
  }

  public function getHeight(){
    return $this->height;
  }

  public function getWidth(){
    return $this->width;
  }

  public function getLength(){
    return $this->length;
  }

  public function getSQLDeleteSyntax(){
    return "DELETE Product, Furniture from Furniture
    INNER JOIN Product ON Furniture.SKU = Product.SKU WHERE Product.SKU = '" . $this->getSku() . "'";
  }

  public function printProductInfo(){
    return "Dimension: " . $this->height . "x" . $this->width . "x" . $this->length;
  }

}

?>

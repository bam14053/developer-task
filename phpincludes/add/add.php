<?php

//Necessary in order to avoid 'unwanted' input
if(!in_array($_GET['productType'],Product::$children,true)) return;

$class = $_GET['productType'];
$product = new $class();
foreach (get_class_methods($product) as $method) {
  if(substr($method,0,3) === 'set'){
    $attribute = strtolower(str_replace("set","",$method));
    $product->$method(htmlspecialchars(trim($_GET[$attribute])));
  }
}
$productsHandler->addProduct($product);
header('Location: index.php');

/*
if(isset($_GET['sku'])) {
  switch ($_GET['productType']) {
      case 'DVD':
          $dvd = new Dvd(htmlspecialchars(trim($_GET['sku'])), htmlspecialchars(trim($_GET['name'])), htmlspecialchars(trim($_GET['price'])));
          $dvd->setSize(htmlspecialchars(trim($_GET['size'])));
          $productsHandler->addProduct($dvd);
          break;
      case 'Furniture':
          $furniture = new Furniture(htmlspecialchars(trim($_GET['sku'])), htmlspecialchars(trim($_GET['name'])), htmlspecialchars(trim($_GET['price'])));
          $furniture->setHeight(htmlspecialchars(trim($_GET['height'])));
          $furniture->setLength(htmlspecialchars(trim($_GET['length'])));
          $furniture->setWidth(htmlspecialchars(trim($_GET['width'])));
          $productsHandler->addProduct($furniture);
          break;
      case 'Book':
          $book = new Book(htmlspecialchars(trim($_GET['sku'])), htmlspecialchars(trim($_GET['name'])), htmlspecialchars(trim($_GET['price'])));
          $book->setWeight(htmlspecialchars(trim($_GET['weight'])));
          $productsHandler->addProduct($book);
          break;
  };
}*/
 ?>

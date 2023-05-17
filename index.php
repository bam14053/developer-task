<?php
//Of course placing the credentials elsewhere where it's not accessible to the public
require "phpincludes/Credentials.php";
//Include all my classes for the products
require "phpincludes/Product.php";
require "phpincludes/Dvd.php";
require "phpincludes/Furniture.php";
require "phpincludes/Book.php";
//This is where all the logic resides in
require "phpincludes/ProductsHandler.php";

//Get a list of all products from the datavase
$productsHandler = new ProductsHandler();
$productsHandler->getProductsList();

//First determine which page is loaded
$q = str_replace('?', "",$_SERVER['QUERY_STRING']);
if($q == "delete" && isset($_POST["ids"])){
  $productsHandler->deleteProducts($_POST["ids"]);
}elseif ($q == "addProduct") {
  include "phpincludes/addProductPage.php";
}elseif (strpos($q, 'add') === 0 && isset($_GET['sku'])) {
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
  header('Location: index.php');
}else{
  $products = $productsHandler->getProducts();
  //Show the page which list the products
  include "phpincludes/showProductsPage.php";
}
?>

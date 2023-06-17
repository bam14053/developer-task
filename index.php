<?php
//Of course placing the credentials elsewhere where it's not accessible to the public
require "src/models/Credentials.php";
//Include all my classes for the products
require "src/models/Product.php";
require "src/models/Dvd.php";
require "src/models/Furniture.php";
require "src/models/Book.php";
//This is where all the logic resides in
require "src/handlers/ProductsHandler.php";

//Get a list of all products from the database
$productsHandler = new ProductsHandler();

//First determine which page is loaded
$q = str_replace('?', "",$_SERVER['QUERY_STRING']);
if($q == "delete"){
  if(isset($_POST["ids"]))
    $productsHandler->deleteProducts($_POST["ids"]);
}elseif ($q == "addProduct") {
  include "src/pages/addProduct.php";
}else{
  if(strpos($q, 'add') === 0)
    $productsHandler->addProduct();
  $products = $productsHandler->getProducts();
  //Show the page which list the products
  include "src/pages/showProducts.php";
}
?>

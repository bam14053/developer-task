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

//Get a list of all products from the database
$productsHandler = new ProductsHandler();
$productsHandler->getProductsList();

//First determine which page is loaded
$q = str_replace('?', "",$_SERVER['QUERY_STRING']);
if($q == "delete"){
  include "phpincludes/delete/delete.php";
}elseif ($q == "addProduct") {
  include "phpincludes/add/addProductPage.php";
}elseif (strpos($q, 'add') === 0){
  include "phpincludes/add/add.php";
}else{
  $products = $productsHandler->getProducts();
  //Show the page which list the products
  include "phpincludes/show/showProductsPage.php";
}
?>

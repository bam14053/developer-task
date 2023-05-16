<?php
//Of course placing the credentials elsewhere where it's not accessible to the public
require "Credentials.php";
//Include all my classes
require "Product.php";
require "Dvd.php";
require "Furniture.php";
require "Book.php";
//This is where all the logic resides in
require "ProductsHandler.php";

//Start a session
session_start();

require "deleteProducts.php";
require "getProducts.php";

?>
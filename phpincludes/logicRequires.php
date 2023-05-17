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

$productsHandler = new ProductsHandler();
$productsHandler->getProductsList();

//First determine which page is loaded
$q = str_replace('?', "",$_SERVER['QUERY_STRING']);
if($q == "delete" && isset($_POST["ids"])){
  $productsHandler->deleteProducts($_POST["ids"]);
}elseif ($q == "addProduct") {
  
}else {
  $products = $productsHandler->getProducts();
}

//if(isset($_POST["ids"])) $productsHandler->deleteProducts($_POST["ids"]);
// if(isset($_GET['sku'])){
//     $args = array();
//     switch ($_GET['productType']) {
//         case 'DVD':
//             $args[] = htmlspecialchars(trim($_GET['size']));
//             break;
//         case 'Furniture':
//             $args[] = htmlspecialchars(trim($_GET['height']));
//             $args[] = htmlspecialchars(trim($_GET['width']));
//             $args[] = htmlspecialchars(trim($_GET['length']));
//             break;
//         case 'Book':
//             $args[] = htmlspecialchars(trim($_GET['weight']));
//             break;
//     };
//     $productsHandler->addProduct(htmlspecialchars(trim($_GET['sku'])), htmlspecialchars(trim($_GET['name'])),
//             htmlspecialchars(trim($_GET['price'])), $_GET['productType'], $args);
//     header('Location: index.php');
// }

?>

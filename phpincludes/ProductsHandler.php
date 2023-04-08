<?php

function getProductsList(){
  //Establishing connection
  $conn = new mysqli(Credentials::$servername, Credentials::$username, Credentials::$password, Credentials::$dbname);

  // Check connection
  if ($conn->connect_error) {
    die("Connection to the database failed, please contact the admin for more information");
  }

  //Create an empty productsarray
  $products = array();

  //First add all DVDs to the array
  $sql = "SELECT * FROM Product INNER JOIN DVD ON Product.SKU = DVD.SKU ORDER BY Product.SKU ASC";
  $result = $conn->query($sql);

  if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
      $dvd = new Dvd();
      $dvd->setSku($row["SKU"]);
      $dvd->setName($row["Name"]);
      $dvd->setPrice($row["Price"]);
      $dvd->setSize($row["Size"]);

      $products[$dvd->getSku()] = $dvd;
    }
  }

  //First add all DVDs to the array
  $sql = "SELECT * FROM Product INNER JOIN Furniture ON Product.SKU = Furniture.SKU ORDER BY Product.SKU ASC";
  $result = $conn->query($sql);

  if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
      $furniture = new Furniture();
      $furniture->setSku($row["SKU"]);
      $furniture->setName($row["Name"]);
      $furniture->setPrice($row["Price"]);
      $furniture->setHeight($row["Height"]);
      $furniture->setLength($row["Length"]);
      $furniture->setWidth($row["Width"]);

      $products[$furniture->getSku()] = $furniture;
    }
  }

  //First add all DVDs to the array
  $sql = "SELECT * FROM Product INNER JOIN Book ON Product.SKU = Book.SKU ORDER BY Product.SKU ASC";
  $result = $conn->query($sql);

  if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
      $book = new Book();
      $book->setSku($row["SKU"]);
      $book->setName($row["Name"]);
      $book->setPrice($row["Price"]);
      $book->setWeight($row["Weight"]);

      $products[$book->getSku()] = $book;
    }
  }
  $conn->close();
  return $products;
}
function deleteProducts($skuIDs, $products){
  //Establishing connection
  $conn = new mysqli(Credentials::$servername, Credentials::$username, Credentials::$password, Credentials::$dbname);

  // Check connection
  if ($conn->connect_error) {
    die("Connection to the database failed, please contact the admin for more information");
  }

  foreach ($skuIDs as $skuID){
    $conn->query($products[$skuID]->getSQLDeleteSyntax());
  };
  $conn->close();
}
function getSKUs(){
  //Get a list of all SKUs, so that the user can't insert it twice

  //Establishing connection
  $conn = new mysqli(Credentials::$servername, Credentials::$username, Credentials::$password, Credentials::$dbname);

  // Check connection
  if ($conn->connect_error) {
    die("Connection to the database failed, please contact the admin for more information");
  }

  $skus = array();

  $sql = "SELECT SKU FROM Product ORDER BY SKU ASC";
  $result = $conn->query($sql);

  while($skus[] = $result->fetch_assoc()["SKU"]);
  $conn->close();
  return $skus;
}
function addProduct(){
  //Establishing connection
  $conn = new mysqli(Credentials::$servername, Credentials::$username, Credentials::$password, Credentials::$dbname);

  // Check connection
  if ($conn->connect_error) {
    die("Connection to the database failed, please contact the admin for more information");
  }

  $sku = htmlspecialchars(trim($_GET['sku']));
  $name = htmlspecialchars(trim($_GET['name']));
  $price = htmlspecialchars(trim($_GET['price']));
  $sql = "INSERT INTO Product (SKU,Name,Price) VALUES ('$sku','$name',$price)";

  if ($conn->query($sql) === TRUE) {
    switch ($_GET['productType']) {
      case 'DVD':
        $size = htmlspecialchars(trim($_GET['size']));
        $conn->query("INSERT INTO DVD (SKU, Size) VALUES ('$sku', $size)");
        break;
      case 'Furniture':
        $height = htmlspecialchars(trim($_GET['height']));
        $width = htmlspecialchars(trim($_GET['width']));
        $length = htmlspecialchars(trim($_GET['length']));
        $conn->query("INSERT INTO Furniture (SKU, Height, Width, Length) VALUES ('$sku', $height, $width, $length)");
        break;
      case 'Book':
        $weight = htmlspecialchars(trim($_GET['weight']));
        $conn->query("INSERT INTO Book (SKU, Weight) VALUES ('$sku', $weight)");
      break;
    };
  }
  $conn->close();
}
?>

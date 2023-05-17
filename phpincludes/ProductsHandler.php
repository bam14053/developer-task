<?php
class ProductsHandler {
  private $products;

  function getConnection(){
    return new mysqli(Credentials::$servername, Credentials::$username, Credentials::$password, Credentials::$dbname);
  }

  function getProductsList(){
    //Establishing connection
    $conn = $this->getConnection();

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
        $dvd = new Dvd($row["SKU"], $row["Name"], $row["Price"]);
        $dvd->setSize($row["Size"]);

        $products[$dvd->getSku()] = $dvd;
      }
    }

    //First add all DVDs to the array
    $sql = "SELECT * FROM Product INNER JOIN Furniture ON Product.SKU = Furniture.SKU ORDER BY Product.SKU ASC";
    $result = $conn->query($sql);

    if($result->num_rows > 0){
      while($row = $result->fetch_assoc()){
        $furniture = new Furniture($row["SKU"], $row["Name"], $row["Price"]);
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
        $book = new Book($row["SKU"], $row["Name"], $row["Price"]);
        $book->setWeight($row["Weight"]);

        $products[$book->getSku()] = $book;
      }
    }
    $this->products = $products;
    $conn->close();
  }

  function deleteProducts($skuIDs){
    $conn = $this->getConnection();
    // Check connection
    if ($conn->connect_error) {
      die("Connection to the database failed, please contact the admin for more information");
    }

    foreach ($skuIDs as $skuID){
      $conn->query($this->products[$skuID]->getSQLDeleteSyntax());
      unset($this->products[$skuID]);
    };
  }

  function getSKUs(){
    // //Get a list of all SKUs, so that the user can't insert it twice

    // //Establishing connection
    // $conn = new mysqli(Credentials::$servername, Credentials::$username, Credentials::$password, Credentials::$dbname);

    // // Check connection
    // if ($conn->connect_error) {
    //   die("Connection to the database failed, please contact the admin for more information");
    // }

    // $skus = array();

    // $sql = "SELECT SKU FROM Product ORDER BY SKU ASC";
    // $result = $conn->query($sql);

    // while($skus[] = $result->fetch_assoc()["SKU"]);
    // $conn->close();

    return array_keys($this->products);
  }

  function addProduct($product){
    $conn = $this->getConnection();
    // Check connection
    if ($conn->connect_error) {
      die("Connection to the database failed, please contact the admin for more information");
    }
    $sql = "INSERT INTO Product (SKU,Name,Price) VALUES ('".$product->getSku()."','".$product->getName()."',".$product->getPrice().")";
    if ($conn->query($sql) === TRUE){
      $conn->query($product->getSQLAddSyntax());
      $this->products[$product->getSku()] = $product;
    }
    $conn->close();
  }

  function getProducts(){
    return $this->products;
  }

}
?>

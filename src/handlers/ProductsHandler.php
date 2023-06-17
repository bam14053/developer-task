<?php
class ProductsHandler {
  private $products;
  private $conn;

  public function __construct(){
    $this->conn = new mysqli(Credentials::$servername, Credentials::$username, Credentials::$password, Credentials::$dbname);
    // Check connection
    if ($this->conn->connect_error) {
      die("Connection to the database failed, please contact the admin for more information");
    }

    //Create an empty productsarray
    $products = array();

    //First add all DVDs to the array
    $sql = "SELECT * FROM Product INNER JOIN DVD ON Product.SKU = DVD.SKU ORDER BY Product.SKU ASC";
    $result = $this->conn->query($sql);

    if($result->num_rows > 0){
      while($row = $result->fetch_assoc()){
        $dvd = new Dvd($row["SKU"], $row["Name"], $row["Price"]);
        $dvd->setSize($row["Size"]);

        $products[$dvd->getSku()] = $dvd;
      }
    }

    //First add all DVDs to the array
    $sql = "SELECT * FROM Product INNER JOIN Furniture ON Product.SKU = Furniture.SKU ORDER BY Product.SKU ASC";
    $result = $this->conn->query($sql);

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
    $result = $this->conn->query($sql);

    if($result->num_rows > 0){
      while($row = $result->fetch_assoc()){
        $book = new Book($row["SKU"], $row["Name"], $row["Price"]);
        $book->setWeight($row["Weight"]);

        $products[$book->getSku()] = $book;
      }
    }
    $this->products = $products;
  }

  public function __destruct(){
      $this->conn->close();
  }

  function deleteProducts($skuIDs){
    // Check connection
    if ($this->conn->connect_error) {
      die("Connection to the database failed, please contact the admin for more information");
    }

    foreach ($skuIDs as $skuID){
      $this->conn->query($this->products[$skuID]->getSQLDeleteSyntax());
      unset($this->products[$skuID]);
    };
  }

  function getSKUs(){
    return array_keys($this->products);
  }

  function addProduct(){
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

    // Check connection
    if ($this->conn->connect_error) {
      die("Connection to the database failed, please contact the admin for more information");
    }

    $sql = "INSERT INTO Product (SKU,Name,Price) VALUES ('".$product->getSku()."','".$product->getName()."',".$product->getPrice().")";
    if ($this->conn->query($sql) === TRUE){
      $this->conn->query($product->getSQLAddSyntax());
      $this->products[$product->getSku()] = $product;
    }
  }

  function getProducts(){
    return $this->products;
  }

}
?>

<?php
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
  header('Location: index.php');
}
 ?>

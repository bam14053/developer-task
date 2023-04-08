<?php
require "phpincludes/Credentials.php";
//This is where all the logic resides in
require "phpincludes/ProductsHandler.php";

$skus = getSKUs();
if(isset($_GET['sku'])){
  addProduct();
  header('Location: index.php');
}
 ?>
<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Add new Product</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
</head>
<body>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
  <script
       src="https://code.jquery.com/jquery-3.6.4.min.js"
       integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8="
       crossorigin="anonymous"></script>
  <script>
    // var SKUids = [];
    $(document).ready(function(){
      // fetch("addProduct.php")
      //   .then((response)=>{
      //     if(response.ok) return response.json();
      //   })
      //   .then((data)=>{
      //     SKUids = data;
      //   });
      $("#productType").change(function(){
        $("fieldset.forms:visible").each(function(){
          //Hide any visible forms and remove the required attribute from the input controls as well as the name attribute so it won't be send with the form
          $(this).attr("hidden","hidden");
          $(this).find("input").removeAttr("required");
          $(this).find("input").removeAttr("name");
        });
        switch ($(this).val()) {
          case "DVD":
            $("#dvd-form").removeAttr("hidden");
            $("#dvd-form").find("input").attr("required","required");
            $("#size").attr("name","size");
            break;
          case "Furniture":
            $("#furniture-form").removeAttr("hidden");
            $("#furniture-form").find("input").attr("required","required");
            $("#width").attr("name","width");
            $("#height").attr("name","height");
            $("#length").attr("name","length");
            break;
          case "Book":
            $("#book-form").removeAttr("hidden");
            $("#book-form").find("input").attr("required","required");
            $("#weight").attr("name","weight");
            break;
        }
      });
      $("#sku").on("input",function(){
        if($('#'+$(this).val()).length) $("#sku").get(0).setCustomValidity("SKU already exists");
        else $("#sku").get(0).setCustomValidity("");
      });
    });
  </script>
  <p></p>
  <?php
    foreach($skus as $sku){?>
      <div id="<?php echo $sku;?>" hidden> </div>
    <?php } ?>
  <div class="container">
    <div class="row">
      <div class="col-6">
        <h1>Add Product</h1>
      </div>
      <div class="col-3">
      </div>
      <div class="col-1">
        <button class="btn btn-primary" form="product_form">Save</button>
      </div>
      <div class="col">
        <a type="button" href="index.php" class="btn btn-danger">Cancel</a>
      </div>
    </div>
  </div>
  <hr>
  <form class="form" id="product_form" action="addProduct.php" method="get">
    <fieldset class="align-items-center">
      <div class="row mb-2">
        <label for="sku" class="offset-sm-1 col-sm-1 col-form-label">SKU</label>
        <div class="col-sm-5">
          <input type="text" id="sku" name="sku" class="form-control" required>
        </div>
      </div>
      <div class="row mb-2">
        <label for="name" class="offset-sm-1 col-sm-1 col-form-label">Name</label>
        <div class="col-sm-5">
          <input type="text" id="name" name="name" class="form-control" required>
        </div>
      </div>
      <div class="row mb-2">
        <label for="price" class="offset-sm-1 col-sm-1 col-form-label">Price</label>
        <div class="col-sm-5">
          <input type="number" min="1" id="price" name="price" class="form-control" required>
        </div>
      </div>
    </fieldset>
    <fieldset>
      <div class="row mb-3">
        <label for="productType" class="offset-sm-1 col-sm-2 col-form-label">Type Switcher</label>
        <div class="col-sm-4">
          <select id="productType" name="productType" class="form-control" required>
            <option id="" value="" selected>--Please select a type of product--</option>
            <option id="DVD" value="DVD">DVD</option>
            <option id="Furniture" value="Furniture">Furniture</option>
            <option id="Book" value="Book">Book</option>
          </select>
        </div>
      </div>
    </fieldset>
    <fieldset id="dvd-form" class="forms align-items-center" hidden>
      <div class="row mb-2">
        <label for="size" class="offset-sm-1 col-sm-1 col-form-label">Size (MB)</label>
        <div class="col-sm-5">
          <input type="number" min="1" id="size" class="size form-control" placeholder="Please provide size of DVD">
        </div>
      </div>
    </fieldset>
    <fieldset id="furniture-form" class="forms align-items-center" hidden>
      <div class="row mb-2">
        <label for="height" class="offset-sm-1 col-sm-2 col-form-label">Height (CM)</label>
        <div class="col-sm-5">
          <input type="number" min="1" max="999" id="height" placeholder="Please provide height of furniture" class="height form-control">
        </div>
      </div>
      <div class="row mb-2">
        <label for="width" class="offset-sm-1 col-sm-2 col-form-label">Width (CM)</label>
        <div class="col-sm-5">
          <input type="number" min="1" max="999" placeholder="Please provide width of furniture" id="width" class="width form-control">
        </div>
      </div>
      <div class="row mb-2">
        <label for="length" class="offset-sm-1 col-sm-2 col-form-label">Length (CM)</label>
        <div class="col-sm-5">
          <input type="number" min="1" max="999" id="length" placeholder="Please provide length of furniture" class="length form-control">
        </div>
      </div>
    </fieldset>
    <fieldset id="book-form" class="forms align-items-center" hidden>
      <div class="row mb-2">
        <label for="weight" class="offset-sm-1 col-sm-2 col-form-label">Weight (KG)</label>
        <div class="col-sm-5">
          <input type="number" min="1" max="999" id="weight" placeholder="Please provide weight of book" class="weight form-control">
        </div>
      </div>
    </fieldset>
    <!-- <fieldset id="info" hidden>
      <div class="row mb-2">
        <div class="offset-sm-1 col-sm-4">
          <small id="info-text">Please enter the size of the DVD in MB.</small>
        </div>
      </div>
    </fieldset> -->
  </form>
</body>
</html>

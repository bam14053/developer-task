<?php
//Of course placing the credentials elsewhere where it's not accessible to the public
require "phpincludes/logicRequires.php";
?>
<!DOCTYPE html>
 <html>
 <head>
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <title>Product List</title>
       <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
 </head>
 <body>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
   <script
			  src="https://code.jquery.com/jquery-3.6.4.min.js"
			  integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8="
			  crossorigin="anonymous"></script>
       <script>
          $(document).ready(function(){
            $("#delete-product-btn").on("click",function(){
              var skuIDs = [];
              $(".delete-checkbox:checked").each(function(){
                skuIDs.push($(this).attr("id"));
                $("div#"+$(this).attr("id")).remove();
              });
              if(!skuIDs.length) return;
              $.ajax({
                url: "index.php",
                data: {
                  ids: skuIDs
                },
                type: "POST",
                dataType: "text",
              });
              // $("#delete-product-btn").attr("hidden","hidden");
            });
            // $(".delete-checkbox").change(function(){
            //   if($(".delete-checkbox:checked").length){
            //     if($("#delete-product-btn").is(":hidden")) $("#delete-product-btn").removeAttr("hidden");
            //   }
            //   else
            //       $("#delete-product-btn").attr("hidden","hidden");
            // });
          });
       </script>
   <hr>
   <div class="container">
     <div class="row">
       <div class="col-6">
         <h1>Product List</h1>
       </div>
       <div class="col-3">
       </div>
       <div class="col-1">
         <a role="button" class="btn btn-primary" href="addProduct.php">ADD</a>
       </div>
       <div class="col">
         <button type="button" class="btn btn-danger" id="delete-product-btn">MASS DELETE</button>
       </div>
     </div>
   </div>
   <hr class="border border-top-1">
   <div class="container text-start">
     <div class="row row-cols-5">
       <?php
          foreach($products as $product){?>
            <div class="col" id="<?php echo $product->getSku(); ?>">
              <div class="container">
                <div class="row">
                  <div class="col">
                    <div>
                      <input class="delete-checkbox form-check-input" type="checkbox" id="<?php echo $product->getSku(); ?>">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col align-self-center offset-1">
                    <?php echo $product->getSku();?>
                  </div>
                </div>
                <div class="row">
                  <div class="col align-self-center offset-1">
                    <?php echo $product->getName();?>
                  </div>
                </div>
                <div class="row">
                  <div class="col align-self-center offset-1">
                    <?php echo $product->getPrice();?>$
                  </div>
                </div>
                <div class="row">
                  <div class="col align-self-center offset-1">
                    <?php echo $product->printProductInfo();?>
                  </div>
                </div>
            </div>
          </div>
            <?php
          }
       ?>
     </div>
   </div>
 </body>
 </html>

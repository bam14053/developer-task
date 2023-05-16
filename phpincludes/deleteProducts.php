<?php
//Delete products
if(isset($_POST["ids"])) deleteProducts($_POST["ids"], $_SESSION["products"]);
?>
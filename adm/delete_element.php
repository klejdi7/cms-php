<?php
require 'php/con.php';
require 'php/functions.php';

if(isset($_GET['prod_id']))
{
$id = $_GET['prod_id'];
$element=$pdo->prepare("DELETE FROM produkte WHERE product_id=:id");
$element->bindParam(":id",$id);
$element->execute();
//
echo "
       <script type=\"text/javascript\">
       alert('Elementi u fshi me sukses!');
  location.replace('/products')
           </script>
       ";
}

// brand Delete
else if(isset($_GET['brand_id'])){
$id = $_GET['brand_id'];
$element=$pdo->prepare("DELETE FROM brands WHERE brand_id=:id");
$element->bindParam(":id",$id);
$element->execute();

//
echo "
       <script type=\"text/javascript\">
       alert('Elementi u fshi me sukses!');
  location.replace('/brands')
           </script>
       ";
}

else if(isset($_GET['order_id'])){
$id = $_GET['order_id'];
$element=$pdo->prepare("DELETE FROM orders WHERE order_id=:id");
$element->bindParam(":id",$id);
$element->execute();

$element=$pdo->prepare("DELETE FROM products_purchased WHERE order_id=:id");
$element->bindParam(":id",$id);
$element->execute();
//
echo "
       <script type=\"text/javascript\">
       alert('Elementi u fshi me sukses!');
  location.replace('/orders')
           </script>
       ";
}

// User Delete
else if(isset($_GET['user_id'])){
$id = $_GET['user_id'];
$element=$pdo->prepare("DELETE FROM users WHERE user_id=:id");
$element->bindParam(":id",$id);
$element->execute();
//
echo "
       <script type=\"text/javascript\">
       alert('Elementi u fshi me sukses!');
  location.replace('/users')
           </script>
       ";
}
?>

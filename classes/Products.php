<?php
include_once 'controller/Dbh.php';
Class Product Extends Dbh {

  private $table_name = "produkte";

	public $product_id;
  public $name;
	public $type;
  public $brand;
  public $price;
  public $shteti;

  public $stock;
  public $currency;
  public $stock_price;
  public $created_at;
  public $edited_at;

  // function __construct(){
  //
  //   }
  function product_info($id){
    $prod_id = $id;
    $table = $this->table_name;

    $stmt = $this->connect()->prepare("SELECT * FROM $table WHERE product_id = :prod_id");
    $stmt->bindValue(':prod_id', $prod_id);
    $stmt->execute();
    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    $this->product_id = $product['product_id'];
    $this->name = $product['name'];
    $this->type = $product['type'];
    $this->brand = $product['brand'];
    // $this->stock = $product['stock'];
    $this->stock_price = $product['stock_price'];
    $this->price = $product['price'];

    if($product['shteti'] == 1){
    $this->shteti = "Shqiperi";
    $this->currency = "ALL";

    }
    else if($product['shteti'] == 2){
      $this->shteti = "Kosove";
      $this->currency = "€";
    }
    $this->edited_at = $product['edited_at'];
    $this->created_at = $product['created_at'];
  }

  function getAllProducts(){
    $table = $this->table_name;

    $stmt = $this->connect()->prepare("SELECT * from $table");
    $stmt->execute();
    $products = $stmt->fetchall(PDO::FETCH_ASSOC);

    return $products;
    }

    function getAllSizes(){
      $stmt = $this->connect()->prepare("SELECT * from masat WHERE product_id = '$this->product_id'");
      $stmt->execute();
      $sizes = $stmt->fetchall(PDO::FETCH_ASSOC);

      return $sizes;
      }


  function searchData($term){
    $table = $this->table_name;

    $src = $this->connect() -> prepare("SELECT * FROM produkte WHERE name  LIKE '%".$term."%' OR product_id LIKE '%".$term."%'");
    $src->execute();
    $search = $src->fetchall(PDO::FETCH_ASSOC);
    return $search;
  }

  function updateProduct($id){
    $table = $this->table_name;
    $name = !empty($_POST['name']) ? trim($_POST['name']) : null;
    $type = !empty($_POST['type']) ? trim($_POST['type']) : null;
    $brand = !empty($_POST['brand']) ? trim($_POST['brand']) : null;
    $stock = !empty($_POST['stock']) ? trim($_POST['stock']) : null;
    $price = !empty($_POST['price']) ? trim($_POST['price']) : null;
    $stock_price = !empty($_POST['stock_price']) ? trim($_POST['stock_price']) : null;

    $element=$this->connect()->prepare("UPDATE $table SET name = :name, brand = :brand, stock = :stock,type = :type, stock_price = :stock_price,price= :price WHERE product_id=:id");
    $element->bindValue(":id",$id);
    $element->bindValue(":name",$name);
    $element->bindValue(":brand",$brand);
    $element->bindValue(":stock",$stock);
    $element->bindValue(":stock_price",$stock_price);
    $element->bindValue(":type",$type);
    $element->bindValue(":price",$price);

    $element->execute();
header("Refresh:0");
echo "
       <script type=\"text/javascript\">
       alert('Element updated successfully!');
  location.replace('/product/$id')
           </script>
       ";
}
  }

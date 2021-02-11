<?php require 'controller/Dbh.php';

Class AddProduct Extends Dbh {

  private $table_name = "produkte";

	private $product_id;
  private $name;
	private $type;
  private $brand;
  private $price;
  private $state;
  private $stock;
  private $stock_price;

  function __construct(){
    $this->product_id = !empty($_POST['id']) ? trim($_POST['id']) : null;
    $this->name = !empty($_POST['name']) ? trim($_POST['name']) : null;
    $this->type = !empty($_POST['type']) ? trim($_POST['type']) : null;
    $this->brand = !empty($_POST['brand']) ? trim($_POST['brand']) : null;
    $this->state = !empty($_POST['state']) ? trim($_POST['state']) : null;
    $this->price = !empty($_POST['price']) ? trim($_POST['price']) : null;
    $this->stock = !empty($_POST['stock']) ? trim($_POST['stock']) : null;
    $this->stock_price = !empty($_POST['price_stock']) ? trim($_POST['price_stock']) : null;

    }

  function create_product(){

    $table = $this->table_name;

    $sql = "SELECT COUNT(name) AS num FROM $table WHERE product_id = :product_id";

    $stmt = $this->connect()->prepare($sql);

    $stmt->bindValue(':product_id', $this->product_id);

    $stmt->execute();

    //Fetch the row.
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    global $errors;

    $errors = array();

    if($row['num'] > 0){
      array_push($errors, "Produkti eshte regjistruar me perpara!");
    }
    else{
    $add = "INSERT INTO $table (product_id, name, brand, shteti ,type, stock_price, price, created_at)" . "VALUES (:id ,:name, :brand, :state,:type, :price_stock,:price, CURRENT_TIMESTAMP)";
    $stmt = $this->connect()->prepare($add);

    //Bind our variables.
    $stmt->bindValue(':id', $this->product_id);
    $stmt->bindValue(':name', $this->name);
    $stmt->bindValue(':brand', $this->brand);
    $stmt->bindValue(':type', $this->type);
    $stmt->bindValue(':state', $this->state);
    // $stmt->bindValue(':stock', $this->stock);
    $stmt->bindValue(':price_stock', $this->stock_price);
    $stmt->bindValue(':price', $this->price);

    //Execute the statement and insert the new account.
    $result = $stmt->execute();
    foreach ($_SESSION['sizes'] as $key => $value){
    $add = "INSERT INTO masat (product_id, masa, stok, created_at)" . "VALUES (:id ,:masa, :stok, CURRENT_TIMESTAMP)";
    $stmt = $this->connect()->prepare($add);

    //Bind our variables.
    $stmt->bindValue(':id', $this->product_id);
    $stmt->bindValue(':masa', $key);
    $stmt->bindValue(':stok', $value);
    //Execute the statement and insert the new account.
    $result = $stmt->execute();
  }
    $_SESSION['user_message'] = '<div class="panel panel-default"><h4> Produkti u krijua me sukses!</h4><div>';
    header("location: /success_user");
    exit;
  }
  }

}

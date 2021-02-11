<?php
include_once 'controller/Dbh.php';
Class Order Extends Dbh {

  private $table_name = "orders";

	public $order_id;
  public $cos_fname;
	public $cos_lname;
  // public $cos_email;
  public $cos_nr;
  public $cos_adress;
  public $cos_city;
  public $cos_state;
  public $cos_products;
  public $cos_total;
  public $currency;
  public $status;
  public $created_at;


  // Orders Data Page----------------------

  function orderData($id){
    $order_id = $id;
    $table = $this->table_name;

    $stmt = $this->connect()->prepare("SELECT * FROM $table WHERE order_id = :order_id");
    $stmt->bindValue(':order_id', $order_id);
    $stmt->execute();
    $order = $stmt->fetch(PDO::FETCH_ASSOC);
    $this->order_id = $order['order_id'];
    $this->cos_fname = $order['cos_name'];
    $this->cos_lname = $order['cos_lname'];
    // $this->cos_email = $order['cos_email'];
    $this->cos_nr = $order['cos_nr'];
    $this->cos_adress = $order['cos_adress'];
    $this->cos_city = $order['cos_city'];
    if($order['cos_state'] == 1){
    $this->cos_state = "Shqiperi";
    $this->currency = "ALL";
    }
    else if($order['cos_state'] == 2){
      $this->cos_state = "Kosove";
      $this->currency = "€";
    }
    $this->cos_products = $order['cos_products'];
    $this->cos_total = $order['cos_total'];
    $this->status = $order['status'];
    $this->created_at = $order['created_at'];
  }

  function getAllOrders(){
    $table = $this->table_name;
    $src = $this->connect() -> prepare("SELECT * FROM $table");
    $src->execute();
    $orders = $src->fetchall(PDO::FETCH_ASSOC);
    return $orders;
  }


  function productsPurchased($id){
    $stmt = $this->connect()->prepare('SELECT * FROM products_purchased WHERE order_id = :order_id');
    $stmt->bindValue(':order_id', $id);
    $stmt->execute();
    $purchased = $stmt->fetchall(PDO::FETCH_ASSOC);
    return $purchased;
  }

  function searchData($term){
  $table = $this->table_name;

  $src = $this->connect() -> prepare("SELECT * FROM $table WHERE cos_name  LIKE '%".$term."%' OR order_id LIKE '%".$term."%'");
  $src->execute();
  $search = $src->fetchall(PDO::FETCH_ASSOC);
  return $search;
}

// --------------------------

  // Create Order --------------
  function AddToList($pr){
  $id = !empty($_POST['product']) ? trim($_POST['product']) : null;
  $size = !empty($_POST['size']) ? trim($_POST['size']) : null;
  $quantity = !empty($_POST['quantity']) ? trim($_POST['quantity']) : null;
  $stmt = $this->connect()->prepare("SELECT * FROM produkte WHERE product_id = :prod_id");
  $stmt->bindValue(':prod_id', $id);
  $stmt->execute();
  $prod = $stmt->fetch(PDO::FETCH_ASSOC);
  $price = "";
  $currency = "";
  if($pr == 2){
    $price = $prod['price'] * 0.0081;
    $currency = "€";
    // settype($price, "integer");
  $v=array($prod['product_id'],$prod['name'],$prod['brand'],$size,$quantity,$price,$price * $quantity,$currency);
}
else{
  $price = $prod['price'];
  $currency = "€";
  $v=array($prod['product_id'],$prod['name'],$prod['brand'],$size,$quantity,$price,$price * $quantity,$currency);
}
  array_push($_SESSION['prods'] , $v);
  header("Refresh:0");
}

   function create_order(){

     $table = $this->table_name;
     $order_id = rand(111111, 99999);
     $products = count($_SESSION['prods']);

     $fname = !empty($_POST['fname']) ? trim($_POST['fname']) : null;
     $lname = !empty($_POST['lname']) ? trim($_POST['lname']) : null;
     $cel = !empty($_POST['cel']) ? trim($_POST['cel']) : null;
     $city = !empty($_POST['city']) ? trim($_POST['city']) : null;
     $adress = !empty($_POST['adress']) ? trim($_POST['adress']) : null;
     $state = $_GET['shteti'];
     $total = !empty($_POST['total']) ? trim($_POST['total']) : null;

       $add = "INSERT INTO $table (order_id, cos_name, cos_lname, cos_nr, cos_adress, cos_city, cos_state, cos_products, cos_total, created_at)"
                        . "VALUES (:id ,      :fname,    :lname,   :cel,    :adress,    :city,    :state,       :prods    ,:total, CURRENT_TIMESTAMP)";
     $stmt = $this->connect()->prepare($add);

     //Bind our variables.
     $stmt->bindValue(':id', $order_id);
     $stmt->bindValue(':fname', $fname);
     $stmt->bindValue(':lname', $lname);
     $stmt->bindValue(':cel', $cel);
     $stmt->bindValue(':city', $city);
     $stmt->bindValue(':adress', $adress);
     $stmt->bindValue(':state', $state);
     $stmt->bindValue(':total', $total);
     $stmt->bindValue(':prods', $products);

     //Execute the statement and insert the new account.
     $result = $stmt->execute();

     // ------------------- Products INFO -----------------------------
 foreach ($_SESSION['prods'] as $cartd){

    $product_id = $cartd[0];
    $product = $cartd[1];
    $brand = $cartd[2];
    $size = $cartd[3];
    $q = $cartd[4];
    $price = $cartd[5];
    $total = $cartd[6];


    $sq = "INSERT INTO products_purchased (order_id, product_id , prod_name, prod_brand, prod_size, prod_price, prod_quantity, price_total, cos_name, created_at)" . "VALUES (:order_id, :product_id, :product, :brand, :size, :price, :quantity, :total, :cos_name, CURRENT_TIMESTAMP)";
    $pro = $this->connect()->prepare($sq);

    $pro->bindValue(':order_id', $order_id);
    $pro->bindValue(':product_id', $product_id);
    $pro->bindValue(':product', $product);
    $pro->bindValue(':brand', $brand);
    $pro->bindValue(':size', $size);
    $pro->bindValue(':quantity', $q);
    $pro->bindValue(':price', $price);
    $pro->bindValue(':total', $total);
    $pro->bindValue(':cos_name', $fname);

    $result = $pro-> execute();

    $element=$this->connect()->prepare("UPDATE masat SET stok = stok - :stock WHERE product_id=:id AND masa = '$size'");
    $element->bindValue(":id",$product_id);
    $element->bindValue(":stock",$q);
    $results = $element->execute();
}
     $_SESSION['user_message'] = '<div class="panel panel-default"><h4> Porosia u krijua me sukses!</h4><div>';
     header("location: /success_user");
     unset($_SESSION['prods']);
     exit;
   }

  function getAllSizes($id){
    $stmt = $this->connect()->prepare("SELECT * from masat Where product_id = '$id' AND stok > 0");
    $stmt->execute();
    $sizes = $stmt->fetchall(PDO::FETCH_ASSOC);

    return $sizes;
    }


    function getAllProductsClothes(){
      $table = "produkte";

      $stmt = $this->connect()->prepare("SELECT * from $table  where type = 'Veshje'");
      $stmt->execute();
      $products = $stmt->fetchall(PDO::FETCH_ASSOC);

      return $products;
      }

      function getAllProductsShoes(){
        $table = "produkte";

        $stmt = $this->connect()->prepare("SELECT * from $table Where  type = 'Kepuce'");
        $stmt->execute();
        $products = $stmt->fetchall(PDO::FETCH_ASSOC);

        return $products;
        }
    // ----------------------

  // HOME PAGE ----------
  function getNumberOrders(){
    $table = $this->table_name;

    $src = $this->connect() -> prepare("SELECT * FROM orders");
    $src->execute();
    $no = $src->fetchall(PDO::FETCH_ASSOC);
    return count($no);
  }

  function getMoneyTotalAlbania(){
  $st = $this->connect()->prepare("SELECT SUM(cos_total) AS total FROM orders Where cos_state = 1");
  $st->execute();
  $row = $st->fetch(PDO::FETCH_ASSOC);
  $all_total = $row['total'];
  return $all_total;
  }

  function getMoneyTotalKosovo(){
  $st = $this->connect()->prepare("SELECT SUM(cos_total) AS total FROM orders Where cos_state = 2");
  $st->execute();
  $row = $st->fetch(PDO::FETCH_ASSOC);
  $all_total = $row['total'];
  return $all_total;
  }

  function getHomeOrders(){
    $table = $this->table_name;

    $src = $this->connect() -> prepare("SELECT * FROM orders LIMIT 3");
    $src->execute();
    $limit = $src->fetchall(PDO::FETCH_ASSOC);
    return $limit;
  }
  // -------------------------
}

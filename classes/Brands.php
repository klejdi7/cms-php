<?php
include_once 'controller/Dbh.php';

Class Brand Extends Dbh {

  private $table_name = "brands";

      public $brand_id;
      public $brand_name;
      public $created_at;

      function allBrands(){
          $table = $this->table_name;

          $stmt = $this->connect()->prepare("SELECT * from $table");
          $stmt->execute();
          $brands = $stmt->fetchAll();
          return $brands;

      }

      function create_brand(){
        $name = !empty($_POST['brand_name']) ? trim($_POST['brand_name']) : null;
        $sql = "SELECT COUNT(brand_name) AS num FROM brands WHERE brand_name = :brand_name";
        $stmt = $this->connect()->prepare($sql);

        $stmt->bindValue(':brand_name', $name);

        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

            global $errors;
            $errors = array();

        if($row['num'] > 0){
          array_push($errors, "Brand eshte regjistruar me perpara!");

        }
        else{
        $add = "INSERT INTO brands (brand_name, created_at)" . "VALUES (:title ,CURRENT_TIMESTAMP)";
        $stmt = $this->connect()->prepare($add);

        //Bind our variables.
        $stmt->bindValue(':title', $name);

        //Execute the statement and insert the new account.
        $result = $stmt->execute();
        header("location: /brands");
        exit;
    }

      }
}
?>

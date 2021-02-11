<?php
include_once 'controller/Dbh.php';

class UserSet extends Dbh {
  private $user_id;
  private $username;
  private $name;
  private $password;

    function __construct($username, $password){
      $this->username = $username;
      $this->password = $password;
  }

  function createUser(){
    $name = !empty($_POST['name']) ? trim($_POST['name']) : null;
    $role = $_POST['role'];
    $account_id = rand(111111, 99999);

    // $sql = "SELECT COUNT(username) AS num FROM users WHERE username = :username";
    //
    // $stmt = $this->connect()->prepare($sql);
    //
    // $stmt->bindValue(':username', $this->username );
    //
    // //Execute.
    // $stmt->execute();
    //
    // //Fetch the row.
    // $row = $stmt->fetch(PDO::FETCH_ASSOC);
    //
    //  if($row['num'] > 0){
    //   $_SESSION['error'] = '<div class="info-alert">Perdoruesi me kete username eshte regjistruar me pare!</div>';
    // }
    // else{

    $passwordHash = password_hash($this->password, PASSWORD_BCRYPT, array("cost" => 12));

    $sql = "INSERT INTO users (user_id, username ,password, name, role, created_at)" . "VALUES (:account_id ,:username, :password, :name,:role, CURRENT_TIMESTAMP)";
    $stmt = $this->connect()->prepare($sql);

    //Bind our variables.
    $stmt->bindValue(':username', $this->username);
    $stmt->bindValue(':password', $passwordHash);
    $stmt->bindValue(':name', $name);
    $stmt->bindValue(':role', $role);
    $stmt->bindValue(':account_id', $account_id);


    //Execute the statement and insert the new account.
    $result = $stmt->execute();
    $_SESSION['user_message'] = '<div class="panel panel-default"><h1> Perdoruesi <span class="badge badge-secondary">#'.$account_id.'</span></h1><h4> Perdoruesi u krijua me sukses </h4><div>';
    header("location: success_user");
  }


  function loginUser() {
    // Retrieve the user account information for the given username.
    $sql = "SELECT * FROM users WHERE username = :username";
    $stmt = $this->connect()->prepare($sql);

    //Bind value.
    $stmt->bindValue(':username', $this->username);

    //Execute.
    $stmt->execute();

    //Fetch row.
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    global $errors;

    //If $row is FALSE.
    if($user === false){
        //Could not find a user with that username!
        //PS: You might want to handle this error in a more user-friendly manner!
        array_push($errors, "Perdoruesi me kete username nuk ekziston!");
    } else{
      $validPassword = password_verify($this->password, $user['password']);
      if($validPassword){
        $this->setCredentails($user['user_id'], $user['name']);
        $this->sessionUser();
        header("location: /home");
        exit;
      }
      else{
          //$validPassword was FALSE. Passwords do not match.
          array_push($errors, "Password i vendosur gabim!");
      }
    }
  }
  protected function setCredentails($user_id,$name) {
    $this->user_id = $user_id;
    $this->name = $name;
  }
  protected function sessionUser(){
    $_SESSION['user_id'] = $this->user_id;
    $_SESSION['logged_in'] = true;
    $_SESSION['username'] = $this->username;
    }
}

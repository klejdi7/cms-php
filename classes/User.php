<?php
include_once 'controller/Dbh.php';

class User Extends Dbh{

	// database connection and table name
	private $table_name = "users";

	// object properties
	public $user_id;
  public $username;
	public $name;
	public $email;
  public $role;
  public $created_at;

      function __construct($user_id){
        $this->user_id = $user_id;
        }

		public function getAllUsers(){
			$table = $this->table_name;
			$src = $this->connect() -> prepare("SELECT * FROM $table");
			$src->execute();
			$users = $src->fetchall(PDO::FETCH_ASSOC);
			return $users;
		}

    public function getUserData(){
      $user_id = $this->user_id;
      $table = $this->table_name;
      // $stmt = $this->connect()->prepare("SELECT * from $table WHERE user_id=?");
      // $stmt->execute([$user_id]);
			//
      //   while($row = $stmt->fetch()){
      //     $data[] = $row;
      //   }
      //   return $data;
			$stmt = $this->connect()->prepare("SELECT * FROM $table WHERE user_id = :user_id");
			$stmt->bindValue(':user_id', $user_id);
			$stmt->execute();
			$user = $stmt->fetch(PDO::FETCH_ASSOC);
			$this->username = $user['username'];
			$this->name = $user['name'];
			$this->role = $user['role'];
			$this->created_at = $user['created_at'];

}

}
?>

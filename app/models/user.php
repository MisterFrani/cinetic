<?php
class User {

	private $sTable;

	public function __construct()
	{
		$this->sTable = TABLE_USERS;
	}

	public function register($dataForm){
		global $db;
		global $help;

		$data = [
			"firstname"=> $help->text($dataForm["firstname"]),
			"lastname"=> $help->text($dataForm["lasttname"]),
			"email"=> $dataForm["email"],
			"password"=> $help->cryptPass($dataForm["password"]),
			"birthday"=> $dataForm["birthday"],
			"sexe"=> $dataForm["sexe"],
			"avatar"=> AVATAR_DEFAULT,
			"statusId"=> STANDBY,
			"isConnected"=> V_FALSE

		];
		
		$queryVerif = "SELECT * FROM $this->sTable WHERE email = ?";
		$verif = $db->sqlSingleResult($queryVerif, ["email"=> $data["email"]]);
		if($verif) {
			return "email_exist";
		}

		$queryInsert = "INSERT INTO $this->sTable(firstname, lastname, email,password, birthday, sexe, avatar, statusId, isConnected, createdAt) VALUES(?,?,?,?,?,?,?,?,?, NOW()"; 
		$db->sqlSimpleQuery($queryInsert, $data);
		return "success";

	}


	public function login ($login){
		global $db;
		global $help;

		$data = [
			"email"=> $dataForm["email"],
			"password"=> $help->cryptPass($dataForm["password"])	
		];

		$query = "SELECT * FROM $this->sTable WHERE email = ? AND password = ?";
		$user = $db->sqlSingleResult($query, $data);
		if($user) {
			if($user->statusId == ACTIVE) {
				$_SESSION["cinetic"] = $user->id;

				$db->sqlSimpleQuery("UPDATE $this->sTable  SET lastConnected = NOW() WHERE id = ?", ["id"=>$user->id]);
				return "connected";
			}
			else {
				return $user->statusId;
			}
		} else {
			return "not_exist";
		}	
	}
	//
	public function getUser ($id){
		global $db;
		global $help;

		$query = "SELECT * FROM $this->sTable WHERE id = ?";
		$user = $db->sqlSingleResult($query, ["id"=> $id]);
		return $user;
	}
	// recuperer la liste desz utilisateurs
	public function getUsers($status = null) {
		global $db;
		global $help;

		$query = "SELECT * FROM $this->sTable";
		$data = [];
		if ($status){
			$query .= " WHERE statusId= ?";
			$data = ["statusId"=>$status]; 
		}
		$users = $db->sqlManyResults($query, $data);
		return $users;
	}

	// modi
	public function editUser($dataForm){
		global $db;
		global $help;

		$data = [
			"firstname"=> $help->text($dataForm["firstname"]),
			"lastname"=> $help->text($dataForm["lasttname"]),
			"email"=> $dataForm["email"]
		];

		$data["id"]=$dataForm["id"]

	}



}
?>

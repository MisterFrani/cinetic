<?php
class Friend {

	private $sTable;

	public function __construct()
	{
		$this->sTable = TABLE_FRIENDS;
	}

	public function follow($dataForm){
		global $db;
		global $help;

		$data = [
			"id_user"=> $dataForm["id_user"],
			"follower"=> $dataForm["follower"]
		];

		$verif =  $db->sqlSingleResult("SELECT * FROM $this->sTable WHERE id_user = ? AND follower = ?", ["id_user"=>$id_user, "follower"=>$follower]);

		if(!$verif){
			$query = "INSERT INTO $this->sTable(id_user, follower, date) VALUES(?,?, NOW())"; 
			$db->sqlSimpleQuery($query, $data);
		}
		return "success";
	}


	public function removeFollower($userId, $follower) {
		global $db;
		global $help;

		$db->sqlSimpleQuery("DELETE FROM $this->sTable WHERE userId = ? AND follower = ?", ["userId"=>$userId, "follower"=>$follower]);
		return "removed";
	}

	//Liste des personnes qui me suivent
	public function getFollows($userId) {
		global $db;
		global $help;

		$query = "SELECT * FROM $this->sTable WHERE userId = ?";
		$followers = $db->sqlManyResults($query, ["userId"=>$userId]);
		return $followers;
	}

	//Liste des personnes que je suis
	public function getToFollow($follower) {
		global $db;
		global $help;

		$query = "SELECT * FROM $this->sTable WHERE follower = ?";
		$followers = $db->sqlManyResults($query, ["follower"=>$follower]);
		return $followers;
	}
}
?>

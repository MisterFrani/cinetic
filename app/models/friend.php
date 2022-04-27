<?php
class Friend {

	private $sTable;

	public function __construct()
	{
		$this->sTable = TABLE_FRIENDS;
    
		$this->sTableUsers = TABLE_USERS;
	}

	public function follow($follow){
    
		global $db;
		global $help;

		$data = [
			"id_user"=> $follow,
			"follower"=> $_SESSION['cinetic']
		];

		$verif =  $db->sqlSingleResult("SELECT * FROM $this->sTable WHERE id_user = ? AND follower = ?", $data);

		if(!$verif){
			$query = "INSERT INTO $this->sTable(id_user, follower, date) VALUES(?,?, NOW())"; 
			$db->sqlSimpleQuery($query, $data);
			return "follow";

		} else {
			$db->sqlSimpleQuery("DELETE FROM $this->sTable WHERE id = ?", ["id"=>$verif->id]);
			return "unfollow";
		}
	}

	public function removeFollow($id){
		global $db;
		global $help;

		$db->sqlSimpleQuery("DELETE FROM $this->sTable WHERE id = ?", ["id"=>$id]);
		return "remove";
	}

	//Liste des personnes qui me suivent
	public function getFollows($userId) {
		global $db;
		global $help;

		$query = "SELECT f.id_user, f.id, f.follower, u.firstname, u.lastname, u.email, u.birthday, u.sexe, u.avatar, u.isConnected, u.lastConnected
			FROM $this->sTable f 
			INNER JOIN $this->sTableUsers u ON u.id = f.follower
			WHERE f.id_user = ?";
		$followers = $db->sqlManyResults($query, ["id_user"=>$userId]);

		return $followers;
	}

	//Liste des personnes que je suis
	public function getToFollow($follower) {
		global $db;
		global $help;


		$query = "SELECT f.id_user, f.id, f.follower, u.firstname, u.lastname, u.email, u.birthday, u.sexe, u.avatar, u.isConnected, u.lastConnected
		FROM $this->sTable f 
		INNER JOIN $this->sTableUsers u ON u.id = f.id_user
		WHERE f.follower = ?";

		$followers = $db->sqlManyResults($query, ["follower"=>$follower]);
		return $followers;
	}
}
?>

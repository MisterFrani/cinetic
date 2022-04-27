<?php
class Post {

	private $sTable;

	public function __construct()
	{
		$this->sTable = TABLE_POSTS;
		$this->sTableComment = TABLE_COMMENTS;
		$this->sTableLike = TABLE_LIKES;
		$this->sTableUsers = TABLE_USERS;
	}

	public function publish($dataForm){
		global $db;
		global $help;

		$data = [
			"content"=> trim($dataForm["content"]) ? $help->text($dataForm["content"]) : NULL,
			"userId"=> $_SESSION['cinetic'],
			"statusId"=> ACTIVE,
			"image"=> NULL,
			"type_image" => NULL
		];

		if($help->text($dataForm["link"])){
			$data["image"] = $help->text($dataForm["link"]);
			$data["type_image"] = "YOUTUBE";
		}

		if(isset($_FILES['image']) && $_FILES['image']['name'] != ""){
			$image = $help->uploadFile($_FILES['image'], REP_POST);
			if(!$image){
				return 'format_file';
			}
			$data["image"]=$image;
			$data["type_image"] = $_FILES['image']["type"];
		}

		$query = "INSERT INTO $this->sTable(content, userId, statusId, image, type_image, createdAt, updatedAt) VALUES(?,?,?,?,?, NOW(), NOW())"; 
		$db->sqlSimpleQuery($query, $data);
		return "success";
	}

	//
	public function getPostsForMe($id, $status = null){
		global $db;
		global $help;

		$query = "SELECT p.id, p.content, p.userId, p.statusId, p.createdAt, p.updatedAt, p.image, p.type_image, 
					u.firstname, u.lastname, u.email, u.birthday, u.sexe, u.avatar, u.isConnected, u.lastConnected
					FROM $this->sTable p 
					INNER JOIN $this->sTableUsers u ON u.id = p.userId 
					WHERE p.userId = ? ";
		$data = ["userId"=>$id];
		if ($status){
			$query .= " AND p.statusId= ?";
			$data = ["statusId"=>$status]; 
		}
		$query .= " ORDER BY p.createdAt DESC";
		$posts = $db->sqlManyResults($query, $data);
		return $posts;
	}

	// recuperer la liste des posts
	public function getPosts($status = null) {
		global $db;
		global $help;

		$query = "SELECT p.id, p.content, p.userId, p.statusId, p.createdAt, p.updatedAt, p.image, p.type_image, 
					u.firstname, u.lastname, u.email, u.birthday, u.sexe, u.avatar, u.isConnected, u.lastConnected
					FROM $this->sTable p 
					INNER JOIN $this->sTableUsers u ON u.id = p.userId ";
		$data = [];
		if ($status){
			$query .= " WHERE p.statusId= ?";
			$data = ["statusId"=>$status]; 
		}
		$query .= " ORDER BY p.createdAt DESC";
		$posts = $db->sqlManyResults($query, $data);
		return $posts;
	}

	// recuperer la liste des posts
	public function deletePost($id) {
		global $db;
		global $help;

		$db->sqlSimpleQuery("DELETE FROM $this->sTable WHERE id = ?", ["id"=>$id]);
		$db->sqlSimpleQuery("DELETE FROM $this->sTableComment WHERE postId = ?", ["postId"=>$id]);
		$db->sqlSimpleQuery("DELETE FROM $this->sTableLike WHERE postId = ?", ["postId"=>$id]);

		return "deleted";
	}

	// modi
	public function editPost($dataForm){
		global $db;
		global $help;

		$data = [
			"content"=> $help->text($dataForm["content"]),
		];

		$query = "UPDATE $this->sTable SET content = ?, updatedAt = NOW() WHERE id = ?"; 

		if(isset($_FILES['image']) && $dataForm['image'] != ""){
			$image = $help->uploadFile($_FILES['image'], REP_POST);
			if(!$image){
				return 'format_file';
			}
			$data["image"]=$image;
			$query = "UPDATE $this->sTable SET content = ?, image = ?, updatedAt = NOW() WHERE id = ?"; 
		}

		$data["id"]=$dataForm["id"];

		$db->sqlSimpleQuery($query, $data);
		return "updated";
	}

	public function createComment($dataForm){
		global $db;
		global $help;

		$data = [
			"content"=> $help->text($dataForm["content"]),
			"userId"=> $_SESSION['cinetic'],
			"postId"=> $dataForm["postId"]
		];

		$query = "INSERT INTO $this->sTableComment(content, userId, postId, createdAt, updatedAt) VALUES(?,?,?, NOW(), NOW())"; 
		$db->sqlSimpleQuery($query, $data);
		return "success";
	}

	public function getComments($postId) {
		global $db;
		global $help;

		$query = "SELECT c.id, c.content, c.userId, c.postId, c.createdAt, c.updatedAt,
		u.firstname, u.lastname, u.email, u.birthday, u.sexe, u.avatar, u.isConnected, u.lastConnected
		FROM $this->sTableComment c
		INNER JOIN $this->sTableUsers u ON u.id = c.userId
		WHERE c.postId = ? ORDER BY c.createdAt ASC";
		$comments = $db->sqlManyResults($query, ["postId"=>$postId]);
		return $comments;
	}
	
	public function deleteComment($id) {
		global $db;
		global $help;

		$db->sqlSimpleQuery("DELETE FROM $this->sTableComment WHERE id = ?", ["id"=>$id]);
		return "deleted";
	}

	public function like($postId) {
		global $db;
		global $help;

		$getLike = $db->sqlSingleResult("SELECT * FROM $this->sTableLike WHERE postId = ? AND userId = ?", ["postId"=>$postId, "userId"=>$_SESSION['cinetic']]);
		if(!$getLike){
			$db->sqlSimpleQuery("INSERT INTO $this->sTableLike(postId, userId) VALUES(?,?)", ["postId"=>$postId, "userId"=>$_SESSION['cinetic']]);
			return "liked";
		}
		else {
			$db->sqlSimpleQuery("DELETE FROM $this->sTableLike WHERE postId = ? AND userId = ?", ["postId"=>$postId, "userId"=>$_SESSION['cinetic']]);
			return "disliked";
		}
		
	}

	public function getLikes($postId) {
		global $db;
		global $help;

		$query = "SELECT * FROM $this->sTableLike WHERE postId = ?";
		$likes = $db->sqlManyResults($query, ["postId"=>$postId]);
		return $likes;
	}

}
?>

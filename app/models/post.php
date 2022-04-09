<?php
class Post {

	private $sTable;

	public function __construct()
	{
		$this->sTable = TABLE_POSTS;
		$this->sTableComment = TABLE_COMMENTS;
		$this->sTableLike = TABLE_LIKES;
	}

	public function publish($dataForm){
		global $db;
		global $help;

		$data = [
			"content"=> $help->text($dataForm["content"]),
			"userId"=> $dataForm["userId"],
			"statusId"=> ACTIVE,
			"image"=> NULL
		];

		if(isset($_FILES['image']) && $dataForm['image'] != ""){
			$image = $help->uploadFile($_FILES['image'], REP_POST);
			if(!$image){
				return 'format_file';
			}
			$data["image"]=$image;
		}

		$query = "INSERT INTO $this->sTable(content, userId, statusId, image, createdAt, updatedAt) VALUES(?,?,?,?, NOW(), NOW())"; 
		$db->sqlSimpleQuery($query, $data);
		return "success";

	}

	//
	public function getPost ($id){
		global $db;
		global $help;

		$query = "SELECT * FROM $this->sTable WHERE id = ?";
		$post = $db->sqlSingleResult($query, ["id"=> $id]);
		return $post;
	}

	// recuperer la liste des posts
	public function getPosts($status = null) {
		global $db;
		global $help;

		$query = "SELECT * FROM $this->sTable";
		$data = [];
		if ($status){
			$query .= " WHERE statusId= ?";
			$data = ["statusId"=>$status]; 
		}
		$query .= " ORDER BY createdAt DESC";
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
			"userId"=> $dataForm["userId"],
			"postId"=> $dataForm["postId"]
		];

		$query = "INSERT INTO $this->sTableComment(content, userId, postId, createdAt, updatedAt) VALUES(?,?,?, NOW(), NOW())"; 
		$db->sqlSimpleQuery($query, $data);
		return "success";
	}

	public function getComments($postId) {
		global $db;
		global $help;

		$query = "SELECT * FROM $this->sTableComment WHERE postId = ? ORDER BY createdAt DESC";
		$comments = $db->sqlManyResults($query, ["postId"=>$postId]);
		return $comments;
	}
	
	public function deleteComment($id) {
		global $db;
		global $help;

		$db->sqlSimpleQuery("DELETE FROM $this->sTableComment WHERE id = ?", ["id"=>$id]);
		return "deleted";
	}

	public function dislike($postId, $userId) {
		global $db;
		global $help;

		$db->sqlSimpleQuery("DELETE FROM $this->sTableLike WHERE postId = ? AND userId = ?", ["postId"=>$postId, "userId"=>$userId]);
		return "disliked";
	}

	public function like($postId, $userId) {
		global $db;
		global $help;

		$getLike = $db->sqlSingleResult("SELECT * FROM $this->sTableLike WHERE postId = ? AND userId = ?", ["postId"=>$postId, "userId"=>$userId]);
		if(!$getLike){
			$db->sqlSimpleQuery("INSERT INTO $this->sTableLike(postId, userId) VALUES(?,?)", ["postId"=>$postId, "userId"=>$userId]);
		}
		
		return "liked";
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

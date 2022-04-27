<?php
class Message {

	private $sTable;

	public function __construct()
	{
		$this->sTable = TABLE_MESSAGES;
	}

	public function send($dataForm){
		global $db;
		global $help;

		$data = [
			"content"=> $help->text($dataForm["content"]),
			"exp"=> $_SESSION['cinetic'],
			"dest"=> $dataForm["dest"],
			"viewed"=> V_FALSE
		];

		$query = "INSERT INTO $this->sTable(content, exp, dest, viewed, createdAt) VALUES(?,?,?,?, NOW())"; 
		$db->sqlSimpleQuery($query, $data);
		return "success";

	}

	// recuperer la liste des conversations
	public function getConversations($userId) {
		global $db;
		global $help;

		$query = "SELECT exp, dest, createdAt, content, viewed FROM $this->sTable WHERE (exp = ? OR dest = ?) 
		GROUP BY exp, dest
		ORDER BY createdAt DESC";
		$messages = $db->sqlManyResults($query, ["exp"=>$userId, "dest"=>$userId]);
		return $messages;
	}

	// recuperer la liste des messages
	public function getMessages($exp, $dest) {
		global $db;
		global $help;

		$query = "SELECT * FROM $this->sTable WHERE (exp = $exp AND dest = $dest) OR (dest = $exp AND exp = $dest) ORDER BY createdAt ASC";
		$convesations = $db->sqlManyResults($query);

		return $convesations;
	}

	public function deleteMessage($id) {
		global $db;
		global $help;

		$db->sqlSimpleQuery("DELETE FROM $this->sTable WHERE id = ?", ["id"=>$id]);
		return "deleted";
	}

	public function deleteConversation($exp, $dest) {
		global $db;
		global $help;

		$db->sqlSimpleQuery("DELETE FROM $this->sTable WHERE exp = ? AND dest = ?", ["exp"=>$exp, "dest"=>$dest]);
		return "deleted";
	}	
}
?>

<?php  
include("init.php");

$json = file_get_contents('php://input');
$data = json_decode($json, true);
$result = array();

if(is_array($data))
{
    $send = $msg->send($data);
    $dest = $usr->getUser($data['dest']);
    $exp = $usr->getUser($_SESSION['cinetic']);
    $messages = $msg->getMessages($exp->id, $dest->id);

    include("messages-socket.php");
    $result["error"] = null;
    $result["result"] = $message;
}
else{
    $result["error"] = 'Erreur des données';
    $result["result"] = null;
}
echo json_encode($result);

include("close.php");
?>
<?php  
include("init.php");

$json = file_get_contents('php://input');
$data = json_decode($json, true);
$result = array();

if(is_array($data))
{
    $create = $fo->follow($data['id_user']);
    $id_user = $data['id_user'];

    include('card-users.php');

    $result["error"] = null;
    $result["result"] = $block;
}
else{
    $result["error"] = 'Erreur des données';
    $result["result"] = null;
}
echo json_encode($result);

include("close.php");
?>
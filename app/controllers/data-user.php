<?php 
$toFollow = $fo->getToFollow($_SESSION['cinetic']);
$follows = $fo->getFollows($_SESSION['cinetic']);
$friends = array_merge($toFollow, $follows);

$conversations = $msg->getConversations($_SESSION['cinetic']);

$array = [];
foreach($conversations as $item){ 
    $idUserMsg = $item->dest == $user->id ? $item->exp : $item->dest;
    $getUser = $usr->getUser($idUserMsg);
    $array[] = $getUser;
}
$temp = array_unique(array_column($array, 'id'));
$getUsers = array_intersect_key($array, $temp);
?>
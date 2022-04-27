<?php 
$toFollow = $fo->getToFollow($_SESSION['cinetic']);
$follows = $fo->getFollows($_SESSION['cinetic']);
$friends = array_merge($toFollow, $follows);

$conversations = $msg->getConversations($_SESSION['cinetic']);
?>
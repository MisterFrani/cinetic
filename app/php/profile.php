<?php 
$getUser = $usr->getUser($_GET["user"]);
$toFollow = $fo->getToFollow($_GET["user"]);
$toFollowMe = $fo->getToFollow($_SESSION['cinetic']);
$follows = $fo->getFollows($_GET["user"]);
$posts = $post->getPostsForMe($_GET["user"]);

$friends = array_merge($toFollow, $follows);

$iam_follow = array_search($_GET["user"], array_column($toFollowMe, 'id_user')); 
$dest = $getUser->id;
?>
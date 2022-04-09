<?php
session_start();
ini_set('display_errors',1);
error_reporting(1);

setlocale(LC_TIME, 'fr', 'fr_FR', 'fr_FR.ISO8859-1');

include_once('./../includes/config.php');

require_once('./../models/Helper.php');
require_once('./../models/query.php');
require_once('./../models/user.php');
require_once('./../models/post.php');
require_once('./../models/friend.php');
require_once('./../models/message.php');

$db  = new Query();
$help = new Helper();
$usr = new User();
$post = new Post();
$fo = new Friend();
$msg = new Message();


?>

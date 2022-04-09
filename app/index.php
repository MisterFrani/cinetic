<?php
session_start();
ini_set('display_errors',1);
error_reporting(1);

setlocale(LC_TIME, 'fr', 'fr_FR', 'fr_FR.ISO8859-1');

include_once('includes/config.php');


require_once('models/Helper.php');
require_once('models/query.php');
require_once('models/user.php');
require_once('models/post.php');
require_once('models/friend.php');
require_once('models/message.php');



$db  = new Query();
$help = new Helper();
$usr = new User();
$post = new Post();
$fo = new Friend();
$msg = new Message();

$page = htmlentities($_GET['p']);
$errors = scandir('views');

// print_r($errors);
if(isset($_GET['p'])){
	if(in_array($_GET['p'].".php",$errors)){
		$displayedPage = $page;
	}else{
		header('location:?p=404');
	}
}else{
	header('location:?p=home');
}

switch($displayedPage){
	case 'sign-up':
	case 'forgot':
	case 'sign-in':
		$headerfootersuffix = '_auth';
	break;
	case '404':
		$headerfootersuffix = '_other';
	break;
	default :
		$headerfootersuffix = '_app';
	break;
}



@include_once('php/'.$displayedPage.'.php');

include_once('includes/layout/header'.$headerfootersuffix.'.php');

include_once('views/'.$displayedPage.'.php');

include_once('includes/layout/footer'.$headerfootersuffix.'.php');


unset($db);
unset($GLOBALS);

?>

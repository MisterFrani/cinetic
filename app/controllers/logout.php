<?php 

include("init.php");

$db->sqlSimpleQuery("UPDATE ".TABLE_USERS."  SET isConnected = 0 WHERE id = ?", ["id"=>$_SESSION['cinetic']]);
$logout = $help->logout();

header("location:../");

include("close.php");

?>
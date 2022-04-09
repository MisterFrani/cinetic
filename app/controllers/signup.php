<?php  
include("init.php");

$dataForm = $_REQUEST;
if (!$help->verifMail($dataForm["email"])) {
    echo "Le format de votre mail est incorrecte";
}else {
    $create = $usr->register($dataForm);
    if ($create == "email_exist") {
        echo "mail déja utilisé";
    } elseif ($create == "success") {
        echo "Votre compte a été crée , BRAVO !!!!!!!!!!!";
    }
}

include("close.php");
?>
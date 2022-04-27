<?php  
include("init.php");

$json = file_get_contents('php://input');
$data = json_decode($json, true);
$result = array();

if(is_array($data))
{
    if (!$help->verifMail($data["email"])) {
        $result["error"] = 'Le format de votre mail est incorrecte';
        $result["result"] = 'email';
    }else {
        $create = $usr->register($data);
        if ($create == "email_exist") {
            $result["error"] = 'mail déja utilisé';
            $result["result"] = 'email';
        } elseif ($create == "success") {
            $result["error"] = null;
            $result["result"] = "Compte crée avec succès";
        }
    }
}
else{
    $result["error"] = 'Erreur des données';
    $result["result"] = null;
}
echo json_encode($result);

include("close.php");
?>
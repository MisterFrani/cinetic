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
        $login = $usr->login($data);
        if ($login == DELETE) {
            $result["error"] = "Votre a été supprimé. Veuillez contacter l'administrateur";
            $result["result"] = null;
        } elseif ($login == STANDBY) {
            $result["error"] = "Votre compte n'est active. Un mail vous a été envoyé";
            $result["result"] = null;
        } 
        elseif ($login == "not_exist") {
            $result["error"] = "Email ou mot de passe incorrect";
            $result["result"] = null;
        } 
        else {
            $result["error"] = null;
            $result["result"] = "Connexion réussie";
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
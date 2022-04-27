<?php  
include("init.php");

$result = array();
$dataForm = $_REQUEST;

if ($dataForm["link"] && !$help->checkYoutubeVideo($dataForm["link"])) {
    $result["error"] = 'Lien YouTube non valide';
    $result["result"] = 'link';
}else {
    $create = $post->publish($dataForm);
    if ($create == "format_file") {
        $result["error"] = 'Fichier non accepté';
        $result["result"] = 'email';
    } elseif ($create == "success") {
        $result["error"] = null;
        $result["result"] = "Post publié avec succès";
    }
}

echo json_encode($result);

include("close.php");
?>
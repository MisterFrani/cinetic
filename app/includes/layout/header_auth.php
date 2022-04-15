<?php 
    if (isset($_SESSION["cinetic"])) {
        header("location:?p=home");
    }
    $root = '/public/auth';
    $path = [
        "css" => $root."/css",
        "js" => $root."/js",
        "fonts" => $root."/fonts",
        "img" => $root."/img",
        "icon" => $root."/icon",
    ]

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=
    , initial-scale=1.0">
    <link rel="stylesheet" href="<?=$path['css']?>/style.css">
    <!-- <link rel="stylesheet" href="/assets/css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="<?=$path['css']?>/fonts.css">
    <title>Cinetic</title>
</head>
<body>
    <header>

    </header>
    <main>
        <div class="container ">
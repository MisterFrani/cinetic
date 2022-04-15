<?php 
$root = '/public';
$path = [
    "css" => $root."/css",
    "js" => $root."/js",
    "images" => $root."/images",
];
?>

<!doctype html>
<html lang="en">
   <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>Cinetic</title>
      <!-- Bootstrap CSS -->
      <link rel="stylesheet" href="<?=$path['css']?>/bootstrap.min.css">
      <!-- Typography CSS -->
      <link rel="stylesheet" href="<?=$path['css']?>/typography.css">
      <!-- Style CSS -->
      <link rel="stylesheet" href="<?=$path['css']?>/style.css">
      <!-- Responsive CSS -->
      <link rel="stylesheet" href="<?=$path['css']?>/responsive.css">
   </head>
   <body class="iq-bg-primary">
      <!-- loader Start -->
      <div id="loading">
         <div id="loading-center">
         </div>
      </div>
      <!-- loader END -->
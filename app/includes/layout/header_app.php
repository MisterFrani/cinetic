<?php 
    if (!isset($_SESSION["cinetic"])) {
        header("location:?p=sign-in");
    }

    $root = '/public';
    $path = [
        "css" => $root."/css",
        "js" => $root."/js",
        "fonts" => $root."/fonts",
        "/public/images/" => $root."/images",
        "fullcalendar" => $root."/fullcalendar",
    ];
    $user = $usr->getUser($_SESSION["cinetic"]);
?>
<!DOCTYPE html>
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
   <body class="right-column-fixed">
      <!-- loader Start -->
      <div id="loading">
         <div id="loading-center">
         </div>
      </div>
      <!-- loader END -->
      <!-- Wrapper Start -->
      <div class="wrapper">
         <!-- Sidebar  -->
         <div class="iq-sidebar">
            <div id="sidebar-scrollbar">
               <nav class="iq-sidebar-menu">
                  <ul id="iq-sidebar-toggle" class="iq-menu">
                     <li <?php if($_GET['p'] == "home"){ ?>class="active"<?php } ?>>
                        <a href="?p=home" class="iq-waves-effect"><i class="las la-newspaper"></i><span>Fil d'actualité</span></a>
                     </li>
                     <li <?php if($_GET['p'] == "follows"){ ?>class="active"<?php } ?>>
                        <a href="?p=follows" class="iq-waves-effect"><i class="las la-at"></i><span>Abonnés</span></a>
                     </li>
                     <li <?php if($_GET['p'] == "users"){ ?>class="active"<?php } ?>>
                        <a href="?p=users" class="iq-waves-effect"><i class="las la-user-friends"></i><span>utilisateurs</span></a>
                     </li>
                     <li <?php if($_GET['p'] == "message"){ ?>class="active"<?php } ?>>
                        <a href="?p=message" class="iq-waves-effect"><i class="ri-mail-line"></i><span>Message</span></a>
                     </li>
                  </ul>
               </nav>
               <div class="p-3"></div>
            </div>
         </div>
         <!-- TOP Nav Bar -->
         <div class="iq-top-navbar">
            <div class="iq-navbar-custom">
               <nav class="navbar navbar-expand-lg navbar-light p-0">
                  <div class="iq-navbar-logo d-flex justify-content-between">
                     <a href="?p=home">
                     <img src="/public/images/logo.svg" class="img-fluid" alt="">
                     </a>
                     <div class="iq-menu-bt align-self-center">
                     <div class="wrapper-menu">
                        <div class="main-circle"><i class="ri-menu-line"></i></div>
                     </div>
                  </div>
                  </div>
                  <div class="iq-search-bar">
                     
                  </div>
                  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"  aria-label="Toggle navigation">
                  <i class="ri-menu-3-line"></i>
                  </button>
                  <div class="collapse navbar-collapse" id="navbarSupportedContent">
                     <ul class="navbar-nav ml-auto navbar-list">
                        <li class="nav-item">
                           <a href="#" class="search-toggle iq-waves-effect">
                              <div id="lottie-mail"></div>
                              <span class="bg-primary count-mail"></span>
                           </a>
                        </li>
                        <li>
                           <a href="?p=profile&user=<?=$_SESSION['cinetic']?>" class="iq-waves-effect d-flex align-items-center">
                              <img src="<?=$user->avatar?>" class="img-fluid rounded-circle mr-3" alt="user">
                              <div class="caption">
                                 <h6 class="mb-0 line-height"><?=$user->firstname?> <?=$user->lastname?></h6>
                              </div>
                           </a>
                        </li>
                     </ul>
                     <ul class="navbar-list">
                        <li>
                           <a href="#" class="search-toggle iq-waves-effect d-flex align-items-center">
                           <i class="ri-arrow-down-s-fill"></i>
                           </a>
                           <div class="iq-sub-dropdown iq-user-dropdown">
                              <div class="iq-card shadow-none m-0">
                                 <div class="iq-card-body p-0 ">
                                    <div class="bg-primary p-3 line-height">
                                       <h5 class="mb-0 text-white line-height">Hello <?=$user->firstname?> <?=$user->lastname?></h5>
                                       <span class="text-white font-size-12"><?=$user->email?></span>
                                    </div>
                                    <a href="?p=profile&user=<?=$_SESSION['cinetic']?>" class="iq-sub-card iq-bg-primary-hover">
                                       <div class="media align-items-center">
                                          <div class="rounded iq-card-icon iq-bg-primary">
                                             <i class="ri-file-user-line"></i>
                                          </div>
                                          <div class="media-body ml-3">
                                             <h6 class="mb-0 ">Mon Profil</h6>
                                             <p class="mb-0 font-size-12">Voir mes activités de profil.</p>
                                          </div>
                                       </div>
                                    </a>
                                    <a href="?p=profile" class="iq-sub-card iq-bg-warning-hover">
                                       <div class="media align-items-center">
                                          <div class="rounded iq-card-icon iq-bg-warning">
                                             <i class="ri-profile-line"></i>
                                          </div>
                                          <div class="media-body ml-3">
                                             <h6 class="mb-0 ">Editer profil</h6>
                                             <p class="mb-0 font-size-12">Modifier mes informations personnelles.</p>
                                          </div>
                                       </div>
                                    </a>
                                    <a href="?p=account" class="iq-sub-card iq-bg-info-hover">
                                       <div class="media align-items-center">
                                          <div class="rounded iq-card-icon iq-bg-info">
                                             <i class="ri-account-box-line"></i>
                                          </div>
                                          <div class="media-body ml-3">
                                             <h6 class="mb-0 ">Reglage de compte</h6>
                                             <p class="mb-0 font-size-12">Gérer les informations de connexion.</p>
                                          </div>
                                       </div>
                                    </a>
                                    <div class="d-inline-block w-100 text-center p-3">
                                       <a class="bg-primary iq-sign-btn" href="controllers/logout.php" role="button">Se déconnecter<i class="ri-login-box-line ml-2"></i></a>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </li>
                     </ul>
                  </div>
               </nav>
            </div>
         </div>
         <!-- TOP Nav Bar END -->
         <!-- Right Sidebar Panel Start-->
         <div class="right-sidebar-mini right-sidebar">
            <div class="right-sidebar-panel p-0">
               <div class="iq-card shadow-none">
                  <div class="iq-card-body p-0">
                     <div class="media-height p-3">
                        <div class="iq-card-header d-flex justify-content-between">
                           <div class="iq-header-title">
                              <h4 class="card-title">Stories</h4>
                           </div>
                        </div>
                        <div class="iq-card-body">
                           <ul class="media-story m-0 p-0">
                              <li class="d-flex mb-4 align-items-center">
                                 <i class="ri-add-line font-size-18"></i>
                                 <div class="stories-data ml-3">
                                    <h5>Créer</h5>
                                    <p class="mb-0"></p>
                                 </div>
                              </li>
                              <li class="d-flex mb-4 align-items-center active">
                                 <img src="/public/images/page-img/s2.jpg" alt="story-img" class="rounded-circle img-fluid">
                                 <div class="stories-data ml-3">
                                    <h5>Anna Mull</h5>
                                    <p class="mb-0">1 hour ago</p>
                                 </div>
                              </li>
                              <li class="d-flex mb-4 align-items-center">
                                 <img src="/public/images/page-img/s3.jpg" alt="story-img" class="rounded-circle img-fluid">
                                 <div class="stories-data ml-3">
                                    <h5>Ira Membrit</h5>
                                    <p class="mb-0">4 hour ago</p>
                                 </div>
                              </li>
                           </ul>
                           <a href="#" class="btn btn-primary d-block mt-3">Tout voir</a>
                        </div>
                        <ul class="suggested-page-story mt-3 p-0 list-inline">
                            <li class="mb-3">
                                <img src="/public/images/picard.webp" class="img-fluid rounded" alt="Responsive image">
                            </li>
                        </ul>
                     </div>
                     <div class="right-sidebar-toggle bg-primary mt-3">
                        <i class="ri-arrow-left-line side-left-icon"></i>
                        <i class="ri-arrow-right-line side-right-icon"><span class="ml-3 d-inline-block">Close Menu</span></i>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <!-- Right Sidebar Panel End-->

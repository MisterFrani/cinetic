
<!-- Page Content  -->
<div id="content-page" class="content-page mt-5">
<div class="container mt-5">
    <div class="row mt-5">
        <div class="col-sm-12 mt-5">
            <div class="iq-card">
            <div class="iq-card-body profile-page p-0">
                <div class="profile-header">
                    <div class="user-detail text-center mb-3">
                        <div class="profile-img">
                            <img src="<?=$getUser->avatar?>" alt="profile-img" class="avatar-130 img-fluid" />
                        </div>
                        <div class="profile-detail">
                        <h3 class=""><?=$getUser->firstname?> <?=$getUser->lastname?></h3>
                        </div>
                    </div>
                    <div class="profile-info p-4 d-flex align-items-center justify-content-between position-relative">
                        <div class="social-links">
                            <?php if($getUser->id != $_SESSION['cinetic']){ ?>
                                <div id="follow_one">
                                    <?php if($iam_follow === false){ ?>
                                        <a href="javascript:void();" data-user-id="<?php echo $getUser->id; ?>" class="btn btn-primary follow_one">Suivre</a>
                                    <?php }else{ ?>
                                        <a href="javascript:void();" class="follow_one" data-user-id="<?php echo $getUser->id; ?>"><i data-user-id="<?php echo $getUser->id; ?>" class="fa fa-times"></i> Ne plus suivre</a> 
                                        <button data-toggle="modal" data-target="#chat-modal-<?php echo $getUser->id; ?>" class="ml-3 btn btn-success"> <i class="fa fa-envelope"></i></button>
                                    <?php } ?>
                                </div>                               
                            <?php } ?>
                        </div>
                        
                        <div class="social-info">
                        <ul class="social-data-block d-flex align-items-center justify-content-between list-inline p-0 m-0">
                            <li class="text-center pl-3">
                                <h6>Posts</h6>
                                <p class="mb-0"><?=count($posts)?></p>
                            </li>
                            <li class="text-center pl-3">
                                <h6>Followers</h6>
                                <p class="mb-0"><?=count($follows)?></p>
                            </li>
                            <li class="text-center pl-3">
                                <h6>Following</h6>
                                <p class="mb-0"><?=count($toFollow)?></p>
                            </li>
                        </ul>
                        </div>
                    </div>
                </div>
            </div>
            </div>
            <div class="iq-card">
            <div class="iq-card-body p-0">
                <div class="user-tabing">
                    <ul class="nav nav-pills d-flex align-items-center justify-content-center profile-feed-items p-0 m-0">
                        <li class="col-sm-4 p-0">
                        <a class="nav-link active" data-toggle="pill" href="#timeline">Activités</a>
                        </li>
                        <li class="col-sm-4 p-0">
                        <a class="nav-link" data-toggle="pill" href="#about">A propos</a>
                        </li>
                        <li class="col-sm-4 p-0">
                        <a class="nav-link" data-toggle="pill" href="#friends">Amis</a>
                        </li>
                    </ul>
                </div>
            </div>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="tab-content">
            <div class="tab-pane fade active show" id="timeline" role="tabpanel">
                <div class="iq-card-body p-0 mt-4">
                    <div class="row">
                        <div class="col-lg-8 m-auto">
                            <?php if($_GET['user'] == $_SESSION['cinetic']){ include('components/publish.php'); } ?>
                            <?php foreach($posts as $item){ include('components/card-post.php');} ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="about" role="tabpanel">
                <div class="iq-card">
                    <div class="iq-card-body">
                        <div class="row">
                        
                        <div class="col-md-8 m-auto pl-4">
                        <h4>Informations de contact</h4>
                                    <hr>
                                    <div class="row">
                                    <div class="col-3">
                                        <h6>Email</h6>
                                    </div>
                                    <div class="col-9">
                                        <p class="mb-0"><?=$getUser->email?></p>
                                    </div>
                                    </div>
                                    
                                    <h4 class="mt-3">Informations basiques</h4>
                                    <hr>
                                    <div class="row">
                                    <div class="col-3">
                                        <h6>Date de naissance</h6>
                                    </div>
                                    <div class="col-9">
                                        <p class="mb-0"><?=$getUser->birthday?></p>
                                    </div>
                                    <div class="col-3">
                                        <h6>Genre</h6>
                                    </div>
                                    <div class="col-9">
                                        <p class="mb-0"><?=$getUser->sexe == "H"?"Homme":"Femme"?></p>
                                    </div>
                                    <div class="col-3">
                                        <h6>Membre depuis le </h6>
                                    </div>
                                    <div class="col-9">
                                        <p class="mb-0"><?=$getUser->createdAt?></p>
                                    </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="friends" role="tabpanel">
                <div class="iq-card">
                    <div class="iq-card-body">
                        <div class="row mt-5">
                            <?php foreach ($friends as $item) {
                                $idUser = $_GET["user"] == $item->id_user ? $item->follower : $item->id_user;
                                $toFollow_f = $fo->getToFollow($idUser);
                                $follows_f = $fo->getFollows($idUser);
                                $friends_f = array_merge($toFollow_f, $follows_f);
                             ?>
                                <div class="col-md-6 col-lg-6 mb-3">
                                    <div class="iq-friendlist-block">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="d-flex align-items-center">
                                                <a href="?p=profile&user=<?=$idUser?>">
                                                    <img src="<?=$item->avatar?>" height="150" width="150" alt="profile-img" class="img-fluid">
                                                </a>
                                                <div class="friend-info ml-3">
                                                    <h5><a href="?p=profile&user=<?=$idUser?>"><?=$item->firstname?> <?=$item->lastname?></a></h5>
                                                    <p class="mb-0"><?=count( $friends_f)?> ami(s)</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
</div>
</div>
<?php include("components/new-conversation-user.php");?>
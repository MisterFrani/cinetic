 <!-- Page Content  -->
 <div id="content-page" class="content-page">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="iq-card position-relative inner-page-bg bg-primary" style="height: 150px;">
                <div class="inner-page-title">
                    <h3 class="text-white">Followers</h3>
                </div>
                </div>
            </div>
            <div class="col-12">
                <div class="iq-card">
                    <div class="iq-card-body">
                        <ul class="nav nav-tabs" id="myTab-1" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Abonnés</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Abonnements</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent-2">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

                                <div class="row mt-5" id="follows">
                                    <?php foreach($follows as $item){ 
                                        $iam_follow = array_search($item->follower, array_column($toFollow, 'id_user')); 
                                        $dest = $item->follower;
                                    ?>
                                    <div class="col-md-6 mt-3">
                                        <div class="iq-card mt-5">
                                            <div class="iq-card-body profile-page p-0">
                                                <div class="profile-header-image">
                                                    <div class="cover-container">
                                                    </div>
                                                    <div class="profile-info p-4">
                                                        <div class="user-detail">
                                                            <div class="d-flex flex-wrap justify-content-between align-items-start">
                                                                <div class="profile-detail d-flex">
                                                                    <div class="profile-img pr-4">
                                                                        <a href="?p=profile&user=<?=$item->follower?>"><img src="<?=$item->avatar?>" alt="profile-img" class="avatar-130 img-fluid" /></a>
                                                                    </div>
                                                                    <div class="user-data-block">
                                                                        <a href="?p=profile&user=<?=$item->follower?>"><h4 class=""><?=$item->firstname?> <?=$item->lastname?></h4></a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="d-flex justify-content-end">
                                                                <?php if($iam_follow === false){ ?>
                                                                    <a href="javascript:void();" data-user-id="<?php echo $item->follower; ?>" class="btn btn-primary following-also">Suivre en retour</a>
                                                                <?php }else{ ?>
                                                                    <button data-toggle="modal" data-target="#chat-modal-<?php echo $item->follower; ?>" class="ml-3 btn btn-success"> <i class="fa fa-envelope"></i></button>
                                                                <?php } ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php include("components/new-conversation-user.php");?>
                                    <?php } ?>
                                </div>

                            </div>
                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <div class="row mt-5" id="followers">
                                    <?php foreach($toFollow as $item){ $dest = $item->id_user;?>
                                    <div class="col-md-6 mt-3">
                                        <div class="iq-card mt-5">
                                            <div class="iq-card-body profile-page p-0">
                                                <div class="profile-header-image">
                                                    <div class="cover-container">
                                                    </div>
                                                    <div class="profile-info p-4">
                                                        <div class="user-detail">
                                                            <div class="d-flex flex-wrap justify-content-between align-items-start">
                                                                <div class="profile-detail d-flex">
                                                                    <div class="profile-img pr-4">
                                                                        <a href="?p=profile&user=<?=$item->id_user?>"><img src="<?=$item->avatar?>" alt="profile-img" class="avatar-130 img-fluid" /></a>
                                                                    </div>
                                                                    <div class="user-data-block">
                                                                        <a href="?p=profile&user=<?=$item->id_user?>"><h4 class=""><?=$item->firstname?> <?=$item->lastname?></h4></a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="d-flex justify-content-end">
                                                                <a href="javascript:void();" class="unfollowing" data-id="<?php echo $item->id; ?>"><i data-id="<?php echo $item->id; ?>" class="fa fa-times"></i> Ne plus suivre</a> 
                                                                <button data-toggle="modal" data-target="#chat-modal-<?php echo $dest; ?>" class="ml-3 btn btn-success"> <i class="fa fa-envelope"></i></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php include("components/new-conversation-user.php");?>
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
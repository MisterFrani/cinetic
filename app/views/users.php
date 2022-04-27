

<div id="content-page" class="content-page">
    <div class="container mt-5">
        <div class="row mt-5" id="following">
            <?php foreach($users as $item){ 
                $iam_follow = array_search($item->id, array_column($toFollow, 'id_user')); 
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
                                                <a href="?p=profile&user=<?=$item->id?>"><img src="<?=$item->avatar?>" alt="profile-img" class="avatar-130 img-fluid" /></a>
                                            </div>
                                            <div class="user-data-block">
                                                <a href="?p=profile&user=<?=$item->id?>"><h4 class=""><?=$item->firstname?> <?=$item->lastname?></h4></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-end">
                                        <?php if($iam_follow === false){ ?>
                                            <a href="javascript:void();" data-user-id="<?php echo $item->id; ?>" class="btn btn-primary following">Suivre</a>
                                        <?php }else{ ?>
                                            <a href="javascript:void();" class="following" data-user-id="<?php echo $item->id; ?>"><i data-user-id="<?php echo $item->id; ?>" class="fa fa-times"></i> Ne plus suivre</a>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
    </div>
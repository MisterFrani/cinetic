<?php
    $users = $usr->getUsers(ACTIVE);  
    $toFollow = $fo->getToFollow($_SESSION['cinetic']);  
    $block = '';

    foreach ($users as $item) {
        $iam_follow = array_search($item->id, array_column($toFollow, 'id_user')); 

        $block .= '
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
                                                <a href="?p=profile&user='.$item->id.'"><img src="'.$item->avatar.'" alt="profile-img" class="avatar-130 img-fluid" /></a>
                                            </div>
                                            <div class="user-data-block">
                                                <a href="?p=profile&user='.$item->id.'"><h4 class="">'.$item->firstname.' '.$item->lastname.'</h4></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-end">';
                                        if($iam_follow === false){
                                            $block .= '<a href="javascript:void();" onclick="followingSocket('.$item->id.')" class="btn btn-primary">Suivre</a>';
                                        }else{
                                            $block .= '<a href="javascript:void();" onclick="followingSocket('.$item->id.')"><i class="fa fa-times"></i> Ne plus suivre</a>';
                                        }
                        $block .= '</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        ';
    }
?>

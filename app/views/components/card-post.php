<?php 
    $likes = $post->getLikes($item->id);
    $comments = $post->getComments($item->id);

    $id = array_search($_SESSION['cinetic'], array_column($likes, 'userId'));
?>
    <div class="col-sm-12">
    <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
        <div class="iq-card-body">
            <div class="user-post-data">
                <div class="d-flex flex-wrap">
                <div class="media-support-user-img mr-3">
                    <img class="rounded-circle img-fluid" src="<?=$item->avatar?>" alt="">
                </div>
                <div class="media-support-info mt-2">
                    <h5 class="mb-0 d-inline-block"><a href="?p=profile&user=<?=$item->userId?>" class=""><?=$item->firstname?> <?=$item->lastname?></a></h5>
                    <p class="mb-0 text-primary"><?=$item->createdAt?></p>
                </div>
                </div>
            </div>
            <div class="mt-3">
                <p><?=nl2br($item->content)?></p>
            </div>
            <?php if($item->image){ ?>
            <div class="user-post">
            <a href="javascript:void();">
                <?php if($item->type_image == "YOUTUBE"){ ?>
                    <iframe height="380" class="embed-responsive-item w-100" src="<?=$item->image?>" allowfullscreen></iframe>
                <?php }else{ ?>
                    <img src="<?=$item->image?>" alt="post-image" class="img-fluid rounded w-100">
                <?php } ?>
            </a>
            </div>
            <?php } ?>
            <div class="comment-area mt-3">
                <div id="comment-area-<?php echo $item->id; ?>">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="like-block position-relative d-flex align-items-center">
                    <div class="d-flex align-items-center">
                        <div class="like-data">
                            <div class="">
                                <a href="javascript:void();" data-post-id="<?php echo $item->id; ?>" class="send-like"><i data-post-id="<?php echo $item->id; ?>" class="fa fa-heart<?php if($id === false){ ?>-o<?php } ?>"></i></a>
                            </div>
                        </div>
                        <div class="total-like-block ml-2 mr-3">
                            <div class="">
                                <span  aria-haspopup="true" aria-expanded="false" role="button">
                                    <?=count($likes)?> Like(s)
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="total-comment-block">
                        <div class="dropdown">
                            <span class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="button">
                                <?=count($comments)?> Commentaire(s)
                            </span>
                        </div>
                    </div>
                    </div>
                </div>
                <hr>
                <ul class="post-comments p-0 m-0">
                    <?php foreach($comments as $c){ ?>
                        <li class="mb-2">
                            <div class="d-flex flex-wrap">
                                <div class="user-img">
                                    <img src="<?=$c->avatar?>" alt="userimg" class="avatar-35 rounded-circle img-fluid">
                                </div>
                                <div class="comment-data-block ml-3">
                                    <h6><a href="?p=profile&user=<?=$c->userId?>"><?=$c->firstname?> <?=$c->lastname?></a></h6>
                                    <p class="mb-0"><?=$c->content?></p>
                                    <div class="d-flex flex-wrap align-items-center comment-activity">
                                        <small><a href="javascript:void();"><?=$c->createdAt?></a></small>
                                    </div>
                                </div>
                            </div>
                        </li>
                    <?php } ?>
                </ul>
                </div>
                
                <form onsubmit="return false;" id="form-comment-<?php echo $item->id; ?>" class="comment-text d-flex align-items-center mt-3">
                <input type="text" class="form-control rounded" name="content">
                <div class="comment-attagement d-flex">
                    <a href="javascript:void();" data-post-id="<?php echo $item->id; ?>" class="send-comment"><i data-post-id="<?php echo $item->id; ?>" class="fa fa-paper-plane-o mr-3"></i></a>
                </div>
                </form>
            </div>
        </div>
    </div>
    </div>
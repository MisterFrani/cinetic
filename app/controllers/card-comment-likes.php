<?php
    $likes = $post->getLikes($postId);
    $comments = $post->getComments($postId);
    
    $class = "-o";
    if($create == 'liked'){
        $class = "";
    }
    
    $block = '
    <div class="d-flex justify-content-between align-items-center">
        <div class="like-block position-relative d-flex align-items-center">
            <div class="d-flex align-items-center">
                <div class="like-data">
                    <div class="">
                        <a href="javascript:void();" onclick="sendLikeSocket('.$postId.')" class="send-like"><i lass="fa fa-heart'.$class.'"></i></a>
                    </div>
                </div>
                <div class="total-like-block ml-2 mr-3">
                    <div class="">
                        <span  aria-haspopup="true" aria-expanded="false" role="button">
                            '.count($likes).' Like(s)
                        </span>
                    </div>
                </div>
            </div>
            <div class="total-comment-block">
                <div class="dropdown">
                    <span class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="button">
                        '.count($comments).' Commentaire(s)
                    </span>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <ul class="post-comments p-0 m-0">';
        foreach($comments as $c){ 
            $block .= '<li class="mb-2">
                    <div class="d-flex flex-wrap">
                        <div class="user-img">
                            <img src="'.$c->avatar.'" alt="userimg" class="avatar-35 rounded-circle img-fluid">
                        </div>
                        <div class="comment-data-block ml-3">
                            <h6><a href="?p=profile&user='.$c->userId.'">'.$c->firstname.' '.$c->lastname.'</a></h6>
                            <p class="mb-0">'.$c->content.'</p>
                            <div class="d-flex flex-wrap align-items-center comment-activity">
                                <small><a href="javascript:void();">'.$c->createdAt.'</a></small>
                            </div>
                        </div>
                    </div>
                </li>';
        }
    $block .= '</ul>';
?>

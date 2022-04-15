<?php
$message = '';
foreach($messages as $m){ 
    if($m->exp == $exp->id){
        $message .= '<div class="chat">
            <div class="chat-user">
                <a class="avatar m-0">
                <img src="'.$exp->avatar.'" alt="avatar" class="avatar-35 ">
                </a>
            </div>
            <div class="chat-detail">
                <div class="chat-message">
                    <p>'.$m->content.'</p>
                </div>
            </div>
        </div>';
    } else {
        $message .= '<div class="chat chat-left">
            <div class="chat-user">
                <a class="avatar m-0">
                <img src="'.$dest->avatar.'" alt="avatar" class="avatar-35 ">
                </a>
            </div>
            <div class="chat-detail">
                <div class="chat-message">
                    <p>'.$m->content.'></p>
                </div>
            </div>
        </div>';
    }
} 
?>
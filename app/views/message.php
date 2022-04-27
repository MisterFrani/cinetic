 <?php 
    $array = [];
    foreach($conversations as $item){ 
        $idUserMsg = $item->dest == $user->id ? $item->exp : $item->dest;
        $getUser = $usr->getUser($idUserMsg);
        $array[] = $getUser;
    }
    $temp = array_unique(array_column($array, 'id'));
    $getUsers = array_intersect_key($array, $temp);
 ?>
 
 <!-- Page Content  -->
 <div id="content-page" class="content-page">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="iq-card">
                <div class="iq-card-body chat-page pb-3">
                    <div class="chat-data-block">
                        <div class="row">
                            <div class="col-lg-3 chat-data-left scroller">
                            <div class="chat-search pt-3 pl-3">
                                <div class="d-flex align-items-center">
                                    <div class="chat-profile mr-3">
                                        <img src="<?=$user->avatar?>" alt="chat-user" class="avatar-60 ">
                                    </div>
                                    <div class="chat-caption">
                                        <h5 class="mb-0"><?=$user->firstname?> <?=$user->lastname?></h5>
                                    </div>
                                </div>
                                

                            </div>
                            <div class="chat-sidebar-channel scroller mt-4 pl-3">
                                <h5 class=""><button data-toggle="modal" data-target="#chat-modal" class="btn btn-danger"> <i class="fa fa-plus"></i> conversation</button></h5>
                                <ul class="iq-chat-ui nav flex-column nav-pills">
                                    <?php 
                                        foreach($getUsers as $item){ 
                                    ?>
                                        <li>
                                            <a  data-toggle="pill" href="#chatbox<?=$item->id?>">
                                            <div class="d-flex align-items-center">
                                                <div class="avatar mr-2">
                                                    <img src="<?=$item->avatar?>" alt="chatuserimage" class="avatar-50 ">
                                                </div>
                                                <div class="d-flex flex-column">
                                                    <div class="chat-sidebar-name">
                                                        <h6 class="mb-0"><?=$item->firstname?> <?=$item->lastname?></h6>
                                                    </div>
                                                    <div class="chat-meta float-right">
                                                    </div>
                                                </div>
                                            </div>
                                            </a>
                                        </li>
                                    <?php } ?>
                                </ul>
                            </div>
                            </div>
                            <div class="col-lg-9 chat-data p-0 chat-data-right">
                            <div class="tab-content">
                                <div class="tab-pane fade active show" id="default-block" role="tabpanel">
                                    <div class="chat-start">
                                        <span class="iq-start-icon text-primary"><i class="ri-message-3-line"></i></span>
                                        <button id="chat-start" data-toggle="modal" data-target="#chat-modal" class="btn bg-white mt-3">Commencer une conversation</button>
                                    </div>
                                </div>
                                
                                <?php foreach($getUsers as $item){ 
                                    $messages = $msg->getMessages($user->id, $item->id);
                                ?>
                                <div class="tab-pane fade" id="chatbox<?=$item->id?>" role="tabpanel">
                                    <div class="chat-head">
                                        <header class="d-flex justify-content-between align-items-center bg-white pt-3 pr-3 pb-3">
                                            <div class="d-flex align-items-center">
                                                <div class="sidebar-toggle">
                                                    <i class="ri-menu-3-line"></i>
                                                </div>
                                                <div class="avatar chat-user-profile m-0 mr-3">
                                                    <img src="<?=$item->avatar?>" alt="avatar" class="avatar-50 ">
                                                </div>
                                                <h5 class="mb-0"><?=$item->firstname?> <?=$item->lastname?></h5>
                                            </div>

                                            <div class="chat-header-icons d-flex">
                                                <a href="javascript:void();" class="chat-icon-delete iq-bg-primary">
                                                    <i class="ri-delete-bin-line"></i>
                                                </a>
                                            </div>
                                        </header>
                                    </div>
                                    <div class="chat-content scroller" id="messages-socket">
                                        <?php foreach($messages as $m){ ?>
                                            <?php if($m->exp == $user->id){ ?>
                                                <div class="chat">
                                                    <div class="chat-user">
                                                        <a class="avatar m-0">
                                                        <img src="<?=$user->avatar?>" alt="avatar" class="avatar-35 ">
                                                        </a>
                                                    </div>
                                                    <div class="chat-detail">
                                                        <div class="chat-message">
                                                            <p><?=$m->content?></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php } else { ?>
                                                <div class="chat chat-left">
                                                    <div class="chat-user">
                                                        <a class="avatar m-0">
                                                        <img src="<?=$item->avatar?>" alt="avatar" class="avatar-35 ">
                                                        </a>
                                                    </div>
                                                    <div class="chat-detail">
                                                        <div class="chat-message">
                                                            <p><?=$m->content?></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                        <?php } ?>
                                       
                                    </div>
                                    <div class="chat-footer p-3 bg-white">
                                        <form id="form-chatbox" class="d-flex align-items-center">
                                            <div class="chat-attagement d-flex">
                                                <a href="javascript:void();"><i class="fa fa-smile-o pr-3" aria-hidden="true"></i></a>
                                            </div>
                                            <input type="hidden" name="dest" value="<?=$item->id?>">
                                            <textarea  class="form-control mr-3" name="content" placeholder="Tape ton message"></textarea>
                                            <button type="submit" class="btn btn-primary d-flex align-items-center p-2"><i class="fa fa-paper-plane-o" aria-hidden="true"></i><span class="d-none d-lg-block ml-1">Envoyer</span></button>
                                        </form>
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
    </div>

    <?php include("components/new-conversation.php");?>
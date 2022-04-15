

<div id="chat-modal-data-<?=$dest?>" class="iq-card iq-card-block iq-card-stretch iq-card-height mt-5">
    <div class="modal fade mt-5" id="chat-modal-<?=$dest?>" tabindex="-1" role="dialog" aria-labelledby="post-modalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog mt-5" role="document">
            <form id="form-chat-<?=$dest?>">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="post-modalLabel">Envoyer un message</h5>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="ri-close-fill"></i></button>
                    </div>
                    <div class="modal-body">
                        <div class="backup"></div>
                        <div class="d-flex flex-column align-items-center">
                            <input type="hidden" name="dest" value="<?=$dest?>">
                            <div class="post-text ml-3 w-100 mt-2" action="javascript:void();">
                                <textarea name="content" class="form-control rounded"  placeholder="Tape ton message..." style="border:none;" rows="4"></textarea>
                            </div>
                        </div>
                    <hr>
                    <button type="button" data-dest="<?=$dest?>" class="btn btn-primary d-block w-100 mt-3 chat-modal">Envoyer</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div id="post-modal-data" class="iq-card iq-card-block iq-card-stretch iq-card-height">
    <div class="iq-card-header d-flex justify-content-between">
        <div class="iq-header-title">
            <h4 class="card-title">Créer un post</h4>
        </div>
    </div>
    <div class="iq-card-body" data-toggle="modal" data-target="#post-modal">
        <div class="d-flex align-items-center">
            <div class="user-img">
            <img src="<?=$user->avatar?>" alt="userimg" class="avatar-60 rounded-circle">
            </div>
            <div class="post-text ml-3 w-100" action="javascript:void();">
            <input type="text" class="form-control rounded" placeholder="Quoi de neuf..." style="border:none;">
            </div>
        </div>
        <hr>
    </div>
    <div class="modal fade" id="post-modal" tabindex="-1" role="dialog" aria-labelledby="post-modalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog" role="document">
            <form id="form-post">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="post-modalLabel">Créer mon post</h5>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="ri-close-fill"></i></button>
                    </div>
                    <div class="modal-body">
                    <div class="backup"></div>
                    <div class="d-flex align-items-center">
                        <div class="post-text ml-3 w-100" action="javascript:void();">
                            <textarea name="content" id="" class="form-control rounded"  placeholder="Alors raconte..." style="border:none;" rows="4"></textarea>
                        </div>
                    </div>
                    <hr>
                    <div class="other-option">
                        <div class="form-group">
                            <label for="">Joindre fichier</label>
                            <input type="file" name="image" class="form-control">
                        </div>
                        <hr>
                        ou 
                        <hr>
                        <div class="form-group">
                            <label for="">Lien de la vidéo (youtube par exemple)</label>
                            <input type="text" id="link" name="link" accept="video/*, image/*" class="form-control" >
                        </div>

                    </div>
                    <button type="submit" class="btn btn-primary d-block w-100 mt-3">Publier</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
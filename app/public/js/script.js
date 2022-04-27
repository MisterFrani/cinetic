const $formPost = document.querySelector("#form-post");
const $formChat = document.querySelector("#form-chat");
const $chatModal = document.querySelectorAll(".chat-modal");
const $formChatbox = document.querySelector("#form-chatbox");
const $backup = document.querySelector(".backup");
const $sendComment = document.querySelectorAll(".send-comment");
const $sendLike = document.querySelectorAll(".send-like");
const $following = document.querySelectorAll(".following");
const $follow_one = document.querySelectorAll(".follow_one");
const $followingAlso = document.querySelectorAll(".following-also");
const $unfollowing = document.querySelectorAll(".unfollowing");

if($formPost){
    $formPost.addEventListener("submit", post);
}

if($formChat){
    $formChat.addEventListener("submit", chat);
}

if($formChatbox){
    $formChatbox.addEventListener("submit", chatbox);
}

if($sendComment.length){
    $sendComment.forEach(element => {
        element.addEventListener("click", sendComment);
    });
}

if($chatModal.length){
    $chatModal.forEach(element => {
        element.addEventListener("click", chatModal);
    });
}

if($sendLike.length){
    $sendLike.forEach(element => {
        element.addEventListener("click", sendLike);
    });
}

if($following.length){
    $following.forEach(element => {
        element.addEventListener("click", following);
    });
}

if($follow_one.length){
    $follow_one.forEach(element => {
        element.addEventListener("click", follow_one);
    });
}

if($followingAlso.length){
    $followingAlso.forEach(element => {
        element.addEventListener("click", followingAlso);
    });
}

if($unfollowing.length){
    $unfollowing.forEach(element => {
        element.addEventListener("click", unfollowing);
    });
}

async function post(e){
    e.preventDefault();
    const $form = e.target;
    const $elmentData = $form.querySelectorAll("[name]");
    let nbError = 0;

    $elmentData.forEach(element => {
        if(element.value.trim() == ""){
            nbError++;
        }
    });


    if(nbError !== $elmentData.length){

        backupRemove();
        const data = new FormData($form);

        const req = await fetch("/controllers/create-post.php", {
            method: "POST", //ou POST, PUT, DELETE
            body: data
        })
        const response = await req.json();
        if(!response.error){
            backupAdd(response.result, 'success');
            $form.reset();
            setTimeout(() => {
                $("#post-modal").modal('hide');
                window.location.reload();
                backupRemove();
            }, 2000);
        }else {
            backupAdd(response.error, "danger");
            if(response.result){
                document.querySelector("#"+response.result).classList.add('has-error');
            }
        }

        
    } else {
        backupAdd("Veuillez remplir au moins un champs", "danger");
    }
    scrollToTop();
}

async function chat(e){
    e.preventDefault();
    const $form = e.target;
    const data = {};
    const $elmentData = $form.querySelectorAll("[name]");
    let nbError = 0;

    $elmentData.forEach(element => {
        if(element.value.trim() == ""){
            nbError++;
        } else {
            element.classList.remove('has-error');
            data[element.name] = element.value.trim();
        }
    });


    if(nbError === 0){
        backupRemove();
        
        const req = await fetch("/controllers/create-chat.php", {
            method: "POST", //ou POST, PUT, DELETE
            headers: {
                "Content-Type": "application/json" //pour un corps de type chaine
            },
            body: JSON.stringify(data)
        })
        const response = await req.json();
        if(!response.error){
            $form.reset();
            setTimeout(() => {
                $("#chat-modal").modal('hide');
                window.location.replace("?p=message");
            }, 2000);
        }else {
            backupAdd(response.error, "danger");
            if(response.result){
                document.querySelector("#"+response.result).classList.add('has-error');
            }
        }
    } 
    scrollToTop();
}


async function chatModal(e){
    const $this = e.target;
    const id = $this.getAttribute('data-dest');
    const $form = document.querySelector("#form-chat-"+id);
    const data = {};
    const $elmentData = $form.querySelectorAll("[name]");
    let nbError = 0;

    $elmentData.forEach(element => {
        if(element.value.trim() == ""){
            nbError++;
        } else {
            element.classList.remove('has-error');
            data[element.name] = element.value.trim();
        }
    });


    if(nbError === 0){        
        const req = await fetch("/controllers/create-chat.php", {
            method: "POST", //ou POST, PUT, DELETE
            headers: {
                "Content-Type": "application/json" //pour un corps de type chaine
            },
            body: JSON.stringify(data)
        })
        const response = await req.json();
        if(!response.error){
            $form.reset();
            setTimeout(() => {
                $("#chat-modal-"+id).modal('hide');
                window.location.replace("?p=message");
            }, 2000);
        }
    } 
    scrollToTop();
}


async function chatbox(e){
    e.preventDefault();
    const $form = e.target;
    const data = {};
    const $elmentData = $form.querySelectorAll("[name]");
    let nbError = 0;

    $elmentData.forEach(element => {
        if(element.value.trim() == ""){
            nbError++;
        } else {
            element.classList.remove('has-error');
            data[element.name] = element.value.trim();
        }
    });


    if(nbError === 0){        
        const req = await fetch("/controllers/create-chat.php", {
            method: "POST", //ou POST, PUT, DELETE
            headers: {
                "Content-Type": "application/json" //pour un corps de type chaine
            },
            body: JSON.stringify(data)
        })
        const response = await req.json();
        console.log(response);
        if(!response.error){
            $form.reset();
            var $back = document.querySelector('#messages-socket');
            $back.innerHTML = response.result;
            $back.scrollTop = $back.scrollHeight;
        }
    } 
}


async function sendComment(e){
    const $this = e.target;
    const postId = $this.getAttribute('data-post-id');
    const $form = document.querySelector('#form-comment-'+postId);
    const $content = document.querySelector('#comment-area-'+postId);
    const $elmentData = $form.querySelectorAll("[name]");
    const data = {};
    var nbError = 0;

    $elmentData.forEach(element => {
        if(element.value.trim() == ""){
            nbError++;
        }
        else {
            element.classList.remove('has-error');
            data[element.name] = element.value.trim();
        }
    });

    data['postId'] = postId;

    if(nbError == 0){
        const req = await fetch("/controllers/comments.php", {
            method: "POST", //ou POST, PUT, DELETE
            headers: {
                "Content-Type": "application/json" //pour un corps de type chaine
            },
            body: JSON.stringify(data)
        })
        const response = await req.json();
        if(!response.error){
            $form.reset();
            $content.innerHTML = response.result;
        }
    }
}

window.sendLikeSocket = async function(postId){
    const $content = document.querySelector('#comment-area-'+postId);

    const data = {postId};

    const req = await fetch("/controllers/like.php", {
        method: "POST", //ou POST, PUT, DELETE
        headers: {
            "Content-Type": "application/json" //pour un corps de type chaine
        },
        body: JSON.stringify(data)
    })
    const response = await req.json();
    if(!response.error){
        $content.innerHTML = response.result;
    }
}

async function sendLike(e){
    const $this = e.target;
    const postId = $this.getAttribute('data-post-id');
    const $content = document.querySelector('#comment-area-'+postId);

    const data = {postId};

    const req = await fetch("/controllers/like.php", {
        method: "POST", //ou POST, PUT, DELETE
        headers: {
            "Content-Type": "application/json" //pour un corps de type chaine
        },
        body: JSON.stringify(data)
    })
    const response = await req.json();
    if(!response.error){
        $content.innerHTML = response.result;
    }
}


window.followingSocket = async function(id_user){
    const $content = document.querySelector('#following');

    const data = {id_user};

    const req = await fetch("/controllers/following.php", {
        method: "POST", //ou POST, PUT, DELETE
        headers: {
            "Content-Type": "application/json" //pour un corps de type chaine
        },
        body: JSON.stringify(data)
    })
    const response = await req.json();
    if(!response.error){
        $content.innerHTML = response.result;
    }
}

async function following(e){
    const $this = e.target;
    const id_user = $this.getAttribute('data-user-id');
    const $content = document.querySelector('#following');

    const data = {id_user};

    const req = await fetch("/controllers/following.php", {
        method: "POST", //ou POST, PUT, DELETE
        headers: {
            "Content-Type": "application/json" //pour un corps de type chaine
        },
        body: JSON.stringify(data)
    })
    const response = await req.json();
    if(!response.error){
        $content.innerHTML = response.result;
    }
}

async function follow_one(e){
    const $this = e.target;
    const id_user = $this.getAttribute('data-user-id');
    const $content = document.querySelector('#follow_one');

    const data = {id_user};

    const req = await fetch("/controllers/follow_one.php", {
        method: "POST", //ou POST, PUT, DELETE
        headers: {
            "Content-Type": "application/json" //pour un corps de type chaine
        },
        body: JSON.stringify(data)
    })
    const response = await req.json();
    if(!response.error){
        if(response.result == "follow"){
            $content.innerHTML = '<a href="javascript:void();" class="follow_one" onclick="follow_oneSocket('+id_user+')" ><i class="fa fa-times"></i> Ne plus suivre</a>'
        } else {
            $content.innerHTML = '<a href="javascript:void();" onclick="follow_oneSocket('+id_user+')" class="btn btn-primary follow_one">Suivre</a>'
        }
    }
}
window.follow_oneSocket = async function(id_user){
    const $content = document.querySelector('#follow_one');

    const data = {id_user};

    const req = await fetch("/controllers/follow_one.php", {
        method: "POST", //ou POST, PUT, DELETE
        headers: {
            "Content-Type": "application/json" //pour un corps de type chaine
        },
        body: JSON.stringify(data)
    })
    const response = await req.json();
    if(!response.error){
        if(response.result == "follow"){
            $content.innerHTML = '<a href="javascript:void();" class="follow_one" onclick="follow_oneSocket('+id_user+')" ><i class="fa fa-times"></i> Ne plus suivre</a>'
        } else {
            $content.innerHTML = '<a href="javascript:void();" onclick="follow_oneSocket('+id_user+')" class="btn btn-primary follow_one">Suivre</a>'
        }
    }
}

async function followingAlso(e){
    let question = confirm("Voulez-vous aussi suivre en retour ?");

    if(question){
        const $this = e.target;
        const id_user = $this.getAttribute('data-user-id');

        const data = {id_user};

        const req = await fetch("/controllers/following-also.php", {
            method: "POST", //ou POST, PUT, DELETE
            headers: {
                "Content-Type": "application/json" //pour un corps de type chaine
            },
            body: JSON.stringify(data)
        })
        const response = await req.json();
        if(!response.error){
            window.location.reload();
        }
    }
}

async function unfollowing(e){
    let question = confirm("Voulez-vous vous désabonner ?");

    if(question){
        const $this = e.target;
        const id = $this.getAttribute('data-id');

        const data = {id};

        const req = await fetch("/controllers/unfollow.php", {
            method: "POST", //ou POST, PUT, DELETE
            headers: {
                "Content-Type": "application/json" //pour un corps de type chaine
            },
            body: JSON.stringify(data)
        })
        const response = await req.json();
        if(!response.error){
            window.location.reload();
        }
    }
}

function backupAdd(text, type){
    $backup.classList.add('alert');
    $backup.classList.add('alert-'+type);
    $backup.innerHTML = text
}

function backupRemove(){
    $backup.classList.remove('alert');
    $backup.classList.remove('alert-danger');
    $backup.classList.remove('alert-success');
    $backup.classList.remove('alert-primary');
    $backup.innerHTML = ""
}

function scrollToTop() {
    window.scroll({
        top: 0, 
        left: 0, 
        behavior: 'smooth' 
    });
}
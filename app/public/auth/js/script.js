const $formSignup = document.querySelector("#form-signup");
const $formSignin = document.querySelector("#form-signin");
const $backup = document.querySelector(".backup");

if($formSignup){
    $formSignup.addEventListener("submit", signup);
}
if($formSignin){
    $formSignin.addEventListener("submit", signin);
}

async function signup(e){
    e.preventDefault();
    const $form = e.target;
    const data = {};
    const $elmentData = $form.querySelectorAll("[name]");
    let nbError = 0;

    $elmentData.forEach(element => {
        if(element.value.trim() == ""){
            element.classList.add('has-error');
            nbError++;
        } else {
            element.classList.remove('has-error');
            data[element.name] = element.value.trim();
        }
    });


    if(nbError == 0){
        const $password = document.querySelector('#password');
        const $cpassword = document.querySelector('#cpassword');
        if(data.password !== data.cpassword){
            backupAdd("Les mots de passe ne sont pas identiques", "danger");
            $password.classList.add("has-error");
            $cpassword.classList.add("has-error");
        } else {
            $password.classList.remove("has-error");
            $cpassword.classList.remove("has-error");
            backupRemove();
            
            const req = await fetch("/controllers/signup.php", {
                method: "POST", //ou POST, PUT, DELETE
                headers: {
                  "Content-Type": "application/json" //pour un corps de type chaine
                },
                body: JSON.stringify(data)
            })
            const response = await req.json();
            if(!response.error){
                backupAdd(response.result, 'success');
                $form.reset();
                setTimeout(() => {
                    window.location.replace('?p=sign-in'); // ou window.location.href = '?p=sign-in';
                }, 2000);
            }else {
                backupAdd(response.error, "danger");
                if(response.result){
                    document.querySelector("#"+response.result).classList.add('has-error');
                }
            }

        }
    } else {
        backupAdd("Veuillez remplir tous les champs", "danger");
    }
    scrollToTop();
}

async function signin(e){
    e.preventDefault();
    const $form = e.target;
    const data = {};
    const $elmentData = $form.querySelectorAll("[name]");
    let nbError = 0;

    $elmentData.forEach(element => {
        if(element.value.trim() == ""){
            element.classList.add('has-error');
            nbError++;
        } else {
            element.classList.remove('has-error');
            data[element.name] = element.value.trim();
        }
    });


    if(nbError == 0){
        backupRemove();
        
        const req = await fetch("/controllers/signin.php", {
            method: "POST", //ou POST, PUT, DELETE
            headers: {
                "Content-Type": "application/json" //pour un corps de type chaine
            },
            body: JSON.stringify(data)
        })
        const response = await req.json();
        if(!response.error){
            backupAdd(response.result, 'success');
            $form.reset();
            setTimeout(() => {
                window.location.replace('?p=home'); // ou window.location.href = '?p=home';
            }, 2000);
        }else {
            backupAdd(response.error, "danger");
            if(response.result){
                document.querySelector("#"+response.result).classList.add('has-error');
            }
        }
        
    } else {
        backupAdd("Veuillez remplir tous les champs", "danger");
    }
    scrollToTop();
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
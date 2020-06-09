window.addEventListener('load', initInscription);


function initInscription() {
    document.forms.connexion.addEventListener('submit', traitConnexion);
    document.forms.inscription.addEventListener('submit', traiteInscription);
}

function traitConnexion(ev) {
    ev.preventDefault();
    let url = 'services/login.php';
    let options = {
        method: 'post',
        body: new FormData(this),
        credentials: 'same-origin'
    }
    fetchFromJson(url, options)
        .then(processAnswer)
        .then(connexionOk, connexionOr);
}

function connexionOk(list) {
    //ev.preventDefault();
    //console.log(answer)
    window.location = "../stat.html"
    window.alert("connecter")
}

function connexionOr(ev) {
    //ev.preventDefault();
    window.location = "../stat.html"
    window.alert("connecter")
}

function traiteInscription(ev) {
    ev.preventDefault();
    let url = 'services/signUp.php?';
    let options = {
        method: 'post',
        body: new FormData(this),
        credentials: 'same-origin'
    }
    fetchFromJson(url, options)
        .then(processAnswer)
        .then(inscritOk, inscritError);
}

function processAnswer(answer) {

    if (answer.status == "ok") {

        return answer.result;
    }
    throw new Error(answer.message);
}

function inscritOk(list) {
    window.alert("vous êtes bien inscrit")
    //var creation = document.getElementById('creationCompte');
    //var res = "<strong>Votre compte a bien été créé </strong>";
    //res += "<br /> <a href=\"profil.php\">Cliquer ici pour vous connecté</a>";
    //creation.innerHTML = res;
    //document.querySelector('form').hidden = true;
}

function inscritError(error) {
    window.alert("vous n'êtes pas inscrit")
    //var creation = document.getElementById('creationCompte');
    //var res = "<mark>Le login choisi existe déjà, veuillez choisir un autre login </mark>";
    //creation.innerHTML = res;
}
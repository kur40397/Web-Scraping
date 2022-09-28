var myInput = document.getElementById("pass");
var letter = document.getElementById("letter");
var capital = document.getElementById("capital");
var number = document.getElementById("number");
var specialchar = document.getElementById("special_char");
var length = document.getElementById("length");
/* Lorsque l'utilisateur clique sur le champ de mot de passe , le div du message d'afficher*/
myInput.onfocus = function () {
    document.getElementById("message").style.display = "block";
}
/* Lorsque l'user clique en dehors du champ du mot de passe on masque le div de message*/
myInput.onblur = function () {
    document.getElementById("message").style.display = "none";
}
/* lorsque l'user commence à taper quelque chose sur le champs du mot de passe*/
myInput.onkeyup = function () {
    // ici on valise les lettres miniscule //
    var lowerCaseLetters = /[a-z]/g;
    if (myInput.value.match(lowerCaseLetters)) {
        letter.classList.remove("invalid");
        letter.classList.add("valid");
    } else {
        letter.classList.remove("valid");
        letter.classList.add("invalid");
    }
    // ici on valide les lettres majiscule
    var upperCaseLetters = /[A-Z]/g;
    if (myInput.value.match(upperCaseLetters)) {
        capital.classList.remove("invalid");
        capital.classList.add("valid");
    } else {
        capital.classList.remove("valid");
        capital.classList.add("invalid");
    }
    // ici on valide  les nombres
    var numbers = /[0-9]/g;
    if (myInput.value.match(numbers)) {
        number.classList.remove("invalid");
        number.classList.add("valid");
    } else {
        number.classList.remove("valid");
        number.classList.add("invalid");
    }
    // pour valider le nombre des utilisationss
    if (myInput.value.length >= 8) {
        length.classList.remove("invalid");
        length.classList.add("valid");
    } else {
        length.classList.remove("valid");
        length.classList.add("invalid");
    }
    // pn valide les chaines de caractères
    var char = /[^A-Za-z0-9_]/g;
    if (myInput.value.match(char)) {
        specialchar.classList.remove("invalid");
        specialchar.classList.add("valid");
    } else {
        specialchar.classList.remove("valid");
        specialchar.classList.add("invalid");
    }



}


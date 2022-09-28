//Get the button
var mybutton = document.getElementById("myBtn");

// Lorsque l'utilisateur fait défiler vers le bas 2820 pixels à partir du haut du document, affichez le bouton
window.onscroll = function () { scrollFunction() };

function scrollFunction() {
    if (document.documentElement.scrollTop > 2820) {
        mybutton.style.display = "block";
    } else {
        mybutton.style.display = "none";
    }
}

// Lorsque l'utilisateur clique sur le bouton, faites défiler vers le haut du document
function topFunction() {
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
}
//ouvrir le pop ups
window.onload = function () {
    OpenBootstrapPopup();
};
function OpenBootstrapPopup() {
    $("#simpleModal").modal('show');

}

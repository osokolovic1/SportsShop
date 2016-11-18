//pomjeranje na desnu stranu
function pomjeri(smjer) {
    var lista = document.getElementById("ulSnizenje").getElementsByTagName("li");
    //moramo pronaci prvi koji nema hide
    var i = 1; //preskace se prvi jer je button
    while (lista[i].classList.contains("hide")) i++;

    if (i < lista.length-5 && smjer === 1) { //zbog zadnjih 4 plus buton //1 za desno
      lista[i].classList.add("hide");
      lista[i+4].classList.remove("hide");
    }
    else if (i > 1 && smjer == -1) {
      lista[i+3].classList.add("hide");
      lista[i-1].classList.remove("hide");
    }
}

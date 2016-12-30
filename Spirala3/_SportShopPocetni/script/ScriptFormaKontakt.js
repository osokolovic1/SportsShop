//spremanje
function spremiFormaKontakt() {
    if (typeof(Storage) !== undefined) {
        var textEmail = document.getElementById("inputMail").value;
        var textareaPoruka = document.getElementById("textareaPoruka").value;
        if (focusLostEmail()) //da ne pamti ako nije u redu validacija
          localStorage.setItem("textEmail", textEmail);
        if(focusLostPoruka())
          localStorage.setItem("textareaPoruka", "");
    }
    else {
        window.alert("Spremanje prethodno unesenih podataka u local storage nije podržano u ovoj verziji browsera.");
    }
}

//ucitavanje
function ucitajFormaKontakt() {
    if (typeof(Storage) !== "undefined") {
        document.getElementById("inputMail").value = localStorage.getItem("textEmail");
        document.getElementById("textareaPoruka").value = localStorage.getItem("textareaPoruka");
    }
    else {
        window.alert("Ucitavanje prethodno unesenih podataka u local storage nije podržano u ovoj verziji browsera.");
    }
}


//validacija
//forma kontakt
function validirajEmail(mail) {
  var patern = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
  return patern.test(mail);
}


function focusLostEmail() {
  var unosEmail = document.getElementById("inputMail").value;
  var uslov = validirajEmail(unosEmail);

  if(!uslov) {
    document.getElementById("pKontakt").innerHTML = "Pogrešan format E-mail adrese!";
    localStorage.setItem("textEmail", "");
    return false;
  }
  else {
    document.getElementById("pKontakt").innerHTML = null;
  }
  return true;
}


function focusLostPoruka() {
  var unosPoruka = document.getElementById("textareaPoruka").value;
  if (unosPoruka.length === 0) {
    document.getElementById("pKontakt").innerHTML = "Niste unijeli sadržaj poruke!";
    localStorage.setItem("textareaPoruka", "");
    return false;
  }
  else {
    document.getElementById("pKontakt").innerHTML = null;
  }
  return true;
}

function onclickPosalji() {
  if (focusLostPoruka() && focusLostEmail()) {
    document.getElementById("textareaPoruka").value = "Poruka je poslana...";
    //ovdje ce biti implementacija slanja
  }
}

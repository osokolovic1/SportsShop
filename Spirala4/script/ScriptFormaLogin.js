//**** forma login *****//

porukaKorIme = "Korisničko ime smije sadržavati samo alfanumeričke znakove i mora biti duže od 4 znaka!";
porukaSifra = "Netačan format šifre!";

//spremanje
function spremiFormaLogin() {
    if (typeof(Storage) !== "undefined") {
        var textKorIme = document.getElementById("textKorIme").value;
        var textSifra = document.getElementById("textSifra").value;

        if (focusLost("textKorIme", porukaKorIme, 1))
          localStorage.setItem("textKorIme", textKorIme);
        if(focusLost("textSifra", porukaSifra, 1))
          localStorage.setItem("textSifra", textSifra);
    }
    else {
        window.alert("Spremanje prethodno unesenih podataka u local storage nije podržano u ovoj verziji browsera.");
    }
}

//ucitavanje
function ucitajFormaLogin() {
    if (typeof(Storage) !== "undefined") {
        document.getElementById("textKorIme").value = localStorage.getItem("textKorIme");
        document.getElementById("textSifra").value = localStorage.getItem("textSifra");
    }
    else {
        window.alert("Ucitavanje prethodno unesenih podataka u local storage nije podržano u ovoj verziji browsera.");
    }
}

//validacija
function validiraj(unos, forma) {
  var patern = /^[a-zA-Z0-9]{5,50}$/;
  var patern1 = /^[a-zA-Z]+$/;
  if (forma == 1)
    return patern.test(unos);
  if (forma == 2)
    return patern1.test(unos);
}


function focusLost(id, poruka, forma) {
  var unos = document.getElementById(id).value;

  var uslov = validiraj(unos, forma);
  if (!uslov) {
    if (!id.includes("Reg") && !id.includes("Promj"))
      document.getElementById("pPrijava").innerHTML = poruka;
    else if (id.includes("Reg") && !id.includes("Promj"))
      document.getElementById("pRegistracija").innerHTML = poruka;
    else if (id.includes("Promj"))
      document.getElementById("pPromjena").innerHTML = poruka;

    localStorage.setItem(id, "");
    return false;
  }
  else {
    if (!id.includes("Reg") && !id.includes("Promj"))
      document.getElementById("pPrijava").innerHTML = "";
    else if (id.includes("Reg") && !id.includes("Promj"))
      document.getElementById("pRegistracija").innerHTML = "";
    else if (id.includes("Promj"))
      document.getElementById("pPromjena").innerHTML = "";
  }

  return true;
}


function onclickPrijava() {
  var uslov = focusLost("textKorIme", porukaKorIme, 1) && focusLost("textSifra", porukaSifra, 1);

  return uslov;
}



//**** forma registracija ****//

//spremanje
function spremiFormaReg() {
    if (typeof(Storage) !== "undefined") {
        var textImeReg = document.getElementById("textImeReg").value;
        var textPrezimeReg = document.getElementById("textPrezimeReg").value;
        var textMailReg = document.getElementById("textMailReg").value;
        var textKorImeReg = document.getElementById("textKorImeReg").value;
        var textSifraReg = document.getElementById("textSifraReg").value;
        var textSifraReg1 = document.getElementById("textSifraReg1").value;

        if (validiraj(textImeReg, 2))
          localStorage.setItem("textImeReg", textImeReg);
        if (validiraj(textPrezimeReg, 2))
          localStorage.setItem("textPrezimeReg", textPrezimeReg);
        if (validirajEmail(textMailReg))
          localStorage.setItem("textMailReg", textMailReg);
        if (validiraj(textKorImeReg, 1))
          localStorage.setItem("textKorImeReg", textKorImeReg);
        if (validiraj(textSifraReg, 1))
          localStorage.setItem("textSifraReg", textSifraReg);
        if (validiraj(textSifraReg1, 1))
          localStorage.setItem("textSifraReg1", textSifraReg1);
    }
    else {
        window.alert("Spremanje prethodno unesenih podataka u local storage nije podržano u ovoj verziji browsera.");
    }
}

//ucitavanje
function ucitajFormaReg() {
    if (typeof(Storage) !== "undefined") {
        document.getElementById("textImeReg").value = localStorage.getItem("textImeReg");
        document.getElementById("textPrezimeReg").value = localStorage.getItem("textPrezimeReg");
        document.getElementById("textMailReg").value = localStorage.getItem("textMailReg");
        document.getElementById("textKorImeReg").value = localStorage.getItem("textKorImeReg");
        document.getElementById("textSifraReg").value = localStorage.getItem("textSifraReg");
        document.getElementById("textSifraReg1").value = localStorage.getItem("textSifraReg1");
    }
    else {
        window.alert("Ucitavanje prethodno unesenih podataka u local storage nije podržano u ovoj verziji browsera.");
    }
}


//validacija
//validiraj imamo vec za ime i prezime forma = 2
//mail
function validirajEmailReg(mail) {
  var patern = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
  return patern.test(mail);
}
//za k.ime i sifru imamo validiraj
//potrebno je provjeriti da li su iste obje sifre
function focusLostEmailReg() {    //da ne mijenjam postojeći focusLost
  var unosEmail = document.getElementById("textMailReg").value;
  var uslov = validirajEmailReg(unosEmail);

  if(!uslov) {
    document.getElementById("pRegistracija").innerHTML = "Pogrešan format E-mail adrese!";
    localStorage.setItem("textMailReg", "");
    return false;
  }
  else {
    document.getElementById("pRegistracija").innerHTML = "";
  }
  return true;
}

function uporediSifre() {
  var sifra = document.getElementById("textSifraReg").value;
  var sifraPon = document.getElementById("textSifraReg1").value;
  if (sifra != sifraPon) {
    document.getElementById("pRegistracija").innerHTML = "Šifra i ponovljena šifra su različite!";
    return false;
  }
  else {
    document.getElementById("pRegistracija").innerHTML = "";
  }
  return true;
}

function onclickRegistracija() {
  var poruka = document.getElementById("pRegistracija");
  //ifovi  iza svakog pozivanja focus lost iz razloga da se ne poziva veci broj puta nego sto treba
  var u1 = focusLost("textImeReg", "Ime smije sadržavati samo slova engleskog alfabeta!", 2);
  if (!u1) return false;
  var u2 = focusLost("textPrezimeReg", "Prezime smije sadržavati samo slova engleskog alfabeta!", 2);
  if (!u2) return false;
  var u3 = focusLostEmailReg();
  if (!u3) return false;
  var u4 = focusLost("textKorImeReg", porukaKorIme, 1);
  if (!u4) return false;
  var u5 = focusLost("textSifraReg", porukaSifra, 1);
  if (!u5) return false;
  var u6 = focusLost("textSifraReg1", "Netačan format ponovljene šifre!", 1);
  if (!u6) return false;
  if (!uporediSifre()) return false;
    //registrovanje korisnika
  spremiFormaReg();
  //ako sve prođe, submit forme se desi
}


function onclickPromjena(arg) {
  if (arg == 1)
    document.getElementById("redPromjena").classList.remove("hide");
  else if (arg == 0)
    document.getElementById("redPromjena").classList.add("hide");
}


function validacijaPromjena(unos) { //stara sifra je iz sesije
  var novoKIme = document.getElementById("textKorImePromj").value;
  var staraSifra = document.getElementById("textSSifraPromj").value;
  var novaSifraC = document.getElementById("textNSifraPromj").value;

  if (novoKIme != "" && staraSifra == "" && novaSifraC == "") {
    var uslov = validiraj(novoKIme, 1);
    if (!uslov)
      document.getElementById("pPromjena").innerHTML = porukaKorIme;
    return uslov;
  }
  if ((staraSifra != "" && novaSifraC != "") && novoKIme == "") {
    var uslov = validiraj(staraSifra, 1);
    if (!uslov) {
      document.getElementById("pPromjena").innerHTML = "Netačan format stare šifre!";
      return false;
    }
    uslov = validiraj(novaSifraC, 1);
    if (!uslov) {
      document.getElementById("pPromjena").innerHTML = "Netačan format nove šifre!";
      return false;
    }
    if (staraSifra != unos) {
      document.getElementById("pPromjena").innerHTML = "Netačan unos stare šifre!";
      return false;
    }

    document.getElementById("pPromjena").innerHTML = "";
    return true;
  }
  document.getElementById("pPromjena").innerHTML = "Pogrešan unos! Napomena: Možete mijenjati ili samo korisničko ime ili samo šifru u istom koraku.";
  return false;
}


function onchangeDisEn(arg) {
  var input = document.getElementById("textKorImePromj");
  var input1 = document.getElementById("textSSifraPromj");
  var input2 = document.getElementById("textNSifraPromj");

  switch (arg) {
    case 0:
      if (input.value != "") {
        input1.disabled = true;
        input2.disabled = true;
      }
      else {
        input1.disabled = false;
        input2.disabled = false;
      }
      break;
    case 1:
      if (input1.value != "" || input2.value != "")
        input.disabled = true;
      else
        input.disabled = false;
    default:

  }
}

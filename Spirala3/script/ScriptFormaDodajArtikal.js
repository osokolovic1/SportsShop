function validirajDodaj(unos, arg) {
  var paternNaziv = /^[A-Za-z][a-zA-Z0-9šŠžŽćĆčČ. ]*$/;
  var paternCijena = /^([0-9]*((.)[0-9]{2}))$/;
  var paternSlika = /^[a-zA-Z0-9]*$/;

  switch (arg) {
    case 0:
      return paternNaziv.test(unos);
      break;
    case 1:
      return paternCijena.test(unos);
      break;
    case 2:
      return paternSlika.test(unos);
      break;
  }
}


function unosDodaj() {
  var naziv = document.getElementById("nazivDodaj").value;
  var cijena = document.getElementById("cijenaDodaj").value;
  var slika = document.getElementById("slikaDodaj").value;
  var poruka = document.getElementById("pDodaj");

  if (naziv == "" || cijena == "" || slika == "") {
    poruka.innerHTML = "Niste unijeli sve potrebne podatke!";
    return false;
  }
  if (!validirajDodaj(naziv, 0)) {
    poruka.innerHTML = "Pogrešan format naziva! Napomena: Dopušteno korištenje slova, brojeva, razmaka i tačke.";
    return false;
  }
  if (!validirajDodaj(cijena, 1)) {
    poruka.innerHTML = "Pogrešan format cijene! Napomena: Unesite potpunu cijenu(primjer: 4.00)";
    return false;
  }
  if (!validirajDodaj(slika, 2)) {
    poruka.innerHTML = "Pogrešan format naziva slike! Napomena: Dopušteno korištenje slova, brojeva.";
    return false;
  }
  poruka.innerHTML = "";
  return true;
}


function unosEdit() {
  var naziv = document.getElementById("nazivEdit").value;
  var cijena = document.getElementById("cijenaEdit").value;
  var slika = document.getElementById("slikaEdit").value;
  var poruka = document.getElementById("pEdit");

  if (naziv == "" && cijena == "" && slika == "") {
    poruka.innerHTML = "Morate odabrati artikal!";
    return false;
  }
  if (!validirajDodaj(naziv, 0)) {
    poruka.innerHTML = "Pogrešan format naziva! Napomena: Dopušteno korištenje slova, brojeva, razmaka i tačke.";
    return false;
  }
  if (!validirajDodaj(cijena, 1)) {
    poruka.innerHTML = "Pogrešan format cijene! Napomena: Unesite potpunu cijenu(primjer: 4.00)";
    return false;
  }
  if (!validirajDodaj(slika, 2)) {
    poruka.innerHTML = "Pogrešan format naziva slike! Napomena: Dopušteno korištenje slova, brojeva.";
    return false;
  }
  poruka.innerHTML = "";
  return true;
}



//funkcija za onclick na element liste
function selectElement(objekat, kategorija) {
  var naziv = objekat.childNodes[4].innerHTML;
  var cijena = objekat.childNodes[8].innerHTML;
  var cijena = cijena.replace(/[^0-9.]/g, "");
  //dohvatimo sliku
  var slikatemp = objekat.getElementsByTagName("img")[0];
  var slikaLokacija = slikatemp.src;
  var temp = slikaLokacija.split("/");
  var temp1 = temp[temp.length-1];
  //sada jos ukloniti .jpg
  var temp = temp1.split(".");
  var slika = temp[0];

  //upisimo
  document.getElementById("kategorijaEdit").value = kategorija;
  document.getElementById("pNazivEdit").value = naziv;
  document.getElementById("nazivEdit").value = naziv;
  document.getElementById("cijenaEdit").value = cijena
  document.getElementById("slikaEdit").value = slika;
}




//ovo radim da bih razdvojio akcije fin

function submitPromijeni() {
  var forma = document.getElementById("formaEdit");
  forma.action = "promjenaArtikla.php";
  if (unosEdit())
    forma.submit();
}

function submitIzbrisi() {
  var forma = document.getElementById("formaEdit");
  forma.action = "brisanjeArtikla.php";
  if (unosEdit())
    forma.submit();
}

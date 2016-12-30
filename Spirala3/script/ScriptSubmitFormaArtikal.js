//ovo radim da bih razdvojio akcije fin

function submitPromijeni() {
  var forma = document.getElementById("formaEdit");
  forma.action = "promjenaArtikla.php";
  forma.submit();
}

function submitIzbrisi() {
  var forma = document.getElementById("formaEdit");
  forma.action = "brisanjeArtikla.php";
  forma.submit();
}

xmlhttp = new XMLHttpRequest();

function ucitajSadrzaj(meni) {
  var ucitavanje;
  xmlhttp.onreadystatechange =
  function() {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
      document.getElementById("wrapperDiv").innerHTML = xmlhttp.responseText;
      if (ucitavanje == 1) ucitajFormaKontakt();
      else if (ucitavanje == 2) {
        ucitajFormaLogin();
        ucitajFormaReg();
      }
    }
    else {
      console.log(xmlhttp.readyState);
    }
  }
  var path;
  switch(meni) {
    case 1:
      path = "HomeContent.html";
      break;
    case 2:
      path = "ShopContent.html";
      break;
    case 3:
      path = "ContactContent.html";
      ucitavanje = 1;
      break;
    case 4:
      path = "PlacesContent.html";
      break;
    case 5:
      path = "AboutContent.html";
      break;
    case 6:
      path = "LoginContent.html";
      ucitavanje = 2;
      break;
  }

  xmlhttp.open("GET", path, true);
  xmlhttp.send();
}

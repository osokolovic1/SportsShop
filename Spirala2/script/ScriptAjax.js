xmlhttp = new XMLHttpRequest();

function ucitajSadrzaj(meni) {
  xmlhttp.onreadystatechange =
  function() {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
      document.getElementById("wrapperDiv").innerHTML = xmlhttp.responseText;
      if (meni == 3) ucitajFormaKontakt();
      else if (meni == 6) {
        ucitajFormaLogin();
        ucitajFormaReg();
      }
      else if (meni == 2) ucitajFormaShop();
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
      ucitavanje = 3;
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

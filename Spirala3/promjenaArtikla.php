<?php
  session_start();

  if (isset($_GET["promijeniEdit"])) {
    $kategorija = $_GET["kategorijaArtiklaEdit"];
    $path = "";

    if ($kategorija == "Odjeca") {
      $path = "products/clothes.xml";
    }
    else if ($kategorija == "Obuca") {
      $path = "products/shoes.xml";
    }
    else {
      $path = "products/requisites.xml";
    }
    $doc = new DOMDocument();
    $doc->load($path, LIBXML_NOBLANKS);
    $doc->formatOutput = true;
    //da ne bi ostajao prostor koji je cvor zauzimao
    $doc->preserveWhiteSpace = false;

    //ne treba provjera ima li artikla jer on sigurno postoji ako je na stranici
    $root = $doc->documentElement;
    $proizvodi = $root->getElementsByTagName("product");
    $postoji = false;
    foreach($proizvodi as $proizvod) {
      $nazivEdituj = $proizvod->getElementsByTagName("name")[0]->nodeValue;
      if ($nazivEdituj == $_GET["nazivArtiklaEdit"] && $nazivEdituj != $_GET["pNazivArtiklaEdit"]) {
        //provjera postoji li vec novi naziv
        $postoji = true;
        break;
      }
    }

    if ($postoji) {
      $_SESSION["greskaNazivEdit"] = "Proizvod sa unesenim novim nazivom već postoji!";
    }
    else {
      foreach($proizvodi as $proizvod) {
        $nazivEdituj = $proizvod->getElementsByTagName("name")[0]->nodeValue;
        if ($nazivEdituj == $_GET["pNazivArtiklaEdit"]) {
          //editovanje
          $proizvod->childNodes[1]->nodeValue = $_GET["nazivArtiklaEdit"];
          $proizvod->childNodes[2]->nodeValue = $_GET["cijenaArtiklaEdit"];
          $proizvod->childNodes[3]->nodeValue = "img/artikli/" . $_GET["slikaArtiklaEdit"] . ".jpg";
          unset($_SESSION["greskaNazivEdit"]);
          break;
        }
      }
    }

    $doc->save($path);

    header("Location: ShopContent.php");
    die;

  }
  else
    echo '<script>alert("greska");</scrtipt>';
?>

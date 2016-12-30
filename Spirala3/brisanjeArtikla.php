<?php
  session_start();

  if (isset($_GET["brisiEdit"])) {
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
    if (file_exists($path)) {
      $doc->load($path, LIBXML_NOBLANKS);
      $doc->formatOutput = true;
      //da ne bi ostajao prostor koji je cvor zauzimao
      $doc->preserveWhiteSpace = false;

      //ne treba provjera ima li artikla jer on sigurno postoji ako je na stranici
      $root = $doc->documentElement;
      $proizvodi = $root->getElementsByTagName("product");
      //pronadjimo cvor za izbaciti
      foreach($proizvodi as $proizvod) {
        $nazivUkloni = $proizvod->getElementsByTagName("name")[0]->nodeValue;
        if ($nazivUkloni == $_GET["pNazivArtiklaEdit"]) {
          $root->removeChild($proizvod);
          break;
        }
      }
      //artikal sigurno postoji cim je na stranici
      $doc->save($path);

      header("Location: ShopContent.php");
      exit("Uspješna akcija!");
    }
    else
      echo '<script>alert("Fajl ne postoji!");</scrtipt>';
      header("Location: ShopContent.php");
      die;
  }
?>

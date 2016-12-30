<?php
  session_start();
  if (isset($_GET["dodajArtikal"])) {

    $kategorija = $_GET["tipDodaj"];
    $path = "";
    //mora nesto biti odabrano jer je select u formi
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

      //dohvatimo root
      $root = $doc->documentElement;
      ///dodajmo broj na id
      $nodovi = $doc->getElementsByTagName("product");
      //treba provjeriti da li artikal sa istim imenom već postoji i ako postoji onda prekinuti posšto ću npr za brisanje tražiti po imenu(najlakse)
      foreach ($nodovi as $nod) {
        $nazivTemp = $nod->getElementsByTagName("name")[0]->nodeValue;
        if ($nazivTemp == $_GET["nazivArtiklaDodaj"]) {
          $_SESSION["greskaNazivDodaj"] = "Proizvod sa prethodno unsesenim imenom već postoji u istoj kategoriji!";

          header("Location: ShopContent.php");
          //umjesto die
          exit("Greška!");
        }
      }
      $id = $nodovi->length + 1;
      //kreirajmo child nodove
      //prije svega prvi koji na kraju dodajemo kad sve dodamo u njega
      $proizvod = $doc->createElement("product");
      $idChild = $doc->createElement("id", $id);
      $naziv = $doc->createElement("name", $_GET["nazivArtiklaDodaj"]);
      $cijena = $doc->createElement("price", $_GET["cijenaArtiklaDodaj"]);
      $slika = $doc->createElement("image", "img/artikli/" . $_GET["slikaArtiklaDodaj"] . ".jpg");
      //prvo dodajemo sve u dio pa u fajl
      $proizvod->appendChild($idChild);
      $proizvod->appendChild($naziv);
      $proizvod->appendChild($cijena);
      $proizvod->appendChild($slika);

      $root->appendChild($proizvod);

      //snimanje
      $doc->save($path);

      unset($_SESSION["greskaNazivDodaj"]);
      header("Location: ShopContent.php");
      exit("Uspješna akcija!");
    }
    else echo '<script>alert("Fajl ne postoji!");</scrtipt>';
    header("Location: ShopContent.php");
    die;
  }
?>

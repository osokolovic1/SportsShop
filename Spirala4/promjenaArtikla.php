<?php
  session_start();
  $veza = new PDO("mysql:host=" . getenv("MYSQL_SERVICE_HOST") . ";port=3306;dbname=sportsshop", "osokolovic1", "88xgjgizvyjfa7d2");
  $veza->exec("set names utf8");

  if (isset($_GET["promijeniEdit"])) {
    $upit1 = $veza->prepare("UPDATE artikli SET naziv=?, cijena=?, tip=? WHERE naziv=?");
    $upit2 = $veza->prepare("UPDATE slike SET lokacija=? WHERE slikaid=?");

    $kategorija = $_GET["kategorijaArtiklaEdit"];
    $tip = null;
    if ($kategorija == "Odjeca")
      $tip = 1;
    else if ($kategorija == "Obuca")
      $tip = 2;
    else
      $tip = 3;
    //provjeriti postoji li problem ako zelimo ostaviti isti naziv artikla
    $test = $upit1->execute(array($_GET["nazivArtiklaEdit"], $_GET["cijenaArtiklaEdit"], $tip, $_GET["pNazivArtiklaEdit"]));
    //ovo ce vratiti false ako vec postoji ovaj sa istim nazivom kao novi naziv i tako zakljucujemo postoji li
    if ($test) {
      $upitPronadji = $veza->prepare("SELECT artikalid FROM artikli WHERE naziv=?");
      $upitPronadji->execute(array($_GET["pNazivArtiklaEdit"])); //prvobitni naziv artikla u formi
      $temp = $upitPronadji->fetch();
      $id = $temp["artikalid"];
      $lokacija = "img/artikli/" . $_GET["slikaArtiklaEdit"] . ".jpg";
      $upit2->execute(array($lokacija, $id));
      unset($_SESSION["greskaNazivEdit"]);
    }
    else
      //greska jer postoji vec
      $_SESSION["greskaNazivEdit"] = "Proizvod sa unesenim novim nazivom već postoji!";

    header("Location: ShopContent.php");
    die;
  }
?>

<?php
  session_start();
  $veza = new PDO("mysql:host=" . getenv("MYSQL_SERVICE_HOST") . ";port=3306;dbname=sportsshop", "osokolovic1", "88xgjgizvyjfa7d2");
  $veza->exec("set names utf8");

  if (isset($_GET["dodajArtikal"])) {
    $upit1 = $veza->prepare("INSERT INTO skladiste SET stanje=?");
    $upit2 = $veza->prepare("INSERT INTO artikli (artikalid, naziv, cijena, tip)
                                    VALUES (?, ?, ?, ?)");
    $upit3 = $veza->prepare("INSERT INTO slike SET slikaid=?, lokacija=?");
    $upitTest = $veza->prepare("SELECT artikalid FROM artikli WHERE naziv=?");

    //provjerimo postoji li vec sa ovim nazivom
    $upitTest->execute(array($_GET["nazivArtiklaDodaj"]));

    if ($upitTest->rowCount() == 0) {
      //dodaj artikal
      $upit1->execute(array(1));

      $temp = $veza->query("SELECT Max(id) FROM skladiste");
      $idrow = $temp->fetch();
      $id = $idrow[0];
      $slika = "img/artikli/" . $_GET["slikaArtiklaDodaj"] . ".jpg";
      if (!file_exists($slika))
        $slika = "img/error.jpg"; //ako ne postoji slika sa unesenim nazivom
      $kategorija = $_GET["tipDodaj"];
      //mora nesto biti odabrano jer je select u formi
      $tip = null;
      if ($kategorija == "Odjeca")
        $tip = 1;
      else if ($kategorija == "Obuca")
        $tip = 2;
      else
        $tip = 3;

      $upit2->execute(array($id, $_GET["nazivArtiklaDodaj"], $_GET["cijenaArtiklaDodaj"], $tip));
      $upit3->execute(array($id, $slika));

      unset($_SESSION["greskaNazivDodaj"]);
      header("Location: ShopContent.php");
      exit("Uspješna akcija!");
    }
    else {
      //artikal sa nazivom vec postoji u bazi
      $_SESSION["greskaNazivDodaj"] = "Proizvod sa prethodno unsesenim imenom već postoji u bazi!";
      header("Location: ShopContent.php");
      //umjesto die
      exit("Greška!");
    }

    header("Location: ShopContent.php");
    die;
  }
?>

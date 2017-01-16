<?php
  session_start();
  $veza = new PDO("mysql:host=" . getenv("MYSQL_SERVICE_HOST") . ";port=3306;dbname=sportsshop", "osokolovic1", "88xgjgizvyjfa7d2");
  $veza->exec("set names utf8");

  $upitPronadji = $veza->prepare("SELECT artikalid FROM artikli WHERE naziv=?");
  $upitPronadji->execute(array($_GET["pNazivArtiklaEdit"])); //prvobitni naziv artikla u formi
  $temp = $upitPronadji->fetch();
  $id = $temp["artikalid"];

  $upitBrisi1 = $veza->prepare("DELETE FROM skladiste WHERE id=?");
  $upitBrisi2 = $veza->prepare("DELETE FROM artikli WHERE artikalid=?");
  $upitBrisi3 = $veza->prepare("DELETE FROM slike WHERE slikaid=?");

  $upitBrisi2->execute(array($id));
  $upitBrisi3->execute(array($id));
  //zadnji brisemo ovaj sa primary key-em tj. koji pokazuje na ove ostale (njega prvog dodajemo)
  $test=$upitBrisi1->execute(array($id));

  header("Location: ShopContent.php");
  die;
?>

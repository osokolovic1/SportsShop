<?php
  session_start();

  //konekcija
  $veza = new PDO("mysql:host=" . getenv("MYSQL_SERVICE_HOST") . ";port=3306;dbname=sportsshop", "osokolovic1", "88xgjgizvyjfa7d2");
  $veza->exec("set names utf8");


  $upitProvjera = $veza->prepare("SELECT * FROM artikli WHERE naziv=?"); //provjeri, dodaj artikal tek ako ovo vrati nula redova
  $upit1 = $veza->prepare("INSERT INTO skladiste SET stanje=?");
  $upit2 = $veza->prepare("INSERT INTO artikli SET artikalid=?, naziv=?, cijena=?, tip=?");
  $upit3 = $veza->prepare("INSERT INTO slike SET slikaid=?, lokacija=?");
  //prebaci artikle
  if (file_exists("products/clothes.xml")) {
    $xmlclothes = simplexml_load_file("products/clothes.xml");
    $clothes = $xmlclothes->children();

    foreach ($clothes as $cth) {
      $upitProvjera->execute(array($cth->name));
      if ($upitProvjera->rowCount() == 0) {         //ako ne postoji nijedan sa istim imenom u bazi
        $upit1->execute(array(1));
        //dohvatimo id zadnjeg dodanog - autoincrement
        $temp = $veza->query("SELECT Max(id) FROM skladiste");
        $idrow = $temp->fetch();
        $id = $idrow[0];
        $upit2->execute(array($id, $cth->name, $cth->price, 1));
        $upit3->execute(array($id, $cth->image));
      }
    }
  }
  if (file_exists("products/shoes.xml")) {
    $xmlshoes = simplexml_load_file("products/shoes.xml");
    $shoes = $xmlshoes->children();

    foreach ($shoes as $shoe) {
      $upitProvjera->execute(array($shoe->name));
      if ($upitProvjera->rowCount() == 0) {
        $upit1->execute(array(1));
        $temp = $veza->query("SELECT Max(id) FROM skladiste");
        $idrow = $temp->fetch();
        $id = $idrow[0];

        $upit2->execute(array($id, $shoe->name, $shoe->price, 2));
        $upit3->execute(array($id, $shoe->image));
      }
    }
  }
  if (file_exists("products/requisites.xml")) {
    $xmlreq = simplexml_load_file("products/requisites.xml");
    $reqs = $xmlreq->children();

    foreach ($reqs as $req) {
      $upitProvjera->execute(array($req->name));
      if ($upitProvjera->rowCount() == 0) {
        $upit1->execute(array(1));
        $temp = $veza->query("SELECT Max(id) FROM skladiste");
        $idrow = $temp->fetch();
        $id = $idrow[0];

        $upit2->execute(array($id, $req->name, $req->price, 3));
        $upit3->execute(array($id, $req->image));
      }
    }
  }

  //prebacivanje korisnika:   -koristim kod iz preuzimanjeCSV   -insert ignore zbog user name-a koji mora biti unique
  //basename("/etc/example.d", ".d")
  $upitKorisnik = $veza->prepare("INSERT IGNORE INTO korisnici (ime, prezime, email, korisnicko_ime, sifra, rola)
                                                VALUES (?, ?, ?, ?, ?, ?)");
  $files = glob("users/*xml");
  foreach ($files as $file) {
    $xmlfile = file_get_contents($file, FILE_TEXT);
    $xml = new SimpleXMLElement($xmlfile);

    $uName = basename($file, ".xml");
    $rola = null;
    if ($xml->rola != "")   //rola u bazi je null ili 1 ukoliko se radi o adminu.
      $rola = 1;
    $upitKorisnik->execute(array($xml->name, $xml->surname, $xml->email, $uName, $xml->password, $rola));
  }


  header("Location: index.php");
?>

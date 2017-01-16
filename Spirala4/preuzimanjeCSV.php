<?php
  session_start();
  //veza za bazu
  $veza = new PDO("mysql:host=" . getenv("MYSQL_SERVICE_HOST") . ";port=3306;dbname=sportsshop", "osokolovic1", "88xgjgizvyjfa7d2");
  $veza->exec("set names utf8");

  $upit = $veza->prepare("SELECT * FROM korisnici");
  if ($upit->execute()) {
    //kreiranje csv-a
    $csvHeader = array("Ime", "Prezime", "E-mail");
    $csvFile = fopen('korisnici.csv', 'w');
    fputcsv($csvFile, $csvHeader);
    fclose($csvFile);

    $vrijednosti = [];
    $rezultat = $upit->fetchAll();
    foreach ($rezultat as $red) {
      $vrijednosti[] = $red["ime"];
      $vrijednosti[] = $red["prezime"];
      $vrijednosti[] = $red["email"];

      $csvFile = fopen('korisnici.csv', 'a');
      fputcsv($csvFile, $vrijednosti);
      fclose($csvFile);

      $vrijednosti = [];
    }

    $contenttype = "application/force-download";
    header("Content-Type: " . $contenttype);
    header("Content-Disposition: attachment; filename=\"" . basename('Korisnici.csv') . "\";");
    readfile("Korisnici.csv");
    exit;
  }

?>

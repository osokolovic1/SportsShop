<?php
  session_start();

  $files = glob("users/*xml");

  if (is_array($files)) {

    $csvHeader = array("Ime", "Prezime", "E-mail");
    $csvFile = fopen('korisnici.csv', 'w');
    fputcsv($csvFile, $csvHeader);
    fclose($csvFile);

    $vrijednosti = [];

    foreach ($files as $file) {
      $xmlfile = file_get_contents($file, FILE_TEXT);
      //sada kreiramo xml
      $xml = new SimpleXMLElement($xmlfile);
      //vrijednostima cvorova pristupam koristenjem njihovog naziva
      $vrijednosti[] = $xml->name;
      $vrijednosti[] = $xml->surname;
      $vrijednosti[] = $xml->email;
      //ubacujemo vrijednosti u csv
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

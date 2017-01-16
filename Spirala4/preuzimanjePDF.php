<?php
require('./fpdf181/fpdf.php');
class PDF extends FPDF
{
    function Header()
    {
        $this->Image('./img/logo.png', 80, 5, 120);
        $this->SetFont('Arial', 'B', 28);
        $this->Cell(-30, 20, 'Artikli', 0, 0);
    }
    function Footer()
    {
        //br stranice
        $this->SetY(-20);
        $this->SetX(170);

        $this->SetFont('Arial','I', 15);
        $this->Cell(0, 10, $this->PageNo(), 0, 0, 'C');
    }
    function BasicTable($header, $data)
    {
        // Data
        $this->SetY(55);
        $this->SetFont('Arial', '', 14);
        $br = 1;
        foreach($data as $row)
        {
            /*foreach($row as $col){
                $this->Cell(70, 11, $col, 0, 0);
            }*/
            $this->Cell(30, 11, $br . ".", 0, 0);
            $this->Cell(70, 11, $row["naziv"], 0, 0);
            $this->Cell(70, 11, $row["cijena"] . " KM", 0, 0);
            $br++;
            $this->Ln();
        }
    }
}


    $pdf = new PDF();
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->SetFont('Arial', '', 12);
    $header = array("Artikal", "Cijena");

    $veza = new PDO("mysql:host=" . getenv("MYSQL_SERVICE_HOST") . ";port=3306;dbname=sportsshop", "osokolovic1", "88xgjgizvyjfa7d2");
    $veza->exec("set names utf8");
    $upit = $veza->prepare("SELECT artikalid, naziv, cijena FROM artikli");
    $rezultat = null;
    if ($upit->execute()) {
      $rezultat = $upit->fetchAll();
      $pdf->BasicTable($header, $rezultat);
    }

  $pdf->SetX(15);
  $pdf->SetY(80);
  $pdf->Output();
?>

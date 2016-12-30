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
        foreach($data as $row)
        {
            foreach($row as $col){
                $this->Cell(70, 11, $col, 0, 0);
            }
            $this->Ln();
        }
    }
}
    $pdf = new PDF();
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->SetFont('Arial', '', 12);
    $header = array("Redni broj", "Artikal", "Cijena");

    $xmlOdjeca = new SimpleXMLElement("<?xml version='1.0' encoding='utf-8'?><clothes></clothes>");
    $i = 1;

    if (file_exists("products/clothes.xml")) {
      $xml = simplexml_load_file("products/clothes.xml");
      foreach ($xml->children() as $child) {
        $proizvod = $xmlOdjeca->addChild("product");
        $proizvod->addChild("number", $i . ".");
        $proizvod->addChild("name", $child->name);
        $proizvod->addChild("price", $child->price);
        $i++;
      }
  }
  if (file_exists("products/shoes.xml")) {
    $xml = simplexml_load_file("products/shoes.xml");
    foreach ($xml->children() as $child) {
      $proizvod = $xmlOdjeca->addChild("product");
      $proizvod->addChild("number", $i . ".");
      $proizvod->addChild("name", $child->name);
      $proizvod->addChild("price", $child->price);
      $i++;
    }
  }
  if (file_exists("products/requisites.xml")) {
    $xml = simplexml_load_file("products/requisites.xml");
    foreach ($xml->children() as $child) {
      $proizvod = $xmlOdjeca->addChild("product");
      $proizvod->addChild("number", $i . ".");
      $proizvod->addChild("name", $child->name);
      $proizvod->addChild("price", $child->price);
      $i++;
    }
  }

  $pdf->BasicTable($header, $xmlOdjeca);
  $pdf->SetX(15);
  $pdf->SetY(80);
  $pdf->Output();
?>

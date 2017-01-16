<?php
  session_start();
?>

 <!DOCTYPE html>
 <html lang="en">

 <head>
 	<meta charset="UTF-8">
 	<!--<meta name="viewport" content="width=device-width, initial-scale=1.0">-->
 	<title>Sport shop</title>
 	<link rel="stylesheet" href="style.css">
 	<script src="script/Carousel.js"></script>
 	<script src="script/ScriptFormaKontakt.js"></script>
 	<script src="script/ScriptFormaShop.js"></script>
 	<script src="script/ScriptFormaLogin.js"></script>
 </head>

 <body>

   <div class="red"><!--logo-->
     <div class="kolona dvanaest logo"><a href="#"><img src="img/logo.png" alt="error" id="logo"></a></div>
   </div>

   <div class="red"><!--meni--><!--label okolo zbog kursora tj da ne bude onaj za oznaku teksta, a kad je samo label nemoguce mijenjati font iz nekog razl-->
     <label><div class="kolona dva meni"><a href="HomeContent.php">POCETNA</a></div></label>
     <label><div class="kolona dva meni"><a href="ShopContent.php">PRODAVNICA</a></div></label>
     <label><div class="kolona dva meni"><a href="ContactContent.php">KONTAKT</a></div></label>
     <label><div class="kolona dva meni"><a href="PlacesContent">POSLOVNICE</a></div></label>
     <label><div class="kolona dva meni"><a href="AboutContent.php">O NAMA</a></div></label>
     <label><div class="kolona dva meni"><a href="LoginContent.php">PRIJAVA</a></div></label>
   </div>
   <?php
    if (isset($_SESSION["korisnik"])) { ?>
      <div class="red">
        <a class="odjavaLink" href="logout.php">Odjava</a>
        <a class="odjavaLink" href="preuzimanjePDF.php">Katalog(PDF)</a>
        <?php if(isset($_SESSION["rola"]) && $_SESSION["rola"] == "administrator") { ?>
          <a class="odjavaLink" href="preuzimanjeCSV.php">Podaci o korisnicima(CSV)</a>
          <a class="odjavaLink" href="XMLuBazu.php">Prebaci podatke u bazu</a>
        <?php } ?>
      </div>
    <?php } ?>

 </body>
 </html>

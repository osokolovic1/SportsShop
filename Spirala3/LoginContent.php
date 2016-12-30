<?php
  include('header.php');

  $greska = "";
  $greskaReg ="";
  $greskaPromj = "";

  if (isset($_POST["prijava"])) {

    $korisnik = preg_replace("/[^a-zA-Z0-9]/", "", $_POST["inputKorisnickoImeLogin"]);
    $izvornaSifra = ($_POST["inputSifraLogin"]);
    $sifra = md5($izvornaSifra);

    if (file_exists("users/" . $korisnik . ".xml")) {
      $korisnikXml = new SimpleXMLElement("users/" . $korisnik . ".xml", 0, true);

        if ($sifra == $korisnikXml->password) {
          session_start();
          $_SESSION["korisnik"] = $korisnik;
          $_SESSION["izvornaSifra"] = $izvornaSifra;
          $_SESSION["sifra"] = $sifra;
          if ($korisnikXml->rola == "administrator") //rola pocetna se dodaje rucno tj. u fajlu, ne moze kroz stranicu, jedan je admin
            $_SESSION["rola"] = "administrator";
          header("Location: index.php");
          die;
        }
        else {
          $greska = "Pogrešna šifra!";
        }
    }
    else {
      $greska = "Korisnik ne postoji!";
    }
  }
?>

<div id="login">
  <div class="red">
      <div class="kolona dvanaest prazno centar"><b>Dobro došli! Prijavite se ukoliko imate korisnički profil. Ukoliko nemate profil registrujte se
          i otkrijte različita iznenađenja!</b>
      </div>
  </div>

  <div class="red">
      <div class="kolona tri prazno"></div>

      <div class="kolona sest prazno"> <!--forma login-->
          <form class="forma" onsubmit="return onclickPrijava();" action="#" method="post">
              <h3>Prijava:</h3>
              <label>Korisničko ime:</label><br>
              <input type="text" name="inputKorisnickoImeLogin" id="textKorIme"
              onblur="focusLost('textKorIme', 'Korisničko ime smije sadržavati samo alfanumeričke znakove i mora biti duže od 4 znaka!', 1);">
              <br><br>
              <label>Šifra:</label><br>
              <input type="password" name="inputSifraLogin" id="textSifra" onblur="focusLost('textSifra', 'Netačan format šifre!', 1);">
              <br>
              <div class="pValid">
                <p id="pPrijava">
                  <?php
                    if ($greska != "")
                    echo $greska;
                   ?>
                </p>
              </div>
              <div class="buttonWrap">
                  <button type="submit" name="prijava" onclick="spremiFormaLogin(); onclickPrijava();" onfocus="onclickPrijava();">Prijava</button>
                  <!-- dodao i onfocus event da bi brze radilo u nekim slucajevima i da ne bi zahtijevalo više click-ova-->
                  <button type="button" name="promjena" onclick="onclickPromjena(1);"
                    <?php if (isset($_SESSION["korisnik"]))
                            echo "enabled";
                          else echo "disabled";?>>
                    Promjena
                  </button>
              </div>
          </form>
          <div class="kolona tri prazno"></div>
      </div>


      <?php
        if (isset($_POST["promjenaOK"])) {
          if (isset($_POST["inputKorisnickoImePromj"])) {
            $novoKIme = preg_replace("/[^a-zA-Z0-9]/", "", $_POST["inputKorisnickoImePromj"]);
            if ($novoKIme != "") {
              if (!file_exists("users/" . $novoKIme . ".xml")){
                //nadji fajl sa imenom iz sesije i preimenuj ga u novo
                rename("users/" . $_SESSION["korisnik"] . ".xml", "users/" . $novoKIme . ".xml");
                $_SESSION["korisnik"] = $novoKIme;
                header("Location: LoginContent.php");
                die;
              }
              else $greskaPromj = "Korisnik sa unesenim imenom već postoji!";
            }
          }
          if (isset($_POST["inputSSifraPromj"])) {
            $staraSifra = preg_replace("/[^a-zA-Z0-9]/", "", $_POST["inputSSifraPromj"]);
            if ($_SESSION["sifra"] == md5($staraSifra)) {
              //ucitamo i promijenimo sifru
              $novaSifra = preg_replace("/[^a-zA-Z0-9]/", "", $_POST["inputNSifraPromj"]);
              $doc = new DOMDocument();
              //da bi bio prijavljen mora postojati pa zato ne provjeravamo
              $doc->load("users/" . $_SESSION["korisnik"] . ".xml");
              $doc->getElementsByTagName("password")->item(0)->nodeValue = md5($novaSifra);
              $doc->save("users/" . $_SESSION["korisnik"] . ".xml");

              $_SESSION["izvornaSifra"] = $novaSifra;
              $_SESSION["sifra"] = md5($novaSifra);
            }
          }
        }
      ?>
      <!--forma promjena-->
      <div class="red hide" id="redPromjena">
        <div class="kolona tri prazno"></div>
          <div class="kolona sest prazno">
            <form class="forma" onsubmit="return validacijaPromjena('<?php echo $_SESSION["izvornaSifra"];?>');" action="" method="post">
              <h3>Promjena - unesite ono što želite promijeniti:</h3>
              <label>Novo korisničko ime:</label><br>
              <input type="text" name="inputKorisnickoImePromj" id="textKorImePromj" onchange="onchangeDisEn(0);">
              <br><br>
              <label>Stara šifra:</label><br>
              <input type="password" name="inputSSifraPromj" id="textSSifraPromj" onchange="onchangeDisEn(1);">
              <br><br>
              <label>Nova šifra:</label><br>
              <input type="password" name="inputNSifraPromj" id="textNSifraPromj" onchange="onchangeDisEn(1);">
              <br>
              <div class="pValid">
                <p id="pPromjena">
                  <?php
                    if ($greskaPromj != "")
                    echo $greskaPromj;
                   ?>
                </p>
              </div>
              <div class="buttonWrap">
                  <button type="submit" name="promjenaOK" onclick="" onfocus="">OK</button>
                  <!-- dodao i onfocus event da bi brze radilo u nekim slucajevima i da ne bi zahtijevalo više click-ova-->
                  <button type="button" name="promjenaExit" onclick="onclickPromjena(0)">Zatvori</button>
              </div>
            </form>
          </div>
        <div class="kolona tri prazno"></div>
        <br>
      </div>






      <!--forma registracija-->
      <?php
      if (isset($_POST["registracija"])) {
        //radi bez event prevent
        //ovdje imamo validirane sve unose prije submita
        $ime = preg_replace("/[^a-zA-Z]/", "", $_POST["inputImeReg"]);
        $prezime = preg_replace("/[^a-zA-Z]/", "", $_POST["inputPrezimeReg"]);
        $email = $_POST["inputMail"];
        $korImeReg = $_POST["inputKorisnickoImeReg"];
        $sifraReg = $_POST["inputSifraReg"];

        if (file_exists("users/" . $korImeReg . ".xml"))
          $greskaReg = "Korisnik sa unesenim korisničkim imenom već postoji!";
        else {
          $xml = new DOMDocument('1.0', 'utf-8');
          $xml->formatOutput = true;

          $xmlRoot = $xml->createElement("user");
          $xml->appendChild($xmlRoot);

          $name = $xml->createElement("name", $ime);
          $surname = $xml->createElement("surname", $prezime);
          $email = $xml->createElement("email", $email);
          $password = $xml->createElement("password", md5($sifraReg));
          $rola = $xml->createElement("rola", ""); //ovdje izmjena na kraju ako se odlučim za registraciju admina
          $xmlRoot->appendChild($name);
          $xmlRoot->appendChild($surname);
          $xmlRoot->appendChild($email);
          $xmlRoot->appendChild($password);
          $xmlRoot->appendChild($rola);

          $xml->save("users/" . $korImeReg . ".xml");
        }
      }
      ?>
      <div class="red">
        <div class="kolona dva prazno"></div>
        <div class="kolona osam prazno"> <!--forma registracija-->
            <form class="forma" id="formaRegistracija" onsubmit="return onclickRegistracija();" action="" method="post">
                <h3>Registracija:</h3>
                <label>Ime:</label><br>
                <input type="text" name="inputImeReg" id="textImeReg"
                  onblur="focusLost('textImeReg', 'Ime smije sadržavati samo slova engleskog alfabeta!', 2);">
                <br><br>
                <label>Prezime:</label><br>
                <input type="text" name="inputPrezimeReg" id="textPrezimeReg"
                  onblur="focusLost('textPrezimeReg', 'Prezime smije sadržavati samo slova engleskog alfabeta!', 2);">
                <br><br>
                <label>E-mail adresa:</label><br>
                <input type="text" name="inputMail" id="textMailReg" onblur="focusLostEmailReg();">
                <br><br>
                <label>Korisničko ime:</label><br>
                <input type="text" name="inputKorisnickoImeReg" id="textKorImeReg"
                  onblur="focusLost('textKorImeReg', 'Korisničko ime smije sadržavati samo alfanumeričke znakove i mora biti dužine veće od 4 znaka!', 1);">
                <br><br>
                <label>Šifra:</label><br>
                <input type="password" name="inputSifraReg" id="textSifraReg" onblur="focusLost('textSifraReg', 'Netačan format šifre!', 1);">
                <br><br>
                <label>Ponovite Šifru:</label><br>
                <input type="password" name="inputSifraPonovoReg" id="textSifraReg1"
                  onblur="focusLost('textSifraReg1', 'Netačan format ponovljene šifre!', 1); uporediSifre();">
                <br>
                <div class="pValid">
                  <p id="pRegistracija">
                    <?php
                      if ($greskaReg != "")
                      echo $greskaReg;
                     ?>
                  </p>
                </div>
                <div class="buttonWrap">
                    <button type="submit" name="registracija" onclick="spremiFormaReg(); onclickRegistracija();">OK</button>
                </div>
            </form>
        </div>

        <div class="kolona dva prazno"></div>

    </div>
  </div>
</div>

<?php
  include('footer.php');
?>

<?php
  include('header.php');
  try {
    $veza = new PDO("mysql:host=" . getenv("MYSQL_SERVICE_HOST") . ";port=3306;dbname=sportsshop", "osokolovic1", "88xgjgizvyjfa7d2");
    $veza->exec("set names utf8");
  }
  catch (PDOException $e) {
    echo $e->getMessage();
    exit;
  }

  $greska = "";
  $greskaReg ="";
  $greskaPromj = "";

  if (isset($_POST["prijava"])) {

    $korisnik = preg_replace("/[^a-zA-Z0-9]/", "", $_POST["inputKorisnickoImeLogin"]);
    $izvornaSifra = ($_POST["inputSifraLogin"]);
    $sifra = md5($izvornaSifra);
    //dohvatimo iz baze korisnika ako postoji
    $upit = $veza->prepare("SELECT * FROM korisnici WHERE korisnicko_ime=?");
    $upit->execute(array($korisnik));
    //provjera da li postoji tj da li je upit ista vratio
    if ($upit->rowCount() > 0) {
      $rezultat = $upit->fetch();

        if ($sifra == $rezultat["sifra"]) {
          session_start();
          $_SESSION["korisnik"] = $korisnik;
          $_SESSION["izvornaSifra"] = $izvornaSifra;
          $_SESSION["sifra"] = $sifra;
          if ($rezultat["rola"] != null) //rola pocetna, jedan je admin
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

            $upitPretraga = $veza->prepare("SELECT * FROM korisnici WHERE korisnicko_ime=?");
            $upitPromjena = $veza->prepare("UPDATE korisnici SET korisnicko_ime=? WHERE korisnicko_ime=?");

            $novoKIme = preg_replace("/[^a-zA-Z0-9]/", "", $_POST["inputKorisnickoImePromj"]);
            if ($novoKIme != "") {
              $upitPretraga->execute(array($novoKIme));
              if ($upit->rowCount() == 0){   //ako ne postoji korisnik sa istim novim imenom
                //update postojeceg usera
                $upitPromjena->execute(array($novoKIme, $_SESSION["korisnik"]));
                $_SESSION["korisnik"] = $novoKIme;
                header("Location: LoginContent.php");
                die;
              }
              else $greskaPromj = "Korisnik sa unesenim imenom već postoji!";
            }
          }
          if (isset($_POST["inputSSifraPromj"])) {
            $staraSifra = preg_replace("/[^a-zA-Z0-9]/", "", $_POST["inputSSifraPromj"]);
            if ($_SESSION["sifra"] == md5($staraSifra)) { //tacno unesena stara sifra
              //ucitamo i promijenimo sifru
              $novaSifra = preg_replace("/[^a-zA-Z0-9]/", "", $_POST["inputNSifraPromj"]);
              $novaSifraMD5 = md5($novaSifra);
              $upit = $veza->prepare("UPDATE korisnici SET sifra=? WHERE korisnicko_ime=?");
              $upit->execute(array($novaSifraMD5, $_SESSION["korisnik"]));

              $_SESSION["izvornaSifra"] = $novaSifra;
              $_SESSION["sifra"] = $novaSifraMD5;
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
        //dodano ako je prijavljen već da se ne može registrovati
        if (!isset($_SESSION["korisnik"])) {
          $ime = preg_replace("/[^a-zA-Z]/", "", $_POST["inputImeReg"]);
          $prezime = preg_replace("/[^a-zA-Z]/", "", $_POST["inputPrezimeReg"]);
          $email = $_POST["inputMail"];
          $korImeReg = $_POST["inputKorisnickoImeReg"];
          $sifraReg = $_POST["inputSifraReg"];

          $upitProvjera = $veza->prepare("INSERT INTO korisnici (ime, prezime, email, korisnicko_ime, sifra)
                                                  VALUES (?, ?, ?, ?, ?)");
          $test = $upitProvjera->execute(array($ime, $prezime, $email, $korImeReg, md5($sifraReg)));
          if (!$test)
            $greskaReg = "Korisnik sa unesenim korisničkim imenom već postoji!";
          else
            $greskaReg = "";
        }
        else
          $greskaReg = "Već ste prijavljeni!";
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

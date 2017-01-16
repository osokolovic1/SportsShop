<?php
  include('header.php');
  $veza = new PDO("mysql:host=" . getenv("MYSQL_SERVICE_HOST") . ";port=3306;dbname=sportsshop", "osokolovic1", "88xgjgizvyjfa7d2");
  $veza->exec("set names utf8");

  $upit = $veza->prepare("SELECT * FROM artikli");
  $upit->execute();
  $rezultat = $upit->fetchAll();

  $upitSlika = $veza->prepare("SELECT lokacija FROM slike WHERE slikaid=?");
?>

<script src="script/ScriptFormaDodajArtikal.js"></script>

<div id="shop">
  <div class="red">
      <div class="kolona tri prazno">
          <!--Pretraga-forma-->
          <form class="forma">
              <h3>Pretraga:</h3>
              <label>Odaberite kategoriju:</label><br>
              <select name="tip" id="selectTip">
                  <option value="odjeca">Odjevni artikli</option>
                  <option value="obuca">Obuća</option>
                  <option value="rekviziti">Rekviziti</option>
              </select>
              <br><br>
              <label>Odaberite brend:</label><br>
              <select name="brend" id="selectBrend">
                  <option value="adidas">Adidas</option>
                  <option value="nike">Nike</option>
                  <option value="puma">Puma</option>
                  <option value="umbro">Umbro</option>
                  <option value="karimor">Karimor</option>
                  <option value="lonsdale">Lonsdale</option>
                  <option value="asics">Asics</option>
                  <option value="nb">New Balance</option>
                  <option value="slazenger">Slazenger</option>
                  <option value="head">Head</option>
                  <option value="suunto">Suunto</option>
                  <option value="skechers">Skechers</option>
                  <option value="wilson">Wilson</option>
                  <option value="arena">Arena</option>
                  <option value="speedo">Speedo</option>
              </select>
              <br><br>
              <label>Dodatno:</label><br>
              <input type="text" name="dodatno" id="inputDodatno">
              <br><br>
              <div class="buttonWrap">
                  <button type="button" onclick="spremiFormaShop();">Traži</button>
              </div>
          </form>
      </div>

      <div class="kolona devet artikli">
          <div class="red artikli">
              <h2 class="artikli naslov">Odjeća:</h2>
              <ul class="artikli">
                <?php
                  foreach ($rezultat as $red) {
                    if ($red["tip"] == 1) {
                      $upitSlika->execute(array($red["artikalid"]));
                      $slika = $upitSlika->fetch();
                    ?>
                      <li onclick="selectElement(this, 'Odjeca')">
                          <img src="<?php echo $slika["lokacija"]; ?>" onerror="if (this.src != 'img/error.jpg') this.src = 'img/error.jpg';">
                          <p><div class="snaziv"><?php echo $red["naziv"];?></div></p>
                          <p><div class="scijena"><?php echo $red["cijena"];?>KM</div></p>
                      </li>
                  <?php }
                 }
                ?>
              </ul>
          </div>

          <div class="red artikli">
              <h2 class="artikli naslov">Obuća:</h2>
              <ul class="artikli">
                <?php
                  foreach ($rezultat as $red) {
                    if ($red["tip"] == 2) {
                      $upitSlika->execute(array($red["artikalid"]));
                      $slika = $upitSlika->fetch();
                    ?>
                      <li onclick="selectElement(this, 'Obuca')">
                          <img src="<?php echo $slika["lokacija"]; ?>" onerror="if (this.src != 'img/error.jpg') this.src = 'img/error.jpg';">
                          <p><div class="snaziv"><?php echo $red["naziv"];?></div></p>
                          <p><div class="scijena"><?php echo $red["cijena"];?>KM</div></p>
                      </li>
                  <?php }
                 }
                ?>
              </ul>
          </div>

          <div class="red artikli">
              <h2 class="artikli naslov">Rekviziti:</h2>
              <ul class="artikli">
                <?php
                  foreach ($rezultat as $red) {
                    if ($red["tip"] == 3) {
                      $upitSlika->execute(array($red["artikalid"]));
                      $slika = $upitSlika->fetch();
                    ?>
                      <li onclick="selectElement(this, 'Rekviziti')">
                          <img src="<?php echo $slika["lokacija"]; ?>" onerror="if (this.src != 'img/error.jpg') this.src = 'img/error.jpg';">
                          <p><div class="snaziv"><?php echo $red["naziv"];?></div></p>
                          <p><div class="scijena"><?php echo $red["cijena"];?>KM</div></p>
                      </li>
                  <?php }
                 }
                ?>
              </ul>
          </div>
      </div>
  </div>



<!--forma edit-->
  <?php
    if (isset($_SESSION["korisnik"]) && isset($_SESSION["rola"])) { ?>
      <div class="red">
        <div class="kolona tri prazno"></div>
        <div class="kolona devet artikli prazno">
          <form class="forma" id="formaEdit" onsubmit="return unosEdit();" method="get">
              <h3>Uređivanje artikla:</h3>
              <label>Kategorija:</label><br>
              <input type="text" name="kategorijaArtiklaEdit" placeholder="Odaberite artikal" id="kategorijaEdit" readonly="true">
              <label>Prvobitni naziv artikla:</label><br>
              <input type="text" name="pNazivArtiklaEdit" placeholder="Odaberite artikal" id="pNazivEdit" readonly="true">
              <p></P><br>
              <label>Novi naziv artikla:</label><br>
              <input type="text" name="nazivArtiklaEdit" placeholder="Odaberite artikal" id="nazivEdit">
              <label>Cijena artikla:</label><br>
              <input type="text" name="cijenaArtiklaEdit" placeholder="Odaberite artikal" id="cijenaEdit">
              <label>Slika-ime fajla:</label><br>
              <input type="text" name="slikaArtiklaEdit" placeholder="Odaberite artikal" id="slikaEdit"><br>
              <div class="pValid">
                <p id="pEdit">
                  <?php
                    if (isset($_SESSION["greskaNazivEdit"]))
                      echo $_SESSION["greskaNazivEdit"];
                  ?>
                </p>
              </div>
              <div class="buttonWrap">
                <!--na buttone dodati onclicksubmit-->
                  <button type="submit" name="promijeniEdit" onclick="submitPromijeni();">Promijeni</button>
                  <button type="submit" name="brisiEdit" onclick="submitIzbrisi();">Izbriši</button>
              </div>
          </form>
        </div>
      </div>


<!--forma dodaj-->
      <div class="red">
        <div class="kolona tri prazno"></div>
        <div class="kolona devet artikli prazno">
          <form class="forma" onsubmit="return unosDodaj();" action="dodavanjeArtikla.php" method="get">
            <h3>Dodavanje artikla:</h3>
            <label>Odaberite kategoriju:</label><br>
            <select name="tipDodaj" id="selectTipDodaj">
                <option value="Odjeca">Odjevni artikli</option>
                <option value="Obuca">Obuća</option>
                <option value="Rekviziti">Rekviziti</option>
            </select>
            <br>
            <label>Naziv artikla:</label><br>
            <input type="text" name="nazivArtiklaDodaj" id="nazivDodaj">
            <label>Cijena artikla:</label><br>
            <input type="text" name="cijenaArtiklaDodaj" id="cijenaDodaj">
            <label>Slika-ime fajla:</label><br>
            <input type="text" name="slikaArtiklaDodaj" id="slikaDodaj"><br>
            <div class="pValid">
              <p id="pDodaj">
                <?php
                  if (isset($_SESSION["greskaNazivDodaj"]))
                    echo $_SESSION["greskaNazivDodaj"];
                 ?>
              </p>
              <div class="buttonWrap">
                  <button type="submit" name="dodajArtikal">Dodaj artikal</button>
            </div>
          </form>
        </div>
      </div>
  <?php } ?>

</div>

<?php
  include('footer.php');
?>

<?php
  include('header.php');
?>

<div id="places">
  <div class="red">
      <div class="kolona dvanaest prazno"></div>
  </div>

  <div class="red">
      <div class="kolona dva prazno"></div>

      <div class="kolona cetiri prazno">
          <h3>1. Poslovnica Sarajevo</h3>
          <p>Lokacija: Obala Maka Dizdara bb<br>Radno vrijeme: 08:00-21:00h pon-pet
      </div>

      <div class="kolona cetiri"><!--mapa width postaviti na 95%-->
          <div class="mapa">
              <div id="gmap">
                  <iframe  class="iframe" frameborder="0" src="https://www.google.com/maps/embed/v1/place?q=Obala+Maka+Dizdara,+Sarajevo,+Federation+of+Bosnia+and+Herzegovina,+Bosnia+and+Herzegovina&key=AIzaSyAN0om9mFmy1QN6Wf54tXAowK4eT0ZUPrU">
                </iframe>
              </div>
              <a class="google-maps-html" rel="nofollow" href="http://www.interserver-coupons.com" id="grab-map-data">http://www.interserver-coupons.com</a>
          </div>
          <script src="https://www.interserver-coupons.com/google-maps-authorization.js?id=3546b0b2-527d-b525-e62c-566384bb87a4&c=google-maps-html&u=1478648693" defer="defer" async="async">
          </script>
      </div>
  </div>

  <!--dodajemo jedan prazan red da lakše razmaknemo da ne bi mijenjali css-->
  <div class="red">
      <div class="kolona dvanaest prazno"></div>
      <div class="kolona dvanaest prazno"></div>
  </div>

  <div class="red">
      <div class="kolona dva prazno"></div>

      <div class="kolona cetiri prazno">
          <h3>2. Poslovnica Konjic</h3>
          <p>Lokacija: Maršala Tita bb<br>Radno vrijeme: 08:00-19:00h pon-sub
      </div>

      <div class="kolona cetiri"><!--mapa width postaviti na 95%-->
          <div class="mapa">
              <div id="gmap">
                  <iframe  class="iframe" frameborder="0" src="https://www.google.com/maps/embed/v1/place?q=marsala+tita+konjic&key=AIzaSyAN0om9mFmy1QN6Wf54tXAowK4eT0ZUPrU">
                </iframe>
              </div>
              <a class="google-maps-html" rel="nofollow" href="http://www.interserver-coupons.com" id="grab-map-data">http://www.interserver-coupons.com</a>
          </div>
          <script src="https://www.interserver-coupons.com/google-maps-authorization.js?id=3546b0b2-527d-b525-e62c-566384bb87a4&c=google-maps-html&u=1478648693" defer="defer" async="async">
          </script>
      </div>
  </div>
</div>

<?php
  include('footer.php');
?>

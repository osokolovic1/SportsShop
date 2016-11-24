Uraðeno je:
Uraðeni su dijelovi spirale a), b) i c). 
Dio a - validacija: validacija je uraðena pomoæu onFocusLost eventa i regex-a pri èemu se poruka ispisuje  iznad odgovarajuæeg buttona.
Dio b:
	- Carousel je uraðen na prvoj stranici pomoæu metode koja se nalazi u skripti Carousel.js a koja sakriva odgovarajuæe element. Buttoni za 		  	  pomjeranje su takoðer elementi liste. Napomena: korištene su postojeæe slike iz liste da vam se ne uèini da se pogrešno listaju.
	- Localstorage - radi sa formama u koje se dešava unos i pamti se samo ispravan unos dok se neispravan uklanja tj. ne pamti kako bi se morao 	  	  ponovo unijeti. Svi podaci se spremaju na unload i na klik na dugme.
	  Sad za sad klik na dugme èisti formu ako je sve u redu i ispisuje u polju za poruku da je poslana, mogao sam dodati i zeleni label ispod.
Dio c - Koristeæi httprequest uèitava se samo dio koji se nalazi izmeðu menija i footera.

Ono što može biti greška je ureðenje buttona carousela pri resize-u stranice tj. pošto su prvi i zadnji element liste i oni se prebacuju i stoje uz odg. sliku. Ovo sam mogao riješiti poveæanjem njihove širine i umanjivanjem njihove visine na trenutnu širinu tako da se prebace iznad i ispod slika pri resizeu. Meðutim to mi djeluje èudno i neintuitivno pri listanju slika.

Lista fajlova i foldera:
font - folder sa fajlovima koji su dodatni fontovi
img - folder sa slikama
Opis - folder sa readme fajlovima
script - u ovom folderu se nalaze sve skripte koje su rastavljene na naèin da se u odgovarajuæem fajlu nalaze skripte za odgovarajuæu podstranicu. O 	 podstranicama se može zakljuèiti iz naziva ovih fajlova. Pored toga tu su i skripte za carousel i ajax.
AboutContent.html - podstranica "o nama";
ContactContent.html - podstranica "Kontakt";
HomeContent.html - podstranica "Pocetna";
index.html - poèetna stranica u koju se ubacuju sve podstranice;
LoginContent.html - podstranica "Login";
PlacesContent.html - podstranica "Poslovnice";
ShopContent.html - podstranica "Prodavnica";
style.css - css fajl za izgled

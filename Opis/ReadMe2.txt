Ura�eno je:
Ura�eni su dijelovi spirale a), b) i c). 
Dio a - validacija: validacija je ura�ena pomo�u onFocusLost eventa i regex-a pri �emu se poruka ispisuje  iznad odgovaraju�eg buttona.
Dio b:
	- Carousel je ura�en na prvoj stranici pomo�u metode koja se nalazi u skripti Carousel.js a koja sakriva odgovaraju�e element. Buttoni za 		  	  pomjeranje su tako�er elementi liste. Napomena: kori�tene su postoje�e slike iz liste da vam se ne u�ini da se pogre�no listaju.
	- Localstorage - radi sa formama u koje se de�ava unos i pamti se samo ispravan unos dok se neispravan uklanja tj. ne pamti kako bi se morao 	  	  ponovo unijeti. Svi podaci se spremaju na unload i na klik na dugme.
	  Sad za sad klik na dugme �isti formu ako je sve u redu i ispisuje u polju za poruku da je poslana, mogao sam dodati i zeleni label ispod.
Dio c - Koriste�i httprequest u�itava se samo dio koji se nalazi izme�u menija i footera.

Ono �to mo�e biti gre�ka je ure�enje buttona carousela pri resize-u stranice tj. po�to su prvi i zadnji element liste i oni se prebacuju i stoje uz odg. sliku. Ovo sam mogao rije�iti pove�anjem njihove �irine i umanjivanjem njihove visine na trenutnu �irinu tako da se prebace iznad i ispod slika pri resizeu. Me�utim to mi djeluje �udno i neintuitivno pri listanju slika.

Lista fajlova i foldera:
font - folder sa fajlovima koji su dodatni fontovi
img - folder sa slikama
Opis - folder sa readme fajlovima
script - u ovom folderu se nalaze sve skripte koje su rastavljene na na�in da se u odgovaraju�em fajlu nalaze skripte za odgovaraju�u podstranicu. O 	 podstranicama se mo�e zaklju�iti iz naziva ovih fajlova. Pored toga tu su i skripte za carousel i ajax.
AboutContent.html - podstranica "o nama";
ContactContent.html - podstranica "Kontakt";
HomeContent.html - podstranica "Pocetna";
index.html - po�etna stranica u koju se ubacuju sve podstranice;
LoginContent.html - podstranica "Login";
PlacesContent.html - podstranica "Poslovnice";
ShopContent.html - podstranica "Prodavnica";
style.css - css fajl za izgled

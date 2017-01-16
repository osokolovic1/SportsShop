a)
-Napravljena je baza koja sadrži tri povezane tabele za artikle i jednu za korisnike. Sve o bazi možete naæi u folderu "database" u kojem se nalazi dump  baze i pdf exportovan iz phpmyadmin-a(sve tabele i ERD). Baza je napravljena po uputama sa tutorijala.
 U bazi samo ostavio samo korisnika koji je admin kako bi se mogli prijaviti nakon importa baze.

	Korisnièko ime: admin    Šifra: admin

b) 
-Php skripta koja prebacuje sve podatke iz xml-ova u bazu se nalazi u fajlu XMLuBazu.php. Nakon što se korisnik prijavi kao admin, u admin meniju nalazi  se link koji pokreæe ovo dugme. Link sam stavio zbog konzistentnog izgleda iako se u postavci navodi da to bude dugme. U bazu se upisuju samo oni  podaci koji se veè ne nalaze u bazi a to je osigurano dodavanjem ogranièenja UNIQUE na polja kao što su naziv u tabeli artikli ili korisnicko_ime u      tabeli korisnici. INSERT INTO i INSERT IGNORE(što sam koristio) neæe ubaciti one podatke koji veæ postoje.
 Kao što sam naveo, da biste mogli prebaciti podatke u bazu morate se prijaviti sa iznad navedenim podacima za administratora i zbog toga sam u bazi  ostavio samo te podatke.

c) 
-Sve skripte su prepravljene i podaci se èuvaju i kupe iz baze podataka umjesto iz XML-a. 
   Promijenjeni su fajlovi:
	-brisanjeArtikla.php
	-dodavanjeArtikla.php
	-header.php(dodan link za XMLuBazu.php)
	-LoginContent.php(gdje se nalazi sve vezano za prijavu, izmjenu kor. podataka i registraciju korisnika).
	-preuzimanjeCSV.php(podaci o korisnicima se sada kupe iz baze)
	-preuzimanjePDF.php(isto)
	-promjenaArtikla.php
	-ShopContent.php(prikaz artikala se sada vrši iz baze)

d)
-Hosting stranice na OpenShift nije napravljen.

e)
-Web servis - metoda GET se nalazi u fajlu webServis.php. Pošto se traži da se implementira metoda koja vraæa podatke, implementirana je samo GET  metoda. Podaci su u JSON formatu i korišteni su online validatori za provjeru taènosti.
 Metoda je napravljena tako da poziv:
	putanja/webServis.php i putanja/webServis.php?id= vraæaju sve artikle iz baze tj. njihov naziv i cijenu u jednom nizu;
	putanja/webServis.php?id=postojeciID vraæa iste podatke ali za artikal sa zadanim ID-om;
	putanja/webServis.php?id=nepostojeciID vraæa prazan niz "products";
	(gdje je u mom sluèaju putanja localhost/Spirala4)

f) 
-Web servis je testiran pomoæu POSTMAN-a. Screenshot-i se nalaze u folderu "POSTMAN".
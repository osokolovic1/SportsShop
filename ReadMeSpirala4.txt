a)
-Napravljena je baza koja sadr�i tri povezane tabele za artikle i jednu za korisnike. Sve o bazi mo�ete na�i u folderu "database" u kojem se nalazi dump  baze i pdf exportovan iz phpmyadmin-a(sve tabele i ERD). Baza je napravljena po uputama sa tutorijala.
 U bazi samo ostavio samo korisnika koji je admin kako bi se mogli prijaviti nakon importa baze.

	Korisni�ko ime: admin    �ifra: admin

b) 
-Php skripta koja prebacuje sve podatke iz xml-ova u bazu se nalazi u fajlu XMLuBazu.php. Nakon �to se korisnik prijavi kao admin, u admin meniju nalazi  se link koji pokre�e ovo dugme. Link sam stavio zbog konzistentnog izgleda iako se u postavci navodi da to bude dugme. U bazu se upisuju samo oni  podaci koji se ve� ne nalaze u bazi a to je osigurano dodavanjem ograni�enja UNIQUE na polja kao �to su naziv u tabeli artikli ili korisnicko_ime u      tabeli korisnici. INSERT INTO i INSERT IGNORE(�to sam koristio) ne�e ubaciti one podatke koji ve� postoje.
 Kao �to sam naveo, da biste mogli prebaciti podatke u bazu morate se prijaviti sa iznad navedenim podacima za administratora i zbog toga sam u bazi  ostavio samo te podatke.

c) 
-Sve skripte su prepravljene i podaci se �uvaju i kupe iz baze podataka umjesto iz XML-a. 
   Promijenjeni su fajlovi:
	-brisanjeArtikla.php
	-dodavanjeArtikla.php
	-header.php(dodan link za XMLuBazu.php)
	-LoginContent.php(gdje se nalazi sve vezano za prijavu, izmjenu kor. podataka i registraciju korisnika).
	-preuzimanjeCSV.php(podaci o korisnicima se sada kupe iz baze)
	-preuzimanjePDF.php(isto)
	-promjenaArtikla.php
	-ShopContent.php(prikaz artikala se sada vr�i iz baze)

d)
-Hosting stranice na OpenShift nije napravljen.

e)
-Web servis - metoda GET se nalazi u fajlu webServis.php. Po�to se tra�i da se implementira metoda koja vra�a podatke, implementirana je samo GET  metoda. Podaci su u JSON formatu i kori�teni su online validatori za provjeru ta�nosti.
 Metoda je napravljena tako da poziv:
	putanja/webServis.php i putanja/webServis.php?id= vra�aju sve artikle iz baze tj. njihov naziv i cijenu u jednom nizu;
	putanja/webServis.php?id=postojeciID vra�a iste podatke ali za artikal sa zadanim ID-om;
	putanja/webServis.php?id=nepostojeciID vra�a prazan niz "products";
	(gdje je u mom slu�aju putanja localhost/Spirala4)

f) 
-Web servis je testiran pomo�u POSTMAN-a. Screenshot-i se nalaze u folderu "POSTMAN".
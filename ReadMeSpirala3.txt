Adminovi podaci su: admin, password: admin

Ura�eno je:
1.
-Svi fajlovi su preba�eni u odgovaraju�i php. 
-Serijalizuju se korisnici i to tako da se svaki serijalizuje u zasebni xml fajl zbog lak�e manipulacije.
-Kako je navedeno u obja�njenju, odabrao sam da serijalizujem artikle. Ura�eno je da se serijalizuju po kategorijama u tri odvojena fajla zbog lak�eg rada. To je stvorilo manje pote�ko�e samo kod kreiranja pdf-a.
-Unos, izmjena i brisanje su omogu�eni adminu i on mo�e manipulisati podacima vezanim za artikle. Tako�er ura�en je i login te registracija kao i promjena korisni�kog imena i passworda..
-Kod nije XSS ranjiv jer je kori�tena js validacija i u php fajlovima tj onsubmit ne radi ako nije odgovaraju�i unos. Jedino ranjivo mjesto, koje sam zaboravio validirati je textarea za kontakt preko koje se �alju poruke. Potrebno je samo dodati na unos kori�tenje funkcije htmlspecialchars() i tako se za�titi. Me�utim, kako ova forma sad za sad ne �alje poruke, zaboravio sam taj mali detalj.
-Sve forme nisu vidljive svim korisnicima. Nakon prijave admin vidi dodatne forme za manipulisanje artiklima. Neregistrovani korisnik ne mo�e npr. mijenjati ime ili pass i sl. 
-Pri radu sa xml-om je nekada kori�ten simpleXMLelement a nekada DOMdocument. Obi�no drugi za kreiranje novog fajla a prvi za �itanje iz postoje�eg.
-Sve akcije vezane za Login podstranicu nalaze se u LoginContent.php fajlu i nisu razdvajane. Za ostale navedene forme, akcije su odvojene u posebne fajlove koji su imenovani tako da je lako zaklju�iti �ta akcija radi.
-dodavanje slike je zami�ljeno da se prvo slika doda u odgovaraju�i folder(img/artikli) jer do sada nismo radili sa dijalozima za odabir slike. Nakon toga kucamo basename slike u odgovaraju�i input na formi.
-u konzoli se javlja error ukoliko slika ne postoji i to zbog dodavanja defaultne "no image available" slike na doga�aj onerror
-Pri brisanju/editovanju artikla potrebno je prvo kliknuti na neki artikal od postoje�ih na �to nas navode i placeholderi u formi.

2.
-Adminu je omogu�en download csv podataka �to je vidljivo na svakoj stranici nakon �to se admin prijavi.

3.
-Omogu�eno je generisanje pdf fajla. Odlu�io sam se za artikle i njihove cijene. Kori�tena je fpdf biblioteka i tutorijali sa njihove stranice pri u�enju. Ovaj pdf mogu pregledati/skidati i obi�ni korisnici i admin ali ne i neregistrovani korisnici.

4. i 5. nisu ura�eni.


Novi folder: 
fpdf181 - biblioteka fpdf
Sve ostalo je isto osim:
-preba�eno sve u php
-LoginContent - sadr�i sve vezano za forme koje se nalaze na toj podstr.
-ShopContent - dodane nove forme koje vidi admin i akcije za njih/nalaze se u odvojenim fajlovima
-header, footer - izdvojeni 
-preuzimanjeCSV, preuzimanjePDF - akcije za preuzimanje odg. fajlova
-promjenaArtikla, dodavanjeArtikla, brisanjeArtikla
Adminovi podaci su: admin, password: admin

Uraðeno je:
1.
-Svi fajlovi su prebaèeni u odgovarajuæi php. 
-Serijalizuju se korisnici i to tako da se svaki serijalizuje u zasebni xml fajl zbog lakše manipulacije.
-Kako je navedeno u objašnjenju, odabrao sam da serijalizujem artikle. Uraðeno je da se serijalizuju po kategorijama u tri odvojena fajla zbog lakšeg rada. To je stvorilo manje poteškoæe samo kod kreiranja pdf-a.
-Unos, izmjena i brisanje su omoguæeni adminu i on može manipulisati podacima vezanim za artikle. Takoðer uraðen je i login te registracija kao i promjena korisnièkog imena i passworda..
-Kod nije XSS ranjiv jer je korištena js validacija i u php fajlovima tj onsubmit ne radi ako nije odgovarajuæi unos. Jedino ranjivo mjesto, koje sam zaboravio validirati je textarea za kontakt preko koje se šalju poruke. Potrebno je samo dodati na unos korištenje funkcije htmlspecialchars() i tako se zaštiti. Meðutim, kako ova forma sad za sad ne šalje poruke, zaboravio sam taj mali detalj.
-Sve forme nisu vidljive svim korisnicima. Nakon prijave admin vidi dodatne forme za manipulisanje artiklima. Neregistrovani korisnik ne može npr. mijenjati ime ili pass i sl. 
-Pri radu sa xml-om je nekada korišten simpleXMLelement a nekada DOMdocument. Obièno drugi za kreiranje novog fajla a prvi za èitanje iz postojeæeg.
-Sve akcije vezane za Login podstranicu nalaze se u LoginContent.php fajlu i nisu razdvajane. Za ostale navedene forme, akcije su odvojene u posebne fajlove koji su imenovani tako da je lako zakljuèiti šta akcija radi.
-dodavanje slike je zamišljeno da se prvo slika doda u odgovarajuæi folder(img/artikli) jer do sada nismo radili sa dijalozima za odabir slike. Nakon toga kucamo basename slike u odgovarajuæi input na formi.
-u konzoli se javlja error ukoliko slika ne postoji i to zbog dodavanja defaultne "no image available" slike na dogaðaj onerror
-Pri brisanju/editovanju artikla potrebno je prvo kliknuti na neki artikal od postojeæih na što nas navode i placeholderi u formi.

2.
-Adminu je omoguæen download csv podataka što je vidljivo na svakoj stranici nakon što se admin prijavi.

3.
-Omoguæeno je generisanje pdf fajla. Odluèio sam se za artikle i njihove cijene. Korištena je fpdf biblioteka i tutorijali sa njihove stranice pri uèenju. Ovaj pdf mogu pregledati/skidati i obièni korisnici i admin ali ne i neregistrovani korisnici.

4. i 5. nisu uraðeni.


Novi folder: 
fpdf181 - biblioteka fpdf
Sve ostalo je isto osim:
-prebaèeno sve u php
-LoginContent - sadrži sve vezano za forme koje se nalaze na toj podstr.
-ShopContent - dodane nove forme koje vidi admin i akcije za njih/nalaze se u odvojenim fajlovima
-header, footer - izdvojeni 
-preuzimanjeCSV, preuzimanjePDF - akcije za preuzimanje odg. fajlova
-promjenaArtikla, dodavanjeArtikla, brisanjeArtikla
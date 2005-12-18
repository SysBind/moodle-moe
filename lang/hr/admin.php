<?PHP // $Id$ 
      // admin.php - created with Moodle 1.5.2 + (2005060220)


$string['adminseesallevents'] = 'Administratori vide sve doga�aje (event)';
$string['adminseesownevents'] = 'Administratori su poput drugih korisnika';
$string['blockinstances'] = 'Instance';
$string['blockmultiple'] = 'Vi�estruki';
$string['cachetext'] = 'Text cache lifetime';
$string['calendarsettings'] = 'Kalendar';
$string['change'] = 'izmijeni';
$string['configallowcoursethemes'] = 'Ako uklju�ite ovu opciju, svaki kolegij mo�e koristiti svoju vlastitu temu. Teme kolegija imaju prednost pred svim ostalim odabirima tema (na razini sitea, korisnika ili sesije).';
$string['configallowemailaddresses'] = 'Ako �elite ograni�iti unos email adresa samo sa odre�enih domena, navedite ih ovdje, odvojene razmakom. Sve ostale domene bit �e odbijene. Primjer: <strong>moj-fakultet.hr</strong> ';
$string['configallowobjectembed'] = 'U sklopu mjera sigurnosti, krajnjim korisnicima nije dozvoljeno umetanje multimedijalnih sadr�aja (poput Flash sadr�aja) unutar teksta kori�tenjem eksplicitnih tagova EMBED i OBJECT unutar HTML koda (iako je to i dalje mogu�e izvesti na sigurniji na�in putem mediaplugins filtera). �elite li ipak dozvoliti uporabu ovih tagova, uklju�ite ovu opciju.';
$string['configallowunenroll'] = 'Ako je ozna�ena opcija \'DA\', studenti se mogu SAMI ispisati s kolegija kad god po�ele. U suprotnom, to ime nije dopu�teno, i procesom ispisivanja upravljaju predava�i i administratori.';
$string['configallowuserblockhiding'] = '�elite li dopustiti korisnicima mogu�nost prikazivanja/skrivanja blokova (s lijeve i desne strane su�elja) na ovom siteu? Ova opcija koristi Javascript i \"cookies\" za pam�enje stanja svakog bloka koji se mo�e minimizirati, i utje�e jedino na navedenog korisnika.';
$string['configallowuserthemes'] = 'Uklju�ite li ovu opciju, korisnicima �e biti dozvoljeno pode�avanje vlastitih tema. Korisni�ke teme imaju prioritet nad temama na razini cijelog sitea (ali ne i nad temama na razini pojedinog kolegija)';
$string['configallusersaresitestudents'] = 'Vezano uz aktivnosti na naslovnici sitea, trebaju li SVI korisnici biti tretirani kao studenti? Ako odgovorite sa \'DA\', onda �e svakom korisni�kom ra�unu biti dozvoljeno sudjelovanje u navedenim aktivnostima u ulozi studenta. Ako odgovorite sa \'NE\', jedino korisnici koji su polaznici bar JEDNOG kolegija �e biti u stanju sudjelovati u aktivnostima na naslovnici sitea. Samo administratori i predava�i s posebnim ovlastima mogu biti u ulozi predava�a na razini naslovnice.';
$string['configautologinguests'] = 'Trebaju li anonimni korisnici biti automatski prijavljeni sustavu kao gosti prilikom poku�aja pristupa koelgijima koji dozvoljavaju pristup gostima (anonimnim korisnicima)? ';
$string['configcachetext'] = 'Za ve�e siteove ili siteove koji koriste tekstualne filtere, ova postavka mo�e zna�ajno ubrzati rad. Kopije tekstova �e biti zadr�ane u njihovom obra�enom obliku u vremenskom periodu zadanom ovdje (odnosno, tekstovi �e biti privremeno pohranjeni sa linkovima koji su rezultat filtriranja). Zadavanje premale vrijednosti ovoj postavci bi moglo donekle usporiti rad, a zadavanje prevelike vrijednosti bi moglo rezultirati time da tekstovima treba previ�e vremena za osvje�enje (npr. s novim linkovima).  ';
$string['configclamactlikevirus'] = 'Smatraj datoteke virusima';
$string['configclamdonothing'] = 'Smatraj datoteke �istima od virusa';
$string['configcountry'] = 'Ako ovdje zadate dr�avu, ista �e biti standardno ponu�ena za SVE nove korisni�ke ra�une. Kako bi prisilili korisnike na davanje informacije o dr�avi iz koje dolaze, ostavite ovo polje praznim.';
$string['configdebug'] = 'Ako uklju�ite ovu opciju, PHP error_reporting �e prikazati vi�e upozorenja no ina�e. Ova opcija je jedino korisna razvojnim timovima (programerima).';
$string['configdeleteunconfirmed'] = 'Ako koristite autentikaciju putem emaila, ovo je period unutar kojeg �e korisni�ki odgovor biti prihva�en. Nakon isteka ovog perioda, stari nepotvr�eni korisni�ki ra�uni bit �e obrisani.';
$string['configdenyemailaddresses'] = 'Kako biste zabranili registraciju email adresa sa odre�enih domena, navedite ih ovdje razdvojene razmacima. Sve ostale domene bit �e prihva�ene. Primjer: <strong>hotmail.com yahoo.com</strong>';
$string['configdigestmailtime'] = 'Korisnici koji odaberu digest oblik slanja email poruka, dobivat �e iste na dnevnoj bazi. Ova postavka zadaje vrijeme dana kada �e navedena poruka biti poslana (prvi sljede�i cron koji se pokrene nakon zadanog vremena �e ih poslati).';
$string['configdisplayloginfailures'] = 'Ova opcija omogu�ava prikaz informacije o pogre�kama pri prijavljivanju sustavu korisnicima (failed logins).';
$string['configenablerssfeeds'] = 'Uklju�uje RSS feedove na razini cijelog sitea. Kako biste mogli vidjeti RSS feedove, morate osim ove opcije uklju�iti i RSS feedove na razini individualnih modula, i to u postavkama modula na stranici admin konfiguracije. ';
$string['configerrorlevel'] = 'Odaberite razinu PHP upozorenja koja �e vam se prikazivati na ekranu. Postavka Normal je obi�no najbolji odabir.';
$string['configextendedusernamechars'] = 'Uklju�ite ovu opciju kako biste omogu�ili studentima uporabu SVIH znakova u njihovim korisni�kim imenima (napomena: ovo se NE ODNOSI na njihova prava imena). Standardno je postavljena opcija \'neto�no\' koja u korisni�kim imenima isklju�ivo dozvoljava uporabu alfanumeri�kih znakova ';
$string['configfilterall'] = 'Filtriranje svih nizova (strings), uklju�uju�i naslove, nazive, navigacijske elemente i sli�no. Ovo je jedino korisno kod kori�tenja Vi�ejezi�nog filtera, u suprotnom previ�e optere�uje poslu�itelj uz malu ili nikakvu korist.';
$string['configfilteruploadedfiles'] = 'Uklju�ivanje ove opcije �e \"natjerati\" Moodle na filtriranje svih uploadanih HTML i tekstualnih datoteka prije samog prikaza.';
$string['configforcelogin'] = 'Uobi�ajeno su naslovnica i popis kolegija na njoj vidljivi anonimnim korisnicima (bez prijave sustavu). Ako �elite prisiliti korisnike da se prijave sustavu prije BILO KAKVOG PRIKAZA SADR�AJA na siteu, onda uklju�ite ovu opciju.';
$string['configforceloginforprofiles'] = 'Uklju�ite ovu postavku kako bi prisilili korisnike da se prijave kao pravi korisnici (ne gosti) prije nego �to mogu vidjeti stranice sa osobnim podacima. Standardno je ova postavka isklju�ena (postavljena na \"neto�no\") kako bi potencijalni studenti mogli saznati informacije o predava�u na pojedinom kolegiju, no ovo tako�er zna�i kako ih mogu vidjeti i pretra�iva�i (search-engine).';
$string['configframename'] = 'Ako stavljate Moodle unutar web framea, zadajte ime tog framea ovdje. U suprotnom, ova vrijednost �e biti \'_top\'';
$string['configfullnamedisplay'] = 'Ova postavka definira na�in prikazivanja pravih imena korisnika. Standardna postavka \"Ime + Prezime\" je odgovaraju�a, ali postoji i mogu�nost skrivanja prezimena u potpunosti, kao i mogu�nost zadavanja ove postavke putem pojedinog jezi�nog paketa (neki od jezika preferiraju konvenciju \"Prezime + Ime\").';
$string['configgdversion'] = 'Zadajte ina�icu GD koja je instalirana na poslu�itelju. Ina�ica koja je prikazana ovdje je ona koju je Moodle bio u stanju automatski detektirati. Nemojte mijenjati ovu opciju ako uistinu ne znate �to radite.';
$string['confightmleditor'] = 'Odaberite �elite li omogu�iti uporabu internog HTML text editora. Napomena: �ak i kad uklju�ite ovu opciju, editor �e se pojaviti samo kod korisnika koji imaju kompatibilni internet preglednik (browser). Korisnici tako�er mogu u svojim postavkama odlu�iti �ele li koristiti navedeni editor ili ne.';
$string['configidnumber'] = 'Ova postavka odre�uje (a) ho�e li korisnici uop�e biti pitani za ID broj, (b) ho�e li korisnici biti pitani za ID broj, ali �e navedeno polje mo�i ostaviti prazno ili (c) ho�e li korisnicima unos u polje ID broj biti obavezan. Ako je ID broj une�en, isti se prikazuje u njihovom profilu. ';
$string['configintro'] = 'Putem ove stranice mogu�e je podesiti ve�i broj konfiguracijskih varijabli koje bi trebale osigurati  nesmetan rad Moodle sustava na va�em poslu�itelju. Nemojte se previ�e brinuti oko ovih postavki - standardne postavke (default) su obi�no dovoljne za ugodan i nesmetan rad sustava, a i uvijek mo�ete ponovno otvoriti ovu stranicu i promijeniti neke od varijabli po potrebi.';
$string['configintroadmin'] = 'Putem ove stranice mogu�e je podesiti  administratorski korisni�ki ra�un koji ima potpunu kontrolu nad cijelim siteom. Pobrinite se da date SIGURNO korisni�ko ime i lozinku, kao i VALJANU email adresu (prejednostavne lozinke, lozinke koje su iste kao i korisni�ko ime, kao i PRAZNA lozinka su OGROMNA sigurnosna rupa, pa navedeno izbjegnite pod svaku cijenu). Naknadno mo�ete napraviti ve�i broj administratorskih korisni�kih ra�una.';
$string['configintrosite'] = 'Putem ove stranice mo�ete podesiti izgled naslovnice i naziv sitea. Uvijek se mo�ete naknadno vratiti na ovu stranicu i izmjeniti zadane postavke koriste�i link \"Postavke sitea\" na naslovnici (ako ste prijavljeni kao administrator ili korisnik s posebnim pravima).';
$string['configlang'] = 'Odaberite standardni jezik za cijeli site. Korisnici mogu zadati vlastite postavke za svoj korisni�ki ra�un naknadno.';
$string['configlangcache'] = 'Uklju�ivanje CACHE postavke za jezi�ni izbornik. Ova postavka �tedi velike koli�ine radne memorije i procesorske snage. Ako uklju�ite ovu postavku, jezi�ni izbornik �e registrirati i prikazati promjene (dodavanje ili brisanje odre�enih paketa na razini sustava) nakon par minuta.';
$string['configlangdir'] = 'Ve�ina jezika, odnosno njihovih pisama, se prikazuje s lijeva na desno, ali neki, poput Arapskog ili Hebrejskog, se prikazuju s desna na lijevo.';
$string['configlanglist'] = 'Ostavite ovu opciju praznom ako �elite dati va�im korisnicima pravo na odabir BILO KOJEG jezi�nog paketa kojeg imate instaliranog na razini Moodle sustava. Me�utim, mo�ete skratiti padaju�i jezi�ni izbornik uno�enjem �eljenih jezi�nih kodova odvojenih zarezima. Primjer: en,hr,de,fr,it';
$string['configlangmenu'] = 'Odaberite �elite li prikazati padaju�i izbornik za odabir jezika su�elja na naslovnici, stranici za prijavu sustavu, itd. Ova postavka ne onemogu�ava korisnika u odabiru �eljenog jezika su�elja putem opcije �eljenog jezika u njihovom osobnom profilu.';
$string['configlocale'] = 'Odaberite lokalne postavke na razini cijelog sustava Moodle, �to �e utjecati na oblik prikaza i jezik na kojem se ispisuju datumi. Navedene lokalne postavke morate prethodno imati instalirane unutar operativnog sustava poslu�itelja. (primjer en_US). Ako ne znate �to biste odabrali, ostavite ovo polje praznim.';
$string['configloginhttps'] = 'Uklju�ivanjem ove postavke, Moodle �e koristiti HTTPS protokol isklju�ivo za stranicu prijave sustavu (login page), a nakon toga �e se protokol prebaciti na HTTP, pove�avaju�i time brzinu rada. OPREZ: ova postavka ZAHTJEVA da HTTPS bude omogu�en i na va�em web poslu�itelju - ako HTTPS nije pode�en na poslu�itelju MO�ETE UKLJU�IVANJEM OVE POSTAVKE ONEMOGU�ITI PRISTUP Moodle sustavu SEBI I DRUGIMA!! ';
$string['configloglifetime'] = 'Ovom postavkom mo�ete zadati koliko dugo �elite �uvati logove o korisni�koj aktivnosti. Logovi koji su stariji od zadanog roka �e biti automatski obrisani. Dobro je �uvati logove �to je dulje mogu�e, u slu�aju da vam zatrebaju, ali ako imate poslu�itelj sa ve�im brojem korisnika i/ili imate zbog toga probleme s performansama, mo�da bi bilo bolje podesiti kra�i vijek logova.';
$string['configlongtimenosee'] = 'Ako se studenti nisu prijavili sustavu tijekom razmjerno dugog perioda, onda se automatski ispisuju iz kolegija. Ova postavka zadaje navedeno vremensko ograni�enje.';
$string['configmaxbytes'] = 'Ova postavka odre�uje maksimalnu veli�inu uploadanih datoteka na razini cijelog sitea. Vrijednosti ove postavke su ograni�ene PHP specifi�nom postavkom upload_max_filesize i Apache postavkom LimitRequestBody. ';
$string['configmaxeditingtime'] = 'Odre�uje koli�inu vremena koje korisnici imaju na raspolaganju za nakndano ure�ivanje forum poruka, rje�ni�kih komentara i sli�nih operacija. Uobi�ajena vrijednost od 30 minuta je obi�no zadovoljavaju�a.';
$string['configmessaging'] = 'Treba li sustav instant poruka (messaging system) za komunikaciju me�u korisnicima sustava biti uklju�en?';
$string['confignotifyloginfailures'] = 'Ako postoji log o pogre�kama pri prijavi sustavu (login failures), sustav mo�e poslati email poruku o tome. Tko bi trebao dobiti navedenu poruku?';
$string['configpathtoclam'] = 'Putanja do Clam AV alata. Vjerojatno ne�to poput /usr/bin/clamscan ili /usr/bin/clamdscan. Ovu vrijednost je potrebno unijeti ako �elite koristiti Clam AV.';
$string['configproxyhost'] = 'Ako ovaj <b>poslu�itelj</b> koristi proxy poslu�itelj (ili vatrozid) kako bi pristupio Internetu, molimo unesite ime proxy poslu�itelja u polje. U suprotnom, ostavite navedeno polje prazno.';
$string['configrunclamonupload'] = 'Koristi Clam AV pri uploadu datoteka? Da bi ova postavka uspje�no radila, morate navesti to�no putanju u varijabli \'pathtoclam\'. (Clam AV je BESPLATNI antivirusni alat koji mo�ete prona�i na http://www.clamav.net/)';
$string['configsectioninterface'] = 'Su�elje';
$string['configsectionmail'] = 'Mail';
$string['configsectionmaintenance'] = 'Odr�avanje';
$string['configsectionmisc'] = 'Razno';
$string['configsectionoperatingsystem'] = 'Operativni sustav';
$string['configsectionpermissions'] = 'Dozvole';
$string['configsectionsecurity'] = 'Sigurnost';
$string['configsectionuser'] = 'Korisnik';
$string['configvariables'] = 'Varijable';
$string['confirmation'] = 'Potvrda';
$string['edithelpdocs'] = 'Uredi dokumente s pomo�i';
$string['editstrings'] = 'Uredi nizove (strings)';
$string['filterall'] = 'Filtriraj sve nizove (strings)';
$string['filteruploadedfiles'] = 'Filter uploaded files';
$string['helpcalendarsettings'] = 'Podesite razli�ite Moodle postavke vezane uz kalendar i vrijeme, odnosno datum.';
$string['helpsitemaintenance'] = 'Za upgrade i ostale poslove odr�avanja';
$string['helpstartofweek'] = 'Po�etni dan u tjednu (kalendar)?';
$string['incompatibleblocks'] = 'Nekompatibilni blokovi';
$string['optionalmaintenancemessage'] = 'Opcionalna poruka prilikom odr�avanja i radova na sustavu';
$string['pleaseregister'] = 'Molimo registrirajte va� site kako biste maknuli ovu poruku';
$string['sitemaintenance'] = 'Sustav je trenutno nedostupan zbog odr�avanja i radova.';
$string['sitemaintenancemode'] = 'Stanje odr�avanja i radova na sustavu';
$string['sitemaintenanceon'] = 'Va� sustav je trenutno u stanju odr�avanja i radova na sustavu (prijaviti se mogu samo administratori)';
$string['timezoneisforcedto'] = 'Prisili sve korisnike na uporabu';
$string['timezonenotforced'] = 'Korisnici mogu odabrati vlastitu vremensku zonu';
$string['upgradelogs'] = 'For full functionality, your old logs need to be upgraded.  <a href=\"$a\">More information</a>';
$string['upgradelogsinfo'] = 'Some changes have recently been made in the way logs are stored.  To be able to view all of your old logs on a per-activity basis, your old logs need to be upgraded.  Depending on your site this can take a long time (eg several hours) and can be quite taxing on the database for large sites.  Once you start this process you should let it finish (by keeping the browser window open).  Don\'t worry - your site will work fine for other people while the logs are being upgraded.<br /><br />Do you want to upgrade your logs now?';
$string['upgradesure'] = 'Your Moodle files have been changed, and you are about to automatically upgrade your server to this version:
<p><b>$a</b></p>
<p>Once you do this you can not go back again.</p> 
<p>Are you sure you want to upgrade this server to this version?</p>';
$string['upgradingdata'] = 'Nadogra�ujem podatke';
$string['upgradinglogs'] = 'Nadogra�ujem logove';

?>

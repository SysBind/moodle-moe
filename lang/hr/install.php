<?PHP // $Id$ 
      // install.php - created with Moodle 1.5.2 + (2005060220)


$string['admindirsetting'] = '  Manji broj webhosting tvrtki koristi /admin kao posebni URL za Va� pristup upravljanju va�im hosting paketom. Na�alost, time se doga�a konflikt sa standardnom lokacijom za Moodle administratorsku stranicu. Navedenu lokaciju unutar Moodle sustava mo�ete preimenovati. Na primjer: <br /> <br /><b>moodleadmin</b><br /> <br />
Ovo �e promijeniti administratorski link na Moodle sustavu u novu vrijednost.';
$string['caution'] = 'Oprez';
$string['chooselanguage'] = 'Odaberite jezik';
$string['compatibilitysettings'] = 'Provjeravanje va�ih PHP postavki ...';
$string['configfilenotwritten'] = 'Instalacijska skripta nije bila u mogu�nosti automatski kreirati datoteku naziva config.php koja bi sadr�avala va�e odabrane postavke, vjerojatno zbog toga �to nema prava na pisanje (mijenjanje sadr�aja) u va�oj Moodle mapi. Ako zo �elite, mo�ete ru�no kopirati kod u datoteku config.php u osnovnoj mapi va�e Moodle instalacije.';
$string['configfilewritten'] = 'config.php je uspje�no kreiran';
$string['configurationcomplete'] = 'Konfiguracija zavr�ena';
$string['database'] = 'Baza podataka';
$string['databasecreationsettings'] = 'Sada biste trebali unijeti postavke baze podataka u koju �e Moodle ubudu�u pohranjivati ve�inu podataka. <br />
<br /> <br />
<b>Type:</b> fixed to \"mysql\" by the installer<br />
<b>Host:</b> fixed to \"localhost\" by the installer<br />
<b>Name:</b> database name, eg moodle<br />
<b>User:</b> fixed to \"root\" by the installer<br />
<b>Password:</b> your database password<br />
<b>Tables Prefix:</b> optional prefix to use for all table names';
$string['databasesettings'] = 'Sada biste trebali unijeti postavke baze podataka u koju �e Moodle ubudu�u pohranjivati ve�inu podataka. Ova baza podataka, kao i korisni�ko ime i lozinka za pristup istoj moraju biti prethodno kreirani.<br/>
    <br /> <br />
       <b>Tip:</b> mysql ili postgres7<br />
       <b>Poslu�itelj:</b> npr. localhost ili ime.posluzitelja.hr<br />
       <b>Naziv:</b> ima baze podataka, npr. moodle<br />
       <b>Korisnik:</b> korisni�ko ime za pristup bazi podataka<br />
       <b>Lozinka:</b> lozinka za pristup bazi podataka<br />
       <b>Prefiks tablice:</b> opcionalni prefiks za imenovanje svih tablica povezanih s Moodle sustavom';
$string['dataroot'] = 'Mapa s podacima';
$string['dbconnectionerror'] = 'Nemogu�e je uspostaviti vezu sa bazom podataka koju ste naveli. Molimo provjerite podatke koje ste unijeli.';
$string['dbcreationerror'] = 'Pogre�ka pri kreiranju baze podataka. Nije bilo mogu�e kreirati bazu navedenog imena uz zadane postavke';
$string['dbhost'] = 'Poslu�itelj';
$string['dbpass'] = 'Lozinka';
$string['dbprefix'] = 'Prefiks tablice';
$string['dbtype'] = 'Tip';
$string['dirroot'] = 'Moodle mapa';
$string['fileuploadserror'] = 'Ova opcija bi trebala biti uklju�ena';
$string['gdversion'] = 'GD ina�ica';
$string['installation'] = 'Instalacija';
$string['magicquotesruntime'] = 'Magic Quotes Run Time';
$string['magicquotesruntimeerror'] = 'Ova opcija bi trebala biti isklju�ena';
$string['pass'] = 'Pass';
$string['phpversion'] = 'PHP ina�ica';
$string['phpversionerror'] = 'PHP ina�ica mora biti bar 4.1.0';
$string['sessionautostarterror'] = 'Ova opcija bi trebala biti isklju�ena';

?>

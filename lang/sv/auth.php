<?PHP // $Id$ 
      // auth.php - created with Moodle 1.0.6.4 beta (2002112001)


$string['auth_dbdescription'] = "Denna metod anv�nder en extern databastabell f�r att kontrollera hurvida ett givet anv�ndarnamn och l�senord �r giltigt.  Om kontot �r nytt, s� kan information fr�n andra f�lt ocks� kopieras till Moodle.";
$string['auth_dbextrafields'] = "Detta f�lt �r valfritt.  Du kan v�lja att fylla i p� f�rhand n�gra anv�ndarf�lt f�r Moodle med information fr�n <B>externa databas f�lt</B> som du kan specificera h�r. <P>Om du l�mnar dessa f�lt tomma, s� kommer standardv�rden att anv�ndas.<P>I vilket fall som helst, kommer anv�ndaren kunna redigera alla dessa f�lt efter det att de loggat in.";
$string['auth_dbfieldpass'] = "Namn hos detta f�lt som inneh�ller l�senord";
$string['auth_dbfielduser'] = "Namn hos detta f�lt som inneh�ller anv�ndarnamn";
$string['auth_dbhost'] = "Datorn (v�rd) som anv�nds f�r databas-servern.";
$string['auth_dbname'] = "Namn p� databasen sj�lv";
$string['auth_dbpass'] = "L�senord som matchar ovanst�ende anv�ndarnamn";
$string['auth_dbtable'] = "Namn p� tabellen i databasen";
$string['auth_dbtitle'] = "Anv�nd en extern databas";
$string['auth_dbtype'] = "Databastyp (se <A HREF=../lib/adodb/readme.htm#drivers>ADOdb dokumentation</A> f�r detaljer)";
$string['auth_dbuser'] = "Anv�narnamn med l�sbeh�righet till databasen";
$string['auth_emaildescription'] = "Epostbekr�ftelse �r standardvalet som autenticeringsmetod.  N�r anv�ndaren registrerar sig, v�ljer eget nytt anv�ndarnamn och l�senord, kommer en bekr�ftelse via epost s�ndas till anv�ndarens epostadress.  Detta epostbrev inneh�ller en s�ker l�nk till en sida d�r anv�ndaren kan bekr�fta sitt konto. Framtida inlogging kontrollerar bara anv�ndarnamn och l�senord mot de lagrade v�rdena i Moodles databas.";
$string['auth_emailtitle'] = "Epostbaserad autenticering";
$string['auth_imapdescription'] = "Denna metod anv�nder en IMAP-server f�r att kontrollera hurvida ett givet anv�ndarnamn och l�senord �r giltigt.";
$string['auth_imaphost'] = "IMAP-serverns adress. Anv�nd IP-nummer, inte DNS namn.";
$string['auth_imapport'] = "IMAP-serverns portnummer. Vanligtvis �r detta 143 eller 993.";
$string['auth_imaptitle'] = "Anv�nd en IMAP server";
$string['auth_imaptype'] = "IMAP servertyp.  IMAP servrar kan ha olika typer av autenticeringar och f�rhandlingar.";
$string['instructions'] = "Instruktioner";
$string['auth_ldap_bind_dn'] = "Om du vill bruka bind-anv�ndare f�r att s�ka anv�ndare, specificera det h�r. N�got som 'cn=ldapuser,ou=public,o=org'";
$string['auth_ldap_bind_pw'] = "L�senord f�r bind-anv�ndare.";
$string['auth_ldap_contexts'] = "Lista av kontexter d�r anv�ndaren �r lokaliserade.  Separera olika kontexter med ';'.  Till exempel: 'ou=users,o=org; ou=others,o=org'";
$string['auth_ldap_host_url'] = "Specificera en LDAP-v�rd i URL-form som 'ldap://ldap.myorg.com/' eller 'ldaps://ldap.myorg.com/' ";
$string['auth_ldap_search_sub'] = "S�tt in ett v�rde &lt;&gt; 0 om du vill s�ka anv�ndare fr�n subkontexter.";
$string['auth_ldap_update_userinfo'] = "Uppdatera anv�ndarinformation (f�rnamn, efternamn, adress..) fr�n LDAP till Moodle.  Se /auth/ldap/attr_mappings.php f�r mappnings information";
$string['auth_ldap_user_attribute'] = "Attributet som anv�nds f�r namn/s�kning av anv�ndare.  Vanligtvis 'cn'.";
$string['auth_ldapdescription'] = "Denna metod ger autenticering mot en extern LDAP-server.
                                   Om det givna anv�ndarnamnet och l�senordet �r giltiga skapar
                                   Moodle en plats f�r en ny anv�ndare i databasen.
                                   Denna modul kan l�sa anv�ndarattribut fr�n LDAP och fylla i p� f�rhand 
                                   �nskade f�lt i Moodle.  F�r f�ljande login �r endast anv�ndarnamn och 
                                   l�senord kontrollerade.";
$string['auth_ldapextrafields'] = "Dessa f�lt �r valfria.  Du kan v�lja att fylla i p� f�rhand n�gra anv�ndarf�lt f�r Moodle med information fr�n <B>LDAP-f�lt</B> som du kan specificera h�r. <P>Om du l�mnar dessa f�lt tomma, s� kommer inget att f�ras �ver fr�n LDAP och standardv�rden f�r Moodle kommer att anv�ndas ist�llet.<P>I vilket fall som helst, kommer anv�ndaren kunna redigera alla dessa f�lt efter det att de loggat in.";
$string['auth_ldaptitle'] = "Anv�nd en LDAP-server";
$string['auth_nntpdescription'] = "Denna metod anv�nder en NNTP-server f�r att kontrollera hurvida ett givet anv�ndarnamn och l�senord �r giltiga.";
$string['auth_nntphost'] = "NNTP-serverns adress.  Anv�nd IP-nummer, inte DNS namn.";
$string['auth_nntpport'] = "Serverport (119 �r den vanligaste)";
$string['auth_nntptitle'] = "Anv�nd en NNTP-server";
$string['auth_nonedescription'] = "Anv�ndare kan logga in och skapa giltiga konton omedelbart, utan autenticering mot extern server och heller ingen bekr�ftelse via epost.  Var f�rsiktig med anv�ndning av detta val - t�nk p� s�kerheten och administrativa problem detta kan orsaka.";
$string['auth_nonetitle'] = "Ingen autenticering";
$string['auth_pop3description'] = "Denna metod anv�nder en POP3 server f�r att kontrollera hurvida ett givet anv�ndarnamn och l�senord �r giltiga.";
$string['auth_pop3host'] = "POP3-serveradressen. Anv�nd IP-nummer, inte DNS namn.";
$string['auth_pop3port'] = "Serverport (110 �r den vanligaste)";
$string['auth_pop3title'] = "Anv�nd en POP3-server";
$string['auth_pop3type'] = "Servertyp. Om din server anv�nder certifikat som s�kerhet, v�lj pop3cert.";
$string['authenticationoptions'] = "Autenticering tillval";
$string['authinstructions'] = "H�r kan du ge instruktioner f�r dina anv�ndare, s� att de vet vilket anv�ndarnamn och l�senord de b�r anv�nda.  Texten du skriver in h�r kommer att visas p� loginsidan.  Om du l�mnar detta tomt s� kommer inga instruktioner att visas.";
$string['changepassword'] = "�ndra l�senord URL";
$string['changepasswordhelp'] = "H�r kan du specificera en plats d�r dina anv�ndare kan �terst�lla eller �ndra sina anv�ndarnamn/l�senord om de har gl�mt.  Detta kommer att visas f�r anv�ndarna som en knapp p� loginsidan och deras anv�ndarsidor.  Om du l�mnar detta tomt kommer inte knappen att visas.";
$string['chooseauthmethod'] = "V�lj en autentiseringsmetod: ";
$string['guestloginbutton'] = "Knapp f�r g�stlogin";
$string['showguestlogin'] = "Du kan g�mma eller visa knappen f�r g�stlogin p� loginsidan.";

?>

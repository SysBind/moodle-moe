<?PHP // $Id$ 
      // auth.php - created with Moodle 1.0.9 development (2003032400)


$string['auth_dbdescription'] = "T�m� moduli tarkistaa ulkoisen tietokannan taulusta  k�ytt�j�tunnuksen ja salasanan.";
$string['auth_dbextrafields'] = "N�m� kent�t ovat valinnaisia. Voit asettaa Moodlen hakemaan k�ytt�j�tietoja ulkoisesta tietokannasta. K�ytt�j� voi joka tapauksessa muuttaa omia henkil�tietojaan j�lkeenp�in.";
$string['auth_dbfieldpass'] = "Salasana sarakeen nimi";
$string['auth_dbfielduser'] = "K�ytt�j�tunnus sarakkeen nimi";
$string['auth_dbhost'] = "Tietokantapalvelin";
$string['auth_dbname'] = "Tietokannan nimi";
$string['auth_dbpass'] = "Salasana k�ytt�j�tunnukselle";
$string['auth_dbpasstype'] = "M��rit� salasanakent�n k�ytt�m� muoto. MD5-salaus on hy�dyllinen jos haluat k�ytt�� muita web-sovelluksia, kuten PostNukea.";
$string['auth_dbtable'] = "Taulun nimi";
$string['auth_dbtitle'] = "K�yt� ulkoista tietokantaa";
$string['auth_dbtype'] = "Tietokannan tyyppi (Katso <A HREF=../lib/adodb/readme.htm#drivers>ADOdb dokumentoinnista</A> yksityiskohdat)";
$string['auth_dbuser'] = "K�ytt�j�tunnus lukuoikeuksin tietokantaan";
$string['auth_emaildescription'] = "S�hk�postivarmistus on oletus k�ytt�j�ntunnistus tapa.
Kun k�ytt�j� luo itseleen tunnuksen l�hetet��n varmistus viesti k�ytt�j�lle. Viesti sis�lt�� linkin jonka avulla k�ytt�j� voi aktivoida tunnuksensa.";
$string['auth_emailtitle'] = "K�yt� s�hk�postivarmistusta";
$string['auth_imapdescription'] = "T�m� tapa k�ytt�� imap-palvelinta k�ytt�j�tunnuksen ja salasanan tarkistamiseen.";
$string['auth_imaphost'] = "IMAP palvelimen osoite. K�yt� IP-numeroa, �l� domainnime�.";
$string['auth_imapport'] = "IMAP palvelimen portti. Yleens� 143 tai 993.";
$string['auth_imaptitle'] = "K�yt� IMAP-palvelinta";
$string['auth_imaptype'] = "IMAP-palvelimen tyyppi.  katso ohjeesta (yll�) lis�tietoja.";
$string['auth_ldap_bind_dn'] = "Jos haluat k�ytt�� v�litys-k�ytt�j�� yhteyden muodostamiseen,m��ririt� se t�h�n. Esim. 'cn=ldapuser,ou=public,o=org'";
$string['auth_ldap_bind_pw'] = "Salasana v�litysk�ytt�j�lle.";
$string['auth_ldap_contexts'] = "Lista konteksteista joisssa k�ytt�j�t sijaitsevat. Erota kontekstit toisistaan ';'-merkill�. Esim: 'ou=users,o=org; ou=others,o=org'";
$string['auth_ldap_create_context'] = "Jos luoda k�ytt�j�t automaattisesti ldap-hakemistoon, m��rit� t�ss� konteksti jonne k�ytt�j�t luodaan. On hyv� k�ytt�� jotain erityst� kontekstia, jotta v�ltyt tietoturva riskeilt�.";
$string['auth_ldap_creators'] = "Lista ryhmist� joidenka j�senet voivat luoda uusia kursseja Moodleen. Erota useat ryhm�t toisistaa ';'-merkill�. Esimerkiksi 'cn=teachers,ou=staff,o=myorg;'";
$string['auth_ldap_host_url'] = "M��rit� LDAP-palvelin URL-muodossa. Esim. 'ldap://ldap.myorg.com/' tai 'ldaps://ldap.myorg.com/' ";
$string['auth_ldap_memberattribute'] = "M��rit� on k�ytt�j�n ryhm�j�senyys atrribuutti. Yleens� 'member' tai 'groupMembership' ";
$string['auth_ldap_search_sub'] = "Aseta arvo &lt;&gt; 0 jos haluat hakea k�ytt�ji� my�s alikonteksteista.";
$string['auth_ldap_update_userinfo'] = "P�ivit� k�ytt�j�tiedot LDAP:ista moodleen (firstname, lastname, address..) .";
$string['auth_ldap_user_attribute'] = "Attribuutti k�ytt�j�nimille . Yleens� 'cn'.";
$string['auth_ldapdescription'] = "T�m� tapa tarjoaa k�ytt�j�tunnistuksen LDAP-palvelimelta.
                  Jos salasana ja tunnus t�sm��v�t, moodle luo uuden k�ytt�j�n  tietokantaansa. Jos olet valinnut 'auth_ldap_update_userinfo' option niin my�s k�ytt�j�tiedot siirret��n LDAP:sta moodleen.

Seuraavilla kerroilla ainostaan tunnus ja salasana tarkistetaan.";
$string['auth_ldapextrafields'] = "N�m� kent�t ovat valinnaisia. Voit asettaa Moodlen hakemaan k�ytt�j�tietoja LDAP-hakemistosta. K�ytt�j� voi joka tapauksessa muuttaa omia henkil�tietojaan j�lkeenp�in.";
$string['auth_ldaptitle'] = "K�yt� LDAP-palvelinta";
$string['auth_nntpdescription'] = "T�m� tapa k�ytt�� NNTP-palvelinta k�ytt�j�n tunnistukseen.";
$string['auth_nntphost'] = "NNTP palvelimen osoite. K�yt� IP-numeroa, �l� domainnime�.";
$string['auth_nntpport'] = "Palvelimen portti (119 , yleens�)";
$string['auth_nntptitle'] = "K�yt� NNTP-palvelinta";
$string['auth_nonedescription'] = "K�ytt�j�t voivat luoda vapaasti uuden tunnuksen ilman s�hk�postivarmistusta. 
Jos k�yt�t t�t� tapaa, mieti mit� tietoturva- tai yll�pito-ongelmia t�m� voi aiheuttaa.";
$string['auth_nonetitle'] = "Ei tunnistusta";
$string['auth_pop3description'] = "T�m� tapa k�ytt�� POP3 palvelinta k�ytt�j�n tunnistukseen.";
$string['auth_pop3host'] = "POP3 palvelimen osoite. K�yt� IP-numeroa, �l� domainnime�.";
$string['auth_pop3port'] = "Palvelimen portti (110 , yleens�)";
$string['auth_pop3title'] = "K�yt� POP3-palvelinta";
$string['auth_pop3type'] = "Palvelimen tyyppi. Jos k�yt�tte salattua yhteytt� valitse pop3cert.";
$string['auth_user_create'] = "K�ytt�j�n luonti";
$string['auth_user_creation'] = "Vooivatko  k�ytt�j�t voivat itse luoda tunnuksensa. K�ytt�j� tiedot tarkistetaan s�hk�postin avulla. Jos aktivoit t�m�n vaihtoehdon , muista my�s m��ritell� autentikointi-modulin muut asetukset t�h�n liittyen.";
$string['auth_usernameexists'] = "K�ytt�j�tunnus on jo k�yt�ss�. Valitse joku toinen.";
$string['authenticationoptions'] = "K�ytt�j�tunnistus asetukset";
$string['authinstructions'] = "T�h�n voi kirjoittaa ohjeet opiskelijoille mit� tunnusta ja salasanaa heid�n tulisi k�ytt��. T�m� teksti n�kyy kirjaantumissivulla.";
$string['changepassword'] = "Salasanan vaihto URL";
$string['changepasswordhelp'] = "T�ss� osoitteessa k�ytt�j�t voivat vaihtaa unohtamansa salasanan.";
$string['chooseauthmethod'] = "Valitse k�ytt�j�ntunnistus tapa: ";
$string['guestloginbutton'] = "Kirjaudu vieraana painike";
$string['instructions'] = "Ohjeeet";
$string['md5'] = "MD5-salaus";
$string['plaintext'] = "Paljas teksti";
$string['showguestlogin'] = "Voit n�ytt�� tai piiloittaa vierask�ytt�j� painikkeen kirjaantumissivulla.";

?>

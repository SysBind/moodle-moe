<?PHP // $Id$ 
      // auth.php - created with Moodle 1.0.6.4 beta (2002112001)


$string['auth_dbdescription'] = "T�m� moduli tarkistaa ulkoisen tietokannan taulusta onko k�ytt�j�tunnuksen ja salasanan.";
$string['auth_dbfieldpass'] = "Salasana sarakeen nimi";
$string['auth_dbfielduser'] = "K�ytt�tunnus sarakkeen nimi";
$string['auth_dbhost'] = "Tietokanta palvelin";
$string['auth_dbname'] = "Tietokannan nimi";
$string['auth_dbpass'] = "Salasana k�ytt�j�tunnukselle";
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
$string['auth_imaptitle'] = "K�yt� IMAP palvelinta";
$string['auth_imaptype'] = "IMAP palvelimen tyyppi.  katso ohjeesta (yll�) lis�tietoja.";
$string['auth_ldap_bind_dn'] = "Jos haluat k�ytt�� v�litys-k�ytt�j�� yhteyden muodostamiseen,m��ririt� se t�h�n. Esim. 'cn=ldapuser,ou=public,o=org'";
$string['auth_ldap_bind_pw'] = "Salasana v�litysk�ytt�j�lle.";
$string['auth_ldap_contexts'] = "Lista konteksteista joisssa k�ytt�j�t sijaitsevat. Erota kontekstit toisistaan ';'-merkill�. Esim: 'ou=users,o=org; ou=others,o=org'";
$string['auth_ldap_host_url'] = "M��rit� LDAP-palvelin URL-muodossa. Esim. 'ldap://ldap.myorg.com/' tai 'ldaps://ldap.myorg.com/' ";
$string['auth_ldap_search_sub'] = "Aseta arvo &lt;&gt; 0 jos haluat haka k�ytt�ji� my�s alikonteksteista.";
$string['auth_ldap_update_userinfo'] = "P�ivit� k�ytt�j�tiedot LDAP:ista moodleen (firstname, lastname, address..) . Katso lis�tietoa /auth/ldap/attr_mappings.php.";
$string['auth_ldap_user_attribute'] = "Attribuutti k�ytt�j�nimille . Yleens� 'cn'.";
$string['auth_ldapdescription'] = "T�m� tapa tarjoaa k�ytt�j�tunnistuksen LDAP-palvelimelta.
                  Jos salasana ja tunnus t�sm��v�t, moodle luo uuden k�ytt�j�n  tietokantaansa. Jos olet valinnut 'auth_ldap_update_userinfo' option niin my�s k�ytt�j�tiedot siirret��n LDAP:sta moodleen.

Seuraavilla kerroilla ainostaan tunnus ja salasana tarkistetaan.";
$string['auth_ldaptitle'] = "K�yt� LDAP palvelinta";
$string['auth_nntpdescription'] = "T�m� tapa k�ytt�� NNTP palvelinta k�ytt�j�n tunnistukseen.";
$string['auth_nntphost'] = "NNTP palvelimen osoite. K�yt� IP-numeroa, �l� domainnime�.";
$string['auth_nntpport'] = "Palvelimen portti (119 , yleens�)";
$string['auth_nntptitle'] = "K�yt� NNTP palvelinta";
$string['auth_nonedescription'] = "K�ytt�j�t voivat luoda vapaasti uuden tunnuksen ilman s�hk�postivarmistusta. 
Jos k�yt�t t�t� tapaa mieti mit� tietoturva- tai yll�pito-ongelmia t�m� voi aiheuttaa.";
$string['auth_nonetitle'] = "Ei tunnistusta";
$string['auth_pop3description'] = "T�m� tapa k�ytt�� POP3 palvelinta k�ytt�j�n tunnistukseen.";
$string['auth_pop3host'] = "POP3 palvelimen osoite. K�yt� IP-numeroa, �l� domainnime�.";
$string['auth_pop3port'] = "Palvelimen portti (110 , yleens�)";
$string['auth_pop3title'] = "K�yt� POP3 palvelinta";
$string['auth_pop3type'] = "Palvelimen tyyppi. Jos k�yt�tte salattua yhteytt� valitse pop3cert.";
$string['authenticationoptions'] = "K�ytt�j�ntunnistus asetukset";
$string['authinstructions'] = "T�h�n voi kirjoittaa ohjeet opiskelijoille mit� tunnusta ja salasanaa heid�n tulisi k�ytt��. T�m� teksti n�kyy kirjaantumissivulla.";
$string['chooseauthmethod'] = "Valitse k�ytt�j�ntunnistus tapa: ";
$string['showguestlogin'] = "Voit n�ytt�� tai piiloittaa vierask�ytt�j� painikkeen kirjaantumissivulla.";

?>

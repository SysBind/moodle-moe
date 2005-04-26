<?PHP // $Id$ 
      // admin.php - created with Moodle 1.5 UNSTABLE DEVELOPMENT (2005041101)


$string['adminseesallevents'] = 'Els administradors veuen tots els esdeveniments';
$string['adminseesownevents'] = 'Els administradors s�n com els altres usuaris';
$string['blockinstances'] = 'Inst�ncies';
$string['blockmultiple'] = 'M�ltiple';
$string['cachetext'] = 'Durada de la mem�ria cau de text';
$string['calendarsettings'] = 'Calendari';
$string['change'] = 'Canvia';
$string['configallowcoursethemes'] = 'Si habiliteu aquesta opci�, cada curs podr� definir el seu tema. Els temes dels cursos substitueixen qualsevol altra selecci� de tema: tema del lloc, de l\'usuari o de la sessi�.';
$string['configallowemailaddresses'] = 'Si voleu limitar les noves adreces de correu a certs dominis, especifiqueu-los aqu� separats per espais. Tots els altres dominis seran rebutjats. P. ex. <strong>uji.es upc.es xtec.es</strong>';
$string['configallowunenroll'] = 'Si especifiqueu \'S�\', llavors els estudiants podran cancel�lar quan vulguin la seva inscripci� en un curs. Si no, nom�s podran cancel�lar la inscripci� els professors i els administradors.';
$string['configallowuserblockhiding'] = 'Voleu que els usuaris puguin ocultar/mostrar els blocs laterals arreu d\'aquest lloc? Aquesta caracter�stica fa servir Javascript i galetes per recordar l\'estat de cada bloc. Nom�s afecta la visualitzaci� de cada usuari.';
$string['configallowuserthemes'] = 'Si habiliteu aquesta opci�, els usuaris podran definir els seus temes. Els temes dels usuaris substitueixen el tema del lloc (per� no substitueixen els temes dels cursos).';
$string['configallusersaresitestudents'] = 'Cal considerar com a estudiants TOTS els usuaris en les activitats de la p�gina inicial d\'aquest lloc? Si la resposta �s \"S�\", llavors qualsevol usuari amb un compte confirmat podr� participar com a estudiant en aquestes activitats. Si la resposta �s \"No\", llavors nom�s els usuaris que ja siguin membres d\'almenys un curs podran participar en aquestes activitats de la p�gina inicial. Nom�s els administradors i els professors que hi hagin estat assignats poden actuar com a professors d\'aquestes activitats.';
$string['configautologinguests'] = 'Cal fer entrar autom�ticament com a visitants els usuaris externs que intenten entrar en un curs que permet l\'acc�s de visitants?';
$string['configcachetext'] = 'Aquest par�metre pot agilitzar el funcionament de llocs amb molts usuaris o llocs que utilitzen filtres de text. Durant el temps que s\'especifica aqu� es ret� una c�pia del text ja filtrat. Teniu en compte que si el temps especificat �s massa breu el funcionament es podria alentir i tot, i que un temps massa prolongat podria implicar que els textos triguessin massa a actualitzar-se.';
$string['configclamactlikevirus'] = 'Tracta els fitxers com a virus';
$string['configclamdonothing'] = 'D�na els fitxers per bons';
$string['configclamfailureonupload'] = 'Si heu configurat el clam per escanejar els fitxers que es pugin, per� est� configurat incorrectament o no es pot executar per alguna ra� desconeguda, com s\'hauria de comportar? Si trieu \"Tracta els fitxers com a virus\", tots els fitxers es mouran a l\'�rea de quarantena, o seran suprimits. Si trieu \"D�na els fitxers per bons\", els fitxers es mouran al seu directori de destinaci� com �s normal.';
$string['configcountry'] = 'Si definiu un pa�s aqu�, llavors aquest pa�s quedar� seleccionat per defecte en els nous comptes d\'usuari. Si voleu que els usuaris tri�n obligat�riament un pa�s, no n\'especifiqueu cap aqu�.';
$string['configdbsessions'] = 'Si habiliteu aquest par�metre, la base de dades emmagatzemar� la informaci� de les sessions dels usuaris. Aix� �s especialment �til en llocs amb molts usuaris o en llocs que funcionen en cl�sters de servidors. Per a la majoria de llocs problema �s millor no habilitar-lo i utilitzar el disc del servidor en lloc de la base de dades. Teniu en compte que si canvieu ara aquest par�metre tancareu les sessions de tots els usuaris (la vostra inclosa).';
$string['configdebug'] = 'Si activeu aquest par�metre s\'incrementar� l\'error_reporting del PHP, de manera que es visualitzaran m�s avisos. �til nom�s per a desenvolupadors.';
$string['configdeleteunconfirmed'] = 'Si esteu utilitzant l\'autenticaci� per correu electr�nic, aquest �s el per�ode dins del qual s\'acceptar� la resposta dels usuaris. Despr�s d\'aquest per�ode, els comptes no confirmats se suprimeixen.';
$string['configdenyemailaddresses'] = 'Per refusar les adreces de correu de certs dominis, especifiqueu-les aqu� de la mateixa manera. Tots els altres dominis seran acceptats. P. ex. <strong>hotmail.com yahoo.com</strong>';
$string['configdigestmailtime'] = 'Les persones que tri�n rebre el correu electr�nic en format resum, el rebran una vegada al dia. Aquest par�metre controla a quina hora s\'envia el resum diari (el seg�ent cron que s\'executi despr�s d\'aquesta hora l\'enviar�).';
$string['configdisplayloginfailures'] = 'Aquest par�metre permet que usuaris seleccionats visualitzin informaci� sobre intents d\'entrada erronis.';
$string['configenablerssfeeds'] = 'Aquest commutador habilita l\'RSS per a tot el lloc. Per a utilitzar realment l\'RSS, l\'haureu d\'activar tamb� en cada m�dul. Aneu als par�metres dels m�duls en Administraci� > Configuraci�.';
$string['configenablerssfeedsdisabled'] = 'No est� disponible perqu� l\'RSS est� inhabilitat per a tot el lloc. Per habilitar-lo, aneu a la pantalla de variables en Administraci� > Configuraci�.';
$string['configerrorlevel'] = 'Trieu el nivell d\'avisos del PHP que voleu visualitzar. Generalment \'Normal\' �s la millor opci�.';
$string['configextendedusernamechars'] = 'Habiliteu aquest par�metre perqu� els estudiants puguin usar qualsevol car�cter en el seu nom d\'usuari (no afecta els noms actuals). El valor per defecte �s \"fals\", la qual cosa limita els noms d\'usuari a car�cters alfanum�rics.';
$string['configfilterall'] = 'Filtra totes les cadenes, inclosos encap�alaments, t�tols, barres de navegaci�, etc. �til sobretot amb el filtre multillenguatge. Si no, pot crear una c�rrega extra al servidor sense guanyar res a canvi.';
$string['configfilteruploadedfiles'] = 'Habilitar aquest par�metre fa que Moodle processi amb els filtres, abans de visualitzar-los, tots els fitxers de text i HTML que es pengin.';
$string['configforcelogin'] = 'Normalment la p�gina inicial del lloc i la llista de cursos es poden llegir sense entrar-hi amb nom d\'usuari i contrasenya. Si voleu imposar que els usuari entrin abans de veure o fer RES en aquest lloc, habiliteu aquest par�metre.';
$string['configforceloginforprofiles'] = 'Habiliteu aquest par�metre per imposar que els usuaris entrin amb un compte real (no com a visitants) abans que puguin veure les p�gines dels perfils dels usuaris. Per defecte est� inhabilitat (\"fals\"), la qual cosa vol dir que els possibles estudiants poden llegir la informaci� dels professors de cada curs, i tamb� que els motors de recerca web, com ara Google, poden entrar-hi.';
$string['configframename'] = 'Si teniu incrustat Moodle dins d\'un marc web, escriviu aqu� el nom del marc. Si no aquest valor hauria de ser \'_top\'.';
$string['configfullnamedisplay'] = 'Aquest par�metre defineix el format dels noms quan es visualitzen complets. En la majoria de llocs el valor per defecte �s el m�s adequat: \"Nom + Cognoms\". Per� si voleu podeu ocultar els cognoms, o deixar que el paquet d\'idioma decideixi el format (alguns idiomes tenen convencions diferents).';
$string['configgdversion'] = 'Indiqueu la versi� instal�lada de GD. La versi� que es mostra per defecte �s la que s\'ha detectat autom�ticament. No la canvieu si no esteu segur del que feu.';
$string['confightmleditor'] = 'Trieu si voleu permetre l\'�s de l\'editor HTML integrat. Encara que decidiu permetre\'n l\'�s, aquest editor nom�s apareixer� si l\'usuari fa servir un navegador web compatible. Els usuaris tamb� poden triar no usar-lo.';
$string['configidnumber'] = 'Aquesta opci� especifica si: a) no es demana cap n�mero d\'identificaci� als usuaris; b) es demana un n�mero d\'identificaci� als usuaris per� poden deixar-lo en blanc o c) es demana un n�mero d\'identificaci� als usuaris i no poden deixar-lo en blanc. Si l\'usuari ha donat un n�mero d\'identificaci�, aquest n�mero es mostra al seu perfil.';
$string['configintro'] = 'En aquesta p�gina podeu especificar un gran nombre de variables de configuraci� que contribueixen a fer funcionar Moodle de la manera adequada en el vostre servidor. Per� no cal que us amo�neu: els valors per defecte solen anar molt b� i sempre podeu tornar-hi m�s tard per fer canvis en aquests par�metres.';
$string['configintroadmin'] = 'En aquesta p�gina haur�eu de configurar el compte de l\'administrador principal que tindr� control complet sobre aquest lloc. Doneu-li un nom i una contrasenya segurs i una adre�a de correu electr�nic v�lida. Despr�s podreu crear m�s comptes d\'administraci�.';
$string['configintrosite'] = 'Aquesta p�gina us permet configurar la p�gina inicial i el nom d\'aquest lloc. Podeu tornar-hi despr�s en qualsevol moment per canviar aquests par�metres, per mitj� de l\'enlla� \"Par�metres del lloc\" de la p�gina inicial.';
$string['configintrotimezones'] = 'Aquesta p�gina cercar� informaci� nova sobre zones hor�ries (inclosos horaris d\'estiu) i actualitzar� la vostra base de dades. S\'inspeccionaran, per ordre, aquestes ubicacions: $a Aquest procediment generalment �s molt segur i no pot perjudicar les instal�lacions normals. Desitgeu actualitzar ara les zones hor�ries?';
$string['configlang'] = 'Trieu un idioma per defecte per a tot el lloc. Casa usuari podr� triar despr�s el seu idioma. ';
$string['configlangdir'] = 'La majoria d\'idiomes s\'escriuen d\'esquerra a dreta, per� alguns, com l\'�rab o l\'hebreu, s\'escriuen de dreta a esquerra.';
$string['configlanglist'] = 'Deixeu en blanc aquest camp per tal que els usuaris puguin triar qualsevol idioma instal�lat. Si voleu abreujar el men� d\'idiomes, introdu�u aqu� una llista de codis separats per comes. Per exemple: ca,es_es,en,fr,it.';
$string['configlangmenu'] = 'Trieu si voleu visualitzar o no el men� d\'idioma a la p�gina inicial, p�gina d\'entrada, etc. No impedeix que l\'usuari pugui definir el seu idioma preferit en el seu perfil.';
$string['configlocale'] = 'Trieu un <em>locale</em> per a tot el lloc. Afecta el format i l\'idioma de les dates. Heu de tenir instal�lades les dades d\'aquest <em>locale</em> en el vostre sistema operatiu. P. ex. ca_ES, es_ES o en_US. Si no sabeu qu� triar deixeu-lo en blanc.';
$string['configloginhttps'] = 'Activar aquest par�metre fa que Moodle utilitzi una connexi� https segura en la p�gina d\'entrada, tot proporcionant aix� una entrada segura, i despr�s torni als URL normals amb http per a mantenir la velocitat normal. ALERTA: aquest par�metre requereix que l\'https estigui habilitat en el vostre servidor. Si no est� habilitat US PODR�EU QUEDAR FORA SENSE POSSIBILITAT D\'ENTRAR AL VOSTRE LLOC.';
$string['configsectioninterface'] = 'Interf�cie';
$string['configsectionmail'] = 'Correu';
$string['configsectionmaintenance'] = 'Manteniment';
$string['configsectionmisc'] = 'Miscel�l�nia';
$string['configsectionoperatingsystem'] = 'Sistema Operatiu';
$string['configsectionpermissions'] = 'Permisos';
$string['configsectionsecurity'] = 'Seguretat';
$string['configsectionuser'] = 'Usuari';
$string['configvariables'] = 'Variables';
$string['confirmation'] = 'Confirmaci�';
$string['cronwarning'] = 'La <a href=\"cron.php\">seq��ncia de manteniment cron.php</a> no s\'ha executat en les darreres 24 hores com a m�nim.<br />La <a href=\"../doc/?frame=install.html?=cron\">documentaci� d\'instal�laci�</a> explica com podeu automatitzar-ho.';
$string['edithelpdocs'] = 'Edita documents d\'ajuda';
$string['editstrings'] = 'Edita cadenes';
$string['filterall'] = 'Filtra totes les cadenes';
$string['filteruploadedfiles'] = 'Filtrar fitxers penjats';
$string['helpadminseesall'] = 'Veuen els administradors tots els esdeveniments o nom�s aquells que se\'ls hi apliquin?';
$string['helpcalendarsettings'] = 'Configureu diversos aspectes de Moodle relatius al calendari i a les dates i horaris.';
$string['helpstartofweek'] = 'En quin dia comen�a la setmana?';
$string['helpupcominglookahead'] = 'Quants dies per endavant considera el calendari per determinar els esdeveniments pr�xims?';
$string['helpupcomingmaxevents'] = 'Quin nombre m�xim d\'esdeveniments pr�xims es mostra per defecte als usuaris?';
$string['helpweekenddays'] = 'Quins dies de la setmana es consideren \"cap de setmana\" i es mostren amb un color diferent?';
$string['importtimezones'] = 'Actualitza la llista completa de zones hor�ries';
$string['sitemaintenancemode'] = 'Mode manteniment';
$string['therewereerrors'] = 'Hi ha errors en aquestes dades';
$string['upgradelogs'] = 'Per a disposar de totes les funcionalitats, els vostres registres s\'han d\'actualitzar. <a href=\"$a\">M�s informaci�</a>';
$string['upgradelogsinfo'] = 'S\'han introdu�t alguns canvis en la manera d\'emmagatzemar els registres. Per tal de poder veure tots els vostres registres vells per activitat, els vostres registres vells s\'han d\'actualitzar. Depenent del vostre servidor aix� pot trigar una bona estona (unes quantes hores) i en una instal�laci� gran pot carregar una mica la base de dades. Una vegada h�geu engegat aquest proc�s haureu de deixar que acabi (mantenint la finestra del navegador oberta). No us amo�neu: el vostre lloc seguir� actiu per als usuaris mentre els registres s\'actualitzen. <br /><br />Voleu actualitzar els registres ara?';
$string['upgradesure'] = 'Els vostres fitxers de Moodle han canviat i esteu a punt d\'actualitzar autom�ticament el servidor a aquesta versi�:
<p><b>$a</b></p>
<p>Despr�s de fer aix� no podreu tornar enrere.</p> 
<p>Esteu segur que voleu actualitzar aquest servidor a aquesta versi�?</p>';
$string['upgradinglogs'] = 'S\'estan actualitzant els registres';

?>

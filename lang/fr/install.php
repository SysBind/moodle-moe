<?php // $Id$
     
$string['admindirerror'] = 'Le dossier d\'administration sp�cifi� est incorrect';
$string['admindirname'] = 'Dossier d\'administration';
$string['admindirsetting'] = 'Quelques h�bergeurs web utilisent le dossier � /admin � comme URL sp�ciale vous permettant d\'acc�der � un tableau de bord ou autre chose. Ceci entre en collision avec l\'emplacement standard des pages d\'administration de Moodle. Vous pouvez corriger cela en renommant le dossier d\'administration de votre installation de Moodle, en inscrivant ici le nouveau nom, par exemple <br />&nbsp;<br /><b>moodleadmin</b><br />&nbsp;<br />. Les liens vers l\'administration de Moodle seront ainsi corrig�s.</p>';
$string['chooselanguage'] = 'Choisissez une langue';
$string['compatibilitysettings'] = 'V�rification de la compatibilit� du serveur pour le fonctionnement de Moodle';
$string['configfilenotwritten'] = 'Le programme d\'installation n\'a pas pu cr�er automatiquement le fichier de configuration � config.php � avec vos r�glages. Veuillez copier le code ci-dessous dans un fichier appel� � config.php �, que vous placerez � l\int�rieur du dossier principal de Moodle (l� o� se trouve un fichier � config-dist.php �).';
$string['configfilewritten'] = 'Le fichier � config.php � a �t� cr�� avec succ�s';
$string['configurationcomplete'] = 'Configuration termin�e';
$string['database'] = 'Base de donn�es';
$string['databasesettings'] = 'Il faut maintenant configurer la base de donn�es dans laquelle sont enregistr�es la plupart des donn�es utilis�es par Moodle. Cette base de donn�es doit avoir d�j� �t� cr��e sur le serveur, ainsi qu\'un nom d\'utilisateur et un mot de passe permettant d\'y acc�der.<br /><br />&nbsp;<br />
<b>Type :</b> mysql ou postgres7<br />
<b>Serveur h�te :</b> le plus souvent � localhost � ou par exemple � db.isp.com��<br />
<b>Nom :</b> nom de la base de donn�es, par exemple � moodle��<br />
<b>Utilisateur :</b> le nom d\'utilisateur de la base de donn�es<br />
<b>Mot de passe :</b> le mot de passe de la base de donn�es<br />
<b>Pr�fixe des tables :</b> pr�fixe � utiliser pour les noms de toutes les tables';
$string['dataroot'] = 'Donn�es';
$string['datarooterror'] = 'Le param�tre � Donn�es � est incorrect';
$string['dbconnectionerror'] = 'Erreur de connexion � la base de donn�es. Veuillez v�rifier les r�glages de votre base de donn�es';
$string['dbcreationerror'] = 'Erreur lors de la cr�ation de la base de donn�es. Impossible de cr�er la base de donn�es avec les param�tres fournis';
$string['dbhost'] = 'Serveur h�te';
$string['dbpass'] = 'Mot de passe';
$string['dbprefix'] = 'Pr�fixe des tables';
$string['dbtype'] = 'Type';
$string['directorysettings'] = '<b>WWW :</b> veuillez indiquer � Moodle l\'emplacement o� il se trouve. Sp�cifiez l\'adresse web compl�te de l\'endroit o� il a �t� install�. Si votre site web est accessible par plusieurs URL, choisissez celle qui est la plus naturelle ou la plus �vidente. Ne pas placer de barre oblique � la fin de l\'adresse<br />&nbsp;<br />
<b>Dossier :</b> veuillez sp�cifier le chemin complet de ce m�me dossier (OS path). Assurez-vous que la casse des caract�res (majuscules/minuscules) est correcte<br />&nbsp;<br />
<b>Donn�es :</b> Moodle a besoin d\'un emplacement o� enregistrer les fichiers d�pos�s sur le site. Le serveur web (utilisateur d�nomm� habituellement � www �, � apache � ou � nobody �) doit avoir acc�s � ce dossier en lecture et EN �CRITURE. Toutefois ce dossier ne devrait pas �tre accessible directement depuis le web.';
$string['dirroot'] = 'Dossier';
$string['dirrooterror'] = 'Le param�tre � Dossier � est incorrect. Essayez le param�tre suivant';
$string['fail'] = '�chec';
$string['fileuploads'] = 'T�l�chargement des fichiers';
$string['fileuploadserror'] = 'Le t�l�chargement des fichiers sur le serveur doit �tre activ�';
$string['fileuploadshelp'] = 'Moodle n�cessite l\'activation du t�l�chargement des fichiers';
$string['gdversion'] = 'Version de GD';
$string['gdversionerror'] = 'La librairie GD doit �tre activ�e pour traiter et cr�er les images';
$string['gdversionhelp'] = 'La librairie GD doit �tre activ�e pour traiter et cr�er les images';
$string['installation'] = 'Installation';
$string['memorylimit'] = 'Limite de m�moire';
$string['memorylimiterror'] = 'La limite de m�moire doit �tre d\'au moins 16 Mo ou �tre modifiable';
$string['memorylimithelp'] = 'La limite de m�moire doit �tre d\'au moins 16 Mo ou �tre modifiable. Votre limite de m�moire actuelle est de $a';
$string['pass'] = 'R�ussi';
$string['phpversion'] = 'Version de PHP';
$string['phpversionerror'] = 'La version du programme PHP doit �tre au moins 4.1.0';
$string['phpversionhelp'] = 'Moodle n�cessite au minimum la version 4.1.0 de PHP. Vous utilisez actuellement la version $a';
$string['safemode'] = 'Safe Mode';
$string['safemodeerror'] = 'Moodle ne peut pas traiter correctement les fichiers lorsque le mode � safe mode � est activ�';
$string['safemodehelp'] = 'Moodle ne peut pas traiter correctement les fichiers lorsque le mode � safe mode � est activ�';
$string['sessionautostart'] = 'D�marrage automatique des sessions';
$string['sessionautostarterror'] = 'Ce param�tre doit �tre d�sactiv�';
$string['sessionautostarthelp'] = 'Le d�marrage automatique des sessions doit �tre d�sactiv�';
$string['sessionsavepath'] = 'Chemin d\'enregistrement des sessions';
$string['sessionsavepatherror'] = 'Il semble que votre serveur ne supporte pas les sessions';
$string['sessionsavepathhelp'] = 'Moodle n�cessite le support des sessions';
$string['magicquotesruntime'] = 'Magic Quotes Run Time';
$string['magicquotesruntimeerror'] = 'Ce r�glage doit �tre d�sactiv�';
$string['magicquotesruntimehelp'] = 'Le r�glage � Magic quotes � doit �tre d�sactiv�';
$string['wwwroot'] = 'WWW';
$string['wwwrooterror'] = 'Le param�tre � WWW � est incorrect';

?>

<?php // $Id$
     
$string['admindirerror'] = 'Le dossier d\'administration sp�cifi� est incorrect';
$string['admindirname'] = 'Dossier d\'administration';
$string['admindirsetting'] = '<p>Quelques h�bergeurs web utilisent le dossier � /admin � comme URL sp�ciale vous permettant d\'acc�der � un tableau de bord ou autre chose. Ceci entre en collision avec l\'emplacement standard des pages d\'administration de Moodle. Vous pouvez corriger cela en renommant le dossier d\'administration de votre installation de Moodle, en inscrivant ici le nouveau nom, par exemple <blockquote>moodleadmin</blockquote>. Les liens vers l\'administration de Moodle seront ainsi corrig�s.</p>';
$string['chooselanguage'] = 'Choisissez une langue';
$string['configfilenotwritten'] = 'Le programme d\'installation n\'a pas pu cr�er automatiquement le fichier de configuration � config.php � avec vos r�glages. Veuillez copier le code ci-dessous dans un fichier appel� � config.php �, que vous placerez � l\int�rieur du dossier principal de Moodle (l� o� se trouve un fichier � config-dist.php �).';
$string['configfilewritten'] = 'Le fichier � config.php � a �t� cr�� avec succ�s';
$string['configurationcomplete'] = 'Configuration termin�e';
$string['database'] = 'Base de donn�es';
$string['databasesettings'] = '<p>Il faut maintenant configurer la base de donn�es dans laquelle sont enregistr�es la plupart des donn�es utilis�es par Moodle. Cette base de donn�es doit avoir d�j� �t� cr��e sur le serveur, ainsi qu\'un nom d\'utilisateur et un mot de passe permettant d\'y acc�der.</p>
<p>Type : mysql ou postgres7<br />
Serveur h�te : le plus souvent � localhost � ou par exemple � db.isp.com��<br />
Nom : nom de la base de donn�es, par exemple � moodle��<br />
Utilisateur : le nom d\'utilisateur de la base de donn�es<br />
Mot de passe : le mot de passe de la base de donn�es<br />
Pr�fixe des tables : pr�fixe � utiliser pour les noms de toutes les tables</p>';
$string['dataroot'] = 'Donn�es';
$string['datarooterror'] = 'Le param�tre � Donn�es � est incorrect';
$string['dbconnectionerror'] = 'Erreur de connexion � la base de donn�es. Veuillez v�rifier les r�glages de votre base de donn�es';
$string['dbcreationerror'] = 'Erreur lors de la cr�ation de la base de donn�es. Impossible de cr�er la base de donn�es avec les param�tres fournis';
$string['dbhost'] = 'Serveur h�te';
$string['dbpass'] = 'Mot de passe';
$string['dbprefix'] = 'Pr�fixe des tables';
$string['dbtype'] = 'Type';
$string['directorysettings'] = '<p><b>WWW :</b> veuillez indiquer � Moodle l\'emplacement o� il se trouve. Sp�cifiez l\'adresse web compl�te de l\'endroit o� il a �t� install�. Si votre site web est accessible par plusieurs URL, choisissez celle qui est la plus naturelle ou la plus �vidente. Ne pas placer de barre oblique � la fin de l\'adresse</p>
<p><b>Dossier :</b> veuillez sp�cifier le chemin complet de ce m�me dossier (OS path). Assurez-vous que la casse des caract�res (majuscules/minuscules) est correcte</p>
<p><b>Donn�es :</b> Moodle a besoin d\'un emplacement o� enregistrer les fichiers d�pos�s sur le site. Le serveur web (utilisateur d�nomm� habituellement � www �, � apache � ou � nobody �) doit avoir acc�s � ce dossier en lecture et EN �CRITURE. Toutefois ce dossier ne devrait pas �tre accessible directement depuis le web.</p>';
$string['dirroot'] = 'Dossier';
$string['dirrooterror'] = 'Le param�tre � Dossier � est incorrect. Essayez le param�tre suivant';
$string['wwwroot'] = 'WWW';
$string['wwwrooterror'] = 'Le param�tre � WWW � est incorrect';

?>

<?php // $Id$

$string['modulename'] = 'Wiki';
$string['modulenameplural'] = 'Wikis';

$string['wikiname'] = 'Nom de la page';
$string['wikitype'] = 'Type';
$string['ewikiprinttitle'] = 'Afficher sur chaque page le nom du wiki.';
$string['htmlmode'] = 'Mode HTML';
$string['ewikiacceptbinary'] = 'Permettre les fichiers binaires';
$string['initialcontent'] = 'Choisir une page initiale';
$string['chooseafile'] = 'S�lectionner/d�poser une page initiale';
$string['pagenamechoice'] = '- ou -';

$string['wikidefaultpagename'] = 'IndexWiki';
$string['wikistartederror'] = 'Le wiki a d�j� des entr�es - impossible de modifier.';
$string['nowikicreated'] = 'Aucune entr�e n\'a �t� cr��e dans ce wiki.';
$string['wikiusage'] = 'Utilisation de ce wiki';

$string['nohtml'] = 'Pas de code HTML';
$string['safehtml'] = 'HTML s�r';
$string['htmlonly'] = 'HTML uniquement';

$string['searchwiki'] = 'Recherche dans le wiki';
$string['wikilinks'] = 'Liens wiki';
$string['choosewikilinks'] = '-- S�lectionner les liens wiki --';
$string['viewpage'] = 'Afficher la page';
$string['sitemap'] = 'Carte du site';
$string['pageindex'] = 'Index des pages';
$string['newestpages'] = 'Pages r�centes';
$string['mostvisitedpages'] = 'Pages les plus visit�es';
$string['mostoftenchangedpages'] = 'Pages les plus souvent modifi�es';
$string['updatedpages'] = 'Pages modifi�es';
$string['orphanedpages'] = 'Pages orphelines';
$string['orphanedpage'] = 'Page orpheline';
$string['wantedpages'] = 'Pages d�sir�es';
$string['filedownload'] = 'D�p�t de fichier';
$string['for'] = 'pour';
$string['groups'] = 'Groupes';

$string['action'] = '-- Action --';
$string['otherwikis'] = 'Autres wikis';
$string['pageactions'] = 'Actions de page';
$string['editthispage'] = 'Modifier cette page';
$string['backlinks'] = 'R�f�rences';
$string['pageinfo'] = 'Information de la page';
$string['attachments'] = 'Annexe de la page';
$string['howtowiki'] = 'Qu\'est-ce qu\'un wiki';

$string['chooseadministration'] = '-- Administration --';
$string['administration'] = 'Administration';
$string['notadministratewiki'] = 'Vous n\'�tes pas autoris� � administrer ce wiki !';
$string['noadministrationaction'] = 'Aucune action d\'administration donn�e.';
$string['setpageflags'] = 'Fixer les attributs de la page';
$string['nocandidatestoremove'] = 'No candidate pages to remove, choose \'$a\' to show all pages.';
$string['removepages'] = 'Supprimer des pages';
$string['pagesremoved'] = 'Pages supprim�es.';
$string['checklinkscheck'] = 'Voulez-vous vraiment v�rifier les liens de cette page :';
$string['checklinks'] = 'V�rifiez les liens';
$string['linkschecked'] = 'Liens v�rifi�s';
$string['checklinksnotice'] = 'Merci de patienter durant cette op�ration.';
$string['removenotice'] = 'Seules les pages non r�f�renc�es seront list�es ici. Comme le moteur ewiki ne fait que des tests limit�s sur les r�f�rences, il est possible que certaines d\'entre elles manquent ici.<br />Cependant si vous videz une page d\'abord, elle sera aussi affich�e ici. D\'autres diagnostics sont �galement effectu�s.';
$string['removepagecheck'] = 'Voulez-vous vraiment supprimer ces pages ?';
$string['pagename'] = 'Nom de page';
$string['errororreason'] = 'Erreur ou cause';
$string['listall'] = 'Tout afficher';
$string['listcandidates'] = 'Afficher les candidats';
$string['removeselectedpages'] = 'Supprimer les pages s�lectionn�es';
$string['disabledpage'] = 'Page d�sactiv�es';
$string['errorbinandtxt'] = 'Erreur d\'attribut : page de type BIN et TXT';
$string['errornotype'] = 'Erreur d\'attribut : page ni BIN ni TXT';
$string['errorhtml'] = 'Page de type HTML';
$string['readonly'] = 'Page en lecture seule';
$string['ownerunknown'] = 'inconnu';
$string['errorroandwr'] = 'Erreur d\'attribut : la page est autoris�e en �criture et en lecture seule';
$string['errorsize'] = 'Taille de la page sup�rieure � 64KiB';
$string['emptypage'] = 'Page vide';
$string['flags'] = 'Attributs';
$string['status'] = 'Statut';
$string['flagsset'] = 'Attributs modifi�s';
$string['strippages'] = 'Purger les pages';
$string['strippagecheck'] = 'Voulez-vous vraiment purger les anciennes versions de ces pages :';
$string['nothingtostrip'] = 'Il n\'y a pas de pages avec plus d\'une version.';
$string['version'] = 'Version';
$string['versions'] = 'Versions';
$string['pagesstripped'] = 'Pages purg�es.';
$string['wrongversionrange'] = '$a n\'est pas un intervalle correct !';
$string['versionrangetoobig'] = 'Il n\'est pas permis de supprimer toutesles versions d\'une page ! La derni�re version doit persister.';
$string['linkok'] = 'OK';
$string['linkdead'] = 'MORT';
$string['offline'] = 'HORS-LIGNE';
$string['nolinksfound'] = 'Aucun lien trouv� sur la page.';
$string['revertpages'] = 'R�tablir les modifications effectu�es';
$string['pagesreverted'] = 'Modifications r�tablies';
$string['revertpagescheck'] = 'Voulez-vous vraiment r�tablir les modifications suivantes :';
$string['revertchanges'] = 'R�tablir les modifications';
$string['versionstodelete'] = 'Version(s) � supprimer';
$string['nochangestorevert'] = 'Aucune modification � r�tablir.';
$string['authorfieldpattern'] = 'Author field pattern';
$string['noregexp'] = 'Ceci doit �tre une cha�ne de caract�res fixe (Pas de * ni d\'expression r�guli�re), de pr�f�rence l\'adresse IP du saboteur ou son nom d\'h�te ; ne pas inclure le num�ro de port (qui augmente � chaque requ�te http).';
$string['changesfield'] = 'Combien d\'heures depuis le dernier changement';
$string['howtooperate'] = 'Comment collaborer';
$string['authorfieldpatternerror'] = 'Veuillez saisir un auteur.';
$string['deleteversionserror'] = 'Veuillez saisir un num�ro de version correct.';
$string['changesfielderror'] = 'Veuillez saisir une heure correcte.';
$string['revertlastonly'] = 'Seulement s\'il s\'agit du dernier changement';
$string['revertallsince'] = 'R�tablir �galement les modifications effectu�es apr�s';
$string['revertthe'] = 'R�tablir les modifications';
$string['deleteversions'] = 'Combien de derni�res versions � d�truire';
$string['deletepage'] = 'Supprimer la page';

# Filter Name
$string['filtername'] = 'Liens automatiques des pages wiki';


# Flags, please be careful when translating
$string['flagtxt'] = 'TXT';
$string['flagbin'] = 'BIN';
$string['flagoff'] = 'OFF';
$string['flaghtm'] = 'HTM';
$string['flagro'] = 'RO';
$string['flagwr'] = 'WR';

# This one has to be a WikiWord !!!
$string['deletemewikiword'] = 'SupprimezMoi';
$string['deletemewikiwordfound'] = '$a trouv� sur la page';

$string['submit'] = 'Envoyer';

# Ewiki
$string['editform1'] = 'Ne vous focalisez pas trop sur le formatage, il peut toujours �tre am�lior� ult�rieurement.';
$string['editform2'] = 'Veuillez �crire intelligemment, et souvenez-vous que toutes les modifications sont enregistr�es.';
$string['save'] = 'Enregistrer';
$string['preview'] = 'Pr�visualiser';
$string['canceledit'] = 'Annuler';
$string['uploadpicturebutton'] = 'D�poser';
$string['lastchanged'] = 'Derni�re modification le $a';
$string['hits'] = '$a requ�tes';
$string['changes'] = '$a modifications';
$string['upload0'] = 'Utilisez ce formulaire pour d�poser un fichier binaire dans ce wiki :';
$string['uplnewnam'] = 'Enregistrer sous un nom diff�rent';
$string['uplok'] = 'Votre fichier a �t� d�pos� correctement.';
$string['uplerror'] = 'D�sol�, votre fichier n\'a pas pu �tre d�pos�.';
$string['dwnlnofiles'] = 'Aucun fichier d�pos� jusqu\'ici.';
$string['file'] = 'Fichier';
$string['uploadedon'] = 'D�pos� le';
$string['fileisoftype'] = 'Le fichier est de type';
$string['downloadtimes'] = 'T�l�charg� $a fois';
$string['of'] = 'sur';
$string['comment'] = 'Commentaire';
$string['dwnlsection'] = 'T�l�charger la section';
$string['infoaboutpage'] = 'Information sur la page';
$string['thanksforcontribution'] = 'Merci pour votre contribution.';
$string['disabledpage'] = 'Cette page n\'est actuellement pas disponible.';
$string['doesnotexist'] = 'Cette page n\'existe pas encore. si vous voulez la cr�er, veuillez cliquer sur le bouton modifier.';
$string['errversionsave'] = 'D�sol�, pendant que vous modifiiez cette page, quelqu\'un d\'autre a enregistr� une version modifi�e. Veuillez retourner � l\'�cran pr�c�dent et coper vos modifications dans le presse-papiers de votre ordinateur afin de les ins�rer de nouveau dans l\'�cran d\'�dition.';
$string['forbidden'] = 'Vous n\'�tes pas autoris� � acc�der � cette page.';
$string['binimgtoolarge'] = 'Le fichier image est trop gros !';
$string['binnoimg'] = 'Ce format de fichier ne peut pas �tre accept� !';
$string['browse'] = 'Consulter';
$string['fetchback'] = 'Fetch-back';
$string['differences'] = 'Diff�rences entre les versions $a->new_ver et $a->old_ver de $a->pagename.';
$string['diff'] = 'Diff';
$string['author'] = 'Auteur';
$string['created'] = 'Cr��';
$string['lastmodified'] = 'Derni�re modification';
$string['meta'] = 'M�ta-data';
$string['refs'] = 'R�ferences';
$string['contentsize'] = 'Taille du contenu';
$string['pageslinkingto'] = 'Pages avec un lien vers cette page';
$string['viewsmfor'] = 'Afficher la carte du site pour';
$string['smfor'] = 'Carte du site pour';
$string['cannotchangepage'] = 'Cette page ne peux pas �tre modifi�e.';
$string['uplinsect'] = 'D�poser dans';
$string['invalidroot'] = 'Vous n\'�tes pas autoris� � acc�der � la page racine actuelle, et donc aucune carte du site ne peut �tre cr��e.';
$string['thispageisntlinkedfromanywhereelse'] = 'Aucun lien n\'existe vers cette page.';

$string['wikiexportcomment'] = 'Vous pouvez ici configurer l\'exportation selon vos besoins.';
$string['wikiexport'] = 'Exporter des pages';
$string['exportformats'] = 'Exporter des formats';
$string['export'] = 'Exporter';
$string['withbinaries'] = 'Inclure les contenus binaires';
$string['withvirtualpages'] = 'Inclure les liens wiki';
$string['plaintext'] = 'Texte pur';
$string['html'] = 'Format HTML';
$string['downloadaszip'] = 'Archive zip t�l�chargeable';
$string['moduledirectory'] = 'Module dossier';
$string['exportto'] = 'Exporter vers';
$string['exportsuccessful'] = 'Exportation r�ussie.';
$string['index'] = 'Index';

?>
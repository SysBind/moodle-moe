<?PHP // $Id$ 
      // admin.php - created with Moodle 1.5.2 + (2005060221)


$string['adminseesallevents'] = 'Administrator/innen sehen alle Termine';
$string['adminseesownevents'] = 'Administrator/innen sehen nur Termine eigener Kurse';
$string['blockinstances'] = 'Instanzen';
$string['blockmultiple'] = 'Mehrfach';
$string['cachetext'] = 'Dauer der Gültigkeit für Cache';
$string['calendarsettings'] = 'Kalender';
$string['change'] = 'Ändern';
$string['configallowcoursethemes'] = 'Mit der Aktivierung erlauben Sie die Auswahl kursspezifischer Themes. Kursthemes überschreiben die Einstellungen für die gesamte Installation und von Nutzer/innen.';
$string['configallowemailaddresses'] = 'Wenn Sie die Nutzung bestimmter E-Mail-Adressen verbindlich vorgeben wollen, können Sie diese auf bestimmte Domains begrenzen. Tragen Sie dazu die zulässigen Domains ein, z.B. <strong>unserefirma.de</strong>.';
$string['configallowobjectembed'] = 'Als Sicherheitsvoreinstellung dürfen normale Benutzer/innen in ihren Texten keine eingebetteten Multimedia-Dateien (z.B. Flash) benutzen. Speziell sind die HTML-Tags EMBED und OBJECT nicht erlaubt (wobei dies durch die Verwendung des Multimedia-Plugin-Filters sicherer durchgeführt werden könnte). Wenn Sie diese Tags trotzdem erlauben möchten, dass wählen Sie \'Ja\'. ';
$string['configallowunenroll'] = 'Wenn Sie \'Ja\' wählen, haben Teilnehmer/innen die Möglichkeit, sich jederzeit selbst aus ihren Kursen auszutragen, andernfalls liegt dies allein in der Hand der Kursleiter/innen oder Administrator/innen.';
$string['configallowuserblockhiding'] = 'Wollen Sie zulassen, dass Nutzer/innen selber Blöcke ein-/und ausblenden können. Das Feature verwendet JavaScript und Cookies, um den Status zu speichern. Die Einstellung bezieht sich nur auf die Ansicht der Nutzer/innen.';
$string['configallowuserthemes'] = 'Die Einstellung erlaubt Nutzer/innen, ein Design auszuwählen. Damit wird das Design der Installation überschrieben, nicht aber kursspezifische Design-Einstellungen.';
$string['configallusersaresitestudents'] = 'Hier legen Sie den Zugriff zu den Lernaktivitäten auf der Startseite der Moodle-Installation fest. Wenn Sie \'Ja\' eintragen, kann jede/r bestätigte Teilnehmer/in, die Lernaktivitäten auf der Startseite durchführen. Wenn Sie \'Nein\' eintragen, können nur Teilnehmer/innen, die derzeit in mindestens einem Kurs eingetragen sind, die Lernaktivitäten auf der Startseite ausführen. Nur die Administrator/innen und speziell zugelassene Trainer/innen können die Aktivitäten auf der Startseite einrichten und bearbeiten.';
$string['configautologinguests'] = 'Sollen Gäste automatisch eingeloggt werden, wenn der Kurs den Zugang für Gäste erlaubt?';
$string['configcachetext'] = 'Diese Einstellung kann größere Sites (oder bei Verwendung von Textfiltern) erheblich beschleunigen. Textkopien werden in ihrer verarbeiteten Fassung für die festgelegte Zeit vorgehalten. Eine zu niedrige Einstellung kann sogar zu einer leichten Verlangsamung führen, bei einer zu hohen Einstellung kann die Aktualisierung der Texte (z.B. mit neuen Links) allerdings zu lange brauchen.';
$string['configclamactlikevirus'] = 'Behandle die Dateien wir virenhaltige Dateien';
$string['configclamdonothing'] = 'Behandle die Dateien als ok';
$string['configclamfailureonupload'] = 'Legen Sie fest, was passieren soll, wenn Sie hochgeladene Dateien mit ClamAV auf Viren überprüfen, dabei aber ein Fehler auftritt.
Wenn Sie auswählen \'Behandle Dateien wie virenhaltige Dateien\', werden Sie in das Quarantäne-Verzeichnis verschoben oder gelöscht. Wenn Sie wählen \'Behandle die Dateien als ok\' werden sie normal ohne Prüfung hochgeladen. In jedem Fall werden Admins benachrichtigt, dass ein Problem aufgetreten ist. Seien Sie mit dieser Einstellung sehr vorsichtig.';
$string['configcountry'] = 'Wenn Sie hier ein Land einstellen, wird dieses Land als Vorgabe für neue Zugänge gewählt.  Wenn die Nutzer/innen ein Land aktiv wählen sollen, lassen Sie das Feld einfach leer.';
$string['configdbsessions'] = 'Diese Einstellung verwendet die Datenbank auch dazu Informationen über aktuelle Sitzungen abzuspeichern. Das ist sinnvoll bei sehr großen Anwendungen oder Anwendungen, die über mehrere Clustern von Servern verteilt arbeiten. Meist kann die Einstellung deaktiviert bleiben. Bei einer Änderung der Einstellung werden alle aktuellen Nutzer/innen ausgeloggt. Das gilt auch für Administrator/innen';
$string['configdebug'] = 'Wenn Sie dies einschalten, werden die Fehlermeldungen von PHP erweitert, so dass mehr Warnungen ausgegeben werden. Dies ist nur nützlich für Entwickler.';
$string['configdeleteunconfirmed'] = 'Wenn Sie die Authentifikation per E-Mail verwenden, geben Sie hier den Zeitraum an, innerhalb dessen die Nutzer ihre Registrierung bestätigen müssen. Unbestätigte Zugänge verfallen danach und werden gelöscht.';
$string['configdenyemailaddresses'] = 'Definieren Sie hier Domains von denen keine E-Mail-Adressen akzeptiert werden. z.B. <strong>hotmail.com yahoo.de</strong>.';
$string['configdigestmailtime'] = 'Personen, die E-Mails als Digest (Zusammenfassung) eingerichtet haben, erhalten diese Zusammenfassung einmal täglich. Mit dieser Einstellung legen Sie fest zu welchem Zeitpunkt. Beim darauf folgenden Cron-Aufruf werden die Zusammenfassungen mit versandt.';
$string['configdisplayloginfailures'] = 'Anzeige von Informationen über frühere gescheiterte Logins der ausgewählten Nutzer.';
$string['configenablerssfeeds'] = 'Diese Einstellung aktiviert RSS-Feeds für die gesamte Seite. Es ist zusätzlich erforderlich, RSS-Feeds in den einzelnen Modulen zu aktivieren. Gehen Sie dazu zu den Modul-Einstellungen in der Administration.';
$string['configenablerssfeedsdisabled'] = 'Diese Option ist nicht verfügbar, weil die RSS-Feeds für alle Seiten deaktiviert sind.  Um diese zu aktivieren, gehen sie zu den Variablen in der Administration.';
$string['configerrorlevel'] = 'Wählen Sie die Menge der PHP-Warnungen, die Sie angezeigt bekommen möchten. \'Normal\' ist meist eine gute Wahl.';
$string['configextendedusernamechars'] = 'Aktivieren Sie diese Einstellung, damit jedes Zeichen im Nutzernamen zulässig ist (Dies beeinflusst bereits vorhandene Namen nicht). In der Grundeinstellung sind nur alphanumerische Zeichen zulässig.';
$string['configfilterall'] = 'Filter über alle Begriffe, inkl. Überschriften, Titel, Navigationselemente, etc.) Dies kann im Zusammenhang mit dem Multilang-Filter nützlich sein. Es belastet den Server jedoch stark und kann zu einer Reduzierung der Arbeitsgeschwindigkeit führen.';
$string['configfilteruploadedfiles'] = 'Beim Aktivieren dieser Option werden alle hochgeladenen HTML- und Textdateien über den Filter bearbeitet, bevor sie angezeigt werden.';
$string['configforcelogin'] = 'Normalerweise können die Startseite und die Kursübersicht (nicht jedoch die Kurse) eingesehen werden, ohne sich einzuloggen. Aktivieren Sie diese Option, wenn ein Login zwingend sein soll, um IRGENDETWAS auf dieser Site ausführen zu können.';
$string['configforceloginforprofiles'] = 'Wenn Sie diese Einstellung aktivieren, müssen Teilnehmer/innen sich erst anmelden, um die Profile der Trainer/innen einsehen zu können. In der Grundeinstellung (\'Nein\') können die Teilnehmer/innen sich vor der Anmeldung zum Kurs über die Trainer/innen informieren. Zugleich können aber auch Suchmaschinen auf diese Profile zugreifen.';
$string['configframename'] = 'Sofern Sie Moodle innerhalb eines Frames einbinden, tragen Sie hier den Namen des Frames ein. Anderenfalls sollte dieser Wert auf \'_top\' stehen.';
$string['configfullnamedisplay'] = 'Hier können Sie festlegen, wie Namen in Ihrer Vollform angezeigt werden. In den meisten Fällen wird die Grundeinstellung \"Vorname + Nachname\" geeignet sein. Sie können jedoch auch die Nachnamen ausblenden, ganz nach Ihren Konventionen.';
$string['configgdversion'] = 'Zeigt Ihnen die installierte Version von GD an. Die angezeigte Version wurde automatisch ermittelt. Ändern Sie diese nicht, es sei denn Sie wissen wirklich, was Sie tun. ';
$string['confightmleditor'] = 'Wählen Sie aus, ob Sie die Verwendung des Text-Editors prinzipiell zulassen möchten. Der Editor ist allerdings auf kompatible Browser angewiesen, sonst bleibt er unsichtbar. Die Nutzer können die Verwendung auch individuell ablehnen.';
$string['configidnumber'] = 'Diese Option legt fest, ob (a) Nutzer nicht nach einer ID Nummer gefragt werden, (b) Nutzer zwar nach einer ID Nummer gefragt werden, das Feld aber leer lassen können oder (c) Nutzer nach einer ID Nummer gefragt werden und dieses Feld nicht leer lassen können. Die ID Nummer des Nutzers wird in seinem Profil angezeigt.';
$string['configintro'] = 'Auf dieser Seite können Sie eine Anzahl von Konfigurations-Variablen spezifizieren, die Ihnen helfen, dass Moodle auf Ihrem Server zuverlässig arbeitet. Sorgen Sie sich nicht großartig - die Standard-Einstellungen funktionieren normalerweise sehr gut. Sie können jederzeit auf diese Seite zurückkommen und Einstellungen ändern.';
$string['configintroadmin'] = 'Auf dieser Seite sollten Sie den/die Hauptadminstrator/in einrichten, der/die die vollständige Kontrolle über die Site hat. Achten Sie darauf, hier einen sicheren Benutzernamen samt Passwort sowie eine gültige E-Mail-Adresse anzugeben. Weitere Administrator/innen können Sie später festlegen.';
$string['configintrosite'] = 'Diese Seite erlaubt es Ihnen, die Startseite und den Namen der neuen Site einzurichten. Sie können später über die Startseite (Konfiguration > Seiteneinstellungen) hierher zurückkehren und die Einstellungen jederzeit bearbeiten.';
$string['configintrotimezones'] = 'Diese Seite sucht nach neuen Einstellungen für Zeitzonen, inkl. neue Regelungen für die Sommerzeit, und aktualisiert die Datenbank. Dabei werden die Orte geprüft: $a. Der Vorgang ist normalerweise sehr sicher und beeinträchtigt Ihre Installation nicht. Wollen Sie die Zeitzonen nun aktualisieren?';
$string['configlang'] = 'Wählen Sie die Standard-Sprache für die gesamte Seite. Die Benutzer können diese später überschreiben.';
$string['configlangcache'] = 'Speichern der Sprachmenus. Spart eine Menge an Speicher und Prozessleistung. Mit der Aktivierung dauert es ein paar Minuten zur Aktualisierung, wenn Sprachen gelöscht oder hinzugefügt wurden.';
$string['configlangdir'] = 'In den meisten Sprachen schreibt man von links nach rechts, aber in einigen anderen, wie Arabisch oder Hebräisch, schreibt man von rechts nach links.';
$string['configlanglist'] = 'Lassen Sie dieses Feld leer, um allen Nutzern zu erlauben, aus jeder installierten Sprache auszuwählen. Sie können das Sprachmenü verkürzen, indem Sie eine durch Kommas getrennte Liste der Spachcodes angeben, die Sie für die Auswahl möchten. z.B. en,es_es,fr,it.';
$string['configlangmenu'] = 'Wählen Sie aus, ob Sie generell das Sprach-Auswahlmenü haben möchten, etwa auf Ihrer Startseite, auf der Anmeldungsseite usw. Dies betrifft nicht die Möglichkeit des Nutzers, seine bevorzugte Sprache in seinem Profil einzustellen.';
$string['configlocale'] = 'Wählen Sie eine für die gesamte Seite gültige Region (Zeitzone) - diese wird die Anzeige jedes Datums beeinflussen. Sie müssen die Daten dieser Region auf Ihrem Betriebssystem installiert haben. Sofern Sie nicht wissen, was Sie auswählen sollen, lassen Sie dieses Feld leer.';
$string['configloginhttps'] = 'Wenn Sie diese Einstellung aktivieren wird eine sichere https-Verbindung für den login-Prozess genutzt. Danach wird eine normale http Verbindung genutzt.
ACHTUNG: Die Einstellung erfordert eine gesonderte Aktivierung von https auf dem Server. Wenn diese NICHT besteht, können Sie sich selber vom Zugriff zur Seite ausschließen!!!';
$string['configloglifetime'] = 'Dies definiert die Zeitdauer, für die die Statistiken der Nutzer-Aktivitäten gespeichert werden. Ältere Statistiken werden automatisch gelöscht. Speichern Sie diese Daten nur so lange, wie sie unbedingt benötigt werden. Wenn Sie einen ausgelasteten Server haben und Geschwindigkeitseinbrüche feststellen, sollten Sie den Statistik-Zeitraum reduzieren.';
$string['configlongtimenosee'] = 'Wenn sich Teilnehmer/innen nach einer sehr langen Zeit nicht mehr angemeldet haben, werden Sie automatisch nach dieser Zeit aus dem Kurs ausgetragen.';
$string['configmaxbytes'] = 'Dieser Wert legt für die gesamte Site die maximale Größe für das Hochladen von Dateien fest. Der Eintrag wird begrenzt durch die PHP-Einstellung \'upload_max_filesize\' und die Apache-Einstellung \'LimitRequestBody\'. Diese Rahmeneinstellung begrenzt also auch die maximal wählbare Größe auf Kurs- oder Modulebene.';
$string['configmaxeditingtime'] = 'Hier bestimmen Sie die Zeitspanne, in der die Teilnehmer/innen die Foren-Beiträge, Glossar-Kommentare usw. erneut bearbeiten dürfen. Normalerweise sind 30 Minuten ein guter Wert. ';
$string['configmessaging'] = 'Soll das Messaging-System zwischen Nutzer/innen aktiviert werden?';
$string['confignoreplyaddress'] = 'Tragen Sie hier die E-Mail-Adresse ein, die als Absender beim Versand von Nachrichten (z.B. aus Foren) genutzt werden soll, wenn die E-Mail-Adresse des Trainers nicht für Rückantworten genutzt werden kann.';
$string['confignotifyloginfailures'] = 'E-Mail-Benachrichtigungen können versandt werden, wenn Login-Fehler aufgezeichnet wurden. Wer sollte die Nachrichten sehen?';
$string['confignotifyloginthreshold'] = 'Nach wie vielen gescheiterten Anmeldeversuchen soll eine Benachrichtigung erfolgen (nur wenn diese auch aufgezeichnet werden)?';
$string['configopentogoogle'] = 'Wenn Sie diese Option aktivieren, wird Google erlaubt, Ihre Seite als Gast zu besuchen. Außerdem werden Besucher, die über einen Link von Google kommen, automatisch als \'Gäste\' eingeloggt. Dies gilt natürlich nur für Kurse, die Gäste ohne Schlüssel zulassen.';
$string['configpathtoclam'] = 'Pfad für ClamAV. Zumeist /usr/bon/clamscan oder user/bin/clamdscan. Die Einstellung ist erforderlich, damit ClamAV gefunden wird.';
$string['configproxyhost'] = 'Wenn dieser <b>Server</b> einen Proxy braucht (z.B. eine Firewall), um Internetzugriff zu bekommen, dann tragen Sie hier den Namen und den Port des Proxys ein. Anderenfalls lassen sie das Feld leer.';
$string['configquarantinedir'] = 'Wenn ClamAV infizierte Dateien in ein Quarantäne-Verzeichnis verschieben soll, definieren Sie das Verzeichnis hier. Wenn Sie den Eintrag leer lassen, das Verzeichnis ungültig ist oder nicht beschrieben werden kann, werden infizierte Dateien gelöscht. Tragen Sie keinen Slash am Ende ein.';
$string['configrunclamonupload'] = 'ClamAV für hochgeladene Dateien nutzen? Sie müssen zusätzlich einen Pfad zu ClamAV in pathtoclam eintragen. ClamAV ist ein freier Virenscanner. http://www.clamav.net';
$string['configsectioninterface'] = 'Gestaltung';
$string['configsectionmail'] = 'E-Mail';
$string['configsectionmaintenance'] = 'Wartung';
$string['configsectionmisc'] = 'Verschiedenes';
$string['configsectionoperatingsystem'] = 'Arbeitsweise';
$string['configsectionpermissions'] = 'Rechte';
$string['configsectionsecurity'] = 'Sicherheit';
$string['configsectionuser'] = 'Nutzer/innen';
$string['configsecureforms'] = 'Moodle kann einen zusätzlichen Grad an Sicherheit verwenden, wenn es Daten von Web-Formularen erhält. Sofern dies eingeschaltet ist, dann wird die Variable HTTP_REFERER gegen
die Adresse des aktuellen Formulars geprüft.
In einigen wenigen Fällen kann das Probleme verursachen, wenn der Nutzer eine Firewall benutzt (z.B. Zonealarm), die so konfiguriert ist, dass der HTTP_REFERER nicht mitgesendet wird.
Das Ergebnis ist, dass Sie bei einem Formular nicht weiterkommen.
Sofern Nutzer z.B. Probleme mit der Zugangsseite haben, sollten Sie diese Einstellung deaktivieren, so ist Ihre Seite allerdings offener für Brute-Force-Attacken. Im Zweifelsfall, belassen Sie es auf \'ja\'.';
$string['configsessioncookie'] = 'Diese Einstellung legt den Namen des Cookies, der für Moodle-Zugriffe benutzt wird fest. Dieser Eintrag ist optional und nur sinnvoll, um zu verhindern das mehrere Cookies sich überlagern. Dies kann der Fall sein, wenn mehrere Moodle-Systeme auf der gleichen Webseite installiert sind. ';
$string['configsessiontimeout'] = 'Wenn eingeloggte Benutzer länger keine Aktionen ausführen (Seiten laden), werden sie automatisch ausgeloggt. Diese Variable legt die betreffende Zeitspanne fest.';
$string['configshowblocksonmodpages'] = 'Einige Lernaktivitäten erlauben, die Nutzung von Blöcken innerhalb der Aktivität. Mit dieser Einstellung ermöglichen Sie den Trainer/innen auf der Kursseite diese Blöcke in die Lernaktivität einzufügen. Andernfalls steht diese Option nicht zur Verfügung.';
$string['configshowsiteparticipantslist'] = 'Alle auf dieser Seite angezeigten Teilnehmer/innen und Trainer/innen werden in der Teilnehmer/innen-Liste aufgeführt. Wer soll die Teilnehmerliste einsehen dürfen?';
$string['configsitepolicy'] = 'Wenn Sie eine Zustimmungserklärung verwenden, die alle Nutzer/innen bei der Nutzung akzeptieren müssen, können Sie hier die URL für diese Seite festlegen. Dies kann z.B. im Verzeichnis der Startseite sein. z.B. http://IhreDomain.de/file.php/1/zustimmung.html';
$string['configslasharguments'] = 'Dateien (Bilder, Dokumente usw.) können über ein Skript, das \'Slash-Argumente\' benutzt (zweite Option) einfacher in Internet-Browsern, Proxy-Servern usw. zwischengespeichert werden.
Leider erlauben nicht alle PHP-Server diese Methode, so dass Sie, sofern Sie Probleme bei der Anzeige von Dateien oder Bildern (beispielsweise den Benutzer-Fotos) haben, diese Variable auf die erste Option stellen müssen. ';
$string['configsmtphosts'] = 'Geben Sie hier den vollen Namen von einem oder mehreren lokalen SMTP-Servern an, die Moodle für den E-Mail-Versand benutzen soll (beispielsweise \'E-Mail.a.de\' oder \'E-Mail.a.de;E-Mail.b.de\'). Wenn Sie dieses frei lassen, wird Moodle die Standard-Methode von PHP zum Senden von E-Mails verwenden.';
$string['configsmtpuser'] = 'Sofern Sie einen SMTP-Server angegeben haben und der Server Zugangsdaten erfordert, dann geben Sie hier Benutzernamen und Passwort an.';
$string['configteacherassignteachers'] = 'Sollen Trainer/innen ihren Kursen selbst weitere Kolleg/innen zuordnen können? Falls \'Nein\', können nur Kursersteller/innen und Administrator/innen den Kursen Trainer/innen zuordnen.';
$string['configthemelist'] = 'Wenn das Feld leer bleibt kann jedes Theme ausgewählt werden. Wenn das Auswahlmenü für Themes verkürzt werden soll, können Sie hier die auswählbaren Themes eintragen, Trennen Sie die Namen der Themes mit Kommas; z.B.: standard,orangewhite. Achten Sie darauf den Wortzwischenraum nicht zu benutzen.';
$string['configtimezone'] = 'Stellen Sie hier die bevorzugte Zeitzone ein. Sie steuert die Zeitanzeige in Ihren Kursen. Jeder Teilnehmer kann selbst in seinem Profil eine eigene Zeitzone einstellen und damit Ihre Voreinstellung für sich aufheben. Die Einstellung \"Serverzeit\"  verwendet hier die Zeiteinstellung Ihres Internetservers. Die Einstellung \"Serverzeit\" im Nutzerprofil hingegen greift auf die Einstellung Ihres Moodle-Programms an dieser Stelle zurück.';
$string['configunzip'] = 'Geben Sie hier den Pfad zum Programm unzip an (Nur Unix). Dieser wird für das Entpacken von ZIP-Archiven auf dem Server benötigt.';
$string['configvariables'] = 'Variablen konfigurieren';
$string['configwarning'] = 'Vorsicht bei der Veränderung dieser Einstellungen, ungeeignete Werte können zu Problemen führen.';
$string['configzip'] = 'Geben Sie hier den Pfad zum Programm zip an (nur Unix). Dieser wird für die Erstellung ZIP-Archiven auf dem Server benötigt.';
$string['confirmation'] = 'Bestätigung';
$string['cronwarning'] = 'Das <a href=\"cron.php\">Cron-Skript</a> wurde in den letzten 24 Stunden nicht ausgeführt. <br />Die  <a href=\"../doc/?frame=install.html#cron\" >Installationsdokumentation</a> erläutert, wie Sie diesen Vorgang automatisieren können.';
$string['edithelpdocs'] = 'Hilfedateien bearbeiten';
$string['editstrings'] = 'Menütexte bearbeiten';
$string['filterall'] = 'Alle Begriffe filtern';
$string['filteruploadedfiles'] = 'Filter für hochgeladene Dateien';
$string['helpadminseesall'] = 'Sollen Administrator/innen alle  Kalendereinträge sehen oder nur die, die sie betreffen?';
$string['helpcalendarsettings'] = 'Konfiguration verschiedener Kalender und datums- und zeitbezogener Einstellungen';
$string['helpforcetimezone'] = 'Sie können Nutzer/innen erlauben, eine eigene Zeitzone einzustellen oder die verwendete Zeitzone fest definieren.';
$string['helpsitemaintenance'] = 'Für Upgrades und andere Arbeiten am System';
$string['helpstartofweek'] = 'An welchem Tag soll die Woche im Kalender beginnen?';
$string['helpupcominglookahead'] = 'Wie viele Tage im voraus sollen künftige Termine gesucht werden?';
$string['helpupcomingmaxevents'] = 'Wie viele Termine sollen maximal als künftige Termine angezeigt werden?';
$string['helpweekenddays'] = 'Welche Tage der Woche sollen als Wochenende farbig hervorgehoben werden?';
$string['importtimezones'] = 'Update der Zeitzonenliste';
$string['importtimezonescount'] = '$a->count Einträge importiert von $a->source';
$string['importtimezonesfailed'] = 'Keine Daten gefunden! (schlechte Nachricht)';
$string['incompatibleblocks'] = 'Inkompatible Blöcke';
$string['optionalmaintenancemessage'] = 'Optionale Wartungsinformation';
$string['pleaseregister'] = 'Registrieren Sie Ihre Seite, um diesen Button zu entfernen';
$string['sitemaintenance'] = 'Die Seite wird zur Zeit überarbeitet und steht für kurze Zeit nicht zur Verfügung.';
$string['sitemaintenancemode'] = 'Wartungsmodus';
$string['sitemaintenanceoff'] = 'Der Wartungsmodus wurde wieder abgeschaltet. Die Seite steht wieder zur Verfügung.';
$string['sitemaintenanceon'] = 'Die Seite befindet sich zur Zeit im Wartungsmodus. Nur Administator/innen können die Seite nutzen.';
$string['sitemaintenancewarning'] = 'Die Seite befindet sich zur Zeit im Wartungsmodus. Nur Administator/innen können sie nutzen und sich einloggen. Um in den Normalmodus zurückzukehren, klicken Sie auf <a href=\"maintenance.php\">Wartungsmodus abschalten</a>.';
$string['tabselectedtofront'] = 'Tabellen mit Tabulatoren: soll die Reihe mit dem aktiven Tabulator im Vordergrund platziert werden?';
$string['therewereerrors'] = 'Es geht Fehler in Ihren Daten';
$string['timezoneforced'] = 'Dies wurde durch die Administration festgelegt.';
$string['timezoneisforcedto'] = 'Für alle Nutzer/innen festlegen.';
$string['timezonenotforced'] = 'Nutzer/innen können eine eigene Zeitzone auswählen.';
$string['upgradeforumread'] = 'In der Version 1.5 können Sie Forenbeiträge als gelesen/ungelesen markieren.<br />Für diese Funktion müssen die Datenbanktabellen aktualisiert werden. <a href=\"$a\">Tabellen jetzt aktualisieren</a>.';
$string['upgradeforumreadinfo'] = 'Mit einer neuen Funktion in Moodle 1.5 können Forenbeiträge als gelesen/ungelesen markiert werden. Um diese Funktion zu verwenden, müssen die Datenbanktabellen aktualisiert werden. Je nach Größe der Datenbank kann dieser Vorgang längere Zeit (Stunden) erfordern. Führen Sie diesen Vorgang am besten in Zeiten mit wenigen Zugriffen aus. Die Seite funktioniert während der Umstellung weiter. Die Nutzer/innen bemerken davon nichts. Wenn Sie den Vorgang einmal gestartet haben, darf er nicht unterbrochen werden. Lassen Sie das Browserfenster dabei offen. Sollten Sie das Browser-Fenster versehentlich schließen, können Sie den Prozess neu starten. <br />Wollen Sie nun starten?';
$string['upgradelogs'] = 'Für die vollständige Funktionsfähigkeit müssen die alten Log-Daten aktualisiert werden. <a href=\"$a\">Weitere Information</a>';
$string['upgradelogsinfo'] = 'Die Art und Weise, in der Log-Daten gespeichert werden, wurde verändert. Damit Sie Ihre alten Log-Daten mit den Einzelaktivitäten einsehen können, müssen die alten Log-Daten aktualisiert werden. Je nachdem wie viele Daten auf Ihrer Seite gespeichert sind, kann dieser Vorgang eine längere Zeit beanspruchen (u.U. mehrere Stunden). Der Vorgang beansprucht die Datenbank bei umfangreichen Seiten stark. Wenn Sie den Vorgang einmal gestartet haben, müssen Sie ihn ohne Unterbrechung abschließen lassen. Das Browserfenster darf in dieser Zeit nicht geschlossen und die Internetverbindung nicht unterbrochen werden. Der Zugriff auf Ihre Seite durch andere Anwender ist dadurch nicht beeinträchtigt. <br /><br />Wollen Sie nun Ihre Log-Daten aktualisieren?';
$string['upgradesure'] = 'Moodle-Dateien wurden verändert. Ihre Installation von moodle wird auf die Version $a aktualisiert.
<p>Wenn Sie dies tun, können Sie nicht zu einer früheren Version zurückkehren.</p>
<p>Sind Sie sicher, dass Sie das Update ausführen wollen?</p>';
$string['upgradingdata'] = 'Daten aktualisieren';
$string['upgradinglogs'] = 'Log-Daten aktualisieren';

?>

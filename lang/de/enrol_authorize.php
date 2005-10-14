<?PHP // $Id$ 
      // enrol_authorize.php - created with Moodle 1.6 development (2005090100)


$string['adminreview'] = 'Zahlung �berpr�fen bevor Kreditkarte akzeptiert wird';
$string['anlogin'] = 'Authorize.net: Loginname';
$string['anpassword'] = 'Authorize.net: Passwort (nicht erforderlich)';
$string['anreferer'] = 'Tragen Sie hier die URL ein wenn Sie dies in Ihrem authorize.net account eintragen. Damit wird eine \"Referer:URL\" in der Webanfrage erstellt.';
$string['antestmode'] = 'Authorize.net: Test Transaktionen';
$string['antrankey'] = 'Authorize.net: Transaktionskey';
$string['ccexpire'] = 'Verfallsdatum';
$string['ccexpired'] = 'Die Kreditkarte ist abgelaufen';
$string['ccinvalid'] = 'Ung�ltige Kartennummer';
$string['ccno'] = 'Kreditkartennummer';
$string['cctype'] = 'Kreditkartentyp';
$string['ccvv'] = 'Kreditkarten �berpr�fung';
$string['ccvvhelp'] = 'Schauen Sie auf der Kartenr�ckseite nach (letzte drei Zeichen)';
$string['choosemethod'] = 'Wenn Sie den Zugangsschl�ssel kennen, tragen Sie ihn hier ein. Im anderen Fall m�ssen Sie erst die Kursgeb�hren entrichten.';
$string['chooseone'] = 'F�llen Sie eines oder beide Felder aus';
$string['description'] = 'Das Authorize.net Modul erlaubt Kursgeb�hren �ber Kreditkarten abzurechnen. Wenn der Betrag f�r einen Kurs auf \'0\' gesetzt wird, wird die Geb�hrenabfrage nicht gestartet. Sie k�nnen hier einen seitenweit g�ltigen Betrag einsetzen, der als Grundbetrag f�r jeden Kurs voreingestellt ist. Diese Einstellung kann in den Kurseinstellungen �berschrieben werden.';
$string['enrolname'] = 'Authorize.net Kreditkartenabrechnung';
$string['httpsrequired'] = 'Ihre Anfrage kann leider zur Zeit nicht bearbeitet werden. Die Konfiguration der Seite weist einen Fehler auf. <br /><br />
Geben Sie Ihre Kreditkartennummer solange nicht ein bis Sie ein gelbes Schlo� am Fu� des Browsers sehen k�nnen. Es signalisiert eine einfache Verschl�sselung f�r die �bermittlung aller Daten zwischen Ihrem Rechner und dem Server. Damit wird die Daten�bertragung gesch�tzt und Ihre Kreditkartendaten k�nnen nichtin falsche H�nde geraten.';
$string['logindesc'] = 'Sie k�nnen in den Optionen (Variables/Security) eine sichere <a href=\"$a->url\">Https Verbindung</a> ausw�hlen.
<br /><br />
Ist diese Variable gesetzt, wird Moodle f�r die Login- und Zahlungsseite eine sichere https Verbindung aufbauen.';
$string['nameoncard'] = 'Name auf den die Karte ausgestellt ist';
$string['reviewday'] = 'Bewahren der Kreditkarte automatisch f�r <b>$a </b> Tage bis ein/e Trainer/in oder ein/e Administrator/in die Zahlung gepr�ft hat. CronJobs m�ssen hierf�r aktiv sein.<br/>Wert 0 Tage = Funktion deaktiviert<br/>autocapture = Trainer/in, Admin pr�ft manuell.<br/>Transaktion wird gel�scht wenn autocapture deaktiviert wird oder innerhalb von 30 Tagen keine Pr�fung erfolgt ist.';
$string['reviewnotify'] = 'Ihre Zahlung wird gepr�ft. Sie erhalten eine E-Mailnachricht von Ihrer/m Trainer/in in einigen Tagen.';
$string['sendpaymentbutton'] = 'Zahlung �bertragen';
$string['zipcode'] = 'ZIp Code';

?>

<?PHP // $Id$ 
      // enrol_authorize.php - created with Moodle 1.6 development (2005081700)


$string['adminreview'] = 'Rendel�s ellen�rz�se a hitelk�rtya haszn�lata el�tt.';
$string['anlogin'] = 'Authorize.net: felhaszn�l�n�v';
$string['anpassword'] = 'Authorize.net: jelsz� (nem sz�ks�ges)';
$string['anreferer'] = 'Adja meg itt az URL-hivatkoz�st, ha ezt be�ll�tja az authorize.net fi�kj�ban. Ezzel a weboldalk�r�sben egy \"Referer: URL\" fejl�c tov�bb�t�dik.';
$string['antestmode'] = 'Authorize.net: �gyletek ellen�rz�se';
$string['antrankey'] = 'Authorize.net: �gyletkulcs';
$string['ccexpire'] = 'Lej�rat d�tuma';
$string['ccexpired'] = 'A hitelk�rtya lej�rt';
$string['ccinvalid'] = '�rv�nytelen k�rtyasz�m';
$string['ccno'] = 'Hitelk�rtyasz�m';
$string['cctype'] = 'Hitelk�rtyat�pus';
$string['ccvv'] = 'K�rtyaellen�rz�s';
$string['ccvvhelp'] = 'L�sd a k�rtya t�loldal�n (3 sz�mjegy)';
$string['choosemethod'] = 'Adja meg a kurzus beiratkoz�si k�dj�t, ha ismeri; ellenkez� esetben fizetnie kell a kurzus elv�gz�s��rt.';
$string['chooseone'] = 'Az al�bbi k�t mez�t vagy az egyiket t�ltse ki';
$string['description'] = 'Az Authorize.net modullal forgalmaz�k t�r�t�ses kurzusai hozhat�k l�tre. Ha valamely kurzus �ra nulla, a tanul�knak nem kell fizetni a bel�p�shez. Itt adhat� meg a port�lra glob�lisan �rv�nyes k�lts�g, valamint az egyes kurzusokhoz egyenk�nt be�ll�that� k�lts�g. A kurzusk�lts�g fel�l�rja a port�lk�lts�get.';
$string['enrolname'] = 'Authorize.net: hitelk�rtyakapu';
$string['httpsrequired'] = 'Sajnos k�r�s�t jelenleg nem tudjuk feldolgozni. A port�lt nem lehetett megfelel� m�don be�ll�tani.<br /><br />
Ne adja meg a hitelk�rtyasz�m�t, ha a b�ng�sz� alj�n nem jelenik meg egy s�rga lakat. Ez azt jelzi, hogy az �gyf�l �s a kiszolg�l� k�z�tt minden adat tov�bb�t�sa k�doltan t�rt�nik. �gy a 2 sz�m�t�g�p k�z�tti kapcsolat adatforgalma v�dve van �s hitelk�rty�ja sz�m�t nem lehet interneten kereszt�l levenni.';
$string['logindesc'] = 'Ezt az opci�t be kell kapcsolni. <br /><br /> A V�ltoz�k/Biztons�g r�szben be�ll�that egy <a href=\"$a->url\">loginhttps</a> opci�t. <br /><br />
Ennek bekapcsol�sakor a Moodle csak a bejelentkez�si �s fizet�si oldalakon haszn�l biztons�gos https-csatlakoz�st.';
$string['nameoncard'] = 'K�rty�n szerepl� n�v';
$string['reviewday'] = 'Automatikusan terhelje meg a hitelk�rty�t, ha egy tan�r vagy egy rendszergazda  <b>$a</b> napon bel�l nem vizsg�lja fel�l a rendel�st. A CRON LEGYEN BEKAPCSOLVA.<br />(0 nap = automatikus terhel�s kikapcsol�sa = tan�r, rendszergazda k�zi �ton fel�lvizsg�lja. Az �gylet t�rl�dik, ha kikapcsolja az automatikus terhel�st, vagy ha 30 napon bel�l fel�lvizsg�lja.)';
$string['reviewnotify'] = 'Fizet�s�t ellen�rizz�k. N�h�ny napon bel�l e-mail �zenetet kap a tan�r�t�l.';
$string['sendpaymentbutton'] = 'P�nz k�ld�se';
$string['zipcode'] = 'Ir�ny�t�sz�m';

?>

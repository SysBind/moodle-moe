<?PHP // $Id$ 
      // enrol_authorize.php - created with Moodle 1.6 development (2005101200)


$string['adminauthorizeccapture'] = 'Sipari�i �nceleme ve Otomatik-�ekme Ayarlar�';
$string['adminauthorizeemail'] = 'Email G�nderme Ayarlar�';
$string['adminauthorizesettings'] = 'Authorize.net Ayarlar�';
$string['adminauthorizewide'] = 'Site Geneli Ayarlar�';
$string['adminneworder'] = 'De�erli Y�netici,

Yeni bir bekleyen sipari� ald�n�z:

Sipari� no: $a->orderid
��lem ID: $a->transid
Kullan�c�: $a->user
Kurs: $a->course
Miktar: $a->amount

OTOMAT�K-�EKME ETK�N M�?: $a->acstatus

Otomatik �ekme etkinse kredi kart�ndan $a->captureon tarihinde �ekilecek ve ��rencinin derse kayd� yap�lacak. Di�er durumda $a->expireon tarihinde s�resi dolacak ve bu tarihten sonra �ekilemeyecek.

Ayr�ca a�a��daki linki t�klayarak �demeyi derhal kabul veya reddedebilir ve ��renciyi derse kaydedebilirsiniz:
$a->url';
$string['adminnewordersubject'] = '$a->course: Bekleyen Yeni Sipari�($a->orderid)';
$string['adminreview'] = 'Kredi kart�ndan �ekmeden �nce sipari�i incele.';
$string['amount'] = 'Miktar';
$string['anlogin'] = 'Authorize.net: Kullan�c� ad�';
$string['anpassword'] = 'Authorize.net: �ifre';
$string['anreferer'] = 'Authorize.net hesab�n�zda URL referer ayar� yapt�ysan�z buraya yaz�n�z. Bu, web iste�inde \"Referer: URL\" ba�l���n� g�nderir.';
$string['antestmode'] = '��lemleri deneme modunda �al��t�r (para �ekilmez)';
$string['antrankey'] = 'Authorize.net: ��lem Anahtar� (Transaction Key)';
$string['authorizedpendingcapture'] = 'Onaylanm�� / �ekilmeyi Bekliyor';
$string['canbecredit'] = '$a->upto\'a kadar geri �denebilir';
$string['cancelled'] = '�ptal edilmi�';
$string['capture'] = '�ek';
$string['capturedpendingsettle'] = '�ekilmi� / �deme Bekleniyor';
$string['capturedsettled'] = '�ekilmi� / �denmi�';
$string['capturetestwarn'] = '�ekme �al���yor olarak g�r�n�yor fakat deneme modunda kay�t g�ncellenmedi';
$string['captureyes'] = 'Para kredi kart�ndan �ekilecek ve ��rencinin derse kayd� yap�lacak. Emin misiniz?';
$string['ccexpire'] = 'Ge�erlilik Tarihi';
$string['ccexpired'] = 'Kredi kart�n�n s�resi ge�mi�';
$string['ccinvalid'] = 'Ge�ersiz kart numaras�';
$string['ccno'] = 'Kredi Kart� No';
$string['cctype'] = 'Kredi Kart� Tipi';
$string['ccvv'] = 'Onay Kodu';
$string['ccvvhelp'] = 'Kart�n arkas�na bak�n�z (son 3 rakam)';
$string['choosemethod'] = 'Kursun kay�t anahtar�n� biliyorsan�z giriniz. Di�er durumda bu kurs i�in �deme yapman�z gerekiyor.';
$string['chooseone'] = 'A�a��daki iki alandan birini veya ikisini doldurun';
$string['credittestwarn'] = 'Geri �deme �al���yor olarak g�r�n�yor fakat deneme modunda yeni kay�t eklenmedi';
$string['cutofftime'] = 'Hesap Kesim Zaman�. Hesap kesimi en son ne zaman yap�lacak?';
$string['description'] = 'Authorize.net mod�l� Kredi Kart� sa�lay�c�lar�yla �cretli kurslar ayarlaman�za olanak verir. Bir kursun �creti s�f�r ise ��rencilere �deme yapmalar� i�in bir istekte bulunulmaz. Sitenin geneli i�in ayarlayabilece�iniz varsay�lan bir tutar vard�r ve her bir dersin �cretini tek tek de ayarlayabilirsiniz. Kurs �creti ayarlan�rsa site genelindeki �cret yoksay�l�r..<br /><br /><b>Not:</b> Kurs ayarlar�nda kay�t anahtar�n� girdiyseniz ��renciler bu anahtara g�re de kay�t olma se�ene�ine sahip olabileceklerdir. Bu, ��recilerden baz�lar�n�n �deme yaparak baz�lar�n�n da kay�t anahtar�na g�re kay�t olmas�n� istiyorsan�z kullan��l�d�r.';
$string['enrolname'] = 'Authorize.net Kredi Kart� Sa�lay�c�s�';
$string['expired'] = 'S�resi dolmu�';
$string['howmuch'] = 'Ne kadar?';
$string['httpsrequired'] = '�zg�n�z, iste�inizi �u anda yerine getiremiyoruz. Bu sitenin ayar� do�ru yap�land�r�lmam��.
<br /><br />
Taray�c�n�z�n alt taraf�nda sar� bir kilit g�rm�yorsan�z kredi kart� numaran�z� girmeyiniz. Bu, sizinle sunucu aras�nda gidip gelen verinin �ifrelendi�i anlam�na gelir. B�ylece 2 bilgisayar aras�nda akan bilgi korunmu� olur ve kredi kart� numaran�z internet �zerinden yakalanamaz.';
$string['logindesc'] = 'Bu se�enek A�IK olmal�.
<br /><br />
<a href=\"$a->url\">Loginhttps</a> se�ene�ini De�i�kenler/G�venlik b�l�m�nden ayarlayabilirsiniz.
<br /><br />
Bu se�enek aktif ise sadece giri� ve �deme sayfalar� i�in g�venli ba�lant� (https) kullan�lacakt�r.';
$string['nameoncard'] = 'Kart �zerindeki �sim';
$string['noreturns'] = 'Geri �deme yok';
$string['notsettled'] = 'Faturaland�r�lmam��';
$string['orderid'] = 'Sipari� ID';
$string['paymentmanagement'] = '�deme Y�netimi';
$string['paymentpending'] = '$a->orderid numaral� �demeniz bu kurs i�in onay bekliyor.';
$string['refund'] = 'Geri �de';
$string['refunded'] = 'Geri �denmi�';
$string['returns'] = 'Geri �demeler';
$string['reviewday'] = '<b>$a</b> g�n i�inde e�itimci veya y�netici sipari�i incelemezse kredi kart�ndan otomatik olarak paray� �ek. CRON ETK�N OLMALI. <br /> (0 g�n otomatik �ekme aktif de�il anlam�na gelir ve ayn� zamanda e�itimci veya y�neticinin sipari�i kendisi inceleyece�ini zorunlu tutar. Otomatik �ekmeyi etinle�tirmezseniz veya 30 g�n i�inde sipari�i incelemezseniz i�lem iptal edilir.)';
$string['reviewnotify'] = '�demeniz incelenecek. Bir ka� g�n i�inde e�itimcinizden bir email bekleyin.';
$string['sendpaymentbutton'] = '�demeyi Yap';
$string['settled'] = 'Faturaland�r�lm��';
$string['settlementdate'] = 'Hesap Kesim Tarihi';
$string['subvoidyes'] = 'Geri �denen $a->transid nolu i�lem iptal edilecek ve hesab�n�za $a->amount y�klenecek. Emin misiniz?';
$string['tested'] = 'Denendi';
$string['testmode'] = '[DENEME MODU]';
$string['transid'] = '��lem ID';
$string['unenrolstudent'] = '��rencinin ders kayd�n� sil?';
$string['void'] = '�ptal et';
$string['voidtestwarn'] = '�ptal etme �al���yor olarak g�r�n�yor fakat deneme modunda kay�t g�ncellenmedi';
$string['voidyes'] = '��lem iptal edilecek. Emin misiniz?';
$string['zipcode'] = 'Posta Kodu';

?>

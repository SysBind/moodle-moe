<?PHP // $Id$ 
      // enrol_authorize.php - created with Moodle 1.5.2 (2005060220)


$string['adminreview'] = 'Revisar el orden antes de capturar la tarjeta de cr�dito.';
$string['anlogin'] = 'Authorize.net: Usuario';
$string['anpassword'] = 'Authorize.net: Contrase�a (no requerida)';
$string['anreferer'] = 'Defina el referente URL si ha seleccionado ese ajuste en su cuenta authorize.net. Esto enviar� una l�nea \"Referer: URL\" incrustada en la solicitud.';
$string['antestmode'] = 'Ejecutar las transacciones s�lo en modo de prueba (no se env�a dinero)';
$string['antrankey'] = 'Authorize.net: Clave de transacci�n';
$string['ccexpire'] = 'Fecha de expiraci�n';
$string['ccexpired'] = 'La tarjeta de cr�dito ha expirado';
$string['ccinvalid'] = 'N�mero de tarjeta no v�lido';
$string['ccno'] = 'N�mero de la tarjeta de cr�dito';
$string['cctype'] = 'Tipo de la tarjeta de cr�dito';
$string['ccvv'] = 'Verificaci�n de la tarjeta';
$string['ccvvhelp'] = 'Mire el reverso de la tarjeta (3 �ltimos d�gitos)';
$string['choosemethod'] = 'Si conoce la clave de matriculaci�n del curso, escr�bala; en caso contrario, necesitar� pagar por este curso.';
$string['chooseone'] = 'Rellene uno o ambos de los siguientes dos campos';
$string['description'] = 'El m�dulo Authorize.net permite planificar cursos de pago. Si el costo de un curso es cero, no se pedir� a los estudiantes que paguen. Existe un costo para todo el sitio que usted puede fijar aqu� como valor por defecto para el sitio completo y adem�s una opci�n que permite fijar el costo de cada curso. El costo del curso pasa por alto el costo del sitio.';
$string['enrolname'] = 'Puerta de Tarjeta de Cr�dito de Authorize.net';
$string['httpsrequired'] = 'Sentimos informarle que su petici�n no puede cursarse en este momento. La configuraci�n del sitio podr�a no ser correcta.
<br /><br />
Por favor, no escriba el n�mero de su tarjeta de cr�dito a menos que vea un candado amarillo en la parte inferior del navegador. Esto significa que se encriptar�n todos los datos entre el cliente y el servidor, de modo que la informaci�n durante la transacci�n entre dos ordenadores estar� protegida y nadie podr� capturar el n�mero de su tarjeta de cr�dito.';
$string['logindesc'] = 'Esta opci�n deber� estar ACTIVADA.
<br /><br />
Puede seleccionar la opci�n <a href=\"$a->url\">loginhttps</a> en la secci�n Variables/Seguridad.
<br /><br />
Al activarla, Moodle utilizar� una conexi�n https segura �nicamente para las p�ginas de acceso y pago.';
$string['nameoncard'] = 'Nombre que figura en la tarjeta';
$string['reviewday'] = 'Capturar la tarjeta de cr�dito autom�ticamente a menos que un profesor o administrador revise la orden en el plazo de <b>$a</b> d�as. EL CRON DEBE ESTAR ACTIVADO.<br />(0=disable=teacher,admin review it. La transacci�n ser� cancelada a menos que la revise en 30 d�as)';
$string['reviewnotify'] = 'Su pago ser� sometido a revisi�n. Espere un correo electr�nico de su profesor en los pr�ximos d�as.';
$string['sendpaymentbutton'] = 'Enviar pago';
$string['zipcode'] = 'C�digo postal';

?>

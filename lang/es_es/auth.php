<?PHP // $Id$ 
      // auth.php - created with Moodle 1.0.8.1 (2003011200)


$string['auth_dbdescription'] = "Este m�todo utiliza una tabla de una base de datos externa para comprobar si un determinado usuario y contrase�a son v�lidos. Si la cuenta es nueva, la informaci�n de otros campos puede tambi�n ser copiada en Moodle.";
$string['auth_dbextrafields'] = "Estos campos son opcionales. Usted puede elegir pre-rellenar algunos campos del usuario de Moodle con informaci�n de los <B>campos de la base de datos externa</B> que especifique aqu�. <P>Si deja esto en blanco, se tomar�n los valores por defecto.<P>En ambos casos, el usuario podr� editar todos estos campos despu�s de entrar.";
$string['auth_dbfieldpass'] = "Nombre del campo que contiene las contrase�as";
$string['auth_dbfielduser'] = "Nombre del campo que contiene los nombres de usuario";
$string['auth_dbhost'] = "El ordenador que hospeda el servidor de la base de datos.";
$string['auth_dbname'] = "Nombre de la base de datos";
$string['auth_dbpass'] = "Contrase�a correspondiente al usuario anterior";
$string['auth_dbpasstype'] = "Especifica el formato que usa el campo de contrase�a. La encriptaci�n MD5 es �til para conectar on otras aplicaciones web como PostNuke.";
$string['auth_dbtable'] = "Nombre de la tabla en la base de datos";
$string['auth_dbtitle'] = "Usar una base de datos externa";
$string['auth_dbtype'] = "El tipo de base de datos (Vea la <A HREF=../lib/adodb/readme.htm#drivers>ADOdb documentaci�n</A> para m�s detalles)";
$string['auth_dbuser'] = "Usuario con acceso de lectura a la base de datos";
$string['auth_emaildescription'] = "La confirmaci�n por correo alectr�nico es el m�todo de autenticaci�n predeterminado. Cuando el usuario se inscribe, escogiendo su propio nombre de usuario y contrase�a, un email de confirmaci�n es enviado a su direcci�n de correo electr�nico. Este email contiene un enlace seguro a una p�gina donde el usuario puede confirmar su cuenta. Las futuras entradas comprueban el nombre de usuario y contrase�a contra los valores guardados en la base de datos de Moodle.";
$string['auth_emailtitle'] = "Autenticaci�n basada en Email";
$string['auth_imapdescription'] = "Este m�todo usa un servidor IMAP para comprobar si el nombre de usuario y contrase�a son v�lidos.";
$string['auth_imaphost'] = "La direcci�n del servidor IMAP. Use el n�mero IP, no el nombre DNS.";
$string['auth_imapport'] = "N�mero del puerto del servidor IMAP. Normalmente es el 143 o 993.";
$string['auth_imaptitle'] = "Usar un servidor IMAP";
$string['auth_imaptype'] = "El tipo de servidor IMAP. Los servidores IMAP pueden tener diferentes tipos de autenticaci�n y negociaci�n.";
$string['auth_ldap_bind_dn'] = "Si quiere usar 'bind-user' para buscar usuarios, especif�quelo aqu�. Algo como 'cn=ldapuser,ou=public,o=org'";
$string['auth_ldap_bind_pw'] = "Contrase�a para bind-user.";
$string['auth_ldap_contexts'] = "Lista de contextos donde los usuarios son ubicados. Separar contetos diferentes con ';'. Por ejemplo: 'ou=usuarios,o=org; ou=otros,o=org'";
$string['auth_ldap_host_url'] = "Especificar el host LDAP en forma de URL como 'ldap://ldap.myorg.com/' o 'ldaps://ldap.myorg.com/' ";
$string['auth_ldap_search_sub'] = "Poner el valor &lt;&gt; 0 si quiere buscar usuarios de subcontextos.";
$string['auth_ldap_update_userinfo'] = "Actualizar informaci�n del usuario (nombre, apellido, direcci�n..) desde LDAP a Moodle. Mire en /auth/ldap/attr_mappings.php para informaci�n de mapeado";
$string['auth_ldap_user_attribute'] = "El atributo usado para nombrar/buscar usuarios. Normalmente 'cn'.";
$string['auth_ldapdescription'] = "Este m�todo proporciona autenticaci�n contra un servidor LDAP externo.

Si el nombre de usuario y contrase�a facilitados son v�lidos, Moodle crea una nueva entrada para el usuario en su base de datos. Este m�dulo puede leer atributos de usuario desde LDAP y prerrellenar los campos requeridos en Moodle. Para las entradas sucesivas s�lo se comprueba el usuario y la contrase�a.";
$string['auth_ldapextrafields'] = "Estos campos son opcionales. Usted puede elegir pre-rellenar algunos campos de usuario en Moodle con informaci�n de los <B>campos LDAP</B> que especifique aqu�. <P>Si deja estos campos en blanco, entonces no se transferir� nada desde LDAP y se usar� el sistema predeterminado en Moodle.<P>En ambos casos, los usuarios podr�n editar todos estos campos despu�s de entrar.";
$string['auth_ldaptitle'] = "Usar un servidor LDAP";
$string['auth_nntpdescription'] = "Este m�todo usa un servidor NNTP para comprobar si el nombre de usuario y contrase�a facilitados son v�lidos.";
$string['auth_nntphost'] = "La direcci�n del servidor NNTP. Usar el n�mero IP, no el nombre DNS.";
$string['auth_nntpport'] = "Puerto del Servidor (119 es el m�s habitual)";
$string['auth_nntptitle'] = "Usar un servidor NNTP";
$string['auth_nonedescription'] = "Los usuarios pueden suscribirse y crear cuentas v�lidas inmediatamente, sin autenticaci�n contra un servidor externo y sin confirmaci�n v�a email. Tenga cuidado al usar esta opci�n - piense en los problemas de seguridad y de administraci�n que puede ocasionar.";
$string['auth_nonetitle'] = "Sin autenticaci�n";
$string['auth_pop3description'] = "Este m�todo utiliza un servidor POP3 para comprobar si el nombre de usuario y contrase�a facilitados son v�lidos.";
$string['auth_pop3host'] = "La direcci�n del servidor POP3. Use el n�mero IP, no el nombre DNS.";
$string['auth_pop3port'] = "Puerto del Servidor (110 es el m�s habitual)";
$string['auth_pop3title'] = "Usar un servidor POP3";
$string['auth_pop3type'] = "Tipo de Servidor. Si su servidor utiliza certificado de seguridad, escoja pop3cert.";
$string['authenticationoptions'] = "Opciones de Autenticaci�n";
$string['authinstructions'] = "Aqu� puede proporcionar instrucciones a sus usuarios, de forma que sepan que usuario y contrase�a deben usar. El texto que incluya aqu� aparecer� en la p�gina de acceso. Si deja esto en blanco no aparecer�n ningunas instrucciones.";
$string['changepassword'] = "Cambiar contrase�a URL";
$string['changepasswordhelp'] = "Aqu� puede especificar donde pueden sus usuarios recuperar o cambiar sus nombre de usuario/contrase�a si los han olvidado. Para ello, aparecer� un bot�n en la p�gina de entrada. Si deja esto en blanco, este bot�n no se mostrar�.";
$string['chooseauthmethod'] = "Escoger un m�todo de autenticaci�n: ";
$string['guestloginbutton'] = "Bot�n de entrada para invitados";
$string['instructions'] = "Instrucciones";
$string['md5'] = "Encriptaci�n M5";
$string['plaintext'] = "Texto plano";
$string['showguestlogin'] = "Puede ocultar o mostrar el bot�n de entrada para invitados en la p�gina de acceso.";

?>

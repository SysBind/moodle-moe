<?PHP // $Id$ 
      // auth.php - created with Moodle 1.0.8 (2003010600)


$string['auth_dbdescription'] = "Este m�todo usa uma tabela de uma base de dados externa para verificar se a senha e o nome do usu�rio s�o v�lidos. Se a conta for nova, a informa��o de outros campos tamb�m deve ser copiada em Moodle.";
$string['auth_dbextrafields'] = "Estes campos s�o opcionais. Pode-se optar por preencher alguns dos campos do usu�rio em Moodle com informa��o de <b>campos da base de dados externa</b> especificados aqui.<p>Deixando estes campos em branco, ser�o usados valores predefinidos.<p>Nos dois casos, o usu�rio poder� editar todos estes campos quando tiver entrado no sistema.";
$string['auth_dbfieldpass'] = "Nome do campo que contem as senhas";
$string['auth_dbfielduser'] = "Nome do campo que contem os nomes de usu�rios";
$string['auth_dbhost'] = "Computador que hospeda o server da base de dados.";
$string['auth_dbname'] = "Nome da base de dados";
$string['auth_dbpass'] = "Senha correspondente ao usu�rio acima";
$string['auth_dbpasstype'] = "Indique o formato usado no campo de senhas. A codifica��o MD5 � �til na conex�o com outras aplica��es web comuns como PostNuke";
$string['auth_dbtable'] = "Nome da tabela na base de dados";
$string['auth_dbtitle'] = "Use uma base de dados externa";
$string['auth_dbtype'] = "O tipo de base de dados (veja <a href=\"../lib/adodb/readme.htm#drivers\"> Documenta��o do ADOdb</a> para mais detalhes)";
$string['auth_dbuser'] = "Nome de usu�rio com permiss�o de leitura da base de dados";
$string['auth_emaildescription'] = "Confirma��o via correio eletr�nico � o m�todo de autentica��o predefinido. Quando o usu�rio se inscrever, escolhendo o nome de usu�rio e a senha, enviada uma mensagem de confirma��o ser� enviada para o seu endere�o de correio eletr�nico. Essa mensagem contem um link seguro a uma p�gina onde o usu�rio deve confirmar a sua inscri��o. Em ingressos sucessivos, ser�o confrontados o nome de usu�rio e senha inseridos e os valores arquivados na base de dados de Moodle.";
$string['auth_emailtitle'] = "Autentica��o baseada no correio eletr�nico";
$string['auth_imapdescription'] = "Este m�todo usa um servidor IMAP para verificar se nome de usu�rio e senha s�o v�lidos.";
$string['auth_imaphost'] = "Endere�o do servidor IMAP. Use o N�MERO IP e n�o o nome DNS.";
$string['auth_imapport'] = "N�mero da porta do servidor IMAP. Geralmente � 143 ou 993.";
$string['auth_imaptitle'] = "Use um servidor IMAP";
$string['auth_imaptype'] = "Tipo de servidor IMAP. Os servidores IMAP podem usar diferentes m�todos de autentica��o e negocia��o.";
$string['auth_ldap_bind_dn'] = "Se quiser usar bind-user para procurar usu�rios, especifique-o aqui. Algo como 'cn=ldapuser,ou=public,o=org'";
$string['auth_ldap_bind_pw'] = "Senha para o bind-user.";
$string['auth_ldap_contexts'] = "Lista dos contextos onde os usu�rios s�o situados. Separe contextos diferentes com ';'. Por exemplo: 'ou=users,o=org; ou=others,o=org'";
$string['auth_ldap_host_url'] = "Especifique o servidor LDAP con o formato URL como 'ldap://ldap.myorg.com/' ou 'ldaps://ldap.myorg.com/'";
$string['auth_ldap_search_sub'] = "Inserir valor &lt;&gt; 0; se quiser procurar usu�rios nos sub-contextos.";
$string['auth_ldap_update_userinfo'] = "Atualizar informa��o de usu�rios (nome, sobrenome, endere�o...) de LDAP em Moodle. Para informa��o sobre o mapeamento, consulte /auth/ldap/attr_mappings.php";
$string['auth_ldap_user_attribute'] = "O atributo usado para nomear/procurar usu�rios. Geralmente 'cn'.";
$string['auth_ldapdescription'] = "Este m�todo faz a autentica��o em rela��o a um servidor LDAP externo. Se o nome de usu�rio e senha forem v�lidos, Moodle cria um novo registo de usu�rio na sua base de dados. Este m�dulo pode ler atributos do usu�rio no LDAP e preencher os valores desejados em Moodle. Em ingressos sucessivos ser�o verificados apenas o nome de usu�rio e a senha.";
$string['auth_ldapextrafields'] = "Estes campos s�o opcionais. Pode-se optar por preencher campos do usu�rio com informa��o de <b>campos LDAP</b> especificados aqui.<p>Deixando estes campos em branco, ser�o usados valores predefinidos.<p>Nos dois casos, o usu�rio poder� editar todos estes campos quando tiver entrado no sistema.";
$string['auth_ldaptitle'] = "Use um servidor LDAP";
$string['auth_nntpdescription'] = "Este m�todo usa um servidor NNTP para verificar se um nome do usu�rio e a senha s�o v�lidos.";
$string['auth_nntphost'] = "Endere�o do servidor NNTP. Use o N�MERO IP e n�o o nome DNS.";
$string['auth_nntpport'] = "Porta do servidor  (normalmente 119)";
$string['auth_nntptitle'] = "Use um servidor NNTP";
$string['auth_nonedescription'] = "Os usu�rios podem se registrar e criar contas v�lidas imediatamente, sem autentica��o por servidor externo e sem nenhuma confirma��o por correio. Tenha cuidado usando esta op��o - pense nos problemas de seguran�a e administra��o que poderia causar.";
$string['auth_nonetitle'] = "Nenhuma autentica��o";
$string['auth_pop3description'] = "Este m�todo usa um servidor POP3 para verificar se um nome de usu�rio e senha s�o v�lidos.";
$string['auth_pop3host'] = "Endere�o do servidor POP3. Use o N�MERO IP e n�o o nome DNS.";
$string['auth_pop3port'] = "Porta do servidor  (normalmente 110)";
$string['auth_pop3title'] = "Use um servidor POP3";
$string['auth_pop3type'] = "Tipo de servidor. Se o seu servidor usar certificados de seguran�a, escolha pop3cert.";
$string['authenticationoptions'] = "Op��es de autentica��o";
$string['authinstructions'] = "Aqui pode-se incluir instru��es para os seus usu�rios, para que saibam qual nome de usu�rio e senha deveriam estar usando. O texto escrito aqui aparecer� na p�gina de entrada. Se deixar este campo em branco, n�o ser� dada nenhuma instru��o.";
$string['changepassword'] = "URL para modificar a senha";
$string['changepasswordhelp'] = "Aqui pode-se especificar um endere�o onde os usu�rios podem recuperar ou modificar a senha e o nome de usu�rio se os esqueceram. Este ser� publicado como um bot�o na p�gina de entrada e na p�gina do usu�rio. Se deixar este espa�o em branco o bot�o n�o aparecer�.";
$string['chooseauthmethod'] = "Escolha um m�todo de autentica��o: ";
$string['guestloginbutton'] = "Bot�o de entrada como visitante";
$string['instructions'] = "Instru��es";
$string['md5'] = "codifica��o MD5";
$string['plaintext'] = "Texto simples";
$string['showguestlogin'] = "Pode-se optar por esconder ou mostrar o bot�o de entrada para visitantes na p�gina de ingresso.";

?>

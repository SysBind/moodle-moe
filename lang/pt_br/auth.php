<?PHP // $Id$ 
      // auth.php - created with Moodle 1.0.6.4 beta (2002111900)


$string['auth_dbdescription'] = "Este m�todo usa uma tabela externa da base de dados para verificar se um nome de usu�rio e uma senha sejam v�lidos.";
$string['auth_dbfieldpass'] = "Nome do campo que contem as senhas";
$string['auth_dbfielduser'] = "Nome do campo que contem os nomes de usu�rios";
$string['auth_dbhost'] = "Endere�o IP do computador que hospeda o usu�rio da base de dados.";
$string['auth_dbname'] = "Nome da pr�pria base de dados";
$string['auth_dbpass'] = "Senha que combina com o nome de usu�rio acima";
$string['auth_dbtable'] = "Nome da tabela na base de dados";
$string['auth_dbtitle'] = "Use uma base de dados externa";
$string['auth_dbtype'] = "O tipo da base de dados (veja <A HREF=../lib/adodb/readme.htm#drivers>ADOdb documentation</A > para maiores detalhes)";
$string['auth_dbuser'] = "Nome de usu�rio com acesso � base de dados";
$string['auth_emaildescription'] = "Confirma��o de e-mail � o m�todo de autentica��o pad�o.  Quando o usu�rio se inscrever, enquanto escolhendo seu pr�prio nome de usu�rio e senha, um e-mail de confirma��o � enviado ao endere�o de e-mail do usu�rio.  Este e-mail cont�m uma liga��o segura a uma p�gina onde o usu�rio pode confirmar sua conta.";
$string['auth_emailtitle'] = "Atutentica��o baseada em e-mail";
$string['auth_imapdescription'] = "Este m�todo usa um usu�rio do IMAP para verificar se um nome de usu�rio e uma senha sejam v�lidos.";
$string['auth_imaphost'] = "O endere�o do usu�rio do IMAP.  Use o N�MERO IP e n�o o nome do DNS.";
$string['auth_imapport'] = "N�mero da porta de usu�rio do IMAP.  Geralmente este � 143 ou 993.";
$string['auth_imaptitle'] = "Use um servidor IMAP";
$string['auth_imaptype'] = "O tipo do usu�rio do IMAP.  Veja a p�gina da ajuda (acima) para mais detalhes.";
$string['auth_ldap_bind_dn'] = "Se voc� quiser usar o bind-user para procurar usu�rios, especifique-o aqui.  De prefer�ncia 'do cn=ldapuser, ou=public, o=org'";
$string['auth_ldap_bind_pw'] = "Senha para o bind-user.";
$string['auth_ldap_contexts'] = "Lista dos contextos onde os usu�rios s�o encontrados.  Contextos diferentes separados com ';'.  Para o exemplo:  'ou=users, o=org;  ou=others, o=org'";
$string['auth_ldap_host_url'] = "Especifique o servidor de hospedagem do LDAP no formu��rio de endere�o como 'ldap://ldap.myorg.com/' ou 'ldaps://ldap.myorg.com/' ";
$string['auth_ldap_search_sub'] = "Ponha o &lt;&gt; do valor;  0 se voc� preferir para procurar usu�rios dos sub-contextos.";
$string['auth_ldap_update_userinfo'] = "Informa��o de atualiza��o do usu�rio(primeiro nome, sobrenome, endere�o.) de LDAP a Moodle.  Verifique /auth/ldap/attr_mappings.php tra�ando a informa��o";
$string['auth_ldap_user_attribute'] = "O atributo usado para nomear e procurar usu�rios.  Geralmente 'cn'.";
$string['auth_ldapdescription'] = "Este m�todo fornece a autentic��o de encontro a um usu�rio externo de LDAP.  Se o nome de usu�rio e a senha forem v�lidos, Moodle cr�a uma entrada de usu�rio nova em sua base de dados.  Este m�dulo pode ler atributos do usu�rio de LDAP e prefil nos campos criados no Moodle.  Para ver se h� in�cios de uma sess�o somente o nome de usu�rio e a senha s�o verificados.";
$string['auth_ldaptitle'] = "Use um servidor LDAP";
$string['auth_nntpdescription'] = "Este m�todo usa um usu�rio do NNTP para verificar se um nome de usu�rio e uma senha sejam v�lidos.";
$string['auth_nntphost'] = "O endere�o do usu�rio do NNTP.  Use o N�MERO IP e n�o o nome do DNS.";
$string['auth_nntpport'] = "Porta de usu�rio (119 � o mais comum)";
$string['auth_nntptitle'] = "Use um servidor NNTP";
$string['auth_nonedescription'] = "Os usu�rios podem se registrar e podem criar contas v�lidas imediatamente, sem autentica��o de um servidor externo e nenhuma confirma��o por e-mail.  Tenha cuidado que usa esta op��o - pense na seguran�a e problemas de administra��o que isto poderia causar.";
$string['auth_nonetitle'] = "Nenhuma autentica��o";
$string['auth_pop3description'] = "Este m�todo usa um usu�rio POP3 verificar se um nome de usu�rio e uma senha sejam v�lidos.";
$string['auth_pop3host'] = "O endere�o do servidor POP3.  Use o N�MERO IP e n�o o nome do DNS.";
$string['auth_pop3port'] = "Porta de usu�rio (110 � o mais comum)";
$string['auth_pop3title'] = "Use um servidor POP3";
$string['auth_pop3type'] = "Tipo do usu�rio.  Se seu usu�rio usar a seguran�a do certificado, escolha pop3cert.";
$string['authenticationoptions'] = "Op��es de autentica��o";
$string['authinstructions'] = "Aqui voc� pode prover instru��es para seus usu�rios, assim eles sabem qual username e contra-senha que eles deveriam estar usando.  O texto no que voc� entra aqui se aparecer� na p�gina de login.  Se voc� deixa este espa�o em branco ent�o que nenhuma instru��o ser� imprimida.";
$string['chooseauthmethod'] = "Escolha um m�todo de autentica��o: ";
$string['showguestlogin'] = "Voc� pode esconder ou pode mostrar o botao login de convidado na p�gina de login.";
$string['auth_dbextrafields'] = "Estes campos s�o opcionais.  Voc� pode escolher preencher algum dos campos com informa��o de usu�rio nos camposda base de dados </B> especifique aqui.<P> se voc� deixar estes em branco, manter�o o formato padr�o. <P> em um ou outro caso, o usu�rio poder� editar todos estes campos depois de confirmada a entrada.";
$string['instructions'] = "Intru��es";
$string['auth_ldapextrafields'] = "Estes campos s�o opcionais.  Voc� pode escolher preenchar algum com informa��o do usu�rio Moodle <B> nos campos de LDAP </B> esse voc� especifica aqui.  <P> se voc� deixar o espa�o em branco, nada ser� transferido ent�o de LDAP e os padr�es do Moodle ser�o usados. <P> em um ou outro caso, o usu�rio poder�  editar todos estes campos depois de confirmada sua entrada.";
$string['guestloginbutton'] = "Bot�o de entrada como visitante";
$string['changepassword'] = "Mude o endere�o da senha";
$string['changepasswordhelp'] = "Aqui voc� pode especificar um local em que seus usu�rios podem recuperar ou mudar sua senha do nome de usu�rio se esquecerem.  Isto ser� fornecido aos usu�rios como um endere�o alternativo na p�gina do in�cio de uma sess�o.  Se voc� deixar este espa�o em branco o endere�o n�o aparecer�.";
$string['auth_dbpasstype'] = "Especifique o formato que o campo da senha est� usando.  O encripta��o MD5 � �til para conectar a outras aplica��es comuns da aplica��es como PostNuke";
$string['md5'] = "Encripta��o MD5";
$string['plaintext'] = "Simples texto";
?>

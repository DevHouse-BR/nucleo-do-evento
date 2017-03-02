<?php
/*
* *- *- *- *- *- *- MAMBOLETO Joomla! -* -* -* -* -* -*
* @version 2.0 BETA
* @author Fernando Soares
* @copyright Fernando Soares - http://www.fernandosoares.com.br/
* @date Abril, 2007
* @package Joomla! 1.1.12 e Virtuemart 1.0.10

Baseado no trabalho de 	Matheus Mendes e Pedro Müller ( contato@mambopros.net )
				Messuka ( messuka@messuka.com.br )
				Metasig http://www.metasig.com.br

*/

// @(#) $Id: comum.php,v 1.10 2001/12/05 15:24:51 jcpm Exp $
include_once(BOLETO_INC_PATH . "class.ini.php");
$ini = new File_Ini(BOLETO_CONF_PATH . "phpboleto.ini.php", "#");
$inidata = (object) $ini->getBlockValues("Banco de Dados");

// dsn para a conexão ao banco de dados - os valores vem de phpboleto.php
$dsn = array(
    'phptype'  => $inidata->BOLETO_DBTYPE,
    'hostspec' => $inidata->BOLETO_DBHOST,
    'database' => $inidata->BOLETO_DBNAME,
    'username' => $inidata->BOLETO_DBUSER,
    'password' => $inidata->BOLETO_DBPASS
);

function usuario_Autenticado()
{
    global $phpboleto_cookie, $ini;
    $inidata = (object) $ini->getBlockValues("Admin Geral");

    // abra o vetor do cookie
    $cookie = unserialize(base64_decode($phpboleto_cookie));
    if ($cookie["senha_form"] != md5($inidata->PALAVRA_SECRETA . $inidata->SENHA_MESTRE)) {
        return false;
    }

    // checa pelo tempo máximo de login
    if ((time() - $cookie["horario"]) > $inidata->TEMPO_MAXIMO_LOGIN) {
        return false;
    }

    return true;
}

function checaAutenticacao()
{
    if (!usuario_Autenticado()) {
        // deleta o cookie e redireciona o usuário de volta para a página de login
        setcookie("phpboleto_cookie", "");

        header("Location: index2.php?option=com_mamboleto");
        exit;
    }
}

function rodaSlashes($string)
{
    if (get_magic_quotes_gpc() == 1) {
        return $string;
    } else {
        return addslashes($string);
    }
}

function corLoop($i)
{
    if ($i % 2) {
        return "#CCCCCC";
    } else {
        return "#999999";
    }
}

function inicializar($nome_var, $valor)
{
    if (!isset($GLOBALS[$nome_var])) {
        $GLOBALS[$nome_var] = $valor;
    }
}

function checaErro($objeto)
{
    if (PEAR::isError($objeto)) {
        echo $objeto->getMessage();
        exit;
    }
}

function mostraTitulo($string)
{
?>
<table width="80%" border="0" cellspacing="0" cellpadding="5" align="center">
  <tr>
    <td align="center">
      <font color="#000000"><img src="<? echo  BOLETO_URL . "/imagens/mamboleto.gif"; ?>"><br><h1><?php echo $string; ?></h1></font>
    </td>
  </tr>
</table>
<?php
}

// Funcoes do template da area de administracao
function mostraCabecalho($titulo)
{
    global $ini;
    $inidata = (object) $ini->getBlockValues("Admin Geral");
?>
<html>
<head>
  <title><?php echo $titulo; ?></title>
  <link rel="stylesheet" href="../config/estilo.css" type="text/css">
</head>

<body bgcolor="#FFFFFF">
<table width="600" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="50%" class="normal">
      © 2007 <a href="http://www.fernandosoares.com.br" target="_blank">Fernando Soares</a>
    </td>
    <td align="right" width="50%" class="normal">
      <?php echo $inidata->VERSAO; ?>
    </td>
  </tr>
</table>
<br>
<?php
}

function mostraRodape()
{
?>

</body>
</html>
<?php
}

// limpa as variaveis para os outros scripts
unset($ini);
unset($inidata);
?>
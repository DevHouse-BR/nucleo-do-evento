<?php
/*
* *- *- *- *- *- *- MAMBOLETO Joomla! -* -* -* -* -* -*
* @version 2.0 RC1
* @author Fernando Soares
* @copyright Fernando Soares - http://www.fernandosoares.com.br/
* @date Julho, 2007
* @package Joomla! 1.1.12 e Virtuemart 1.0.13

Baseado no trabalho de 	Matheus Mendes e Pedro Müller ( contato@mambopros.net )
				Messuka ( messuka@messuka.com.br )
				Metasig http://www.metasig.com.br
*/

function com_install() {

global $database, $mosConfig_absolute_path, $mosConfig_live_site, $mosConfig_host, $mosConfig_db, $mosConfig_user, $mosConfig_password;

	$database->setQuery( "SELECT id FROM #__components WHERE admin_menu_link = 'option=com_mamboleto'" );
	$id = $database->loadResult();

	//add new admin menu images
	$database->setQuery( "UPDATE #__components SET admin_menu_img = '../administrator/components/com_mamboleto/imagens/menu_icon.png', admin_menu_link = 'option=com_mamboleto' WHERE id=$id");
	$database->query();


if (!$mosConfig_absolute_path) {
    if(!require_once("../configuration.php")) {
        die("não foi possível encontrar o arquivo de configuração do Joomla! nesse servidor.");
    } 
}

/* util functions (string manipulation) */
  function after ($isso, $naquilo)
  {
      if (!is_bool(strpos($naquilo, $isso)))
      return substr($naquilo, strpos($naquilo,$isso)+strlen($isso));
  }
  function before ($thiis, $inthat)
  {
       return substr($inthat, 0, strpos($inthat, $thiis));
  }
  function between ($thiis, $that, $inthat)
  {
     return before($that, after($thiis, $inthat));
  }

/* main file */
//    echo "<h1>$mosConfig_absolute_path</h1>"; // debug
if (stristr(PHP_OS, "win")) {
    $separador = "\\\\"; // separador: \\
    $outro = "/";
} else {
    $separador = "/"; // separador: /
    $outro = "\\\\";
}
$caminho = str_replace($outro, $separador,$mosConfig_absolute_path) . $separador . "administrator" . $separador . "components" .$separador. "com_mamboleto";
$caminho1 = str_replace($outro, $separador,$mosConfig_live_site) . $separador . "administrator" . $separador . "components" . $separador . "com_mamboleto" . $separador;



/* PRIMEIRA PARTE - CONFIGURANDO AS CONSTANTES */
$antigo = @file( $caminho . $separador . "include" . $separador . "pre.php");
$arquivo = @fopen($caminho . $separador . "include" . $separador ."pre.php", "w+");

foreach($antigo as $line)
{
    // procura pela chamada do define(
     if (eregi("define\s*\(\s*[\"\']*[\"\']",$line)) {
          $strTmp = between('(',')',$line);
          //echo $line; // debug
          $arrLinha = explode (",", $strTmp);
          $arrLinha[0] = between("\"","\"",$arrLinha[0]);
          if ($arrLinha[0] == "BOLETO_SEPARADOR") {
              $line = "define(\"". $arrLinha[0] . "\",\"". $separador . "\"); // automatico\n";             
          } else if ($arrLinha[0] == "BOLETO_PATH") {
              $line = "define(\"". $arrLinha[0] . "\", \"". $caminho . "\"); // automatico\n";
          } else if ($arrLinha[0] == "BOLETO_URL") {
              $line = "define(\"". $arrLinha[0] . "\", \"". $caminho1 . "\"); // automatico\n"; 
          }
          
     }
     @fputs($arquivo,$line);
     //else echo $line; // debug
}
@fclose($arquivo);
@chmod($caminho . "/include/pre.php",777);

include_once($caminho . $separador . "include" . $separador . "class.ini.php");
$ini = new File_Ini($caminho . $separador . "config" . $separador . "phpboleto.ini.php", "#");


/* SEGUNDA PARTE - CONFIGURAÇÃO DO BANCO DE DADOS */
$geral_bloco_ini = "Admin Geral";
$db_bloco_ini = "Banco de Dados";

if ($ini) {
  $ini->enableCache("On");
  $ini->setIniValue($geral_bloco_ini, "BOLETO_SISTEMA", "banco");
  $ini->setIniValue($geral_bloco_ini, "VERSAO", "Versão 2.0 RC1");
  $ini->setIniValue($geral_bloco_ini, "TITULO_ADMIN_NORMAL", "MamboletoJoomla! - Interface de Administração");
  $ini->setIniValue($db_bloco_ini, "BOLETO_DBTYPE", "mysql");
  $ini->setIniValue($db_bloco_ini, "BOLETO_DBHOST", $mosConfig_host);
  $ini->setIniValue($db_bloco_ini, "BOLETO_DBNAME", $mosConfig_db);
  $ini->setIniValue($db_bloco_ini, "BOLETO_DBUSER", $mosConfig_user);
  $ini->setIniValue($db_bloco_ini, "BOLETO_DBPASS", $mosConfig_password);
  $ini->save();
}

echo "<h4>Seu MamboletoJoomla! já está configurado de acordo com o Joomla!</h4>";

}
?>

<h3>MamboletoJoomla! 2.0 - RC1</h3>
<br>
Esta versão é pública para quem deseja auxiliar no processo de desenvolvimento.<br>
<b>Por favor reportem os bugs/erros com o Mamboleto ou com os boletos.</b><br>
<br>
<br>
<b>Avisos</b>:
<br>
<p align="left"><ol>
<li>Para acessar o MamboletoJoomla! vá até 'Components > Mamboleto'.</li><br>
<li>Vá em 'Administrar Boletos' e clique no título do boleto correspondente ao seu banco.</li><br>
<li>Configure seus dados bancários conforme fornecido pelo seu banco.</li><br>
<li>Repita a operação para os demais bancos que você irá utilizar.</li><br>
</ol></p>
<br>
<center>
<strong>Obrigado por utilizar esta versão do MamboletoJoomla!.</strong>
<br>
<a href="http://www.fernandosoares.com.br" target="_blank">Fernando Soares</a>
</center>
<br><br>
Baseado no trabalho iniciado por:<br>
<a href="http://www.joomla.com.br" target="_blank">Matheus Mendes</a> e messuka@messuka.com.br
<br>
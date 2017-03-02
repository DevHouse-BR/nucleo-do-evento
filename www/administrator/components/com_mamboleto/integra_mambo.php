<?php
/**
* *- *- *- *- *- *- MamboletoJoomla! -* -* -* -* -* -*
* @version 2.0 BETA
* @author Fernando Soares - http://www.fernandosoares.com.br
* @origem Matheus Mendes e Pedro Müller
* @date Abril, 2007
* @description Integração do Mamboleto com Joomla!
* @package Joomla! 1.0.12
*/

/* Arquivo de integração -> Configurações atuais do Joomla! viram as configurações do mamboletoJoomla! :D */




if (!$mosConfig_absolute_path) {
    if(!require_once("../configuration.php")) {
        die("não foi possível encontrar o arquivo de configuração do Joomla! nesse servidor.");
    } 
}
//if (!$mosConfig_absolute_path) $mosConfig_absolute_path = "/home/httpd/html/lab/cobaia";

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


/* PRIMEIRA PARTE - CONFIGURANDO AS CONSTANTES */
$antigo = @file( $caminho . $separador . "include" . $separador . "pre.php");
$arquivo = @fopen($caminho . $separador . "include" . $separador ."pre.php", "w+");

//echo "<pre>";
foreach($antigo as $line)
{
    // procura pela chamada do define(
     if (eregi("define\s*\(\s*[\"\']*[\"\']",$line)) {
          $strTmp = between('(',')',$line);
          //echo $line; // debug
          $arrLinha = explode (",", $strTmp);
          $arrLinha[0] = between("\"","\"",$arrLinha[0]);
          //$arrLinha[0] = str_replace($outro, $separador, $arrLinha[0]);
          // arrLinha[0] é a variável a ser definida
          // arrLinha[1] é o valor do define. Deve estar entre aspas duplas ""
          if ($arrLinha[0] == "BOLETO_SEPARADOR") {
              $line = "define(\"". $arrLinha[0] . "\",\"". $separador . "\"); // automatico\n";             
          } else if ($arrLinha[0] == "BOLETO_PATH") {
              $line = "define(\"". $arrLinha[0] . "\", \"". $caminho . "\"); // automatico\n"; 
          }
          
     }
     @fputs($arquivo,$line);
     //else echo $line; // debug
}
//echo "</pre>";
@fclose($arquivo);
@chmod($caminho . "/include/pre.php",777);

/* SEGUNDA PARTE - CONFIGURAÇÃO DO BANCO DE DADOS */
$geral_bloco_ini = "Admin Geral";
$db_bloco_ini = "Banco de Dados";

if ($ini) {
  $ini->enableCache("On");
  $ini->setIniValue($geral_bloco_ini, "BOLETO_SISTEMA", "banco");
  $ini->setIniValue($geral_bloco_ini, "VERSAO", "Versão 2.0 BETA");
  $ini->setIniValue($geral_bloco_ini, "TITULO_ADMIN_NORMAL", "MamboletoJoomla! - Interface de Administração");
  $ini->setIniValue($db_bloco_ini, "BOLETO_DBTYPE", "mysql");
  $ini->setIniValue($db_bloco_ini, "BOLETO_DBHOST", $mosConfig_host);
  $ini->setIniValue($db_bloco_ini, "BOLETO_DBNAME", $mosConfig_db);
  $ini->setIniValue($db_bloco_ini, "BOLETO_DBUSER", $mosConfig_user);
  $ini->setIniValue($db_bloco_ini, "BOLETO_DBPASS", $mosConfig_password);
  $ini->save();
}


echo "<h2>Seu MamboletoJoomla! está agora configurado de acordo com o Joomla!</h2>";

/*
regexp:
"/(define\s*\(\s*[\"\']" . $parametro . "[\"\']\s*,\s*[\"\'])[^\"\']*([\"\'])/s", "\1" . $novo_valor . "\2"
*/

?>
<?php
/*
* *- *- *- *- *- *- MAMBOLETO Joomla! -* -* -* -* -* -*
* @version 2.0 RC1
* @author Fernando Soares
* @copyright Fernando Soares - http://www.fernandosoares.com.br/
* @date Julho, 2007
* @package Joomla! 1.1.12 e Virtuemart 1.0.12

Baseado no trabalho de 	Matheus Mendes e Pedro Müller ( contato@mambopros.net )
				Messuka ( messuka@messuka.com.br )
				Metasig http://www.metasig.com.br
*/


/* vim: set expandtab tabstop=4 shiftwidth=4: */
// +----------------------------------------------------------------------+
// | phpBoleto v2.0                                                       |
// +----------------------------------------------------------------------+
// | Copyright (c) 1999-2001 Pablo Martins F. Costa, João Prado Maia      |
// +----------------------------------------------------------------------+
// | Este arquivo está sujeito a versão 2 da GNU General Public License,  |
// | que foi adicionada nesse pacote no arquivo COPYING e está disponível |
// | pela Web em http://www.gnu.org/copyleft/gpl.txt                      |
// | Você deve ter recebido uma cópia da GNU Public License junto com     |
// | esse pacote; se não, escreva para:                                   |
// |                                                                      |
// | Free Software Foundation, Inc.                                       |
// | 59 Temple Place - Suite 330                                          |
// | Boston, MA 02111-1307, USA.                                          |
// +----------------------------------------------------------------------+
// | Autores: João Prado Maia <jpm@phpbrasil.com>                         |
// +----------------------------------------------------------------------+
//
// @(#) $Id: config.php,v 1.17 2002/03/18 04:08:33 jcpm Exp $
//
ob_start();
error_reporting(E_ALL);
ini_set("include_path", ".");
include_once("include/pre.php");
include_once(BOLETO_INC_PATH . "comum.php");
include_once(BOLETO_INC_PATH . "class.ini.php");
$ini = new File_Ini(BOLETO_CONF_PATH . "phpboleto.ini.php", "#");
$inidata = (object) $ini->getBlockValues("Admin Geral");

mostraCabecalho($inidata->TITULO_ADMIN_NORMAL);
mostraTitulo("Configuração Geral");
?>
<table width="600" border="0" cellspacing="0" cellpadding="5">
  <tr>
    <td class="normal"> 
      <b>Essa tela mostra os par&acirc;metros de configura&ccedil;&atilde;o geral
      do sistema do MamboletoJoomla!. Voc&ecirc; pode us&aacute;-lo para modificar os
      valores padr&otilde;es; tais como a senha mestre da se&ccedil;&atilde;o de 
      administra&ccedil;&atilde;o do programa, dados gerais sobre o tipo de servidor
      de banco de dados, usu&aacute;rio e senha, etc.
      </b>
    </td>
  </tr>
  <tr>
    <td align="center" class="navegacao">
      <hr>
      <a href="index2.php?option=com_mamboleto">Menu Principal</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="index2.php?option=com_mamboleto&task=config">Configuração Geral</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="index2.php?option=com_mamboleto&task=boletos">Boletos</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="index2.php?option=com_mamboleto&task=bancos">Bancos</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="index2.php?option=com_mamboleto&task=configuracoes">Configurações Personalizadas</a>
      <hr>
    </td>
  </tr>
<?php
$geral_bloco_ini = "Admin Geral";
$db_bloco_ini = "Banco de Dados";
if ((isset($_POST["cat"])) && ($_POST["cat"] == "update")) {
    if ($_POST["db_type"] == "ini") {
        $ini->enableCache("On");
        $ini->setIniValue($geral_bloco_ini, "BOLETO_SISTEMA", "ini");
        $ini->save();
    } else {
        $ini->enableCache("On");
        $ini->setIniValue($geral_bloco_ini, "BOLETO_SISTEMA", "banco");
        $ini->setIniValue($db_bloco_ini, "BOLETO_DBTYPE", strtolower($_POST["db_type"]));
        $ini->setIniValue($db_bloco_ini, "BOLETO_DBHOST", strtolower($_POST["db_host"]));
        $ini->setIniValue($db_bloco_ini, "BOLETO_DBNAME", $_POST["db_name"]);
        $ini->setIniValue($db_bloco_ini, "BOLETO_DBUSER", $_POST["db_user"]);
        $ini->setIniValue($db_bloco_ini, "BOLETO_DBPASS", $_POST["db_pass"]);
        $ini->save();
    }

} elseif ((isset($_POST["cat"])) && ($_POST["cat"] == "update_senha")) {
    $ini->enableCache("On");
    $ini->setIniValue($geral_bloco_ini, "SENHA_MESTRE", md5($_POST["nova_senha"]));
    $ini->save();

    // modifica o cookie com a senha / hash encriptado
    $cookie = array(
        "autenticado" => "sim",
        "horario"     => time(),
        "senha_form"  => md5($inidata->PALAVRA_SECRETA . md5($_POST["nova_senha"]))
    );
    $cookie = base64_encode(serialize($cookie));
    setcookie("phpboleto_cookie", $cookie);

} elseif ((isset($_POST["cat"])) && ($_POST["cat"] == "modificar")) {
    // mostra os dados apropriados (em modificacoes)
    $inidata = (object) $ini->getBlockValues($db_bloco_ini);
?>
  <tr>
    <td>
      <form method="post" action="index2.php">
      <input type="hidden" name="option" value="com_mamboleto">
      <input type="hidden" name="task" value="config">
      <input type="hidden" name="cat" value="update">
      <table width="100%" border="0" cellpadding="1" cellspacing="0">
        <tr bgcolor="#000000">
          <td>
            <table width="100%" border="0" cellspacing="0" cellpadding="3" bgcolor="#999999">
              <tr>
                <td nowrap class="normal"><b>Tipo de Servidor:</b></td>
                <td width="100%">
                  <select name="db_type">
<?php
    $db_types = array(
        "mysql"  => "MySQL",
        "pgsql"  => "PostgreSQL",
        "msql"   => "mSQL",
        "ibase"  => "Interbase",
        "ifx"    => "Informix",
        "mssql"  => "Microsoft SQL Server",
        "oci8"   => "Oracle",
        "sybase" => "Sybase",
        "odbc"   => "ODBC",
        "ini"    => "Arquivos INI"
    );
    while (list($chave, $valor) = each($db_types)) {
        if ($chave == $inidata->BOLETO_DBTYPE) {
            echo "                    <option value=\"$chave\" selected>$valor</option>\n";
        } else {
            echo "                    <option value=\"$chave\">$valor</option>\n";
        }
    }
?>
                  </select>
                </td>
              </tr>
              <tr>
                <td nowrap class="normal"><b>Servidor:</b></td>
                <td width="100%"><input type="text" name="db_host" value="<?php echo $inidata->BOLETO_DBHOST; ?>"></td>
              </tr>
              <tr>
                <td nowrap class="normal"><b>Banco de Dados:</b></td>
                <td width="100%"><input type="text" name="db_name" value="<?php echo $inidata->BOLETO_DBNAME; ?>"></td>
              </tr>
              <tr>
                <td nowrap class="normal"><b>Usu&aacute;rio:</b></td>
                <td width="100%"><input type="text" name="db_user" value="<?php echo $inidata->BOLETO_DBUSER; ?>"></td>
              </tr>
              <tr>
                <td nowrap class="normal"><b>Senha:</b></td>
                <td width="100%"><input type="text" name="db_pass" value="<?php echo $inidata->BOLETO_DBPASS; ?>"></td>
              </tr>
              <tr>
                <td nowrap colspan="2">
                  <input type="submit" value="Salvar Modifica&ccedil;&otilde;es" class="button">
                </td>
              </tr>
            </table>
          </td>
        </tr>
      </table>
      </form>
    </td>
  </tr>
  <tr>
    <td>
      <hr>
    </td>
  </tr>
<?php
} elseif ((isset($_POST["cat"])) && ($_POST["cat"] == "integrar")) {
    // mostra os dados apropriados (em modificacoes)
    //$inidata = (object) $ini->getBlockValues($db_bloco_ini);
?>
  <tr>
    <td>
      <? include_once("integra_mambo.php"); ?>
	</td>
  </tr>
  <tr>
    <td>
      <hr>
    </td>
  </tr>
<?php
}
if (isset($msg)) :
?>
  <tr>
    <td align="center" class="normal">
      <b><?php echo $msg; ?></b>
    </td>
  </tr>
<?php
endif;

$sysdata = (object) $ini->getBlockValues("Admin Geral");
$inidata = (object) $ini->getBlockValues("Banco de Dados");
$senha_atual = $ini->getIniValue($geral_bloco_ini, "SENHA_MESTRE");
?>
  <?php if ((isset($erro)) && (!empty($erro))) : ?>
  <tr>
    <td align="center" class="normal">
      <font color="red">Erro: <?php echo $erro; ?></font>
    </td>
  </tr>
  <?php endif; ?>
  <tr>
    <td>
        <table width="100%" border="0" cellspacing="3" cellpadding="0">
          <tr>
            <td nowrap colspan="2" bgcolor="#CCCCCC">
              <h4>Conexão com banco de dados (caso os boletos estejam separados do Joomla!)</h4>
            </td>
          </tr>
          <tr>
            <td>
              <table width="100%" border="0" cellspacing="0" cellpadding="1" bgcolor="#000000">
                <tr>
                  <td>
                    <table width="100%" border="0" cellspacing="0" cellpadding="2" bgcolor="#FFFFFF">
                      <tr>
                        <td width="120" class="normal"><b>Sistema:</b></td>
                        <td class="normal"><?php echo $sysdata->BOLETO_SISTEMA; ?></td>
                      </tr>
                      <?php if ($sysdata->BOLETO_SISTEMA != "ini") : ?>
                      <tr>
                        <td width="120" class="normal"><b>Tipo de Servidor:</b></td>
                        <td class="normal"><?php echo $inidata->BOLETO_DBTYPE; ?></td>
                      </tr>
                      <tr>
                        <td width="120" class="normal"><b>Servidor:</b></td>
                        <td class="normal"><?php echo $inidata->BOLETO_DBHOST; ?></td>
                      </tr>
                      <tr>
                        <td width="120" class="normal"><b>Banco de Dados:</b></td>
                        <td class="normal"><?php echo $inidata->BOLETO_DBNAME; ?></td>
                      </tr>
                      <tr>
                        <td width="120" class="normal"><b>Usu&aacute;rio:</b></td>
                        <td class="normal"><?php echo $inidata->BOLETO_DBUSER; ?></td>
                      </tr>
                      <tr>
                        <td width="120" class="normal"><b>Senha:</b></td>
                        
                      <td class="normal"><em><font color="#FF0000">*protegido</font></em></td>
                      </tr>
                      <?php endif; ?>
                    </table>
                  </td>
                </tr>
              </table>
            </td>
            <td valign="top" align="right">
              <form method="post" action="index2.php">
              <input type="hidden" name="option" value="com_mamboleto">
              <input type="hidden" name="task" value="config">

              <input type="hidden" name="cat" value="modificar">
              <input type="submit" value="Modificar Configura&ccedil;&atilde;o" class="button" name="submit">
			  </form>
			  
            </td>
          </tr>
<!--          <tr>
            <td colspan="2">
              <hr>
            </td>
          </tr>
          <tr>
            <td nowrap colspan="2" bgcolor="#CCCCCC">
              <h4>Configurar de acordo com o Joomla!</h4>
            </td>
          </tr>
          <tr>
            <td valign="top">
              <table width="100%" border="0" cellspacing="0" cellpadding="1" bgcolor="#000000">
                <tr>
                  <td>
                    <table width="100%" border="0" cellspacing="0" cellpadding="2" bgcolor="#FFFFFF">
                    <tr> 
                      <td class="normal">Clicando no bot&atilde;o ao lado, voc&ecirc; 
                        ir&aacute; configurar o MamboletoJoomla! de acordo com as configura&ccedil;&otilde;es 
                        do Joomla!</td>
                    </tr>
                  </table>
                  </td>
                </tr>
              </table>
            </td>
            <td valign="top" align="right">
              <form method="post" action="index2.php">
              <input type="hidden" name="option" value="com_mamboleto">
              <input type="hidden" name="task" value="config">

              <input type="hidden" name="cat" value="integrar">
              <input type="submit" value="Integrar ao Joomla!" class="button" name="submit">
              </form>
            </td>
          </tr> -->
        </table>
    </td>
  </tr>
</table>
<?php
mostraRodape();
ob_end_flush();
?>

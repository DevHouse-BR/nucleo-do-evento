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
// @(#) $Id: bancos.php,v 1.10 2001/12/19 15:53:41 jcpm Exp $
//
error_reporting(E_ALL);
ini_set("include_path", ".");
include_once("include/pre.php");
include_once(BOLETO_INC_PATH . "comum.php");
include_once(BOLETO_INC_PATH . "class.ini.php");
$ini = new File_Ini(BOLETO_CONF_PATH . "phpboleto.ini.php", "#");
$inidata = (object) $ini->getBlockValues("Admin Geral");

include_once(BOLETO_INC_PATH . "class.db.php");
$db_api = Boleto_DB::conectar($inidata->BOLETO_SISTEMA);

if ((isset($_POST["cat"])) && ($_POST["cat"] == "deletar")) {
    if (isset($_POST["bancos"])) {
        $db_api->deletarBancos($_POST["bancos"]);
    }
} elseif ((isset($_POST["cat"])) && ($_POST["cat"] == "update")) {
    $db_api->atualizarBanco();
} elseif ((isset($_POST["cat"])) && ($_POST["cat"] == "insert")) {
    $db_api->adicionarBanco();
}
mostraCabecalho($inidata->TITULO_ADMIN_NORMAL);
mostraTitulo("Bancos");
?>
<table width="600" border="0" cellspacing="0" cellpadding="5">
  <tr>
    <td class="normal">
      <b>Essa tela contém a lista de bancos disponíveis para uso no MamboletoJoomla!. Você pode
      criar novos bancos clicando no botão "Novo Banco" ou editar bancos já existentes 
      clicando no nome do mesmo na lista abaixo. Essas opções serão usadas na criação 
      do boleto com os parâmetros especificados.
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
if ((isset($_GET["cat"])) && (($_GET["cat"] == "novo") || ($_GET["cat"] == "modificar"))) {
    if ($_GET["cat"] == "modificar") {
        extract($db_api->pegaDadosBanco($_GET["bnid"]), EXTR_OVERWRITE);
    }
    inicializar("layout", "");
    inicializar("nome", "");
    inicializar("codigo", "");
    inicializar("uso_do_banco", "");
?>
  <tr>
    <td>
      <script language="JavaScript" src="<? echo $mosConfig_live_site ?>/administrator/components/com_mamboleto/include/functions_boleto.js"></script>
      <script language="JavaScript">
      <!--
      function checaFormulario()
      {
          var checa = document.banco_form;
          if (isWhitespace(checa.nome.value)) {
              alert("Por favor digite o nome do banco.");
              checa.nome.focus();
              return false;
          }
          if (!isNumberOnly(checa.codigo.value)) {
              alert("Por favor utilize somente números no código do banco.");
              checa.codigo.focus();
              return false;
          }
          checa.submit();
      }
      //-->
      </script>
      <form name="banco_form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
      <input type="hidden" name="option" value="com_mamboleto">
      <input type="hidden" name="task" value="bancos">

      <?php if ($_GET["cat"] == "novo") : ?>
      <input type="hidden" name="cat" value="insert">
      <?php elseif ($_GET["cat"] == "modificar") : ?>
      <input type="hidden" name="cat" value="update">
      <input type="hidden" name="bnid" value="<?php echo $_GET["bnid"]; ?>">
      <?php endif; ?>
      <table width="100%" border="0" cellpadding="1" cellspacing="0">
        <tr bgcolor="#000000">
          <td>
            <table width="100%" border="0" cellspacing="0" cellpadding="3" bgcolor="#999999">
              <tr> 
                <td nowrap class="normal"><b>Layout:</b></td>
                <td nowrap width="100%"> 
                  <select name="layout">
                    <?php
                    $bancos = $db_api->listaLayouts();
                    reset($bancos);
                    while (list($chave, $valor) = each($bancos)) {
                        if ($layout == $chave) {
                            echo "<option value=\"$chave\" selected>$valor</option>\n";
                        } else {
                            echo "<option value=\"$chave\">$valor</option>\n";
                        }
                    }
                    ?>
                  </select>
                </td>
              </tr>
              <tr>
                <td nowrap class="normal"><b>Nome do Banco:</b></td>
                <td width="100%">
                  <input type="text" name="nome" size="40" maxlength="40" value="<?php echo $nome; ?>">
                </td>
              </tr>
              <tr>
                <td nowrap class="normal"><b>Código:</b></td>
                <td width="100%">
                  <input type="text" name="codigo" size="40" maxlength="40" value="<?php echo $codigo; ?>">
                  <font size="-1">(utilize somente números)</font>
                </td>
              </tr>
              <tr>
                <td nowrap class="normal"><b>Uso do Banco:</b></td>
                <td width="100%">
                  <input type="text" name="uso_do_banco" size="40" maxlength="50" value="<?php echo $uso_do_banco; ?>">
                </td>
              </tr>
              <tr>
                <td nowrap colspan="2">
                  <input type="button" value="Salvar" class="button" onClick="javascript:checaFormulario();">
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
}
?>
  <tr>
    <td>
      <script language="JavaScript">
      <!--
      function checaRemocao()
      {
          var checa = document.deleta_form;
          if (confirm("Essa opção irá remover as emissões selecionadas.")) {
              checa.submit();
          } else {
              return false;
          }
      }
      //-->
      </script>
      <form name="deleta_form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
      <input type="hidden" name="option" value="com_mamboleto">
      <input type="hidden" name="task" value="bancos">

      <input type="hidden" name="cat" value="deletar">
      <table width="100%" border="0" cellspacing="0" cellpadding="3">
        <tr bgcolor="#CCCCCC">
          <td colspan="3">
            <h4>Lista de Bancos</h4>
          </td>
        </tr>
        <tr>
          <td width="5" nowrap>&nbsp;</td>
          <td nowrap class="normal"><b>Nome do Banco</b></td>
          <td width="60%" class="normal"><b>Código</b></td>
        </tr>
<?php
$bancos = $db_api->listaBancos();
for ($i = 0; $i < count($bancos); $i++) {
?>
        <tr bgcolor="<?php echo corLoop($i); ?>">
          <td width="5" nowrap><input type="checkbox" name="bancos[]" value="<?php echo $bancos[$i]["bnid"]; ?>"></td>
          <td nowrap class="normal"><a href="<?php echo $_SERVER['PHP_SELF'] . '?option=com_mamboleto&task=bancos&'; ?>cat=modificar&bnid=<?php echo $bancos[$i]["bnid"]; ?>"><?php echo $bancos[$i]["nome"]; ?></a></td>
          <td width="60%" class="normal"><?php echo htmlspecialchars(stripslashes($bancos[$i]["codigo"])); ?></td>
        </tr>
<?php
}
?>
        <tr>
          <td colspan="3">
            <hr>
          </td>
        </tr>
        <tr>
          <td colspan="3">
            <input type="button" value="Novo Banco" class="button" onClick="javascript:location.href='<?php echo $_SERVER['PHP_SELF']; ?>?option=com_mamboleto&task=bancos&cat=novo';">
            &nbsp; 
            <input type="button" value="Deletar" class="button" onClick="javascript:checaRemocao();">
          </td>
        </tr>
      </table>
      </form>
    </td>
  </tr>
</table>
<?php
mostraRodape();
?>

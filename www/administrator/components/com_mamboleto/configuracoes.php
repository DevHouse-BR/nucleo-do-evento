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
// @(#) $Id: configuracoes.php,v 1.10 2001/12/19 15:53:41 jcpm Exp $
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
    if (isset($_POST["configs"])) {
        $db_api->deletarConfiguracoes($_POST["configs"]);
    }
} elseif ((isset($_POST["cat"])) && ($_POST["cat"] == "update")) {
    $db_api->atualizarConfiguracao();
} elseif ((isset($_POST["cat"])) && ($_POST["cat"] == "insert")) {
    $db_api->adicionarConfiguracao();
}

mostraCabecalho($inidata->TITULO_ADMIN_NORMAL);
mostraTitulo("Personalizações");
?>
<table width="600" border="0" cellspacing="0" cellpadding="5">
  <tr>
    <td class="normal">
      <b>Essa tela mostra a lista de configurações personalizadas para a criação de boletos
      pelo MamboletoJoomla!. Opções incluem o envio do boleto por email pelo aplicativo, anexar
      uma cópia do boleto em formato PDF à mensagem e outros parâmetros de configuração. Essas
      opções foram colocadas à parte para poderem ser re-usadas em vários modelos de boleto.
      <br>
      <br>
      Novas configurações podem ser criadas clicando no botão "Nova Configuração Personalizadas"
      abaixo e configurações existentes podem ser editadas clicando no título das mesmas.
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
        extract($db_api->pegaDadosConfiguracao($_GET["cid"]), EXTR_OVERWRITE);
    }
    inicializar("titulo", "");
    inicializar("enviar_email", "0");
    inicializar("remetente", "");
    inicializar("remetente_email", "");
    inicializar("assunto", "");
    inicializar("enviar_pdf", "0");
    inicializar("mensagem_texto", "");
    inicializar("mensagem_html", "");
    inicializar("servidor_smtp", "");
    inicializar("servidor_http", "");
    inicializar("imagem_tipo", "jpeg");
    inicializar("usar_truetype", "1");
?>
  <tr> 
    <td>
      <script language="JavaScript" src="/administrator/components/com_mamboleto/include/functions_boleto.js"></script>
      <script language="JavaScript">
      <!--
      function checaFormulario()
      {
          var checa = document.config_form;
          if (isWhitespace(checa.titulo.value)) {
              alert("Por favor digite o título dessa configuração.");
              checa.titulo.focus();
              return false;
          }
          if (checa.enviar_email[0].checked) {
              if (isWhitespace(checa.remetente.value)) {
                  alert("Por favor digite o nome do remetente para o email.");
                  checa.remetente.focus();
                  return false;
              }
              if (isWhitespace(checa.remetente_email.value)) {
                  alert("Por favor digite o endereço de email do remetente.");
                  checa.remetente_email.focus();
                  return false;
              }
              if (!isEmail(checa.remetente_email.value)) {
                  alert("Por favor digite um endereço de email válido.");
                  checa.remetente_email.focus();
                  return false;
              }
              if (isWhitespace(checa.assunto.value)) {
                  alert("Por favor digite o assunto para o email.");
                  checa.assunto.focus();
                  return false;
              }
              if (isWhitespace(checa.mensagem_texto.value)) {
                  alert("Por favor digite a mensagem em formato texto para o email.");
                  checa.mensagem_texto.focus();
                  return false;
              }
              if (isWhitespace(checa.mensagem_html.value)) {
                  alert("Por favor digite a mensagem em formato HTML para o email.");
                  checa.mensagem_html.focus();
                  return false;
              }
              if (isWhitespace(checa.mensagem_texto.value)) {
                  alert("Por favor digite a mensagem em formato texto para o email.");
                  checa.mensagem_texto.focus();
                  return false;
              }
              if (isWhitespace(checa.servidor_smtp.value)) {
                  alert("Por favor digite o servidor SMTP.");
                  checa.servidor_smtp.focus();
                  return false;
              }
              if (isWhitespace(checa.servidor_http.value)) {
                  alert("Por favor digite o servidor HTTP.");
                  checa.servidor_http.focus();
                  return false;
              }
          }
          checa.submit();
      }
      //-->
      </script>
      <form name="config_form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
      <input type="hidden" name="option" value="com_mamboleto">
      <input type="hidden" name="task" value="configuracoes">
      <?php if ($_GET["cat"] == "novo") : ?>
      <input type="hidden" name="cat" value="insert">
      <?php elseif ($_GET["cat"] == "modificar") : ?>
      <input type="hidden" name="cat" value="update">
      <input type="hidden" name="cid" value="<?php echo $_GET["cid"]; ?>">
      <?php endif; ?>
      <table width="100%" border="0" cellpadding="1" cellspacing="0">
        <tr bgcolor="#000000">
          <td>
            <table width="100%" border="0" cellspacing="0" cellpadding="3" bgcolor="#999999">
              <tr> 
                <td nowrap class="normal"><b>T&iacute;tulo:</b></td>
                <td nowrap width="100%"> 
                  <input type="text" name="titulo" size="40" maxlength="30" value="<?php echo htmlspecialchars(stripslashes($titulo)); ?>">
                </td>
              </tr>
              <tr>
                <td colspan="2" class="normal">
                  <hr>
                  <b>Enviar Boleto por Email ?</b>&nbsp;&nbsp;
                  <input type="radio" name="enviar_email" value="1" <?php if ($enviar_email) echo "checked"; ?>>Sim&nbsp;&nbsp;&nbsp;
                  <input type="radio" name="enviar_email" value="0" <?php if (!$enviar_email) echo "checked"; ?>>Não
                </td>
              </tr>
              <tr>
<!--                <td nowrap class="normal"><b>Remetente:</b></td> -->
                <td>
                  <input type="hidden" name="remetente" size="40" maxlength="50" value="<?php echo htmlspecialchars(stripslashes($remetente)); ?>">
                </td>
              </tr>
              <tr>
<!--                <td nowrap class="normal"><b>Remetente - Email:</b></td> -->
                <td>
<!--                  <input type="text" name="remetente_email" size="40" maxlength="255" value="<?php echo htmlspecialchars(stripslashes($remetente_email)); ?>"> -->
                  <input type="hidden" name="remetente_email" size="40" maxlength="255" value="<?php echo htmlspecialchars(stripslashes($remetente_email)); ?>">
                </td>
              </tr>
              <tr>
                <td nowrap class="normal"><b>Assunto:</b></td>
                <td>
                  <input type="text" name="assunto" size="40" maxlength="50" value="<?php echo htmlspecialchars(stripslashes($assunto)); ?>">
                </td>
              </tr>
              <tr>
                <td colspan="2" class="normal">
<!--                  <b>Enviar Boleto em PDF Anexado ?</b>&nbsp;&nbsp;
                  <input type="radio" name="enviar_pdf" value="1" <?php if ($enviar_pdf) echo "checked"; ?>>Sim&nbsp;&nbsp;&nbsp;
                  <input type="radio" name="enviar_pdf" value="0" <?php if (!$enviar_pdf) echo "checked"; ?>>Não -->
                  <input type="hidden" name="enviar_pdf" value="0" >
                </td>
              </tr>
              <tr>
<!--                <td class="normal"><b>Mensagem em Formato Texto:</b></td> -->
                <td>
                  <input type="hidden" name="mensagem_texto" value="<?php echo htmlspecialchars(stripslashes($mensagem_texto)); ?>">
<!--                  <textarea name="mensagem_texto" cols="40" rows="7"><?php echo htmlspecialchars(stripslashes($mensagem_texto)); ?></textarea> -->
                </td>
              </tr>
              <tr>
<!--                <td class="normal"><b>Mensagem em Formato HTML:</b></td> -->
                <td>
                  <input type="hidden" name="mensagem_html" value="<?php echo htmlspecialchars(stripslashes($mensagem_html)); ?>">
<!--                  <textarea name="mensagem_html" cols="40" rows="7"><?php echo htmlspecialchars(stripslashes($mensagem_html)); ?></textarea> -->
                </td>
              </tr>
              <tr>
<!--                <td class="normal"><b>Servidor SMTP:</b></td> -->
                <td>
                  <input type="hidden" name="servidor_smtp" size="40" maxlength="80" value="<?php echo htmlspecialchars(stripslashes($servidor_smtp)); ?>">
                </td>
              </tr>
              <tr>
<!--                <td class="normal"><b>Servidor HTTP:</b></td> -->
                <td>
                  <input type="hidden" name="servidor_http" size="40" maxlength="80" value="<?php echo htmlspecialchars(stripslashes($servidor_http)); ?>">
                </td>
              </tr>
              <tr>
                <td colspan="2">
<!--                  <hr> -->
                </td>
              </tr>
              <tr>
<!--                <td class="normal"><b>Tipo de Imagem:</b></td> -->
                <td>
                  <input type="hidden" name="imagem_tipo" value="jpeg">

<!--                  <select name="imagem_tipo">
                    <option value="jpeg" <?php if ($imagem_tipo == "jpeg") echo "selected"; ?>>JPG</option>
                    <option value="png" <?php if ($imagem_tipo == "png") echo "selected"; ?>>PNG</option>
                    <option value="gif" <?php if ($imagem_tipo == "gif") echo "selected"; ?>>GIF</option>
                  </select> -->
                </td>
              </tr>
              <tr>
                <td colspan="2" class="normal">
<!--                  <hr> -->
                  <input type="hidden" name="usar_truetype" value="1">

<!--                  <b>Usar Fontes Truetype no Boleto ?</b>&nbsp;&nbsp;
                  <input type="radio" name="usar_truetype" value="1" <?php if ($usar_truetype) echo "checked"; ?>>Sim&nbsp;&nbsp;&nbsp;
                  <input type="radio" name="usar_truetype" value="0" <?php if (!$usar_truetype) echo "checked"; ?>>Não -->
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
      <input type="hidden" name="task" value="configuracoes">
      <input type="hidden" name="cat" value="deletar">
      <table width="100%" border="0" cellspacing="0" cellpadding="3">
        <tr bgcolor="#CCCCCC">
          <td colspan="4">
            <h4>Lista de Configurações</h4>
          </td>
        </tr>
        <tr>
          <td width="5" nowrap>&nbsp;</td>
          <td nowrap class="normal"><b>Título</b></td>
          <td width="40%" class="normal"><b>Enviar Boleto por Email ?</b></td>
<!--          <td width="40%" class="normal"><b>Enviar Boleto em PDF Anexado ?</b></td> -->
        </tr>
<?php
$configs = $db_api->listaConfiguracoes();
for ($i = 0; $i < count($configs); $i++) {
?>
        <tr bgcolor="<?php echo corLoop($i); ?>">
          <td width="5" nowrap><input type="checkbox" name="configs[]" value="<?php echo $configs[$i]["cid"]; ?>"></td>
          <td nowrap class="normal"><a href="<?php echo $_SERVER['PHP_SELF']; ?>?option=com_mamboleto&task=configuracoes&cat=modificar&cid=<?php echo $configs[$i]["cid"]; ?>"><?php echo htmlspecialchars(stripslashes(ucfirst($configs[$i]["titulo"]))); ?></a></td>
          <td width="40%" class="normal"><?php echo ($configs[$i]["enviar_email"]) ? "Sim" : "Não"; ?></td>
<!--          <td width="40%" class="normal"><?php echo ($configs[$i]["enviar_pdf"]) ? "Sim" : "Não"; ?></td> -->
        </tr>
<?php
}
?>
        <tr>
          <td colspan="4">
            <hr>
          </td>
        </tr>
        <tr>
          <td colspan="4">
<!--            <input type="button" value="Nova Configuração Personalizada" class="button" onClick="javascript:location.href='<?php echo $_SERVER['PHP_SELF']; ?>?option=com_mamboleto&task=configuracoes&cat=novo';">
            &nbsp; 
            <input type="button" value="Deletar" class="button" onClick="javascript:checaRemocao();"> -->
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

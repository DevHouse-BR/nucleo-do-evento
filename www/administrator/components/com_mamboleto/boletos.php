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
// @(#) $Id: boletos.php,v 1.14 2001/12/19 15:53:41 jcpm Exp $
//
$componetfile = '?option=com_mamboleto&task=boletos&';
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
    if (isset($_POST["boletos"])) {
        $db_api->deletarBoletos($_POST["boletos"]);
    }
} elseif ((isset($_POST["cat"])) && ($_POST["cat"] == "update")) {
    $db_api->atualizarBoleto();
} elseif ((isset($_POST["cat"])) && ($_POST["cat"] == "insert")) {
    $db_api->adicionarBoleto();
}

mostraCabecalho($inidata->TITULO_ADMIN_NORMAL);
mostraTitulo("Boletos");
?>
<table width="600" border="0" cellspacing="0" cellpadding="5">
  <tr>
    <td class="normal">
      <b>Essa tela mostra a lista de modelos de boletos disponíveis para uso pelo 
      MamboletoJoomla!. As opções usadas nessa tela irão afetar diretamente a geração do
      boleto, então verifique as suas mudanças clicando no link "Revisar Boleto"
      abaixo. O link "Gerar Templates" serve para gerar código PHP que será usado
      para chamar as funções do MamboletoJoomla! e criar o modelo de boleto especificado.
      <br>
      <br>
      Os modelos de boletos listados aqui são conectados aos dados de Bancos e 
      Configurações Personalizadas, pois eles definem como o modelo de boleto
      deve ser gerado e outras opções de design do mesmo.
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
        extract($db_api->pegaDadosBoleto($_GET["bid"]), EXTR_OVERWRITE);
    }
    inicializar("titulo", "");
    inicializar("bnid", "");
    inicializar("cid", "");
    inicializar("cedente", "");
    inicializar("agencia", "");
    inicializar("agencia_dig", "");
    inicializar("conta_cedente", "");
    inicializar("conta_cedente_dig", "");
    inicializar("especie_documento", "REC");
    inicializar("codigo", "");
    inicializar("sacado", "");
    inicializar("cpf", "");
    inicializar("local_pagamento", "");
    inicializar("sacador", "");
    inicializar("carteira", "");
    inicializar("instrucoes_linha1", "");
    inicializar("instrucoes_linha2", "");
    inicializar("instrucoes_linha3", "");
    inicializar("instrucoes_linha4", "");
    inicializar("instrucoes_linha5", "");
    
    inicializar("demons1", "");
    inicializar("demons2", "");
    inicializar("demons3", "");
    inicializar("demons4", "");
    
    inicializar("convenio", "");

?>
  <tr> 
    <td>
      <script language="JavaScript" src="<? echo $mosConfig_live_site ?>/administrator/components/com_mamboleto/include/functions_boleto.js"></script>

      <script language="JavaScript">
      <!--
      function checaFormulario()
      {
          var checa = document.boleto_form;
          if (isWhitespace(checa.titulo.value)) {
              alert("Por favor digite o título para esse boleto.");
              checa.titulo.focus();
              return false;
          }
          if (checa.bnid.length == 0) {
              alert("Por favor adicione bancos antes de tentar criar um boleto.");
              return false;
          }
          if (checa.cid.length == 0) {
              alert("Por favor adicione uma configuração personalizada antes de tentar criar um boleto.");
              return false;
          }
          if (isWhitespace(checa.cedente.value)) {
              alert("Por favor digite o cedente para esse boleto.");
              checa.cedente.focus();
              return false;
          }
          if (isWhitespace(checa.agencia.value)) {
              alert("Por favor digite a agência para esse boleto.");
              checa.agencia.focus();
              return false;
          }
          if (isWhitespace(checa.codigo.value)) {
              alert("Por favor digite o código para esse boleto.");
              checa.codigo.focus();
              return false;
          }
          if (isWhitespace(checa.carteira.value)) {
              alert("Por favor digite a carteira para esse boleto.");
              checa.carteira.focus();
              return false;
          }
          checa.submit();
      }
      //-->
      </script>
      <form name="boleto_form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
      <input type="hidden" name="option" value="com_mamboleto">
      <input type="hidden" name="task" value="boletos">
      
      <?php if ($_GET["cat"] == "novo") : ?>
      <input type="hidden" name="cat" value="insert">
      <?php elseif ($_GET["cat"] == "modificar") : ?>
      <input type="hidden" name="cat" value="update">
      <input type="hidden" name="bid" value="<?php echo $_GET["bid"]; ?>">
      <?php endif; ?>
      <table width="100%" border="0" cellpadding="1" cellspacing="0">
        <tr bgcolor="#000000">
          <td>
            <table width="100%" border="0" cellspacing="0" cellpadding="3" bgcolor="#999999">
                <tr bgcolor="#0066CC"> 
                  <td colspan="4" nowrap class="normal"><div align="center"><strong><font color="#FF9933">Dados 
                      do Banco</font></strong></div></td>
                </tr>
                <tr> 
                  <td width="34%" nowrap class="normal"><b>T&iacute;tulo do Boleto:</b></td>
                  <td colspan="3" nowrap> <input type="text" name="titulo" size="40" maxlength="30" value="<?php echo $titulo; ?>"> 
                  </td>
                </tr>
                <tr> 
                  <td nowrap class="normal"><b>Banco:</b></td>
                  <td colspan="2"> <select name="bnid">
                      <?php
    $bancos = $db_api->listaBancos();
    for ($i = 0; $i < count($bancos); $i++) {
        $checado = ($bancos[$i]["bnid"] == $bnid) ? "selected" : "";
        echo "<option $checado value=\"" . $bancos[$i]["bnid"] . "\">" . $bancos[$i]["nome"] . "</option>\n";
    }
?>
                    </select> </td>
                  <td align="center"> 
                    <?php if (!empty($bnid)) : ?>
                    <input type="button" value="Modificar Dados do Banco" class="button" onClick="javascript:location.href='<?php echo $_SERVER['PHP_SELF']; ?>?option=com_mamboleto&task=bancos&cat=modificar&bnid=<?php echo $bnid; ?>';"> 
                    <?php endif; ?>
                  </td>
                </tr>
                <tr> 
                  <td nowrap class="normal"><b>Configuração Personalizadas</b></td>
                  <td colspan="2"> <select name="cid">
                      <?php
    $configs = $db_api->listaConfiguracoes();
    for ($i = 0; $i < count($configs); $i++) {
        $checado = ($configs[$i]["cid"] == $cid) ? "checked" : "";
        echo "<option $checado value=\"" . $configs[$i]["cid"] . "\">" . htmlspecialchars(stripslashes($configs[$i]["titulo"])) . "</option>\n";
    }
?>
                    </select> </td>
                  <td align="center"> 
                    <?php if (!empty($cid)) : ?>
                    <input type="button" value="Modificar Configuração" class="button" onClick="javascript:location.href='<?php echo $_SERVER['PHP_SELF']; ?>?option=com_mamboleto&task=configuracoes&cat=modificar&cid=<?php echo $cid; ?>';"> 
                    <?php endif; ?>
                  </td>
                </tr>
                <tr bgcolor="#0066CC"> 
                  <td colspan="4" nowrap class="normal"><div align="center"><strong><font color="#FF9933">Dados 
                      da Conta</font></strong></div></td>
                </tr>
                <tr> 
                  <td nowrap class="normal"><b>Agência / Conta do Cedente:</b></td>
                  <td colspan="3"> <input type="text" name="agencia" size="10" maxlength="10" value="<?php echo $agencia; ?>">
                    - 
                    <input type="text" name="agencia_dig" size="2" maxlength="2" value="<?php echo $agencia_dig; ?>"> 
                    &nbsp;&nbsp;<b>/</b>&nbsp;&nbsp; <input type="text" name="conta_cedente" size="20" maxlength="20" value="<?php echo $conta_cedente; ?>">
                    - 
                    <input type="text" name="conta_cedente_dig" size="2" maxlength="2" value="<?php echo $conta_cedente_dig; ?>"> 
                  </td>
                </tr>
                <tr> 
                  <td nowrap class="normal"><b>Carteira/Convênio:</b></td>
                  <td colspan="3">
                    <input type="text" name="carteira" size="5" maxlength="5" value="<?php echo $carteira; ?>"><b>/</b>
                    <input type="text" name="convenio" size="12" maxlength="12" value="<?php echo $convenio; ?>">
                  </td>
                </tr>
                <tr bgcolor="#0066CC"> 
                  <td colspan="4" nowrap class="normal"><div align="center"><strong><font color="#FF9933">Dados 
                      do boleto</font></strong></div></td>
                </tr>
                <tr> 
                  <td nowrap class="normal"><b>Espécie de Documento:</b></td>
                  <td width="11%"> <input type="text" name="especie_documento" size="10" maxlength="10" value="<?php echo $especie_documento; ?>"> 
                  </td>
                  <td width="10%" align="right"><b>Código:</b></td>
                  <td width="45%"><input type="text" name="codigo" size="5" maxlength="5" value="<?php echo $codigo; ?>"></td>
                </tr>
                <tr> 
                  <td nowrap class="normal"><b>Cedente:</b></td>
                  <td colspan="3"> <input type="text" name="cedente" size="40" maxlength="255" value="<?php echo $cedente; ?>"> 
                  </td>
                </tr>
                <tr> 
                  <td nowrap class="normal"><b>Local Pagamento:</b></td>
                  <td colspan="3"> <input type="text" name="local_pagamento" size="40" maxlength="255" value="<?php echo $local_pagamento; ?>"> 
                  </td>
                </tr>
                
                <tr>
                  <td colspan="4" align='center'> <b>Instruções para pagamento:</b> </td>
                </tr>
                
                <tr> 
                  <td nowrap class="normal"&nbsp;></td>
                  <td colspan="3"> <input type="text" name="instrucoes_linha1" size="40" maxlength="100" value="<?php echo $instrucoes_linha1; ?>"> 
                    <br> <input type="text" name="instrucoes_linha2" size="40" maxlength="100" value="<?php echo $instrucoes_linha2; ?>"> 
                    <br> <input type="text" name="instrucoes_linha3" size="40" maxlength="100" value="<?php echo $instrucoes_linha3; ?>"> 
                    <br> <input type="text" name="instrucoes_linha4" size="40" maxlength="100" value="<?php echo $instrucoes_linha4; ?>"> 
                    <br> <input type="text" name="instrucoes_linha5" size="40" maxlength="100" value="<?php echo $instrucoes_linha5; ?>"> 
                  </td>
                </tr>
                
                
                <tr>
                  <td colspan="4" align='center'> <b>Dados complementares (demonstrativo):</b> </td>
                </tr>

                <tr>
                  <td nowrap class="normal"&nbsp;></td>
                  <td colspan="3">
                         <input type="text" name="demons1" size="40" maxlength="100" value="<?php echo $demons1; ?>">
                    <br> <input type="text" name="demons2" size="40" maxlength="100" value="<?php echo $demons2; ?>">
                    <br> <input type="text" name="demons3" size="40" maxlength="100" value="<?php echo $demons3; ?>">
                    <br> <input type="text" name="demons4" size="40" maxlength="100" value="<?php echo $demons4; ?>">

                  </td>
                </tr>
                
                
                
                <tr> 
                  <td nowrap colspan="4"> <input type="button" value="Salvar" class="button" onClick="javascript:checaFormulario();"> 
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
      <input type="hidden" name="task" value="boletos">
      <input type="hidden" name="cat" value="deletar">
      <table width="100%" border="0" cellspacing="0" cellpadding="3">
        <tr bgcolor="#CCCCCC">
          <td colspan="4">
            <h4>Lista de Boletos</h4>
          </td>
        </tr>
        <tr>
          <td width="5" nowrap>&nbsp;</td>
          <td nowrap class="normal"><b>Banco</b></td>
          <td width="100%" class="normal"><b>Título do Boleto</b></td>
          <td nowrap>&nbsp;</td>
        </tr>
<?php
$boletos = $db_api->listaBoletos();
for ($i = 0; $i < count($boletos); $i++) {
?>
        <tr bgcolor="<?php echo corLoop($i); ?>">
          <td width="5" nowrap><input type="checkbox" name="boletos[]" value="<?php echo $boletos[$i]["bid"]; ?>"></td>
          <td nowrap class="normal"><?php echo $boletos[$i]["nome_banco"]; ?></td>
          <td width="100%" class="normal"><a href="<?php echo $_SERVER['PHP_SELF'] . $componetfile ; ?>cat=modificar&bid=<?php echo $boletos[$i]["bid"]; ?>"><?php echo htmlspecialchars(stripslashes($boletos[$i]["titulo"])); ?></a></td>
          <td nowrap class="normal">
            <a href="index2.php?option=com_mamboleto&task=revisar_boleto&cat=db&cid=<?php echo $boletos[$i]["cid"]; ?>&bid=<?php echo $boletos[$i]["bid"]; ?>">Revisar Boleto</a>&nbsp;&nbsp; <!-- |&nbsp;
            <a href="index2.php?option=com_mamboleto&task=templates&bid=<?php echo $boletos[$i]["bid"]; ?>">Gerar Templates</a> -->
          </td>
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
            <input type="button" value="Novo Boleto" class="button" onClick="javascript:location.href='<?php echo $_SERVER['PHP_SELF']; ?>?option=com_mamboleto&task=boletos&cat=novo';">
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

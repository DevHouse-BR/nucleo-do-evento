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
// @(#) $Id: index.php,v 1.9 2001/12/19 15:53:41 jcpm Exp $
//
error_reporting(E_ALL);
ini_set("include_path", ".");
include_once("include/pre.php");



if ((isset($_POST["tipo"])) && (!empty($_POST["tipo"])) && ($_POST["cat"] == "db")) {
    include_once(BOLETO_INC_PATH . "class.boleto.php");
    
    include_once(BOLETO_INC_PATH . "class.db.php");
    $db_api = Boleto_DB::conectar($inidata->BOLETO_SISTEMA);
    
    extract($db_api->pegaDadosBoleto($_POST["bid"]), EXTR_OVERWRITE);

    extract($db_api->pegaDadosConfiguracao($_POST["cid"]), EXTR_OVERWRITE);

$info = array(
    "tipo"                => $_POST["tipo"], // opcional
    "vencimento"          => implode("/", $_POST["vencimento"]), // opcional
    "nosso_numero"        => $_POST["nosso_numero"],
    "numero_documento"    => "",
    "codigo_barra"        => "",
    "data_documento"      => date("d/m/Y"), // opcional
    "valor_documento"     => $_POST["valor"],
    /* Campos opcionais que podem ser gravados no banco de dados */
    "cgc_cpf"             => $_POST["cpf"],
    "agencia"             => $agencia,       // original era $agencia . $agencia_dig
    "conta_cedente"       => $conta_cedente, // original era $conta_cedente . $conta_cedente_dig
    "convenio"            => $convenio,
    "sacado"              => implode(" ", $_POST["sacado"]),
    "instrucoes_linha1"   => $instrucoes_linha1,
    "instrucoes_linha2"   => $instrucoes_linha2,
    "instrucoes_linha3"   => $instrucoes_linha3,
    "instrucoes_linha4"   => $instrucoes_linha4,
    "instrucoes_linha5"   => $instrucoes_linha5,
    /* Campos normalmente não necessários */
    "acrescimos"          => "",
    "valor_cobrado"       => "",
    "data_processamento"  => "",
    "especificacao_moeda" => "R$",
    "quantidade"          => "",
    "valor_moeda"         => "",
    "descontos"           => "",
    "deducoes"            => "",
    "multa"               => "",
    "demons1"             => $demons1,
    "demons2"             => $demons2,
    "demons3"             => $demons3,
    "demons4"             => $demons4,
    /* Campos para o envio do boleto por email */
    "boletomail"          => $enviar_email,
    "remetente_nome"      => $remetente,
    "remetente_email"     => $remetente_email,
    "recipiente_nome"     => $_POST["recipiente_nome"],
    "recipiente_email"    => $_POST["recipiente_email"],
    "assunto"             => $assunto,
    "mensagem_texto"      => 'Não informada',
    "mensagem_html"       => $mensagem_html,
    "enviar_pdf"          => $enviar_pdf, // funcionará somente se 'tipo' for diferente de 'pdf'
    "servidor_smtp"       => $servidor_smtp,
    "servidor_http"       => $servidor_http
);


    $boleto = new Boleto;
    $boleto->geraBoleto($info, $_POST["bid"]);
?>

<strong>&nbsp;|&nbsp;&nbsp;<a href="index2.php?option=com_mamboleto&task=revisar_boleto&cat=db&cid=<?php 
echo $_POST["cid"]; ?>&bid=<?php echo $_POST["bid"]; ?>">Voltar para Revisar Boleto</a>&nbsp;&nbsp;|&nbsp;</strong>


<?php
} else {
    include_once(BOLETO_INC_PATH . "comum.php");
    include_once(BOLETO_INC_PATH . "class.ini.php");
    $ini = new File_Ini(BOLETO_CONF_PATH . "phpboleto.ini.php", "#");
    $inidata = (object) $ini->getBlockValues("Admin Geral");


    include_once(BOLETO_INC_PATH . "class.db.php");
    $db_api = Boleto_DB::conectar($inidata->BOLETO_SISTEMA);

    mostraCabecalho($inidata->TITULO_ADMIN_NORMAL);
    mostraTitulo("Revisar Boleto");
    
    
    extract($db_api->pegaDadosBoleto($_GET["bid"]), EXTR_OVERWRITE);

    extract($db_api->pegaDadosConfiguracao($_GET["cid"]), EXTR_OVERWRITE);

//}
?>

<html>
<head>
  <title>phpBoleto - Tela de Testes</title>
  <link rel="stylesheet" href="config/estilo.css" type="text/css">
<script language="JavaScript">
<!--
var submitcount=0;
function validatePrompt (Ctrl, PromptStr) {
    alert (PromptStr)
    Ctrl.focus();
    return;
}
function campovazio(Ctrl, Msg) {
    if (Ctrl.value == "") {
        validatePrompt (Ctrl, Msg)
        return (false);
    } else
        return (true);
}
function isEmail(string) {
    if (string.search(/^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+$/) != -1)
        return true;
    else
        return false;
}
function IsReadyEmail(Field) {
    if(document.forms[0].boletomail.options[document.forms[0].boletomail.selectedIndex].value == "0")
        return true;

    if (isEmail(Field.value) == false) {
        validatePrompt (Field, "Email invalido. Por favor somente letras, digitos e \"._-@\" no \"Email\".");        
        return false;
    }
    return true;
}
function verify()  {
    if (!IsReadyEmail(document.forms[0].email))
        return;

    document.forms[0].submit();
    return;
}
//-->
</script>
</head>

<body bgcolor="#FFFFFF">
 <hr>
  <a href="index2.php?option=com_mamboleto">Menu Principal</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="index2.php?option=com_mamboleto&task=config">Configuração Geral</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="index2.php?option=com_mamboleto&task=boletos">Boletos</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="index2.php?option=com_mamboleto&task=bancos">Bancos</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="index2.php?option=com_mamboleto&task=configuracoes">Configurações Personalizadas</a>

  <form name="revisar_form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
      <input type="hidden" name="option" value="com_mamboleto">
      <input type="hidden" name="task" value="revisar_boleto">
      <input type="hidden" name="cat" value="db">
      <input type="hidden" name="bid" value="<?php echo $_GET["bid"]; ?>">
      <input type="hidden" name="cid" value="<?php echo $_GET["cid"]; ?>">

<table width="600" border="0" cellpadding="1" cellspacing="0" bgcolor="#000000">
  <tr>
    <td>
      <table width="100%" border="0" cellspacing="0" cellpadding="3" bgcolor="#999999">
        <tr>
          <td width="100%" colspan="2" class="normal">
            <b>Dados do Documento</b>
          </td>
        </tr>
        <tr>
          <td width="140" class="normal">Valor:</td>
          <td width="100%">
            <input type="text" name="valor" size="20" value="36,00">
          </td>
        </tr>
        <tr>
          <td width="140" nowrap class="normal">Número do pedido (nosso numero):</td>
          <td width="100%">
            <input type="text" name="nosso_numero" size="20" value="0002">
          </td>
        </tr>
        <tr> 
          <td width="140" class="normal">Vencimento do Título:</td>
          <td width="100%">
            <select name="vencimento[]">
              <option value="01">1</option>
              <option value="02">2</option>
              <option value="03">3</option>
              <option value="04">4</option>
              <option value="05" selected>5</option>
              <option value="06">6</option>
              <option value="07">7</option>
              <option value="08">8</option>
              <option value="09">9</option>
              <option value="10">10</option>
              <option value="11">11</option>
              <option value="12">12</option>
              <option value="13">13</option>
              <option value="14">14</option>
              <option value="15">15</option>
              <option value="16">16</option>
              <option value="17">17</option>
              <option value="18">18</option>
              <option value="19">19</option>
              <option value="20">20</option>
              <option value="21">21</option>
              <option value="22">22</option>
              <option value="23">23</option>
              <option value="24">24</option>
              <option value="25">25</option>
              <option value="26">26</option>
              <option value="27">27</option>
              <option value="28">28</option>
              <option value="29">29</option>
              <option value="30">30</option>
              <option value="31">31</option>
            </select>
            <select name="vencimento[]">
              <option value="01" selected>Janeiro</option>
              <option value="02">Fevereiro</option>
              <option value="03">Marco</option>
              <option value="04">Abril</option>
              <option value="05">Maio</option>
              <option value="06">Junho</option>
              <option value="07">Julho</option>
              <option value="08">Agosto</option>
              <option value="09">Setembro</option>
              <option value="10">Outubro</option>
              <option value="11">Novembro</option>
              <option value="12">Dezembro</option>
            </select>
            <select name="vencimento[]">
              <option value="1997">1997</option>
              <option value="1998">1998</option>
              <option value="1999">1999</option>
              <option value="2000">2000</option>
              <option value="2001">2001</option>
              <option value="2002">2002</option>
              <option value="2003">2003</option>
              <option value="2004">2004</option>
              <option value="2005">2005</option>
              <option value="2006">2006</option>
              <option value="2007" selected>2007</option>
              <option value="2008">2008</option>
              <option value="2009">2009</option>
              <option value="2010">2010</option>
              <option value="2011">2011</option>
              <option value="2012">2012</option>
              <option value="2013">2013</option>
              <option value="2014">2014</option>
              <option value="2015">2015</option>
              <option value="2016">2016</option>
              <option value="2017">2017</option>
              <option value="2018">2018</option>
              <option value="2019">2019</option>
              <option value="2020">2020</option>
            </select>
          </td>
        </tr>
        <tr>
          <td colspan="2" width="100%" class="normal">
            <hr>
            <b>Dados do Sacado</b>
          </td>
        </tr>
        <tr>
          <td width="140" class="normal">Nome/Razão Social:</td>
          <td width="100%">
            <input type="text" name="sacado[nome]" size="30" value="Nome do Cliente">
          </td>
        </tr>
        <tr>
          <td width="140" class="normal">C.G.C./C.P.F.:</td>
          <td width="100%">
            <input type="text" name="cpf" size="20" value="123.456.789-01">
          </td>
        </tr>
        <tr>
          <td width="140" class="normal">Endereço:</td>
          <td width="100%">
            <input type="text" name="sacado[endereco]" size="30" value="R. Endereço, 2007">
          </td>
        </tr>
        <tr>
          <td width="140" class="normal">Bairro:</td>
          <td width="100%">
            <input type="text" name="sacado[bairro]" size="20" value="Bairro">
          </td>
        </tr>
        <tr>
          <td width="140" class="normal">CEP:</td>
          <td width="100%">
            <input type="text" name="sacado[cep]" size="10" value="96800-000">
          </td>
        </tr>
        <tr>
          <td width="140" class="normal">Estado:</td>
          <td width="100%">
            <select size="1" name="sacado[estado]">
              <option value="SP">SP</option>
              <option value="AC">AC</option>
              <option value="AL">AL</option>
              <option value="AM">AM</option>
              <option value="AP">AP</option>
              <option value="BA">BA</option>
              <option value="CE">CE</option>
              <option value="DF">DF</option>
              <option value="ES">ES</option>
              <option value="GO">GO</option>
              <option value="MA">MA</option>
              <option value="MG">MG</option>
              <option value="MS">MS</option>
              <option value="MT">MT</option>
              <option value="PA">PA</option>
              <option value="PB">PB</option>
              <option value="PE">PE</option>
              <option value="PI">PI</option>
              <option value="PR">PR</option>
              <option value="RN">RN</option>
              <option value="RO">RO</option>
              <option value="RR">RR</option>
              <option value="RJ">RJ</option>
              <option value="RS" selected>RS</option>
              <option value="SC">SC</option>
              <option value="SE">SE</option>
              <option value="TO">TO</option>
            </select>
          </td>
        </tr>                                                                        
        <tr>
          <td colspan="2" width="100%" class="normal">
            <hr>
            <b>Dados Complementares</b>
          </td>
        </tr>
        <tr>
          <td width="140" class="normal">Demonstrativo:</td>
          <td width="100%">
            <?php echo $demons1; ?><br>
            <?php echo $demons2; ?><br>
            <?php echo $demons3; ?><br>
            <?php echo $demons4; ?>
          </td>
        </tr>                                            
        <tr>
          <td colspan=2 width="100%" class="normal">
            <hr>
            <b>Dados do Banco</b>
          </td>
        </tr>
        <tr>
        <td><b>Agência / Conta do Cedente:</b></td>
        <td>
          <?php echo $agencia; ?>-<?php echo $agencia_dig; ?>&nbsp;&nbsp;<b>/</b>&nbsp;&nbsp;
          <?php echo $conta_cedente; ?>-<?php echo $conta_cedente_dig; ?>
        </td>
        </tr>                      
        <tr>
        <td><b>Convênio:</b></td>
        <td>
          <?php echo $convenio; ?>
        </td>
        </tr>
        <tr>
          <td width="140" class="normal">Instruções para o Caixa:</td>
          <td width="100%">
            <?php echo $instrucoes_linha1; ?><br>
            <?php echo $instrucoes_linha2; ?><br>
            <?php echo $instrucoes_linha3; ?><br>
            <?php echo $instrucoes_linha4; ?><br>
            <?php echo $instrucoes_linha5; ?>
          </td>
        </tr>
        <tr>
          <td colspan=2 width="100%" class="normal">
            <hr>
            <b>Opções de Geração do Boleto</b>
          </td>
        </tr>      
        <tr>
<!--          <td width="140" class="normal">Formato do Boleto:</td>
          <td width="100%"> -->
            <input type="hidden" name="tipo" size="30" value="html">

<!--            <select name="tipo">
              <option value="html">Boleto em HTML</option>
              <option value="imagem">Boleto em Imagem</option>
              <option value="pdf">Boleto em PDF</option>
              <option value="svg">Boleto em SVG (experimental)</option>
            </select>  -->
          </td>
        </tr>
        <tr>
          <td width="140" class="normal">Mandar Boleto por Email:</td>
          <td width="100%">
            <b> <?php if ($enviar_email) echo "Sim"; else echo "Não";?> </b>
          </td>
        </tr>
        <tr>
<!--          <td width="140" class="normal">Enviar Cópia em Anexo como PDF:</td>
          <td width="100%">
          <b> <?php if ($enviar_pdf) echo "Sim"; else echo "Não";?> </b>
          </td> -->
        </tr>
        <tr>
<?php if ($enviar_email == "1"){ ?>
          <td width="140" class="normal">Assunto:</td>
          <td width="100%">
            <?php echo htmlspecialchars(stripslashes($assunto)); ?>
<?php } ?>
          </td>
        </tr>
        <tr>
<!--          <td width="140" class="normal">Mensagem (html):</td>
          <td width="100%">
            <?php echo htmlspecialchars(stripslashes($mensagem_html)); ?>
          </td> -->
        </tr>
        <tr>
<!--          <td width="140" class="normal">Nome do Remetente:</td>
          <td width="100%">
            <?php echo htmlspecialchars(stripslashes($remetente)); ?>
          </td> -->
        </tr>
        <tr>
<!--          <td width="140" class="normal">Email do Remetente:</td>
          <td width="100%">
            <?php echo htmlspecialchars(stripslashes($remetente_email)); ?>
          </td> -->
        </tr>
        <tr>
<!--          <td width="140" class="normal">Nome do Recipiente:</td> -->
          <td width="100%">
            <input type="hidden" name="recipiente_nome" size="30" value="">
          </td>
        </tr>
        <tr>
<?php if ($enviar_email == "1"){ ?>
          <td width="140" class="normal">Email do Destinatário:</td>
          <td width="100%">
            <input type="text" name="recipiente_email" size="30">
<?php } else { ?>
            <input type="hidden" name="recipiente_email" size="30" value="">
<?php } ?>
          </td>
        </tr>
        <tr>
<!--          <td width="140" class="normal">Servidor SMTP:</td>
          <td width="100%">
            <?php echo htmlspecialchars(stripslashes($servidor_smtp)); ?>
          </td> -->
        </tr>
        <tr>
<!--          <td width="140" class="normal">Servidor HTTP:</td>
          <td width="100%">
            <?php echo htmlspecialchars(stripslashes($servidor_http)); ?>
          </td> -->
        </tr>
        <tr>
          <td colspan="2">
            <hr>
            <input type="submit" value="Gerar Boleto &gt;&gt;" class="button">
          </td>
        </tr>
      </table>
    </td>
  </tr>
</table>
</form>
<?php
}
    mostraRodape();

?>
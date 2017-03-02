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

/* copyright do phpBoleto */
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
/* fim do copyright do phpBoleto */

/********************************************************
* Frontend
* =========
* Como utilizar este script: 
*
* 1 - Passe os valores (pode ser por formulário, pela url, por sessão.. tanto faz) correspondentes a cada campo
*	do boleto (veja a lista abaixo).
*
* 2 - Certifique-se de que está chamando este componente numa nova janela (index2.php?option=com_mamboleto&no_html=0)
*	e que todos os parâmetros estão sendo passados.
*
* -Lista dos valores que podem ser passados para o boleto (atenção! estes valores devem estar no array $info):
*
****** 
     * Estrutura do array associativo que deve ser passado ao método:
     *         "vencimento"          => "20/07/2007",
     *         "nosso_numero"        => "961580786",
     *         "numero_documento"    => "123",
     *         "codigo_barra"        => "",
     *         "data_documento"      => "30/07/2007",
     *         "valor_documento"     => "1250,00",
     *
     * Parâmetros opcionais que normalmente são gravados no banco de dados:
     *
     *         "cgc_cpf"             => "23569870255",
     *         "sacado"              => "nome do sacado",
     *         "endereco"            => "endereço do sacado",
     *         "instrucoes_linha1"   => "",
     *         "instrucoes_linha2"   => "",
     *         "instrucoes_linha3"   => "",
     *         "instrucoes_linha4"   => "",
     *         "instrucoes_linha5"   => "",
     *         "demons1"   		 => "",
     *         "demons2"   		 => "",
     *         "demons3"   		 => "",
     *         "demons4"   		 => "",
     *
     * Parâmetros normalmente não necessários:
     *
     *         "acrescimos"          => "",
     *         "valor_cobrado"       => "",
     *         "data_processamento"  => "",
     *         "especificacao_moeda" => "R$",
     *         "quantidade"          => "",
     *         "valor_moeda"         => "",
     *         "descontos"           => "",
     *         "deducoes"            => "",
     *         "multa"               => "",
     *
     * Parâmetros necessários somente para o envio do boleto por email:
     *
     *         "boletomail"          => "1",
     *         "recipiente_email"    => "email@provedor.com.br",
     *         "assunto"             => "Boleto ref. pedido nr. 123",
******
*
* - NOTAS: Matheus Mendes (www.joomla.com.br)
*
****** @access  public
     *
     * @param   int $id_boleto 	O ID do boleto, relacionando o banco de dados. 
     *                         	Esse número será algo conhecido pelo usuário 
     *                         	através da interface de administração.
     *
     * @param   array $info 		Parâmetros de criação do boleto. Muitos deles são na
     *                      		verdade parâmetros opcionais, e servem como um modo 
     *                      		dinâmico de se criar boletos, sem necessariamente 
     *                      		modificar as opções apropriadas pela interface de 
     *                      		administração.
     *
     * @return  void 			dependendo do modelo de boleto
     *
     * @see     geraBoleto()
     *
******
*
* Não importa como esses dados irão chegar, contanto que eles cheguem.
* Pode ser phpShop, osCommerce, Facile Forms, Mãe Dinah.... 
*
*********************************************************/


include_once( $mosConfig_absolute_path . "/administrator/components/com_mamboleto/include/pre.php");

include_once( BOLETO_INC_PATH . "class.boleto.php");


//original $tipo = mosGetParam( $_REQUEST, 'tipo', 'html'); // só tá funcionando o html

$tipo = 'html'; // só tá funcionando o html

$data_documento = mosGetParam( $_REQUEST, 'data_documento', date("d/m/Y")); // opcional
$vencimento = mosGetParam( $_REQUEST, 'vencimento', date("d/m/Y", time()+60*60*24*7)); 
$nosso_numero = mosGetParam( $_REQUEST, 'nosso_numero', 0);
$numero_documento = mosGetParam( $_REQUEST, 'numero_documento', 0);
//$codigo_barra = "";
$codigo_barra = mosGetParam( $_REQUEST, 'codigo_barra', '');
$valor_documento  = str_replace('.',',',number_format(mosGetParam( $_REQUEST, 'valor_documento', "0"), 2, ',', ' ') );
$id = mosGetParam( $_REQUEST, 'id', 6);
$s_nome = mosGetParam( $_REQUEST, 'sacado', 'Não informado');
$s_end = mosGetParam( $_REQUEST, 'endereco', '');
$cgc_cpf = mosGetParam( $_REQUEST, 'cgc_cpf', '');

$instrucoes_linha1 = mosGetParam( $_REQUEST, 'instrucoes_linha1', '');
$instrucoes_linha2 = mosGetParam( $_REQUEST, 'instrucoes_linha2', '');
$instrucoes_linha3 = mosGetParam( $_REQUEST, 'instrucoes_linha3', '');
$instrucoes_linha4 = mosGetParam( $_REQUEST, 'instrucoes_linha4', '');
$instrucoes_linha5 = mosGetParam( $_REQUEST, 'instrucoes_linha5', '');
$demons1 = mosGetParam( $_REQUEST, 'demons1', '');
$demons2 = mosGetParam( $_REQUEST, 'demons2', '');
$demons3 = mosGetParam( $_REQUEST, 'demons3', '');
$demons4 = mosGetParam( $_REQUEST, 'demons4', '');
$data_processamento = mosGetParam( $_REQUEST, 'data_processamento', '');
$especificacao_moeda = mosGetParam( $_REQUEST, 'especificacao_moeda', '');

if (!empty($_REQUEST['quantidade'])){$quantidade = str_replace('.',',',number_format(mosGetParam( $_REQUEST, 'quantidade', "0"), 2, ',', ' ') );}
else {$quantidade = '';}
if (!empty($_REQUEST['valor_moeda'])){$valor_moeda = str_replace('.',',',number_format(mosGetParam( $_REQUEST, 'valor_moeda', "0"), 2, ',', ' ') );}
else {$valor_moeda = '';}
if (!empty($_REQUEST['descontos'])){$descontos = str_replace('.',',',number_format(mosGetParam( $_REQUEST, 'descontos', "0"), 2, ',', ' ') );}
else {$descontos = '';}
if (!empty($_REQUEST['deducoes'])){$deducoes = str_replace('.',',',number_format(mosGetParam( $_REQUEST, 'deducoes', "0"), 2, ',', ' ') );}
else {$deducoes = '';}
if (!empty($_REQUEST['multa'])){$multa = str_replace('.',',',number_format(mosGetParam( $_REQUEST, 'multa', "0"), 2, ',', ' ') );}
else {$multa = '';}
if (!empty($_REQUEST['acrescimos'])){$acrescimos = str_replace('.',',',number_format(mosGetParam( $_REQUEST, 'acrescimos', "0"), 2, ',', ' ') );}
else {$acrescimos = '';}
if (!empty($_REQUEST['valor_cobrado'])){$valor_cobrado = str_replace('.',',',number_format(mosGetParam( $_REQUEST, 'valor_cobrado', "0"), 2, ',', ' ') );}
else {$valor_cobrado = '';}

$boletomail = mosGetParam( $_REQUEST, 'boletomail', '0');
$recipiente_email = mosGetParam( $_REQUEST, 'recipiente_email', '');
$assunto = mosGetParam( $_REQUEST, 'assunto', '');



$info = array(
    "tipo"                => "$tipo",
    "vencimento"          => "$vencimento", 
    "nosso_numero"        => "$nosso_numero",
    "numero_documento"    => "$numero_documento",
    "codigo_barra"        => "$codigo_barra",
    "data_documento"      => "$data_documento",
    "valor_documento"     => "$valor_documento",
    "sacado"              => "$s_nome \n $s_end",
    "cgc_cpf"             => "$cgc_cpf",

    "instrucoes_linha1"   => "$instrucoes_linha1",
    "instrucoes_linha2"   => "$instrucoes_linha2",
    "instrucoes_linha3"   => "$instrucoes_linha3",
    "instrucoes_linha4"   => "$instrucoes_linha4",
    "instrucoes_linha5"   => "$instrucoes_linha5",
    "demons1"   		  => "$demons1",
    "demons2"   		  => "$demons2",
    "demons3"   		  => "$demons3",
    "demons4"   		  => "$demons4",
    "quantidade"   	  => "$quantidade",
    "valor_moeda"   	  => "$valor_moeda",
    "descontos"   	  => "$descontos",
    "deducoes"   		  => "$deducoes",
    "multa"   		  => "$multa",
    "acrescimos"   	  => "$acrescimos",
    "valor_cobrado"   	  => "$valor_cobrado",
    "especificacao_moeda" => "$especificacao_moeda",
    "data_processamento"  => "$data_processamento",

    "assunto"             => "$assunto",
    "boletomail"          => "$boletomail",
    "recipiente_email"    => "$recipiente_email"
);

$boleto = new Boleto;
$boleto->geraBoleto($info, $id);

echo "<!-- gerado por Mamboleto <h1><a href=\"http://www.fernandosoares.com.br\">Fernando Soares</a></h1> -->";
?>

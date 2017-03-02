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
// |          Pablo Martins F. Costa <pablo@users.sourceforge.net>        |
// | Modificado para o Banco Itaú:                                        |
// |          Claudio Pereira <cpereira@brasilenergia.com.br>             |
// +----------------------------------------------------------------------+
//
// @(#) $Id: class.banco.itau.php,v 1.1 2002/08/03 00:10:13 jcpm Exp $
//

require_once(BOLETO_INC_PATH . "boletos" . BOLETO_SEPARADOR . "bancos" . BOLETO_SEPARADOR . "class.banco.comum.php");

class Boleto_Banco_Itau extends Boleto_Banco_Comum
{
    function geraDadosBanco($info)
    {

        // formata o valor do documento para o codigo de barras
        $v = str_replace("R\$", "", $info["valor_documento"]);
        $v = str_replace(chr(44), "", $v);
        $valor = sprintf("%010d", $v);

        // vencimento
        $vence = explode("/", $info["vencimento"]);
        $dvence = $vence[0];
        $mvence = $vence[1];
        $avence = $vence[2];
        $vcto = "$dvence/$mvence/$avence";
        $fatorvcto = $this->_fatorVencimento($avence, $mvence, $dvence);

	$codbank = "341";
	$moeda = "9";

	$cZero ="0"; // nao mexa
	$zero = "000"; // nao mexa
	$cart = $this->_pegaCarteira("7");
	$nosso_numero = sprintf("%08d", $info["nosso_numero"]);

	// Montagem da agencia e conta cedente
	$agencia = substr(sprintf("%04d", $info["agencia"]),0, 4);
	$contacedente = substr(sprintf("%05d", $info["conta_cedente"]),0, 5);

	// calcula DAC de agencia-caontacedente
	$DAC_ACC=$this->_modulo10("$agencia$contacedente");

	//faz o cálculo do DAC do nosso número conf. regras das carteiras
	if (in_array((int)$cart,array(126,131,146,150,168))) {
		$DAC_NN=$this->_modulo10("$cart$nosso_numero");
	} else {
		$DAC_NN=$this->_modulo10("$agencia$contacedente$cart$nosso_numero");
	}

	// 43 numeros para o calculo do digito verificador do código de barras
	$dvcampo = "$codbank$moeda$fatorvcto$valor$cart$nosso_numero$DAC_NN$agencia$contacedente$DAC_ACC$zero";
	$dv =  $this->_modulo11($dvcampo);

	// Numero para o codigo de barras com 44 digitos
	$num = "$codbank$moeda$dv$fatorvcto$valor$cart$nosso_numero$DAC_NN$agencia$contacedente$DAC_ACC$zero";

        // Devolve a linha digitavel
        $linha_digitavel = $this->_montaLinha($num);

        $codigo_banco = $this->_geraCodigoBanco($codbank);

        // nosso numero
        $nosso_numero = "$cart / $nosso_numero-$DAC_NN";

        // agencia/codigo cedente
        $agencia_codigo = "$agencia / $contacedente-$DAC_ACC";

        return array(
            "linha_digitavel" => $linha_digitavel,
            "agencia_codigo"  => $agencia_codigo,
            "codigo_barras"   => $num,
            "codigo_banco"    => $codigo_banco,
            "nosso_numero"    => $nosso_numero
        );
    }


}
?>
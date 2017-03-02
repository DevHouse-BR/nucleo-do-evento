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
// +----------------------------------------------------------------------+
//
// @(#) $Id: class.banco.bradesco.php,v 1.5 2001/10/23 16:51:56 jcpm Exp $
//

require_once(BOLETO_INC_PATH . "boletos" . BOLETO_SEPARADOR . "bancos" . BOLETO_SEPARADOR . "class.banco.comum.php");

class Boleto_Banco_Bradesco extends Boleto_Banco_Comum
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

	$codbank = "237";
	$moeda = "9";
	$zero = "0";

// pega carteira
	$cart = $this->_pegaCarteira("3");
	$cart = substr(sprintf("%02d", $cart),0, 2);

// pega e monta nosso numero
	$nnum = sprintf("%011d", $info["nosso_numero"]);
	$dvnn = $this->_digitoVerificador($nnum);
	$nosso_numero = "$cart/$nnum-$dvnn";


	// Montagem da agencia e conta cedente
	$agencia = substr(sprintf("%04d", $info["agencia"]),0, 4);
	$contacedente = substr(sprintf("%07d", $info["conta_cedente"]), 0, 7);


	// 43 numeros para o calculo do digito verificador
	$dvcampo = "$codbank$moeda$fatorvcto$valor$agencia$cart$nnum$contacedente$zero";
	$dv =  $this->_modulo11($dvcampo);

	// Numero para o codigo de barras com 44 digitos
	$num = "$codbank$moeda$dv$fatorvcto$valor$agencia$cart$nnum$contacedente$zero";

        // Devolve a linha digitavel
        $linha_digitavel = $this->_montaLinha($num);
        $codigo_banco = $this->_geraCodigoBanco($codbank);

	// montagem agencia/codigo cedente
	$p1 = $this->_digitoVerificador($agencia);
	$p2 = $this->_digitoVerificador($contacedente);
	$agencia_codigo = "$agencia-$p1 / $contacedente-$p2";

        return array(
            "linha_digitavel" => $linha_digitavel,
            "agencia_codigo"  => $agencia_codigo,
            "codigo_barras"   => $num,
            "codigo_banco"    => $codigo_banco,
            "nosso_numero"    => $nosso_numero
        );
    }

    function _digitoVerificador($numero)
    {
        $resto = $this->_modulo11($numero, 9, 1);
        $digito = 11 - $resto;
        if ($resto == 1) {
            $digito = "P";
        } elseif ($resto == 0) {
            $digito = 0;
        }
        return $digito;
    }
}
?>
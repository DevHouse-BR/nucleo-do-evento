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
// @(#) $Id: class.banco.cef.php, v.2.0 RC1 $
//

require_once(BOLETO_INC_PATH . "boletos" . BOLETO_SEPARADOR . "bancos" . BOLETO_SEPARADOR . "class.banco.comum.php");

class Boleto_Banco_Cef extends Boleto_Banco_Comum
{
    function geraDadosBanco($info)
    {

	$codbank = "104";
	$moeda = "9";

// constante referente ao código da carteira
	$YYY = "870";

        // formatacao do numero para o codigo de barras
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

	$nnum = sprintf("%09d", $info["nosso_numero"]);

	$cart = $this->_pegaCarteira("7");
	$agencia = substr(sprintf("%04d", $info["agencia"]),0, 4);

// código do cedente (numero do convenio)
	$nconvenio = substr(sprintf("%08d", $info["convenio"]), -8);

// efetua formação do nosso número de acordo com a carteira
	if (strtoupper($cart) == "CR"){
		$nnum =  substr($nnum, -9);
		$nosso_numero = "9$nnum";
	} else {
		$nnum =  substr($nnum, -8);
		$nosso_numero = "82$nnum";
	}


// monta agencia-código do cedente-dv
	$agcod = "$agencia$YYY$nconvenio";
	$dvcc = $this->_calculaDV($agcod);
	$agcod = "$agencia$YYY$nconvenio-$dvcc";
	
// monta nosso numero-dv
	$dvnn = $this->_calculaDV($nosso_numero);
	$nnum = "$nosso_numero-$dvnn";

	// 43 numeros para o calculo do digito verificador do código de barras
	$dvcampo = "$codbank$moeda$fatorvcto$valor$nosso_numero$agencia$YYY$nconvenio";
	$dv = $this->_modulo11($dvcampo);


	// Numero para o codigo de barras com 44 digitos
	$num = "$codbank$moeda$dv$fatorvcto$valor$nosso_numero$agencia$YYY$nconvenio";

        // Devolve a linha digitavel
        $linha_digitavel = $this->_montaLinha($num);
        $codigo_banco = $this->_geraCodigoBanco($codbank);

        return array(
            "linha_digitavel" => $linha_digitavel,
            "agencia_codigo"  => $agcod,
            "codigo_barras"   => $num,
            "codigo_banco"    => $codigo_banco,
            "nosso_numero"    => $nnum
        );

    }

// cálculo do DV
	function _calculaDV($numero)
	{
		$resto = $this->_modulo11($numero,9,1);
		$dv = 11 - $resto;
			if ($dv > 9){
				$dv = 0;
			}
		return $dv;
	}

}
?>
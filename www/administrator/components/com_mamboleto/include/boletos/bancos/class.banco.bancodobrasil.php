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
// |          Miguel Angelo Crosariol <miguel@assintel.com.br>            |
// +----------------------------------------------------------------------+
//
// @(#) $Id: class.banco.bancodobrasil.php,v 1.3 2001/12/06 22:29:47 jcpm Exp $
//

require_once(BOLETO_INC_PATH . "boletos" . BOLETO_SEPARADOR . "bancos" . BOLETO_SEPARADOR . "class.banco.comum.php");

class Boleto_Banco_BancodoBrasil extends Boleto_Banco_Comum
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


        /* VARIAVEIS */
	
	$codbank = "001"; // numero do banco do brasil
	$nmoeda = "9"; // moeda (R$)
	$zeroslivres = "000000";

	// numero do convenio
	$nconvenio = $info["convenio"];

	// numero da carteira
	$cart = $this->_pegaCarteira("6");

	// Montagem da agencia e conta cedente
	$agencia = substr(sprintf("%04d", $info["agencia"]), 0, 4);

	// pega e normatiza o número da conta do cedente para 8 dígitos sem o DV
	$contacedente = substr(sprintf("%08d", $info["conta_cedente"]),0, 8);

	if (strlen ($nconvenio) <= "6"){
		if (strlen ($nconvenio) <= "4"){
			$tamnnum = "7";
			$nconvenio = substr(sprintf("%04d", $nconvenio),0,4);
			$nnum = substr(sprintf("%0".$tamnnum."d", $info["nosso_numero"]),0, $tamnnum);

			// 43 numeros para o calculo do digito verificador
			$dvcampo = "$codbank$nmoeda$fatorvcto$valor$nconvenio$nnum$agencia$contacedente$cart";
			$dv = $this->_modulo11($dvcampo);

			// Numero para o codigo de barras com 44 digitos
			$num="$codbank$nmoeda$dv$fatorvcto$valor$nconvenio$nnum$agencia$contacedente$cart";

			// calcula DV convenio - nosso numero
			$nosso_numero = "$nconvenio$nnum-" . $this->_modulo11("$nconvenio$nnum");

		} else {
			$tamnnum = "5";
			$nconvenio = substr(sprintf("%06d", $nconvenio),0,6);
			if ($info["codigo"] == "1"){
				$nnum = substr(sprintf("%0".$tamnnum."d", $info["nosso_numero"]),0, $tamnnum);

				// 43 numeros para o calculo do digito verificador
				$dvcampo = "$codbank$nmoeda$fatorvcto$valor$nconvenio$nnum$agencia$contacedente$cart";
				$dv = $this->_modulo11($dvcampo);

				// Numero para o codigo de barras com 44 digitos
				$num="$codbank$nmoeda$dv$fatorvcto$valor$nconvenio$nnum$agencia$contacedente$cart";

				// calcula DV convenio - nosso numero
				$nosso_numero = "$nconvenio$nnum-" . $this->_modulo11("$nconvenio$nnum");

			} elseif ($info["codigo"] == "2"){
				$tamnnum = "17";
				$nservico = "21";
				$nnum = substr(sprintf("%0".$tamnnum."d", $info["nosso_numero"]),0, $tamnnum);

				// 43 numeros para o calculo do digito verificador
				$dvcampo = "$codbank$nmoeda$fatorvcto$valor$nconvenio$nnum$nservico";
				$dv = $this->_modulo11($dvcampo);

				// Numero para o codigo de barras com 44 digitos
				$num="$codbank$nmoeda$dv$fatorvcto$valor$nconvenio$nnum$nservico";

				// calcula DV convenio - nosso numero
				$nosso_numero = $nnum;

			}

		}


	} elseif (strlen ($nconvenio) == "7"){
		$tamnnum = "10";
		$nnum = substr(sprintf("%0".$tamnnum."d", $info["nosso_numero"]),0, $tamnnum);

		// 43 numeros para o calculo do digito verificador
		$dvcampo = "$codbank$nmoeda$fatorvcto$valor$zeroslivres$nconvenio$nnum$cart";
		$dv = $this->_modulo11($dvcampo);

		// Numero para o codigo de barras com 44 digitos
		$num="$codbank$nmoeda$dv$fatorvcto$valor$zeroslivres$nconvenio$nnum$cart";

		// calcula DV convenio - nosso numero
		$nosso_numero = "$nconvenio$nnum";


	} elseif (strlen ($nconvenio) == "8"){
		$tamnnum = "9";
		$nnum = substr(sprintf("%0".$tamnnum."d", $info["nosso_numero"]),0, $tamnnum);

		// 43 numeros para o calculo do digito verificador
		$dvcampo = "$codbank$nmoeda$fatorvcto$valor$zeroslivres$nconvenio$nnum$cart";
		$dv = $this->_modulo11($dvcampo);

		// Numero para o codigo de barras com 44 digitos
		$num="$codbank$nmoeda$dv$fatorvcto$valor$zeroslivres$nconvenio$nnum$cart";

		// calcula DV convenio - nosso numero
		$nosso_numero = "$nconvenio$nnum-" . $this->_modulo11("$nconvenio$nnum");

	}

        // Devolve a linha digitavel
        $linha_digitavel = $this->_montaLinha($num);
        $codigo_banco = $this->_geraCodigoBanco($codbank);


        /* AGENCIA / CONTACEDENTE*/
        $p0 = $this->_digitoVerificador($agencia);
        $p1 = $this->_digitoVerificador($contacedente);
        $agencia_codigo = "$agencia-$p0 / $contacedente-$p1";

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
           $digito = "X";		//corrigido o DV para X quando o resto for 1...conforme documentação do BB
        } elseif ($resto == 0) {
           $digito = 0;
        }
        return $digito;
    }

}
?>

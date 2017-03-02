<?php
/*
* *- *- *- *- *- *- MAMBOLETO Joomla! -* -* -* -* -* -*
* @version 2.0 BETA2
* @author Fernando Soares
* @copyright Fernando Soares - http://www.fernandosoares.com.br/
* @date Maio, 2007
* @package Joomla! 1.1.12 e Virtuemart 1.0.10

Baseado no trabalho de 	Matheus Mendes e Pedro Müller ( contato@mambopros.net )
				Messuka ( messuka@messuka.com.br )
				Metasig http://www.metasig.com.br
*/
//
// 	class.banco.banrisul.php	v.1.0		07/05/2007
//

require_once(BOLETO_INC_PATH . "boletos" . BOLETO_SEPARADOR . "bancos" . BOLETO_SEPARADOR . "class.banco.comum.php");

class Boleto_Banco_BancoBanrisul extends Boleto_Banco_Comum
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
	
	$cZero ="0"; // nao mexa
	$nmoeda = "9"; // moeda (R$)
	$codbank = "041"; // numero do Banco Banrisul

	$produto = "2"; 	// constante - não mexa
	$constante = "1";	// constante - não mexa


	// pega e formata o numero do convenio
	$nconvenio = substr(sprintf("%07d", $info["convenio"]),0, 7);

	// pega e formata o nosso numero
	$nnum = substr(sprintf("%08d", $info["nosso_numero"]),0,8);

	// calcula DV do nosso número e monta nosso numero com DV
	$p = $this->DuploDV_Banrisul($nnum);
	$nosso_numero = "$nnum-$p";

	// Montagem da agencia e conta cedente
	$agencia = substr(sprintf("%03d", $info["agencia"]), 0, 3);

	// pega a conta do cedente e formata com 9 digitos sem DV
	$contacedente = substr(sprintf("%09d", $info["conta_cedente"]),0,9);

	// cálculo do duplo digito verificador 
	$dvcpo = "$codbank$nmoeda$fatorvcto$valor$produto$constante$agencia$contacedente$nnum$codbank";
	$ddcb = $this->DuploDV_Banrisul($dvcpo);


	// montagem da linha para cálculo do dac
	$cpodac = "$codbank$nmoeda$fatorvcto$valor$produto$constante$agencia$nconvenio$nnum$codbank$ddcb";
	
	//calculando o DAC
	$dac = $this->_modulo11($cpodac);

	// Numero para o codigo de barras com 44 digitos
	$num = "$codbank$nmoeda$dac$fatorvcto$valor$produto$constante$agencia$nconvenio$nnum$codbank$ddcb";


        // Devolve a linha digitavel
        $linha_digitavel = $this->_montaLinha($num);
        $codigo_banco = $this->_geraCodigoBanco($codbank);


        /* AGENCIA / CONTACEDENTE*/
        $p0 = $this->DuploDV_Banrisul($agencia);
        $p1 = $this->DuploDV_Banrisul($nconvenio);
        $agencia_codigo = "$agencia-$p0 / $nconvenio-$p1";

        return array(
            "linha_digitavel" => $linha_digitavel,
            "agencia_codigo"  => $agencia_codigo,
            "codigo_barras"   => $num,
            "codigo_banco"    => $codigo_banco,
            "nosso_numero"    => $nosso_numero
        );
    }

	function DuploDV_Banrisul($dvcampo)
	{
        // calculando o primeiro DV do nosso número
		//$dvcampo = $nnum;
		$dvnnum1 = $this->_modulo10($dvcampo, 1);

        // calculando o segundo DV do nosso número
		$dvcampo2 = "$dvcampo$dvnnum1";
		for ($resto = $this->_modulo11($dvcampo2,7,2);$resto == 1;){
			if ($dvnnum1 == 9){
				$dvnnum1 = 0;
			} else {
				$dvnnum1 = $dvnnum1 + 1;
			}
			$dvcampo1 = "$dvcampo$dvnnum1";
			$resto = $this->_modulo11($dvcampo1,7,2);
		}
		if ($resto == 0){
			$dvnnum2 = $resto;
		} else {
			$dvnnum2 = 11 - $resto;
		}
		$dd = "$dvnnum1$dvnnum2";
	//	$dvcampo = "$dvcampo$dd";
	return $dd;
	}
}
?>

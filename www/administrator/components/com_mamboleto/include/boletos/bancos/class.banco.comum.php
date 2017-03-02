<?php
/*
* *- *- *- *- *- *- MAMBOLETO Joomla! -* -* -* -* -* -*
* @version 2.0 BETA2
* @author Fernando Soares
* @copyright Fernando Soares - http://www.fernandosoares.com.br/
* @date Maio, 2007
* @package Joomla! 1.1.12 e Virtuemart 1.0.10
*
* >> FORAM ACRESCENTADAS NOVAS FUNÇÕES E CORRIGIDAS OUTRAS TANTAS...VEJA AS OBSERVAÇÕES!

Baseado no trabalho de 	Matheus Mendes e Pedro Müller ( contato@mambopros.net )
				Messuka ( messuka@messuka.com.br )
				Metasig http://www.metasig.com.br

NÃO USE ESSE CLASSE COMO UM BANCO!

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
// @(#) $Id: class.banco.comum.php,v 1.5 2002/07/31 01:03:17 jcpm Exp $
//

class Boleto_Banco_Comum
{
// Calcula o fator de vencimento

    function _fatorVencimento($ano, $mes, $dia)
    {
        return(abs(($this->_dateToDays("1997","10","07")) - ($this->_dateToDays($ano, $mes, $dia))));
    }


// Função auxiliar no cálculo do fator de vencimento

    function _dateToDays($year,$month,$day)
    {
        $century = substr($year, 0, 2);
        $year = substr($year, 2, 2);
        if ($month > 2) {
            $month -= 3;
        } else {
            $month += 9;
            if ($year) {
                $year--;
            } else {
                $year = 99;
                $century --;
            }
        }

        return ( floor((  146097 * $century)    /  4 ) +
                floor(( 1461 * $year)        /  4 ) +
                floor(( 153 * $month +  2) /  5 ) +
                    $day +  1721119);
    }

// Calcula o Módulo11

    function _modulo11($num, $base=9, $r=0)
    {
        /**
         *   Autor:
         *           Pablo Costa <pablo@users.sourceforge.net>
	 *
	 *   Modificado por:
	 *	Fernando Soares - Janeiro/2007 - http://www.fernandosoares.com.br
         *
         *   Função:
         *    Calculo do Modulo 11 para geracao do digito verificador 
         *    de boletos bancarios conforme documentos obtidos 
         *    da Febraban - www.febraban.org.br 
         *
         *   Entrada:
         *     $num: string numérica para a qual se deseja calcularo digito verificador;
         *     $base: valor máximo de multiplicacao [2 até $base]
         *     $r: quando especificado "1" devolve somente o resto
	 *		>> normalmente utilizado no cálculo do digito verificador do número do banco
         *
         *   Saída:
         *     Retorna o Digito Controlador.
         *
         *   Observações:
         *     - Script desenvolvido sem nenhum reaproveitamento de código pré existente.
         *     - Assume-se que a verificação do formato das variáveis de entrada é feita antes da execução deste script.
         */                                        

        $soma = 0;
        $fator = 2;

        /* Separacao dos numeros */
        for ($i = strlen($num); $i > 0; $i--) {

            $numeros[$i] = substr($num,$i-1,1);		// pega cada numero isoladamente

            $parcial[$i] = $numeros[$i] * $fator;	// Efetua multiplicação do número pelo falor

            $soma += $parcial[$i];	// Soma dos resultados parciais

            if ($fator == $base) {	// faz com que o fator de multiplicação
                $fator = 1;		// seja restaurado para 2
            }				// no próximo cálculo

            $fator++;	//acresce 1 ao fator de multiplicação
        }

        /* Calculo do modulo 11 */
        if ($r == 0) {
            $soma *= 10;
            $digito = $soma % 11;
		if (in_array((int)$digito,array(0,1,10,11))) {
            $digito = 1;
            }
            return $digito;
        } elseif ($r == 1){
            $resto = $soma % 11;
            return $resto;
        } elseif ($r == 2){
		if ($soma < 11){
			return $soma;
		}
		$resto = $soma % 11;
		return $resto;
 	  }
    }

    function _modulo10($num, $r=0)
    {
        /*
            Autor:
                    Pablo Costa <pablo@users.sourceforge.net>
            Função:
                    Calculo do Modulo 10 para geracao do digito verificador 
                    de boletos bancarios conforme documentos obtidos 
                    da Febraban - www.febraban.org.br 

            Entrada:
                    $num: string numérica para a qual se deseja calcularo digito verificador;

		    $r: quando informado "1" faz o cáculo de acordo como regulamento do banrisul 

            Saída:
                    Retorna o Digito verificador.

            Observações:
                    - Script desenvolvido sem nenhum reaproveitamento de código pré existente.
                    - Assume-se que a verificação do formato das variáveis de entrada é feita antes da execução deste script.
        */                                        

        $numtotal10 = 0;
        $fator = 2;

        // Separacao dos numeros
        for ($i = strlen($num); $i > 0; $i--) {

            // pega cada numero isoladamente
            $numeros[$i] = substr($num,$i-1,1);

            // Efetua multiplicacao do numero pelo fator de multiplicação
		if ($r == 0){
            		$parcial10[$i] = $numeros[$i] * $fator;
		} elseif ($r == 1){
			$parcial10[$i] = $numeros[$i] * $fator;
			if ($parcial10[$i] > 9){
				$parcial10[$i] = $parcial10[$i] - 9;
			}
		}

            // monta sequencia para soma dos digitos no (modulo 10)
            $numtotal10 .= $parcial10[$i];

	   // intercala o fator de multiplicacao entre 2 e 1 (modulo 10)
            if ($fator == 2) {
                $fator = 1;
            } else {
                $fator = 2;
            }
        }

        $soma = 0;

        // Calculo do modulo 10
        for ($i = strlen($numtotal10); $i > 0; $i--) {
            $numeros[$i] = substr($numtotal10,$i-1,1);
            $soma += $numeros[$i];				
        }

        $resto = $soma % 10;
        $digito = 10 - $resto;
        if ($resto == 0) {
            $digito = 0;
        }

        return $digito;
    }


    function _montaLinha($codigo)
    {
        // Posição 	Conteúdo
        // 1 a 3    Número do banco
        // 4        Código da Moeda - 9 para Real
        // 5        Digito verificador do Código de Barras
        // 6 a 19   Valor (12 inteiros e 2 decimais)
        // 20 a 44  Campo Livre definido por cada banco

        // 1. Campo - composto pelo código do banco, código da moéda, as cinco primeiras posições
        // do campo livre e DV (modulo10) deste campo
        $p1 = substr($codigo, 0, 4);
        $p2 = substr($codigo, 19, 5);
        $p3 = $this->_modulo10("$p1$p2");
        $p4 = "$p1$p2$p3";
        $p5 = substr($p4, 0, 5);
        $p6 = substr($p4, 5);
        $campo1 = "$p5.$p6";

        // 2. Campo - composto pelas posiçoes 6 a 15 do campo livre
        // e livre e DV (modulo10) deste campo
        $p1 = substr($codigo, 24, 10);
        $p2 = $this->_modulo10($p1);
        $p3 = "$p1$p2";
        $p4 = substr($p3, 0, 5);
        $p5 = substr($p3, 5);
        $campo2 = "$p4.$p5";

        // 3. Campo composto pelas posicoes 16 a 25 do campo livre
        // e livre e DV (modulo10) deste campo
        $p1 = substr($codigo, 34, 10);
        $p2 = $this->_modulo10($p1);
        $p3 = "$p1$p2";
        $p4 = substr($p3, 0, 5);
        $p5 = substr($p3, 5);
        $campo3 = "$p4.$p5";

        // 4. Campo - digito verificador do codigo de barras
        $campo4 = substr($codigo, 4, 1);

        // 5. Campo composto pelo valor nominal pelo valor nominal do documento, sem
        // indicacao de zeros a esquerda e sem edicao (sem ponto e virgula). Quando se
        // tratar de valor zerado, a representacao deve ser 000 (tres zeros).
        $campo5 = substr($codigo, 5, 14);

        return "$campo1 $campo2 $campo3 $campo4 $campo5"; 
    }


    function _geraCodigoBanco($numero)
    {

// JANEIRO/2007 - Fernando Soares - http://www.fernandosoares.com.br

//       *   Entrada:
//       *     $numero: número do banco para o qual se quer gerar o digito verificador.
//       *
//       *   Saída:
//       *     Retorna o dígito verificador do número do banco.


        $parte1 = substr($numero, 0, 3);
        $parte2 = 11 - $this->_modulo11($parte1,"9","1");
if (in_array((int)$parte2,array(10,11))) {
            	$parte2 = "0";
		}
    
        return $parte1 . "-" . $parte2;
    }



function _pegaCarteira($IDboleto)
{

// Modificação para que o mamboleto pegue automaticamente do bando de dados o
// número da carteira que até então tinha de ser informado manualmente.
// MAIO/2007 - Fernando Soares - http://www.fernandosoares.com.br
// v.2

//       *   Entrada:
//       *     $IDboleto: ID do boleto do qual deve ser encontrada a carteira correspondente.
//       *
//       *   Saída:
//       *     Retorna o Número da Carteira correspondente.

global $mosConfig_dbprefix;

$ht = file_get_contents (BOLETO_CONF_PATH . BOLETO_SEPARADOR . 'phpboleto.ini.php');
$ht = str_replace('[Admin Geral]','',$ht);
$ht = str_replace('BOLETO_SISTEMA=','',$ht);
$ht = str_replace('VERSAO=',',',$ht);
$ht = str_replace('TITULO_ADMIN_NORMAL=',',',$ht);
$ht = str_replace('[Banco de Dados]','',$ht);
$ht = str_replace('BOLETO_DBTYPE=',',',$ht);
$ht = str_replace('BOLETO_DBHOST=',',',$ht);
$ht = str_replace('BOLETO_DBNAME=',',',$ht);
$ht = str_replace('BOLETO_DBUSER=',',',$ht);
$ht = str_replace('BOLETO_DBPASS=',',',$ht);
list($boleto_sistema, $versao_mamboleto, $titulo_adm, $tipo_db,
$server_db, $nome_db, $usuario_db, $senha_db) = explode(',',$ht);
$boleto_sistema = trim($boleto_sistema);
$versao_mamboleto = trim($versao_mamboleto);
$titulo_adm = trim($titulo_adm);
$tipo_db = trim($tipo_db);
$server_db = trim($server_db);
$nome_db = trim($nome_db);
$usuario_db = trim($usuario_db);
$senha_db = trim($senha_db);


$link = mysql_connect($server_db, $usuario_db, $senha_db);
if (!$link) {
   die('Não foi possível conectar: ' . mysql_error());
	    }

mysql_select_db($nome_db, $link);

$result = mysql_query("SELECT carteira FROM ".$mosConfig_dbprefix."mblto_boletos WHERE bid=$IDboleto");

$cart = mysql_result($result, 0);

mysql_close($link);

return $cart;

}

}
?>
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
// @(#) $Id: class.banco.php,v 1.13 2002/03/16 04:48:01 jcpm Exp $
//


/**
 * A classe Boleto_DB_Banco disponibiliza uma API para o
 * o uso de operações com o banco de dados, seja ele na
 * forma de um servidor de banco de dados completo como
 * o PostgreSQL ou até numa interface mais simples de
 * arquivos INI. Essa API serve como um "wrapper" em
 * volta dos métodos reais que lidam diretamente com esses
 * bancos de dados.
 *
 * @version  2
 * @author   João Prado Maia <jpm@phpbrasil.com>
 */
require_once(BOLETO_INC_PATH . "db" . BOLETO_SEPARADOR . "class.comum.php");

class Boleto_DB_Banco extends Boleto_DB_Comum
{
    var $dbh;
    var $inidb;
    var $ini_path;

    /**
     * Constructor da classe. Inicializa algumas variaveis e
     * conecta com o servidor de banco de dados utilizando
     * para isso o pacote PEAR::DB de abstração de acesso
     * a bancos de dados.
     *
     * @see     _pegaCaminhoConfiguracao(), _pegaConfiguracaoINI(), connect()
     */
    function Boleto_DB_Banco()
    {
		
        $this->_pegaCaminhoConfiguracao();
        $inidata = $this->_pegaConfiguracaoINI();
        require_once(BOLETO_INC_PATH . BOLETO_SEPARADOR . "pear". BOLETO_SEPARADOR . "DB.php");
		
        $dsn = array(
            "phptype"  => $inidata["BOLETO_DBTYPE"],
            "hostspec" => $inidata["BOLETO_DBHOST"],
            'database' => $inidata["BOLETO_DBNAME"],
            'username' => $inidata["BOLETO_DBUSER"],
            'password' => $inidata["BOLETO_DBPASS"]
        );

        $this->dbh = DB::connect($dsn);
        // consertando um bug do DB/common.php
        $this->dbh->prepare_maxstmt = 0;
    }

    /**
     * Método para pegar o nome do arquivo de layout do banco.
     *
     * @access  public
     * @param   string $nome_banco Nome extenso do banco
     * @return  string O nome do arquivo de layout
     * @see     getOne()
     */
    function pegaNomeLayout($nome_banco)
    {
	global $mosConfig_dbprefix;

        $stmt = "SELECT
                    layout
                 FROM
                    ".$mosConfig_dbprefix."mblto_bancos
                 WHERE
                    nome='$nome_banco'";
        return $this->dbh->getOne($stmt);
    }

    /**
     * Método usado na interface de geração de boletos
     * para determinar as opções editadas na interface
     * de administração.
     *
     * @access  public
     * @param   int $id_boleto ID do Boleto
     * @return  array Vetor associativo com o result-set
     * @see     getRow()
     */
    function pegaOpcoesBoleto($id_boleto)
    {
	global $mosConfig_dbprefix;

        $stmt = "SELECT 
                    A.nome AS nome_banco, 
                    A.codigo AS codigo_banco, 
                    A.uso_do_banco, 
                    B.cid, 
                    B.agencia as agencia,
                    B.cedente, 
                    B.conta_cedente as conta_cedente,
                    B.especie_documento, 
                    B.codigo, 

                    B.local_pagamento, 

                    B.carteira, 
                    B.instrucoes_linha1, 
                    B.instrucoes_linha2, 
                    B.instrucoes_linha3, 
                    B.instrucoes_linha4, 
                    B.instrucoes_linha5,
                    B.demons1,
                    B.demons2,
                    B.demons3,
                    B.demons4,
                    B.convenio
                 FROM
                    ".$mosConfig_dbprefix."mblto_bancos A, 
                    ".$mosConfig_dbprefix."mblto_boletos B 
                 WHERE 
                    B.bnid=A.bnid AND 
                    B.bid=$id_boleto";
        $opcoes = $this->dbh->getRow($stmt, DB_FETCHMODE_ASSOC);
        if ($opcoes == false) {
            return "Boleto_Erro";
        } else {
            return $opcoes;
        }
    }

    /**
     * Método usado na interface de geração de boletos
     * para determinar as opções editadas na interface
     * de administração.
     *
     * @access  public
     * @param   int $id_config ID da configuração
     * @return  array Vetor associativo com o result-set
     * @see     getRow()
     */
    function pegaOpcoesConfig($id_config)
    {
	global $mosConfig_dbprefix;

        $stmt = "SELECT * FROM ".$mosConfig_dbprefix."mblto_config WHERE cid=$id_config";
        $opcoes = $this->dbh->getRow($stmt, DB_FETCHMODE_ASSOC);
        if ($opcoes == false) {
            return "Boleto_Erro";
        } else {
            return $opcoes;
        }
    }

    /**
     * Método usado pela interface de administração do phpBoleto
     * para listar os boletos existentes. Um vetor multi-
     * dimensional será retornado.
     *
     * @access  public
     * @return  array Vetor multi-dimensional com o result-set
     * @see     simpleQuery(), numRows(), fetchRow()
     */
    function listaBoletos()
    {
	global $mosConfig_dbprefix;

        $temp = array();

        $stmt = "SELECT
                    A.nome AS nome_banco,
                    B.titulo,
                    B.bid,
                    B.cid
                 FROM
                    ".$mosConfig_dbprefix."mblto_bancos A,
                    ".$mosConfig_dbprefix."mblto_boletos B
                 WHERE
                    A.bnid=B.bnid";
        $result = $this->dbh->simpleQuery($stmt);
        for ($i = 0; $i < $this->dbh->numRows($result); $i++) {
            $row = $this->dbh->fetchRow($result, DB_FETCHMODE_ASSOC);
            $temp[$i] = $row;
        }
        return $temp;
    }

    /**
     * Método usado pela interface de administração do phpBoleto
     * para listar os bancos existentes.
     *
     * @access  public
     * @return  array Vetor multi-dimensional com o result-set
     * @see     getAll()
     */
    function listaBancos()
    {
	global $mosConfig_dbprefix;

        $stmt = "SELECT bnid, layout, nome, codigo FROM ".$mosConfig_dbprefix."mblto_bancos ORDER BY nome ASC";
        return $this->dbh->getAll($stmt, DB_FETCHMODE_ASSOC);
    }

    /**
     * Método usado pela interface de administração do phpBoleto
     * para listar as configurações existentes.
     *
     * @access  public
     * @return  array Vetor multi-dimensional com o result-set
     * @see     getAll()
     */
    function listaConfiguracoes()
    {
	global $mosConfig_dbprefix;

        $stmt = "SELECT cid, titulo, enviar_email, enviar_pdf FROM ".$mosConfig_dbprefix."mblto_config ORDER BY titulo ASC";
        return $this->dbh->getAll($stmt, DB_FETCHMODE_ASSOC);
    }

    /**
     * Método usado pela interface de administração do phpBoleto
     * para deletar boletos.
     *
     * @access  public
     * @param   array $boletos Vetor com IDs de boletos
     * @return  void
     * @see     simpleQuery()
     */
    function deletarBoletos($boletos)
    {
	global $mosConfig_dbprefix;

        $lista = implode(", ", $boletos);
        $stmt = "DELETE FROM ".$mosConfig_dbprefix."mblto_boletos ";
        $stmt .= "WHERE bid IN ($lista)";
        $this->dbh->simpleQuery($stmt);
    }

    /**
     * Método usado pela interface de administração do phpBoleto
     * para deletar bancos.
     *
     * @access  public
     * @param   array $bancos Vetor com IDs de bancos
     * @return  void
     * @see     simpleQuery()
     */
    function deletarBancos($bancos)
    {
	global $mosConfig_dbprefix;

        $lista = implode(", ", $bancos);
        $stmt = "DELETE FROM ".$mosConfig_dbprefix."mblto_bancos ";
        $stmt .= "WHERE bnid IN ($lista)";
        $this->dbh->simpleQuery($stmt);
    }

    /**
     * Método usado pela interface de administração do phpBoleto
     * para deletar configurações.
     *
     * @access  public
     * @param   array $configs Vetor com IDs de configurações
     * @return  void
     * @see     simpleQuery()
     */
    function deletarConfiguracoes($configs)
    {
	global $mosConfig_dbprefix;

        $lista = implode(", ", $configs);
        $stmt = "DELETE FROM ".$mosConfig_dbprefix."mblto_config ";
        $stmt .= "WHERE cid IN ($lista)";
        $this->dbh->simpleQuery($stmt);
    }

    /**
     * Método usado pela interface de administração do phpBoleto
     * para popular o formulário de edição de boletos.
     *
     * @access  public
     * @param   int $bid ID do boleto
     * @return  array Vetor multi-dimensional com o result-set
     * @see     getRow()
     */
    function pegaDadosBoleto($bid)
    {
	global $mosConfig_dbprefix;

        $stmt = "SELECT
                    titulo,
                    bnid,
                    cid,
                    agencia,
                    agencia_dig,
                    cedente,
                    conta_cedente,
                    conta_cedente_dig,
                    especie_documento,
                    codigo,
                    local_pagamento,
                    carteira,
                    instrucoes_linha1,
                    instrucoes_linha2,
                    instrucoes_linha3,
                    instrucoes_linha4,
                    instrucoes_linha5,
                    demons1,
                    demons2,
                    demons3,
                    demons4,
                    convenio
                    
                 FROM
                    ".$mosConfig_dbprefix."mblto_boletos
                 WHERE
                    bid=$bid";
        return $this->dbh->getRow($stmt, DB_FETCHMODE_ASSOC);
    }

    /**
     * Método usado pela interface de administração do phpBoleto
     * para popular o formulário de edição de bancos.
     *
     * @access  public
     * @param   int $bnid ID do banco
     * @return  array Vetor multi-dimensional com o result-set
     * @see     getRow()
     */
    function pegaDadosBanco($bnid)
    {
	global $mosConfig_dbprefix;

        $stmt = "SELECT * FROM ".$mosConfig_dbprefix."mblto_bancos WHERE bnid=$bnid";
        return $this->dbh->getRow($stmt, DB_FETCHMODE_ASSOC);
    }

    /**
     * Método usado pela interface de administração do phpBoleto
     * para popular o formulário de edição de configurações
     * personalizadas.
     *
     * @access  public
     * @param   int $cid ID da configuração
     * @return  array Vetor multi-dimensional com o result-set
     * @see     getRow()
     */
    function pegaDadosConfiguracao($cid)
    {
	global $mosConfig_dbprefix;

        $stmt = "SELECT * FROM ".$mosConfig_dbprefix."mblto_config WHERE cid=$cid";
        return $this->dbh->getRow($stmt, DB_FETCHMODE_ASSOC);
    }

    /**
     * Método usado pela interface de administração para adicionar
     * novos boletos ao banco de dados.
     *
     * @access  public
     * @return  void
     * @see     simpleQuery()
     */
    function adicionarBoleto()
    {
        global $HTTP_POST_VARS, $mosConfig_dbprefix;

        $stmt = "INSERT INTO ".$mosConfig_dbprefix."mblto_boletos
                    (bnid, cid, titulo, agencia, agencia_dig, cedente, conta_cedente,conta_cedente_dig, especie_documento, codigo,  local_pagamento,  carteira, instrucoes_linha1,
                    instrucoes_linha2, instrucoes_linha3, instrucoes_linha4, instrucoes_linha5,demons1,demons2,demons3,demons4,convenio)
                 VALUES
                    (" . $_POST["bnid"] . ", " . $_POST["cid"] . ", '" .
                    rodaSlashes($_POST["titulo"]) . "', '" . rodaSlashes($_POST["agencia"]) .
"', '" . rodaSlashes($_POST["agencia_dig"]) .

"', '" . 
                    rodaSlashes($_POST["cedente"]) . 
                    "', '" . rodaSlashes($_POST["conta_cedente"]) . 
                    "', '" . rodaSlashes($_POST["conta_cedente_dig"]) . 
                    "', '" .
                    rodaSlashes($_POST["especie_documento"]) . "', '" . rodaSlashes($_POST["codigo"]) . "', '" .
                 
                    rodaSlashes($_POST["local_pagamento"]) . "', '"  .
                    rodaSlashes($_POST["carteira"]) .
                     "', '" . rodaSlashes($_POST["instrucoes_linha1"]) . "', '" .
                    rodaSlashes($_POST["instrucoes_linha2"]) . "', '" . rodaSlashes($_POST["instrucoes_linha3"]) . "', '" .
                    rodaSlashes($_POST["instrucoes_linha4"]) .

                     "', '" . rodaSlashes($_POST["demons1"]) . "', '" .
                    rodaSlashes($_POST["demons2"]) . "', '" . rodaSlashes($_POST["demons3"]) . "', '" .
                    rodaSlashes($_POST["demons4"]) .

                    "', '" . rodaSlashes($_POST["instrucoes_linha5"]) .
                    "', '" . rodaSlashes($_POST["convenio"]) .
                    "')";
                 //   echo "<h3>$stmt</h3>";
        $this->dbh->simpleQuery($stmt);
    }

    /**
     * Método usado pela interface de administração para adicionar
     * novos bancos ao banco de dados.
     *
     * @access  public
     * @return  void
     * @see     simpleQuery()
     */
    function adicionarBanco()
    {
        global $_POST, $mosConfig_dbprefix;

        $stmt = "INSERT INTO ".$mosConfig_dbprefix."mblto_bancos
                    (layout, nome, codigo, uso_do_banco)
                 VALUES
                    ('" . rodaSlashes($_POST["layout"]) . "', '" . 
                    rodaSlashes($_POST["nome"]) . "', '" . 
                    rodaSlashes($_POST["codigo"]) . "', '" . 
                    rodaSlashes($_POST["uso_do_banco"]) . "')";
        $this->dbh->simpleQuery($stmt);
    }

    /**
     * Método usado pela interface de administração para adicionar
     * novas configurações ao banco de dados.
     *
     * @access  public
     * @return  void
     * @see     simpleQuery()
     */
    function adicionarConfiguracao()
    {
        global $_POST, $mosConfig_dbprefix;

        $stmt = "INSERT INTO ".$mosConfig_dbprefix."mblto_config
                    (titulo, enviar_email, remetente, remetente_email, assunto, servidor_smtp, servidor_http,
                    imagem_tipo, usar_truetype, enviar_pdf, mensagem_texto, mensagem_html)
                 VALUES
                    ('" . rodaSlashes($_POST["titulo"]) . "', ". $_POST["enviar_email"] . ", '" . rodaSlashes($_POST["remetente"]) . "', '" . 
                    rodaSlashes($_POST["remetente_email"]) . "', '" . rodaSlashes($_POST["assunto"]) . "', '" . 
                    rodaSlashes($_POST["servidor_smtp"]) . "', '" . rodaSlashes($_POST["servidor_http"]) . "', '" . 
                    rodaSlashes($_POST["imagem_tipo"]) . "', " . $_POST["usar_truetype"] . ", " . $_POST["enviar_pdf"] . ", '" . 
                    rodaSlashes($_POST["mensagem_texto"]) . "', '" . rodaSlashes($_POST["mensagem_html"]) . "')";
        $this->dbh->simpleQuery($stmt);
    }

    /**
     * Método usado pela interface de administração para modificar
     * os dados específicos de um boleto.
     *
     * @access  public
     * @return  void
     * @see     simpleQuery()
     */
    function atualizarBoleto()
    {
        global $_POST, $mosConfig_dbprefix;

        $stmt = "UPDATE
                    ".$mosConfig_dbprefix."mblto_boletos
                 SET
                    bnid=" . $_POST["bnid"] . ",
                    cid=" . $_POST["cid"] . ",
                    titulo='" . rodaSlashes($_POST["titulo"]) . "',
                    agencia='" . rodaSlashes($_POST["agencia"]) . "',
                    agencia_dig='" . rodaSlashes($_POST["agencia_dig"]) . "',
                    cedente='" . rodaSlashes($_POST["cedente"]) . "',
                    conta_cedente='" . rodaSlashes($_POST["conta_cedente"]) . "',
                    conta_cedente_dig='" . rodaSlashes($_POST["conta_cedente_dig"]) . "',
                    especie_documento='" . rodaSlashes($_POST["especie_documento"]) . "',
                    codigo='" . rodaSlashes($_POST["codigo"]) . "',
                   
                   
                    local_pagamento='" . rodaSlashes($_POST["local_pagamento"]) . "',
                  
                    carteira='" . rodaSlashes($_POST["carteira"]) . "',
                    instrucoes_linha1='" . rodaSlashes($_POST["instrucoes_linha1"]) . "',
                    instrucoes_linha2='" . rodaSlashes($_POST["instrucoes_linha2"]) . "',
                    instrucoes_linha3='" . rodaSlashes($_POST["instrucoes_linha3"]) . "',
                    instrucoes_linha4='" . rodaSlashes($_POST["instrucoes_linha4"]) . "',
                    instrucoes_linha5='" . rodaSlashes($_POST["instrucoes_linha5"]) . "',
                    demons1='" . rodaSlashes($_POST["demons1"]) . "',
                    demons2='" . rodaSlashes($_POST["demons2"]) . "',
                    demons3='" . rodaSlashes($_POST["demons3"]) . "',
                    demons4='" . rodaSlashes($_POST["demons4"]) . "',
                    convenio='" . rodaSlashes($_POST["convenio"]) . "'
                 WHERE
                    bid=" . $_POST["bid"];
        $this->dbh->simpleQuery($stmt);
    }

    /**
     * Método usado pela interface de administração para modificar
     * os dados específicos de um banco.
     *
     * @access  public
     * @return  void
     * @see     simpleQuery()
     */
    function atualizarBanco()
    {
        global $_POST, $mosConfig_dbprefix;

        $stmt = "UPDATE
                    ".$mosConfig_dbprefix."mblto_bancos
                 SET
                    layout='" . rodaSlashes($_POST["layout"]) . "',
                    nome='" . rodaSlashes($_POST["nome"]) . "',
                    codigo='" . rodaSlashes($_POST["codigo"]) . "',
                    uso_do_banco='" . rodaSlashes($_POST["uso_do_banco"]) . "'
                 WHERE
                    bnid=" . $_POST["bnid"];
        $this->dbh->simpleQuery($stmt);
    }

    /**
     * Método usado pela interface de administração para modificar
     * os dados específicos de uma configuração.
     *
     * @access  public
     * @return  void
     * @see     simpleQuery()
     */
    function atualizarConfiguracao()
    {
        global $_POST, $mosConfig_dbprefix;

        $stmt = "UPDATE
                    ".$mosConfig_dbprefix."mblto_config
                 SET
                    titulo='" . rodaSlashes($_POST["titulo"]) . "',
                    enviar_email=" . $_POST["enviar_email"] . ",
                    remetente='" . rodaSlashes($_POST["remetente"]) . "',
                    remetente_email='" . rodaSlashes($_POST["remetente_email"]) . "',
                    assunto='" . rodaSlashes($_POST["assunto"]) . "',
                    servidor_smtp='" . rodaSlashes($_POST["servidor_smtp"]) . "',
                    servidor_http='" . rodaSlashes($_POST["servidor_http"]) . "',
                    imagem_tipo='" . rodaSlashes($_POST["imagem_tipo"]) . "',
                    usar_truetype=" . $_POST["usar_truetype"] . ",
                    enviar_pdf=" . $_POST["enviar_pdf"] . ",
                    mensagem_texto='" . rodaSlashes($_POST["mensagem_texto"]) . "',
                    mensagem_html='" . rodaSlashes($_POST["mensagem_html"]) . "'
                 WHERE
                    cid=" . $_POST["cid"];
        $this->dbh->simpleQuery($stmt);
    }
}
?>

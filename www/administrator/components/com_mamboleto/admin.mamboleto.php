<?php
/*
* *- *- *- *- *- *- MAMBOLETO Joomla! -* -* -* -* -* -*
* @version 2.0 BETA2
* @author Fernando Soares
* @copyright Fernando Soares - http://www.fernandosoares.com.br/
* @date Abril, 2007
* @package Joomla! 1.1.12 e Virtuemart 1.0.10

Baseado no trabalho de 	Matheus Mendes e Pedro Müller ( contato@mambopros.net )
				Messuka ( messuka@messuka.com.br )
				Metasig http://www.metasig.com.br
*/

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
//
error_reporting(E_ALL);
ini_set("include_path", ".");
include_once("include/pre.php");
include_once(BOLETO_INC_PATH . "comum.php");
include_once(BOLETO_INC_PATH . "class.ini.php");
$ini = new File_Ini(BOLETO_CONF_PATH . "phpboleto.ini.php", "#");
$inidata = (object) $ini->getBlockValues("Admin Geral");

//checaAutenticacao();
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
      
switch ($task){
   case 'config' : include('config.php');
         break;   
   case 'boletos' : include('boletos.php');
         break;   
   case 'bancos' : include('bancos.php');
         break;   
   case 'configuracoes' : include('configuracoes.php');
         break;   	 	 		 
   case 'revisar_boleto' : include('revisar_boleto.php');
         break;   	 	 		
   case 'templates' : include('templates.php');
         break;
   case 'ajuda' : include('ajuda.php');
	   break;
   case 'inicio':
   default:
        include('principal.php');
}
?>
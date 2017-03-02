<?php
defined('_VALID_MOS') or die('Direct Access to this location is not allowed.');
/**
*
* @version $Id: correios_encom_pac.php,v 1.4 24/07/2007 $
* @package VirtueMart
* @subpackage shipping
* @copyright Copyright (C) 2007 Fernando Soares. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* VirtueMart is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See /administrator/components/com_virtuemart/COPYRIGHT.php for copyright notices and details.
*
* http://virtuemart.net
*/

/**
*
* This class will charge a shipping rate determined by passing parameters to 
* Correios Brazilian Post Calculator located at http://www.correios.com.br/ 
* @copyright (C) 2007 Fernando Soares, http://www.fernandosoares.com.br
* Based in auspost.php from (C) 2006 Ben Wilson
*******************************************************************************
*/
class correios_encom_pac {

	var $classname = "correios_encom_pac";

	function list_rates( &$d ) {
		global $total, $tax_total, $CURRENCY_DISPLAY;

		$cart = $_SESSION['cart'];

		/** Read current Configuration ***/
//correção		require_once(CLASSPATH ."shipping/".$this->classname.".cfg.php");
		require(CLASSPATH ."shipping/".$this->classname.".cfg.php");

		if ( $_SESSION['auth']['show_price_including_tax'] != 1 ) {
			$taxrate = 1;
			$order_total = $total + $tax_total;
		}
		else {
			$taxrate = $this->get_tax_rate() + 1;
			$order_total = $total;
		}

		//Create DB User Object for Current User
		$dbu = new ps_DB;
		$q  = "SELECT country,zip FROM #__{vm}_user_info WHERE user_info_id = '". $d["ship_to_info_id"] . "'";
		$dbu->query($q);
		if (!$dbu->next_record()) {
			/*$vmLogger->err( $VM_LANG->_PHPSHOP_CHECKOUT_ERR_SHIPTO_NOT_FOUND );
			return False;*/
		}

		//Create DB Vendor Object for Shop Vendor
		$dbv = new ps_DB;
		$q  = "SELECT * from #__{vm}_vendor, #__{vm}_country WHERE vendor_id='" . $_SESSION["ps_vendor_id"] . "' AND (vendor_country=country_2_code OR vendor_country=country_3_code)";
		$dbv->query($q);
		$dbv->next_record();


		//setup das variáveis para Consulta Correios - Encomenda Normal

		//CEP de Origem (ex. 96840150)
		//$Order_Pickup_Postcode = '96840150';
		$Order_Pickup_Postcode = $dbv->f("vendor_zip");

		//CEP de Destino (ex. 96840150)
		//$Order_Destination_Postcode = '96840150';
		$Order_Destination_Postcode = $dbu->f("zip");


		//Peso dos rodutos (Kg)
		//$Order_WeightKG = '0.300';
		$Order_WeightKG = $d['weight'] ;
		


		//Usei um valor padrão de 25Cm para todas as medidas a seguir:

		//Comprimento médio dos pacotes utilizados para envio pelos Correios(Cm)
		$Order_Length = Comprimento;

		//Largura/Diâmetro médio dos pacotes utilizados para envio pelos Correios(Cm)
		$Order_Width = Larg_Diam;

		//Altura média dos pacotes utilizados para envio pelos Correios(Cm)
		$Order_Height = Altura;
		


		//taxa de empacotamento e manuseio, e será acrescida aos custos de envio retornados pelos Correios
		$Order_Handling_Fee = Handling_Fee;

		//Aviso de Recebimento dos Correios
		$Order_MaoPropria = MaoPropria;

		//Aviso de Recebimento dos Correios
		$Order_Aviso = AvisoReceb;

		//Tipo de embrulho dos Correios
		$Order_Formatos = Formatos;

		//Ponto de obtenção do valor do frete
		$pto = Ponto;



	if ($Order_Formatos = 1) {
	$Opt1 = "&Largura=";
	$Opt2 = "&Altura=".$Order_Height;
	}
	else	{
	$Opt1 = "&Diametro=";
	$Opt2 = "";
	}


	    // Collect variables into the query URI for Correios Brazilian Post

   	    $teste = implode("", file('http://www.correios.com.br/encomendas/precos/calculo.cfm?resposta=paginaCorreios&servico=41106&cepOrigem='.$Order_Pickup_Postcode.'&cepDestino='.$Order_Destination_Postcode.'&peso='.$Order_WeightKG.'&Formato='.$Order_Formatos.'&Comprimento='.$Order_Length.$Opt1.$Order_Width.$Opt2.'&MaoPropria='.$Order_MaoPropria.'&valorDeclarado='. $order_total .'&avisoRecebimento='.$Order_Aviso));
	    preg_match_all("#<b>(.*?)<\/b>#s", $teste, $myfile);



		// Obtém o valor do frete
		$valor = $myfile[1][$pto];
		$APcharge = floatval(str_replace("," , ".", substr($valor,3)));


			$Total_Shipping_Handling = $APcharge + $Order_Handling_Fee;

			$_SESSION[$shipping_rate_id] = 1;

			// THE ORDER OF THOSE VALUES IS IMPORTANT:
			// ShippingClassName|carrier_name|rate_name|totalshippingcosts|rate_id

			$shipping_rate_id = urlencode( $this->classname."|Correios Brasil|Encomenda PAC|".$Total_Shipping_Handling);

			$html .= "\n<input type=\"radio\" name=\"shipping_rate_id\" id=\"correios_encomenda\" checked=\"checked\" value=\"$shipping_rate_id\" />\n";
			$html .= "<label for=\"Correios_encomenda_shipping_rate\">Correios - Encomenda PAC&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- ";
			$html .= $CURRENCY_DISPLAY->getFullValue($Total_Shipping_Handling);
			$html .= " (".$Order_WeightKG." kg)";
			$html .= "</label>";

			$_SESSION[$shipping_rate_id] = 1;

			echo $html;
			return true;
	}

	function get_rate( &$d ) {

	$shipping_rate_id = $d["shipping_rate_id"];
	$is_arr = explode("|", urldecode(urldecode($shipping_rate_id)) );
	$order_shipping = $is_arr[3];

	return $order_shipping;

	}


	function get_tax_rate() {

		/** Read current Configuration ***/
		require_once(CLASSPATH ."shipping/".$this->classname.".cfg.php");

		if( intval(ENCOM_TAX_CLASS)== 0 )
		return( 0 );
		else {
			require_once( CLASSPATH. "ps_tax.php" );
			$tax_rate = ps_tax::get_taxrate_by_id( intval(ENCOM_TAX_CLASS) );
			return $tax_rate;
		}
	}

	/* Validate this Shipping method by checking if the SESSION contains the key
	* @returns boolean False when the Shipping method is not in the SESSION
	*/
	function validate( $d ) {

		$shipping_rate_id = $d["shipping_rate_id"];

		if( array_key_exists( $shipping_rate_id, $_SESSION )) {
			
			return true;
		}
		else {
			return false;
		}
	}
	/**
    * Show all configuration parameters for this Shipping method
    * @returns boolean False when the Shipping method has no configration
    */
	function show_configuration() {
		global $VM_LANG;
		/** Read current Configuration ***/
		require_once(CLASSPATH ."shipping/".$this->classname.".cfg.php");
    ?>
      <table>
    <tr>

	<?php
//Mostra o logo dos correios se este estiver disponível no site dos correios

	$logo_correios = "http://www.correios.com.br/encomendas/servicos/Pac/Imagens/logo_pac1.gif"; //Caminho para o logo dos Correios
	if (@fopen($logo_correios, "r")) {
      echo "<td><img src=$logo_correios alt=\"CORREIOS\"></td>";
	}
	?>

    </tr>
    <tr>
        <td><strong>Ponto de obtenção do valor do frete:</strong>
		</td>
		<td>
            <input type="text" name="Ponto" class="inputbox" value="<?php echo Ponto ?>" />
		</td>
		<td>
            <?php echo mm_ToolTip("Este é o ponto da página dos correios onde é obtido o valor do frete.") ?>
        </td>
    </tr>
    <tr>
        <td><strong>Taxa de empacotamento e manuseio:</strong>
		</td>
		<td>
            <input type="text" name="Handling_Fee" class="inputbox" value="<?php echo Handling_Fee ?>" />
		</td>
		<td>
            <?php echo mm_ToolTip("Esta é sua taxa de empacotamento e manuseio, e será acrescida aos custos de envio retornados pelos Correios") ?>
        </td>
    </tr>
	  <tr>
		<td><strong><?php echo $VM_LANG->_PHPSHOP_UPS_TAX_CLASS ?></strong></td>
		<td>
		  <?php
		  require_once(CLASSPATH.'ps_tax.php');
		  ps_tax::list_tax_value("ENCOM_TAX_CLASS", ENCOM_TAX_CLASS) ?>
		</td>
		<td><?php echo mm_ToolTip($VM_LANG->_PHPSHOP_UPS_TAX_CLASS_TOOLTIP) ?><td>
	  </tr>	



<tr>
		<td><strong>Mão Própria:</strong></td>
		<td>
			<select class="inputbox" name="MaoPropria">
			<option value="n">Não</option>
			<option value="s">Sim</option>
			</select>

		</td>
		<td><?php echo mm_ToolTip("Você define se usará ou não o serviço Mão Própria dos Correios") ?><td>
</tr>	
<tr>
		<td><strong>Aviso de Recebimento:</strong></td>
		<td>
			<select class="inputbox" name="AvisoReceb">
			<option value="N">Não</option>
			<option value="S">Sim</option>
			</select>

		</td>
		<td><?php echo mm_ToolTip("Você define se usará ou não o serviço de Aviso de Recebimento dos Correios") ?><td>
</tr>	
<tr>
		<td><strong>Formato:</strong></td>
		<td>
			<select class="inputbox" name="Formatos">
			<option value="1">Caixa/Pacote</option>
			<option value="2">Rolo/Prisma</option>
			</select>

		</td>
		<td><?php echo mm_ToolTip("Você define se o formato embrulho é Caixa/Pacote ou Rolo/Prisma") ?><td>
</tr>
    <tr>
        <td><strong>Comprimento médio pacotes(Cm):</strong>
		</td>
		<td>
            <input type="text" name="Comprimento" class="inputbox" value="<?php echo Comprimento ?>" />
		</td>
		<td>
            <?php echo mm_ToolTip("Comprimento médio dos pacotes utilizados para envio pelos Correios") ?>
        </td>
    </tr>
    <tr>
        <td><strong>Largura/Diâmetro médio pacotes(Cm):</strong>
		</td>
		<td>
            <input type="text" name="Larg_Diam" class="inputbox" value="<?php echo Larg_Diam ?>" />
		</td>
		<td>
            <?php echo mm_ToolTip("Largura/Diâmetro médio dos pacotes utilizados para envio pelos Correios") ?>
        </td>
    </tr>
    <tr>
        <td><strong>Altura média pacotes(Cm):</strong>
		</td>
		<td>
            <input type="text" name="Altura" class="inputbox" value="<?php echo Altura ?>" />
		</td>
		<td>
            <?php echo mm_ToolTip("Altura média dos pacotes utilizados para envio pelos Correios") ?>
        </td>
    </tr>

	</table>


   <?php
   // return false if there's no configuration
   return true;
	}
	/**
  * Returns the "is_writeable" status of the configuration file
  * @param void
  * @returns boolean True when the configuration file is writeable, false when not
  */
	function configfile_writeable() {
		return is_writeable( CLASSPATH."shipping/".$this->classname.".cfg.php" );
	}

	/**
	* Writes the configuration file for this shipping method
	* @param array An array of objects
	* @returns boolean True when writing was successful
	*/
	function write_configuration( &$d ) {
	    global $vmLogger;

		$my_config_array = array("Handling_Fee" => $d['Handling_Fee'],
		"ENCOM_TAX_CLASS" => $d['ENCOM_TAX_CLASS'],"MaoPropria" => $d['MaoPropria'],
		"AvisoReceb" => $d['AvisoReceb'],"Formatos" => $d['Formatos'],"Comprimento" => $d['Comprimento'],
		"Larg_Diam" => $d['Larg_Diam'],"Altura" => $d['Altura'],"Ponto" => $d['Ponto']
		);
		$config = "<?php\n";
		$config .= "defined('_VALID_MOS') or die('Direct Access to this location is not allowed.'); \n\n";
		foreach( $my_config_array as $key => $value ) {
			$config .= "define ('$key', '$value');\n";
		}

		$config .= "?>";

		if ($fp = fopen(CLASSPATH ."shipping/".$this->classname.".cfg.php", "w")) {
			fputs($fp, $config, strlen($config));
			fclose ($fp);
			return true;
		}
		else {
			$vmLogger->err( "Error writing to configuration file" );
			return false;
		}
	}
}


?>

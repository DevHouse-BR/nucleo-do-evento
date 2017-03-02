<?php
/**
 * sh404SEF support for VirtueMart component.
 * Yannick Gaultier (shumisha)
 * shumisha@gmail.com
 * {shSourceVersionTag: V 1.2.4.q - 2007-06-10}
 */

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

// init languages system : we can't use Virtuemart languages files, because we don't always want to use current language strings.
// When using joomfish, we'll need on the same page strings for various languages (in the language switcher module)
global $mosConfig_lang, $mosConfig_absolute_path, $sh_LANG, $sefConfig;

// V 1.2.4.q must comply with translation restrictions
$shLangName = empty($lang) ? $mosConfigLang : shGetNameFromIsoCode( $lang);
$shLangIso = (shTranslateUrl($option, $shLangName)) ? (isset($lang) ? $lang : shGetIsoCodeFromName( $mosConfig_lang))
                                       : (isset($GLOBALS['mosConfig_defaultLang']) ? 
                                             shGetIsoCodeFromName($GLOBALS['mosConfig_defaultLang'])
                                           : shGetIsoCodeFromName( $mosConfig_lang));


$shLangIso = shLoadPluginLanguage( 'com_virtuemart', $shLangIso, '_PHPSHOP_LIST_ALL_PRODUCTS');

$title = array();
$dosef = true;
$shItemidString = '';

 /**
 * Function vm_sef_get_category_array() is based on  
 * Mark Fabrizio, Joomlicious
 * fabrizim@owlwatch.com
 * http://www.joomlicious.com
 */
if( !function_exists( 'vm_sef_get_category_array' ) ){
  function vm_sef_get_category_array( &$db, $category_id, $option ){
  
    global $sefConfig, $mosConfig_lang;
  
	  static $tree = null;  // V 1.2.4.m  $tree must an array based on current language
	  
	  if(empty($tree[$mos_config_lang])){
  		$q  = "SELECT c.category_name, c.category_id, x.category_parent_id FROM #__vm_category AS c" ;
	  	$q .= "\n LEFT JOIN #__vm_category_xref AS x ON c.category_id = x.category_child_id";
	  	$db->setQuery( $q );
	  	if (!shTranslateUrl($option, $shLangName))  // V 1.2.4.m
	  	  $tree[$mosConfig_lang] = $db->loadObjectList( 'category_id', false);  // V 1.2.4.m if Joomfish, and don't translate
	  	                                                    // use special call of loadObjectList, asking JF not to translate
	  	else  
		    $tree[$mosConfig_lang] = $db->loadObjectList( 'category_id' );
  	}
	  $title=array();
	  if ($sefConfig->shVMInsertCategories == 1)    // only one category
	    $title[] = ($sefConfig->shInsertCategoryId ? 
                    $tree[$mosConfig_lang][ $category_id ]->category_id.$sefConfig->replacement : '')   
                 .$tree[$mosConfig_lang][ $category_id ]->category_name; 
    else 
      do {               // all categories and subcategories. We don't really need id, as path 
		    $title[] = ($sefConfig->shInsertCategoryId ? 
          $tree[$mosConfig_lang][ $category_id ]->category_id.$sefConfig->replacement : '') // to category
          .$tree[$mosConfig_lang][ $category_id ]->category_name;                           // will always be unique
		    $category_id = $tree[$mosConfig_lang][ $category_id ]->category_parent_id;
	    } while( $category_id != 0 );
	  return array_reverse( $title );
  }
}
  
//ob_start( 'ob_gzhandler' );
//global $shLog;

shRemoveFromGETVarsList('option');
if (!empty($lang))
  shRemoveFromGETVarsList('lang');  
if (!empty($Itemid))
  shRemoveFromGETVarsList('Itemid');

// start VM specific stuff
$shVmCChk = false;
$page = isset($page) ? @$page : null;  
if (!empty($page)) {
  shRemoveFromGETVarsList('page');
}  

// shumisha : insert shop name from menu
$shShopName = empty($sefConfig->shShopName) ?  
  getMenuTitle($option, (isset($task) ? @$task : null), null, null, $shLangName ) : $sefConfig->shShopName;

// special handling for 'vmcchk' cookie test
if (strpos( $string, 'vmcchk')) {// if VM is doing a cookie check
  $shVmCChk = true;
  // this is a trick to counter a 'bug' in VM 1.0.10 when using SEF URL
	setcookie( 'VMCHECK', 'OK', time()+60*60, '/' );
}
//die($func);
switch ($page)
{
    case 'shop.browse':
      //$shLog->l( 5, 'non SEF String = %s ', $string);	
      //$shLog->l(5, 'Begin : Option = %s - page = %s - func = %s - product_id = %s - category_id = %s - manufacturer_id = %s - shShopName = %s', $option, $page, $func, $product_id, $category_id, $manufacturer_id, $shShopName);
      if ($sefConfig->shVmInsertShopName) $title[] = $shShopName;
      if ($shVmCChk) {
        $title[] = 'vmchk';
        shRemoveFromGETVarsList('vmcchk');
      }  
      if ( $sefConfig->shVmInsertManufacturerName && !empty ($manufacturer_id)) { 
        $query  = "SELECT mf_name, manufacturer_id FROM #__vm_manufacturer" ;
		    $query .= "\n WHERE manufacturer_id=".$manufacturer_id;
		    $database->setQuery( $query );
		    if (!shTranslateUrl($option, $shLangName))  // V 1.2.4.m
		      $database->loadObject($result, false);
		    else   
		      $database->loadObject($result);  
		    $shRef = empty($result)?  // no name available
          $sh_LANG[$shLangIso]['_PHPSHOP_MANUFACTURER'].$sefConfig->replacement.$manufacturer_id // put ID
          : ($sefConfig->shInsertManufacturerId ? $manufacturer_id.$sefConfig->replacement : ''); // if name, put ID only if requested
		    $title[] = $shRef.(empty( $result ) ? '' :  $result->mf_name);
      }
      if (isset($manufacturer_id))  // V 1.2.4.m
        shRemoveFromGETVarsList('manufacturer_id');
        
      // process $root
      if (!empty($root)) {
        // first insert root cat
        $title[] = $sh_LANG[$shLangIso]['_PHPSHOP_ROOT_CAT'].$sefConfig->replacement.$root;
        shRemoveFromGETVarsList('root');
        // then insert child cat (but only one cat, not full list of nested cats)
        $title[] = $sh_LANG[$shLangIso]['_PHPSHOP_CATEGORY'].$sefConfig->replacement.$category_id;
      } else { // if no $root process categories as usual 
        //$shLog->l(5, 'Cas shop.browse 2 = title = %s', print_r($title, true));
		    if (($sefConfig->shVMInsertCategories && !empty ($category_id))
           || (!$sefConfig->shVMInsertCategories && empty ($product_id))) { 
		      $title = array_merge( $title, vm_sef_get_category_array( $database, $category_id, $option ));
		    } else { // V 1.2.4.f : still need to add category id even if we don't want to add name!!
		      if (!empty($category_id)) {
            $title = array_merge( $title, vm_sef_get_category_array( $database, $category_id, $option ));
            }
        }
      }
      // V 1.2.4.m 
      if (isset($category_id))
        shRemoveFromGETVarsList('category_id');  
		  //$shLog->l(5, 'Before title :Option = %s - page = %s - func = %s - product_id = %s - category_id = %s - manufacturer_id = %s - shShopName = %s - root = %s', $option, $page, $func, $product_id, $category_id, $manufacturer_id, $shShopName, $root);
      if (empty($product_id) && empty($category_id) && empty($manufacturer_id) && empty($Search)
          && empty($root)) {
        $title[] = $sh_LANG[$shLangIso]['_PHPSHOP_LIST_ALL_SHOP_PRODUCTS'];
      }  
      else {
        if ($sefConfig->shVmAdditionalText)  // V 1.2.4.k additional text is now optional
          $title[] = $sh_LANG[$shLangIso]['_PHPSHOP_LIST_ALL_PRODUCTS'];
      }    
	    if( @count($title) > 0 )
        if (isset($sefConfig->suffix))
				  $title[count($title)-1] .= $sefConfig->suffix;
			  else $title[] = '/';
      else $dosef = false;
		break;
		case 'shop.downloads':  // V 1.2.4.g 2007-04-07
		  if ($sefConfig->shVmInsertShopName) $title[] = $shShopName;
		  if ($shVmCChk) {
        $title[] = 'vmchk';
        shRemoveFromGETVarsList('vmcchk');
      }
		  $title[] = $sh_LANG[$shLangIso]['_PHPSHOP_DOWNLOADS_TITLE'];
		  $title[] = '/';
		break;
		case 'shop.cart':
		  if (!empty($func))
        switch ($func){
          case 'cartAdd':
            if ($sefConfig->shVmInsertShopName) $title[] = $shShopName;
            if ($shVmCChk) {
              $title[] = 'vmchk';
              shRemoveFromGETVarsList('vmcchk');
            }
            $title[] = $sh_LANG[$shLangIso]['_PHPSHOP_ADD'];
            shRemoveFromGETVarsList('func');
            if (!empty($product_id)) {  // if a product_id is set (it should!)
              $shProductName = $sefConfig->shVmUseProductSKU ? 'product_sku':'product_name';  
              $q = "SELECT product_id, ".$shProductName." FROM #__vm_product";  // then try to add its name as well
	            $q .= "\n WHERE product_id = %s";
	            $database->setQuery( sprintf( $q, $product_id ) );
	            if (!shTranslateUrl($option, $shLangName))  // V 1.2.4.m
	              $database->loadObject( $row, false);
	            else $database->loadObject( $row);
	            $shRef = empty($row)?  // no name available
                $sh_LANG[$shLangIso]['_PHPSHOP_PRODUCT'].$sefConfig->replacement.$product_id // put ID
                : ($sefConfig->shInsertProductId ? $product_id.$sefConfig->replacement : ''); // if name, put ID only if requested
		          $title[] = $shRef.(empty( $row ) ? '' :  $row->$shProductName);
            }
            shRemoveFromGETVarsList('product_id');
          break;
          case 'cartUpdate':
            if ($sefConfig->shVmInsertShopName) $title[] = $shShopName;
            if ($shVmCChk) {
              $title[] = 'vmchk';
              shRemoveFromGETVarsList('vmcchk');
            }
            $title[] = $sh_LANG[$shLangIso]['_PHPSHOP_UPDATE'];
            shRemoveFromGETVarsList('func');
            if (!empty($product_id)) {  // if a product_id is set (it should!)
              $shProductName = $sefConfig->shVmUseProductSKU ? 'product_sku':'product_name';  
              $q = "SELECT product_id, ".$shProductName." FROM #__vm_product";  // then try to add its name as well
	            $q .= "\n WHERE product_id = %s";
	            $database->setQuery( sprintf( $q, $product_id ) );
	            if (!shTranslateUrl($option, $shLangName))  // V 1.2.4.m
	              $database->loadObject( $row, false);
	            else $database->loadObject( $row);
	            
	            $shRef = empty($row)?  // no name available
                $sh_LANG[$shLangIso]['_PHPSHOP_PRODUCT'].$sefConfig->replacement.$product_id // put ID
                : ($sefConfig->shInsertProductId ? $product_id.$sefConfig->replacement : ''); // if name, put ID only if requested
		          $title[] = $shRef.(empty( $row ) ? '' :  $row->$shProductName);
            }
            shRemoveFromGETVarsList('product_id');
          break;
          case 'cartdelete':
            if ($sefConfig->shVmInsertShopName) $title[] = $shShopName;
            if ($shVmCChk) {
              $title[] = 'vmchk';
              shRemoveFromGETVarsList('vmcchk');
            }
            $title[] = $sh_LANG[$shLangIso]['_PHPSHOP_DELETE'];
            shRemoveFromGETVarsList('func');
            if (!empty($product_id)) {  // if a product_id is set (it should!)
              $shProductName = $sefConfig->shVmUseProductSKU ? 'product_sku':'product_name';  
              $q = "SELECT product_id, ".$shProductName." FROM #__vm_product";  // then try to add its name as well
	            $q .= "\n WHERE product_id = %s";
	            $database->setQuery( sprintf( $q, $product_id ) );
	            if (!shTranslateUrl($option, $shLangName))  // V 1.2.4.m
	              $database->loadObject( $row, false);
	            else $database->loadObject( $row);
	            
	            $shRef = empty($row)?  // no name available
                $sh_LANG[$shLangIso]['_PHPSHOP_PRODUCT'].$sefConfig->replacement.$product_id // put ID
                : ($sefConfig->shInsertProductId ? $product_id.$sefConfig->replacement : ''); // if name, put ID only if requested
		          $title[] = $shRef.(empty( $row ) ? '' :  $row->$shProductName);
            }
            shRemoveFromGETVarsList('product_id');
          break;
        } else {  // only show cart, no function
          if ($sefConfig->shVmInsertShopName) $title[] = $shShopName;
          if ($shVmCChk) {
            $title[] = 'vmchk';
            shRemoveFromGETVarsList('vmcchk');
          }
          $title[] = $sh_LANG[$shLangIso]['_PHPSHOP_CART_TITLE'];
        }  
      if (count($title) == 0) 
        $dosef = false;
		break;
		
    case 'shop.product_details':
      $shProductName = $sefConfig->shVmUseProductSKU ? 'product_sku':'product_name';
      $q = "SELECT p.product_id, ".$shProductName.", x.category_id FROM #__vm_product AS p LEFT JOIN #__vm_product_category_xref AS x ON p.product_id = x.product_id";
	    $q .= "\n WHERE p.product_id = %s";
	    $database->setQuery( sprintf( $q, $product_id ) );
	    if (!shTranslateUrl($option, $shLangName))  // V 1.2.4.m
	      $rows = $database->loadObjectList( '', false);
	    else $rows = $database->loadObjectList( ); 
	    if( @count( $rows ) > 0 ){
		    $row = $rows[0];
		    if ($sefConfig->shVmInsertShopName) $title[] = $shShopName;
        if ($shVmCChk) {
          $title[] = 'vmchk';
          shRemoveFromGETVarsList('vmcchk');
        }
        if ( $sefConfig->shVmInsertManufacturerName && !empty($manufacturer_id)) { 
          $query  = "SELECT mf_name, manufacturer_id FROM #__vm_manufacturer" ;
		      $query .= "\n WHERE manufacturer_id=".$manufacturer_id;
		      $database->setQuery( $query );
		      if (!shTranslateUrl($option, $shLangName))  // V 1.2.4.m
		        $database->loadObject($result, false);
		      else $database->loadObject($result);  
		      if (!empty($result)) {
		        $title[] = ($sefConfig->shInsertManufacturerId ? $manufacturer_id.$sefConfig->replacement: '')
                       .$result->mf_name;
            shRemoveFromGETVarsList('manufacturer_id');
          } else {
            $title[] = $sh_LANG[$shLangIso]['_PHPSHOP_MANUFACTURER_MOD']  // add its ID to URL
                        .$sefConfig->replacement.$manufacturer_id; 
            shRemoveFromGETVarsList('manufacturer_id');             
          } 
                      
        } else if ( $sefConfig->shVmInsertManufacturerName && !empty($product_id)) { 
        	$query  = "SELECT m.mf_name, m.manufacturer_id FROM #__vm_manufacturer AS m" ;
	  	    $query .= "\n LEFT JOIN #__vm_product_mf_xref AS x ON m.manufacturer_id = x.manufacturer_id";
		      $query .= "\n WHERE x.product_id=".$product_id;
		      $database->setQuery( $query );
		      if (!shTranslateUrl($option, $shLangName))  // V 1.2.4.m
		        $database->loadObject($result, false);
		      else $database->loadObject($result);
		      if (!empty($result)) {
		        $title[] = ($sefConfig->shInsertManufacturerId ? $result->manufacturer_id.$sefConfig->replacement: '')
                       .$result->mf_name;
            shRemoveFromGETVarsList('manufacturer_id');
          } else {
            $title[] = $sh_LANG[$shLangIso]['_PHPSHOP_MANUFACTURER_MOD']  // add its ID to URL
                        .$sefConfig->replacement.$manufacturer_id; 
            shRemoveFromGETVarsList('manufacturer_id');             
          }             
        } else 
          if (isset($manufacturer_id))
            shRemoveFromGETVarsList('manufacturer_id'); // this has to be manufacturer_id=0
        
		    if ($sefConfig->shVMInsertCategories) {
          $title = array_merge( $title, vm_sef_get_category_array( $database, $row->category_id, $option ));
        }
        if (isset($category_id))  // V 1.2.4.m
          shRemoveFromGETVarsList('category_id');  
		    $title[] = $sefConfig->shInsertProductId ? $product_id.$sefConfig->replacement.$row->$shProductName:$row->$shProductName;
		    shRemoveFromGETVarsList('product_id');
		    // v 1.2.4.f : flypage param was not passed on 
		    // V 1.2.4.m : now can be switched on/off
		    if (!empty($flypage) && $sefConfig->shVmInsertFlypage) {
          $title[] = empty($sh_LANG[$shLangIso]['_PHPSHOP_PRODUCT_DETAILS_'.$flypage]) ? 
            $flypage : $sh_LANG[$shLangIso]['_PHPSHOP_PRODUCT_DETAILS_'.$flypage];
          shRemoveFromGETVarsList('flypage');  
		    } else if (!empty($flypage)) shRemoveFromGETVarsList('flypage');
		  } else $dosef = false; 
		break;
		
    case 'shop.search':
      if ($sefConfig->shVmInsertShopName) $title[] = $shShopName;
      if ($shVmCChk) {
        $title[] = 'vmchk';
        shRemoveFromGETVarsList('vmcchk');
      }
      $title[] =  $sh_LANG[$shLangIso]['_PHPSHOP_SEARCH_TITLE'];
      if (count($title) == 0) $dosef = false;
    break;  
    case 'shop.registration':  // V 1.2.4.k
      if ($sefConfig->shVmInsertShopName) $title[] = $shShopName;
      if ($shVmCChk) {
        $title[] = 'vmchk';
        shRemoveFromGETVarsList('vmcchk');
      }
      $title[] =  $sh_LANG[$shLangIso]['_PHPSHOP_SH_CREATE_ACCOUNT'];
    break; 
    case 'shop.view_images':
      if ($sefConfig->shVmInsertShopName) $title[] = $shShopName;
      if ($shVmCChk) {
        $title[] = 'vmchk';
        shRemoveFromGETVarsList('vmcchk');
      }
      $title[] =  $sh_LANG[$shLangIso]['_PHPSHOP_MORE_IMAGES'];
      
      if ($sefConfig->shVMInsertCategories && !empty($category_id)) { 
        $title = array_merge( $title, vm_sef_get_category_array( $database, $category_id, $option ));
      }   
      if (isset($category_id)) // V 1.2.4.m
      shRemoveFromGETVarsList('category_id'); 
              
      if (!empty($product_id)) {
        $shProductName = $sefConfig->shVmUseProductSKU ? 'product_sku':'product_name';  
        $q = "SELECT product_id, ".$shProductName." FROM #__vm_product";  // then try to add its name as well
	      $q .= "\n WHERE product_id = %s";
	      $database->setQuery( sprintf( $q, $product_id ) );
	      if (!shTranslateUrl($option, $shLangName))  // V 1.2.4.m
	        $database->loadObject( $row, false);
        else $database->loadObject( $row);
        if (!empty($row)) {   
		      $title[] = $sefConfig->shInsertProductId ? 
            $product_id.$sefConfig->replacement.$row->$shProductName:
            $row->$shProductName;
		    }
		  }  
		  shRemoveFromGETVarsList('product_id');
		  
		  if (!empty($image_id))
        if ($image_id == 'product') {
          $title[] = $sh_LANG[$shLangIso]['_PHPSHOP_SH_PRODUCT_IMAGE'];
        }  
        else {
          $q = "SELECT file_id, file_title FROM #__vm_product_files";  // then try to add its name as well
	        $q .= "\n WHERE file_id = %s";
	        $database->setQuery( sprintf( $q, $image_id ) );
	        if (!shTranslateUrl($option, $shLangName))  // V 1.2.4.m
	          $database->loadObject( $row, false); 
          else $database->loadObject( $row);   
          if (!empty($row)) {   
            $title[] = $row->file_id.$sefConfig->replacement.$row->file_title;
          }
        }
      shRemoveFromGETVarsList('image_id');  
      // V 1.2.4.m : now can be switched on/off
		  if (!empty($flypage) && $sefConfig->shVmInsertFlypage) {  
        $title[] = empty($sh_LANG[$shLangIso]['_PHPSHOP_PRODUCT_DETAILS_'.$flypage]) ? 
          $flypage : $sh_LANG[$shLangIso]['_PHPSHOP_PRODUCT_DETAILS_'.$flypage];
        shRemoveFromGETVarsList('flypage');  
		  } else  if (!empty($flypage)) shRemoveFromGETVarsList('flypage');
      if (count($title) == 0) $dosef = false;
    break; 
        		
    case 'checkout.index': // note: this is not currently used, as VM 1.0.10 misses some calls to sefRelToAbs()
      if (!$sefConfig->shForceNonSefIfHttps) {
        if ($sefConfig->shVmInsertShopName) $title[] = $shShopName;
        $ssl_redirect = isset($ssl_redirect) ? @$ssl_redirect : null;
        if ($ssl_redirect) {  // let's add ssl just after shopname so that we can block it through robots.txt if we want
          $title[] = 'ssl';
          shRemoveFromGETVarsList('ssl_redirect');
        }  
        $cartReset = isset($cartReset) ? @$cartReset : null; // need to preserve cartReset param, used when
        if ($cartReset) {                                    // switching to SSL w/ shared certificate
          $title[] = 'cartReset'.$sefConfig->replacement.$cartReset;
          shRemoveFromGETVarsList('cartReset');
        }
        if (!$shAppendRemainingGETVars) {  // if martID is not passed as a regular parameter, we need to encode it in the sef URL  
          $martID = isset($martID) ? @$martID : null;
          if ($martID) {  // 1.2.4.j need to preserve martID when switching to shared SSL 
            $title[] = 'martID'.$sefConfig->replacement.$martID;
          }   
        } // if shAppendRemainingGETVars is true, then no need to encode martID in sef URL, it will be passed as an additional param
        if ($shVmCChk) {
          $title[] = 'vmchk';
          shRemoveFromGETVarsList('vmcchk');
        }
        $title[] =  $sh_LANG[$shLangIso]['_PHPSHOP_CHECKOUT_TITLE'];
        if ((!empty($checkout_this_step))
           || (!empty($ship_to_info_id))
           || (!empty($shipping_rate_id))
           || (!empty($payment_method_id))
           || (!empty($first_payment_method_id))
           || (!empty($payment_method_id))
           || (!empty($checkout_next_step)))
           $dosef=false;
      } else $dosef = false;     
    break; 
  
    case 'checkout.confirm':
    case 'checkout.customer_info':
    case 'checkout.dandomain_cc_form':
    case 'checkout.dandomain_result':
    case 'checkout.danhost_cc_form':
    case 'checkout.danhost_result':
    case 'checkout.freepay_cc_form':
    case 'checkout.freepay_result':
    case 'checkout.login_form':
    case 'checkout.paymentradio':
    case 'checkout.result':
    case 'checkout.thankyou':
    case 'checkout.wannafind_cc_form':
    case 'checkout.wannafind_result':
    case 'checkout_bar':
    case 'checkout_register_form':
    
    break;
    
    case 'account.index':
      if ($sefConfig->shVmInsertShopName) $title[] = $shShopName;
      if ($shVmCChk) {
        $title[] = 'vmchk';
        shRemoveFromGETVarsList('vmcchk');
      }
      $title[] =  $sh_LANG[$shLangIso]['_PHPSHOP_ACCOUNT_TITLE'];
    break;
    
    case 'account.billing':
      if ($sefConfig->shVmInsertShopName) $title[] = $shShopName;
      if ($shVmCChk) {
        $title[] = 'vmchk';
        shRemoveFromGETVarsList('vmcchk');
      }
      $title[] =  $sh_LANG[$shLangIso]['_PHPSHOP_ACC_ACCOUNT_INFO'];
      // V 1.2.4.f april 4, 2007
      if (!empty($next_page)) {
        $title[] = $next_page;
      }  
      shRemoveFromGETVarsList('next_page');
    break; 

    case 'account.shipping':
      if ($sefConfig->shVmInsertShopName) $title[] = $shShopName;
      if ($shVmCChk) {
        $title[] = 'vmchk';
        shRemoveFromGETVarsList('vmcchk');
      }
      $title[] =  $sh_LANG[$shLangIso]['_PHPSHOP_ACC_SHIP_INFO'];
    break;

    case 'account.order_details': 
      $order_id = isset($order_id) ? @$order_id : null;
      if ($sefConfig->shVmInsertShopName) $title[] = $shShopName;
      if ($shVmCChk) {
        $title[] = 'vmchk';
        shRemoveFromGETVarsList('vmcchk');
      }
      $title[] =  $sh_LANG[$shLangIso]['_PHPSHOP_VIEW'].$sefConfig->replacement
        .$sh_LANG[$shLangIso]['_PHPSHOP_ORDER_ITEM']
        .($order_id ? $sefConfig->replacement.'id'.strval($order_id):'');
      shRemoveFromGETVarsList('order_id');  
    break;

    case '':  // this is main menu link, let's fetch menu title
    case 'shop.index':
      $title[] = getMenuTitle($option, (isset($task) ? @$task : null), $Itemid, '', $shLangName );
      if ($shVmCChk) {
        $title[] = 'vmchk';
        shRemoveFromGETVarsList('vmcchk');
      }
			if (count($title) == 0) $dosef = false;
    break;
    default:
      $dosef = false;
    break;
}
if($dosef){
  if (!empty($shItemidString))
    $title[] = $shItemidString; // V 1.2.4.m
  // stitch back additional parameters, not sef-ified
	$shAppendString .= shGETGarbageCollect();  // add automatically all GET variables that had not been used already
  if (!empty($shAppendString)) 
    $shAppendString = '?'.ltrim( $shAppendString, '&'); // don't add to $string, otherwise it will be stored in the DB 
	$string = sef_404::sefGetLocation( shRebuildNonSefString( $string), $title, null, (isset($limit) ? @$limit : null), (isset($limitstart) ? @$limitstart : null), (isset($shLangName) ? @$shLangName : null));
}	
?>

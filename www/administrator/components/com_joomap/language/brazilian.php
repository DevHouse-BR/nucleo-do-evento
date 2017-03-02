<?php defined( '_VALID_MOS' ) or die( 'Acesso direto a este local n�o � permitido.' ); ?>
<?php
/* @package joomap
 * @author: Daniel Grothe, http://www.ko-ca.com/
 */

if( !defined( 'JOOMAP_LANG' )) {
    define('JOOMAP_LANG', 1 );
    // -- General ------------------------------------------------------------------
    define('_JOOMAP_CFG_COM_TITLE',			'Configura��o do Joomap');
    define('_JOOMAP_CFG_OPTIONS',			'Op��es de Display');
    define('_JOOMAP_CFG_CSS_CLASSNAME',		'Nome da Classe CSS');
    define('_JOOMAP_CFG_EXPAND_CATEGORIES',	'Expandir Categorias de Conte�do');
    define('_JOOMAP_CFG_EXPAND_SECTIONS',	'Expandir Se��es de Conte�do');
    define('_JOOMAP_CFG_SHOW_MENU_TITLES',	'Mostrar T�tulos do Menu');
    define('_JOOMAP_CFG_NUMBER_COLUMNS',	'N�mero de Colunas');
    define('_JOOMAP_EX_LINK',				'Marcar Links Externos');
    define('_JOOMAP_CFG_CLICK_HERE', 		'Click aqui');
    define('_JOOMAP_CFG_GOOGLE_MAP',		'Google Sitemap');
    define('_JOOMAP_EXCLUDE_MENU',			'Excluir IDs de Menu');
    define('_JOOMAP_TAB_DISPLAY',			'Display');
    define('_JOOMAP_TAB_MENUS',				'Menus');
    define('_JOOMAP_CFG_WRITEABLE',			'Grav�vel');
    define('_JOOMAP_CFG_UNWRITEABLE',		'Somente Leitura');
    define('_JOOMAP_MSG_MAKE_UNWRITEABLE',	'Deixar Somente Leitura depois de salvar');
    define('_JOOMAP_MSG_OVERRIDE_WRITE_PROTECTION', 'Sobreescrever a prote��o de somente leitura ao salvar');
    define('_JOOMAP_GOOGLE_LINK',			'Googlelink');
    define('_JOOMAP_CFG_INCLUDE_LINK',		'Link Invis�vel do autor');

    // -- Tips ---------------------------------------------------------------------
    define('_JOOMAP_EXCLUDE_MENU_TIP',		'Especificar IDs de menu que voc� n�o quer incluido no mapa do site.<br /><strong>NOTA</strong><br />Separe os IDs com v�rgula!');
    define('_JOOMAP_CFG_GOOGLE_MAP_TIP',	'O arquivo XML gerado para o GoogleSiteMap');
    define('_JOOMAP_GOOGLE_LINK_TIP',		'Copie o link e envie para o GoogleSiteMap');

    // -- Menus --------------------------------------------------------------------
    define('_JOOMAP_CFG_SET_ORDER',			'Ajuste a ordem de mostragem dos menus');
    define('_JOOMAP_CFG_MENU_SHOW',			'Mostrar');
    define('_JOOMAP_CFG_MENU_REORDER',		'Reordenar');
    define('_JOOMAP_CFG_MENU_ORDER',		'Ordenar');
    define('_JOOMAP_CFG_MENU_NAME',			'Nome do Menu');
    define('_JOOMAP_CFG_DISABLE',			'Click para desabilitar');
    define('_JOOMAP_CFG_ENABLE',			'Click para abilitar');
    define('_JOOMAP_SHOW',					'Mostrar');
    define('_JOOMAP_NO_SHOW',				'N�o mostrar');

    // -- Toolbar ------------------------------------------------------------------
    define('_JOOMAP_TOOLBAR_SAVE', 			'Salvar');
    define('_JOOMAP_TOOLBAR_CANCEL', 		'Cancelar');

    // -- Errors -------------------------------------------------------------------
    define('_JOOMAP_ERR_NO_LANG',			'Language file [ %s ] not found, loaded default language: brazilian<br />');
    define('_JOOMAP_ERR_CONF_SAVE',         'ERROR: Failed to save the configuration.');
    define('_JOOMAP_ERR_NO_CREATE',         'ERROR: Not able to create Settings table');
    define('_JOOMAP_ERR_NO_DEFAULT_SET',    'ERROR: Not able to insert default Settings');
    define('_JOOMAP_ERR_NO_PREV_BU',        'WARNING: Not able to drop previous backup');
    define('_JOOMAP_ERR_NO_BACKUP',         'ERROR: Not able to create backup');
    define('_JOOMAP_ERR_NO_DROP_DB',        'ERROR: Not able to drop Settings table');
    define('_JOOMAP_ERR_NO_SETTINGS',		'ERROR: Unable to load Settings from Database: <a href="%s">Create Settings table</a>');

    // -- Config -------------------------------------------------------------------
    define('_JOOMAP_MSG_SET_RESTORED',      'Settings restored');
    define('_JOOMAP_MSG_SET_BACKEDUP',      'Settings saved');
    define('_JOOMAP_MSG_SET_DB_CREATED',    'Settings table created');
    define('_JOOMAP_MSG_SET_DEF_INSERT',    'Default Settings inserted');
    define('_JOOMAP_MSG_SET_DB_DROPPED',    'Settings table dropped');
	
    // -- CSS ----------------------------------------------------------------------
    define('_JOOMAP_CSS',					'JooMap CSS');
    define('_JOOMAP_CSS_EDIT',				'Edit template'); // Edit template
	
    // -- Sitemap (Frontend) -------------------------------------------------------
    define('_JOOMAP_SHOW_AS_EXTERN_ALT',	'Link abre uma nova janela');
}
?>

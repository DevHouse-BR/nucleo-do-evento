<?php
/**
* @version $Id: weather.php,v 0.1 2005/05/05 10:00:00 stingrey Exp $
* @package Mambo
* @subpackage Contact
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Mambo is Free Software
*/

/*Arquivo traduzido para Portugu�s do Brasil em 06 de dezembro de 2006 por:
  Fernando Soares (Santa Cruz do Sul-RS, Brazil)
  fsoares@fsoares.com.br

  � permitido copiar, reproduzir, modificar e distribuir este arquivo sob os
  termos da Gnu General Public License (GPL).
  Voc� pode consultar uma c�pia desta licensa em:
  http://www.gnu.org/copyleft/gpl.html
*/

/** ensure this file is being included by a parent file */
defined('_VALID_MOS') or die('Direct Access to this location is not allowed.');

define("_W_ACTUAL", "Valores Atuais");
define("_W_FORECAST", "Previs�o");
define("_W_LOC_DATA", "Local");
define("_W_WIND", "Vento");
define("_W_TEMP", "Temp.");
define("_W_WINDCHILL", "S.T�rm.");
define("_W_WINDSPEED", "Velocidade");
define("_W_WINDDIR", "Dire��o");
define("_W_WINDGUST", "Velocidade m�x.");
define("_W_SUNRISE", "Amanhecer");
define("_W_SUNSET", "Anoitecer");
define("_W_OBST", "Esta��o");
define("_W_LAT", "Latitude");
define("_W_LON", "Longitude");
define("_W_DEWP", "Ponto de Orvalho");
define("_W_VISIBILITY", "Visibilidade");
define("_W_HUMIDITY", "Humidade");
define("_W_UV_INDEX", "�ndice UV");
define("_W_UV_LOW", "Baixo");
define("_W_UV_MED", "M�dio");
define("_W_UV_HIGH", "Alto");
define("_W_UV_SHIGH", "Extremo");
define("_W_PRESSURE", "Press�o");
define("_W_UNKNOWN_ERROR", "Ocorreu um erro desconhecido");
define("_W_ERROR_TITLE", "Erro");
define("_W_ERROR_DESCR", "Ocorreu o seguinte erro");
define("_W_ERROR_CODE", "C�digo do erro");
define("_W_ERROR_NOPARTNERID", "Partner ID n�o dispon�vel!");
define("_W_ERROR_NOPASSWORD", "key n�o dispon�vel!");
define("_W_FORECAST_SUNRISE", "Sai");
define("_W_FORECAST_SUNSET", "Se p�e");
define("_W_FORECAST_TEMP_MAX", "M�x");
define("_W_FORECAST_TEMP_MIN", "M�n");
define("_W_FORECAST_WINDSPEED", "Velocid.");
define("_W_FORECAST_DAY", "Dia");
define("_W_FORECAST_NIGHT"," Noite");
define("_W_FORECAST_SUN", "Sol");
define("_W_FORECAST_TEMP", "Temperatura");
define("_W_FORECAST_WIND", "Vento");
define("_W_FORECAST_HUMI", "Humid.");
define("_W_FORECAST_DIRECTION", "Dire��o");
define("_W_FORECAST_RAIN", "Precip.");
define("_W_FORECAST_FTITLE", "Detalhes para o dia");
define("_W_FORECAST_BACK", "Voltar � visualiza��o geral");
define("_W_FORECAST_FOR", "para");
define("_W_FORECAST_D_DAY", "Dia");
define("_W_FORECAST_D_NIGHT", "Noite");
define("_W_FORECAST_TEMP_D_MAX", "Temperatura m�x.");
define("_W_FORECAST_TEMP_D_MIN", "Temperatura m�n.");
define("_W_FORECAST_D_RAIN", "Precipita��o");
define("_W_BAROMETER", "Barom.");
define("_W_PROVIDER", "Provido por");
define("_W_MOD_BUTTON", "Mais detalhes");
define("_W_SELECT_LOCATION", "Selecione sua cidade...");

// Language tags for administration section
define("_WEATHER_TITLE", "Configura��o do eWeather");
define("_WEATHER_PARAM_TITLE", "Par�metro");
define("_WEATHER_VALUE_TITLE", "Valor");
define("_WEATHER_DESCRIB_TITLE", "Descri��o");
define("_WEATHER_PARTNER_ID", "Partner ID");
define("_WEAHTER_PARTNER_ID_D", "Precisa de um Partner ID fornecido por <a href=\"http://www.weather.com/services/xmloap.html\" target=\"_blank\">http://www.weather.com</a>.");
define("_WEATHER_PARTNER_KEY", "Partner Key");
define("_WEAHTER_PARTNER_KEY_D", "Precisa de um Key fornecido por <a href=\"http://www.weather.com/services/xmloap.html\" target=\"_blank\">http://www.weather.com</a>.");
define("_WEATHER_DEFAULT_LOCATION", "Localidade");
define("_WEATHER_DEFAULT_LOCATION_D", "Localidade padr�o");
define("_WEATHER_DEFAULT_LOC_CODE", "C�digos de localidades");
define("_WEATHER_DEFAULT_LOC_CODE_D", "C�digo de localidade para a cidade selecionada.");
define("_WEATHER_CACHE_TIME", "Intervalo de cache");
define("_WEATHER_CACHE_TIME_D", "Intervalo de obten��o dos dados de previs�o. Valor m�nimo: 1800 segundos (30 Min.)");
define("_WEATHER_UNITS", "Unidades");
define("_WEATHER_UNITS_D", "Sistema de unidades a utilizar (ingl�s ou m�trico)");
define("_WEATHER_FORECAST_DAYS", "Dias");
define("_WEATHER_UNITS_ENG", "Ingl�s");
define("_WEATHER_UNITS_INT", "M�trico");
define("_WEATHER_FORECAST_DAYS_D", "Dias de previs�o");
define("_WEATHER_SHOW_FOOTER", "Mostrar Rodap�");
define("_WEATHER_SHOW_FOOTER_D", "Mostra o rodap� no componente");
define("_WEATHER_SHOW_FORECAST", "Mostra a previs�o");
define("_WEATHER_SHOW_FORECAST_D", "Mostra a previs�o no componente");
define("_WEATHER_TIME_FORMAT", "Formato de hora");
define("_WEATHER_TIME_FORMAT_D", "Formato de hora a mostrar na previs�o meteorol�gica. Busca par�metros na fun��o strftime");
define("_WEATHER_DATE_FORMAT_LONG", "Formato de data (longo)");
define("_WEATHER_DATE_FORMAT_LONG_D", "Formato de data em formato longo para cabe�alhos. Busca par�metros na fun��o strftime");
define("_WEATHER_DATE_FORMAT_SHORT", "Formato de data (curto)");
define("_WEATHER_DATE_FORMAT_SHORT_D", "Formato de data curto para mostrar nas visualiza��es gerais. Busca par�metros na fun��o strftime");
define("_WEATHER_DATE_FORMAT_DETAIL", "Formato de data (detalhe)");
define("_WEATHER_DATE_FORMAT_DETAIL_D", "Formato para previs�o detalhada. Busca par�metros na fun��o strftime");
define("_WEATHER_ICONSET", "Estilo de �cones");
define("_WEATHER_ICONSET_D", "Selecione um estio de �cones para mostrar.");
// Version 1.0.5 Beta
define("_WEATHER_USE_PROXY", "Proxy");
define("_WEATHER_USE_PROXY_D", "Ativa conex�o atrav�s de  proxy com weather.com.");
define("_WEATHER_PROXY_HOST", "Proxy Host");
define("_WEATHER_PROXY_HOST_D", "Nome do Host ou endere�o IP do servidor proxy.");
define("_WEATHER_PROXY_PORT", "Porta do proxy");
define("_WEATHER_PROXY_PORT_D", "Porta para a conex�o por proxy.");
define("_WEATHER_USE_PROXY_AUTH", "Autentica��o do proxy.");
define("_WEATHER_USE_PROXY_AUTH_D", "Utilizado para autenticar o servidor junto ao proxy");
define("_WEATHER_PROXY_AUTH_USER", "ID de Usu�rio do Proxy");
define("_WEATHER_PROXY_AUTH_USER_D", "ID de usu�rio para autenticar-se junto ao proxy.");
define("_WEATHER_PROXY_AUTH_PWD","Senha do Proxy");
define("_WEATHER_PROXY_AUTH_PWD_D", "Senha necess�ria para autenticar-se junto ao proxy.");

define("_WEATHER_REGION", "Regi�o");
define("_WEATHER_COUNTRY", "Pa�s");
define("_WEATHER_CITY", "Cidade");
define("_WEATHER_CITY_CODE", "C�digo de cidade");
define("_WEATHER_PROFILE_UPDATE", "Perfil atualizado!");
define("_WEATHER_PROFILE_SAVED", "Perfil salvo!");
define("_WEATHER_PROFILE_ERROR", "Erro - Perfil n�o foi salvo!");
define("_WEATHER_SAVE_BUTTON", "&nbsp;&nbsp;&nbsp;Salvar&nbsp;&nbsp;&nbsp;");
define("_WEATHER_CANCEL_BUTTON", "&nbsp;&nbsp;&nbsp;Cancelar&nbsp;&nbsp;&nbsp;");
define("_WEATHER_SHOW_ALL", "Mostrar todas as cidades instaladas");
define("_WEATHER_GO_INST", "Voltar para localidades");

?>

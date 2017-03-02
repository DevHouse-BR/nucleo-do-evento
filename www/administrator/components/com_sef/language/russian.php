<?php
//
// Copyright (C) 2004 W.H.Welch
// All rights reserved.
//
// This source file is part of the 404SEF Component, a Mambo 4.5.1
// custom Component By W.H.Welch - http://sef404.sourceforge.net/
//
// This program is free software; you can redistribute it and/or
// modify it under the terms of the GNU General Public License (GPL)
// as published by the Free Software Foundation; either version 2
// of the License, or (at your option) any later version.
//
// Please note that the GPL states that any headers in files and
// Copyright notices as well as credits in headers, source files
// and output (screens, prints, etc.) can not be removed.
// You can extend them with your own credits, though...
//
// This program is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with this program; if not, write to the Free Software
// Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.
//
// The "GNU General Public License" (GPL) is available at
// http://www.gnu.org/copyleft/gpl.html.
// 
//  Russian translation by Dmitry Afanasieb, june 2007
// 
// Dont allow direct linking

defined( '_VALID_MOS' ) or die( '������ ��������.' );

// admin interface
DEFINE('_COM_SEF_CONFIG','sh404SEF<br/>������������');
DEFINE('_COM_SEF_CONFIG_DESC','��������� ���������������� sh404SEF');
DEFINE('_COM_SEF_HELP','sh404SEF<br/>���������');
DEFINE('_COM_SEF_HELPDESC','����� ������ �� sh404SEF?');
DEFINE('_COM_SEF_INFO','sh404SEF<br/>������������');
DEFINE('_COM_SEF_INFODESC','���������� ������ � ������������ �� sh404SEF');
DEFINE('_COM_SEF_VIEWURL','�����������/��������<br/>SEF ������');
DEFINE('_COM_SEF_VIEWURLDESC','�����������/�������� SEF ������');
DEFINE('_COM_SEF_VIEW404','�����������/��������<br/>404 ����');
DEFINE('_COM_SEF_VIEW404DESC','�����������/�������� 404 ����');
DEFINE('_COM_SEF_VIEWCUSTOM','�����������/��������<br/>���������� �������������');
DEFINE('_COM_SEF_VIEWCUSTOMDESC','�����������/�������� ���������� �������������');
DEFINE('_COM_SEF_SUPPORT','���������<br/>���');
DEFINE('_COM_SEF_SUPPORTDESC','������� �� ���� sh404SEF (� ����� ����)');
DEFINE('_COM_SEF_BACK','��������� � ������ ���������� sh404SEF');
DEFINE('_COM_SEF_PURGEURL','��������<br/>SEF ������');
DEFINE('_COM_SEF_PURGEURLDESC','������� SEF ������');
DEFINE('_COM_SEF_PURGE404','��������<br/>404 ����');
DEFINE('_COM_SEF_PURGE404DESC','������� ���� ������ 404');
DEFINE('_COM_SEF_PURGECUSTOM','��������<br/>���������� ������������');
DEFINE('_COM_SEF_PURGECUSTOMDESC','������� ���������� �������������');
DEFINE('_COM_SEF_WARNDELETE','��������!!!<br/>�� ����������� ������� ');
DEFINE('_COM_SEF_RECORD',' ������');
DEFINE('_COM_SEF_RECORDS',' ������');
DEFINE('_COM_SEF_NORECORDS','������ �� �������.');
DEFINE('_COM_SEF_PROCEED',' ���������� ');
DEFINE('_COM_SEF_OK',' OK ');
DEFINE('_COM_SEF_SUCCESSPURGE','������ ������� �������');
DEFINE('_PREVIEW_CLOSE','������� ������ ����');
DEFINE('_COM_SEF_EMPTYURL','���������� ������ ������ (URL) ��� ���������������.');
DEFINE('_COM_SEF_NOLEADSLASH','� ����� ������ (URL) �������� ���� ����� �������.');
DEFINE('_COM_SEF_BADURL','������ Non-SEF ������ ������ ���������� � index.php');
DEFINE('_COM_SEF_URLEXIST','������ (URL) ��� ���������� � ���� ������!');
DEFINE('_COM_SEF_SHOW0','�������� SEF ������');
DEFINE('_COM_SEF_SHOW1','�������� 404 ����');
DEFINE('_COM_SEF_SHOW2','�������� ���������� �������������');
DEFINE('_COM_SEF_INVALID_URL','�������� URL: ������ ������ ������� ���������� Itemid, �� �� �� ������.<br/>�������: �������� ����� ���� ��� ������� ��������. ��� ������� ��� �����������, ������ �������� ���.');
DEFINE('_COM_SEF_DEF_404_MSG','<h1>404: �� �������</h1><h4>��������, �� ����������, ������� �� ��������� �� �������</h4>');
DEFINE('_COM_SEF_SELECT_DELETE','�������� ������� ��� ��������');
DEFINE('_COM_SEF_ASC',' (asc) ');
DEFINE('_COM_SEF_DESC',' (desc) ');
DEFINE('_COM_SEF_WRITEABLE',' <b><font color="green">������� ��� ������</font></b>');
DEFINE('_COM_SEF_UNWRITEABLE',' <b><font color="red">������� ��� ������</font></b>');
DEFINE('_COM_SEF_USING_DEFAULT',' <b><font color="red">������������� �������� �� ���������</font></b>');
DEFINE('_COM_SEF_DISABLED',"<p class='error'>����������: ��������� SEF � Joomla/Mambo ���������. ��� ������������� SEF, ����������, �������� �� �� �������� SEO<a href='".
  $GLOBALS['mosConfig_live_site']."/administrator/index2.php?option=com_config'>���������� ������������</a></p>");
DEFINE('_COM_SEF_TITLE_CONFIG','������������ sh404SEF ');
DEFINE('_COM_SEF_TITLE_BASIC','�������� ������������');
DEFINE('_COM_SEF_ENABLED','��������');
DEFINE('_COM_SEF_TT_ENABLED','���� ������� ���, �� ����� ����������� ����������� SEF ��� Joomla/Mambo');
DEFINE('_COM_SEF_DEF_404_PAGE','�������� ������ 404:');
DEFINE('_COM_SEF_REPLACE_CHAR','������ ������:');
DEFINE('_COM_SEF_TT_REPLACE_CHAR','������, ������������ ��� ������ ����������� �������� � ������ (URL)');
DEFINE('_COM_SEF_PAGEREP_CHAR','<nobr>������ ����������� �������:</nobr>');
DEFINE('_COM_SEF_TT_PAGEREP_CHAR','������, ������������ ��� ��������� ������� ������� �� �������� ������ (URL)');
DEFINE('_COM_SEF_STRIP_CHAR','��������� �������:');
DEFINE('_COM_SEF_TT_STRIP_CHAR','�������, ��������� �� ������ (URL). �������, �������� �� �������� |');
DEFINE('_COM_SEF_FRIENDTRIM_CHAR','���������� �������:');
DEFINE('_COM_SEF_TT_FRIENDTRIM_CHAR','�������, ������� ����� ������������ � ������� (URL). �������, �������� �� �������� |');
DEFINE('_COM_SEF_USE_ALIAS','������������ ����������');
DEFINE('_COM_SEF_TT_USE_ALIAS','�������� ��, ����� ������������ ���������� ���������� ������ ������ ��������� � ������ (URL)');
DEFINE('_COM_SEF_SUFFIX','���������� ������:');
DEFINE('_COM_SEF_TT_SUFFIX','���������� ��� \\\'files\\\'. �������� ������, ���� �� ����� ����������. �� ��������� - \\\'.html\\\'.');
DEFINE('_COM_SEF_ADDFILE','���� ������� �� ���������:');
DEFINE('_COM_SEF_TT_ADDFILE','��� ����� ��� ���������� � �������, ������� � ����� ������ ����� - /. ������� ��� ��������� �������, ��������� ������������ ����, �� ������� ������������ ������ 404, ���� ����� ���.');
DEFINE('_COM_SEF_PAGETEXT','����� ��������:');
DEFINE('_COM_SEF_TT_PAGETEXT','�����, ����������� � ������ ��� ��������������� ����������. ������������ %s ��� ������� ������ �������� � ����� ������. ���� ������� ���������, �� ����� �������� � ����� ������.');
DEFINE('_COM_SEF_LOWER','� ������ ��������');
DEFINE('_COM_SEF_TT_LOWER','������������� ��� ������� � ������ ������� � ������ (URL)','� ������ ��������');
DEFINE('_COM_SEF_SHOW_SECT','�������� �������');
DEFINE('_COM_SEF_TT_SHOW_SECT','���� ��, �� ����� ��������� �������� ������� � ������');
DEFINE('_COM_SEF_HIDE_CAT','������ ���������');
DEFINE('_COM_SEF_TT_SHOW_CAT','���� ��, �� ��������� ����� ��������� �� ������');
DEFINE('_COM_SEF_404PAGE','�������� ������ 404:');
DEFINE('_COM_SEF_TT_404PAGE','��������� ������� ��� 404 ������ - �� ������� (��������� ���������� �� ����� ��������)');
DEFINE('_COM_SEF_TITLE_ADV','�������������� ��������� ����������');
DEFINE('_COM_SEF_TT_ADV','<b>���. ��������� �� ���������</b><br/>���� ���������, ���� ���������� SEF Advanced ������������, �� ��� ����� ������������.<br/><b>�� ����������</b><br/>�� ��������� � �� � ��������� SEF ������ � ������ �����<br/><b>����������</b><br/>�� ��������� SEF ������ ��� ����� ����������<br/>');
DEFINE('_COM_SEF_TT_ADV4','�������������� ��������� ��� ');
DEFINE('_COM_SEF_TITLE_MANAGER','sh404SEF �������� ������ (URL)');
DEFINE('_COM_SEF_VIEWMODE','����� ���������:');
DEFINE('_COM_SEF_SORTBY','����������� ��:');
DEFINE('_COM_SEF_HITS','���������');
DEFINE('_COM_SEF_DATEADD','���� ����������');
DEFINE('_COM_SEF_SEFURL','SEF ������');
DEFINE('_COM_SEF_URL','������');
DEFINE('_COM_SEF_REALURL','�������� ������');
DEFINE('_COM_SEF_EDIT','�������������');
DEFINE('_COM_SEF_ADD','��������');
DEFINE('_COM_SEF_NEWURL','����� SEF ������');
DEFINE('_COM_SEF_TT_NEWURL','������ ������������� ��������������� �� Joomla/Mambo �������� <i>���</i> ���� �������');
DEFINE('_COM_SEF_OLDURL','������ Non-SEF ������');
DEFINE('_COM_SEF_TT_OLDURL','��� ������ (URL) ������ ���������� � index.php');
DEFINE('_COM_SEF_SAVEAS','��������� ��� ���������� �������������');
DEFINE('_COM_SEF_TITLE_SUPPORT','sh404SEF ���������');
DEFINE('_COM_SEF_HELPVIA','<b>��������� �������� ����� ��������� ������:</b>');
DEFINE('_COM_SEF_OFFICIAL','������������ ����� �������');
DEFINE('_COM_SEF_MAMBERS','����� ����������');
DEFINE('_COM_SEF_TITLE_PURGE','���� ������ ������� sh404SEF');
DEFINE('_COM_SEF_USE_DEFAULT','(������������ ��������� �� ���������)');
DEFINE('_COM_SEF_NOCACHE','�� ����������');
DEFINE('_COM_SEF_SKIP','����������');
DEFINE('_COM_SEF_INSTALLED_VERS','������������� ������:');
DEFINE('_COM_SEF_COPYRIGHT','Copyright');
DEFINE('_COM_SEF_LICENSE','��������');
DEFINE('_COM_SEF_SUPPORT_404SEF','���������� ���');
DEFINE('_COM_SEF_CONFIG_UPDATED','������������ ���������');
DEFINE('_COM_SEF_WRITE_ERROR','������ ��� ������ ������������');
DEFINE('_COM_SEF_NOACCESS','������ ����������');
DEFINE('_COM_SEF_FATAL_ERROR_HEADERS','FATAL ERRPR: ��������� ��� ���������');
DEFINE('_COM_SEF_UPLOAD_OK','���� ������� ��������');
DEFINE('_COM_SEF_ERROR_IMPORT','������ ��� �������:');
DEFINE('_COM_SEF_INVALID_SQL','�������� ������ � ����� SQL :');
DEFINE('_COM_SEF_NO_UNLINK','���������� ����������� ����������� ���� �� �������� �����');
DEFINE('_COM_SEF_IMPORT_OK','���������� ������ (URLs) ������� �������������!');
DEFINE('_COM_SEF_WRITE_FAILED','���������� �������� ����������� ���� � ���������� �����');
DEFINE('_COM_SEF_EXPORT_FAILED','������� ���������� ��������!!!');
DEFINE('_COM_SEF_IMPORT_EXPORT','������/������� ������');
DEFINE('_COM_SEF_SELECT_FILE','����������, �������� ������� ����');
DEFINE('_COM_SEF_IMPORT','��������. ���������� ������ (URLs)');
DEFINE('_COM_SEF_EXPORT','����������. ���������� ������ (URLs)');

// component interface
DEFINE('_COM_SEF_NOREAD','�������: ���������� ��������� ���� ');
DEFINE('_COM_SEF_CHK_PERMS','����������, ��������� ���������� �� ��� ���� � ���������, ��� ���� ���� ����� ���� ��������.');
DEFINE('_COM_SEF_DEBUG_DATA_DUMP','����� ����� ������ ��������: �������� �������� ���������');
DEFINE('_COM_SEF_STRANGE','��������� ���-�� ��������. ����� �������� ����<br />');

//Added by Leon
define('_FULL_TITLE', '������ ���������');
define('_TITLE_ALIAS', '��������� ���������');
define('_COM_SEF_SHOW_CAT', '�������� ���������');

// added by shumisha

// General params
define('_COM_SEF_SH_REPLACEMENTS', '������ ���������� ��������:');
define('_COM_SEF_TT_SH_REPLACEMENTS', '������� �� �������� ��� ������ (URL), ����� ��� �� ��������� ��� ������������, ����� ���� �������� ������ �� ������ ������� ������. <br />������ xxx | yyy ��� ������� ����������� �������. xxx - ���������� ������, � yyy - �����, ���������� ������. <br />����� ���� ������� ��������� ����� ������ ����������� �������� (,). ����� ������ � ����� ���������, ����������� ������ ���������� | <br />������ �����, ��� xxx ��� yyy ����� ���� ����������������, �������� _|oe ');

// cache params
define('_COM_SEF_SH_CACHE_TITLE', '���������� ������������');
define('_COM_SEF_SH_USE_URL_CACHE', '�������� ��� URL');
define('_COM_SEF_TT_SH_USE_URL_CACHE', '���� ��, SEF ������ (URL) ����� �������� � ��� �� ����, ��� ����������� �������� �������� �������� �������. ������ ��� ��������� ������������� �������� ������!');
define('_COM_SEF_SH_MAX_URL_IN_CACHE', '������ ���:');
define('_COM_SEF_TT_SH_MAX_URL_IN_CACHE', '����� ��� ������ (URL) ����������� ������ �������� ������������� ��� ������������ ������. ������� ������������ ����� ������ (URL), ������� ����� ���� ��������� � ��� (�������������� ������ ����� ����������, �� �� ����� ��������� � ���, ������ ����� �������� �������� ����������). ����� ������, ������ ������ (URL) �������� �������� 200 ���� (100 ��� SEF ������ and 100 ��� ��-SEF ������). ��������, 5000 ������ ������, ��������, 1 �� �� �����.');
// URL translation
define('_COM_SEF_SH_TRANSLATION_TITLE', '���������� ���������');
define('_COM_SEF_SH_TRANSLATE_URL', '��������� ������');
define('_COM_SEF_TT_SH_TRANSLATE_URL', '���� �� � ���� ������������, �������� SEF ������ ����� ���������� � ���� ���������� �����, ��� ������ � Joomfish. ���� ���, ������ ����� �� ����� �����. �� �����������, ���� ���� �� ������������.');
// itemid control
define('_COM_SEF_SH_ITEMID_TITLE', '���������� Itemid');
define('_COM_SEF_SH_INSERT_GLOBAL_ITEMID_IF_NONE', '�������� Itemid ����, ���� ���');
define('_COM_SEF_TT_SH_INSERT_GLOBAL_ITEMID_IF_NONE', '���� Itemid �� ���������� � ��-SEF URL ����� ��� ��������������� � SEF � �� �������� ������ �����, ������� ����� ���� Itemid ����� �������� � ����. ��� �����������, ��� ���� ��������, ������ ��������� �� ���� �������� (�.�. ����, ��� � ���������� ������)');
define('_COM_SEF_SH_INSERT_TITLE_IF_NO_ITEMID', '�������� ��������� ����, ���� ��� Itemid');
define('_COM_SEF_TT_SH_INSERT_TITLE_IF_NO_ITEMID', '���� Itemid �� ���������� � ��-SEF URL ����� ��� before ��������������� � SEF � �� �������� ������ �����, ������� ������� ��������� ���� ����� �������� � SEF ������. ��� ����� �������������, ���� �������� ���� ����� ������������, ��� ��� ��� ������������ -2, -3, -... ���������� � SEF ������, ���� �������� ��������������� �� ������ ����.');
define('_COM_SEF_SH_ALWAYS_INSERT_MENU_TITLE', '������ ��������� ��������� ����');
define('_COM_SEF_TT_SH_ALWAYS_INSERT_MENU_TITLE', '���� ��, ��������� ���� ��������������� Itemid ������������� � ��-Sef URL, ��� ������� �������� ��������� ����, ���� �� ���������� Itemid, ����� �������� � SEF ������.');
define('_COM_SEF_SH_ALWAYS_INSERT_ITEMID', '������ ���������� Itemid � SEF ������');
define('_COM_SEF_TT_SH_ALWAYS_INSERT_ITEMID', '���� ��, �� ��-SEF Itemid (��� Itemid ������� ������ ����, ���� ����������� ��� � ��-sef URL) ����� �������� � SEF ������. ��� ����� ���� ����������� ������ ���������� ������� ��������� ��������� ����, ���� � ��� ���� ��������� ������� ���� � ���������� ���������� (���, ��������, ���� � ������� ���� � ���� � ������� ����)');
define('_COM_SEF_SH_ALWAYS_INSERT_ITEMID_PREFIX', 'ID ����');
define('_COM_SEF_SH_DEFAULT_MENU_ITEM_NAME', '����������� ��������� ����:');
define('_COM_SEF_TT_SH_DEFAULT_MENU_ITEM_NAME', '����� �������� ���� ������ (��), �� ������ ����� ���������� ����� ����������� � SEF ������. ������ �����, ��� ���� ����� ����� ���������� � �� ����� ���������');

// Virtuemart params
define('_COM_SEF_SH_VM_TITLE', '��������� Virtuemart');
define('_COM_SEF_SH_VM_INSERT_SHOP_NAME', '�������� �������� �������� � ������ (URL)');
define('_COM_SEF_TT_SH_VM_INSERT_SHOP_NAME', '���� <strong>��<strong>, �������� �������� (��� ���������� � ������ ���� ��������� ��������) ����� ������ ����������� � SEF ������');
define('_COM_SEF_SH_SHOP_NAME', '�������� �������� �� ���������:');
define('_COM_SEF_TT_SH_SHOP_NAME', '���� �������� ���� - ��, �� ������ ����� ���������� ����� ����������� � SEF ������. ������ �����, ��� ���� ����� ����� ���������� � �� ����� ���������');
define('_COM_SEF_SH_INSERT_PRODUCT_ID', '�������� ID �������� � URL');
define('_COM_SEF_TT_SH_INSERT_PRODUCT_ID', '���� ��, ID �������� ����� �������� � �������� �������� � ������ SEF<br />��������: mysite.com/3-my-very-nice-product.html.<br />��� �������, ���� �� �� ���������� �������� ��������� � URL, ��� ��� ���������� �������� ����� ����� ������ �������� � ��������� ����������. ������ �����, ��� ��� �� ������� SKU, �� �����, ��� ���������� ID ��������, ������� ��� ����� ����������.');
define('_COM_SEF_SH_VM_USE_PRODUCT_SKU', '������������ SKU �������� ��� ��������');
define('_COM_SEF_TT_SH_VM_USE_PRODUCT_SKU', '���� ��, SKU ��������, ��� ��������, ������� �� ������� ��� ������� ��������, ����� ������������ ������ ������� �������� ��������.');
define('_COM_SEF_SH_VM_INSERT_MANUFACTURER_NAME', '�������� �������� ������������� � URL');
define('_COM_SEF_TT_SH_VM_INSERT_MANUFACTURER_NAME', '���� ��, �������� �������������, ���� ����, ����� ��������� � SEF ������ ������� ��������.<br />��������: mysite.com/manufacturer-name/product-name.html');
define('_COM_SEF_SH_VM_INSERT_MANUFACTURER_ID', '�������� ID �������������');
define('_COM_SEF_TT_SH_VM_INSERT_MANUFACTURER_ID', '���� ��, ID ������������� ����� ��������� ����� ��������� ������������� � SEF ������<br />��������: mysite.com/6-manufacturer-name/3-my-very-nice-product.html.');
define('_COM_SEF_SH_VM_INSERT_CATEGORIES', '�������� ���������');
define('_COM_SEF_TT_SH_VM_INSERT_CATEGORIES', '���� <strong>���</strong>, �������� ��������� �� ����� ��������� � URL ������� ��������, ��� �: <br /> mysite.com/joomla-cms.html<br />���� <strong>������ ���� ���������</strong> - �������� ���������, � ������� ��������� �������, ����� ��������� � SEF ������, ��� �: <br /> mysite.com/joomla/joomla-cms.html<br />���� <strong>��� �������� ���������</strong>, �� ����� ��������� ��� ���������, � ������� ��������� �������, ��� �: <br /> mysite.com/software/cms/joomla/joomla-cms.html');
define('_COM_SEF_SH_VM_DO_NOT_SHOW_CATEGORIES', '���');
define('_COM_SEF_SH_VM_SHOW_LAST_CATEGORY', '������ ���� ���������');
define('_COM_SEF_SH_VM_SHOW_ALL_CATEGORIES', '��� �������� ���������');
define('_COM_SEF_SH_VM_INSERT_CATEGORY_ID', '�������� ID ��������� � URL');
define('_COM_SEF_TT_SH_VM_INSERT_CATEGORY_ID', '���� ��, ID ��������� ����� ��������� � ������� �������� ��������� � URL ����� �������� ��������, ��� �: <br /> mysite.com/1-software/4-cms/1-joomla/joomla-cms.html');

// V 1.2.4.h
// insert numerical id params
define('_COM_SEF_SH_INSERT_NUMERICAL_ID_TITLE', '���������� ID');
define('_COM_SEF_SH_INSERT_NUMERICAL_ID', '�������� �������� ID � URL');
define('_COM_SEF_TT_SH_INSERT_NUMERICAL_ID', '���� <strong>��</strong>, �������� ID ����� �������� � URL � ����� ���������� ��������� � ������, ����� ��� Google �������. ID ����� ��������������� �������: 2007041100000, ��� 20070411 ���� �������� � 00000  - ���������� ���������� ID �������� ����������. � �����, ��� ����� ���������� ���� ��������, ����� ���������� ������ � ����������. ������ �����, ��� � ���������� �� �� ������� �� ��������.');
define('_COM_SEF_SH_INSERT_NUMERICAL_ID_ALL_CAT', '��� ���������:');
define('_COM_SEF_SH_INSERT_NUMERICAL_ID_CAT_LIST', '��������� �� ���� ����������');
define('_COM_SEF_TT_SH_INSERT_NUMERICAL_ID_CAT_LIST', '�������� ID ����� �������� ������ � SEF ������ �������� ���������� �������������� �����. �� ������ ������� ��������� ��������� �������� � ���������� ������� CTRL ����� �������� �� �������� ���������.');

// V 1.2.4.j
define('_COM_SEF_SH_REDIRECT_NON_SEF_TO_SEF', '301 ��������������� �� ��-Sef � SEF URL');
define('_COM_SEF_TT_SH_REDIRECT_NON_SEF_TO_SEF', '���� <strong>��</strong>, ��-Sef URL ��� �������������� � �� ����� �������������� � �� SEF ����� ��������� 301 - ��������� ������������ ���������������. ���� SE-URL �� ����������, ��� ����� �������, ���� ����� ����� ��� ���� POST ���������� � ������� ��������.');
define('_COM_SEF_SH_LIVE_SECURE_SITE', 'URL ����������� SSL ����������:');
define('_COM_SEF_TT_SH_LIVE_SECURE_SITE', '������� ��� � <strong>������� URL ���� ������ ����� ����� �� � ������ SSL</strong>.<br />���������� ������ ���� �� ����������� https ������. ���� ���, �� �� ��������� ����� httpS://normalSiteURL.<br />���������� ������� ������ url ��� ����� �������. ��������: <strong>https://www.mysite.com</strong> ��� <strong>https://sharedsslserveur.com/myaccount</strong>.');

// V 1.2.4.k
define('_COM_SEF_SH_IJOOMLA_MAG_TITLE', '��������� �������� iJoomla');
define('_COM_SEF_SH_ACTIVATE_IJOOMLA_MAG', '������������ ������� iJoomla � ����������');
define('_COM_SEF_TT_SH_ACTIVATE_IJOOMLA_MAG', '���� <strong>��</strong>, �� ed ��������, ���� ������������ � ���������� com_content, ����� ��������������� ��� ID iJoomla ��������.');
define('_COM_SEF_SH_INSERT_IJOOMLA_MAG_ISSUE_ID', '�������� �������� ID � URL');
define('_COM_SEF_TT_SH_INSERT_IJOOMLA_MAG_ISSUE_ID', '���� <strong>��</strong>, �� ���������� ���������� �������� ID ����� �������� � ������� ��������� ��������, ����� ���� ���������, ��� ��� ���������.');
define('_COM_SEF_SH_INSERT_IJOOMLA_MAG_NAME', '�������� �������� �������� � URL');
define('_COM_SEF_TT_SH_INSERT_IJOOMLA_MAG_NAME', '���� <strong>��<strong>, �� �������� �������� (��� ���������� � ��������� ��������) ������ ����� ����������� � SEF ������');
define('_COM_SEF_SH_IJOOMLA_MAG_NAME', '�������� �������� �� ���������:');
define('_COM_SEF_TT_SH_IJOOMLA_MAG_NAME', '����� ���������� �������� - ��, �� ������ ����� �������� ����� ����������� � SEF ������. ������ �����, ��� ����� ����� ��������� � �� ����� ���������');
define('_COM_SEF_SH_INSERT_IJOOMLA_MAG_MAGAZINE_ID', '�������� ID �������� � URL');
define('_COM_SEF_TT_SH_INSERT_IJOOMLA_MAG_MAGAZINE_ID', '���� <strong>��</strong>, ID �������� ����� �������� � ������� �������� �������� � URL, ��� �: <br /> mysite.com/<strong>4</strong>-Joomla-magazine/Good-article-title.html');
define('_COM_SEF_SH_INSERT_IJOOMLA_MAG_ARTICLE_ID', '�������� ID ��������� � URL');
define('_COM_SEF_TT_SH_INSERT_IJOOMLA_MAG_ARTICLE_ID', '���� <strong>��</strong>, ID ��������� ����� �������� � ������� ��������� ��������� � URL, ��� �: <br /> mysite.com/Joomla-magazine/<strong>56</strong>-Good-article-title.html');

define('_COM_SEF_SH_CB_TITLE', '��������� Community Builder ');
define('_COM_SEF_SH_CB_INSERT_NAME', '�������� �������� Community Builder');
define('_COM_SEF_TT_SH_CB_INSERT_NAME', '���� <strong>��</strong>, ��������� ���� ������� �������� �������� Community Builder ����� �������� �� ���� CB SEF URL');
define('_COM_SEF_SH_CB_NAME', '�������� CB �� ���������:');
define('_COM_SEF_TT_SH_CB_NAME', '����� ���������� �������� - ��, �� ����� �� ������ �������� ����� ������ � SEF URL. ������ �����, ��� ���� ����� ����� ���������� � �� ����� ���������.');
define('_COM_SEF_SH_CB_INSERT_USER_NAME', '�������� ��� ������������');
define('_COM_SEF_TT_SH_CB_INSERT_USER_NAME', '���� <strong>��</strong>, ��� ������������ ����� ��������� � SEF ������. <strong>��������:</strong> ��� ����� ������������ ��������� ������ �� � ����������� ������ ����, ���� � ��� ����� ������������������ �������������. ���� ������� ���, �� ����� ����������� ID ������������ � ��������� �������: ..../send-user-email.html?user=245');
define('_COM_SEF_SH_CB_INSERT_USER_ID', '�������� ID ������������');
define('_COM_SEF_TT_SH_CB_INSERT_USER_ID', '���� <strong>��</strong>, ID ����������� ����� �������� � ��� ����� <strong>��� �������, ��� ����������� ��������� ������� (��)</strong>, � ������, ���� ��� ������������ ����� ���� ���.');

define('_COM_SEF_SH_LOG_404_ERRORS', '���� ������ 404');
define('_COM_SEF_TT_SH_LOG_404_ERRORS', '���� <strong>��</strong>, 404 ������ ����� �������� � ��. ��� ����� ������ ����� ������ � ������� �����. ��� ����� ������ ����� � ��, ������� �� ������ ��������� ������ ��������, ����� ���� �������������.');

define('_COM_SEF_SH_VM_ADDITIONAL_TEXT', '�������������� �����:');
define('_COM_SEF_TT_SH_VM_ADDITIONAL_TEXT', '���� <strong>��</strong>, �� �������������� ����� ����� �������� � ���������� URL. ��������: ..../category-A/View-all-products.html VS ..../category-A/ .');

// V 1.2.4.m
define('_COM_SEF_SH_REDIRECT_JOOMLA_SEF_TO_SEF', '301 ��������������� � JOOMLA SEF � sh404SEF');
define('_COM_SEF_TT_SH_REDIRECT_JOOMLA_SEF_TO_SEF', '���� <strong>��</strong>, �� ����������� ������ JOOMLA SEF ����� �������������� �������� 301 � sh404SEF ����������, ���� ��� ���� � ��. ���� �� ��� � ��, �� ��� ����� ������� ������.');
define('_COM_SEF_SH_VM_INSERT_FLYPAGE', '������� ��� flypage');
define('_COM_SEF_TT_SH_VM_INSERT_FLYPAGE', '���� ��, �� �������� flypage ����� ��������� � URL ������� �������� ��������. ����� ���� ���������, ���� �� ����������� ���� ���� flypage.');
define('_COM_SEF_SH_LETTERMAN_TITLE', '��������� Letterman ');
define('_COM_SEF_SH_LETTERMAN_DEFAULT_ITEMID', 'Itemid ��� �������� Letterman �� ���������');
define('_COM_SEF_TT_SH_LETTERMAN_DEFAULT_ITEMID', '������� Itemid ��������, ������� ����� ��������� � ������ Letterman (����������, ��������� �������������, ...');

define('_COM_SEF_SH_FB_TITLE', '��������� Fireboard ');
define('_COM_SEF_SH_FB_INSERT_NAME', '�������� �������� Fireboard');
define('_COM_SEF_TT_SH_FB_INSERT_NAME', '���� <strong>��</strong>, �� ����� ��������� ���� ������� �������� �������� Fireboard ����� ����������� �� ���� Fireboard SEF �������');
define('_COM_SEF_SH_FB_NAME', '�������� Fireboard �� ���������:');
define('_COM_SEF_TT_SH_FB_NAME', '���� <strong>��<strong>, �������� Fireboard (��� ���������� � ��������� ������ ���� Fireboard) ������ ����� ����������� � SEF �������.');
define('_COM_SEF_SH_FB_INSERT_CATEGORY_NAME', '�������� �������� ���������');
define('_COM_SEF_TT_SH_FB_INSERT_CATEGORY_NAME', '���� ��, �� �������� ��������� ����� ��������� �� ��� SEF ������ ���������');
define('_COM_SEF_SH_FB_INSERT_CATEGORY_ID', '�������� ID ���������');
define('_COM_SEF_TT_SH_FB_INSERT_CATEGORY_ID', '���� <strong>��</strong>, �� ID ��������� ����� ��������� � ��� ��������, <strong>����� ���������� �������� ����� ������ (��)</strong>, � �������, ���� ��� �������� ����� ���� � ���� ��������.');
define('_COM_SEF_SH_FB_INSERT_MESSAGE_SUBJECT', '�������� �������� ���������');
define('_COM_SEF_TT_SH_FB_INSERT_MESSAGE_SUBJECT', '���� <strong>��</strong>, ������� ��������� ����� �������� � SEF ������ ������� ���������.');
define('_COM_SEF_SH_FB_INSERT_MESSAGE_ID', '�������� ID ���������');
define('_COM_SEF_TT_SH_FB_INSERT_MESSAGE_ID', '���� <strong>��</strong>, ID ��������� ����� �������� � �������� ��������� <strong>����� ���������� �������� ����� ������ (��)</strong>, � �������, ���� ��� ��������� ����� ���������� �������� ��������.');
define('_COM_SEF_SH_INSERT_LANGUAGE_CODE', '�������� ��� ����� � URL');
define('_COM_SEF_TT_SH_INSERT_LANGUAGE_CODE', '���� <strong>��</strong>, �� ����� �������� ISO ��� ����� � SEF ������, �����, ���� ���� �������� ������ �� ��������� ��� �����.');
DEFINE('_COM_SEF_SH_DO_NOT_TRANSLATE_URL','�� ����������');
DEFINE('_COM_SEF_SH_DO_NOT_INSERT_LANGUAGE_CODE','�� ��������� ���');
define('_COM_SEF_SH_ADV_MANAGE_URL', '��������� URL');
define('_COM_SEF_TT_SH_ADV_MANAGE_URL', '��� ������� �������������� ����������:<br /><b>��������� �� ���������</b><br/>������� ���������, ���� ������������ ��������� SEF Advanced, �� �� ����� �����������. <br/><b>�� ����������</b><br/>�� ��������� � �� and ��������� SEF ������ � ������ �����<br/><b>����������</b><br/>�� ������ SEF ������ ��� ������� ����������<br/>');
define('_COM_SEF_SH_ADV_TRANSLATE_URL', '���������� URL');
define('_COM_SEF_TT_SH_ADV_TRANSLATE_URL', '��� ������� �������������� ����������. ��������, ���� URL ����� ������������. �� ���� �������, ���� ���� ����� ������ ���� ����.');
define('_COM_SEF_SH_ADV_INSERT_ISO', '�������� ��� ISO');
define('_COM_SEF_TT_SH_ADV_INSERT_ISO', '��� ������� �������������� ���������� � ���� ��� ���� �������������, �������� ��������� ��� ��� ��� ISO � SEF ������. ��������: www.monsite.com/<b>fr</b>/introduction.html. fr ��� ������������. ������ ��� �� ����� �������� � ������ ����� �� ���������.');
define('_COM_SEF_SH_CB_USE_USER_PSEUDO', '�������� ���������� ������������');
define('_COM_SEF_TT_SH_CB_USE_USER_PSEUDO', '���� <strong>��</strong>, �� ��������� ������������ ����� �������� � SEF ������ ������ ��� ���������� �����, ���� �� ������� ������ ����� ����.');
define('_COM_SEF_SH_OVERRIDE_SEF_EXT', '��������� sef_ext ����');
define('_COM_SEF_SH_DO_NOT_OVERRIDE_SEF_EXT', '�� �������� sef_ext ����');
define('_COM_SEF_TT_SH_ADV_OVERRIDE_SEF', '��������� ���������� ���� �� ������ ������� sef_ext ���������������� ��� �������������� � OpenSEF ��� SEF Advanced. ���� �������� �� - (��������� sef_ext), �� ���� ������� ���������� �� ����� ����������� � ������ sh404SEF ����� ����������� ������ ���� (��� �������, ��� �� ���� ��� ����� ����������). ���� ���, ����� sef_ext ���� ���������� ����� �����������.'); 

//V 1.2.4.q
define('_COM_SEF_SH_CONF_TAB_MAIN', '��������');
define('_COM_SEF_SH_CONF_TAB_PLUGINS', '�������');
define('_COM_SEF_SH_CONF_TAB_ADVANCED', '�����������');
define('_COM_SEF_SH_CONF_TAB_BY_COMPONENT', '����������');

// V 1.2.4.q
define('_COM_SEF_SH_ENCODE_URL', '������������� URL');
define('_COM_SEF_TT_SH_ENCODE_URL', '���� ��, �� URL ����� ������������ ���, ����� ���� ����������� � �������, �������� �� ��������� �������. ��������������� URL ����� ���������: mysite.com/%34%56%E8%67%12.....');
define('_COM_SEF_SH_FILTER', '������');
define('_COM_SEF_CONFIRM_ERASE_CACHE', '�� �������, ��� ������ �������� ��� ������ (URL)?   ��� ������������� ������� ����� ��������� �����������. ��� �������� ���� �����, ���������� ����� ����� �� ���� ���� � ������� �� �������, ��� �� �����(!) ������� ����� �����.');

?>

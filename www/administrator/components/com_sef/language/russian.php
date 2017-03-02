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

defined( '_VALID_MOS' ) or die( 'Доступ запрещен.' );

// admin interface
DEFINE('_COM_SEF_CONFIG','sh404SEF<br/>Конфигурация');
DEFINE('_COM_SEF_CONFIG_DESC','Настройка функционирования sh404SEF');
DEFINE('_COM_SEF_HELP','sh404SEF<br/>Поддержка');
DEFINE('_COM_SEF_HELPDESC','Нужна помощь по sh404SEF?');
DEFINE('_COM_SEF_INFO','sh404SEF<br/>Документация');
DEFINE('_COM_SEF_INFODESC','Посмотреть Сводку и Документацию по sh404SEF');
DEFINE('_COM_SEF_VIEWURL','Просмотреть/Изменить<br/>SEF ссылки');
DEFINE('_COM_SEF_VIEWURLDESC','Просмотреть/Изменить SEF ссылки');
DEFINE('_COM_SEF_VIEW404','Просмотреть/Изменить<br/>404 логи');
DEFINE('_COM_SEF_VIEW404DESC','Просмотреть/Изменить 404 логи');
DEFINE('_COM_SEF_VIEWCUSTOM','Просмотреть/Изменить<br/>Выборочные переадресации');
DEFINE('_COM_SEF_VIEWCUSTOMDESC','Просмотреть/Изменить Выборочные переадресации');
DEFINE('_COM_SEF_SUPPORT','Поддержка<br/>Веб');
DEFINE('_COM_SEF_SUPPORTDESC','Перейти на сайт sh404SEF (в новом окне)');
DEFINE('_COM_SEF_BACK','Вернуться в Панель Управления sh404SEF');
DEFINE('_COM_SEF_PURGEURL','Очистить<br/>SEF ссылки');
DEFINE('_COM_SEF_PURGEURLDESC','Очистка SEF ссылок');
DEFINE('_COM_SEF_PURGE404','Очистить<br/>404 логи');
DEFINE('_COM_SEF_PURGE404DESC','Очистка лога ошибок 404');
DEFINE('_COM_SEF_PURGECUSTOM','Очистить<br/>Выборочные переадресаци');
DEFINE('_COM_SEF_PURGECUSTOMDESC','Очитска Выборочных переадресаций');
DEFINE('_COM_SEF_WARNDELETE','ВНИМАНИЕ!!!<br/>Вы собираетесь удалить ');
DEFINE('_COM_SEF_RECORD',' запись');
DEFINE('_COM_SEF_RECORDS',' записи');
DEFINE('_COM_SEF_NORECORDS','Записи не найдены.');
DEFINE('_COM_SEF_PROCEED',' Продолжить ');
DEFINE('_COM_SEF_OK',' OK ');
DEFINE('_COM_SEF_SUCCESSPURGE','Записи успешно очищены');
DEFINE('_PREVIEW_CLOSE','Закрыть данное окно');
DEFINE('_COM_SEF_EMPTYURL','Необходимо ввести Ссылку (URL) для перенаправления.');
DEFINE('_COM_SEF_NOLEADSLASH','В Новой ссылке (URL) недолжно быть Слэша впереди.');
DEFINE('_COM_SEF_BADURL','Старая Non-SEF ссылка должна начинаться с index.php');
DEFINE('_COM_SEF_URLEXIST','Ссылка (URL) уже существует в базе данных!');
DEFINE('_COM_SEF_SHOW0','Показать SEF ссылки');
DEFINE('_COM_SEF_SHOW1','Показать 404 логи');
DEFINE('_COM_SEF_SHOW2','Показать Выборочные переадресации');
DEFINE('_COM_SEF_INVALID_URL','НЕВЕРНЫЙ URL: данная ссылка требует правильный Itemid, но он не найден.<br/>РЕШЕНИЕ: Создайте пункт меню для данного элемента. Вам ненужно его публиковать, просто создайте его.');
DEFINE('_COM_SEF_DEF_404_MSG','<h1>404: Не найдено</h1><h4>Извините, но содержимое, которое Вы запросили не найдено</h4>');
DEFINE('_COM_SEF_SELECT_DELETE','Выберите элемент для удаления');
DEFINE('_COM_SEF_ASC',' (asc) ');
DEFINE('_COM_SEF_DESC',' (desc) ');
DEFINE('_COM_SEF_WRITEABLE',' <b><font color="green">Открыта для записи</font></b>');
DEFINE('_COM_SEF_UNWRITEABLE',' <b><font color="red">Закрыта для записи</font></b>');
DEFINE('_COM_SEF_USING_DEFAULT',' <b><font color="red">Использование Значений по умолчанию</font></b>');
DEFINE('_COM_SEF_DISABLED',"<p class='error'>ПРИМЕЧАНИЕ: Поддержка SEF в Joomla/Mambo выключена. Для использования SEF, пожалуйста, включите ее из страницы SEO<a href='".
  $GLOBALS['mosConfig_live_site']."/administrator/index2.php?option=com_config'>Глобальная Конфигурация</a></p>");
DEFINE('_COM_SEF_TITLE_CONFIG','Конфигурация sh404SEF ');
DEFINE('_COM_SEF_TITLE_BASIC','Основная Конфигурация');
DEFINE('_COM_SEF_ENABLED','Включено');
DEFINE('_COM_SEF_TT_ENABLED','Если выбрано Нет, то будет использован стандартный SEF для Joomla/Mambo');
DEFINE('_COM_SEF_DEF_404_PAGE','Страница ошибки 404:');
DEFINE('_COM_SEF_REPLACE_CHAR','Символ замены:');
DEFINE('_COM_SEF_TT_REPLACE_CHAR','Символ, используемый для замены неизвестных символов в ссылке (URL)');
DEFINE('_COM_SEF_PAGEREP_CHAR','<nobr>Символ разделителя страниц:</nobr>');
DEFINE('_COM_SEF_TT_PAGEREP_CHAR','Символ, используемый для отделения номеров страниц от названия ссылки (URL)');
DEFINE('_COM_SEF_STRIP_CHAR','Удаляемые символы:');
DEFINE('_COM_SEF_TT_STRIP_CHAR','Символы, удаляемые из ссылок (URL). Введите, разделяя их символом |');
DEFINE('_COM_SEF_FRIENDTRIM_CHAR','Допустимые символы:');
DEFINE('_COM_SEF_TT_FRIENDTRIM_CHAR','Символы, которые можно использовать в ссылках (URL). Введите, разделяя их символом |');
DEFINE('_COM_SEF_USE_ALIAS','Использовать псевдонимы');
DEFINE('_COM_SEF_TT_USE_ALIAS','Выберите Да, чтобы использовать Псевдонимы зоголовков вместо Текста заголовка в ссылке (URL)');
DEFINE('_COM_SEF_SUFFIX','Расширение файлов:');
DEFINE('_COM_SEF_TT_SUFFIX','Расширение для \\\'files\\\'. Оставьте пустым, если не будет расширений. По умолчанию - \\\'.html\\\'.');
DEFINE('_COM_SEF_ADDFILE','Файл индекса по умолчанию:');
DEFINE('_COM_SEF_TT_ADDFILE','Имя файла для добавления к ссылкам, имеющим в конце символ слэша - /. Полезен для поисковых роботов, ожидающих определенный файл, но которым возвращается ошибка 404, если файла нет.');
DEFINE('_COM_SEF_PAGETEXT','Текст страницы:');
DEFINE('_COM_SEF_TT_PAGETEXT','Текст, добавляемый к ссылке для многостраничных материалов. Используется %s для вставки номера страницы в конце ссылки. Если суффикс определен, он будет добавлен в конец строки.');
DEFINE('_COM_SEF_LOWER','В нижнем регистре');
DEFINE('_COM_SEF_TT_LOWER','Преобразовать все символы в нижний регистр в ссылке (URL)','В нижнем регистре');
DEFINE('_COM_SEF_SHOW_SECT','Показать Разделы');
DEFINE('_COM_SEF_TT_SHOW_SECT','Если Да, то будет добавлено название раздела в ссылку');
DEFINE('_COM_SEF_HIDE_CAT','Убрать Категории');
DEFINE('_COM_SEF_TT_SHOW_CAT','Если Да, то категории будут исключены из ссылки');
DEFINE('_COM_SEF_404PAGE','Страница ошибок 404:');
DEFINE('_COM_SEF_TT_404PAGE','Статичная странца для 404 ошибок - Не найдено (состояние публикации не имеет значения)');
DEFINE('_COM_SEF_TITLE_ADV','Дополнительные настройки компонента');
DEFINE('_COM_SEF_TT_ADV','<b>исп. заголовок по умолчанию</b><br/>идет нормально, если расширение SEF Advanced присутствует, то оно будет использовано.<br/><b>не кэшировать</b><br/>не сохранять в БД и создавать SEF ссылки в старом стиле<br/><b>пропустить</b><br/>не создавать SEF ссылки для этого компонента<br/>');
DEFINE('_COM_SEF_TT_ADV4','Дополнительные Настройки для ');
DEFINE('_COM_SEF_TITLE_MANAGER','sh404SEF Менеджер ссылок (URL)');
DEFINE('_COM_SEF_VIEWMODE','Режим просмотра:');
DEFINE('_COM_SEF_SORTBY','Сортировать по:');
DEFINE('_COM_SEF_HITS','Просмотры');
DEFINE('_COM_SEF_DATEADD','Дата добавления');
DEFINE('_COM_SEF_SEFURL','SEF ссылки');
DEFINE('_COM_SEF_URL','Ссылки');
DEFINE('_COM_SEF_REALURL','Реальные ссылки');
DEFINE('_COM_SEF_EDIT','Редактировать');
DEFINE('_COM_SEF_ADD','Добавить');
DEFINE('_COM_SEF_NEWURL','Новая SEF ссылка');
DEFINE('_COM_SEF_TT_NEWURL','Только относительное перенаправление из Joomla/Mambo каталога <i>без</i> слэш впереди');
DEFINE('_COM_SEF_OLDURL','Старые Non-SEF ссылки');
DEFINE('_COM_SEF_TT_OLDURL','Эта ссылка (URL) должна начинаться с index.php');
DEFINE('_COM_SEF_SAVEAS','Сохранить как Выборочную Переадресацию');
DEFINE('_COM_SEF_TITLE_SUPPORT','sh404SEF Поддержка');
DEFINE('_COM_SEF_HELPVIA','<b>Поддержка доступна через слудующие форумы:</b>');
DEFINE('_COM_SEF_OFFICIAL','Оффициальный Форум Проекта');
DEFINE('_COM_SEF_MAMBERS','Форум Участников');
DEFINE('_COM_SEF_TITLE_PURGE','База Данных Очистки sh404SEF');
DEFINE('_COM_SEF_USE_DEFAULT','(использовать заголовок по умолчанию)');
DEFINE('_COM_SEF_NOCACHE','не кэшировать');
DEFINE('_COM_SEF_SKIP','пропустить');
DEFINE('_COM_SEF_INSTALLED_VERS','Установленная версия:');
DEFINE('_COM_SEF_COPYRIGHT','Copyright');
DEFINE('_COM_SEF_LICENSE','Лицензия');
DEFINE('_COM_SEF_SUPPORT_404SEF','Поддержите нас');
DEFINE('_COM_SEF_CONFIG_UPDATED','Конфигурация обновлена');
DEFINE('_COM_SEF_WRITE_ERROR','Ошибка при записи конфигурации');
DEFINE('_COM_SEF_NOACCESS','Доступ невозможен');
DEFINE('_COM_SEF_FATAL_ERROR_HEADERS','FATAL ERRPR: Заголовок уже отправлен');
DEFINE('_COM_SEF_UPLOAD_OK','Файл успешно загружен');
DEFINE('_COM_SEF_ERROR_IMPORT','Ошибка при импорте:');
DEFINE('_COM_SEF_INVALID_SQL','Неверные данные в файле SQL :');
DEFINE('_COM_SEF_NO_UNLINK','Невозможно переместить загруженный файл из каталога медиа');
DEFINE('_COM_SEF_IMPORT_OK','Выборочные ссылки (URLs) успешно импортированы!');
DEFINE('_COM_SEF_WRITE_FAILED','Невозможно записать загруженный файл в дерикторию медиа');
DEFINE('_COM_SEF_EXPORT_FAILED','Экспорт закончился неудачно!!!');
DEFINE('_COM_SEF_IMPORT_EXPORT','Импорт/Экспорт ссылок');
DEFINE('_COM_SEF_SELECT_FILE','Пожалуйста, выберите сначала файл');
DEFINE('_COM_SEF_IMPORT','Импортир. Выборочные ссылки (URLs)');
DEFINE('_COM_SEF_EXPORT','Зарезервир. Выборочные ссылки (URLs)');

// component interface
DEFINE('_COM_SEF_NOREAD','ОШИБУКА: Невозможно прочитать файл ');
DEFINE('_COM_SEF_CHK_PERMS','Пожалуйста, проверьте разрешения на ваш файл и убедитесь, что этот файл может быть прочитан.');
DEFINE('_COM_SEF_DEBUG_DATA_DUMP','ДЕБАГ ДАМПА ДАННЫХ ЗАВЕРШЕН: Загрузка Страницы Завершена');
DEFINE('_COM_SEF_STRANGE','Произошло что-то странное. Этого недолжно быть<br />');

//Added by Leon
define('_FULL_TITLE', 'Полный заголовок');
define('_TITLE_ALIAS', 'Псевдоним заголовка');
define('_COM_SEF_SHOW_CAT', 'Показать Категорию');

// added by shumisha

// General params
define('_COM_SEF_SH_REPLACEMENTS', 'Список заменяемых символов:');
define('_COM_SEF_TT_SH_REPLACEMENTS', 'Символы не принятые для ссылки (URL), такие как не латинские или подчеркнутые, могут быть заменены исходя из данной таблицы замены. <br />Формат xxx | yyy для каждого заменяемого символа. xxx - заменяемый символ, а yyy - новый, заменяющий символ. <br />Может быть создано множество таких правил разделенных запятыми (,). Между старым и новым символами, используйте символ разделения | <br />Учтите также, что xxx или yyy могут быть многосимвольными, например _|oe ');

// cache params
define('_COM_SEF_SH_CACHE_TITLE', 'Управление Кэшированием');
define('_COM_SEF_SH_USE_URL_CACHE', 'Включить кэш URL');
define('_COM_SEF_TT_SH_USE_URL_CACHE', 'Если Да, SEF ссылки (URL) будут записаны в кэш на диск, что существенно увеличит скорость загрузки страниц. Однако это потребует использования дисковой памяти!');
define('_COM_SEF_SH_MAX_URL_IN_CACHE', 'Размер кэш:');
define('_COM_SEF_TT_SH_MAX_URL_IN_CACHE', 'Когда кэш ссылок (URL) активирован данный параметр устанавливает его максимальный размер. Введите максимальное число ссылок (URL), которые могут быть сохранены в кэш (дополнительные ссылки будут обработаны, но не будут сохранены в кэш, отчего время загрузки страницы увеличится). Грубо говоря, каждая ссылки (URL) занимает примерно 200 байт (100 для SEF ссылки and 100 для не-SEF ссылки). Например, 5000 ссылок займут, примерно, 1 Мб на диске.');
// URL translation
define('_COM_SEF_SH_TRANSLATION_TITLE', 'Управление переводом');
define('_COM_SEF_SH_TRANSLATE_URL', 'Перевести ссылку');
define('_COM_SEF_TT_SH_TRANSLATE_URL', 'Если Да и сайт многоязычный, значения SEF ссылок будут переведены в язык посетителя сайта, как решено в Joomfish. Если Нет, ссылки будут на языке сайта. Не используйте, если сайт не многоязычный.');
// itemid control
define('_COM_SEF_SH_ITEMID_TITLE', 'Управление Itemid');
define('_COM_SEF_SH_INSERT_GLOBAL_ITEMID_IF_NONE', 'Вставить Itemid меню, если нет');
define('_COM_SEF_TT_SH_INSERT_GLOBAL_ITEMID_IF_NONE', 'Если Itemid не установлен в не-SEF URL перед его преобразованием в SEF и Вы включите данную опцию, текущий пункт меню Itemid будет добавлен к нему. Это гарантирует, что если кликнуть, ссылка приведент на туже страницу (т.е. тоже, что и отображают модули)');
define('_COM_SEF_SH_INSERT_TITLE_IF_NO_ITEMID', 'Вставить заголовок меню, если нет Itemid');
define('_COM_SEF_TT_SH_INSERT_TITLE_IF_NO_ITEMID', 'Если Itemid не установлен в не-SEF URL перед его before преобразованием в SEF и Вы включите данную опцию, текущий элемент Заголовка меню будет добавлен в SEF ссылку. Это стоит задействовать, если параметр выше также задействован, так как это предотвратит -2, -3, -... добавление к SEF ссылке, если материал просматривается из разных мест.');
define('_COM_SEF_SH_ALWAYS_INSERT_MENU_TITLE', 'Всегда добавлять заголовок меню');
define('_COM_SEF_TT_SH_ALWAYS_INSERT_MENU_TITLE', 'Если Да, заголовок меню соответствующий Itemid устанавленный в не-Sef URL, или текущем элементе заголовка меню, если не установлен Itemid, будет добавлен в SEF ссылку.');
define('_COM_SEF_SH_ALWAYS_INSERT_ITEMID', 'Всегда прибавлять Itemid к SEF ссылке');
define('_COM_SEF_TT_SH_ALWAYS_INSERT_ITEMID', 'Если Да, то не-SEF Itemid (или Itemid текущго пункта меню, если установлено Нет в не-sef URL) будет добавлен к SEF ссылке. Это может быть использоано вместо постоянной вставки параметра заголовка меню, если у Вас есть несколько пунктов меню с одинаковым заголовком (как, например, один в главном меню и один в верхнем меню)');
define('_COM_SEF_SH_ALWAYS_INSERT_ITEMID_PREFIX', 'ID Меню');
define('_COM_SEF_SH_DEFAULT_MENU_ITEM_NAME', 'Стандартный заголовок меню:');
define('_COM_SEF_TT_SH_DEFAULT_MENU_ITEM_NAME', 'Когда параметр выше выбран (Да), вы можете здесь отвергнуть текст добавленный в SEF ссылку. Имейте ввиду, что этот текст будет неизменным и не будет переведен');

// Virtuemart params
define('_COM_SEF_SH_VM_TITLE', 'Параметры Virtuemart');
define('_COM_SEF_SH_VM_INSERT_SHOP_NAME', 'Добавить название магазина в ссылку (URL)');
define('_COM_SEF_TT_SH_VM_INSERT_SHOP_NAME', 'Если <strong>Да<strong>, название магазина (как определено в пункте меню заголовка магазина) будет всегда добавляться к SEF ссылке');
define('_COM_SEF_SH_SHOP_NAME', 'Название магазина по умолчанию:');
define('_COM_SEF_TT_SH_SHOP_NAME', 'Если параметр выше - Да, Вы можете здесь отвергнуть текст добавленный в SEF ссылку. Имейте ввиду, что этот текст будет неизменным и не будет переведен');
define('_COM_SEF_SH_INSERT_PRODUCT_ID', 'Добавить ID продукта в URL');
define('_COM_SEF_TT_SH_INSERT_PRODUCT_ID', 'Если Да, ID продукта будет добавлен к названию продукта в ссылке SEF<br />Например: mysite.com/3-my-very-nice-product.html.<br />Это полезно, если вы не добавляете названия категорий в URL, так как различниые продукты могут иметь схожие названия в различных категориях. Имейте ввиду, что это не продукт SKU, но лучше, чем встроенный ID продукта, который все время однозначен.');
define('_COM_SEF_SH_VM_USE_PRODUCT_SKU', 'Использовать SKU продукта для названия');
define('_COM_SEF_TT_SH_VM_USE_PRODUCT_SKU', 'Если Да, SKU продукта, код продукта, которые Вы вводите для каждого продукта, будут использованы вместо полного названия продукта.');
define('_COM_SEF_SH_VM_INSERT_MANUFACTURER_NAME', 'Добавить название производителя в URL');
define('_COM_SEF_TT_SH_VM_INSERT_MANUFACTURER_NAME', 'Если Да, название производителя, если есть, будет добавлено в SEF ссылку впереди продукта.<br />Например: mysite.com/manufacturer-name/product-name.html');
define('_COM_SEF_SH_VM_INSERT_MANUFACTURER_ID', 'Добавить ID производителя');
define('_COM_SEF_TT_SH_VM_INSERT_MANUFACTURER_ID', 'Если Да, ID производителя будет добавлено перед названием производителя в SEF ссылке<br />Например: mysite.com/6-manufacturer-name/3-my-very-nice-product.html.');
define('_COM_SEF_SH_VM_INSERT_CATEGORIES', 'Добавить категории');
define('_COM_SEF_TT_SH_VM_INSERT_CATEGORIES', 'Если <strong>Нет</strong>, название категории не будет добавлено в URL впереди продукта, как в: <br /> mysite.com/joomla-cms.html<br />Если <strong>Только одна последняя</strong> - название категории, к которой относится продукт, будет добавлено в SEF ссылку, как в: <br /> mysite.com/joomla/joomla-cms.html<br />Если <strong>Все входящие категории</strong>, то будут добавлены все категории, к которым относится продукт, как в: <br /> mysite.com/software/cms/joomla/joomla-cms.html');
define('_COM_SEF_SH_VM_DO_NOT_SHOW_CATEGORIES', 'Нет');
define('_COM_SEF_SH_VM_SHOW_LAST_CATEGORY', 'Только одна последняя');
define('_COM_SEF_SH_VM_SHOW_ALL_CATEGORIES', 'Все входящие категории');
define('_COM_SEF_SH_VM_INSERT_CATEGORY_ID', 'Вставить ID категории в URL');
define('_COM_SEF_TT_SH_VM_INSERT_CATEGORY_ID', 'Если Да, ID категории будет добавлено к каждому названию категории в URL перед название продукта, как в: <br /> mysite.com/1-software/4-cms/1-joomla/joomla-cms.html');

// V 1.2.4.h
// insert numerical id params
define('_COM_SEF_SH_INSERT_NUMERICAL_ID_TITLE', 'Уникальный ID');
define('_COM_SEF_SH_INSERT_NUMERICAL_ID', 'Добавить номерной ID в URL');
define('_COM_SEF_TT_SH_INSERT_NUMERICAL_ID', 'Если <strong>Да</strong>, номерной ID будет добавлен к URL в целях облегчения включения в сервис, такой как Google новости. ID будет соответствовать формату: 2007041100000, где 20070411 дата создания и 00000  - внутренний уникальный ID элемента содержания. В итоге, Вам нужно установить дату создания, когда содержимое готово к публикации. Имейте ввиду, что в дальнейшем Вы не сможете ее изменить.');
define('_COM_SEF_SH_INSERT_NUMERICAL_ID_ALL_CAT', 'Все категории:');
define('_COM_SEF_SH_INSERT_NUMERICAL_ID_CAT_LIST', 'Применить ко всем категориям');
define('_COM_SEF_TT_SH_INSERT_NUMERICAL_ID_CAT_LIST', 'Номерной ID будет добавлен только в SEF ссылки элеменов содержания представленных здесь. Вы можете выбрать множество категорий нажатием и удержанием клавиши CTRL перед нажатием на название категории.');

// V 1.2.4.j
define('_COM_SEF_SH_REDIRECT_NON_SEF_TO_SEF', '301 перенаправление из не-Sef в SEF URL');
define('_COM_SEF_TT_SH_REDIRECT_NON_SEF_TO_SEF', 'Если <strong>Да</strong>, не-Sef URL уже присутствующие в БД будут перенаправлены в их SEF часть используя 301 - Постоянно перемещенное перенаправление. Если SE-URL не существует, оно будет создано, если кроме этого там есть POST информация в запросе страницы.');
define('_COM_SEF_SH_LIVE_SECURE_SITE', 'URL защищенного SSL соединения:');
define('_COM_SEF_TT_SH_LIVE_SECURE_SITE', 'Задайте это к <strong>полному URL бызы вашего сайте когда он в режиме SSL</strong>.<br />Необходимо только если Вы используете https доступ. Если нет, то по умолчанию будет httpS://normalSiteURL.<br />Пожалуйста введите полный url без слеша впереди. Например: <strong>https://www.mysite.com</strong> или <strong>https://sharedsslserveur.com/myaccount</strong>.');

// V 1.2.4.k
define('_COM_SEF_SH_IJOOMLA_MAG_TITLE', 'Настройки Магазина iJoomla');
define('_COM_SEF_SH_ACTIVATE_IJOOMLA_MAG', 'Активировать магазин iJoomla в содержимом');
define('_COM_SEF_TT_SH_ACTIVATE_IJOOMLA_MAG', 'Если <strong>Да</strong>, то ed параметр, если присутствует в компоненте com_content, будет интерпретирован как ID iJoomla магазина.');
define('_COM_SEF_SH_INSERT_IJOOMLA_MAG_ISSUE_ID', 'Добавить исходный ID в URL');
define('_COM_SEF_TT_SH_INSERT_IJOOMLA_MAG_ISSUE_ID', 'Если <strong>Да</strong>, то уникальный внутренний исходный ID будет добавлен к каждому исходному названию, чтобы быть уверенным, что оно уникально.');
define('_COM_SEF_SH_INSERT_IJOOMLA_MAG_NAME', 'Добавить название магазина в URL');
define('_COM_SEF_TT_SH_INSERT_IJOOMLA_MAG_NAME', 'Если <strong>Да<strong>, то название магазина (как определено в заголовке магазина) всегда будет добавляться к SEF ссылке');
define('_COM_SEF_SH_IJOOMLA_MAG_NAME', 'Название магазина по умолчанию:');
define('_COM_SEF_TT_SH_IJOOMLA_MAG_NAME', 'Когда предыдущий параметр - Да, Вы можете здесь заменить текст добавленный в SEF ссылку. Имейте ввиду, что текст будет постоянен и не будет переведен');
define('_COM_SEF_SH_INSERT_IJOOMLA_MAG_MAGAZINE_ID', 'Добавить ID магазина в URL');
define('_COM_SEF_TT_SH_INSERT_IJOOMLA_MAG_MAGAZINE_ID', 'Если <strong>Да</strong>, ID магазина будет добавлен к каждому названию магазина в URL, как в: <br /> mysite.com/<strong>4</strong>-Joomla-magazine/Good-article-title.html');
define('_COM_SEF_SH_INSERT_IJOOMLA_MAG_ARTICLE_ID', 'Добавить ID материала в URL');
define('_COM_SEF_TT_SH_INSERT_IJOOMLA_MAG_ARTICLE_ID', 'Если <strong>Да</strong>, ID материала будет добавлен к каждому заголовку материала в URL, как в: <br /> mysite.com/Joomla-magazine/<strong>56</strong>-Good-article-title.html');

define('_COM_SEF_SH_CB_TITLE', 'Параметры Community Builder ');
define('_COM_SEF_SH_CB_INSERT_NAME', 'Добавить название Community Builder');
define('_COM_SEF_TT_SH_CB_INSERT_NAME', 'Если <strong>Да</strong>, заголовое меню впереди основной страницы Community Builder будет добавлен ко всем CB SEF URL');
define('_COM_SEF_SH_CB_NAME', 'Название CB по умолчанию:');
define('_COM_SEF_TT_SH_CB_NAME', 'Когда предыдущий параметр - Да, Вы здесь Вы можете вставить текст замены в SEF URL. Имейте ввиду, что этот текст будет постояенен и не будет переведен.');
define('_COM_SEF_SH_CB_INSERT_USER_NAME', 'Добавить Имя пользователя');
define('_COM_SEF_TT_SH_CB_INSERT_USER_NAME', 'Если <strong>Да</strong>, имя пользователя будет добавлено в SEF ссылки. <strong>ВНИМАНИЕ:</strong> это может основательно увеличить размер БД и затормозить работу сайт, если у Вас много зарегистрированных пользователей. Если выбрано Нет, то будет использован ID пользователя в следующем вормате: ..../send-user-email.html?user=245');
define('_COM_SEF_SH_CB_INSERT_USER_ID', 'Добавить ID пользователя');
define('_COM_SEF_TT_SH_CB_INSERT_USER_ID', 'Если <strong>Да</strong>, ID пользоателя будет добавлен к его имени <strong>при условии, что предыдущией параметрв активен (Да)</strong>, в случае, если два пользователя имеют одно имя.');

define('_COM_SEF_SH_LOG_404_ERRORS', 'Логи ошибок 404');
define('_COM_SEF_TT_SH_LOG_404_ERRORS', 'Если <strong>Да</strong>, 404 ошибки будут записаны в БД. Это может помочь найти ошибки в ссылках сайта. Это также займет место в БД, поэтому Вы можете отключить данный параметр, когда сайт протестирован.');

define('_COM_SEF_SH_VM_ADDITIONAL_TEXT', 'Дополнительный текст:');
define('_COM_SEF_TT_SH_VM_ADDITIONAL_TEXT', 'Если <strong>Да</strong>, то дополнительный текст будет добавлен к категориям URL. Например: ..../category-A/View-all-products.html VS ..../category-A/ .');

// V 1.2.4.m
define('_COM_SEF_SH_REDIRECT_JOOMLA_SEF_TO_SEF', '301 перенаправление с JOOMLA SEF в sh404SEF');
define('_COM_SEF_TT_SH_REDIRECT_JOOMLA_SEF_TO_SEF', 'Если <strong>Да</strong>, то стандартные ссылки JOOMLA SEF будут перенаправлены командой 301 в sh404SEF эквивалент, если они есть в БД. Если их нет в БД, то они будут созданы налету.');
define('_COM_SEF_SH_VM_INSERT_FLYPAGE', 'Всавить Имя flypage');
define('_COM_SEF_TT_SH_VM_INSERT_FLYPAGE', 'Если Да, то название flypage будет добавлено в URL впереди описания продукта. Может быть неактивно, если Вы используете лишь одну flypage.');
define('_COM_SEF_SH_LETTERMAN_TITLE', 'Настройки Letterman ');
define('_COM_SEF_SH_LETTERMAN_DEFAULT_ITEMID', 'Itemid для страницы Letterman по умолчанию');
define('_COM_SEF_TT_SH_LETTERMAN_DEFAULT_ITEMID', 'Введите Itemid страницы, которая будет добавлена в ссылки Letterman (отписаться, сообщения подтверждения, ...');

define('_COM_SEF_SH_FB_TITLE', 'Настройки Fireboard ');
define('_COM_SEF_SH_FB_INSERT_NAME', 'Вставить название Fireboard');
define('_COM_SEF_TT_SH_FB_INSERT_NAME', 'Если <strong>Да</strong>, то пункт заголовка меню впереди основной страницы Fireboard будет присоединен ко всем Fireboard SEF ссылкам');
define('_COM_SEF_SH_FB_NAME', 'Название Fireboard по умолчанию:');
define('_COM_SEF_TT_SH_FB_NAME', 'Если <strong>Да<strong>, название Fireboard (как определено в заголовке пункат меню Fireboard) всегда будет добавляться к SEF ссылкам.');
define('_COM_SEF_SH_FB_INSERT_CATEGORY_NAME', 'Вставить Название категории');
define('_COM_SEF_TT_SH_FB_INSERT_CATEGORY_NAME', 'Если Да, то название категории будет добавлено во все SEF ссылки сообщений');
define('_COM_SEF_SH_FB_INSERT_CATEGORY_ID', 'Добавить ID категории');
define('_COM_SEF_TT_SH_FB_INSERT_CATEGORY_ID', 'Если <strong>Да</strong>, то ID категории будет добавлено к его названию, <strong>когда предыдущий параметр также выбран (Да)</strong>, к примеру, если две категрии имеют одно и тоже название.');
define('_COM_SEF_SH_FB_INSERT_MESSAGE_SUBJECT', 'Вставить предмент сообщения');
define('_COM_SEF_TT_SH_FB_INSERT_MESSAGE_SUBJECT', 'Если <strong>Да</strong>, предмет сообщения будет вставлен в SEF ссылку впереди сообщения.');
define('_COM_SEF_SH_FB_INSERT_MESSAGE_ID', 'Вставить ID сообщения');
define('_COM_SEF_TT_SH_FB_INSERT_MESSAGE_ID', 'Если <strong>Да</strong>, ID сообщения будет добавлен к предмету сообщения <strong>когда предыдущий параметр также выбран (Да)</strong>, к примеру, если два сообщения имеют одинаковое название предмета.');
define('_COM_SEF_SH_INSERT_LANGUAGE_CODE', 'Вставить Код языка в URL');
define('_COM_SEF_TT_SH_INSERT_LANGUAGE_CODE', 'Если <strong>Да</strong>, то будет вставлен ISO код языка в SEF ссылку, кроме, если язык является языком по умолчанию для сайта.');
DEFINE('_COM_SEF_SH_DO_NOT_TRANSLATE_URL','Не переводить');
DEFINE('_COM_SEF_SH_DO_NOT_INSERT_LANGUAGE_CODE','Не вставлять код');
define('_COM_SEF_SH_ADV_MANAGE_URL', 'Обработки URL');
define('_COM_SEF_TT_SH_ADV_MANAGE_URL', 'Для каждого установленного компонента:<br /><b>заголовок по умолчанию</b><br/>обычная обработка, если присутствует компонент SEF Advanced, то он будет использован. <br/><b>не кэшировать</b><br/>не сохранять в БД and создавать SEF ссылки в старом стиле<br/><b>пропустить</b><br/>не делать SEF ссылки для данного компонента<br/>');
define('_COM_SEF_SH_ADV_TRANSLATE_URL', 'Переводить URL');
define('_COM_SEF_TT_SH_ADV_TRANSLATE_URL', 'Для каждого установленного компонента. Выберите, если URL будет переводиться. Не даст эффекта, если сайт имеет только один язык.');
define('_COM_SEF_SH_ADV_INSERT_ISO', 'Вставить код ISO');
define('_COM_SEF_TT_SH_ADV_INSERT_ISO', 'Для каждого установленного компонента и если Ваш сайт многоязыковый, выберите вставлять или нет код ISO в SEF ссылку. Например: www.monsite.com/<b>fr</b>/introduction.html. fr для Французского. Данный код не будет добавлен в ссылку языка по умолчанию.');
define('_COM_SEF_SH_CB_USE_USER_PSEUDO', 'Вставить Псеводоним пользователя');
define('_COM_SEF_TT_SH_CB_USE_USER_PSEUDO', 'Если <strong>Да</strong>, то псевдоним пользователя будет добавлен к SEF ссылке вместо его настоящего имени, если Вы выбрали данную опцию выше.');
define('_COM_SEF_SH_OVERRIDE_SEF_EXT', 'Заместить sef_ext файл');
define('_COM_SEF_SH_DO_NOT_OVERRIDE_SEF_EXT', 'Не замещать sef_ext файл');
define('_COM_SEF_TT_SH_ADV_OVERRIDE_SEF', 'Некоторые компоненты идут со своими файлами sef_ext предназначенными для имспользования с OpenSEF или SEF Advanced. Если параметр Да - (Заместить sef_ext), то файл данного расширения не будет использован и плагин sh404SEF будет использован вместо него (при условии, что он один для этого компонента). Если Нет, тогда sef_ext файл компонента будет использован.'); 

//V 1.2.4.q
define('_COM_SEF_SH_CONF_TAB_MAIN', 'Основные');
define('_COM_SEF_SH_CONF_TAB_PLUGINS', 'Плагины');
define('_COM_SEF_SH_CONF_TAB_ADVANCED', 'Расширенные');
define('_COM_SEF_SH_CONF_TAB_BY_COMPONENT', 'Компоненты');

// V 1.2.4.q
define('_COM_SEF_SH_ENCODE_URL', 'Преобразовать URL');
define('_COM_SEF_TT_SH_ENCODE_URL', 'Если Да, то URL будет преобразован так, чтобы быть совместимым с языками, имеющими не латниские символы. Преобразованный URL будет выглядеть: mysite.com/%34%56%E8%67%12.....');
define('_COM_SEF_SH_FILTER', 'Фильтр');
define('_COM_SEF_CONFIRM_ERASE_CACHE', 'Вы уверены, что хотите ОЧИСТИТЬ кэш ссылок (URL)?   Это рекомендуется сделать после изменения конфгурации. Для создания кэша снова, необходимо вновь зайти на свой сайт и проийти по ссылкам, или же лучше(!) создать карту сайта.');

?>

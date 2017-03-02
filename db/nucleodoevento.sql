-- phpMyAdmin SQL Dump
-- version 3.0.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: Mar 02, 2017 as 03:16 AM
-- Versão do Servidor: 5.0.51
-- Versão do PHP: 5.2.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Banco de Dados: `nucleodoevento`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_banner`
--

CREATE TABLE IF NOT EXISTS `jos_banner` (
  `bid` int(11) NOT NULL auto_increment,
  `cid` int(11) NOT NULL default '0',
  `type` varchar(10) NOT NULL default 'banner',
  `name` varchar(50) NOT NULL default '',
  `imptotal` int(11) NOT NULL default '0',
  `impmade` int(11) NOT NULL default '0',
  `clicks` int(11) NOT NULL default '0',
  `imageurl` varchar(100) NOT NULL default '',
  `clickurl` varchar(200) NOT NULL default '',
  `date` datetime default NULL,
  `showBanner` tinyint(1) NOT NULL default '0',
  `checked_out` tinyint(1) NOT NULL default '0',
  `checked_out_time` datetime NOT NULL default '0000-00-00 00:00:00',
  `editor` varchar(50) default NULL,
  `custombannercode` text,
  PRIMARY KEY  (`bid`),
  KEY `viewbanner` (`showBanner`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Extraindo dados da tabela `jos_banner`
--

INSERT INTO `jos_banner` (`bid`, `cid`, `type`, `name`, `imptotal`, `impmade`, `clicks`, `imageurl`, `clickurl`, `date`, `showBanner`, `checked_out`, `checked_out_time`, `editor`, `custombannercode`) VALUES
(1, 1, 'banner', 'OSM 1', 0, 473, 0, 'osmbanner1.png', 'http://www.opensourcematters.org', '2004-07-07 15:31:29', 0, 0, '0000-00-00 00:00:00', '', ''),
(2, 1, 'banner', 'OSM 2', 0, 424, 0, 'osmbanner2.png', 'http://www.opensourcematters.org', '2004-07-07 15:31:29', 0, 0, '0000-00-00 00:00:00', '', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_bannerclient`
--

CREATE TABLE IF NOT EXISTS `jos_bannerclient` (
  `cid` int(11) NOT NULL auto_increment,
  `name` varchar(60) NOT NULL default '',
  `contact` varchar(60) NOT NULL default '',
  `email` varchar(60) NOT NULL default '',
  `extrainfo` text NOT NULL,
  `checked_out` tinyint(1) NOT NULL default '0',
  `checked_out_time` time default NULL,
  `editor` varchar(50) default NULL,
  PRIMARY KEY  (`cid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Extraindo dados da tabela `jos_bannerclient`
--

INSERT INTO `jos_bannerclient` (`cid`, `name`, `contact`, `email`, `extrainfo`, `checked_out`, `checked_out_time`, `editor`) VALUES
(1, 'Open Source Matters', 'Administrator', 'admin@opensourcematters.org', '', 0, '00:00:00', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_bannerfinish`
--

CREATE TABLE IF NOT EXISTS `jos_bannerfinish` (
  `bid` int(11) NOT NULL auto_increment,
  `cid` int(11) NOT NULL default '0',
  `type` varchar(10) NOT NULL default '',
  `name` varchar(50) NOT NULL default '',
  `impressions` int(11) NOT NULL default '0',
  `clicks` int(11) NOT NULL default '0',
  `imageurl` varchar(50) NOT NULL default '',
  `datestart` datetime default NULL,
  `dateend` datetime default NULL,
  PRIMARY KEY  (`bid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Extraindo dados da tabela `jos_bannerfinish`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_blastchatc`
--

CREATE TABLE IF NOT EXISTS `jos_blastchatc` (
  `id` int(11) NOT NULL,
  `url` varchar(100) default NULL,
  `version` varchar(20) NOT NULL default '2.2',
  `intra_id` varchar(100) default NULL,
  `priv_key` varchar(100) default NULL,
  `detached` binary(1) NOT NULL default '0',
  `width` varchar(6) NOT NULL default '100%',
  `height` varchar(6) NOT NULL default '480',
  `d_width` varchar(6) NOT NULL default '640',
  `d_height` varchar(6) NOT NULL default '480',
  `frame_border` binary(1) NOT NULL default '0',
  `m_width` varchar(6) NOT NULL default '0',
  `m_height` varchar(6) NOT NULL default '0',
  `global_count` int(11) NOT NULL default '0',
  `global_update` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `url` (`url`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `jos_blastchatc`
--

INSERT INTO `jos_blastchatc` (`id`, `url`, `version`, `intra_id`, `priv_key`, `detached`, `width`, `height`, `d_width`, `d_height`, `frame_border`, `m_width`, `m_height`, `global_count`, `global_update`) VALUES
(0, 'www.nucleodoevento.com.br', '2.2', '6271e23dadb91c5ffa1360cf516c5c27', '57e704734316d6bf9bb898947642c4c3', '0', '100%', '480', '640', '480', '0', '0', '0', 200, 1184866794);

-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_blastchatc_users`
--

CREATE TABLE IF NOT EXISTS `jos_blastchatc_users` (
  `userid` int(11) default '0',
  `serverid` int(11) default '0',
  `sec_code` varchar(100) default NULL,
  `session_id` varchar(200) default NULL,
  `logged` binary(1) NOT NULL default '0',
  `last_update` int(11) NOT NULL default '0',
  `idle` varchar(5) default NULL,
  `roomid` int(11) NOT NULL default '0',
  `room_serverid` int(11) NOT NULL default '0',
  `roomname` varchar(100) default NULL,
  UNIQUE KEY `sec_code` (`sec_code`),
  UNIQUE KEY `session_id` (`session_id`),
  KEY `userid_logged_last_update` (`userid`,`logged`,`last_update`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `jos_blastchatc_users`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_categories`
--

CREATE TABLE IF NOT EXISTS `jos_categories` (
  `id` int(11) NOT NULL auto_increment,
  `parent_id` int(11) NOT NULL default '0',
  `title` varchar(50) NOT NULL default '',
  `name` varchar(255) NOT NULL default '',
  `image` varchar(100) NOT NULL default '',
  `section` varchar(50) NOT NULL default '',
  `image_position` varchar(10) NOT NULL default '',
  `description` text NOT NULL,
  `published` tinyint(1) NOT NULL default '0',
  `checked_out` int(11) unsigned NOT NULL default '0',
  `checked_out_time` datetime NOT NULL default '0000-00-00 00:00:00',
  `editor` varchar(50) default NULL,
  `ordering` int(11) NOT NULL default '0',
  `access` tinyint(3) unsigned NOT NULL default '0',
  `count` int(11) NOT NULL default '0',
  `params` text NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `cat_idx` (`section`,`published`,`access`),
  KEY `idx_section` (`section`),
  KEY `idx_access` (`access`),
  KEY `idx_checkout` (`checked_out`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Extraindo dados da tabela `jos_categories`
--

INSERT INTO `jos_categories` (`id`, `parent_id`, `title`, `name`, `image`, `section`, `image_position`, `description`, `published`, `checked_out`, `checked_out_time`, `editor`, `ordering`, `access`, `count`, `params`) VALUES
(1, 0, 'Latest', 'Latest News', 'taking_notes.jpg', '1', 'left', 'The latest news from the Joomla! Team', 1, 0, '0000-00-00 00:00:00', '', 0, 0, 1, ''),
(2, 0, 'Joomla!', 'Joomla!', 'clock.jpg', 'com_weblinks', 'left', 'A selection of links that are all related to the Joomla! Project.', 1, 0, '0000-00-00 00:00:00', '', 0, 0, 0, ''),
(3, 0, 'Newsflash', 'Newsflash', '', '2', 'left', '', 1, 0, '0000-00-00 00:00:00', '', 0, 0, 0, ''),
(4, 0, 'Joomla!', 'Joomla!', '', 'com_newsfeeds', 'left', '', 1, 0, '0000-00-00 00:00:00', '', 2, 0, 0, ''),
(5, 0, 'Business: general', 'Business: general', '', 'com_newsfeeds', 'left', '', 1, 0, '0000-00-00 00:00:00', '', 1, 0, 0, ''),
(7, 0, 'Examples', 'Example FAQs', 'key.jpg', '3', 'left', 'Here you will find an example set of FAQs.', 1, 0, '0000-00-00 00:00:00', '', 0, 0, 2, ''),
(9, 0, 'Finance', 'Finance', '', 'com_newsfeeds', 'left', '', 1, 0, '0000-00-00 00:00:00', '', 5, 0, 0, ''),
(10, 0, 'Linux', 'Linux', '', 'com_newsfeeds', 'left', '<br />\r\n', 1, 0, '0000-00-00 00:00:00', '', 6, 0, 0, ''),
(11, 0, 'Internet', 'Internet', '', 'com_newsfeeds', 'left', '', 1, 0, '0000-00-00 00:00:00', '', 7, 0, 0, ''),
(12, 0, 'Contacts', 'Contacts', '', 'com_contact_details', 'left', 'Contact Details for this website', 1, 0, '0000-00-00 00:00:00', '', 0, 0, 0, ''),
(13, 0, 'default', 'default', '', 'com_google_maps', 'left', '', 1, 0, '0000-00-00 00:00:00', '', 0, 0, 0, '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_components`
--

CREATE TABLE IF NOT EXISTS `jos_components` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(50) NOT NULL default '',
  `link` varchar(255) NOT NULL default '',
  `menuid` int(11) unsigned NOT NULL default '0',
  `parent` int(11) unsigned NOT NULL default '0',
  `admin_menu_link` varchar(255) NOT NULL default '',
  `admin_menu_alt` varchar(255) NOT NULL default '',
  `option` varchar(50) NOT NULL default '',
  `ordering` int(11) NOT NULL default '0',
  `admin_menu_img` varchar(255) NOT NULL default '',
  `iscore` tinyint(4) NOT NULL default '0',
  `params` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=62 ;

--
-- Extraindo dados da tabela `jos_components`
--

INSERT INTO `jos_components` (`id`, `name`, `link`, `menuid`, `parent`, `admin_menu_link`, `admin_menu_alt`, `option`, `ordering`, `admin_menu_img`, `iscore`, `params`) VALUES
(1, 'Banners', '', 0, 0, '', 'Banner Management', 'com_banners', 0, 'js/ThemeOffice/component.png', 0, ''),
(2, 'Manage Banners', '', 0, 1, 'option=com_banners', 'Active Banners', 'com_banners', 1, 'js/ThemeOffice/edit.png', 0, ''),
(3, 'Manage Clients', '', 0, 1, 'option=com_banners&task=listclients', 'Manage Clients', 'com_banners', 2, 'js/ThemeOffice/categories.png', 0, ''),
(4, 'Web Links', 'option=com_weblinks', 0, 0, '', 'Manage Weblinks', 'com_weblinks', 0, 'js/ThemeOffice/globe2.png', 0, ''),
(5, 'Web Link Items', '', 0, 4, 'option=com_weblinks', 'View existing weblinks', 'com_weblinks', 1, 'js/ThemeOffice/edit.png', 0, ''),
(6, 'Web Link Categories', '', 0, 4, 'option=categories&section=com_weblinks', 'Manage weblink categories', '', 2, 'js/ThemeOffice/categories.png', 0, ''),
(7, 'Contacts', 'option=com_contact', 0, 0, '', 'Edit contact details', 'com_contact', 0, 'js/ThemeOffice/user.png', 1, ''),
(8, 'Manage Contacts', '', 0, 7, 'option=com_contact', 'Edit contact details', 'com_contact', 0, 'js/ThemeOffice/edit.png', 1, ''),
(9, 'Contact Categories', '', 0, 7, 'option=categories&section=com_contact_details', 'Manage contact categories', '', 2, 'js/ThemeOffice/categories.png', 1, ''),
(10, 'Front Page', 'option=com_frontpage', 0, 0, '', 'Manage Front Page Items', 'com_frontpage', 0, 'js/ThemeOffice/component.png', 1, ''),
(11, 'Polls', 'option=com_poll', 0, 0, 'option=com_poll', 'Manage Polls', 'com_poll', 0, 'js/ThemeOffice/component.png', 0, ''),
(12, 'News Feeds', 'option=com_newsfeeds', 0, 0, '', 'News Feeds Management', 'com_newsfeeds', 0, 'js/ThemeOffice/component.png', 0, ''),
(13, 'Manage News Feeds', '', 0, 12, 'option=com_newsfeeds', 'Manage News Feeds', 'com_newsfeeds', 1, 'js/ThemeOffice/edit.png', 0, ''),
(14, 'Manage Categories', '', 0, 12, 'option=com_categories&section=com_newsfeeds', 'Manage Categories', '', 2, 'js/ThemeOffice/categories.png', 0, ''),
(15, 'Login', 'option=com_login', 0, 0, '', '', 'com_login', 0, '', 1, ''),
(16, 'Search', 'option=com_search', 0, 0, '', '', 'com_search', 0, '', 1, ''),
(17, 'Syndicate', '', 0, 0, 'option=com_syndicate', 'Manage Syndication Settings', 'com_syndicate', 0, 'js/ThemeOffice/component.png', 0, 'check=1\ncache=1\ncache_time=3600\ncount=5\ntitle=Núcleo do Evento\ndescription=Núcleo do Evento RSS Feed\nimage_file=logo_header.png\nimage_alt=Núcleo do Evento\nlimit_text=1\ntext_length=20\nrss091=1\nrss10=1\nrss20=1\natom03=1\nopml=1\norderby=front\nlive_bookmark=0'),
(18, 'Mass Mail', '', 0, 0, 'option=com_massmail&hidemainmenu=1', 'Send Mass Mail', 'com_massmail', 0, 'js/ThemeOffice/mass_email.png', 0, ''),
(19, 'joomlaXplorer', 'option=com_joomlaxplorer', 0, 0, 'option=com_joomlaxplorer', 'joomlaXplorer', 'com_joomlaxplorer', 0, '../administrator/components/com_joomlaxplorer/images/joomla_x_icon.png', 0, ''),
(20, 'Joomap', 'option=com_joomap', 0, 0, 'option=com_joomap', 'Joomap', 'com_joomap', 0, 'js/ThemeOffice/component.png', 0, ''),
(32, 'Info', '', 0, 29, 'option=com_eweather&task=about', 'Info', 'com_eweather', 2, '../administrator/components/com_eweather/mn_img/info.png', 0, ''),
(31, 'Configuration', '', 0, 29, 'option=com_eweather&task=showConfig', 'Configuration', 'com_eweather', 1, '../administrator/components/com_eweather/mn_img/settings.png', 0, ''),
(29, 'eWeather', 'option=com_eweather', 0, 0, 'option=com_eweather', 'eWeather', 'com_eweather', 0, '../administrator/components/com_eweather/mn_img/eweather.png', 0, ''),
(30, 'Locations', '', 0, 29, 'option=com_eweather&task=allLocations', 'Locations', 'com_eweather', 0, '../administrator/components/com_eweather/mn_img/location.png', 0, ''),
(37, 'Google Maps', 'option=com_google_maps', 0, 0, 'option=com_google_maps', 'Google Maps', 'com_google_maps', 0, 'js/ThemeOffice/component.png', 0, ''),
(38, 'Manage Google Map Markers', '', 0, 37, 'option=com_google_maps', 'Manage Google Map Markers', 'com_google_maps', 0, 'js/ThemeOffice/component.png', 0, ''),
(39, 'Manage Google Map Categories', '', 0, 37, 'option=com_categories&section=com_google_maps', 'Manage Google Map Categories', 'com_google_maps', 1, 'js/ThemeOffice/component.png', 0, ''),
(40, 'Configuration', '', 0, 37, 'option=com_google_maps&act=configure', 'Configuration', 'com_google_maps', 2, 'js/ThemeOffice/component.png', 0, ''),
(41, 'VirtueMart', 'option=com_virtuemart', 0, 0, 'option=com_virtuemart', 'VirtueMart', 'com_virtuemart', 0, '../administrator/components/com_virtuemart/favicon.ico', 0, ''),
(42, 'virtuemart_version', '', 0, 9999, '', '', '', 0, '', 0, 'RELEASE=1.0.12\nDEV_STATUS=stable'),
(43, 'sh404SEF', 'option=com_sef', 0, 0, 'option=com_sef', 'sh404SEF', 'com_sef', 0, 'js/ThemeOffice/component.png', 0, ''),
(44, 'VisualRecommend', 'option=com_visualrecommend', 0, 0, 'option=com_visualrecommend', 'VisualRecommend', 'com_visualrecommend', 0, '../administrator/components/com_visualrecommend/images/visualrecommend_icon.png', 0, ''),
(45, 'Control Panel', '', 0, 44, 'option=com_visualrecommend&task=controlpanel', 'Control Panel', 'com_visualrecommend', 0, 'js/ThemeOffice/controlpanel.png', 0, ''),
(46, 'Configuration', '', 0, 44, 'option=com_visualrecommend&task=config', 'Configuration', 'com_visualrecommend', 1, 'js/ThemeOffice/config.png', 0, ''),
(47, 'Tracking', '', 0, 44, 'option=com_visualrecommend&task=tracking', 'Tracking', 'com_visualrecommend', 2, 'js/ThemeOffice/users.png', 0, ''),
(48, 'Statistics', '', 0, 44, 'option=com_visualrecommend&task=statstracking', 'Statistics', 'com_visualrecommend', 3, '../administrator/components/com_visualrecommend/images/statistic_icon.png', 0, ''),
(49, 'Export All mails to CSV', '', 0, 44, 'option=com_visualrecommend&task=exporttracking', 'Export All mails to CSV', 'com_visualrecommend', 4, 'js/ThemeOffice/mass_email.png', 0, ''),
(50, 'Export Reply mails to CSV', '', 0, 44, 'option=com_visualrecommend&task=exportreplytracking', 'Export Reply mails to CSV', 'com_visualrecommend', 5, 'js/ThemeOffice/mass_email.png', 0, ''),
(51, 'Purge all tracking', '', 0, 44, 'option=com_visualrecommend&task=purgealltracking', 'Purge all tracking', 'com_visualrecommend', 6, 'js/ThemeOffice/trash.png', 0, ''),
(52, 'About', '', 0, 44, 'option=com_visualrecommend&task=about', 'About', 'com_visualrecommend', 7, 'js/ThemeOffice/credits.png', 0, ''),
(53, 'Recommend', 'option=com_recommend', 0, 0, 'option=com_recommend', 'Recommend', 'com_recommend', 0, 'js/ThemeOffice/component.png', 0, ''),
(54, 'Info', '', 0, 53, 'option=com_recommend&act=sub1', 'Info', 'com_recommend', 0, 'js/ThemeOffice/component.png', 0, ''),
(59, 'utChat', 'option=com_utchat', 0, 0, 'option=com_utchat', 'utChat', 'com_utchat', 0, 'js/ThemeOffice/component.png', 0, ''),
(60, 'PU Database Admin', 'option=com_pudba', 0, 0, 'option=com_pudba', 'PU Database Admin', 'com_pudba', 0, '../administrator/components/com_pudba/images/menu.png', 0, ''),
(61, 'Mamboleto', 'option=com_mamboleto', 0, 0, 'option=com_mamboleto', 'Mamboleto', 'com_mamboleto', 0, '../administrator/components/com_mamboleto/imagens/menu_icon.png', 0, '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_contact_details`
--

CREATE TABLE IF NOT EXISTS `jos_contact_details` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(100) NOT NULL default '',
  `con_position` varchar(50) default NULL,
  `address` text,
  `suburb` varchar(50) default NULL,
  `state` varchar(20) default NULL,
  `country` varchar(50) default NULL,
  `postcode` varchar(10) default NULL,
  `telephone` varchar(25) default NULL,
  `fax` varchar(25) default NULL,
  `misc` mediumtext,
  `image` varchar(100) default NULL,
  `imagepos` varchar(20) default NULL,
  `email_to` varchar(100) default NULL,
  `default_con` tinyint(1) unsigned NOT NULL default '0',
  `published` tinyint(1) unsigned NOT NULL default '0',
  `checked_out` int(11) unsigned NOT NULL default '0',
  `checked_out_time` datetime NOT NULL default '0000-00-00 00:00:00',
  `ordering` int(11) NOT NULL default '0',
  `params` text NOT NULL,
  `user_id` int(11) NOT NULL default '0',
  `catid` int(11) NOT NULL default '0',
  `access` tinyint(3) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Extraindo dados da tabela `jos_contact_details`
--

INSERT INTO `jos_contact_details` (`id`, `name`, `con_position`, `address`, `suburb`, `state`, `country`, `postcode`, `telephone`, `fax`, `misc`, `image`, `imagepos`, `email_to`, `default_con`, `published`, `checked_out`, `checked_out_time`, `ordering`, `params`, `user_id`, `catid`, `access`) VALUES
(1, 'Wander Von Muller', 'Fotógrafo e Administrador', 'Rua Santo Agostinho, 96', 'Joinville', 'Santa Catarina', 'Brasil', '89207-650', '55 (47) 3465-2943', '55 (47) 9126-0414', '', 'wander.png', 'top', 'wandervonmuller@vonmuller.com', 0, 1, 0, '0000-00-00 00:00:00', 2, 'menu_image=-1\npageclass_sfx=\nprint=\nback_button=\nname=1\nposition=1\nemail=0\nstreet_address=1\nsuburb=1\nstate=1\ncountry=1\npostcode=1\ntelephone=1\nfax=1\nmisc=1\nimage=1\nvcard=0\nemail_description=1\nemail_description_text=\nemail_form=1\nemail_copy=0\ndrop_down=0\ncontact_icons=0\nicon_address=\nicon_email=\nicon_telephone=\nicon_fax=\nicon_misc=\nrobots=-1\nmeta_description=\nmeta_keywords=\nmeta_author=', 64, 12, 0),
(2, 'Leonardo Lima de Vasconcellos', 'WebMaster - Analista de Sistemas', 'Rua Santo Agostinho, 96', 'Joinville', 'Santa Catarina', 'Brasil', '89207-650', '55 (47) 3465-2943', '', '', '', '', 'leonardo.vasconcellos@gmail.com', 0, 0, 0, '0000-00-00 00:00:00', 1, 'menu_image=-1\npageclass_sfx=\nprint=\nback_button=\nname=1\nposition=1\nemail=0\nstreet_address=1\nsuburb=1\nstate=1\ncountry=1\npostcode=1\ntelephone=1\nfax=1\nmisc=1\nimage=1\nvcard=0\nemail_description=1\nemail_description_text=\nemail_form=1\nemail_copy=0\ndrop_down=0\ncontact_icons=0\nicon_address=\nicon_email=\nicon_telephone=\nicon_fax=\nicon_misc=\nrobots=-1\nmeta_description=\nmeta_keywords=\nmeta_author=', 63, 12, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_content`
--

CREATE TABLE IF NOT EXISTS `jos_content` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `title` varchar(100) NOT NULL default '',
  `title_alias` varchar(100) NOT NULL default '',
  `introtext` mediumtext NOT NULL,
  `fulltext` mediumtext NOT NULL,
  `state` tinyint(3) NOT NULL default '0',
  `sectionid` int(11) unsigned NOT NULL default '0',
  `mask` int(11) unsigned NOT NULL default '0',
  `catid` int(11) unsigned NOT NULL default '0',
  `created` datetime NOT NULL default '0000-00-00 00:00:00',
  `created_by` int(11) unsigned NOT NULL default '0',
  `created_by_alias` varchar(100) NOT NULL default '',
  `modified` datetime NOT NULL default '0000-00-00 00:00:00',
  `modified_by` int(11) unsigned NOT NULL default '0',
  `checked_out` int(11) unsigned NOT NULL default '0',
  `checked_out_time` datetime NOT NULL default '0000-00-00 00:00:00',
  `publish_up` datetime NOT NULL default '0000-00-00 00:00:00',
  `publish_down` datetime NOT NULL default '0000-00-00 00:00:00',
  `images` text NOT NULL,
  `urls` text NOT NULL,
  `attribs` text NOT NULL,
  `version` int(11) unsigned NOT NULL default '1',
  `parentid` int(11) unsigned NOT NULL default '0',
  `ordering` int(11) NOT NULL default '0',
  `metakey` text NOT NULL,
  `metadesc` text NOT NULL,
  `access` int(11) unsigned NOT NULL default '0',
  `hits` int(11) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `idx_section` (`sectionid`),
  KEY `idx_access` (`access`),
  KEY `idx_checkout` (`checked_out`),
  KEY `idx_state` (`state`),
  KEY `idx_catid` (`catid`),
  KEY `idx_mask` (`mask`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Extraindo dados da tabela `jos_content`
--

INSERT INTO `jos_content` (`id`, `title`, `title_alias`, `introtext`, `fulltext`, `state`, `sectionid`, `mask`, `catid`, `created`, `created_by`, `created_by_alias`, `modified`, `modified_by`, `checked_out`, `checked_out_time`, `publish_up`, `publish_down`, `images`, `urls`, `attribs`, `version`, `parentid`, `ordering`, `metakey`, `metadesc`, `access`, `hits`) VALUES
(1, 'Núcleo do Evento!', 'Bem Vindo!', '<p>A FAGGA oferece um conjunto completo de servi&ccedil;os para planejamento, cria&ccedil;&atilde;o, produ&ccedil;&atilde;o, administra&ccedil;&atilde;o e log&iacute;stica de eventos. Desde uma reuni&atilde;o executiva para 5 participantes at&eacute; grandes feiras setoriais que atingem a visita&ccedil;&atilde;o de mais de 500.000 pessoas. <br /><br />Em seus escrit&oacute;rios no Rio de Janeiro, S&atilde;o Paulo e Salvador, profissionais especializados em diferentes &aacute;reas, como marketing e comunica&ccedil;&atilde;o; viagens e turismo; arquitetura promocional; design e comunica&ccedil;&atilde;o visual; internet e inform&aacute;tica, s&atilde;o envolvidos em cada etapa do projeto, garantindo assim o sucesso total nas iniciativas de nossos clientes.<br /><br />Associada &agrave; GL events desde 2006, a FAGGA &eacute; hoje a mais completa empresa brasileira do setor, somando &agrave; sua reconhecida qualidade de atendimento e planejamento a experi&ecirc;ncia, o conhecimento e as melhores solu&ccedil;&otilde;es e pr&aacute;ticas adotadas internacionalmente por uma conceituada parceira.<br /><br /><br />Grupo GL events<br /><br />Com sede em Lyon, na Fran&ccedil;a, o Grupo GL events &eacute; considerado um dos maiores conglomerados mundiais no competitivo segmento de eventos e exposi&ccedil;&otilde;es, atuando em organiza&ccedil;&atilde;o de feiras, congressos e conven&ccedil;&otilde;es, gest&atilde;o de centros de conven&ccedil;&otilde;es e sal&otilde;es de exposi&ccedil;&atilde;o, al&eacute;m de grandes eventos corporativos, atrav&eacute;s de sua associada, Market Place.<br /><br />O Grupo GL events conta com 2.600 empregados diretos e administra 66 opera&ccedil;&otilde;es e neg&oacute;cios, como a gest&atilde;o de 16 centros de conven&ccedil;&otilde;es e exposi&ccedil;&otilde;es em 13 diferentes pa&iacute;ses, entre eles, o Brasil.</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>', '<h4><font color="#ff6600">Joomla! features:</font></h4><ul><li>Completely database driven site engines </li><li>News, products or services sections fully editable and manageable</li><li>Topics sections can be added to by contributing authors </li><li>Fully customisable layouts including left, center and right menu boxes </li><li>Browser upload of images to your own library for use anywhere in the site </li><li>Dynamic Forum/Poll/Voting booth for on-the-spot results </li><li>Runs on Linux, FreeBSD, MacOSX server, Solaris and AIX </li></ul><h4>Extensive Administration:</h4><ul><li>Change order of objects including news, FAQs, articles etc. </li><li>Random Newsflash generator </li><li>Remote author submission module for News, Articles, FAQs and Links </li><li>Object hierarchy - as many sections, departments, divisions and pages as you want </li><li>Image library - store all your PNGs, PDFs, DOCs, XLSs, GIFs and JPEGs online for easy use </li><li>Automatic Path-Finder. Place a picture and let Joomla! fix the link </li><li>News feed manager. Choose from over 360 news feeds from around the world </li><li>Archive manager. Put your old articles into cold storage rather than throw them out </li><li>Email-a-friend and Print-format for every story and article </li><li>In-line Text editor similar to Word Pad </li><li>User editable look and feel </li><li>Polls/Surveys - Now put a different one on each page </li><li>Custom Page Modules. Download custom page modules to spice up your site </li><li>Template Manager. Download templates and implement them in seconds </li><li>Layout preview. See how it looks before going live </li><li>Banner manager. Make money out of your site</li></ul>', 1, 1, 0, 1, '2004-06-12 11:54:06', 62, 'Web Master', '2007-07-27 16:14:36', 62, 0, '0000-00-00 00:00:00', '2004-01-01 00:00:00', '0000-00-00 00:00:00', 'asterisk.png|left|Joomla! Logo|1|Example Caption|bottom|center|120', '', 'pageclass_sfx=\nback_button=\nitem_title=1\nlink_titles=\nintrotext=1\nsection=0\nsection_link=0\ncategory=0\ncategory_link=0\nrating=\nauthor=\ncreatedate=\nmodifydate=\npdf=\nprint=\nemail=\nkeyref=\ndocbook_type=\nrobots=-1', 14, 0, 1, '', '', 0, 20),
(2, 'Lembrancinhas', '', 'As lembran&ccedil;inhas de casamento s&atilde;o uma das maneiras de agradecer a presen&ccedil;a dos convidados...', 'Cada vez mais os casamentos s&atilde;o elaborados e glamorosos. A apresenta&ccedil;&atilde;o e a embalagem das lembran&ccedil;as de casamento devem ter um &ecirc;nfase &uacute;nica e apelativa. &Agrave;s vezes a maneira como uma lembrancinha de casamento &eacute; apresentada d&aacute; ao casamento um ar memor&aacute;vel.<img src="images/stories/Image/lemb.jpg" alt="Lembrancinhas" title="Lembrancinhas de Casamento" width="270" height="400" align="right" /><br /><br />N&atilde;o se esque&ccedil;am que as lembran&ccedil;inhas de casamento s&atilde;o uma das maneiras de agradecer a presen&ccedil;a dos convidados. Os brindes ou lembran&ccedil;as de casamento podem ser decorativos, complementando a decora&ccedil;&atilde;o das mesas da recep&ccedil;&atilde;o, ou o pr&oacute;prio ambiente da festa. Tal como o resto da decora&ccedil;&atilde;o do casamento, os brindes devem refletir a formalidade do casamento, e a personalidade do casal.<br /><br />Usem uma embalagem de bom gosto, n&atilde;o ofere&ccedil;am as lembran&ccedil;as avulsas. Uma pequena caixa, ou saquinho de papel com um la&ccedil;o, oferece um embrulho de bom gosto para qualquer brinde. Se os convidados notarem que existiu um esfor&ccedil;o da vossa parte para agradar, isso ser&aacute; um gesto mais importante que o brinde dentro do embrulho. <br />&Eacute; de grande import&acirc;ncia que as cores das embalagens das lembran&ccedil;as estejam de acordo com a palete de cores do casamento, com as mesas, com as flores, etc. Podem colocar fitas com cores a condizer nas lembran&ccedil;as. <br />Coloquem uma mensagem personalizada em cada lembran&ccedil;a, nem que seja sobre a funcionalidade da pr&oacute;pria lembran&ccedil;a, pode ser uma frase que faz sentido para voc&ecirc;s, um pequeno poema, etc... No caso de oferecerem doces podem sempre escrever algo como: &quot;2 doces para cada um, para que n&atilde;o esque&ccedil;am que a vida tamb&eacute;m &eacute; doce...&quot; <br />Mandar gravar as iniciais, usar uma fita personalizada, ou usar a data de casamento impressa, ou at&eacute; uma mensagem pessoal, tamb&eacute;m far&atilde;o as lembran&ccedil;as mais personalizadas. Tudo isto pode ser escrito &agrave; m&atilde;o para dar um toque pessoal, mas s&oacute; no caso de a caligrafia ser realmente bonita, sen&atilde;o mais vale optarem por contratar um cal&iacute;grafo profissional para o fazer. Outra op&ccedil;&atilde;o poder&aacute; ser a impress&atilde;o a laser, muito menos dispendiosa e tamb&eacute;m com resultados muito interessantes. <br />Aliem alguma funcionalidade aos brindes de casamento, usem-nos como cart&otilde;es indicativos para os convidados, por exemplo: na mesa &agrave; entrada da recep&ccedil;&atilde;o, coloquem um pequeno cart&atilde;o em cada brinde com o nome do convidado e n&uacute;mero correspondente da mesa da recep&ccedil;&atilde;o.<img src="images/stories/Image/lemb2.jpg" alt="Lembrancinhas" title="Lembrancinhas de Casamento" width="400" height="262" align="right" /><br />Podem tamb&eacute;m fazer voc&ecirc;s mesmos um pequeno cart&atilde;o para prender nas lembrancinhas; colocando um monograma com as iniciais, a data do casamento, etc., enfim a criatividade aqui &eacute; um fator a dar asas. <br />A Lenda do Bem Casado:<br />O Bem Casado representa duas partes que se unem e s&atilde;o seladas pela cumplicidade e respeito m&uacute;tuo. Para que se tenha muita sorte, na uni&atilde;o, dever&aacute; ser distribu&iacute;do um Bem Casado a cada convidado. Diz a lenda, que todo aquele que saborear um Bem Casado, estar&aacute; sendo aben&ccedil;oado com a mesma sorte e felicidade de quem oferece. Basta fazer um pedido, antes de dar a primeira mordida...', 1, 2, 0, 3, '2004-08-09 08:30:34', 62, '', '2007-06-27 14:55:40', 62, 0, '0000-00-00 00:00:00', '2004-08-09 00:00:00', '0000-00-00 00:00:00', '', '', 'pageclass_sfx=\nback_button=\nitem_title=1\nlink_titles=\nintrotext=1\nsection=0\nsection_link=0\ncategory=0\ncategory_link=0\nrating=\nauthor=\ncreatedate=\nmodifydate=\npdf=\nprint=\nemail=\nkeyref=\ndocbook_type=\nrobots=-1', 5, 0, 1, '', '', 0, 27),
(3, '12 Dicas para o dia perfeito', '12 Dicas para o dia perfeito', 'Um casamento por muito stressante que possa ser, especialmente na sua prepara&ccedil;&atilde;o, n&atilde;o deve jamais ser uma fonte de mau estar ou de exaust&atilde;o. No dia do seu casamento, altura em que &eacute; suposto ficar o mais radiante poss&iacute;vel, n&atilde;o deve parecer cansada ou esgotada...', 'Um casamento por muito stressante que possa ser, especialmente na sua prepara&ccedil;&atilde;o, n&atilde;o deve jamais ser uma fonte de mau estar ou de exaust&atilde;o. No dia do seu casamento, altura em que &eacute; suposto ficar o mais radiante poss&iacute;vel, n&atilde;o deve parecer cansada ou esgotada... afinal planeou tudo para que este dia fosse uma harmonia de felicidade. <br /><br />1. Planeje tudo com anteced&ecirc;ncia. Fa&ccedil;a as anota&ccedil;&otilde;es antecipadamente, e um plano com hor&aacute;rio quer para o dia, quer para os dias que antecedem o casamento. <br /><br />2. Marque uma massagem para a manh&atilde; do dia do seu casamento para come&ccedil;ar esse dia relaxada. <img src="images/stories/Image/Banho.jpg" alt="Banho Relaxante" title="Banho Relaxante" width="199" height="140" align="right" /><br /><br />3. Marque uma pedicura e manicura, de prefer&ecirc;ncia tudo no mesmo local para n&atilde;o andar a correr de um lado para o outro. Lembre-se que podem surgir contratempos tal como o tr&acirc;nsito, podendo atrasar-se. <br /><br />4. Marque tamb&eacute;m o cabeleireiro bem como a maquiagem no mesmo local, pelas mesmas raz&otilde;es antes referidas. Se puder fazer TUDO no mesmo local, excelente! <br /><br />5. Antes do dia do casamento, cerca de duas semanas antes, fa&ccedil;a um teste de maquiagem para verificar poss&iacute;veis alergias a produtos e tire uma fotografia para que no dia do casamento a maquiadora volte a refaze-la fielmente. Observe a maquiagem &agrave; luz que vai estar exposta no dia do casamento, e tire a(s) fotografia(s) nessas condi&ccedil;&otilde;es.<br /><br />6. No cabeleireiro, antes do dia do casamento fa&ccedil;a o mesmo com o penteado, tire fotografias, ponha o v&eacute;u ou outros acess&oacute;rios que pretenda usar, tire uma foto, ou v&aacute;rias e veja como fica na fotografia, &eacute; assim que vai aparecer nas suas fotos de casamento. N&atilde;o se esque&ccedil;a de verificar se &eacute; o que deseja, isto aplica-se quer ao vestido, quer as cores da recep&ccedil;&atilde;o e a maquiagem.<br /><br />7. Fa&ccedil;a tratamentos faciais, depila&ccedil;&atilde;o, no m&iacute;nimo duas semanas antes do dia do casamento. Lembre-se que a pele pode ficar com irrita&ccedil;&atilde;o... este tempo &eacute; o m&iacute;nimo necess&aacute;rio para curar o sucedido.<br /><br />8. Fa&ccedil;a um corte de cabelo pelo menos duas semanas antes do casamento. Vai dar tempo ao cabelo para ficar mais natural, ou mesmo se fizer uma colora&ccedil;&atilde;o caso n&atilde;o goste ainda estar&aacute; a tempo de mudar.<br /><br />9. Se vai usar o cabelo preso no casamento, lave o cabelo na noite anterior e n&atilde;o no pr&oacute;prio dia, pois assim o cabelo &eacute; mais f&aacute;cil de prender e de trabalhar. Caso use v&eacute;u ou chap&eacute;u no cabelo e pretenda remove-los depois da cerim&oacute;nia, pe&ccedil;a ao cabeleireiro para estar presente nesse momento para a ajudar a remover com cuidado, e dar uns retoques caso seja necess&aacute;rio. &nbsp;<br /><br />10. Se o casamento vai ser no Ver&atilde;o ou num local com muito sol, n&atilde;o se esque&ccedil;a de aplicar protetor solar por baixo da maquiagem e nos locais do seu corpo que v&atilde;o estar expostos ao sol.<br /><br />11. Caso a cerim&ocirc;nia dure at&eacute; &agrave; noite, pe&ccedil;a &agrave; maquiadora para no fim da tarde retocar a maquiagem, pois &agrave; noite esta deve sempre ser um pouco mais forte e carregada, para as fotografias, e para o pr&oacute;prio ambiente.<br /><br />12. N&atilde;o v&aacute; pegar sol antes do dia do casamento, pois ficar com a pele toda manchada ou com um escald&atilde;o n&atilde;o &eacute; nada agrad&aacute;vel em altura alguma, muito menos no dia do seu casamento!<br />', 1, 2, 0, 3, '2004-08-09 08:30:34', 62, '', '2007-06-27 15:05:30', 62, 0, '0000-00-00 00:00:00', '2004-08-09 00:00:00', '0000-00-00 00:00:00', '', '', 'pageclass_sfx=\nback_button=\nitem_title=1\nlink_titles=\nintrotext=1\nsection=0\nsection_link=0\ncategory=0\ncategory_link=0\nrating=\nauthor=\ncreatedate=\nmodifydate=\npdf=\nprint=\nemail=\nkeyref=\ndocbook_type=\nrobots=-1', 2, 0, 2, '', '', 0, 28),
(4, 'Newsflash 3', '', 'Aoccdrnig to a rscheearch at an Elingsh uinervtisy, it deosn''t mttaer in waht oredr the ltteers in a wrod are, the olny iprmoetnt tihng is taht frist and lsat ltteer is at the rghit pclae. The rset can be a toatl mses and you can sitll raed it wouthit porbelm. Tihs is bcuseae we do not raed ervey lteter by itslef but the wrod as a wlohe.', '', -2, 2, 1, 3, '2004-08-09 08:30:34', 62, '', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', '2004-08-09 00:00:00', '0000-00-00 00:00:00', '', '', '', 1, 0, 0, '', '', 0, 19),
(6, 'Example News Item 1', 'News1', '{mosimage}Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat,\r\nsed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit\r\namet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam\r\nvoluptua. At vero eos et accusam et justo duo dolores et ea rebum.', '<p>{mosimage}Duis autem vel eum iriure dolor in hendrerit in vulputate\r\nvelit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at\r\nvero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum\r\nzzril delenit augue duis dolore te feugait nulla facilisi. Lorem ipsum dolor\r\nsit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt\r\nut laoreet dolore magna aliquam erat volutpat.</p>\r\n\r\n<p>Ut wisi enim ad minim veniam, quis nostrud exerci tation\r\nullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis\r\nautem vel eum iriure dolor in hendrerit in vulputate velit esse molestie\r\nconsequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan\r\net iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis\r\ndolore te feugait nulla facilisi.</p>\r\n\r\n<p>Nam liber tempor cum soluta nobis eleifend option congue\r\nnihil imperdiet doming id quod mazim placerat facer possim assum. Lorem ipsum\r\ndolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod\r\ntincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim\r\nveniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut\r\naliquip ex ea commodo consequat.</p>\r\n\r\n<p>Duis autem vel eum iriure dolor in hendrerit in vulputate\r\nvelit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis. At\r\nvero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd\r\ngubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum\r\ndolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor\r\ninvidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero\r\neos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no\r\nsea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit\r\namet, consetetur sadipscing elitr, At accusam aliquyam diam diam dolore dolores\r\nduo eirmod eos erat, et nonumy sed tempor et et invidunt justo labore Stet\r\nclita ea et gubergren, kasd magna no rebum. sanctus sea sed takimata ut vero\r\nvoluptua. est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet,\r\nconsetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore\r\net dolore magna aliquyam erat.</p>\r\n\r\n<p>Consetetur sadipscing elitr, sed diam nonumy eirmod tempor\r\ninvidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero\r\neos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no\r\nsea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit\r\namet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut\r\nlabore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam\r\net justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata\r\nsanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur\r\nsadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore\r\nmagna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo\r\ndolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est\r\nLorem ipsum dolor sit amet.</p>', -2, 1, 0, 1, '2004-07-07 11:54:06', 62, '', '2004-07-07 18:05:05', 62, 0, '0000-00-00 00:00:00', '2004-07-07 00:00:00', '0000-00-00 00:00:00', 'food/coffee.jpg|left||0\r\nfood/bread.jpg|right||0', '', '', 1, 0, 0, '', '', 0, 12),
(7, 'Example News Item 2', 'News2', '<p>{mosimage}Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat,\r\nsed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit\r\namet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam\r\nvoluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem\r\nipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At\r\nvero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.</p>', '', -2, 1, 0, 1, '2004-07-07 11:54:06', 62, '', '2004-07-07 18:11:30', 62, 0, '0000-00-00 00:00:00', '2004-07-07 00:00:00', '0000-00-00 00:00:00', 'food/bun.jpg|right||0', '', '', 1, 0, 0, '', '', 0, 11),
(8, 'Example News Item 3', 'News3', '<p>{mosimage}Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat,\r\nsed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit\r\namet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam\r\nvoluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem\r\nipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At\r\nvero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.</p>', '', -2, 1, 0, 1, '2004-04-12 11:54:06', 62, '', '2004-07-07 18:08:23', 62, 0, '0000-00-00 00:00:00', '2004-07-07 00:00:00', '0000-00-00 00:00:00', 'fruit/pears.jpg|right||0', '', '', 1, 0, 0, '', '', 0, 4),
(9, 'Example News Item 4', 'News4', '<p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat,\r\nsed diam voluptua. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam\r\nvoluptua. At\r\nvero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.</p>', '<p>{mosimage}Duis autem vel eum iriure dolor in hendrerit in vulputate\r\nvelit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at\r\nvero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum\r\nzzril delenit augue duis dolore te feugait nulla facilisi. Lorem ipsum dolor\r\nsit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt\r\nut laoreet dolore magna aliquam erat volutpat.</p>\r\n\r\n{mospagebreak}<p>{mosimage}Ut wisi enim ad minim veniam, quis nostrud exerci tation\r\nullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis\r\nautem vel eum iriure dolor in hendrerit in vulputate velit esse molestie\r\nconsequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan\r\net iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis\r\ndolore te feugait nulla facilisi.</p>\r\n\r\n<p>{mosimage}Nam liber tempor cum soluta nobis eleifend option congue\r\nnihil imperdiet doming id quod mazim placerat facer possim assum. Lorem ipsum\r\ndolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod\r\ntincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim\r\nveniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut\r\naliquip ex ea commodo consequat.</p>\r\n\r\n<p>Duis autem vel eum iriure dolor in hendrerit in vulputate\r\nvelit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis. At\r\nvero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd\r\ngubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum\r\ndolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor\r\ninvidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero\r\neos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no\r\nsea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit\r\namet, consetetur sadipscing elitr, At accusam aliquyam diam diam dolore dolores\r\nduo eirmod eos erat, et nonumy sed tempor et et invidunt justo labore Stet\r\nclita ea et gubergren, kasd magna no rebum. sanctus sea sed takimata ut vero\r\nvoluptua. est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet,\r\nconsetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore\r\net dolore magna aliquyam erat.</p>\r\n\r\n{mospagebreak}<p>Consetetur sadipscing elitr, sed diam nonumy eirmod tempor\r\ninvidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero\r\neos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no\r\nsea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit\r\namet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut\r\nlabore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam\r\net justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata\r\nsanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur\r\nsadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore\r\nmagna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo\r\ndolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est\r\nLorem ipsum dolor sit amet.</p>', -2, 1, 0, 1, '2004-07-07 11:54:06', 62, '', '2004-07-07 18:10:23', 62, 0, '0000-00-00 00:00:00', '2004-07-07 00:00:00', '0000-00-00 00:00:00', 'fruit/strawberry.jpg|left||0\r\nfruit/pears.jpg|right||0\r\nfruit/cherry.jpg|left||0', '', '', 1, 0, 0, '', '', 0, 18),
(10, 'Example FAQ Item 1', 'FAQ1', '<p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat,\r\nsed diam voluptua. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam\r\nvoluptua. At\r\nvero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.</p>', '', -2, 3, 0, 7, '2004-05-12 11:54:06', 62, '', '2004-07-07 18:10:23', 62, 0, '0000-00-00 00:00:00', '2004-01-01 00:00:00', '0000-00-00 00:00:00', '', '', '', 1, 0, 0, '', '', 0, 11),
(11, 'Example FAQ Item 2', 'FAQ2', '<p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat,\r\nsed diam voluptua. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam\r\nvoluptua. At\r\nvero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.</p>', '<p>{mosimage}Duis autem vel eum iriure dolor in hendrerit in vulputate\r\nvelit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at\r\nvero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum\r\nzzril delenit augue duis dolore te feugait nulla facilisi. Lorem ipsum dolor\r\nsit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt\r\nut laoreet dolore magna aliquam erat volutpat.</p>\r\n\r\n<p>{mosimage}Ut wisi enim ad minim veniam, quis nostrud exerci tation\r\nullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis\r\nautem vel eum iriure dolor in hendrerit in vulputate velit esse molestie\r\nconsequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan\r\net iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis\r\ndolore te feugait nulla facilisi.</p>\r\n\r\n<p>{mosimage}Nam liber tempor cum soluta nobis eleifend option congue\r\nnihil imperdiet doming id quod mazim placerat facer possim assum. Lorem ipsum\r\ndolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod\r\ntincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim\r\nveniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut\r\naliquip ex ea commodo consequat.</p>\r\n\r\n<p>Duis autem vel eum iriure dolor in hendrerit in vulputate\r\nvelit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis. At\r\nvero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd\r\ngubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum\r\ndolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor\r\ninvidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero\r\neos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no\r\nsea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit\r\namet, consetetur sadipscing elitr, At accusam aliquyam diam diam dolore dolores\r\nduo eirmod eos erat, et nonumy sed tempor et et invidunt justo labore Stet\r\nclita ea et gubergren, kasd magna no rebum. sanctus sea sed takimata ut vero\r\nvoluptua. est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet,\r\nconsetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore\r\net dolore magna aliquyam erat.</p>\r\n\r\n<p>Consetetur sadipscing elitr, sed diam nonumy eirmod tempor\r\ninvidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero\r\neos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no\r\nsea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit\r\namet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut\r\nlabore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam\r\net justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata\r\nsanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur\r\nsadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore\r\nmagna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo\r\ndolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est\r\nLorem ipsum dolor sit amet.</p>', -2, 3, 0, 7, '2004-05-12 11:54:06', 62, 'Web master', '2004-07-07 18:10:23', 62, 0, '0000-00-00 00:00:00', '2004-01-01 00:00:00', '0000-00-00 00:00:00', 'fruit/cherry.jpg|left||0\r\nfruit/peas.jpg|right||0\r\nfood/milk.jpg|left||0', '', '', 1, 0, 0, '', '', 0, 16),
(12, '404', '404', '<h1>404: Not Found</h1><h4>Sorry, but the content you requested could not be found</h4>', '', 1, 0, 0, 0, '2004-11-11 12:44:38', 62, '', '2007-07-25 17:55:38', 0, 0, '0000-00-00 00:00:00', '2004-10-17 00:00:00', '0000-00-00 00:00:00', '', '', 'menu_image=-1\nitem_title=0\npageclass_sfx=\nback_button=\nrating=0\nauthor=0\ncreatedate=0\nmodifydate=0\npdf=0\nprint=0\nemail=0', 1, 0, 0, '', '', 0, 779);

-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_content_frontpage`
--

CREATE TABLE IF NOT EXISTS `jos_content_frontpage` (
  `content_id` int(11) NOT NULL default '0',
  `ordering` int(11) NOT NULL default '0',
  PRIMARY KEY  (`content_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `jos_content_frontpage`
--

INSERT INTO `jos_content_frontpage` (`content_id`, `ordering`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4);

-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_content_rating`
--

CREATE TABLE IF NOT EXISTS `jos_content_rating` (
  `content_id` int(11) NOT NULL default '0',
  `rating_sum` int(11) unsigned NOT NULL default '0',
  `rating_count` int(11) unsigned NOT NULL default '0',
  `lastip` varchar(50) NOT NULL default '',
  PRIMARY KEY  (`content_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `jos_content_rating`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_core_acl_aro`
--

CREATE TABLE IF NOT EXISTS `jos_core_acl_aro` (
  `aro_id` int(11) NOT NULL auto_increment,
  `section_value` varchar(240) NOT NULL default '0',
  `value` varchar(240) NOT NULL default '',
  `order_value` int(11) NOT NULL default '0',
  `name` varchar(255) NOT NULL default '',
  `hidden` int(11) NOT NULL default '0',
  PRIMARY KEY  (`aro_id`),
  UNIQUE KEY `jos_gacl_section_value_value_aro` (`section_value`(100),`value`(100)),
  KEY `jos_gacl_hidden_aro` (`hidden`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Extraindo dados da tabela `jos_core_acl_aro`
--

INSERT INTO `jos_core_acl_aro` (`aro_id`, `section_value`, `value`, `order_value`, `name`, `hidden`) VALUES
(10, 'users', '62', 0, 'administrador', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_core_acl_aro_groups`
--

CREATE TABLE IF NOT EXISTS `jos_core_acl_aro_groups` (
  `group_id` int(11) NOT NULL auto_increment,
  `parent_id` int(11) NOT NULL default '0',
  `name` varchar(255) NOT NULL default '',
  `lft` int(11) NOT NULL default '0',
  `rgt` int(11) NOT NULL default '0',
  PRIMARY KEY  (`group_id`),
  KEY `parent_id_aro_groups` (`parent_id`),
  KEY `jos_gacl_parent_id_aro_groups` (`parent_id`),
  KEY `jos_gacl_lft_rgt_aro_groups` (`lft`,`rgt`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=31 ;

--
-- Extraindo dados da tabela `jos_core_acl_aro_groups`
--

INSERT INTO `jos_core_acl_aro_groups` (`group_id`, `parent_id`, `name`, `lft`, `rgt`) VALUES
(17, 0, 'ROOT', 1, 22),
(28, 17, 'USERS', 2, 21),
(29, 28, 'Public Frontend', 3, 12),
(18, 29, 'Registered', 4, 11),
(19, 18, 'Author', 5, 10),
(20, 19, 'Editor', 6, 9),
(21, 20, 'Publisher', 7, 8),
(30, 28, 'Public Backend', 13, 20),
(23, 30, 'Manager', 14, 19),
(24, 23, 'Administrator', 15, 18),
(25, 24, 'Super Administrator', 16, 17);

-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_core_acl_aro_sections`
--

CREATE TABLE IF NOT EXISTS `jos_core_acl_aro_sections` (
  `section_id` int(11) NOT NULL auto_increment,
  `value` varchar(230) NOT NULL default '',
  `order_value` int(11) NOT NULL default '0',
  `name` varchar(230) NOT NULL default '',
  `hidden` int(11) NOT NULL default '0',
  PRIMARY KEY  (`section_id`),
  UNIQUE KEY `value_aro_sections` (`value`),
  UNIQUE KEY `jos_gacl_value_aro_sections` (`value`),
  KEY `hidden_aro_sections` (`hidden`),
  KEY `jos_gacl_hidden_aro_sections` (`hidden`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Extraindo dados da tabela `jos_core_acl_aro_sections`
--

INSERT INTO `jos_core_acl_aro_sections` (`section_id`, `value`, `order_value`, `name`, `hidden`) VALUES
(10, 'users', 1, 'Users', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_core_acl_groups_aro_map`
--

CREATE TABLE IF NOT EXISTS `jos_core_acl_groups_aro_map` (
  `group_id` int(11) NOT NULL default '0',
  `section_value` varchar(240) NOT NULL default '',
  `aro_id` int(11) NOT NULL default '0',
  UNIQUE KEY `group_id_aro_id_groups_aro_map` (`group_id`,`section_value`,`aro_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `jos_core_acl_groups_aro_map`
--

INSERT INTO `jos_core_acl_groups_aro_map` (`group_id`, `section_value`, `aro_id`) VALUES
(25, '', 10);

-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_core_log_items`
--

CREATE TABLE IF NOT EXISTS `jos_core_log_items` (
  `time_stamp` date NOT NULL default '0000-00-00',
  `item_table` varchar(50) NOT NULL default '',
  `item_id` int(11) unsigned NOT NULL default '0',
  `hits` int(11) unsigned NOT NULL default '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `jos_core_log_items`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_core_log_searches`
--

CREATE TABLE IF NOT EXISTS `jos_core_log_searches` (
  `search_term` varchar(128) NOT NULL default '',
  `hits` int(11) unsigned NOT NULL default '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `jos_core_log_searches`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_eweather_cache`
--

CREATE TABLE IF NOT EXISTS `jos_eweather_cache` (
  `id` mediumint(9) NOT NULL auto_increment,
  `lastupdate` int(11) default NULL,
  `locid` varchar(15) NOT NULL default '',
  `feed` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 PACK_KEYS=0 AUTO_INCREMENT=2 ;

--
-- Extraindo dados da tabela `jos_eweather_cache`
--

INSERT INTO `jos_eweather_cache` (`id`, `lastupdate`, `locid`, `feed`) VALUES
(1, 1186430611, 'BRXX0130', '<?xml version="1.0" encoding="ISO-8859-1"?><!--This document is intended only for use by authorized licensees of The Weather Channel. Unauthorized use is prohibited. Copyright 1995-2005, The Weather Channel Interactive, Inc. All Rights Reserved.--><weather ver="2.0"><head><locale>en_US</locale><form>MEDIUM</form><ut>C</ut><ud>km</ud><us>km/h</us><up>mb</up><ur>mm</ur></head><loc id="BRXX0130"><dnam>Joinville, Brazil</dnam><tm>5:03 PM</tm><lat>-26.30</lat><lon>-48.85</lon><sunr>6:52 AM</sunr><suns>5:51 PM</suns><zone>-3</zone></loc><cc><lsup>8/6/07 5:00 PM Local Time</lsup><obst>Curitiba, Brazil</obst><tmp>19</tmp><flik>19</flik><t>Mostly Cloudy</t><icon>28</icon><bar><r>1019.0</r><d>steady</d></bar><wind><s>11</s><gust>N/A</gust><d>50</d><t>NE</t></wind><hmid>73</hmid><vis>10.0</vis><uv><i>0</i><t>Low</t></uv><dewp>14</dewp><moon><icon>23</icon><t>Waning Crescent</t></moon></cc><dayf><lsup>8/6/07 2:31 PM Local Time</lsup><day d="0" t="Monday" dt="Aug 6"><hi>N/A</hi><low>16</low><sunr>6:52 AM</sunr><suns>5:51 PM</suns><part p="d"><icon>44</icon><t>N/A</t><wind><s>N/A</s><gust>N/A</gust><d>N/A</d><t>N/A</t></wind><bt>N/A</bt><ppcp>0</ppcp><hmid>N/A</hmid></part><part p="n"><icon>26</icon><t>Cloudy</t><wind><s>8</s><gust>N/A</gust><d>8</d><t>N</t></wind><bt>Cloudy</bt><ppcp>0</ppcp><hmid>98</hmid></part></day><day d="1" t="Tuesday" dt="Aug 7"><hi>24</hi><low>16</low><sunr>6:51 AM</sunr><suns>5:52 PM</suns><part p="d"><icon>26</icon><t>Cloudy</t><wind><s>13</s><gust>N/A</gust><d>273</d><t>W</t></wind><bt>Cloudy</bt><ppcp>10</ppcp><hmid>77</hmid></part><part p="n"><icon>45</icon><t>Showers Late</t><wind><s>6</s><gust>N/A</gust><d>124</d><t>SE</t></wind><bt>Shwrs Late</bt><ppcp>30</ppcp><hmid>97</hmid></part></day><day d="2" t="Wednesday" dt="Aug 8"><hi>21</hi><low>15</low><sunr>6:50 AM</sunr><suns>5:52 PM</suns><part p="d"><icon>39</icon><t>AM Showers</t><wind><s>11</s><gust>N/A</gust><d>100</d><t>E</t></wind><bt>AM Showers</bt><ppcp>40</ppcp><hmid>87</hmid></part><part p="n"><icon>26</icon><t>Cloudy</t><wind><s>2</s><gust>N/A</gust><d>90</d><t>E</t></wind><bt>Cloudy</bt><ppcp>10</ppcp><hmid>98</hmid></part></day><day d="3" t="Thursday" dt="Aug 9"><hi>25</hi><low>16</low><sunr>6:49 AM</sunr><suns>5:53 PM</suns><part p="d"><icon>30</icon><t>AM Clouds / PM Sun</t><wind><s>11</s><gust>N/A</gust><d>62</d><t>ENE</t></wind><bt>AM Clouds</bt><ppcp>10</ppcp><hmid>87</hmid></part><part p="n"><icon>29</icon><t>Partly Cloudy</t><wind><s>3</s><gust>N/A</gust><d>8</d><t>N</t></wind><bt>P Cloudy</bt><ppcp>0</ppcp><hmid>95</hmid></part></day><day d="4" t="Friday" dt="Aug 10"><hi>27</hi><low>16</low><sunr>6:49 AM</sunr><suns>5:53 PM</suns><part p="d"><icon>30</icon><t>Partly Cloudy</t><wind><s>11</s><gust>N/A</gust><d>335</d><t>NNW</t></wind><bt>P Cloudy</bt><ppcp>0</ppcp><hmid>77</hmid></part><part p="n"><icon>29</icon><t>Partly Cloudy</t><wind><s>3</s><gust>N/A</gust><d>300</d><t>WNW</t></wind><bt>P Cloudy</bt><ppcp>0</ppcp><hmid>87</hmid></part></day><day d="5" t="Saturday" dt="Aug 11"><hi>26</hi><low>16</low><sunr>6:48 AM</sunr><suns>5:54 PM</suns><part p="d"><icon>26</icon><t>Cloudy</t><wind><s>11</s><gust>N/A</gust><d>160</d><t>SSE</t></wind><bt>Cloudy</bt><ppcp>10</ppcp><hmid>79</hmid></part><part p="n"><icon>26</icon><t>Cloudy</t><wind><s>3</s><gust>N/A</gust><d>126</d><t>SE</t></wind><bt>Cloudy</bt><ppcp>20</ppcp><hmid>96</hmid></part></day><day d="6" t="Sunday" dt="Aug 12"><hi>22</hi><low>16</low><sunr>6:47 AM</sunr><suns>5:54 PM</suns><part p="d"><icon>26</icon><t>Cloudy</t><wind><s>10</s><gust>N/A</gust><d>103</d><t>ESE</t></wind><bt>Cloudy</bt><ppcp>20</ppcp><hmid>85</hmid></part><part p="n"><icon>45</icon><t>Scattered Showers</t><wind><s>3</s><gust>N/A</gust><d>84</d><t>E</t></wind><bt>Sct Showers</bt><ppcp>30</ppcp><hmid>96</hmid></part></day><day d="7" t="Monday" dt="Aug 13"><hi>24</hi><low>15</low><sunr>6:46 AM</sunr><suns>5:55 PM</suns><part p="d"><icon>39</icon><t>Scattered Showers</t><wind><s>11</s><gust>N/A</gust><d>77</d><t>ENE</t></wind><bt>Sct Showers</bt><ppcp>30</ppcp><hmid>82</hmid></part><part p="n"><icon>29</icon><t>Partly Cloudy</t><wind><s>5</s><gust>N/A</gust><d>27</d><t>NNE</t></wind><bt>P Cloudy</bt><ppcp>10</ppcp><hmid>92</hmid></part></day><day d="8" t="Tuesday" dt="Aug 14"><hi>25</hi><low>16</low><sunr>6:45 AM</sunr><suns>5:55 PM</suns><part p="d"><icon>30</icon><t>Partly Cloudy</t><wind><s>11</s><gust>N/A</gust><d>46</d><t>NE</t></wind><bt>P Cloudy</bt><ppcp>10</ppcp><hmid>76</hmid></part><part p="n"><icon>29</icon><t>Partly Cloudy</t><wind><s>5</s><gust>N/A</gust><d>77</d><t>ENE</t></wind><bt>P Cloudy</bt><ppcp>20</ppcp><hmid>90</hmid></part></day><day d="9" t="Wednesday" dt="Aug 15"><hi>23</hi><low>15</low><sunr>6:44 AM</sunr><suns>5:56 PM</suns><part p="d"><icon>30</icon><t>Partly Cloudy</t><wind><s>10</s><gust>N/A</gust><d>186</d><t>S</t></wind><bt>P Cloudy</bt><ppcp>20</ppcp><hmid>82</hmid></part><part p="n"><icon>45</icon><t>Scattered Showers</t><wind><s>3</s><gust>N/A</gust><d>173</d><t>S</t></wind><bt>Sct Showers</bt><ppcp>30</ppcp><hmid>95</hmid></part></day></dayf></weather>');

-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_eweather_locations`
--

CREATE TABLE IF NOT EXISTS `jos_eweather_locations` (
  `id` int(4) NOT NULL auto_increment,
  `city` varchar(50) default NULL,
  `country` varchar(50) NOT NULL default '0',
  `region` varchar(50) NOT NULL default '0',
  `loc_id` varchar(10) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 PACK_KEYS=0 AUTO_INCREMENT=705 ;

--
-- Extraindo dados da tabela `jos_eweather_locations`
--

INSERT INTO `jos_eweather_locations` (`id`, `city`, `country`, `region`, `loc_id`) VALUES
(1, 'Adamantina', 'Brazil', 'South America', 'BRXX0001'),
(2, 'Alagoinhas', 'Brazil', 'South America', 'BRXX0002'),
(3, 'Alegrete', 'Brazil', 'South America', 'BRXX0003'),
(4, 'Altamira', 'Brazil', 'South America', 'BRXX0005'),
(5, 'Americana', 'Brazil', 'South America', 'BRXX0006'),
(6, 'Anapolis', 'Brazil', 'South America', 'BRXX0007'),
(7, 'Anastacio', 'Brazil', 'South America', 'BRXX0008'),
(8, 'Andradina', 'Brazil', 'South America', 'BRXX0009'),
(9, 'Apucarana', 'Brazil', 'South America', 'BRXX0010'),
(10, 'Aracaju', 'Brazil', 'South America', 'BRXX0011'),
(11, 'Aracati', 'Brazil', 'South America', 'BRXX0012'),
(12, 'Aracatuba', 'Brazil', 'South America', 'BRXX0013'),
(13, 'Aracruz', 'Brazil', 'South America', 'BRXX0014'),
(14, 'Arapiraca', 'Brazil', 'South America', 'BRXX0015'),
(15, 'Arapongas', 'Brazil', 'South America', 'BRXX0016'),
(16, 'Araucaria', 'Brazil', 'South America', 'BRXX0017'),
(17, 'Araxa', 'Brazil', 'South America', 'BRXX0018'),
(18, 'Aripuana', 'Brazil', 'South America', 'BRXX0019'),
(19, 'Auriflama', 'Brazil', 'South America', 'BRXX0020'),
(20, 'Avare', 'Brazil', 'South America', 'BRXX0021'),
(21, 'Bage', 'Brazil', 'South America', 'BRXX0022'),
(22, 'Balsamo', 'Brazil', 'South America', 'BRXX0023'),
(23, 'Balsas', 'Brazil', 'South America', 'BRXX0024'),
(24, 'Bandeirantes', 'Brazil', 'South America', 'BRXX0025'),
(25, 'Barbacena', 'Brazil', 'South America', 'BRXX0026'),
(26, 'Barcelos', 'Brazil', 'South America', 'BRXX0027'),
(27, 'Barra do Garcas', 'Brazil', 'South America', 'BRXX0028'),
(28, 'Barra Mansa', 'Brazil', 'South America', 'BRXX0029'),
(29, 'Barreiras', 'Brazil', 'South America', 'BRXX0030'),
(30, 'Bauru', 'Brazil', 'South America', 'BRXX0031'),
(31, 'Belem', 'Brazil', 'South America', 'BRXX0032'),
(32, 'Belo Horizonte', 'Brazil', 'South America', 'BRXX0033'),
(33, 'Bento Goncalves', 'Brazil', 'South America', 'BRXX0034'),
(34, 'Biguacu', 'Brazil', 'South America', 'BRXX0035'),
(35, 'Birigui', 'Brazil', 'South America', 'BRXX0036'),
(36, 'Blumenau', 'Brazil', 'South America', 'BRXX0037'),
(37, 'Boa Vista', 'Brazil', 'South America', 'BRXX0038'),
(38, 'Bom Despacho', 'Brazil', 'South America', 'BRXX0039'),
(39, 'Bom Jesus da Lapa', 'Brazil', 'South America', 'BRXX0040'),
(40, 'Botucatu', 'Brazil', 'South America', 'BRXX0041'),
(41, 'Braganca Paulista', 'Brazil', 'South America', 'BRXX0042'),
(42, 'Brasilia', 'Brazil', 'South America', 'BRXX0043'),
(43, 'Brusque', 'Brazil', 'South America', 'BRXX0044'),
(44, 'Cabo Frio', 'Brazil', 'South America', 'BRXX0045'),
(45, 'Caceres', 'Brazil', 'South America', 'BRXX0046'),
(46, 'Cachoeiro de Itap', 'Brazil', 'South America', 'BRXX0048'),
(47, 'Campina Grande', 'Brazil', 'South America', 'BRXX0049'),
(48, 'Campinas', 'Brazil', 'South America', 'BRXX0050'),
(49, 'Campo Grande', 'Brazil', 'South America', 'BRXX0051'),
(50, 'Campo Largo', 'Brazil', 'South America', 'BRXX0052'),
(51, 'Campo Mourao', 'Brazil', 'South America', 'BRXX0053'),
(52, 'Campos', 'Brazil', 'South America', 'BRXX0054'),
(53, 'Campos do Jordao', 'Brazil', 'South America', 'BRXX0055'),
(54, 'Canoas', 'Brazil', 'South America', 'BRXX0056'),
(55, 'Canoinhas', 'Brazil', 'South America', 'BRXX0057'),
(56, 'Canto do Buriti', 'Brazil', 'South America', 'BRXX0058'),
(57, 'Caraguatatuba', 'Brazil', 'South America', 'BRXX0059'),
(58, 'Carapina', 'Brazil', 'South America', 'BRXX0060'),
(59, 'Caratinga', 'Brazil', 'South America', 'BRXX0061'),
(60, 'Caravelas', 'Brazil', 'South America', 'BRXX0062'),
(61, 'Cascavel', 'Brazil', 'South America', 'BRXX0063'),
(62, 'Castro', 'Brazil', 'South America', 'BRXX0064'),
(63, 'Catalao', 'Brazil', 'South America', 'BRXX0065'),
(64, 'Catanduva', 'Brazil', 'South America', 'BRXX0066'),
(65, 'Caxias', 'Brazil', 'South America', 'BRXX0067'),
(66, 'Caxias do Sul', 'Brazil', 'South America', 'BRXX0068'),
(67, 'Chapeco', 'Brazil', 'South America', 'BRXX0069'),
(68, 'Colatina', 'Brazil', 'South America', 'BRXX0070'),
(69, 'Colombo', 'Brazil', 'South America', 'BRXX0071'),
(70, 'Conselheiro Lafai', 'Brazil', 'South America', 'BRXX0072'),
(71, 'Cornelio Procopio', 'Brazil', 'South America', 'BRXX0073'),
(72, 'Corumba', 'Brazil', 'South America', 'BRXX0074'),
(73, 'Coxim', 'Brazil', 'South America', 'BRXX0075'),
(74, 'Criciuma', 'Brazil', 'South America', 'BRXX0076'),
(75, 'Cruzeta', 'Brazil', 'South America', 'BRXX0077'),
(76, 'Cuiaba', 'Brazil', 'South America', 'BRXX0078'),
(77, 'Curitiba', 'Brazil', 'South America', 'BRXX0079'),
(78, 'Curitibanos', 'Brazil', 'South America', 'BRXX0080'),
(79, 'Curvelo', 'Brazil', 'South America', 'BRXX0081'),
(80, 'Diadema', 'Brazil', 'South America', 'BRXX0082'),
(81, 'Diamantina', 'Brazil', 'South America', 'BRXX0083'),
(82, 'Divinopolis', 'Brazil', 'South America', 'BRXX0084'),
(83, 'Dourados', 'Brazil', 'South America', 'BRXX0085'),
(84, 'Dracena', 'Brazil', 'South America', 'BRXX0086'),
(85, 'Duque de Caxias', 'Brazil', 'South America', 'BRXX0087'),
(86, 'Farroupilha', 'Brazil', 'South America', 'BRXX0088'),
(87, 'Feira de Santana', 'Brazil', 'South America', 'BRXX0089'),
(88, 'Fernandopolis', 'Brazil', 'South America', 'BRXX0090'),
(89, 'Florianopolis', 'Brazil', 'South America', 'BRXX0091'),
(90, 'Formosa', 'Brazil', 'South America', 'BRXX0092'),
(91, 'Fortaleza', 'Brazil', 'South America', 'BRXX0093'),
(92, 'Foz do Iguacu', 'Brazil', 'South America', 'BRXX0094'),
(93, 'Franca', 'Brazil', 'South America', 'BRXX0095'),
(94, 'Garanhuns', 'Brazil', 'South America', 'BRXX0096'),
(95, 'Garopaba', 'Brazil', 'South America', 'BRXX0097'),
(96, 'Gaspar', 'Brazil', 'South America', 'BRXX0098'),
(97, 'Goiania', 'Brazil', 'South America', 'BRXX0099'),
(98, 'Governador Valada', 'Brazil', 'South America', 'BRXX0100'),
(99, 'Gramado', 'Brazil', 'South America', 'BRXX0101'),
(100, 'Guaiba', 'Brazil', 'South America', 'BRXX0102'),
(101, 'Guarapari', 'Brazil', 'South America', 'BRXX0103'),
(102, 'Guarapuava', 'Brazil', 'South America', 'BRXX0104'),
(103, 'Guararapes', 'Brazil', 'South America', 'BRXX0105'),
(104, 'Guaratuba', 'Brazil', 'South America', 'BRXX0106'),
(105, 'Guarulhos', 'Brazil', 'South America', 'BRXX0107'),
(106, 'Hidrolandia', 'Brazil', 'South America', 'BRXX0108'),
(107, 'Iguape', 'Brazil', 'South America', 'BRXX0109'),
(108, 'Indaial', 'Brazil', 'South America', 'BRXX0110'),
(109, 'Inhumas', 'Brazil', 'South America', 'BRXX0111'),
(110, 'Ipatinga', 'Brazil', 'South America', 'BRXX0112'),
(111, 'Irati', 'Brazil', 'South America', 'BRXX0113'),
(112, 'Itaberaba', 'Brazil', 'South America', 'BRXX0114'),
(113, 'Itajai', 'Brazil', 'South America', 'BRXX0115'),
(114, 'Itaperuna', 'Brazil', 'South America', 'BRXX0116'),
(115, 'Itapeva', 'Brazil', 'South America', 'BRXX0117'),
(116, 'Itaquari', 'Brazil', 'South America', 'BRXX0118'),
(117, 'Itaqui', 'Brazil', 'South America', 'BRXX0119'),
(118, 'Itauna', 'Brazil', 'South America', 'BRXX0120'),
(119, 'Itu', 'Brazil', 'South America', 'BRXX0121'),
(120, 'Ituiutaba', 'Brazil', 'South America', 'BRXX0122'),
(121, 'Jacareacanga', 'Brazil', 'South America', 'BRXX0123'),
(122, 'Jaciara', 'Brazil', 'South America', 'BRXX0124'),
(123, 'Janauba', 'Brazil', 'South America', 'BRXX0125'),
(124, 'Jaragua do Sul', 'Brazil', 'South America', 'BRXX0126'),
(125, 'Ji-Parana', 'Brazil', 'South America', 'BRXX0127'),
(126, 'Joao Pessoa', 'Brazil', 'South America', 'BRXX0128'),
(127, 'Joinville', 'Brazil', 'South America', 'BRXX0130'),
(128, 'Juiz de Fora', 'Brazil', 'South America', 'BRXX0131'),
(129, 'Labrea', 'Brazil', 'South America', 'BRXX0133'),
(130, 'Limeira', 'Brazil', 'South America', 'BRXX0134'),
(131, 'Linhares', 'Brazil', 'South America', 'BRXX0135'),
(132, 'Santana do Livram', 'Brazil', 'South America', 'BRXX0136'),
(133, 'Londrina', 'Brazil', 'South America', 'BRXX0137'),
(134, 'Lorena', 'Brazil', 'South America', 'BRXX0138'),
(135, 'Lourenco', 'Brazil', 'South America', 'BRXX0139'),
(136, 'Luziania', 'Brazil', 'South America', 'BRXX0140'),
(137, 'Barra de Macae', 'Brazil', 'South America', 'BRXX0141'),
(138, 'Macapa', 'Brazil', 'South America', 'BRXX0142'),
(139, 'Maceio', 'Brazil', 'South America', 'BRXX0143'),
(140, 'Mafra', 'Brazil', 'South America', 'BRXX0144'),
(141, 'Mage', 'Brazil', 'South America', 'BRXX0145'),
(142, 'Manaus', 'Brazil', 'South America', 'BRXX0146'),
(143, 'Manhuacu', 'Brazil', 'South America', 'BRXX0147'),
(144, 'Manicore', 'Brazil', 'South America', 'BRXX0148'),
(145, 'Maraba', 'Brazil', 'South America', 'BRXX0149'),
(146, 'Marilia', 'Brazil', 'South America', 'BRXX0150'),
(147, 'Maringa', 'Brazil', 'South America', 'BRXX0151'),
(148, 'Maua', 'Brazil', 'South America', 'BRXX0152'),
(149, 'Mazagao', 'Brazil', 'South America', 'BRXX0153'),
(150, 'Medianeira', 'Brazil', 'South America', 'BRXX0154'),
(151, 'Montes Claros', 'Brazil', 'South America', 'BRXX0155'),
(152, 'Morrinhos', 'Brazil', 'South America', 'BRXX0156'),
(153, 'Mossoro', 'Brazil', 'South America', 'BRXX0157'),
(154, 'Natal', 'Brazil', 'South America', 'BRXX0158'),
(155, 'Niteroi', 'Brazil', 'South America', 'BRXX0159'),
(156, 'Nova Iguacu', 'Brazil', 'South America', 'BRXX0161'),
(157, 'Nova Lima', 'Brazil', 'South America', 'BRXX0162'),
(158, 'Novo Hamburgo', 'Brazil', 'South America', 'BRXX0163'),
(159, 'Olinda', 'Brazil', 'South America', 'BRXX0164'),
(160, 'Osasco', 'Brazil', 'South America', 'BRXX0165'),
(161, 'Ourinhos', 'Brazil', 'South America', 'BRXX0166'),
(162, 'Pacajus', 'Brazil', 'South America', 'BRXX0167'),
(163, 'Palmares', 'Brazil', 'South America', 'BRXX0168'),
(164, 'Palmas', 'Brazil', 'South America', 'BRXX0169'),
(165, 'Paracatu', 'Brazil', 'South America', 'BRXX0170'),
(166, 'Paraguacu Paulist', 'Brazil', 'South America', 'BRXX0171'),
(167, 'Paranagua', 'Brazil', 'South America', 'BRXX0172'),
(168, 'Parintins', 'Brazil', 'South America', 'BRXX0173'),
(169, 'Passo Fundo', 'Brazil', 'South America', 'BRXX0174'),
(170, 'Pauini', 'Brazil', 'South America', 'BRXX0175'),
(171, 'Pelotas', 'Brazil', 'South America', 'BRXX0176'),
(172, 'Penapolis', 'Brazil', 'South America', 'BRXX0177'),
(173, 'Peruibe', 'Brazil', 'South America', 'BRXX0178'),
(174, 'Petrolina', 'Brazil', 'South America', 'BRXX0179'),
(175, 'Petropolis', 'Brazil', 'South America', 'BRXX0180'),
(176, 'Piracicaba', 'Brazil', 'South America', 'BRXX0181'),
(177, 'Pirapora', 'Brazil', 'South America', 'BRXX0182'),
(178, 'Pocos de Caldas', 'Brazil', 'South America', 'BRXX0183'),
(179, 'Ponta Grossa', 'Brazil', 'South America', 'BRXX0184'),
(180, 'Ponta Pora', 'Brazil', 'South America', 'BRXX0185'),
(181, 'Porto Alegre', 'Brazil', 'South America', 'BRXX0186'),
(182, 'Porto Artur', 'Brazil', 'South America', 'BRXX0187'),
(183, 'Porto Feliz', 'Brazil', 'South America', 'BRXX0188'),
(184, 'Porto Nacional', 'Brazil', 'South America', 'BRXX0189'),
(185, 'Porto Velho', 'Brazil', 'South America', 'BRXX0190'),
(186, 'Presidente Pruden', 'Brazil', 'South America', 'BRXX0192'),
(187, 'Primavera do Lest', 'Brazil', 'South America', 'BRXX0193'),
(188, 'Quixeramobim', 'Brazil', 'South America', 'BRXX0194'),
(189, 'Recife', 'Brazil', 'South America', 'BRXX0195'),
(190, 'Registro', 'Brazil', 'South America', 'BRXX0196'),
(191, 'Resende', 'Brazil', 'South America', 'BRXX0197'),
(192, 'Ribeirao Preto', 'Brazil', 'South America', 'BRXX0198'),
(193, 'Rio Branco', 'Brazil', 'South America', 'BRXX0199'),
(194, 'Rio de Janeiro', 'Brazil', 'South America', 'BRXX0201'),
(195, 'Rio Grande', 'Brazil', 'South America', 'BRXX0202'),
(196, 'Rio Grande da Ser', 'Brazil', 'South America', 'BRXX0203'),
(197, 'Rio Largo', 'Brazil', 'South America', 'BRXX0204'),
(198, 'Rio Verde', 'Brazil', 'South America', 'BRXX0205'),
(199, 'Rolandia', 'Brazil', 'South America', 'BRXX0206'),
(200, 'Rondonopolis', 'Brazil', 'South America', 'BRXX0207'),
(201, 'Rosairo', 'Brazil', 'South America', 'BRXX0208'),
(202, 'Rosario Oeste', 'Brazil', 'South America', 'BRXX0209'),
(203, 'Rozendo', 'Brazil', 'South America', 'BRXX0210'),
(204, 'Sabara', 'Brazil', 'South America', 'BRXX0211'),
(205, 'Salto do Urubupun', 'Brazil', 'South America', 'BRXX0212'),
(206, 'Santa Isabel', 'Brazil', 'South America', 'BRXX0214'),
(207, 'Santa Maria', 'Brazil', 'South America', 'BRXX0215'),
(208, 'Santarem', 'Brazil', 'South America', 'BRXX0216'),
(209, 'Santo Andre', 'Brazil', 'South America', 'BRXX0217'),
(210, 'Santos Dumont', 'Brazil', 'South America', 'BRXX0219'),
(211, 'Sao Bernardo do C', 'Brazil', 'South America', 'BRXX0220'),
(212, 'Sao Caetano', 'Brazil', 'South America', 'BRXX0221'),
(213, 'Sao Carlos', 'Brazil', 'South America', 'BRXX0222'),
(214, 'Sao Felix do Xing', 'Brazil', 'South America', 'BRXX0223'),
(215, 'Sao Gabriel da Ca', 'Brazil', 'South America', 'BRXX0224'),
(216, 'Sao Joao de Barra', 'Brazil', 'South America', 'BRXX0225'),
(217, 'Sao Joaquim', 'Brazil', 'South America', 'BRXX0226'),
(218, 'Sao Jose do Rio P', 'Brazil', 'South America', 'BRXX0227'),
(219, 'Sao Jose Dos Camp', 'Brazil', 'South America', 'BRXX0228'),
(220, 'Sao Jose dos Pinh', 'Brazil', 'South America', 'BRXX0229'),
(221, 'Sao Leopoldo', 'Brazil', 'South America', 'BRXX0230'),
(222, 'Sao Luis', 'Brazil', 'South America', 'BRXX0231'),
(223, 'Sao Paulo', 'Brazil', 'South America', 'BRXX0232'),
(224, 'Sao Vicente', 'Brazil', 'South America', 'BRXX0233'),
(225, 'Serra', 'Brazil', 'South America', 'BRXX0234'),
(226, 'Sete Lagoas', 'Brazil', 'South America', 'BRXX0235'),
(227, 'Sinop', 'Brazil', 'South America', 'BRXX0236'),
(228, 'Sorocaba', 'Brazil', 'South America', 'BRXX0237'),
(229, 'Tabatinga', 'Brazil', 'South America', 'BRXX0238'),
(230, 'Tangara', 'Brazil', 'South America', 'BRXX0239'),
(231, 'Tarauaca', 'Brazil', 'South America', 'BRXX0240'),
(232, 'Tatui', 'Brazil', 'South America', 'BRXX0241'),
(233, 'Taubate', 'Brazil', 'South America', 'BRXX0242'),
(234, 'Tefe', 'Brazil', 'South America', 'BRXX0243'),
(235, 'Terenos', 'Brazil', 'South America', 'BRXX0244'),
(236, 'Teresina', 'Brazil', 'South America', 'BRXX0245'),
(237, 'Tijucas', 'Brazil', 'South America', 'BRXX0246'),
(238, 'Tres Lagoas', 'Brazil', 'South America', 'BRXX0247'),
(239, 'Trindade', 'Brazil', 'South America', 'BRXX0248'),
(240, 'Tubarao', 'Brazil', 'South America', 'BRXX0249'),
(241, 'Tupa', 'Brazil', 'South America', 'BRXX0250'),
(242, 'Ubatuba', 'Brazil', 'South America', 'BRXX0251'),
(243, 'Uberaba', 'Brazil', 'South America', 'BRXX0252'),
(244, 'Uberlandia', 'Brazil', 'South America', 'BRXX0253'),
(245, 'Uruguaiana', 'Brazil', 'South America', 'BRXX0254'),
(246, 'Varzea Grande', 'Brazil', 'South America', 'BRXX0255'),
(247, 'Vera Cruz', 'Brazil', 'South America', 'BRXX0256'),
(248, 'Viamao', 'Brazil', 'South America', 'BRXX0257'),
(249, 'Vilhena', 'Brazil', 'South America', 'BRXX0258'),
(250, 'Vitoria', 'Brazil', 'South America', 'BRXX0259'),
(251, 'Vitoria da Conqui', 'Brazil', 'South America', 'BRXX0260'),
(252, 'Votuporanga', 'Brazil', 'South America', 'BRXX0261'),
(253, 'Angra dos Reis', 'Brazil', 'South America', 'BRXX0263'),
(254, 'Araguari', 'Brazil', 'South America', 'BRXX0264'),
(255, 'Araraquara', 'Brazil', 'South America', 'BRXX0265'),
(256, 'Arvoredo', 'Brazil', 'South America', 'BRXX0266'),
(257, 'Assis', 'Brazil', 'South America', 'BRXX0267'),
(258, 'Bertioga', 'Brazil', 'South America', 'BRXX0268'),
(259, 'Buzios', 'Brazil', 'South America', 'BRXX0269'),
(260, 'Cacapava', 'Brazil', 'South America', 'BRXX0270'),
(261, 'Camboriu', 'Brazil', 'South America', 'BRXX0271'),
(262, 'Carapicuiba', 'Brazil', 'South America', 'BRXX0272'),
(263, 'Caruaru', 'Brazil', 'South America', 'BRXX0273'),
(264, 'Castanhal', 'Brazil', 'South America', 'BRXX0274'),
(265, 'Cianorte', 'Brazil', 'South America', 'BRXX0275'),
(266, 'Concordia', 'Brazil', 'South America', 'BRXX0276'),
(267, 'Cruz Alta', 'Brazil', 'South America', 'BRXX0277'),
(268, 'Currais Novos', 'Brazil', 'South America', 'BRXX0278'),
(269, 'Erexim', 'Brazil', 'South America', 'BRXX0279'),
(270, 'Gravatai', 'Brazil', 'South America', 'BRXX0280'),
(271, 'Guaruja', 'Brazil', 'South America', 'BRXX0281'),
(272, 'Ilhabela', 'Brazil', 'South America', 'BRXX0282'),
(273, 'Ilheus', 'Brazil', 'South America', 'BRXX0283'),
(274, 'Itabaiana', 'Brazil', 'South America', 'BRXX0284'),
(275, 'Itabuna', 'Brazil', 'South America', 'BRXX0285'),
(276, 'Itanhaem', 'Brazil', 'South America', 'BRXX0286'),
(277, 'Itapetininga', 'Brazil', 'South America', 'BRXX0287'),
(278, 'Muribeca dos Guar', 'Brazil', 'South America', 'BRXX0288'),
(279, 'Jequie', 'Brazil', 'South America', 'BRXX0289'),
(280, 'Juazeiro do Norte', 'Brazil', 'South America', 'BRXX0290'),
(281, 'Lages', 'Brazil', 'South America', 'BRXX0291'),
(282, 'Laguna', 'Brazil', 'South America', 'BRXX0292'),
(283, 'Lins', 'Brazil', 'South America', 'BRXX0293'),
(284, 'Maracanau', 'Brazil', 'South America', 'BRXX0294'),
(285, 'Maresias', 'Brazil', 'South America', 'BRXX0295'),
(286, 'Mogi Das Cruzes', 'Brazil', 'South America', 'BRXX0296'),
(287, 'Mogi-Guacu', 'Brazil', 'South America', 'BRXX0297'),
(288, 'Mongagua', 'Brazil', 'South America', 'BRXX0298'),
(289, 'Nilopolis', 'Brazil', 'South America', 'BRXX0299'),
(290, 'Parati', 'Brazil', 'South America', 'BRXX0300'),
(291, 'Patos de Minas', 'Brazil', 'South America', 'BRXX0302'),
(292, 'Patrocinio', 'Brazil', 'South America', 'BRXX0303'),
(293, 'Paulista', 'Brazil', 'South America', 'BRXX0304'),
(294, 'Pedra Azul', 'Brazil', 'South America', 'BRXX0305'),
(295, 'Porto Seguro', 'Brazil', 'South America', 'BRXX0306'),
(296, 'Santa Branca', 'Brazil', 'South America', 'BRXX0307'),
(297, 'Santa Cruz do Sul', 'Brazil', 'South America', 'BRXX0308'),
(298, 'Sao Joao del Rei', 'Brazil', 'South America', 'BRXX0309'),
(299, 'Sao Mateus', 'Brazil', 'South America', 'BRXX0310'),
(300, 'Sao Sebastiao', 'Brazil', 'South America', 'BRXX0311'),
(301, 'Sobral', 'Brazil', 'South America', 'BRXX0312'),
(302, 'Sumare', 'Brazil', 'South America', 'BRXX0313'),
(303, 'Teofilo Otoni', 'Brazil', 'South America', 'BRXX0314'),
(304, 'Teresopolis', 'Brazil', 'South America', 'BRXX0315'),
(305, 'Timon', 'Brazil', 'South America', 'BRXX0316'),
(306, 'Umuarama', 'Brazil', 'South America', 'BRXX0317'),
(307, 'Varginha', 'Brazil', 'South America', 'BRXX0318'),
(308, 'Vila Velha', 'Brazil', 'South America', 'BRXX0319'),
(309, 'Volta Redonda', 'Brazil', 'South America', 'BRXX0320'),
(310, 'Ilheus Aeroporto', 'Brazil', 'South America', 'BRXX0323'),
(311, 'Santa Marta', 'Brazil', 'South America', 'BRXX0327'),
(312, 'Boraciia', 'Brazil', 'South America', 'BRXX0333'),
(313, 'Juquia', 'Brazil', 'South America', 'BRXX0336'),
(314, 'Alta Floresta', 'Brazil', 'South America', 'BRXX0339'),
(315, 'Imperatriz', 'Brazil', 'South America', 'BRXX0340'),
(316, 'Santana do Piragu', 'Brazil', 'South America', 'BRXX0341'),
(317, 'Poa', 'Brazil', 'South America', 'BRXX0342'),
(318, 'Paulinia', 'Brazil', 'South America', 'BRXX0343'),
(319, 'Sao Roque', 'Brazil', 'South America', 'BRXX0344'),
(320, 'Cabreuva', 'Brazil', 'South America', 'BRXX0345'),
(321, 'Abaete', 'Brazil', 'South America', 'BRXX0346'),
(322, 'Afua', 'Brazil', 'South America', 'BRXX0347'),
(323, 'Aguai', 'Brazil', 'South America', 'BRXX0348'),
(324, 'Aguas de Sao Pedr', 'Brazil', 'South America', 'BRXX0349'),
(325, 'Aguas Formosas', 'Brazil', 'South America', 'BRXX0350'),
(326, 'Aimores', 'Brazil', 'South America', 'BRXX0351'),
(327, 'Alpinopolis', 'Brazil', 'South America', 'BRXX0352'),
(328, 'Alvaraes', 'Brazil', 'South America', 'BRXX0353'),
(329, 'Alvares Machado', 'Brazil', 'South America', 'BRXX0354'),
(330, 'Andira', 'Brazil', 'South America', 'BRXX0355'),
(331, 'Apiai', 'Brazil', 'South America', 'BRXX0356'),
(332, 'Araguaina', 'Brazil', 'South America', 'BRXX0357'),
(333, 'Aruja', 'Brazil', 'South America', 'BRXX0358'),
(334, 'Bambui', 'Brazil', 'South America', 'BRXX0359'),
(335, 'Barra de Sao Fran', 'Brazil', 'South America', 'BRXX0360'),
(336, 'Barra do Pirai', 'Brazil', 'South America', 'BRXX0361'),
(337, 'Boa Esperanca', 'Brazil', 'South America', 'BRXX0362'),
(338, 'Bocaiuva', 'Brazil', 'South America', 'BRXX0363'),
(339, 'Jau', 'Brazil', 'South America', 'BRXX0364'),
(340, 'Caete', 'Brazil', 'South America', 'BRXX0365'),
(341, 'Capao Bonito', 'Brazil', 'South America', 'BRXX0366'),
(342, 'Capao da Canoa', 'Brazil', 'South America', 'BRXX0367'),
(343, 'Caparao', 'Brazil', 'South America', 'BRXX0368'),
(344, 'Caracarai', 'Brazil', 'South America', 'BRXX0369'),
(345, 'Cerqueira Cesar', 'Brazil', 'South America', 'BRXX0370'),
(346, 'Cesario Lange', 'Brazil', 'South America', 'BRXX0371'),
(347, 'Cipo', 'Brazil', 'South America', 'BRXX0372'),
(348, 'Codajas', 'Brazil', 'South America', 'BRXX0373'),
(349, 'Cristalandia', 'Brazil', 'South America', 'BRXX0374'),
(350, 'Cubatao', 'Brazil', 'South America', 'BRXX0375'),
(351, 'Curuca', 'Brazil', 'South America', 'BRXX0376'),
(352, 'Espirito Santo do', 'Brazil', 'South America', 'BRXX0377'),
(353, 'Feijo', 'Brazil', 'South America', 'BRXX0378'),
(354, 'Filadelfia', 'Brazil', 'South America', 'BRXX0379'),
(355, 'Francisco Sa', 'Brazil', 'South America', 'BRXX0380'),
(356, 'Grao Mogol', 'Brazil', 'South America', 'BRXX0381'),
(357, 'Guaira', 'Brazil', 'South America', 'BRXX0382'),
(358, 'Guaratingueta', 'Brazil', 'South America', 'BRXX0383'),
(359, 'Gurupa', 'Brazil', 'South America', 'BRXX0384'),
(360, 'Humaita', 'Brazil', 'South America', 'BRXX0385'),
(361, 'Ibiai', 'Brazil', 'South America', 'BRXX0386'),
(362, 'Ibiuna', 'Brazil', 'South America', 'BRXX0387'),
(363, 'Iepe', 'Brazil', 'South America', 'BRXX0388'),
(364, 'Ipero', 'Brazil', 'South America', 'BRXX0389'),
(365, 'Ipiiba', 'Brazil', 'South America', 'BRXX0390'),
(366, 'Irai', 'Brazil', 'South America', 'BRXX0391'),
(367, 'Irece', 'Brazil', 'South America', 'BRXX0392'),
(368, 'Itaborai', 'Brazil', 'South America', 'BRXX0393'),
(369, 'Itaguai', 'Brazil', 'South America', 'BRXX0394'),
(370, 'Itai', 'Brazil', 'South America', 'BRXX0395'),
(371, 'Itapolis', 'Brazil', 'South America', 'BRXX0396'),
(372, 'Ivai', 'Brazil', 'South America', 'BRXX0397'),
(373, 'Jacarei', 'Brazil', 'South America', 'BRXX0398'),
(374, 'Januaria', 'Brazil', 'South America', 'BRXX0399'),
(375, 'Joao Neiva', 'Brazil', 'South America', 'BRXX0400'),
(376, 'Jose Bonifacio', 'Brazil', 'South America', 'BRXX0402'),
(377, 'Jurua', 'Brazil', 'South America', 'BRXX0403'),
(378, 'Lindoia', 'Brazil', 'South America', 'BRXX0404'),
(379, 'Lucelia', 'Brazil', 'South America', 'BRXX0405'),
(380, 'Morro do Chapeu', 'Brazil', 'South America', 'BRXX0406'),
(381, 'Mairipora', 'Brazil', 'South America', 'BRXX0407'),
(382, 'Mancio Lima', 'Brazil', 'South America', 'BRXX0408'),
(383, 'Marataizes', 'Brazil', 'South America', 'BRXX0409'),
(384, 'Marica', 'Brazil', 'South America', 'BRXX0410'),
(385, 'Martinopolis', 'Brazil', 'South America', 'BRXX0411'),
(386, 'Matao', 'Brazil', 'South America', 'BRXX0412'),
(387, 'Maues', 'Brazil', 'South America', 'BRXX0413'),
(388, 'Mirandopolis', 'Brazil', 'South America', 'BRXX0414'),
(389, 'Muriae', 'Brazil', 'South America', 'BRXX0415'),
(390, 'Nazare Paulista', 'Brazil', 'South America', 'BRXX0416'),
(391, 'Nova Venecia', 'Brazil', 'South America', 'BRXX0417'),
(392, 'Novo Airao', 'Brazil', 'South America', 'BRXX0418'),
(393, 'Obidos', 'Brazil', 'South America', 'BRXX0419'),
(394, 'Olimpia', 'Brazil', 'South America', 'BRXX0420'),
(395, 'Oriximina', 'Brazil', 'South America', 'BRXX0421'),
(396, 'Orlandia', 'Brazil', 'South America', 'BRXX0422'),
(397, 'Para de Minas', 'Brazil', 'South America', 'BRXX0423'),
(398, 'Parana', 'Brazil', 'South America', 'BRXX0424'),
(399, 'Paulinia', 'Brazil', 'South America', 'BRXX0425'),
(400, 'Pirajai', 'Brazil', 'South America', 'BRXX0426'),
(401, 'Pirajui', 'Brazil', 'South America', 'BRXX0427'),
(402, 'Poco Fundo', 'Brazil', 'South America', 'BRXX0428'),
(403, 'Pompeia', 'Brazil', 'South America', 'BRXX0429'),
(404, 'Pompeu', 'Brazil', 'South America', 'BRXX0430'),
(405, 'Ponte Alta do Bom', 'Brazil', 'South America', 'BRXX0431'),
(406, 'Presidente Medici', 'Brazil', 'South America', 'BRXX0432'),
(407, 'Propria', 'Brazil', 'South America', 'BRXX0433'),
(408, 'Regente Feijo', 'Brazil', 'South America', 'BRXX0434'),
(409, 'Ribeirao Pires', 'Brazil', 'South America', 'BRXX0436'),
(410, 'Santo Antonio de ', 'Brazil', 'South America', 'BRXX0437'),
(411, 'Sao Caetano de Od', 'Brazil', 'South America', 'BRXX0438'),
(412, 'Sao Luiz Gonzaga', 'Brazil', 'South America', 'BRXX0439'),
(413, 'Sao Jose do Rio P', 'Brazil', 'South America', 'BRXX0440'),
(414, 'Sao Joao da Boa V', 'Brazil', 'South America', 'BRXX0441'),
(415, 'Salesopolis', 'Brazil', 'South America', 'BRXX0442'),
(416, 'Santa Barbara', 'Brazil', 'South America', 'BRXX0443'),
(417, 'Santo Anastacio', 'Brazil', 'South America', 'BRXX0444'),
(418, 'Sao Fidelis', 'Brazil', 'South America', 'BRXX0445'),
(419, 'Sao Francisco', 'Brazil', 'South America', 'BRXX0446'),
(420, 'Sao Goncalo', 'Brazil', 'South America', 'BRXX0447'),
(421, 'Sao Joao da Barra', 'Brazil', 'South America', 'BRXX0448'),
(422, 'Sao Joao da Ponte', 'Brazil', 'South America', 'BRXX0449'),
(423, 'Sao Joaquim da Ba', 'Brazil', 'South America', 'BRXX0450'),
(424, 'Sao Luis do Parai', 'Brazil', 'South America', 'BRXX0451'),
(425, 'Sao Miguel Arcanj', 'Brazil', 'South America', 'BRXX0452'),
(426, 'Sao Pedro da Alde', 'Brazil', 'South America', 'BRXX0453'),
(427, 'Sao Romao', 'Brazil', 'South America', 'BRXX0454'),
(428, 'Sao Roque', 'Brazil', 'South America', 'BRXX0455'),
(429, 'Sao Simao', 'Brazil', 'South America', 'BRXX0456'),
(430, 'Sarapui', 'Brazil', 'South America', 'BRXX0457'),
(431, 'Senador Jose Porf', 'Brazil', 'South America', 'BRXX0458'),
(432, 'Sertaozinho', 'Brazil', 'South America', 'BRXX0459'),
(433, 'Silvianopolis', 'Brazil', 'South America', 'BRXX0460'),
(434, 'Senhor do Bonfim', 'Brazil', 'South America', 'BRXX0461'),
(435, 'Santo Antonio da ', 'Brazil', 'South America', 'BRXX0462'),
(436, 'Taboao da Serra', 'Brazil', 'South America', 'BRXX0463'),
(437, 'Tapaua', 'Brazil', 'South America', 'BRXX0464'),
(438, 'Tapirai', 'Brazil', 'South America', 'BRXX0465'),
(439, 'Tiete', 'Brazil', 'South America', 'BRXX0466'),
(440, 'Timoteo', 'Brazil', 'South America', 'BRXX0467'),
(441, 'Tocantinopolis', 'Brazil', 'South America', 'BRXX0468'),
(442, 'Tres Marias', 'Brazil', 'South America', 'BRXX0469'),
(443, 'Tres Pontas', 'Brazil', 'South America', 'BRXX0470'),
(444, 'Tres Rios', 'Brazil', 'South America', 'BRXX0471'),
(445, 'Uba', 'Brazil', 'South America', 'BRXX0472'),
(446, 'Unai', 'Brazil', 'South America', 'BRXX0473'),
(447, 'Urupes', 'Brazil', 'South America', 'BRXX0474'),
(448, 'Vargem Grande do ', 'Brazil', 'South America', 'BRXX0475'),
(449, 'Varzea Paulista', 'Brazil', 'South America', 'BRXX0476'),
(450, 'Vicosa', 'Brazil', 'South America', 'BRXX0477'),
(451, 'Visconde do Rio B', 'Brazil', 'South America', 'BRXX0478'),
(452, 'Agudos', 'Brazil', 'South America', 'BRXX0479'),
(453, 'Alegre', 'Brazil', 'South America', 'BRXX0480'),
(454, 'Alenquer', 'Brazil', 'South America', 'BRXX0481'),
(455, 'Alfenas', 'Brazil', 'South America', 'BRXX0482'),
(456, 'Almeirim', 'Brazil', 'South America', 'BRXX0483'),
(457, 'Almenara', 'Brazil', 'South America', 'BRXX0484'),
(458, 'Amparo', 'Brazil', 'South America', 'BRXX0485'),
(459, 'Ananindeua', 'Brazil', 'South America', 'BRXX0486'),
(460, 'Angatuba', 'Brazil', 'South America', 'BRXX0487'),
(461, 'Aparecida', 'Brazil', 'South America', 'BRXX0488'),
(462, 'Araguatins', 'Brazil', 'South America', 'BRXX0489'),
(463, 'Araruama', 'Brazil', 'South America', 'BRXX0490'),
(464, 'Arinos', 'Brazil', 'South America', 'BRXX0491'),
(465, 'Ariquemes', 'Brazil', 'South America', 'BRXX0492'),
(466, 'Atibaia', 'Brazil', 'South America', 'BRXX0493'),
(467, 'Baixo Guandu', 'Brazil', 'South America', 'BRXX0494'),
(468, 'Barra do Corda', 'Brazil', 'South America', 'BRXX0495'),
(469, 'Barretos', 'Brazil', 'South America', 'BRXX0496'),
(470, 'Barueri', 'Brazil', 'South America', 'BRXX0497'),
(471, 'Bebedouro', 'Brazil', 'South America', 'BRXX0498'),
(472, 'Belford Roxo', 'Brazil', 'South America', 'BRXX0499'),
(473, 'Belo Monte', 'Brazil', 'South America', 'BRXX0500'),
(474, 'Benjamin Constant', 'Brazil', 'South America', 'BRXX0502'),
(475, 'Betim', 'Brazil', 'South America', 'BRXX0503'),
(476, 'Boca do Acre', 'Brazil', 'South America', 'BRXX0504'),
(477, 'Boituva', 'Brazil', 'South America', 'BRXX0505'),
(478, 'Bom Jardim', 'Brazil', 'South America', 'BRXX0506'),
(479, 'Bom Jesus', 'Brazil', 'South America', 'BRXX0508'),
(480, 'Bom Jesus', 'Brazil', 'South America', 'BRXX0509'),
(481, 'Borba', 'Brazil', 'South America', 'BRXX0510'),
(482, 'Botelhos', 'Brazil', 'South America', 'BRXX0511'),
(483, 'Brotas', 'Brazil', 'South America', 'BRXX0512'),
(484, 'Buri', 'Brazil', 'South America', 'BRXX0513'),
(485, 'Buritis', 'Brazil', 'South America', 'BRXX0514'),
(486, 'Buritizeiro', 'Brazil', 'South America', 'BRXX0515'),
(487, 'Caapiranga', 'Brazil', 'South America', 'BRXX0516'),
(488, 'Cacoal', 'Brazil', 'South America', 'BRXX0517'),
(489, 'Caetite', 'Brazil', 'South America', 'BRXX0518'),
(490, 'Caieiras', 'Brazil', 'South America', 'BRXX0519'),
(491, 'Campestre', 'Brazil', 'South America', 'BRXX0520'),
(492, 'Campo Belo', 'Brazil', 'South America', 'BRXX0521'),
(493, 'Campos Novos', 'Brazil', 'South America', 'BRXX0522'),
(494, 'Canavieiras', 'Brazil', 'South America', 'BRXX0523'),
(495, 'Cantagalo', 'Brazil', 'South America', 'BRXX0524'),
(496, 'Canutama', 'Brazil', 'South America', 'BRXX0525'),
(497, 'Capanema', 'Brazil', 'South America', 'BRXX0526'),
(498, 'Capela do Alto', 'Brazil', 'South America', 'BRXX0527'),
(499, 'Capelinha', 'Brazil', 'South America', 'BRXX0528'),
(500, 'Capivari', 'Brazil', 'South America', 'BRXX0529'),
(501, 'Carangola', 'Brazil', 'South America', 'BRXX0530'),
(502, 'Carbonita', 'Brazil', 'South America', 'BRXX0531'),
(503, 'Carinhanha', 'Brazil', 'South America', 'BRXX0532'),
(504, 'Carmo da Cachoeir', 'Brazil', 'South America', 'BRXX0533'),
(505, 'Carmo do Rio Clar', 'Brazil', 'South America', 'BRXX0534'),
(506, 'Carolina', 'Brazil', 'South America', 'BRXX0535'),
(507, 'Carvoeiro', 'Brazil', 'South America', 'BRXX0536'),
(508, 'Casa Branca', 'Brazil', 'South America', 'BRXX0537'),
(509, 'Castelo', 'Brazil', 'South America', 'BRXX0538'),
(510, 'Cataguases', 'Brazil', 'South America', 'BRXX0539'),
(511, 'Cerquilho', 'Brazil', 'South America', 'BRXX0540'),
(512, 'Coelho da Rocha', 'Brazil', 'South America', 'BRXX0541'),
(513, 'Congonhas', 'Brazil', 'South America', 'BRXX0542'),
(514, 'Contagem', 'Brazil', 'South America', 'BRXX0543'),
(515, 'Cordeiro', 'Brazil', 'South America', 'BRXX0544'),
(516, 'Corinto', 'Brazil', 'South America', 'BRXX0545'),
(517, 'Coronel Fabrician', 'Brazil', 'South America', 'BRXX0546'),
(518, 'Cotia', 'Brazil', 'South America', 'BRXX0547'),
(519, 'Cruzeiro', 'Brazil', 'South America', 'BRXX0548'),
(520, 'Cruzeiro do Sul', 'Brazil', 'South America', 'BRXX0549'),
(521, 'Diamantino', 'Brazil', 'South America', 'BRXX0550'),
(522, 'Duartina', 'Brazil', 'South America', 'BRXX0551'),
(523, 'Ecoporanga', 'Brazil', 'South America', 'BRXX0552'),
(524, 'Embu', 'Brazil', 'South America', 'BRXX0553'),
(525, 'Encruzilhada do S', 'Brazil', 'South America', 'BRXX0554'),
(526, 'Espinosa', 'Brazil', 'South America', 'BRXX0555'),
(527, 'Floriano', 'Brazil', 'South America', 'BRXX0556'),
(528, 'Fonte Boa', 'Brazil', 'South America', 'BRXX0557'),
(529, 'Formoso', 'Brazil', 'South America', 'BRXX0558'),
(530, 'Francisco Morato', 'Brazil', 'South America', 'BRXX0559'),
(531, 'Franco da Rocha', 'Brazil', 'South America', 'BRXX0560'),
(532, 'General Salgado', 'Brazil', 'South America', 'BRXX0561'),
(533, 'Guapiara', 'Brazil', 'South America', 'BRXX0562'),
(534, 'Guarus', 'Brazil', 'South America', 'BRXX0563'),
(535, 'Gurupi', 'Brazil', 'South America', 'BRXX0564'),
(536, 'Ibitinga', 'Brazil', 'South America', 'BRXX0565'),
(537, 'Imperatriz', 'Brazil', 'South America', 'BRXX0566'),
(538, 'Indaiatuba', 'Brazil', 'South America', 'BRXX0567'),
(539, 'Inhapim', 'Brazil', 'South America', 'BRXX0568'),
(540, 'Ipameri', 'Brazil', 'South America', 'BRXX0569'),
(541, 'Itabaianinha', 'Brazil', 'South America', 'BRXX0570'),
(542, 'Itabira', 'Brazil', 'South America', 'BRXX0571'),
(543, 'Itacoatiara', 'Brazil', 'South America', 'BRXX0572'),
(544, 'Itaituba', 'Brazil', 'South America', 'BRXX0573'),
(545, 'Itamarandiba', 'Brazil', 'South America', 'BRXX0574'),
(546, 'Itapecerica da Se', 'Brazil', 'South America', 'BRXX0576'),
(547, 'Itapiranga', 'Brazil', 'South America', 'BRXX0577'),
(548, 'Itatiaia', 'Brazil', 'South America', 'BRXX0578'),
(549, 'Itatiba', 'Brazil', 'South America', 'BRXX0579'),
(550, 'Itupeva', 'Brazil', 'South America', 'BRXX0580'),
(551, 'Ituverava', 'Brazil', 'South America', 'BRXX0581'),
(552, 'Jaboticabal', 'Brazil', 'South America', 'BRXX0582'),
(553, 'Jacarezinho', 'Brazil', 'South America', 'BRXX0583'),
(554, 'Jales', 'Brazil', 'South America', 'BRXX0585'),
(555, 'Jaru', 'Brazil', 'South America', 'BRXX0586'),
(556, 'Jequitinhonha', 'Brazil', 'South America', 'BRXX0587'),
(557, 'Jumirim', 'Brazil', 'South America', 'BRXX0588'),
(558, 'Juquitiba', 'Brazil', 'South America', 'BRXX0589'),
(559, 'Juruti', 'Brazil', 'South America', 'BRXX0590'),
(560, 'Lagoa Santa', 'Brazil', 'South America', 'BRXX0591'),
(561, 'Lagoa Vermelha', 'Brazil', 'South America', 'BRXX0592'),
(562, 'Laranjal Paulista', 'Brazil', 'South America', 'BRXX0593'),
(563, 'Lavras', 'Brazil', 'South America', 'BRXX0594'),
(564, 'Leme', 'Brazil', 'South America', 'BRXX0595'),
(565, 'Machado', 'Brazil', 'South America', 'BRXX0596'),
(566, 'Macuco', 'Brazil', 'South America', 'BRXX0597'),
(567, 'Mairinque', 'Brazil', 'South America', 'BRXX0598'),
(568, 'Malacacheta', 'Brazil', 'South America', 'BRXX0599'),
(569, 'Manacapuru', 'Brazil', 'South America', 'BRXX0600'),
(570, 'Manga', 'Brazil', 'South America', 'BRXX0601'),
(571, 'Mangaratiba', 'Brazil', 'South America', 'BRXX0602'),
(572, 'Mantena', 'Brazil', 'South America', 'BRXX0603'),
(573, 'Marambaia', 'Brazil', 'South America', 'BRXX0604'),
(574, 'Mariana', 'Brazil', 'South America', 'BRXX0605'),
(575, 'Medina', 'Brazil', 'South America', 'BRXX0606'),
(576, 'Mesquita', 'Brazil', 'South America', 'BRXX0607'),
(577, 'Minas Novas', 'Brazil', 'South America', 'BRXX0608'),
(578, 'Mirassol', 'Brazil', 'South America', 'BRXX0609'),
(579, 'Mococa', 'Brazil', 'South America', 'BRXX0610'),
(580, 'Monte Alegre', 'Brazil', 'South America', 'BRXX0611'),
(581, 'Monte Azul', 'Brazil', 'South America', 'BRXX0612'),
(582, 'Moura', 'Brazil', 'South America', 'BRXX0613'),
(583, 'Mutum', 'Brazil', 'South America', 'BRXX0614'),
(584, 'Nanuque', 'Brazil', 'South America', 'BRXX0615'),
(585, 'Natividade', 'Brazil', 'South America', 'BRXX0616'),
(586, 'Neves', 'Brazil', 'South America', 'BRXX0617'),
(587, 'Xavantina', 'Brazil', 'South America', 'BRXX0618'),
(588, 'Novo Cruzeiro', 'Brazil', 'South America', 'BRXX0619'),
(589, 'Novo Horizonte', 'Brazil', 'South America', 'BRXX0620'),
(590, 'Oiapoque', 'Brazil', 'South America', 'BRXX0621'),
(591, 'Oswaldo Cruz', 'Brazil', 'South America', 'BRXX0622'),
(592, 'Ouro Preto', 'Brazil', 'South America', 'BRXX0623'),
(593, 'Ouro Preto do Oes', 'Brazil', 'South America', 'BRXX0624'),
(594, 'Paraibuna', 'Brazil', 'South America', 'BRXX0625'),
(595, 'Paulistana', 'Brazil', 'South America', 'BRXX0626'),
(596, 'Paulo Afonso', 'Brazil', 'South America', 'BRXX0627'),
(597, 'Pederneiras', 'Brazil', 'South America', 'BRXX0628'),
(598, 'Pedro Afonso', 'Brazil', 'South America', 'BRXX0629'),
(599, 'Penedo', 'Brazil', 'South America', 'BRXX0631'),
(600, 'Pereira Barreto', 'Brazil', 'South America', 'BRXX0632'),
(601, 'Perus', 'Brazil', 'South America', 'BRXX0633'),
(602, 'Picos', 'Brazil', 'South America', 'BRXX0634'),
(603, 'Piedade', 'Brazil', 'South America', 'BRXX0635'),
(604, 'Piedade do Rio Gr', 'Brazil', 'South America', 'BRXX0636'),
(605, 'Pilar do Sul', 'Brazil', 'South America', 'BRXX0637'),
(606, 'Pimenta Bueno', 'Brazil', 'South America', 'BRXX0638'),
(607, 'Pindamonhangaba', 'Brazil', 'South America', 'BRXX0639'),
(608, 'Pirapozinho', 'Brazil', 'South America', 'BRXX0640'),
(609, 'Pirassununga', 'Brazil', 'South America', 'BRXX0641'),
(610, 'Pirituba', 'Brazil', 'South America', 'BRXX0642'),
(611, 'Pitangui', 'Brazil', 'South America', 'BRXX0643'),
(612, 'Ponte Nova', 'Brazil', 'South America', 'BRXX0644'),
(613, 'Porangaba', 'Brazil', 'South America', 'BRXX0645'),
(614, 'Porteirinha', 'Brazil', 'South America', 'BRXX0646'),
(615, 'Porto Acre', 'Brazil', 'South America', 'BRXX0647'),
(616, 'Porto de Moz', 'Brazil', 'South America', 'BRXX0648'),
(617, 'Porto Ferreira', 'Brazil', 'South America', 'BRXX0649'),
(618, 'Prainha', 'Brazil', 'South America', 'BRXX0650'),
(619, 'Presidente Vences', 'Brazil', 'South America', 'BRXX0651'),
(620, 'Queimados', 'Brazil', 'South America', 'BRXX0652'),
(621, 'Rancharia', 'Brazil', 'South America', 'BRXX0653'),
(622, 'Raul Soares', 'Brazil', 'South America', 'BRXX0654'),
(623, 'Remanso', 'Brazil', 'South America', 'BRXX0655'),
(624, 'Rio Bananal', 'Brazil', 'South America', 'BRXX0656'),
(625, 'Rio das Ostras', 'Brazil', 'South America', 'BRXX0657'),
(626, 'Rio Pardo de Mina', 'Brazil', 'South America', 'BRXX0658'),
(627, 'Rolim de Moura', 'Brazil', 'South America', 'BRXX0659'),
(628, 'Salinas', 'Brazil', 'South America', 'BRXX0660'),
(629, 'Salto', 'Brazil', 'South America', 'BRXX0661'),
(630, 'Salto de Pirapora', 'Brazil', 'South America', 'BRXX0662'),
(631, 'Salvaterra', 'Brazil', 'South America', 'BRXX0663'),
(632, 'Santa Cruz', 'Brazil', 'South America', 'BRXX0664'),
(633, 'Santa Leopoldina', 'Brazil', 'South America', 'BRXX0665'),
(634, 'Santa Luzia', 'Brazil', 'South America', 'BRXX0666'),
(635, 'Saquarema', 'Brazil', 'South America', 'BRXX0667'),
(636, 'Serra Negra', 'Brazil', 'South America', 'BRXX0668'),
(637, 'Soure', 'Brazil', 'South America', 'BRXX0669'),
(638, 'Suzano', 'Brazil', 'South America', 'BRXX0670'),
(639, 'Taguatinga', 'Brazil', 'South America', 'BRXX0671'),
(640, 'Taquarituba', 'Brazil', 'South America', 'BRXX0672'),
(641, 'Teodoro Sampaio', 'Brazil', 'South America', 'BRXX0673'),
(642, 'Tiradentes', 'Brazil', 'South America', 'BRXX0674'),
(643, 'Torres', 'Brazil', 'South America', 'BRXX0675'),
(644, 'Tracuateua', 'Brazil', 'South America', 'BRXX0676'),
(645, 'Trancoso', 'Brazil', 'South America', 'BRXX0677'),
(646, 'Turmalina', 'Brazil', 'South America', 'BRXX0678'),
(647, 'Valinhos', 'Brazil', 'South America', 'BRXX0679'),
(648, 'Vassouras', 'Brazil', 'South America', 'BRXX0680'),
(649, 'Vespasiano', 'Brazil', 'South America', 'BRXX0681'),
(650, 'Vinhedo', 'Brazil', 'South America', 'BRXX0682'),
(651, 'Viseu', 'Brazil', 'South America', 'BRXX0683'),
(652, 'Votorantim', 'Brazil', 'South America', 'BRXX0684'),
(653, 'New Xavantina', 'Brazil', 'South America', 'BRXX0685'),
(654, 'Acucena', 'Brazil', 'South America', 'BRXX0686'),
(655, 'Aeroporto de Conf', 'Brazil', 'South America', 'BRXX0687'),
(656, 'Aeroporto do Gale', 'Brazil', 'South America', 'BRXX0688'),
(657, 'Aluminio', 'Brazil', 'South America', 'BRXX0689'),
(658, 'Aracoiaba da Serr', 'Brazil', 'South America', 'BRXX0690'),
(659, 'Aracuai', 'Brazil', 'South America', 'BRXX0691'),
(660, 'Aragarcas', 'Brazil', 'South America', 'BRXX0692'),
(661, 'Araguacu', 'Brazil', 'South America', 'BRXX0693'),
(662, 'Augustinopolis', 'Brazil', 'South America', 'BRXX0694'),
(663, 'Bom Jesus de Itab', 'Brazil', 'South America', 'BRXX0695'),
(664, 'Brasilia de Minas', 'Brazil', 'South America', 'BRXX0696'),
(665, 'Calcoene', 'Brazil', 'South America', 'BRXX0697'),
(666, 'Campina do Monte ', 'Brazil', 'South America', 'BRXX0698'),
(667, 'Campo Limpo Pauli', 'Brazil', 'South America', 'BRXX0699'),
(668, 'Codisburgo', 'Brazil', 'South America', 'BRXX0700'),
(669, 'Colorado do Oeste', 'Brazil', 'South America', 'BRXX0701'),
(670, 'Conceicao do Arag', 'Brazil', 'South America', 'BRXX0702'),
(671, 'Coracao de Jesus', 'Brazil', 'South America', 'BRXX0703'),
(672, 'Embu-Guacu', 'Brazil', 'South America', 'BRXX0704'),
(673, 'Ferraz de Vasconc', 'Brazil', 'South America', 'BRXX0705'),
(674, 'Figueiropolis', 'Brazil', 'South America', 'BRXX0706'),
(675, 'Formoso do Aragua', 'Brazil', 'South America', 'BRXX0707'),
(676, 'Garca', 'Brazil', 'South America', 'BRXX0708'),
(677, 'Igarape-Acu', 'Brazil', 'South America', 'BRXX0709'),
(678, 'Itaguacu', 'Brazil', 'South America', 'BRXX0710'),
(679, 'Ivinhema', 'Brazil', 'South America', 'BRXX0711'),
(680, 'Joacaba', 'Brazil', 'South America', 'BRXX0712'),
(681, 'Lencois Paulista', 'Brazil', 'South America', 'BRXX0713'),
(682, 'Miracema do Tocan', 'Brazil', 'South America', 'BRXX0714'),
(683, 'Miranorte', 'Brazil', 'South America', 'BRXX0715'),
(684, 'Moji-Mirim', 'Brazil', 'South America', 'BRXX0716'),
(685, 'Novo Aripuana', 'Brazil', 'South America', 'BRXX0717'),
(686, 'Placido Castro', 'Brazil', 'South America', 'BRXX0718'),
(687, 'Santa Vitoria do ', 'Brazil', 'South America', 'BRXX0719'),
(688, 'Santana do Parnai', 'Brazil', 'South America', 'BRXX0720'),
(689, 'Sao Gabriel da Pa', 'Brazil', 'South America', 'BRXX0721'),
(690, 'Sao Joao de Merit', 'Brazil', 'South America', 'BRXX0722'),
(691, 'Sao Lourenco da S', 'Brazil', 'South America', 'BRXX0723'),
(692, 'Tangara da Serra', 'Brazil', 'South America', 'BRXX0724'),
(693, 'Tres Coracoes', 'Brazil', 'South America', 'BRXX0725'),
(694, 'Vera', 'Brazil', 'South America', 'BRXX0726'),
(695, 'Cariacica', 'Brazil', 'South America', 'BRXX0727'),
(696, 'Iuna', 'Brazil', 'South America', 'BRXX0728'),
(697, 'Santa Teresa', 'Brazil', 'South America', 'BRXX0729'),
(698, 'Amapa', 'Brazil', 'South America', 'BRXX0730'),
(699, 'Icoraci', 'Brazil', 'South America', 'BRXX0731'),
(700, 'Guanambi', 'Brazil', 'South America', 'BRXX0732'),
(701, 'Itaparica', 'Brazil', 'South America', 'BRXX0733'),
(702, 'Santa Cruz Cabral', 'Brazil', 'South America', 'BRXX0734'),
(703, 'Abreu e Lima', 'Brazil', 'South America', 'BRXX0735'),
(704, 'Camaragibe', 'Brazil', 'South America', 'BRXX0736');

-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_eweather_prefs`
--

CREATE TABLE IF NOT EXISTS `jos_eweather_prefs` (
  `id` int(11) NOT NULL auto_increment,
  `region` varchar(100) NOT NULL default '',
  `country` varchar(100) NOT NULL default '',
  `loc_id` varchar(5) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=275 ;

--
-- Extraindo dados da tabela `jos_eweather_prefs`
--

INSERT INTO `jos_eweather_prefs` (`id`, `region`, `country`, `loc_id`) VALUES
(1, 'Africa', 'Algeria', 'AGXX'),
(2, 'Africa', 'Angola', 'AOXX'),
(3, 'Africa', 'Ascension Islands', 'SHXX'),
(4, 'Africa', 'Benin', 'BNXX'),
(5, 'Africa', 'Botswana', 'BCXX'),
(6, 'Africa', 'Burkina Faso', 'UVXX'),
(7, 'Africa', 'Burundi', 'BYXX'),
(8, 'Africa', 'Cameroon', 'CMXX'),
(9, 'Africa', 'Canary Islands', 'SPXX'),
(10, 'Africa', 'Central African Republic', 'CTXX'),
(11, 'Africa', 'Chad', 'CDXX'),
(12, 'Africa', 'Comoros', 'CNXX'),
(13, 'Africa', 'Congo', 'CGXX'),
(14, 'Africa', 'Djibouti', 'DJXX'),
(15, 'Africa', 'Egypt', 'EGXX'),
(16, 'Africa', 'Equatorial Guinea', 'EKXX'),
(17, 'Africa', 'Eritrea', 'ERXX'),
(18, 'Africa', 'Ethiopia', 'ETXX'),
(19, 'Africa', 'Gabon', 'GBXX'),
(20, 'Africa', 'Ghana', 'GHXX'),
(21, 'Africa', 'Guinea', 'GVXX'),
(22, 'Africa', 'Guinea-Bissau', 'PUXX'),
(23, 'Africa', 'Ivory Coast', 'IVXX'),
(24, 'Africa', 'Kenya', 'KEXX'),
(25, 'Africa', 'Lesotho', 'LTXX'),
(26, 'Africa', 'Liberia', 'LIXX'),
(27, 'Africa', 'Libya', 'LYXX'),
(28, 'Africa', 'Madagascar', 'MAXX'),
(29, 'Africa', 'Malawi', 'MIXX'),
(30, 'Africa', 'Mali', 'MLXX'),
(31, 'Africa', 'Marocco', 'MOXX'),
(32, 'Africa', 'Mauritania', 'MRXX'),
(33, 'Africa', 'Mauritius', 'MPXX'),
(34, 'Africa', 'Mozambique', 'MZXX'),
(35, 'Africa', 'Namibia', 'WAXX'),
(36, 'Africa', 'Nigeria', 'NIXX'),
(37, 'Africa', 'Reunion Islands', 'REXX'),
(38, 'Africa', 'Rwanda', 'RWXX'),
(39, 'Africa', 'Sao Tome and Principe', 'TPXX'),
(40, 'Africa', 'Senegal', 'SGXX'),
(41, 'Africa', 'Seychelles', 'SEXX'),
(42, 'Africa', 'Sierra Leone', 'SLXX'),
(43, 'Africa', 'Somalia', 'SOXX'),
(44, 'Africa', 'South Africa', 'SFXX'),
(45, 'Africa', 'St. Helena', 'SHXX'),
(46, 'Africa', 'Sudan', 'SUX'),
(47, 'Africa', 'Swaziland', 'WZXX'),
(48, 'Africa', 'Tanzania', 'TZXX'),
(49, 'Africa', 'The Gambia', 'GAXX'),
(50, 'Africa', 'Togo', 'TOXX'),
(51, 'Africa', 'Tunisia', 'TSXX'),
(52, 'Africa', 'Uganda', 'UGXX'),
(53, 'Africa', 'Zaire', ''),
(54, 'Africa', 'Zambia', 'ZAXX'),
(55, 'Africa', 'Zimbabwe', 'ZIXX'),
(56, 'Asia', 'Afghanistan', 'AFXX'),
(57, 'Asia', 'Armenia', 'AMXX'),
(58, 'Asia', 'Azerbaijan', 'AJXX'),
(59, 'Asia', 'Baharain', 'BAXX'),
(60, 'Asia', 'Bangladesh', 'BGXX'),
(61, 'Asia', 'Bhutan', 'BTXX'),
(62, 'Asia', 'Brunei', 'BXXX'),
(63, 'Asia', 'Cambodia', ''),
(64, 'Asia', 'China', ''),
(65, 'Asia', 'Georgia', ''),
(66, 'Asia', 'India', ''),
(67, 'Asia', 'Indian Ocean Islands', ''),
(68, 'Asia', 'Indonesia', 'IDXX'),
(69, 'Asia', 'Japan', ''),
(70, 'Asia', 'Kazakhstan', ''),
(71, 'Asia', 'Kyrgyzstan', ''),
(72, 'Asia', 'Laos', ''),
(73, 'Asia', 'Macao', ''),
(74, 'Asia', 'Malaysia', ''),
(75, 'Asia', 'Maldives', 'MVXX'),
(76, 'Asia', 'Mongolia', ''),
(77, 'Asia', 'Myanmar', ''),
(78, 'Asia', 'Nepal', 'NPXX'),
(79, 'Asia', 'North Korea', ''),
(80, 'Asia', 'Oman', ''),
(81, 'Asia', 'Pakistan', ''),
(82, 'Asia', 'Philippines', ''),
(83, 'Asia', 'Phillipines', ''),
(84, 'Asia', 'Qatar', 'QAXX'),
(85, 'Asia', 'Russia', ''),
(86, 'Asia', 'Singapore', ''),
(87, 'Asia', 'South Korea', ''),
(88, 'Asia', 'Sri Lanka', ''),
(89, 'Asia', 'Taiwan', ''),
(90, 'Asia', 'Tajikistan', ''),
(91, 'Asia', 'Thailand', ''),
(92, 'Asia', 'Turkmenistan', ''),
(93, 'Asia', 'Uzbekistan', ''),
(94, 'Asia', 'Vietnam', ''),
(95, 'Australia/New Zealand', 'Australia', ''),
(96, 'Australia/New Zealand', 'New Zealand', ''),
(97, 'Canada', 'Canada', 'CAXX'),
(98, 'Caribbean', 'Antigua', ''),
(99, 'Caribbean', 'Aruba', ''),
(100, 'Caribbean', 'Bahamas', ''),
(101, 'Caribbean', 'Barbados', ''),
(102, 'Caribbean', 'Bonaire', ''),
(103, 'Caribbean', 'Caymen Islands', ''),
(104, 'Caribbean', 'Cuba', ''),
(105, 'Caribbean', 'Curacao', ''),
(106, 'Caribbean', 'Dominican Republic', ''),
(107, 'Caribbean', 'Guadaloupe', 'GPXX'),
(108, 'Caribbean', 'Haiti', 'HAXX'),
(109, 'Caribbean', 'Jamaica', 'JMXX'),
(110, 'Caribbean', 'Martinique', 'MBXX'),
(111, 'Caribbean', 'Puerto Rico', ''),
(112, 'Caribbean', 'St. Barthelemy', ''),
(113, 'Caribbean', 'St. Kitts and Nevis', ''),
(114, 'Caribbean', 'St. Lucia', ''),
(115, 'Caribbean', 'St. Maarten', ''),
(116, 'Caribbean', 'St. Martin', ''),
(117, 'Caribbean', 'St. Vincent and Grenadines', ''),
(118, 'Caribbean', 'Trinidad and Tobago', ''),
(119, 'Caribbean', 'Virgin Islands (U.S.)', ''),
(120, 'Central America', 'Anguilla', 'AVXX'),
(121, 'Central America', 'Belize', 'BHXX'),
(122, 'Central America', 'Bermuda', 'BDXX'),
(123, 'Central America', 'Costa Rica', ''),
(124, 'Central America', 'Dominica', 'DOXX'),
(125, 'Central America', 'El Salvador', 'ESXX'),
(126, 'Central America', 'Grenada', 'GJXX'),
(127, 'Central America', 'Guatemala', ''),
(128, 'Central America', 'Honduras', ''),
(129, 'Central America', 'Mexico', ''),
(130, 'Central America', 'Montserrat', 'RPXX'),
(131, 'Central America', 'Nicaragua', 'NUXX'),
(132, 'Central America', 'Panama', 'PMXX'),
(133, 'Central America', 'Tortola', ''),
(134, 'Central America', 'Turk Islands', ''),
(135, 'East Europe', 'Albania', ''),
(136, 'East Europe', 'Belarus', ''),
(137, 'East Europe', 'Bosnia', ''),
(138, 'East Europe', 'Bulgaria', ''),
(139, 'East Europe', 'Croatia', ''),
(140, 'East Europe', 'Czech Republic', 'EZXX'),
(141, 'East Europe', 'Estonia', ''),
(142, 'East Europe', 'Finland', 'FIXX'),
(143, 'East Europe', 'Greece', 'GRXX'),
(144, 'East Europe', 'Hungary', 'HUXX'),
(145, 'East Europe', 'Latvia', ''),
(146, 'East Europe', 'Lithuania', ''),
(147, 'East Europe', 'Macedonia', ''),
(148, 'East Europe', 'Moldova', ''),
(149, 'East Europe', 'Poland', 'PLXX'),
(150, 'East Europe', 'Romania', ''),
(151, 'East Europe', 'Serbia', ''),
(152, 'East Europe', 'Slovakia', ''),
(153, 'East Europe', 'Slovenia', ''),
(154, 'East Europe', 'Ukraine', ''),
(155, 'Middle East', 'Cyprus', ''),
(156, 'Middle East', 'Iran', ''),
(157, 'Middle East', 'Iraq', ''),
(158, 'Middle East', 'Israel', ''),
(159, 'Middle East', 'Jordan', ''),
(160, 'Middle East', 'Kuwait', ''),
(161, 'Middle East', 'Lebanon', ''),
(162, 'Middle East', 'Saudi Arabia', ''),
(163, 'Middle East', 'Syria', ''),
(164, 'Middle East', 'Turkey', 'TUXX'),
(165, 'Middle East', 'United Arab Emirates', 'AEXX'),
(166, 'Middle East', 'Yemen', ''),
(167, 'South America', 'Argentina', ''),
(168, 'South America', 'Bolivia', ''),
(169, 'South America', 'Brazil', 'BRXX'),
(170, 'South America', 'Chile', ''),
(171, 'South America', 'Colombia', ''),
(172, 'South America', 'Ecuador', ''),
(173, 'South America', 'Falkland Islands', 'FKXX'),
(174, 'South America', 'French Guiana', 'CAYX'),
(175, 'South America', 'Guyana', 'GYXX'),
(176, 'South America', 'Paraguay', ''),
(177, 'South America', 'Peru', ''),
(178, 'South America', 'Suriname', 'NSXX'),
(179, 'South America', 'Uruguay', ''),
(180, 'South America', 'Venezuela', ''),
(181, 'United States', 'USA Alabama', 'USAL'),
(182, 'United States', 'USA Alaska', 'USAK'),
(183, 'United States', 'USA Arizona', 'USAZ'),
(184, 'United States', 'USA Arkansas', 'USAR'),
(185, 'United States', 'USA California', 'USCA'),
(186, 'United States', 'USA Colorado', 'USCO'),
(187, 'United States', 'USA Connecticut', 'USCT'),
(188, 'United States', 'USA DC', 'USDC'),
(189, 'United States', 'USA Delaware', 'USDE'),
(190, 'United States', 'USA Florida', 'USFL'),
(191, 'United States', 'USA Georgia', 'USGA'),
(192, 'United States', 'USA Hawaii', 'USHI'),
(193, 'United States', 'USA Idaho', 'USID'),
(194, 'United States', 'USA Illinois', 'USIL'),
(195, 'United States', 'USA Indiana', 'USIN'),
(196, 'United States', 'USA Iowa', 'USIA'),
(197, 'United States', 'USA Kansas', 'USKS'),
(198, 'United States', 'USA Kentucky', 'USKY'),
(199, 'United States', 'USA Louisiana', 'USLA'),
(200, 'United States', 'USA Maine', 'USME'),
(201, 'United States', 'USA Maryland', 'USMD'),
(202, 'United States', 'USA Massachusetts', 'USMA'),
(203, 'United States', 'USA Michigan', 'USMI'),
(204, 'United States', 'USA Minnesota', 'USMN'),
(205, 'United States', 'USA Mississippi', 'USMS'),
(206, 'United States', 'USA Missouri', 'USMO'),
(207, 'United States', 'USA Montana', 'USMT'),
(208, 'United States', 'USA Nebraska', 'USNE'),
(209, 'United States', 'USA Nevada', 'USNV'),
(210, 'United States', 'USA New Hampshire', 'USNH'),
(211, 'United States', 'USA New Jersey', 'USNJ'),
(212, 'United States', 'USA New Mexico', 'USNM'),
(213, 'United States', 'USA New York', 'USNY'),
(214, 'United States', 'USA North Carolina', 'USNC'),
(215, 'United States', 'USA North Dakota', 'USND'),
(216, 'United States', 'USA Ohio', 'USOH'),
(217, 'United States', 'USA Oklahoma', 'USOK'),
(218, 'United States', 'USA Oregon', 'USOR'),
(219, 'United States', 'USA Pennsylvania', 'USPA'),
(220, 'United States', 'USA Rhodeisland', 'USRI'),
(221, 'United States', 'USA South Carolina', 'USSC'),
(222, 'United States', 'USA South Dakota', 'USSD'),
(223, 'United States', 'USA Tennessee', 'USTN'),
(224, 'United States', 'USA Texas', 'USTX'),
(225, 'United States', 'USA Utah', 'USUT'),
(226, 'United States', 'USA Vermont', 'USVT'),
(227, 'United States', 'USA Virginia', 'USVA'),
(228, 'United States', 'USA Washington', 'USWA'),
(229, 'United States', 'USA West Virginia', 'USWV'),
(230, 'United States', 'USA Wisconsin', 'USWI'),
(231, 'United States', 'USA Wyoming', 'USWY'),
(232, 'West Europe', 'Andorra', ''),
(233, 'West Europe', 'Austria', 'AUXX'),
(234, 'West Europe', 'Azores', ''),
(235, 'West Europe', 'Belgium', 'BEXX'),
(236, 'West Europe', 'Cape Verde', 'CVXX'),
(237, 'West Europe', 'Denmark', 'DAXX'),
(238, 'West Europe', 'France', 'FRXX'),
(239, 'West Europe', 'Germany', 'GMXX'),
(240, 'West Europe', 'Greenland', ''),
(241, 'West Europe', 'Iceland', ''),
(242, 'West Europe', 'Ireland', 'EIXX'),
(243, 'West Europe', 'Italy', 'ITXX'),
(244, 'West Europe', 'Liechtenstein', 'LSXX'),
(245, 'West Europe', 'Luxembourg', 'LUXX'),
(246, 'West Europe', 'Madeira Islands', ''),
(247, 'West Europe', 'Malta', 'MTXX'),
(248, 'West Europe', 'Monaco', ''),
(249, 'West Europe', 'Netherlands', 'NLXX'),
(250, 'West Europe', 'Norway', 'NOXX'),
(251, 'West Europe', 'Portugal', 'POXX'),
(252, 'West Europe', 'Spain', 'SPXX'),
(253, 'West Europe', 'Sweden', 'SWXX'),
(254, 'West Europe', 'Switzerland', 'SZXX'),
(255, 'West Europe', 'United Kingdom', 'UKXX'),
(256, 'West Europe', 'Vatican City', ''),
(257, 'Pacific Islands', 'Cook Islands', ''),
(258, 'Pacific Islands', 'Fiji', ''),
(259, 'Pacific Islands', 'French Polynesia', 'FPXX'),
(260, 'Pacific Islands', 'Guam', ''),
(261, 'Pacific Islands', 'Kiribati', ''),
(262, 'Pacific Islands', 'Marshall Islands', ''),
(263, 'Pacific Islands', 'Micronesia', ''),
(264, 'Pacific Islands', 'Nauru', ''),
(265, 'Pacific Islands', 'New Caledonia', ''),
(266, 'Pacific Islands', 'Palau', ''),
(267, 'Pacific Islands', 'Papua New Guinea', ''),
(268, 'Pacific Islands', 'Solomon Islands', ''),
(269, 'Pacific Islands', 'Tonga', ''),
(270, 'Pacific Islands', 'Tuvalu', ''),
(271, 'Pacific Islands', 'Vanuatu', ''),
(272, 'Pacific Islands', 'Western Samoa', ''),
(273, 'Antarctica', 'Antarctica', ''),
(274, 'Africa', 'Niger', 'NGXX');

-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_eweather_profiles`
--

CREATE TABLE IF NOT EXISTS `jos_eweather_profiles` (
  `id` int(11) NOT NULL auto_increment,
  `uid` varchar(10) NOT NULL default '',
  `locid` varchar(15) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Extraindo dados da tabela `jos_eweather_profiles`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_google_maps`
--

CREATE TABLE IF NOT EXISTS `jos_google_maps` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(100) NOT NULL default '',
  `address` text,
  `suburb` varchar(50) NOT NULL default '',
  `state` varchar(20) NOT NULL default '',
  `country` varchar(50) NOT NULL default '',
  `postcode` varchar(10) NOT NULL default '',
  `misc` text,
  `lat` double default NULL,
  `lng` double default NULL,
  `polyColor` varchar(10) NOT NULL default '',
  `polyWidth` varchar(10) NOT NULL default '',
  `draggable` tinyint(1) NOT NULL default '0',
  `markerType` tinyint(1) NOT NULL default '1',
  `params` text,
  `published` tinyint(1) NOT NULL default '0',
  `checked_out` int(11) NOT NULL,
  `checked_out_time` int(11) NOT NULL,
  `ordering` int(11) NOT NULL,
  `catid` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `access` tinyint(3) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Extraindo dados da tabela `jos_google_maps`
--

INSERT INTO `jos_google_maps` (`id`, `name`, `address`, `suburb`, `state`, `country`, `postcode`, `misc`, `lat`, `lng`, `polyColor`, `polyWidth`, `draggable`, `markerType`, `params`, `published`, `checked_out`, `checked_out_time`, `ordering`, `catid`, `user_id`, `access`, `date`) VALUES
(1, 'Núcleo do Evento', 'R. Santo Agostinho', 'Joinville', 'Santa Catarina', 'Brazil', '89207-650', '', -26.320499, -48.84301, '', '', 0, 1, '', 1, 0, 0, 1, 13, 62, 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_google_maps_conf`
--

CREATE TABLE IF NOT EXISTS `jos_google_maps_conf` (
  `id` tinyint(4) NOT NULL default '1',
  `mapWidth` varchar(10) NOT NULL default '99%',
  `mapHeight` varchar(10) NOT NULL default '450px',
  `mapBorder` text,
  `zoomLevel` tinyint(1) NOT NULL default '4',
  `APIKey` varchar(100) NOT NULL default '[Enter your API Key here]',
  `title` text,
  `misc` text,
  `centerId` int(11) default '0',
  `centerLat` double default '40.748442',
  `centerLng` double default '-73.984721',
  `autoOpen` tinyint(1) NOT NULL default '0',
  `showScale` tinyint(1) NOT NULL default '1',
  `showZoom` tinyint(1) NOT NULL default '1',
  `whichZoom` tinyint(1) NOT NULL default '1',
  `showType` tinyint(1) NOT NULL default '1',
  `whichType` tinyint(1) NOT NULL default '1',
  `contZoom` tinyint(1) NOT NULL default '0',
  `doubleclickZoom` tinyint(1) NOT NULL default '0',
  `reqAd` tinyint(1) NOT NULL default '0',
  `reqCt` tinyint(1) NOT NULL default '0',
  `reqSt` tinyint(1) NOT NULL default '0',
  `reqZp` tinyint(1) NOT NULL default '0',
  `reqCn` tinyint(1) NOT NULL default '0',
  `reqLl` tinyint(1) NOT NULL default '0',
  `tooltip` int(11) NOT NULL default '0',
  `pdMarkers` text,
  `geocode` tinyint(1) NOT NULL default '1',
  `sideTitle` text,
  `sideStyle` text,
  `sideNum` int(11) NOT NULL default '5',
  `sideShowcat` tinyint(1) NOT NULL default '1',
  `sideShowtitle` tinyint(1) NOT NULL default '1',
  `autoApprove` tinyint(1) NOT NULL default '0',
  `communityEnable` tinyint(1) NOT NULL default '0',
  `communityHidereal` tinyint(1) NOT NULL default '0',
  `communityLimit` int(11) NOT NULL default '125',
  `communityIcon` int(11) NOT NULL default '0',
  `catSep` varchar(1) NOT NULL default ',',
  `xmlEncoding` varchar(20) NOT NULL default 'ISO-8859-1',
  `xmlUrl` tinyint(1) NOT NULL default '0',
  `xmlCache` int(11) NOT NULL default '-1',
  `editBodytag` int(11) NOT NULL default '0',
  `safariCompat` tinyint(1) NOT NULL default '0',
  `overviewWidth` int(11) NOT NULL default '200',
  `overviewHeight` int(11) NOT NULL default '200',
  `overviewEnable` tinyint(1) NOT NULL default '0',
  `mappingAPI` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `jos_google_maps_conf`
--

INSERT INTO `jos_google_maps_conf` (`id`, `mapWidth`, `mapHeight`, `mapBorder`, `zoomLevel`, `APIKey`, `title`, `misc`, `centerId`, `centerLat`, `centerLng`, `autoOpen`, `showScale`, `showZoom`, `whichZoom`, `showType`, `whichType`, `contZoom`, `doubleclickZoom`, `reqAd`, `reqCt`, `reqSt`, `reqZp`, `reqCn`, `reqLl`, `tooltip`, `pdMarkers`, `geocode`, `sideTitle`, `sideStyle`, `sideNum`, `sideShowcat`, `sideShowtitle`, `autoApprove`, `communityEnable`, `communityHidereal`, `communityLimit`, `communityIcon`, `catSep`, `xmlEncoding`, `xmlUrl`, `xmlCache`, `editBodytag`, `safariCompat`, `overviewWidth`, `overviewHeight`, `overviewEnable`, `mappingAPI`) VALUES
(1, '99%', '450px', '1px solid lightblue', 17, 'ABQIAAAAnDabREt3ufSAcfwHgj8goBQiNMZB3lpRrIq_EazjhUEbDywPsxQyduWrHespJIt0tpRPm_EITsVipw', '<img src="http://www.nucleodoevento.com.br/images/icones/mapa.png"  hspace="6" alt="Image" />&nbsp;<h3>Mapa Escritório Núcleo do Evento!</h3>', '<br/><br/>', -1, -26.31965, -48.82629, 1, 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 1, 'Locations', '', 5, 1, 0, 0, 0, 0, 125, 0, ',', 'ISO-8859-1', 0, -1, 0, 0, 200, 200, 1, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_groups`
--

CREATE TABLE IF NOT EXISTS `jos_groups` (
  `id` tinyint(3) unsigned NOT NULL default '0',
  `name` varchar(50) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `jos_groups`
--

INSERT INTO `jos_groups` (`id`, `name`) VALUES
(0, 'Public'),
(1, 'Registered'),
(2, 'Special');

-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_joomap`
--

CREATE TABLE IF NOT EXISTS `jos_joomap` (
  `version` varchar(255) default NULL,
  `classname` varchar(255) default NULL,
  `expand_category` int(11) default NULL,
  `expand_section` int(11) default NULL,
  `show_menutitle` int(11) default NULL,
  `columns` int(11) default NULL,
  `exlinks` int(11) default NULL,
  `ext_image` varchar(255) default NULL,
  `menus` text,
  `exclmenus` varchar(255) default NULL,
  `includelink` int(11) default NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `jos_joomap`
--

INSERT INTO `jos_joomap` (`version`, `classname`, `expand_category`, `expand_section`, `show_menutitle`, `columns`, `exlinks`, `ext_image`, `menus`, `exclmenus`, `includelink`) VALUES
('2.0', 'sitemap', 1, 1, 1, 1, 1, 'img_grey.gif', 'mainmenu,0,1\nothermenu,1,1', '', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_mambots`
--

CREATE TABLE IF NOT EXISTS `jos_mambots` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(100) NOT NULL default '',
  `element` varchar(100) NOT NULL default '',
  `folder` varchar(100) NOT NULL default '',
  `access` tinyint(3) unsigned NOT NULL default '0',
  `ordering` int(11) NOT NULL default '0',
  `published` tinyint(3) NOT NULL default '0',
  `iscore` tinyint(3) NOT NULL default '0',
  `client_id` tinyint(3) NOT NULL default '0',
  `checked_out` int(11) unsigned NOT NULL default '0',
  `checked_out_time` datetime NOT NULL default '0000-00-00 00:00:00',
  `params` text NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `idx_folder` (`published`,`client_id`,`access`,`folder`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Extraindo dados da tabela `jos_mambots`
--

INSERT INTO `jos_mambots` (`id`, `name`, `element`, `folder`, `access`, `ordering`, `published`, `iscore`, `client_id`, `checked_out`, `checked_out_time`, `params`) VALUES
(1, 'MOS Image', 'mosimage', 'content', 0, -10000, 1, 1, 0, 0, '0000-00-00 00:00:00', ''),
(2, 'MOS Pagination', 'mospaging', 'content', 0, 10000, 1, 1, 0, 0, '0000-00-00 00:00:00', ''),
(3, 'Legacy Mambot Includer', 'legacybots', 'content', 0, 2, 0, 1, 0, 0, '0000-00-00 00:00:00', ''),
(4, 'SEF', 'mossef', 'content', 0, 4, 1, 0, 0, 0, '0000-00-00 00:00:00', ''),
(5, 'MOS Rating', 'mosvote', 'content', 0, 5, 1, 1, 0, 0, '0000-00-00 00:00:00', ''),
(6, 'Search Content', 'content.searchbot', 'search', 0, 1, 1, 1, 0, 0, '0000-00-00 00:00:00', ''),
(7, 'Search Weblinks', 'weblinks.searchbot', 'search', 0, 2, 1, 1, 0, 0, '0000-00-00 00:00:00', ''),
(8, 'Code support', 'moscode', 'content', 0, 3, 0, 0, 0, 0, '0000-00-00 00:00:00', ''),
(9, 'No WYSIWYG Editor', 'none', 'editors', 0, 0, 1, 1, 0, 0, '0000-00-00 00:00:00', ''),
(10, 'TinyMCE WYSIWYG Editor', 'tinymce', 'editors', 0, 0, 1, 1, 0, 0, '0000-00-00 00:00:00', 'theme=advanced'),
(11, 'MOS Image Editor Button', 'mosimage.btn', 'editors-xtd', 0, 0, 1, 0, 0, 0, '0000-00-00 00:00:00', ''),
(12, 'MOS Pagebreak Editor Button', 'mospage.btn', 'editors-xtd', 0, 0, 1, 0, 0, 0, '0000-00-00 00:00:00', ''),
(13, 'Search Contacts', 'contacts.searchbot', 'search', 0, 3, 1, 1, 0, 0, '0000-00-00 00:00:00', ''),
(14, 'Search Categories', 'categories.searchbot', 'search', 0, 4, 1, 0, 0, 0, '0000-00-00 00:00:00', ''),
(15, 'Search Sections', 'sections.searchbot', 'search', 0, 5, 1, 0, 0, 0, '0000-00-00 00:00:00', ''),
(16, 'Email Cloaking', 'mosemailcloak', 'content', 0, 6, 1, 0, 0, 0, '0000-00-00 00:00:00', ''),
(17, 'GeSHi', 'geshi', 'content', 0, 7, 0, 0, 0, 0, '0000-00-00 00:00:00', ''),
(18, 'Search Newsfeeds', 'newsfeeds.searchbot', 'search', 0, 6, 1, 0, 0, 0, '0000-00-00 00:00:00', ''),
(19, 'Load Module Positions', 'mosloadposition', 'content', 0, 8, 1, 0, 0, 0, '0000-00-00 00:00:00', ''),
(20, 'JoomlaTinyFCK', 'jtf', 'editors', 0, 0, 1, 0, 0, 0, '0000-00-00 00:00:00', ''),
(21, 'Google Maps', 'plugin_googlemap2', 'content', 0, 1, 1, 0, 0, 0, '0000-00-00 00:00:00', 'publ=0\nGoogle_API_key=ABQIAAAAnDabREt3ufSAcfwHgj8goBQiNMZB3lpRrIq_EazjhUEbDywPsxQyduWrHespJIt0tpRPm_EITsVipw\nGoogle_Multi_API_key=\nwidth=100%\nheight=400px\nlat=52.075581\nlon=4.541513\nzoom=17\nzoomType=Small\nzoomNew=0\nzoomWheel=0\nmapType=Normal\nshowMaptype=1\noverview=0\nmarker=1\ndir=0\ntxtdir=Directions:\ntxtgetdir=Get Directions\ntxtfrom=From here\ntxtto=To here\ntxtdiraddr=Address:\ngotoaddr=0\ntxtaddr=Address: ##\nerraddr=Address ## not found!\nalign=center\nlangtype=site\nlang='),
(22, 'VisualRecommentBot', 'visualrecommendbot', 'content', 0, 0, 1, 0, 0, 0, '0000-00-00 00:00:00', ''),
(23, 'mosproductsnap', 'mosproductsnap', 'content', 0, 0, 0, 0, 0, 0, '0000-00-00 00:00:00', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_mblto_bancos`
--

CREATE TABLE IF NOT EXISTS `jos_mblto_bancos` (
  `bnid` smallint(3) unsigned NOT NULL auto_increment,
  `layout` varchar(40) NOT NULL default '',
  `nome` varchar(20) NOT NULL default '',
  `codigo` int(4) unsigned NOT NULL default '0',
  `uso_do_banco` varchar(50) NOT NULL default '',
  PRIMARY KEY  (`bnid`),
  UNIQUE KEY `nome` (`nome`),
  KEY `bnid` (`bnid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Extraindo dados da tabela `jos_mblto_bancos`
--

INSERT INTO `jos_mblto_bancos` (`bnid`, `layout`, `nome`, `codigo`, `uso_do_banco`) VALUES
(1, 'class.banco.bradesco.php', 'Bradesco', 237, ''),
(2, 'class.banco.santander.php', 'Santander', 353, ''),
(3, 'class.banco.cef.php', 'Caixa Econ. Federal', 104, ''),
(4, 'class.banco.bancodobrasil.php', 'Banco do Brasil', 1, ''),
(5, 'class.banco.itau.php', 'Banco Itaú S.A.', 341, ''),
(6, 'class.banco.banrisul.php', 'BANRISUL', 41, '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_mblto_boletos`
--

CREATE TABLE IF NOT EXISTS `jos_mblto_boletos` (
  `bid` int(4) unsigned NOT NULL auto_increment,
  `bnid` int(4) unsigned NOT NULL default '0',
  `cid` int(4) unsigned NOT NULL default '0',
  `titulo` varchar(30) NOT NULL default '',
  `agencia` varchar(10) NOT NULL default '',
  `agencia_dig` char(2) default NULL,
  `cedente` varchar(255) NOT NULL default '',
  `conta_cedente` varchar(20) NOT NULL default '',
  `conta_cedente_dig` char(2) default NULL,
  `especie_documento` varchar(10) NOT NULL default '',
  `codigo` varchar(40) NOT NULL default '',
  `local_pagamento` varchar(255) NOT NULL default '',
  `carteira` varchar(30) NOT NULL default '',
  `instrucoes_linha1` varchar(100) NOT NULL default '',
  `instrucoes_linha2` varchar(100) NOT NULL default '',
  `instrucoes_linha3` varchar(100) NOT NULL default '',
  `instrucoes_linha4` varchar(100) NOT NULL default '',
  `instrucoes_linha5` varchar(100) NOT NULL default '',
  `demons1` varchar(100) default NULL,
  `demons2` varchar(100) default NULL,
  `demons3` varchar(100) default NULL,
  `demons4` varchar(100) default NULL,
  `convenio` varchar(15) default NULL,
  PRIMARY KEY  (`bid`),
  UNIQUE KEY `titulo` (`titulo`),
  KEY `cid` (`cid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Extraindo dados da tabela `jos_mblto_boletos`
--

INSERT INTO `jos_mblto_boletos` (`bid`, `bnid`, `cid`, `titulo`, `agencia`, `agencia_dig`, `cedente`, `conta_cedente`, `conta_cedente_dig`, `especie_documento`, `codigo`, `local_pagamento`, `carteira`, `instrucoes_linha1`, `instrucoes_linha2`, `instrucoes_linha3`, `instrucoes_linha4`, `instrucoes_linha5`, `demons1`, `demons2`, `demons3`, `demons4`, `convenio`) VALUES
(3, 1, 1, 'Boleto Bradesco', '1234', '1', 'NOME DE SUA EMPRESA', '12345678', '0', 'R$', '1', 'Preferencialmente no Banco Bradesco', '06', 'O PAGAMENTO PODE SER EFETUADO EM QUALQUER AGÊNCIA DA REDE BANCÁRIA OU LOTÉRICA ATÉ O VENCIMENTO.', '', '', '', '', 'Seu pedido será encaminhado após a confirmação de pagamento deste Boleto Bancário.', '', 'Consulte seu pedido em http://www.seusite.com.br', '', '123456'),
(4, 2, 1, 'Boleto Santander', '1234', '1', 'NOME DE SUA EMPRESA', '12345678', '0', 'R$', '1', 'Preferencialmente no Banco Santander', 'COB', 'O PAGAMENTO PODE SER EFETUADO EM QUALQUER AGÊNCIA DA REDE BANCÁRIA OU LOTÉRICA ATÉ O VENCIMENTO.', '', '', '', '', 'Seu pedido será encaminhado após a confirmação de pagamento deste Boleto Bancário.', '', 'Consulte seu pedido em http://www.seusite.com.br', '', '123456'),
(5, 3, 1, 'Boleto CEF', '1234', '1', 'NOME DE SUA EMPRESA', '12345678', '0', 'R$', '1', 'Preferencialmente na Caixa Economica Federal', 'SR', 'O PAGAMENTO PODE SER EFETUADO EM QUALQUER AGÊNCIA DA REDE BANCÁRIA OU LOTÉRICA ATÉ O VENCIMENTO.', '', '', '', '', 'Seu pedido será encaminhado após a confirmação de pagamento deste Boleto Bancário.', '', 'Consulte seu pedido em http://www.seusite.com.br', '', '123456'),
(6, 4, 1, 'Boleto BB', '1234', '1', 'NOME DE SUA EMPRESA', '12345678', 'x', 'R$', '1', 'Preferencialmente no Banco do Brasil', '18', 'O PAGAMENTO PODE SER EFETUADO EM QUALQUER AGÊNCIA DA REDE BANCÁRIA OU LOTÉRICA ATÉ O VENCIMENTO.', '', '', '', '', 'Seu pedido será encaminhado após a confirmação de pagamento deste Boleto Bancário.', '', 'Consulte seu pedido em http://www.seusite.com.br', '', '123456'),
(7, 5, 1, 'Boleto Itaú', '1234', '1', 'NOME DE SUA EMPRESA', '12345678', '6', 'R$', '1', 'Preferencialmente no Banco Itaú', '175', 'O PAGAMENTO PODE SER EFETUADO EM QUALQUER AGÊNCIA DA REDE BANCÁRIA OU LOTÉRICA ATÉ O VENCIMENTO.', '', '', '', '', 'Seu pedido será encaminhado após a confirmação de pagamento deste Boleto Bancário.', '', 'Consulte seu pedido em http://www.seusite.com.br', '', '123456'),
(8, 6, 1, 'Boleto Banrisul', '1234', '1', 'NOME DE SUA EMPRESA', '12345678', '6', 'R$', '1', 'Preferencialmente no Banrisul', 'DM', 'O PAGAMENTO PODE SER EFETUADO EM QUALQUER AGÊNCIA DA REDE BANCÁRIA OU LOTÉRICA ATÉ O VENCIMENTO.', '', '', '', '', 'Seu pedido será encaminhado após a confirmação de pagamento deste Boleto Bancário.', '', 'Consulte seu pedido em http://www.seusite.com.br', '', '123456');

-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_mblto_config`
--

CREATE TABLE IF NOT EXISTS `jos_mblto_config` (
  `cid` smallint(3) unsigned NOT NULL auto_increment,
  `titulo` varchar(30) NOT NULL default '',
  `enviar_email` tinyint(1) unsigned NOT NULL default '0',
  `remetente` varchar(50) NOT NULL default '',
  `remetente_email` varchar(255) NOT NULL default '',
  `assunto` varchar(50) NOT NULL default '',
  `servidor_smtp` varchar(80) NOT NULL default '',
  `servidor_http` varchar(80) NOT NULL default '',
  `imagem_tipo` varchar(4) NOT NULL default '',
  `usar_truetype` tinyint(1) unsigned NOT NULL default '1',
  `enviar_pdf` tinyint(1) unsigned NOT NULL default '0',
  `mensagem_texto` longtext NOT NULL,
  `mensagem_html` longtext NOT NULL,
  PRIMARY KEY  (`cid`),
  UNIQUE KEY `titulo` (`titulo`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Extraindo dados da tabela `jos_mblto_config`
--

INSERT INTO `jos_mblto_config` (`cid`, `titulo`, `enviar_email`, `remetente`, `remetente_email`, `assunto`, `servidor_smtp`, `servidor_http`, `imagem_tipo`, `usar_truetype`, `enviar_pdf`, `mensagem_texto`, `mensagem_html`) VALUES
(1, 'Mamboleto', 0, 'Nome de sua loja', 'seu@email.com.br', 'Boleto Bancário do seu Pedido', 'smtp.mail.yahoo.com.br', 'www.seusite.com.br', 'jpg', 1, 0, 'Boleto bancário Mamboleto.', 'Boleto bancário Mamboleto.');

-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_menu`
--

CREATE TABLE IF NOT EXISTS `jos_menu` (
  `id` int(11) NOT NULL auto_increment,
  `menutype` varchar(25) default NULL,
  `name` varchar(100) default NULL,
  `link` text,
  `type` varchar(50) NOT NULL default '',
  `published` tinyint(1) NOT NULL default '0',
  `parent` int(11) unsigned NOT NULL default '0',
  `componentid` int(11) unsigned NOT NULL default '0',
  `sublevel` int(11) default '0',
  `ordering` int(11) default '0',
  `checked_out` int(11) unsigned NOT NULL default '0',
  `checked_out_time` datetime NOT NULL default '0000-00-00 00:00:00',
  `pollid` int(11) NOT NULL default '0',
  `browserNav` tinyint(4) default '0',
  `access` tinyint(3) unsigned NOT NULL default '0',
  `utaccess` tinyint(3) unsigned NOT NULL default '0',
  `params` text NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `componentid` (`componentid`,`menutype`,`published`,`access`),
  KEY `menutype` (`menutype`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=32 ;

--
-- Extraindo dados da tabela `jos_menu`
--

INSERT INTO `jos_menu` (`id`, `menutype`, `name`, `link`, `type`, `published`, `parent`, `componentid`, `sublevel`, `ordering`, `checked_out`, `checked_out_time`, `pollid`, `browserNav`, `access`, `utaccess`, `params`) VALUES
(1, 'mainmenu', 'Home', 'index.php?option=com_frontpage', 'components', 1, 0, 10, 0, 4, 0, '0000-00-00 00:00:00', 0, 0, 0, 3, 'menu_image=-1\npageclass_sfx=\nheader=Núcleo do Evento! Seu Evento em Jonville e Região\npage_title=0\nback_button=0\nleading=1\nintro=2\ncolumns=2\nlink=1\norderby_pri=\norderby_sec=front\npagination=2\npagination_results=1\nimage=1\nsection=0\nsection_link=0\ncategory=0\ncategory_link=0\nitem_title=1\nlink_titles=\nreadmore=\nrating=\nauthor=\ncreatedate=\nmodifydate=\npdf=0\nprint=0\nemail=0\nunpublished=0\nrobots=-1\nmeta_description=\nmeta_keywords=\nmeta_author='),
(2, 'mainmenu', 'Novidades', 'index.php?option=com_content&task=section&id=1', 'content_section', 1, 0, 1, 0, 5, 0, '0000-00-00 00:00:00', 0, 0, 0, 3, 'menu_image=-1\nheader=\npage_title=1\npageclass_sfx=\nback_button=\ndescription_sec=1\ndescription_sec_image=1\norderby=\nother_cat_section=1\nempty_cat_section=0\ndescription_cat=1\ndescription_cat_image=1\nother_cat=1\nempty_cat=0\ncat_items=1\ncat_description=1\ndate_format=\ndate=\nauthor=\nhits=\nheadings=1\nnavigation=1\norder_select=1\ndisplay=1\ndisplay_num=50\nfilter=1\nfilter_type=title\nunpublished=1\nrobots=-1\nmeta_description=\nmeta_keywords=\nmeta_author='),
(3, 'mainmenu', 'Contato', 'index.php?option=com_contact', 'components', 1, 0, 7, 0, 8, 0, '0000-00-00 00:00:00', 0, 0, 0, 3, 'menu_image=-1\npageclass_sfx=\nback_button=\npage_title=1\nheader=\ncatid=0\nother_cat_section=1\nother_cat=1\ncat_description=1\ncat_items=1\ndescription=1\ndescription_text=\nimage=-1\nimage_align=right\nheadings=1\nposition=1\nemail=0\ntelephone=1\nfax=1\nbannedEmail=\nbannedSubject=\nbannedText=\nrobots=-1\nsessionCheck=1\nmeta_description=\nmeta_keywords=\nmeta_author='),
(23, 'mainmenu', 'Links', 'index.php?option=com_weblinks', 'components', 0, 0, 4, 0, 7, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 'menu_image=web_links.jpg\npageclass_sfx=\nback_button=\npage_title=1\nheader=\nheadings=1\nhits=\nitem_description=1\nother_cat=1\ndescription=1\ndescription_text=\nimage=-1\nimage_align=right\nweblink_icons='),
(5, 'mainmenu', 'Busca', 'index.php?option=com_search', 'components', 1, 0, 16, 0, 9, 0, '0000-00-00 00:00:00', 0, 0, 0, 3, 'menu_image=\npageclass_sfx=\nback_button=\npage_title=1\nheader='),
(6, 'mainmenu', 'Joomla! License', 'index.php?option=com_content&task=view&id=5', 'content_typed', -2, 0, 5, 0, 3, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, ''),
(7, 'mainmenu', 'Notícias', 'index.php?option=com_newsfeeds', 'components', 0, 0, 12, 0, 10, 0, '0000-00-00 00:00:00', 0, 0, 0, 3, 'menu_image=-1\npageclass_sfx=\nback_button=\npage_title=1\nheader=\nother_cat_section=1\nother_cat=1\ncat_description=1\ncat_items=1\ndescription=1\ndescription_text=\nimage=-1\nimage_align=right\nheadings=1\nname=1\narticles=1\nlink=0\nfeed_image=1\nfeed_descr=1\nitem_descr=1\nword_count=0\nrobots=-1\nmeta_description=\nmeta_keywords=\nmeta_author='),
(8, 'mainmenu', 'Wrapper', 'index.php?option=com_wrapper', 'wrapper', -2, 0, 0, 0, 2, 0, '0000-00-00 00:00:00', 0, 0, 0, 3, 'menu_image=-1\npageclass_sfx=\nback_button=\npage_title=1\nheader=\nscrolling=auto\nwidth=100%\nheight=600\nheight_auto=0\nurl=www.joomla.org'),
(9, 'mainmenu', 'Blog', 'index.php?option=com_content&task=blogsection&id=0', 'content_blog_section', 1, 0, 0, 0, 6, 0, '0000-00-00 00:00:00', 0, 0, 0, 3, 'menu_image=-1\npageclass_sfx=\nback_button=\nheader=A blog of all sections with no images\npage_title=1\nleading=0\nintro=6\ncolumns=2\nlink=4\norderby_pri=\norderby_sec=\npagination=2\npagination_results=1\nimage=0\ndescription=0\ndescription_image=0\ncategory=0\ncategory_link=0\nitem_title=1\nlink_titles=\nreadmore=\nrating=\nauthor=\ncreatedate=\nmodifydate=\npdf=\nprint=\nemail=\nsectionid='),
(10, 'othermenu', 'Joomla! Home', 'http://www.joomla.org', 'url', 1, 0, 0, 0, 1, 0, '0000-00-00 00:00:00', 0, 0, 0, 3, ''),
(11, 'othermenu', 'Joomla! Forums', 'http://forum.joomla.org', 'url', 1, 0, 0, 0, 1, 0, '0000-00-00 00:00:00', 0, 0, 0, 3, ''),
(12, 'othermenu', 'OSM Home', 'http://www.opensourcematters.org', 'url', 1, 0, 0, 0, 1, 0, '0000-00-00 00:00:00', 0, 0, 0, 3, ''),
(24, 'othermenu', 'Administrator', 'administrator/', 'url', 1, 0, 0, 0, 3, 0, '0000-00-00 00:00:00', 0, 0, 0, 3, 'menu_image=-1'),
(21, 'usermenu', 'Your Details', 'index.php?option=com_user&task=UserDetails', 'url', 1, 0, 0, 0, 1, 0, '0000-00-00 00:00:00', 0, 0, 1, 3, ''),
(13, 'usermenu', 'Submit News', 'index.php?option=com_content&task=new&sectionid=1&Itemid=0', 'url', 1, 0, 0, 0, 2, 0, '0000-00-00 00:00:00', 0, 0, 1, 2, ''),
(14, 'usermenu', 'Submit WebLink', 'index.php?option=com_weblinks&task=new', 'url', 1, 0, 0, 0, 4, 0, '0000-00-00 00:00:00', 0, 0, 1, 2, ''),
(15, 'usermenu', 'Check-In My Items', 'index.php?option=com_user&task=CheckIn', 'url', 1, 0, 0, 0, 5, 0, '0000-00-00 00:00:00', 0, 0, 1, 2, ''),
(16, 'usermenu', 'Logout', 'index.php?option=com_login', 'components', 1, 0, 15, 0, 5, 0, '0000-00-00 00:00:00', 0, 0, 1, 3, ''),
(17, 'topmenu', 'Home', 'index.php', 'url', 1, 0, 0, 0, 1, 0, '0000-00-00 00:00:00', 0, 0, 0, 3, ''),
(18, 'topmenu', 'Contato', 'index.php?option=com_contact&Itemid=3', 'url', 1, 0, 0, 0, 2, 0, '0000-00-00 00:00:00', 0, 0, 0, 3, 'menu_image=-1'),
(19, 'topmenu', 'Notícias', 'index.php?option=com_content&task=section&id=1&Itemid=2', 'url', 1, 20, 0, 0, 1, 0, '0000-00-00 00:00:00', 0, 0, 0, 3, 'menu_image=web_links.jpg'),
(20, 'topmenu', 'Links', 'index.php?option=com_weblinks&Itemid=23', 'url', 1, 0, 0, 0, 4, 0, '0000-00-00 00:00:00', 0, 0, 0, 3, 'menu_image=-1'),
(25, 'mainmenu', 'Perguntas Frequentes', 'index.php?option=com_content&task=category&sectionid=3&id=7', 'content_category', 0, 0, 7, 0, 11, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 'menu_image=-1\nheader=\npage_title=1\npageclass_sfx=\nback_button=\ndescription_cat=1\ndescription_cat_image=1\norderby=\ndate_format=\ndate=\nauthor=\nhits=\nheadings=1\nnavigation=1\norder_select=1\ndisplay=1\ndisplay_num=50\nfilter=1\nfilter_type=title\nother_cat=1\nempty_cat=0\ncat_items=1\ncat_description=1\nunpublished=1\nrobots=-1\nmeta_description=\nmeta_keywords=\nmeta_author='),
(26, 'mainmenu', 'Mapa Do Site', 'index.php?option=com_joomap', 'components', 1, 0, 20, 0, 12, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, ''),
(27, 'mainmenu', 'Mapa', 'index.php?option=com_google_maps', 'url', 1, 0, 0, 0, 13, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 'menu_image=-1'),
(28, 'mainmenu', 'Recomende este site', 'index.php?option=com_recommend', 'components', 1, 0, 53, 0, 14, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, ''),
(29, 'mainmenu', 'Loja Virtual', 'index.php?option=com_virtuemart', 'components', 1, 0, 41, 0, 15, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, ''),
(30, 'mainmenu', 'Chat', 'index.php?option=com_blastchatc', 'components', -2, 0, 55, 0, 1, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, ''),
(31, 'mainmenu', 'Chat', 'index.php?option=com_utchat', 'components', 1, 0, 59, 0, 16, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_messages`
--

CREATE TABLE IF NOT EXISTS `jos_messages` (
  `message_id` int(10) unsigned NOT NULL auto_increment,
  `user_id_from` int(10) unsigned NOT NULL default '0',
  `user_id_to` int(10) unsigned NOT NULL default '0',
  `folder_id` int(10) unsigned NOT NULL default '0',
  `date_time` datetime NOT NULL default '0000-00-00 00:00:00',
  `state` int(11) NOT NULL default '0',
  `priority` int(1) unsigned NOT NULL default '0',
  `subject` varchar(230) NOT NULL default '',
  `message` text NOT NULL,
  PRIMARY KEY  (`message_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Extraindo dados da tabela `jos_messages`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_messages_cfg`
--

CREATE TABLE IF NOT EXISTS `jos_messages_cfg` (
  `user_id` int(10) unsigned NOT NULL default '0',
  `cfg_name` varchar(100) NOT NULL default '',
  `cfg_value` varchar(255) NOT NULL default '',
  UNIQUE KEY `idx_user_var_name` (`user_id`,`cfg_name`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `jos_messages_cfg`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_modules`
--

CREATE TABLE IF NOT EXISTS `jos_modules` (
  `id` int(11) NOT NULL auto_increment,
  `title` text NOT NULL,
  `content` text NOT NULL,
  `ordering` int(11) NOT NULL default '0',
  `position` varchar(10) default NULL,
  `checked_out` int(11) unsigned NOT NULL default '0',
  `checked_out_time` datetime NOT NULL default '0000-00-00 00:00:00',
  `published` tinyint(1) NOT NULL default '0',
  `module` varchar(50) default NULL,
  `numnews` int(11) NOT NULL default '0',
  `access` tinyint(3) unsigned NOT NULL default '0',
  `showtitle` tinyint(3) unsigned NOT NULL default '1',
  `params` text NOT NULL,
  `iscore` tinyint(4) NOT NULL default '0',
  `client_id` tinyint(4) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `published` (`published`,`access`),
  KEY `newsfeeds` (`module`,`published`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=49 ;

--
-- Extraindo dados da tabela `jos_modules`
--

INSERT INTO `jos_modules` (`id`, `title`, `content`, `ordering`, `position`, `checked_out`, `checked_out_time`, `published`, `module`, `numnews`, `access`, `showtitle`, `params`, `iscore`, `client_id`) VALUES
(1, 'Enquete', '', 1, 'right', 0, '0000-00-00 00:00:00', 1, 'mod_poll', 0, 0, 1, 'cache=0\nmoduleclass_sfx=-green', 0, 0),
(2, 'Menu do Usuário', '', 3, 'left', 0, '0000-00-00 00:00:00', 0, 'mod_mainmenu', 0, 1, 1, 'class_sfx=\nmoduleclass_sfx=\nmenutype=usermenu\nmenu_style=vert_indent\nfull_active_id=0\ncache=0\nmenu_images=0\nmenu_images_align=0\nexpand_menu=0\nactivate_parent=0\nindent_image=0\nindent_image1=\nindent_image2=\nindent_image3=\nindent_image4=\nindent_image5=\nindent_image6=\nspacer=\nend_spacer=', 1, 0),
(3, 'Menu Principal', '', 1, 'left', 0, '0000-00-00 00:00:00', 1, 'mod_mainmenu', 0, 0, 1, 'class_sfx=\nmoduleclass_sfx=\nmenutype=mainmenu\nmenu_style=vert_indent\nfull_active_id=0\ncache=0\nmenu_images=0\nmenu_images_align=0\nexpand_menu=0\nactivate_parent=0\nindent_image=0\nindent_image1=\nindent_image2=\nindent_image3=\nindent_image4=\nindent_image5=\nindent_image6=\nspacer=\nend_spacer=', 1, 0),
(4, 'Login', '', 5, 'left', 0, '0000-00-00 00:00:00', 1, 'mod_login', 0, 0, 1, 'moduleclass_sfx=\npretext=\nposttext=\nlogin=\nlogout=\nlogin_message=0\nlogout_message=0\ngreeting=1\nname=0', 1, 0),
(5, 'RSS', '', 6, 'left', 0, '0000-00-00 00:00:00', 1, 'mod_rssfeed', 0, 0, 1, 'text=\ncache=0\nmoduleclass_sfx=\nrss091=1\nrss10=1\nrss20=1\natom=1\nopml=1\nrss091_image=\nrss10_image=\nrss20_image=\natom_image=\nopml_image=', 1, 0),
(6, 'Últimas Notícias', '', 1, 'user1', 0, '0000-00-00 00:00:00', 1, 'mod_latestnews', 0, 0, 1, 'moduleclass_sfx=\ncache=0\ntype=1\nshow_front=1\ncount=5\ncatid=\nsecid=', 1, 0),
(7, 'Estatísticas', '', 5, 'right', 0, '0000-00-00 00:00:00', 0, 'mod_stats', 0, 0, 1, 'serverinfo=1\nsiteinfo=1\ncounter=1\nincrease=0\nmoduleclass_sfx=-blue', 0, 0),
(8, 'Usuários Online', '', 6, 'right', 0, '0000-00-00 00:00:00', 1, 'mod_whosonline', 0, 0, 1, 'showmode=0\nmoduleclass_sfx=-orange', 0, 0),
(9, 'Popular', '', 6, 'user2', 0, '0000-00-00 00:00:00', 1, 'mod_mostread', 0, 0, 1, '', 0, 0),
(10, 'Escolha de Skin', '', 7, 'left', 0, '0000-00-00 00:00:00', 0, 'mod_templatechooser', 0, 0, 1, 'title_length=50\nshow_preview=1\npreview_width=140\npreview_height=90\nmoduleclass_sfx=', 0, 0),
(11, 'Arquivo', '', 8, 'left', 0, '0000-00-00 00:00:00', 0, 'mod_archive', 0, 0, 1, 'count=10\ncache=0\nmoduleclass_sfx=', 1, 0),
(12, 'Seções', '', 9, 'left', 0, '0000-00-00 00:00:00', 0, 'mod_sections', 0, 0, 1, 'count=5\nmoduleclass_sfx=', 1, 0),
(13, 'Novidades', '', 1, 'top', 0, '0000-00-00 00:00:00', 0, 'mod_newsflash', 0, 0, 1, 'catid=3\nstyle=random\nimage=0\nlink_titles=\nreadmore=0\nitem_title=0\nitems=\ncache=0\nmoduleclass_sfx=', 0, 0),
(14, 'Itens Relacionados', '', 10, 'left', 0, '0000-00-00 00:00:00', 0, 'mod_related_items', 0, 0, 1, 'cache=0\nmoduleclass_sfx=', 0, 0),
(15, 'Busca', '', 1, 'user4', 0, '0000-00-00 00:00:00', 1, 'mod_search', 0, 0, 0, 'moduleclass_sfx=\ncache=0\nset_itemid=\nwidth=20\ntext=\nbutton=\nbutton_pos=right\nbutton_text=', 0, 0),
(16, 'Imagem Aleatória', '', 8, 'right', 0, '0000-00-00 00:00:00', 1, 'mod_random_image', 0, 0, 1, 'type=jpg\nfolder=images/thumb\nlink=\nwidth=120\nheight=\nmoduleclass_sfx=', 0, 0),
(17, 'Menu Superior', '', 1, 'user3', 0, '0000-00-00 00:00:00', 1, 'mod_mainmenu', 0, 0, 0, 'class_sfx=-nav\nmoduleclass_sfx=\nmenutype=topmenu\nmenu_style=list_flat\nfull_active_id=0\ncache=0\nmenu_images=0\nmenu_images_align=0\nexpand_menu=0\nactivate_parent=0\nindent_image=0\nindent_image1=\nindent_image2=\nindent_image3=\nindent_image4=\nindent_image5=\nindent_image6=\nspacer=\nend_spacer=', 1, 0),
(18, 'Banners', '', 1, 'banner', 0, '0000-00-00 00:00:00', 1, 'mod_banners', 0, 0, 0, 'banner_cids=\nmoduleclass_sfx=\n', 1, 0),
(19, 'Components', '', 2, 'cpanel', 0, '0000-00-00 00:00:00', 1, 'mod_components', 0, 99, 1, '', 1, 1),
(20, 'Popular', '', 3, 'cpanel', 0, '0000-00-00 00:00:00', 1, 'mod_popular', 0, 99, 1, '', 0, 1),
(21, 'Latest Items', '', 4, 'cpanel', 0, '0000-00-00 00:00:00', 1, 'mod_latest', 0, 99, 1, '', 0, 1),
(22, 'Menu Stats', '', 5, 'cpanel', 0, '0000-00-00 00:00:00', 1, 'mod_stats', 0, 99, 1, '', 0, 1),
(23, 'Unread Messages', '', 1, 'header', 0, '0000-00-00 00:00:00', 1, 'mod_unread', 0, 99, 1, '', 1, 1),
(24, 'Online Users', '', 2, 'header', 0, '0000-00-00 00:00:00', 1, 'mod_online', 0, 99, 1, '', 1, 1),
(25, 'Full Menu', '', 1, 'top', 0, '0000-00-00 00:00:00', 1, 'mod_fullmenu', 0, 99, 1, '', 1, 1),
(26, 'Pathway', '', 1, 'pathway', 0, '0000-00-00 00:00:00', 1, 'mod_pathway', 0, 99, 1, '', 1, 1),
(27, 'Toolbar', '', 1, 'toolbar', 0, '0000-00-00 00:00:00', 1, 'mod_toolbar', 0, 99, 1, '', 1, 1),
(28, 'System Message', '', 1, 'inset', 0, '0000-00-00 00:00:00', 1, 'mod_mosmsg', 0, 99, 1, '', 1, 1),
(29, 'Quick Icons', '', 1, 'icon', 0, '0000-00-00 00:00:00', 1, 'mod_quickicon', 0, 99, 1, '', 1, 1),
(30, 'Outro Menu', '', 4, 'left', 0, '0000-00-00 00:00:00', 0, 'mod_mainmenu', 0, 0, 0, 'class_sfx=\nmoduleclass_sfx=\nmenutype=othermenu\nmenu_style=vert_indent\nfull_active_id=0\ncache=0\nmenu_images=0\nmenu_images_align=0\nexpand_menu=0\nactivate_parent=0\nindent_image=0\nindent_image1=\nindent_image2=\nindent_image3=\nindent_image4=\nindent_image5=\nindent_image6=\nspacer=\nend_spacer=', 0, 0),
(31, 'Wrapper', '', 11, 'left', 0, '0000-00-00 00:00:00', 0, 'mod_wrapper', 0, 0, 1, '', 0, 0),
(32, 'Logged', '', 0, 'cpanel', 0, '0000-00-00 00:00:00', 1, 'mod_logged', 0, 99, 1, '', 0, 1),
(35, 'Previsão do Tempo', '', 7, 'right', 0, '0000-00-00 00:00:00', 1, 'mod_eweather', 0, 0, 1, 'moduleclass_sfx=-green', 0, 0),
(36, 'Anúncios Google', '', 9, 'right', 0, '0000-00-00 00:00:00', 0, 'mod_adsense_joomlaspan_2.1_ClickSafe', 0, 0, 1, 'joomlaspan_ip_block1=\njoomlaspan_ip_block2=\njoomlaspan_ip_block3=\njoomlaspan_ip_block4=\njoomlaspan_ip_block5=\nip_block_alt_code=\njoomlaspan_ad_css=\nmoduleclass_sfx=-blue\njoomlaspan_ad_client=pub-6257118084972146\njoomlaspan_ad_format=160x600_as\njoomlaspan_ad_channel=\njoomlaspan_ad_type=image\njoomlaspan_ad_in_frame=0\njoomlaspan_alternate_ad_url=\njoomlaspan_alternate_color=FFFFFF\njoomlaspan_color_border1=159FC1\njoomlaspan_color_border2=159FC1\njoomlaspan_color_border3=159FC1\njoomlaspan_color_border4=159FC1\njoomlaspan_color_bg1=159FC1\njoomlaspan_color_bg2=159FC1\njoomlaspan_color_bg3=159FC1\njoomlaspan_color_bg4=159FC1\njoomlaspan_color_link1=0033FF\njoomlaspan_color_link2=0033FF\njoomlaspan_color_link3=0033FF\njoomlaspan_color_link4=0033FF\njoomlaspan_color_text1=333333\njoomlaspan_color_text2=333333\njoomlaspan_color_text3=333333\njoomlaspan_color_text4=333333\njoomlaspan_color_url1=008000\njoomlaspan_color_url2=008000\njoomlaspan_color_url3=008000\njoomlaspan_color_url4=008000', 0, 0),
(37, 'Categorias de Produtos', '', 17, 'left', 0, '0000-00-00 00:00:00', 0, 'mod_product_categories', 0, 0, 1, 'menutype=jscook\njscook_type=menu\njscookMenu_style=ThemeOffice\nmenu_orientation=hbr\njscookTree_style=ThemeXP\nroot_label=Shop\ncache=0\nmoduleclass_sfx=\nclass_sfx=', 0, 0),
(38, 'Product Scroller', '', 16, 'left', 0, '0000-00-00 00:00:00', 0, 'mod_productscroller', 0, 0, 1, '', 0, 0),
(39, 'Loja Virtual', '', 2, 'left', 0, '0000-00-00 00:00:00', 1, 'mod_virtuemart', 0, 0, 0, 'cache=0\nclass_sfx=\nmoduleclass_sfx=\npretext=\nshow_login_form=no\nshow_categories=yes\nshow_listall=yes\nshow_minicart=no\nshow_productsearch=yes\nshow_product_parameter_search=no\nmenutype=links\njscook_type=menu\njscookMenu_style=ThemeOffice\nmenu_orientation=hbr\njscookTree_style=ThemeXP\nroot_label=Shop', 0, 0),
(40, 'All-In-One New/Featured/TopTen/Random Products Module', '', 15, 'left', 0, '0000-00-00 00:00:00', 0, 'mod_virtuemart_allinone', 0, 0, 1, '', 0, 0),
(41, 'Seu Carrinho', '', 2, 'right', 0, '0000-00-00 00:00:00', 1, 'mod_virtuemart_cart', 0, 0, 1, 'moduleclass_sfx=\nclass_sfx=-orange', 0, 0),
(42, 'Featured Products', '', 14, 'left', 0, '0000-00-00 00:00:00', 0, 'mod_virtuemart_featureprod', 0, 0, 1, '', 0, 0),
(43, 'Latest products', '', 13, 'left', 0, '0000-00-00 00:00:00', 0, 'mod_virtuemart_latestprod', 0, 0, 1, '', 0, 0),
(44, 'Fabricantes', '', 3, 'right', 0, '0000-00-00 00:00:00', 1, 'mod_virtuemart_manufacturers', 0, 0, 1, 'cache=0\ntext_before=\nshow_linklist=1\nshow_dropdown=1\nauto=1\nmoduleclass_sfx=-green\nclass_sfx=', 0, 0),
(45, 'Produtos Aleatórios', '', 4, 'right', 0, '0000-00-00 00:00:00', 1, 'mod_virtuemart_randomprod', 0, 0, 1, 'max_items=1\nshow_price=1\nshow_addtocart=1\ndisplay_style=vertical\nproducts_per_row=1\ncategory_id=\nmoduleclass_sfx=-blue\nclass_sfx=', 0, 0),
(46, 'VirtueMart Search Module', '', 12, 'left', 0, '0000-00-00 00:00:00', 0, 'mod_virtuemart_search', 0, 0, 1, '', 0, 0),
(47, 'VirtueMart TopTen products Module', '', 18, 'left', 0, '0000-00-00 00:00:00', 0, 'mod_virtuemart_topten', 0, 0, 1, '', 0, 0),
(48, 'JoomFish language selection (sh version)', '', 2, 'user3', 0, '0000-00-00 00:00:00', 0, 'mod_shJoomfish', 0, 0, 0, '', 0, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_modules_menu`
--

CREATE TABLE IF NOT EXISTS `jos_modules_menu` (
  `moduleid` int(11) NOT NULL default '0',
  `menuid` int(11) NOT NULL default '0',
  PRIMARY KEY  (`moduleid`,`menuid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `jos_modules_menu`
--

INSERT INTO `jos_modules_menu` (`moduleid`, `menuid`) VALUES
(1, 1),
(2, 0),
(3, 0),
(4, 0),
(5, 0),
(6, 1),
(6, 2),
(7, 1),
(7, 2),
(7, 3),
(7, 5),
(7, 7),
(7, 9),
(7, 23),
(7, 25),
(7, 26),
(8, 1),
(9, 1),
(9, 2),
(9, 4),
(9, 27),
(9, 36),
(10, 1),
(11, 0),
(12, 0),
(13, 1),
(14, 0),
(15, 0),
(16, 1),
(16, 2),
(16, 3),
(16, 5),
(16, 7),
(16, 9),
(16, 23),
(16, 25),
(16, 26),
(17, 0),
(18, 0),
(30, 0),
(35, 1),
(36, 1),
(36, 3),
(36, 5),
(36, 9),
(36, 26),
(36, 27),
(36, 28),
(36, 31),
(37, 29),
(38, 0),
(39, 0),
(40, 0),
(41, 29),
(42, 0),
(43, 0),
(44, 29),
(45, 1),
(45, 3),
(45, 5),
(45, 7),
(45, 9),
(45, 23),
(45, 26),
(45, 27),
(45, 28),
(45, 31),
(46, 0),
(47, 0),
(48, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_newsfeeds`
--

CREATE TABLE IF NOT EXISTS `jos_newsfeeds` (
  `catid` int(11) NOT NULL default '0',
  `id` int(11) NOT NULL auto_increment,
  `name` text NOT NULL,
  `link` text NOT NULL,
  `filename` varchar(200) default NULL,
  `published` tinyint(1) NOT NULL default '0',
  `numarticles` int(11) unsigned NOT NULL default '1',
  `cache_time` int(11) unsigned NOT NULL default '3600',
  `checked_out` tinyint(3) unsigned NOT NULL default '0',
  `checked_out_time` datetime NOT NULL default '0000-00-00 00:00:00',
  `ordering` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `published` (`published`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Extraindo dados da tabela `jos_newsfeeds`
--

INSERT INTO `jos_newsfeeds` (`catid`, `id`, `name`, `link`, `filename`, `published`, `numarticles`, `cache_time`, `checked_out`, `checked_out_time`, `ordering`) VALUES
(4, 1, 'Joomla! - Official News', 'http://www.joomla.org/index.php?option=com_rss_xtd&feed=RSS2.0&type=com_frontpage&Itemid=1', '', 1, 5, 3600, 0, '0000-00-00 00:00:00', 8),
(4, 2, 'Joomla! - Community News', 'http://www.joomla.org/index.php?option=com_rss_xtd&feed=RSS2.0&type=com_content&task=blogcategory&id=0&Itemid=33', '', 1, 5, 3600, 0, '0000-00-00 00:00:00', 9),
(10, 4, 'Linux Today', 'http://linuxtoday.com/backend/my-netscape.rdf', '', 1, 3, 3600, 0, '0000-00-00 00:00:00', 1),
(5, 5, 'Business News', 'http://headlines.internet.com/internetnews/bus-news/news.rss', '', 1, 3, 3600, 0, '0000-00-00 00:00:00', 2),
(11, 6, 'Web Developer News', 'http://headlines.internet.com/internetnews/wd-news/news.rss', '', 1, 3, 3600, 0, '0000-00-00 00:00:00', 3),
(10, 7, 'Linux Central:New Products', 'http://linuxcentral.com/backend/lcnew.rdf', '', 1, 3, 3600, 0, '0000-00-00 00:00:00', 4),
(10, 8, 'Linux Central:Best Selling', 'http://linuxcentral.com/backend/lcbestns.rdf', '', 1, 3, 3600, 0, '0000-00-00 00:00:00', 5),
(10, 9, 'Linux Central:Daily Specials', 'http://linuxcentral.com/backend/lcspecialns.rdf', '', 1, 3, 3600, 0, '0000-00-00 00:00:00', 6),
(9, 10, 'Internet:Finance News', 'http://headlines.internet.com/internetnews/fina-news/news.rss', '', 1, 3, 3600, 0, '0000-00-00 00:00:00', 7);

-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_polls`
--

CREATE TABLE IF NOT EXISTS `jos_polls` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `title` varchar(100) NOT NULL default '',
  `voters` int(9) NOT NULL default '0',
  `checked_out` int(11) NOT NULL default '0',
  `checked_out_time` datetime NOT NULL default '0000-00-00 00:00:00',
  `published` tinyint(1) NOT NULL default '0',
  `access` int(11) NOT NULL default '0',
  `lag` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Extraindo dados da tabela `jos_polls`
--

INSERT INTO `jos_polls` (`id`, `title`, `voters`, `checked_out`, `checked_out_time`, `published`, `access`, `lag`) VALUES
(14, 'O que você achou deste site?', 4, 0, '0000-00-00 00:00:00', 1, 0, 86400);

-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_poll_data`
--

CREATE TABLE IF NOT EXISTS `jos_poll_data` (
  `id` int(11) NOT NULL auto_increment,
  `pollid` int(4) NOT NULL default '0',
  `text` text NOT NULL,
  `hits` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `pollid` (`pollid`,`text`(1))
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Extraindo dados da tabela `jos_poll_data`
--

INSERT INTO `jos_poll_data` (`id`, `pollid`, `text`, `hits`) VALUES
(1, 14, 'Regular', 2),
(2, 14, 'Bom', 1),
(3, 14, 'Ótimo', 1),
(4, 14, '', 0),
(5, 14, '', 0),
(6, 14, '', 0),
(7, 14, '', 0),
(8, 14, '', 0),
(9, 14, '', 0),
(10, 14, '', 0),
(11, 14, '', 0),
(12, 14, '', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_poll_date`
--

CREATE TABLE IF NOT EXISTS `jos_poll_date` (
  `id` bigint(20) NOT NULL auto_increment,
  `date` datetime NOT NULL default '0000-00-00 00:00:00',
  `vote_id` int(11) NOT NULL default '0',
  `poll_id` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `poll_id` (`poll_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Extraindo dados da tabela `jos_poll_date`
--

INSERT INTO `jos_poll_date` (`id`, `date`, `vote_id`, `poll_id`) VALUES
(1, '2007-06-27 19:27:00', 3, 14),
(2, '2007-07-11 21:59:00', 2, 14),
(3, '2007-07-20 01:15:00', 1, 14);

-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_poll_menu`
--

CREATE TABLE IF NOT EXISTS `jos_poll_menu` (
  `pollid` int(11) NOT NULL default '0',
  `menuid` int(11) NOT NULL default '0',
  PRIMARY KEY  (`pollid`,`menuid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `jos_poll_menu`
--

INSERT INTO `jos_poll_menu` (`pollid`, `menuid`) VALUES
(14, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_redirection`
--

CREATE TABLE IF NOT EXISTS `jos_redirection` (
  `id` int(11) NOT NULL auto_increment,
  `cpt` int(11) NOT NULL default '0',
  `rank` int(11) NOT NULL default '0',
  `oldurl` varchar(255) NOT NULL default '',
  `newurl` varchar(150) NOT NULL default '',
  `dateadd` date NOT NULL default '0000-00-00',
  PRIMARY KEY  (`id`),
  KEY `newurl` (`newurl`),
  KEY `rank` (`rank`),
  KEY `oldurl` (`oldurl`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=350 ;

--
-- Extraindo dados da tabela `jos_redirection`
--

INSERT INTO `jos_redirection` (`id`, `cpt`, `rank`, `oldurl`, `newurl`, `dateadd`) VALUES
(348, 0, 0, 'Lost-password.html', 'index.php?option=com_registration&Itemid=29&lang=portuguese&task=lostPassword', '0000-00-00'),
(349, 1, 0, 'eweather/', 'index.php?option=com_eweather&Itemid=99999999&detail_view=3&lang=portuguese', '0000-00-00'),
(346, 2, 0, 'eweather/', 'index.php?option=com_eweather&Itemid=0&lang=portuguese', '0000-00-00'),
(347, 0, 0, 'home/', 'index.php?option=com_frontpage&Itemid=29&lang=portuguese', '0000-00-00'),
(344, 0, 0, 'visualrecommend/showform.html', 'index.php?option=com_visualrecommend&Itemid=0&com=content&id=7&lang=portuguese&task=showform', '0000-00-00'),
(345, 0, 0, 'visualrecommend/showform.html', 'index.php?option=com_visualrecommend&Itemid=0&com=content&id=4&lang=portuguese&task=showform', '0000-00-00'),
(342, 0, 0, 'noticias/Internet.html', 'index.php?option=com_newsfeeds&Itemid=7&catid=11&lang=portuguese', '0000-00-00'),
(343, 0, 0, 'visualrecommend/showform.html', 'index.php?option=com_visualrecommend&Itemid=0&com=content&id=3&lang=portuguese&task=showform', '0000-00-00'),
(340, 0, 0, 'noticias/Finance.html', 'index.php?option=com_newsfeeds&Itemid=7&catid=9&lang=portuguese', '0000-00-00'),
(341, 0, 0, 'noticias/Linux.html', 'index.php?option=com_newsfeeds&Itemid=7&catid=10&lang=portuguese', '0000-00-00'),
(339, 0, 0, 'noticias/Joomla.html', 'index.php?option=com_newsfeeds&Itemid=7&catid=4&lang=portuguese', '0000-00-00'),
(338, 0, 0, 'noticias/Business-general.html', 'index.php?option=com_newsfeeds&Itemid=7&catid=5&lang=portuguese', '0000-00-00'),
(337, 0, 0, 'visualrecommend/showform.html', 'index.php?option=com_visualrecommend&Itemid=0&com=content&id=2&lang=portuguese&task=showform', '0000-00-00'),
(335, 0, 0, 'Latest/News4/Page-2.html', 'index.php?option=com_content&Itemid=9&id=9&lang=portuguese&limit=1&limitstart=1&task=view', '0000-00-00'),
(336, 0, 0, 'Latest/News4/Page-3.html', 'index.php?option=com_content&Itemid=9&id=9&lang=portuguese&limit=1&limitstart=2&task=view', '0000-00-00'),
(333, 0, 0, 'Table/Latest/', 'index.php?option=com_content&Itemid=2&id=1&lang=portuguese&sectionid=1&task=category', '0000-00-00'),
(334, 0, 0, 'links/Joomla.html', 'index.php?option=com_weblinks&Itemid=23&catid=2&lang=portuguese', '0000-00-00'),
(331, 0, 0, 'contato/Wander-Von-Muller.html', 'index.php?option=com_contact&Itemid=3&contact_id=1&lang=portuguese&task=view', '0000-00-00'),
(332, 0, 0, '404.html', 'index.php?option=com_content&Itemid=&id=12&lang=portuguese&task=view', '0000-00-00'),
(330, 1, 0, 'Latest/News3.html', 'index.php?option=com_content&Itemid=9&id=8&lang=portuguese&task=view', '0000-00-00'),
(324, 0, 0, 'Create-new-article/News.html', 'index.php?option=com_content&Itemid=&lang=portuguese&sectionid=1&task=new', '0000-00-00'),
(325, 1, 0, 'submit-weblink/Create-new-link.html', 'index.php?option=com_weblinks&Itemid=14&lang=portuguese&task=new', '0000-00-00'),
(326, 1, 0, 'user/CheckIn.html', 'index.php?option=com_user&Itemid=15&lang=portuguese&task=CheckIn', '0000-00-00'),
(327, 0, 0, 'Log-in.html', 'index.php?option=com_login&Itemid=16&lang=portuguese', '0000-00-00'),
(328, 2, 0, 'logout/', 'index.php?option=logout&lang=portuguese', '0000-00-00'),
(329, 1, 0, 'Examples/FAQ1.html', 'index.php?option=com_content&Itemid=9&id=10&lang=portuguese&task=view', '0000-00-00'),
(322, 3, 0, 'Latest/News2.html', 'index.php?option=com_content&Itemid=9&id=7&lang=portuguese&task=view', '0000-00-00'),
(323, 2, 0, 'user/UserDetails.html', 'index.php?option=com_user&Itemid=21&lang=portuguese&task=UserDetails', '0000-00-00'),
(320, 2, 0, 'poll/', 'index.php?option=com_poll&lang=portuguese', '0000-00-00'),
(321, 1, 0, 'poll/results.html', 'index.php?option=com_poll&id=14&lang=portuguese&task=results', '0000-00-00'),
(317, 1, 0, 'rss/', 'index.php?option=com_rss&feed=RSS2.0&lang=portuguese&no_html=1', '0000-00-00'),
(318, 0, 0, 'rss/', 'index.php?option=com_rss&feed=ATOM0.3&lang=portuguese&no_html=1', '0000-00-00'),
(319, 0, 0, 'rss/', 'index.php?option=com_rss&feed=OPML&lang=portuguese&no_html=1', '0000-00-00'),
(313, 1, 0, 'Lost-password.html', 'index.php?option=com_registration&lang=portuguese&task=lostPassword', '0000-00-00'),
(314, 1, 0, 'Create-an-account.html', 'index.php?option=com_registration&lang=portuguese&task=register', '0000-00-00'),
(316, 0, 0, 'rss/', 'index.php?option=com_rss&feed=RSS1.0&lang=portuguese&no_html=1', '0000-00-00'),
(315, 0, 0, 'rss/', 'index.php?option=com_rss&feed=RSS0.91&lang=portuguese&no_html=1', '0000-00-00'),
(311, 3, 0, 'mapa/', 'index.php?option=com_google_maps&Itemid=27&lang=portuguese', '0000-00-00'),
(312, 3, 0, 'recomende-este-site/', 'index.php?option=com_recommend&Itemid=28&lang=portuguese', '0000-00-00'),
(309, 2, 0, 'noticias.html', 'index.php?option=com_newsfeeds&Itemid=7&lang=portuguese', '0000-00-00'),
(310, 4, 0, 'mapa-do-site/', 'index.php?option=com_joomap&Itemid=26&lang=portuguese', '0000-00-00'),
(308, 3, 0, 'Search.html', 'index.php?option=com_search&Itemid=5&lang=portuguese&limitstart=&task=', '0000-00-00'),
(307, 5, 0, 'blog/', 'index.php?option=com_content&Itemid=9&id=&lang=portuguese&task=blogsection', '0000-00-00'),
(306, 4, 0, 'Examples/FAQ2.html', 'index.php?option=com_content&Itemid=9&id=11&lang=portuguese&task=view', '0000-00-00'),
(305, 1, 0, 'Latest/Bem-Vindo.html', 'index.php?option=com_content&Itemid=9&id=1&lang=portuguese&task=view', '0000-00-00'),
(304, 3, 0, 'Latest/News4.html', 'index.php?option=com_content&Itemid=9&id=9&lang=portuguese&task=view', '0000-00-00'),
(303, 0, 0, 'Latest/News1.html', 'index.php?option=com_content&Itemid=9&id=6&lang=portuguese&task=view', '0000-00-00'),
(302, 7, 0, 'Newsflash/12-Dicas-para-o-dia-perfeito.html', 'index.php?option=com_content&Itemid=9&id=3&lang=portuguese&task=view', '0000-00-00'),
(300, 6, 0, 'Newsflash/Newsflash-3.html', 'index.php?option=com_content&Itemid=9&id=4&lang=portuguese&task=view', '0000-00-00'),
(301, 5, 0, 'Newsflash/Lembrancinhas.html', 'index.php?option=com_content&Itemid=9&id=2&lang=portuguese&task=view', '0000-00-00'),
(299, 1, 0, 'Table/News/', 'index.php?option=com_content&Itemid=2&id=1&lang=portuguese&task=section', '0000-00-00'),
(298, 2, 0, 'links.html', 'index.php?option=com_weblinks&Itemid=23&lang=portuguese', '0000-00-00'),
(296, 0, 0, 'Newsflash/Newsflash-3.html', 'index.php?option=com_content&Itemid=1&id=4&lang=portuguese&task=view', '0000-00-00'),
(297, 4, 0, 'contato/', 'index.php?option=com_contact&Itemid=3&lang=portuguese', '0000-00-00'),
(295, 0, 0, 'Newsflash/12-Dicas-para-o-dia-perfeito.html', 'index.php?option=com_content&Itemid=1&id=3&lang=portuguese&task=view', '0000-00-00'),
(293, 0, 0, 'Latest/Bem-Vindo.html', 'index.php?option=com_content&Itemid=1&id=1&lang=portuguese&task=view', '0000-00-00'),
(294, 0, 0, 'Newsflash/Lembrancinhas.html', 'index.php?option=com_content&Itemid=1&id=2&lang=portuguese&task=view', '0000-00-00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_sections`
--

CREATE TABLE IF NOT EXISTS `jos_sections` (
  `id` int(11) NOT NULL auto_increment,
  `title` varchar(50) NOT NULL default '',
  `name` varchar(255) NOT NULL default '',
  `image` varchar(100) NOT NULL default '',
  `scope` varchar(50) NOT NULL default '',
  `image_position` varchar(10) NOT NULL default '',
  `description` text NOT NULL,
  `published` tinyint(1) NOT NULL default '0',
  `checked_out` int(11) unsigned NOT NULL default '0',
  `checked_out_time` datetime NOT NULL default '0000-00-00 00:00:00',
  `ordering` int(11) NOT NULL default '0',
  `access` tinyint(3) unsigned NOT NULL default '0',
  `count` int(11) NOT NULL default '0',
  `params` text NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `idx_scope` (`scope`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Extraindo dados da tabela `jos_sections`
--

INSERT INTO `jos_sections` (`id`, `title`, `name`, `image`, `scope`, `image_position`, `description`, `published`, `checked_out`, `checked_out_time`, `ordering`, `access`, `count`, `params`) VALUES
(1, 'News', 'The News', 'articles.jpg', 'content', 'right', 'Select a news topic from the list below, then select a news article to read.', 1, 0, '0000-00-00 00:00:00', 1, 0, 1, ''),
(2, 'Newsflashes', 'Newsflashes', '', 'content', 'left', '', 1, 0, '0000-00-00 00:00:00', 2, 0, 1, ''),
(3, 'FAQs', 'Frequently Asked Questions', 'pastarchives.jpg', 'content', 'left', 'From the list below choose one of our FAQs topics, then select an FAQ to read. If you have a question which is not in this section, please contact us.', 1, 0, '0000-00-00 00:00:00', 2, 0, 1, '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_session`
--

CREATE TABLE IF NOT EXISTS `jos_session` (
  `username` varchar(50) default '',
  `time` varchar(14) default '',
  `session_id` varchar(200) NOT NULL default '0',
  `guest` tinyint(4) default '1',
  `userid` int(11) default '0',
  `usertype` varchar(50) default '',
  `gid` tinyint(3) unsigned NOT NULL default '0',
  PRIMARY KEY  (`session_id`),
  KEY `whosonline` (`guest`,`usertype`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `jos_session`
--

INSERT INTO `jos_session` (`username`, `time`, `session_id`, `guest`, `userid`, `usertype`, `gid`) VALUES
('', '1488435208', '979f7ef79314496ce05abeead806f39a', 1, 0, '', 0),
('', '1488435399', 'cbe7fd747249737abdc56a2d9be8d838', 1, 0, '', 0),
('admin', '1488435316', '646fc87220c5842ddf5133180120fd70', 1, 62, 'Super Administrator', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_stats_agents`
--

CREATE TABLE IF NOT EXISTS `jos_stats_agents` (
  `agent` varchar(255) NOT NULL default '',
  `type` tinyint(1) unsigned NOT NULL default '0',
  `hits` int(11) unsigned NOT NULL default '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `jos_stats_agents`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_templates_menu`
--

CREATE TABLE IF NOT EXISTS `jos_templates_menu` (
  `template` varchar(50) NOT NULL default '',
  `menuid` int(11) NOT NULL default '0',
  `client_id` tinyint(4) NOT NULL default '0',
  PRIMARY KEY  (`template`,`menuid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `jos_templates_menu`
--

INSERT INTO `jos_templates_menu` (`template`, `menuid`, `client_id`) VALUES
('nucleodoevento', 0, 0),
('joomla_admin', 0, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_template_positions`
--

CREATE TABLE IF NOT EXISTS `jos_template_positions` (
  `id` int(11) NOT NULL auto_increment,
  `position` varchar(10) NOT NULL default '',
  `description` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Extraindo dados da tabela `jos_template_positions`
--

INSERT INTO `jos_template_positions` (`id`, `position`, `description`) VALUES
(1, 'left', ''),
(2, 'right', ''),
(3, 'top', ''),
(4, 'bottom', ''),
(5, 'inset', ''),
(6, 'banner', ''),
(7, 'header', ''),
(8, 'footer', ''),
(9, 'newsflash', ''),
(10, 'legals', ''),
(11, 'pathway', ''),
(12, 'toolbar', ''),
(13, 'cpanel', ''),
(14, 'user1', ''),
(15, 'user2', ''),
(16, 'user3', ''),
(17, 'user4', ''),
(18, 'user5', ''),
(19, 'user6', ''),
(20, 'user7', ''),
(21, 'user8', ''),
(22, 'user9', ''),
(23, 'advert1', ''),
(24, 'advert2', ''),
(25, 'advert3', ''),
(26, 'icon', ''),
(27, 'debug', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_users`
--

CREATE TABLE IF NOT EXISTS `jos_users` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(50) NOT NULL default '',
  `username` varchar(25) NOT NULL default '',
  `email` varchar(100) NOT NULL default '',
  `password` varchar(100) NOT NULL default '',
  `usertype` varchar(25) NOT NULL default '',
  `block` tinyint(4) NOT NULL default '0',
  `sendEmail` tinyint(4) default '0',
  `gid` tinyint(3) unsigned NOT NULL default '1',
  `registerDate` datetime NOT NULL default '0000-00-00 00:00:00',
  `lastvisitDate` datetime NOT NULL default '0000-00-00 00:00:00',
  `activation` varchar(100) NOT NULL default '',
  `params` text NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `usertype` (`usertype`),
  KEY `idx_name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=73 ;

--
-- Extraindo dados da tabela `jos_users`
--

INSERT INTO `jos_users` (`id`, `name`, `username`, `email`, `password`, `usertype`, `block`, `sendEmail`, `gid`, `registerDate`, `lastvisitDate`, `activation`, `params`) VALUES
(62, 'administrador', 'admin', 'contato@nucleodoevento.com.br', 'e10adc3949ba59abbe56e057f20f883e', 'Super Administrator', 0, 1, 25, '2007-06-25 16:00:29', '2007-08-02 09:24:17', '', 'editor=');

-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_usertypes`
--

CREATE TABLE IF NOT EXISTS `jos_usertypes` (
  `id` tinyint(3) unsigned NOT NULL default '0',
  `name` varchar(50) NOT NULL default '',
  `mask` varchar(11) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `jos_usertypes`
--

INSERT INTO `jos_usertypes` (`id`, `name`, `mask`) VALUES
(0, 'superadministrator', ''),
(1, 'administrator', ''),
(2, 'editor', ''),
(3, 'user', ''),
(4, 'author', ''),
(5, 'publisher', ''),
(6, 'manager', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_visualrecommend`
--

CREATE TABLE IF NOT EXISTS `jos_visualrecommend` (
  `id` int(11) NOT NULL auto_increment,
  `contentid` int(11) NOT NULL default '0',
  `num_send` tinyint(1) NOT NULL default '0',
  `name` varchar(30) NOT NULL default '',
  `mail_sender` varchar(50) NOT NULL default '',
  `userid` int(11) NOT NULL default '0',
  `mails` text NOT NULL,
  `num_reply` tinyint(1) NOT NULL default '0',
  `mails_reply` text NOT NULL,
  `num_points` int(11) NOT NULL default '0',
  `ip` varchar(15) NOT NULL default '',
  `date` datetime NOT NULL default '0000-00-00 00:00:00',
  `link` varchar(255) NOT NULL default '',
  `keyreply` varchar(30) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Extraindo dados da tabela `jos_visualrecommend`
--

INSERT INTO `jos_visualrecommend` (`id`, `contentid`, `num_send`, `name`, `mail_sender`, `userid`, `mails`, `num_reply`, `mails_reply`, `num_points`, `ip`, `date`, `link`, `keyreply`) VALUES
(1, 3, 2, 'Leonardo', 'leonardo@nucleodoevento.com.br', 0, 'deniselima@prsc.mpf.gov.br;denisejlle@hotmail.com', 1, 'deniselima@prsc.mpf.gov.br', 0, '201.34.152.219', '2007-07-18 18:45:53', 'http://www.nucleodoevento.com.br/Newsflash/12-Dicas-para-o-dia-perfeito.html', '1184795151469e8a0f1967b'),
(2, 1, 1, 'Leonardo', 'leonardo@nucleodoevento.com.br', 0, 'leonardo@nucleodoevento.com.br', 0, '', 0, '201.34.152.219', '2007-07-18 18:46:24', 'http://www.nucleodoevento.com.br/Latest/Bem-Vindo.html', '1184795183469e8a2f51862');

-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_vm_affiliate`
--

CREATE TABLE IF NOT EXISTS `jos_vm_affiliate` (
  `affiliate_id` int(11) NOT NULL auto_increment,
  `user_id` int(11) NOT NULL default '0',
  `active` char(1) NOT NULL default 'N',
  `rate` int(11) NOT NULL default '0',
  PRIMARY KEY  (`affiliate_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Used to store affiliate user entries' AUTO_INCREMENT=1 ;

--
-- Extraindo dados da tabela `jos_vm_affiliate`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_vm_affiliate_sale`
--

CREATE TABLE IF NOT EXISTS `jos_vm_affiliate_sale` (
  `order_id` int(11) NOT NULL default '0',
  `visit_id` varchar(32) NOT NULL default '',
  `affiliate_id` int(11) NOT NULL default '0',
  `rate` int(2) NOT NULL default '0',
  PRIMARY KEY  (`order_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Stores orders that affiliates have placed';

--
-- Extraindo dados da tabela `jos_vm_affiliate_sale`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_vm_auth_user_vendor`
--

CREATE TABLE IF NOT EXISTS `jos_vm_auth_user_vendor` (
  `user_id` int(11) default NULL,
  `vendor_id` int(11) default NULL,
  KEY `idx_auth_user_vendor_user_id` (`user_id`),
  KEY `idx_auth_user_vendor_vendor_id` (`vendor_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Maps a user to a vendor';

--
-- Extraindo dados da tabela `jos_vm_auth_user_vendor`
--

INSERT INTO `jos_vm_auth_user_vendor` (`user_id`, `vendor_id`) VALUES
(62, 1),
(63, 1),
(64, 1),
(66, 1),
(67, 1),
(68, 1),
(72, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_vm_category`
--

CREATE TABLE IF NOT EXISTS `jos_vm_category` (
  `category_id` int(11) NOT NULL auto_increment,
  `vendor_id` int(11) NOT NULL default '0',
  `category_name` varchar(128) NOT NULL default '',
  `category_description` text,
  `category_thumb_image` varchar(255) default NULL,
  `category_full_image` varchar(255) default NULL,
  `category_publish` char(1) default NULL,
  `cdate` int(11) default NULL,
  `mdate` int(11) default NULL,
  `category_browsepage` varchar(255) NOT NULL default 'browse_1',
  `products_per_row` tinyint(2) NOT NULL default '1',
  `category_flypage` varchar(255) default NULL,
  `list_order` int(11) default NULL,
  PRIMARY KEY  (`category_id`),
  KEY `idx_category_vendor_id` (`vendor_id`),
  KEY `idx_category_name` (`category_name`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='Product Categories are stored here' AUTO_INCREMENT=12 ;

--
-- Extraindo dados da tabela `jos_vm_category`
--

INSERT INTO `jos_vm_category` (`category_id`, `vendor_id`, `category_name`, `category_description`, `category_thumb_image`, `category_full_image`, `category_publish`, `cdate`, `mdate`, `category_browsepage`, `products_per_row`, `category_flypage`, `list_order`) VALUES
(6, 1, 'Fantasias', '', 'fdf64361f61c0986487f1f09b3682820.jpg', '783f8ef0729d83236131d7b8e4b94c25.jpg', 'Y', 1185554320, 1185645961, 'browse_1', 1, 'shop.flypage', 1),
(7, 1, 'Asa de Borboleta', '', '967e46943b9634c78217496927bc09cd.jpg', 'fcda780e2f76290a27cf4f28136c9a11.jpg', 'Y', 1185554545, 1185554833, 'browse_1', 1, 'shop.flypage', 1),
(8, 1, 'Barba e Bigode', '', '7c22bf17c430d88c4dd2385ead87db09.jpg', '8925dec7422626a22b436487b12bebd9.jpg', 'Y', 1185557083, 1185557119, 'browse_1', 1, 'shop.flypage', 2),
(9, 1, 'Bijoux', '', '16d009059407ba740f7740acc544ca27.jpg', 'e9864b0e88ba557b78a3bf2e2dcf1e3f.jpg', 'Y', 1185557307, 1185557307, 'browse_1', 1, 'shop.flypage', 3),
(10, 1, 'Estolas e Boás', '', 'b26d262b8dca0a608967905524511edb.jpg', '7e9c29b26038ab2a9619925b2431d6ee.jpg', 'Y', 1185558774, 1185558774, 'browse_1', 1, 'shop.flypage', 4),
(11, 1, 'Diversos', '', '8d354f577d792c061a52f3ce303da222.jpg', '238a9b5dbbae31b18c43787af942b3a7.jpg', 'Y', 1185568957, 1185568977, 'browse_1', 1, 'shop.flypage', 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_vm_category_xref`
--

CREATE TABLE IF NOT EXISTS `jos_vm_category_xref` (
  `category_parent_id` int(11) NOT NULL default '0',
  `category_child_id` int(11) NOT NULL default '0',
  `category_list` int(11) default NULL,
  KEY `category_xref_category_parent_id` (`category_parent_id`),
  KEY `category_xref_category_child_id` (`category_child_id`),
  KEY `idx_category_xref_category_list` (`category_list`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Category child-parent relation list';

--
-- Extraindo dados da tabela `jos_vm_category_xref`
--

INSERT INTO `jos_vm_category_xref` (`category_parent_id`, `category_child_id`, `category_list`) VALUES
(6, 10, 0),
(0, 6, 0),
(6, 9, 0),
(6, 8, 0),
(6, 7, 0),
(0, 11, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_vm_country`
--

CREATE TABLE IF NOT EXISTS `jos_vm_country` (
  `country_id` int(11) NOT NULL auto_increment,
  `zone_id` int(11) NOT NULL default '1',
  `country_name` varchar(64) default NULL,
  `country_3_code` char(3) default NULL,
  `country_2_code` char(2) default NULL,
  PRIMARY KEY  (`country_id`),
  KEY `idx_country_name` (`country_name`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='Country records' AUTO_INCREMENT=240 ;

--
-- Extraindo dados da tabela `jos_vm_country`
--

INSERT INTO `jos_vm_country` (`country_id`, `zone_id`, `country_name`, `country_3_code`, `country_2_code`) VALUES
(1, 1, 'Afghanistan', 'AFG', 'AF'),
(2, 1, 'Albania', 'ALB', 'AL'),
(3, 1, 'Algeria', 'DZA', 'DZ'),
(4, 1, 'American Samoa', 'ASM', 'AS'),
(5, 1, 'Andorra', 'AND', 'AD'),
(6, 1, 'Angola', 'AGO', 'AO'),
(7, 1, 'Anguilla', 'AIA', 'AI'),
(8, 1, 'Antarctica', 'ATA', 'AQ'),
(9, 1, 'Antigua and Barbuda', 'ATG', 'AG'),
(10, 1, 'Argentina', 'ARG', 'AR'),
(11, 1, 'Armenia', 'ARM', 'AM'),
(12, 1, 'Aruba', 'ABW', 'AW'),
(13, 1, 'Australia', 'AUS', 'AU'),
(14, 1, 'Austria', 'AUT', 'AT'),
(15, 1, 'Azerbaijan', 'AZE', 'AZ'),
(16, 1, 'Bahamas', 'BHS', 'BS'),
(17, 1, 'Bahrain', 'BHR', 'BH'),
(18, 1, 'Bangladesh', 'BGD', 'BD'),
(19, 1, 'Barbados', 'BRB', 'BB'),
(20, 1, 'Belarus', 'BLR', 'BY'),
(21, 1, 'Belgium', 'BEL', 'BE'),
(22, 1, 'Belize', 'BLZ', 'BZ'),
(23, 1, 'Benin', 'BEN', 'BJ'),
(24, 1, 'Bermuda', 'BMU', 'BM'),
(25, 1, 'Bhutan', 'BTN', 'BT'),
(26, 1, 'Bolivia', 'BOL', 'BO'),
(27, 1, 'Bosnia and Herzegowina', 'BIH', 'BA'),
(28, 1, 'Botswana', 'BWA', 'BW'),
(29, 1, 'Bouvet Island', 'BVT', 'BV'),
(30, 1, 'Brasil', 'BRA', 'BR'),
(31, 1, 'British Indian Ocean Territory', 'IOT', 'IO'),
(32, 1, 'Brunei Darussalam', 'BRN', 'BN'),
(33, 1, 'Bulgaria', 'BGR', 'BG'),
(34, 1, 'Burkina Faso', 'BFA', 'BF'),
(35, 1, 'Burundi', 'BDI', 'BI'),
(36, 1, 'Cambodia', 'KHM', 'KH'),
(37, 1, 'Cameroon', 'CMR', 'CM'),
(38, 1, 'Canada', 'CAN', 'CA'),
(39, 1, 'Cape Verde', 'CPV', 'CV'),
(40, 1, 'Cayman Islands', 'CYM', 'KY'),
(41, 1, 'Central African Republic', 'CAF', 'CF'),
(42, 1, 'Chad', 'TCD', 'TD'),
(43, 1, 'Chile', 'CHL', 'CL'),
(44, 1, 'China', 'CHN', 'CN'),
(45, 1, 'Christmas Island', 'CXR', 'CX'),
(46, 1, 'Cocos (Keeling) Islands', 'CCK', 'CC'),
(47, 1, 'Colombia', 'COL', 'CO'),
(48, 1, 'Comoros', 'COM', 'KM'),
(49, 1, 'Congo', 'COG', 'CG'),
(50, 1, 'Cook Islands', 'COK', 'CK'),
(51, 1, 'Costa Rica', 'CRI', 'CR'),
(52, 1, 'Cote D''Ivoire', 'CIV', 'CI'),
(53, 1, 'Croatia', 'HRV', 'HR'),
(54, 1, 'Cuba', 'CUB', 'CU'),
(55, 1, 'Cyprus', 'CYP', 'CY'),
(56, 1, 'Czech Republic', 'CZE', 'CZ'),
(57, 1, 'Denmark', 'DNK', 'DK'),
(58, 1, 'Djibouti', 'DJI', 'DJ'),
(59, 1, 'Dominica', 'DMA', 'DM'),
(60, 1, 'Dominican Republic', 'DOM', 'DO'),
(61, 1, 'East Timor', 'TMP', 'TP'),
(62, 1, 'Ecuador', 'ECU', 'EC'),
(63, 1, 'Egypt', 'EGY', 'EG'),
(64, 1, 'El Salvador', 'SLV', 'SV'),
(65, 1, 'Equatorial Guinea', 'GNQ', 'GQ'),
(66, 1, 'Eritrea', 'ERI', 'ER'),
(67, 1, 'Estonia', 'EST', 'EE'),
(68, 1, 'Ethiopia', 'ETH', 'ET'),
(69, 1, 'Falkland Islands (Malvinas)', 'FLK', 'FK'),
(70, 1, 'Faroe Islands', 'FRO', 'FO'),
(71, 1, 'Fiji', 'FJI', 'FJ'),
(72, 1, 'Finland', 'FIN', 'FI'),
(73, 1, 'France', 'FRA', 'FR'),
(74, 1, 'France, Metropolitan', 'FXX', 'FX'),
(75, 1, 'French Guiana', 'GUF', 'GF'),
(76, 1, 'French Polynesia', 'PYF', 'PF'),
(77, 1, 'French Southern Territories', 'ATF', 'TF'),
(78, 1, 'Gabon', 'GAB', 'GA'),
(79, 1, 'Gambia', 'GMB', 'GM'),
(80, 1, 'Georgia', 'GEO', 'GE'),
(81, 1, 'Germany', 'DEU', 'DE'),
(82, 1, 'Ghana', 'GHA', 'GH'),
(83, 1, 'Gibraltar', 'GIB', 'GI'),
(84, 1, 'Greece', 'GRC', 'GR'),
(85, 1, 'Greenland', 'GRL', 'GL'),
(86, 1, 'Grenada', 'GRD', 'GD'),
(87, 1, 'Guadeloupe', 'GLP', 'GP'),
(88, 1, 'Guam', 'GUM', 'GU'),
(89, 1, 'Guatemala', 'GTM', 'GT'),
(90, 1, 'Guinea', 'GIN', 'GN'),
(91, 1, 'Guinea-bissau', 'GNB', 'GW'),
(92, 1, 'Guyana', 'GUY', 'GY'),
(93, 1, 'Haiti', 'HTI', 'HT'),
(94, 1, 'Heard and Mc Donald Islands', 'HMD', 'HM'),
(95, 1, 'Honduras', 'HND', 'HN'),
(96, 1, 'Hong Kong', 'HKG', 'HK'),
(97, 1, 'Hungary', 'HUN', 'HU'),
(98, 1, 'Iceland', 'ISL', 'IS'),
(99, 1, 'India', 'IND', 'IN'),
(100, 1, 'Indonesia', 'IDN', 'ID'),
(101, 1, 'Iran (Islamic Republic of)', 'IRN', 'IR'),
(102, 1, 'Iraq', 'IRQ', 'IQ'),
(103, 1, 'Ireland', 'IRL', 'IE'),
(104, 1, 'Israel', 'ISR', 'IL'),
(105, 1, 'Italy', 'ITA', 'IT'),
(106, 1, 'Jamaica', 'JAM', 'JM'),
(107, 1, 'Japan', 'JPN', 'JP'),
(108, 1, 'Jordan', 'JOR', 'JO'),
(109, 1, 'Kazakhstan', 'KAZ', 'KZ'),
(110, 1, 'Kenya', 'KEN', 'KE'),
(111, 1, 'Kiribati', 'KIR', 'KI'),
(112, 1, 'Korea, Democratic People''s Republic of', 'PRK', 'KP'),
(113, 1, 'Korea, Republic of', 'KOR', 'KR'),
(114, 1, 'Kuwait', 'KWT', 'KW'),
(115, 1, 'Kyrgyzstan', 'KGZ', 'KG'),
(116, 1, 'Lao People''s Democratic Republic', 'LAO', 'LA'),
(117, 1, 'Latvia', 'LVA', 'LV'),
(118, 1, 'Lebanon', 'LBN', 'LB'),
(119, 1, 'Lesotho', 'LSO', 'LS'),
(120, 1, 'Liberia', 'LBR', 'LR'),
(121, 1, 'Libyan Arab Jamahiriya', 'LBY', 'LY'),
(122, 1, 'Liechtenstein', 'LIE', 'LI'),
(123, 1, 'Lithuania', 'LTU', 'LT'),
(124, 1, 'Luxembourg', 'LUX', 'LU'),
(125, 1, 'Macau', 'MAC', 'MO'),
(126, 1, 'Macedonia, The Former Yugoslav Republic of', 'MKD', 'MK'),
(127, 1, 'Madagascar', 'MDG', 'MG'),
(128, 1, 'Malawi', 'MWI', 'MW'),
(129, 1, 'Malaysia', 'MYS', 'MY'),
(130, 1, 'Maldives', 'MDV', 'MV'),
(131, 1, 'Mali', 'MLI', 'ML'),
(132, 1, 'Malta', 'MLT', 'MT'),
(133, 1, 'Marshall Islands', 'MHL', 'MH'),
(134, 1, 'Martinique', 'MTQ', 'MQ'),
(135, 1, 'Mauritania', 'MRT', 'MR'),
(136, 1, 'Mauritius', 'MUS', 'MU'),
(137, 1, 'Mayotte', 'MYT', 'YT'),
(138, 1, 'Mexico', 'MEX', 'MX'),
(139, 1, 'Micronesia, Federated States of', 'FSM', 'FM'),
(140, 1, 'Moldova, Republic of', 'MDA', 'MD'),
(141, 1, 'Monaco', 'MCO', 'MC'),
(142, 1, 'Mongolia', 'MNG', 'MN'),
(143, 1, 'Montserrat', 'MSR', 'MS'),
(144, 1, 'Morocco', 'MAR', 'MA'),
(145, 1, 'Mozambique', 'MOZ', 'MZ'),
(146, 1, 'Myanmar', 'MMR', 'MM'),
(147, 1, 'Namibia', 'NAM', 'NA'),
(148, 1, 'Nauru', 'NRU', 'NR'),
(149, 1, 'Nepal', 'NPL', 'NP'),
(150, 1, 'Netherlands', 'NLD', 'NL'),
(151, 1, 'Netherlands Antilles', 'ANT', 'AN'),
(152, 1, 'New Caledonia', 'NCL', 'NC'),
(153, 1, 'New Zealand', 'NZL', 'NZ'),
(154, 1, 'Nicaragua', 'NIC', 'NI'),
(155, 1, 'Niger', 'NER', 'NE'),
(156, 1, 'Nigeria', 'NGA', 'NG'),
(157, 1, 'Niue', 'NIU', 'NU'),
(158, 1, 'Norfolk Island', 'NFK', 'NF'),
(159, 1, 'Northern Mariana Islands', 'MNP', 'MP'),
(160, 1, 'Norway', 'NOR', 'NO'),
(161, 1, 'Oman', 'OMN', 'OM'),
(162, 1, 'Pakistan', 'PAK', 'PK'),
(163, 1, 'Palau', 'PLW', 'PW'),
(164, 1, 'Panama', 'PAN', 'PA'),
(165, 1, 'Papua New Guinea', 'PNG', 'PG'),
(166, 1, 'Paraguay', 'PRY', 'PY'),
(167, 1, 'Peru', 'PER', 'PE'),
(168, 1, 'Philippines', 'PHL', 'PH'),
(169, 1, 'Pitcairn', 'PCN', 'PN'),
(170, 1, 'Poland', 'POL', 'PL'),
(171, 1, 'Portugal', 'PRT', 'PT'),
(172, 1, 'Puerto Rico', 'PRI', 'PR'),
(173, 1, 'Qatar', 'QAT', 'QA'),
(174, 1, 'Reunion', 'REU', 'RE'),
(175, 1, 'Romania', 'ROM', 'RO'),
(176, 1, 'Russian Federation', 'RUS', 'RU'),
(177, 1, 'Rwanda', 'RWA', 'RW'),
(178, 1, 'Saint Kitts and Nevis', 'KNA', 'KN'),
(179, 1, 'Saint Lucia', 'LCA', 'LC'),
(180, 1, 'Saint Vincent and the Grenadines', 'VCT', 'VC'),
(181, 1, 'Samoa', 'WSM', 'WS'),
(182, 1, 'San Marino', 'SMR', 'SM'),
(183, 1, 'Sao Tome and Principe', 'STP', 'ST'),
(184, 1, 'Saudi Arabia', 'SAU', 'SA'),
(185, 1, 'Senegal', 'SEN', 'SN'),
(186, 1, 'Seychelles', 'SYC', 'SC'),
(187, 1, 'Sierra Leone', 'SLE', 'SL'),
(188, 1, 'Singapore', 'SGP', 'SG'),
(189, 1, 'Slovakia (Slovak Republic)', 'SVK', 'SK'),
(190, 1, 'Slovenia', 'SVN', 'SI'),
(191, 1, 'Solomon Islands', 'SLB', 'SB'),
(192, 1, 'Somalia', 'SOM', 'SO'),
(193, 1, 'South Africa', 'ZAF', 'ZA'),
(194, 1, 'South Georgia and the South Sandwich Islands', 'SGS', 'GS'),
(195, 1, 'Spain', 'ESP', 'ES'),
(196, 1, 'Sri Lanka', 'LKA', 'LK'),
(197, 1, 'St. Helena', 'SHN', 'SH'),
(198, 1, 'St. Pierre and Miquelon', 'SPM', 'PM'),
(199, 1, 'Sudan', 'SDN', 'SD'),
(200, 1, 'Suriname', 'SUR', 'SR'),
(201, 1, 'Svalbard and Jan Mayen Islands', 'SJM', 'SJ'),
(202, 1, 'Swaziland', 'SWZ', 'SZ'),
(203, 1, 'Sweden', 'SWE', 'SE'),
(204, 1, 'Switzerland', 'CHE', 'CH'),
(205, 1, 'Syrian Arab Republic', 'SYR', 'SY'),
(206, 1, 'Taiwan', 'TWN', 'TW'),
(207, 1, 'Tajikistan', 'TJK', 'TJ'),
(208, 1, 'Tanzania, United Republic of', 'TZA', 'TZ'),
(209, 1, 'Thailand', 'THA', 'TH'),
(210, 1, 'Togo', 'TGO', 'TG'),
(211, 1, 'Tokelau', 'TKL', 'TK'),
(212, 1, 'Tonga', 'TON', 'TO'),
(213, 1, 'Trinidad and Tobago', 'TTO', 'TT'),
(214, 1, 'Tunisia', 'TUN', 'TN'),
(215, 1, 'Turkey', 'TUR', 'TR'),
(216, 1, 'Turkmenistan', 'TKM', 'TM'),
(217, 1, 'Turks and Caicos Islands', 'TCA', 'TC'),
(218, 1, 'Tuvalu', 'TUV', 'TV'),
(219, 1, 'Uganda', 'UGA', 'UG'),
(220, 1, 'Ukraine', 'UKR', 'UA'),
(221, 1, 'United Arab Emirates', 'ARE', 'AE'),
(222, 1, 'United Kingdom', 'GBR', 'GB'),
(223, 1, 'United States', 'USA', 'US'),
(224, 1, 'United States Minor Outlying Islands', 'UMI', 'UM'),
(225, 1, 'Uruguay', 'URY', 'UY'),
(226, 1, 'Uzbekistan', 'UZB', 'UZ'),
(227, 1, 'Vanuatu', 'VUT', 'VU'),
(228, 1, 'Vatican City State (Holy See)', 'VAT', 'VA'),
(229, 1, 'Venezuela', 'VEN', 'VE'),
(230, 1, 'Viet Nam', 'VNM', 'VN'),
(231, 1, 'Virgin Islands (British)', 'VGB', 'VG'),
(232, 1, 'Virgin Islands (U.S.)', 'VIR', 'VI'),
(233, 1, 'Wallis and Futuna Islands', 'WLF', 'WF'),
(234, 1, 'Western Sahara', 'ESH', 'EH'),
(235, 1, 'Yemen', 'YEM', 'YE'),
(236, 1, 'Yugoslavia', 'YUG', 'YU'),
(237, 1, 'Democratic Republic of Congo', 'DRC', 'DC'),
(238, 1, 'Zambia', 'ZMB', 'ZM'),
(239, 1, 'Zimbabwe', 'ZWE', 'ZW');

-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_vm_coupons`
--

CREATE TABLE IF NOT EXISTS `jos_vm_coupons` (
  `coupon_id` int(16) NOT NULL auto_increment,
  `coupon_code` varchar(32) NOT NULL default '',
  `percent_or_total` enum('percent','total') NOT NULL default 'percent',
  `coupon_type` enum('gift','permanent') NOT NULL default 'gift',
  `coupon_value` decimal(12,2) NOT NULL default '0.00',
  PRIMARY KEY  (`coupon_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='Used to store coupon codes' AUTO_INCREMENT=5 ;

--
-- Extraindo dados da tabela `jos_vm_coupons`
--

INSERT INTO `jos_vm_coupons` (`coupon_id`, `coupon_code`, `percent_or_total`, `coupon_type`, `coupon_value`) VALUES
(1, 'test1', 'total', 'gift', '6.00'),
(2, 'test2', 'percent', 'permanent', '15.00'),
(3, 'test3', 'total', 'permanent', '4.00'),
(4, 'test4', 'total', 'gift', '15.00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_vm_creditcard`
--

CREATE TABLE IF NOT EXISTS `jos_vm_creditcard` (
  `creditcard_id` int(11) NOT NULL auto_increment,
  `vendor_id` int(11) NOT NULL default '0',
  `creditcard_name` varchar(70) NOT NULL default '',
  `creditcard_code` varchar(30) NOT NULL default '',
  PRIMARY KEY  (`creditcard_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='Used to store credit card types' AUTO_INCREMENT=8 ;

--
-- Extraindo dados da tabela `jos_vm_creditcard`
--

INSERT INTO `jos_vm_creditcard` (`creditcard_id`, `vendor_id`, `creditcard_name`, `creditcard_code`) VALUES
(1, 1, 'Visa', 'VISA'),
(2, 1, 'MasterCard', 'MC'),
(3, 1, 'American Express', 'amex'),
(4, 1, 'Discover Card', 'discover'),
(5, 1, 'Diners Club', 'diners'),
(6, 1, 'JCB', 'jcb'),
(7, 1, 'Australian Bankcard', 'australian_bc');

-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_vm_csv`
--

CREATE TABLE IF NOT EXISTS `jos_vm_csv` (
  `field_id` int(11) NOT NULL auto_increment,
  `field_name` varchar(128) NOT NULL default '',
  `field_default_value` text,
  `field_ordering` int(3) NOT NULL default '0',
  `field_required` char(1) default 'N',
  PRIMARY KEY  (`field_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='Holds all fields which are used on CVS Ex-/Import' AUTO_INCREMENT=27 ;

--
-- Extraindo dados da tabela `jos_vm_csv`
--

INSERT INTO `jos_vm_csv` (`field_id`, `field_name`, `field_default_value`, `field_ordering`, `field_required`) VALUES
(1, 'product_sku', '', 1, 'Y'),
(2, 'product_s_desc', '', 5, 'N'),
(3, 'product_desc', '', 6, 'N'),
(4, 'product_thumb_image', '', 7, 'N'),
(5, 'product_full_image', '', 8, 'N'),
(6, 'product_weight', '', 9, 'N'),
(7, 'product_weight_uom', 'KG', 10, 'N'),
(8, 'product_length', '', 11, 'N'),
(9, 'product_width', '', 12, 'N'),
(10, 'product_height', '', 13, 'N'),
(11, 'product_lwh_uom', '', 14, 'N'),
(12, 'product_in_stock', '0', 15, 'N'),
(13, 'product_available_date', '', 16, 'N'),
(14, 'product_discount_id', '', 17, 'N'),
(15, 'product_name', '', 2, 'Y'),
(16, 'product_price', '', 4, 'N'),
(17, 'category_path', '', 3, 'Y'),
(18, 'manufacturer_id', '', 18, 'N'),
(19, 'product_tax_id', '', 19, 'N'),
(20, 'product_sales', '', 20, 'N'),
(21, 'product_parent_sku', '0', 21, 'N'),
(22, 'attribute', '', 22, 'N'),
(23, 'custom_attribute', '', 23, 'N'),
(24, 'attributes', '', 24, 'N'),
(25, 'attribute_values', '', 25, 'N'),
(26, 'product_discount', '', 26, 'N');

-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_vm_currency`
--

CREATE TABLE IF NOT EXISTS `jos_vm_currency` (
  `currency_id` int(11) NOT NULL auto_increment,
  `currency_name` varchar(64) default NULL,
  `currency_code` char(3) default NULL,
  PRIMARY KEY  (`currency_id`),
  KEY `idx_currency_name` (`currency_name`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='Used to store currencies' AUTO_INCREMENT=158 ;

--
-- Extraindo dados da tabela `jos_vm_currency`
--

INSERT INTO `jos_vm_currency` (`currency_id`, `currency_name`, `currency_code`) VALUES
(1, 'Andorran Peseta', 'ADP'),
(2, 'United Arab Emirates Dirham', 'AED'),
(3, 'Afghanistan Afghani', 'AFA'),
(4, 'Albanian Lek', 'ALL'),
(5, 'Netherlands Antillian Guilder', 'ANG'),
(6, 'Angolan Kwanza', 'AOK'),
(7, 'Argentinian Austral', 'ARA'),
(9, 'Australian Dollar', 'AUD'),
(10, 'Aruban Florin', 'AWG'),
(11, 'Barbados Dollar', 'BBD'),
(12, 'Bangladeshi Taka', 'BDT'),
(14, 'Bulgarian Lev', 'BGL'),
(15, 'Bahraini Dinar', 'BHD'),
(16, 'Burundi Franc', 'BIF'),
(17, 'Bermudian Dollar', 'BMD'),
(18, 'Brunei Dollar', 'BND'),
(19, 'Bolivian Boliviano', 'BOB'),
(20, 'Brazilian Real', 'BRL'),
(21, 'Bahamian Dollar', 'BSD'),
(22, 'Bhutan Ngultrum', 'BTN'),
(23, 'Burma Kyat', 'BUK'),
(24, 'Botswanian Pula', 'BWP'),
(25, 'Belize Dollar', 'BZD'),
(26, 'Canadian Dollar', 'CAD'),
(27, 'Swiss Franc', 'CHF'),
(28, 'Chilean Unidades de Fomento', 'CLF'),
(29, 'Chilean Peso', 'CLP'),
(30, 'Yuan (Chinese) Renminbi', 'CNY'),
(31, 'Colombian Peso', 'COP'),
(32, 'Costa Rican Colon', 'CRC'),
(33, 'Czech Koruna', 'CZK'),
(34, 'Cuban Peso', 'CUP'),
(35, 'Cape Verde Escudo', 'CVE'),
(36, 'Cyprus Pound', 'CYP'),
(40, 'Danish Krone', 'DKK'),
(41, 'Dominican Peso', 'DOP'),
(42, 'Algerian Dinar', 'DZD'),
(43, 'Ecuador Sucre', 'ECS'),
(44, 'Egyptian Pound', 'EGP'),
(46, 'Ethiopian Birr', 'ETB'),
(47, 'Euro', 'EUR'),
(49, 'Fiji Dollar', 'FJD'),
(50, 'Falkland Islands Pound', 'FKP'),
(52, 'British Pound', 'GBP'),
(53, 'Ghanaian Cedi', 'GHC'),
(54, 'Gibraltar Pound', 'GIP'),
(55, 'Gambian Dalasi', 'GMD'),
(56, 'Guinea Franc', 'GNF'),
(58, 'Guatemalan Quetzal', 'GTQ'),
(59, 'Guinea-Bissau Peso', 'GWP'),
(60, 'Guyanan Dollar', 'GYD'),
(61, 'Hong Kong Dollar', 'HKD'),
(62, 'Honduran Lempira', 'HNL'),
(63, 'Haitian Gourde', 'HTG'),
(64, 'Hungarian Forint', 'HUF'),
(65, 'Indonesian Rupiah', 'IDR'),
(66, 'Irish Punt', 'IEP'),
(67, 'Israeli Shekel', 'ILS'),
(68, 'Indian Rupee', 'INR'),
(69, 'Iraqi Dinar', 'IQD'),
(70, 'Iranian Rial', 'IRR'),
(73, 'Jamaican Dollar', 'JMD'),
(74, 'Jordanian Dinar', 'JOD'),
(75, 'Japanese Yen', 'JPY'),
(76, 'Kenyan Schilling', 'KES'),
(77, 'Kampuchean (Cambodian) Riel', 'KHR'),
(78, 'Comoros Franc', 'KMF'),
(79, 'North Korean Won', 'KPW'),
(80, '(South) Korean Won', 'KRW'),
(81, 'Kuwaiti Dinar', 'KWD'),
(82, 'Cayman Islands Dollar', 'KYD'),
(83, 'Lao Kip', 'LAK'),
(84, 'Lebanese Pound', 'LBP'),
(85, 'Sri Lanka Rupee', 'LKR'),
(86, 'Liberian Dollar', 'LRD'),
(87, 'Lesotho Loti', 'LSL'),
(89, 'Libyan Dinar', 'LYD'),
(90, 'Moroccan Dirham', 'MAD'),
(91, 'Malagasy Franc', 'MGF'),
(92, 'Mongolian Tugrik', 'MNT'),
(93, 'Macau Pataca', 'MOP'),
(94, 'Mauritanian Ouguiya', 'MRO'),
(95, 'Maltese Lira', 'MTL'),
(96, 'Mauritius Rupee', 'MUR'),
(97, 'Maldive Rufiyaa', 'MVR'),
(98, 'Malawi Kwacha', 'MWK'),
(99, 'Mexican Peso', 'MXP'),
(100, 'Malaysian Ringgit', 'MYR'),
(101, 'Mozambique Metical', 'MZM'),
(102, 'Nigerian Naira', 'NGN'),
(103, 'Nicaraguan Cordoba', 'NIC'),
(105, 'Norwegian Kroner', 'NOK'),
(106, 'Nepalese Rupee', 'NPR'),
(107, 'New Zealand Dollar', 'NZD'),
(108, 'Omani Rial', 'OMR'),
(109, 'Panamanian Balboa', 'PAB'),
(110, 'Peruvian Inti', 'PEI'),
(111, 'Papua New Guinea Kina', 'PGK'),
(112, 'Philippine Peso', 'PHP'),
(113, 'Pakistan Rupee', 'PKR'),
(114, 'Polish Zloty', 'PLZ'),
(116, 'Paraguay Guarani', 'PYG'),
(117, 'Qatari Rial', 'QAR'),
(118, 'Romanian Leu', 'ROL'),
(119, 'Rwanda Franc', 'RWF'),
(120, 'Saudi Arabian Riyal', 'SAR'),
(121, 'Solomon Islands Dollar', 'SBD'),
(122, 'Seychelles Rupee', 'SCR'),
(123, 'Sudanese Pound', 'SDP'),
(124, 'Swedish Krona', 'SEK'),
(125, 'Singapore Dollar', 'SGD'),
(126, 'St. Helena Pound', 'SHP'),
(127, 'Sierra Leone Leone', 'SLL'),
(128, 'Somali Schilling', 'SOS'),
(129, 'Suriname Guilder', 'SRG'),
(130, 'Sao Tome and Principe Dobra', 'STD'),
(131, 'Russian Ruble', 'RUB'),
(132, 'El Salvador Colon', 'SVC'),
(133, 'Syrian Potmd', 'SYP'),
(134, 'Swaziland Lilangeni', 'SZL'),
(135, 'Thai Bath', 'THB'),
(136, 'Tunisian Dinar', 'TND'),
(137, 'Tongan Pa''anga', 'TOP'),
(138, 'East Timor Escudo', 'TPE'),
(139, 'Turkish Lira', 'TRL'),
(140, 'Trinidad and Tobago Dollar', 'TTD'),
(141, 'Taiwan Dollar', 'TWD'),
(142, 'Tanzanian Schilling', 'TZS'),
(143, 'Uganda Shilling', 'UGS'),
(144, 'US Dollar', 'USD'),
(145, 'Uruguayan Peso', 'UYP'),
(146, 'Venezualan Bolivar', 'VEB'),
(147, 'Vietnamese Dong', 'VND'),
(148, 'Vanuatu Vatu', 'VUV'),
(149, 'Samoan Tala', 'WST'),
(150, 'Democratic Yemeni Dinar', 'YDD'),
(151, 'Yemeni Rial', 'YER'),
(152, 'New Yugoslavia Dinar', 'YUD'),
(153, 'South African Rand', 'ZAR'),
(154, 'Zambian Kwacha', 'ZMK'),
(155, 'Zaire Zaire', 'ZRZ'),
(156, 'Zimbabwe Dollar', 'ZWD'),
(157, 'Slovak Koruna', 'SKK');

-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_vm_function`
--

CREATE TABLE IF NOT EXISTS `jos_vm_function` (
  `function_id` int(11) NOT NULL auto_increment,
  `module_id` int(11) default NULL,
  `function_name` varchar(32) default NULL,
  `function_class` varchar(32) default NULL,
  `function_method` varchar(32) default NULL,
  `function_description` text,
  `function_perms` varchar(255) default NULL,
  PRIMARY KEY  (`function_id`),
  KEY `idx_function_module_id` (`module_id`),
  KEY `idx_function_name` (`function_name`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='Used to map a function alias to a ''real'' class::function' AUTO_INCREMENT=169 ;

--
-- Extraindo dados da tabela `jos_vm_function`
--

INSERT INTO `jos_vm_function` (`function_id`, `module_id`, `function_name`, `function_class`, `function_method`, `function_description`, `function_perms`) VALUES
(1, 1, 'userAdd', 'ps_user', 'add', '', 'admin,storeadmin'),
(2, 1, 'userDelete', 'ps_user', 'delete', '', 'admin,storeadmin'),
(3, 1, 'userUpdate', 'ps_user', 'update', '', 'admin,storeadmin'),
(4, 1, 'adminPasswdUpdate', 'ps_user', 'update_admin_passwd', 'Updates Site Administrator Password', 'admin'),
(31, 2, 'productAdd', 'ps_product', 'add', '', 'admin,storeadmin'),
(6, 1, 'functionAdd', 'ps_function', 'add', '', 'admin'),
(7, 1, 'functionUpdate', 'ps_function', 'update', '', 'admin'),
(8, 1, 'functionDelete', 'ps_function', 'delete', '', 'admin'),
(9, 1, 'userLogout', 'ps_user', 'logout', '', 'none'),
(10, 1, 'userAddressAdd', 'ps_user_address', 'add', '', 'admin,storeadmin,shopper,demo'),
(11, 1, 'userAddressUpdate', 'ps_user_address', 'update', '', 'admin,storeadmin,shopper'),
(12, 1, 'userAddressDelete', 'ps_user_address', 'delete', '', 'admin,storeadmin,shopper'),
(13, 1, 'moduleAdd', 'ps_module', 'add', '', 'admin'),
(14, 1, 'moduleUpdate', 'ps_module', 'update', '', 'admin'),
(15, 1, 'moduleDelete', 'ps_module', 'delete', '', 'admin'),
(16, 1, 'userLogin', 'ps_user', 'login', '', 'none'),
(17, 3, 'vendorAdd', 'ps_vendor', 'add', '', 'admin'),
(18, 3, 'vendorUpdate', 'ps_vendor', 'update', '', 'admin,storeadmin'),
(19, 3, 'vendorDelete', 'ps_vendor', 'delete', '', 'admin'),
(20, 3, 'vendorCategoryAdd', 'ps_vendor_category', 'add', '', 'admin'),
(21, 3, 'vendorCategoryUpdate', 'ps_vendor_category', 'update', '', 'admin'),
(22, 3, 'vendorCategoryDelete', 'ps_vendor_category', 'delete', '', 'admin'),
(23, 4, 'shopperAdd', 'ps_shopper', 'add', '', 'none'),
(24, 4, 'shopperDelete', 'ps_shopper', 'delete', '', 'admin,storeadmin'),
(25, 4, 'shopperUpdate', 'ps_shopper', 'update', '', 'admin,storeadmin,shopper'),
(26, 4, 'shopperGroupAdd', 'ps_shopper_group', 'add', '', 'admin,storeadmin'),
(27, 4, 'shopperGroupUpdate', 'ps_shopper_group', 'update', '', 'admin,storeadmin'),
(28, 4, 'shopperGroupDelete', 'ps_shopper_group', 'delete', '', 'admin,storeadmin'),
(29, 5, 'orderSearch', 'ps_order', 'find', '', 'admin,storeadmin,demo'),
(30, 5, 'orderStatusSet', 'ps_order', 'order_status_update', '', 'admin,storeadmin'),
(32, 2, 'productDelete', 'ps_product', 'delete', '', 'admin,storeadmin'),
(33, 2, 'productUpdate', 'ps_product', 'update', '', 'admin,storeadmin'),
(34, 2, 'productCategoryAdd', 'ps_product_category', 'add', '', 'admin,storeadmin'),
(35, 2, 'productCategoryUpdate', 'ps_product_category', 'update', '', 'admin,storeadmin'),
(36, 2, 'productCategoryDelete', 'ps_product_category', 'delete', '', 'admin,storeadmin'),
(37, 2, 'productPriceAdd', 'ps_product_price', 'add', '', 'admin,storeadmin'),
(38, 2, 'productPriceUpdate', 'ps_product_price', 'update', '', 'admin,storeadmin'),
(39, 2, 'productPriceDelete', 'ps_product_price', 'delete', '', 'admin,storeadmin'),
(40, 2, 'productAttributeAdd', 'ps_product_attribute', 'add', '', 'admin,storeadmin'),
(41, 2, 'productAttributeUpdate', 'ps_product_attribute', 'update', '', 'admin,storeadmin'),
(42, 2, 'productAttributeDelete', 'ps_product_attribute', 'delete', '', 'admin,storeadmin'),
(43, 7, 'cartAdd', 'ps_cart', 'add', '', 'none'),
(44, 7, 'cartUpdate', 'ps_cart', 'update', '', 'none'),
(45, 7, 'cartDelete', 'ps_cart', 'delete', '', 'none'),
(46, 10, 'checkoutComplete', 'ps_checkout', 'add', '', 'shopper,storeadmin,admin'),
(47, 1, 'setLanguage', 'ps_module', 'set_language', '', 'none'),
(48, 8, 'paymentMethodUpdate', 'ps_payment_method', 'update', '', 'admin,storeadmin'),
(49, 8, 'paymentMethodAdd', 'ps_payment_method', 'add', '', 'admin,storeadmin'),
(50, 8, 'paymentMethodDelete', 'ps_payment_method', 'delete', '', 'admin,storeadmin'),
(51, 5, 'orderDelete', 'ps_order', 'delete', '', 'admin,storeadmin'),
(52, 11, 'addTaxRate', 'ps_tax', 'add', '', 'admin,storeadmin'),
(53, 11, 'updateTaxRate', 'ps_tax', 'update', '', 'admin,storeadmin'),
(54, 11, 'deleteTaxRate', 'ps_tax', 'delete', '', 'admin,storeadmin'),
(55, 10, 'checkoutValidateST', 'ps_checkout', 'validate_shipto', '', 'none'),
(59, 5, 'orderStatusUpdate', 'ps_order_status', 'update', '', 'admin,storeadmin'),
(60, 5, 'orderStatusAdd', 'ps_order_status', 'add', '', 'storeadmin,admin'),
(61, 5, 'orderStatusDelete', 'ps_order_status', 'delete', '', 'admin,storeadmin'),
(62, 1, 'currencyAdd', 'ps_currency', 'add', 'add a currency', 'storeadmin,admin'),
(63, 1, 'currencyUpdate', 'ps_currency', 'update', '        update a currency', 'storeadmin,admin'),
(64, 1, 'currencyDelete', 'ps_currency', 'delete', 'delete a currency', 'storeadmin,admin'),
(65, 1, 'countryAdd', 'ps_country', 'add', 'Add a country ', 'storeadmin,admin'),
(66, 1, 'countryUpdate', 'ps_country', 'update', 'Update a country record', 'storeadmin,admin'),
(67, 1, 'countryDelete', 'ps_country', 'delete', 'Delete a country record', 'storeadmin,admin'),
(68, 2, 'product_csv', 'ps_csv', 'upload_csv', '', 'admin'),
(110, 7, 'waitingListAdd', 'zw_waiting_list', 'add', '', 'none'),
(111, 13, 'addzone', 'ps_zone', 'add', 'This will add a zone', 'admin,storeadmin'),
(112, 13, 'updatezone', 'ps_zone', 'update', 'This will update a zone', 'admin,storeadmin'),
(113, 13, 'deletezone', 'ps_zone', 'delete', 'This will delete a zone', 'admin,storeadmin'),
(114, 13, 'zoneassign', 'ps_zone', 'assign', 'This will assign a country to a zone', 'admin,storeadmin'),
(115, 1, 'writeConfig', 'ps_config', 'writeconfig', 'This will write the configuration details to phpshop.cfg.php', 'admin'),
(116, 12839, 'carrierAdd', 'ps_shipping', 'add', '', 'admin,storeadmin'),
(117, 12839, 'carrierDelete', 'ps_shipping', 'delete', '', 'admin,storeadmin'),
(118, 12839, 'carrierUpdate', 'ps_shipping', 'update', '', 'admin,storeadmin'),
(119, 12839, 'rateAdd', 'ps_shipping', 'rate_add', '', 'admin,storeadmin'),
(120, 12839, 'rateUpdate', 'ps_shipping', 'rate_update', '', 'admin,shopadmin'),
(121, 12839, 'rateDelete', 'ps_shipping', 'rate_delete', '', 'admin,storeadmin'),
(122, 10, 'checkoutProcess', 'ps_checkout', 'process', '', 'shopper,storeadmin,admin,demo'),
(123, 5, 'downloadRequest', 'ps_order', 'download_request', 'This checks if the download request is valid and sends the file to the browser as file download if the request was successful, otherwise echoes an error', 'admin,storeadmin,shopper'),
(124, 98, 'affiliateAdd', 'ps_affiliate', 'add', '', 'admin,storeadmin'),
(125, 98, 'affiliateUpdate', 'ps_affiliate', 'update', '', 'admin,storeadmin'),
(126, 98, 'affiliateDelete', 'ps_affiliate', 'delete', '', 'admin,storeadmin'),
(127, 98, 'affiliateEmail', 'ps_affiliate', 'email', '', 'admin,storeadmin'),
(128, 99, 'manufacturerAdd', 'ps_manufacturer', 'add', '', 'admin,storeadmin'),
(129, 99, 'manufacturerUpdate', 'ps_manufacturer', 'update', '', 'admin,storeadmin'),
(130, 99, 'manufacturerDelete', 'ps_manufacturer', 'delete', '', 'admin,storeadmin'),
(131, 99, 'manufacturercategoryAdd', 'ps_manufacturer_category', 'add', '', 'admin,storeadmin'),
(132, 99, 'manufacturercategoryUpdate', 'ps_manufacturer_category', 'update', '', 'admin,storeadmin'),
(133, 99, 'manufacturercategoryDelete', 'ps_manufacturer_category', 'delete', '', 'admin,storeadmin'),
(134, 7, 'addReview', 'ps_reviews', 'process_review', 'This lets the user add a review and rating to a product.', 'admin,storeadmin,shopper,demo'),
(135, 7, 'productReviewDelete', 'ps_reviews', 'delete_review', 'This deletes a review and from a product.', 'admin,storeadmin'),
(136, 8, 'creditcardAdd', 'ps_creditcard', 'add', 'Adds a Credit Card entry.', 'admin,storeadmin'),
(137, 8, 'creditcardUpdate', 'ps_creditcard', 'update', 'Updates a Credit Card entry.', 'admin,storeadmin'),
(138, 8, 'creditcardDelete', 'ps_creditcard', 'delete', 'Deletes a Credit Card entry.', 'admin,storeadmin'),
(139, 2, 'changePublishState', 'vmAbstractObject.class', 'handlePublishState', 'Changes the publish field of an item, so that it can be published or unpublished easily.', 'admin,storeadmin'),
(140, 2, 'export_csv', 'ps_csv', 'export_csv', 'This function exports all relevant product data to CSV.', 'admin,storeadmin'),
(141, 2, 'reorder', 'ps_product_category', 'reorder', 'Changes the list order of a category.', 'admin,storeadmin'),
(142, 2, 'discountAdd', 'ps_product_discount', 'add', 'Adds a discount.', 'admin,storeadmin'),
(143, 2, 'discountUpdate', 'ps_product_discount', 'update', 'Updates a discount.', 'admin,storeadmin'),
(144, 2, 'discountDelete', 'ps_product_discount', 'delete', 'Deletes a discount.', 'admin,storeadmin'),
(145, 8, 'shippingmethodSave', 'ps_shipping_method', 'save', '', 'admin,storeadmin'),
(146, 2, 'uploadProductFile', 'ps_product_files', 'add', 'Uploads and Adds a Product Image/File.', 'admin,storeadmin'),
(147, 2, 'updateProductFile', 'ps_product_files', 'update', 'Updates a Product Image/File.', 'admin,storeadmin'),
(148, 2, 'deleteProductFile', 'ps_product_files', 'delete', 'Deletes a Product Image/File.', 'admin,storeadmin'),
(149, 12843, 'couponAdd', 'ps_coupon', 'add_coupon_code', 'Adds a Coupon.', 'admin,storeadmin'),
(150, 12843, 'couponUpdate', 'ps_coupon', 'update_coupon', 'Updates a Coupon.', 'admin,storeadmin'),
(151, 12843, 'couponDelete', 'ps_coupon', 'remove_coupon_code', 'Deletes a Coupon.', 'admin,storeadmin'),
(152, 12843, 'couponProcess', 'ps_coupon', 'process_coupon_code', 'Processes a Coupon.', 'admin,storeadmin,shopper,demo'),
(153, 2, 'ProductTypeAdd', 'ps_product_type', 'add', 'Function add a Product Type and create new table product_type_<id>.', 'admin'),
(154, 2, 'ProductTypeUpdate', 'ps_product_type', 'update', 'Update a Product Type.', 'admin'),
(155, 2, 'ProductTypeDelete', 'ps_product_type', 'delete', 'Delete a Product Type and drop table product_type_<id>.', 'admin'),
(156, 2, 'ProductTypeReorder', 'ps_product_type', 'reorder', 'Changes the list order of a Product Type.', 'admin'),
(157, 2, 'ProductTypeAddParam', 'ps_product_type_parameter', 'add_parameter', 'Function add a Parameter into a Product Type and create new column in table product_type_<id>.', 'admin'),
(158, 2, 'ProductTypeUpdateParam', 'ps_product_type_parameter', 'update_parameter', 'Function update a Parameter in a Product Type and a column in table product_type_<id>.', 'admin'),
(159, 2, 'ProductTypeDeleteParam', 'ps_product_type_parameter', 'delete_parameter', 'Function delete a Parameter from a Product Type and drop a column in table product_type_<id>.', 'admin'),
(160, 2, 'ProductTypeReorderParam', 'ps_product_type_parameter', 'reorder_parameter', 'Changes the list order of a Parameter.', 'admin'),
(161, 2, 'productProductTypeAdd', 'ps_product_product_type', 'add', 'Add a Product into a Product Type.', 'admin,storeadmin'),
(162, 2, 'productProductTypeDelete', 'ps_product_product_type', 'delete', 'Delete a Product from a Product Type.', 'admin,storeadmin'),
(163, 1, 'stateAdd', 'ps_country', 'addState', 'Add a State ', 'storeadmin,admin'),
(164, 1, 'stateUpdate', 'ps_country', 'updateState', 'Update a state record', 'storeadmin,admin'),
(165, 1, 'stateDelete', 'ps_country', 'deleteState', 'Delete a state record', 'storeadmin,admin'),
(166, 2, 'csvFieldAdd', 'ps_csv', 'add', 'Add a CSV Field ', 'storeadmin,admin'),
(167, 2, 'csvFieldUpdate', 'ps_csv', 'update', 'Update a CSV Field', 'storeadmin,admin'),
(168, 2, 'csvFieldDelete', 'ps_csv', 'delete', 'Delete a CSV Field', 'storeadmin,admin');

-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_vm_manufacturer`
--

CREATE TABLE IF NOT EXISTS `jos_vm_manufacturer` (
  `manufacturer_id` int(11) NOT NULL auto_increment,
  `mf_name` varchar(64) default NULL,
  `mf_email` varchar(255) default NULL,
  `mf_desc` text,
  `mf_category_id` int(11) default NULL,
  `mf_url` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`manufacturer_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='Manufacturers are those who create products' AUTO_INCREMENT=3 ;

--
-- Extraindo dados da tabela `jos_vm_manufacturer`
--

INSERT INTO `jos_vm_manufacturer` (`manufacturer_id`, `mf_name`, `mf_email`, `mf_desc`, `mf_category_id`, `mf_url`) VALUES
(2, 'Comemorare', '', '<p>A Comemorare - Artigos para Festas iniciou suas atividades no in&iacute;cio de 2003. Com sede em Curitiba, a equipe Comemorare busca sempre atender satisfatoriamente seus clientes de todo o Brasil. </p><p>Para tanto estamos sempre buscando novidades no mercado mundial de festas. A Comemorare hoje comercializa diversas linhas de produtos, importados, nacionais e de fabrica&ccedil;&atilde;o pr&oacute;pria, tudo para oferecer sempre o melhor pre&ccedil;o e qualidade ao cliente.</p>', 1, '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_vm_manufacturer_category`
--

CREATE TABLE IF NOT EXISTS `jos_vm_manufacturer_category` (
  `mf_category_id` int(11) NOT NULL auto_increment,
  `mf_category_name` varchar(64) default NULL,
  `mf_category_desc` text,
  PRIMARY KEY  (`mf_category_id`),
  KEY `idx_manufacturer_category_category_name` (`mf_category_name`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='Manufactorers are assigned to these categories' AUTO_INCREMENT=2 ;

--
-- Extraindo dados da tabela `jos_vm_manufacturer_category`
--

INSERT INTO `jos_vm_manufacturer_category` (`mf_category_id`, `mf_category_name`, `mf_category_desc`) VALUES
(1, '-default-', 'This is the default manufacturer category');

-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_vm_module`
--

CREATE TABLE IF NOT EXISTS `jos_vm_module` (
  `module_id` int(11) NOT NULL auto_increment,
  `module_name` varchar(255) default NULL,
  `module_description` text,
  `module_perms` varchar(255) default NULL,
  `module_publish` char(1) default NULL,
  `list_order` int(11) default NULL,
  PRIMARY KEY  (`module_id`),
  KEY `idx_module_name` (`module_name`),
  KEY `idx_module_list_order` (`list_order`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='VirtueMart Core Modules, not: Joomla modules' AUTO_INCREMENT=12844 ;

--
-- Extraindo dados da tabela `jos_vm_module`
--

INSERT INTO `jos_vm_module` (`module_id`, `module_name`, `module_description`, `module_perms`, `module_publish`, `list_order`) VALUES
(1, 'admin', '<h4>ADMINISTRATIVE USERS ONLY</h4>\r\n\r\n<p>Only used for the following:</p>\r\n<OL>\r\n\r\n<LI>User Maintenance</LI>\r\n<LI>Module Maintenance</LI>\r\n<LI>Function Maintenance</LI>\r\n</OL>\r\n', 'admin', 'Y', 1),
(2, 'product', '<p>Here you can adminster your online catalog of products.  The Product Administrator allows you to create product categories, create new products, edit product attributes, and add product items for each attribute value.</p>', 'storeadmin,admin', 'Y', 4),
(3, 'vendor', '<h4>ADMINISTRATIVE USERS ONLY</h4>\r\n<p>Here you can manage the vendors on the phpShop system.</p>', 'admin', 'N', 12),
(4, 'shopper', '<p>Manage shoppers in your store.  Allows you to create shopper groups.  Shopper groups can be used when setting the price for a product.  This allows you to create different prices for different types of users.  An example of this would be to have a ''wholesale'' group and a ''retail'' group. </p>', 'admin,storeadmin', 'Y', 4),
(5, 'order', '<p>View Order and Update Order Status.</p>', 'admin,storeadmin', 'Y', 5),
(6, 'msgs', 'This module is unprotected an used for displaying system messages to users.  We need to have an area that does not require authorization when things go wrong.', 'none', 'N', 99),
(7, 'shop', 'This is the Washupito store module.  This is the demo store included with the phpShop distribution.', 'none', 'Y', 99),
(8, 'store', '', 'storeadmin,admin', 'Y', 2),
(9, 'account', 'This module allows shoppers to update their account information and view previously placed orders.', 'shopper,storeadmin,admin,demo', 'N', 99),
(10, 'checkout', '', 'none', 'N', 99),
(11, 'tax', 'The tax module allows you to set tax rates for states or regions within a country.  The rate is set as a decimal figure.  For example, 2 percent tax would be 0.02.', 'admin,storeadmin', 'Y', 8),
(12, 'reportbasic', 'The report basic module allows you to do queries on all orders.', 'admin,storeadmin', 'Y', 7),
(13, 'zone', 'This is the zone-shipping module. Here you can manage your shipping costs according to Zones.', 'admin,storeadmin', 'N', 9),
(12839, 'shipping', '<h4>Shipping</h4><p>Let this module calculate the shipping fees for your customers.<br>Create carriers for shipping areas and weight groups.</p>', 'admin,storeadmin', 'Y', 10),
(98, 'affiliate', 'administrate the affiliates on your store.', 'storeadmin,admin', 'N', 99),
(99, 'manufacturer', 'Manage the manufacturers of products in your store.', 'storeadmin,admin', 'Y', 6),
(12842, 'help', 'Help Module', 'admin,storeadmin', 'Y', 13),
(12843, 'coupon', 'Coupon Management', 'admin,storeadmin', 'Y', 11);

-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_vm_orders`
--

CREATE TABLE IF NOT EXISTS `jos_vm_orders` (
  `order_id` int(11) NOT NULL auto_increment,
  `user_id` int(11) NOT NULL default '0',
  `vendor_id` int(11) NOT NULL default '0',
  `order_number` varchar(32) default NULL,
  `user_info_id` varchar(32) default NULL,
  `order_total` decimal(15,2) NOT NULL default '0.00',
  `order_subtotal` decimal(15,5) default NULL,
  `order_tax` decimal(10,2) default NULL,
  `order_tax_details` text NOT NULL,
  `order_shipping` decimal(10,2) default NULL,
  `order_shipping_tax` decimal(10,2) default NULL,
  `coupon_discount` decimal(12,2) NOT NULL default '0.00',
  `order_discount` decimal(12,2) NOT NULL default '0.00',
  `order_currency` varchar(16) default NULL,
  `order_status` char(1) default NULL,
  `cdate` int(11) default NULL,
  `mdate` int(11) default NULL,
  `ship_method_id` varchar(255) default NULL,
  `customer_note` text NOT NULL,
  `ip_address` varchar(15) NOT NULL default '',
  PRIMARY KEY  (`order_id`),
  KEY `idx_orders_user_id` (`user_id`),
  KEY `idx_orders_vendor_id` (`vendor_id`),
  KEY `idx_orders_order_number` (`order_number`),
  KEY `idx_orders_user_info_id` (`user_info_id`),
  KEY `idx_orders_ship_method_id` (`ship_method_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='Used to store all orders' AUTO_INCREMENT=6 ;

--
-- Extraindo dados da tabela `jos_vm_orders`
--

INSERT INTO `jos_vm_orders` (`order_id`, `user_id`, `vendor_id`, `order_number`, `user_info_id`, `order_total`, `order_subtotal`, `order_tax`, `order_tax_details`, `order_shipping`, `order_shipping_tax`, `coupon_discount`, `order_discount`, `order_currency`, `order_status`, `cdate`, `mdate`, `ship_method_id`, `customer_note`, `ip_address`) VALUES
(1, 67, 1, '9b6cd659ecbf6ae562e38c9cc83cd4d4', '08816bfbcc3c1082ce14d953f3a2ef2e', '240.30', '176.72055', '14.58', 'a:0:{}', '49.00', '0.00', '0.00', '0.00', 'BRL', 'P', 1185400516, 1185546403, 'standard_shipping|DHL|World_2 &gt; 8kg|49.00|18', '', '201.35.192.223'),
(2, 67, 1, 'a239949e9f3fdf635301c1c078f52ed8', '08816bfbcc3c1082ce14d953f3a2ef2e', '168.99', '140.97921', '11.78', 'a:1:{s:6:"0.0825";d:1.0954628175519633970225186203606426715850830078125;}', '13.28', '1.10', '0.00', '-2.00', 'BRL', 'P', 1185570502, 1185570502, 'flex|STD|Standard Shipping over 25.00|14.3738', '', '201.41.206.131'),
(3, 68, 1, '0af9ad21b47c956571bbb9a6c4a37687', '7806273a5ccfb7a48a063fbbb596d30c', '17.08', '7.00231', '0.73', 'a:0:{}', '7.50', '0.00', '0.00', '-2.00', 'BRL', 'P', 1185580779, 1185580779, 'correios_encomenda|Correios Brasil|Encomenda Normal|7.5', 'se não tiver ninguém na portaria, por favor ligar', '201.11.77.78'),
(4, 67, 1, 'e3cd341348879ba02d1ef14f255ce9a4', '08816bfbcc3c1082ce14d953f3a2ef2e', '312.66', '259.95381', '21.60', 'a:0:{}', '29.26', '0.00', '0.00', '-2.00', 'BRL', 'P', 1185646326, 1185646326, 'correios_sedex|Correios Brasil|SEDEX Normal|29.26', 'f djslkaf dçlkaj fdlçkaj fdlks', '201.2.227.110'),
(5, 67, 1, '024e2b23962060aafa61b55e0fed57be', '08816bfbcc3c1082ce14d953f3a2ef2e', '23.26', '12.80370', '1.06', 'a:0:{}', '9.40', '0.00', '0.00', '0.00', 'BRL', 'P', 1186091789, 1186091789, 'correios_sedex|Correios Brasil|SEDEX Normal|9.4', 'ggdsgfds', '201.14.171.148');

-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_vm_order_history`
--

CREATE TABLE IF NOT EXISTS `jos_vm_order_history` (
  `order_status_history_id` int(11) NOT NULL auto_increment,
  `order_id` int(11) NOT NULL default '0',
  `order_status_code` char(1) NOT NULL default '0',
  `date_added` datetime NOT NULL default '0000-00-00 00:00:00',
  `customer_notified` int(1) default '0',
  `comments` text,
  PRIMARY KEY  (`order_status_history_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='Stores all actions and changes that occur to an order' AUTO_INCREMENT=8 ;

--
-- Extraindo dados da tabela `jos_vm_order_history`
--

INSERT INTO `jos_vm_order_history` (`order_status_history_id`, `order_id`, `order_status_code`, `date_added`, `customer_notified`, `comments`) VALUES
(1, 1, 'P', '2007-07-25 18:55:16', 1, ''),
(2, 1, 'C', '2007-07-27 11:18:39', 1, ''),
(3, 1, 'P', '2007-07-27 11:26:43', 1, ''),
(4, 2, 'P', '2007-07-27 18:08:22', 1, ''),
(5, 3, 'P', '2007-07-27 20:59:39', 1, ''),
(6, 4, 'P', '2007-07-28 15:12:06', 1, ''),
(7, 5, 'P', '2007-08-02 18:56:29', 1, '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_vm_order_item`
--

CREATE TABLE IF NOT EXISTS `jos_vm_order_item` (
  `order_item_id` int(11) NOT NULL auto_increment,
  `order_id` int(11) default NULL,
  `user_info_id` varchar(32) default NULL,
  `vendor_id` int(11) default NULL,
  `product_id` int(11) default NULL,
  `order_item_sku` varchar(64) NOT NULL default '',
  `order_item_name` varchar(64) NOT NULL default '',
  `product_quantity` int(11) default NULL,
  `product_item_price` decimal(15,5) default NULL,
  `product_final_price` decimal(12,2) NOT NULL default '0.00',
  `order_item_currency` varchar(16) default NULL,
  `order_status` char(1) default NULL,
  `cdate` int(11) default NULL,
  `mdate` int(11) default NULL,
  `product_attribute` text,
  PRIMARY KEY  (`order_item_id`),
  KEY `idx_order_item_order_id` (`order_id`),
  KEY `idx_order_item_user_info_id` (`user_info_id`),
  KEY `idx_order_item_vendor_id` (`vendor_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='Stores all items (products) which are part of an order' AUTO_INCREMENT=7 ;

--
-- Extraindo dados da tabela `jos_vm_order_item`
--

INSERT INTO `jos_vm_order_item` (`order_item_id`, `order_id`, `user_info_id`, `vendor_id`, `product_id`, `order_item_sku`, `order_item_name`, `product_quantity`, `product_item_price`, `product_final_price`, `order_item_currency`, `order_status`, `cdate`, `mdate`, `product_attribute`) VALUES
(1, 1, '08816bfbcc3c1082ce14d953f3a2ef2e', 1, 8, 'P02', 'Circular Saw', 1, '176.72000', '191.30', 'USD', 'P', 1185400516, 1185546403, 'Size:M; Power:middle'),
(2, 2, '08816bfbcc3c1082ce14d953f3a2ef2e', 1, 43, 'COM000028', 'Boá de Tule Verde', 10, '13.00000', '14.07', 'BRL', 'P', 1185570502, 1185570502, ''),
(3, 2, '08816bfbcc3c1082ce14d953f3a2ef2e', 1, 44, 'COM000029', 'Buzina de Gás', 1, '11.00000', '11.91', 'BRL', 'P', 1185570502, 1185570502, ''),
(4, 3, '7806273a5ccfb7a48a063fbbb596d30c', 1, 20, 'COM000004', 'Bico de Pato com Strass', 1, '7.00000', '7.58', 'BRL', 'P', 1185580779, 1185580779, ''),
(5, 4, '08816bfbcc3c1082ce14d953f3a2ef2e', 1, 32, 'COM000017', 'Boá de Penas Verde e Limão', 20, '13.00000', '14.07', 'BRL', 'P', 1185646326, 1185646326, ''),
(6, 5, '08816bfbcc3c1082ce14d953f3a2ef2e', 1, 17, 'COM000001', 'Asa de Borboleta Pequena', 1, '12.80000', '13.86', 'BRL', 'P', 1186091789, 1186091789, '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_vm_order_payment`
--

CREATE TABLE IF NOT EXISTS `jos_vm_order_payment` (
  `order_id` int(11) NOT NULL default '0',
  `payment_method_id` int(11) default NULL,
  `order_payment_code` varchar(30) NOT NULL default '',
  `order_payment_number` blob,
  `order_payment_expire` int(11) default NULL,
  `order_payment_name` varchar(255) default NULL,
  `order_payment_log` text,
  `order_payment_trans_id` text NOT NULL,
  KEY `idx_order_payment_order_id` (`order_id`),
  KEY `idx_order_payment_method_id` (`payment_method_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='The payment method that was chosen for a specific order';

--
-- Extraindo dados da tabela `jos_vm_order_payment`
--

INSERT INTO `jos_vm_order_payment` (`order_id`, `payment_method_id`, `order_payment_code`, `order_payment_number`, `order_payment_expire`, `order_payment_name`, `order_payment_log`, `order_payment_trans_id`) VALUES
(1, 4, '', '', 0, '', '', ''),
(2, 2, '', '', 0, '', 'A informação sobre o pagamento foi\nguardada para posterior processamento.<BR>', ''),
(3, 2, '', '', 0, '', 'A informação sobre o pagamento foi\nguardada para posterior processamento.<BR>', ''),
(4, 2, '', '', 0, '', 'A informação sobre o pagamento foi\nguardada para posterior processamento.<BR>', ''),
(5, 17, '', '', 0, '', '', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_vm_order_status`
--

CREATE TABLE IF NOT EXISTS `jos_vm_order_status` (
  `order_status_id` int(11) NOT NULL auto_increment,
  `order_status_code` char(1) NOT NULL default '',
  `order_status_name` varchar(64) default NULL,
  `list_order` int(11) default NULL,
  `vendor_id` int(11) default NULL,
  PRIMARY KEY  (`order_status_id`),
  KEY `idx_order_status_list_order` (`list_order`),
  KEY `idx_order_status_vendor_id` (`vendor_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='All available order statuses' AUTO_INCREMENT=6 ;

--
-- Extraindo dados da tabela `jos_vm_order_status`
--

INSERT INTO `jos_vm_order_status` (`order_status_id`, `order_status_code`, `order_status_name`, `list_order`, `vendor_id`) VALUES
(1, 'P', 'Pendente', 1, 1),
(2, 'C', 'Confirmado', 2, 1),
(3, 'X', 'Cancelado', 3, 1),
(4, 'R', 'Reembolsado', 4, 1),
(5, 'S', 'Enviado', 5, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_vm_order_user_info`
--

CREATE TABLE IF NOT EXISTS `jos_vm_order_user_info` (
  `order_info_id` int(11) NOT NULL auto_increment,
  `order_id` int(11) NOT NULL default '0',
  `user_id` int(11) NOT NULL default '0',
  `address_type` char(2) default NULL,
  `address_type_name` varchar(32) default NULL,
  `company` varchar(64) default NULL,
  `title` varchar(32) default NULL,
  `last_name` varchar(32) default NULL,
  `first_name` varchar(32) default NULL,
  `middle_name` varchar(32) default NULL,
  `phone_1` varchar(32) default NULL,
  `phone_2` varchar(32) default NULL,
  `fax` varchar(32) default NULL,
  `address_1` varchar(64) NOT NULL default '',
  `address_2` varchar(64) default NULL,
  `city` varchar(32) NOT NULL default '',
  `state` varchar(32) NOT NULL default '',
  `country` varchar(32) NOT NULL default 'US',
  `zip` varchar(32) NOT NULL default '',
  `user_email` varchar(255) default NULL,
  `extra_field_1` varchar(255) default NULL,
  `extra_field_2` varchar(255) default NULL,
  `extra_field_3` varchar(255) default NULL,
  `extra_field_4` char(1) default NULL,
  `extra_field_5` char(1) default NULL,
  `bank_account_nr` varchar(32) NOT NULL default '',
  `bank_name` varchar(32) NOT NULL default '',
  `bank_sort_code` varchar(16) NOT NULL default '',
  `bank_iban` varchar(64) NOT NULL default '',
  `bank_account_holder` varchar(48) NOT NULL default '',
  `bank_account_type` enum('Checking','Business Checking','Savings') NOT NULL default 'Checking',
  PRIMARY KEY  (`order_info_id`),
  KEY `idx_order_info_order_id` (`order_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='Stores the BillTo and ShipTo Information at order time' AUTO_INCREMENT=6 ;

--
-- Extraindo dados da tabela `jos_vm_order_user_info`
--

INSERT INTO `jos_vm_order_user_info` (`order_info_id`, `order_id`, `user_id`, `address_type`, `address_type_name`, `company`, `title`, `last_name`, `first_name`, `middle_name`, `phone_1`, `phone_2`, `fax`, `address_1`, `address_2`, `city`, `state`, `country`, `zip`, `user_email`, `extra_field_1`, `extra_field_2`, `extra_field_3`, `extra_field_4`, `extra_field_5`, `bank_account_nr`, `bank_name`, `bank_sort_code`, `bank_iban`, `bank_account_holder`, `bank_account_type`) VALUES
(1, 1, 67, 'BT', '-default-', '', 'Sr.', 'Vasconcellos', 'Leonardo', 'Lima de', '(47) 34346908', '(47) 8405-1020', '', 'Rua Orestes Guimarães, 255 - apto 401', 'Centro', 'Joinville', '', 'BRA', '89217-001', 'leo_lima_jlle@yahoo.com.br', '', '', '', '', '', '', '', '', '', '', ''),
(2, 2, 67, 'BT', '-default-', '', 'Sr.', 'Vasconcellos', 'Leonardo', 'Lima de', '(47) 34346908', '(47) 8405-1020', '', 'Rua Orestes Guimarães, 255 - apto 401', 'Centro', 'Joinville', '', 'BRA', '89217-001', 'leo_lima_jlle@yahoo.com.br', '', '', '', '', '', '', '', '', '', '', ''),
(3, 3, 68, 'BT', '-default-', '', 'Sra.', 'Lima', 'Denise', 'Alcantara Bezerra', '47-34346908', '47-99610414', '', 'Rua Orestes Guimarães, 225 apt. 604, centro', '', 'Joinville', '', 'BRA', '89204060', 'denisejlle@hotmail.com', '', '', '', '', '', '', '', '', '', '', ''),
(4, 4, 67, 'BT', '-default-', '', 'Sr.', 'Vasconcellos', 'Leonardo', 'Lima de', '(47) 34346908', '(47) 8405-1020', '', 'Rua Orestes Guimarães, 255 - apto 401', 'Centro', 'Joinville', '', 'BRA', '89217-001', 'leo_lima_jlle@yahoo.com.br', '', '', '', '', '', '', '', '', '', '', ''),
(5, 5, 67, 'BT', '-default-', '', 'Sr.', 'Vasconcellos', 'Leonardo', 'Lima de', '(47) 34346908', '(47) 8405-1020', '', 'Rua Orestes Guimarães, 255 - apto 401', 'Centro', 'Joinville', '', 'BRA', '89217-001', 'leo_lima_jlle@yahoo.com.br', '', '', '', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_vm_payment_method`
--

CREATE TABLE IF NOT EXISTS `jos_vm_payment_method` (
  `payment_method_id` int(11) NOT NULL auto_increment,
  `vendor_id` int(11) default NULL,
  `payment_method_name` varchar(255) default NULL,
  `payment_class` varchar(50) NOT NULL default '',
  `shopper_group_id` int(11) default NULL,
  `payment_method_discount` decimal(12,2) default NULL,
  `list_order` int(11) default NULL,
  `payment_method_code` varchar(8) default NULL,
  `enable_processor` char(1) default NULL,
  `is_creditcard` tinyint(1) NOT NULL default '0',
  `payment_enabled` char(1) NOT NULL default 'N',
  `accepted_creditcards` varchar(128) NOT NULL default '',
  `payment_extrainfo` text NOT NULL,
  `payment_passkey` blob NOT NULL,
  PRIMARY KEY  (`payment_method_id`),
  KEY `idx_payment_method_vendor_id` (`vendor_id`),
  KEY `idx_payment_method_name` (`payment_method_name`),
  KEY `idx_payment_method_list_order` (`list_order`),
  KEY `idx_payment_method_shopper_group_id` (`shopper_group_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='The payment methods of your store' AUTO_INCREMENT=18 ;

--
-- Extraindo dados da tabela `jos_vm_payment_method`
--

INSERT INTO `jos_vm_payment_method` (`payment_method_id`, `vendor_id`, `payment_method_name`, `payment_class`, `shopper_group_id`, `payment_method_discount`, `list_order`, `payment_method_code`, `enable_processor`, `is_creditcard`, `payment_enabled`, `accepted_creditcards`, `payment_extrainfo`, `payment_passkey`) VALUES
(1, 1, 'Purchase Order', '', 6, '0.00', 4, 'PO', 'N', 0, 'N', '', '', ''),
(2, 1, 'Cash On Delivery', '', 5, '-2.00', 5, 'COD', 'N', 0, 'N', '', '', ''),
(3, 1, 'Credit Card', 'ps_authorize', 5, '0.00', 0, 'AN', 'Y', 0, 'N', '1,2,6,7,', '', ''),
(4, 1, 'PayPal', 'ps_paypal', 5, '0.00', 0, 'PP', 'P', 0, 'N', '', '\n<?php\n$url = "https://www.paypal.com/cgi-bin/webscr";\n$tax_total = $db->f("order_tax") + $db->f("order_shipping_tax");\n$discount_total = $db->f("coupon_discount") + $db->f("order_discount");\n$post_variables = Array(\n"cmd" => "_xclick",\n"business" => PAYPAL_EMAIL,\n"receiver_email" => PAYPAL_EMAIL,\n"item_name" => $VM_LANG->_PHPSHOP_ORDER_PRINT_PO_NUMBER.": ". $db->f("order_id"),\n"order_id" => $db->f("order_id"),\n"invoice" => $db->f("order_number"),\n"amount" => round( $db->f("order_subtotal")+$tax_total-$discount_total, 2),\n"shipping" => sprintf("%.2f", $db->f("order_shipping")),\n"currency_code" => $_SESSION[''vendor_currency''],"first_name" => $dbbt->f(''first_name''),\n"last_name" => $dbbt->f(''last_name''),\n"address_street" => $dbbt->f(''address_1''),\n"address_zip" => $dbbt->f(''zip''),\n"address_city" => $dbbt->f(''city''),\n"address_state" => $dbbt->f(''state''),\n"address_country" => $dbbt->f(''country''),\n"image_url" => $vendor_image_url,\n"return" => SECUREURL ."index.php?option=com_virtuemart&page=checkout.result&order_id=".$db->f("order_id"),\n"notify_url" => SECUREURL ."administrator/components/com_virtuemart/notify.php",\n"cancel_return" => SECUREURL ."index.php",\n"undefined_quantity" => "0",\n"test_ipn" => PAYPAL_DEBUG,\n"pal" => "NRUBJXESJTY24",\n"no_shipping" => "1",\n"no_note" => "1"\n);\nif( $page == "checkout.thankyou" ) {\n$query_string = "?";\nforeach( $post_variables as $name => $value ) {\n$query_string .= $name. "=" . urlencode($value) ."&";\n}\nmosRedirect( $url . $query_string );\n} else {\n\necho ''<form action="''.$url.''" method="post" target="_blank">'';\necho ''<input type="image" name="submit" src="http://images.paypal.com/images/x-click-but6.gif" border="0" alt="Make payments with PayPal, it is fast, free, and secure!" />'';\n\nforeach( $post_variables as $name => $value ) {\necho ''<input type="hidden" name="''.$name.''" value="''.$value.''" />'';\n}\n\necho ''</form>'';\n\n}\n?>', ''),
(5, 1, 'PayMate', 'ps_paymate', 5, '0.00', 0, 'PM', 'P', 0, 'N', '', '<script type="text/javascript" language="javascript">\n  function openExpress(){\n	var url = ''https://www.paymate.com.au/PayMate/ExpressPayment?mid=<?php echo PAYMATE_USERNAME.\n	  "&amt=".$db->f("order_total").\n	  "&currency=".$_SESSION[''vendor_currency''].\n	  "&ref=".$db->f("order_id").\n	  "&pmt_sender_email=".$user->email.\n	  "&pmt_contact_firstname=".$user->first_name.\n	  "&pmt_contact_surname=".$user->last_name.\n	  "&regindi_address1=".$user->address_1.\n	  "&regindi_address2=".$user->address_2.\n	  "&regindi_sub=".$user->city.\n	  "&regindi_pcode=".$user->zip;?>''\n	var newWin = window.open(url, ''wizard'', ''height=640,width=500,scrollbars=0,toolbar=no'');\n	self.name = ''parent'';\n	newWin.focus();\n  }\n  </script>\n  <div align="center">\n  <p>\n  <a href="javascript:openExpress();">\n  <img src="https://www.paymate.com.au/homepage/images/butt_PayNow.gif" border="0" alt="Pay with Paymate Express">\n  <br />click here to pay your account</a>\n  </p>\n  </div>', ''),
(6, 1, 'WorldPay', 'ps_worldpay', 5, '0.00', 0, 'WP', 'P', 0, 'N', '', '<form action="https://select.worldpay.com/wcc/purchase" method="post">\n						  <input type=hidden name="testMode" value="100"> \n						  <input type="hidden" name="instId" value="<?php echo WORLDPAY_INST_ID ?>" />\n						  <input type="hidden" name="cartId" value="<?php echo $db->f("order_id") ?>" />\n						  <input type="hidden" name="amount" value="<?php echo $db->f("order_total") ?>" />\n						  <input type="hidden" name="currency" value="<?php echo $_SESSION[''vendor_currency''] ?>" />\n						  <input type="hidden" name="desc" value="Products" />\n						  <input type="hidden" name="email" value="<?php echo $user->email?>" />\n						  <input type="hidden" name="address" value="<?php echo $user->address_1?>&#10<?php echo $user->address_2?>&#10<?php echo\n						  $user->city?>&#10<?php echo $user->state?>" />\n						  <input type="hidden" name="name" value="<?php echo $user->title?><?php echo $user->first_name?>. <?php echo $user->middle_name?><?php echo $user->last_name?>" />\n						  <input type="hidden" name="country" value="<?php echo $user->country?>"/>\n						  <input type="hidden" name="postcode" value="<?php echo $user->zip?>" />\n						  <input type="hidden" name="tel"  value="<?php echo $user->phone_1?>">\n						  <input type="hidden" name="withDelivery"  value="true">\n						  <br />\n						  <input type="submit" value ="PROCEED TO PAYMENT PAGE" />\n						  </form>', ''),
(7, 1, '2Checkout', 'ps_twocheckout', 5, '0.00', 0, '2CO', 'P', 0, 'N', '', '<?php\n	$q  = "SELECT * FROM #__users WHERE user_info_id=''".$db->f("user_info_id")."''"; \n	$dbbt = new ps_DB;\n	$dbbt->setQuery($q);\n	$dbbt->query();\n	$dbbt->next_record(); \n	// Get ship_to information\n	if( $db->f("user_info_id") != $dbbt->f("user_info_id")) {\n	  $q2  = "SELECT * FROM #__vm_user_info WHERE user_info_id=''".$db->f("user_info_id")."''"; \n	  $dbst = new ps_DB;\n	  $dbst->setQuery($q2);\n	  $dbst->query();\n	  $dbst->next_record();\n	}\n	else  {\n	  $dbst = $dbbt;\n	}\n			\n	//Authnet vars to send\n	$formdata = array (\n	 ''x_login'' => TWOCO_LOGIN,\n	 ''x_email_merchant'' => ((TWOCO_MERCHANT_EMAIL == ''True'') ? ''TRUE'' : ''FALSE''),\n			 \n	 // Customer Name and Billing Address\n	 ''x_first_name'' => $dbbt->f("first_name"),\n	 ''x_last_name'' => $dbbt->f("last_name"),\n	 ''x_company'' => $dbbt->f("company"),\n	 ''x_address'' => $dbbt->f("address_1"),\n	 ''x_city'' => $dbbt->f("city"),\n	 ''x_state'' => $dbbt->f("state"),\n	 ''x_zip'' => $dbbt->f("zip"),\n	 ''x_country'' => $dbbt->f("country"),\n	 ''x_phone'' => $dbbt->f("phone_1"),\n	 ''x_fax'' => $dbbt->f("fax"),\n	 ''x_email'' => $dbbt->f("email"),\n	\n	 // Customer Shipping Address\n	 ''x_ship_to_first_name'' => $dbst->f("first_name"),\n	 ''x_ship_to_last_name'' => $dbst->f("last_name"),\n	 ''x_ship_to_company'' => $dbst->f("company"),\n	 ''x_ship_to_address'' => $dbst->f("address_1"),\n	 ''x_ship_to_city'' => $dbst->f("city"),\n	 ''x_ship_to_state'' => $dbst->f("state"),\n	 ''x_ship_to_zip'' => $dbst->f("zip"),\n	 ''x_ship_to_country'' => $dbst->f("country"),\n	\n	 ''x_invoice_num'' => $db->f("order_number"),\n	 ''x_receipt_link_url'' => SECUREURL."2checkout_notify.php"\n	 );\n	 \n	if( TWOCO_TESTMODE == "Y" )\n	  $formdata[''demo''] = "Y";\n	\n	 $version = "2";\n	 $url = "https://www2.2checkout.com/2co/buyer/purchase";\n	 $formdata[''x_amount''] = number_format($db->f("order_total"), 2, ''.'', '''');\n	\n	 //build the post string\n	 $poststring = '''';\n	 foreach($formdata AS $key => $val){\n	   $poststring .= "<input type=''hidden'' name=''$key'' value=''$val'' />\n	";\n	 }\n	\n	?>\n	<form action="<?php echo $url ?>" method="post" target="_blank">\n	<?php echo $poststring ?>\n	<p>Click on the Image below to pay...</p>\n	<input type="image" name="submit" src="https://www.2checkout.com/images/buy_logo.gif" border="0" alt="Make payments with 2Checkout, it''s fast and secure!" title="Pay your Order with 2Checkout, it''s fast and secure!" />\n	</form>', ''),
(8, 1, 'NoChex', 'ps_nochex', 5, '0.00', 0, 'NOCHEX', 'P', 0, 'N', '', '<form action="https://www.nochex.com/nochex.dll/checkout" method=post target="_blank"> \n											<input type="hidden" name="email" value="<?php echo NOCHEX_EMAIL ?>" />\n											<input type="hidden" name="amount" value="<?php printf("%.2f", $db->f("order_total"))?>" />\n											<input type="hidden" name="ordernumber" value="<?php $db->p("order_id") ?>" />\n											<input type="hidden" name="logo" value="<?php echo $vendor_image_url ?>" />\n											<input type="hidden" name="returnurl" value="<?php echo SECUREURL ."index.php?option=com_virtuemart&amp;page=checkout.result&amp;order_id=".$db->f("order_id") ?>" />\n											<input type="image" name="submit" src="http://www.nochex.com/web/images/paymeanimated.gif"> \n											</form>', ''),
(9, 1, 'Credit Card (PayMeNow)', 'ps_paymenow', 5, '0.00', 0, 'PN', 'Y', 0, 'N', '1,2,3,', '', ''),
(10, 1, 'eWay', 'ps_eway', 5, '0.00', 0, 'EWAY', 'Y', 0, 'N', '', '', ''),
(11, 1, 'eCheck.net', 'ps_echeck', 5, '0.00', 0, 'ECK', 'B', 0, 'N', '', '', ''),
(12, 1, 'Credit Card (eProcessingNetwork)', 'ps_epn', 5, '0.00', 0, 'EPN', 'Y', 0, 'N', '1,2,3,', '', ''),
(13, 1, 'iKobo', '', 5, '0.00', 0, 'IK', 'P', 0, 'N', '', '<form action="https://www.iKobo.com/store/index.php" method="post"> \n  <input type="hidden" name="cmd" value="cart" />Click on the image below to Pay with iKobo\n  <input type="image" src="https://www.ikobo.com/merchant/buttons/ikobo_pay1.gif" name="submit" alt="Pay with iKobo" /> \n  <input type="hidden" name="poid" value="USER_ID" /> \n  <input type="hidden" name="item" value="Order: <?php $db->p("order_id") ?>" /> \n  <input type="hidden" name="price" value="<?php printf("%.2f", $db->f("order_total"))?>" /> \n  <input type="hidden" name="firstname" value="<?php echo $user->first_name?>" /> \n  <input type="hidden" name="lastname" value="<?php echo $user->last_name?>" /> \n  <input type="hidden" name="address" value="<?php echo $user->address_1?>&#10<?php echo $user->address_2?>" /> \n  <input type="hidden" name="city" value="<?php echo $user->city?>" /> \n  <input type="hidden" name="state" value="<?php echo $user->state?>" /> \n  <input type="hidden" name="zip" value="<?php echo $user->zip?>" /> \n  <input type="hidden" name="phone" value="<?php echo $user->phone_1?>" /> \n  <input type="hidden" name="email" value="<?php echo $user->email?>" /> \n  </form> >', ''),
(14, 1, 'iTransact', '', 5, '0.00', 0, 'ITR', 'P', 0, 'N', '', '<?php\n  //your iTransact account details\n  $vendorID = "XXXXX";\n  global $vendor_name;\n  $mername = $vendor_name;\n  \n  //order details\n  $total = $db->f("order_total");$first_name = $user->first_name;$last_name = $user->last_name;$address = $user->address_1;$city = $user->city;$state = $user->state;$zip = $user->zip;$country = $user->country;$email = $user->email;$phone = $user->phone_1;$home_page = $mosConfig_live_site."/index.php";$ret_addr = $mosConfig_live_site."/index.php";$cc_payment_image = $mosConfig_live_site."/components/com_virtuemart/shop_image/ps_image/cc_payment.jpg";\n  ?>\n  <form action="https://secure.paymentclearing.com/cgi-bin/mas/split.cgi" method="POST"> \n		<input type="hidden" name="vendor_id" value="<?php echo $vendorID; ?>" />\n		<input type="hidden" name="home_page" value="<?php echo $home_page; ?>" />\n		<input type="hidden" name="ret_addr" value="<?php echo $ret_addr; ?>" />\n		<input type="hidden" name="mername" value="<?php echo $mername; ?>" />\n		<!--Enter text in the next value that should appear on the bottom of the order form.-->\n		<INPUT type="hidden" name="mertext" value="" />\n		<!--If you are accepting checks, enter the number 1 in the next value.  Enter the number 0 if you are not accepting checks.-->\n		<INPUT type="hidden" name="acceptchecks" value="0" />\n		<!--Enter the number 1 in the next value if you want to allow pre-registered customers to pay with a check.  Enter the number 0 if not.-->\n		<INPUT type="hidden" name="allowreg" value="0" />\n		<!--If you are set up with Check Guarantee, enter the number 1 in the next value.  Enter the number 0 if not.-->\n		<INPUT type="hidden" name="checkguar" value="0" />\n		<!--Enter the number 1 in the next value if you are accepting credit card payments.  Enter the number zero if not.-->\n		<INPUT type="hidden" name="acceptcards" value="1">\n		<!--Enter the number 1 in the next value if you want to allow a separate mailing address for credit card orders.  Enter the number 0 if not.-->\n		<INPUT type="hidden" name="altaddr" value="0" />\n		<!--Enter the number 1 in the next value if you want the customer to enter the CVV number for card orders.  Enter the number 0 if not.-->\n		<INPUT type="hidden" name="showcvv" value="1" />\n		\n		<input type="hidden" name="1-desc" value="Order Total" />\n		<input type="hidden" name="1-cost" value="<?php echo $total; ?>" />\n		<input type="hidden" name="1-qty" value="1" />\n		<input type="hidden" name="total" value="<?php echo $total; ?>" />\n		<input type="hidden" name="first_name" value="<?php echo $first_name; ?>" />\n		<input type="hidden" name="last_name" value="<?php echo $last_name; ?>" />\n		<input type="hidden" name="address" value="<?php echo $address; ?>" />\n		<input type="hidden" name="city" value="<?php echo $city; ?>" />\n		<input type="hidden" name="state" value="<?php echo $state; ?>" />\n		<input type="hidden" name="zip" value="<?php echo $zip; ?>" />\n		<input type="hidden" name="country" value="<?php echo $country; ?>" />\n		<input type="hidden" name="phone" value="<?php echo $phone; ?>" />\n		<input type="hidden" name="email" value="<?php echo $email; ?>" />\n		<p><input type="image" alt="Process Secure Credit Card Transaction using iTransact" border="0" height="60" width="210" src="<?php echo $cc_payment_image; ?>" /> </p>\n		</form>', ''),
(15, 1, 'Dankort / PBS', 'ps_pbs', 5, '0.00', 0, 'PBS', 'P', 0, 'N', '', '', ''),
(16, 1, 'Verisign PayFlow Pro', 'ps_pfp', 5, '0.00', 0, 'PFP', 'Y', 0, 'N', '1,2,6,7,', '', ''),
(17, 1, 'PagSeguro  (VISA, AMEX, Transferência e Boleto Eletrônico)', 'ps_paypal', 5, '0.00', 0, 'PS', 'P', 0, 'Y', '', '<!-- INICIO FORMULARIO BOTAO PAGSEGURO -->\r\n<form target=\\"pagseguro\\" action=\\"https://pagseguro.uol.com.br/security/webpagamentos/webpagto.aspx\\" method=\\"post\\">\r\n<input type=\\"hidden\\" name=\\"email_cobranca\\" value=\\"leonardo@nucleodoevento.com.br\\">\r\n<input type=\\"hidden\\" name=\\"tipo\\" value=\\"CP\\">\r\n<input type=\\"hidden\\" name=\\"moeda\\" value=\\"BRL\\">\r\n<input type=\\"hidden\\" name=\\"item_id_1\\" value=\\"1\\">\r\n<input type=\\"hidden\\" name=\\"item_descr_1\\" value=\\"Loja Virtual Núcleo do Evento\\">\r\n<input type=\\"hidden\\" name=\\"item_valor_1\\" value=\\"<?=number_format(doubleval(round( $db->f(\\"order_total\\")+$tax_total-$discount_total, 2)),2,\\",\\",\\".\\")?>\\">\r\n<input type=\\"hidden\\" name=\\"item_quant_1\\" value=\\"1\\">\r\n<input type=\\"image\\" src=\\"https://pagseguro.uol.com.br/Security/Imagens/btnPagueComBR.jpg\\" name=\\"submit\\" alt=\\"Pague com PagSeguro - é rápido, grátis e seguro!\\">\r\n</form>\r\n<!-- FINAL FORMULARIO BOTAO PAGSEGURO -->', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_vm_product`
--

CREATE TABLE IF NOT EXISTS `jos_vm_product` (
  `product_id` int(11) NOT NULL auto_increment,
  `vendor_id` int(11) NOT NULL default '0',
  `product_parent_id` int(11) NOT NULL default '0',
  `product_sku` varchar(64) NOT NULL default '',
  `product_s_desc` varchar(255) default NULL,
  `product_desc` text,
  `product_thumb_image` varchar(255) default NULL,
  `product_full_image` varchar(255) default NULL,
  `product_publish` char(1) default NULL,
  `product_weight` decimal(10,4) default NULL,
  `product_weight_uom` varchar(32) default 'pounds.',
  `product_length` decimal(10,4) default NULL,
  `product_width` decimal(10,4) default NULL,
  `product_height` decimal(10,4) default NULL,
  `product_lwh_uom` varchar(32) default 'inches',
  `product_url` varchar(255) default NULL,
  `product_in_stock` int(11) default NULL,
  `product_available_date` int(11) default NULL,
  `product_availability` varchar(56) NOT NULL default '',
  `product_special` char(1) default NULL,
  `product_discount_id` int(11) default NULL,
  `ship_code_id` int(11) default NULL,
  `cdate` int(11) default NULL,
  `mdate` int(11) default NULL,
  `product_name` varchar(64) default NULL,
  `product_sales` int(11) NOT NULL default '0',
  `attribute` text,
  `custom_attribute` text NOT NULL,
  `product_tax_id` tinyint(2) NOT NULL default '0',
  `product_unit` varchar(32) default NULL,
  `product_packaging` int(11) default NULL,
  PRIMARY KEY  (`product_id`),
  KEY `idx_product_vendor_id` (`vendor_id`),
  KEY `idx_product_product_parent_id` (`product_parent_id`),
  KEY `idx_product_sku` (`product_sku`),
  KEY `idx_product_ship_code_id` (`ship_code_id`),
  KEY `idx_product_name` (`product_name`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='All products are stored here.' AUTO_INCREMENT=46 ;

--
-- Extraindo dados da tabela `jos_vm_product`
--

INSERT INTO `jos_vm_product` (`product_id`, `vendor_id`, `product_parent_id`, `product_sku`, `product_s_desc`, `product_desc`, `product_thumb_image`, `product_full_image`, `product_publish`, `product_weight`, `product_weight_uom`, `product_length`, `product_width`, `product_height`, `product_lwh_uom`, `product_url`, `product_in_stock`, `product_available_date`, `product_availability`, `product_special`, `product_discount_id`, `ship_code_id`, `cdate`, `mdate`, `product_name`, `product_sales`, `attribute`, `custom_attribute`, `product_tax_id`, `product_unit`, `product_packaging`) VALUES
(35, 1, 0, 'COM000020', 'Colar de 1.80m confeccionada em penas e plumas.', '<p>Colar de 1.80m confeccionada em penas e plumas. </p><p>Obs.: Marabus e estolas de penas podem soltar tinta, podendo ocorrer manchas na pele e roupas.</p>', 'ce82823a4c968582bee9da9a17cc6c28.jpg', 'a0fd22ad05fa39c0516b05270ac25cef.jpg', 'Y', '1.0000', 'Kg', '1.0000', '1.0000', '1.0000', 'Cm', '', 0, 1185505200, '7 dias', 'N', 0, 0, 1185566733, 1185566733, 'Boá de Plumas com Pontas Verde Limão', 0, '', '', 2, 'Unid', 0),
(33, 1, 0, 'COM000018', 'Colar de 1.80m confeccionada em penas e plumas.', '<p>Colar de 1.80m confeccionada em penas e plumas. </p><p>Obs.: Marabus e estolas de penas podem soltar tinta, podendo ocorrer manchas na pele e roupas.</p>', '5acafe31eb533e8ed977308155107205.jpg', '4c45d04ea84ce4ce78b810ce98891c22.jpg', 'Y', '1.0000', 'Kg', '1.0000', '1.0000', '1.0000', 'Cm', '', 0, 1185505200, '7 dias', 'N', 0, 0, 1185566355, 1185566355, 'Boá de Penas Vermelho', 0, '', '', 2, 'Unid', 0),
(34, 1, 0, 'COM000019', 'Colar de 1.80m confeccionada em penas e plumas.', '<p>Colar de 1.80m confeccionada em penas e plumas. </p><p>Obs.: Marabus e estolas de penas podem soltar tinta, podendo ocorrer manchas na pele e roupas.</p>', 'acf1bea8b01efa0ecdc3eab1123dc01a.jpg', '1aa551d5cd7c4154f7e150e029761b8f.jpg', 'Y', '1.0000', 'Kg', '1.0000', '1.0000', '1.0000', 'Cm', '', 0, 1185505200, '7 dias', 'N', 0, 0, 1185566565, 1185566565, 'Boá de Plumas com Pontas Lilás', 0, '', '', 2, 'Unid', 0),
(32, 1, 0, 'COM000017', 'Colar de 1.80m confeccionada em penas e plumas.', '<p>Colar de 1.80m confeccionada em penas e plumas. </p><p>Obs.: Marabus e estolas de penas podem soltar tinta, podendo ocorrer manchas na pele e roupas.</p>', '5ee57df3587a0d7a2a1bafbbf293dbb1.jpg', '041f139c5809aab501d2904b23a4f7ce.jpg', 'Y', '1.0000', 'Kg', '1.0000', '1.0000', '1.0000', 'Cm', '', -20, 1185505200, '7 dias', 'N', 0, 0, 1185566236, 1185566236, 'Boá de Penas Verde e Limão', 20, '', '', 2, 'Unid', 0),
(17, 1, 0, 'COM000001', 'Asa de borboleta com detalhes em porpurina. Diversas cores. Vem com elástico.\r\nServe para adultos e crianças.', 'Asa de borboleta com detalhes em porpurina. Diversas cores. Vem com el&aacute;stico.<br />Serve para adultos e crian&ccedil;as.', 'f97a9246c386d40cf74a095d038f4d00.jpg', '401e83d9e1273e6751781e57a323d89f.jpg', 'Y', '1.0000', 'Kg', '1.0000', '1.0000', '1.0000', 'Cm', '', -1, 1185505200, '7 dias', 'N', 0, 0, 1185556361, 1185556361, 'Asa de Borboleta Pequena', 1, '', '', 2, 'Unid', 0),
(18, 1, 0, 'COM000002', 'Asa de borboleta, confeccionada artesanalmente. Serve para crianças e adultos.', '<p>Asa de borboleta, confeccionada artesanalmente. Serve para crian&ccedil;as e adultos. <br />Dispon&iacute;vel nas cores: azul, rosa, lil&aacute;s, preto, branco, amarelo.</p>', '6c21a0027ea77803b557e117d1440028.jpg', '708d7e0af849d70aa59116628ec1bbce.jpg', 'Y', '1.0000', 'Kg', '1.0000', '1.0000', '1.0000', 'Cm', '', 0, 1185505200, '7 dias', 'N', 0, 0, 1185557003, 1185557003, 'Asa de borboleta média', 0, '', '', 2, 'Unid', 0),
(19, 1, 0, 'COM000003', 'Bigode com cavanhaque postiço. Vem com adesivo para fixação na pele.', '<p>Bigode com cavanhaque posti&ccedil;o. Vem com adesivo para fixa&ccedil;&atilde;o na pele.</p>', 'dcd19cff2de5c238385cbe73f7d6d7ef.jpg', 'fa4cf62ee32e500f5ec69a5337f64f83.jpg', 'Y', '1.0000', 'Kg', '1.0000', '1.0000', '1.0000', 'Cm', '', 0, 1185505200, '7 dias', 'N', 0, 0, 1185557215, 1185557215, 'Bigode com cavanhaque', 0, '', '', 2, 'Unid', 0),
(20, 1, 0, 'COM000004', 'Bico de pato em metal com strass.', '<p>Bico de pato em metal com strass.</p>', '2c19ddf90ed61bac7058d04f218115c0.jpg', 'cd6d45476dbfeb3ff492b85d2af859ad.jpg', 'Y', '1.0000', 'Kg', '1.0000', '1.0000', '1.0000', 'Cm', '', -1, -75600, '7 dias', 'N', 0, 0, 1185557422, 1185557788, 'Bico de Pato com Strass', 1, '', '', 2, 'Unid', 0),
(21, 1, 0, 'COM000005', 'Ponto de luz com fio de nylon e strass.', '<p>Ponto de luz com fio de nylon&nbsp;e strass.</p>', '0cf564a7c1a38ecb0f56248ea81dc4f8.jpg', 'f39a0b3e0bb24a8461649d3e60d4dac6.jpg', 'Y', '1.0000', 'Kg', '1.0000', '1.0000', '1.0000', 'Cm', '', 0, 1185505200, '7 dias', 'N', 0, 0, 1185557636, 1185557636, 'Fio de Luz', 0, '', '', 2, 'Unid', 0),
(22, 1, 0, 'COM000006', 'Par de grampos decorados com detalhes em strass.', '<p>Par de grampos decorados com detalhes em strass.</p>', 'ba658cf4ddbb32c4e449f48eabc1b49e.jpg', '1ccaf1f6602e4d2549adbe88e706a8fd.jpg', 'Y', '1.0000', 'Kg', '1.0000', '1.0000', '1.0000', 'Cm', '', 0, 1185505200, '7 dias', 'N', 0, 0, 1185557929, 1185557929, 'Grampo Decorado', 0, '', '', 2, 'Unid', 0),
(23, 1, 0, 'COM000007', 'Grampo comprido para penteados com strass na ponta.', '<p>Grampo comprido para penteados com strass na ponta.</p>', '446fdb7b72d45c8cef3307101f61e805.jpg', 'b72a692adc0a6b3728fc06e68baf399a.jpg', 'Y', '1.0000', 'Kg', '1.0000', '1.0000', '1.0000', 'Cm', '', 7, 1185505200, '', 'N', 0, 0, 1185558130, 1185558130, 'Grampo para Penteado com Strass', 0, '', '', 2, 'Unid', 0),
(24, 1, 0, 'COM000008', 'Pulseira em strass.\r\n', '<p>Pulseira em strass.</p>', '48c3b04b2a823b0c2a49ea49b286bff0.jpg', '3681dd22586b930ef14cc7260588b120.jpg', 'Y', '1.0000', 'Kg', '1.0000', '1.0000', '1.0000', 'Cm', '', 0, 1185505200, '7 dias', 'N', 0, 0, 1185558277, 1185558277, 'Pulseira de Strass', 0, '', '', 2, 'Unid', 0),
(25, 1, 0, 'COM000009', 'Colar de 1.80m confeccionada em penas e plumas.', '<p>Colar de 1.80m confeccionada em penas e plumas.</p><p>* Obs.: Marabus e estolas de penas podem soltar tinta, podendo ocorrer manchas na pele e roupas.</p>', '05c83ad99e039432d04b8be5925017d1.jpg', '3d90b0398a0590700f4e224f5c17ee7c.jpg', 'Y', '1.0000', 'Kg', '1.0000', '1.0000', '1.0000', 'Cm', '', 0, -75600, '7 dias', 'N', 0, 0, 1185558667, 1185558820, 'Boá de Penas Amarelo', 0, '', '', 2, 'Unid', 0),
(26, 1, 0, 'COM000011', 'Colar de 1.80m confeccionada em penas e plumas.', '<p>Colar de 1.80m confeccionada em penas e plumas.</p><p>*Obs.: Marabus e estolas de penas podem soltar tinta, podendo ocorrer manchas na pele e roupas.</p>', '710648f98ca9a7e1bbc94da335d1c30f.jpg', '7e8a20bdb2174ed5a44e8f23781da3ae.jpg', 'Y', '1.0000', 'Kg', '1.0000', '1.0000', '1.0000', 'Cm', '', 0, 1185505200, '7 dias', 'N', 0, 0, 1185558937, 1185558937, 'Boá de Penas Azul', 0, '', '', 2, 'Unid', 0),
(27, 1, 0, 'COM000012', 'Colar de 1.80m confeccionada em penas e plumas.', '<p>Colar de 1.80m confeccionada em penas e plumas. </p><p>Obs.: Marabus e estolas de penas podem soltar tinta, podendo ocorrer manchas na pele e roupas.</p>', '968375dde3cf4dcabfe541b6440c8ef0.jpg', '50a6eedff797e1a8ac871840cc5bd766.jpg', 'Y', '1.0000', 'Kg', '1.0000', '1.0000', '1.0000', 'Cm', '', 0, 1185505200, '7 dias', 'N', 0, 0, 1185563918, 1185563918, 'Boa de Penas Branco', 0, '', '', 2, 'Unid', 0),
(28, 1, 0, 'COM000013', 'Colar de 1.80m confeccionada em penas e plumas.', '<p>Colar de 1.80m confeccionada em penas e plumas. </p><p>Obs.: Marabus e estolas de penas podem soltar tinta, podendo ocorrer manchas na pele e roupas.</p>', '74a9fca4cb8b84f0e4d163132ac89ca2.jpg', '4a17199202c7fa7e2e5c6edacd540d16.jpg', 'Y', '1.0000', 'Kg', '1.0000', '1.0000', '1.0000', 'Cm', '', 0, 1185505200, '7 dias', 'N', 0, 0, 1185564024, 1185564432, 'Boá de Penas Laranja', 0, '', '', 2, 'Unid', 0),
(29, 1, 0, 'COM000014', 'Colar de 1.80m confeccionada em penas e plumas.', '<p>Colar de 1.80m confeccionada em penas e plumas. </p><p>Obs.: Marabus e estolas de penas podem soltar tinta, podendo ocorrer manchas na pele e roupas.</p>', 'a41dcc1fdf361ec560d2c32cad2813ad.jpg', 'c2b1c64f998247cddf0a9273f5bc3d9a.jpg', 'Y', '1.0000', 'Kg', '1.0000', '1.0000', '1.0000', 'Cm', '', 0, 1185505200, '7 dias', 'N', 0, 0, 1185565078, 1185565078, 'Boá de Penas Lilas', 0, '', '', 2, 'Unid', 0),
(30, 1, 0, 'COM000015', 'Colar de 1.80m confeccionada em penas e plumas.', '<p>Colar de 1.80m confeccionada em penas e plumas. </p><p>Obs.: Marabus e estolas de penas podem soltar tinta, podendo ocorrer manchas na pele e roupas.</p>', '7425cb7f15a7957bf9816082e7af92d4.jpg', '4dcb16e9390182a6f0fec19fbfefcd72.jpg', 'Y', '1.0000', 'Kg', '1.0000', '1.0000', '1.0000', 'Cm', '', 0, 1185505200, '7 dias', 'N', 0, 0, 1185565474, 1185565474, 'Boá de Penas Pink', 0, '', '', 2, 'Unid', 0),
(31, 1, 0, 'COM000016', 'Colar de 1.80m confeccionada em penas e plumas.', '<p>Colar de 1.80m confeccionada em penas e plumas. </p><p>Obs.: Marabus e estolas de penas podem soltar tinta, podendo ocorrer manchas na pele e roupas.</p>', '77dc0c4bad3977132d560144c5f8bb6a.jpg', 'c1ffa5800130116d3e08f68074862a8a.jpg', 'Y', '1.0000', 'Kg', '1.0000', '1.0000', '1.0000', 'Cm', '', 0, 1185505200, '7 dias', 'N', 0, 0, 1185565584, 1185565584, 'Boá de Penas Preto', 0, '', '', 2, 'Unid', 0),
(36, 1, 0, 'COM000021', 'Colar de 1.80m confeccionada em penas e plumas.', '<p>Colar de 1.80m confeccionada em penas e plumas. </p><p>Obs.: Marabus e estolas de penas podem soltar tinta, podendo ocorrer manchas na pele e roupas.</p>', '8e5e27a8123f715b3e8c33ec862ab848.jpg', '4450f4110b287c19c76720afe0b4923d.jpg', 'Y', '1.0000', 'Kg', '1.0000', '1.0000', '1.0000', 'Cm', '', 0, 1185505200, '7 dias', 'N', 0, 0, 1185566867, 1185566867, 'Boá de Plumas com Pontas Azul', 0, '', '', 2, 'Unid', 0),
(37, 1, 0, 'COM000022', 'Colar de 1.80m confeccionada em penas e plumas.', '<p>Colar de 1.80m confeccionada em penas e plumas. </p><p>Obs.: Marabus e estolas de penas podem soltar tinta, podendo ocorrer manchas na pele e roupas.</p>', 'fe35a6bec79d3ced8bbd444f81ce8af6.jpg', '316a502e7280ae951d751693a0b96cd7.jpg', 'Y', '1.0000', 'Kg', '1.0000', '1.0000', '1.0000', 'Cm', '', 0, 1185505200, '7 dias', 'N', 0, 0, 1185567013, 1185567013, 'Boá de Plumas com Pontas Laranja', 0, '', '', 2, 'Unid', 0),
(38, 1, 0, 'COM000023', 'Colar de 1.80m confeccionada em penas e plumas.', '<p>Colar de 1.80m confeccionada em penas e plumas. </p><p>Obs.: Marabus e estolas de penas podem soltar tinta, podendo ocorrer manchas na pele e roupas.</p>', '22a1df1af747c2908a062f6bc702a02d.jpg', '9d72a342abd5de362a4a2662b8514c83.jpg', 'Y', '1.0000', 'Kg', '1.0000', '1.0000', '1.0000', 'Cm', '', 0, 1185505200, '7 dias', 'N', 0, 0, 1185567228, 1185567228, 'Boá de Plumas com Pontas Rosa', 0, '', '', 2, 'Unid', 0),
(39, 1, 0, 'COM000024', 'Echarpe/Estola de 1.80m confeccionada em tule.', '<p>Echarpe/Estola de 1.80m confeccionada em tule.</p>', 'ad9e3fb4be1a0d88a9c5c7f4d6bd16c7.jpg', '999813b15c10d601d0360d9f9ccae8ca.jpg', 'Y', '1.0000', 'Kg', '1.0000', '1.0000', '1.0000', 'Cm', '', 0, 1185505200, '7 Dias', 'N', 0, 0, 1185567354, 1185567354, 'Boá de Tule Amarelo', 0, '', '', 2, 'Unid', 0),
(40, 1, 0, 'COM000025', 'Colar de 1.80m confeccionada em tule.\r\n', '<p>Colar de 1.80m confeccionada em tule.</p>', '2e9a33b34fa347a1bfe5f33fddfe9a0a.jpg', '8b1867049d70d5283bd04f5c4a232227.jpg', 'Y', '1.0000', 'Kg', '1.0000', '1.0000', '1.0000', 'Cm', '', 0, 1185505200, '7 dias', 'N', 0, 0, 1185567584, 1185567584, 'Boá de Tule Azul', 0, '', '', 2, 'Unid', 0),
(41, 1, 0, 'COM000026', 'Colar de 1.80m confeccionada em tule.\r\n', '<p>Colar de 1.80m confeccionada em tule.</p>', '3ecdf360bcc2e56b3a8d55fab4ff5c59.jpg', '1f196ffc3539e48f4f1da4711e43cf28.jpg', 'Y', '1.0000', 'Kg', '1.0000', '1.0000', '1.0000', 'Cm', '', 0, 1185505200, '7 dias', 'N', 0, 0, 1185568377, 1185568377, 'Boá de Tule Laranja', 0, '', '', 2, 'Unid', 0),
(42, 1, 0, 'COM000027', 'Colar de 1.80m confeccionada em tule.\r\n', '<p>Colar de 1.80m confeccionada em tule.</p>', '70e696178282824747895e5bb96714cd.jpg', 'ea32fe57ee0f2b7debf3328e29686859.jpg', 'Y', '1.0000', 'Kg', '1.0000', '1.0000', '1.0000', 'Cm', '', 0, 1185505200, '7 dias', 'N', 0, 0, 1185568596, 1185568596, 'Boá de Tule Rosa', 0, '', '', 2, 'Unid', 0),
(43, 1, 0, 'COM000028', 'Colar estilo estola de tule, 1,80m de comprimento.\r\n', '<p>Colar estilo estola de tule, 1,80m de comprimento.</p>', '2621232556262f9572e9f6745f892008.jpg', 'e86d336a87cbf651960910eb2bd588b6.jpg', 'Y', '1.0000', 'Kg', '1.0000', '1.0000', '1.0000', 'Cm', '', -10, 1185505200, '7 dias', 'N', 0, 0, 1185568694, 1185568694, 'Boá de Tule Verde', 10, '', '', 2, 'Unid', 0),
(44, 1, 0, 'COM000029', 'Buzina com barulho muuuito alto!! Ideal para salões de festas grande.\r\n', '<p>Buzina com barulho muuuito alto!! Ideal para sal&otilde;es de festas grande.</p>', '2c7ced8a2fe8f05f067407f9de12f458.jpg', '133d18b0971fb00ba6a9fbb40e1a9c25.jpg', 'Y', '1.0000', 'Kg', '1.0000', '1.0000', '1.0000', 'Cm', '', -1, 1185505200, '7 dias', 'N', 0, 0, 1185569081, 1185569081, 'Buzina de Gás', 1, '', '', 2, 'Unid', 0),
(45, 1, 0, 'COM000030', 'Buzina de aperto.', '<p>Buzina de aperto.</p>', '5caa64a6dbc7fb69193dede82e78c9b4.jpg', 'b13f34b1f8880513c3cb31ad5ff2e0bc.jpg', 'Y', '1.0000', 'Kg', '1.0000', '1.0000', '1.0000', 'Cm', '', 0, 1185505200, '7 dias', 'N', 0, 0, 1185569376, 1185569376, 'Mini Buzina', 0, '', '', 2, 'Unid', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_vm_product_attribute`
--

CREATE TABLE IF NOT EXISTS `jos_vm_product_attribute` (
  `product_id` int(11) NOT NULL default '0',
  `attribute_name` char(255) NOT NULL default '',
  `attribute_value` char(255) NOT NULL default '',
  KEY `idx_product_attribute_product_id` (`product_id`),
  KEY `idx_product_attribute_name` (`attribute_name`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Stores attributes + their specific values for Child Products';

--
-- Extraindo dados da tabela `jos_vm_product_attribute`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_vm_product_attribute_sku`
--

CREATE TABLE IF NOT EXISTS `jos_vm_product_attribute_sku` (
  `product_id` int(11) NOT NULL default '0',
  `attribute_name` char(255) NOT NULL default '',
  `attribute_list` int(11) NOT NULL default '0',
  KEY `idx_product_attribute_sku_product_id` (`product_id`),
  KEY `idx_product_attribute_sku_attribute_name` (`attribute_name`),
  KEY `idx_product_attribute_list` (`attribute_list`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Attributes for a Parent Product used by its Child Products';

--
-- Extraindo dados da tabela `jos_vm_product_attribute_sku`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_vm_product_category_xref`
--

CREATE TABLE IF NOT EXISTS `jos_vm_product_category_xref` (
  `category_id` int(11) NOT NULL default '0',
  `product_id` int(11) NOT NULL default '0',
  `product_list` int(11) default NULL,
  KEY `idx_product_category_xref_category_id` (`category_id`),
  KEY `idx_product_category_xref_product_id` (`product_id`),
  KEY `idx_product_category_xref_product_list` (`product_list`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Maps Products to Categories';

--
-- Extraindo dados da tabela `jos_vm_product_category_xref`
--

INSERT INTO `jos_vm_product_category_xref` (`category_id`, `product_id`, `product_list`) VALUES
(9, 22, 0),
(9, 21, 0),
(7, 18, 0),
(7, 17, 0),
(9, 20, 0),
(9, 23, 0),
(10, 26, 0),
(10, 25, 0),
(9, 24, 0),
(8, 19, 0),
(10, 27, 0),
(10, 28, 0),
(10, 29, 0),
(10, 30, 0),
(10, 31, 0),
(10, 32, 0),
(10, 33, 0),
(10, 34, 0),
(10, 35, 0),
(10, 36, 0),
(10, 37, 0),
(10, 38, 0),
(10, 39, 0),
(10, 40, 0),
(10, 41, 0),
(10, 42, 0),
(10, 43, 0),
(11, 44, 0),
(11, 45, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_vm_product_discount`
--

CREATE TABLE IF NOT EXISTS `jos_vm_product_discount` (
  `discount_id` int(11) NOT NULL auto_increment,
  `amount` decimal(12,2) NOT NULL default '0.00',
  `is_percent` tinyint(1) NOT NULL default '0',
  `start_date` int(11) NOT NULL default '0',
  `end_date` int(11) NOT NULL default '0',
  PRIMARY KEY  (`discount_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='Discounts that can be assigned to products' AUTO_INCREMENT=3 ;

--
-- Extraindo dados da tabela `jos_vm_product_discount`
--

INSERT INTO `jos_vm_product_discount` (`discount_id`, `amount`, `is_percent`, `start_date`, `end_date`) VALUES
(1, '20.00', 1, 1097704800, 1194390000),
(2, '2.00', 0, 1098655200, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_vm_product_download`
--

CREATE TABLE IF NOT EXISTS `jos_vm_product_download` (
  `product_id` int(11) NOT NULL default '0',
  `user_id` int(11) NOT NULL default '0',
  `order_id` int(11) NOT NULL default '0',
  `end_date` int(11) NOT NULL default '0',
  `download_max` int(11) NOT NULL default '0',
  `download_id` varchar(32) NOT NULL default '',
  `file_name` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`download_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Active downloads for selling downloadable goods';

--
-- Extraindo dados da tabela `jos_vm_product_download`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_vm_product_files`
--

CREATE TABLE IF NOT EXISTS `jos_vm_product_files` (
  `file_id` int(19) NOT NULL auto_increment,
  `file_product_id` int(11) NOT NULL default '0',
  `file_name` varchar(128) NOT NULL default '',
  `file_title` varchar(128) NOT NULL default '',
  `file_description` mediumtext NOT NULL,
  `file_extension` varchar(128) NOT NULL default '',
  `file_mimetype` varchar(64) NOT NULL default '',
  `file_url` varchar(254) NOT NULL default '',
  `file_published` tinyint(1) NOT NULL default '0',
  `file_is_image` tinyint(1) NOT NULL default '0',
  `file_image_height` int(11) NOT NULL default '0',
  `file_image_width` int(11) NOT NULL default '0',
  `file_image_thumb_height` int(11) NOT NULL default '50',
  `file_image_thumb_width` int(11) NOT NULL default '0',
  PRIMARY KEY  (`file_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Additional Images and Files which are assigned to products' AUTO_INCREMENT=1 ;

--
-- Extraindo dados da tabela `jos_vm_product_files`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_vm_product_mf_xref`
--

CREATE TABLE IF NOT EXISTS `jos_vm_product_mf_xref` (
  `product_id` int(11) default NULL,
  `manufacturer_id` int(11) default NULL,
  KEY `idx_product_mf_xref_product_id` (`product_id`),
  KEY `idx_product_mf_xref_manufacturer_id` (`manufacturer_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Maps a product to a manufacturer';

--
-- Extraindo dados da tabela `jos_vm_product_mf_xref`
--

INSERT INTO `jos_vm_product_mf_xref` (`product_id`, `manufacturer_id`) VALUES
(25, 2),
(21, 2),
(18, 2),
(17, 2),
(20, 2),
(29, 2),
(32, 2),
(31, 2),
(30, 2),
(19, 2),
(28, 2),
(27, 2),
(26, 2),
(24, 2),
(23, 2),
(22, 2),
(33, 2),
(34, 2),
(35, 2),
(36, 2),
(37, 2),
(38, 2),
(39, 2),
(40, 2),
(41, 2),
(42, 2),
(43, 2),
(44, 2),
(45, 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_vm_product_price`
--

CREATE TABLE IF NOT EXISTS `jos_vm_product_price` (
  `product_price_id` int(11) NOT NULL auto_increment,
  `product_id` int(11) NOT NULL default '0',
  `product_price` decimal(12,5) default NULL,
  `product_currency` char(16) default NULL,
  `product_price_vdate` int(11) default NULL,
  `product_price_edate` int(11) default NULL,
  `cdate` int(11) default NULL,
  `mdate` int(11) default NULL,
  `shopper_group_id` int(11) default NULL,
  `price_quantity_start` int(11) unsigned NOT NULL default '0',
  `price_quantity_end` int(11) unsigned NOT NULL default '0',
  PRIMARY KEY  (`product_price_id`),
  KEY `idx_product_price_product_id` (`product_id`),
  KEY `idx_product_price_shopper_group_id` (`shopper_group_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='Holds price records for a product' AUTO_INCREMENT=46 ;

--
-- Extraindo dados da tabela `jos_vm_product_price`
--

INSERT INTO `jos_vm_product_price` (`product_price_id`, `product_id`, `product_price`, `product_currency`, `product_price_vdate`, `product_price_edate`, `cdate`, `mdate`, `shopper_group_id`, `price_quantity_start`, `price_quantity_end`) VALUES
(20, 21, '3.50000', 'BRL', 0, 0, 1185557636, 1185557636, 5, 0, 0),
(26, 26, '13.00000', 'BRL', 0, 0, 1185558937, 1185558937, 5, 0, 0),
(21, 20, '7.00000', 'BRL', 0, 0, 1185557788, 1185557788, 5, 0, 0),
(18, 18, '13.80000', 'BRL', 0, 0, 1185557003, 1185557003, 5, 0, 0),
(17, 17, '12.80000', 'BRL', 0, 0, 1185556361, 1185556361, 5, 0, 0),
(28, 28, '13.00000', 'BRL', 0, 0, 1185564024, 1185564432, 5, 0, 0),
(32, 32, '13.00000', 'BRL', 0, 0, 1185566236, 1185566236, 5, 0, 0),
(30, 30, '13.00000', 'BRL', 0, 0, 1185565474, 1185565474, 5, 0, 0),
(29, 29, '13.00000', 'BRL', 0, 0, 1185565078, 1185565078, 5, 0, 0),
(19, 19, '8.00000', 'BRL', 0, 0, 1185557215, 1185557215, 5, 0, 0),
(25, 25, '13.00000', 'BRL', 0, 0, 1185558667, 1185558820, 5, 0, 0),
(27, 27, '13.00000', 'BRL', 0, 0, 1185563918, 1185563918, 5, 0, 0),
(24, 24, '19.90000', 'BRL', 0, 0, 1185558277, 1185558277, 5, 0, 0),
(23, 23, '1.00000', 'BRL', 0, 0, 1185558130, 1185558130, 5, 0, 0),
(22, 22, '5.00000', 'BRL', 0, 0, 1185557929, 1185557929, 5, 0, 0),
(31, 31, '13.00000', 'BRL', 0, 0, 1185565584, 1185565584, 5, 0, 0),
(33, 33, '13.00000', 'BRL', 0, 0, 1185566355, 1185566355, 5, 0, 0),
(34, 34, '16.50000', 'BRL', 0, 0, 1185566565, 1185566565, 5, 0, 0),
(35, 35, '16.50000', 'BRL', 0, 0, 1185566733, 1185566733, 5, 0, 0),
(36, 36, '16.50000', 'BRL', 0, 0, 1185566867, 1185566867, 5, 0, 0),
(37, 37, '16.50000', 'BRL', 0, 0, 1185567013, 1185567013, 5, 0, 0),
(38, 38, '16.50000', 'BRL', 0, 0, 1185567228, 1185567228, 5, 0, 0),
(39, 39, '13.00000', 'BRL', 0, 0, 1185567354, 1185567354, 5, 0, 0),
(40, 40, '13.00000', 'BRL', 0, 0, 1185567584, 1185567584, 5, 0, 0),
(41, 41, '13.00000', 'BRL', 0, 0, 1185568377, 1185568377, 5, 0, 0),
(42, 42, '13.00000', 'BRL', 0, 0, 1185568596, 1185568596, 5, 0, 0),
(43, 43, '13.00000', 'BRL', 0, 0, 1185568694, 1185568694, 5, 0, 0),
(44, 44, '11.00000', 'BRL', 0, 0, 1185569081, 1185569081, 5, 0, 0),
(45, 45, '1.00000', 'BRL', 0, 0, 1185569376, 1185569376, 5, 0, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_vm_product_product_type_xref`
--

CREATE TABLE IF NOT EXISTS `jos_vm_product_product_type_xref` (
  `product_id` int(11) NOT NULL default '0',
  `product_type_id` int(11) NOT NULL default '0',
  KEY `idx_product_product_type_xref_product_id` (`product_id`),
  KEY `idx_product_product_type_xref_product_type_id` (`product_type_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Maps products to a product type';

--
-- Extraindo dados da tabela `jos_vm_product_product_type_xref`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_vm_product_relations`
--

CREATE TABLE IF NOT EXISTS `jos_vm_product_relations` (
  `product_id` int(11) NOT NULL default '0',
  `related_products` text,
  PRIMARY KEY  (`product_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `jos_vm_product_relations`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_vm_product_reviews`
--

CREATE TABLE IF NOT EXISTS `jos_vm_product_reviews` (
  `product_id` varchar(255) NOT NULL default '',
  `comment` text NOT NULL,
  `userid` int(11) NOT NULL default '0',
  `time` int(11) NOT NULL default '0',
  `user_rating` tinyint(1) NOT NULL default '0',
  `review_ok` int(11) NOT NULL default '0',
  `review_votes` int(11) NOT NULL default '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `jos_vm_product_reviews`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_vm_product_type`
--

CREATE TABLE IF NOT EXISTS `jos_vm_product_type` (
  `product_type_id` int(11) NOT NULL auto_increment,
  `product_type_name` varchar(255) NOT NULL default '',
  `product_type_description` text,
  `product_type_publish` char(1) default NULL,
  `product_type_browsepage` varchar(255) default NULL,
  `product_type_flypage` varchar(255) default NULL,
  `product_type_list_order` int(11) default NULL,
  PRIMARY KEY  (`product_type_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Extraindo dados da tabela `jos_vm_product_type`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_vm_product_type_parameter`
--

CREATE TABLE IF NOT EXISTS `jos_vm_product_type_parameter` (
  `product_type_id` int(11) NOT NULL default '0',
  `parameter_name` varchar(255) NOT NULL default '',
  `parameter_label` varchar(255) NOT NULL default '',
  `parameter_description` text,
  `parameter_list_order` int(11) NOT NULL default '0',
  `parameter_type` char(1) NOT NULL default 'T',
  `parameter_values` varchar(255) default NULL,
  `parameter_multiselect` char(1) default NULL,
  `parameter_default` varchar(255) default NULL,
  `parameter_unit` varchar(32) default NULL,
  PRIMARY KEY  (`product_type_id`,`parameter_name`),
  KEY `idx_product_type_parameter_product_type_id` (`product_type_id`),
  KEY `idx_product_type_parameter_parameter_order` (`parameter_list_order`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Parameters which are part of a product type';

--
-- Extraindo dados da tabela `jos_vm_product_type_parameter`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_vm_product_votes`
--

CREATE TABLE IF NOT EXISTS `jos_vm_product_votes` (
  `product_id` int(255) NOT NULL default '0',
  `votes` text NOT NULL,
  `allvotes` int(11) NOT NULL default '0',
  `rating` tinyint(1) NOT NULL default '0',
  `lastip` varchar(50) NOT NULL default '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Stores all votes for a product';

--
-- Extraindo dados da tabela `jos_vm_product_votes`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_vm_shipping_carrier`
--

CREATE TABLE IF NOT EXISTS `jos_vm_shipping_carrier` (
  `shipping_carrier_id` int(11) NOT NULL auto_increment,
  `shipping_carrier_name` char(80) NOT NULL default '',
  `shipping_carrier_list_order` int(11) NOT NULL default '0',
  PRIMARY KEY  (`shipping_carrier_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='Shipping Carriers as used by the Standard Shipping Module' AUTO_INCREMENT=3 ;

--
-- Extraindo dados da tabela `jos_vm_shipping_carrier`
--

INSERT INTO `jos_vm_shipping_carrier` (`shipping_carrier_id`, `shipping_carrier_name`, `shipping_carrier_list_order`) VALUES
(1, 'DHL', 0),
(2, 'UPS', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_vm_shipping_rate`
--

CREATE TABLE IF NOT EXISTS `jos_vm_shipping_rate` (
  `shipping_rate_id` int(11) NOT NULL auto_increment,
  `shipping_rate_name` varchar(255) NOT NULL default '',
  `shipping_rate_carrier_id` int(11) NOT NULL default '0',
  `shipping_rate_country` text NOT NULL,
  `shipping_rate_zip_start` varchar(32) NOT NULL default '',
  `shipping_rate_zip_end` varchar(32) NOT NULL default '',
  `shipping_rate_weight_start` decimal(10,3) NOT NULL default '0.000',
  `shipping_rate_weight_end` decimal(10,3) NOT NULL default '0.000',
  `shipping_rate_value` decimal(10,2) NOT NULL default '0.00',
  `shipping_rate_package_fee` decimal(10,2) NOT NULL default '0.00',
  `shipping_rate_currency_id` int(11) NOT NULL default '0',
  `shipping_rate_vat_id` int(11) NOT NULL default '0',
  `shipping_rate_list_order` int(11) NOT NULL default '0',
  PRIMARY KEY  (`shipping_rate_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='Shipping Rates, used by the Standard Shipping Module' AUTO_INCREMENT=22 ;

--
-- Extraindo dados da tabela `jos_vm_shipping_rate`
--

INSERT INTO `jos_vm_shipping_rate` (`shipping_rate_id`, `shipping_rate_name`, `shipping_rate_carrier_id`, `shipping_rate_country`, `shipping_rate_zip_start`, `shipping_rate_zip_end`, `shipping_rate_weight_start`, `shipping_rate_weight_end`, `shipping_rate_value`, `shipping_rate_package_fee`, `shipping_rate_currency_id`, `shipping_rate_vat_id`, `shipping_rate_list_order`) VALUES
(1, 'Inland &gt; 4kg', 1, 'DEU', '00000', '99999', '0.000', '4.000', '5.62', '2.00', 47, 0, 1),
(2, 'Inland &gt; 8kg', 1, 'DEU', '00000', '99999', '4.000', '8.000', '6.39', '2.00', 47, 0, 2),
(3, 'Inland &gt; 12kg', 1, 'DEU', '00000', '99999', '8.000', '12.000', '7.16', '2.00', 47, 0, 3),
(4, 'Inland &gt; 20kg', 1, 'DEU', '00000', '99999', '12.000', '20.000', '8.69', '2.00', 47, 0, 4),
(5, 'EU+ &gt;  4kg', 1, 'AND;BEL;DNK;FRO;FIN;FRA;GRC;GRL;GBR;IRL;ITA;LIE;LUX;MCO;NLD;AUT;POL;PRT;SMR;SWE;CHE;SVK;ESP;CZE', '00000', '99999', '0.000', '4.000', '14.00', '2.00', 47, 0, 5),
(6, 'EU+ &gt;  8kg', 1, 'AND;BEL;DNK;FRO;FIN;FRA;GRC;GRL;GBR;IRL;ITA;LIE;LUX;MCO;NLD;AUT;POL;PRT;SMR;SWE;CHE;SVK;ESP;CZE', '00000', '99999', '4.000', '8.000', '18.00', '2.00', 47, 0, 6),
(7, 'EU+ &gt; 12kg', 1, 'AND;BEL;DNK;FRO;FIN;FRA;GRC;GRL;GBR;IRL;ITA;LIE;LUX;MCO;NLD;AUT;POL;PRT;SMR;SWE;CHE;SVK;ESP;CZE', '00000', '99999', '8.000', '12.000', '22.00', '2.00', 47, 0, 7),
(8, 'EU+ &gt; 20kg', 1, 'AND;BEL;DNK;FRO;FIN;FRA;GRC;GRL;GBR;IRL;ITA;LIE;LUX;MCO;NLD;AUT;POL;PRT;SMR;SWE;CHE;SVK;ESP;CZE', '00000', '99999', '12.000', '20.000', '30.00', '2.00', 47, 0, 8),
(9, 'Europe &gt; 4kg', 1, 'ALB;ARM;AZE;BLR;BIH;BGR;EST;GEO;GIB;ISL;YUG;KAZ;HRV;LVA;LTU;MLT;MKD;MDA;NOR;ROM;RUS;SVN;TUR;UKR;HUN;BLR;CYP', '00000', '99999', '0.000', '4.000', '23.00', '2.00', 47, 0, 9),
(10, 'Europe &gt;  8kg', 1, 'ALB;ARM;AZE;BLR;BIH;BGR;EST;GEO;GIB;ISL;YUG;KAZ;HRV;LVA;LTU;MLT;MKD;MDA;NOR;ROM;RUS;SVN;TUR;UKR;HUN;BLR;CYP', '00000', '99999', '4.000', '8.000', '29.00', '2.00', 47, 0, 10),
(11, 'Europe &gt; 12kg', 1, 'ALB;ARM;AZE;BLR;BIH;BGR;EST;GEO;GIB;ISL;YUG;KAZ;HRV;LVA;LTU;MLT;MKD;MDA;NOR;ROM;RUS;SVN;TUR;UKR;HUN;BLR;CYP', '00000', '99999', '8.000', '12.000', '36.00', '2.00', 47, 0, 11),
(12, 'Europe &gt; 20kg', 1, 'ALB;ARM;AZE;BLR;BIH;BGR;EST;GEO;GIB;ISL;YUG;KAZ;HRV;LVA;LTU;MLT;MKD;MDA;NOR;ROM;RUS;SVN;TUR;UKR;HUN;BLR;CYP', '00000', '99999', '12.000', '20.000', '48.00', '2.00', 47, 0, 12),
(13, 'World_1 &gt;  4kg', 1, 'EGY;DZA;BHR;IRQ;IRN;ISR;YEM;JOR;CAN;QAT;KWT;LBN;LBY;MAR;OMN;SAU;SYR;TUN;ARE;USA', '00000', '99999', '0.000', '4.000', '26.00', '2.00', 47, 0, 13),
(14, 'World_1 &gt; 8kg', 1, 'EGY;DZA;BHR;IRQ;IRN;ISR;YEM;JOR;CAN;QAT;KWT;LBN;LBY;MAR;OMN;SAU;SYR;TUN;ARE;USA', '00000', '99999', '4.000', '8.000', '35.00', '2.00', 47, 0, 14),
(15, 'World_1 &gt;12kg', 1, 'EGY;DZA;BHR;IRQ;IRN;ISR;YEM;JOR;CAN;QAT;KWT;LBN;LBY;MAR;OMN;SAU;SYR;TUN;ARE;USA', '00000', '99999', '8.000', '12.000', '43.00', '2.00', 47, 0, 15),
(16, 'World_1 &gt;20kg', 1, 'EGY;DZA;BHR;IRQ;IRN;ISR;YEM;JOR;CAN;QAT;KWT;LBN;LBY;MAR;OMN;SAU;SYR;TUN;ARE;USA', '00000', '99999', '12.000', '20.000', '59.00', '2.00', 47, 0, 16),
(17, 'World_2 &gt; 4kg', 1, '', '00000', '99999', '0.000', '4.000', '32.00', '2.00', 47, 0, 17),
(18, 'World_2 &gt; 8kg', 1, '', '00000', '99999', '4.000', '8.000', '47.00', '2.00', 47, 0, 18),
(19, 'World_2 &gt; 12kg', 1, '', '00000', '99999', '8.000', '12.000', '61.00', '2.00', 47, 0, 19),
(20, 'World_2 &gt; 20kg', 1, '', '00000', '99999', '12.000', '20.000', '90.00', '2.00', 47, 0, 20),
(21, 'UPS Express', 2, 'AND;BEL;DNK;FRO;FIN;FRA;GRC;GRL;GBR;IRL;ITA;LIE;LUX;MCO;NLD;AUT;POL;PRT;SMR;SWE;CHE;SVK;ESP;CZE', '00000', '99999', '0.000', '20.000', '5.00', '2.00', 47, 0, 21);

-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_vm_shopper_group`
--

CREATE TABLE IF NOT EXISTS `jos_vm_shopper_group` (
  `shopper_group_id` int(11) NOT NULL auto_increment,
  `vendor_id` int(11) default NULL,
  `shopper_group_name` varchar(32) default NULL,
  `shopper_group_desc` text,
  `shopper_group_discount` decimal(5,2) NOT NULL default '0.00',
  `show_price_including_tax` tinyint(1) NOT NULL default '1',
  `default` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`shopper_group_id`),
  KEY `idx_shopper_group_vendor_id` (`vendor_id`),
  KEY `idx_shopper_group_name` (`shopper_group_name`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='Shopper Groups that users can be assigned to' AUTO_INCREMENT=8 ;

--
-- Extraindo dados da tabela `jos_vm_shopper_group`
--

INSERT INTO `jos_vm_shopper_group` (`shopper_group_id`, `vendor_id`, `shopper_group_name`, `shopper_group_desc`, `shopper_group_discount`, `show_price_including_tax`, `default`) VALUES
(5, 1, '-default-', 'This is the default shopper group.', '0.00', 1, 1),
(6, 1, 'Gold Level', 'Gold Level phpShoppers.', '0.00', 1, 0),
(7, 1, 'Wholesale', 'Shoppers that can buy at wholesale.', '0.00', 0, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_vm_shopper_vendor_xref`
--

CREATE TABLE IF NOT EXISTS `jos_vm_shopper_vendor_xref` (
  `user_id` int(11) default NULL,
  `vendor_id` int(11) default NULL,
  `shopper_group_id` int(11) default NULL,
  `customer_number` varchar(32) default NULL,
  KEY `idx_shopper_vendor_xref_user_id` (`user_id`),
  KEY `idx_shopper_vendor_xref_vendor_id` (`vendor_id`),
  KEY `idx_shopper_vendor_xref_shopper_group_id` (`shopper_group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Maps a user to a Shopper Group of a Vendor';

--
-- Extraindo dados da tabela `jos_vm_shopper_vendor_xref`
--

INSERT INTO `jos_vm_shopper_vendor_xref` (`user_id`, `vendor_id`, `shopper_group_id`, `customer_number`) VALUES
(62, 1, 5, ''),
(63, 1, 5, ''),
(64, 1, 5, ''),
(66, 1, 5, '105165770446a7b6be0ef4b'),
(67, 1, 5, '82854347846a7bf93d0687'),
(68, 1, 5, '22541564646aa848207352'),
(72, 1, 5, '187544341446b76697ac497');

-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_vm_state`
--

CREATE TABLE IF NOT EXISTS `jos_vm_state` (
  `state_id` int(11) NOT NULL auto_increment,
  `country_id` int(11) NOT NULL default '1',
  `state_name` varchar(64) default NULL,
  `state_3_code` char(3) default NULL,
  `state_2_code` char(2) default NULL,
  PRIMARY KEY  (`state_id`),
  UNIQUE KEY `state_3_code` (`state_3_code`,`state_2_code`),
  KEY `idx_country_id` (`country_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='States that are assigned to a country' AUTO_INCREMENT=209 ;

--
-- Extraindo dados da tabela `jos_vm_state`
--

INSERT INTO `jos_vm_state` (`state_id`, `country_id`, `state_name`, `state_3_code`, `state_2_code`) VALUES
(1, 223, 'Alabama', 'ALA', 'AL'),
(2, 223, 'Alaska', 'ALK', 'AK'),
(3, 223, 'Arizona', 'ARZ', 'AZ'),
(4, 223, 'Arkansas', 'ARK', 'AR'),
(5, 223, 'California', 'CAL', 'CA'),
(6, 223, 'Colorado', 'COL', 'CO'),
(7, 223, 'Connecticut', 'CCT', 'CT'),
(8, 223, 'Delaware', 'DEL', 'DE'),
(9, 223, 'District Of Columbia', 'DOC', 'DC'),
(10, 223, 'Florida', 'FLO', 'FL'),
(11, 223, 'Georgia', 'GEA', 'GA'),
(12, 223, 'Hawaii', 'HWI', 'HI'),
(13, 223, 'Idaho', 'IDA', 'ID'),
(14, 223, 'Illinois', 'ILL', 'IL'),
(15, 223, 'Indiana', 'IND', 'IN'),
(16, 223, 'Iowa', 'IOA', 'IA'),
(17, 223, 'Kansas', 'KAS', 'KS'),
(18, 223, 'Kentucky', 'KTY', 'KY'),
(19, 223, 'Louisiana', 'LOA', 'LA'),
(20, 223, 'Maine', 'MAI', 'ME'),
(21, 223, 'Maryland', 'MLD', 'MD'),
(22, 223, 'Massachusetts', 'MSA', 'MA'),
(23, 223, 'Michigan', 'MIC', 'MI'),
(24, 223, 'Minnesota', 'MIN', 'MN'),
(25, 223, 'Mississippi', 'MIS', 'MS'),
(26, 223, 'Missouri', 'MIO', 'MO'),
(27, 223, 'Montana', 'MOT', 'MT'),
(28, 223, 'Nebraska', 'NEB', 'NE'),
(29, 223, 'Nevada', 'NEV', 'NV'),
(30, 223, 'New Hampshire', 'NEH', 'NH'),
(31, 223, 'New Jersey', 'NEJ', 'NJ'),
(32, 223, 'New Mexico', 'NEM', 'NM'),
(33, 223, 'New York', 'NEY', 'NY'),
(34, 223, 'North Carolina', 'NOC', 'NC'),
(35, 223, 'North Dakota', 'NOD', 'ND'),
(36, 223, 'Ohio', 'OHI', 'OH'),
(37, 223, 'Oklahoma', 'OKL', 'OK'),
(38, 223, 'Oregon', 'ORN', 'OR'),
(39, 223, 'Pennsylvania', 'PEA', 'PA'),
(40, 223, 'Rhode Island', 'RHI', 'RI'),
(41, 223, 'South Carolina', 'SOC', 'SC'),
(42, 223, 'South Dakota', 'SOD', 'SD'),
(43, 223, 'Tennessee', 'TEN', 'TN'),
(44, 223, 'Texas', 'TXS', 'TX'),
(45, 223, 'Utah', 'UTA', 'UT'),
(46, 223, 'Vermont', 'VMT', 'VT'),
(47, 223, 'Virginia', 'VIA', 'VA'),
(48, 223, 'Washington', 'WAS', 'WA'),
(49, 223, 'West Virginia', 'WEV', 'WV'),
(50, 223, 'Wisconsin', 'WIS', 'WI'),
(51, 223, 'Wyoming', 'WYO', 'WY'),
(52, 38, 'Alberta', 'ALB', 'AB'),
(53, 38, 'British Columbia', 'BRC', 'BC'),
(54, 38, 'Manitoba', 'MAB', 'MB'),
(55, 38, 'New Brunswick', 'NEB', 'NB'),
(56, 38, 'Newfoundland and Labrador', 'NFL', 'NL'),
(57, 38, 'Northwest Territories', 'NWT', 'NT'),
(58, 38, 'Nova Scotia', 'NOS', 'NS'),
(59, 38, 'Nunavut', 'NUT', 'NU'),
(60, 38, 'Ontario', 'ONT', 'ON'),
(61, 38, 'Prince Edward Island', 'PEI', 'PE'),
(62, 38, 'Quebec', 'QEC', 'QC'),
(63, 38, 'Saskatchewan', 'SAK', 'SK'),
(64, 38, 'Yukon', 'YUT', 'YT'),
(65, 222, 'England', 'ENG', 'EN'),
(66, 222, 'Northern Ireland', 'NOI', 'NI'),
(67, 222, 'Scotland', 'SCO', 'SD'),
(68, 222, 'Wales', 'WLS', 'WS'),
(69, 13, 'Australian Capital Territory', 'ACT', 'AT'),
(70, 13, 'New South Wales', 'NSW', 'NW'),
(71, 13, 'Northern Territory', 'NOT', 'NT'),
(72, 13, 'Queensland', 'QLD', 'QL'),
(73, 13, 'South Australia', 'SOA', 'SA'),
(74, 13, 'Tasmania', 'TAS', 'TA'),
(75, 13, 'Victoria', 'VIC', 'VI'),
(76, 13, 'Western Australia', 'WEA', 'WA'),
(77, 138, 'Aguascalientes', 'AGS', 'AG'),
(78, 138, 'Baja California Norte', 'BCN', 'BN'),
(79, 138, 'Baja California Sur', 'BCS', 'BS'),
(80, 138, 'Campeche', 'CAM', 'CA'),
(81, 138, 'Chiapas', 'CHI', 'CS'),
(82, 138, 'Chihuahua', 'CHA', 'CH'),
(83, 138, 'Coahuila', 'COA', 'CO'),
(84, 138, 'Colima', 'COL', 'CM'),
(85, 138, 'Distrito Federal', 'DFM', 'DF'),
(86, 138, 'Durango', 'DGO', 'DO'),
(87, 138, 'Guanajuato', 'GTO', 'GO'),
(88, 138, 'Guerrero', 'GRO', 'GU'),
(89, 138, 'Hidalgo', 'HGO', 'HI'),
(90, 138, 'Jalisco', 'JAL', 'JA'),
(91, 138, 'MÃ©xico (Estado de)', 'EDM', 'EM'),
(92, 138, 'MichoacÃ¡n', 'MCN', 'MI'),
(93, 138, 'Morelos', 'MOR', 'MO'),
(94, 138, 'Nayarit', 'NAY', 'NY'),
(95, 138, 'Nuevo LeÃ³n', 'NUL', 'NL'),
(96, 138, 'Oaxaca', 'OAX', 'OA'),
(97, 138, 'Puebla', 'PUE', 'PU'),
(98, 138, 'QuerÃ©taro', 'QRO', 'QU'),
(99, 138, 'Quintana Roo', 'QUR', 'QR'),
(100, 138, 'San Luis PotosÃ­', 'SLP', 'SP'),
(101, 138, 'Sinaloa', 'SIN', 'SI'),
(102, 138, 'Sonora', 'SON', 'SO'),
(103, 138, 'Tabasco', 'TAB', 'TA'),
(104, 138, 'Tamaulipas', 'TAM', 'TM'),
(105, 138, 'Tlaxcala', 'TLX', 'TX'),
(106, 138, 'Veracruz', 'VER', 'VZ'),
(107, 138, 'YucatÃ¡n', 'YUC', 'YU'),
(108, 138, 'Zacatecas', 'ZAC', 'ZA'),
(109, 30, 'Acre', 'ACR', 'AC'),
(110, 30, 'Alagoas', 'ALG', 'AL'),
(111, 30, 'AmapÃ¡', 'AMP', 'AP'),
(112, 30, 'Amazonas', 'AMZ', 'AM'),
(113, 30, 'BahÃ­a', 'BAH', 'BA'),
(114, 30, 'CearÃ¡', 'CEA', 'CE'),
(115, 30, 'Distrito Federal', 'DFB', 'DF'),
(116, 30, 'Espirito Santo', 'ESS', 'ES'),
(117, 30, 'GoiÃ¡s', 'GOI', 'GO'),
(118, 30, 'MaranhÃ£o', 'MAR', 'MA'),
(119, 30, 'Mato Grosso', 'MAT', 'MT'),
(120, 30, 'Mato Grosso do Sul', 'MGS', 'MS'),
(121, 30, 'Minas GeraÃ­s', 'MIG', 'MG'),
(122, 30, 'ParanÃ¡', 'PAR', 'PR'),
(123, 30, 'ParaÃ­ba', 'PRB', 'PB'),
(124, 30, 'ParÃ¡', 'PAB', 'PA'),
(125, 30, 'Pernambuco', 'PER', 'PR'),
(126, 30, 'PiauÃ­', 'PIA', 'PI'),
(127, 30, 'Rio Grande do Norte', 'RGN', 'RN'),
(128, 30, 'Rio Grande do Sul', 'RGS', 'RS'),
(129, 30, 'Rio de Janeiro', 'RDJ', 'RJ'),
(130, 30, 'RondÃ´nia', 'RON', 'RO'),
(131, 30, 'Roraima', 'ROR', 'RR'),
(132, 30, 'Santa Catarina', 'SAC', 'SC'),
(133, 30, 'Sergipe', 'SER', 'SE'),
(134, 30, 'SÃ£o Paulo', 'SAP', 'SP'),
(135, 30, 'Tocantins', 'TOC', 'TO'),
(136, 44, 'Anhui', 'ANH', 'AN'),
(137, 44, 'Beijing', 'BEI', 'BE'),
(138, 44, 'Fujian', 'FUJ', 'FJ'),
(139, 44, 'Gansu', 'GAN', 'GU'),
(140, 44, 'Guangdong', 'GUA', 'GU'),
(141, 44, 'Guangxi Zhuang', 'GUZ', 'GZ'),
(142, 44, 'Guizhou', 'GUI', 'GI'),
(143, 44, 'Hainan', 'HAI', 'HA'),
(144, 44, 'Hebei', 'HEB', 'HE'),
(145, 44, 'Heilongjiang', 'HEI', 'HG'),
(146, 44, 'Henan', 'HEN', 'HN'),
(147, 44, 'Hubei', 'HUB', 'HI'),
(148, 44, 'Hunan', 'HUN', 'HU'),
(149, 44, 'Jiangsu', 'JIA', 'JI'),
(150, 44, 'Jiangxi', 'JIX', 'JX'),
(151, 44, 'Jilin', 'JIL', 'JN'),
(152, 44, 'Liaoning', 'LIA', 'LI'),
(153, 44, 'Nei Mongol', 'NML', 'NM'),
(154, 44, 'Ningxia Hui', 'NIH', 'NH'),
(155, 44, 'Qinghai', 'QIN', 'QI'),
(156, 44, 'Shaanxi', 'SHA', 'SH'),
(157, 44, 'Shandong', 'SNG', 'SG'),
(158, 44, 'Shanghai', 'SHH', 'SI'),
(159, 44, 'Shanxi', 'SHX', 'SX'),
(160, 44, 'Sichuan', 'SIC', 'SN'),
(161, 44, 'Tianjin', 'TIA', 'TI'),
(162, 44, 'Xinjiang Uygur', 'XIU', 'XU'),
(163, 44, 'Xizang', 'XIZ', 'XI'),
(164, 44, 'Yunnan', 'YUN', 'YU'),
(165, 44, 'Zhejiang', 'ZHE', 'ZH'),
(166, 151, 'Bonaire', 'BNR', 'BN'),
(167, 151, 'Curacao', 'CUR', 'CR'),
(168, 175, 'Alba', 'ABA', 'AB'),
(169, 175, 'Arad', 'ARD', 'AR'),
(170, 175, 'Arges', 'ARG', 'AG'),
(171, 175, 'Bacau', 'BAC', 'BC'),
(172, 175, 'Bihor', 'BIH', 'BH'),
(173, 175, 'Bistrita-Nasaud', 'BIS', 'BN'),
(174, 175, 'Botosani', 'BOT', 'BT'),
(175, 175, 'Braila', 'BRL', 'BL'),
(176, 175, 'Brasov', 'BRA', 'BR'),
(177, 175, 'Bucuresti', 'BUC', 'IF'),
(178, 175, 'Buzau', 'BUZ', 'BU'),
(179, 175, 'Calarasi', 'CAL', 'CL'),
(180, 175, 'Caras Severin', 'CRS', 'CS'),
(181, 175, 'Cluj', 'CLJ', 'CJ'),
(182, 175, 'Constanta', 'CST', 'CT'),
(183, 175, 'Covasna', 'COV', 'CV'),
(184, 175, 'Dambovita', 'DAM', 'DV'),
(185, 175, 'Dolj', 'DLJ', 'DJ'),
(186, 175, 'Galati', 'GAL', 'GL'),
(187, 175, 'Giurgiu', 'GIU', 'GR'),
(188, 175, 'Hargita', 'HRG', 'HR'),
(189, 175, 'Hunedoara', 'HUN', 'HN'),
(190, 175, 'Ialomita', 'IAL', 'IL'),
(191, 175, 'Iasi', 'IAS', 'IS'),
(192, 175, 'Ilfov', 'ILF', 'IF'),
(193, 175, 'Maramures', 'MAR', 'MM'),
(194, 175, 'Mehedinti', 'MEH', 'MH'),
(195, 175, 'Mures', 'MUR', 'MS'),
(196, 175, 'Neamt', 'NEM', 'NT'),
(197, 175, 'Olt', 'OLT', 'OT'),
(198, 175, 'Prahova', 'PRA', 'PR'),
(199, 175, 'Salaj', 'SAL', 'SJ'),
(200, 175, 'Satu Mare', 'SAT', 'ST'),
(201, 175, 'Sibiu', 'SIB', 'SB'),
(202, 175, 'Suceava', 'SUC', 'SV'),
(203, 175, 'Teleorman', 'TEL', 'TL'),
(204, 175, 'Timis', 'TIM', 'TM'),
(205, 175, 'Tulcea', 'TUL', 'TL'),
(206, 175, 'Valcea', 'VAL', 'VL'),
(207, 175, 'Vaslui', 'VAS', 'VS'),
(208, 175, 'Vreancea', 'VRA', 'VR');

-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_vm_tax_rate`
--

CREATE TABLE IF NOT EXISTS `jos_vm_tax_rate` (
  `tax_rate_id` int(11) NOT NULL auto_increment,
  `vendor_id` int(11) default NULL,
  `tax_state` varchar(64) default NULL,
  `tax_country` varchar(64) default NULL,
  `mdate` int(11) default NULL,
  `tax_rate` decimal(10,4) default NULL,
  PRIMARY KEY  (`tax_rate_id`),
  KEY `idx_tax_rate_vendor_id` (`vendor_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='The tax rates for your store' AUTO_INCREMENT=3 ;

--
-- Extraindo dados da tabela `jos_vm_tax_rate`
--

INSERT INTO `jos_vm_tax_rate` (`tax_rate_id`, `vendor_id`, `tax_state`, `tax_country`, `mdate`, `tax_rate`) VALUES
(2, 1, 'CA', 'USA', 964565926, '0.0825');

-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_vm_user_info`
--

CREATE TABLE IF NOT EXISTS `jos_vm_user_info` (
  `user_info_id` varchar(32) NOT NULL default '',
  `user_id` int(11) NOT NULL default '0',
  `address_type` char(2) default NULL,
  `address_type_name` varchar(32) default NULL,
  `company` varchar(64) default NULL,
  `title` varchar(32) default NULL,
  `last_name` varchar(32) default NULL,
  `first_name` varchar(32) default NULL,
  `middle_name` varchar(32) default NULL,
  `phone_1` varchar(32) default NULL,
  `phone_2` varchar(32) default NULL,
  `fax` varchar(32) default NULL,
  `address_1` varchar(64) NOT NULL default '',
  `address_2` varchar(64) default NULL,
  `city` varchar(32) NOT NULL default '',
  `state` varchar(32) NOT NULL default '',
  `country` varchar(32) NOT NULL default 'US',
  `zip` varchar(32) NOT NULL default '',
  `user_email` varchar(255) default NULL,
  `extra_field_1` varchar(255) default NULL,
  `extra_field_2` varchar(255) default NULL,
  `extra_field_3` varchar(255) default NULL,
  `extra_field_4` char(1) default NULL,
  `extra_field_5` char(1) default NULL,
  `cdate` int(11) default NULL,
  `mdate` int(11) default NULL,
  `perms` varchar(40) NOT NULL default 'shopper',
  `bank_account_nr` varchar(32) NOT NULL default '',
  `bank_name` varchar(32) NOT NULL default '',
  `bank_sort_code` varchar(16) NOT NULL default '',
  `bank_iban` varchar(64) NOT NULL default '',
  `bank_account_holder` varchar(48) NOT NULL default '',
  `bank_account_type` enum('Checking','Business Checking','Savings') NOT NULL default 'Checking',
  PRIMARY KEY  (`user_info_id`),
  KEY `idx_user_info_user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Customer Information, BT = BillTo and ST = ShipTo';

--
-- Extraindo dados da tabela `jos_vm_user_info`
--

INSERT INTO `jos_vm_user_info` (`user_info_id`, `user_id`, `address_type`, `address_type_name`, `company`, `title`, `last_name`, `first_name`, `middle_name`, `phone_1`, `phone_2`, `fax`, `address_1`, `address_2`, `city`, `state`, `country`, `zip`, `user_email`, `extra_field_1`, `extra_field_2`, `extra_field_3`, `extra_field_4`, `extra_field_5`, `cdate`, `mdate`, `perms`, `bank_account_nr`, `bank_name`, `bank_sort_code`, `bank_iban`, `bank_account_holder`, `bank_account_type`) VALUES
('9846e1d2e15bebdbd416b179549ed5ef', 62, 'BT', '', '', '', '', '', '', '', '', '', '', '', '', '', 'US', '', 'leo_lima_jlle@yahoo.com.br', '', '', '', '', '', 1182798029, 1184643369, 'shopper', '', '', '', '', '', 'Checking'),
('9c070d854a15f72a85f44fd748da001f', 63, 'BT', '', '', '', '', '', '', '', '', '', '', '', '', '', 'US', '', 'leonardo.vasconcellos@gmail.com', '', '', '', '', '', 1182968034, 0, 'shopper', '', '', '', '', '', 'Checking'),
('5dd75acc241e9be9741405d0b5198bd3', 64, 'BT', '', '', '', '', '', '', '', '', '', '', '', '', '', 'US', '', 'wandervonmuller@vonmuller.com', '', '', '', '', '', 1182968240, 1182983453, 'shopper', '', '', '', '', '', 'Checking'),
('08816bfbcc3c1082ce14d953f3a2ef2e', 67, 'BT', '-default-', '', 'Sr.', 'Vasconcellos', 'Leonardo', 'Lima de', '(47) 34346908', '(47) 8405-1020', '', 'Rua Orestes Guimarães, 255 - apto 401', 'Centro', 'Joinville', '', 'BRA', '89217-001', 'leo_lima_jlle@yahoo.com.br', '', '', '', '', '', 1185398672, 1185398672, 'shopper', '', '', '', '', '', ''),
('7806273a5ccfb7a48a063fbbb596d30c', 68, 'BT', '-default-', '', 'Sra.', 'Lima', 'Denise', 'Alcantara Bezerra', '47-34346908', '47-99610414', '', 'Rua Orestes Guimarães, 225 apt. 604, centro', '', 'Joinville', '', 'BRA', '89204060', 'denisejlle@hotmail.com', '', '', '', '', '', 1185580157, 1185580157, 'shopper', '', '', '', '', '', ''),
('71b0f0e2367512cc4d860acee4d06014', 72, 'BT', '-default-', '', '', 'lima', 'rafa', '', '789797', '', '', 'ruajlkdfsaj l', '', 'joinville', '', 'BRA', '8921777000', 'llvasconcellos@hotmail.com', '', '', '', '', '', 1186424469, 1186424469, 'shopper', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_vm_vendor`
--

CREATE TABLE IF NOT EXISTS `jos_vm_vendor` (
  `vendor_id` int(11) NOT NULL auto_increment,
  `vendor_name` varchar(64) default NULL,
  `contact_last_name` varchar(32) NOT NULL default '',
  `contact_first_name` varchar(32) NOT NULL default '',
  `contact_middle_name` varchar(32) default NULL,
  `contact_title` varchar(32) default NULL,
  `contact_phone_1` varchar(32) NOT NULL default '',
  `contact_phone_2` varchar(32) default NULL,
  `contact_fax` varchar(32) default NULL,
  `contact_email` varchar(255) default NULL,
  `vendor_phone` varchar(32) default NULL,
  `vendor_address_1` varchar(64) NOT NULL default '',
  `vendor_address_2` varchar(64) default NULL,
  `vendor_city` varchar(32) NOT NULL default '',
  `vendor_state` varchar(32) NOT NULL default '',
  `vendor_country` varchar(32) NOT NULL default 'US',
  `vendor_zip` varchar(32) NOT NULL default '',
  `vendor_store_name` varchar(128) NOT NULL default '',
  `vendor_store_desc` text,
  `vendor_category_id` int(11) default NULL,
  `vendor_thumb_image` varchar(255) default NULL,
  `vendor_full_image` varchar(255) default NULL,
  `vendor_currency` varchar(16) default NULL,
  `cdate` int(11) default NULL,
  `mdate` int(11) default NULL,
  `vendor_image_path` varchar(255) default NULL,
  `vendor_terms_of_service` text NOT NULL,
  `vendor_url` varchar(255) NOT NULL default '',
  `vendor_min_pov` decimal(10,2) default NULL,
  `vendor_freeshipping` decimal(10,2) NOT NULL default '0.00',
  `vendor_currency_display_style` varchar(64) NOT NULL default '',
  PRIMARY KEY  (`vendor_id`),
  KEY `idx_vendor_name` (`vendor_name`),
  KEY `idx_vendor_category_id` (`vendor_category_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='Vendors manage their products in your store' AUTO_INCREMENT=2 ;

--
-- Extraindo dados da tabela `jos_vm_vendor`
--

INSERT INTO `jos_vm_vendor` (`vendor_id`, `vendor_name`, `contact_last_name`, `contact_first_name`, `contact_middle_name`, `contact_title`, `contact_phone_1`, `contact_phone_2`, `contact_fax`, `contact_email`, `vendor_phone`, `vendor_address_1`, `vendor_address_2`, `vendor_city`, `vendor_state`, `vendor_country`, `vendor_zip`, `vendor_store_name`, `vendor_store_desc`, `vendor_category_id`, `vendor_thumb_image`, `vendor_full_image`, `vendor_currency`, `cdate`, `mdate`, `vendor_image_path`, `vendor_terms_of_service`, `vendor_url`, `vendor_min_pov`, `vendor_freeshipping`, `vendor_currency_display_style`) VALUES
(1, 'Núcleo do Evento', 'Vasconcellos', 'Leonardo', 'Lima', 'Sr.', '55 (47) 3465-2943', '', '', 'leonardo@nucleodoevento.com.br', '55 (47) 3465-2943', 'Rua Santo Agostinho, 96 - Sala 1', 'Guanabara', 'Joinville', 'SC', 'BRA', '89207-650', 'Núcleo do Evento', '<p><strong>N&oacute;s temos os melhores produtos para seu evento, sua casa, sua vida!</strong></p><p>Trabalhamos com profissionais qualificados e produtos de alta qualidade. </p><p>Por Favor <a href=\\"https://nucleodoevento.websiteseguro.com/index.php?option=com_virtuemart&amp;page=shop.registration\\">registre-se</a> para poder comprar.</p><p>Aqui voc&ecirc; disp&otilde;e de v&aacute;rios m&eacute;todos de pagamento, como boletos&nbsp;banc&aacute;rios e cart&otilde;es de cr&eacute;dito.&nbsp;N&oacute;s tamb&eacute;m&nbsp;somos conveniados as seguintes empresas de pagamentos online:</p><p><img src=\\"https://pagseguro.uol.com.br/Security/Imagens/btnPreferenciaCartoesBR.gif\\" alt=\\"Pagseguro\\" title=\\"Pagseguro\\" width=\\"418\\" height=\\"74\\" /></p>', 0, '', 'd4adb036b15ce3e3025f24e3848b5d39.jpg', 'BRL', 950302468, 1186427667, 'shop_image/', '<h1 class=\\"contentpane\\">Termos do Servi&ccedil;o</h1><!-- begin content --><div class=\\"wiki-content\\"><hr /></div><div class=\\"wiki-content\\"><p>Ao usar um servi&ccedil;o especifico do N&uacute;cleo do Evento, o Usu&aacute;rio e o N&uacute;cleo do Evento est&atilde;o cientes de que estar&atilde;o sujeitos a qualquer manual ou regras aplic&aacute;veis a tal servi&ccedil;o, esteja ele dispon&iacute;vel ou n&atilde;o no momento. Todos os manuais ou regras s&atilde;o, neste ato, integrados aos Termos do Servi&ccedil;o como refer&ecirc;ncia. </p><p>Os Termos do Servi&ccedil;o Casando Bem , que passaremos a referir como os &quot;Termos do Servi&ccedil;o&quot;, poder&atilde;o ser atualizados ou modificados a qualquer momento pelo N&uacute;cleo do Evento. O Usu&aacute;rio poder&aacute; revisar a vers&atilde;o mais recente dos Termos do Servi&ccedil;o a qualquer tempo acessando <a href=\\"index2.php?option=com_virtuemart&amp;page=shop.tos&amp;pop=1\\" target=\\"_blank\\">Termos do Servi&ccedil;o</a> </p><p class=\\"contentpane\\">Constituem parte integrante dos Termos do Servi&ccedil;o: os termos e condi&ccedil;&otilde;es contidos neste documento, a Pol&iacute;tica de Privacidade do N&uacute;cleo do Evento e quaisquer regras ou pol&iacute;ticas vigentes que possam ser publicadas, de tempos em tempos, pelo N&uacute;cleo do Evento, aplic&aacute;veis a cada um dos Servi&ccedil;os (ou a qualquer outro servi&ccedil;o que venha a ser fornecido pelo N&uacute;cleo do Evento no futuro). </p><p>Ao clicar em &quot;Eu Aceito&quot; e a utiliza&ccedil;&atilde;o de qualquer Servi&ccedil;o, o Usu&aacute;rio indica que leu e concordou, mesmo que tacitamente, com a vers&atilde;o mais recente dos Termos do Servi&ccedil;o e vincular&aacute; automaticamente o Usu&aacute;rio &agrave;s regras ali contidas. </p><h4 class=\\"contentpane\\">Descri&ccedil;&atilde;o do Servi&ccedil;o</h4><p class=\\"contentpane\\">Atualmente, o N&uacute;cleo do Evento fornece ao Usu&aacute;rio acesso a v&aacute;rios recursos online, como f&oacute;runs de debate, &aacute;lbum digital, servi&ccedil;os de com&eacute;rcio eletr&ocirc;nico e conte&uacute;do personaliz&aacute;vel (&quot;Servi&ccedil;o(s)&quot;), entre outros. Salvo estabelecido de forma diversa, qualquer novo recurso que aumente ou aprimore os Servi&ccedil;os atualmente disponibilizados, incluindo novos lan&ccedil;amentos no N&uacute;cleo do Evento, estar&aacute; automaticamente sujeito aos Termos de Servi&ccedil;o. </p><p class=\\"contentpane\\">O Usu&aacute;rio est&aacute; ciente e concorda que o Servi&ccedil;o &eacute; fornecido na forma como est&aacute; disponibilizado e que o N&uacute;cleo do Evento n&atilde;o &eacute; respons&aacute;vel por exclus&atilde;o, n&atilde;o entrega ou falha no arquivamento de qualquer comunica&ccedil;&atilde;o do Usu&aacute;rio ou estabelecimento de suas op&ccedil;&otilde;es de personaliza&ccedil;&atilde;o. </p><p class=\\"contentpane\\">De forma a bem utilizar o Servi&ccedil;o, o Usu&aacute;rio deve obter, por si, acesso &agrave; &quot;World Wide Web&quot;, seja diretamente ou atrav&eacute;s de dispositivos que possam disponibilizar o conte&uacute;do existente na Web, pagando os valores cobrados por seu provedor de acesso, se este for o caso, e providenciando todo o equipamento necess&aacute;rio para efetuar sua conex&atilde;o &agrave; World Wide Web, incluindo computador, modem ou outro dispositivo de acesso. Atente que certas &aacute;reas do Servi&ccedil;o podem conter conte&uacute;do dirigido a um p&uacute;blico adulto. O Usu&aacute;rio precisar&aacute; ter pelo menos 18 anos para acessar tais &aacute;reas. </p><p class=\\"contentpane\\">O Servi&ccedil;o &eacute; fornecido apenas conforme e quando estiver dispon&iacute;vel. Atualmente, o N&uacute;cleo do Evento n&atilde;o cobra o Usu&aacute;rio pelo Servi&ccedil;o (exceto por Aperfei&ccedil;oamentos que o Usu&aacute;rio possa desejar obter), mas no futuro, o N&uacute;cleo do Evento poder&aacute; cobrar uma taxa pelo Servi&ccedil;o ou parte dele, mediante modifica&ccedil;&atilde;o dos Termos do Servi&ccedil;o. </p><p class=\\"contentpane\\">O Usu&aacute;rio entende e concorda que o N&uacute;cleo do Evento n&atilde;o fornecer&aacute; nenhuma assist&ecirc;ncia, nem qualquer tipo de suporte t&eacute;cnico com rela&ccedil;&atilde;o ao Servi&ccedil;o. A utiliza&ccedil;&atilde;o do Servi&ccedil;o ser&aacute; ao inteiro risco do Usu&aacute;rio, sendo que o N&uacute;cleo do Evento apenas concordou em fornecer gratuitamente o Servi&ccedil;o de acordo com as condi&ccedil;&otilde;es estabelecidas nos Termos do Servi&ccedil;o. </p><p class=\\"contentpane\\">Quanto &agrave; divulga&ccedil;&atilde;o de fotos e textos pelo Usu&aacute;rio no site, o N&uacute;cleo do Evento apenas fornece um local transit&oacute;rio e tempor&aacute;rio para que voc&ecirc; possa publicar copias em formato de arquivos eletr&ocirc;nicos de suas fotos, imagens e textos em forma digital, em ambiente remoto, dispon&iacute;vel pela Internet, para exibi-los a seus convidados. O N&uacute;cleo do Evento tem por finalidade, exclusivamente, fornecer o meio f&iacute;sico para exposi&ccedil;&atilde;o de seus arquivos, proporcionando relacionamentos sociais entre pessoas, sem qualquer outro prop&oacute;sito. </p><p class=\\"contentpane\\">O N&uacute;cleo do Evento disponibiliza ao Usu&aacute;rio publicar algumas fotos em um &aacute;lbum digital. Contudo, o N&uacute;cleo do Evento n&atilde;o tem por finalidade o armazenamento de seus arquivos fotogr&aacute;ficos. As imagens enviados pelo Usu&aacute;rio ser&atilde;o de inteira responsabilidade do mesmo, que deve respeitar e aceitar a pol&iacute;tica de privacidade e os termos do servi&ccedil;o do N&uacute;cleo do Evento. O N&uacute;cleo do Evento n&atilde;o se responsabiliza por qualquer perda ou dano que essa publica&ccedil;&atilde;o possa gerar ao Usu&aacute;rio. </p><p class=\\"contentpane\\">O Usu&aacute;rio est&aacute; obrigado a respeitar a privacidade dos demais usu&aacute;rios dos servi&ccedil;os oferecidos pelo N&uacute;cleo do Evento, a n&atilde;o tomar qualquer medida e a n&atilde;o praticar qualquer ato que, direta ou indiretamente, prejudique os direitos do N&uacute;cleo do Evento, seus patrocinadores, os direitos autorais e de imagem do N&uacute;cleo do Evento, de terceiros e de outros usu&aacute;rios dos servi&ccedil;os do N&uacute;cleo do Evento. </p><h4 class=\\"contentpane\\">Obriga&ccedil;&otilde;es de Registro do Usu&aacute;rio</h4><p class=\\"contentpane\\">Em considera&ccedil;&atilde;o &agrave; utiliza&ccedil;&atilde;o do Servi&ccedil;o, o Usu&aacute;rio concorda em: </p><ul><li class=\\"contentpane\\">fornecer informa&ccedil;&otilde;es verdadeiras, exatas, atuais e completas sobre si mesmo quando do registro no formul&aacute;rio espec&iacute;fico (&quot;Informa&ccedil;&otilde;es de Registro&quot;) para acesso ao Servi&ccedil;o; </li><li class=\\"contentpane\\">conservar e atualizar imediatamente tais informa&ccedil;&otilde;es de Registro para mant&ecirc;-las verdadeiras, exatas, atuais e completas. </li></ul><p class=\\"contentpane\\">Se qualquer informa&ccedil;&atilde;o fornecida pelo Usu&aacute;rio for falsa, incorreta, desatualizada ou incompleta, ou caso o N&uacute;cleo do Evento tenha raz&otilde;es suficientes para suspeitar que tais informa&ccedil;&otilde;es sejam falsas, incorretas, desatualizadas ou incompletas, o N&uacute;cleo do Evento ter&aacute; o direito em suspender ou cancelar imediatamente, independente de notifica&ccedil;&atilde;o, a conta do Usu&aacute;rio e recusar toda e qualquer utiliza&ccedil;&atilde;o, presente ou futura do Servi&ccedil;o, ou parte dele. </p><p class=\\"contentpane\\">O N&uacute;cleo do Evento se preocupa com a seguran&ccedil;a e privacidade de todos os seus Usu&aacute;rios, especialmente crian&ccedil;as ou adolescentes que eventualmente possam acessar o Servi&ccedil;o. De acordo com a legisla&ccedil;&atilde;o aplic&aacute;vel &agrave; crian&ccedil;a e ao adolescente, &eacute; responsabilidade dos pais determinar se determinado Servi&ccedil;o e/ou Conte&uacute;do &eacute; apropriado. </p><h4 class=\\"contentpane\\">Pol&iacute;tica de Privacidade</h4><p class=\\"contentpane\\">O N&uacute;cleo do Evento possui uma pol&iacute;tica expressa sobre a quest&atilde;o da privacidade online. As Informa&ccedil;&otilde;es de Registro e algumas outras informa&ccedil;&otilde;es sobre o Usu&aacute;rio est&atilde;o sujeitas ao tratamento referido em tal pol&iacute;tica de privacidade. </p><p class=\\"contentpane\\">Favor consultar o documento &quot;Pol&iacute;tica de Privacidade&quot; dispon&iacute;vel em Pol&iacute;tica de Privacidade para maiores informa&ccedil;&otilde;es. Tal documento constitui parte integrante dos Termos do Servi&ccedil;o e dever&aacute; ser lido atentamente por todos os Usu&aacute;rios antes da aceita&ccedil;&atilde;o e utiliza&ccedil;&atilde;o do Servi&ccedil;o. </p><h4 class=\\"contentpane\\">Senha e Seguran&ccedil;a</h4><p class=\\"contentpane\\">Ao final do processo de registro de conta, o Usu&aacute;rio dever&aacute; escolher uma senha e identifica&ccedil;&atilde;o, passando a ser integralmente respons&aacute;vel por manter a confidencialidade da senha e desta identifica&ccedil;&atilde;o bem como por todas as atividades que ocorram sob sua senha e/ou identifica&ccedil;&atilde;o. O Usu&aacute;rio concorda em: </p><ul><li class=\\"contentpane\\">notificar imediatamente o N&uacute;cleo do Evento sobre qualquer uso n&atilde;o autorizado da sua senha ou conta ou qualquer outra quebra de seguran&ccedil;a de que tome conhecimento; </li><li class=\\"contentpane\\">sair de sua conta de Usu&aacute;rio ao final de cada sess&atilde;o e assegurar que esta n&atilde;o seja acessada por terceiros n&atilde;o autorizados. O N&uacute;cleo do Evento n&atilde;o ser&aacute; respons&aacute;vel por qualquer perda ou dano decorrente do descumprimento do disposto nesta cl&aacute;usula por parte do Usu&aacute;rio. </li></ul><h4 class=\\"contentpane\\">Conduta do Usu&aacute;rio</h4><p class=\\"contentpane\\">O Usu&aacute;rio reconhece e concorda que qualquer informa&ccedil;&atilde;o, dado, texto, software, m&uacute;sica, som, fotografia, gr&aacute;fico, v&iacute;deo, mensagem ou qualquer outro material (o &quot;Conte&uacute;do&quot;), seja ele veiculado publicamente ou transmitido privativamente atrav&eacute;s do Servi&ccedil;o, ser&aacute; de total responsabilidade da pessoa f&iacute;sica ou jur&iacute;dica que forneceu originariamente o Conte&uacute;do. </p><p class=\\"contentpane\\">Isto significa que cada Usu&aacute;rio, e nunca o N&uacute;cleo do Evento , &eacute; integralmente respons&aacute;vel por todo e qualquer Conte&uacute;do que seja transmitido a um servidor, exibido ou de qualquer outra forma disponibilizado atrav&eacute;s do Servi&ccedil;o. O N&uacute;cleo do Evento n&atilde;o controla o Conte&uacute;do disponibilizado atrav&eacute;s do Servi&ccedil;o e, como conseq&uuml;&ecirc;ncia, n&atilde;o garante a corre&ccedil;&atilde;o, integridade ou qualidade de tal Conte&uacute;do. </p><p class=\\"contentpane\\">Ao utilizar o Servi&ccedil;o, o Usu&aacute;rio reconhece e concorda que poder&aacute; ficar exposto a Conte&uacute;do ofensivo, imoral ou censur&aacute;vel. Sob nenhuma forma, o N&uacute;cleo do Evento ser&aacute; respons&aacute;vel por qualquer Conte&uacute;do, inclusive, sem limita&ccedil;&atilde;o, por qualquer erro ou omiss&atilde;o em qualquer Conte&uacute;do ou por qualquer perda e dano de qualquer esp&eacute;cie resultante da utiliza&ccedil;&atilde;o de qualquer Conte&uacute;do que seja exibido, enviado, transmitido ou de qualquer outra forma disponibilizado atrav&eacute;s do Servi&ccedil;o. </p><p class=\\"contentpane\\">&Eacute; VEDADO ao Usu&aacute;rio utilizar o Servi&ccedil;o para: </p><ul><li class=\\"contentpane\\">transmitir, exibir, enviar, ou de qualquer outra forma, disponibilizar qualquer Conte&uacute;do que seja ilegal, incluindo, mas n&atilde;o se limitando, que seja ofensivo &agrave; honra, que invada &agrave; privacidade de terceiros amea&ccedil;ador, que seja vulgar, obsceno, preconceituoso, racista ou de qualquer forma censur&aacute;vel, atrav&eacute;s do Servi&ccedil;o; </li><li class=\\"contentpane\\">violar direitos das crian&ccedil;as e adolescentes; </li><li class=\\"contentpane\\">assumir a &quot;personalidade&quot; de outra pessoa, f&iacute;sica ou jur&iacute;dica, ou ainda declarar-se ou apresentar-se falsamente como membro de alguma entidade; </li><li class=\\"contentpane\\">forjar cabe&ccedil;alhos, ou de qualquer outra forma manipular identificadores, a fim de disfar&ccedil;ar a origem de qualquer Conte&uacute;do transmitido atrav&eacute;s do Servi&ccedil;o; </li><li class=\\"contentpane\\">tornar dispon&iacute;vel, divulgar, enviar, transmitir, ou de qualquer outra forma, disponibilizar qualquer Conte&uacute;do sem que tenha o direito de faz&ecirc;-lo de acordo com a lei , por for&ccedil;a de contrato ou de rela&ccedil;&atilde;o de confian&ccedil;a; </li><li class=\\"contentpane\\">tornar dispon&iacute;vel, divulgar, enviar, transmitir ou de qualquer outra forma disponibilizar qualquer Conte&uacute;do que viole qualquer patente, marca, segredo de neg&oacute;cio, direito autoral ou qualquer outro direito de terceiro (&quot;Direitos&quot;); </li><li class=\\"contentpane\\">tornar dispon&iacute;vel, divulgar, enviar, transmitir ou de qualquer outra forma disponibilizar qualquer tipo de propaganda ou material promocional n&atilde;o solicitado ou n&atilde;o autorizado, tais como mensagens n&atilde;o solicitadas (conhecidos como &quot;junk mail&quot; ou &quot;spam&quot;), correntes, esquemas de pir&acirc;mide ou qualquer outra forma de solicita&ccedil;&atilde;o; </li><li class=\\"contentpane\\">tornar dispon&iacute;vel, divulgar, enviar, transmitir ou de qualquer outra forma disponibilizar qualquer Conte&uacute;do que contenha v&iacute;rus ou qualquer outro c&oacute;digo, arquivo ou programa de computador com o prop&oacute;sito de interromper, destruir ou limitar a funcionalidade de qualquer software, hardware ou equipamento de telecomunica&ccedil;&otilde;es; </li><li class=\\"contentpane\\">interromper o fluxo normal de um di&aacute;logo, interferir na utiliza&ccedil;&atilde;o e aproveitamento do Servi&ccedil;o por outros usu&aacute;rios, ou de qualquer outra forma afetar a capacidade de outros Usu&aacute;rios efetuarem comunica&ccedil;&otilde;es ou troca de mensagens em tempo real; </li><li class=\\"contentpane\\">interferir ou interromper o Servi&ccedil;o, as redes ou os servidores conectados ao Servi&ccedil;o, obter ou tentar obter acesso n&atilde;o autorizado a outros sistemas ou redes de computadores conectados ao Servi&ccedil;o ou desobedecer qualquer regra, procedimento, pol&iacute;tica ou regulamento de redes ou sistemas conectados ao Servi&ccedil;o; </li><li class=\\"contentpane\\">violar, seja intencionalmente ou n&atilde;o, qualquer norma legal municipal, estadual, nacional ou internacional que seja integrada ao sistema brasileiro; </li><li class=\\"contentpane\\">vigiar secretamente ou, de qualquer forma, assediar terceiros; </li><li class=\\"contentpane\\">obter ou armazenar dados pessoais sobre outros Usu&aacute;rios, inclusive, mas n&atilde;o se limitando, informa&ccedil;&otilde;es financeiras. </li></ul><p class=\\"contentpane\\">O Usu&aacute;rio reconhece que o N&uacute;cleo do Evento n&atilde;o pr&eacute;-seleciona o Conte&uacute;do a ser disponibilizado atrav&eacute;s do Servi&ccedil;o, mas o N&uacute;cleo do Evento ou seus representantes, reservam-se o direito de (mas n&atilde;o se obrigam), a pr&oacute;pria discri&ccedil;&atilde;o, rejeitar ou modificar a categoria apropriada para a disponibiliza&ccedil;&atilde;o de qualquer Conte&uacute;do atrav&eacute;s do Servi&ccedil;o. Sem limita&ccedil;&atilde;o ao disposto acima, o N&uacute;cleo do Evento e seus representantes ter&atilde;o o direito de retirar do Servi&ccedil;o qualquer Conte&uacute;do que viole os Termos do Servi&ccedil;o ou que seja censur&aacute;vel por qualquer motivo. O Usu&aacute;rio concorda que dever&aacute; pr&eacute;-avaliar e assumir todos os riscos resultantes da utiliza&ccedil;&atilde;o de qualquer Conte&uacute;do, inclusive por confiar que qualquer Conte&uacute;do seja correto, completo ou &uacute;til. Cabe ao Usu&aacute;rio decidir se ir&aacute; ou n&atilde;o confiar em qualquer Conte&uacute;do criado pelo N&uacute;cleo do Evento ou submetido ao N&uacute;cleo do Evento, incluindo, mas n&atilde;o se limitando a, informa&ccedil;&otilde;es disponibilizadas nos F&oacute;runs do N&uacute;cleo do Evento ou em qualquer outra parte do Servi&ccedil;o. </p><p class=\\"contentpane\\">O Usu&aacute;rio reconhece e concorda que o N&uacute;cleo do Evento poder&aacute; preservar o Conte&uacute;do do Usu&aacute;rio, mas tamb&eacute;m poder&aacute; divulg&aacute;-lo se desta forma determinar a Lei ou, de boa f&eacute;, acreditar que a preserva&ccedil;&atilde;o ou a revela&ccedil;&atilde;o seja necess&aacute;ria para: </p><ul><li class=\\"contentpane\\">cumprir com algum procedimento legal; </li><li class=\\"contentpane\\">fazer cumprir os Termos do Servi&ccedil;o; </li><li class=\\"contentpane\\">para responder reclama&ccedil;&otilde;es de que tal Conte&uacute;do viole Direitos de terceiros; </li><li class=\\"contentpane\\">para proteger direitos, propriedades, interesses ou manter a seguran&ccedil;a do N&uacute;cleo do Evento, dos Usu&aacute;rios e do p&uacute;blico em geral. </li></ul><p class=\\"contentpane\\">O Usu&aacute;rio &eacute; o &uacute;nico respons&aacute;vel - exonerando o N&uacute;cleo do Evento e os seus patrocinadores &ndash; pelos textos e pelas suas fotos publicadas no site atrav&eacute;s de sua conta e por todo e qualquer material, atividade e/ou finalidade que tiver com os servi&ccedil;os disponibilizados pelo N&uacute;cleo do Evento. </p><h4 class=\\"contentpane\\">Conte&uacute;do Exibido pelo Usu&aacute;rio:</h4><p class=\\"contentpane\\">A seguir encontra-se uma lista de conte&uacute;dos proibidos de serem publicados pelo Usu&aacute;rio no site do N&uacute;cleo do Evento atrav&eacute;s da ferramenta &#39;Meu Site&#39;. Ao N&uacute;cleo do Evento reserva-se o direito de cancelar o servi&ccedil;o prestado ao Usu&aacute;rio infrator sem aviso pr&eacute;vio. </p><ul><li class=\\"contentpane\\">Utiliza&ccedil;&atilde;o, sem a autoriza&ccedil;&atilde;o expressa do autor ou titular dos direitos, de material protegido por direito autoral, registrado como marca comercial ou patenteado. A infra&ccedil;&atilde;o de qualquer obra protegida por direito autoral, bem como marca, patente, segredo comercial ou outra viola&ccedil;&atilde;o de propriedade intelectual que contribua, incentive ou facilite a infra&ccedil;&atilde;o. Esta proibi&ccedil;&atilde;o inclui todas as formas de divulga&ccedil;&atilde;o de pirataria de software. </li><li class=\\"contentpane\\">Divulgar material que explore a imagem de menores de 18 anos, ou que divulgue informa&ccedil;&atilde;o com identifica&ccedil;&atilde;o pessoal de menores de 18 anos. O N&uacute;cleo do Evento reserva-se o direito de informar as autoridades policiais e judiciais sobre viola&ccedil;&otilde;es desta disposi&ccedil;&atilde;o e de cooperar com elas, informando, caso solicitado, os dados cadastrais do contratante que violar as leis brasileiras, bem como dados das conex&otilde;es, como endere&ccedil;o de IP para cria&ccedil;&atilde;o e manuten&ccedil;&atilde;o do &Aacute;lbum digital. </li><li class=\\"contentpane\\">Material que na opini&atilde;o do N&uacute;cleo do Evento seja ofensivo ou lesivo &agrave; &eacute;tica, moral e bons costumes, incluindo express&otilde;es de intoler&acirc;ncia, apologias, racismo, conte&uacute;do pornogr&aacute;fico, bem como demais manifesta&ccedil;&otilde;es de &oacute;dio ou amea&ccedil;as de viol&ecirc;ncia, configuradas, ou n&atilde;o, como crimes de intoler&acirc;ncia; </li><li class=\\"contentpane\\">Divulga&ccedil;&atilde;o de material ou Websites que promovam quaisquer atividades ilegais, instiga&ccedil;&otilde;es ou divulga&ccedil;&atilde;o de instru&ccedil;&otilde;es para atividades ilegais; </li><li class=\\"contentpane\\">Divulga&ccedil;&atilde;o de material que calunie ou ameace terceiros ou que seja injurioso ou abusivo; </li><li class=\\"contentpane\\">Divulga&ccedil;&atilde;o de material que infrinja os direitos de privacidade ou de publicidade, incluindo a divulga&ccedil;&atilde;o de imagem, dados biogr&aacute;ficos ou outra informa&ccedil;&atilde;o privada sobre qualquer indiv&iacute;duo ou organiza&ccedil;&atilde;o; </li><li class=\\"contentpane\\">Divulga&ccedil;&atilde;o de programas execut&aacute;veis ou emuladores para download por meio de websites ou links; </li><li class=\\"contentpane\\">Declara&ccedil;&otilde;es falsas sobre a sua identidade ou fazer-se passar por outra pessoa, ou por membro da equipe do N&uacute;cleo do Evento. </li><li class=\\"contentpane\\">Uso do site com a finalidade de obter informa&ccedil;&atilde;o pessoal identificativa para uso ou fins ilegais; </li><li class=\\"contentpane\\">Divulga&ccedil;&atilde;o de materiais ou links a sorteio, concurso ou jogo que requera o pagamento de uma taxa para participa&ccedil;&atilde;o; </li><li class=\\"contentpane\\">Qualquer decis&atilde;o sobre a aplica&ccedil;&atilde;o destas normas ser&aacute; tomada segundo crit&eacute;rio absoluto e exclusivo do N&uacute;cleo do Evento; </li><li class=\\"contentpane\\">Decidindo o N&uacute;cleo do Evento que deve notificar &agrave;s autoridades policiais e judiciais sobre o conte&uacute;do divulgado pelo contratante, facultar&aacute; c&oacute;pia desse conte&uacute;do &agrave; autoridade correspondente sem aviso pr&eacute;vio ou consentimento do contratante. O N&uacute;cleo do Evento cooperar&aacute; com as autoridades policiais e judiciais para a localiza&ccedil;&atilde;o de contratantes que promovam conduta ilegal. </li></ul><h4 class=\\"contentpane\\">Indeniza&ccedil;&atilde;o</h4><p class=\\"contentpane\\">O Usu&aacute;rio concorda em indenizar e isentar o N&uacute;cleo do Evento e seus empregados, parceiros e clientes que exibam suas marcas em conjunto com o N&uacute;cleo do Evento, de quaisquer perdas e danos que venham a ser demandados, incluindo despesas judiciais e honor&aacute;rios advocat&iacute;cios em raz&atilde;o do Conte&uacute;do pelo Usu&aacute;rio submetido, exibido, transmitido ou tornado dispon&iacute;vel no Servi&ccedil;o, o uso pelo Usu&aacute;rio do Servi&ccedil;o, a conex&atilde;o com o Servi&ccedil;o, a viola&ccedil;&atilde;o dos Termos de Servi&ccedil;o ou a viola&ccedil;&atilde;o de qualquer Direito. </p><h4 class=\\"contentpane\\">Restri&ccedil;&otilde;es Espec&iacute;ficas para Uso Internacional</h4><p class=\\"contentpane\\">Reconhecendo o alcance mundial da Internet, o Usu&aacute;rio concorda em cumprir qualquer legisla&ccedil;&atilde;o local que disponha sobre a conduta de Usu&aacute;rios na rede e sobre Conte&uacute;dos aceit&aacute;veis. Especificamente, o Usu&aacute;rio concorda em cumprir com todas as leis aplic&aacute;veis com rela&ccedil;&atilde;o &agrave; transmiss&atilde;o de dados t&eacute;cnicos a partir do Brasil ou do pa&iacute;s no qual o Usu&aacute;rio resida. </p><h4 class=\\"contentpane\\">Proibi&ccedil;&atilde;o de Revenda do Servi&ccedil;o</h4><p class=\\"contentpane\\">O Usu&aacute;rio concorda em n&atilde;o reproduzir, duplicar, copiar, vender, revender ou explorar com finalidade comercial qualquer parte do Servi&ccedil;o, sua utiliza&ccedil;&atilde;o ou acesso. </p><h4 class=\\"contentpane\\">Modifica&ccedil;&otilde;es no Servi&ccedil;o</h4><p class=\\"contentpane\\">Ao N&uacute;cleo do Evento reserva-se o direito de, a qualquer tempo, modificar ou descontinuar, temporariamente ou permanentemente, o Servi&ccedil;o ou parte dele, com ou sem notifica&ccedil;&atilde;o. O Usu&aacute;rio concorda que o N&uacute;cleo do Evento n&atilde;o est&aacute; apto a proceder para o Usu&aacute;rio ou terceiros qualquer modifica&ccedil;&atilde;o, suspens&atilde;o ou descontinua&ccedil;&atilde;o do Servi&ccedil;o. </p><h4 class=\\"contentpane\\">T&eacute;rmino</h4><p class=\\"contentpane\\">O Usu&aacute;rio concorda que o N&uacute;cleo do Evento, &agrave; sua livre discri&ccedil;&atilde;o, poder&aacute; cancelar sua senha, sua conta ou parte dela ou a utiliza&ccedil;&atilde;o do Servi&ccedil;o e remover ou descartar qualquer Conte&uacute;do, incluindo se acreditar que o Usu&aacute;rio esteja violando ou agindo de forma contr&aacute;ria &agrave; letra e ao esp&iacute;rito dos Termos do Servi&ccedil;o. </p><p class=\\"contentpane\\">O Usu&aacute;rio concorda que o t&eacute;rmino de seu acesso ao Servi&ccedil;o, por qualquer raz&atilde;o constante deste Termos do Servi&ccedil;o, pode ocorrer sem uma notifica&ccedil;&atilde;o pr&eacute;via e reconhece e concorda que o N&uacute;cleo do Evento poder&aacute; desativar ou apagar sua conta e todas as informa&ccedil;&otilde;es e dados constantes nesta conta e/ou bloquear o acesso a tais arquivos ou ao Servi&ccedil;o. </p><h4 class=\\"contentpane\\">Negocia&ccedil;&otilde;es com Anunciantes</h4><p class=\\"contentpane\\">A correspond&ecirc;ncia, negocia&ccedil;&atilde;o ou participa&ccedil;&atilde;o do Usu&aacute;rio em promo&ccedil;&otilde;es com anunciantes, encontradas no ou divulgadas atrav&eacute;s do Servi&ccedil;o, incluindo pagamento ou entrega de bens e servi&ccedil;os, condi&ccedil;&otilde;es, garantias e apresenta&ccedil;&otilde;es associadas a tal negocia&ccedil;&atilde;o, ocorrem exclusivamente entre o Usu&aacute;rio e o anunciante. O Usu&aacute;rio concorda que o N&uacute;cleo do Evento n&atilde;o &eacute; respons&aacute;vel por qualquer perda e dano de qualquer tipo incorrida como resultado de tal negocia&ccedil;&atilde;o ou como resultado da presen&ccedil;a do anunciante no Servi&ccedil;o. </p><h4 class=\\"contentpane\\">Conex&otilde;es (&quot;Links&quot;)</h4><p class=\\"contentpane\\">O Servi&ccedil;o ou terceiros poder&atilde;o fornecer &quot;links&quot; para outros sites da World Wide Web ou outros recursos. </p><p class=\\"contentpane\\">Como o N&uacute;cleo do Evento n&atilde;o tem controle sobre tais sites ou recursos externos, o Usu&aacute;rio reconhece e concorda que o N&uacute;cleo do Evento n&atilde;o &eacute; respons&aacute;vel pela disponibilidade dos mesmos e n&atilde;o endossa ou se responsabiliza por qualquer Conte&uacute;do, propaganda, produtos, servi&ccedil;os ou outros materiais contidos ou disponibilizados atrav&eacute;s de tais sites ou recursos. O Usu&aacute;rio expressamente reconhece que o N&uacute;cleo do Evento n&atilde;o ser&aacute; respons&aacute;vel, direta ou indiretamente, por quaisquer perdas e danos que sejam efetiva ou alegadamente causados por, ou em conex&atilde;o, pela confian&ccedil;a depositada em tal Conte&uacute;do, bens e servi&ccedil;os dispon&iacute;veis no ou atrav&eacute;s de tais sites ou recursos. </p><h4 class=\\"contentpane\\">Direitos de Propriedade Intelectual do N&uacute;cleo do Evento e de Terceiros</h4><p class=\\"contentpane\\">O Usu&aacute;rio reconhece e concorda que o Conte&uacute;do inclu&iacute;do em propagandas patrocinadoras ou informa&ccedil;&otilde;es apresentadas ao Usu&aacute;rio atrav&eacute;s do Servi&ccedil;o ou anunciantes s&atilde;o protegidos por direitos autorais, marcas, patentes ou outros direitos de propriedade intelectual e outra eventual legisla&ccedil;&atilde;o aplic&aacute;vel. Salvo expressamente autorizado pelo N&uacute;cleo do Evento ou anunciantes, o Usu&aacute;rio concorda em n&atilde;o modificar, alugar, vender, distribuir ou criar obras derivadas a partir do Servi&ccedil;o, no todo ou em parte. </p><p class=\\"contentpane\\">O Usu&aacute;rio tamb&eacute;m n&atilde;o poder&aacute; acessar o Servi&ccedil;o por qualquer meio que n&atilde;o seja a interface fornecida pelo N&uacute;cleo do Evento para acessar o Servi&ccedil;o. </p><h4 class=\\"contentpane\\">Garantia Limitada</h4><p class=\\"contentpane\\">O Usu&aacute;rio expressamente concorda e est&aacute; ciente de que: </p><ul><li class=\\"contentpane\\">O Servi&ccedil;o &eacute; utilizado ao inteiro risco do Usu&aacute;rio. O Servi&ccedil;o &eacute; fornecido ao Usu&aacute;rio na forma em que est&aacute; dispon&iacute;vel. O N&uacute;cleo do Evento, em raz&atilde;o das veda&ccedil;&otilde;es indicadas acima ao Usu&aacute;rio, n&atilde;o oferece garantias outras al&eacute;m das estabelecidas nestes Termos de Servi&ccedil;o. O N&uacute;cleo do Evento reserva-se o direito de n&atilde;o prestar assist&ecirc;ncia ou suporte t&eacute;cnico aos usu&aacute;rios do servi&ccedil;o e software. </li><li><span class=\\"contentpane\\">O N&uacute;cleo do Evento n&atilde;o pode garantir que: </span><ul><li class=\\"contentpane\\">determinados servi&ccedil;os &agrave; disposi&ccedil;&atilde;o atender&atilde;o &agrave;s necessidades do Usu&aacute;rio; </li><li class=\\"contentpane\\">que o Servi&ccedil;o ser&aacute; prestado de forma ininterrupta, tempestiva, segura ou livre de erros; </li><li class=\\"contentpane\\">que o resultado obtido pelo uso do Servi&ccedil;o ser&aacute; exato ou confi&aacute;vel; </li><li class=\\"contentpane\\">que a qualidade de qualquer produto, servi&ccedil;o, informa&ccedil;&otilde;es ou outro material adquirido ou obtido pelo Usu&aacute;rio atrav&eacute;s do Servi&ccedil;o atender&aacute; &agrave;s expectativas; </li><li class=\\"contentpane\\">que quaisquer erros ser&atilde;o corrigidos. </li></ul></li><li class=\\"contentpane\\">Qualquer obten&ccedil;&atilde;o de material, por meio de download ou outra forma, durante uso do Servi&ccedil;o, &eacute; efetuada ao inteiro risco do Usu&aacute;rio e ao seu livre crit&eacute;rio, sendo o Usu&aacute;rio integralmente respons&aacute;vel por qualquer preju&iacute;zo causado ao sistema do computador pessoal ou pela perda de dados resultantes do download ou por qualquer outra forma de acesso a tais materiais. </li></ul><h4 class=\\"contentpane\\">Limita&ccedil;&atilde;o de Responsabilidade</h4><p class=\\"contentpane\\">O Usu&aacute;rio expressamente concorda e est&aacute; ciente de que o N&uacute;cleo do Evento n&atilde;o ter&aacute; qualquer responsabilidade, seja contratual ou extra-contratual, por quaisquer danos patrimoniais ou morais, incluindo, sem limita&ccedil;&atilde;o, danos por lucros cessantes, perda de fundo de com&eacute;rcio ou de informa&ccedil;&otilde;es ou outras perdas intang&iacute;veis resultantes do: </p><ul><li class=\\"contentpane\\">uso ou incapacidade de usar o Servi&ccedil;o; </li><li class=\\"contentpane\\">custo de aquisi&ccedil;&atilde;o de bens ou servi&ccedil;os outros decorrentes da compra de bens, informa&ccedil;&otilde;es e dados pelo ou atrav&eacute;s do servi&ccedil;o ou mensagens de recebimento ou transa&ccedil;&otilde;es estabelecidas no ou atrav&eacute;s do Servi&ccedil;o; </li><li class=\\"contentpane\\">acesso n&atilde;o autorizado &agrave;s transmiss&otilde;es ou informa&ccedil;&otilde;es do Usu&aacute;rio, bem como da altera&ccedil;&atilde;o destes; </li><li class=\\"contentpane\\">orienta&ccedil;&otilde;es ou condutas de terceiros sobre o Servi&ccedil;o; </li><li class=\\"contentpane\\">por motivos de for&ccedil;a maior ou caso fortuito e atos praticados pelo pr&oacute;prio Usu&aacute;rio. </li></ul><h4 class=\\"contentpane\\">Avisos</h4><p class=\\"contentpane\\">Qualquer aviso ao Usu&aacute;rio dever&aacute; ser feito atrav&eacute;s de e-mail. O Servi&ccedil;o poder&aacute;, tamb&eacute;m, fornecer avisos sobre modifica&ccedil;&otilde;es nos Termos do Servi&ccedil;o ou qualquer outra informa&ccedil;&atilde;o por meio da exibi&ccedil;&atilde;o de avisos ou links no Servi&ccedil;o ao Usu&aacute;rio. </p><h4 class=\\"contentpane\\">Disposi&ccedil;&otilde;es Gerais</h4><p class=\\"contentpane\\">Os Termos do Servi&ccedil;o constituem o acordo integral entre o Usu&aacute;rio e o N&uacute;cleo do Evento e reger&atilde;o a utiliza&ccedil;&atilde;o do Servi&ccedil;o pelo Usu&aacute;rio, substituindo qualquer acordo anterior entre o Usu&aacute;rio e o N&uacute;cleo do Evento. </p><p class=\\"contentpane\\">Os Termos do Servi&ccedil;o e o relacionamento entre o Usu&aacute;rio e o N&uacute;cleo do Evento ser&atilde;o regidos pelas leis da Rep&uacute;blica Federativa do Brasil, sem considera&ccedil;&atilde;o a qualquer disposi&ccedil;&atilde;o sobre conflito de leis. O Usu&aacute;rio e o N&uacute;cleo do Evento concordam em submeter-se &agrave; compet&ecirc;ncia &uacute;nica e exclusiva dos tribunais localizados no Brasil. </p><p class=\\"contentpane\\">O Usu&aacute;rio entende e expressamente autoriza que o N&uacute;cleo do Evento utilize recursos, tais como, mas n&atilde;o se limitando, &quot;cookies&quot;, a fim de oferecer um servi&ccedil;o melhor e mais personalizado. Para maiores informa&ccedil;&otilde;es sobre &quot;cookies&quot; ou outros recursos e sobre as condi&ccedil;&otilde;es em que o N&uacute;cleo do Evento divulgar&aacute; suas Informa&ccedil;&otilde;es de Registro, consulte a Pol&iacute;tica de Privacidade do N&uacute;cleo do Evento em: Pol&iacute;tica de Privacidade </p><p class=\\"contentpane\\">O Usu&aacute;rio tem o direito de acessar e corrigir Informa&ccedil;&otilde;es de Registro pessoais. O Usu&aacute;rio poder&aacute; obter tal acesso eletronicamente. </p><h4 class=\\"contentpane\\">Viola&ccedil;&otilde;es</h4><p><span class=\\"contentpane\\">Favor reportar qualquer viola&ccedil;&atilde;o dos Termos do Servi&ccedil;o ao Atendimento ao Cliente do N&uacute;cleo do Evento enviando um e-mail para <a href=\\"mailto:contato@nucleodoevento.com.br\\">contato@nucleodoevento.com.br</a></span> </p></div>', 'http://www.nucleodoevento.com.br', '0.00', '0.00', '1|R$ |2|,| .|2|1');

-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_vm_vendor_category`
--

CREATE TABLE IF NOT EXISTS `jos_vm_vendor_category` (
  `vendor_category_id` int(11) NOT NULL auto_increment,
  `vendor_category_name` varchar(64) default NULL,
  `vendor_category_desc` text,
  PRIMARY KEY  (`vendor_category_id`),
  KEY `idx_vendor_category_category_name` (`vendor_category_name`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='The categories that vendors are assigned to' AUTO_INCREMENT=7 ;

--
-- Extraindo dados da tabela `jos_vm_vendor_category`
--

INSERT INTO `jos_vm_vendor_category` (`vendor_category_id`, `vendor_category_name`, `vendor_category_desc`) VALUES
(6, '-default-', 'Default');

-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_vm_visit`
--

CREATE TABLE IF NOT EXISTS `jos_vm_visit` (
  `visit_id` varchar(255) NOT NULL default '',
  `affiliate_id` int(11) NOT NULL default '0',
  `pages` int(11) NOT NULL default '0',
  `entry_page` varchar(255) NOT NULL default '',
  `exit_page` varchar(255) NOT NULL default '',
  `sdate` int(11) NOT NULL default '0',
  `edate` int(11) NOT NULL default '0',
  PRIMARY KEY  (`visit_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Records the visit of an affiliate';

--
-- Extraindo dados da tabela `jos_vm_visit`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_vm_waiting_list`
--

CREATE TABLE IF NOT EXISTS `jos_vm_waiting_list` (
  `waiting_list_id` int(11) NOT NULL auto_increment,
  `product_id` int(11) NOT NULL default '0',
  `user_id` int(11) NOT NULL default '0',
  `notify_email` varchar(150) NOT NULL default '',
  `notified` enum('0','1') default '0',
  `notify_date` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`waiting_list_id`),
  KEY `product_id` (`product_id`),
  KEY `notify_email` (`notify_email`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Stores notifications, users waiting f. products out of stock' AUTO_INCREMENT=1 ;

--
-- Extraindo dados da tabela `jos_vm_waiting_list`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_vm_zone_shipping`
--

CREATE TABLE IF NOT EXISTS `jos_vm_zone_shipping` (
  `zone_id` int(11) NOT NULL auto_increment,
  `zone_name` varchar(255) default NULL,
  `zone_cost` decimal(10,2) default NULL,
  `zone_limit` decimal(10,2) default NULL,
  `zone_description` text NOT NULL,
  `zone_tax_rate` int(11) NOT NULL default '0',
  PRIMARY KEY  (`zone_id`),
  KEY `zone_id` (`zone_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='The Zones managed by the Zone Shipping Module' AUTO_INCREMENT=5 ;

--
-- Extraindo dados da tabela `jos_vm_zone_shipping`
--

INSERT INTO `jos_vm_zone_shipping` (`zone_id`, `zone_name`, `zone_cost`, `zone_limit`, `zone_description`, `zone_tax_rate`) VALUES
(1, 'Default', '6.00', '35.00', 'This is the default Shipping Zone. This is the zone information that all countries will use until you assign each individual country to a Zone.', 2),
(2, 'Zone 1', '1000.00', '10000.00', 'This is a zone example', 2),
(3, 'Zone 2', '2.00', '22.00', 'This is the second zone. You can use this for notes about this zone', 2),
(4, 'Zone 3', '11.00', '64.00', 'Another usefull thing might be details about this zone or special instructions.', 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_weblinks`
--

CREATE TABLE IF NOT EXISTS `jos_weblinks` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `catid` int(11) NOT NULL default '0',
  `sid` int(11) NOT NULL default '0',
  `title` varchar(250) NOT NULL default '',
  `url` varchar(250) NOT NULL default '',
  `description` varchar(250) NOT NULL default '',
  `date` datetime NOT NULL default '0000-00-00 00:00:00',
  `hits` int(11) NOT NULL default '0',
  `published` tinyint(1) NOT NULL default '0',
  `checked_out` int(11) NOT NULL default '0',
  `checked_out_time` datetime NOT NULL default '0000-00-00 00:00:00',
  `ordering` int(11) NOT NULL default '0',
  `archived` tinyint(1) NOT NULL default '0',
  `approved` tinyint(1) NOT NULL default '1',
  `params` text NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `catid` (`catid`,`published`,`archived`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Extraindo dados da tabela `jos_weblinks`
--

INSERT INTO `jos_weblinks` (`id`, `catid`, `sid`, `title`, `url`, `description`, `date`, `hits`, `published`, `checked_out`, `checked_out_time`, `ordering`, `archived`, `approved`, `params`) VALUES
(1, 2, 0, 'Joomla!', 'http://www.joomla.org', 'Home of Joomla!', '2005-02-14 15:19:02', 3, 1, 0, '0000-00-00 00:00:00', 1, 0, 1, 'target=0'),
(2, 2, 0, 'php.net', 'http://www.php.net', 'The language that Joomla! is developed in', '2004-07-07 11:33:24', 2, 1, 0, '0000-00-00 00:00:00', 3, 0, 1, ''),
(3, 2, 0, 'MySQL', 'http://www.mysql.com', 'The database that Joomla! uses', '2004-07-07 10:18:31', 1, 1, 0, '0000-00-00 00:00:00', 5, 0, 1, ''),
(4, 2, 0, 'OpenSourceMatters', 'http://www.opensourcematters.org', 'Home of OSM', '2005-02-14 15:19:02', 3, 1, 0, '0000-00-00 00:00:00', 1, 0, 1, 'target=0'),
(5, 2, 0, 'Joomla! - Forums', 'http://forum.joomla.org', 'Joomla! Forums', '2005-02-14 15:19:02', 4, 1, 0, '0000-00-00 00:00:00', 1, 0, 1, 'target=0'),
(6, 2, 0, 'Case Bem', 'http://www.casebem.com.br', 'b al ljçfd asljf lçadkj fçlkdsaj fçlsdaj fçlk jaçf djaçlkfdj açlkfj dçaljf dlçka jfçlkdaj fçlkd jaçfl jdsaçlf dkjsa fçdljsa', '2007-07-19 13:20:06', 1, 1, 0, '0000-00-00 00:00:00', 0, 0, 1, '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

<?php
/**
 * SEF module for Joomla! - URL caching system
 *  
 *
 * @author      $Author: shumisha $
 * @copyright   Yannick Gaultier - 2007
 * @package     sh404SEF
 * 
 * {shSourceVersionTag: V 1.2.4.q - 2007-06-10}  
 */

// Security check to ensure this file is being included by a parent file.
if (!defined('_VALID_MOS')) die('Direct Access to this location is not allowed.');

// shumisha 2007-03-13 added URL and iso code caching

if (!function_exists('shGetIsoCodeFromName')){ // V 1.2.4.m missing '' around function name
// shumisha utility function to obtain iso code from language name
function shGetIsoCodeFromName($langName) {
  global $database, $shIsoCodeCache, $mosConfig_locale, $mosConfig_lang;
  // V 1.2.4.h was failing if Joomfish is not installed : #__languages does not exist !! 
  if (empty( $shIsoCodeCache)) {
    // V 1.2.4.q protect against non-joomfish install
    if (!empty($GLOBALS['mosConfig_mbf_content'])) {
      $query = "SELECT iso, code FROM #__languages WHERE 1";
      $database->setQuery($query);
      $rows = $database->loadObjectList();
      foreach ($rows as $row) {
        $shIsoCodeCache[$row->code] = $row->iso;
      }
    } else { // no joomfish, so it has to be default language
      $shTemp = explode( '_', $mosConfig_locale);
      $langName = $mosConfig_lang;
      $shIsoCodeCache[$mosConfig_lang] = $shTemp[0] ? $shTemp[0] : 'en';  
    }
  }
  return empty($shIsoCodeCache[$langName]) ? 'en' : $shIsoCodeCache[$langName];
}
}

if (!function_exists('shGetNameFromIsoCode')){ // V 1.2.4.q 
// shumisha utility function to obtain language name from iso code
function shGetNameFromIsoCode($langCode) {
  global $database, $shLangNameCache, $mosConfig_lang, $shLangNameCache;
  // V 1.2.4.h was failing if Joomfish is not installed : #__languages does not exist !! 
  if (empty( $shLangNameCache)) {
    // V 1.2.4.q protect against non-joomfish install
    if (!empty($GLOBALS['mosConfig_mbf_content'])) {
      $query = "SELECT iso, code FROM #__languages WHERE 1";
      $database->setQuery($query);
      $rows = $database->loadObjectList();
      foreach ($rows as $row) {
        $shLangNameCache[$row->iso] = $row->code;
      }
      return empty($shLangNameCache[$langCode]) ? $mosConfig_lang : $shLangNameCache[$langCode];
    } else { // no joomfish, so it has to be default language
      return $mosConfig_lang;  
    }
  } else return empty($shLangNameCache[$langCode]) ? $mosConfig_lang : $shLangNameCache[$langCode];
}
}

global $sefConfig;

// URL Cache management

global $shIsoCodeCache,
       $shLangNameCache;
global $shURLDiskCache,
       $shURLMemCache, 
       $shDiskCacheLoaded,
       $shURLCacheFileName,
       $shURLTotalCount;

$shIsoCodeCache = null;
$shLangNameCache = null;
$shURLCache = null;
$shURLMemCache = null;
$shDiskCacheLoaded = false;
$shURLCacheFileName = $mosConfig_absolute_path.'/components/com_sef/cache/shCacheContent.php';
$shURLTotalCount = 0;  // v 1.2.4.c added total cache size control

if (!empty($sefConfig->shUseURLCache)) 
  register_shutdown_function('shWriteURLCacheToDisk');

function sh_var_export( $cache, $start) {
  // export content of array $cache, inserting a numeric key starting at $start
  if (!count( $cache)) return '';
  $ret = '';
  foreach ($cache as $cacheItem) {
    $ret .= "\n".'$shURLDiskCache['.$start.'][\'nonSefURL\']=\''.$cacheItem['nonSefURL'].'\';';
    $ret .= "\n".'$shURLDiskCache['.$start++.'][\'sefURL\']=\''.$cacheItem['sefURL'].'\';';
  }
  return $ret; 
}

function shWriteURLCacheToDisk() {
  global $shURLDiskCache, $shURLMemCache, $shURLCacheFileName;
  
  if (!count($shURLMemCache)) return; // nothing to do, no new URL to write to disk
  if (!file_exists($shURLCacheFileName))
    $cache = '<?php // shCache : URL cache file for sh404SEF
if (!defined(\'_VALID_MOS\')) die(\'Direct Access to this location is not allowed.\');';
  else 
    $cache = '<?php';
  $count = count( $shURLDiskCache);
  $cache .= sh_var_export( $shURLMemCache, $count); // only need to write memory cache, ie: those URL added since last read of cache from disk
  $cache .= "\n".'?'.'>';
  $cacheFile=fopen( $shURLCacheFileName,'ab');
  if ($cacheFile) {
    fwrite( $cacheFile, $cache);
    fclose( $cacheFile);
  }  
}

// fetch an URL from cache, return null if not found
function shGetSefURLFromCache($string) {
  global $sefConfig, $shURLDiskCache, $shURLMemCache, $shDiskCacheLoaded, $iso_client_lang;
  
  if (!$sefConfig->shUseURLCache) return null;
  if (!$shDiskCacheLoaded){ // cache not setup yet, load it up from disk to memory
    shLoadURLCache();  
    $shDiskCacheLoaded = true;
  }  
  if (empty($shURLDiskCache) && empty($shURLMemCache)) return null;
  if (!empty($shURLDiskCache)) 
    foreach ($shURLDiskCache as $cacheItem) {
      if ($cacheItem['nonSefURL'] == $string) {
        //echo 'DiskCacheHit = '.$string.'<br />';
        return $cacheItem['sefURL'];
      }  
    } 
  if (!empty($shURLMemCache))  
    foreach ($shURLMemCache as $cacheItem) {
      if ($cacheItem['nonSefURL'] == $string) {
      //echo 'MemCacheHit = '.$string.'<br />';
        return $cacheItem['sefURL'];
      }  
    } 
  return null;
}

// fetch an URL from cache, return null if not found
function shGetNonSefURLFromCache($string) {
  global $sefConfig, $shURLDiskCache, $shURLMemCache,
         $shDiskCacheLoaded;  // V 1.2.4.m $shDiskCacheLoaded was not declared as global
  
  if (!$sefConfig->shUseURLCache) return null;
  if (!$shDiskCacheLoaded){ // cache not setup yet, load it up from disk to memory
    shLoadURLCache();  
    $shDiskCacheLoaded = true;
  }
  if (empty($shURLDiskCache) && empty($shURLMemCache)) return null; 
  if (!empty($shURLDiskCache))
    foreach ($shURLDiskCache as $cacheItem) {
      if ($cacheItem['sefURL'] == $string) {
        return $cacheItem['nonSefURL'];
      }  
    } 
  if (!empty($shURLMemCache))  
    foreach ($shURLMemCache as $cacheItem) {
      if ($cacheItem['sefURL'] == $string) {
        return $cacheItem['nonSefURL'];
      }  
    }   
  return null;
}

function shAddSefURLToCache( $nonSefURL, $sefURL) {
  global $sefConfig, $shURLMemCache, $shURLTotalCount;
  if (!$sefConfig->shUseURLCache) return null;
  if ($shURLTotalCount >= $sefConfig->shMaxURLInCache) return null;  // v 1.2.4.c added total cache size control
  // Filter out non sef url which include &mosmsg, as I don't want to have a cache entry for every single msg
  // that can be thrown at me, including every 404 error
  if (strpos(strtolower($nonSefURL), '&mosmsg')) return null;
  $count = count($shURLMemCache);
  $shURLMemCache[$count]['nonSefURL'] = $nonSefURL;
  $shURLMemCache[$count]['sefURL'] = $sefURL;
  $shURLTotalCount++;  // v 1.2.4.c added total cache size control
  return true;
}

function shRemoveURLFromCache( $nonSefURLList) {
  global $sefConfig, $shURLMemCache, $shURLDiskCache, $shURLTotalCount, $mosConfig_absolute_path;
  
  if (!$sefConfig->shUseURLCache || empty($nonSefURLList)) return null;
  $foundInDiskCache = false;
  $foundInMemCache = false;
  foreach ($nonSefURLList as $nonSefURL) {
    if (!empty($shURLMemCache)) { 
      while (list( $id, $cacheItem) = each ($shURLMemCache)) { // look up in memory cache
        if ($cacheItem['nonSefURL'] == $nonSefURL) {
          $shURLMemCache[$id] = array();
          $shURLTotalCount--; 
          $foundInMemCache = true;
        }
      } 
    }    
    if (!empty($shURLDiskCache)) { 
      while (list( $id, $cacheItem) = each ($shURLDiskCache)) {  // look up disk cache
        if ($cacheItem['nonSefURL'] == $nonSefURL) {
          unset($shURLDiskCache[$id]);
          $shURLTotalCount--;
          $foundInDiskCache = true;
        }
      }  
    }  
  } 
  if ($foundInMemCache) {
    $shURLMemCache = array_values($shURLMemCache); // simply reindex mem cache
    return;
  }
  if ($foundInDiskCache) { // we need to remove these url from the disk cache file
    // to make it simpler, I simply rewrite the complete file
    $shURLMemCache = (empty($shURLMemCache) ? 
                     array_values($shURLDiskCache)
                    :array_merge($shURLDiskCache, $shURLMemCache));
    $shURLDiskCache = array();  // don't need disk cache anymore, as all URL are in mem cache
    // so we remove both on disk cache and in memory copy of on disk cache
    if (file_exists($mosConfig_absolute_path.'/components/com_sef/cache/shCacheContent.php'))
      unlink($mosConfig_absolute_path.'/components/com_sef/cache/shCacheContent.php');
    // no need to write new URL list in disk file, as this will be done automatically at shutdown  
  }  
}

// load cached URL from disk into an array in memory
// array format : $shURLCache[nonSefURL] = SefURL
// disk file format : simple text file : first line is nonSefURL, next is SefURL, then repeat
// each new set of nonSef/Sef is appended to file
function shLoadURLCache() {
  global $shURLDiskCache, $shURLCacheFileName, $shURLTotalCount;
  if (file_exists( $shURLCacheFileName)) {
    unset($shUrlDiskCache); // version 1.2.4c : clear shURLDiskCache, before loading new version, just in case
    include($shURLCacheFileName);
  } else unset($shUrlDiskCache);  // version 1.2.4c : unset instead of just setting it to null
  $shURLTotalCount = count($shURLDiskCache);
}

?>

<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
if (!defined('DOKU_AUTOLOAD')) define('DOKU_AUTOLOAD', 'doku');
if (!defined('DOKU_PATH')) define('DOKU_PATH', realpath('./plugins/doku'));

/**
 * checks wether doku plugin has registerd autoload
 * @return type 
 */
function is_autoload_registered()
{
    return (spl_autoload_functions() !== false && in_array(DOKU_AUTOLOAD, spl_autoload_functions()));
}

/**
 * autoload for doku plugin
 * only takes care of Classes which are in package Class_Doku or Interface
 * @param string $className 
 */
function doku_autoload($className)
{
    if (false !== strpos($className, 'Class_Doku') 
        || false !== strpos($className, 'Interface')
    ) {
        include_once(DOKU_PATH . '/' . str_replace('_', '/', $className) . '.php');
    }
}

/**
 * checks wether Class_Doku has been defined
 * @return boolean 
 */
function doku_configured()
{
    return defined('DOKU_CONFIGURED');
}

/**
 * extracts bb dokutags from text
 * @param string $text
 * @return array
 */
function extractLanguageAndFunction($text)
{
    $tags = array();
    preg_match_all('/\[doku\]([a-zA-Z0-9_-]+)\[\/doku\]/', $text, $matchedTags,PREG_SET_ORDER);
    return $matchedTags;
    
}

if (!is_autoload_registered('doku_autoload')) {
    spl_autoload_register ('doku_autoload');
}

if (!doku_configured()) {
    $configFile = DOKU_PATH . '/config.ini';
    if (file_exists($configFile)) {
        $config = parse_ini_file($configFile, true);
        Class_Doku::setConfig($config);
        define('DOKU_CONFIGURED', 1);
    }
}
$doku = Class_Doku::getDoku('php');
$runtimeCache = array();
foreach (extractLanguageAndFunction($parsedtext) as $tag)
{
    $function = $tag[1];
    $match = $tag[0];
    if (!in_array($function, $runtimeCache)) {
//        $this->tag_list['no_options'][$function]['html'] = $doku->getFunctionDocumentation($function);
        echo $doku->getFunctionDocumentation($function);
        str_replace($match, '['.$function.']'.$function.'[/'.$function.']', $parsedtext);
        $runtimeCache[] = $function;
    }
}




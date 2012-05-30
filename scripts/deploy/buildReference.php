<?php
/**
 * This file builds a php-function-reference in json-format
 * 
 * @author Johannes Brinksmeier <johannes.brinksmeier@googlemail.com>
 */
error_reporting(E_ALL);
define('DIR_ROOT', dirname(dirname(dirname(__FILE__))));
set_include_path(implode(PATH_SEPARATOR, array(
    dirname(dirname(dirname(__FILE__))) . '/library'
)));
function build_autoload($class) {
    $file = str_replace('_', '/', $class) . '.php';
    include $file;
}
spl_autoload_register('build_autoload');
$referencePath = 'references/externals/php';
$refDir = new JB_Dir($referencePath);
$functions = array();
foreach ($refDir->ls()->getSubdirs() as $packageDir) {
    $subs = $packageDir->ls();
    foreach ($subs->getSubDirs() as $dir) {
        if ($dir->getName() == 'functions') {
            foreach ($dir->ls()->getFiles() as $functionFile) {
                $functionXML = simplexml_load_string(
                    str_replace('&', '', file_get_contents(DIR_ROOT . '/' . $functionFile->getPathName())));
                $functions[(string)$functionXML->refnamediv->refname] = array(
                    'name'  => (string)$functionXML->refnamediv->refname,
                    'desc'  => (string)$functionXML->refnamediv->refpurpose
                );
            }
        }
    }
}


file_put_contents(dirname(dirname(dirname(__FILE__))) . '/php-ref.json', json_encode($functions));
<?php
define('BASE_DIR', dirname(__FILE__) . '/..');
set_include_path(implode(PATH_SEPARATOR, array(
    BASE_DIR,
    get_include_path()
)));
function doku_autoload($class)
{
    $class = str_replace('_', '/', $class);
    $file = $class . '.php';
    $found = false;
    $paths = explode(PATH_SEPARATOR, get_include_path());
    foreach ($paths as $path) {
        if (file_exists($path .'/'. $file)) {
            $found = true;
        }
    }
    if ($found) {
        include_once $file;
        return true;
    }
    return false;
}
spl_autoload_register('doku_autoload');
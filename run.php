<?php
/**
 * Testfile
 * @author Johannes Brinksmeier <johannes.rsl@googlemail.com>
 */
//set_include_path(implode(PATH_SEPARATOR, array(
//    dirname(__FILE__),
//     get_include_path()
//)));
define('DOKU_PATH', dirname(__FILE__));
$parsedtext = '[doku]array_key_exists[/doku]';
try {
    include './doku.php';
} catch (Class_Doku_Exception $e) {
    echo $e->getMessage();
}

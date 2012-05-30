<?php

/**
 * Expression filename is undefined on line 3, column 6 in Templates/Scripting/PHPClass.php.
 * 
 * @category    Doku
 * @package     PHP
 * @subpackage  Source
 * @author      jojo <johannes.rsl@googlemail.com>
 * @copyright   Copyrights are evil
 * @since       23.01.2011
 * @version     $Id: $
 * 
 */

/**
 * Adapter for Doku_Php building descriptions for php-functions using
 * Reflection API
 *
 * @author      jojo <johannes.rsl@googlemail.com>
 */
class Class_Doku_Php_Source_Reflection implements Interface_Source
{
    /**
     * return description object for $function
     * @param   string  $function 
     * @return  Class_Doku_Pph_Description_ReflectionFunction
     * @todo implement error-handling on non-existent functions
     */
    public function getFunctionDescription($function) 
    {
        $description = new Class_Doku_Php_Description_ReflectionFunction();
        $reflectedFuntion = new ReflectionFunction($function);
        $description->setFunction($reflectedFuntion);
        return $description;
    }
}


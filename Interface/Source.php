<?php

/**
 * Expression filename is undefined on line 3, column 6 in Templates/Scripting/PHPInterface.php.
 * 
 * @category    Doku
 * @package     Interface
 * @author      jojo <johannes.rsl@googlemail.com>
 * @copyright   Copyrights are evil
 * @since       23.01.2011
 * @version     $Id: $
 * 
 */

/**
 * Description of Source
 *
 * @author      jojo <johannes.rsl@googlemail.com>
 */
interface Interface_Source 
{
    /**
     * builds description object for $function
     * 
     * @param   string  $function
     * @return  Interface_Description
     */
    public function getFunctionDescription($function);
}

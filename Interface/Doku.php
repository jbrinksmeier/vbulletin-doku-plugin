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
 * Defines a Doku-object
 *
 * @author      jojo <johannes.rsl@googlemail.com>
 */
interface Interface_Doku 
{
  /**
   * returns a description object for a function
   * @param   string  $functionName
   * @return  Doku_Description_Function
   */
  public function getFunctionDocumentation($functionName);
  
  /**
   * setSource
   * 
   * @param Interface_Source $source
   * @return void
   */
  public function setSource(Interface_Source $src);
}

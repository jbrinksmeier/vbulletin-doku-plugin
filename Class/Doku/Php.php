<?php

/**
 * Expression filename is undefined on line 3, column 6 in Templates/Scripting/PHPClass.php.
 * 
 * @category    Doku
 * @package     Class
 * @subpackage  Doku
 * @author      jojo <johannes.rsl@googlemail.com>
 * @copyright   Copyrights are evil
 * @since       23.01.2011
 * @version     $Id: $
 * 
 */

/**
 * Implementation of Interface_Doku for the php language
 *
 * @author      jojo <johannes.rsl@googlemail.com>
 */
class Class_Doku_Php implements Interface_Doku 
{
    /**
     * source to fetch information about a function
     * @var Interface_Source
     */
    protected $source = null;

    /**
     * returns description for function $functionName
     *  
     * @param string $functionName 
     * 
     */
    public function getFunctionDocumentation($functionName) 
    {
        if (null === $this->source) {
            throw new Class_Doku_Exception('No source adapter set!');
        }
        return $this->source->getFunctionDescription($functionName);
    }
    
    /**
     * setSource
     * @param Interface_Source $src 
     * @return void
     */
    public function setSource(Interface_Source $src)
    {
        $this->source = $src;
    }
    
    /**
     * getSource
     * @return Interface_Source
     */
    public function getSource()
    {
        return $this->source;
    }
}


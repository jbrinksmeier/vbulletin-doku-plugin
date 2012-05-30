<?php

/**
 * Expression filename is undefined on line 3, column 6 in Templates/Scripting/PHPClass.php.
 * 
 * @category    Doku
 * @package     PHP
 * @subpackage  Description
 * @author      jojo <johannes.rsl@googlemail.com>
 * @copyright   Copyright is evil
 * @since       23.01.2011
 * @version     $Id: $
 * 
 */
/**
 * Description implementation for a php ReflectionFunction
 *
 * @author      jojo <johannes.rsl@googlemail.com>
 */
class Class_Doku_Php_Description_ReflectionFunction implements Interface_Description
{
    /**
     * function to render
     * @var ReflectionFunction 
     */
    protected $function = null;

    /**
     * setFunction
     * @param   ReflectionFunction $function 
     * @return  void
     */
    public function setFunction(ReflectionFunction $function)
    {
        $this->function = $function;
    }
    
    /**
     * getFunction
     * @return ReflectionFunction|null
     */
    public function getFunction()
    {
        return $this->function;
    }
    
    /**
     * render a reflection function
     * @return string
     */
    public function __toString() 
    {
        $s = '';
        if (null !== $this->function) {
            $s = (string) $this->function;
        }
        return $s;
    }
}


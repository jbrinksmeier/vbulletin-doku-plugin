<?php
/**
 * JsonFunction.php
 *
 * @catgory
 * @author      Johannes Brinksmeier<johannes.brinksmeier@googlemail.com>
 * @version     $Id $
 */
/**
 *
 *
 * @package
 * @subpackage
 */
class Class_Doku_Php_Description_JsonFunction implements Interface_Description
{

    /**
     * @var stdClass
     */
    protected $_function;

    /**
     * @return string
     */
    function __toString()
    {
        return $this->_function->name . PHP_EOL
            . $this->_function->desc . PHP_EOL;
    }

    /**
     * @param \stdClass $function
     * @return Class_Doku_Php_Description_JsonFunction
     */
    public function setFunction($function)
    {
        $this->_function = $function;
        return $this;
    }
}

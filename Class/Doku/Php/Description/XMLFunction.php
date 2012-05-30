<?php
/**
 * Enter description here ...
 * @author j.brinksmeier
 *
 */
class Class_Doku_Php_Description_XMLFunction implements Interface_Description
{
    /**
     * function to render
     * @var SimpleXMLElement
     */
    protected $function = null;
    
    /* (non-PHPdoc)
     * @see Interface/Interface_Description::__toString()
     */
    public function __toString()
    {
        if (null !== $this->function) {
            $s = $this->getName() . PHP_EOL;
            $s .= $this->getPurpose() . PHP_EOL;
            return $s;
        }
        return '';
    }
    
    /**
     * set xml-function to render
     * @param SimpleXMLElement $function
     * @return Class_Doku_Php_Description_XMLFunction
     */
    public function setFunction(SimpleXMLElement $function)
    {
        $this->function = $function;
        return $this;
    }
    
    /**
     * extract name of function
     * @return string 
     */
    protected function getName()
    {
        return $this->function->refnamediv->refname;
    }
    
    /**
     * return description of functions purpose
     * @return string
     */
    protected function getPurpose()
    {
        return $this->function->refnamediv->refpurpose;
    }
}
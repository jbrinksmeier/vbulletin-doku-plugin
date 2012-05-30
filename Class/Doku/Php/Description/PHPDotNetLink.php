<?php
class Class_Doku_Php_Description_PHPDotNetLink
    implements Interface_Description
{
    /**
     * function to render
     * @var string
     */
    protected $function = null;

    /**
     * set function to render
     * @param string $function
     * @return Class_Doku_Php_Description_PHPDotNetLink
     */
    public function setFunction($function)
    {
        $this->function = (string)$function;
        return $this;
    }
    
    /* (non-PHPdoc)
     * @see Interface/Interface_Description::__toString()
     */
    public function __toString()
    {
        if (null !== $this->function) {
            return '<a href="http://php.net/'
                   . Class_Doku_Php_Source_PHPDotNet::parseFunctionName(
                        $this->function)
                   . '">' . $this->function
                   . '</a>';
        }
        return '';
    }
}
<?php
class Class_Doku_Php_Source_PHPDotNet implements Interface_Source
{
    /**
     * path to xml-reference-files
     * @var string
     */
    const REFERENCE_PATH = 'references/php';
    
    /**
     * array with function-descriptions
     * @var array 
     */
    protected $_doku = array();
    
    /* (non-PHPdoc)
     * @see Interface/Interface_Source::getFunctionDescription()
     */
    public function getFunctionDescription($function)
    {
        $parsedFunction = self::parseFunctionName($function);
        try {
            $functionDescription = 
                new Class_Doku_Php_Description_JsonFunction();
            return $functionDescription->setFunction(
                $this->_getXml($package, $parsedFunction)
            );
        } catch (Class_Doku_Exception $e) {
            $functionDescription = 
                new Class_Doku_Php_Description_PHPDotNetLink();
            return $functionDescription->setFunction($function);
        }
    }
    
    /**
     * parse functioname to php.net format
     * @param string $function
     * @return string
     */
    public static function parseFunctionName($function)
    {
        return str_replace('_', '-', (string)$function);
    }
    
    /**
     * searchs for $function in json-doku
     * @param string $function 
     * @return stdClass 
     */
    protected function _search($function)
    {
    
    }
    
    protected function _getDoku()
    {
        
    }
}
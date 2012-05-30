<?php
class Class_Doku_Php_Source_PHPDotNet implements Interface_Source
{
    /**
     * path to json-reference
     * @var string
     */
    const DEFAULT_REFERENCE_PATH = 'php-ref.json';

    /**
     * reference-file
     * @var string
     */
    protected $_referenceFile;

    /**
     * function list
     * @var array
     */
    protected $_functions = array();

    /** (non-PHPdoc)
     * @see Interface/Interface_Source::getFunctionDescription()
     */
    public function getFunctionDescription($function)
    {
        $parsedFunction = self::parseFunctionName($function);
        try {
            $functionDescription = 
                new Class_Doku_Php_Description_JsonFunction();
            return $functionDescription->setFunction(
                $this->_search($parsedFunction)
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
        return str_replace('-', '_', (string)$function);
    }
    
    /**
     * searchs for $function in json-doku
     * @param string $function 
     * @return stdClass
     * @throws Class_Doku_Exception if function not found
     */
    protected function _search($function)
    {
        if (empty($this->_functions)) {
            $this->_loadFunctions();
        }
        if (isset($this->_functions->$function)) {
            return $this->_functions->$function;
        }
        throw new Class_Doku_Exception('Function ' . $function . ' not found');
    }

    /**
     * load json-string into function list
     */
    protected function _loadFunctions()
    {
        $this->_functions = json_decode(
            file_get_contents($this->getReferenceFile()));
    }

    /**
     * @param string $referenceFile
     * @return Class_Doku_Php_Source_PHPDotNet
     */
    public function setReferenceFile($referenceFile)
    {
        $this->_referenceFile = $referenceFile;
        return $this;
    }

    /**
     * @return string
     */
    public function getReferenceFile()
    {
        if (null === $this->_referenceFile) {
            $this->setReferenceFile(self::DEFAULT_REFERENCE_PATH);
        }
        return $this->_referenceFile;
    }
}
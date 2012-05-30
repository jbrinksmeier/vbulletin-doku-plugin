<?php

/**
 * File for class Doku
 * 
 * @category    Doku
 * @package     Class
 * @author      jojo <johannes.rsl@googlemail.com>
 * @copyright   Copyrights are evil
 * @since       23.01.2011
 * @version     $Id: $
 * 
 */

/**
 * This class is the accesspoint for fetching adapters to different languages.
 * it loads and configures them from config
 *
 * @author      jojo <johannes.rsl@googlemail.com>
 */
class Class_Doku 
{

    /**
     * prefix for concrete doku-classes
     * @var string
     */
    const DOKU_CLASSPREFIX = 'Class_Doku_';
    
    /**
     * instance
     * @var Class_Doku
     */
    protected static $instance = null;
    /**
     * configuration array
     * @var array
     */
    protected $config = array();

    /**
     * cache for already loaded doku-classes
     * @var array 
     */
    protected static $dokuCache = array();
    
    /**
     * getInstance
     * 
     * @return Class_Doku
     */
    public static function getInstance() 
    {
        if (null === self::$instance) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    /**
     * sets configuration
     * @param array $config 
     * @return void
     * 
     */
    public static function setConfig(array $config) 
    {
        $doku = self::getInstance();
        $doku->setConfiguration($config);
    }

    /**
     * get Adapter for $language
     * 
     * @param   string $language 
     * @return  Interface_Doku
     * @throws Class_Doku_Exception for errors loading Doku-class and dependers
     */
    public static function getDoku($language) 
    {
        $self = self::getInstance();
        $config = $self->getConfiguration();
        if (isset($config[$language])) {
            if (isset(self::$dokuCache[$language])) {
                return self::$dokuCache[$language];
            }
            $sourceAdapterClass = $config[$language]['sourceadapter'];
            if (!class_exists($sourceAdapterClass)) {
                throw new Class_Doku_Exception('unable to load SourceAdapter '.$sourceAdapterClass);
            }
            $sourceAdapter = new $sourceAdapterClass;
            $dokuClass = self::DOKU_CLASSPREFIX . ucfirst($language);
            if (!class_exists($dokuClass)) {
                throw new Class_Doku_Exception('Unable to load Doku-class for '.$language);
            }
            $doku = new $dokuClass;
            $doku->setSource($sourceAdapter);
            self::$dokuCache[$language] = $doku;
            return $doku;
        }
        throw new Class_Doku_Exception('Language '.$language.' is not supported');
    }

    /**
     * returns wether instance is configured 
     * 
     * @return boolean
     */
    public static function unconfigured() 
    {
        return self::getConfig() == array();
    }

    /**
     * getConfig
     * @return array 
     */
    public static function getConfig() 
    {
        $doku = self::getInstance();
        return $doku->getConfiguration();
    }

    public static function reset() 
    {
        self::$instance = null;
        self::$dokuCache = array();
    }

    /**
     * the real configuration setter
     * @param array $config
     * @return void 
     */
    public function setConfiguration(array $config) 
    {
        $this->config = $config;
        $this->_validateConfig();
    }

    /**
     * the real config getter
     * @return array
     */
    public function getConfiguration() 
    {
        return $this->config;
    }

    /**
     * validates current configuration.
     * If configuration found invalid, its reset to default 
     * 
     * @return void
     * @throws Class_Doku_Exception on invalid configuration
     */
    protected function _validateConfig() 
    {
        foreach ($this->config as $language) {
            if (!is_array($language) || !isset($language['sourceadapter'])) {
                $this->config = array();
                throw new Class_Doku_Exception('Configuration incomplete for ' . (isset($language['name'])) ? $language['name']: 'unknown');
            }
        }
    }

}


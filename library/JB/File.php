<?php
/** represents a file 
 * @author jojo
 *
 */
class JB_File
{    
    /**
     * parent directory
     * @var JB_Dir
     */
    protected $_dir;
    
    /**
     * filename
     * @var string
     */
    protected $_name;

    /**
     * standard constructor
     *
     * @param JB_Dir $dir parent directory
     * @param string $name full name
     * @return void
     */
    public function __construct(JB_Dir $dir, $name)
    {
        $this->_dir = $dir;
        $this->_name = $name;
    }
    
    /** magic get
     * @param $var
     * @return mixed
     */
    public function __get($var)
    {
        //all properties are protected
        $prop = "_" . $var;
        if (property_exists($this, $prop)) {
            return $this->$prop;
        }
        return null;
    }

    /**
     * returns full name of file
     * beginning from specified root
     * @return string full filename
     */
    public function getPathname()
    {
        return $this->_dir->getPathname() . JB_Dir::DIR_SEPARATOR . $this->_name;
    }
    
    /**
     * returns file-extension
     * @return string file-extension
     */
    public function getExtension()
    {
        return substr($this->_name, strrpos($this->_name, ".")+1);
    }
}
<?php
/**
 * Dir
 * class represanting a folder in filesystem
 * provides read-access to files and subfolders
 * @author jojo
 *
 */
class JB_Dir
{
    /**
     * Directory is uninitialized
     */
    const DIR_BLANK = 0;
    
    /**
     * Director did a scan of
     * to be represented filesystem-folder
     *
     */
    const DIR_SCANNED = 1;

    /**
     * file-separator
     * 
     */
    const DIR_SEPARATOR = "/";
    
    /**
     * indicating state of directory
     * @var int
     */
    protected $_state = JB_Dir::DIR_BLANK;
    
    /**
     * the rootdirectory in filesystem
     * from that on dirs are read
     * @var string
     */
    protected $_root = "/";
    /**
     * parent directory
     * @var JB_Dir
     */
    protected $_parent;
    
    /**
     * array with subdirectories
     * subdirectories are uninitialized, i.e. did not scan themself
     * @var array<Dir>
     */
    protected $_subdirs = array();
    
    /** name of directory
     * @var string
     */
    protected $_name;

    /** array with files
     * @var array<Dir_File>
     */
    protected $_files = array();

    /**
     * constructor
     *
     * @param string $path path to dir
     * @param JB_Dir $parent the parent-directory if any
     * @param string root the root directory of package
     * @throws JB_DirNotReadableException if dir is not readable
     * @throws JB_DirOutOfScopeException if dir is above root-folder
     * @return void
     */
    public function __construct($path, JB_Dir $parent=null, $root=null)
    {
       if (!$root && defined("DIR_ROOT")) {
           $this->_root = realpath(DIR_ROOT);
       } elseif ($root) {
           $this->_root = realpath($root);
       }
       if (!is_dir($this->_root . JB_Dir::DIR_SEPARATOR . $path)) {
           throw new JB_DirNotReadableException($this->_root . JB_Dir::DIR_SEPARATOR . $path . " does not exist!");
       }

       $this->_parent = $parent;
       if (empty($path)) {
           $path = "/";
       }
       $this->_name = realpath($this->_root . JB_Dir::DIR_SEPARATOR . $path);
       if (strpos($this->_name, $this->_root) === FALSE) {
           throw new JB_DirOutOfScopeException($this->_name . " is not within the root-directory specified: " . $this->_root);
       }
       
    }

    /**
     * returns the root-directory this package is working on
     * @return string root-folder
     */
    public function getRoot()
    {
        return $this->_root;
    }

    /**
     * returns all subdirs
     * @return array<Dir>
     */
    public function getSubdirs()
    {
        return $this->_subdirs;
    }

    /**
     * returns all files
     * @return array<Dir_File>
     */
    public function getFiles()
    {
        return $this->_files;
    }
    
    /**
     * returns dirname with full path
     * beginning from root
     * @return string
     */
    public function getPathname()
    {
        return substr($this->_name, strrpos($this->_name, $this->_root . JB_Dir::DIR_SEPARATOR)+strlen($this->_root)+1);
    }
    
    /**
     * returns dirname without path
     * @return string
     */
    public function getName()
    {
        return ($this->_name === $this->_root) ? "" : substr($this->_name, strrpos($this->_name, "/")+1);
    }

    /**
     * returns parent-directory
     * watch its state!
     * @return JB_Dir the parent dir
     */
    public function dirUp()
    {
        return $this->_parent;    
    }
    
    /**
     * loads this dir, subdirs(without files and non-recursive)
     * and this dir's files
     * 
     * @todo implement recursion
     *
     * @param $rec boolean  wether to load all subdirs recursivly,
     *                      i.e. calling ls on them !NOT IMPLEMENTED YET!
     * @return JB_Dir
     */
    public function ls($rec=false)
    {
        try {
            $it = new DirectoryIterator($this->_name);
            foreach ($it as $node) {
                $name = $node->getFilename();
                if (!$node->isDot() && $name[0] != ".") {
                    if ($node->isDir()
                        && 
                        !array_key_exists($name, $this->_subdirs)
                    ) {
                        $this->_subdirs[$name]
                            = new JB_Dir($this->getPathname() . JB_Dir::DIR_SEPARATOR . $name, $this, $this->_root);
                    }
                    if ($node->isFile()
                        && 
                        !array_key_exists($name, $this->_files)
                    ) {
                        $this->_files[$name] = new JB_File($this, $name);
                    }
                }
            }
            $this->_state = JB_Dir::DIR_SCANNED;
        } catch (Exception $e) {
            $this->_state = JB_Dir::DIR_BLANK;
            throw $e;
        }
        return $this;
    }

    /**
     * indicates dir's state
     * @return boolean
     */
    public function isReady()
    {
        return (bool)$this->_state;
    }

}
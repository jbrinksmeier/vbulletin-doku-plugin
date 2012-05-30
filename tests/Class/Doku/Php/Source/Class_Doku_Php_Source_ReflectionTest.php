<?php


require_once dirname(__FILE__) . '/../../../../../Class/Doku/Php/Source/Reflection.php';

/**
 * Test class for Class_Doku_Php_Source_Reflection.
 * Generated by PHPUnit on 2011-01-23 at 23:54:04.
 */
class Class_Doku_Php_Source_ReflectionTest extends PHPUnit_Framework_TestCase {

    /**
     * @var Class_Doku_Php_Source_Reflection
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp() {
        $this->object = new Class_Doku_Php_Source_Reflection;
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown() {
        
    }

    /**
     * test getFunctionDescription().
     */
    public function testGetFunctionDescription() 
    {
        $descr = $this->object->getFunctionDescription('in_array');
        $this->assertInstanceOf('Interface_Description', $descr);
        $this->assertInstanceOf('Class_Doku_Php_Description_ReflectionFunction', $descr);
        $this->assertEquals(new ReflectionFunction('in_array'), $descr->getFunction());
    }
    
    /**
     * @expectedException ReflectionException
     */
    public function testGetFunctionDescriptionFunctionDoesNotExist()
    {
        $this->object->getFunctionDescription('invalid_function');
    }

}

?>

<?php

namespace Feedtailor\Mocking\Tests;

use Feedtailor\Mocking\MethodInvoker;

class ExampleClass
{
    public function add1($a = 1, $b = 2)
    {
        return $this->add2($a, $b);
    }

    protected function add2($a = 3, $b = 4)
    {
        return $this->add3($a, $b);
    }

    private function add3($a = 5 , $b = 6)
    {
        return $a + $b;
    }
}

class PropertyModifierTest extends \PHPUnit_Framework_TestCase
{
    protected function setUp()
    {
        parent::setUp();
    }

    protected function tearDown()
    {
        parent::tearDown();
    }


    /**
     * @test
     */
    public function invokePublicMethod()
    {
        $obj = new ExampleClass();

        $this->assertEquals(3,  MethodInvoker::create($obj)->invoke("add1"));
        $this->assertEquals(12, MethodInvoker::create($obj)->invoke("add1", array(10)));
        $this->assertEquals(30, MethodInvoker::create($obj)->invoke("add1", array(10, 20)));
    }

    /**
     * @test
     */
    public function invokeProtectedMethod()
    {
        $obj = new ExampleClass();

        $this->assertEquals(7,  MethodInvoker::create($obj)->invoke("add2"));
        $this->assertEquals(14, MethodInvoker::create($obj)->invoke("add2", array(10)));
        $this->assertEquals(30, MethodInvoker::create($obj)->invoke("add2", array(10, 20)));
    }

    /**
     * @test
     */
    public function invokePrivateMethod()
    {
        $obj = new ExampleClass();

        $this->assertEquals(11, MethodInvoker::create($obj)->invoke("add3"));
        $this->assertEquals(16, MethodInvoker::create($obj)->invoke("add3", array(10)));
        $this->assertEquals(30, MethodInvoker::create($obj)->invoke("add3", array(10, 20)));
    }
}

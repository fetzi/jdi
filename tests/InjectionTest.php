<?php
require_once "bootstrap.php";

/**
 * @backupGlobals disabled
 */
class InjectionTest extends PHPUnit_Framework_TestCase {

    public function setUp() {
        $container = new \Jopic\DI\Container();

        $container->register("foo", function() {
            return Phockito::mock('Jopic\SampleService');
        });

        $container->register("foo3", function() {
            return Phockito::mock('Jopic\SampleService');
        });

        $di = \Jopic\DI\DependencyInjection::getInstance();
        $di->setContainer($container);
    }

    public function testInjectionForCorrectSampleClass() {
        $container = \Jopic\DI\DependencyInjection::getInstance()->getContainer();
        $foo = $container->foo;
        $foo3 = $container->foo3;

        $sampleClass = new Jopic\Tests\Samples\CorrectSampleClass();

        $this->assertEquals(get_class($foo), get_class($sampleClass->getFoo()));
        $this->assertEquals(get_class($foo3), get_class($sampleClass->getFoo3()));
    }

    /**
     * @expectedException Jopic\DI\Exception\ContainerException
     */
    public function testInjectionForIncorrectSampleClass() {
        $sampleClass = new Jopic\Tests\Samples\IncorrectSampleClass();
    }
}
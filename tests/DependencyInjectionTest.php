<?php

/**
 * @backupGlobals disabled
 */
class DependencyInjectionTest extends PHPUnit_Framework_TestCase {

    public function setUp() {
        $container = new \Jopic\DI\Container();

        $container->register("foo", function() {
            return "foo";
        });

        $container->register("foo2", function() {
            return "foo2";
        });

        $container->register("foo3", function() {
            return "foo3";
        });

        $di = \Jopic\DI\DependencyInjection::getInstance();
        $di->setContainer($container);
    }

    /**
     * @expectedException Jopic\DI\Exception\ContainerException
     */
    public function testAccessToContainerWithoutContainerSet() {

        $di = \Jopic\DI\DependencyInjection::getInstance();
        $di->setContainer(null);

        $di->getContainer();
    }

    public function testAccessToContainerSucceeds() {
        $container = new \Jopic\DI\Container();

        $di = \Jopic\DI\DependencyInjection::getInstance();
        $di->setContainer($container);

        $this->assertEquals($container, $di->getContainer());
    }

    public function testAccessToExistingContainerElement() {
        $container = \Jopic\DI\DependencyInjection::getInstance()->getContainer();

        $foo = "foo";
        $foo2 = "foo2";
        $foo3 = "foo3";

        $this->assertEquals($foo, $container->foo);
        $this->assertEquals($foo, $container->get("foo"));

        $this->assertEquals($foo2, $container->foo2);
        $this->assertEquals($foo2, $container->get("foo2"));

        $this->assertEquals($foo3, $container->foo3);
        $this->assertEquals($foo3, $container->get("foo3"));
    }

    /**
     * @expectedException Jopic\DI\Exception\ContainerException
     */
    public function testAccessToNonExistingContainerElement() {
        $container = \Jopic\DI\DependencyInjection::getInstance()->getContainer();
        $container->foo4;
    }
}
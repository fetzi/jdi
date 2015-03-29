<?php

use Jopic\DI;

/**
 * @backupGlobals disabled
 */
class JDITest extends PHPUnit_Framework_TestCase {

    public function setUp() {
        DI\JDI::reset();
    }

    public function testSetContainerAddsContainerToStaticStore() {
        DI\JDI::setContainer("foo", null);

        $this->assertEquals(1, DI\JDI::getContainerCount());
    }

    public function testGetContainerReturnsTheStoredContainer() {
        DI\JDI::setContainer("foo", "bar");

        $container = DI\JDI::getContainer("foo");

        $this->assertEquals("bar", $container);
    }

    /**
     * @expectedException Jopic\DI\Exception\ContainerException
     */
    public function testGetContainerWithNonExistingContainerThrowsException() {
        DI\JDI::getContainer("notexisting");
    }
}
<?php

namespace Jopic\DI;

use Jopic\DI\Exception\ContainerException;

/**
 * Class Jdi
 * @package Jopic\DI
 */
class JDI {
    
    private static $containers = array();

    /**
     * reset the list of stored containers
     */
    public static function reset() {
        self::$containers = array();
    }

    /**
     * method for retreiving a stored container from the static store
     *
     * @throws ContainerException if the container with the given name does not exist
     */
    public static function getContainer($containerName) {
        if(array_key_exists($containerName, self::$containers)) {
            return self::$containers[$containerName];
        }
        
        throw new ContainerException("the container with the name $containerName could not be found.");
    }

    /**
     * method for storing a container in the static store
     */
    public static function setContainer($containerName, $container) {
        self::$containers[$containerName] = $container;
    }

    /**
     * method for querying the number of available containers
     */
    public static function getContainerCount() {
        return count(self::$containers);
    }
}
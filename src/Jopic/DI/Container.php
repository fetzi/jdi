<?php
namespace Jopic\DI;

use Jopic\DI\Exception\ContainerException;

/**
 * Class Container
 * @package Jopic\DI
 */
class Container {
	
	private $container = array();

	public function __construct() { }

	/**
	 * method for registering objects for dependency injection
	 *
	 * @param $name the name of the injectable object
	 * @param $function the closure that is called on injection
	 * @throws ContainerException throws the exception if the given function parameter is no closure
	 */
	public function register($name, $function) {
		if(!$this->isClosure($function)) {
			throw new ContainerException("Unable to register $name. Needs to be a closure.");
		}

		$this->container[$name] = $function;
	}

	/**
	 * returns the result of the closure function stored with the given object name
	 *
	 * @param $name the object name
	 * @return mixed result of closure function call
	 * @throws ContainerException throws an exception if there is no object with the given name registered in the container
	 */
	public function get($name) {
		if(!array_key_exists($name, $this->container)) {
			throw new ContainerException("Unable to find Injector for $name!");
		}

		return $this->container[$name]();
	}

	/**
	 * magic get implementation
	 *
	 * @see get
	 */
	public function __get($name) {
		return $this->get($name);
	}

	/**
	 * method checks if given parameter is a closure function
	 *
	 * @param $function potential closure parameter
	 * @return bool true if the given parameter is a closure
	 */
	private function isClosure($function) {
		return is_object($function) && ($function instanceof \Closure);
	}
}
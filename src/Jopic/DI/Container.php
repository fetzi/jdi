<?php
namespace Jopic\DI;

use Jopic\DI\Exception\ContainerException;

class Container {
	
	private $container = array();

	public function __construct() { }

	public function register($name, $function) {
		if(!$this->isClosure($function)) {
			throw new ContainerException("Unable to register $name. Needs to be a closure.");
		}

		$this->container[$name] = $function;
	}

	public function get($name) {
		if(!array_key_exists($name, $this->container)) {
			throw new ContainerException("Unable to find Injector for $name!");
		}

		return $this->container[$name]();
	}

	public function __get($name) {
		return $this->get($name);
	}

	private function isClosure($function) {
		return is_object($function) && ($function instanceof \Closure);
	}
}
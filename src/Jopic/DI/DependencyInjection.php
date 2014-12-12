<?php
namespace Jopic\DI;

use Jopic\DI\Exception\ContainerException;

class DependencyInjection {
	
	private static $instance;

	private $container;

	static public function getInstance() {
		if(self::$instance == null) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	private function __construct() {

	}

	public function setContainer($container) {
		$this->container = $container;
	}

	public function getContainer() {
		if($this->container == null) {
			throw new ContainerException("Unable to initialize Dependency Injection. Container needs to be set up!");
		}

		return $this->container;
	}
}
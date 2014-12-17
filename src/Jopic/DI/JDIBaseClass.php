<?php
namespace Jopic\DI;

/**
 * Class JDIBaseClass
 * @package Jopic\DI
 */
abstract class JDIBaseClass {

	private $injectionProxy = array();

    /**
     * @param $class handle to the real implementation class
     */
    public function __construct($class) {
        $this->readProperties($class);
    }

    /**
     * method that checks all class properties for the annotation @Inject
     * and if this annotation is present it injects the variable from the DI container
     *
     * @param $class handle to subclass
     * @throws Exception\ContainerException throws the exception if the DI container was not initialized
     * or the inject property is not avaiable in the container
     */
    private function readProperties($class) {
		$container = DependencyInjection::getInstance()->getContainer();
        $reflectionClass = new \ReflectionClass($class);

        foreach($reflectionClass->getProperties() as $property) {
			$name = $property->getName();
            $docComment = $property->getDocComment();

            if(preg_match("/(\\s*)\\*(\\s*)@inject\\n/", $docComment)) {
                $obj = $container->get($property->getName());

                if($property->isPrivate() || $property->isProtected()) {
                    $property->setAccessible(true);
                }

				if($property->isPrivate()) {
					$property->setValue($class, $obj);
				}
                else {
					$this->injectionProxy[$name] = $container->getClosure($name);
					unset($class->$name);
				}

            }
        }
    }

	/**
	 * magic function for value retreival of lazyly injected properties
	 *
	 * @param $name property name
	 * @return mixed property value
	 */
	public function __get($name) {
		$this->$name =  $this->injectionProxy[$name]();
		unset($this->injectionProxy[$name]);

		if(count($this->injectionProxy) == 0) {
			unset($this->injectionProxy);
		}

		return $this->$name;
	}
}
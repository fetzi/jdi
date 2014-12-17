<?php
namespace Jopic;

class SampleClass extends DI\JDIBaseClass {

    /**
	 * this property gets injected directly
     * @inject
     */
    private $foo;

	/**
	 * this property gets injected lazyly -> the real value is loaded on first property use
	 * @inject
	 */
	protected $foo2;

	public function __construct() {
        //this call is important for dependency injection
        parent::__construct($this);
    }

	public function getFoo2() {
		return $this->foo2;
	}
}
<?php
namespace Jopic;

class SampleClass extends DI\JDIBaseClass {

    /**
     * @inject
     */
    private $foo;

    public function __construct() {
        //this call is important for dependency injection
        parent::__construct($this);
    }
}
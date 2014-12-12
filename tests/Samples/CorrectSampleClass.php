<?php
namespace Jopic\Tests\Samples;

class CorrectSampleClass extends \Jopic\DI\JDIBaseClass {

    /**
     * @inject
     */
    private $foo;

    private $foo2;

    /**
     * @inject
     */
    protected $foo3;

    public function __construct() {
        parent::__construct($this);
    }

    public function getFoo() {
        return $this->foo;
    }

    public function getFoo3() {
        return $this->foo3;
    }
}
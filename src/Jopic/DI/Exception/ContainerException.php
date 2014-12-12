<?php
namespace Jopic\DI\Exception;

class ContainerException extends \Exception {

    public function __construct($message) {
        parent::__construct($message);
    }
}
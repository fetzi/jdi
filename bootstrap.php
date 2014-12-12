<?php
include "vendor/autoload.php";

$container = new \Jopic\DI\Container();

$container->register("foo", function() {
    return new \Jopic\SampleService();
});

$di = \Jopic\DI\DependencyInjection::getInstance();
$di->setContainer($container);
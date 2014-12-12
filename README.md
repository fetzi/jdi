# JDI - Jopic Dependency Injection

This repository provides a very basic and easy to use dependency injection "framework" for PHP.

## Installation
You basically need to add my github repository to the "repositories" section of your `composer.json` file.
<pre><code>{
"type": "vcs",
"url": "https://github.com/fetzi/jdi"
}</code></pre>

Now you can add <code>"jopic/jdi": "*"</code> to your <code>require</code> section of your `composer.json` file.

## Usage - Container Setup

At first you have to set up your dependency container:

<pre><code>$container = new Jopic\DI\Container();</code></pre>

Then you can set this container as the active container for dependency injection by:

<pre><code>\Jopic\DI\DependencyInjection::getInstance()->setContainer($container);</code></pre>

## Usage - Container Object registration
To be able to inject objects to class fields the dependency injection container needs to know about injectable objects. Therefore you register them on the container by calling the `register` method.
<pre><code>
$container->register("foo", function() {
    return new DummyObject();
});</code></pre>

**Please note:** it is important to register a closure function (needed for object instantiation).

## Usage - Object Injection
Basically the only 3 things you need to do are:

1. extend the abstract `JDIBaseClass`
2. call `parent::__construct($this);` in your class constructor
3. annotate inject fields of your class with `@inject`

Here is a short example of a Injectable class:
<pre><code>class SampleClass extends Jopic\DI\JDIBaseClass {
    /**
     * @inject
     */
    private $foo;
    
    public function __construct() {
        parent::__construct($this);
    }
}</code></pre>

This code assures that if a object with the name "foo" is registered in the dependency injection container it will be available in this class instances automatically.

## Further Development
I'm currently working on an easy way for injecting properties and will also provide information about property handling.

## Request for comment
If you find any bugs or if you find something (or everything ;-) ) inconvenient please don't hesitate to contact me either directly via github or via e-mail (admin [at] jopic.at).

## Build Status
[![Build Status](https://travis-ci.org/fetzi/jdi.svg?branch=master)](https://travis-ci.org/fetzi/jdi)

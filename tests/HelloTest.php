<?php

class HelloTest extends PHPUnit_Framework_TestCase {

    public function testHello()
    {
        $hello_world = 'hello world';
        $this->assertEquals('hello world', $hello_world);
    }
}
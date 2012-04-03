<?php

class HelloTest extends PHPUnit_Framework_TestCase {

    public function testHello()
    {
        $hello = 'hello world';
        $this->assertEquals('hello world', $hello);
    }
}
<?php

class HelloTest extends PHPUnit_Framework_TestCase {

    public function testHello()
    {
        $hello = 'hello';
        $this->assertEquals('hello world', $hello);
    }
}
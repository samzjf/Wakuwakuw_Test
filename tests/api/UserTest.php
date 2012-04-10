<?php

class Tests_Api_User extends Wakuwakuw_TestCase {

    public function test_browse_1()
	{
		$res = Request::factory('api/user', 'GET')->authenticated()->execute()->response;

		$this->assertNotEmpty($res);
	}
	
	public function test_read_1()
	{
		$res = Request::factory('api/user/1', 'GET')->authenticated()->execute()->response;
		
		//$this->assertTrue(Arr::get($res, 'success'));
		$this->assertNotEmpty($res);
	}
}
<?php

use PHPUnit\Framework\TestCase;
include schedule.js;

class scheduleTest extends TestCase
{
	$expected = schedule::convertStdToMili('1:00pm');
	public function testConvertStdToMili() 
	{
		
		$this->assertEquals(
			1300,
			$expected
		);	
	}
}
?>



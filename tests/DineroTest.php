<?php

namespace LasseRafn\Dinero\Tests;

use LasseRafn\Dinero\Dinero;

class DineroTest extends TestCase
{
	/** @test */
	public function can_set_auth_info() {
		$dinero = new Dinero('clientId', 'clientSecret');

		$this->assertEquals(null, $dinero->getAuthToken());
		$this->assertEquals(null, $dinero->getOrgId());

		$dinero->setAuth('foo', 'bar');

		$this->assertSame('foo', $dinero->getAuthToken());
		$this->assertSame('bar', $dinero->getOrgId());
	}
}

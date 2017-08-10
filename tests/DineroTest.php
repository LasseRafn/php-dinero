<?php

namespace LasseRafn\Dinero\Tests;

use LasseRafn\Dinero\Dinero;
use LasseRafn\Dinero\Requests\ContactRequestBuilder;
use LasseRafn\Dinero\Requests\CreditnoteRequestBuilder;
use LasseRafn\Dinero\Requests\InvoiceRequestBuilder;
use LasseRafn\Dinero\Requests\ProductRequestBuilder;

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

	/** @test */
	public function can_return_builders() {
		$dinero = new Dinero('clientId', 'clientSecret');

		$this->assertSame(ContactRequestBuilder::class, get_class($dinero->contacts()));
		$this->assertSame(InvoiceRequestBuilder::class, get_class($dinero->invoices()));
		$this->assertSame(CreditnoteRequestBuilder::class, get_class($dinero->creditnotes()));
		$this->assertSame(ProductRequestBuilder::class, get_class($dinero->products()));
	}
}

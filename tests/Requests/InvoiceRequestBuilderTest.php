<?php

namespace LasseRafn\Dinero\Tests\Requests;

use LasseRafn\Dinero\Builders\InvoiceBuilder;
use LasseRafn\Dinero\Requests\InvoiceRequestBuilder;
use LasseRafn\Dinero\Tests\TestCase;
use LasseRafn\Dinero\Utils\Request;

class InvoiceRequestBuilderTest extends TestCase
{
	/** @var  InvoiceRequestBuilder() */
	private $requestBuilder;

	public function setUp()
	{
		$this->requestBuilder =  new InvoiceRequestBuilder(new InvoiceBuilder(new Request()));

		parent::setUp();
	}

	/** @test */
	public function can_filter_from() {
		$this->assertArrayNotHasKey('startDate', $this->requestBuilder->getParameters());

		$this->requestBuilder->from(new \DateTime('2017-01-01'));

		$this->assertArrayHasKey('startDate', $this->requestBuilder->getParameters());
	}

	/** @test */
	public function can_filter_to() {
		$this->assertArrayNotHasKey('endDate', $this->requestBuilder->getParameters());

		$this->requestBuilder->to(new \DateTime('2017-01-01'));

		$this->assertArrayHasKey('endDate', $this->requestBuilder->getParameters());
	}

	/** @test */
	public function can_filter_only_paid() {
		$this->assertArrayNotHasKey('statusFilter', $this->requestBuilder->getParameters());

		$this->requestBuilder->onlyPaid();

		$this->assertArrayHasKey('statusFilter', $this->requestBuilder->getParameters());
		$this->assertSame('Paid', $this->requestBuilder->getParameters()['statusFilter']);
	}

	/** @test */
	public function can_filter_only_overdue() {
		$this->assertArrayNotHasKey('statusFilter', $this->requestBuilder->getParameters());

		$this->requestBuilder->onlyOverdue();

		$this->assertArrayHasKey('statusFilter', $this->requestBuilder->getParameters());
		$this->assertSame('Overdue', $this->requestBuilder->getParameters()['statusFilter']);
	}

	/** @test */
	public function can_filter_only_overpaid() {
		$this->assertArrayNotHasKey('statusFilter', $this->requestBuilder->getParameters());

		$this->requestBuilder->onlyOverPaid();

		$this->assertArrayHasKey('statusFilter', $this->requestBuilder->getParameters());
		$this->assertSame('OverPaid', $this->requestBuilder->getParameters()['statusFilter']);
	}

	/** @test */
	public function can_filter_free_text_search() {
		$this->assertArrayNotHasKey('freeTextSearch', $this->requestBuilder->getParameters());

		$this->requestBuilder->search('hello-foo-bar');

		$this->assertArrayHasKey('freeTextSearch', $this->requestBuilder->getParameters());
	}

	/** @test */
	public function can_sort_by_voucher_number() {
		$this->assertArrayNotHasKey('sort', $this->requestBuilder->getParameters());

		$this->requestBuilder->sortByVoucherNumber();

		$this->assertArrayHasKey('sort', $this->requestBuilder->getParameters());
		$this->assertSame('VoucherNumber', $this->requestBuilder->getParameters()['sort']);
	}

	/** @test */
	public function can_sort_by_voucher_date() {
		$this->assertArrayNotHasKey('sort', $this->requestBuilder->getParameters());

		$this->requestBuilder->sortByVoucherDate();

		$this->assertArrayHasKey('sort', $this->requestBuilder->getParameters());
		$this->assertSame('VoucherDate', $this->requestBuilder->getParameters()['sort']);
	}

	/** @test */
	public function can_sort_by_status() {
		$this->assertArrayNotHasKey('sort', $this->requestBuilder->getParameters());

		$this->requestBuilder->sortByStatus();

		$this->assertArrayHasKey('sort', $this->requestBuilder->getParameters());
		$this->assertSame('Status', $this->requestBuilder->getParameters()['sort']);
	}

	/** @test */
	public function can_sort_descending() {
		$this->assertArrayNotHasKey('sortOrder', $this->requestBuilder->getParameters());

		$this->requestBuilder->sortDescending();

		$this->assertArrayHasKey('sortOrder', $this->requestBuilder->getParameters());
		$this->assertSame('descending', $this->requestBuilder->getParameters()['sortOrder']);
	}

	/** @test */
	public function can_sort_ascending() {
		$this->assertArrayNotHasKey('sortOrder', $this->requestBuilder->getParameters());

		$this->requestBuilder->sortAscending();

		$this->assertArrayHasKey('sortOrder', $this->requestBuilder->getParameters());
		$this->assertSame('ascending', $this->requestBuilder->getParameters()['sortOrder']);
	}
}

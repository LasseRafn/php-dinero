<?php

namespace LasseRafn\Dinero\Tests\Requests;

use LasseRafn\Dinero\Builders\ProductBuilder;
use LasseRafn\Dinero\Requests\ProductRequestBuilder;
use LasseRafn\Dinero\Tests\TestCase;
use LasseRafn\Dinero\Utils\Request;

class ProductRequestBuilderTest extends TestCase
{
    /** @var ProductRequestBuilder() */
    private $requestBuilder;

    public function setUp()
    {
        $this->requestBuilder = new ProductRequestBuilder(new ProductBuilder(new Request()));

        parent::setUp();
    }

    /** @test */
    public function can_filter_free_text_search()
    {
        $this->assertArrayNotHasKey('freeTextSearch', $this->requestBuilder->getParameters());

        $this->requestBuilder->search('hello-foo-bar');

        $this->assertArrayHasKey('freeTextSearch', $this->requestBuilder->getParameters());
    }
}

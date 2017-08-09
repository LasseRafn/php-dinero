<?php

namespace LasseRafn\Dinero\Tests\Utils;

use LasseRafn\Dinero\Tests\TestCase;
use LasseRafn\Dinero\Utils\Request;

class RequestTest extends TestCase
{
    /** @test */
    public function can_get_auth_url()
    {
        $request = new Request();

        $this->assertSame('https://authz.dinero.dk/dineroapi/oauth/token', $request->getAuthUrl());
    }

    /** @test */
    public function can_set_token_and_the_headers_will_be_changed_accordingly()
    {
        $request = new Request();

        $this->assertSame('Basic ' . base64_encode(':'), $request->curl->getConfig('headers')['Authorization']);
        $this->assertSame('application/x-www-form-urlencoded', $request->curl->getConfig('headers')['Content-Type']);

        $request = new Request('', '', '123', 123);

        $this->assertSame('Bearer 123', $request->curl->getConfig('headers')['Authorization']);
        $this->assertSame('application/json', $request->curl->getConfig('headers')['Content-Type']);
    }
}

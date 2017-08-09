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
}

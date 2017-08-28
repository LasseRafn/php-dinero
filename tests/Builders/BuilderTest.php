<?php

namespace LasseRafn\Dinero\Tests\Builders;

use LasseRafn\Dinero\Builders\ContactBuilder;
use LasseRafn\Dinero\Tests\TestCase;
use LasseRafn\Dinero\Utils\Request;

class BuilderTest extends TestCase
{
    /** @test */
    public function can_get_entity()
    {
        $builder = new ContactBuilder(new Request());

        $this->assertSame('contacts', $builder->getEntity());
    }
}

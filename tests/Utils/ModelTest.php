<?php

namespace LasseRafn\Dinero\Tests\Utils;

use LasseRafn\Dinero\Tests\TestCase;
use LasseRafn\Dinero\Utils\Model;
use LasseRafn\Dinero\Utils\Request;

class ModelTest extends TestCase
{
	/** @test */
	public function to_array_returns_an_array_of_public_attributes()
	{
		$model = new Model( new Request(), [ 'id' => 1, 'foo' => 'bar' ] );

		$attributes = $model->toArray();

		$this->assertArrayHasKey('id', $attributes);
		$this->assertArrayHasKey('foo', $attributes);
		$this->assertSame('bar', $attributes['foo']);
		$this->assertSame(1, $attributes['id']);
	}

	/** @test */
	public function can_return_a_json_string_if_echoed_out()
	{
		$model = new Model( new Request(), [ 'id' => 1, 'foo' => 'bar' ] );

		$this->assertSame('{"id":1,"foo":"bar"}', (string) $model);
	}
}

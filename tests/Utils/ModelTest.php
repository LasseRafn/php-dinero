<?php

namespace LasseRafn\Dinero\Tests\Utils;

use LasseRafn\Dinero\Tests\TestCase;
use LasseRafn\Dinero\Utils\Model;
use LasseRafn\Dinero\Utils\Request;

class ModelTest extends TestCase
{
	/** @var Model */
	public $model;

	public function setUp()
	{
		$this->model = new Model( new Request(), [ 'id' => 1, 'foo' => 'bar' ] );

		parent::setUp();
	}

	/** @test */
	public function to_array_returns_an_array_of_public_attributes()
	{
		$attributes = $this->model->toArray();

		$this->assertArrayHasKey('id', $attributes);
		$this->assertArrayHasKey('foo', $attributes);
		$this->assertSame('bar', $attributes['foo']);
		$this->assertSame(1, $attributes['id']);
	}
}

<?php namespace LasseRafn\Dinero\Builders;

use LasseRafn\Dinero\Models\Product;

class ProductBuilder extends Builder
{
	protected $entity = 'products';
	protected $model = Product::class;
}
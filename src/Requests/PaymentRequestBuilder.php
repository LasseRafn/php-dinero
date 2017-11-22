<?php namespace LasseRafn\Dinero\Requests;

use LasseRafn\Dinero\Builders\Builder;
use LasseRafn\Dinero\Utils\RequestBuilder;

class PaymentRequestBuilder extends RequestBuilder
{
	public function __construct( Builder $builder )
	{
		$this->parameters['fields'] = '';

		parent::__construct( $builder );
	}
}
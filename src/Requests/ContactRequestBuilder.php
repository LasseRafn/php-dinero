<?php namespace LasseRafn\Dinero\Requests;

use LasseRafn\Dinero\Builders\Builder;
use LasseRafn\Dinero\Utils\RequestBuilder;

class ContactRequestBuilder extends RequestBuilder
{
	public function __construct( Builder $builder )
	{
		$this->parameters['fields'] = 'Name,ContactGuid,Email,IsPerson';

		parent::__construct( $builder );
	}
}
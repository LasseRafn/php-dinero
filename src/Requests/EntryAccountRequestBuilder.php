<?php

namespace LasseRafn\Dinero\Requests;

use LasseRafn\Dinero\Builders\Builder;
use LasseRafn\Dinero\Utils\RequestBuilder;

class EntryAccountRequestBuilder extends RequestBuilder
{
	public function __construct( Builder $builder ) {
		$this->parameters['fields'] = 'Name,AccountNumber,VatCode,Category,IsHidden,IsDefaultSalesAccount';

		parent::__construct( $builder );
	}
}

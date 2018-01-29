<?php namespace LasseRafn\Dinero\Requests;

use LasseRafn\Dinero\Builders\Builder;
use LasseRafn\Dinero\Utils\RequestBuilder;

class PaymentRequestBuilder extends RequestBuilder
{
	public function __construct( Builder $builder )
	{
		$this->parameters['fields'] = 'Guid,DepositAccountNumber,ExternalReference,PaymentDate,Description,Amount,AmountInForeignCurrency';

		parent::__construct( $builder );
	}
}
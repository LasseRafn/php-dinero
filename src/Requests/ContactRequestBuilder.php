<?php

namespace LasseRafn\Dinero\Requests;

use LasseRafn\Dinero\Builders\Builder;
use LasseRafn\Dinero\Utils\RequestBuilder;

class ContactRequestBuilder extends RequestBuilder
{
	public function __construct( Builder $builder ) {
		$this->parameters['fields'] = 'ContactGuid,CreatedAt,UpdatedAt,DeletedAt,IsDebitor,IsCreditor,ExternalReference,Name,Street,ZipCode,City,CountryKey,Phone,Email,Webpage,AttPerson,VatNumber,EanNumber,PaymentConditionType,PaymentConditionNumberOfDays,IsPerson';

		parent::__construct( $builder );
	}
}
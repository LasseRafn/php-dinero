<?php

namespace LasseRafn\Dinero\Requests;

use LasseRafn\Dinero\Builders\Builder;
use LasseRafn\Dinero\Utils\RequestBuilder;

class ProductRequestBuilder extends RequestBuilder
{
    public function __construct(Builder $builder)
    {
        $this->parameters['fields'] = 'Name,ProductGuid,Quantity,Unit';

        parent::__construct($builder);
    }

	/**
	 * Free-text search.
	 *
	 * @param $query
	 *
	 * @return $this
	 */
    public function search($query)
    {
        $this->parameters['freeTextSearch'] = $query;

        return $this;
    }
}

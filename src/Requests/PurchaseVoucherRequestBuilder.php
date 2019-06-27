<?php

namespace LasseRafn\Dinero\Requests;

use LasseRafn\Dinero\Builders\Builder;
use LasseRafn\Dinero\Utils\RequestBuilder;

class PurchaseVoucherRequestBuilder extends RequestBuilder
{
    public function __construct(Builder $builder)
    {
        $this->parameters['fields'] = 'Number,Guid,ContactGuid,VoucherDate,PaymentDate,Status,Timestamp,VoucherNumber,FileGuid,RegionKey,$DepositAccountNumber,ExternalReference';

        parent::__construct($builder);
    }
}

<?php

namespace LasseRafn\Dinero\Requests;

use LasseRafn\Dinero\Builders\Builder;
use LasseRafn\Dinero\Utils\RequestBuilder;

class CreditnoteRequestBuilder extends RequestBuilder
{
    public function __construct(Builder $builder)
    {
        $this->parameters['fields'] = 'Number,Guid,ContactName,Date,PaymentDate,DeletedAt,UpdatedAt,CreatedAt,Description,TotalInclVatInDkk,TotalInclVat,TotalExclVat,TotalExclVatInDkk,Currency,Status,Type,MailOutStatus';

        parent::__construct($builder);
    }

    public function from(\DateTime $startDate)
    {
        $this->parameters['startDate'] = $startDate->format($this->dateFormat);

        return $this;
    }

    public function to(\DateTime $endDate)
    {
        $this->parameters['endDate'] = $endDate->format($this->dateFormat);

        return $this;
    }

    public function search($query)
    {
        $this->parameters['freeTextSearch'] = $query;

        return $this;
    }

    public function sortByVoucherNumber()
    {
        return $this->sortBy('VoucherNumber');
    }

    public function sortByVoucherDate()
    {
        return $this->sortBy('VoucherDate');
    }

    public function sortByStatus()
    {
        return $this->sortBy('Status');
    }

    public function sortBy($value)
    {
        $this->parameters['sort'] = $value;

        return $this;
    }

    public function sortDescending()
    {
        $this->parameters['sortOrder'] = 'descending';

        return $this;
    }

    public function sortAscending()
    {
        $this->parameters['sortOrder'] = 'ascending';

        return $this;
    }
}

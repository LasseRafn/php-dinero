<?php

namespace LasseRafn\Dinero\Builders;

use LasseRafn\Dinero\Models\Invoice;

class InvoiceBuilder extends Builder
{
    protected $entity = 'invoices';
    protected $model = Invoice::class;
}

<?php

namespace LasseRafn\Dinero\Builders;

use LasseRafn\Dinero\Models\Creditnote;

class CreditnoteBuilder extends Builder
{
    protected $entity = 'sales/creditnotes';
    protected $model = Creditnote::class;
}

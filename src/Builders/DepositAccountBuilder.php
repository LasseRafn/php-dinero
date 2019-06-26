<?php

namespace LasseRafn\Dinero\Builders;

use LasseRafn\Dinero\Models\Contact;
use LasseRafn\Dinero\Models\DepositAccount;
use LasseRafn\Dinero\Models\EntryAccount;

class DepositAccountBuilder extends Builder
{
    protected $entity = 'accounts/deposit';
    protected $model = DepositAccount::class;
}

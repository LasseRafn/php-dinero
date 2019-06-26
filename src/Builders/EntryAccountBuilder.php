<?php

namespace LasseRafn\Dinero\Builders;

use LasseRafn\Dinero\Models\Contact;
use LasseRafn\Dinero\Models\EntryAccount;

class EntryAccountBuilder extends Builder
{
    protected $entity = 'accounts/entry';
    protected $model = EntryAccount::class;
}

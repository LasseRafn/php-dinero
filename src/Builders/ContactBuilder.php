<?php

namespace LasseRafn\Dinero\Builders;

use LasseRafn\Dinero\Models\Contact;

class ContactBuilder extends Builder
{
    protected $entity = 'contacts';
    protected $model = Contact::class;
}

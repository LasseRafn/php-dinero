<?php

namespace LasseRafn\Dinero\Models;

use LasseRafn\Dinero\Utils\Model;

class EntryAccount extends Model
{
    protected $entity = 'accounts/entry';
    protected $primaryKey = 'AccountNumber';

    public $AccountNumber;
    public $Name;
    public $VatCode;
    public $Category;
    public $IsHidden;
    public $IsDefaultSalesAccount;
}

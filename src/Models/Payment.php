<?php namespace LasseRafn\Dinero\Models;

use LasseRafn\Dinero\Utils\Model;

class Payment extends Model
{
    protected $entity     = 'payments';
    protected $primaryKey = 'Guid';
    protected $fillable   = [
        'Guid',
        'DepositAccountNumber',
        'ExternalReference',
        'PaymentDate',
        'Description',
        'Amount',
        'AmountInForeignCurrency'
    ];

    public $Guid;
    public $DepositAccountNumber;
    public $ExternalReference;
    public $PaymentDate;
    public $Description;
    public $Amount;
    public $AmountInForeignCurrency;
}
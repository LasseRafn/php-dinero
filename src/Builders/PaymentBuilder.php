<?php namespace LasseRafn\Dinero\Builders;

use LasseRafn\Dinero\Models\Payment;
use LasseRafn\Dinero\Utils\Request;

class PaymentBuilder extends Builder
{
    protected $entity         = 'payments';
    protected $model          = Payment::class;
    protected $collectionName = 'Payments';

    public function __construct(Request $request, $entity)
    {
        $this->entity = $entity;
        parent::__construct($request);
    }
}
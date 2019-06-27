<?php

namespace LasseRafn\Dinero\Builders;

use LasseRafn\Dinero\Models\PurchaseVoucher;

class PurchaseVoucherBuilder extends Builder
{
    protected $entity = 'vouchers/purchase';
    protected $model = PurchaseVoucher::class;
}

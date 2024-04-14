<?php

namespace App\Repositories\Payment;

use Midtrans\Config;
use Midtrans\Snap;

class PaymentMidtransRepository
{
    protected $midtransConfig;
    protected $snap;

    public function __construct(
        Config $midtransConfig,
        Snap $snap,
    ) {
        $this->midtransConfig = $midtransConfig;
        $this->midtransConfig::$serverKey = config('payment.midtrans.server.key');
        $this->midtransConfig::$isProduction = false;
        $this->midtransConfig::$isSanitized = true;
        $this->midtransConfig::$is3ds = true;

        $this->snap = $snap;
    }

    public function createTransaction(array $params)
    {
        return $this->snap::createTransaction($params);
    }
}

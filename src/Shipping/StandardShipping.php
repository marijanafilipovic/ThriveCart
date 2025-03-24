<?php

namespace Marfi\ThriveCart\Shipping;

class StandardShipping implements ShippingRule
{
    public function calculate(float $subtotal): float
    {
        if ($subtotal > 90) return 0.0;
        if ($subtotal > 50 && $subtotal < 90 ) return 2.95;
        if ($subtotal < 50) return 4.95;
        return 0.0;
    }
}

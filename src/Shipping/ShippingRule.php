<?php

namespace Marfi\ThriveCart\Shipping;

interface ShippingRule
{
    public function calculate(float $total): float;
}

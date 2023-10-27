<?php

namespace krzysztofzylka\SimpleLibraries\Library;

/**
 * Price
 */
class Price {

    /**
     * Format amount
     * @param float $amount
     * @param string $currency
     * @return string
     */
    public function formatAmount(float $amount, string $currency = 'PLN') : string {
        return number_format($amount, 2, ',', ' ') . ' ' . $currency;
    }

    /**
     * Calculate VAT amount
     * @param float $amount
     * @param float $vat
     * @return float
     */
    public function calculateVatAmount(float $amount, float $vat) : float {
        return $amount * ($vat / 100);
    }

    /**
     * Calculate net amount
     * @param float $grossAmount
     * @param float $vatRate
     * @return float
     */
    public function calculateNetAmount(float $grossAmount, float $vatRate) : float {
        return $grossAmount / (1 + ($vatRate / 100));
    }

    /**
     * Calculate gross amount
     * @param float $netAmount
     * @param float $vatRate
     * @return float
     */
    function calculateGrossAmount(float $netAmount, float $vatRate) : float {
        return $netAmount * (1 + ($vatRate / 100));
    }

}
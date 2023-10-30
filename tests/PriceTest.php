<?php

use PHPUnit\Framework\TestCase;
use krzysztofzylka\SimpleLibraries\Library\Price;

class PriceTest extends TestCase {

    public function testFormatAmountWithDefaultCurrency() {
        $price = new Price();
        $formattedAmount = $price->formatAmount(1000.5);
        $this->assertEquals('1 000,50 PLN', $formattedAmount);
    }

    public function testFormatAmountWithCustomCurrency() {
        $price = new Price();
        $formattedAmount = $price->formatAmount(500.75, 'USD');
        $this->assertEquals('500,75 USD', $formattedAmount);
    }

    public function testFormatAmountWithZeroAmount() {
        $price = new Price();
        $formattedAmount = $price->formatAmount(0.0);
        $this->assertEquals('0,00 PLN', $formattedAmount);
    }

    public function testCalculateVatAmount() {
        $price = new Price();
        $amount = 100.0;
        $vat = 23.0;

        $vatAmount = $price->calculateVatAmount($amount, $vat);

        $this->assertEquals(23.0, $vatAmount);
    }

    public function testCalculateVatAmountWithZeroVat() {
        $price = new Price();
        $amount = 150.0;
        $vat = 0.0;

        $vatAmount = $price->calculateVatAmount($amount, $vat);

        $this->assertEquals(0.0, $vatAmount);
    }

    public function testCalculateVatAmountWithZeroAmount()
    {
        $price = new Price();
        $amount = 0.0;
        $vat = 23.0;

        $vatAmount = $price->calculateVatAmount($amount, $vat);

        $this->assertEquals(0.0, $vatAmount);
    }

    public function testCalculateNetAmount() {
        $price = new Price();
        $grossAmount = 123.0;
        $vatRate = 23.0;

        $netAmount = $price->calculateNetAmount($grossAmount, $vatRate);

        $this->assertEquals(100.0, $netAmount);
    }

    public function testCalculateNetAmountWithZeroGrossAmount() {
        $price = new Price();
        $grossAmount = 0.0;
        $vatRate = 23.0;

        $netAmount = $price->calculateNetAmount($grossAmount, $vatRate);

        $this->assertEquals(0.0, $netAmount);
    }

    public function testCalculateNetAmountWithZeroVatRate() {
        $price = new Price();
        $grossAmount = 150.0;
        $vatRate = 0.0;

        $netAmount = $price->calculateNetAmount($grossAmount, $vatRate);

        $this->assertEquals(150.0, $netAmount);
    }

    public function testCalculateGrossAmount() {
        $price = new Price();
        $netAmount = 100.0;
        $vatRate = 23.0;

        $grossAmount = $price->calculateGrossAmount($netAmount, $vatRate);

        $this->assertEquals(123.0, $grossAmount);
    }

    public function testCalculateGrossAmountWithZeroNetAmount() {
        $price = new Price();
        $netAmount = 0.0;
        $vatRate = 23.0;

        $grossAmount = $price->calculateGrossAmount($netAmount, $vatRate);

        $this->assertEquals(0.0, $grossAmount);
    }

    public function testCalculateGrossAmountWithZeroVatRate() {
        $price = new Price();
        $netAmount = 150.0;
        $vatRate = 0.0;

        $grossAmount = $price->calculateGrossAmount($netAmount, $vatRate);

        $this->assertEquals(150.0, $grossAmount);
    }

}

<?php

use PHPUnit\Framework\TestCase;
use krzysztofzylka\SimpleLibraries\Library\Integer;

class IntegerTest extends TestCase {

    public function testStrToFloat() {
        $int = '12345';
        $float = Integer::strToFloat($int);
        $this->assertEquals(12345.0, $float);
    }

    public function testStrToFloatWithComma() {
        $int = '12,345.67';
        $float = Integer::strToFloat($int);
        $this->assertEquals(12345.67, $float);
    }

    public function testIsStringInt() {
        $string = '12345';
        $result = Integer::isStringInt($string);
        $this->assertTrue($result);
    }

    public function testIsStringIntWithNonNumericCharacters() {
        $string = '12345a';
        $result = Integer::isStringInt($string);
        $this->assertFalse($result);
    }

    public function testIsStringIntWithComma() {
        $string = '12,345';
        $result = Integer::isStringInt($string);
        $this->assertFalse($result);
    }

    public function testIsInRangeTrue()
    {
        // Test when number is within the range
        $this->assertTrue(Integer::isInRange(5, 1, 10));
    }

    public function testIsInRangeFalse()
    {
        // Test when number is outside the range
        $this->assertFalse(Integer::isInRange(15, 1, 10));
    }

    public function testIsInRangeEdgeValues()
    {
        // Test when number is equal to the minimum value
        $this->assertTrue(Integer::isInRange(1, 1, 10));

        // Test when number is equal to the maximum value
        $this->assertTrue(Integer::isInRange(10, 1, 10));
    }

    public function testIsInRangeNegativeValues()
    {
        // Test when using negative values
        $this->assertFalse(Integer::isInRange(-5, 1, 10));
    }

}

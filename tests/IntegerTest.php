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
}

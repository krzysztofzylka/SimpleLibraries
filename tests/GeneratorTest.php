<?php

use PHPUnit\Framework\TestCase;
use krzysztofzylka\SimpleLibraries\Library\Generator;

class GeneratorTest extends TestCase
{

    public function testUniqId()
    {
        $id = Generator::uniqId();
        $this->assertEquals(strlen($id), 128);

        $id = Generator::uniqId(16);
        $this->assertEquals(16, strlen($id));

        $id = Generator::uniqId(32);
        $this->assertEquals(32, strlen($id));
    }

    public function testUniqHashWithEmptySalt() {
        $hash = Generator::uniqHash();
        $this->assertMatchesRegularExpression('/^[a-f0-9]{32}$/', $hash);
    }

    public function testUniqHashWithNonEmptySalt() {
        $salt = 'your_salt_value';
        $hash = Generator::uniqHash($salt);
        $this->assertMatchesRegularExpression('/^[a-f0-9]{32}$/', $hash);
        $this->assertNotEquals(Generator::uniqHash(), $hash);
    }

    public function testUniqHashUniqueResults() {
        $salt = 'your_salt_value';
        $hash1 = Generator::uniqHash($salt);
        $hash2 = Generator::uniqHash($salt);
        $this->assertNotEquals($hash1, $hash2);
    }

    public function testUniqHashException() {
        $this->expectException(TypeError::class);
        Generator::uniqHash(null);
    }

    public function testFormatBytesWithPrecisionTwo() {
        $result = Generator::formatBytes(1024, 2);
        $this->assertEquals('1.00 kB', $result);
    }

    public function testFormatBytesWithDefaultPrecision() {
        $result = Generator::formatBytes(2048);
        $this->assertEquals('2.00 kB', $result);
    }

    public function testFormatBytesWithPrecisionZero() {
        $result = Generator::formatBytes(500, 0);
        $this->assertEquals('500 B', $result);
    }

    public function testFormatBytesWithLargeValue() {
        $result = Generator::formatBytes(1073741824, 3);
        $this->assertEquals('1.000 GB', $result);
    }

    public function testFormatBytesWithZeroValue() {
        $result = Generator::formatBytes(0);
        $this->assertEquals('0 B', $result);
    }

    public function testGuidFormat() {
        $generator = new Generator();
        $guid = $generator->guid();
        $this->assertMatchesRegularExpression('/^[0-9a-fA-F]{8}-[0-9a-fA-F]{4}-[0-9a-fA-F]{4}-[0-9a-fA-F]{4}-[0-9a-fA-F]{12}$/', $guid);
    }

    public function testGuidUniqueness() {
        $generator = new Generator();
        $guid1 = $generator->guid();
        $guid2 = $generator->guid();
        $this->assertNotEquals($guid1, $guid2);
    }

}
<?php

use PHPUnit\Framework\TestCase;
use krzysztofzylka\SimpleLibraries\Library\Hash;
use krzysztofzylka\SimpleLibraries\Exception\SimpleLibraryException;

class HashTest extends TestCase {

    public function testMd5Hash() {
        $string = 'example';
        $hash = Hash::hash($string, 'md5');
        $this->assertEquals('$001$' .md5($string), $hash);
    }

    public function testSha256Hash() {
        $string = 'example';
        $hash = Hash::hash($string, 'sha256');
        $this->assertEquals('$002$' .hash('sha256', $string), $hash);
    }

    public function testPbkdf2Hash() {
        $string = 'example';
        $hash = Hash::hash($string, 'pbkdf2');
        $expectedHash = '$003$' .hash_pbkdf2('sha256', $string, 'SimpleLibraries', 4096, 20);
        $this->assertEquals($expectedHash, $hash);
    }

    public function testSha512Hash() {
        $string = 'example';
        $hash = Hash::hash($string, 'sha512');
        $this->assertEquals('$004$' .hash('sha512', $string), $hash);
    }

    public function testCrc32Hash() {
        $string = 'example';
        $hash = Hash::hash($string, 'crc32');
        $this->assertEquals('$005$' .hash('crc32', $string), $hash);
    }

    public function testRipemd256Hash() {
        $string = 'example';
        $hash = Hash::hash($string, 'ripemd256');
        $this->assertEquals('$006$' .hash('ripemd256', $string), $hash);
    }

    public function testSnefruHash() {
        $string = 'example';
        $hash = Hash::hash($string, 'snefru');
        $this->assertEquals('$007$' .hash('snefru', $string), $hash);
    }

    public function testGostHash() {
        $string = 'example';
        $hash = Hash::hash($string, 'gost');
        $this->assertEquals('$008$' .hash('gost', $string), $hash);
    }

    public function testXxh32Hash() {
        $string = 'example';
        $hash = Hash::hash($string, 'xxh32');
        $this->assertEquals('$009$' .hash('xxh32', $string), $hash);
    }

    public function testXxh64Hash() {
        $string = 'example';
        $hash = Hash::hash($string, 'xxh64');
        $this->assertEquals('$010$' .hash('xxh64', $string), $hash);
    }

    public function testXxh3Hash() {
        $string = 'example';
        $hash = Hash::hash($string, 'xxh3');
        $this->assertEquals('$011$' .hash('xxh3', $string), $hash);
    }

    public function testXxh128Hash() {
        $string = 'example';
        $hash = Hash::hash($string, 'xxh128');
        $this->assertEquals('$012$' .hash('xxh128', $string), $hash);
    }

    public function testCrc32cHash() {
        $string = 'example';
        $hash = Hash::hash($string, 'crc32c');
        $this->assertEquals('$013$' .hash('crc32c', $string), $hash);
    }

    public function testCheckValidHash() {
        $string = 'example';
        $hash = Hash::hash($string);
        $result = Hash::checkHash($hash, $string);
        $this->assertTrue($result);
    }

    public function testCheckInvalidHash() {
        $string = 'example';
        $invalidHash = Hash::hash('different', 'md5');
        $result = Hash::checkHash($invalidHash, $string);
        $this->assertFalse($result);
    }

}

<?php

use krzysztofzylka\SimpleLibraries\Library\_Array;
use PHPUnit\Framework\TestCase;

class ArrayTest extends TestCase {

    public function testHtmlSpecialChars() {
        $input = [
            'name' => '<script>alert("XSS attack")</script>',
            'age' => 25,
            'email' => 'example@example.com',
        ];

        $expected = [
            'name' => '&lt;script&gt;alert(&quot;XSS attack&quot;)&lt;/script&gt;',
            'age' => 25,
            'email' => 'example@example.com',
        ];

        $result = _Array::htmlSpecialChars($input);

        $this->assertEquals($expected, $result);
    }

    public function testTrim() {
        $input = [
            'name' => '  John  ',
            'age' => 25,
            'email' => '  example@example.com  ',
        ];

        $expected = [
            'name' => 'John',
            'age' => 25,
            'email' => 'example@example.com',
        ];

        $result = _Array::trim($input);

        $this->assertEquals($expected, $result);
    }

    public function testGetFromArrayUsingString() {
        $data = [
            'a' => [
                'b' => 'ok',
            ],
        ];

        $name = 'a.b';

        $expected = 'ok';

        $result = _Array::getFromArrayUsingString($name, $data);

        $this->assertEquals($expected, $result);
    }

    public function testMergeRecursiveDistinct() {
        $array1 = ['name' => 'John', 'age' => 25];
        $array2 = ['age' => 30, 'email' => 'example@example.com'];

        $expected = ['name' => 'John', 'age' => 30, 'email' => 'example@example.com'];

        $result = _Array::mergeRecursiveDistinct($array1, $array2);

        $this->assertEquals($expected, $result);
    }

    public function testInArrayKeys() {
        $data = ['name' => 'John', 'age' => 25, 'email' => 'example@example.com'];

        $this->assertTrue(_Array::inArrayKeys('name', $data));
        $this->assertFalse(_Array::inArrayKeys('address', $data));
    }

    public function testReduction() {
        $data = ['a', 'b', 'c', 'd', 'e', 'f', 'g'];

        $expected = [0 => 'a', 2 => 'c', 4 => 'e', 6 => 'g'];

        $result = _Array::reduction($data, 2);

        $this->assertEquals($expected, $result);
    }
}

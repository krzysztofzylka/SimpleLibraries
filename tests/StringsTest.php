<?php

use PHPUnit\Framework\TestCase;
use krzysztofzylka\SimpleLibraries\Library\Strings;

class StringsTest extends TestCase {

    public function testRepairUrl() {
        $url = 'https://example.com//path//to//resource';
        $result = Strings::repairUrl($url);
        $this->assertEquals('https://example.com/path/to/resource', $result);
    }

    public function testEscape() {
        $input = "It's a test string with special characters: \n\r\t'\"";
        $result = Strings::escape($input);
        $this->assertEquals('It\\\'s a test string with special characters: \\\n\\\r\\\t\\\'\"', $result);
    }

    public function testLowerCleanString() {
        $string = "   This Is a tEsT StrIng <b>With HTML</b>   ";
        $result = Strings::lowerCleanString($string);
        $this->assertEquals('this is a test string &lt;b&gt;with html&lt;/b&gt;', $result);
    }

    public function testEscapeNullString() {
        $input = null;
        $result = Strings::escape($input);
        $this->assertNull($result);
    }

    public function testLowerCleanStringEmptyString() {
        $string = '';
        $result = Strings::lowerCleanString($string);
        $this->assertEquals('', $result);
    }

    public function testClean() {
        $data = 'This is a #test string! with special characters 123';
        $result = Strings::clean($data);
        $this->assertEquals('This-is-a-test-string-with-special-characters-123', $result);
    }

    public function testSubstrWithoutLastWord() {
        $string = 'This is a sample text with more words';
        $length = 20;
        $result = Strings::substrWithoutLastWord($string, $length);
        $this->assertEquals('This is a sample', $result);
    }

    public function testSubstrWithoutLastWordLongString() {
        $string = 'This is a very long string with more words';
        $length = 10;
        $result = Strings::substrWithoutLastWord($string, $length);
        $this->assertEquals('This is a', $result);
    }

    public function testSubstrWithoutLastWordShortString() {
        $string = 'Short';
        $length = 10;
        $result = Strings::substrWithoutLastWord($string, $length);
        $this->assertEquals('Short', $result);
    }

    public function testCleanEmptyString() {
        $data = '';
        $result = Strings::clean($data);
        $this->assertEquals('', $result);
    }

    public function testSubstrWithoutLastWordZeroLength() {
        $string = 'This is a test';
        $length = 0;
        $result = Strings::substrWithoutLastWord($string, $length);
        $this->assertEquals('', $result);
    }

    public function testRemoveLineBreaks() {
        $string = "This is a string\nwith line breaks.\n";
        $result = Strings::removeLineBreaks($string);
        $this->assertEquals('This is a stringwith line breaks.', $result);
    }

    public function testCamelizeString() {
        $string = 'example_string_with_separator';
        $separator = '_';
        $result = Strings::camelizeString($string, $separator);
        $this->assertEquals('ExampleStringWithSeparator', $result);
    }

    public function testDecamelizeString() {
        $string = 'DecamelizeThisString';
        $separator = '_';
        $result = Strings::decamelizeString($string, $separator);
        $this->assertEquals('decamelize_this_string', $result);
    }

    public function testCamelizeStringNoSeparator() {
        $string = 'camelCaseString';
        $result = Strings::camelizeString($string);
        $this->assertEquals('CamelCaseString', $result);
    }

    public function testDecamelizeStringNoSeparator() {
        $string = 'DecamelizeString';
        $result = Strings::decamelizeString($string);
        $this->assertEquals('decamelize_string', $result);
    }

    public function testRemoveLineBreaksEmptyString() {
        $string = '';
        $result = Strings::removeLineBreaks($string);
        $this->assertEquals('', $result);
    }

}

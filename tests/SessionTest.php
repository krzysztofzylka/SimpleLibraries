<?php

use PHPUnit\Framework\TestCase;
use krzysztofzylka\SimpleLibraries\Library\Session;

class SessionTest extends TestCase {

    public function testSetAndGet() {
        Session::set('test_key', 'test_value');
        $result = Session::get('test_key');
        $this->assertEquals('test_value', $result);
    }

    public function testSetAndDelete() {
        Session::set('test_key', 'test_value');
        Session::delete('test_key');
        $result = Session::get('test_key');
        $this->assertNull($result);
    }

    public function testExists() {
        Session::set('test_key', 'test_value');
        $exists = Session::exists('test_key');
        $this->assertTrue($exists);
    }

    public function testClean() {
        Session::set('test_key', 'test_value');
        Session::clean();
        $result = Session::get('test_key');
        $this->assertNull($result);
    }
}

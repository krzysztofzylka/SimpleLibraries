<?php

use PHPUnit\Framework\TestCase;
use krzysztofzylka\SimpleLibraries\Library\Client;

class ClientTest extends TestCase {

    public function testGetIP() {
        // Tworzymy przykładowy request z ustawionymi wartościami nagłówków HTTP
        $_SERVER['HTTP_CLIENT_IP'] = '192.168.1.100';
        $_SERVER['HTTP_X_FORWARDED_FOR'] = '203.0.113.195';
        $_SERVER['REMOTE_ADDR'] = '10.0.0.1';

        $ip = Client::getIP();
        $this->assertEquals('192.168.1.100', $ip);

        // Usuwamy ustawione wartości nagłówków
        unset($_SERVER['HTTP_CLIENT_IP']);
        unset($_SERVER['HTTP_X_FORWARDED_FOR']);
        unset($_SERVER['REMOTE_ADDR']);
    }

    public function testGetIPNoHeaders() {
        // Usuwamy wszystkie ustawione nagłówki, więc oczekiwany wynik to null
        unset($_SERVER['HTTP_CLIENT_IP']);
        unset($_SERVER['HTTP_X_FORWARDED_FOR']);
        unset($_SERVER['REMOTE_ADDR']);

        $ip = Client::getIP();
        $this->assertNull($ip);
    }
}

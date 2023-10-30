<?php

use PHPUnit\Framework\TestCase;
use krzysztofzylka\SimpleLibraries\Library\Cache;

class CacheTest extends TestCase {

    public function testSetAndGetCache() {
        $cache = new Cache();
        $cache->set('key', 'value');
        $result = $cache->get('key');
        $this->assertEquals('value', $result);
    }

    public function testGetNonExistentCache() {
        $cache = new Cache();
        $result = $cache->get('non_existent_key');
        $this->assertNull($result);
    }

    public function testListCacheKeys() {
        $cache = new Cache();
        $cache->set('key1', 'value1');
        $cache->set('key2', 'value2');
        $keys = $cache->list();
        $this->assertCount(2, $keys);
        $this->assertContains('key1', $keys);
        $this->assertContains('key2', $keys);
    }

    public function testDeleteCache() {
        $cache = new Cache();
        $cache->set('key', 'value');
        $result = $cache->delete('key');
        $this->assertTrue($result);
        $result = $cache->get('key');
        $this->assertNull($result);
    }

    public function testDeleteNonExistentCache() {
        $cache = new Cache();
        $result = $cache->delete('non_existent_key');
        $this->assertFalse($result);
    }
}

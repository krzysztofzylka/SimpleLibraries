<?php

use PHPUnit\Framework\TestCase;
use krzysztofzylka\SimpleLibraries\Library\Date;

class DateTest extends TestCase {

    public function testSetAndGetTime() {
        $date = new Date('2023-10-30 12:30:00');
        $timestamp = $date->getTime();
        $this->assertEquals(strtotime('2023-10-30 12:30:00'), $timestamp);
    }

    public function testFormatDate() {
        $date = new Date('2023-10-30 12:30:00');
        $formattedDate = $date->format('Y-m-d H:i:s');
        $this->assertEquals('2023-10-30 12:30:00', $formattedDate);
    }

    public function testAddSeconds() {
        $date = new Date('2023-10-30 12:30:00');
        $date->addSecond(3600);
        $formattedDate = $date->format('Y-m-d H:i:s');
        $this->assertEquals('2023-10-30 13:30:00', $formattedDate);
    }

    public function testSubtractDays() {
        $date = new Date('2023-10-30 12:30:00');
        $date->subDay(2);
        $formattedDate = $date->format('Y-m-d H:i:s');
        $this->assertEquals('2023-10-28 12:30:00', $formattedDate);
    }

    public function testGetSimpleDate() {
        $simpleDate = Date::getSimpleDate();
        $this->assertIsString($simpleDate);
    }

    public function testGetSecondsToDate() {
        $currentTimestamp = time();
        $futureDate = strtotime('+1 hour');
        $seconds = Date::getSecondsToDate($futureDate);
        $this->assertGreaterThan(0, $seconds);
        $this->assertLessThanOrEqual(3600, $seconds);
    }

    public function testGetSecondsToDateWithTimestamp() {
        $currentTimestamp = time();
        $futureTimestamp = $currentTimestamp + 3600;
        $seconds = Date::getSecondsToDate($futureTimestamp);
        $this->assertGreaterThan(0, $seconds);
        $this->assertLessThanOrEqual(3600, $seconds);
    }

    public function testAddMinutes() {
        $date = new Date('2023-10-30 12:30:00');
        $date->addMinute(15);
        $formattedDate = $date->format('Y-m-d H:i:s');
        $this->assertEquals('2023-10-30 12:45:00', $formattedDate);
    }

    public function testAddHours() {
        $date = new Date('2023-10-30 12:30:00');
        $date->addHour(2);
        $formattedDate = $date->format('Y-m-d H:i:s');
        $this->assertEquals('2023-10-30 14:30:00', $formattedDate);
    }

    public function testAddMonths() {
        $date = new Date('2023-10-30 12:30:00');
        $date->addMonth(3);
        $formattedDate = $date->format('Y-m-d H:i:s');
        $this->assertEquals('2024-01-30 12:30:00', $formattedDate);
    }

    public function testAddYears() {
        $date = new Date('2023-10-30 12:30:00');
        $date->addYear(5);
        $formattedDate = $date->format('Y-m-d H:i:s');
        $this->assertEquals('2028-10-30 12:30:00', $formattedDate);
    }

    public function testSubtractSeconds() {
        $date = new Date('2023-10-30 12:30:00');
        $date->subSecond(45);
        $formattedDate = $date->format('Y-m-d H:i:s');
        $this->assertEquals('2023-10-30 12:29:15', $formattedDate);
    }

    public function testSubtractMinutes() {
        $date = new Date('2023-10-30 12:30:00');
        $date->subMinute(15);
        $formattedDate = $date->format('Y-m-d H:i:s');
        $this->assertEquals('2023-10-30 12:15:00', $formattedDate);
    }

    public function testSubtractHours() {
        $date = new Date('2023-10-30 12:30:00');
        $date->subHour(2);
        $formattedDate = $date->format('Y-m-d H:i:s');
        $this->assertEquals('2023-10-30 10:30:00', $formattedDate);
    }

    public function testSubtractMonths() {
        $date = new Date('2023-10-30 12:30:00');
        $date->subMonth(2);
        $formattedDate = $date->format('Y-m-d H:i:s');
        $this->assertEquals('2023-08-30 12:30:00', $formattedDate);
    }

    public function testSubtractYears() {
        $date = new Date('2023-10-30 12:30:00');
        $date->subYear(3);
        $formattedDate = $date->format('Y-m-d H:i:s');
        $this->assertEquals('2020-10-30 12:30:00', $formattedDate);
    }

    public function testGetDateAsString() {
        $date = new Date('2023-10-30 12:30:00');
        $dateAsString = $date->getDate();
        $this->assertIsString($dateAsString);
    }

    public function testGetDateAsTimestamp() {
        $date = new Date('2023-10-30 12:30:00');
        $timestamp = $date->getDate();
        $this->assertIsString($timestamp);
    }

    public function testDefaultFormat() {
        $date = new Date('2023-10-30 12:30:00');
        $formattedDate = $date->__toString();
        $this->assertEquals('2023-10-30 12:30:00', $formattedDate);
    }

    public function testGetSecondsToDateWithFutureTimestamp() {
        $currentTimestamp = time();
        $futureTimestamp = $currentTimestamp + 3600;
        $seconds = Date::getSecondsToDate($futureTimestamp);
        $this->assertGreaterThan(0, $seconds);
        $this->assertLessThanOrEqual(3600, $seconds);
    }

    public function testGetSecondsToDateWithPastTimestamp()
    {
        $currentTimestamp = time();
        $pastTimestamp = $currentTimestamp - 3600;
        $seconds = Date::getSecondsToDate($pastTimestamp);
        $this->assertGreaterThan(0, $seconds);
        $this->assertLessThanOrEqual(3600, $seconds);
    }

}

<?php

namespace krzysztofzylka\SimpleLibraries\Library;

use DateTime;

/**
 * Operating on date
 * @package Biblioteki
 */
class Date {

    /**
     * Seconds in month (30 day)
     * @var int
     */
    public static int $MONTH = 2592000;

    /**
     * Seconds in day
     * @var int
     */
    public static int $DAY = 86400;

    /**
     * Seconds in hour
     * @var int
     */
    public static int $HOUR = 3600;

    /**
     * Seconds in minute
     * @var int
     */
    public static int $MINUTE = 60;

    /**
     * Timestamp
     * @var int
     * @ignore
     */
    protected int $time;

    /**
     * Date format
     * @var ?string
     * @ignore
     */
    protected ?string $format = 'Y-m-d H:i:s';

    /**
     * Set date
     * @param mixed $date
     */
    public function __construct(mixed $date = null) {
        $this->set($date);
    }

    /**
     * Get timestamp
     * @return int
     */
    public function getTime() : int {
        return $this->time;
    }

    /**
     * Zmiana daty
     * @param mixed $date Data
     * @return Date
     */
    public function set(mixed $date = null) : Date {
        if (is_null($date)) {
            $this->time = time();
        } elseif (is_int($date)) {
            $this->time = $date;
        } else {
            $this->time = strtotime($date);
        }

        return $this;
    }

    /**
     * Set date format
     * @param ?string $format Format daty
     * @return Date
     */
    public function format(?string $format) : Date {
        $this->format = $format;

        return $this;
    }

    /**
     * Add seconds to date
     * @param int $seconds
     * @return Date
     */
    public function addSecond(int $seconds) : Date {
        $this->time = strtotime('+' . $seconds . ' SECONDS', $this->time);

        return $this;
    }

    /**
     * Add minutes to date
     * @param int $minutes
     * @return Date
     */
    public function addMinute(int $minutes) : Date {
        $this->time = strtotime('+' . $minutes . ' MINUTES', $this->time);

        return $this;
    }

    /**
     * Add hours to date
     * @param int $hours Ilość godzin
     * @return Date
     */
    public function addHour(int $hours) : Date {
        $this->time = strtotime('+' . $hours . ' HOURS', $this->time);

        return $this;
    }

    /**
     * Add days to date
     * @param int $days
     * @return Date
     */
    public function addDay(int $days) : Date {
        $this->time = strtotime('+' . $days . ' DAYS', $this->time);

        return $this;
    }

    /**
     * Add months to date
     * @param int $months
     * @return Date
     */
    public function addMonth(int $months) : Date {
        $this->time = strtotime('+' . $months . ' MONTHS', $this->time);

        return $this;
    }

    /**
     * Add years to date
     * @param int $years
     * @return Date
     */
    public function addYear(int $years) : Date {
        $this->time = strtotime('+' . $years . ' YEARS', $this->time);

        return $this;
    }

    /**
     * Subtracting seconds from date
     * @param int $seconds
     * @return Date
     */
    public function subSecond(int $seconds) : Date {
        $this->time = strtotime('-' . $seconds . ' SECONDS', $this->time);

        return $this;
    }

    /**
     * Subtracting minutes from date
     * @param int $minutes Ilość minut
     * @return Date
     */
    public function subMinute(int $minutes) : Date {
        $this->time = strtotime('-' . $minutes . ' MINUTES', $this->time);

        return $this;
    }

    /**
     * Subtracting hours from date
     * @param int $hours Ilość godzin
     * @return Date
     */
    public function subHour(int $hours) : Date {
        $this->time = strtotime('-' . $hours . ' HOURS', $this->time);

        return $this;
    }

    /**
     * Subtracting days from date
     * @param int $days Ilość dni
     * @return Date
     */
    public function subDay(int $days) : Date {
        $this->time = strtotime('-' . $days . ' DAYS', $this->time);

        return $this;
    }

    /**
     * Subtracting months from date
     * @param int $months Ilość miesięcy
     * @return Date
     */
    public function subMonth(int $months) : Date {
        $this->time = strtotime('-' . $months . ' MONTHS', $this->time);

        return $this;
    }

    /**
     * Subtracting yers from date
     * @param int $years Ilość lat
     * @return Date
     */
    public function subYear(int $years) : Date {
        $this->time = strtotime('-' . $years . ' YEARS', $this->time);

        return $this;
    }

    /**
     * Get data
     * @return int|string
     */
    public function getDate() : int|string {
        return $this->__toString();
    }

    /**
     * Get date
     * @return string Default format: 'Y-m-d H:i:s'
     */
    public function __toString() {
        if (is_null($this->format)) {
            return $this->getTime();
        }

        return date($this->format, $this->time);
    }

    /**
     * Get simple date in "Y-m-d H:i:s.u" format
     * @param bool $microTime
     * @return string
     */
    public static function getSimpleDate(bool $microTime = false) : string {
        if ($microTime) {
            return DateTime::createFromFormat(
                'U.u',
                sprintf('%.f', microtime(true))
            )->format('Y-m-d H:i:s.u');
        }

        return date('Y-m-d H:i:s');
    }

    /**
     * Get seconds to date
     * @param string|int $date
     * @return int
     */
    public static function getSecondsToDate(string|int $date) : int {
        return round(abs(time() - (is_int($date) ? $date : strtotime($date))));
    }

}
<?php

/**
 * Class Profiler
 *
 * Used to test application
 */
class Profiler
{
    private static $_measures = array();

    /**
     * Save new time stamp with given key
     *
     * @param $timerName
     */
    public static function startMeasure($timerName)
    {
        self::$_measures[$timerName]['time'] = microtime(true);
        if (!isset(self::$_measures[$timerName]['counter'])) {
            self::$_measures[$timerName]['counter'] = 0;
        }
        self::$_measures[$timerName]['counter']++;
    }

    /**
     * Measure duration of specific timer
     *
     * @param $timerName
     */
    public static function endMeasure($timerName)
    {
        self::$_measures[$timerName]['time'] = microtime(true) - self::$_measures[$timerName]['time'];
    }

    /**
     * Print all storage
     */
    public static function renderResult()
    {
        foreach (self::$_measures as $name => $value) {
            echo "<p>Timer $name lasted <b>{$value['time']}</b> mcs/executed {$value['counter']} times.</p>";
            echo "<p>Full time of $name lasted <b>" . $value['time'] * $value['counter'] . " times.</p>";
        }
    }
} 
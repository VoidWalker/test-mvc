<?php

class Profiler
{
    private static $_startTime;

    private static $_timerName;

    public static function startMeasure($timerName)
    {
        self::$_timerName = $timerName;
        self::$_startTime = microtime(true);
    }

    public static function endMeasure()
    {
        echo self::$_timerName . ' lasted: ' . (microtime(true) - self::$_startTime) . ' microseconds.';
    }

} 
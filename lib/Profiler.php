<?php

class Profiler
{
    private static $_startTime;

    private static $_timerName;
    
    private static $_measures = array();

    public static function startMeasure($timerName)
    {
        self::$_timerName = $timerName;
        self::$_startTime = microtime(true);
    }

    public static function endMeasure()
    {
        self::$_measures[self::$_timerName] = microtime(true) - self::$_startTime;
    }
    
    public static function renderResult()
    {
        foreach (self::$_measures as $name => $time) {
            echo "<p>Timer $name lasted <b>$time</b> microseconds.</p>";
        }
    }

} 
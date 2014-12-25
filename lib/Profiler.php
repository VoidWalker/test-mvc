<?php

class Profiler
{  
    private static $_measures = array();

    public static function startMeasure($timerName)
    {
        self::$_measures[$timerName] = microtime(true);
    }

    public static function endMeasure($timerName)
    {
        self::$_measures[$timerName] = microtime(true) - self::$_measures[$timerName];
    }
    
    public static function renderResult()
    {
        foreach (self::$_measures as $name => $time) {
            echo "<p>Timer $name lasted <b>$time</b> microseconds.</p>";
        }
    }

} 
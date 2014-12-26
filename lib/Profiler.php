<?php

class Profiler
{  
    private static $_measures = array();

    public static function startMeasure($timerName)
    {
        self::$_measures[$timerName]['timer'] = microtime(true);
        self::$_measures[$timerName]['counter']++;
    }

    public static function endMeasure($timerName)
    {
        self::$_measures[$timerName]['timer'] = microtime(true) - self::$_measures[$timerName]['timer'];
    }
    
    public static function renderResult()
    {
        foreach (self::$_measures as $name => $value) {
            echo "<p>Timer $name lasted <b>{$value['timer']}</b> mcs/executed {$value['counter']} times.</p>";
        }
    }

} 
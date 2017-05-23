<?php
/**
 * www.github.com/agupta231
 * Date: 5/22/2017
 */

class Log {
    public static $logFile;

    public static function init() {
        Log::$logFile = fopen('/var/log/ping_greenhouse/log' . date("-Y-m-d") .  ".txt", "a") or die("File cannot be opened");
    }

    public static function writeLog($string, $verbose = false) {
        if($verbose) {
            echo $string;
        }

        fwrite(Log::$logFile, $string);
    }

    public static function closeLog() {
        fclose(Log::$logFile);
    }
}
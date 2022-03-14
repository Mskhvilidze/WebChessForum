<?php

class Utils {
    
    const MB = 1024 * 1024;
    const KB = 1024;
    const PRECISION = 2;
    
    public static function getCurrentDate() {
        return date("d\.m\.Y");
    }
    
    public static function getCurrentDateAndTime() {
        return date("d\.m\.Y H:i");
    }
    
    public static function convertBytesToString($bytes) {
        if (!isset($bytes) || !is_numeric($bytes)) {
            return "NaN";
        }
        $bytes = abs($bytes);
        if ($bytes >= self::MB) {
            return round($bytes / self::MB, self::PRECISION) . " MB";
        }
        if ($bytes >= self::KB) {
            return round($bytes / self::KB, self::PRECISION) . " KB";
        }
        return $bytes . " B";
    }
    
    public static function convetStringToBytes($string) {
        if (!isset($string) || !is_string($string)) {
            return "NaN";
        }
        if (substr($string, strlen($string) - 2, 2) == "MB") {
            $bytes = substr($string, 0, strlen($string) - 3);
            $test = floatval($bytes);
            return intval($test * self::MB);
        } else if (substr($string, strlen($string) - 2, 2) == "KB") {
            $bytes = substr($string, 0, strlen($string) - 3);
            $test = floatval($bytes);
            return intval($test * self::KB);
        } else if (substr($string, strlen($string) - 1, 1) == "B") {
            $bytes = substr($string, 0, strlen($string) - 2);
            return intval(floatval($bytes));
        }
    }
}
?>

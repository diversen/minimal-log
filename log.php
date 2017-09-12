<?php

namespace diversen;

/**
 * Class log contains methods for doing 
 * logging
 */
class log {

    /**
     * Var holding log file for CLI mode
     * In Server mode e.g. apache2, we will use the system system log
     * facilities
     * Default is default.log
     * @var string $logfile
     */
    public static $logFile = null;
    
    /**
     * Debug flag
     * var boolean $debug default is false
     */
    public static $debug = false;

    /** 
     * Set <pre> tags around message if on SERVER
     * To message
     */
    public static $pre = true;
    
    /**
     * Enable newline in CLI for every message written to log file
     */
    public static $newlineFile = PHP_EOL;
    
    /**
     * Enable debug flag
     */
    public static function enableDebug () {
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
        self::$debug = true;
    }
    
    /**
     * Logs an error. Will always be written to log file
     * if using a web server it will be logged to the default
     * server error file. If cli it will be written in 'default.log'
     * or a log file you may set yourself
     * @param string $message
     * @param boolean $write_file
     */
    public static function error ($message) {

        if (!is_string($message)) {
            $message = var_export($message, true);
        }

        if (!self::isCli() && self::$pre) {
            $message = "<pre>" . $message . "</pre>";
        }

        if (self::$logFile) {
            error_log($message . self::$newlineFile, 3, self::$logFile);
            error_log($message, 4);
        } else {
            error_log($message, 4);
        }
    }
    
    /**
     * Checks if we are in CLI mode
     * @return boolean $res true if we are and false
     */
    public static function isCli () {
        
        if (php_sapi_name() === 'cli') {
            return true;
        }
        return false;
    }
    
    /**
     * Debug a message. Writes to stdout and to log file 
     * if debug = 1 is set in config - else any message is ignored
     * @param string $message 
     */
    public static function debug ($message) {       
        if (self::$debug) {
            self::error($message);
            return;
        } 
    }

    /**
     * Set log file. 
     * Is used for CLI - as CLI does not have a default log file
     * @param string $file
     */    
    public static function setErrorLogFile($file) {
        self::$logFile = $file;
    }
}


<?php

namespace diversen;

/**
 * Class log contains methods for doing
 * logging
 */
class log
{

    /**
     * Logfile
     * @var string $logfile
     */
    public static $logFile = 'error.log';

    /**
     * Debug flag
     * var boolean $debug default is false
     */
    public static $debug = false;

    /**
     * Enable debug flags. Set high error level and output any error and debug notices
     */
    public static function enableDebug()
    {
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
        self::$debug = true;
    }

    /**
     * Logs an error. If debug is set then output to console or browser
     * @param string $message
     */
    public static function error($message)
    {

        if (!is_string($message)) {
            $message = var_export($message, true);
        }

        if (!self::isCli()) {
            $output_message = "<pre>" . $message . "</pre>";
        } else {
            $output_message = $message;
        }

        if (self::$logFile) {
            error_log($message . PHP_EOL, 3, self::$logFile);
        }

        if (self::$debug) {
            echo $output_message . PHP_EOL;
        }
    }

    /**
     * Checks if we are in CLI mode
     * @return boolean $res true if cli else false
     */
    public static function isCli()
    {

        if (php_sapi_name() === 'cli') {
            return true;
        }
        return false;
    }

    /**
     * Debug a message. Writes to stdout and to log file
     * if debug = false then any message to this method is ignored
     * @param string $message
     */
    public static function debug($message)
    {
        if (self::$debug) {
            self::error($message);
            return;
        }
    }

    /**
     * Set error log file.
     * Is used for CLI - as CLI does not have a default log file
     * @param string $file
     */
    public static function setErrorLogFile($file)
    {
        self::$logFile = $file;
    }
}

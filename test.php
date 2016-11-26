<?php 

// You dont need the include statement if 
// you have installed the classes with composer
include_once "log.php";
use diversen\log;

// You can log most type - also arrays and objects. 
// They will be stringified with var_export
// There is also a check if the script is running on 
// the server or in commandline mode. If it is
// Running on the server, then the message will be
// enclosed in `pre` tags.
log::error('Test error');

// Will not be shown
log::debug('Test debug');

// Enable debug to output all errors and all debug info
log::enableDebug();

// Will both be shown
log::error('Test error');
log::debug('Test debug');

// The log system will log the SAPI via error_log
// You can specify another log file than the system
// log file
log::setErrorLogFile('test.log');

// No this is also logged to a file
log::error('Test error - also in in file');

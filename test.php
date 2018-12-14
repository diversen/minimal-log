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
log::error('Error without debug mode. Not to be seen but added to error.log');

// Will not be shown
log::debug('Debug without debug mode. Not to be seen and not added to error.log');

// Enable debug to output all errors and all debug info
log::enableDebug();

// Will both be shown
log::error('Error in debug mode. To be seen an to be added to error.log');
log::debug('Debug in debug mode. To be seen and added to error.log');

// Change log file
log::setErrorLogFile('test.log');


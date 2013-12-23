<?php

/**
 * @file
 * A single location to store configuration.
 */

// AWS access info
define('S3_LIB_LOCATION', dirname(__FILE__) . '/classes/S3.php');
define('S3_BUCKET', '<BUCKETNAME>');
define('AWSACCESSKEY', '<ACCESSKEY>');
define('AWSSECRETKEY', '<SECRETKEY>');
define('DOWNLOAD_TITLE', 'Download title');
define('DOWNLOAD_PATH', 'path/to/release.zip');

// Data location
// Ideally place this out of reach of the document root. If not, the data folder contains
// an .htaccess file preventing downloads but stil...keeping your CSVs outside the web
// server's public reach is just a good idea. 
define('DATA_LOCATION', dirname(__FILE__) . '/data');

?>
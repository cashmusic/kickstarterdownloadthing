<?php
session_cache_limiter('nocache');

header('P3P: CP="CAO PSA OUR"'); // IE privacy policy fix
ini_set('session.gc_maxlifetime', 10800);
ini_set('session.gc_probability', 1);
ini_set('session.gc_divisor', 100);

session_start();

if (isset($_SESSION['kickstarterthingwhatever'])) {
	include_once('config.php');
	
	// Instantiate S3 class, get uri
	require_once(S3_LIB_LOCATION);
	$s3 = new S3(awsAccessKey, awsSecretKey);
	$uri = 'path/to/release.zip';
	
	// Push to the file
	header("Location: " . S3::getAuthenticatedURL(S3_BUCKET, $uri, 999, false, true) );
} else {
	// No dice, redirect home
	header('Location: /');
}
?>
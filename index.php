<?php
include_once('config.php');
include_once('classes/KickstarterDownloadThing.php');

session_cache_limiter('nocache');
header('P3P: CP="CAO PSA OUR"'); // IE privacy policy fix
ini_set('session.gc_maxlifetime', 9000);
ini_set('session.gc_probability', 1);
ini_set('session.gc_divisor', 100);

session_start();

$ksdt = new KickstarterDownloadThing();


if (isset($_REQUEST['e'])) {
	$email = $_REQUEST['e'];
	if ($ksdt->verifyEmail($email)) {
		$_SESSION['kickstarterthingwhatever'] = true;
	}
}

?>




<!DOCTYPE html>
<html lang="en">
<head> 
<title>CASH Music / Download</title>
<meta name="description" content="CASH Music is a nonprofit that empowers musicians through free/open technology and learning." />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width" />

<link rel="icon" type="image/png" href="http://2ea7029ee5fd6986c0a6-6d885a724441c07ff9b675222419a9d2.r58.cf2.rackcdn.com/ui/01/images/badge.png" />
<link rel="stylesheet" type="text/css" href="https://b6febe3773eb5c5bc449-6d885a724441c07ff9b675222419a9d2.ssl.cf2.rackcdn.com/foundation.min.css" />
<link rel="stylesheet" type="text/css" href='https://fonts.googleapis.com/css?family=Amatic+SC:400,700|Roboto+Condensed:400,700italic,400italic,700,300,300italic|Noto+Serif:400,700italic,400italic,700' />
<link rel="stylesheet" type="text/css"  href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" />
<link rel="stylesheet" type="text/css" href="http://2ea7029ee5fd6986c0a6-6d885a724441c07ff9b675222419a9d2.r58.cf2.rackcdn.com/ui/01/css/app.css" />

<style type="text/css">
	/* FORMS */
	input,textarea,select {height:36px;font:italic 14px/1.25em georgia, times, serif !important;border:1px solid #fff;width:70%;padding:8px;margin-bottom:6px;box-sizing:border-box;-moz-box-sizing:border-box;-webkit-box-sizing:border-box;vertical-align:top;}
	input:active, input:focus, textarea:focus {outline:0;border:1px solid #888;}
	input[type="submit"] {background-color:#231F20;padding:5px 18px 7px 18px !important;font:bold 14px/1.25em 'Roboto Condensed',helvetica,"segoe ui","segoe wp",arial,sans-serif !important;cursor:pointer;width:auto !important;border:1px solid transparent;color:#fff;-webkit-transition: all 0.25s ease-in-out;-moz-transition: all 0.25s ease-in-out;-o-transition: all 0.25s ease-in-out;transition: all 0.25s ease-in-out;}
	input[type="submit"]:hover {background-color:#df0854;border-color:#df0854;color:#fff;}
	label {font-size:0.85em;text-transform:uppercase;color:#999;}

	p.download {margin-top:1.5em;font-size:20px;}
</style>

</head> 
<body>

	<div id="topspc"></div>
	<div id="mainspc" class="row">
		<a href="http://cashmusic.org/"><img id="homeseal" src="http://2ea7029ee5fd6986c0a6-6d885a724441c07ff9b675222419a9d2.r58.cf2.rackcdn.com/ui/01/images/badge.png" width="76" height="76" alt="home" /></a>
		<div id="nav">
			<a href="http://blog.cashmusic.org/"><i class="icon icon-pencil"></i>Blog</a>
			<a href="http://cashmusic.org/#tools"><i class="icon icon-cog"></i>Tools</a>
			<a href="http://cashmusic.org/#learning"><i class="icon icon-book"></i>Learning</a>
			<a href="http://cashmusic.org/events/"><i class="icon icon-map-marker"></i>Events</a>
			<a href="http://cashmusic.org/donate/"><i class="icon icon-heart"></i>Donate</a>
		</div>

			<div class="twelve columns">

			<?php 
			if (isset($_SESSION['kickstarterthingwhatever'])) { 			
				?>
				<div class="row">
					<div class="three columns"></div>
					<div class="six columns">
						<h1>Download</h1>
						<p>
							Thank you for the support!
						</p>
						<p class="download alt">
							<a href="download.php"><?php echo DOWNLOAD_TITLE; ?></a>
						</p>
					</div>
					<div class="three columns"></div>
				</div>
				<?php
			} else {
				?>
				<div class="row">
					<div class="three columns"></div>
					<div class="six columns">
						<h1>Download</h1>
						<p>
							To claim your download just enter your Kickstarter email address.
						</p>
						<?php echo $ksdt->error_msg; ?>
						<div>
							<form id="login_form" method="post" action="./">
								<label for="e">Your Email:</label>
								<input type="text" name="e" id="e" />

								<input type="submit" value=" get the download " />
							</form>
						<div id="helpspc">Need help? <a href="mailto:help@cashmusic.org">help@cashmusic.org</a></div>
						</div>
					</div>
					<div class="three columns"></div>
				</div>
				<?php
			}
			?>



			</div>
		</div>

		<br /><br /><br />
	</div>

	<div id="bottomspc"></div>
</body> 
</html>

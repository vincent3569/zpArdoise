<?php
if (function_exists('checkForPage')) { // check if Zenpage is enabled or not
	if (checkForPage(getOption('zenpage_homepage'))) { // switch to a news page
		$isHomePage = true;
		include ('pages.php');
	} else {
		$isHomePage = false;
		include ('gallery.php');
	}
} else {
	$isHomePage = false;
	include ('gallery.php');
}
?>
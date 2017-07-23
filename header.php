<?php if ( !defined('WEBPATH') ) die();
if ((getOption('use_galleriffic')) && !(($_zp_gallery_page == 'image.php') || ($_zp_gallery_page == 'search.php'))) {
	setOption('image_size', '525', false);
	setOption('image_use_side', 'longest', false);
	setOption('thumb_size', '75', false);
	setOption('thumb_crop', '1', false);
	setOption('thumb_crop_width', '75', false);
	setOption('thumb_crop_height', '75', false);
}
setOption('personnal_thumb_width', '267', false);
setOption('personnal_thumb_height', '133', false);

setOption('zenpage_zp_index_news', false, false);

$firstPageImages = normalizeColumns('3', '5');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>
	<?php
	echo getMainSiteName();
	if ($_zp_gallery_page == 'album.php') {echo ' | '.getBareAlbumTitle(); }
	if ($_zp_gallery_page == 'image.php') {echo ' | '.getBareAlbumTitle().' | '.getBareImageTitle(); }
	if ($_zp_gallery_page == 'contact.php') {echo ' | '.gettext('Contact'); }
	if ($_zp_gallery_page == 'archive.php') {echo ' | '.gettext('Archive View'); }
	if ($_zp_gallery_page == 'password.php') {echo ' | '.gettext('Password Required...'); }
	if ($_zp_gallery_page == '404.php') {echo ' | '.gettext('404 Not Found...'); }
	if ($_zp_gallery_page == 'search.php') {echo ' | '.gettext('Search'); }
	if ($_zp_gallery_page == 'pages.php') {echo ' | '.getBarePageTitle(); }
	if ($_zp_gallery_page == 'news.php') {echo ' | '.gettext('News'); }
	if (($_zp_gallery_page == 'news.php') && (is_NewsArticle())) {echo ' | '.getBareNewsTitle(); }
	?>
	</title>
	<meta http-equiv="content-type" content="text/html; charset=<?php echo getOption('charset'); ?>" />
	<?php printRSSHeaderLink('Gallery', gettext('Latest images RSS')); ?>
	<?php if (function_exists('printZenpageRSSHeaderLink')) { ?>
		<?php printZenpageRSSHeaderLink('NewsWithImages', gettext('News and Gallery RSS'), '', ''); ?>
	<?php } ?>
	<link rel="stylesheet" href="<?php echo $_zp_themeroot; ?>/css/screen.css" type="text/css" media="screen"/>
	<link rel="shortcut icon" href="<?php echo $_zp_themeroot; ?>/images/favicon.ico" />
	<?php zenJavascript(); ?>
	<script type="text/javascript" src="<?php echo $_zp_themeroot; ?>/js/jquery.opacityrollover.js"></script>
	<script type="text/javascript" src="<?php echo $_zp_themeroot; ?>/js/jquery.history.js"></script>
	<?php if ((($_zp_gallery_page == 'album.php') || ($_zp_gallery_page == 'search.php')) && (getOption('use_galleriffic'))) { ?>
		<script type="text/javascript" src="<?php echo $_zp_themeroot; ?>/js/jquery.galleriffic.js"></script>
		<script type="text/javascript" src="<?php echo $_zp_themeroot; ?>/js/zpgalleriffic.js"></script>
	<?php } else { ?>
		<script type="text/javascript" src="<?php echo $_zp_themeroot; ?>/js/zpgalleriffic-min.js"></script>
	<?php } ?>
	<script type="text/javascript" src="<?php echo $_zp_themeroot; ?>/js/fadeSliderToggle.js"></script>

	<?php if ($_zp_gallery_page == 'image.php') { ?>
	<script type="text/javascript">
	//<![CDATA[
	<?php if (hasNextImage()) { ?>var nextURL = "<?=getNextImageURL(); ?>";<?php } ?>
	<?php if (hasPrevImage()) { ?>var prevURL = "<?=getPrevImageURL(); ?>";<?php } ?>

	function keyboardNavigation(e){
		if(!e) e = window.event;
		if (e.altKey) return true;
		var target = e.target || e.srcElement;
		if (target && target.type) return true; //an input editable element
		var keyCode = e.keyCode || e.which;
		var docElem = document.documentElement;
		switch(keyCode) {
			case 63235: case 39:
				if (e.ctrlKey || (docElem.scrollLeft == docElem.scrollWidth-docElem.clientWidth)) {
					<?php if (hasNextImage()) { ?>window.location = nextURL<?php } ?>; return false; }
				break;
			case 63234: case 37:
				if (e.ctrlKey || (docElem.scrollLeft == 0)) {
					<?php if (hasPrevImage()) { ?>window.location = prevURL<?php } ?>; return false; }
				break;
		}
		return true;
	}

	document.onkeydown = keyboardNavigation;
	//]]>
	</script>
	<?php } ?>

	<!--
	<script type='text/javascript' src='http://getfirebug.com/releases/lite/1.2/firebug-lite-compressed.js'></script>
	-->

</head>

<body>

<div id="page">
	<?php if (($_zp_gallery_page != 'image.php') || (getOption('show_image_logo_on_image'))){ ?>
	<div id="site-title" class="clearfix">
		<a href="<?php echo htmlspecialchars(getGalleryIndexURL()); ?>" title="<?php echo getGalleryTitle(); ?>"><img id="zplogo" src="<?php echo $_zp_themeroot; ?>/images/<?php echo getOption('use_image_logo_filename'); ?>" alt="<?php echo getGalleryTitle(); ?>" /></a>
	</div>
	<?php } ?>
    
	<div id="main-menu">
	<?php if (	($_zp_gallery_page == 'index.php') ||
				($_zp_gallery_page == 'gallery.php') ||
				($_zp_gallery_page == 'album.php') ||
				($_zp_gallery_page == 'image.php') ||
				($_zp_gallery_page == 'search.php') )
		{ $galleryactive = 1; }

	?>
		<ul>
		<?php if (gettext(getOption('zenpage_homepage')) == gettext('none')) { ?>
			<li <?php if ($galleryactive) { ?>class="active"<?php } ?>><a href="<?php echo getGalleryIndexURL(false); ?>"><?php echo gettext('Gallery'); ?></a></li>
		<?php } else { ?>
			<?php if (function_exists('getPageTitleLink')) { ?>
				<li <?php if ( getOption('zenpage_homepage') == getPageTitleLink() ) { ?>class="active"<?php } ?>><a href="<?php echo getGalleryIndexURL(false); ?>"><?php echo gettext('Home'); ?></a></li>
			<?php } ?>                
			<li <?php if ($galleryactive) { ?>class="active"<?php } ?>><?php printCustomPageURL(gettext('Gallery'), 'gallery'); ?></li>
		<?php } ?>
		<?php if ( function_exists('getNewsIndexURL') ) { ?>
			<li <?php if ($_zp_gallery_page == 'news.php') { ?>class="active"<?php } ?>><a href="<?php echo getNewsIndexURL(); ?>"><?php echo gettext('news'); ?></a></li>
		<?php } ?>
		</ul>
		<?php if (function_exists('printPageMenu')) { printPageMenu('list-top', '', 'active', 'active', '', ''); } ?>
		<ul>
		<?php if (getOption('show_archive')) { ?>
			<li <?php if ($_zp_gallery_page == 'archive.php') { ?>class="active"<?php } ?>><?php printCustomPageURL(gettext('Archive View'), 'archive'); ?></li>
		<?php } ?>
		<?php if (function_exists('printContactForm')) { ?>
			<li <?php if ($_zp_gallery_page == 'contact.php') { ?>class="active"<?php } ?>><?php printCustomPageURL(gettext('Contact'), 'contact'); ?></li>
		<?php } ?>
		</ul>

	</div>		<!-- END #MAIN-MENU -->

	<div id="container" class="clearfix">
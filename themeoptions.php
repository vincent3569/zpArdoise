<?php

/* Plug-in for theme option handling
 * The Admin Options page tests for the presence of this file in a theme folder
 * If it is present it is linked to with a require_once call.
 * If it is not present, no theme options are displayed.
 */

require_once(SERVERPATH . '/' . ZENFOLDER . '/admin-functions.php');

class ThemeOptions {

	function __construct() {

		$me = basename(dirname(__FILE__));
		setThemeOptionDefault('albums_per_row', 3);
		setThemeOptionDefault('albums_per_page', 9);
		setThemeOptionDefault('images_per_row', 5);
		setThemeOptionDefault('images_per_page', 20);
		setThemeOptionDefault('thumb_size', 150);
		setThemeOptionDefault('thumb_crop', 1);
		setThemeOptionDefault('thumb_crop_width', 150);
		setThemeOptionDefault('thumb_crop_height', 150);
		setThemeOptionDefault('image_size', 700);
		setThemeOptionDefault('image_use_side', 'longest');
		setThemeOptionDefault('custom_index_page', 'gallery');

		setThemeOptionDefault('use_image_logo_filename', 'banniere3.jpg');
		setThemeOptionDefault('show_image_logo_on_image', false);
		setThemeOptionDefault('css_style', 'dark');
		setThemeOptionDefault('links_style', 'default');
		setThemeOptionDefault('zenpage_homepage', NULL);
		setThemeOptionDefault('show_archive', false);
		setThemeOptionDefault('allow_search', true);
		setThemeOptionDefault('show_tag', true);
		setThemeOptionDefault('image_statistic', 'random');
		setThemeOptionDefault('use_galleriffic', true);
		setThemeOptionDefault('galleriffic_delai', 3000);
		setThemeOptionDefault('use_colorbox_album', false);
		setThemeOptionDefault('use_colorbox_image', false);
		setThemeOptionDefault('show_exif', true);

		enableExtension('colorbox_js', 5|THEME_PLUGIN);
		setOption('colorbox_' . $me . '_album', 1);
		setOption('colorbox_' . $me . '_archive', 1);
		setOption('colorbox_' . $me . '_contact', 1);
		setOption('colorbox_' . $me . '_favorites', 1);
		setOption('colorbox_' . $me . '_gallery', 1);
		setOption('colorbox_' . $me . '_image', 1);
		setOption('colorbox_' . $me . '_index', 1);
		setOption('colorbox_' . $me . '_news', 1);
		setOption('colorbox_' . $me . '_pages', 1);
		setOption('colorbox_' . $me . '_password', 1);
		setOption('colorbox_' . $me . '_register', 1);
		setOption('colorbox_' . $me . '_search', 1);

		if (class_exists('cacheManager')) {
			cacheManager::deleteCacheSizes($me);
			cacheManager::addCacheSize($me, getThemeOption('thumb_size'), NULL, NULL, getThemeOption('thumb_crop_width'), getThemeOption('thumb_crop_height'), NULL, NULL, true);
			if (getOption('use_galleriffic')) {
				cacheManager::addCacheSize($me, 85, NULL, NULL, 85, 85, NULL, NULL, true);
				cacheManager::addCacheSize($me, 555, NULL, NULL, NULL, NULL, NULL, NULL, false);
			}
			cacheManager::addCacheSize($me, getThemeOption('image_size'), NULL, NULL, NULL, NULL, NULL, NULL, false);
		}
	}

	function getOptionsDisabled() {
		return array('thumb_size', 'image_size', 'custom_index_page');
	}

	function getOptionsSupported() {
		global $_zp_db;
		$unpublishedpages = $_zp_db->queryFullArray("SELECT title, titlelink FROM " . $_zp_db->prefix('pages') . " WHERE `show` != 1 ORDER by `sort_order`");
		$unpub_list = array();
		foreach ($unpublishedpages as $page) {
			$unpub_list[get_language_string($page['title'])] = $page['titlelink'];
		}

		return array(
			gettext('Use this file as logo') => array('order' => 0, 'key' => 'use_image_logo_filename', 'type' => OPTION_TYPE_TEXTBOX, 'multilingual' => 0, 'desc' => gettext_th('Image file for the logo area: enter the full filename (including extension) of the image file located in themes/zpArdoise/images/ (banniere1.jpg for example).', 'zpArdoise')),
			gettext('Show the logo on Image page') => array('order' => 1, 'key' => 'show_image_logo_on_image', 'type' => OPTION_TYPE_CHECKBOX, 'desc' => gettext_th('Check to show the logo on the Image page.', 'zpArdoise')),
			gettext('Style') => array('order' => 2, 'key' => 'css_style', 'type' => OPTION_TYPE_CUSTOM, 'desc' => gettext_th('Choose Dark or Light for color style of the site.', 'zpArdoise')),
			gettext('Color') => array('order' => 3, 'key' => 'color_style', 'type' => OPTION_TYPE_CUSTOM, 'desc' => gettext_th('Choose the color of links: choose Default to use the default color of Dark or Light style and choose Custom to use a custom value. You can customize these values by editing the file theme/zpArdoise/css/custom.css.', 'zpArdoise')),
			gettext('Homepage') => array('order' => 4, 'key' => 'zenpage_homepage', 'type' => OPTION_TYPE_SELECTOR, 'selections' => $unpub_list, 'null_selection' => gettext('none'), 'desc' => gettext("Choose here any <em>un-published Zenpage page</em> (listed by <em>titlelink</em>) to act as your site’s homepage instead the normal gallery index.")
																																																. "<p class='notebox'>" . gettext("<strong>Note:</strong> This of course overrides the <em>News on index page</em> option and your theme must be setup for this feature! Visit the theming tutorial for details.") . "</p>"),
			gettext('Show Archive link') => array('order' => 5, 'key' => 'show_archive', 'type' => OPTION_TYPE_CHECKBOX, 'desc' => gettext_th('Display a menu link to the Archive list.', 'zpArdoise')),
			gettext('Allow search') => array('order' => 6, 'key' => 'allow_search', 'type' => OPTION_TYPE_CHECKBOX, 'desc' => gettext('Check to enable search form.')),
			gettext('Show Tags') => array('order' => 7, 'key' => 'show_tag', 'type' => OPTION_TYPE_CHECKBOX, 'desc' => gettext_th('Check to show a tag cloud with all the tags of the gallery.', 'zpArdoise')),
			gettext('Show Image Statistic strip') => array('order' => 8, 'key' => 'image_statistic', 'type' => OPTION_TYPE_CUSTOM, 'desc' => gettext_th('Shows a strip of thumbnails on Gallery page, depending of the selected option. NOTE: For anything other than random, the image_album_statistics plugin must be activated.', 'zpArdoise')),
			gettext('Use Galleriffic script') => array('order' => 9, 'key' => 'use_galleriffic', 'type' => OPTION_TYPE_CHECKBOX, 'desc' => gettext_th('Check to use the Galleriffic script. Uncheck to use a standard display. This standard display is also displayed when javascript is disabled in the browser.', 'zpArdoise')),
			gettext('Galleriffic slideshow delay') => array('order' => 10, 'key' => 'galleriffic_delai', 'type' => OPTION_TYPE_TEXTBOX, 'desc' => gettext_th('If Galleriffic is used, enter the delay of the gallerific slideshow in ms (eg 3000).', 'zpArdoise')),
			gettext('Use Colorbox in Album page') => array('order' => 11, 'key' => 'use_colorbox_album', 'type' => OPTION_TYPE_CHECKBOX, 'desc' => gettext_th('Check to display the full size image with Colorbox in album page, if galleriffic is used or not. NOTE : in that case, Image page will never be used.', 'zpArdoise')),
			gettext('Use Colorbox in Image page') => array('order' => 12, 'key' => 'use_colorbox_image', 'type' => OPTION_TYPE_CHECKBOX, 'desc' => gettext_th('Check to display the full size image with Colorbox in Image page.', 'zpArdoise')),
			gettext('Show image EXIF data') => array('order' => 13, 'key' => 'show_exif', 'type' => OPTION_TYPE_CHECKBOX, 'desc' => gettext_th('Show the main EXIF Data on Image page (Model, FocalLength, FNumber, ExposureTime, ISOSpeedRatings). Remember you have to check these EXIFs data on Admin>Options>Image>Metadata.', 'zpArdoise'))
		);
	}

	function handleOption($option, $currentValue) {

		if ($option == 'css_style') {
			echo '<select style="width: 200px;" id="' . $option . '" name="' . $option . '"' . ">\n";
			echo '<option value="dark"';
				if ($currentValue == 'dark') {
					echo ' selected="selected">Dark</option>\n';
				} else {
					echo '>Dark</option>\n';
				}
			echo '<option value="light"';
				if ($currentValue == 'light') {
					echo ' selected="selected">Light</option>\n';
				} else {
					echo '>Light</option>\n';
				}
			echo "</select>\n";
		}

		if ($option == 'color_style') {
			echo '<select style="width: 200px;" id="' . $option . '" name="' . $option . '"' . ">\n";
			echo '<option value="default"';
				if ($currentValue == 'default') {
					echo ' selected="selected">Default</option>\n';
				} else {
					echo '>Default</option>\n';
				}
			echo '<option value="custom"';
				if ($currentValue == 'custom') {
					echo ' selected="selected">Custom</option>\n';
				} else {
					echo '>Custom</option>\n';
				}
			echo "</select>\n";
		}

		if ($option == 'image_statistic') {
			echo '<select style="width: 200px;" id="' . $option . '" name="' . $option . '"' . ">\n";
			echo '<option value="none"';
				if ($currentValue == 'none') {
					echo ' selected="selected">None</option>\n';
				} else {
					echo '>None</option>\n';
				}
			echo '<option value="random"';
				if ($currentValue == 'random') {
					echo ' selected="selected">Random</option>\n';
				} else {
					echo '>Random</option>\n';
				}
			echo '<option value="popular"';
				if ($currentValue == 'popular') {
					echo ' selected="selected">Popular</option>\n';
				} else {
					echo '>Popular</option>\n';
				}
			echo '<option value="latest"';
				if ($currentValue == 'latest') {
					echo ' selected="selected">Latest</option>\n';
				} else {
					echo '>Latest</option>\n';
				}
			echo '<option value="latest-date"';
				if ($currentValue == 'latest-date') {
					echo ' selected="selected">Latest-date</option>\n';
				} else {
					echo '>Latest-date</option>\n';
				}
			echo '<option value="latest-mtime"';
				if ($currentValue == 'latest-mtime') {
					echo ' selected="selected">Latest-mtime</option>\n';
				} else {
					echo '>Latest-mtime</option>\n';
				}
			echo '<option value="mostrated"';
				if ($currentValue == 'mostrated') {
					echo ' selected="selected">Most Rated</option>\n';
				} else {
					echo '>Most Rated</option>\n';
				}
			echo '<option value="toprated"';
				if ($currentValue == 'toprated') {
					echo ' selected="selected">Top Rated</option>\n';
				} else {
					echo '>Top Rated</option>\n';
				}
			echo "</select>\n";
		}
	}
}
?>
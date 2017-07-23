<?php

/* Plug-in for theme option handling
 * The Admin Options page tests for the presence of this file in a theme folder
 * If it is present it is linked to with a require_once call.
 * If it is not present, no theme options are displayed.
 */

require_once(SERVERPATH . '/' . ZENFOLDER . '/admin-functions.php');

class ThemeOptions {

	function ThemeOptions() {
		setOptionDefault('use_image_logo_filename', 'banniere3.jpg');
		setOptionDefault('show_image_logo_on_image', false);
		setOptionDefault('zenpage_homepage', 'none');
		setOptionDefault('show_archive', false);
		setOptionDefault('allow_search', true);
		setOptionDefault('show_exif', true);
		setOptionDefault('show_tag', true);
		setOptionDefault('image_statistic', 'random');
		setOptionDefault('use_colorbox_album', false);
		setOptionDefault('use_colorbox_image', false);
		setOptionDefault('use_galleriffic', true);
		setOptionDefault('galleriffic_delai', 3000);
		setOptionDefault('color_style', 'default');
		setOptionDefault('colorbox_zpArdoise_album', 1);
		setOptionDefault('colorbox_zpArdoise_gallery', 1);
		setOptionDefault('colorbox_zpArdoise_image', 1);
		setOptionDefault('colorbox_zpArdoise_news', 1);
		setOptionDefault('colorbox_zpArdoise_pages', 1);
		setOptionDefault('colorbox_zpArdoise_search', 1);
	}

	function getOptionsSupported() {
		return array(
			gettext('Use this file as logo') => array('key' => 'use_image_logo_filename', 'type' => OPTION_TYPE_TEXTBOX, 'multilingual' => 1, 'desc' => gettext_th('Image file for the logo area: enter the full filename (including extension) of the image file located in themes/zpArdoise/images/ (banniere1.jpg for example).', 'zpArdoise')),
			gettext('Show the logo on Image page') => array('key' => 'show_image_logo_on_image', 'type' => OPTION_TYPE_CHECKBOX, 'desc' => gettext_th('Check to show the logo on the Image page.', 'zpArdoise')),
			gettext('Homepage') => array('key' => 'zenpage_homepage', 'type' => OPTION_TYPE_CUSTOM, 'desc' => gettext("Choose here any <em>un-published Zenpage page</em> (listed by <em>titlelink</em>) to act as your site's homepage instead the normal gallery index.")."<p class='notebox'>".gettext("<strong>Note:</strong> This of course overrides the <em>News on index page</em> option and your theme must be setup for this feature! Visit the theming tutorial for details.")."</p>"),
			gettext('Show Archive link') => array('key' => 'show_archive', 'type' => OPTION_TYPE_CHECKBOX, 'desc' => gettext_th('Display a menu link to the Archive list.', 'zpArdoise')),
			gettext('Allow search') => array('key' => 'allow_search', 'type' => OPTION_TYPE_CHECKBOX, 'desc' => gettext('Check to enable search form.')),
			gettext('Show image EXIF data') => array('key' => 'show_exif', 'type' => OPTION_TYPE_CHECKBOX, 'desc' => gettext_th('Show the main EXIF Data on Image page (Model, FocalLength, FNumber, ExposureTime, ISOSpeedRatings). Remember you have to check these EXIFs data on admin>image>information EXIF.', 'zpArdoise')),
			gettext('Show Tags') => array('key' => 'show_tag', 'type' => OPTION_TYPE_CHECKBOX, 'desc' => gettext_th('Check to show a tag cloud with all the tags of the gallery.', 'zpArdoise')),
			gettext('Show Image Statistic strip') => array('key' => 'image_statistic', 'type' => OPTION_TYPE_CUSTOM, 'desc' => gettext_th('Shows a strip of thumbnails on Gallery page, depending of the selected option. NOTE: For anything other than random, the image_statistic plugin must be activated.', 'zpArdoise')),
			gettext('Use Colorbox in Album page') => array('key' => 'use_colorbox_album', 'type' => OPTION_TYPE_CHECKBOX, 'desc' => gettext_th('Check to display the full size image with Colorbox in album page, if galleriffic is used or not. NOTE : in that case, Image page will never be used.', 'zpArdoise')),
			gettext('Use Colorbox in Image page') => array('key' => 'use_colorbox_image', 'type' => OPTION_TYPE_CHECKBOX, 'desc' => gettext_th('Check to display the full size image with Colorbox in Image page.', 'zpArdoise')),
			gettext('Use Galleriffic script') => array('key' => 'use_galleriffic', 'type' => OPTION_TYPE_CHECKBOX, 'desc' => gettext_th('Check to use the Galleriffic script. Uncheck to use a standard display. This standard display is also displayed when javascript is disabled in the browser.', 'zpArdoise')),
			gettext('Galleriffic delay') => array('key' => 'galleriffic_delai', 'type' => OPTION_TYPE_TEXTBOX, 'desc' => gettext_th('If Galleriffic is used, enter the delay of the gallerific slideshow in ms (eg 3000).', 'zpArdoise')),
			gettext('Color') => array('key' => 'color_style', 'type' => OPTION_TYPE_CUSTOM, 'desc' => gettext_th('Choose the color of the links. You may change the values in themes/zpArdoise/css/custom.css.', 'zpArdoise'))
		);
	}

	function handleOption($option, $currentValue) {
		if ($option == 'color_style') {
			echo '<select style="width:200px;" id="' . $option . '" name="' . $option . '"' . ">\n";

			echo '<option value="default"';
				if ($currentValue == "default") {
				echo ' selected="selected">Default (blue)</option>\n';
				} else {
				echo '>Default (blue)</option>\n';
				}

			echo '<option value="custom"';
				if ($currentValue == "custom") {
				echo ' selected="selected">Custom</option>\n';
				} else {
				echo '>Custom</option>\n';
				}

			echo "</select>\n";
		}

		if ($option == 'image_statistic') {
			echo '<select style="width:200px;" id="' . $option . '" name="' . $option . '"' . ">\n";
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

		if($option == 'zenpage_homepage') {
			$unpublishedpages = query_full_array("SELECT titlelink FROM ".prefix('pages')." WHERE `show` != 1 ORDER by `sort_order`");
			if(empty($unpublishedpages)) {
				echo gettext("No unpublished pages available");
				// clear option if no unpublished pages are available or have been published meanwhile
				// so that the normal gallery index appears and no page is accidentally set if set to unpublished again.
				setOption("zenpage_homepage", "none", true);
			} else {
				echo '<input type="hidden" name="'.CUSTOM_OPTION_PREFIX.'selector-zenpage_homepage" value=0 />' . "\n";
				echo '<select id="'.$option.'" name="zenpage_homepage">'."\n";
				if($currentValue == "none") {
					$selected = " selected = 'selected'";
				} else {
					$selected = "";
				}
				echo "<option$selected>".gettext("none")."</option>";
				foreach($unpublishedpages as $page) {
					if($currentValue == $page["titlelink"]) {
						$selected = " selected = 'selected'";
					} else {
						$selected = "";
					}
					echo "<option$selected>".$page["titlelink"]."</option>";
				}
				echo "</select>\n";
			}
		}
	}

}
?>
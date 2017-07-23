<?php

/* Plug-in for theme option handling
 * The Admin Options page tests for the presence of this file in a theme folder
 * If it is present it is linked to with a require_once call.
 * If it is not present, no theme options are displayed.
 *
 */

require_once(SERVERPATH . '/' . ZENFOLDER . '/admin-functions.php');

class ThemeOptions {

	function ThemeOptions() {
		setOptionDefault('zenpage_homepage', 'none');
		setOptionDefault('allow_search', true);
		setOptionDefault('show_archive', false);
		setOptionDefault('use_image_logo_filename', 'banniere1.jpg');
		setOptionDefault('show_image_logo_on_image', false);
		setOptionDefault('show_exif', true);
		setOptionDefault('final_link', 'No Link');
		setOptionDefault('use_galleriffic', false);
		setOptionDefault('image_statistic', 'random');
		setOptionDefault('show_tag', true);
	}

	function getOptionsSupported() {
		return array(
			gettext('Homepage') => array('key' => 'zenpage_homepage', 'type' => OPTION_TYPE_CUSTOM, 'desc' => gettext("Choose here any <em>unpublished Zenpage page</em> (listed by <em>titlelink</em>) to act as your site's homepage instead the normal gallery index.")),
			gettext('Allow Search') => array('key' => 'allow_search', 'type' => OPTION_TYPE_CHECKBOX, 'desc' => gettext('Check to enable search form.')),
			gettext('Show Archive Link') => array('key' => 'show_archive', 'type' => OPTION_TYPE_CHECKBOX, 'desc' => gettext('Display a menu link to the Archive list.')),
			gettext('Use this File as Title') => array('key' => 'use_image_logo_filename', 'type' => OPTION_TYPE_TEXTBOX, 'multilingual' => 1, 'desc' => gettext('Image file for the logo/title area: enter the full filename (including extension) of the image file located in themes/zpArdoise/images.')),
			gettext('Show the image logo on image page') => array('key' => 'show_image_logo_on_image', 'type' => OPTION_TYPE_CHECKBOX, 'desc' => gettext('Check to show the image/logo on the image page.')),
			gettext('Show Image EXIF Data') => array('key' => 'show_exif', 'type' => OPTION_TYPE_CHECKBOX, 'desc' => gettext('Show the main EXIF Data on Image page (Model, FocalLength, FNumber, ExposureTime, ISOSpeedRatings, ISOSpeedRatings). Remember to check these EXIF data on admin / image / information EXIF')),
			gettext('Use Galleriffic Script') => array('key' => 'use_galleriffic', 'type' => OPTION_TYPE_CHECKBOX, 'desc' => gettext('Check to use the Galleriffic Script. Uncheck to use the standard display. This standard display is also what is displayed when the user has javascript disabled in their browser.')),
			gettext('Show Image Statistic Strip') => array('key' => 'image_statistic', 'type' => OPTION_TYPE_CUSTOM, 'desc' => gettext('Shows a strip of thumbs depending on your option selected on the gallery, news, pages, archive, and contact pages. NOTE: For anything other than random, the image_statistic plugin must be activated.')),
			gettext('Show Tags') => array('key' => 'show_tag', 'type' => OPTION_TYPE_CHECKBOX, 'desc' => gettext('Check to show a tag cloud with all the tags of the gallery.'))
		);
	}

	function handleOption($option, $currentValue) {

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
			$unpublishedpages = query_full_array("SELECT titlelink FROM ".prefix('zenpage_pages')." WHERE `show` != 1 ORDER by `sort_order`");
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
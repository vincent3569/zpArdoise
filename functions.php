<?php
if (!OFFSET_PATH) {
	if ((getOption('use_galleriffic')) && !(($_zp_gallery_page == 'image.php') || ($_zp_gallery_page == 'search.php') || ($_zp_gallery_page == 'favorites.php'))) {
		setOption('image_size', '555', false);
		setOption('image_use_side', 'longest', false);
		setOption('thumb_size', '85', false);
		setOption('thumb_crop', '1', false);
		setOption('thumb_crop_width', '85', false);
		setOption('thumb_crop_height', '85', false);
	}
	setOption('personnal_thumb_width', '267', false);
	setOption('personnal_thumb_height', '133', false);

	setOption('comment_form_toggle', false, true);		// force this option of comment_form, to avoid JS conflits
	setOption('comment_form_pagination', false, true);	// force this option of comment_form, to avoid JS conflits
	setOption('tinymce4_comments', null, true);			// force this option to disable tinyMCE for comment form

	$_zenpage_enabled = extensionEnabled('zenpage');
	$_zenpage_and_news_enabled = extensionEnabled('zenpage') && ZP_NEWS_ENABLED;
	$_zenpage_and_pages_enabled = extensionEnabled('zenpage') && ZP_PAGES_ENABLED;
	$_zp_page_check = 'my_checkPageValidity';
}

function my_checkPageValidity($request, $gallery_page, $page) {
	if ($gallery_page == 'gallery.php') {
		$gallery_page = 'index.php';
	}
	return checkPageValidity($request, $gallery_page, $page);
}

/* zpArdoise_printRandomImages
/*	- use improvements of zenphoto 1.4.14 on printRandomImages
/*	- use improvements of zenphoto 1.4.6 on printRandomImages
/*	- use improvements of zenphoto 1.4.5 on printRandomImages
/*	- use improvements of zenphoto 1.4.2 on printRandomImages
/*		- http://www.zenphoto.org/trac/ticket/1914,
/*		- http://www.zenphoto.org/trac/ticket/2020,
/*		- http://www.zenphoto.org/trac/ticket/2028
/*	- implements call of colorbox (http://www.zenphoto.org/trac/ticket/1908 and http://www.zenphoto.org/trac/ticket/1909)
*/
function zpArdoise_printRandomImages($number=5, $class=NULL, $option='all', $rootAlbum='', $width=NULL, $height=NULL, $crop=NULL, $fullimagelink=false, $a_class=NULL) {
	if (is_null($crop) && is_null($width) && is_null($height)) {
		$crop = 2;
	} else {
		if (is_null($width))
			$width = 85;
		if (is_null($height))
			$height = 85;
		if (is_null($crop)) {
			$crop = 1;
		} else {
			$crop = (int) $crop && true;
		}
	}
	if (!empty($class)) {
		$class = ' class="' . $class . '"';
	}

	echo '<ul' . $class . '>';

		switch ($option) {
			case "all":
				$randomImages = getImageStatistic($number, 'random', '');
				break;
			case "album":
				$randomImages = getImageStatistic($number, 'random', $rootAlbum);
				break;
		}
		if ( isset($randomImages) ) {
			foreach($randomImages as $randomImage) {
				$randomImageList[] = $randomImage;
				echo '<li>' . "\n";
				if ($fullimagelink) {
					$aa_class = ' class="' . $a_class . '"';
					$randomImageURL = $randomImage->getFullimageURL();
				} else {
					$aa_class = NULL;
					$randomImageURL = $randomImage->getLink();
				}
				echo '<a href="' . html_encode($randomImageURL) . '"' . $aa_class . ' title="' . html_encode($randomImage->getTitle()) . '">';
				switch ($crop) {
					case 0:
						$sizes = getSizeCustomImage($width, NULL, NULL, NULL, NULL, NULL, NULL, $randomImage);
						$html = '<img src="' . html_encode(pathurlencode($randomImage->getCustomImage($width, NULL, NULL, NULL, NULL, NULL, NULL, TRUE))) . '" width="' . $sizes[0] . '" height="' . $sizes[1] . '" alt="' . html_encode($randomImage->getTitle()) . '" />' . "\n";
						break;
					case 1:
						$sizes = getSizeCustomImage(NULL, $width, $height, $width, $height, NULL, NULL, $randomImage);
						$html = '<img src="' . html_encode(pathurlencode($randomImage->getCustomImage(NULL, $width, $height, $width, $height, NULL, NULL, TRUE))) . '" width="' . $sizes[0] . '" height="' . $sizes[1] . '" alt="' . html_encode($randomImage->getTitle()) . '" />' . "\n";
						break;
					case 2:
						$sizes = getSizeDefaultThumb($randomImage);
						$html = '<img src="' . html_encode(pathurlencode($randomImage->getThumb())) . '" width="' . $sizes[0] . '" height="' . $sizes[1] . '" alt="' . html_encode($randomImage->getTitle()) . '" />' . "\n";
						break;
				}
				echo zp_apply_filter('custom_image_html', $html, false);
				echo '</a>';
				echo '</li>' . "\n";
			}
		}
	echo '</ul>';
}

/* zpArdoise_printImageStatistic
/*	- use improvements of zenphoto 1.4.14 on printImageStatistic
/*	- use improvements of zenphoto 1.4.6 on printRandomImages
/*	- use improvements of zenphoto 1.4.2 on printImageStatistic (http://www.zenphoto.org/trac/ticket/1914)
/*	- implements call of colorbox (http://www.zenphoto.org/trac/ticket/1908 and http://www.zenphoto.org/trac/ticket/1909)
*/
function zpArdoise_printImageStatistic($number, $option, $albumfolder='', $showtitle=false, $showdate=false, $showdesc=false, $desclength=40, $showstatistic='', $width=NULL, $height=NULL, $crop=NULL, $collection=false, $fullimagelink=false, $threshold=0, $a_class=NULL) {
	$images = getImageStatistic($number, $option, $albumfolder, $collection, $threshold);
	if (is_null($crop) && is_null($width) && is_null($height)) {
		$crop = 2;
	} else {
		if (is_null($width))
			$width = 85;
		if (is_null($height))
			$height = 85;
		if (is_null($crop)) {
			$crop = 1;
		} else {
			$crop = (int) $crop && true;
		}
	}

	echo "\n" . '<div id="$option">' . "\n";
	echo '<ul>' . "\n";
	foreach ($images as $image) {
		if ($fullimagelink) {
			$aa_class = ' class="' . $a_class . '"';
			$imagelink = $image->getFullImageURL();
		} else {
			$aa_class = NULL;
			$imagelink = $image->getLink();
		}
		echo '<li><a href="' . html_encode(pathurlencode($imagelink)) . '"' . $aa_class . ' title="' . html_encode($image->getTitle()) . '"' . '>' . "\n";
		switch ($crop) {
			case 0:
				$sizes = getSizeCustomImage($width, NULL, NULL, NULL, NULL, NULL, NULL, $image);
				echo '<img src="' . html_encode(pathurlencode($image->getCustomImage($width, NULL, NULL, NULL, NULL, NULL, NULL, TRUE))) . '" width="' . $sizes[0] . '" height="' . $sizes[1] . '" alt="' . html_encode($image->getTitle()) . '" /></a>' . "\n";
				break;
			case 1:
				$sizes = getSizeCustomImage(NULL, $width, $height, $width, $height, NULL, NULL, $image);
				echo '<img src="' . html_encode(pathurlencode($image->getCustomImage(NULL, $width, $height, $width, $height, NULL, NULL, TRUE))) . '" width="' . $sizes[0] . '" height="' . $sizes[1] . '" alt="' . html_encode($image->getTitle()) . '" /></a>' . "\n";
				break;
			case 2:
				$sizes = getSizeDefaultThumb($image);
				echo '<img src="' . html_encode(pathurlencode($image->getThumb())) . '" width="' . $sizes[0] . '" height="' . $sizes[1] . '" alt="' . html_encode($image->getTitle()) . '" /></a>' . "\n";
				break;
		}
		if ($showtitle) {
			echo '<h3><a href="' . html_encode(pathurlencode($image->getLink())) . '" title="' . html_encode($image->getTitle()) . '">' . "\n";
			echo $image->getTitle() . '</a></h3>' . "\n";
		}
		if ($showdate) {
			echo '<p>' . zpFormattedDate(DATE_FORMAT, strtotime($image->getDateTime())) . '</p>';
		}
		if ($showstatistic === "rating" OR $showstatistic === "rating+hitcounter") {
			$votes = $image->get("total_votes");
			$value = $image->get("total_value");
			if ($votes != 0) {
				$rating =  round($value/$votes, 1);
			}
			echo '<p>' . sprintf(gettext('Rating: %1$u (Votes: %2$u)'), $rating, $votes) . '</p>';
		}
		if ($showstatistic === "hitcounter" OR $showstatistic === "rating+hitcounter") {
			$hitcounter = $image->get("hitcounter");
			if (empty($hitcounter)) {
				$hitcounter = "0";
			}
			echo '<p>' . sprintf(gettext("Views: %u"), $hitcounter) . '</p>';
		}
		if($showdesc) {
			echo shortenContent($image->getDesc(), $desclength,' (...)');
		}
		echo '</li>' . "\n";;
	}
	echo '</ul>' . "\n";;
	echo '</div>' . "\n";
}

/* zpArdoise_printEXIF */
function zpardoise_printEXIF() {
	$Meta_data = getImageMetaData();		// put all exif data in a array
	if (!is_null($Meta_data)) {
		$Exifs_list = '';
		if (isset($Meta_data['EXIFModel'])) { $Exifs_list .= html_encode($Meta_data['EXIFModel']); };
		if (isset($Meta_data['EXIFFocalLength'])) { $Exifs_list .= ' &ndash; ' . html_encode($Meta_data['EXIFFocalLength']); };
		if (isset($Meta_data['EXIFFNumber'])) { $Exifs_list .= ' &ndash; ' . html_encode($Meta_data['EXIFFNumber']); };
		if (isset($Meta_data['EXIFExposureTime'])) {$Exifs_list .= ' &ndash; ' . html_encode($Meta_data['EXIFExposureTime']); };
		if (isset($Meta_data['EXIFISOSpeedRatings'])) {$Exifs_list .= ' &ndash; ' . html_encode($Meta_data['EXIFISOSpeedRatings']) . ' ISO'; };
		echo $Exifs_list;
	}
}
?>
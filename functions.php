<?php

// force UTF-8 Ø

/* zpArdoise_printEXIF */
function zpardoise_printEXIF() {
	$affichExifs = '';
	if (count(getImageMetaData()) != 0) {
		$tableauDesExif = getImageMetaData(); //On r?cup?re les exfs dans un tableau
		if ($tableauDesExif['EXIFModel']!= NULL) {$affichExifs .= $tableauDesExif['EXIFModel']; };
		if ($tableauDesExif['EXIFFocalLength']!= NULL) {$affichExifs .= ' &ndash; '.$tableauDesExif['EXIFFocalLength']; };
		if ($tableauDesExif['EXIFFNumber']!= NULL) {$affichExifs .= ' &ndash; '.$tableauDesExif['EXIFFNumber']; };
		if ($tableauDesExif['EXIFExposureTime']!= NULL)	{$affichExifs .= ' &ndash; '.$tableauDesExif['EXIFExposureTime']; };
		if ($tableauDesExif['EXIFISOSpeedRatings']!= NULL) {$affichExifs .= ' &ndash; '.$tableauDesExif['EXIFISOSpeedRatings'].' ISO'; };
	}
	echo $affichExifs;
}

/* zpardoise_printRandomImages */
function zpardoise_printRandomImages($number=5, $class=null, $option='all', $rootAlbum='', $width=100, $height=100, $crop=true, $rel=null, $fullImage=false) {
	if (!is_null($class)) {
		$class = ' class="' . $class . '"';
	}
	if (!is_null($rel)) {
		$rel = 'rel="' . $rel . '" ';
	}
	echo "<ul" . $class . ">\n";
	for ($i=1; $i<=$number; $i++) {
		echo "<li>";
		switch($option) {
			case "all" :
				$randomImage = getRandomImages();
				break;
			case "album" :
				$randomImage = getRandomImagesAlbum($rootAlbum);
				break;
		}
		if (is_object($randomImage) && $randomImage->exists) {
			makeImageCurrent($randomImage);
			if($fullImage) {
				$randomImageURL = html_encode(getUnprotectedImageURL());
			} else {
				$randomImageURL = html_encode(getURL($randomImage));
			}
			echo '<a ' . $rel . 'href="' . $randomImageURL . '" title="' . html_encode($randomImage->getTitle()) . '">';
			if($crop) {
				$html = '<img src="' . html_encode($randomImage->getCustomImage(NULL, $width, $height, $width, $height, NULL, NULL, TRUE)) . '" alt="' . html_encode($randomImage->getTitle()) . '" />';
			} else {
				$html =  '<img src="' . html_encode($randomImage->getCustomImage($width, NULL, NULL, NULL, NULL, NULL, NULL, TRUE)) . '" alt="' . html_encode($randomImage->getTitle()) . '" />';
			}
			echo zp_apply_filter('custom_image_html', $html, false);
			echo "</a>";
		}
		echo "</li>\n";
	}
	echo "</ul>\n";
}


/* zpardoise_printImageStatistic */
function zpardoise_printImageStatistic($number, $option, $albumfolder='', $showtitle=false, $showdate=false, $showdesc=false, $desclength=40, $showstatistic='', $width=85, $height=85, $crop=true, $collection=false, $rel=null, $fullImage=false) {
	$images = getImageStatistic($number, $option, $albumfolder,$collection);
	if (!is_null($rel)) {
		$rel = 'rel="' . $rel . '" ';
	}
	echo "\n" . '<div id="' . $option . '">' . "\n";
	echo '<ul>' . "\n";
	foreach ($images as $image) {
		makeImageCurrent($image);
		echo '<li>';
		if($fullImage) {
			$ImageURL = html_encode(getUnprotectedImageURL());
		} else {
			$ImageURL = html_encode($image->getImageLink());
		}		
		echo '<a ' . $rel . 'href="' . $ImageURL . '" title="' . html_encode($image->getTitle()) . '">';
		if($crop) {
			echo '<img src="' . html_encode($image->getCustomImage(NULL, $width, $height, $width, $height, NULL, NULL, TRUE)) . '" alt="' . html_encode($image->getTitle()) . '" />';
		} else {
			echo '<img src="' . html_encode($image->getCustomImage($width, NULL, NULL, NULL, NULL, NULL, NULL, TRUE)) . '" alt="' . html_encode($image->getTitle()) . '" />';
		}
		echo '</a>';
		if($showtitle) {
			echo ' <h3><a href="' . html_encode($image->getImageLink()) . '" title="' . html_encode($image->getTitle()) . '">' . $image->getTitle() . '</a></h3>';
		}
		if($showdate) {
			echo ' <p>' . zpFormattedDate(getOption('date_format'),strtotime($image->getDateTime())) . '</p>';
		}
		if($showstatistic === "rating" OR $showstatistic === "rating+hitcounter") {
			$votes = $image->get("total_votes");
			$value = $image->get("total_value");
			if($votes != 0) {
				$rating =  round($value/$votes, 1);
			}
			echo ' <p>' . sprintf(gettext('Rating: %1$u (Votes: %2$u)'),$rating,$votes) . '</p>';
		}
		if($showstatistic === "hitcounter" OR $showstatistic === "rating+hitcounter") {
			$hitcounter = $image->get("hitcounter");
			if(empty($hitcounter)) { $hitcounter = "0"; }
			echo ' <p>' . sprintf(gettext("Views: %u"),$hitcounter) . '</p>';
		}
		if($showdesc) {
			echo shortenContent($image->getDesc(), $desclength,' (...)');
		}
		echo "</li>\n";
	}
	echo "</ul>\n</div>\n";
}

?>
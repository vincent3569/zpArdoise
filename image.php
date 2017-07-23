<?php include ('header.php'); ?>

		<div id="image-page" class="clearfix">
			<div id="headline" class="clearfix">
				<div class="control-nav">

					<div class="nav-img clearfix">
						<ul class="clearfix">
						<?php if (hasPrevImage()) { ?>
							<li><a href="<?php echo htmlspecialchars(getPrevImageURL()); ?>" title="<?php echo gettext('Previous Image'); ?>">&laquo;<?php echo gettext('prev'); ?></a></li>
						<?php } else { ?>
							<li class="disabledlink"><span>&laquo;<?php echo gettext('prev'); ?></span></li>
						<?php } ?>
						<?php if (hasNextImage()) { ?>
							<li><a href="<?php echo htmlspecialchars(getNextImageURL()); ?>" title="<?php echo gettext('Next Image'); ?>"><?php echo gettext('next'); ?>&raquo;</a></li>
						<?php } else { ?>
							<li class="disabledlink"><span><?php echo gettext('next'); ?>&raquo;</span></li>
						<?php } ?>
						</ul>
					</div>

					<?php if (function_exists('printSlideShowLink')) { ?>
					<?php /* if ((function_exists('printSlideShowLink')) && (!getOption('use_galleriffic'))) { */ ?>
					<div class="control-slide">
						<?php printSlideShowLink(gettext('Slideshow')); ?>
					</div>
					<?php } ?>

				</div>

				<h3><?php printHomeLink('', ' &raquo; '); ?>
				<?php if (gettext(getOption('zenpage_homepage')) == gettext('none')) { ?>
					<a href="<?php echo htmlspecialchars(getGalleryIndexURL()); ?>" title="<?php echo gettext('Albums Index'); ?>"><?php echo getGalleryTitle(); ?></a>
				<?php } else { ?>
					<?php printCustomPageURL(getGalleryTitle(), 'gallery'); ?>
				<?php } ?>
				<?php printParentBreadcrumb(' &raquo; ', ' &raquo; ', ' &raquo; ');  printAlbumBreadcrumb('', ' &raquo; '); printImageTitle(true); ?></h3>

			</div>

			<div id="image">
				<?php if(getOption('use_colorbox_image')) { ?>
					<a rel="zoom" href="<?php echo htmlspecialchars(getUnprotectedImageURL()); ?>" title="<?php echo getBareImageTitle();?>"><?php printDefaultSizedImage(getImageTitle()); ?></a>
				<?php } else { ?>
					<?php printDefaultSizedImage(getImageTitle()); ?>
				<?php } ?>
			</div>

			<div class="img-title"><?php printImageTitle(true); ?></div>

			<div id="img-infos"><?php printImageDesc(true); ?></div>

			<?php if (getOption('show_exif')) { ?>
			<div id="exif-infos">
				<?php // affichage des exif
				$affichExifs = '';
				if (count(getImageMetaData()) != 0) {
					$tableauDesExif = getImageMetaData(); //On r�cup�re les exfs dans un tableau
					if ($tableauDesExif['EXIFModel']!= NULL) {$affichExifs .= $tableauDesExif['EXIFModel']; };
					if ($tableauDesExif['EXIFFocalLength']!= NULL) {$affichExifs .= ' &ndash; '.$tableauDesExif['EXIFFocalLength']; };
					if ($tableauDesExif['EXIFFNumber']!= NULL) {$affichExifs .= ' &ndash; '.$tableauDesExif['EXIFFNumber']; };
					if ($tableauDesExif['EXIFExposureTime']!= NULL)	{$affichExifs .= ' &ndash; '.$tableauDesExif['EXIFExposureTime']; };
					if ($tableauDesExif['EXIFISOSpeedRatings']!= NULL) {$affichExifs .= ' &ndash; '.$tableauDesExif['EXIFISOSpeedRatings'].' ISO'; };
				}
				echo $affichExifs; ?>
			</div>
			<?php } ?>

			<?php if (getOption('show_tag') == true) { ?>
				<div class="headline-tags"><?php printTags('links', '', 'hor-list'); ?></div>
			<?php } ?>

			<?php if (function_exists('printRating')) { ?>
				<div id="rating-wrap"><?php printRating(); ?></div>
			<?php } ?>

		</div>

		<?php include('print_comment.php'); ?>	

<?php include('footer.php'); ?>
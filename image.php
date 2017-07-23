<?php include ('inc_header.php'); ?>

		<div id="image-page" class="clearfix">
			<div id="headline" class="clearfix">
				<div class="control-nav">

					<div class="nav-img clearfix">
						<ul class="clearfix">
						<?php if (hasPrevImage()) { ?>
							<li><a href="<?php echo html_encode(getPrevImageURL()); ?>" title="<?php echo gettext('Previous Image'); ?>">&laquo; <?php echo gettext('prev'); ?></a></li>
						<?php } else { ?>
							<li class="disabledlink"><span>&laquo; <?php echo gettext('prev'); ?></span></li>
						<?php } ?>
						<?php if (hasNextImage()) { ?>
							<li><a href="<?php echo html_encode(getNextImageURL()); ?>" title="<?php echo gettext('Next Image'); ?>"><?php echo gettext('next'); ?> &raquo;</a></li>
						<?php } else { ?>
							<li class="disabledlink"><span><?php echo gettext('next'); ?> &raquo;</span></li>
						<?php } ?>
						</ul>
					</div>

					<?php if (function_exists('printSlideShowLink')) { ?>
					<div class="control-slide">
						<?php printSlideShowLink(gettext('Slideshow')); ?>
					</div>
					<?php } ?>

				</div>

				<h3><?php printHomeLink('', ' » '); ?>
				<?php if (gettext(getOption('zenpage_homepage')) == gettext('none')) { ?>
					<a href="<?php echo html_encode(getGalleryIndexURL()); ?>" title="<?php echo gettext('Albums Index'); ?>"><?php echo html_encode(getGalleryTitle()); ?></a>
				<?php } else { ?>
					<?php printCustomPageURL(getGalleryTitle(), 'gallery'); ?>
				<?php } ?>
				&raquo;&nbsp;<?php printParentBreadcrumb('', ' » ', ' » '); printAlbumBreadcrumb('', ' » '); printImageTitle(true); ?></h3>

			</div>

			<div id="image">
				<?php if (getOption('use_colorbox_image')) { ?>
					<?php /* to do : display full image or sized image */ ?>
					<a class="colorbox" href="<?php echo html_encode(getUnprotectedImageURL()); ?>" title="<?php echo getBareImageTitle();?>"><?php printDefaultSizedImage(getImageTitle()); ?></a>
				<?php } else { ?>
					<?php printDefaultSizedImage(getImageTitle()); ?>
				<?php } ?>
			</div>

			<div id="img-title"><?php printImageTitle(true); ?></div>
			<div id="img-infos"><?php printImageDesc(true); ?></div>

			<?php if (getOption('show_exif')) { ?>
			<div id="exif-infos">
				<?php zpardoise_printEXIF() ?>
			</div>
			<?php } ?>

			<?php if (getOption('show_tag')) { ?>
				<div class="headline-tags"><?php printTags('links', '', 'hor-list'); ?></div>
			<?php } ?>

			<?php if (function_exists('printRating')) { ?>
				<div id="rating-wrap"><?php printRating(); ?></div>
			<?php } ?>

		</div>

		<?php include('inc_print_comment.php'); ?>

<?php include('inc_footer.php'); ?>
<?php include ('inc_header.php'); ?>

		<div id="headline" class="clearfix">
			<h3><?php printHomeLink('', ' &raquo; '); ?>
			<?php if (gettext(getOption('zenpage_homepage')) == gettext('none')) { ?>
				<a href="<?php echo html_encode(getGalleryIndexURL()); ?>" title="<?php echo gettext('Albums Index'); ?>"><?php echo getGalleryTitle(); ?></a>
			<?php } else { ?>
				<?php printCustomPageURL(getGalleryTitle(), 'gallery'); ?>
			<?php } ?>
			<?php printParentBreadcrumb(' &raquo; ', ' &raquo; ', ' &raquo; '); ?><?php printAlbumTitle(true); ?></h3>

			<div class="headline-text"><?php printAlbumDesc(true); ?></div>
		</div>

		<?php if ((function_exists('printSlideShowLink')) && (!getOption('use_galleriffic'))) { ?>
		<div class="control-nav">
			<div class="control-slide">
				<?php printSlideShowLink(gettext('Slideshow')); ?>
			</div>
		</div>
		<?php } ?>

		<?php if (!((getNumImages() > 0) && (getOption('use_galleriffic')))) { ?>
			<div class="pagination-nogal">
				<?php printPageListWithNav(' &laquo; ', ' &raquo; ', false, true, 'clearfix', NULL, true, 7); ?>
			</div>
		<?php } ?>

		<?php if (isAlbumPage()) { ?>
			<?php include('inc_print_album_thumb.php'); ?>
		<?php } ?>

		<?php if (getNumImages() > 0) { ?>
			<?php if (getOption('use_galleriffic')) { ?>

			<div id="galleriffic-wrap" class="clearfix">
				<div id="gallery" class="content">
					<div id="controls" class="controls"></div>
					<div class="slideshow-container">
						<div id="loading" class="loader"></div>
						<div id="slideshow" class="slideshow"></div>
					</div>
					<div id="caption" class="caption-container"></div>
				</div>
				<div id="thumbs" class="navigation">
					<ul class="thumbs">
						<?php while (next_image(true)) { ?>
						<li>
							<?php if (isImageVideo()) { ?>
								<a name="<?php echo html_decode($_zp_current_image->getFileName()); ?>" class="thumb" href="<?php echo $_zp_themeroot; ?>/images/video-placeholder.jpg" title="<?php echo getBareImageTitle(); ?>">
							<?php } else { ?>
								<a name="<?php echo html_decode($_zp_current_image->getFileName()); ?>" class="thumb" href="<?php echo getDefaultSizedImage(); ?>" title="<?php echo getBareImageTitle(); ?>">
							<?php } ?>
							<?php printImageThumb(getAnnotatedImageTitle()); ?></a>
							<a <?php if (getOption('use_colorbox_album')) { ?>class="colorbox"<?php } ?> href="<?php echo html_encode(getUnprotectedImageURL()); ?>" title="<?php echo getBareImageTitle(); ?>"></a>
							<div class="caption">
								<?php if (getOption('show_exif')) { ?>
								<div class="exif-infos-gal">
									<?php zpardoise_printEXIF() ?>
								</div>
								<?php } ?>
								<div class="image-title">
									<a href="<?php echo html_encode(getImageLinkURL()); ?>" title="<?php echo gettext('Image'); ?> : <?php echo getImageTitle(); ?>"><?php printImageTitle(false); ?></a>
								</div>
								<div class="image-desc">
									<?php printImageDesc(true); ?>
								</div>
							</div>
						</li>
						<?php } ?>
					</ul>
				</div>
			</div>
			
			<!-- If javascript is disabled in the users browser, the following version of the album page will display  -->
			<noscript>
				<?php include('inc_print_image_thumb.php'); ?>

				<div class="pagination-nogal clearfix">
					<?php printPageListWithNav(' &laquo; ', ' &raquo; ', false, true, 'clearfix', NULL, true, 7); ?>
				</div>

			</noscript>
			<!-- End of noscript display -->

			<?php } else { ?>
				<?php include('inc_print_image_thumb.php'); ?>
			<?php } ?>

		<?php } ?>

		<?php if (!((getNumImages() > 0) && (getOption('use_galleriffic')))) { ?>
			<div class="pagination-nogal">
				<?php printPageListWithNav(' &laquo; ', ' &raquo; ', false, true, 'clearfix', NULL, true, 7); ?>
			</div>
		<?php } ?>

		<?php if (getOption('show_tag')) { ?>
			<div class="headline-tags"><?php printTags('links', '', 'hor-list'); ?></div>
		<?php } ?>

		<?php if (function_exists('printGoogleMap')) { ?>
			<div class="googlemap"><?php printGoogleMap(NULL, 'googlemap'); ?></div>
			<script type="text/javascript">
			<?php if (getOption('gmap_display') == 'colorbox') { ?>
				$('.google_map').addClass('fadetoggler');
				$('.google_map').prepend('<img id="icon-map" alt="icon-map" src="<?php echo $_zp_themeroot; ?>/images/map.png" />');
			<?php } else { ?>
				$('#googlemap_toggle').addClass('fadetoggler');
				$('#googlemap_toggle').prepend('<img id="icon-map" alt="icon-map" src="<?php echo $_zp_themeroot; ?>/images/map.png" />');
			<?php } ?>
			</script>
		<?php } ?>

		<?php include('inc_print_comment.php'); ?>

<?php include('inc_footer.php'); ?>
<?php include ('header.php'); ?>

	<div id="post">

		<div id="headline" class="clearfix">
			<h4><?php printHomeLink('', ' &raquo; '); ?>
			<?php if (gettext(getOption('zenpage_homepage')) == gettext('none')) { ?>
				<a href="<?php echo htmlspecialchars(getGalleryIndexURL()); ?>" title="<?php echo gettext('Albums Index'); ?>"><?php echo getGalleryTitle(); ?></a>
			<?php } else { ?>
				<?php printCustomPageURL(getGalleryTitle(), 'gallery'); ?>
			<?php } ?>
			&raquo; <?php echo gettext('Page not found...'); ?></h4>
		</div>

		<h4>
			<?php echo gettext('The Zenphoto object you are requesting cannot be found.');
			if (isset($album)) {
				echo '<br />'.sprintf(gettext('Album: %s'), sanitize($album));
			}
			if (isset($image)) {
				echo '<br />'.sprintf(gettext('Image: %s'), sanitize($image));
			}
			if (isset($obj)) {
				echo '<br />'.sprintf(gettext('Page: %s'), substr(basename($obj), 0, -4));
			} ?>
		</h4>

	</div>

<?php include('footer.php'); ?>
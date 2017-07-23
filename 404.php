<?php include ('inc_header.php'); ?>

	<div id="post">

		<div id="headline" class="clearfix">
			<h3><?php printHomeLink('', ' » '); ?>
			<?php if (gettext(getOption('zenpage_homepage')) == gettext('none')) { ?>
				<a href="<?php echo html_encode(getGalleryIndexURL()); ?>" title="<?php echo gettext('Albums Index'); ?>"><?php echo html_encode(getGalleryTitle()); ?></a>
			<?php } else { ?>
				<?php printCustomPageURL(getGalleryTitle(), 'gallery'); ?>
			<?php } ?>
			&raquo;&nbsp;<?php echo gettext("Object not found"); ?></h3>
		</div>

		<h4>
			<?php
			echo gettext('The Zenphoto object you are requesting cannot be found.');
			if (isset($album)) {
				echo '<br />'.sprintf(gettext('Album: %s'), html_encode($album));
			}
			if (isset($image)) {
				echo '<br />'.sprintf(gettext('Image: %s'), html_encode($image));
			}
			if (isset($obj)) {
				echo '<br />'.sprintf(gettext('Page: %s'), html_encode(substr(basename($obj), 0, -4)));
			}
			?>
		</h4>

	</div>

<?php include('inc_footer.php'); ?>
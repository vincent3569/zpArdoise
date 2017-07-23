<?php include ('header.php'); ?>

	<div id="post">

		<div id="headline" class="clearfix">
			<h4><?php printHomeLink('', ' &raquo; '); ?>
			<?php if (gettext(getOption('zenpage_homepage')) == gettext('none')) { ?>
				<a href="<?php echo htmlspecialchars(getGalleryIndexURL()); ?>" title="<?php echo gettext('Albums Index'); ?>"><?php echo getGalleryTitle(); ?></a>
			<?php } else { ?>
				<?php printCustomPageURL(getGalleryTitle(), 'gallery'); ?>
			<?php } ?>
			&raquo; <?php echo gettext('Contact'); ?></h4>
		</div>

		<div class="post">
			<?php if (function_exists('printContactForm')) { ?>
				<?php printContactForm(); ?>
			<?php } else { ?>
				<p><?php echo gettext('The Contact Form plugin has not been activated.'); ?></p>
			<?php } ?>
		</div>

	</div>

<?php include('footer.php'); ?>
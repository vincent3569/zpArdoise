<?php include ('header.php'); ?>

	<div id="post">

		<div id="headline" class="clearfix">
			<h3><?php printHomeLink('', ' &raquo; '); ?>
			<?php if (gettext(getOption('zenpage_homepage')) == gettext('none')) { ?>
				<a href="<?php echo htmlspecialchars(getGalleryIndexURL()); ?>" title="<?php echo gettext('Albums Index'); ?>"><?php echo getGalleryTitle(); ?></a>
			<?php } else { ?>
				<?php printCustomPageURL(getGalleryTitle(), 'gallery'); ?>
			<?php } ?>
			&raquo; <?php echo gettext('Password required'); ?></h3>
		</div>

		<div class="error"><?php echo gettext('A password is required for the page you requested'); ?></div>
		<?php printPasswordForm(NULL, false); ?>

	</div>

<?php include('footer.php'); ?>
<?php include ('header.php'); ?>

	<div id="post">

		<div id="headline" class="clearfix">
			<h3><?php printHomeLink('', ' &raquo; '); ?>
			<?php if (gettext(getOption('zenpage_homepage')) == gettext('none')) { ?>
				<a href="<?php echo htmlspecialchars(getGalleryIndexURL()); ?>" title="<?php echo gettext('Albums Index'); ?>"><?php echo getGalleryTitle(); ?></a>
			<?php } else { ?>
				<?php printCustomPageURL(getGalleryTitle(), 'gallery'); ?>
			<?php } ?>
			&raquo; <?php echo gettext('Archive View'); ?></h3>
		</div>

		<div class="post">
			<table id="archive">
				<tr>
					<td>
						<h4><?php echo gettext('Gallery Archive'); ?></h4>
						<?php printAllDates('archive', 'year', 'month', 'desc'); ?>
					</td>
					<?php if(function_exists('printNewsArchive')) { ?>
					<td id="newsarchive">
						<h4><?php echo gettext_th('News archive'); ?></h4>
						<?php printNewsArchive('archive'); ?>
					</td>
					<?php } ?>
				</tr>
			</table>
		</div>

	</div>

<?php include('footer.php'); ?>
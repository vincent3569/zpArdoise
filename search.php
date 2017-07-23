<?php include ('header.php'); ?>

		<div id="headline" class="clearfix">
			<h4><?php printHomeLink('', ' &raquo; '); ?>
			<?php if (gettext(getOption('zenpage_homepage')) == gettext('none')) { ?>
				<a href="<?php echo htmlspecialchars(getGalleryIndexURL()); ?>" title="<?php echo gettext('Albums Index'); ?>"><?php echo getGalleryTitle(); ?></a>
			<?php } else { ?>
				<?php printCustomPageURL(getGalleryTitle(), 'gallery'); ?>
			<?php } ?>
			&raquo; <?php echo '<em>'.gettext('Recherche').'</em>'; ?></h4>
			<?php if (($total = getNumImages() + getNumAlbums()) > 0) {
				if (isset($_REQUEST['date'])) {
					$searchwords = getSearchDate();
				} else {
					$searchwords = getSearchWords();
				}
				echo '<p>'.sprintf(gettext('Total matches for <em>%1$s</em>: %2$u'), $searchwords, $total).'</p>';
			}
			$c = 0; ?>
		</div>
        
		<?php if (function_exists('printSlideShowLink')) { ?>
		<div class="control-nav">
			<div class="control-slide">
				<?php printSlideShowLink('Diaporama'); ?>
			</div>
		</div>    
		<?php } ?>

		<div class="pagination-album clearfix">
			<?php printPageListWithNav(' &laquo; ', ' &raquo; ', false, true, 'clearfix', NULL, true, 7); ?>
		</div>
	
		<?php if (isAlbumPage()) { ?>
			<?php include('print_album_thumb.php'); ?>
		<?php } ?>

		<?php if (getNumImages() > 0){ ?>
			<?php include('print_image_thumb.php'); ?>
		<?php } ?>

		<div class="pagination-album clearfix">
			<?php printPageListWithNav(' &laquo; ', ' &raquo; ', false, true, 'clearfix', NULL, true, 7); ?>
		</div>

		<?php if ($c == 0) { echo '<p>'.gettext('Sorry, no matches found. Try refining your search.').'</p>'; } ?>

<?php include('footer.php'); ?>
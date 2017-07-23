	<div id="thumbs-nogal">
		<ul class="clearfix thumbs-nogal" id="no-gal-ul">
		<?php $x = 1; while (next_image(false, $firstPageImages)): $c++; $lastcol = ''; ?>
			<?php if ($x == 5) { ?>
				<li class="no-gal-li-lastimg">
				<?php $x = 0; ?>
			<?php } else { ?>
				<li class="no-gal-li">
			<?php } ?>
			<a class="thumb" href="<?php echo htmlspecialchars(getImageLinkURL()); ?>" title="<?php echo getBareImageTitle(); ?>"><?php printImageThumb(getAnnotatedImageTitle()); ?></a>
			</li>
		<?php $x++; endwhile; ?>
		</ul>
	</div>
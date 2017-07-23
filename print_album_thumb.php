	<div id="album-wrap" class="clearfix">
		<ul>
		<?php $x = 1; while (next_album()): $lastcol = '';
			if ($x == 3) {$lastcol=' class="lastcol"'; $x = 0;} ?>
			<li<?php echo $lastcol; ?>>
				<a class="album-thumb" href="<?php echo htmlspecialchars(getAlbumLinkURL()); ?>" title="<?php echo getBareAlbumTitle(); ?>"><?php printCustomAlbumThumbImage(getBareAlbumTitle(), NULL, getOption(personnal_thumb_width), getOption(personnal_thumb_height), getOption(personnal_thumb_width), getOption(personnal_thumb_height)); ?></a>
				<h4><a href="<?php echo htmlspecialchars(getAlbumLinkURL()); ?>" title="<?php echo getBareAlbumTitle(); ?>"><?php printAlbumTitle(); ?></a></h4>
			</li>
		<?php $x++; endwhile; ?>
		</ul>
	</div>
	<div id="album-wrap" class="clearfix">
		<ul>
		<?php while (next_album()) { ?>
			<li>
				<a class="album-thumb" href="<?php echo html_encode(getAlbumURL()); ?>" title="<?php echo html_encode(getBareAlbumTitle()); ?>"><?php printCustomAlbumThumbImage(getBareAlbumTitle(), NULL, getOption('personnal_thumb_width'), getOption('personnal_thumb_height'), getOption('personnal_thumb_width'), getOption('personnal_thumb_height')); ?></a>
				<h4><a href="<?php echo html_encode(getAlbumURL()); ?>" title="<?php echo html_encode(getBareAlbumTitle()); ?>"><?php printAlbumTitle(); ?></a></h4>
			</li>
		<?php } ?>
		</ul>
	</div>
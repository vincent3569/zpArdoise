		<div id="image-stat" class="clearfix">
			<h2 id="image-stat-title">
				<?php switch (getOption('image_statistic')) {
					case 'random':
						echo gettext('Images au hasard'); break;
					case 'popular':
						echo gettext('Images populaires'); break;
					case 'latest':
						echo gettext('Dernieres images'); break;
					case 'latest-date':
						echo gettext('Dernieres images'); break;
					case 'latest-mtime':
						echo gettext('Dernieres images'); break;
					case 'mostrated':
						echo gettext('Les images les plus notees'); break;
					case 'toprated':
						echo gettext('Les images les mieux notees'); break;
				} ?>
			</h2>
			<?php if (getOption('image_statistic') == 'random') { ?>
				<?php printRandomImages(8, null, 'all', '', 86, 86, true); ?>
			<?php } else { ?>
				<?php printImageStatistic(8, getOption('image_statistic'), '', false, false, false, '', '', 86, 86, true, false); ?>
			<?php } ?>
		</div>
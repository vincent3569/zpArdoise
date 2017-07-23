		<div id="image-stat" class="clearfix">
			<h4 id="image-stat-title">
				<?php switch (getOption('image_statistic')) {
					case 'random':
						echo gettext_th('Random images'); break;
					case 'popular':
						echo gettext_th('Popular images'); break;
					case 'latest':
						echo gettext_th('Latest images'); break;
					case 'latest-date':
						echo gettext_th('Latest images'); break;
					case 'latest-mtime':
						echo gettext_th('Latest images'); break;
					case 'mostrated':
						echo gettext_th('Most Rated Images'); break;
					case 'toprated':
						echo gettext_th('Top Rated Images'); break;
				} ?>
			</h4>
			<?php if (getOption('image_statistic') == 'random') { ?>
				<?php printRandomImages(8, null, 'all', '', 86, 86, true); ?>
			<?php } else { ?>
				<?php printImageStatistic(8, getOption('image_statistic'), '', false, false, false, '', '', 86, 86, true, false); ?>
			<?php } ?>
		</div>
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
			<?php if (getOption('image_statistic') == 'random') {
				if(getOption('use_colorbox_album')) {
					zpardoise_printRandomImages(8, null, 'all', '', 85, 85, true, 'zoom', true);
				} else {
					zpardoise_printRandomImages(8, null, 'all', '', 85, 85, true, null, false);
				}
			} else {
				
				if(getOption('use_colorbox_album')) {
					zpardoise_printImageStatistic(8, getOption('image_statistic'), '', false, false, false, '', '', 85, 85, true, false, 'zoom', true);
				} else {
					zpardoise_printImageStatistic(8, getOption('image_statistic'), '', false, false, false, '', '', 85, 85, true, false, null, false);
				}
			} ?>
		</div>
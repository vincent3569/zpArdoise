		<div id="image-stat" class="clearfix">
			<h4 id="image-stat-title">
				<?php switch (getOption('image_statistic')) {
					case 'random':
						echo gettext('Random images'); break;
					case 'popular':
						echo gettext_th('Popular images'); break;		/* to do : use zenphoto translation rather than local translation */
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
			<?php if (getOption('use_galleriffic')) {
				$number = 8; 	// displays 8 thumbnails with default size (85*85) with galleriffic script
			} else {
				$number = 5; 	// displays 5 thumbnails with default size (150*150)
			} ?>
			<?php if (getOption('image_statistic') == 'random') {
				if (getOption('use_colorbox_album')) {
					zpArdoise_printRandomImages($number, null, 'all', '', null, null, null, true, 'colorbox');
				} else {
					zpArdoise_printRandomImages($number, null, 'all', '', null, null, null, false);
				}
			} else {
				
				if (getOption('use_colorbox_album')) {
					zpArdoise_printImageStatistic($number, getOption('image_statistic'), '', false, false, false, '', '', null, null, null, false, true, 'colorbox');
				} else {
					zpArdoise_printImageStatistic($number, getOption('image_statistic'), '', false, false, false, '', '', null, null, null, false, false);
				}
			} ?>
		</div>
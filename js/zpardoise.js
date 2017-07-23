
			jQuery(document).ready(function($) {
				
				//For Comment slide
				$('#comment-wrap').css('display', 'none');
				$('#comment-wrap').css('opacity', '0');
				$(".fadetoggler").click(function(){   
				$(this).next("#comment-wrap").fadeSliderToggle();
				});

				// Initially set opacity on thumbs and add
				// additional styling for hover effect on thumbs
				var onMouseOutOpacity = 0.75;
				$('ul.thumbs li').opacityrollover({
					mouseOutOpacity:   onMouseOutOpacity,
					mouseOverOpacity:  1.0,
					fadeSpeed:         'fast',
					exemptionSelector: '.selected'
				});
				$('li.no-gal-li').opacityrollover({
					mouseOutOpacity:   onMouseOutOpacity,
					mouseOverOpacity:  1.0,
					fadeSpeed:         'fast',
					exemptionSelector: '.selected'
				});
				$('#image-stat li').opacityrollover({
					mouseOutOpacity:   onMouseOutOpacity,
					mouseOverOpacity:  1.0,
					fadeSpeed:         'fast',
					exemptionSelector: '.selected'
				});
				var onMouseOutOpacityAlbums = 0.75;
				$('div#album-wrap ul li a.album-thumb').opacityrollover({
					mouseOutOpacity:   onMouseOutOpacityAlbums,
					mouseOverOpacity:  1.0,
					fadeSpeed:         'fast'
				});
				$('div.opac').opacityrollover({
					mouseOutOpacity:   onMouseOutOpacityAlbums,
					mouseOverOpacity:  1.0,
					fadeSpeed:         'fast'
				});

			});
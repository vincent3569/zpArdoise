
			jQuery(document).ready(function($) {
				
				//For Comment slide
				$('#comment-wrap').css('display', 'none');
				$('#comment-wrap').css('opacity', '0');
				$(".fadetoggler").click(function(){   
				$(this).next("#comment-wrap").fadeSliderToggle();
				});
				
				//For Googlemap slide -- hack VBO
				$('#googlemap-wrap').css('display', 'none');
				$('#googlemap-wrap').css('opacity', '0');
				$(".fadetoggler-googlemap").click(function(){   
				$(this).next("#googlemap-wrap").fadeSliderToggle();
				});

				// Initially set opacity on thumbs and add
				// additional styling for hover effect on thumbs
				var onMouseOutOpacity = 0.75;
				$('ul.thumbs li').opacityrollover({
						/*avec ul.thumbs li : bug avec ie7 et flag_thumbnail
						avec ul.thumbs li img : bug corrigé mais image sélectionnée surexposée*/
					mouseOutOpacity:   onMouseOutOpacity,
					mouseOverOpacity:  1.0,
					fadeSpeed:         'fast',
					exemptionSelector: '.selected'
				});
				$('ul.thumbs-nogal img').opacityrollover({
					mouseOutOpacity:   onMouseOutOpacity,
					mouseOverOpacity:  1.0,
					fadeSpeed:         'fast',
					exemptionSelector: '.selected'
				});
				$('#image-stat li img').opacityrollover({
					mouseOutOpacity:   onMouseOutOpacity,
					mouseOverOpacity:  1.0,
					fadeSpeed:         'fast',
					exemptionSelector: '.selected'
				});
				var onMouseOutOpacityAlbums = 0.75;
				$('div#album-wrap ul li img').opacityrollover({
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
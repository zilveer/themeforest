var $j = jQuery.noConflict();

$j(document).ready(function() {
	"use strict";

	fitAudio();
});

$j(window).load(function() {
	"use strict";

	initBlog();
	initBlogMasonryFullWidth();
});

$j(window).resize(function() {
	fitAudio();
	initBlog();
	initBlogMasonryFullWidth();
});

/*
 **	Init audio player for blog layout
 */
function fitAudio(){
	"use strict";

	$j('audio.blog_audio').mediaelementplayer({
		audioWidth: '100%'
	});
}
/*
 **	Init masonry layout for blog template
 */
function initBlog(){
	"use strict";

	if($j('.blog_holder.masonry').length){

		var $container = $j('.blog_holder.masonry');

		$container.isotope({
			itemSelector: 'article',
			resizable: false,
			masonry: {
				columnWidth: '.blog_holder_grid_sizer',
				gutter: '.blog_holder_grid_gutter'
			}
		});

		$j('.filter').click(function(){
			var selector = $j(this).attr('data-filter');
			$container.isotope({ filter: selector });
			return false;
		});

		if( $container.hasClass('masonry_infinite_scroll')){
			$container.infinitescroll({
					navSelector  : '.blog_infinite_scroll_button span',
					nextSelector : '.blog_infinite_scroll_button span a',
					itemSelector : 'article',
					loading: {
						finishedMsg: finished_text,
						msgText  : loading_text
					}
				},
				// call Isotope as a callback
				function( newElements ) {
					$container.isotope( 'appended', $j( newElements ) );
					fitVideo();
					fitAudio();
					initFlexSlider();
					setTimeout(function(){
						$j('.blog_holder.masonry').isotope( 'layout');
					},400);
				}
			);
		}else if($container.hasClass('masonry_load_more')){

			var i = 1;
			$j('.blog_load_more_button a').on('click', function(e)  {
				e.preventDefault();

				var link = $j(this).attr('href');
				var $content = '.masonry_load_more';
				var $anchor = '.blog_load_more_button a';
				var $next_href = $j($anchor).attr('href');
				$j.get(link+'', function(data){
					var $new_content = $j($content, data).wrapInner('').html();
					$next_href = $j($anchor, data).attr('href');
					$container.append( $j( $new_content) ).isotope( 'reloadItems' ).isotope({ sortBy: 'original-order' });
					fitVideo();
					fitAudio();
					initFlexSlider();
					setTimeout(function(){
						$j('.blog_holder.masonry').isotope( 'layout');
					},400);
					if($j('.blog_load_more_button span').data('rel') > i) {
						$j('.blog_load_more_button a').attr('href', $next_href); // Change the next URL
					} else {
						$j('.blog_load_more_button').remove();
					}
				});
				i++;
			});
		}

		$j('.blog_holder.masonry, .blog_load_more_button_holder').animate({opacity: "1"}, 400, function(){
			$j('.blog_holder.masonry').isotope( 'layout');
		});
	}
}

/*
 **	Init full width masonry layout for blog template
 */
function initBlogMasonryFullWidth(){
	"use strict";

	if($j('.masonry_full_width').length){

		var $container = $j('.masonry_full_width');

		$j('.filter').click(function(){
			var selector = $j(this).attr('data-filter');
			$container.isotope({ filter: selector });
			return false;
		});

		if( $container.hasClass('masonry_infinite_scroll')){
			$container.infinitescroll({
					navSelector  : '.blog_infinite_scroll_button span',
					nextSelector : '.blog_infinite_scroll_button span a',
					itemSelector : 'article',
					loading: {
						finishedMsg: finished_text,
						msgText  : loading_text
					}
				},
				// call Isotope as a callback
				function( newElements ) {
					$container.isotope( 'appended', $j( newElements ) );
					fitVideo();
					fitAudio();
					initFlexSlider();
					setTimeout(function(){
						$j('.blog_holder.masonry_full_width').isotope( 'layout');
					},400);
				}
			);
		} else if($container.hasClass('masonry_load_more')){

			var i = 1;
			$j('.blog_load_more_button a').on('click', function(e)  {
				e.preventDefault();

				var link = $j(this).attr('href');
				var $content = '.masonry_load_more';
				var $anchor = '.blog_load_more_button a';
				var $next_href = $j($anchor).attr('href');
				$j.get(link+'', function(data){
					var $new_content = $j($content, data).wrapInner('').html();
					$next_href = $j($anchor, data).attr('href');
					$container.append( $j( $new_content) ).isotope( 'reloadItems' ).isotope({ sortBy: 'original-order' });
					fitVideo();
					fitAudio();
					initFlexSlider();
					setTimeout(function(){
						$j('.blog_holder.masonry_full_width').isotope( 'layout');
					},400);
					if($j('.blog_load_more_button span').data('rel') > i) {
						$j('.blog_load_more_button a').attr('href', $next_href); // Change the next URL
					} else {
						$j('.blog_load_more_button').remove();
					}
				});
				i++;
			});
		}

		$container.isotope({
			itemSelector: 'article',
			resizable: false,
			masonry: {
				columnWidth: '.blog_holder_grid_sizer',
				gutter: '.blog_holder_grid_gutter'
			}
		});

		$j('.masonry_full_width, .blog_load_more_button_holder').animate({opacity: "1"}, 400, function(){
			$j('.blog_holder.masonry_full_width').isotope( 'layout');
		});
	}
}

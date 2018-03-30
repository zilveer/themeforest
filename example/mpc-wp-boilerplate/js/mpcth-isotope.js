jQuery(document).ready(function($) {

/* ---------------------------------------------------------------- */
/* Variables
/* ---------------------------------------------------------------- */
	var max_pages = parseInt(paginationInfo.max_pages),
		posts_count = parseInt(paginationInfo.posts_count),
		posts_per_page = parseInt(paginationInfo.posts_per_page),
		post_type = paginationInfo.post_type,
		page = parseInt(paginationInfo.page) + 1,
		path = paginationInfo.path,
		next_page_link = paginationInfo.next_page_link,
		loading_text = paginationInfo.loading_text,
		load_more_text = paginationInfo.load_more_text,
		to_end_text = paginationInfo.to_end_text,
		maxColWidth = parseInt(paginationInfo.blog_post_width_max),
		minColWidth = parseInt(paginationInfo.blog_post_width_min),
		effect_type = paginationInfo.blog_type,

		mpcth_settings = paginationInfo.mpcth_settings,
		query_vars = paginationInfo.query_vars,

		$loadmore = $('#mpcth_lm'),
		$button = $('.mpcth-lm-button'),
		$container = $("#mpcth_page_articles"),
		$loaded = $('.mpcth-lm-info'),
		$window = $(window),

		leftBorder = isNaN(parseInt($container.children('.post').css('border-left-width'))) ? 0 : parseInt($container.children('.post').css('border-left-width')),
		rightBorder = isNaN(parseInt($container.children('.post').css('border-right-width'))) ? 0 : parseInt($container.children('.post').css('border-right-width')),

		cwidth = $container.width(),
		externalMarginLeft = parseInt($container.children('.post').css('margin-left')) + parseInt($container.children('.post').css('padding-left')) + leftBorder,
		externalMarginRight = parseInt($container.children('.post').css('margin-right')) + parseInt($container.children('.post').css('padding-right')) + rightBorder,
		colNum = 0,
		colWidth = 0,
		currentURL = '',
		currentPosts = page > max_pages ? posts_count : (page - 1) * posts_per_page,
		canUpdateURL = typeof history.pushState === "function" ? true : false,
		isOneButton = $button.is('.mpcth-lm-info.mpcth-lm-button'),

		attributes = {lines: 13, length: 0, width: 3, radius: 10, corners: 1, rotate: 0, speed: 1.5, trail: 50, shadow: false, hwaccel: false, className: "mpcth-preload-spin", zIndex: 2e9, top: 10, left: 10, color: "#515151"};

	if(isOneButton)
		$button.text(load_more_text + ' - ' + (posts_count - currentPosts) + ' ' + to_end_text);
	else
		$loaded.text(currentPosts + ' / ' + posts_count);
	
	if(posts_count <= posts_per_page) 
		$button.hide();

/* ---------------------------------------------------------------- */
/* Refreshing events
/* ---------------------------------------------------------------- */

	$window.load(function (){
		$('.mpcth-preload-spin').fadeOut(function() {
			$(this).remove();
		})
	})

/* ---------------------------------------------------------------- */
/* Isotope
/* ---------------------------------------------------------------- */

	initIsotope();

	function initIsotope() {
		$window.on('isotopeResize', resizeIsotope);

		$window.resize(function(){
			resizeIsotope();
			coverGap();
		});

		setColumnWidth();
		setPostsWidth();
		coverGap();

		$container.isotope({
			resizable: false,
			animationEngine: 'css',
			masonry: { 
				columnWidth: colWidth + (externalMarginLeft + externalMarginRight)
			}
		});
	}

	function resizeIsotope(){
		setColumnWidth();
		setPostsWidth();

		$container.isotope({ masonry: { columnWidth: colWidth + (externalMarginLeft + externalMarginRight) } });
	}

	function setColumnWidth() {
		if($window.width() > 767)
			cwidth = $container.width();
		else
			cwidth = $window.width();
	
		if(effect_type == 'masonry') {
			if(cwidth < 650) {
				colNum = 1;
			} else {
				colNum = 0;
				for (var i = 10; i > 0; i--) {
					if(cwidth / i < maxColWidth && cwidth / i > minColWidth) {
						colNum = i;
					}
				}
			}

			if(colNum == 0) colNum = 1;
		
			colWidth = Math.floor(cwidth / colNum) - (externalMarginLeft + externalMarginRight);
		} else {
			colWidth = cwidth - (externalMarginLeft + externalMarginRight);
		}
	}

	function coverGap(){
		var gap = $('#mpcth_page_articles').width() - (colNum * colWidth);
		
		if(gap >= 0) {
			$('.page-template-portfolio-template-php #mpcth_aside_menu_section').width(300 + gap);
			$('.page-template-portfolio-template-php #mpcth_page_articles').css('left', gap);
			$('.page-template-portfolio-template-php #mpcth_lm').css('margin-left', 300 + gap);
		}
	}

	function setPostsWidth() {
		$container.children('.post').each(function (index, elem) {
			var $this = $(elem),
				$thumb = $this.children('.mpcth-post-thumbnail'),
				meta = $this.find('.mpcth-hidden-thumb-meta');

			if(colNum > 1 && $this.is('.mpcth-double-width-post'))
				var postWidth = colWidth * 2 + externalMarginLeft + externalMarginRight;
			else
				var postWidth = colWidth;

			$this.width(postWidth);

			if($this.is('.mpcth-post-size-1-1') || $this.is('.mpcth-post-size-2-1') || $this.is('.mpcth-post-size-1-2') || $this.is('.mpcth-post-size-2-2')) {

				if($this.is('.square')) {
					var postWidth = colWidth,
						postHeight = colWidth;

					if(colNum > 1 && $this.is('.mpcth-post-size-2-1')) {
						postWidth = colWidth * 2;
					} 
					
					if($this.is('.mpcth-post-size-1-2')) {
						postHeight = colWidth * 2;
					} 

					if(colNum > 1 && $this.is('.mpcth-post-size-2-2')) {
						postWidth = colWidth * 2;
						postHeight = colWidth * 2;
					}

					if(!$this.is('.mpcth-post-size-2-1')) {
						if(meta.data('ratio') > 1) {
							$this.find('.mpcth-post-thumbnail > img').css({
								'height' : 'auto',
								'width' : '100%'
							});
						} else {
							$this.find('.mpcth-post-thumbnail > img').css({
								'width' : 'auto',
								'height' : '100%'
							});
						}
					} else {
						$this.find('.mpcth-post-thumbnail > img').css({
							'height' : 'auto',
							'width' : '100%'
						});
					}

					$this.width(postWidth);
					$this.height(Math.ceil(postHeight));
				} else {
					var postWidth = colWidth,
						postHeight = Math.ceil(colWidth * 0.6);

					if(colNum > 1 && $this.is('.mpcth-post-size-2-1')) {
						postWidth = colWidth * 2;
					} 

					if($this.is('.mpcth-post-size-1-2')) {
						postHeight = postHeight * 2;
						$this.find('.mpcth-post-thumbnail > img').css({
							'width' : 'auto',
							'height' : '100%'
						});
					} else {
						if(meta.data('ratio') < 0.6) {
							$this.find('.mpcth-post-thumbnail > img').css({
								'height' : '100%',
								'width' : 'auto'
							});
						}
					}
					
					if(colNum > 1 && $this.is('.mpcth-post-size-2-2')) {
						postWidth = colWidth * 2;
						postHeight = postHeight * 2;
					} 

					$this.width(postWidth);
					$this.height(Math.ceil(postHeight));
				}
			}

			if(meta.length && $('body').is('.page-template-blog-template-php'))
				$thumb.height(meta.data('ratio') * postWidth >> 0);

			if(meta.length && $('body').is('.page-template-portfolio-template-php')) {
				var $img = $thumb.children('img'),
					rH = postHeight / $img.attr('height'),
					rW = postWidth / $img.attr('width');

				$img.css({
					'margin-top': 0,
					'margin-left': 0
				});
				
				if(rH < rW) {
					var newH = $img.attr('height') * rW;
					$img.width(postWidth);
					$img.height($img.attr('height') * rW);
					$img.css('margin-top', (newH - postHeight) / -2);
				} else {
					var newW = $img.attr('width') * rH;
					$img.width($img.attr('width') * rH);
					$img.height(postHeight);
					$img.css('margin-left', (newW - postWidth) / -2);
				}
			}

			if($this.css('opacity') != 1) {
				if($this.is('.format-image, .format-gallery'))
					new Spinner(attributes).spin($thumb[0]);

				$thumb.imagesLoaded(function(){                                
					$this.css('opacity', 1);
					$thumb.children('.mpcth-preload-spin').fadeOut(function() {
						$(this).remove();
					});
				});
			}
		});
	}

/* ---------------------------------------------------------------- */
/* Load More
/* ---------------------------------------------------------------- */

	$button.on('click', initLoadMore);

	function initLoadMore(e) {
		$button.off('click');

		if (page <= max_pages) {
			$(this).text(loading_text);

			var spinner = addLoadMore();
			$('#mpcth_lm_container').load(path + '/mpc-wp-boilerplate/php/parts/load-more.php',
				{
					offset: posts_per_page * (page - 1),
					post_type: post_type,
					mpcth_settings: mpcth_settings,
					posts_per_page: posts_per_page,
					query_vars: query_vars
				},
				function() {
					var postClass;
					
					if($('#mpcth_page_articles > article:first-child').hasClass('square'))
						postClass = 'square';
					else
						postClass = 'rectangle';

					videoLoadTimeout = setTimeout(function() {
						$window.trigger('MediaPlayerLoaded');
					}, 2000);

					var $posts = $(this).children();
						
					page++;

					if(next_page_link.indexOf('page/') != -1) {
						next_page_link = next_page_link.replace(/page\/[0-9]+\//, 'page/' + page + '/');
						currentURL = next_page_link.replace(/page\/[0-9]+\//, 'page/' + (page - 1) + '/');
					} else {
						next_page_link = next_page_link.replace(/paged=[0-9]+/, 'paged=' + page);
						currentURL = next_page_link.replace(/paged=[0-9]+/, 'paged=' + (page - 1));
					}

					if (page <= max_pages) {
						if(isOneButton) {
							$button.text(load_more_text + ' - ' + (posts_count - posts_per_page * (page - 1)) + ' ' + to_end_text);
						} else {
							$button.text(load_more_text);
							$loaded.text((posts_per_page * (page - 1)) + ' / ' + posts_count);
						}
					} else {
						$loadmore.hide();

						if(!isOneButton)
							$loaded.text(posts_count + ' / ' + posts_count);
					}
					
					$posts
						.css({'opacity' : 0 })
						.addClass('load-more-no-transition');
					
					spinner.stop();

					$container
						.append($posts)
						.imagesLoaded(function() {
							$posts.addClass(postClass);
						
							setPostsWidth();

							setupPosts($posts);

							$container.isotope('insert', $posts, function() {
								$posts.removeClass('load-more-no-transition');
								$posts.css('opacity', 1);
                                                                
								updateCategoryButtons();
							});
                                                        $button.on('click', initLoadMore);
						});
                                        
                                        
                                                
					if(canUpdateURL)
						history.pushState(null, null, currentURL);
				}
			);
		} else {
			$button.hide();
		}

		e.preventDefault();
	}

/* ---------------------------------------------------------------- */
/* Load More Categories
/* ---------------------------------------------------------------- */

	$('.mpcth-filterable-categories ul li').on('click', function() {
		var $this = $(this);
		var selector = '';

		$this.siblings().removeClass('active');
		$this.addClass('active');

		if($(this).data('link') == 'post')
			selector = '.' + $(this).data('link');
		else
			selector = '.category-' + $(this).data('link');
		
		$container.isotope({ filter: selector });
		return false;
	})

	function updateCategoryButtons() {
		$('.mpcth-filterable-categories ul li').each(function() {
			if($(this).data('link') == 'post')
				selector = '.' + $(this).data('link');
			else
				selector = '.category-' + $(this).data('link');

			if($container.find(selector).length == 0) {
				$(this).hide();
			} else {
				$(this).fadeIn(500);
			}
		})
	}

	updateCategoryButtons();

/* ---------------------------------------------------------------- */
/* Gallery after Load More
/* ---------------------------------------------------------------- */

	function setupPosts($posts) {
		$posts.find('.wpb_flexslider').each(function() {
			var this_element = $(this);
			var sliderSpeed = 800,
				sliderTimeout = parseInt(this_element.attr('data-interval'))*1000,
				sliderFx = this_element.attr('data-flex_fx'),
				slideshow = true;
			if ( sliderTimeout == 0 ) slideshow = false;

			this_element.flexslider({
				animation: sliderFx,
				slideshow: slideshow,
				slideshowSpeed: sliderTimeout,
				sliderSpeed: sliderSpeed,
				smoothHeight: true
			});
		});

		$posts.find('.flexslider .flex-next, .nivoSlider .nivo-nextNav').append('<span></span>');
		$posts.find('.flexslider .flex-prev, .nivoSlider .nivo-prevNav').append('<span></span>');

		$posts.find('.wpb_accordion_wrapper .ui-accordion-header a').addClass('mpcth-sc-icon-empty');
		$posts.find('.wpb_toggle').addClass('mpcth-sc-icon-empty');
	}

});
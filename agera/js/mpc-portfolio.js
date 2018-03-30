/*-----------------------------------------------------------------------------------*/
/*	Portfolio funtionality
/*-----------------------------------------------------------------------------------*/

jQuery.noConflict();
jQuery(document).ready(function($) {

	var colNum = 1,
		blogColNum = 1,
		itemWidth = 300,
		blogItemWidth = 450,
		minWidth = parseInt($('.portfolio-item:first-child').css('min-width')),
		blogMinWidth = parseInt($('blog-post:first-child').css('min-width')),
		footer = false,
		$data,
		firstRun = true,
		firstRunBlog = true,
		folioItemNumber = parseInt($('.portfolio').attr('data-item-number')),
		folioItemRatio = parseInt($('.portfolio').attr('data-item-number')),
		loadMore = false;

	if(parseInt($('#agera_footer').css('left')) == 0)
		footer = true;

	/* Delay function for the resize event */
	var delay = (function(){
	var timer = 0;
	return function(callback, ms){
		clearTimeout (timer);
		timer = setTimeout(callback, ms);
		};
	})();

	$('#content').css({
	   'padding-bottom': $('#header-container').height()
	});

	$(window).resize(function() {
		if(!footer)
			$('#agera_footer').css({'left': -$(window).width()});

		$('#content').css({
		   'padding-bottom': $('#header-container').height()
		});
	});


	/* Footer */
	$('.mpc-footer-ribbon').on('click', function(e){
		var $this = $(this);
		if(!footer){
			$('#agera_footer').css( {
				'left' : -$(window).width(),
				'visibility' : 'visible'
			});
			$('#agera_footer').stop().animate({'left': '0px' }, 500, 'easeOutExpo');
			$this.find('span.plus').stop().animate( { 'opacity' : 0 } );
			$this.find('span.minus').stop().animate( { 'opacity' : 1 } );
		} else {
			$('#agera_footer').stop().animate({'left':  -$(window).width() + 'px' }, 500, 'easeOutExpo', function(){
				$('#agera_footer').css( { 'visibility' : 'hidden' });
			});
			$this.find('span.plus').stop().animate( { 'opacity' : 1 } );
			$this.find('span.minus').stop().animate( { 'opacity' : 0 } );
		}

		footer = !footer;

		e.preventDefault();
	});

	/* Socials */

	/* set width for the social icons */
	$('.social-icons').css( { 'width' : $('.social-icons').width() } );

	$('#agera_footer .social-icons li').hover(function() {
		var $this = $(this);
		$this.find('span.icon-color').stop().animate( { 'top' : '0px' }, 250, 'easeOutExpo');
		$this.find('span.icon').stop().animate( { 'top' : '-25px' }, 250, 'easeOutExpo');
	}, function() {
		var $this = $(this);
		$this.find('span.icon-color').stop().animate( { 'top' : '25px' }, 250, 'easeOutExpo');
		$this.find('span.icon').stop().animate( { 'top' : '0px' }, 250, 'easeOutExpo');
	});

	$('body').on('mouseenter', 'div.portfolio.no-flip .mpc-card', function() {
		var $this = $(this);
		$this.find('.back').css( { 'visibility': 'visible' });
		$this.find('.front').stop().animate( { 'opacity' : 0 }, 1000, 'easeOutExpo' );
		$this.find('.back').stop().animate( { 'opacity' : 1 }, 1000, 'easeOutExpo' );
	});
	$('body').on('mouseleave', 'div.portfolio.no-flip .mpc-card', function() {
		var $this = $(this);
		if($.browser.msie && jQuery.browser.version.substring(0, 2) == "8.") {
			$this.find('.back').css( { 'visibility': 'hidden' });
			$this.find('.front').stop().css( { 'opacity' : 1 });
		}
		$this.find('.front').stop().animate( { 'opacity' : 1 }, 1000, 'easeOutExpo' );
		$this.find('.back').stop().animate( { 'opacity' : 0 }, 1000, 'easeOutExpo', function() {
			$this.find('.back').css( { 'visibility': 'hidden' });
		});
	});

	if($.browser.opera) { $('.mpc-viniet').css( { 'visibility' : 'hidden' } ); }

	if($('html').is('.ie') || $.browser.opera) {
		if(!$('.portfolio').hasClass('no-flip')) {

			$('.portfolio-item').each(function() {
				$this = $(this);

				$this.find('.front.face').css({
					'opacity' : 1,
					'z-index' : 1
				});
				$this.find('.back.face').css({
					'opacity' : 0,
					'z-index' : 0
				});
			});

			$('.portfolio-item').hover(function() {
				$this = $(this);
				$this.find('.front.face').stop().animate( { 'opacity' : 0 }, function() {
					$(this).css( { 'z-index' : 0 });
				});
				$this.find('.back.face').stop().animate( { 'opacity' : 1 }, function() {
					$(this).css( { 'z-index' : 1 });
				});
			}, function() {
				$this = $(this);
				$this.find('.front.face').stop().animate( { 'opacity' : 1 }, function() {
					$(this).css( { 'z-index' : 1 });
				});
				$this.find('.back.face').stop().animate( { 'opacity' : 0 }, function() {
					$(this).css( { 'z-index' : 0 });
				});
			})
		}
	}

	/* ---------------------------------------------------------------- */
	/* Blog Isotope
	/* ---------------------------------------------------------------- */

	var $blog_container = $('.posts-container.blog'),
		$window = $(window),
		window_width = 0,
		blog_columns = 1;

	$window.load(function() {
		window_width = $window.width();
		blog_columns = blog_columns_num(window_width);

		if(window_width > 600) {
			$blog_container.isotope({
				resizable: false,
				masonry: {
					columnWidth: $blog_container.children('.post').first().outerWidth() >> 0
				}
			});
		}

		$window.on('resize', function() {
			window_width = $window.width();
			blog_columns = blog_columns_num(window_width);

			if(window_width > 600) {
				$blog_container.isotope({
					resizable: false,
					masonry: {
						columnWidth: $blog_container.children('.post').first().outerWidth() >> 0
					}
				});
			} else {
				if($blog_container.is('.isotope')) {
					$blog_container.isotope('destroy');
				}
			}
		});
	});

	function blog_columns_num(window_width) {
		var columns_num = 1;

		if(window_width > 1679)
			columns_num = 4;
		else if(window_width > 1280)
			columns_num = 3;
		else if(window_width > 768)
			columns_num = 2;
		else
			columns_num = 1;

		return columns_num;
	}

	/* ---------------------------------------------------------------- */
	/* Portfolio Categories Filter
	/* ---------------------------------------------------------------- */

	var $categories = $('.mpc-portfolio-categories ul li a'),
		$portfolio_items = $('.portfolio-content .portfolio-item'),
		$portfolio_content = $('.portfolio-content');

	$categories.on('click', function(e) {
		e.preventDefault();

		var $this = $(this),
			filter = $this.attr('data-link'),
			duration = 300;

		if($this.hasClass('active'))
			return;

		$categories.removeClass('active');
		$this.addClass('active');

		if(filter == 'all')
			filter = 'portfolio-item';

		$portfolio_content.stop(true, true).fadeOut(duration, function() {
			$portfolio_items.filter(':not(.' + filter + ')').hide();
			$portfolio_items.filter('.' + filter).show();
			$portfolio_content.fadeIn(duration);
		});
	});

	/* ---------------------------------------------------------------- */
	/* Load More
	/* ---------------------------------------------------------------- */

	var $load_more = $('#mpc_load_more'),
		$load_more_wrap = $('#mpcth_load_info'),
		current_page = 2,
		load_more_msg = $load_more.text(),
		loading_msg = $load_more.attr('data-loading'),
		all_posts = $load_more_wrap.attr('data-all-posts'),
		max_pages = $load_more_wrap.attr('data-max-pages'),
		next_posts_url = $load_more_wrap.attr('data-next-url'),
		is_blog = $('.posts-container').is('.blog'),
		item_class = is_blog ? ' .blog-post' : ' .portfolio-item';

	if(current_page > max_pages)
		$load_more.hide();
	else
		$load_more.one('click', init_load_more);

	function init_load_more(e) {
		e.preventDefault();

		$load_more.text(loading_msg);

		$load_more_wrap.load(
			next_posts_url + item_class,
			function(data) {
				var $posts = $load_more_wrap.children(item_class);

				if(is_blog) {
					$posts.hide().appendTo($blog_container).fadeIn();

					$blog_container.isotope('addItems', $posts);
					$window.trigger('resize');
				} else {
					var filter = $categories.filter('.active').attr('data-link');

					if(filter == 'all')
						$posts.hide().appendTo($portfolio_content).fadeIn();
					else
						$posts.hide().appendTo($portfolio_content).filter('.' + filter).fadeIn();

					$portfolio_items = $('.portfolio-content .portfolio-item');
				}

				$load_more.text(load_more_msg);

				$load_more.one('click', init_load_more);
			}
		);

        current_page++;
        
		if(current_page > max_pages) {
			$load_more.fadeOut();
		} else {
			if(next_posts_url.indexOf('page/') != -1) {
				next_posts_url = next_posts_url.replace(/page\/[0-9]+\//, 'page/' + current_page + '/');
			} else {
				next_posts_url = next_posts_url.replace(/paged=[0-9]+/, 'paged=' + current_page);
                console.log('f');
			}
		}

	}

	/*-----------------------------------------------------------------------------------*/
	/*	Read More hover
	/*-----------------------------------------------------------------------------------*/

	$('.mpc-read-more').hover(function(e){
		var $this = $(this);
		$this.find('.plus-white').stop().animate( { 'top' : '-16px' }, 300, 'easeOutExpo');
		$this.find('.plus-hover').stop().animate( { 'top' : '-21px' }, 300, 'easeOutExpo');
	}, function(e){
		var $this = $(this);
		$this.find('.plus-white').stop().animate( { 'top' : '-0px' }, 300, 'easeOutExpo');
		$this.find('.plus-hover').stop().animate( { 'top' : '-5px' }, 300, 'easeOutExpo');
	});

	/*-----------------------------------------------------------------------------------*/
	/*	Helper Functions
	/*-----------------------------------------------------------------------------------*/

	function get_blog_item_dimentions() {
		blogMinWidth = parseInt($('.blog-post:first-child').css('min-width'));

		var wWidth = $(window).width(),
			corrector = 0;

		for(var i = 10; i > 0; i--){
			corrector = (i + 1) * 20 + i * 40;
			if((wWidth - corrector) / i > (blogMinWidth)){
				blogItemWidth = Math.ceil((wWidth - corrector) / i);
				blogColNum = i;
				return;
			}
		}
	}


	function get_item_dimentions() {
		minWidth = parseInt($('.portfolio-item:first-child').css('min-width'));

		var wWidth = $(window).width();

		for(var i = 10; i > 0; i--){
			if(wWidth / i > minWidth){
				itemWidth = Math.ceil(wWidth / i);
				colNum = i;
				return;
			}
		}
	}

	function set_item_dimentions(){
		var row = 0,
			index = 0,
			itemNumber = 1;
			heightRow = 0;

		$('.portfolio-content').find('.portfolio-item .front img').each(function() {
			var $this = $(this),
				height = Math.ceil( (itemWidth / $this.width() ) * $this.height() );

			if(itemNumber > folioItemNumber) {
				$this.parents('.portfolio-item').css({'display' : 'none'});
				loadMore = true;
			}

			if($this.parents('.portfolio-item').hasClass('remove-item')) {
				return true;
			}

			if(index % colNum== 0 && index != 0) {
				index = 0;
				row++;
			}

			if(itemNumber <= folioItemNumber) {
				heightRow = row;
			}

			$this.animate({
				'height' : height + 'px',
				'width' : itemWidth + 'px'
			}, 1000, 'easeOutExpo');


			$this.parents('.portfolio-item, .portfolio-item-thumb').animate({
				'height' : height + 'px',
				'width' : itemWidth + 'px',
				'top' : (height * row) - row + 'px',
				'left' : itemWidth * index  + 'px'
			}, 1000, 'easeOutExpo');

			if(itemNumber <= folioItemNumber)
				$this.parents('.portfolio-item').fadeIn(500, 'easeOutExpo');

			var ratio = 0.6;

			if(height < 430) ratio = 0.7;
			if(height < 300) ratio = 0.55;
			if(height < 280) ratio = 0.5;
			if(height < 230) ratio = 0.4;
			if(height < 200) ratio = 0.3;

			$this.parents('.portfolio-item').find('p.mpc-excerpt').css({ 'height' : Math.floor((height * ratio) / 21) * 21 + 'px'});
			index++;
			itemNumber++;
		});

		height = Math.ceil(( (itemWidth / $('.portfolio-item').find('img').width() ) * $('.portfolio-item').find('img').height() ));

		$('div.portfolio').animate({ 'opacity' : 1 }, 2000, 'easeOutExpo');
		$('div.portfolio-content').animate({
			'height' : (height * (heightRow + 1) - heightRow) + 'px',
			'opacity' : 1
		}, 1000, 'easeOutExpo', function() {
			if(firstRun){
				$data = $(".portfolio-content").clone(true, true);
				firstRun = false;
			}
		});
	}

	function show_additional_items(){
		var row = 0,
			index = 0,
			itemNumber = 1;

			folioItemNumber += folioItemRatio;

		$('.portfolio-content').find('.portfolio-item').each(function() {
			$this = $(this);
			if(itemNumber <= folioItemNumber) {
				loadMore = false;
				$this.fadeIn(500, 'easeOutExpo');
				if(index % colNum == 0 && index != 0) {
					index = 0;
					row++;
				}
			} else {
				loadMore = true;
				$this.css({'display' : 'none'});
			}
			index++;
			itemNumber++;
		});

		$('div.portfolio-content').animate({
			'height' : (height * (row + 1) - row) + 'px',
			'opacity' : 1
		}, 1000, 'easeOutExpo');
	}

	function set_blog_item_dimentions(){
		var row = 0,
			index = 0,
			count = $('.posts-container').find('.blog-post').length,
			k = 0,
			pos = 0;

		$('.posts-container').find('.post-thumbnail').each(function() {
			var $this = $(this),
				imageWidth = blogItemWidth,
				height = Math.ceil( (imageWidth / $this.find('img').width() ) * $this.find('img').height() ),
				dad;

			if(index % blogColNum== 0 && index != 0) {
				index = 0;
				row++;
			}
			$this.find(' > img').css({
				'height' : height + 'px',
				'width' : imageWidth + 'px'
			});

			if(row > 0){
				dad = $this.parents('.blog-post');
				for( var i = 0; i < blogColNum; i++){
					dad = dad.prev();
				}
			}

			$this.parents('.blog-post').css({
				'width' : blogItemWidth + 'px',
				'top' : (dad != undefined) ? parseInt(dad.css('top')) + dad.outerHeight() + 25 + 'px' : '0px',
				'left' : (blogItemWidth + 40) * index + (20 * index)  + 'px'
			});

			$this.find('iframe').css({
				'min-height' : $this.parents('.blog-post').width() * 0.56,
				'height' : 'auto'
			});

			if(count - blogColNum <= k){
				if( pos < parseInt($this.parents('.blog-post').css('top')) + $this.parents('.blog-post').outerHeight() + 25)
					pos = parseInt($this.parents('.blog-post').css('top')) + $this.parents('.blog-post').outerHeight() + 25;
			}

			k++;
			index++;
		});

		$('.mpc-fix').css({'top' : pos });

		if(firstRunBlog) {
			var timer = setInterval(function() {
			  $('.blog').animate( { 'opacity': 1 }, 1000, 'easeOutExpo' );
			  clearInterval(timer);
			  firstRunBlog = false;
			}, 100);
		}

	}
});
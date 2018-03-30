var $j = jQuery.noConflict();

/* jquery.imagefit 
 *
 * Version 0.2 by Oliver Boermans <http://www.ollicle.com/eg/jquery/imagefit/>
 *
 * Extends jQuery <http://jquery.com>
 *
 */
(function($) {
	$.fn.imagefit = function(options) {
		var fit = {
			all : function(imgs){
				imgs.each(function(){
					fit.one(this);
					})
				},
			one : function(img){
				$(img)
					.width('100%').each(function()
					{
						$(this).height(Math.round(
							$(this).attr('startheight')*($(this).width()/$(this).attr('startwidth')))
						);
					})
				}
		};
		
		this.each(function(){
				var container = this;
				
				// store list of contained images (excluding those in tables)
				var imgs = $('img', container).not($("table img"));
				
				// store initial dimensions on each image 
				imgs.each(function(){
					$(this).attr('startwidth', $(this).width())
						.attr('startheight', $(this).height())
						.css('max-width', $(this).attr('startwidth')+"px");
				
					fit.one(this);
				});
				// Re-adjust when window width is changed
				$(window).bind('resize', function(){
					fit.all(imgs);
				});
			});
		return this;
	};
})(jQuery);

jQuery.fn.center = function ()
{
    this.css("left", (jQuery(window).width() / 2) - (this.outerWidth() / 2));
    return this;
}

function adjustIframes()
{
  $j('iframe').each(function(){
  
    var
    $this       = $j(this),
    proportion  = $this.data( 'proportion' ),
    w           = $this.attr('width'),
    actual_w    = $this.width();
    
    if ( ! proportion )
    {
        proportion = $this.attr('height') / w;
        $this.data( 'proportion', proportion );
    }
  
    if ( actual_w != w )
    {
        $this.css( 'height', Math.round( actual_w * proportion ) + 'px !important' );
    }
  });
}

$j.fn.setNav = function(){
	var calScreenWidth = $j(window).width();
	
	if(calScreenWidth >= 960)
	{
		$j('#menu_border_wrapper').css({display: 'block'});
		$j('#main_menu li ul').css({display: 'none', opacity: 1});
	
		$j('#main_menu li').each(function()
		{	
			var $jsublist = $j(this).find('ul:first');
			
			$j(this).hover(function()
			{	
				position = $j(this).position();
				
				if($j(this).parents().attr('class') == 'sub-menu')
				{	
					$jsublist.stop().css({height:'auto', display:'none'}).fadeIn(200);
				}
				else
				{
					var parentWidth = $jsublist.parent('li').width();
					$jsublist.stop().css({overflow: 'visible', height:'auto', display:'none', marginLeft: -((230/2)-(parentWidth/2))+4+'px'}).fadeIn(200);
					
					if(BrowserDetect.browser == 'Explorer' && BrowserDetect.version < 8)
	 				{
	 					hackMargin = -$j(this).width()-2;
						$jsublist.css({marginLeft: hackMargin+'px'});
					}
				}
			},
			function()
			{	
				$jsublist.stop().css({height:'auto', display:'none'}).hide(200);	
			});
	
		});
		
		$j('#menu_wrapper .nav ul li ul').css({display: 'none', opacity: 1});
	
		$j('#menu_wrapper .nav ul li').each(function()
		{
			
			var $jsublist = $j(this).find('ul:first');
			
			$j(this).hover(function()
			{	
				$jsublist.stop().css({height:'auto', display:'none'}).fadeIn(200);	
			},
			function()
			{	
				$jsublist.stop().css({height:'auto', display:'none'}).hide(200);	
			});		
			
		});
	}
}

$j(document).ready(function(){ 

	$j(document).setNav();
	
	$j(window).resize(function(){
		$j(document).setNav();
	});

	$j('.pp_gallery a').fancybox({ 
		padding: 0,
		openEffect 	: 'fade',
		closeEffect : 'fade',
		prevEffect	: 'elastic',
		nextEffect	: 'elastic',
		helpers	: {
			title	: {
				type: 'outside'
			},
			overlay	: {
				css : {
					'background' : 'rgba(0, 0, 0, 0.9)'
				}
			}
		}
	});
	
	$j('.flickr li a').fancybox({ 
		padding: 0,
		openEffect 	: 'fade',
		closeEffect : 'fade',
		prevEffect	: 'elastic',
		nextEffect	: 'elastic',
		helpers	: {
			title	: {
				type: 'outside'
			},
			overlay	: {
				css : {
					'background' : 'rgba(0, 0, 0, 0.9)'
				}
			}
		}
	});
	
	$j('a.fancy-gallery').fancybox({
		padding : 0,
		openEffect 	: 'fade',
		closeEffect : 'fade',
		prevEffect	: 'elastic',
		nextEffect	: 'elastic',
		beforeLoad: function() {
			$j('body').addClass('notouch');
            this.title = $j(this.element).attr('data-title');
        },
        beforeClose: function() {
			$j('body').removeClass('notouch');
        }
	});
	
	$j('.img_frame').fancybox({ 
		padding: 0,
		openEffect 	: 'fade',
		closeEffect : 'fade',
		prevEffect	: 'elastic',
		nextEffect	: 'elastic',
		helpers	: {
			title	: {
				type: 'outside'
			},
			overlay	: {
				css : {
					'background' : 'rgba(0, 0, 0, 0.9)'
				}
			}
		}
	});
	
	$j('.lightbox_youtube').fancybox({ 
		padding: 0,
		openEffect 	: 'fade',
		closeEffect : 'fade',
		prevEffect	: 'elastic',
		nextEffect	: 'elastic',
		helpers	: {
			title	: {
				type: 'outside'
			},
			overlay	: {
				css : {
					'background' : 'rgba(0, 0, 0, 0.9)'
				}
			}
		},
		beforeLoad: function() {
            this.title = $j(this.element).attr('data-title');
        }
	});
	
	$j('.lightbox_vimeo').fancybox({ 
		padding: 0,
		openEffect 	: 'fade',
		closeEffect : 'fade',
		prevEffect	: 'elastic',
		nextEffect	: 'elastic',
		helpers	: {
			title	: {
				type: 'outside'
			},
			overlay	: {
				css : {
					'background' : 'rgba(0, 0, 0, 0.9)'
				}
			}
		},
		beforeLoad: function() {
            this.title = $j(this.element).attr('data-title');
        }
	});
	
	var calScreenHeight = $j(window).height()-108;
	var miniRightPos = 800;
      
    var cols = 3
	var masonry = $j('.gallery_mansory_wrapper');
	
	// initialize masonry
	masonry.imagesLoaded(function(){
	    
	    masonry.masonry({
	    	itemSelector: '.mansory_thumbnail',
	    	isResizable: true,
	    	isAnimated: true,
	    	isFitWidth: true,
	    	columnWidth:Math.floor((masonry.width()/ cols))
	      });
	      
	     masonry.children('.mansory_thumbnail').children('.gallery_type').each(function(){
		    $j(this).addClass('fade-in');
	    });
	});
	
	$j(window).resize(function(){
		var masonry = $j('.gallery_mansory_wrapper');
		
	    masonry.imagesLoaded(function(){
	    
		    masonry.masonry({
		    	itemSelector: '.mansory_thumbnail',
		    	isResizable: true,
		    	isAnimated: true,
		    	isFitWidth: true,
		    	columnWidth:Math.floor((masonry.width()/ cols))
		      });
		      
		     masonry.children('.mansory_thumbnail').children('.gallery_type').each(function(){
			    $j(this).addClass('fade-in');
		    });
		});
	});
    
    $j('#menu_expand_wrapper a').click(function(){
    	$j('#menu_wrapper').fadeIn();
	    $j('#custom_logo').animate({'left': '15px', 'opacity': 1}, 400);
	    $j('#menu_close').animate({'left': '-10px', 'opacity': 1}, 400);
	    $j(this).animate({'left': '-60px', 'opacity': 0}, 400);
	    $j('#menu_border_wrapper select').animate({'left': '0', 'opacity': 1}, 400).fadeIn();
    });
	
	$j('#menu_close').click(function(){
		$j('#custom_logo').animate({'left': '-200px', 'opacity': 0}, 400);
	    $j(this).stop().animate({'left': '-200px', 'opacity': 0}, 400);
	    $j('#menu_expand_wrapper a').animate({'left': '20px', 'opacity': 1}, 400);
	    $j('#menu_border_wrapper select').animate({'left': '-200px', 'opacity': 0}, 400).fadeOut();
	    $j('#menu_wrapper').fadeOut();
	});
	
	var footerLi = 0;
	$j('#footer .sidebar_widget li.widget').each(function()
	{
		footerLi++;
		
		if(footerLi%$j('#pp_footer_style').val() == 0)
		{ 
			$j(this).addClass('last');
		}
	});
	
	// Isotope
	// modified Isotope methods for gutters in masonry
	jQuery.Isotope.prototype._getMasonryGutterColumns = function() {
	    var gutter = this.options.masonry && this.options.masonry.gutterWidth || 0;
	    	containerWidth = this.element.width();
  
	this.masonry.columnWidth = this.options.masonry && this.options.masonry.columnWidth ||
              // or use the size of the first item
              this.$filteredAtoms.outerWidth(true) ||
              // if there's no items, use size of container
              containerWidth;

	this.masonry.columnWidth += gutter;

	this.masonry.cols = Math.floor( ( containerWidth + gutter ) / this.masonry.columnWidth );
	this.masonry.cols = Math.max( this.masonry.cols, 1 );
	};

	jQuery.Isotope.prototype._masonryReset = function() {
	    // layout-specific props
	    this.masonry = {};
	    // FIXME shouldn't have to call this again
	    this._getMasonryGutterColumns();
	    var i = this.masonry.cols;
	    this.masonry.colYs = [];
	    while (i--) {
	    	this.masonry.colYs.push( 0 );
	    }
	};

	jQuery.Isotope.prototype._masonryResizeChanged = function() {
	    var prevSegments = this.masonry.cols;
	    // update cols/rows
	    this._getMasonryGutterColumns();
	    // return if updated cols/rows is not equal to previous
	    return ( this.masonry.cols !== prevSegments );
	};
  
	// cache jQuery window
	var $window = jQuery(window);
	
	// filter items when filter link is clicked
	$j('#portfolio_filters li a').click(function(){
	  	var selector = $j(this).attr('data-filter');
	  	$container.isotope({ filter: selector });
	  	$j('#portfolio_filters li a').removeClass('active');
	  	$j(this).addClass('active');
	  	return false;
	});
	
	
	$j('.portfolio_filters li a').click(function(){
	  	var selector = $j(this).attr('data-filter');
	  	var target = $j(this).attr('data-target');
	  	
	  	$j('#'+target).isotope({ filter: selector });
	  	$j('.portfolio_filters li a').removeClass('active');
	  	$j(this).addClass('active');
	  	return false;
	});
	
	var $container = jQuery('#photo_wall_wrapper');
	
	// start up isotope with default settings
	$container.imagesLoaded( function(){
	    reLayout();
	    $window.smartresize( reLayout );
	    
	    $container.children('.wall_entry').children('.gallery_type').each(function(){
		    $j(this).addClass('fade-in');
	    });
	});
	
	function reLayout() {
		var columnCount = $j('#pp_wall_columns').val();
	
		if(jQuery.type(columnCount) === "undefined")
		{
			var columnCount = 3;
		}

	    masonryOpts = {
		  columnWidth: $container.width() / columnCount
		};
		
		$container.addClass('visible');

	    $container.isotope({
	      resizable: false, // disable resizing by default, we'll trigger it manually
	      itemSelector : '.wall_entry',
	      masonry: masonryOpts
	    }).isotope( 'reLayout' );

	}
	
	$j(window).resize(function() {
		if($j(this).width() < 768)
		{
			$j('#menu_expand_wrapper a').trigger('click');
		}
	});
	
	var isDisableRightClick = $j('#pp_enable_right_click').val();
	
	if(isDisableRightClick!='')
	{
		$j(this).bind("contextmenu", function(e) {
	    	e.preventDefault();
	    });
	}
	
	function rePortfolioLayout() {
	
		var windowWidth = $j(window).width();
		var $jcontainer = $j('#portfolio_filter_wrapper');
		var $jportfolioColumn = $j('#pp_portfolio_columns').attr('value');
		if(jQuery.type($jportfolioColumn) === "undefined")
		{
			var $jportfolioColumn = $j('#pp_wall_columns').attr('value');
		}
		var columnValue = 0;
		
		if(windowWidth > 959)
		{
			columnValue = 980 / $jportfolioColumn;
		}
		else if(windowWidth < 959 && windowWidth > 767)
		{
			columnValue = 726 / $jportfolioColumn;
		}
		else if(windowWidth < 480)
		{
			columnValue = 480;
		}
		
		//alert(columnValue);
	    masonryOpts = {
		  columnWidth: columnValue
		};

	    $jcontainer.isotope({
	      resizable: false, // disable resizing by default, we'll trigger it manually
	      itemSelector : '.element',
	      masonry: masonryOpts
	    } ).isotope();

	}
	
	// cache jQuery window
	var $window = jQuery(window);
  
	// cache container
	var $jcontainer = $j('#portfolio_filter_wrapper');
	
	// start up isotope with default settings
	$jcontainer.imagesLoaded( function(){
	    rePortfolioLayout();
	    $window.smartresize( rePortfolioLayout );
	    
	    $jcontainer.children('.element').children('.gallery_type').each(function(){
		    $j(this).addClass('fadeIn');
	    });
	    
	    $jcontainer.children('.element').children('.portfolio_type').each(function(){
		    $j(this).addClass('fadeIn');
	    });
	});
	
	// filter items when filter link is clicked
	$j('#portfolio_filters li a').click(function(){
	  	var selector = $j(this).attr('data-filter');
	  	$jcontainer.isotope({ filter: selector });
	  	$j('#portfolio_filters li a').removeClass('active');
	  	$j(this).addClass('active');
	  	return false;
	});
	
	function reBlogLayout() {
		var windowWidth = $j(window).width();
		var $jblogcontainer = $j('#blog_grid_wrapper');
		var $blogGridColumn = 3;
		var columnValue = 0;
		if(windowWidth >= 960)
		{
			columnValue = 1000 / $blogGridColumn;
		}
		else if(windowWidth < 960 && windowWidth >= 768)
		{
			columnValue = 740 / $blogGridColumn;
		}
		else
		{
			columnValue = windowWidth/1;
		}

		//alert(columnValue);
	    masonryOpts = {
		  columnWidth: columnValue
		};

	    $jblogcontainer.isotope({
	      resizable: false, // disable resizing by default, we'll trigger it manually
	      itemSelector : '.status-publish',
	      masonry: masonryOpts
	    } ).isotope();
	}
	
	var $jblogcontainer = $j('#blog_grid_wrapper');
	
	$jblogcontainer.imagesLoaded( function(){
	    reBlogLayout();
	    $window.smartresize( reBlogLayout );
	});
	
	var $jgalleriescontainer = $j('#galleries_grid_wrapper');
	
	$jgalleriescontainer.imagesLoaded( function(){
	    var columnCount = 3;
	
	    masonryOpts = {
		  columnWidth: $jgalleriescontainer.width() / columnCount
		};

	    $jgalleriescontainer.isotope({
	      resizable: false,
	      itemSelector : '.galleries.type-galleries',
	      masonry: masonryOpts
	    }).isotope();
	});
    
    jQuery('body[data-style=fullscreen] #wrapper').touchwipe({
    	wipeLeft: function(){ 
        	api.nextSlide();
      	},
       	wipeRight: function(){ 
           	api.prevSlide();
       	}
    });
    
    //Add to top button when scrolling
    $j(window).scroll(function() {
	 	var calScreenWidth = $j(window).width();
		
		if($j(this).scrollTop() > 200) {
		    $j('#toTop').stop().css({opacity: 0.3, "visibility": "visible"}).animate({"visibility": "visible", "bottom": "-5px"}, {duration:1000,easing:"easeOutExpo"});
		} else if($j(this).scrollTop() == 0) {
		    $j('#toTop').stop().css({opacity: 0, "visibility": "hidden"}).animate({"bottom": "0px", "visibility": "hidden"}, {duration:1500,easing:"easeOutExpo"});
		}
	});
 
	$j('#toTop, .hr_totop').click(function() {
		$j('body,html').animate({scrollTop:0},800);
	});
	
	var isDisableDragging = $j('#pp_enable_dragging').val();
	
	if(isDisableDragging!='')
	{
		$j("img").mousedown(function(){
		    return false;
		});
	}
	
	$j(window).scroll(function(){
		if($j(this).scrollTop() >= 100){
			$j('.header_style_wrapper').addClass('fixed');
			$j('.top_bar').addClass('fixed');
	    }
	    else if($j(this).scrollTop() < 100)
	    {
	    	$j('.header_style_wrapper').removeClass('fixed');
		    $j('.top_bar').removeClass('fixed');
	    }
	});
	
	$j('.post_img a img').imagesLoaded(function(){
		$j(this).parent('a').parent('.post_img').addClass('fadeIn');
	});
	
	$j('.post_img img').imagesLoaded(function(){
		$j(this).parent('.post_img').addClass('fadeIn');
	});
	
	$j(document).mouseenter(function()
	{	
	    $j('body').addClass('hover');	
	});	
	
	$j(document).mouseleave(function()
	{	
	    $j('body').removeClass('hover');	
	});	
	
	$j('#slidecaption').center();
	$j(window).resize(function(){
	   $j('#slidecaption').center();
	});
	
	$j('#flow_view_button').click(function(){
		$j('#imageFlow_gallery_info').stop().animate({"left": "-370px", "height": $j(window).height()+"px"}, {duration:1000,easing:"easeOutExpo"});
		$j('#flow_info_button').fadeIn();
	});
	
	$j('#flow_info_button').click(function(){
		$j('#flow_info_button').hide();
		$j('#imageFlow_gallery_info').stop().animate({"left": "0", "height": $j(window).height()+"px"}, {duration:1000,easing:"easeOutExpo"});
	});
	
	/*var isHideGalleryInfo = $j('#pp_gallery_auto_info').val();

	if(isHideGalleryInfo=='')
	{
		setTimeout(function() {
			$j('#flow_view_button').click();
		}, 1000);
	}*/
	
	$j('.top_bar #searchform button').click(function(e)
	{
		e.preventDefault();
		$j('#menu_border_wrapper').toggle();
		$j('#searchform label').toggleClass('visible');
		$j('.top_bar #searchform input').toggle();
	    $j('.top_bar #searchform input').focus();
	});
	
	var siteBaseURL = $j('#pp_homepage_url').val();
	if($j('#pp_ajax_search').val() != '')
    {
		$j('#s').on('input', function() {
			$j.ajax({
				url:siteBaseURL+"/wp-admin/admin-ajax.php",
				type:'POST',
				data:'action=pp_ajax_search&s='+$j('#s').val(),
				success:function(results) {
					$j("#autocomplete").html(results);
					
					if(results != '')
					{
						$j("#autocomplete").addClass('visible');
						$j("#autocomplete").show();
					}
					else
					{
						$j("#autocomplete").hide();
					}
				}
			})
		});
		
		$j("#s").keypress(function(event) {
		    if (event.which == 13) {
		        event.preventDefault();
		        $j("form#searchform").submit();
		    }
		});
		
		$j('#s').focus(function(){
			if ($j('#autocomplete').html() != ''){
				$j("#autocomplete").addClass('visible');
				$j("#autocomplete").fadeIn();
			}
		});
		
		$j('#s').blur(function(){
	      $j("#autocomplete").fadeOut();
		});
	}
	
	$j('#wrapper').waypoint(function(direction) {
		$j('#post_more_wrapper').toggleClass('hiding', direction === "up");
	}, {
		offset: function() {
			return $j.waypoints('viewportHeight') - $j(this).height() + 100;
		}
	});
	
	$j('.animated').imagesLoaded(function() {
		$j(this).waypoint(function(direction) {
			var animationClass = $j(this).data('animation');
		
			$j(this).addClass(animationClass, direction === 'down');
			
		} , { offset: '80%' });
	});
	
	$j('#post_more_close').click(function(){
		$j('#post_more_wrapper').animate({ right: '-380px' }, 300);
		
		return false;
	});
	
	$j('div[data-type="background"]').each(function(){
        var bgobj = $j(this);
     
        $j(window).scroll(function() {
            var yPos = -($j(window).scrollTop() / bgobj.data('speed')); 
             
            var coords = '50% '+ yPos + 'px';
 
            bgobj.css({ backgroundPosition: coords });
        }); 
    });
	
	$j('#mobile_nav_icon').click(function() {
		$j('body,html').animate({scrollTop:0},100);
		$j('body').toggleClass('js_nav');
	});
	
	$j('.mobile_menu_close a').click(function() {
		$j('body').removeClass('js_nav');
	});
	
	$j('input[title!=""]').hint();
	
	$j('.close_alert').click(function() {
		var target = $j(this).data('target');
		$j('#'+target).fadeOut();
	});
	
	$j('.progress_bar').waypoint(function(direction) {
		$j(this).addClass('fadeIn');
		var progressContent = $j(this).children('.progress_bar_content');
        var progressWidth = progressContent.data('score');
     
        progressContent.css({'width': progressWidth+'%'});
	} , { offset: '80%' });
	
	$j('#option_btn').click(
    	function() {
    		if($j('#option_wrapper').css('left') != '0px')
    		{
 				$j('#option_wrapper').animate({"left": "0px"}, { duration: 500 });
	 			$j(this).animate({"left": "200px"}, { duration: 500 });
	 		}
	 		else
	 		{
	 			$j('#option_wrapper').animate({"left": "-210px"}, { duration: 500 });
    			$j('#option_btn').animate({"left": "-2px"}, { duration: 500 });
	 		}
    	}
    );
    
    $j('#pp_layout').change(function() {
		$j("form#form_option").submit();
	});
});

$j(window).on('resize load',adjustIframes);
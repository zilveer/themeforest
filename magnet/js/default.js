var $j = jQuery.noConflict();

var on_change = true;
var size1 = true;
var size2 = true;
var size3 = true;
var size4 = true;
var size1_width = 1166;
var size2_width = 934;
var size3_width = 500;

$j(document).ready(function() {
		
		dropDownMenu();		
		
		sliderInit();

		initAccordion();

		initMessages();

		initTestimonials();

		placeholderReplace();

		initProgressBars();
		
		selectMenu();

		initFlexSlider();
		
		fitVideo();
		
		backButtonInterval();
		backToTop();
		
		checkForIpad();
		
		startPulseScrollTeaser();
		
		initParallax(parallax_speed);
		
		parallaxPager();
		
		viewPort();
		
		stylishSelectContent();
});


$j(window).load(function(){
	magicPanes();
	initPortfolioSingleInfo();
	initPortfolioList();
	initPortfolioFilter();
	checkSizes();
	initTabs();
	
	$width = $j(window).width();
	if($width > size1_width) size1 = false;
	else size2 = false ;
	
	$j('.flexslider').css('visibility','visible');
});

$j(window).resize(function(){
	checkSizes();
	sliderImageHeightUpdate();
	magicPanes();
	
});

$j(window).scroll(function(){
	stopPulseScrollTeaserVertical();
	
});

function checkSizes(){
	$width = $j(window).width();
	if($width > size1_width && size1 == true){
		size2 = true;
		size3 = true;
		size4 = true;
		size1 = false;
		sliderRewind();
		sliderCheckControl();
		$j('.big-slider-slide .image img, .portfolio_holder article .image img').css('max-width','none').css('transform','none').css('transition','none');
		$j('.portfolio_holder').isotope('reLayout');
		sliderImageHovers();
	}
	
	if($width < size1_width && size2 == true){
		size1 = true;
		size3 = true;
		size4 = true;
		size2 = false;
		sliderRewind();
		sliderCheckControl();
		$j('.big-slider-slide .image, .portfolio_holder article .image').stop(true).unbind();
		$j('.big-slider-slide .image img, .portfolio_holder article .image img').stop(true).unbind();
		$j('.big-slider-slide .image img, .portfolio_holder article .image img').removeAttr('style');
		$j('.portfolio_holder').isotope('reLayout');
	}
	
	
	if($width < size2_width && size3 == true){
		size1 = true;
		size2 = true;
		size4 = true;
		size3 = false;
		sliderRewind();
		sliderCheckControl();
		$j('.big-slider-slide .image, .portfolio_holder article .image').stop(true).unbind();
		$j('.big-slider-slide .image img, .portfolio_holder article .image img').stop(true).unbind();
		$j('.big-slider-slide .image img, .portfolio_holder article .image img').removeAttr('style');
		$j('.portfolio_holder').isotope( 'reLayout');
	}
	
	if($width < size3_width && size4 == true){
		size1 = true;
		size2 = true;
		size3 = true;
		size4 = false;
		sliderRewind();
		sliderCheckControl();
		$j('.big-slider-slide .image, .portfolio_holder article .image').stop(true).unbind();
		$j('.big-slider-slide .image img, .portfolio_holder article .image img').stop(true).unbind();
		$j('.big-slider-slide .image img, .portfolio_holder article .image img').removeAttr('style');
		$j('.portfolio_holder').isotope('reLayout');
	}
}

function dropDownMenu(){
	var menu_items = $j('.drop_down > ul > li');

	menu_items.each( function(i) {
		if ($j(menu_items[i]).find('.second').length > 0) {
		
			//$j(menu_items[i]).data('original_height', $j(menu_items[i]).find('.second').height() + 'px');
			$j(menu_items[i]).find('.second').hide();
			
			var size = $j(menu_items[i]).find('ul > li').size()*10 + 100;
			$j(menu_items[i]).mouseenter(function(){
				$j(menu_items[i]).find('.second').css({'visibility': 'visible','height': '0px', 'opacity': '0'});
				$j(menu_items[i]).find('.second').css('display', 'block');
				$j(menu_items[i]).find('.second').stop().animate({'height': $j(menu_items[i]).find('.inner').height() + 'px',opacity:1}, size, function() {
					$j(menu_items[i]).find('.second').css('overflow', 'visible');
					
				});
				dropDownMenuThirdLevel();
			}).mouseleave( function(){
				$j(menu_items[i]).find('.second').stop().animate({'height': '0px'},0, function() {
					$j(menu_items[i]).find('.second').css('overflow', 'hidden');
					$j(menu_items[i]).find('.second').css('visivility', 'hidden');
					
				});
			});
		}

	});
}

function dropDownMenuThirdLevel(){
	var menu_items2 = $j('.drop_down ul li > .second > .inner > .inner2 > ul > li');
	menu_items2.each( function(i) {
		if ($j(menu_items2[i]).find('ul').length > 0) {
			var sum=0;
			$j(menu_items2[i]).find('ul li').each( function(){ sum+=$j(this).height();});
			
			$j(menu_items2[i]).data('original_height', sum + 'px');
			
			var size2 = $j(menu_items2[i]).find('ul > li').size()*10 + 100;
			$j(menu_items2[i]).mouseenter(function(){
				$j(menu_items2[i]).find('ul').css({'visibility': 'visible','height': '0px', 'opacity':'0'});
				$j(menu_items2[i]).find('ul').css('display', 'block');
				$j(menu_items2[i]).find('ul').stop().animate({'height': $j(menu_items2[i]).data('original_height'),opacity:1}, size2, function() {
					$j(menu_items2[i]).find('ul').css('overflow', 'visible');
				});
			}).mouseleave(function(){
				$j(menu_items2[i]).find('ul').stop().animate({'height': '0px'},0, function() {
					$j(menu_items2[i]).find('ul').css('overflow', 'hidden');
					$j(menu_items2[i]).find('.second').css('visivility', 'hidden');
				});
			});
		}

	});
}

function magicPanes(){
	$magicLine = $j("#magic");
	$magicLine2 = $j("#magic2");
	$menulinks = $j(".main_menu > ul > li");
	if($j(".main_menu .active").length > 0){
	
		$j('body').removeClass('menuHoverOn');
		
		$magicLine.width($j(".active").outerWidth(true) - 24).css("left", $j(".active").position().left + 12);
		$magicLine2.width($j(".active").outerWidth(true) - 24).css("left", $j(".active").position().left + 12).data("origLeft", $magicLine.position().left).data("origWidth", $magicLine.width());
		$menulinks.mouseenter(function() {
			$el = $j(this);
			$leftPos = $el.position().left + 12;
			$newWidth = $el.outerWidth(true) - 24;
			
			if($el.hasClass('active') == false){
				//$magicLine.css('background-color','#acacac');
			}
			
			return $magicLine2.stop().animate({
				left: $leftPos,
				width: $newWidth
			});
			
		}).mouseleave(function() {
			
			return $magicLine2.stop().animate({
				left: $magicLine2.data("origLeft"),
				width: $magicLine2.data("origWidth")
			},function(){
				//$magicLine.css('background-color','#252525');
			});
		});
		
		$j('nav > ul > li a').each(function(i) {
			$j(this).click(function(){
				if($j(this).attr('href') != "http://#" && $j(this).attr('href') != "#"){
				
					$j('a').parent().removeClass('active');
					if($j(this).closest('.second').length == 0){
						$j(this).parent().addClass('active');
					}else{
						$j(this).closest('.second').parent().addClass('active');
					}
	
					$magicLine2.data("origLeft", $leftPos).data("origWidth", $newWidth);
					$magicLine2.stop().animate({
						left: $leftPos,
						width: $newWidth
					});
					return $magicLine.stop().animate({
						left: $leftPos,
						width: $newWidth
					});
					
				}else{
					return false;
				}
			});
		});
	
	}else{
		$j('body').addClass('menuHoverOn');
	}
}

function selectMenu(){
	var $menu_select = $j("<div class='select'><ul></ul></div>");
	$j("<span>&nbsp;</span>").prependTo($menu_select);
	$menu_select.appendTo(".selectnav");
	if($j(".main_menu").hasClass('drop_down')){
		$j(".main_menu ul li a").each(function(){
			var menu_url = $j(this).attr("href");
			var menu_text = $j(this).text();
			if ($j(this).parents("li").length == 2) { menu_text = "&nbsp;&nbsp;&nbsp;" + menu_text; }
			if ($j(this).parents("li").length == 3) { menu_text = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" + menu_text; }
			if ($j(this).parents("li").length > 3) { menu_text = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" + menu_text; }
			
			// $j("<li><a href="+menu_url+">"+menu_text+"</a></li>").appendTo($menu_select.find('ul'));
			var li = $j("<li />");
			var link = $j("<a />", {"href": menu_url, "html": menu_text}).appendTo(li);
			li.appendTo($menu_select.find('ul'));
		});
	}else if($j(".main_menu").hasClass('move_down')){
		$j(".main_menu ul li a").each(function(){
			var menu_url = $j(this).attr("href");
			var menu_text = $j(this).text();
			if ($j(this).parents("div.mc").length == 1) { menu_text = "&nbsp;&nbsp;&nbsp;" + menu_text; }
			if ($j(this).hasClass('sub')) { menu_text = "&nbsp;&nbsp;&nbsp;" + menu_text; }
			
			//$j('<li><a href=' + menu_url + '>' + menu_text + '</a></li>').appendTo($menu_select.find('ul'));
			var li = $j("<li />");
			var link = $j("<a />", {"href": menu_url, "html": menu_text}).appendTo(li);
			li.appendTo($menu_select.find('ul'));
		});
	}
	
	
	$j(".select span").click(function () {
		if ($j(".select ul").is(":visible")){
			$j(".select ul").slideUp();
		} else {
			$j(".select ul").slideDown();
		}
	});
	
	$j(".selectnav ul li a").click(function () {
		$j(".select ul").slideUp();
	});

}

function sliderInit(){
	
	sliderCheckControl();
	
	jQuery('.big-slider-wrapper').each(function(){
		
		var $slider = jQuery(this);
	
		var $box=$slider.find('.big-slider-control .control-seek-box');
		var $slidesInner=$slider.find('.big-slider .big-slider-inner');
		var initialPos=0;
		var initialOffset=0;
		var seekWidth=0;
		var boxWidth=0;
		var lastDirection=0;
		var lastPageX=0;
		var autoslide_direction=1;
		var autoslide_timer;
		
		var slidesWidth=0;
		var slidesPaneWidth=0;
		
		var movehandler=function(e){
			stopPulseScrollTeaser();
			
			var left=initialOffset+(e.pageX-initialPos);
			if(left < 0)
				left=0;
			if(left > seekWidth-boxWidth)
				left = seekWidth-boxWidth;
			
			var percent=left/(seekWidth-boxWidth);
				
			$box.css('left',left+'px');
			var offset=(slidesPaneWidth-slidesWidth)*percent;
			$slidesInner.css('margin-left',offset+'px');
			
			lastDirection=lastPageX-e.pageX;
			lastPageX=e.pageX;
		};
		
		var movehandler_mouse_drag=function(e){
			stopPulseScrollTeaser();
			
			var left=initialOffset+(initialPos-e.pageX);
			if(left < 0)
				left=0;
			if(left > seekWidth-boxWidth)
				left = seekWidth-boxWidth;
			
			var percent=left/(seekWidth-boxWidth);
				
			$box.css('left',left+'px');
			var offset=(slidesPaneWidth-slidesWidth)*percent;
			$slidesInner.css('margin-left',offset+'px');
			
			lastDirection=lastPageX-e.pageX;
			lastPageX=e.pageX;
		};
		
		$box.mousedown(function(e){
			e.preventDefault();
			initialPos=e.pageX;
			initialOffset=parseInt($box.css('left'));
			boxWidth=$box.width();
			seekWidth=$slider.find('.big-slider-control .control-seek').width();
			
			slidesWidth=$slider.find('.big-slider .big-slider-uber-inner').width();
			slidesPaneWidth=$slider.find('.big-slider').width();
			
			jQuery(this).addClass('pressed');

			jQuery(document).bind('mousemove',movehandler);
		});
		
		$slider.find('.big-slider').mousedown(function(e){
			e.preventDefault();
			
			initialPos=e.pageX;
			initialOffset=parseInt($box.css('left'));
			boxWidth=$box.width();
			seekWidth=$slider.find('.big-slider-control .control-seek').width();
			
			slidesWidth=$slider.find('.big-slider .big-slider-uber-inner').width();
			slidesPaneWidth=$slider.find('.big-slider').width();
			
			jQuery(this).addClass('pressed');

			$j(this).bind('mousemove',movehandler_mouse_drag);
		});
		
		jQuery(document).mouseup(function(){
			if($box.hasClass('pressed')){
				$box.removeClass('pressed');
				jQuery(document).unbind('mousemove',movehandler);

				var $fs=$slider.find('.big-slider .big-slider-slide:last');
				var sw=$fs.outerWidth()+parseInt($fs.css('margin-left'))+parseInt($fs.css('margin-right'));
				var ml=parseInt($slidesInner.css('margin-left'));
				if(lastDirection > 0) {
					ml=Math.ceil(ml/sw)*sw;
					if(ml > 0)
						ml=0;
				} else {
					ml=Math.floor(ml/sw)*sw;
					if(ml < slidesPaneWidth-slidesWidth)
						ml=slidesPaneWidth-slidesWidth;
				}
				$slidesInner.stop(true).animate({marginLeft: ml+'px'}, 300);
				fitBox(ml);
			}
		});
		
		$slider.find('.big-slider').mouseup(function(){
			if($j(this).hasClass('pressed')){
				$j(this).removeClass('pressed');
				$j(this).unbind('mousemove',movehandler_mouse_drag);

				var $fs=$slider.find('.big-slider .big-slider-slide:last');
				var sw=$fs.outerWidth()+parseInt($fs.css('margin-left'))+parseInt($fs.css('margin-right'));
				var ml=parseInt($slidesInner.css('margin-left'));
				if(lastDirection < 0) {
					ml=Math.ceil(ml/sw)*sw;
					if(ml > 0)
						ml=0;
				} else {
					ml=Math.floor(ml/sw)*sw;
					if(ml < slidesPaneWidth-slidesWidth)
						ml=slidesPaneWidth-slidesWidth;
				}
				$slidesInner.stop(true).animate({marginLeft: ml+'px'}, 300);
				fitBox(ml);
			}
		});
		
		function fitBox(newMarginLeft){
			$box.stop(true);
			
			var percent=newMarginLeft/(slidesPaneWidth-slidesWidth);

			boxWidth=$box.width();
			seekWidth=$slider.find('.big-slider-control .control-seek').width();

			var left=(seekWidth-boxWidth)*percent;
			$box.animate({left:left+'px'},300);
		}
		
		
		$slider.find('.big-slider-control .control-left').click(function(e){
			
			e.preventDefault();
			
			autoslide_direction=0;
			
			slider_scroll_left();
			
		});
		
		function slider_scroll_left() {
			
			$slidesInner.stop(true,true);
			stopPulseScrollTeaser();
			
			var ml=parseInt($slidesInner.css('margin-left'));
			if(ml < 0)
			{
				var $fs=$slider.find('.big-slider .big-slider-slide:last');
				var sw=$fs.outerWidth()+parseInt($fs.css('margin-left'))+parseInt($fs.css('margin-right'));
				ml+=sw;
				ml=Math.round(ml/sw)*sw;
				$slidesInner.animate({marginLeft: ml+'px'}, 300);
				fitBox(ml);
				
				return true;
			} else {
				//return false;
				slidesWidth=$slider.find('.big-slider .big-slider-uber-inner').width();
				slidesPaneWidth=$slider.find('.big-slider').width();
				$slidesInner.animate({marginLeft: slidesPaneWidth-slidesWidth+'px'}, 300);
				fitBox(slidesPaneWidth-slidesWidth);
			}
		}
		

		$slider.find('.big-slider-control .control-right').click(function(e){
			
			e.preventDefault();
			
			autoslide_direction=1;
			
			slider_scroll_right();
			
		});
		
		function slider_scroll_right() {
			
			$slidesInner.stop(true,true);
			stopPulseScrollTeaser();
			
			slidesWidth=$slider.find('.big-slider .big-slider-uber-inner').width();
			slidesPaneWidth=$slider.find('.big-slider').width();
			var ml=parseInt($slidesInner.css('margin-left'));
			if(isNaN(ml))
				ml=0;
			if(slidesWidth+ml > (slidesPaneWidth + 20))
			{
				var $fs=$slider.find('.big-slider .big-slider-slide:last');
				var sw=$fs.outerWidth()+parseInt($fs.css('margin-left'))+parseInt($fs.css('margin-right'));
				ml-=sw;
				ml=Math.round(ml/sw)*sw;
				$slidesInner.animate({marginLeft: ml+'px'}, 300);
				fitBox(ml);
				return true;
			} else {
				//return false;
				$slidesInner.animate({marginLeft: '0px'}, 300);
				fitBox(0);
			}
			
		}
		
		$slider.swipe({ swipeMoving: function( pageX ){			
    },
			swipeLeft: function(){ slider_scroll_right(); },
			swipeRight: function(){ slider_scroll_left(); }
		});
			
	
	});
	
	
}

function sliderRewind() {
	jQuery('.big-slider-wrapper').each(function(){
		var $box=jQuery(this).find('.big-slider-control .control-seek-box');
		var $slidesInner=jQuery(this).find('.big-slider .big-slider-inner');

		$box.css('left',0);
		$slidesInner.css('margin-left',0);
	});
	
}

function sliderCheckControl() {
	var w=jQuery(window).width();
	jQuery('.big-slider-wrapper').each(function(){
		var sn=jQuery(this).find('.big-slider .big-slider-slide').length;
		

		if((sn < 4 && w >=768) || (sn == 1 && w < 768)) {
			//jQuery(this).find('.big-slider-control').hide();
		} else {
			//jQuery(this).find('.big-slider-control').show();
		}	
	});

}

function sliderImageHovers(){
	
	
		$j('.big-slider-wrapper:not(:parent.box1), .portfolio_holder article').find('.image').each(function(){
		
			var zoom = 1.2;
     
			var $oldWidth = $j(this).find('img').width();
			var $oldHeight = $j(this).find('img').height();
			
			$j(this).height($oldHeight);
			
			var $newWidth = $j(this).find('img').width() * zoom;
			var $newHeight = $j(this).find('img').height() * zoom;
		 
			$j(this).hover(function() {
				$j(this).find('img').stop(false,true).animate({'width':$newWidth, 'height':$newHeight}, { duration: 500 }, function(){
				
				});
			},
			function() {
					$j(this).find('img').stop(false,true).animate({'width':$oldWidth, 'height':$oldHeight, 'top':'0', 'left':'0'}, { duration: 500 });   
			});
			
			$j(this).mousemove(
				function(e){
					
					$this = $j(this);
					
					/* Work out mouse position 
					var offset = $j(this).offset();
					var xPos = e.pageX - offset.left;
					var yPos = e.pageY - offset.top;
					*/
					/* Get percentage positions */
					var mouseXPercent = Math.round(xPos / $j(this).width() * 100);
					var mouseYPercent = Math.round(yPos / $j(this).height() * 100);

					/* Position Each Layer */
					$j(this).find('img').each(
						function(){
							var diffX = $this.width() - $j(this).width();
							var diffY = $this.height() - $j(this).height();

							var myX = diffX * (mouseXPercent / 100); 
							var myY = diffY * (mouseYPercent / 100);

							var cssObj = {
								'left': myX + 'px',
								'top': myY + 'px'
							};
							//$j(this).css(cssObj);
							$j(this).animate({left: myX, top: myY},{duration: 200, queue: false, easing: 'linear'});

						}
					);

				}
			);
			
			
		}); 
}

function sliderImageHeightUpdate(){
	$j('.big-slider-wrapper:not(:parent.box1), .portfolio_holder article').find('.image').each(function(){     
		var $oldHeight = $j(this).find('img').height();
		$j(this).height($oldHeight);
	});
}

function initAccordion(){
	$j( ".accordion2" ).accordion({
		collapsible: true,
		active: false,
		icons: "",
		heightStyle: "content"
	});
	
	$j(".toggle").addClass("accordion ui-accordion ui-accordion-icons ui-widget ui-helper-reset")
	.find("h5")
	.addClass("ui-accordion-header ui-helper-reset ui-state-default ui-corner-top ui-corner-bottom")
	.hover(function() { $j(this).toggleClass("ui-state-hover"); })
	.click(function() {
	$j(this)
		.toggleClass("ui-accordion-header-active ui-state-active ui-state-default ui-corner-bottom")
		.next().toggleClass("ui-accordion-content-active").slideToggle(200);
		return false;
	})
	.next()
	.addClass("ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom")
	.hide(); 
}

function initMessages(){
	$j('.message').each(function(){
		$j(this).find('.close').click(function(e){
			e.preventDefault();
			$j(this).parent().fadeOut(500);
		});
	});
}

function initTestimonials(){
	$j('.testimonials').bxSlider({
	  auto: true,
	  controls: false
	});	

	$j('.tweets').bxSlider({
	  auto: true,
	  mode: 'fade',
	  pager: false,
		pause: 6000,
	  nextSelector: '.twitter_next',
      prevSelector: '.twitter_prev',	
      nextText: 'n',
  	  prevText: 'p'  
	});
}

function placeholderReplace(){
    $j('[placeholder]').focus(function() {
     var input = $j(this);
      if (input.val() == input.attr('placeholder')) {
        if (this.originalType) {
          this.type = this.originalType;
          delete this.originalType;
        }
        input.val('');
        input.removeClass('placeholder');
      }
    }).blur(function() {
      var input = $j(this);
      if (input.val() == '') {
        if (this.type == 'password') {
          this.originalType = this.type;
          this.type = 'text';
        }
        input.addClass('placeholder');
        input.val(input.attr('placeholder'));
      }
    }).blur();

    $j('[placeholder]').parents('form').submit(function () {
       $j(this).find('[placeholder]').each(function () {
           var input = $j(this);
           if (input.val() == input.attr('placeholder')) {
               input.val('');
           }
       })
   });
}

var $scrollHeight;
function initPortfolioSingleInfo(){
	var $sidebar   = $j(".portfolio_single_follow");
	if($j(".portfolio_single_follow").length > 0){
	
		offset = $sidebar.offset();
		$scrollHeight = $j(".portfolio_container").height();
		$scrollOffset = $j(".portfolio_container").offset();
		$window = $j(window);
		topPadding = 15;
		
		$window.scroll(function() {

			if($window.width() > 960){

				if ($window.scrollTop() > offset.top) {
					if ($window.scrollTop() + topPadding + $sidebar.height() + 24 < $scrollOffset.top + $scrollHeight) {
						$sidebar.stop().animate({
							marginTop: $window.scrollTop() - offset.top + topPadding
						});
					} else {
						$sidebar.stop().animate({
							marginTop: $scrollHeight - $sidebar.height() - 24
						});
					}
				} else {
					$sidebar.stop().animate({
						marginTop: 0
					});
				}		
			}else{
				$sidebar.css('margin-top',0);
			}
			
		});
	}
}

function initPortfolioList(){
	
	$j('.portfolio_holder').isotope({
		itemSelector: '.element',
		animationEngine : 'jquery',
		animationOptions: {
			duration: 250,
			easing: 'linear',
			queue: false
		}
	});

}

function initPortfolioFilter(){
	$j('.filter a:first').addClass('current');
	$j('.filter a').click(function(){
		var selector = $j(this).attr('data-filter');
		$j('.portfolio_holder').isotope({ filter: selector });
		
		$j(".filter a").removeClass("current");
		$j(this).addClass("current");
		
		return false;
	});
}

function initProgressBars(){
	$j('.progress_bars').each(function() {
		$j(this).appear(function() {
			$j(this).find('.progress_bar').each(function() {
				var percentage = $j(this).find('.progress_content').data('percentage');
				$j(this).find('.progress_content').css('width', '0%');
				$j(this).find('.progress_number').css('width', '0%');
				$j(this).find('.progress_content').animate({
					width: percentage+'%'
				}, 2000);
				$j(this).find('.progress_number').html(percentage+'%');
				$j(this).find('.progress_number').animate({
					width: percentage+'%'
				}, 2000);
			});
		});
	});
	
}

function initTabs(){

	var $tabsNav = $j('.tabs-nav'),
	$tabsNavLis = $tabsNav.children('li'),
	$tabContent = $j('.tab-content');
	$tabsNav.each(function() {
		var $this = $j(this);
		$this.next().children('.tab-content').stop(true,true).hide().first().show();
		$this.children('li').first().addClass('active').stop(true,true).show();
	});
	$tabsNavLis.on('click', function(e) {
		var $this = $j(this);
		$this.siblings().removeClass('active').end().addClass('active');
		$this.parent().next().children('.tab-content').stop(true,true).hide().siblings( $this.find('a').attr('href') ).fadeIn();
		e.preventDefault();
	}); 
}

function fitVideo(){	
	$j(".portfolio_images").fitVids();
	$j(".video_holder").fitVids();
}

function initParallax(speed){
	
	if($j('html').hasClass('touch')){
		$j('.parallax section').each(function() {
			var $self = $j(this);
			var section_height = $self.data('height');
			$self.height(section_height);
			var rate = 0.5;
			
			var bpos = (- $j(this).offset().top) * rate;
			$self.css({'background-position': 'center ' + bpos  + 'px' });
			
			$j(window).bind('scroll', function() {
				var bpos = (- $self.offset().top + $j(window).scrollTop()) * rate;
				$self.css({'background-position': 'center ' + bpos  + 'px' });
			});
		});
	}else{
		$j('.parallax section').each(function() {
			var $self = $j(this);
			var section_height = $self.data('height');
			$self.height(section_height);
			var rate = (section_height / $j(document).height()) * speed;
			
			var distance = $j.elementoffset($self);
			var bpos = - (distance * rate);
			$self.css({'background-position': 'center ' + bpos  + 'px' });
			
			$j(window).bind('scroll', function() {
				var distance = $j.elementoffset($self);
				var bpos = - (distance * rate);
				$self.css({'background-position': 'center ' + bpos  + 'px' });
			});
		});
	}
	return this;
	
}

$j.elementoffset = function($element) {
	var fold = $j(window).scrollTop();
	return (fold) - $element.offset().top + 104;
};

function totop_button(a) {
		var b = $j("#back_to_top");
		b.removeClass("off on");
		if (a == "on") { b.addClass("on") } else { b.addClass("off") }
}

function backButtonInterval(){
	window.setInterval(function () {
			var b = $j(this).scrollTop();
			var c = $j(this).height();
			if (b > 0) { var d = b + c / 2 } else { var d = 1 }
			if (d < 1e3) { totop_button("off") } else { totop_button("on") }
	}, 300);
}

function backToTop(){
	$j(document).on('click','#back_to_top',function(e){
		e.preventDefault();
		
		$j('body,html').animate({scrollTop: 0}, $j(window).scrollTop()/3, 'swing');
	});
}

function checkForIpad(){
	Modernizr.addTest('ipad', function () {
		return !!navigator.userAgent.match(/iPad/i);
	});
}

var pulseScrollTeaserRunning = false;
var pulseScrollTeaserVerticalRunning = false;

function runPulseScrollTeaser() {
	if (!pulseScrollTeaserRunning) {
		$j('#scrollTeaser').hide();
		return;
	}
	
	var pulseSpeed = 500;
	$j('#scrollTeaser-left1').fadeIn(pulseSpeed).delay(0).fadeOut(pulseSpeed);
	$j('#scrollTeaser-left2').delay(300).fadeIn(pulseSpeed).delay(0).fadeOut(pulseSpeed);
	$j('#scrollTeaser-left3').delay(500).fadeIn(pulseSpeed).delay(0).fadeOut(pulseSpeed,runPulseScrollTeaser);
}

function runPulseScrollTeaserVertical() {
	if(!pulseScrollTeaserVerticalRunning) {
		$j('#scrollTeaserVertical').hide();
		return;
	}
	
	var pulseSpeed = 500;
	$j('#scrollTeaser-down1').fadeIn(pulseSpeed).delay(0).fadeOut(pulseSpeed);
	$j('#scrollTeaser-down2').delay(300).fadeIn(pulseSpeed).delay(0).fadeOut(pulseSpeed);
	$j('#scrollTeaser-down3').delay(500).fadeIn(pulseSpeed).delay(0).fadeOut(pulseSpeed,runPulseScrollTeaserVertical);
}

function startPulseScrollTeaser() {
	if (pulseScrollTeaserRunning==true)
		return false;
	if (pulseScrollTeaserVerticalRunning==true)
		return false;

	pulseScrollTeaserRunning = true;
	pulseScrollTeaserVerticalRunning = true;
	$j('#scrollTeaser').show();
	$j('#scrollTeaserVertical').show();
	runPulseScrollTeaser();
	runPulseScrollTeaserVertical();
	return true;
}

function stopPulseScrollTeaser() {
	pulseScrollTeaserRunning = false;
}

function stopPulseScrollTeaserVertical() {
	pulseScrollTeaserVerticalRunning = false;
}

function parallaxPager(){
	var link_holder = $j('.link_holder');
	$j('section.parallax section').each(function(){	
		var href = $j(this).attr("id");
		var title = $j(this).data("title");
		
		var link = $j("<a />", {"href": "#"+href, "class":"link", "title": title, "html": "&nbsp;"});
		link.appendTo(link_holder);
		
	});
	link_holder.css('margin-top',-link_holder.height()/2);
	
	
	$j('.link_holder .link:first-child').addClass('active');
	$j(document).on('click','a.link',function() {
	
		$j('.tooltip').fadeOut(10);
		if($j(this).hasClass('active')){
			return false;
		}
		$j('.link_holder .link').removeClass('active');
		$j(this).addClass('active');
		
		$j.scrollTo($j($j(this).attr("href")), {
			duration: 750,
			offset: {top:-1}
		});
		return false;
	});	
	
	$j(".link_holder a[title]").tooltip({
		 position: "top left",
		 offset: [20, -20]
		 
	});
	
}

function viewPort(){

	$j('.parallax section').waypoint( function(direction) {
		var $active = $j(this).next();
		
		if (direction === "up") {
			$active = $active.prev();
		}
		if (!$active.length) {
			$active = $j(this);
		}
		
		var id = $active.attr("id");
		$j(".link").each(function(){
			var i = $j(this).attr("href").replace("#",""); 
			
			if(i == id){
				$j(this).addClass('active');
			}else{
				$j(this).removeClass('active');
			}
		});	
	}, { offset: '0%' });
}

function stylishSelectContent(){
	if ($j(".gform_wrapper").length === 0 && $j(".woocommerce .checkout").length === 0 && $j(".woocommerce .variations_form").length === 0 && $j(".woocommerce-account .country_select").length === 0 && $j(".woocommerce .woocommerce-ordering").length === 0 && $j(".woocommerce-cart .shipping_calculator").length === 0 ) {
		$j('.content select').not("#rating").sSelect({ddMaxHeight: '300px'});
	}
}
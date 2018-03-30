(function($) {
  "use strict";
  	//Common documen ready event
	jQuery(document).ready(function(){
		init_ultimate_spacer();
	});
  
  	//Common on window resize event
	jQuery(window).resize(function(){
		init_ultimate_spacer();
	});
  
  	//Common on window scroll event
	jQuery(window).scroll(function(){
		var $hideOnMobile = jQuery('.ult-no-mobile').length;
		if(! /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ){
			animate_block();
		} else  {
			if($hideOnMobile >= 1) 
				jQuery(".ult-animation").css("opacity",1);
			else
				animate_block();
		}
		jQuery('.vc-row-fade').vc_fade_row();
		jQuery('.vc-row-translate').vc_translate_row();
	});
	
	$.fn.vc_translate_row = function() {
		var window_scroll = jQuery(window).scrollTop();
		var window_height = jQuery(window).height();
		jQuery(this).each(function(index, element) {
			var mobile_disable = jQuery(element).attr('data-row-effect-mobile-disable');
			if(typeof mobile_disable == "undefined")
				mobile_disable = 'false';
			else
				mobile_disable = mobile_disable.toString();
			if(! /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) )
				var is_mobile = 'false';
			else
				var is_mobile = 'true';
			if(is_mobile == 'true' && mobile_disable == 'true')
				var disable_row_effect = 'true';
			else
				var disable_row_effect = 'false';
					
			if(disable_row_effect == 'false')
			{
				var percentage = 0
				
				var row_height = jQuery(element).outerHeight();
				var row_top = jQuery(element).offset().top;
				var position = row_top - window_scroll;
				var row_visible = position+row_height;
				var pcsense = jQuery(element).attr('data-parallax-content-sense');
				var sense = (pcsense/100);
				var translate = 0;
				
				var cut = window_height - (window_height * (percentage/100));
	
				if(row_visible <= cut && position <= 0)
				{
					if(row_height > window_height)
					{
						var translate = (window_height - row_visible)*sense;
					}
					else
					{
						var translate = -(position*sense);
					}
					if(translate < 0)
						translate = 0;
				}
				else
				{
					translate = 0;
				}
				var find_class = '.upb_row_bg,.upb_video-wrapper,.ult-vc-seperator';
				jQuery(element).find('.vc-row-translate-wrapper').children().each(function(index, child) {
					if(!jQuery(child).is(find_class)) 
					{
						jQuery(child).css({'-webkit-transform':'translateY('+translate+'px)', 'transform':'translateY('+translate+'px)', '-ms-transform':'translateY('+translate+'px)'});
					}
				});
			}
		});
	} //end translate function
	
	$.fn.vc_fade_row = function() {
		var window_scroll = jQuery(window).scrollTop();
		var window_height = jQuery(window).height();
		jQuery(this).each(function(index, element) {
			var mobile_disable = jQuery(element).attr('data-row-effect-mobile-disable');
			if(typeof mobile_disable == "undefined")
				mobile_disable = 'false';
			else
				mobile_disable = mobile_disable.toString();
			if(! /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) )
				var is_mobile = 'false';
			else
				var is_mobile = 'true';
			if(is_mobile == 'true' && mobile_disable == 'true')
				var disable_row_effect = 'true';
			else
				var disable_row_effect = 'false';

			if(disable_row_effect == 'false')
			{
				var min_opacity = 0;
	
				var percentage = jQuery(element).data('fadeout-percentage');
				percentage = 100 - percentage;
				
				var no_class = '';
				
				var row_height = jQuery(element).outerHeight();
				var row_top = jQuery(element).offset().top;
				var position = row_top - window_scroll;
				var row_bottom = position+row_height;
				var opacity = 1;
				
				var cut = window_height - (window_height * (percentage/100));
							
				var newop = (((cut-row_bottom)/cut)*(1-min_opacity));
				if(newop > 0)
					 opacity = 1-newop;

				if(row_bottom <= cut)
				{
					if(opacity < min_opacity)
						opacity = min_opacity;
					else if(opacity > 1)
						opacity = 1;
					jQuery(element).children().each(function(rindex, row_child) {
						var find_class = '.upb_row_bg,.upb_video-wrapper,.ult-vc-seperator';
						if(!jQuery(row_child).is(find_class))
						{
							jQuery(row_child).css({		
								'opacity' : opacity
							});
						}
					});
				}
				else
				{
					jQuery(element).children().each(function(rindex, row_child) {
						jQuery(row_child).css({		
							'opacity' : opacity
						});
					}); 
				}
			}
        });
	} // end fade function

  	jQuery(window).load(function(){
		
		jQuery('.banner-block-custom-height').each(function(index, element) {
            var $blockimg = jQuery(this).find('img');
			var block_width = jQuery(this).width();
			var img_width = $blockimg.width();
			if(block_width > img_width)
				$blockimg.css({'width':'100%','height':'auto'});
        });
  		
  		var flip_resize_count=0, flip_time_resize=0;  		
  		var flip_box_resize = function(){
			jQuery('.ifb-jq-height').each(function(){			
				jQuery(this).find('.ifb-back').css('height','auto');
				jQuery(this).find('.ifb-front').css('height','auto');
				var fh = parseInt(jQuery(this).find('.ifb-front').outerHeight(true));
				var bh = parseInt(jQuery(this).find('.ifb-back').outerHeight(true));
				var gr = (fh>bh)?fh:bh;
				jQuery(this).find('.ifb-front').css('height',gr+'px');
				jQuery(this).find('.ifb-back').css('height',gr+'px');
				if(jQuery(this).hasClass('vertical_door_flip')) {
					jQuery(this).find('.ifb-flip-box').css('height',gr+'px');
				}
				else if(jQuery(this).hasClass('horizontal_door_flip')) {
					jQuery(this).find('.ifb-flip-box').css('height',gr+'px');
				}
				else if(jQuery(this).hasClass('style_9')) {
					jQuery(this).find('.ifb-flip-box').css('height',gr+'px');
				}
			})	
			jQuery('.ifb-auto-height').each(function(){
				if( (jQuery(this).hasClass('horizontal_door_flip')) || (jQuery(this).hasClass('vertical_door_flip')) ){
					var fh = parseInt(jQuery(this).find('.ifb-front').outerHeight());
					var bh = parseInt(jQuery(this).find('.ifb-back').outerHeight());
					var gr = (fh>bh)?fh:bh;
					jQuery(this).find('.ifb-flip-box').css('height',gr+'px');
				}
			})
		}		
		if (navigator.userAgent.indexOf('Safari') != -1 && navigator.userAgent.indexOf('Chrome') == -1){			
			setTimeout(function() {
				flip_box_resize();	
			}, 500);	
		}
		else{
			flip_box_resize();
		}
		jQuery(window).resize(function(){
			flip_resize_count++;
			setTimeout(function() {
				flip_time_resize++;
				if(flip_resize_count == flip_time_resize){
					flip_box_resize();					
				}
			}, 500);
		});
		var tiid=0;
		var mason_des=0;
		jQuery(window).resize(function(){
			ib_responsive();
			jQuery('.csstime.smile-icon-timeline-wrap').each(function(){
				timeline_icon_setting(jQuery(this));
			});
			$('.jstime .timeline-wrapper').each(function(){
				timeline_icon_setting(jQuery(this));
			});
			if(jQuery('.smile-icon-timeline-wrap.jstime .timeline-line').css('display')=='none'){
				if(mason_des===0){
					$('.jstime .timeline-wrapper').masonry('destroy');
					mason_des=1;
				}
			}else{
				if(mason_des==1){					
					jQuery('.jstime .timeline-wrapper').masonry({
						"itemSelector": '.timeline-block',					
					});
					setTimeout(function() {
						jQuery('.jstime .timeline-wrapper').masonry({
							"itemSelector": '.timeline-block',					
						});
						jQuery(this).find('.timeline-block').each(function(){
							if(jQuery(this).css('left')=='0px'){
								jQuery(this).addClass('timeline-post-left');
							}
							else{
								jQuery(this).addClass('timeline-post-right');
							}
						});
						mason_des=0;
					}, 300);
				}				
			}
		});
		$('.smile-icon-timeline-wrap').each(function(){			
			var cstm_width = jQuery(this).data('timeline-cutom-width');
			if(cstm_width){
				jQuery(this).css('width',((cstm_width*2)+40)+'px');
			}
			var width = parseInt(jQuery(this).width());
			var b_wid = parseInt(jQuery(this).find('.timeline-block').width());				
			var l_pos = (b_wid/width)*100;
			var time_r_margin = (width - (b_wid*2) - 40);			
			time_r_margin = (time_r_margin/width)*100;
			$('.jstime .timeline-wrapper').each(function(){
				jQuery(this).masonry({
					"itemSelector": '.timeline-block',
				});
			});
			setTimeout(function() {
				$('.jstime .timeline-wrapper').each(function(){
					jQuery(this).find('.timeline-block').each(function(){
						if(jQuery(this).css('left')=='0px'){
							jQuery(this).addClass('timeline-post-left');
						}
						else{
							jQuery(this).addClass('timeline-post-right');
						}
						timeline_icon_setting(jQuery(this));
					});
					jQuery('.timeline-block').each(function(){
						var div=parseInt(jQuery(this).css('top'))-parseInt(jQuery(this).next().css('top'));
						if((div < 14 && div > 0)|| div==0) {
							jQuery(this).next().addClass('time-clash-right');
						}
						else if(div > -14){
							jQuery(this).next().addClass('time-clash-left');
						}
					})
					jQuery('.smile-icon-timeline-wrap').each(function(){
						var block_bg =jQuery(this).data('time_block_bg_color');
						jQuery(this).find('.timeline-block').css('background-color',block_bg);
					    jQuery(this).find('.timeline-post-left.timeline-block l').css('border-left-color',block_bg);
					    jQuery(this).find('.timeline-post-right.timeline-block l').css('border-right-color',block_bg);	
					    jQuery(this).find('.feat-item').css('background-color',block_bg);	
					    if(jQuery(this).find('.feat-item').find('.feat-top').length > 0)
							jQuery(this).find('.feat-item l').css('border-top-color',block_bg);
						else
					    	jQuery(this).find('.feat-item l').css('border-bottom-color',block_bg);
					})
					jQuery('.jstime.timeline_preloader').remove();
					jQuery('.smile-icon-timeline-wrap.jstime').css('opacity','1');
				});
				jQuery('.timeline-post-right').each(function(){
					var cl = jQuery(this).find('.timeline-icon-block').clone();
					jQuery(this).find('.timeline-icon-block').remove(); 
					jQuery(this).find('.timeline-header-block').after(cl);
				})
			}, 1000);
			jQuery(this).find('.timeline-wrapper').each(function(){
				if(jQuery(this).text().trim()===''){
					jQuery(this).remove();
				}
			});
			if( ! jQuery(this).find('.timeline-line ').next().hasClass('timeline-separator-text')){
				jQuery(this).find('.timeline-line').prepend('<o></o>');
			}			
			var sep_col = jQuery(this).data('time_sep_color');
			var sep_bg =jQuery(this).data('time_sep_bg_color');
			var line_color = jQuery('.smile-icon-timeline-wrap .timeline-line').css('border-right-color');
			jQuery(this).find('.timeline-dot').css('background-color',sep_bg);
			jQuery(this).find('.timeline-line z').css('background-color',sep_bg);
			jQuery(this).find('.timeline-line o').css('background-color',sep_bg);
			jQuery(this).find('.timeline-separator-text').css('color',sep_col);
			jQuery(this).find('.timeline-separator-text .sep-text').css('background-color',sep_bg);
			jQuery(this).find('.ult-timeline-arrow s').css('border-color','rgba(255, 255, 255, 0) '+line_color);
			jQuery(this).find('.feat-item .ult-timeline-arrow s').css('border-color',line_color+' rgba(255, 255, 255, 0)');
			jQuery(this).find('.timeline-block').css('border-color',line_color);
			jQuery(this).find('.feat-item').css('border-color',line_color);
  		});
		jQuery('.timeline-block').each(function(){
			var link_b = $(this).find('.link-box').attr('href');
			var link_t = $(this).find('.link-title').attr('href');
			if(link_b){				
				jQuery(this).wrap('<a href='+link_b+'></a>')
			}
			if(link_t){
				jQuery(this).find('.ult-timeline-title').wrap('<a href='+link_t+'></a>')
			}
		});
		jQuery('.feat-item').each(function(){
			var link_b = $(this).find('.link-box').attr('href');			
			if(link_b){				
				jQuery(this).wrap('<a href='+link_b+'></a>')
			}
		});
	});	// end window load event
	
	jQuery(window).load(function() {
		var $hideOnMobile = jQuery('.ult-no-mobile').length;

		if(! /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) 
		{
			animate_block();
		} else  {
			if($hideOnMobile >= 1) 
				jQuery(".ult-animation").css("opacity",1);
			else
				animate_block();
		}
		ib_responsive();
	
		jQuery(".ubtn").hover(
			function(){
				var $this = jQuery(this);
				$this.find(".ubtn-text").css("color",$this.data('hover'));
				$this.find(".ubtn-hover").css("background",$this.data('hover-bg'));
				var old_style = $this.attr('style');
				if($this.data('shadow-hover') != ''){
					var old_shadow = $this.css('box-shadow');
					//console.log(old_shadow);
					old_style += 'box-shadow:'+$this.data('shadow-hover');
				}
				$this.attr('style', old_style);
				if($this.data('border-hover') != '')
				{
					$this.css("border-color",$this.data('border-hover'));
				}
				if($this.data('shadow-click') != 'none')
				{
					var temp_adj = $this.data('shd-shadow')-3;
					if($this.is('.shd-left') != '')
						$this.css({ 'right':temp_adj});
					else if($this.is('.shd-right') != '')
						$this.css({ 'left':temp_adj });
					else if($this.is('.shd-top') != '')
						$this.css({ 'bottom':temp_adj });
					else if($this.is('.shd-bottom') != '')
						$this.css({ 'top':temp_adj });
				}
			},
			function(){
				var $this = jQuery(this);
				$this.find(".ubtn-text").removeAttr('style');
				$this.find(".ubtn-hover").removeAttr('style');
				var border_color = $this.data('border-color');
				var old_style = $this.attr('style');
				if($this.data('shadow-hover') != '')
					old_style += 'box-shadow:'+$this.data('shadow');
				$this.attr('style', old_style);
				if($this.data('border-hover') != '')
				{
					$this.css("border-color",border_color);
				}
				if($this.data('shadow-click') != 'none')
				{
					$this.removeClass('no-ubtn-shadow');
					if($this.is('.shd-left') != '')
						$this.css({ 'right':'auto'});
					else if($this.is('.shd-right') != '')
						$this.css({ 'left':'auto' });
					else if($this.is('.shd-top') != '')
						$this.css({ 'bottom':'auto' });
					else if($this.is('.shd-bottom') != '')
						$this.css({ 'top':'auto' });
				}
			}
		);
		
		jQuery(".ult-new-ib").hover(
			function(){
				jQuery(this).find(".ult-new-ib-img").attr("style","opacity:"+jQuery(this).data('hover-opacity'));
			},
			function(){
				jQuery(this).find(".ult-new-ib-img").attr("style","opacity:"+jQuery(this).data('opacity'));
			}
		);

		jQuery(".ubtn").on("focus blur mousedown mouseup", function(e) {
			var $this = jQuery(this);
			if($this.data('shadow-click') != 'none')
			{
				setTimeout(function() {
					if($this.is( ":focus" ))
					{
						$this.addClass("no-ubtn-shadow");
						if($this.is('.shd-left') != '')
							$this.css({ 'right':$this.data('shd-shadow')+'px'});
						else if($this.is('.shd-right') != '')
							$this.css({ 'left':$this.data('shd-shadow')+'px' });
						else if($this.is('.shd-top') != '')
							$this.css({ 'bottom':$this.data('shd-shadow')+'px' });
						else if($this.is('.shd-bottom') != '')
							$this.css({ 'top':$this.data('shd-shadow')+'px' });
					}
					else
					{
						$this.removeClass("no-ubtn-shadow");
						if($this.is('.shd-left') != '')
							$this.css({ 'right':'auto'});
						else if($this.is('.shd-right') != '')
							$this.css({ 'left':'auto' });
						else if($this.is('.shd-top') != '')
							$this.css({ 'bottom':'auto' });
						else if($this.is('.shd-bottom') != '')
							$this.css({ 'top':'auto' });
					}
				}, 0 );
			}
		});
		jQuery(".ubtn").focusout(function(){
			var $this = jQuery(this);
			$this.removeClass("no-ubtn-shadow");
			if($this.is('.shd-left') != '')
				$this.css({ 'right':'auto'});
			else if($this.is('.shd-right') != '')
				$this.css({ 'left':'auto' });
			else if($this.is('.shd-top') != '')
				$this.css({ 'bottom':'auto' });
			else if($this.is('.shd-bottom') != '')
				$this.css({ 'top':'auto' });
		});

		
		jQuery('.smile-icon-timeline-wrap.jstime').css('opacity','0');
		jQuery('.jstime.timeline_preloader').css('opacity','1');
		jQuery('.smile-icon-timeline-wrap.csstime .timeline-wrapper').each(function(){
			jQuery('.csstime .timeline-block:even').addClass('timeline-post-left');
			jQuery('.csstime .timeline-block:odd').addClass('timeline-post-right');
		})
		jQuery('.csstime .timeline-post-right').each(function(){
			jQuery(this).css('float','right');
			jQuery("<div style='clear:both'></div>").insertAfter(jQuery(this));
		})
		jQuery('.csstime.smile-icon-timeline-wrap').each(function(){
			var block_bg =jQuery(this).data('time_block_bg_color');
			jQuery(this).find('.timeline-block').css('background-color',block_bg);
		    jQuery(this).find('.timeline-post-left.timeline-block l').css('border-left-color',block_bg);
		    jQuery(this).find('.timeline-post-right.timeline-block l').css('border-right-color',block_bg);	
		    jQuery(this).find('.feat-item').css('background-color',block_bg);	
		    if(jQuery(this).find('.feat-item').find('.feat-top').length > 0)
				jQuery(this).find('.feat-item l').css('border-top-color',block_bg);	
			else
				jQuery(this).find('.feat-item l').css('border-bottom-color',block_bg);
			timeline_icon_setting(jQuery(this));
		})
		// CSS3 Transitions.
		jQuery('*').each(function(){
			if(jQuery(this).attr('data-animation')) {
				var animationName = jQuery(this).attr('data-animation'),
					animationDelay = "delay-"+jQuery(this).attr('data-animation-delay');
				jQuery(this).bsf_appear(function() {
					var $this = jQuery(this);
					//$this.css('opacity','0');
					//setTimeout(function(){
						$this.addClass('animated').addClass(animationName);
						$this.addClass('animated').addClass(animationDelay);
						//$this.css('opacity','1');
					//},1000);
				});
			} 
		});
		// Icon Tabs
		// Stats Counter
		jQuery('.stats-block').each(function() {
			jQuery(this).bsf_appear(function() {
				var endNum = parseFloat(jQuery(this).find('.stats-number').data('counter-value'));
				var Num = (jQuery(this).find('.stats-number').data('counter-value'))+' ';
				var speed = parseInt(jQuery(this).find('.stats-number').data('speed'));
				var ID = jQuery(this).find('.stats-number').data('id');
				var sep = jQuery(this).find('.stats-number').data('separator');
				var dec = jQuery(this).find('.stats-number').data('decimal');
				var dec_count = Num.split(".");
				if(dec_count[1]){
					dec_count = dec_count[1].length-1;
				} else {
					dec_count = 0;
				}
				var grouping = true;
				if(dec == "none"){
					dec = "";
				}
				if(sep == "none"){
					grouping = false;
				} else {
					grouping = true;
				}
				var settings = {
					useEasing : true, 
					useGrouping : grouping, 
					separator : sep, 
					decimal : dec
				}
				var counter = new countUp(ID, 0, endNum, dec_count, speed, settings);
				setTimeout(function(){
					counter.start();
				},500);
			});
		});
		// Flip-box	
		if(! /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) )
				var is_touch_device = false;
			else
				var is_touch_device = true;	
			
		jQuery('#page').click(function(){			
			jQuery('.ifb-hover').removeClass('ifb-hover');
		});
		if(!is_touch_device){
			jQuery('.ifb-flip-box').hover(function(event){			
				event.stopPropagation();				
				jQuery(this).addClass('ifb-hover');	
			},function(event){
				event.stopPropagation();
				jQuery(this).removeClass('ifb-hover');			
			});
		}
		jQuery('.ifb-flip-box').each(function(index, element) {
			if(jQuery(this).parent().hasClass('style_9')) {
				jQuery(this).hover(function(){
						jQuery(this).addClass('ifb-door-hover');						
					},
					function(){
						jQuery(this).removeClass('ifb-door-hover');
					})
				jQuery(this).on('click',function(){
						jQuery(this).toggleClass('ifb-door-right-open');
						jQuery(this).removeClass('ifb-door-hover');						
					});
			}
		});
		jQuery('.ifb-flip-box').click(function(event){
			event.stopPropagation();
			if(jQuery(this).hasClass('ifb-hover')){				
				jQuery(this).removeClass('ifb-hover');							
			}
			else{
				jQuery('.ifb-hover').removeClass('ifb-hover');
				jQuery(this).addClass('ifb-hover');
			}
		});

		//Flipbox
			//Vertical Door Flip
			jQuery('.vertical_door_flip .ifb-front').each(function() {
				jQuery(this).wrap('<div class="v_door ifb-multiple-front ifb-front-1"></div>');
				jQuery(this).parent().clone().removeClass('ifb-front-1').addClass('ifb-front-2').insertAfter(jQuery(this).parent());
			});
			//Reverse Vertical Door Flip
			jQuery('.reverse_vertical_door_flip .ifb-back').each(function() {
				jQuery(this).wrap('<div class="rv_door ifb-multiple-back ifb-back-1"></div>');
				jQuery(this).parent().clone().removeClass('ifb-back-1').addClass('ifb-back-2').insertAfter(jQuery(this).parent());
			});
			//Horizontal Door Flip
			jQuery('.horizontal_door_flip .ifb-front').each(function() {
				jQuery(this).wrap('<div class="h_door ifb-multiple-front ifb-front-1"></div>');
				jQuery(this).parent().clone().removeClass('ifb-front-1').addClass('ifb-front-2').insertAfter(jQuery(this).parent());
			});
			//Reverse Horizontal Door Flip
			jQuery('.reverse_horizontal_door_flip .ifb-back').each(function() {
				jQuery(this).wrap('<div class="rh_door ifb-multiple-back ifb-back-1"></div>');
				jQuery(this).parent().clone().removeClass('ifb-back-1').addClass('ifb-back-2').insertAfter(jQuery(this).parent());
			});
			//Stlye 9 front
			jQuery('.style_9 .ifb-front').each(function() {
				jQuery(this).wrap('<div class="new_style_9 ifb-multiple-front ifb-front-1"></div>');
				jQuery(this).parent().clone().removeClass('ifb-front-1').addClass('ifb-front-2').insertAfter(jQuery(this).parent());
			});
			//Style 9 back
			jQuery('.style_9 .ifb-back').each(function() {
				jQuery(this).wrap('<div class="new_style_9 ifb-multiple-back ifb-back-1"></div>');
				jQuery(this).parent().clone().removeClass('ifb-back-1').addClass('ifb-back-2').insertAfter(jQuery(this).parent());
			});
			var is_safari = /^((?!chrome).)*safari/i.test(navigator.userAgent);
			if( is_safari ){
				jQuery('.vertical_door_flip').each(function(index, element) {
                    var safari_link = jQuery(this).find('.flip_link').outerHeight();
					jQuery(this).find('.flip_link').css('top', - safari_link/2 +'px');
                    jQuery(this).find('.ifb-multiple-front').css('width', '50.2%');
                });
				jQuery('.horizontal_door_flip').each(function(index, element) {
                    var safari_link = jQuery(this).find('.flip_link').outerHeight();
					jQuery(this).find('.flip_link').css('top', - safari_link/2 +'px');
                    jQuery(this).find('.ifb-multiple-front').css('height','50.2%');
                });
				jQuery('.reverse_vertical_door_flip').each(function(index, element) {
                    var safari_link = jQuery(this).find('.flip_link').outerHeight();
					jQuery(this).find('.flip_link').css('top', - safari_link/2 +'px');
                });
				jQuery('.reverse_horizontal_door_flip').each(function(index, element) {
                    var safari_link = jQuery(this).find('.flip_link').outerHeight();
					jQuery(this).find('.flip_link').css('top', - safari_link/2 +'px');
					jQuery(this).find('.ifb-back').css('position', 'inherit');
                });
			}
			//Info Box
			jQuery('.square_box-icon').each(function(index, element) {
                var ib_box_style_icon_height = parseInt(jQuery(this).find('.aio-icon').outerHeight());
				var ib_padding = ib_box_style_icon_height/2;
				//var icon_pos = ib_box_style_icon_height*2;
				jQuery(this).css('padding-top', ib_padding+'px');
				jQuery(this).parent().css('margin-top', ib_padding+20+'px');
				jQuery(this).find('.aio-icon').css('top', - ib_box_style_icon_height+'px');
            });
	}); //end document ready event
	
	function timeline_icon_setting(ele) //setting to est icon if any
	{
		if(ele.find('.timeline-icon-block').length > 0)
		{
			$('.timeline-block').each(function(index, element) {
				var $hbblock = $(this).find('.timeline-header-block');
				var $icon = $(this).find('.timeline-icon-block');
				$icon.css({'position':'absolute'});
				var icon_height = $icon.outerHeight();
				var icon_width = $icon.outerWidth();
				var diff_pos = -(icon_width/2);
				var padding_fixer = parseInt($hbblock.find('.timeline-header').css('padding-left').replace ( /[^\d.]/g, '' ));
				if($(this).hasClass('timeline-post-left'))
				{
					$icon.css({'left':diff_pos,'right':'auto'});
					$hbblock.css({'padding-left':((icon_width/2)+padding_fixer)+'px'});
				}
				else if($(this).hasClass('timeline-post-right'))
				{
					$icon.css({'left':'auto','right':diff_pos});
					$hbblock.css({'padding-right':((icon_width/2)+padding_fixer)+'px'});
				}
				var blheight = $hbblock.height();
				var blmidheight = blheight/2;
				var icon_mid_height = icon_height/2;
				var diff = blmidheight - icon_mid_height;
				$icon.css({'top':diff});
				var tleft = $icon.offset().left;
				var winw = $(window).width();

				if(0 > tleft || winw < (tleft+icon_width))
				{
					$icon.css({'position':'relative','top':'auto','left':'auto','right':'auto','text-align':'center'});
					$icon.children().children().css({'margin':'10px auto'});
					$hbblock.css({'padding':'0'});
				}
			});
		}
	}

	// CSS3 Transitions.
	function animate_block(){
		jQuery('.ult-animation').each(function(){
			if(jQuery(this).attr('data-animate')) {
				//var child = jQuery(this).children('div');
				var child2 = jQuery(this).children('*');
				//var child = jQuery('.ult-animation > *');
				//console.log(child);
				var animationName = jQuery(this).attr('data-animate'),
					animationDuration = jQuery(this).attr('data-animation-duration')+'s',
					animationIteration = jQuery(this).attr('data-animation-iteration'),
					animationDelay = jQuery(this).attr('data-animation-delay');
				var style = 'opacity:1;-webkit-animation-delay:'+animationDelay+'s;-webkit-animation-duration:'+animationDuration+';-webkit-animation-iteration-count:'+animationIteration+'; -moz-animation-delay:'+animationDelay+'s;-moz-animation-duration:'+animationDuration+';-moz-animation-iteration-count:'+animationIteration+'; animation-delay:'+animationDelay+'s;animation-duration:'+animationDuration+';animation-iteration-count:'+animationIteration+';';
				var container_style = 'opacity:1;-webkit-transition-delay: '+(animationDelay)+'s; -moz-transition-delay: '+(animationDelay)+'s; transition-delay: '+(animationDelay)+'s;';
				if(isAppear(jQuery(this))){
					var p_st = jQuery(this).attr('style');
					if(typeof(p_st) == 'undefined'){
						p_st = 'test';
					}
					p_st = p_st.replace(/ /g,'');
					if(p_st == 'opacity:0;'){
						if( p_st.indexOf(container_style) !== 0 ){
							jQuery(this).attr('style',container_style);
						}
					}
				}
				//jQuery(this).bsf_appear(function() {
				jQuery.each(child2,function(index,value){
					var $this = jQuery(value);
					var prev_style = $this.attr('style');
					if(typeof(prev_style) == 'undefined'){
						prev_style = 'test';
					}
					var new_style = '';
					if( prev_style.indexOf(style) == 0 ){
						new_style = prev_style;
					} else {
						new_style = style+prev_style;
					}
					$this.attr('style',new_style);
					if(isAppear($this)){
						$this.addClass('animated').addClass(animationName);
					}
				});
			} 
		});
	}

	function isAppear(id){
		var window_scroll = jQuery(window).scrollTop();
		var window_height = jQuery(window).height();
		
		if(jQuery(id).hasClass('ult-animate-viewport'))
			var start_effect = jQuery(id).data('opacity_start_effect');
		
		if(typeof(start_effect) === 'undefined' || start_effect == '')
			var percentage = 2;
		else
			var percentage = 100 - start_effect;
				
		var element_height = jQuery(id).outerHeight();
		var element_top = jQuery(id).offset().top;
		var position = element_top - window_scroll;

		var cut = window_height - (window_height * (percentage/100));
	
		if(position <= cut)
			return true;
		else
			return false;
	};

	// function for IB responsive
	function ib_responsive(){
		var new_ib = jQuery(".ult-new-ib");
		new_ib.each(function(index, element) {
           var $this = jQuery(this); 
		   if($this.hasClass("ult-ib-resp")){
				var w = jQuery(document).width();
				var ib_min = $this.data("min-width");
				var ib_max = $this.data("max-width");
				if(w <= ib_max && w >= ib_min){
					$this.find(".ult-new-ib-content").hide();
				} else {
					$this.find(".ult-new-ib-content").show();
				}
			}
        });
	}
	
	//function for resize spacer 
	function init_ultimate_spacer()
	{
		$('.ult-spacer').each(function(i,spacer){
			var scrollbarWidth;
			$(document).ready(function() {
				var div = document.createElement('div');

				div.style.overflowY = 'scroll';
				div.style.width =  '50px';
				div.style.height = '50px';

				div.style.visibility = 'hidden';

				document.body.appendChild(div);
				scrollbarWidth = div.offsetWidth - div.clientWidth;
				document.body.removeChild(div);

			});
			var uid = $(spacer).data('id');
			var body_width = $(window).width() + scrollbarWidth;
			var height_on_mob = $(spacer).data('height-mobile');
			var height_on_tabs = $(spacer).data('height-tab');
			var height = $(spacer).data('height');
			if(body_width <= 799){
				$(".spacer-"+uid).height(height_on_mob);
			} else if (body_width >= 799 && body_width <= 1024){
				$(".spacer-"+uid).height(height_on_tabs);
			} else if (body_width >= 1024){
				$(".spacer-"+uid).height(height);
			}
		});
	}

})(jQuery);
//ready

//resize map 
function resize_uvc_map(map, wrap)
{
	var map_override = jQuery('#'+map).attr('data-map_override');
	var is_relative = 'true';				
	if(jQuery('#'+wrap).parents('.wpb_column').length > 0)
		var ancenstor = jQuery('#'+wrap).parents('.wpb_column');
	else if(jQuery('#'+wrap).parents('.vc-row-wrapper').length > 0)
		var ancenstor = jQuery('#'+wrap).parents('.vc-row-wrapper');
	else
		var ancenstor = jQuery('#'+wrap).parent();
	var parent = ancenstor;
	if(map_override=='full'){
		ancenstor= jQuery('body');
		is_relative = 'false';
	}
	if(map_override=='ex-full'){
		ancenstor= jQuery('html');
		is_relative = 'false';
	}
	if( ! isNaN(map_override)){
		for(var i=1;i<map_override;i++){
			if(ancenstor.prop('tagName')!='HTML'){
				ancenstor = ancenstor.parent();
			}else{
				break;
			}
		}
	}
	if(is_relative == 'false')
		var w = ancenstor.outerWidth();
	else
		var w = ancenstor.width();
	var mheight = jQuery('#'+map).outerHeight();
	//parent.css({'height':mheight+'px'});		
	var map_left = jQuery('#'+map).offset().left;
	var map_left_pos = jQuery('#'+map).position().left;
	var div_left = ancenstor.offset().left;
	var cal_left = div_left - map_left;
	if(map_left_pos < 0)
		cal_left = map_left_pos + cal_left;
	else
		cal_left = map_left_pos - map_left;
	jQuery('#'+map).css({'position':'absolute','width': w,'min-width':w});
	if(is_relative == 'false')
		jQuery('#'+map).css({'left': cal_left });
}

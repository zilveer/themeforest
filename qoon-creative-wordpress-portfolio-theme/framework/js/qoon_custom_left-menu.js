jQuery.noConflict()(function($){
	"use strict";
	 $('.oi_xfull').css('height',$(window).height())
	 /*MODERN PORTFOLIO*/
	 if($('body').hasClass('oi_ps_modern')){
		 $('body').mousemove(function( e ) {
			 if(!$('body').hasClass('stop_hovers')){
				 var x = e.pageX/80;
				 var y = e.pageY/80
				 $('.oi_modern_p_content .oi_c_title').css({'margin-top':y*1,'margin-left':x*1});
				 $('.oi_modern_p_prev').css({'margin-top':y-20,'margin-left':x-20});
				 $('.oi_modern_p_next').css({'margin-bottom':y-20,'margin-left':x-20});
				 $('.oi_m_description_content').css({'margin-bottom':y*3,'margin-right':x*3});
				 $('.oi_modern_p_item').css({'margin-top':y-20,'margin-left':x-20});
				 $('.oi_modern_p_up').css({'margin-top':(y-15)*2,'margin-left':(x-15)*2});
				 $('.oi_modern_p_down').css({'margin-bottom':(y-15)*2,'margin-left':(x-15)*2});
			 };
		});
		
		jQuery(document).ready(function($) {
			var id = $('.oi_modern_p_content').attr('data-id');
			var prev = $('.oi_modern_p_content').attr('data-last');
			var tags = $('.oi_modern_p_content').attr('data-tags');
			$('.oi_creative_p_content').animate({'opacity': 0,'bottom':'100px'	}, 100);
			
			$.get
			  (
			  
			   oi_theme.ajax_url,{'action': 'qoon_ajax_request_m', 'id' : id.toString(), 'prev' : prev.toString(), 'type': "live", 'tags':tags},function(result,status)
				{
					$(result.new_posts).imagesLoaded( function(){
						$('.oi_modern_p_prev').attr('style','background-image:url("'+result.new_posts.prev+'")');
						$('.oi_modern_p_next').attr('style','background-image:url("'+result.new_posts.next+'")');
						
						$('.oi_modern_p_next').attr('data-id',result.new_posts.nextid);
						$('.oi_modern_p_prev').animate({'opacity': '1'},300);
						$('.oi_modern_p_next').animate({'opacity': '1'},300);
						$('.oi_modern_p_arrows').animate({'opacity': '1'},300);
						$('.oi_modern_p_item').animate({'opacity': '1'},300);
						$('.oi_m_description_content').animate({'opacity': '1'},300);
					});
				},
			  "json"
			 );
		});
		
		
		$('.oi_modern_p_arrows a').click(function(e) {
			$('.oi_m_description_content').animate({'opacity': '0','right':'-100px'},300);
			$('.oi_modern_p_item').animate({'opacity': '0','right':'-100px'},300);
			var first = $('.oi_modern_p_content').attr('data-id');
			var last = $('.oi_modern_p_content').attr('data-last');
			var thisis = $(this);
			var tags = $('.oi_modern_p_content').attr('data-tags');
			var id = $(this).attr('data-id');

			$.get
				  (
				  oi_theme.ajax_url,{'action': 'qoon_ajax_request_m_load', 'id' : id.toString(), 'first' : first.toString(), 'last': last.toString(), 'tags':tags},function(result,status)
					{
						$(result.new_posts).imagesLoaded( function(){
							$('.oi_modern_p_item').css('background-image','url("'+result.new_posts.url+'")');
							$('.oi_next_m_p').attr('data-id',result.new_posts.next);
							$('.oi_prev_m_p').attr('data-id',result.new_posts.prev);
							$('.oi_c_title a, .oi_c_details').attr('href',result.new_posts.details);
							$('.oi_c_title a').html(result.new_posts.title);
							$('.oi_c_date').html(result.new_posts.date);
							$('.oi_c_cats').html(result.new_posts.cat);
							$('.oi_cm_links').attr('data-link-id',id);
							$('.oi_mp_d').html(result.new_posts.descr);
								$('.oi_m_description_content').css({'right':''}).animate({'opacity': '1'},300);
								$('.oi_modern_p_item').animate({'opacity': '1','right':''},300);
						});
					},
				  "json"
				 );
			
		});
		
		
		
	 };
	/*END MODERN PORTFOLIO*/
	
	 if($('.oi_page_holder').hasClass('oi_full_port_page_raw_scroller')){
		if($('.vc_video-bg-container').length){
		$(window).load(function() {
			$('.vc_video-bg-container').append('<div class="oi_mute"><i class="fa fa-fw fa-volume-up"></i></div>')
			var src = $('.vc_video-bg iframe').attr('src');
			var src_new = src.replace("&enablejsapi=1", "&enablejsapi=0")
			$('.vc_video-bg iframe').attr('src',src_new);
			$('.oi_mute').live('click',function() {
				$(this).find('i').toggleClass('fa-volume-up fa-volume-off')
				if(($('.vc_video-bg iframe').attr('src').indexOf("&enablejsapi=1")>=0)){
					$('.vc_video-bg iframe').attr('src',src_new);
				}else{
					$('.vc_video-bg iframe').attr('src',src);
				}
			});
		});
		};
		
		
		if($('body').outerWidth() > 767){
			$('body').addClass('oi_overh');
		if($('body').hasClass('single-portfolio')){
			$(".oi_portfolio_page_holder > .vc_row").each(function(i){
			 $(this).wrap( function(){
			 	return "<div class='section'></div>";
		 	 });
		});
		}else{
		$(".oi_sections_holder > .row > .col-md-12 > .vc_row").each(function(i){
			 $(this).wrap( function(){
			 	return "<div class='section'></div>";
		 	 });
		});
		}
		$('.oi_portfolio_page_holder').fullpage({
			navigation:true,
			showActiveTooltip: true,
			afterLoad: function(anchorLink, index){
				var loadedSection = $(this);
				if($('.oi_portfolio_page_holder .section').last().hasClass('active')){
					$('.oi_full_port_page_raw_scroller .oi_port_nav').addClass('oi_show_this')
				}else{
					$('.oi_full_port_page_raw_scroller .oi_port_nav').removeClass('oi_show_this')
					}
			}
		});
		
		$('.oi_sections_holder').fullpage({
			navigation:true,
			showActiveTooltip: true,
		});
		
		}
		
	 };
	 
 	$('.oi_page_holder.oi_full_f_page').css({'margin-top': -$('.oi_page_holder.oi_full_f_page').outerHeight()/2,})
	
	/*FIRST TIME LOAD*/
		$('body.oi_will_be_full_page .oi_slide_header_side').hide();
		if(oi_theme.show_ajax ==1){
			$('.oi_loader').css('display','block');
		}
		$('.oi_loader').animate({'opacity': 1	}, 300);
		if($('body').outerWidth()< 1100){
			var ws = $('.oi_header_side').outerWidth()
		}else{
			var ws = $('.oi_header_side').outerWidth()/4;
		}
		var is = $(window).width();
		$('.oi_tag_line_holder').css('max-width', ws-60)
		$('.oi_header_side').css('width','100%');
		
		if(oi_theme.show_ajax !=1){
			
				if(!$('body').hasClass('oi_will_be_full_page')){
				if($('body').outerWidth()< 1100){
					$('.oi_header_side').css({'margin-left': -ws	}, 600);
					
				}else{
				$('.oi_header_side').css({width: ws	}, 600);
				$('.oi_header_side').removeClass('oi_full_page');
				}
			  };
			  $('body').css('overflow-y','visible')
			  $('.oi_page_holder.oi_full_f_page').css({'opacity': 1	},600);
			  $('.oi_tag_line').css({'opacity': 1	}, 600)
			  $('.oi_loader').css('display','none')
			  
			  var $container = $('.oi_port_container');
			  if($container.length) {
				$container.isotope( 'reloadItems' ).isotope()
			  };
		}
		
		
		$(window).load(function() {
			if(oi_theme.show_ajax ==1){
			setTimeout(function(){
			  if(!$('body').hasClass('oi_will_be_full_page')){
				if($('body').outerWidth()< 1100){
					$('.oi_header_side').animate({'margin-left': -ws	}, 600);
					
				}else{
				$('.oi_header_side').animate({width: ws	}, 600);
				$('.oi_header_side').removeClass('oi_full_page');
				}
			  };
			  $('body').css('overflow-y','visible')
			  $('.oi_page_holder.oi_full_f_page').animate({'opacity': 1	},600);
			  $('.oi_tag_line').animate({'opacity': 1	}, 600)
			  $('.oi_loader').css('display','none')
			  
			  var $container = $('.oi_port_container');
			  if($container.length) {
				$container.isotope( 'reloadItems' ).isotope()
			  };
			  
			}, 600);
			}
			
			if($('body').outerWidth()< 1100){
				setTimeout(function(){ $('#menu_slide_xs').animate({'opacity': 1	}, 600)}, 1600);
				$('#menu_slide_xs').click(function(e) {
					e.preventDefault();
					$('#nav-toggle').toggleClass("active");
					if($('#nav-toggle').hasClass("active")){
						if($('body').outerWidth()>778){
							$('.oi_header_side').animate({'margin-left': 0	}, 600);
						}else{
							if($('body').hasClass('oi_will_be_full_page')){
								if($('body').hasClass('oi_ps_creative')){
									$('.oi_ps_creative .menu-main-menu-container').animate({'margin-left': 0	}, 600);
									$('.oi_creative_p_content').animate({'margin-bottom': '-400px'	}, 300);
								}else{
									$('.oi_will_be_full_page:not(.oi_ps_creative) .oi_full_page ').animate({'margin-left': 0	}, 600);
									$('.oi_full_f_page').animate({'opacity': 0	}, 200);
									setTimeout(function(){ $('.oi_full_f_page').css('display','none')}, 200);
								}
							}else{
								$('.oi_header_side').animate({'margin-left': 0	}, 600);
							}
						}
					}else{
						if($('body').outerWidth()>778){
							$('.oi_header_side').animate({'margin-left': -ws	}, 600);
						}else{
							if($('body').hasClass('oi_will_be_full_page')){
								if($('body').hasClass('oi_ps_creative')){
									$('.oi_ps_creative .menu-main-menu-container').animate({'margin-left': '-100%'	}, 600);
									$('.oi_creative_p_content').animate({'margin-bottom': '0'	}, 300);
								}else{
									$('.oi_will_be_full_page:not(.oi_ps_creative) .oi_full_page ').animate({'margin-left': '-100%'	}, 600);
									$('.oi_full_f_page').css('display','block')
									setTimeout(function(){ $('.oi_full_f_page').animate({'opacity': 1	}, 200);}, 200);
								}
							}else{
								$('.oi_header_side').animate({'margin-left': -ws	}, 600);
							}
						}
					}
				});
			}
		});

	
	
/*END ---- FIRST TIME LOAD*/
/*************************************/
if(oi_theme.home_blog ==='0'){
$('.oi_sub_header_side').perfectScrollbar();
}
if($('body').hasClass('oi_left_sb')){
	$('.oi_sub_header_side').perfectScrollbar();
}
if($('body').hasClass('oi_right_sb')){
	$('.oi_page_holder').perfectScrollbar();
}
	
/*************************************/	
/*MENU*/
	$('.menu-item-has-children > a').click(function(e) {
		$(this).parent().find(' > ul').prepend('<li class="oi_go_back"><span><i class="fa fa-long-arrow-left"></i> '+$(this).html()+'</span></li>')
		$(this).parent().parent().find('> li > a').animate({'opacity':0}, 100)
		$(this).parent().find('> ul').css('display','block').animate({'opacity':1	,'margin-left':0}, 400)
		
		$('.oi_go_back').click(function(e) {
			$(this).parent().animate({'opacity':0}, 100).css('display','none').css('margin-left','100px');
			$(this).parent().parent().parent().find('>li > a').animate({'opacity':1}, 100)	
			$(this).remove();
		});
		e.preventDefault();
	});
/*END ---- MENU*/
/*************************************/		
/*************************************/	
/*CHANGE PAGE AJAX*/
	$('.oi_c_details').click(function(e) {
		$('.oi_creative_p_content, .oi_m_holder').animate({'opacity': 0}, 300);
	});
	$('.oi_c_title a').click(function(e) {
		$('.oi_creative_p_content, .oi_m_holder').animate({'opacity': 0}, 300);
	});
	
	$('.oi_c_resize').click(function(e) {
		if($(this).parent().parent().hasClass('oi_c_up')){
			$(this).parent().parent().removeClass('oi_c_up');
			$('.oi_c_description').slideToggle();
		}else{
			$('.oi_c_description').slideToggle();
			$(this).parent().parent().addClass('oi_c_up');
		}
	});
	
	
	if($('#oi_current_image_shortcode').length){
		$('#oi_current_image_shortcode').height($(window).outerHeight())
		$('#oi_next_image_shortcode').height($(window).outerHeight())
	}
	
	$('.oi_crea_a').click(function(e) {
		var first = $('.oi_creative_p_content').attr('data-first');
		var last = $('.oi_creative_p_content').attr('data-last');
		var tags = $('.oi_creative_p_content').attr('data-tags');
		if($('#oi_current_image_shortcode').length){
			var img = $('#oi_current_image_shortcode').css('background-image');
			img = img.replace('url("','"').replace(')','');
		}else{
			var img = $('#oi_current_image').attr('style');
		}
		var id = $(this).attr('data-id');
		
		$('.oi_creative_p_content').animate({'opacity': 0,'bottom':'100px'	}, 100);
		
		$.get
			  (
			  oi_theme.ajax_url,{'action': 'qoon_ajax_request_c', 'id' : id.toString(), 'first' : first.toString(), 'last': last.toString(), 'tags':tags},function(result,status)
				{
					$(result.new_posts).imagesLoaded( function(){
						if($('#oi_current_image_shortcode').length){
							$('#oi_current_image_shortcode').css('background-image','url('+img+')');
							$('#oi_next_image_shortcode').css('background-image','url("'+result.new_posts.url+'")')
						}else{
							$('#oi_current_image').attr('style',img);
							$('#oi_next_image').attr('style','background:url("'+result.new_posts.url+'")')
						}
						
						$('.oi_creative_p_content').css({'bottom':'50px'})
						
						$('.oi_prev_c_p').attr('data-id',result.new_posts.prev);
						$('.oi_next_c_p').attr('data-id',result.new_posts.next);
						$('.oi_c_title a').html(result.new_posts.title);
						$('.oi_c_date').html(result.new_posts.date);
						$('.oi_c_cats').html(result.new_posts.cat);
						$('.oi_c_description_content').html(result.new_posts.descr);
						$('.oi_c_details').attr('href',result.new_posts.details);
						$('.oi_c_title a').attr('href',result.new_posts.details);
						$('.oi_c_title a').attr('data-id',result.new_posts.cur);
						$('.oi_c_details').attr('data-id',result.new_posts.cur);
						if($('#oi_current_image_shortcode').length){
							$('#oi_next_image_shortcode').animate({'opacity': 1}, 600);
							setTimeout(function(){$('#oi_current_image_shortcode').css('background-image','url("'+result.new_posts.url+'")')}, 560);
							setTimeout(function(){$('#oi_next_image_shortcode').animate({'opacity': 0}, 100)}, 600);
						}else{
							$('#oi_next_image').animate({'opacity': 1}, 600);
							setTimeout(function(){$('#oi_current_image').attr('style','background:url("'+result.new_posts.url+'")')}, 560);
						}
						setTimeout(function(){$('.oi_creative_p_content').animate({'opacity': 1}, 300)}, 360);
						
						
					});
				},
			  "json"
			 );
		e.preventDefault();
	});
	
if(oi_theme.show_ajax ==1){	
	if(oi_theme.is_blog || oi_theme.is_blog_t){
		$('.oi_list_cats a, a.oi_post_image:not(.oi_must_zoom), a.blog_title_a, .oi_readmore_btn, .page-numbers').click(function(e) {
			var href = $(this).attr('href');
			$('.oi_page_holder, .oi_sub_header_side ').animate({'opacity': 0	},300); 
			$('.oi_header_side').animate({width: $(window).width()}, 550)
			setTimeout(function(){$('body').css('overflow-y','hidden'); $('.oi_header_side').css('width', $(window).width())}, 560);
			
			setTimeout(function(){$('.oi_loader').css('display','block');}, 600);
			$('.oi_loader').find('.numbers').html('0%');
			$('.oi_loader').find('i').removeClass('active');
			$('.dots i').removeClass("stop-animating")
			$('.oi_loader').animate({'opacity': 1	}, 600)
			setTimeout(function(){location.href = href;}, 400);
			e.preventDefault();
		});
		
	}
	

	$('.oi_main_menu li:not(.menu-item-has-children) a, .oi_strange_portfolio_item a, .oi_port_nav a, .oi_cm_links, .oi_c_title a, .oi_c_details ').live( "click", function(e) {
		$('.oi_page_holder.oi_full_f_page').animate({'opacity': 0	},100);
		$('.oi_page_holder').animate({'opacity': 0	},600);
		$('.oi_sub_header_side').animate({'opacity': 0	},600);
		
		var href = $(this).attr('href'); 
		$('.oi_header_side').animate({width: $(window).width()}, 550)
		setTimeout(function(){$('body').css('overflow-y','hidden'); $('.oi_header_side').css('width', $(window).width())}, 560);
		setTimeout(function(){$('.oi_loader').css('display','block');}, 600);
		$('.oi_loader').find('.numbers').html('0%');
		$('.oi_loader').find('i').removeClass('active');
		$('.dots i').removeClass("stop-animating")
		$('.oi_loader').animate({'opacity': 1	}, 600)
		e.preventDefault();
				if ($(this).parent().hasClass('oi_vc_potrfolio')){
						var $menu_item = $(this).attr('data-id');
						var $type ='portfolio';
					}else if($(this).parent().hasClass('oi_np_link')){
						var $menu_item =$(this).find('.oi_a_holder').attr('data-id');
						var $type ='portfolio';
					}else if($(this).hasClass('oi_cm_links')){
						var $menu_item = $(this).attr('data-link-id');
						var $type ='portfolio';
					}else if( $(this).attr('data-menu')=='no'){
						var $menu_item =$(this).attr('data-id').match(/\d+/);
						var $type ='portfolio'
					}else{
						var $menu_item = $(this).parent().attr('id').match(/\d+/);
						var $type ='post'
					};
				$.get
				  (
				  oi_theme.ajax_url,{'action': 'qoon_ajax_request', 'menu_item' : $menu_item.toString(), 'type' : $type},function(result,status)
					{$(result.new_posts).imagesLoaded( function(){
							$('#oi_next_image').attr('style','background:url("'+result.new_posts.url+'")')
							$('.oi_page_holder').animate({'opacity': 0}, 100)
							$('#oi_current_image').animate({'opacity': 0}, 600);
							$('.oi_page_holder').animate({'opacity': 0}, 600);
							$('#oi_next_image').animate({'opacity': 1}, 600);
							$('.oi_tag_line').animate({'opacity': 0	}, 600);
							setTimeout(function(){location.href = href;}, 400);
						});
						
						
					},
				  "json"
				 );
			e.preventDefault();
		}); 
}
/*END ---- CHANGE PAGE AJAX*/
/*************************************/		
	$('.oi_treingle_holder').hover(
		function() {
			setTimeout(function(){
			  $('.oi_f_date').addClass( "oi_on_top" );
			}, 300);
		}, function() {
			$('.oi_f_date').removeClass( "oi_on_top" );
		}
	);
	$('.oi_xs_menu').click(function(e) {
		e.preventDefault();
		$('.oi_main_menu').toggleClass('must_show_menu')
	});
	$('.oi_xs_menu_top_left').click(function(e) {
		e.preventDefault();
		$('.oi_left_menu').toggleClass('must_show_menu')
	});
$({numValue: 1}).animate({numValue: 100}, {
  duration: 1000,
  easing:'swing',
  step: function() {
    $('.numbers').text(Math.ceil(this.numValue)+'%');
  }
});
$('.tri-1').delay(100).queue(function(){
    $(this).addClass("active");
});
$('.tri-2').delay(200).queue(function(){
    $(this).addClass("active");
});
$('.tri-3').delay(300).queue(function(){
    $(this).addClass("active");
});
$('.tri-4').delay(400).queue(function(){
    $(this).addClass("active");
});
$('.tri-5').delay(500).queue(function(){
    $(this).addClass("active");
});
$('.tri-6').delay(600).queue(function(){
    $(this).addClass("active");
});
$('.tri-7').delay(700).queue(function(){
    $(this).addClass("active");
});
$('.tri-8').delay(800).queue(function(){
    $(this).addClass("active");
});
$('.tri-9').delay(900).queue(function(){
    $(this).addClass("active");
});
$('.tri-10').delay(1000).queue(function(){
    $(this).addClass("active");
});
$('.tri-11').delay(1100).queue(function(){
    $(this).addClass("active");
});
$('.tri-12').delay(1200).queue(function(){
    $(this).addClass("active");
});
$('.tri-13').delay(1300).queue(function(){
    $(this).addClass("active");
});
$('.tri-14').delay(1400).queue(function(){
    $(this).addClass("active");
});
$('.tri-15').delay(1500).queue(function(){
    $(this).addClass("active");
});
$('.tri-16').delay(1600).queue(function(){
    $(this).addClass("active");
});

$('.dots i').delay(1700).queue(function(){
    $(this).addClass("stop-animating");
});


var win = 0;
$( window ).load( function(){
   win = $( window ).width();
});


$(window).bind('resize', function(e)
{
  if (window.RT) clearTimeout(window.RT);
  window.RT = setTimeout(function()
  {
	
	if( Math.abs(win - $( window ).width())>100 ){
		$('body').css('opacity',0) 
    	this.location.reload(false); 
		win = $( window ).width();
		win='';
	}
	
  }, 100);
});



});
jQuery(document).ready(function($) {		
			
	//RESPONSIVE MENU FUNCTION
	jQuery('#responsive-menu').change(function(){
		//alert(jQuery('option:selected',this).val());
		window.location.href = jQuery('option:selected',this).val();
	})

	
	//FORCE CSS VIA JQUERY FOR OLD BROWSERS
	jQuery('#flickr_feed .flickr_badge_image:nth-child(3n+1)').css('margin-right','0px');
	jQuery('iframe[class^="PIN"]').css({'position':'absolute','z-index':'-100','bottom':'0px'});
		
		
	
	
	//BLOG VIDEO POST HOVER
	if(jQuery('article.format-video .post-thumb').length != 0){	
		jQuery('article.format-video .post-thumb').hover(
			function(){
				jQuery('.video img',this).attr('src', jQuery('.video img',this).attr('src').replace('.png','-a.png') );
			},
			function(){
				jQuery('.video img',this).attr('src', jQuery('.video img',this).attr('src').replace('-a.png','.png') );
			}
		);	
	}
	
	
	if(jQuery('.grid .brick .featuredi').length != 0){	
		jQuery(document).on('mouseover', '.grid .brick .featuredi', function() {
			jQuery('.video',this).attr('src', jQuery('.video',this).attr('src').replace('.png','-a.png') );
		});
		jQuery(document).on('mouseout', '.grid .brick .featuredi', function() {
			jQuery('.video',this).attr('src', jQuery('.video',this).attr('src').replace('-a.png','.png') );
		});
	}
	
	
	//MODERN GRID HOVER
	if(jQuery(window).width() > 980 && jQuery('.grid.modern').length != 0){
	jQuery('.grid.modern .brick').hover(
		function(){
			jQuery('.hover-info',this).fadeIn({
				duration: 300
			});
		},
		function(){
			jQuery('.hover-info',this).stop().fadeOut({
				duration: 300
			});
		}
	);
	}
	
	
	//CLASSIC GRID HOVER	
	if(jQuery('.grid-classic').length != 0 && jQuery(window).width() > 980){		
		jQuery('.grid-classic .brick .thumb').hover(
			function(){				
				jQuery('.video',this).fadeOut('fast');
			
				jQuery('.black',this).stop().fadeIn('fast');
								
				jQuery('.black .open',this).animate({
					left: '50%',
					opacity: '1'
				});
				
				jQuery('.black .go',this).animate({
					left: '50%',
					opacity: '1'
				});
			},
			function(){
				jQuery('.video',this).fadeIn();
			
				jQuery('.black',this).stop().fadeOut('fast');
								
				jQuery('.black .open',this).animate({
					left: '-50%',
					opacity: '0'
				});
				
				jQuery('.black .go',this).animate({
					left: '150%',
					opacity: '0'
				});
			}
		);
	}
	
	
	
	//KEEP MENU INSIDE THE SCREEN
	jQuery('nav ul.menu li').each(function(){
		var offset = jQuery(this).offset();
		var left = offset.left;		
		var winw = parseInt(jQuery(window).width()) / 2;
		if(left > winw){
			jQuery(this).find('ul.sub-menu li ul.sub-menu').css('left','-100%');			
		}		
	});
	
	
	//REV SLIDER BOTTOM SEP @ FULL WIDTH
	if(jQuery('.fullwidthbanner-container').length != 0){	
		jQuery('#revslider-tpborder').css({'top':'-82px','border-top':'1px solid #ebebeb;','background-image':'url(images/revslider-bottom.png)'});
		
		jQuery('#page').css('margin-top','0px');
	}
	
	
	//MASONRY	
	jQuery(window).load(function(){
		if(jQuery('.grid').length != 0){
			jQuery('.grid').masonry({ isFitWidth: true });
		}
	});
	
	
	//GALLERY WITH PRETTYPHOTO
	jQuery("a[rel^='prettyPhoto']").prettyPhoto({
		//show_title: false,
		social_tools: false
	});
	
	
	
	//TABS
	if(jQuery('.tabs,.tabs-vertical').length != 0){
		jQuery('.tabs,.tabs-vertical').tabs({
			fx: [{opacity:'toggle', duration:'normal'},
			{opacity:'toggle', duration:'normal'}]
		})
	}
	

	
	//TP CAROUSEL	
	jQuery(window).load(function(){
		if(jQuery('.tp-carousel').length != 0){
			jQuery('.tp-carousel').TPCarousel();
		}
	});
		
		
	//TP POSTS HOVER	
	var isChrome = window.chrome;
	var is_safari = navigator.userAgent.indexOf("Safari") > -1;
	jQuery('.black',this).css('display','none');
	
		if(jQuery('.tp-sc-posts').length != 0){		
			jQuery('.tp-sc-posts .content li.hasthumb').hover(
				function(){									
					var imgw = parseInt(jQuery('img',this).width());
					var imgh = parseInt(jQuery('img',this).height());
					jQuery('.black',this).css('width',imgw+'px');
					jQuery('.black',this).css('height',imgh+'px');
					/*if(isChrome || is_safari){
						jQuery('.black',this).css('margin-left','4px');
					}else{
						//jQuery('.black',this).css('margin-left','-'+(imgw+4)+'px');
					}*/
					//jQuery('.black',this).css('margin-left','-'+(imgw+4)+'px');
					
					
					
					jQuery('.black',this).stop().fadeIn('fast');
					
					jQuery('.black .hover',this).remove();
					jQuery('.black',this).append('<img src="'+template_url+'/images/thumb-hover.png" class="hover" />')				
					jQuery('.black .hover',this).animate({
						left: '50%',
						opacity: '1'
					});
					
				},
				function(){
					jQuery('.black .hover',this).animate({
						left: '-150%',
						opacity: '0'
					},function(){
						jQuery('.black .hover',this).remove();
					});
					jQuery('.black',this).stop().fadeOut('fast');
				}
			);
		}
	
	
	
	
	//TP GALLERY VIEWER		
	if(jQuery('#tp_gallery').length != 0){
		jQuery(function($){	
			
		
			//set up stylings
			$('#tp_gallery #pic_list #nav-left,#tp_gallery #pic_list #nav-right').css('display','block');
			$('#tp_gallery #pic_list #pics ul').css('width','9999px');
			$('#tp_gallery #pic_list #pics').css('height','88px');
			$('#tp_gallery #pic_list').css('height','88px');
			$('#content #tp_gallery #pics').css('width','82%');			
			$('#tp_gallery #pic_list ul li a img').css('opacity','0.7');
			$('#tp_gallery #pic_list ul li:first a img').css('opacity','1');
			
			//calcs
			var scroll_ul = $('#tp_gallery #pic_list ul',this); // get content list
			var margin = parseInt($('#tp_gallery #pic_list ul li',this).css('margin-left')); // get padding
			var colsize = parseInt($('#tp_gallery #pic_list ul li',this).width()); // get column size		
			var elemh = parseInt($('#tp_gallery #pic_list ul li',this).height()) + 44 + 30; // get element height (li  height + arrows height)					
			var stepsize = colsize + (margin * 2);																		
			var viewportw = parseInt($('#tp_gallery #pic_list #pics').width()); // get viewport width
			var scroll_ul_w = 0;	//get total list real width
			$('li',scroll_ul).each(function() {
				scroll_ul_w += parseInt($(this).outerWidth());
			});
			var maxleft = viewportw - scroll_ul_w; // calc maximum left position so we cant scroll further
			
			//set caption if exist
			var imgtitle = '&nbsp; ';
			var fimgtitle = $('#tp_gallery #pic_list ul li:first a img').attr('title');
			if(fimgtitle){ $('#tp_gallery .title').html(fimgtitle); };
				
			
			$('#tp_gallery #pic_list ul li a').click(function(){				
				if($(this).attr('data-url') != $('#tp_gallery #large_pic img').attr('src')){				
					$('#tp_gallery #pic_list ul li a img').css('opacity','0.7');
					$('img',this).css('opacity','1');
					
					//set caption if exist
					imgtitle = '&nbsp; ';
					if($('img',this).attr('title')){ imgtitle = $('img',this).attr('title'); };
					$('#tp_gallery .title').html(imgtitle);
					
					var imgur = $(this).attr('data-url');
					$('#tp_gallery #large_pic img').fadeOut(function(){
						$('#tp_gallery #large_pic img').attr('src',imgur);
						$('#tp_gallery #large_pic a').attr('href',imgur);		
						$('#tp_gallery #large_pic img').load(function(){
							$('#tp_gallery #large_pic img').fadeIn();
						});
					});					
				}
				
				return false;
			});
			
			
			// scroll left			
				$('#tp_gallery #nav-left',this).click(function(){								
					if(parseInt(scroll_ul.css('left')) < 0){
						scroll_ul.animate({'left': '+='+stepsize+'px'}, 400);			
					}
					return false;
				});
				
			
			// scroll right
				$('#tp_gallery #nav-right',this).click(function(){	
					if(scroll_ul_w > viewportw){
						//scroll right only till the end of list
						if(parseInt(scroll_ul.css('left')) >= maxleft){						
							scroll_ul.animate({'left': '-='+stepsize+'px'}, 400);			
						}
					}
					
					return false;
				});
		});
	}
	
	
	
	//TOGGLES
	if(jQuery('.toggle_box').length != 0){
		jQuery('.toggle_box').hide(); 
			//Slide up and down on hover
		jQuery('.toggle').click(function(){
			jQuery(this).next('.toggle_box').slideToggle('slow');
			return false;
		});
	}
});



// ON WINDOW RESIZE - RELOAD MASONRY AND CAROUSEL
	/*var resizeTimer;
	function refresh(){
		location.reload();
	}	
	jQuery(function(){
		jQuery(window).resize(function(){			
			if(tp_responsive != 'off' && parseInt(jQuery(window).width()) < 1024 ){
				clearTimeout(resizeTimer);
				resizeTimer = setTimeout(refresh, 150);
			}
		
		});
	});*/




	

//FORCE PAGE HEIGHT MINIMUM
jQuery(function() {
	if(!jQuery('body').hasClass('page-template-page-pinterest-php')){		
		if(jQuery(window).width() > 780){
			var height = jQuery(window).height() - (jQuery("header#main").outerHeight() + jQuery("footer").outerHeight() ) - 130;
			jQuery("#full-width-content,#content").css("min-height",height+"px");
		}
	}
		
});


//BACK TO TOP FUNCTION
jQuery(function() {
	jQuery(window).scroll(function() {
		if(jQuery(this).scrollTop() > 400) {
			jQuery('#toTop').fadeIn();	
		} else {
			jQuery('#toTop').fadeOut();
		}
		
		
	});
 
	jQuery('#toTop').click(function() {
		jQuery('body,html').animate({scrollTop:0},800);
	});	
});




// JavaScript Document
/*
			the images preload plugin
			*/
			(function($) {
				$.fn.preload = function(options) {
					var opts 	= $.extend({}, $.fn.preload.defaults, options),
						o		= $.meta ? $.extend({}, opts, this.data()) : opts;
					return this.each(function() {
						var $e	= $(this),
							t	= $e.attr('rel'),
							i	= $e.attr('href'),
							l	= 0;
						$('<img/>').load(function(i){
							++l;
							if(l==2) o.onComplete();
						}).attr('src',i);	
						$('<img/>').load(function(i){
							++l;
							if(l==2) o.onComplete();
						}).attr('src',t);	
					});
				};
				$.fn.preload.defaults = {
					onComplete	: function(){return false;}
				};
			})(jQuery);


$(function() {
				//some elements..
				var $ps_container		= $('#ps_container'),
					$ps_image_wrapper 	= $ps_container.find('.ps_image_wrapper'),
					$ps_next			= $ps_container.find('.ps_next'),
					$ps_prev			= $ps_container.find('.ps_prev'),
					$ps_nav				= $ps_container.find('.ps_nav'),
					$tooltip			= $ps_container.find('.ps_preview'),
					$ps_preview_wrapper = $tooltip.find('.ps_preview_wrapper'),
					$links				= $ps_nav.children('li').not($tooltip),
					total_images		= $links.length,
					currentHovered		= -1,
					current				= 0,
					$loader				= $('#loader');
				
				/*check if you are using a browser*/	
				var ie 				= false;
				if ($.browser.msie) {
					ie = true;//you are not!Anyway let's give it a try
				}
				if(!ie)
					$tooltip.css({
						opacity	: 0
					}).show();
					
					
				/*first preload images (thumbs and large images)*/
				var loaded	= 0;
				$links.each(function(i){
					var $link 	= $(this);
					$link.find('a').preload({
						onComplete	: function(){
							++loaded;
							if(loaded == total_images){
								//all images preloaded,
								//show ps_container and initialize events
								$loader.hide();
								$ps_container.show();
								//when mouse enters the pages (the dots),
								//show the tooltip,
								//when mouse leaves hide the tooltip,
								//clicking on one will display the respective image	
								$links.bind('mouseenter',showTooltip)
									  .bind('mouseleave',hideTooltip)
									  .bind('click',showImage);
								//navigate through the images
								$ps_next.bind('click',nextImage);
								$ps_prev.bind('click',prevImage);
							}
						}
					});
				});
				
				function showTooltip(){
					var $link			= $(this),
						idx				= $link.index(),
						linkOuterWidth	= $link.outerWidth(),
						//this holds the left value for the next position
						//of the tooltip
						left			= parseFloat(idx * linkOuterWidth) - $tooltip.width()/2 + linkOuterWidth/2,
						//the thumb image source
						$thumb			= $link.find('a').attr('rel'),
						imageLeft;
					
					//if we are not hovering the current one
					if(currentHovered != idx){
						//check if we will animate left->right or right->left
						if(currentHovered != -1){
							if(currentHovered < idx){
								imageLeft	= 75;
							}
							else{
								imageLeft	= -75;
							}
						}
						currentHovered = idx;
						
						//the next thumb image to be shown in the tooltip
						var $newImage = $('<img/>').css('left','0px')
												   .attr('src',$thumb);
						
						//if theres more than 1 image 
						//(if we would move the mouse too fast it would probably happen)
						//then remove the oldest one (:last)
						if($ps_preview_wrapper.children().length > 1)
							$ps_preview_wrapper.children(':last').remove();
						
						//prepend the new image
						$ps_preview_wrapper.prepend($newImage);
						
						var $tooltip_imgs		= $ps_preview_wrapper.children(),
							tooltip_imgs_count	= $tooltip_imgs.length;
							
						//if theres 2 images on the tooltip
						//animate the current one out, and the new one in
						if(tooltip_imgs_count > 1){
							$tooltip_imgs.eq(tooltip_imgs_count-1)
										 .stop()
										 .animate({
											left:-imageLeft+'px'
										  },150,function(){
												//remove the old one
												$(this).remove();
										  });
							$tooltip_imgs.eq(0)
										 .css('left',imageLeft + 'px')
										 .stop()
										 .animate({
											left:'0px'
										  },150);
						}
					}
					//if we are not using a "browser", we just show the tooltip,
					//otherwise we fade it
					//
					if(ie)
						$tooltip.css('left',left + 'px').show();
					else
					$tooltip.stop()
							.animate({
								left		: left + 'px',
								opacity		: 1
							},150);
				}
				
				function hideTooltip(){
					//hide / fade out the tooltip
					if(ie)
						$tooltip.hide();
					else
					$tooltip.stop()
						    .animate({
								opacity		: 0
							},150);
				}
				
				function showImage(e){
					var $link				= $(this),
						idx					= $link.index(),
						$image				= $link.find('a').attr('href'),
						$currentImage 		= $ps_image_wrapper.find('img'),
						currentImageWidth	= $currentImage.width();
					
					//if we click the current one return
					if(current == idx) return false;
					
					//add class selected to the current page / dot
					$links.eq(current).removeClass('selected');
					$link.addClass('selected');
					
					//the new image element
					var $newImage = $('<img/>').css('left',currentImageWidth + 'px')
											   .attr('src',$image);
					
					//if the wrapper has more than one image, remove oldest
					if($ps_image_wrapper.children().length > 1)
						$ps_image_wrapper.children(':last').remove();
					
					//prepend the new image
					$ps_image_wrapper.prepend($newImage);
					
					//the new image width. 
					//This will be the new width of the ps_image_wrapper
					var newImageWidth	= $newImage.width();
				
					//check animation direction
					if(current > idx){
						$newImage.css('left',-newImageWidth + 'px');
						currentImageWidth = -newImageWidth;
					}	
					current = idx;
					//animate the new width of the ps_image_wrapper 
					//(same like new image width)
					$ps_image_wrapper.stop().animate({
					    width	: newImageWidth + 'px'
					},350);
					//animate the new image in
					$newImage.stop().animate({
					    left	: '0px'
					},350);
					//animate the old image out
					$currentImage.stop().animate({
					    left	: -currentImageWidth + 'px'
					},350);
				
					e.preventDefault();
				}				
				
				function nextImage(){
					if(current < total_images){
						$links.eq(current+1).trigger('click');
					}
				}
				function prevImage(){
					if(current > 0){
						$links.eq(current-1).trigger('click');
					}
				}
			});
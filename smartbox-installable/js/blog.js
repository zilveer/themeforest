jQuery(window).load(function(){
	if (jQuery('.pics').length){
		jQuery('.pics').each(function(){ 
				jQuery(this).css('opacity',1).css('margin-left', '-'+(jQuery(this).width() - jQuery(this).parent().width())/2+'px');
			if (jQuery(this).height() > jQuery(this).parents('.slides').siblings('flex-direction-nav').height() && !jQuery(this).parents('.single').length){
				if (!jQuery(this).parents('.flexslider').hasClass('five'))
					jQuery(this).css('opacity',1);			
			} 
		});
	}
});

jQuery(document).ready(function($){
	initBlogs();
});


function initBlogs(){
	/*check for stickies*/
	if (jQuery('.post.sticky').length){
		jQuery('.post.sticky').each(function(){
			jQuery(this).find('.divider-tags').parent().prepend('<div class="divider-tags"><span class="blog-i sticky"><i class="icon-pushpin"></i> Sticky</span></div>');
		});	
	}

	for (var i=0; i<17; i++){
		jQuery('li.depth-'+i).each(function(){
			jQuery(this).css({ 'width': jQuery(this).parent().width()-((i-1)*10)+'px' });
		});
	}

	jQuery('.metas_container').each(function(){
			
		if (jQuery(this).find('.tags').html() == ""){
			jQuery(this).find('.tags').parent().remove();
		}
		if (jQuery(this).find('.categories').html() == ""){
			jQuery(this).find('.categories').parent().remove();
		}
				
	});	
	
	if(jQuery('.postcontent .flexslider').length){
		jQuery('.postcontent .flexslider').each(function(){
			if (jQuery(this).parents('.single').length){
				jQuery(this).flexslider({
					animation: "fade",
					controlNav: true,
					directionNav: true,
					touch: true
				});
				jQuery(this).find('a.pretty').prettyPhoto({deeplinking: false, show_title: false, social_tools: '', theme: 'pp_default'});					
			} else {
				jQuery(this).flexslider({
					animation: "fade",
					controlNav: true,
					directionNav: true,
					touch: true,
					start:function(slider){
						jQuery(slider).find('.flex-direction-nav li a').each(function(){
							jQuery(this).hover(function(){
								jQuery(this).css('background-color',jQuery('#styleColor').html());
							}, function(){
								jQuery(this).css('background-color','rgba(0, 0, 0, 0.5)');
							});
						});
					}
				});
			}
		});
	}
	
	
	if (jQuery('.the_movies').length){
		jQuery('.the_movies').each(function(){
			var who = $(this).attr('data-movie');
			if (who){
				jQuery(this).html("<iframe src='"+jQuery(".v_links[data-movie="+who+"]").eq(0).html()+"' width='100%' height='370' frameborder='0' webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>");
			} else {
				jQuery(this).html("<iframe src='"+jQuery(".v_links").eq(0).html()+"' width='100%' height='370' frameborder='0' webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>");
			}
			if (jQuery(".the_movies").siblings(".v_links").length > 1){
	      		jQuery(this).find('.movies-nav').remove();
	        	jQuery(this).append('<ul class="flex-direction-nav movies-nav"><li><a class="prev" href="javascript:;">Previous</a></li><li><a class="next" href="javascript:;">Next</a></li></ul>');
	      		jQuery(this).siblings('.current_movie').remove();
	      		jQuery(this).after('<div style="display:none;" class="current_movie">0</div>');
	      		
	      		var elem = jQuery(this);
	      		
	      		jQuery(this).find('.movies-nav .prev').click(function(e){
	      			e.preventDefault();
	      			var index = parseInt(elem.siblings('.current_movie').html());
	      			var nextIndex = 0;
	      			if (index == 0) nextIndex = elem.siblings('.v_links').length - 1;
	      			else nextIndex = index-1;
	      			elem.find("iframe").attr('src', elem.siblings('.v_links').eq(nextIndex).html() );
	      			elem.siblings('.current_movie').html(nextIndex);
	      			
	      		});
	      		jQuery(this).find('.movies-nav .next').click(function(e){
	      			e.preventDefault();
	      			var index = parseInt(elem.siblings('.current_movie').html());
	      			var nextIndex = 0;
	      			if (index == elem.siblings('.v_links').length - 1) nextIndex = 0;
	      			else nextIndex = index+1;
	      			elem.find("iframe").attr('src', elem.siblings('.v_links').eq(nextIndex).html() );
	      			elem.siblings('.current_movie').html(nextIndex);
	      		});
	      	}
		});
	}
	
	
	/* if prettyphotos enabled on the images */
	jQuery('.postcontent .featured-image-thumb .mask').each(function(e){
		jQuery(this).removeAttr('onclick');
		jQuery(this).children('.link').remove();
		jQuery(this).children('.more').html('<i class="icon-search"></i>');
		jQuery(this).children('.more').find('i').css('opacity',0);
		jQuery(this).parent().hover(function(e){
			if (!jQuery(this).hasClass('isHovered')){
				jQuery(this).addClass('isHovered');
				jQuery(this).find('.more i').css('opacity',1);
				var dir = closestEdge(e.pageX, e.pageY, jQuery(this).offset().left, jQuery(this).offset().top, jQuery(this).width(), jQuery(this).height());
				jQuery(this).find('.mask > div').css('display','none');
				jQuery(this).find('.mask').children().unbind("transitionend webkitTransitionEnd oTransitionEnd MSTransitionEnd");
				switch (dir){
					case "left": jQuery(this).find('.mask').children().clone().addClass('new').css({
										'top':'50%',
										'left':'0%',
										'display':'block'
									}).appendTo(jQuery(this).find('.mask'));
									jQuery(this).find('.mask').children('div:not(.new)').remove();
									jQuery(this).find('.mask').children('.new').focus().css({
										'-webkit-transition': 'all 0.35s cubic-bezier(0.175, 0.885, 0.320, 1.275)',
										'-moz-transition': 'all 0.35s cubic-bezier(0.175, 0.885, 0.320, 1.275)',
										'-o-transition': 'all 0.35s cubic-bezier(0.175, 0.885, 0.320, 1.275)',
										'-ms-transition': 'all 0.35s cubic-bezier(0.175, 0.885, 0.320, 1.275)',
										'opacity':'1',
										'filter':'alpha(opacity=100)',
										'top':'50%',
										'left':'54%'
									});
								 break;
					case "right": jQuery(this).find('.mask').children().clone().addClass('new').css({
										'top':'50%',
										'left':'100%',
										'display':'block'
									}).appendTo(jQuery(this).find('.mask'));
									jQuery(this).find('.mask').children('div:not(.new)').remove();
									jQuery(this).find('.mask').children('.new').focus().css({
										'-webkit-transition': 'all 0.35s cubic-bezier(0.175, 0.885, 0.320, 1.275)',
										'-moz-transition': 'all 0.35s cubic-bezier(0.175, 0.885, 0.320, 1.275)',
										'-o-transition': 'all 0.35s cubic-bezier(0.175, 0.885, 0.320, 1.275)',
										'-ms-transition': 'all 0.35s cubic-bezier(0.175, 0.885, 0.320, 1.275)',
										'opacity':'1',
										'filter':'alpha(opacity=100)',
										'top':'50%',
										'left':'54%'
									});	 
								  break;
					case "top": jQuery(this).find('.mask').children().clone().addClass('new').css({
										'top':'-10%',
										'left':'54%',
										'display':'block'
									}).appendTo(jQuery(this).find('.mask'));
									jQuery(this).find('.mask').children('div:not(.new)').remove();
									jQuery(this).find('.mask').children('.new').focus().css({
										'-webkit-transition': 'all 0.35s cubic-bezier(0.175, 0.885, 0.320, 1.275)',
										'-moz-transition': 'all 0.35s cubic-bezier(0.175, 0.885, 0.320, 1.275)',
										'-o-transition': 'all 0.35s cubic-bezier(0.175, 0.885, 0.320, 1.275)',
										'-ms-transition': 'all 0.35s cubic-bezier(0.175, 0.885, 0.320, 1.275)',
										'opacity':'1',
										'filter':'alpha(opacity=100)',
										'top':'50%',
										'left':'54%'
									});
								 break;
					case "bottom": jQuery(this).find('.mask').children().clone().addClass('new').css({
										'top':'110%',
										'left':'54%',
										'display':'block'
									}).appendTo(jQuery(this).find('.mask'));
									jQuery(this).find('.mask').children('div:not(.new)').remove();
									jQuery(this).find('.mask').children('.new').focus().css({
										'-webkit-transition': 'all 0.35s cubic-bezier(0.175, 0.885, 0.320, 1.275)',
										'-moz-transition': 'all 0.35s cubic-bezier(0.175, 0.885, 0.320, 1.275)',
										'-o-transition': 'all 0.35s cubic-bezier(0.175, 0.885, 0.320, 1.275)',
										'-ms-transition': 'all 0.35s cubic-bezier(0.175, 0.885, 0.320, 1.275)',
										'opacity':'1',
										'filter':'alpha(opacity=100)',
										'top':'50%',
										'left':'54%'
									});
								 break;
				}
				jQuery(this).find('.mask').children().removeClass('new');
			} else return false;
		}, function(e){
			jQuery(this).removeClass('isHovered');
			var dir = closestEdge(e.pageX, e.pageY, jQuery(this).offset().left, jQuery(this).offset().top, jQuery(this).width(), jQuery(this).height());
			switch (dir){
				case "left": jQuery(this).find('.mask').children().css({
								'opacity':'0',
								'filter':'alpha(opacity=0)',
								'top':'50%',
								'left':'0%',
							 });
							 break;
				case "right": jQuery(this).find('.mask').children().css({
								'opacity':'0',
								'filter':'alpha(opacity=0)',
								'left':'100%',
								'top':'50%'
							 });
							  break;
				case "top": jQuery(this).find('.mask').children().css({
								'opacity':'0',
								'filter':'alpha(opacity=0)',
								'top':'0%',
								'left':'54%'
							 });
							 break;
				case "bottom": jQuery(this).find('.mask').children().css({
								'opacity':'0',
								'filter':'alpha(opacity=0)',
								'top':'100%',
								'left':'54%'
							 });
							 break;
			}
		});
	});

	jQuery('.postcontent .flexslider .mask').each(function(){
		jQuery(this).removeAttr('onclick');
		jQuery(this).children('.link').remove();
		jQuery(this).children('.more').html('<i class="icon-search"></i>');
		jQuery(this).children('.more').find('i').css('opacity',0);
		jQuery(this).css('z-index',9999);
		jQuery(this).parent().hover(function(e){
			jQuery(this).find('.mask i').css('opacity',1);
			if (!jQuery(this).hasClass('isHovered')){
				jQuery(this).addClass('isHovered');
				var dir = closestEdge(e.pageX, e.pageY, jQuery(this).offset().left, jQuery(this).offset().top, jQuery(this).width(), jQuery(this).height());
				jQuery(this).find('.mask > div').css('display','none');
				jQuery(this).find('.mask').children().unbind("transitionend webkitTransitionEnd oTransitionEnd MSTransitionEnd");
				switch (dir){
					case "left": jQuery(this).find('.mask').children().clone().addClass('new').css({
										'top':'50%',
										'left':'0%',
										'display':'block'
									}).appendTo(jQuery(this).find('.mask'));
									jQuery(this).find('.mask').children('div:not(.new)').remove();
									jQuery(this).find('.mask').children('.new').focus().css({
										'-webkit-transition': 'all 0.2s cubic-bezier(0.175, 0.885, 0.320, 1.275)',
										'-moz-transition': 'all 0.2s cubic-bezier(0.175, 0.885, 0.320, 1.275)',
										'-o-transition': 'all 0.2s cubic-bezier(0.175, 0.885, 0.320, 1.275)',
										'-ms-transition': 'all 0.2s cubic-bezier(0.175, 0.885, 0.320, 1.275)',
										'opacity':'1',
										'filter':'alpha(opacity=100)',
										'top':'50%',
										'left':'54%'
									});
								 break;
					case "right": jQuery(this).find('.mask').children().clone().addClass('new').css({
										'top':'50%',
										'left':'100%',
										'display':'block'
									}).appendTo(jQuery(this).find('.mask'));
									jQuery(this).find('.mask').children('div:not(.new)').remove();
									jQuery(this).find('.mask').children('.new').focus().css({
										'-webkit-transition': 'all 0.2s cubic-bezier(0.175, 0.885, 0.320, 1.275)',
										'-moz-transition': 'all 0.2s cubic-bezier(0.175, 0.885, 0.320, 1.275)',
										'-o-transition': 'all 0.2s cubic-bezier(0.175, 0.885, 0.320, 1.275)',
										'-ms-transition': 'all 0.2s cubic-bezier(0.175, 0.885, 0.320, 1.275)',
										'opacity':'1',
										'filter':'alpha(opacity=100)',
										'top':'50%',
										'left':'54%'
									});	 
								  break;
					case "top": jQuery(this).find('.mask').children().clone().addClass('new').css({
										'top':'-10%',
										'left':'54%',
										'display':'block'
									}).appendTo(jQuery(this).find('.mask'));
									jQuery(this).find('.mask').children('div:not(.new)').remove();
									jQuery(this).find('.mask').children('.new').focus().css({
										'-webkit-transition': 'all 0.2s cubic-bezier(0.175, 0.885, 0.320, 1.275)',
										'-moz-transition': 'all 0.2s cubic-bezier(0.175, 0.885, 0.320, 1.275)',
										'-o-transition': 'all 0.2s cubic-bezier(0.175, 0.885, 0.320, 1.275)',
										'-ms-transition': 'all 0.2s cubic-bezier(0.175, 0.885, 0.320, 1.275)',
										'opacity':'1',
										'filter':'alpha(opacity=100)',
										'top':'50%',
										'left':'54%'
									});
								 break;
					case "bottom": jQuery(this).find('.mask').children().clone().addClass('new').css({
										'top':'110%',
										'left':'54%',
										'display':'block'
									}).appendTo(jQuery(this).find('.mask'));
									jQuery(this).find('.mask').children('div:not(.new)').remove();
									jQuery(this).find('.mask').children('.new').focus().css({
										'-webkit-transition': 'all 0.2s cubic-bezier(0.175, 0.885, 0.320, 1.275)',
										'-moz-transition': 'all 0.2s cubic-bezier(0.175, 0.885, 0.320, 1.275)',
										'-o-transition': 'all 0.2s cubic-bezier(0.175, 0.885, 0.320, 1.275)',
										'-ms-transition': 'all 0.2s cubic-bezier(0.175, 0.885, 0.320, 1.275)',
										'opacity':'1',
										'filter':'alpha(opacity=100)',
										'top':'50%',
										'left':'54%'
									});
								 break;
				}
				jQuery(this).find('.mask').children().removeClass('new');
			} else return false;
		}, function(e){
			jQuery(this).removeClass('isHovered');
			var dir = closestEdge(e.pageX, e.pageY, jQuery(this).offset().left, jQuery(this).offset().top, jQuery(this).width(), jQuery(this).height());
			switch (dir){
				case "left": jQuery(this).find('.mask').children().css({
								'opacity':'0',
								'filter':'alpha(opacity=0)',
								'top':'50%',
								'left':'0%',
							 });
							 break;
				case "right": jQuery(this).find('.mask').children().css({
								'opacity':'0',
								'filter':'alpha(opacity=0)',
								'left':'100%',
								'top':'50%'
							 });
							  break;
				case "top": jQuery(this).find('.mask').children().css({
								'opacity':'0',
								'filter':'alpha(opacity=0)',
								'top':'0%',
								'left':'54%'
							 });
							 break;
				case "bottom": jQuery(this).find('.mask').children().css({
								'opacity':'0',
								'filter':'alpha(opacity=0)',
								'top':'100%',
								'left':'54%'
							 });
							 break;
			}
		});
	});

	if (jQuery('.postcontent .flexslider.slider').length){
		jQuery('.postcontent .flexslider.slider .mask .more').each(function(){
			jQuery(this).attr('onclick', 'jQuery(this).parents(\'.mask\').siblings(\'ul.slides\').find(\'li\').eq(0).find(\'a\').trigger(\'click\');');
		});
	}
	
	jQuery('.metas').each(function(){
		if (jQuery(this).find('.tags').html() == ""){
			jQuery(this).find('.tags').parent().remove();
		}
	});
	
	if (!jQuery('.blogarchive').length){
		jQuery('.postcontent .flexslider.slider ul.slides li a, .postcontent .featured-image-thumb ul.slides li a').parent().find('a[rel^="prettyPhoto"]').prettyPhoto({hook: 'rel'});
	} else {
		if (jQuery('.mask').length){
			jQuery('.postcontent .flexslider.slider ul.slides li a, .postcontent .featured-image-thumb ul.slides li a, .postcontent .featured-image-thumb .flex_this_thumb').parent().find('a[rel^="prettyPhoto"]').prettyPhoto({hook: 'rel'});
		}
	}

	if (jQuery('.postcontent .flexslider .mask').length){
		jQuery('.postcontent .flexslider ol').css('z-index',9999);
	    jQuery('.postcontent .flexslider .flex-direction-nav li a, .postcontent .flexslider ol').hover(function(){
	    	jQuery('.postcontent .flexslider .mask .more').css('opacity',0);
	    }, function(){
	    	jQuery('.postcontent .flexslider .mask .more').css('opacity',1);				
	    });
	}
	
	jQuery('a.comment-reply-link').each(function(){
		if (jQuery(this).attr('href').indexOf('#') != -1){
			jQuery(this).bind('click', function(){
				jQuery('html,body').animate({scrollTop: jQuery(this).offset().top - 80}, 222, 'jswing');
			});
		}
	});

	if (jQuery('.pics').length){
		jQuery('.pics').each(function(){ 
			jQuery(this).css('opacity',1).css('margin-left', '-'+(jQuery(this).width() - jQuery(this).parent().width())/2+'px');
		});
	}
}

function monitorScrollTop(){

	var scrollTop = getScrollTop();
	
	window.loadingPoint = parseInt((jQuery('#pbd-alp-load-posts').offset().top - jQuery(window).height() + 50),10);
	
	if (scrollTop >= window.loadingPoint){
		clearInterval(window.interval);
		jQuery('#pbd-alp-load-posts a').click();
	}

}

function getScrollTop(){
    if(typeof pageYOffset!= 'undefined'){
        //most browsers
        return pageYOffset;
    }
    else{
        var B= document.body; //IE 'quirks'
        var D= document.documentElement; //IE with doctype
        D= (D.clientHeight)? D: B;
        return D.scrollTop;
    }
}


/* load more posts */
jQuery(document).ready(function($) {

	// The number of the next page to load (/page/x/).
	window.pageNum = parseInt($('#loader-startPage').html(),10);
	window.totalForward = 1;
	window.totalBackward = -1;
	
	// The maximum number of pages the current query can return.
	var max = parseInt($('#loader-maxPages').html());
	
	// The link of the next page of posts.
	var nextLink = $('.navigation .next-posts a').attr('href');
	var prevLink = $('.navigation .prev-posts a').attr('href');
	
	/**
	 * Replace the traditional navigation with our own,
	 * but only if there is at least one page of new posts to load.
	**/
	
	if ($('#reading_option').html() === "scroll" || $('#reading_option').html() === "scrollauto"){
		if((parseInt(window.pageNum, 10)+1) <= max) {
			// Insert the "More Posts" link.
			
			$('.post-listing').each(function(){
	
				if ($(this).parents('.recentPosts_widget').length == 0){
					
					if ($(this).parents('.single').length == 0){
						var appendix = '<p id="pbd-alp-load-posts" style="position: relative; float: right; margin-bottom: 50px"><a style=" position: relative; float:right; margin-right: 10px;" href="javascript:;">'+ $('#smartbox_load_more_posts_text').html() +'</a></p>';
						$(this)
							.append('<div style="position:relative;float:left;display:inline-block;width:100%;" class="pbd-alp-placeholder-'+ (parseInt(window.pageNum, 10)+1) +'"></div>')
							.append(appendix);			
					}
				
				}
				// Remove the traditional navigation.
				if ($(this).parents('.single').length == 0){ $('.navigation').remove(); }
			});
			
		}
		if (parseInt(window.pageNum, 10) > 1){
			$('.post-listing').each(function(){
	
				if ($(this).parents('.recentPosts_widget').length == 0){
					
					if ($(this).parents('.single').length == 0){
						var prependix = '<p id="pbd-alp-load-newer-posts" style="position: relative; float: right;"><a style=" position: relative; float:right; margin-right: 10px;" href="javascript:;">'+ $('#smartbox_load_more_posts_text').html() +'</a></p>';
						$(this)
							.prepend('<div class="pbd-alp-placeholder-newer-'+ (parseInt(window.pageNum, 10)-1) +'"></div>')
							.prepend(prependix);			
					}
				
				}
				// Remove the traditional navigation.
				if ($(this).parents('.single').length == 0){ $('.navigation').remove(); }
			});	
		}
		
		
		/**
		 * Load new posts when the link is clicked.
		 */	
		$('#pbd-alp-load-posts a').click(function(e) {
			
			// Are there more posts to load?
			if((window.pageNum + window.totalForward) <= max) {
			
				// Show that we're working.
				$(this).html(''+$('#smartbox_loading_posts_text').html()+'<img style="width:16px; height: 16px; margin-left: 5px; position: relative;" src="'+$('#templatepath').html()+'img/ajx_loading.gif">');
				
				window.first = true;
				
				$('.pbd-alp-placeholder-'+ parseInt(window.pageNum + window.totalForward,10)).load( nextLink + ' .post',
					function() {
						// Update page number and nextLink.
						initBlogs();
						onColorChange($('#styleColor').html());
						
						$('.pbd-alp-placeholder-'+ parseInt(window.pageNum + window.totalForward,10)+' .post').each(function(){
							if ($(this).hasClass('recent')){
								$(this).remove();
							}
						});
						
						if (window.first){
							window.first = false;
							if ($('#reading_option').html() != "scrollauto"){
								$('html,body').stop().animate({
							      "scrollTop": $('.pbd-alp-placeholder-'+ parseInt(window.pageNum + window.totalForward,10)).offset().top - 100
							    }, 1200, "easeInOutExpo", function () {
							      //window.location.hash = target;
							   	});	
							}
						}
	
						window.totalForward = parseInt(window.totalForward+1);
	
						if ($('#permalink_structure').html() == "%postname%")
							nextLink = nextLink.replace(/\/page\/[0-9]?/, '/page/'+ parseInt(window.pageNum + window.totalForward,10)); /* links /page/x/ */
						else nextLink = nextLink.replace(/paged=[0-9]?/, "paged="+parseInt(window.pageNum + window.totalForward, 10)); /* links /?paged=x */
					
						// Add a new placeholder, for when user clicks again.
						$('#pbd-alp-load-posts')
							.before('<div style="position:relative;float:left;width:100%;display:inline-block;" class="pbd-alp-placeholder-'+ parseInt(window.pageNum + window.totalForward, 10) +'"></div>')
						
						// Update the button message.
						if((window.pageNum + window.totalForward ) <= max) {
							$('#pbd-alp-load-posts a').text($('#smartbox_load_more_posts_text').html());
							if ($('#reading_option').html() === "scrollauto") {
								window.clearInterval(window.interval);
								window.interval = setInterval('monitorScrollTop()', 1000 );
							}
						} else {
							$('#pbd-alp-load-posts a').text($('#smartbox_no_more_posts_text').html());
							var t=setTimeout(function(){
								$('#pbd-alp-load-posts').slideUp(500).fadeOut(500);
							},5000);
							window.clearInterval(window.interval);
						}
					}
				).fadeIn(5000);	
			} else {
				window.clearInterval(window.interval);
			}
			return false;
		});
		
		$('#pbd-alp-load-newer-posts a').click(function(e) {
		
			//window.totalBackward = window.totalBackward-1;
			if((window.pageNum + window.totalBackward) > 0) {
			
				// Show that we're working.
				$(this).html(''+$('#smartbox_loading_posts_text').html()+'<img style="width:16px; height: 16px; margin-left: 5px; position: relative;" src="'+$('#templatepath').html()+'img/ajx_loading.gif">');
				$('.pbd-alp-placeholder-newer-'+ (window.pageNum + window.totalBackward)).load( prevLink + ' .post',
					function() {
						//repair_hovers_blog(pageNum);
						// Update page number and nextLink.
						initBlogs();
						onColorChange($('#styleColor').html());
						$('.pbd-alp-placeholder-newer-'+ (window.pageNum + window.totalBackward)+' .post').each(function(){
							if ($(this).hasClass('recent')) $(this).remove();
						});
						
						window.totalBackward = window.totalBackward-1;
	
						prevLink = prevLink.replace(/\/page\/[0-9]?/, '/page/'+ (window.pageNum + window.totalBackward)); /* links /page/x/ */
						prevLink = prevLink.replace(/paged=[0-9]?/, "paged="+(window.pageNum + window.totalBackward)); /* links /?paged=x */		
						// Add a new placeholder, for when user clicks again.
						$('#pbd-alp-load-newer-posts')
							.after('<div class="pbd-alp-placeholder-newer-'+ parseInt((window.pageNum + window.totalBackward)) +'"></div>')
						
						// Update the button message.
						if((window.pageNum + window.totalBackward+1) > 1) {
							$('#pbd-alp-load-newer-posts a').text($('#smartbox_load_more_posts_text').html());
						} else {
							$('#pbd-alp-load-newer-posts a').text($('#smartbox_no_more_posts_text').html());
							var t=setTimeout(function(){
								$('#pbd-alp-load-newer-posts').slideUp(500).fadeOut(500);
							},5000);
						}
					}
				).fadeIn(5000);	
			} else { 
				window.clearInterval(window.interval);
			}	
			return false;
		});	
	}
	
});
$ = (jQuery);

(function($) {
$.fn.getHiddenDimensions = function(includeMargin) {
    var $item = this,
        props = { position: 'absolute', visibility: 'hidden', display: 'block' },
        dim = { width:0, height:0, innerWidth: 0, innerHeight: 0,outerWidth: 0,outerHeight: 0 },
        $hiddenParents = $item.parents().andSelf().not(':visible'),
        includeMargin = (includeMargin == null)? false : includeMargin;

    var oldProps = [];
    $hiddenParents.each(function() {
        var old = {};

        for ( var name in props ) {
            old[ name ] = this.style[ name ];
            this.style[ name ] = props[ name ];
        }

        oldProps.push(old);
    });

    dim.width = $item.width();
    dim.outerWidth = $item.outerWidth(includeMargin);
    dim.innerWidth = $item.innerWidth();
    dim.height = $item.height();
    dim.innerHeight = $item.innerHeight();
    dim.outerHeight = $item.outerHeight(includeMargin);

    $hiddenParents.each(function(i) {
        var old = oldProps[i];
        for ( var name in props ) {
            this.style[ name ] = old[ name ];
        }
    });

    return dim;
}
}(jQuery));


$(window).scroll(function(){
	if ($('.dl-menuopen').length && $('.dl-menuopen').height() > $(window).height()){
		if ($(window).scrollTop() < 10) $('.style_top_bar, .logo.columns, #toppanel_trigger, .trigger_toppanel_closer, #searchform_top').css('z-index',99);
		var transform = Math.floor(window.startPoint - $(window).scrollTop());
		if (transform < 1 && Math.abs(transform) < window.maxTransform){
			$('.style_top_bar, .logo.columns, #toppanel_trigger, .trigger_toppanel_closer, #searchform_top').css('z-index',-1);
			$('.dl-menuopen').css('transform', 'matrix(1, 0, 0, 1, 0, '+transform+')');
		} else {
			if (transform >= 1){
				$('.style_top_bar, .logo.columns, #toppanel_trigger, .trigger_toppanel_closer, #searchform_top').css('z-index',99);
				$('.dl-menuopen').css('transform', 'matrix(1, 0, 0, 1, 0, 0)');
			}
			else $('.dl-menuopen').css('transform', 'matrix(1, 0, 0, 1, 0, '+(window.maxTransform * -1)+')');
		}	
	}
});

$(window).resize(function(){

	if ($('#disable_responsive_layout').html() == "off"){
		if (!isMobile.allExceptIpad()){
					    
		    if ($('#toppanel_trigger').length){
			    $('#toppanel_trigger').addClass('open');
			    $('#toppanel').stop().slideUp(500, "easeOutExpo", function(){
				    $('#toppanel').css({ 'visibility':'hidden', 'display':'block' });
					$('#toppanel_trigger').stop().css('opacity',1).animate({'top':'0px'}, 200, function(){
						if ($('#bodyLayoutType').html() === "boxed" ) $('#white_content').css('overflow','');
						$('#toppanel .toppanel_content').css('overflow-y','hidden');
						$('.toppanel_content > .fullwidth_container.ontoppanel').css({'position':'relative','bottom':'0'});
					});	
				});
				$('#toppanel_trigger').removeClass('open');
		    }
		    
		    if ($('.flex-caption').length){
			    $('.flex-caption').each(function(){
			    	var hide = false;
				    if ($(this).parents('.flexslider').width() < 490){ 
					    hide = true;
				    } 
				    if ($(this).parents('.flexslider').height() < 250){
					    hide = true;
				    }
				    if (hide) $(this).css('display','none');
				    else $(this).css('display','block');	
			    });
		    }
		    
		    /* projs per row (recent projs without scroller) */
			$('.recentProjects3 .projs_row .indproj1').each(function(){
				var newHeight = $(this).width() * window.ration;
				$(this).find('.ch-item a, .ch-item').css('height',newHeight);
			});
			$('.recentProjects4 .projs_row .indproj2').each(function(){
				var newHeight = $(this).width() * window.ration;
				$(this).find('.da-thumbs li a').css('height',newHeight);
			});
			if ($('#projects-1 .proj_list').length){
				$('#projects-1 .proj_list').each(function(){
					if ($(this).children().eq(0).length){
						var newHeight = Math.round($(this).children().eq(0).width() * window.ration);
					}
					$(this).children().find('li.nc').height(newHeight);
				});
			}
			if ($('#projects-2 ul.da-thumbs').length){
				$('#projects-2 ul.da-thumbs').each(function(){
					if ($(this).children().eq(0).length){
						var newHeight = Math.round($(this).children().eq(0).width() * window.ration);
					}
					$(this).children('li a').height(newHeight);
				});
			}	
		}	
	}
	
});

function checkMenu(){
	
	if ($('#headerStyleType').html() === "style1" || $('#headerStyleType').html() === "style2"){
		if ($(window).width() < 980){
			$('header #menulava > li.current-menu-item, header #menulava > li.current-menu-ancestor').css({
			  	'border-bottom': '3px solid '+$('#styleColor').html(),
			  	'border-top': 'none'
		  	});
		} else {
			$('header #menulava > li.current-menu-item, header #menulava > li.current-menu-ancestor').css({
			  	'border-bottom': '0px'
		  	});
		}	
	}
	
}

function closestEdge(x , y, elx, ely, w, h) {
	var distTop = y - ely;
	var distBottom = ely + h - y;
	var distLeft = x - elx;
	var distRight = w - distLeft;
	var min = Math.min(distTop,distBottom,distLeft,distRight);
	switch(min){
		case distTop: return "top"; break;
		case distBottom: return "bottom"; break;
		case distLeft: return "left"; break;
		case distRight: return "right"; break;
	}
}

function checkProjStyle1(){
	/* projects style #1 stuff */
	var color = $('#styleColor').html();
	/* if individual project thumbnail hover isn't default */
	$('.post-thumb').each(function(){
		var hoverOption = "";
		if ($(this).parent().attr('data-rel')){
			hoverOption = $(this).parent().attr('data-rel');
		} else hoverOption = $('#smartbox_thumbnails_hover_option').html();
		switch (hoverOption){
			case "link_magnifier":
				$(this).find('.mask').each(function(){
					$(this).removeAttr('onclick');
					$(this).children('.more').addClass('notalone').html('<p class="more-chitem">View Larger</p>');
					$(this).children('.link').addClass('notalone').html('<p class="more-chitem">More Details</p>');
					$(this).parents('.post-thumb').hover(function(e){
						if (!$(this).hasClass('isHovered')){
							$(this).addClass('isHovered');
							$(this).find('.more-chitem').css({'opacity':1, 'filter':'alpha(opacity=100)'});
							var dir = closestEdge(e.pageX, e.pageY, $(this).offset().left, $(this).offset().top, $(this).width(), $(this).height());
							$(this).find('.mask > div').css('display','none');
							$(this).find('.mask').children().unbind("transitionend webkitTransitionEnd oTransitionEnd MSTransitionEnd");
							switch (dir){
								case "left": $(this).find('.mask').children().clone().addClass('new').css({
													'top':'50%',
													'left':'0%',
													'display':'block'
												}).appendTo($(this).find('.mask'));
												
												$(this).find('.mask').children('div:not(.new)').remove();
												$(this).find('.mask').children('.new').focus().css({
													'-webkit-transition': 'all 0.35s cubic-bezier(0.175, 0.885, 0.320, 1.275)',
													'-moz-transition': 'all 0.35s cubic-bezier(0.175, 0.885, 0.320, 1.275)',
													'-o-transition': 'all 0.35s cubic-bezier(0.175, 0.885, 0.320, 1.275)',
													'-ms-transition': 'all 0.35s cubic-bezier(0.175, 0.885, 0.320, 1.275)',
													'opacity':'1',
													'filter':'alpha(opacity=100)',
													'top':'50%',
													'left':'50%'
												});
											 break;
								case "right": $(this).find('.mask').children().clone().addClass('new').css({
													'top':'50%',
													'left':'100%',
													'display':'block'
												}).appendTo($(this).find('.mask'));
												$(this).find('.mask').children('div:not(.new)').remove();
												$(this).find('.mask').children('.new').focus().css({
													'-webkit-transition': 'all 0.35s cubic-bezier(0.175, 0.885, 0.320, 1.275)',
													'-moz-transition': 'all 0.35s cubic-bezier(0.175, 0.885, 0.320, 1.275)',
													'-o-transition': 'all 0.35s cubic-bezier(0.175, 0.885, 0.320, 1.275)',
													'-ms-transition': 'all 0.35s cubic-bezier(0.175, 0.885, 0.320, 1.275)',
													'opacity':'1',
													'filter':'alpha(opacity=100)',
													'top':'50%',
													'left':'50%'
												});	 
											  break;
								case "top": $(this).find('.mask').children().clone().addClass('new').css({
													'top':'-10%',
													'left':'50%',
													'display':'block'
												}).appendTo($(this).find('.mask'));
												$(this).find('.mask').children('div:not(.new)').remove();
												$(this).find('.mask').children('.new').focus().css({
													'-webkit-transition': 'all 0.35s cubic-bezier(0.175, 0.885, 0.320, 1.275)',
													'-moz-transition': 'all 0.35s cubic-bezier(0.175, 0.885, 0.320, 1.275)',
													'-o-transition': 'all 0.35s cubic-bezier(0.175, 0.885, 0.320, 1.275)',
													'-ms-transition': 'all 0.35s cubic-bezier(0.175, 0.885, 0.320, 1.275)',
													'opacity':'1',
													'filter':'alpha(opacity=100)',
													'top':'50%',
													'left':'50%'
												});
											 break;
								case "bottom": $(this).find('.mask').children().clone().addClass('new').css({
													'top':'110%',
													'left':'50%',
													'display':'block'
												}).appendTo($(this).find('.mask'));
												$(this).find('.mask').children('div:not(.new)').remove();
												$(this).find('.mask').children('.new').focus().css({
													'-webkit-transition': 'all 0.35s cubic-bezier(0.175, 0.885, 0.320, 1.275)',
													'-moz-transition': 'all 0.35s cubic-bezier(0.175, 0.885, 0.320, 1.275)',
													'-o-transition': 'all 0.35s cubic-bezier(0.175, 0.885, 0.320, 1.275)',
													'-ms-transition': 'all 0.35s cubic-bezier(0.175, 0.885, 0.320, 1.275)',
													'opacity':'1',
													'filter':'alpha(opacity=100)',
													'top':'50%',
													'left':'50%'
												});
											 break;
							}
							$(this).find('.mask').children().removeClass('new');
						}
					}, function(e){
						$(this).removeClass('isHovered');
						var dir = closestEdge(e.pageX, e.pageY, $(this).offset().left, $(this).offset().top, $(this).width(), $(this).height());
						switch (dir){
							case "left": $(this).find('.mask').children().css({
											'opacity':'0',
											'filter':'alpha(opacity=0)',
											'top':'50%',
											'left':'0%',
										 });
										 break;
							case "right": $(this).find('.mask').children().css({
											'opacity':'0',
											'filter':'alpha(opacity=0)',
											'left':'100%',
											'top':'50%'
										 });
										  break;
							case "top": $(this).find('.mask').children().css({
											'opacity':'0',
											'filter':'alpha(opacity=0)',
											'top':'0%',
											'left':'50%'
										 });
										 break;
							case "bottom": $(this).find('.mask').children().css({
											'opacity':'0',
											'filter':'alpha(opacity=0)',
											'top':'100%',
											'left':'50%'
										 });
										 break;
						}
					});
				});	
				break;
			case "link": 
				$(this).find('.mask').each(function(){
					$(this).removeAttr('onclick');
					$(this).children('.more').remove();
					$(this).children('.link').html('<p class="more-chitem">More Details</p>');
					$(this).parents('.post-thumb').hover(function(e){
						if (!$(this).hasClass('isHovered')){
							$(this).addClass('isHovered');
							$(this).find('.more-chitem').css({'opacity':1, 'filter':'alpha(opacity=100)'});
							var dir = closestEdge(e.pageX, e.pageY, $(this).offset().left, $(this).offset().top, $(this).width(), $(this).height());
							$(this).find('.mask > div').css('display','none');
							$(this).find('.mask').children().unbind("transitionend webkitTransitionEnd oTransitionEnd MSTransitionEnd");
							switch (dir){
								case "left": $(this).find('.mask').children().clone().addClass('new').css({
													'top':'50%',
													'left':'0%',
													'display':'block'
												}).appendTo($(this).find('.mask'));
												
												$(this).find('.mask').children('div:not(.new)').remove();
												$(this).find('.mask').children('.new').focus().css({
													'-webkit-transition': 'all 0.35s cubic-bezier(0.175, 0.885, 0.320, 1.275)',
													'-moz-transition': 'all 0.35s cubic-bezier(0.175, 0.885, 0.320, 1.275)',
													'-o-transition': 'all 0.35s cubic-bezier(0.175, 0.885, 0.320, 1.275)',
													'-ms-transition': 'all 0.35s cubic-bezier(0.175, 0.885, 0.320, 1.275)',
													'opacity':'1',
													'filter':'alpha(opacity=100)',
													'top':'50%',
													'left':'50%'
												});
											 break;
								case "right": $(this).find('.mask').children().clone().addClass('new').css({
													'top':'50%',
													'left':'100%',
													'display':'block'
												}).appendTo($(this).find('.mask'));
												$(this).find('.mask').children('div:not(.new)').remove();
												$(this).find('.mask').children('.new').focus().css({
													'-webkit-transition': 'all 0.35s cubic-bezier(0.175, 0.885, 0.320, 1.275)',
													'-moz-transition': 'all 0.35s cubic-bezier(0.175, 0.885, 0.320, 1.275)',
													'-o-transition': 'all 0.35s cubic-bezier(0.175, 0.885, 0.320, 1.275)',
													'-ms-transition': 'all 0.35s cubic-bezier(0.175, 0.885, 0.320, 1.275)',
													'opacity':'1',
													'filter':'alpha(opacity=100)',
													'top':'50%',
													'left':'50%'
												});	 
											  break;
								case "top": $(this).find('.mask').children().clone().addClass('new').css({
													'top':'-10%',
													'left':'50%',
													'display':'block'
												}).appendTo($(this).find('.mask'));
												$(this).find('.mask').children('div:not(.new)').remove();
												$(this).find('.mask').children('.new').focus().css({
													'-webkit-transition': 'all 0.35s cubic-bezier(0.175, 0.885, 0.320, 1.275)',
													'-moz-transition': 'all 0.35s cubic-bezier(0.175, 0.885, 0.320, 1.275)',
													'-o-transition': 'all 0.35s cubic-bezier(0.175, 0.885, 0.320, 1.275)',
													'-ms-transition': 'all 0.35s cubic-bezier(0.175, 0.885, 0.320, 1.275)',
													'opacity':'1',
													'filter':'alpha(opacity=100)',
													'top':'50%',
													'left':'50%'
												});
											 break;
								case "bottom": $(this).find('.mask').children().clone().addClass('new').css({
													'top':'110%',
													'left':'50%',
													'display':'block'
												}).appendTo($(this).find('.mask'));
												$(this).find('.mask').children('div:not(.new)').remove();
												$(this).find('.mask').children('.new').focus().css({
													'-webkit-transition': 'all 0.35s cubic-bezier(0.175, 0.885, 0.320, 1.275)',
													'-moz-transition': 'all 0.35s cubic-bezier(0.175, 0.885, 0.320, 1.275)',
													'-o-transition': 'all 0.35s cubic-bezier(0.175, 0.885, 0.320, 1.275)',
													'-ms-transition': 'all 0.35s cubic-bezier(0.175, 0.885, 0.320, 1.275)',
													'opacity':'1',
													'filter':'alpha(opacity=100)',
													'top':'50%',
													'left':'50%'
												});
											 break;
							}
							$(this).find('.mask').children().removeClass('new');	
						} else return false;
					}, function(e){
						$(this).removeClass('isHovered');
						var dir = closestEdge(e.pageX, e.pageY, $(this).offset().left, $(this).offset().top, $(this).width(), $(this).height());
						switch (dir){
							case "left": $(this).find('.mask').children().css({
											'opacity':'0',
											'filter':'alpha(opacity=0)',
											'top':'50%',
											'left':'0%',
										 });
										 break;
							case "right": $(this).find('.mask').children().css({
											'opacity':'0',
											'filter':'alpha(opacity=0)',
											'left':'100%',
											'top':'50%'
										 });
										  break;
							case "top": $(this).find('.mask').children().css({
											'opacity':'0',
											'filter':'alpha(opacity=0)',
											'top':'0%',
											'left':'50%'
										 });
										 break;
							case "bottom": $(this).find('.mask').children().css({
											'opacity':'0',
											'filter':'alpha(opacity=0)',
											'top':'100%',
											'left':'50%'
										 });
										 break;
						}
					});
				});	
				break;
			case "magnifier":
				$(this).find('.mask').each(function(){
					$(this).removeAttr('onclick');
					$(this).children('.link').remove();
					$(this).children('.more').html('<p class="more-chitem">View Larger</p>');
					$(this).parents('.post-thumb').hover(function(e){
						if (!$(this).hasClass('isHovered')){
							$(this).addClass('isHovered');
							$(this).find('.more-chitem').css({'opacity':1, 'filter':'alpha(opacity=100)'});
							var dir = closestEdge(e.pageX, e.pageY, $(this).offset().left, $(this).offset().top, $(this).width(), $(this).height());
							$(this).find('.mask > div').css('display','none');
							$(this).find('.mask').children().unbind("transitionend webkitTransitionEnd oTransitionEnd MSTransitionEnd");
							switch (dir){
								case "left": $(this).find('.mask').children().clone().addClass('new').css({
													'top':'50%',
													'left':'0%',
													'display':'block'
												}).appendTo($(this).find('.mask'));
												$(this).find('.mask').children('div:not(.new)').remove();
												$(this).find('.mask').children('.new').focus().css({
													'-webkit-transition': 'all 0.35s cubic-bezier(0.175, 0.885, 0.320, 1.275)',
													'-moz-transition': 'all 0.35s cubic-bezier(0.175, 0.885, 0.320, 1.275)',
													'-o-transition': 'all 0.35s cubic-bezier(0.175, 0.885, 0.320, 1.275)',
													'-ms-transition': 'all 0.35s cubic-bezier(0.175, 0.885, 0.320, 1.275)',
													'opacity':'1',
													'filter':'alpha(opacity=100)',
													'top':'50%',
													'left':'50%'
												});
											 break;
								case "right": $(this).find('.mask').children().clone().addClass('new').css({
													'top':'50%',
													'left':'100%',
													'display':'block'
												}).appendTo($(this).find('.mask'));
												$(this).find('.mask').children('div:not(.new)').remove();
												$(this).find('.mask').children('.new').focus().css({
													'-webkit-transition': 'all 0.35s cubic-bezier(0.175, 0.885, 0.320, 1.275)',
													'-moz-transition': 'all 0.35s cubic-bezier(0.175, 0.885, 0.320, 1.275)',
													'-o-transition': 'all 0.35s cubic-bezier(0.175, 0.885, 0.320, 1.275)',
													'-ms-transition': 'all 0.35s cubic-bezier(0.175, 0.885, 0.320, 1.275)',
													'opacity':'1',
													'filter':'alpha(opacity=100)',
													'top':'50%',
													'left':'50%'
												});	 
											  break;
								case "top": $(this).find('.mask').children().clone().addClass('new').css({
													'top':'-10%',
													'left':'50%',
													'display':'block'
												}).appendTo($(this).find('.mask'));
												$(this).find('.mask').children('div:not(.new)').remove();
												$(this).find('.mask').children('.new').focus().css({
													'-webkit-transition': 'all 0.35s cubic-bezier(0.175, 0.885, 0.320, 1.275)',
													'-moz-transition': 'all 0.35s cubic-bezier(0.175, 0.885, 0.320, 1.275)',
													'-o-transition': 'all 0.35s cubic-bezier(0.175, 0.885, 0.320, 1.275)',
													'-ms-transition': 'all 0.35s cubic-bezier(0.175, 0.885, 0.320, 1.275)',
													'opacity':'1',
													'filter':'alpha(opacity=100)',
													'top':'50%',
													'left':'50%'
												});
											 break;
								case "bottom": $(this).find('.mask').children().clone().addClass('new').css({
													'top':'110%',
													'left':'50%',
													'display':'block'
												}).appendTo($(this).find('.mask'));
												$(this).find('.mask').children('div:not(.new)').remove();
												$(this).find('.mask').children('.new').focus().css({
													'-webkit-transition': 'all 0.35s cubic-bezier(0.175, 0.885, 0.320, 1.275)',
													'-moz-transition': 'all 0.35s cubic-bezier(0.175, 0.885, 0.320, 1.275)',
													'-o-transition': 'all 0.35s cubic-bezier(0.175, 0.885, 0.320, 1.275)',
													'-ms-transition': 'all 0.35s cubic-bezier(0.175, 0.885, 0.320, 1.275)',
													'opacity':'1',
													'filter':'alpha(opacity=100)',
													'top':'50%',
													'left':'50%'
												});
											 break;
							}
							$(this).find('.mask').children().removeClass('new');
						} else return false;
					}, function(e){
						$(this).removeClass('isHovered');
						var dir = closestEdge(e.pageX, e.pageY, $(this).offset().left, $(this).offset().top, $(this).width(), $(this).height());
						switch (dir){
							case "left": $(this).find('.mask').children().css({
											'opacity':'0',
											'filter':'alpha(opacity=0)',
											'top':'50%',
											'left':'0%',
										 });
										 break;
							case "right": $(this).find('.mask').children().css({
											'opacity':'0',
											'filter':'alpha(opacity=0)',
											'left':'100%',
											'top':'50%'
										 });
										  break;
							case "top": $(this).find('.mask').children().css({
											'opacity':'0',
											'filter':'alpha(opacity=0)',
											'top':'0%',
											'left':'50%'
										 });
										 break;
							case "bottom": $(this).find('.mask').children().css({
											'opacity':'0',
											'filter':'alpha(opacity=0)',
											'top':'100%',
											'left':'50%'
										 });
										 break;
						}
					});
				});
				break;
			case "none":
				$(this).find('.mask').each(function(){
					$(this).children('.more').remove();
					$(this).removeAttr('onclick').click(function(){ $(this).find('.link').trigger('click'); });
				});
				break;
		}
		
		if (window.BrowserDetect.browser == "Explorer" && window.BrowserDetect.version == 8){
			$(this).find('.mask').parents('.post-thumb').parent().hover(function(){
				$(this).find('i').css('opacity',1);
				var argb = '#CC'+$('#styleColor').html().substring(1);
				$(this).find('.mask').css({
					'background':'none',
					'-ms-filter':'progid:DXImageTransform.Microsoft.gradient(startColorstr='+argb+',endColorstr='+argb+')',
					'filter':'progid:DXImageTransform.Microsoft.gradient(startColorstr='+argb+',endColorstr='+argb+')',
					'zoom':'1'
				});
			}, function(){
				$(this).find('.mask').css({
					'background':'none',
					'-ms-filter':'progid:DXImageTransform.Microsoft.gradient(startColorstr=#FFFFFFFF,endColorstr=#FFFFFFFF)',
					'filter':'progid:DXImageTransform.Microsoft.gradient(startColorstr=#FFFFFFFF,endColorstr=#FFFFFFFF)',
					'zoom':'1'
				});
			});
		} else {
			$(this).find('.mask').parents('.post-thumb').parent().hover(function(){
				$(this).find('i').css('opacity',1);
				$(this).find('.mask').css('background-color','rgba('+hexToRgb(color).r+','+hexToRgb(color).g+','+hexToRgb(color).b+',0.8)');
			}, function(){
				$(this).find('.mask').css('background-color','rgba(0,0,0,0)');
			});		
		}
		
		$(this).find('.mask i').css('opacity',0);
	});

}

$(function(){

	/* prettyphoto images */
	$('a.shortcode-img').each(function(e){
		$(this).wrap('<div class="image_container" style="position:relative;display:inline-block;line-height:0px;"/>');
		$(this).before('<div class="mask" style="line-height:0px;"><div class="more" onclick="$(this).parents(\'.image_container\').find(\'.prettyphoto\').click();"></div></div>');
		$(this).prettyPhoto();
	});

	/* mask nas project media */
	if ($('.projects_media .mask, .featured-image-thumb .mask, .image_container .mask').length){
		$('.projects_media .mask, .featured-image-thumb .mask, .image_container .mask').each(function(){
		
			$(this).css('z-index',999);
			$(this).removeAttr('onclick');
			$(this).children('.link').remove();
			$(this).children('.more').html('<p class="more-chitem">View Larger</p>');
			$(this).find('i').css('opacity',0);
			
			$(this).parent().hover(function(e){
				if (!$(this).hasClass('isHovered')){
					$(this).addClass('isHovered');
					$(this).find('i').css('opacity',1);
					var dir = closestEdge(e.pageX, e.pageY, $(this).offset().left, $(this).offset().top, $(this).width(), $(this).height());
					$(this).find('.mask > div').css('display','none');
					$(this).find('.mask').children().unbind("transitionend webkitTransitionEnd oTransitionEnd MSTransitionEnd");
					switch (dir){
						case "left": $(this).find('.mask').children().clone().addClass('new').css({
											'top':'50%',
											'left':'0%',
											'display':'block'
										}).appendTo($(this).find('.mask'));
										$(this).find('.mask').children('div:not(.new)').remove();
										$(this).find('.mask').children('.new').focus().css({
											'-webkit-transition': 'all 0.2s cubic-bezier(0.175, 0.885, 0.320, 1.275)',
											'-moz-transition': 'all 0.2s cubic-bezier(0.175, 0.885, 0.320, 1.275)',
											'-o-transition': 'all 0.2s cubic-bezier(0.175, 0.885, 0.320, 1.275)',
											'-ms-transition': 'all 0.2s cubic-bezier(0.175, 0.885, 0.320, 1.275)',
											'opacity':'1',
											'filter':'alpha(opacity=100)',
											'top':'50%',
											'left':'50%'
										});
									 break;
						case "right": $(this).find('.mask').children().clone().addClass('new').css({
											'top':'50%',
											'left':'100%',
											'display':'block'
										}).appendTo($(this).find('.mask'));
										$(this).find('.mask').children('div:not(.new)').remove();
										$(this).find('.mask').children('.new').focus().css({
											'-webkit-transition': 'all 0.2s cubic-bezier(0.175, 0.885, 0.320, 1.275)',
											'-moz-transition': 'all 0.2s cubic-bezier(0.175, 0.885, 0.320, 1.275)',
											'-o-transition': 'all 0.2s cubic-bezier(0.175, 0.885, 0.320, 1.275)',
											'-ms-transition': 'all 0.2s cubic-bezier(0.175, 0.885, 0.320, 1.275)',
											'opacity':'1',
											'filter':'alpha(opacity=100)',
											'top':'50%',
											'left':'50%'
										});	 
									  break;
						case "top": $(this).find('.mask').children().clone().addClass('new').css({
											'top':'-10%',
											'left':'50%',
											'display':'block'
										}).appendTo($(this).find('.mask'));
										$(this).find('.mask').children('div:not(.new)').remove();
										$(this).find('.mask').children('.new').focus().css({
											'-webkit-transition': 'all 0.2s cubic-bezier(0.175, 0.885, 0.320, 1.275)',
											'-moz-transition': 'all 0.2s cubic-bezier(0.175, 0.885, 0.320, 1.275)',
											'-o-transition': 'all 0.2s cubic-bezier(0.175, 0.885, 0.320, 1.275)',
											'-ms-transition': 'all 0.2s cubic-bezier(0.175, 0.885, 0.320, 1.275)',
											'opacity':'1',
											'filter':'alpha(opacity=100)',
											'top':'50%',
											'left':'50%'
										});
									 break;
						case "bottom": $(this).find('.mask').children().clone().addClass('new').css({
											'top':'110%',
											'left':'50%',
											'display':'block'
										}).appendTo($(this).find('.mask'));
										$(this).find('.mask').children('div:not(.new)').remove();
										$(this).find('.mask').children('.new').focus().css({
											'-webkit-transition': 'all 0.2s cubic-bezier(0.175, 0.885, 0.320, 1.275)',
											'-moz-transition': 'all 0.2s cubic-bezier(0.175, 0.885, 0.320, 1.275)',
											'-o-transition': 'all 0.2s cubic-bezier(0.175, 0.885, 0.320, 1.275)',
											'-ms-transition': 'all 0.2s cubic-bezier(0.175, 0.885, 0.320, 1.275)',
											'opacity':'1',
											'filter':'alpha(opacity=100)',
											'top':'50%',
											'left':'50%'
										});
									 break;
					}
					$(this).find('.mask').children().removeClass('new');	
				} else return false;
			}, function(e){
				$(this).removeClass('isHovered');
				var dir = closestEdge(e.pageX, e.pageY, $(this).offset().left, $(this).offset().top, $(this).width(), $(this).height());
				switch (dir){
					case "left": $(this).find('.mask').children().css({
									'opacity':'0',
									'filter':'alpha(opacity=0)',
									'top':'50%',
									'left':'0%',
								 });
								 break;
					case "right": $(this).find('.mask').children().css({
									'opacity':'0',
									'filter':'alpha(opacity=0)',
									'left':'100%',
									'top':'50%'
								 });
								  break;
					case "top": $(this).find('.mask').children().css({
									'opacity':'0',
									'filter':'alpha(opacity=0)',
									'top':'0%',
									'left':'50%'
								 });
								 break;
					case "bottom": $(this).find('.mask').children().css({
									'opacity':'0',
									'filter':'alpha(opacity=0)',
									'top':'100%',
									'left':'50%'
								 });
								 break;
				}
			});
		});
		
		if ($('.projects_media .flexslider').length){
			$('.projects_media .flexslider .mask .more').attr('onclick', '$(\'.projects_media .flexslider ul.slides li:not(.clone)\').eq(0).find(\'a\').trigger(\'click\');');
			$('.projects_media .flexslider ul.slides li a').prettyPhoto();
		}
		
		if ($('.flexslider .mask').length){
		    $('.flexslider .flex-direction-nav li a, .flexslider .flex-control-nav').hover(function(){
		    	$(this).closest('.flexslider').find('.mask .more').css('opacity',0);
		    }, function(){
		    	$(this).closest('.flexslider').find('.mask .more').css('opacity',1);				
		    });
		}
	
	}

	checkProjStyle1();
	
	$('.metas').each(function(){
		if ($(this).find('.tags').html() == ""){
			$(this).find('.tags').parent().remove();
		}
	});

	/*WIDGETS AND STUFF*/
	
	$.tools.tooltip.addEffect("designa_style4",
		  function(done) {
			  var conf = this.getConf(), tip = this.getTip();
		 	  if (!tip.find('.tt_triangle').length){ tip.append('<div class="tt_triangle" />'); } 
			  tip.find('.tt_triangle').css({ 'margin-left' : (tip.width() - tip.find('.tt_triangle').width())/2 });
			  
			  if ($('.n-hc').length){
				  //tip.addClass('tooltipdown');
			 	  if (!tip.find('.tt_triangle').length){ tip.prepend('<div class="tt_triangle" />'); } 
				  tip.css('margin-top','-40px').find('.tt_triangle').css({ 'margin-left' : (tip.width() - tip.find('.tt_triangle').width())/2 });
				  tip.stop().css('display','block').animate({opacity: 1, top: '+=10'}, 200);
			  } else {
				  tip.css('margin-top','-30px')
				  tip.removeClass('tooltipdown');
				  tip.stop().css({'display':'block', 'cursor':'pointer'}).animate({opacity: 1, top: '-=10'}, 200);	  
			  }
			  
			  done.call();
		  },
		  function(done) {
		  
			  if ($('.n-hc').length){
				 this.getTip().animate({opacity: 0, top: '-=10'}, 200, function(){
				 	$(this).removeClass('tooltipdown');
				 	$(this).css('display','none');
				 	done.call();
			 	 });

			  } else {
				  this.getTip().animate({opacity: 0, top: '+=10'}, 200, function(){
				 	 $(this).css('display','none');
				 	 done.call();
			 	  });
			  }		  
		  }
	);
	
	$.tools.tooltip.addEffect("designa",
		  function(done) {
			  var conf = this.getConf(), tip = this.getTip();
		 	  if (!tip.find('.tt_triangle').length){ tip.append('<div class="tt_triangle" />'); } 
			  tip.find('.tt_triangle').css({ 'margin-left' : (tip.width() - tip.find('.tt_triangle').width())/2 });
			  tip.stop().css({'display':'block', 'cursor':'pointer'}).animate({opacity: 1, top: '-=10'}, 200);
			  done.call();
		  },
		  function(done) {
		 	 this.getTip().animate({opacity: 0, top: '+=10'}, 200, function(){
			 	 $(this).css('display','none');
			 	 done.call();
		 	 });
		  }
	);
	
	$.tools.tooltip.addEffect("designaDowner",
		  function(done) {
			  var conf = this.getConf(), tip = this.getTip();
			  if ($('#headerStyleType').html() !== "style4") tip.addClass('tooltipdown');
			  tip.css('top',tip.height()+17+'px');
		 	  if (!tip.find('.tt_triangle').length){ tip.prepend('<div class="tt_triangle" />'); } 
			  tip.find('.tt_triangle').css({ 'margin-left' : (tip.width() - tip.find('.tt_triangle').width())/2 });
			  tip.stop().css('display','block').animate({opacity: 1, top: '+=10'}, 200);
			  done.call();
		  },
		  function(done) {
		 	 this.getTip().animate({opacity: 0, top: '-=10'}, 200, function(){
			 	$(this).css('display','none');
			 	done.call();
		 	 });
		  }
	);
	
	$.tools.tooltip.addEffect("designaLight",
		  function(done) {
			  var conf = this.getConf(), tip = this.getTip();
			  tip.addClass('light');
		 	  if (!tip.find('.tt_triangle').length){ tip.append('<div class="tt_triangle" />'); } 
			  tip.find('.tt_triangle').css({ 'margin-left' : (tip.width() - tip.find('.tt_triangle').width())/2 });
			  tip.stop().css('display','block').animate({opacity: 1, top: '-=10'}, 200);
			  done.call();
		  },
		  function(done) {
		 	 this.getTip().animate({opacity: 0, top: '+=10'}, 200, function(){
			 	 $(this).css('display','none');
			 	done.call();
		 	 });
		  }
	);
	
	$.tools.tooltip.addEffect("designaDark",
		  function(done) {
			  var conf = this.getConf(), tip = this.getTip();
			  tip.addClass('dark');
			  tip.css('margin-top','-29px');
		 	  if (!tip.find('.tt_triangle').length){ tip.append('<div class="tt_triangle" />'); } 
			  tip.find('.tt_triangle').css({ 'margin-left' : (tip.width() - tip.find('.tt_triangle').width())/2 });
			  tip.stop().css('display','block').animate({opacity: 1, top: '-=10'}, 200);
			  done.call();
		  },
		  function(done) {
		 	 this.getTip().animate({opacity: 0, top: '+=10'}, 200, function(){
			 	 $(this).css('display','none');
			 	 done.call();
		 	 });
		  }
	);

	if (!isMobile.any()){
		$('div.goto_projects[title], div.goto_blog[title]').tooltip({
			effect: "designa"
		});	
	}
	
	$('.footer_right_content .socialdiv li a').add($('.footer_right_content .socialdiv-dark li a')).each(function(){
		if (!isMobile.any()) $(this).tooltip({ effect: "designaDark" });
	});
	
	$('.socialdiv-dark li a').each(function(){
		if ($(this).parents('.header_container').length){
			if (!isMobile.any()) $(this).tooltip({ effect: "designaDowner" });	
		} else {
			if (!isMobile.any()) $(this).tooltip({ effect: "designaLight" });
		}
	});
	
	
	$('span.tooltiper[title]').each(function(i){
		if ($(this).hasClass('tooltip-Light')){
			if (!isMobile.any()) $(this).tooltip({ effect: "designaLight", delay: 250 });
			$(this).trigger('mouseenter').trigger('mouseleave');
			if (isMobile.any()){
				$(this).click(function(){
					$(this).trigger('mouseenter');
				});
			}
		} else {
			if (!isMobile.any()) $(this).tooltip({ effect: "designaDark", delay: 250 });
			$(this).trigger('mouseenter').trigger('mouseleave');
			if (isMobile.any()){
				$(this).click(function(){
					$(this).trigger('mouseenter');
				});
			}
		}
	});

	if ($('.shortcode-accs').length){
		$('.shortcode-accs').each(function(e){
			$(this).tabs(
			    ".shortcode-accs div.pane",
			    {tabs: '.acc-title > h2', effect: 'slide', initialIndex: 0}
			);
		});
	}

	if ($('#nav-below').length){
		$('#nav-below').children('div').each(function(){
			if ($(this).html().length < 1){
				$(this).css('display','none');
			}
		});		
	}	    
    
    if ($('#headerStyleType').html() !== "style3"){
		  //Generate Menu
		  $('ul#menulava, ul#menulava_top, ul#menu_top_bar').supersubs({ 
		      minWidth:    10,   // minimum width of sub-menus in em units 
		      maxWidth:    22,   // maximum width of sub-menus in em units 
		      extraWidth:  1     // extra width can ensure lines don't sometimes turn over 
		                         // due to slight rounding differences and font-family 
		  }).superfish({ 
		      animation: {height:'show'},   // slide-down effect without fade-in 
		      delay:     0,               // 1.2 second delay on mouseout 
		      disableHI: true
		  });
    } else {
	      //Generate Menu
	      $('ul#menulava').supersubs({ 
		      minWidth:    10,   // minimum width of sub-menus in em units 
		      maxWidth:    22,   // maximum width of sub-menus in em units 
		      extraWidth:  1     // extra width can ensure lines don't sometimes turn over 
                // due to slight rounding differences and font-family 
		  }).superfish({ 
		      animation: {height:'show'},   // slide-down effect without fade-in 
		      delay:     300,      // 1.2 second delay on mouseout 
		      disableHI: false,
		      speed: 200,
		      speedOut: 400,
		      onBeforeShow: function(){
			      if ($(this).parents('li').last().children('a').length){
				      $(this).parents('li').last().children('a').stop().css({'color':'white', 'background-color': $('#styleColor').html() });
				      $(this).parents('li').last().siblings().children('a').not('.current-menu-item, .current-menu-ancestor').css({'color':$('#headerstyle3_menucolor').html(), 'background-color':'transparent'});	      
			      }
		      },
		      onHide: function(){
				  $(this).parents('li').last().children('a').stop().css({'color':$('#headerstyle3_menucolor').html(), 'background-color': 'white' });
		      }
		  });
		  
		  $('ul#menulava > li').not('.current-menu-item, .current-menu-ancestor').each(function(){
			  if ($(this).find('ul').length == 0) {
				  $(this).hover(function(){
					  $(this).css('background-color', $('#styleColor').html());
					  $(this).find('a').css('color','white');
				  }, function(){
					  $(this).css('background-color', 'white');
					  $(this).find('a').css('color',$('#headerstyle3_menucolor').html());
				  });
			  }
		  });
		  
		 /*
 $('ul#menulava > li').hover(function(){
			  $(this).css('background-color', $('#styleColor').html()).children('a').css('color','white');
		  }, function(){
			  $(this).css('background-color', 'white').children('a').css('color',$('#headerstyle3_menucolor').html());
		  });
*/
		 
		  $('ul#menulava_top, ul#menu_top_bar').supersubs({ 
		      minWidth:    10,   // minimum width of sub-menus in em units 
		      maxWidth:    22,   // maximum width of sub-menus in em units 
		      extraWidth:  1     // extra width can ensure lines don't sometimes turn over 
		                         // due to slight rounding differences and font-family 
		  }).superfish({ 
		      animation: {height:'show'},   // slide-down effect without fade-in 
		      delay:     1000,               // 1.2 second delay on mouseout 
		      disableHI: true
		  });
	}
	    
	 $("header #menulava > li > a").each(function(){
	   
	   $(this).find('span').eq($(this).find('span').length - 1).after($(this).children('p'));
	
	 });
	 $(".dropdown-menu" ).change(
	      function() { 
	      	if($(this).find("option:selected").val() != "")
	          window.location = $(this).find("option:selected").val();
	      }
	  );

 
});

$(window).load(function(){

	if ($('#toppanel').length){
		$('#toppanel').stop().slideUp(1).css('opacity',1);
		$("#toppanel_trigger").click(function(){
			if (!$(this).hasClass('open')) {
				$('#toppanel').css('display','none');
				if ($('#bodyLayoutType').html() === "boxed" ) $('#white_content').css('overflow','hidden');	
				$(this).stop().animate({'top':'-25px'}, 200, function(){
					$('#toppanel').css('visibility','visible');
					$('#toppanel').stop().slideDown( 500, "easeOutExpo", function(){
					
						if ($('#toppanel').height() > $(window).height()){
							$('#toppanel .toppanel_content > .container').css('overflow-y','scroll');
							$('.toppanel_content > .fullwidth_container.ontoppanel').css({'position':'fixed','bottom':'0'});
							$('#toppanel .toppanel_content > .container').height( $(window).height()-$(this).siblings('.fullwidth_container.ontoppanel').height());
							var lowest = 0;
							var bottom = 0;
							$('#toppanel .toppanel_content > .container').children().each(function(e){
								if ($(this).offset().top+$(this).height() > bottom) {
									bottom = $(this).offset().top + $(this).height();
									lowest = e;
								}
							});
							$('#toppanel .toppanel_content > .container').children().eq(lowest).css('margin-bottom',$(window).height()/2);
						} 
						
					});								
				});
				$(this).addClass('open');
			} 
			else {
				$('#toppanel').stop().slideUp(500, "easeOutExpo", function(){
					$('#toppanel_trigger').stop().css('opacity',1).animate({'top':'0px'}, 200, function(){
						if ($('#bodyLayoutType').html() === "boxed" ) $('#white_content').css('overflow','');
						$('#toppanel .toppanel_content').css('overflow-y','hidden');
						$('.toppanel_content > .fullwidth_container.ontoppanel').css({'position':'relative','bottom':'0'});
					});	
				});
				$(this).removeClass('open');
			}
		});	
	}


	$('#white_content').append('<div class="clear" />');

	/*MEDIAELEMENTS.JS*/
	var color = $('#styleColor').html();
	var darkerColor = $.xcolor.darken(color);
	
	if ($('.imgloader').length){
		$('.imgloader').each(function(){
			$(this).animate({opacity: 0}, 500, function(){
				$(this).remove();
			});
			$(this).siblings('img').animate({opacity: 1}, 500);
		});
	}
	
	if ($('.rp_style1_img').length){
		$('.rp_style1_img').each(function(){
			$(this).animate({'opacity':1},500);
			if ($(this).height() < $(this).parents('ul').siblings('.magnifier').height()){
				$(this).css({'width':'auto', 'height':'100%'}).addClass('altered');
			}
		});
	}

});


function randomXToY(minVal,maxVal,floatVal){
  var randVal = minVal+(Math.random()*(maxVal-minVal));
  return typeof floatVal=='undefined'?Math.round(randVal):randVal.toFixed(floatVal);
}


function animateElement($el, type, animation){
	
	var delay = 0;
	switch (type){
		case "title": delay = 0; speedTrans = randomXToY(500,1500) ; break;
		case "text": delay = 300;  speedTrans = randomXToY(500,1500); break;
		case "image": delay = 300;  speedTrans = randomXToY(500,1500); break;
		case "button": delay = 900;  speedTrans = randomXToY(500,1500); break;
	}
	
	switch (animation){
		case "des_moveFromTop": 
			$el
				.css({'opacity':0, 'top':'-100%'})
				.delay(delay)
				.animate({ 'opacity': 1, 'top': '0px' },speedTrans, 'easeInOutExpo');
			break;
		case "des_moveFromBottom": 
			$el
				.css({'opacity':0, 'bottom':'-100%'})
				.delay(delay)
				.animate({ 'opacity': 1, 'bottom': '0px' },speedTrans, 'easeInOutExpo');
			break;
		case "des_moveFromLeft": 
			if (type == "text"){
				$el
					.css({'opacity':0, 'margin-left':'-100%'})
					.delay(delay)
					.animate({ 'opacity': 1, 'margin-left': '0px' },speedTrans, 'easeInOutExpo');
			} else {
				$el
					.css({'opacity':0, 'left':'-100%'})
					.delay(delay)
					.animate({ 'opacity': 1, 'left': '0px' },speedTrans, 'easeInOutExpo');	
			}
			break;
		case "des_moveFromRight": 
			if (type == "text"){
				$el
					.css({'opacity':0, 'margin-right':'-100%'})
					.delay(delay)
					.animate({ 'opacity': 1, 'margin-right': '0px' },speedTrans, 'easeInOutExpo');
			} else {
				$el
					.css({'opacity':0, 'right':'-100%'})
					.delay(delay)
					.animate({ 'opacity': 1, 'right': '0px' },speedTrans, 'easeInOutExpo');	
			}
			break;
		case "des_fade":
			$el
				.css({'opacity':0})
				.delay(delay)
				.animate({ 'opacity': 1},1500, 'easeInOutExpo');
			break;
	}
	
	
}

$(document).ready(function(){
	
	$('.shortcode-unorderedlist li').wrapInner('<span>');

	if ($('.recentPosts_style2').length){
		$('.recentPosts_style2').each(function(){
			if ($(this).find('.post_listing .slides-item').eq(0).width() < 480){
				$(this).find('.post_listing .slides-item').each(function(){
					$(this).find('.columns').removeClass('eight').addClass('sixteen');
				});
			}
		});
	}

	$('.wpcf7-submit').click(function(){
		$(this).parents('.wpb_wrapper').find('input').mouseover(function(){ $(this).siblings('.wpcf7-not-valid-tip').fadeOut("fast"); });
	});

	$('.tooltip').css('visibility','hidden');
	$('.socialiconsshortcode li a').trigger('mouseover').trigger('mouseout');
	setTimeout(function(){
		$('.tooltip').css('visibility','visible');
	}, 500);

	$('#dl-menu ul.dl-menu > li li:not(.dl-back)').removeAttr('class');
	$('#dl-menu ul.dl-menu ul').removeClass('sub-menu').addClass('dl-submenu-smart');
	$( '#dl-menu' ).dlmenu({
		animationClasses : { classin : 'dl-animate-in-2', classout : 'dl-animate-out-2' }
	});
	$('.dl-menu a').each(function(){ 
		if ($(this).siblings('ul').length){
			$(this).after('<span class="gosubmenu icon-angle-right" />');
		}
		$(this).click(function(e){
			if ($(this).attr('href').indexOf('http') > -1){
				e.preventDefault(); e.stopPropagation(); window.location = $(this).attr('href');
			}
		});
	});
	
	if ($('#lang_sel a.lang_sel_sel, #lang_sel_click a.lang_sel_sel').length){
		$('#lang_sel a.lang_sel_sel, #lang_sel_click a.lang_sel_sel').append('<i class="icon-angle-down"></i>');
		$('#lang_sel a.lang_sel_sel, #lang_sel_click a.lang_sel_sel').prepend('<i class="icon-globe" style="left:0px;"></i>');
	}
	
	/* as benditas fullwidth sections */
	if ($('#bodyLayoutType').html() !== "boxed"){		
		var ww = $(window).width()+10;
		var rw = $('#wrapper > .container').width();
		$('.shortcode.fullwidth-section').each(function(){
			$(this).css({ 'opacity': 1,'margin-left': (rw-ww)/2-5, 'width': ww, 'text-align':'center'});
			$(this).children().not('.video-container').wrapAll('<div class="main_cols container" style="z-index:2; text-align:left;"/>');
			$(this).children('.main_cols').width(rw);
		});
		$(window).resize(function(){
			var ww = $(window).width()+10;
			var rw = $('#wrapper > .container').width();
			$('.shortcode.fullwidth-section').each(function(){
				$(this).css({ 'margin-left': (rw-ww)/2-5, 'width': ww });
				$(this).children('.main_cols').width(rw);
			});
		});
	} else {
		if ($('.fullwidth-section').length){
			$('.fullwidth-section').each(function(){ 
				if (!$(this).children('.main_cols.container').length){
					$(this).children().not('.video-container').wrapAll('<div class="main_cols container" style="z-index:2;"/>');
				}
				if ($(this).parent().hasClass('entry') == true){
					 $(this).css('margin-left', '1%');
				}
				if ($(this).hasClass('parallax')) $(this).css('background-size','100%');
			});
		}
		$('body').css('visibility','visible');
	}
	
	/* remove brs from the new non-visual shortcodes */
	$('.main_cols.container > br').remove();

	/*asshole IE*/
	if (window.BrowserDetect.browser === "Explorer"){
		$('.info_above_menu .telephone i, .info_above_menu .email i, .info_above_menu .address i').css('vertical-align', 'middle');	
	}

	if ($('.menu_wpml_widget').length){
		var totalHeight = $('#lang_sel ul ul > li, #lang_sel_click ul ul > li').outerHeight() * $('#lang_sel ul ul > li, #lang_sel_click ul ul > li').length;
		var maxWidth = 0;
		$('#lang_sel ul ul > li > a, #lang_sel_click ul ul > li > a').each(function(){
			if ($(this).getHiddenDimensions(true).outerWidth > maxWidth) maxWidth = $(this).getHiddenDimensions(true).outerWidth;
			$(this).css('float','left');
		});
		$('#lang_sel ul ul > li, #lang_sel_click ul ul > li').width(maxWidth);
		$('#lang_sel ul ul, #lang_sel_click ul ul').css('width',$('#lang_sel ul ul > li, #lang_sel_click ul ul > li').getHiddenDimensions(true).outerWidth+'px').css('left','-11px');
		$('#lang_sel ul li, #lang_sel_click ul li').hover(function(){
			$(this).children('ul').css('visibility','visible').stop().animate({'height':totalHeight+'px'}, 500);
		}, function(){
			$(this).children('ul').stop().animate({'height':'0px'}, 500, function(){ $(this).css('visibility','hidden'); });
		});
		
	}
	
	if ($('#smartbox_fixed_menu').html() != "off"){
		if ($('.logo_and_menu .logo a img').length){
			
			if ($('#headerType').html() === "without"){
				var image = document.createElement('img');
			    image.onload = function(){
			    	var newHeight = parseInt($('.logo_and_menu .logo a img').eq(0).css('max-height'), 10) + parseInt($('.logo_and_menu .logo a img').eq(0).css('margin-top'), 10) * 3 + 2 ;
			    	if ($('#headerStyleType').html() !== "style1") newHeight += $('.header_container .fullwidth_container').height();
			    	if ($('#headerStyleType').html() === "style4") newHeight += 60;
			    	if ($('#bodyLayoutType').html() === "boxed"){
				    	if (!$('body').hasClass('page-template-template-home-php')){
					    	$('#wrapper').css('margin-top', newHeight +'px');	
				    	} else {
					    	$('#wrapper').css('margin-top', '0px');
				    	}
			    	} else {
			    		if (!$('body').hasClass('page-template-template-home-php')){
				    		$('#white_content').css('margin-top', newHeight +'px');		
			    		}
			    	}
			    	
			    };
			    var source = $('.logo_normal').attr('src');
			    if ($('.logo_normal').css('display') == "none")
				    source = $('.logo_retina').attr('src');
				image.src = source;
			} else {
				var image = document.createElement('img');
			    image.onload = function(){
			    	var newHeight = $('.header_container').height();
			    	var ratio = parseInt($('.logo_normal').css('max-width'),10) / this.width ;
			    	if ($('#slider_container .rev_slider_wrapper .fullscreenbanner').length == 0){
						$('#slider_container').css('padding-top', newHeight +'px');
					} else {
						$('#slider_container').css('padding-top', '0px');
					}
					$('.flexslider_container').css('padding-top', newHeight +'px');
					if (!$('body').hasClass('boxedpage'))
						$('.fullwidth-container').css('margin-top', newHeight+15 +'px');
					if ($('body').hasClass('single-portfolio'))
						$('.fullwidth-container').css('margin-top', newHeight +'px');
					$('.home-no-slider').css('padding-top', newHeight+40 +'px');
					$('.everything > .fullwidth-container').css('margin-top', newHeight +'px');		
			    };
			    var source = $('.logo_normal').attr('src');
			    if ($('.logo_normal').css('display') == "none")
				    source = $('.logo_retina').attr('src');
				image.src = source;		
			}
			
		} else {
			var newHeight = parseInt($('.header_container').height(), 10);
	    	if ($('#slider_container .rev_slider_wrapper .fullscreenbanner').length == 0){
				$('#slider_container').css('padding-top', newHeight +'px');
			} else {
				$('#slider_container').css('padding-top', '0px');
			}
			$('.flexslider_container').css('padding-top', newHeight +'px');
			$('.fullwidth-container').css('margin-top', newHeight+15 +'px');
			$('.home-no-slider').css('padding-top', newHeight+40 +'px');
			$('.everything > .fullwidth-container').css('margin-top', newHeight +'px');		
		}
			
	} else {
		$('.header_container').css('float','none');
		$('.logo_and_menu .logo').css({'max-width':'26%','width':'100%'});
	}

	if ($('#bodyLayoutType').html() == "boxed"){
	
		$('body').addClass('boxedpage');
		
		if ($('body').hasClass('page-template-template-contacts-php')){
			$('#white_content').appendTo($('.everything'));
			$('#map').css({'margin-top':'18px !important','top':'0px'}).prependTo($('#wrapper'));
		}
		
		/*move elements around*/
		$('.header_container').css('width','auto');
		
		if ($('.mail_chimp_form_container').length){
			$('#wrapper').after($('.mail_chimp_form_container'));
		}
		
		if ($('.entry-breadcrumb').length){
			$('#white_content #wrapper').after($('.entry-breadcrumb').parent());
		}
		
		if ($('.flexslider_container').length){
			$('.flexslider_container').prependTo($('#white_content').eq(0));
		}

		$('.fullwidth-container').prependTo('#white_content:not(.contacts)');
		$('#header_bg').prependTo('#white_content:not(.contacts)');
		$('.header_container').prependTo('#white_content:not(.contacts)');

		if ($('#white_content:not(.contacts) #wrapper').next().hasClass('container') && !$('#white_content:not(.contacts) #wrapper').next().hasClass('breadcrumbs-container')){
			$('#white_content:not(.contacts) #wrapper').next().prependTo($('#white_content:not(.contacts) #wrapper'));
		}

		if ($('#slider_container.designareslider').length){
			$('#slider_container.designareslider').prependTo('#white_content:not(.contacts)');
		}

		$('#big_footer').appendTo('#white_content:not(.contacts)');
	
		if ($('#bodyShadowColor').length)
			$('#white_content').css({'box-shadow': $('#bodyShadowColor').html()+' 0 0 10px'});
		$('#white_content').append('<div class="clear" />');
		
		if ($('.fullwidth-container .pageTitle').length && $('.breadcrumbs-container').length){
			$('.breadcrumbs-container').appendTo($('.fullwidth-container .pageTitle').parent());
		}
		
		if ($('.projects_media.fullwidthslider').length){
			$('.projects_media.fullwidthslider').prependTo($('#wrapper'));
		}
	}	

	window.ration = .75;

	if ($('#mc-embedded-subscribe').length){
		$('#mc-embedded-subscribe').click(function(e){
			if (!validate_email($('#mce-EMAIL').val())){
				e.stopPropagation();
				e.preventDefault();
				$('#mce-EMAIL').css({'border':'1px solid #D07F7F', 'color':'#D07F7F'}).val('Please insert a valid email');
				$('#mce-EMAIL').focus(function(){
					$(this).val('');
					$(this).css({
						'border':'none',
						'color': 'rgb(192, 191, 191)'
					});
				});
				return false;
			}
		});
	}
	
	/* projs per row (recent projs without scroller) */
	$('.recentProjects3 .projs_row .indproj1').each(function(){
		var newHeight = $(this).width() * window.ration;
		$(this).find('.ch-item a, .ch-item').css('height',newHeight);
	});
	$('.recentProjects4 .projs_row .indproj2').each(function(){
		var newHeight = $(this).width() * window.ration;
		$(this).find('.da-thumbs li a').css('height',newHeight);
		if ($(this).find('ul > li > p').length){
			$(this).find('ul > li > p').children().unwrap();
			$(this).find('ul > li > a.noscroll:eq(1)').remove();
		}
	});
	
	$('.recentProjects4 .da-recent-projs li').each(function(){
		$(this).find('p').children().unwrap();
		$(this).children('a').eq(1).remove();
		$(this).parents('.recentProjects4').find('.smartboxtitle br').remove();
	});
	
	if ($('.flex-caption').length){
	    $('.flex-caption').each(function(){
	    	if (!$(this).parents('.flexslider_container').length){
		    	var hide = false;
			    if ($(this).parents('.flexslider').width() < 490){ 
				    hide = true;
			    } 
			    if ($(this).parents('.flexslider').height() < 250){
				    hide = true;
			    }
			    if (hide) $(this).css('display','none');
			    else $(this).css('display','block');	
	    	}
	    });
    }
	
	if ($('.addthiscode').length) $('.addthiscode').css('display','inline-block');
	
	if ($('#projects-1 .proj_list').length){
		$('#projects-1 .proj_list').each(function(){
			if ($(this).children().eq(0).length){
				var newHeight = Math.round($(this).children().eq(0).width() * window.ration);
			}
			$(this).children().find('li.nc').height(newHeight);
		});
	}
	if ($('#projects-2 ul.da-thumbs').length){
		$('#projects-2 ul.da-thumbs').each(function(){
			if ($(this).children().eq(0).length){
				var newHeight = Math.round($(this).children().eq(0).width() * window.ration);
			}
			$(this).children('li a').height(newHeight);
		});
	}
		
	/*shortcode maps*/
	$('.mapelas').each(function(){
		var $el = $(this);
		var g_map = $(this).attr('id');
		var latlng = new google.maps.LatLng($(this).siblings('#gm_lat').val(), $(this).siblings('#gm_lng').val());
		var myOptions = {
		  scrollwheel: false,
		  zoom: 15,
		  center: latlng,
		  mapTypeId: google.maps.MapTypeId.ROADMAP
		};
		if(document.getElementById(g_map))
			var g_map = new google.maps.Map(document.getElementById(g_map), myOptions);
		
		// Creating a marker and positioning it on the map
		var marker = new google.maps.Marker({
		  position: new google.maps.LatLng($(this).siblings('#gm_lat').attr('value'), $(this).siblings('#gm_lng').attr('value')),
		  map: g_map
		});
		
		google.maps.event.addListener(g_map, "tilesloaded", function(){
			$(this).find('.gmnoprint').eq(0).remove();
			google.maps.event.clearInstanceListeners(g_map);
		}, true);
		
	});
	
	/* unordered lists with icons */
	$('.shortcode-unorderedlist').each(function(){
		var icon = $(this).attr('class').split('shortcode-unorderedlist addicon-');
			icon = icon[1];
		var color = $(this).attr('data-rel');
		$(this).find('ul > li').each(function(){
			$(this).prepend('<i style="color:'+color+';" class="icon-'+icon+'"></i>');
		});
	});
	
	/* ------------------------------------------------------------------------ */
	/* Back To Top */
	/* ------------------------------------------------------------------------ */

	$(window).scroll(function(){
		if($(window).scrollTop() > 200){
			$("#back-to-top").fadeIn(200);
		} else{
			$("#back-to-top").fadeOut(200);
		}
	});
	
	$('#back-to-top a').click(function() {
		  $('html, body').animate({ scrollTop:0 }, 1300, "easeInOutCirc");
		  return false;
	});
	

	if ($('#headerStyleType').html() === "style1" || $('#headerStyleType').html() === "style4" ){
		if ($('#headerStyleType').html() === "style4"){
			$('.socialdiv li a[title]').add($('.socialdiv-dark li a[title]')).each(function(){
				if ($(this).parents('.logo_and_menu').length){
					if (!isMobile.any()){
						$(this).tooltip({
							effect: "designa_style4"
						});	
					}
				} else {
					if (!isMobile.any()){
						$(this).tooltip({
							effect: "designa"
						});	
					}
				}
			});	
		} else {
			if (!isMobile.any()){
				$('.socialdiv li a[title]').tooltip({
					effect: "designa"
				});		
			}
		}
	} else {
		$('.socialdiv li a[title]').each(function(){
			if ($(this).parents('.header_container').length){
				if (!isMobile.any()){
					$(this).tooltip({
						effect: "designaDowner"
					});	
				}
			} else {
				if (!isMobile.any()){
					$(this).tooltip({
						effect: "designa"
					});	
				}
			}
		});
	}
	
	$('.footer_right_content .socialdiv li').each(function(){
		$(this).find('a[title]').tooltip({
			effect: "designaDowner"
		});
	});
	
	if ($('ul.service-items').length){
		$('ul.service-items').each(function(){
			$(this).children().not('li').remove();
			var ipr = parseInt($(this).attr('class').slice(-1), 10);
			var layout = "";
			switch (ipr){
				case 2: layout = "eight columns"; break;
				case 3: layout = "one-third column"; break;
				case 4: layout = "four columns"; break;
			}
			var aux = 0;
			var row = 0;
			var elements = [];
				elements[row] = [];
			for (var i=0; i< $(this).children('li').length; i++){
				$(this).children('li').eq(i).addClass(layout);
				if ($(this).hasClass('bigicons')){
					$(this).children('li').eq(i).find('.designare_icon').css({
						'width':'70px',
						'height':'70px',
						'float':'left'
					});
					$(this).children('li').eq(i).find('.item-title').width('auto');
					$(this).children('li').eq(i).find('.item-desc').css({
						'float':'none',
						'margin': '30px 0 0 0'
					});
				}
				$el = $(this).children('li').eq(i);
				if (aux < ipr){
					elements[row][aux] = $el;
				} 
				else {
					aux = 0;
					row++;
					elements[row] = [];
					elements[row][aux] = $el;
				}
				aux++;
			}
			for (var i=0; i< elements.length; i++){
				$(this).append('<div class="row row-'+i+'" />');
				for (var j=0; j< elements[i].length; j++){
					$(this).children('.row-'+i).append(elements[i][j]);
				}
			}
		});
	}
	
	if (window.BrowserDetect.browser == "iPhone")
		$('.acc-substitute .pane p, #accordion .pane p').css({ 'font-size': '11px' });
	
	onColorChange($('#styleColor').html());

	$(".option_btn").click(function(){
		if($("#option_wrapper").css("left")!="0px"){
			$("#option_wrapper").animate({left:"0px"},{duration:300});
			$(this).animate({left:"200px"},{duration:300});
			$(this).removeClass("settings-close").addClass("settings-open");
		}else{
			$("#option_wrapper").animate({left:"-230px"},{duration:300});
			$(".option_btn").animate({left:"0"},{duration:300});
			$(this).removeClass("settings-open").addClass("settings-close");
		}
	});

	
	$('a.flex_this_thumb, a.pp-link').prettyPhoto();
	
	var styleColor = $("#styleColor").html();
	if ($('#headerStyleType').html() === "style1" || $('#headerStyleType').html() === "style2"){
		for (var idx = 0; idx < $('header #menulava > li').length; idx++){

			if ($('header #menulava > li').eq(idx).find('.sub-menu').length){
				
				if (!$('header #menulava > li').eq(idx).hasClass('current-menu-ancestor') && !$('header #menulava > li').eq(idx).hasClass('current-menu-item')){
					$('header #menulava > li').eq(idx).hover(function(){
						$(this).css("border-bottom", "3px solid "+styleColor);
					}, function(){
						$(this).css("border-bottom", "3px solid transparent");
					});	
				}
				
			}
		}
		
	}
	if ($('#headerStyleType').html() === "style3"){
		for (var idx = 0; idx < $('header #menulava > li').length; idx++){

			if ($('header #menulava > li').eq(idx).find('.sub-menu').length){
				
				/*
if (!$('header #menulava > li').eq(idx).hasClass('current-menu-ancestor') && !$('header #menulava > li').eq(idx).hasClass('current-menu-item')){
					$('header #menulava > li').eq(idx).hover(function(){
						$(this).css("background", styleColor).css('color','white');
					}, function(){
						$(this).css("background", "white");
					});	
				}
*/
				
			}
		}
	}

	$(".video-wrapper").fitVids();

	if ($('.flexslider').length){
		$('.flexslider').css('overflow','hidden');
	}
	
	if($("#map").length > 0)
		initializeMaps();
	
	$('#map a').each(function(){
		$(this).hover(function(){
			$(this).find('.maphover').stop().animate({opacity: .6}, 300);
			$(this).find('.mapzoom').stop().animate({opacity: 1}, 300);
		}, function(){
			$(this).find('.maphover').stop().animate({opacity: 0}, 300);
			$(this).find('.mapzoom').stop().animate({opacity: 0}, 300);
		});
	});
	
	$(".tabs").tabs(".panes > div", {effect: "slide", autoHeight: true, history: false}).siblings('.panes').find('.main_cols.container').removeClass('container');
				
	/* search widget top */
	if ($('.search_toggler')){
		$('.search_toggler').each(function(){
			$(this)
				.unbind('click')
				.bind('click', function(){
					if ($(this).siblings('#s').hasClass('search_close')){
						$(this).siblings('#s').toggleClass('search_close');
						$(this).parents('#searchform').removeClass('ie_searcher_close').addClass('ie_searcher_open');
						$(this).siblings('#s').trigger('focus');
					} else {
						if ($(this).siblings('#s').val() == $(this).siblings('.search_box_text').html()){
							$(this).siblings('#s').toggleClass('search_close');
							$(this).parents('#searchform').removeClass('ie_searcher_open').addClass('ie_searcher_close');
						} else {
							$(this).siblings('#searchsubmit').trigger('click');
						}
					}
				});
		});	
	}
	
	/*special tabs stuff*/
	if ($('.special_tabs').length){
	
		$('.special_tabs').each(function(e){
		
			$(this).addClass('st-'+e);
			var el = $('.st-'+e);
			
			$(el).children("p, br").remove();

			$(el).append('<div class="tab-selector five columns" />');
			$(el).find('.label').appendTo($(el).children('.tab-selector'));
			$(el).append('<div class="tab-container eleven columns" />');
			$(el).find('.content').appendTo($(el).children('.tab-container'));
			
			$(el).find('.tab-selector > .label').eq(0).addClass('current');
			$(el).find('.tab-container > .content').eq(0).addClass('current').css({
				'opacity':1,
				'top':'0%'
			});
			
			if ($(el).find('.tab-container > .content').find('img.aligncenter').length){
		    	$(el).find('.tab-container > .content').find('img.aligncenter').parents('p').css('text-align','center');
		    }
			
			$(el).css('min-height', $(el).find('.tab-selector').height());
			if ($(el).find('.tab-container > .content').eq(0).height() > $(el).find('.tab-selector').height())
				$(el).animate({'height': $(el).find('.tab-container > .content').eq(0).height()}, 1000, 'easeInOutExpo');
			else $(this).parents('.special_tabs').animate({'height': $(this).parents('.tab-selector').height()}, 1000, 'easeInOutExpo');
			for ( var i = 1; i < $(el).find('.tab-container > .content').length; i++){
				$(el).find('.tab-container > .content').eq(i).css({
					'position':'absolute',
					'margin-top':'100%',
					opacity:0
				});
			}
			
			var elm = $(this).attr('class').split("special_tabs ");
			var elm = elm[1];
			
			$('.'+elm).find('.tab-selector > .label').each(function(){
			
				if (!$(this).find('.designare_icon_special_tabs').length){
					$(this).find('.tab_title').css('padding-left','10px');
				}
				
				$(this).append('<div class="tabpointer"><div class="triangle"></div></div>');

				var styleColor = $('#styleColor').html();

				$(this).find('.triangle').css({
					'border-top': $(this).height()/2+'px solid transparent',
					'border-bottom': $(this).height()/2+'px solid transparent',
					'border-left': '10px solid '+styleColor
				});
				
				$(this).click(function(){
				
					if (!$(this).hasClass('current')){
						var filterClass = $(this).attr('class').toString();
						var randid = filterClass.replace("label ","");
						var nextEl = $('.'+elm).find('.tab-container > .content.'+randid);
						if ($(nextEl).height() > $(this).parents('.tab-selector').height())
							$(this).parents('.special_tabs').stop().animate({'height': $(nextEl).height()}, 1000, 'easeInOutExpo');
						else 
							$(this).parents('.special_tabs').stop().animate({'height': $(this).parents('.tab-selector').height()}, 1000, 'easeInOutExpo');
						$(nextEl).css({'margin-top':'100%','top':'0%', 'display':'block'});
						var current = $('.'+elm).find('.tab-container > .current');
						var id = $(current).attr('class').split(" ");
							id = id[1];
						$('.'+elm).find('.tab-selector > .label.'+id).css({'color':'#5c5c5c'});
						$('.'+elm).find('.tab-selector > .label.'+id+'.current').css({'color':'#5c5c5c'});
						$(current).stop().animate({'margin-top':'100%', opacity:0}, 1000, 'easeInOutExpo', function(){
							$(this).css('display','none');
						}); 
						$('.'+elm).find('.tab-selector > .label.'+id).removeClass('current');
						$(current).removeClass('current');
						$(current).animate({
							'margin-top': '-100%',
							opacity: 0
						}, 1000, 'easeInOutExpo', function(){
							$(this).css({'margin-top':'100%'});
						});
						$('.'+elm).find('.tab-selector > .label.'+randid).css({'color': $('#styleColor').html() });
						$('.'+elm).find('.tab-selector > .label.'+randid).addClass('current');
						$('.'+elm).find('.tab-selector > label.'+randid).css('color', $('#styleColor').html());
						$('.'+elm).find('.tab-container > .content.'+randid).css('display','block');
						$('.'+elm).find('.tab-container > .content.'+randid).addClass('current').stop().animate({ 'margin-top': '0%', opacity:1 },1000, 'easeInOutExpo', function(){
							$(this).css('display','block');
							if ($(this).find('.services-graph').length){
								var id = $(this).find('.services-graph').attr('id');
								sliding_horizontal_graph(id,3000);
							}
							
							if (window.BrowserDetect.browser == "Explorer" && window.BrowserDetect.version == 8){
								if ($(this).find('.recent_testimonials').length){
									$(this).css('width','100%');
								}
							}
							
							if ($(this).find('.indproj2').length){
								$(this).find('.indproj2').each(function(){
									var newHeight = $(this).width() * window.ration;
									$(this).find('.da-thumbs li a').css('height',newHeight);
								});								
							}
							$.waypoints("refresh");
							
						});
					}		
				});
				
			});
			
		});
	}
	
	if ($('.recentPosts_style2 .flexslider').length){
		$('.recentPosts_style2 .flexslider').each(function(){
			var flexwho = $(this).attr('id').toString();
			$('#'+flexwho).flexslider({
				controlNav: false,
				directionNav: true
			}).find('.flex-direction-nav').css({'top':'45%', 'width':'112%', 'left':'-6%'});
		});
	}
	
	if (!isMobile.any() && $('.parallax.fullwidth-section').length) skrollr.init({forceHeight: false});
	
	setTimeout(function(){
		$('#wrapper, .fullwidth-container, .sf-menu ul').css('visibility','visible');
	}, 100);
});

function isScrolledIntoView(id){
    var elem = "#" + id;
    var docViewTop = $(window).scrollTop();
    var docViewBottom = docViewTop + $(window).height();

    if ($(elem).length > 0){
        var elemTop = $(elem).offset().top;
        var elemBottom = elemTop + $(elem).height();
    }

    return ((elemBottom >= docViewTop) && (elemTop <= docViewBottom)
      && (elemBottom <= docViewBottom) &&  (elemTop >= docViewTop) );
}



function sliding_horizontal_graph(id, speed){
    $("#" + id + " li span").each(function(i){                                  
        var cur_li = $("#" + id + " li").eq(i).find("span");
        var w = cur_li.attr("title");
        cur_li.animate({width: w + "%"}, speed);
    })
}

function graph_init(id, speed){
    $(window).scroll(function(){
    	if ($('#'+id).hasClass('notinview')){	    	
	    	if (isScrolledIntoView(id)){
	    		$('#'+id).removeClass('notinview');
	            sliding_horizontal_graph(id, speed);
	        }
    	}
    });
    
    if (isScrolledIntoView(id)){
        sliding_horizontal_graph(id, speed);
    }
}

function incrementNumerical(id, percent, speed){
	setTimeout(function(){
		var newVal = parseInt($(id+' .value').html(),10)+speed;

		if (newVal > percent) newVal = percent;
		$(id+' .value').html(newVal);
		if (newVal < percent){
			incrementNumerical(id, percent, speed);
		}
	}, 1);
}

function htmlDecode(a) {
    var b = $("<div/>").html(a).text();
    return b
}

function playpause($el){
	if ($el.hasClass('playing')){
		$('#slider_container').cameraResume();
		$el.removeClass('playing').addClass('paused');
	} else {
		$('#slider_container').cameraPause();
		$el.removeClass('paused').addClass('playing');
	}
}

/******************************************************************************************************************
	
	 Smartbox - Quicksand Function
	
	******************************************************************************************************************/

function quicksandstart(obj){
(function($) {
	$.fn.sorted = function(customOptions) {
		var options = {
			reversed: false,
			by: function(a) {
				return a.text();
			}
		};
		$.extend(options, customOptions);
	
		$data = $(this);
		arr = $data.get();
		arr.sort(function(a, b) {
			
		   	var valA = options.by($(a));
		   	var valB = options.by($(b));
			if (options.reversed) {
				return (valA < valB) ? 1 : (valA > valB) ? -1 : 0;				
			} else {		
				return (valA < valB) ? -1 : (valA > valB) ? 1 : 0;	
			}
		});
		return $(arr);
	};

})(jQuery);

$(function() {

	var read_button = function(class_names) {
    var r = {
      selected: false,
      type: 0
    };
    for (var i=0; i < class_names.length; i++) {
      if (class_names[i].indexOf('selected-') == 0) {
        r.selected = true;
      }
      if (class_names[i].indexOf('segment-') == 0) {
        r.segment = class_names[i].split('-')[1];
      }
    };
    return r;
  };
  
  var determine_sort = function($buttons) {
    var $selected = $buttons.parent().filter('[class*="selected-"]');
    return $selected.find('a').attr('data-value');
  };
  
  var determine_kind = function($buttons) {
    var $selected = $buttons.parent().filter('[class*="selected-"]');
    return $selected.find('a').attr('data-value');
  };
  
  var $preferences = {
    duration: 800,
    easing: 'easeInOutQuad',
    adjustHeight: 'auto'
  };
  
  var $list = $('#'+obj+' .proj_list');
  var $data = $list.clone();
  
  var $controls = $('#'+obj+' ul.splitter');
  
  $controls.each(function(i) {
  
    
    var $control = $(this);
    var $buttons = $control.find('a');
    
    $buttons.bind('click', function(e) {

    	
      var $button = $(this);
      var $button_container = $button.parent();
      var button_properties = read_button($button_container.attr('class').split(' '));      
      var selected = button_properties.selected;
      var button_segment = button_properties.segment;

      if (!selected) {

        $buttons.parent().removeClass('selected-0').removeClass('selected-1').removeClass('selected-2');
        $button_container.addClass('selected-' + button_segment);
        
        var sorting_type = determine_sort($controls.eq(1).find('a'));
        var sorting_kind = determine_kind($controls.eq(0).find('a'));
        
        if (sorting_kind == 'all') {
          var $filtered_data = $data.find('li.view');
        } else {
          var $filtered_data = $data.find('li.' + sorting_kind);
        }
        
        if (window.BrowserDetect.browser === "Firefox" || window.BrowserDetect.browser === "Chrome"){
        	$filtered_data.removeClass('animated').css('animation-name','basofias');
        }
        
        if (sorting_type == 'size') {
          var $sorted_data = $filtered_data.sorted({
            by: function(v) {
              return parseFloat($(v).find('span').text());
            }
          });
        } else {
          var $sorted_data = $filtered_data.sorted({
            by: function(v) {
              return $(v).find('strong').text().toLowerCase();
            }
          });
        }
                
        $list.quicksand($sorted_data, $preferences, function(){
			
			if ($('#projects-1').length){
				checkProjStyle1();
				$('.flex_this_thumb').prettyPhoto();
			} else {

				if (window.BrowserDetect.browser === "Firefox"){
					$('#projects-2 .da-thumbs > li').removeClass('animated').css('animation-name','basofias');
		        }
				$('#projects-2 .da-thumbs > li').hoverdir();

		        if ($('.imgloader').length){
					$('.imgloader').each(function(){
						$(this).animate({opacity: 0}, 500, function(){
							$(this).remove();
						});
						$(this).siblings('img').animate({opacity: 1}, 500);
					});
				}
			}
			
        });
                
      }
      e.preventDefault();

    });
    
  }); 
});
}

function clickThumbsOverlay(obj){
	/* PROJECTS - OPEN MORE INFO */
	$("#"+obj+" .projectCategories").find("a").click(function (event) {
	    var p_cat = $(this).attr("data-value");
	    
	    $("#"+obj+" .projectCategories").find("li.termCat").each(function(){
	    	$(this).removeClass('selected-1');
	    })
	    
	    $(this).parent("li.termCat").addClass('selected-1');    
	    if ($('#projects-1').length){
			checkProjStyle1();
			$("#"+obj+" .proj_list_overlay > li").each(function(e){
		    	if(p_cat == "all"){
		    		$(this).stop().animate({opacity: 1}, 1000);
		    		if (window.BrowserDetect.browser == "Explorer" && window.BrowserDetect.version == 8){
		    			$("#"+obj+" .proj_list_overlay li").eq(e).find('img').animate({'opacity':1}, 1000);
		    			$("#"+obj+" .proj_list_overlay li").eq(e).find('.mask').css({'visibility':'visible'});
		    		}
		    	} else {
		    		if($(this).hasClass(p_cat)){
		    			$(this).stop().animate({opacity: 1}, 1000);
		    			if (window.BrowserDetect.browser == "Explorer" && window.BrowserDetect.version == 8){
		    				$("#"+obj+" .proj_list_overlay li").eq(e).find('img').animate({'opacity':1}, 1000);
		    				$("#"+obj+" .proj_list_overlay li").eq(e).find('.mask').css({'visibility':'visible'});
		    			}
		    		} else {
			    		if (window.BrowserDetect.browser === "Safari"){
							$(this).removeClass( $(this).attr('class').split('animated')[1] );
						}
		    			$(this).stop().animate({opacity: 0.1}, 1000);
		    			$(this).add($(this).find('*')).unbind("mouseover mouseout mouseenter mouseleave");
		    			$(this).find('.mask').unbind('click');
		    			if (window.BrowserDetect.browser == "Explorer" && window.BrowserDetect.version == 8){
			    			$("#"+obj+" .proj_list_overlay li").eq(e).find('img').animate({'opacity':.1}, 1000);
			    			$("#"+obj+" .proj_list_overlay li").eq(e).find('.mask').css({'visibility':'hidden'});
			    		}
		    		}
		    	}
		    });
	    } else {
		    $("#"+obj+" .proj_list_overlay > li").each(function(e){
		    	$(this).css('pointer-events','auto');
		    	if(p_cat == "all"){
		    		$(this).stop().animate({opacity: 1}, 1000);
		    		if (window.BrowserDetect.browser == "Explorer" && window.BrowserDetect.version == 8){
		    			$("#"+obj+" .proj_list_overlay li").eq(e).find('img').animate({'opacity':1}, 1000);
		    			$("#"+obj+" .proj_list_overlay li").eq(e).find('.mask').css({'visibility':'visible'});
		    		}
		    	} else {
		    		if($(this).hasClass(p_cat)){
		    			$(this).stop().animate({opacity: 1}, 1000);
		    			if (window.BrowserDetect.browser == "Explorer" && window.BrowserDetect.version == 8){
		    				$("#"+obj+" .proj_list_overlay li").eq(e).find('img').animate({'opacity':1}, 1000);
		    				$("#"+obj+" .proj_list_overlay li").eq(e).find('.mask').css({'visibility':'visible'});
		    			}
		    		} else {
			    		if (window.BrowserDetect.browser === "Safari"){
							$(this).removeClass( $(this).attr('class').split('animated')[1] );
						}
		    			$(this).stop().animate({opacity: 0.1}, 1000);
		    			$(this).css('pointer-events','none');
		    			if (window.BrowserDetect.browser == "Explorer" && window.BrowserDetect.version == 8){
			    			$("#"+obj+" .proj_list_overlay li").eq(e).find('img').animate({'opacity':.1}, 1000);
			    			$("#"+obj+" .proj_list_overlay li").eq(e).find('.mask').css({'visibility':'hidden'});
			    		}
		    		}
		    	}
		    });
		    $('#projects-2 .da-thumbs > li:not(.disabled)').hoverdir();
	    }    
	});

}


var BrowserDetect = {
    init: function () {
        this.browser = this.searchString(this.dataBrowser) || "An unknown browser";
        this.version = this.searchVersion(navigator.userAgent) || this.searchVersion(navigator.appVersion) || "an unknown version";
        this.OS = this.searchString(this.dataOS) || "an unknown OS"
    },
    searchString: function (a) {
        for (var b = 0; b < a.length; b++) {
            var c = a[b].string;
            var d = a[b].prop;
            this.versionSearchString = a[b].versionSearch || a[b].identity;
            if (c) {
                if (c.indexOf(a[b].subString) != -1) return a[b].identity
            } else if (d) return a[b].identity
        }
    },
    searchVersion: function (a) {
        var b = a.indexOf(this.versionSearchString);
        if (b == -1) return;
        return parseFloat(a.substring(b + this.versionSearchString.length + 1))
    },
    dataBrowser: [{
        string: navigator.userAgent,
        subString: "Chrome",
        identity: "Chrome"
    }, {
        string: navigator.userAgent,
        subString: "OmniWeb",
        versionSearch: "OmniWeb/",
        identity: "OmniWeb"
    }, {
        string: navigator.vendor,
        subString: "Apple",
        identity: "Safari",
        versionSearch: "Version"
    }, {
        prop: window.opera,
        identity: "Opera",
        versionSearch: "Version"
    }, {
        string: navigator.vendor,
        subString: "iCab",
        identity: "iCab"
    }, {
        string: navigator.vendor,
        subString: "KDE",
        identity: "Konqueror"
    }, {
        string: navigator.userAgent,
        subString: "Firefox",
        identity: "Firefox"
    }, {
        string: navigator.vendor,
        subString: "Camino",
        identity: "Camino"
    }, {
        string: navigator.userAgent,
        subString: "Netscape",
        identity: "Netscape"
    }, {
        string: navigator.userAgent,
        subString: "MSIE",
        identity: "Explorer",
        versionSearch: "MSIE"
    }, {
        string: navigator.userAgent,
        subString: "Gecko",
        identity: "Mozilla",
        versionSearch: "rv"
    }, {
        string: navigator.userAgent,
        subString: "Mozilla",
        identity: "Netscape",
        versionSearch: "Mozilla"
    }],
    dataOS: [{
        string: navigator.platform,
        subString: "Win",
        identity: "Windows"
    }, {
        string: navigator.platform,
        subString: "Mac",
        identity: "Mac"
    }, {
        string: navigator.userAgent,
        subString: "iPhone",
        identity: "iPhone/iPod"
    }, {
        string: navigator.platform,
        subString: "Linux",
        identity: "Linux"
    }]
};
BrowserDetect.init();


function initializeMaps(){
	            
  var latlng = new google.maps.LatLng($('#gm_lat').val(), $('#gm_lng').val());
	var myOptions = {
	  scrollwheel: false,
	  zoom: 15,
	  center: latlng,
	  mapTypeId: google.maps.MapTypeId.ROADMAP
	};
	if(document.getElementById('map'))
		var map = new google.maps.Map(document.getElementById('map'), myOptions);
	
	// Creating a marker and positioning it on the map
	var marker = new google.maps.Marker({
	  position: new google.maps.LatLng($('#gm_lat').val(), $('#gm_lng').val()),
	  map: map
	});
	
	google.maps.event.addListener(map, "tilesloaded", function(){
		$('#map').find('.gmnoprint').eq(0).remove();
		google.maps.event.clearInstanceListeners(map);
	}, true);

}

function onColorChange(color){
	
	$('.scrollbar .track .thumb').css('background',color);

	$('.post_type, .camera_next:hover span').css('background-color',' ');
	$('.post_type, .camera_next:hover span, .pricing_tab.highlight .title, .shortcode-toggle.open a').css("background-color",color);
	
	$('.camera-controls-toggler').css({'background': $.xcolor.lighten(color) , 'border-bottom': '3px solid '+color});
	
	$('.cameraholder, .page_title_s2 .overlay_sep, .page_title_s3 .overlay_sep, .page_title_s4 .overlay_sep, #tweet_scroll_place, #navT .activeSlide').css('background', ' ');
	$('.cameraholder, .page_title_s2 .overlay_sep, .page_title_s3 .overlay_sep, .page_title_s4 .overlay_sep, #navT .activeSlide').css('background',color);
	
	$('#tweet_scroll_place').css('background','rgba('+hexToRgb(color).r+','+hexToRgb(color).g+','+hexToRgb(color).b+',0)');
	
	$('.cameraholder .vert-sep').css('background', ' ');
	$('.cameraholder .vert-sep, #mc-embedded-subscribe').css('background', $.xcolor.darken(color));
	
	$('.color_logo, header #menulava > li.current-menu-item > a, header #menulava > li.current-menu-ancestor > a, .shortcode-team .team-box h5, #tabs ul.tabs li a:hover, #tabs ul.tabs li a.current, a.button.none:hover').css('color',color);
	
	var linksColor = color;
	if ($('#smartbox_links_color_hover').html() != "") linksColor = "#"+$('#smartbox_links_color_hover').html();
	
	$('.entry-breadcrumb a:hover, .blogarchive .post .the_title a:hover, .blogarchive .post .readmore a:hover, #footer_content .widget_links li a:hover, #footer_content .widget_categories li a:hover, #secondary .widget_links li a:hover, #secondary .widget_categories li a:hover, .recentposts_listing a.the_title:hover, #footer_content #recentPostsSidebar_widget .recentposts_listing a.the_title:hover, #footer_content #recentPostsSidebar_widget .recentposts_listing a.the_title:hover, #twitter_update_list li a:hover,.recentPosts .post .title_date .title a:hover,.blogarchive .post a.readmore:hover, .widget_pages li a:hover, .rc-container a:hover').css('color',linksColor)
	
	if ($('#headerStyleType').html() === "style1" || $('#headerStyleType').html() === "style2"){
		$('header #menulava > li.current-menu-item, header #menulava > li.current-menu-ancestor').css('border-bottom', '3px solid '+color);	
		for (var idx = 0; idx < $('header #menulava > li').length; idx++){
			if ($('header #menulava > li').eq(idx).find('.sub-menu').length){
				
				if (!$('header #menulava > li').eq(idx).hasClass('current-menu-ancestor') && !$('header #menulava > li').eq(idx).hasClass('current-menu-item')){
					$('header #menulava > li').eq(idx).hover(function(){
						$(this).css("border-bottom", "3px solid "+styleColor);
					}, function(){
						$(this).css("border-bottom", "0px solid transparent");
					});	
				}
			}
		}
	}
	if ($('#headerStyleType').html() === "style3"){
		for (var idx = 0; idx < $('header #menulava > li').length; idx++){
			if ($('header #menulava > li').eq(idx).find('.sub-menu').length){
				if (!$('header #menulava > li').eq(idx).hasClass('current-menu-ancestor') && !$('header #menulava > li').eq(idx).hasClass('current-menu-item')){
					$('header #menulava > li').eq(idx).hover(function(){
						$(this).css("background", styleColor).css('color','white');
					}, function(){
						$(this).css("background", "white");
					});	
				}
			}
		}
	}
	
	if ($('.flex-caption .caption-title').length){
		$('.flex-caption .caption-title').css('background','rgba('+hexToRgb(color).r+','+hexToRgb(color).g+','+hexToRgb(color).b+',0.8)');
	}
	
	$('ul.tabs li a.current').css('border-top', '1px solid '+color);
	
	$('.services-graph li span, .filterby .projectCategories li a:hover').css('background', color);
	
	$('.socialdiv a[title]').removeAttr('style').css('background', ' ');
	
	$('.magnify_this_thumb, .hyperlink_this_thumb').removeAttr('onmouseover onmouseout').unbind('hover').hover(function(){
		$(this).css('background',color); 
	}, function(){
		$(this).css('background','white');
	});
	
	
	$('.camera_next, .camera_prev').unbind('mouseover mouseout mouseenter mouseleave').hover(function(){
		$(this).find('span').css("background-color",color);
	}, function(){
		$(this).find('span').css("background-color",'#444');
	});
	
	$('.jcarousel-prev-horizontal, .jcarousel-next-horizontal, .flex-direction-nav li a').hover(function(){
		$(this).css('background-color', color);
	}, function(){
		$(this).css('background-color', '');
	});

	$('#flickr li').each(function(){
		$(this).hover(function(){
			$(this).css('border','3px solid '+color);
		}, function(){
			$(this).css('border','3px solid #EDEDED');
		});
	});

	if (!$('.ua_ie11').length){
		$('.sf-menu li li a').hover(function(){
			$(this).css('color',color);
		}, function(){
			$(this).css('color', ' ');
		});	
	}
	
	$('.option_btn.settings-open').css('background-color', color);
	
		
	$("a:not(.button)").each(function(){
		var c =  $(this).css("color");
		
		if($(this).parent().hasClass("termCat") || 
		   $(this).parent().hasClass('menu-item') ||
		   $(this).parent().hasClass('p_title') ||
		   $(this).parent().parent().hasClass('flex-direction-nav')
		){}
		else{
			var linksColor = color;
			if ($('#smartbox_links_color_hover').html() != "") linksColor = "#"+$('#smartbox_links_color_hover').html();
			$(this).hover(function(){
		      $(this).css("color", linksColor);
		  }, function() {
		      $(this).css("color", c);
		  });
		 }
	});
	
	$('.recentposts_listing a.the_title').each(function(){
		var linksColor = color;
		if ($('#smartbox_links_color_hover').html() != "") linksColor = "#"+$('#smartbox_links_color_hover').html();
		$(this).hover(function(){
			$(this).css('color',linksColor);
		}, function(){
			$(this).css('color',' ');
		});
	});
	
	/*VERTICAL TABS*/
	$('.special_tabs .tab-selector .label.current .designare_icon_special_tabs').css('background-color', color);
	$('.special_tabs .tab-selector .label.current .tab_title').css('color', color);

	if (window.BrowserDetect.browser == "Explorer" && window.BrowserDetect.version == 8){
		if ($('.project_list_s3 .slides_container .indproj1').length){
			$('.project_list_s3 .slides_container .indproj1').hover(function(){
				var argb = '#CC'+$('#styleColor').html().substring(1);
				$(this).find('.mask').css({
					'background':'none',
					'-ms-filter':'progid:DXImageTransform.Microsoft.gradient(startColorstr='+argb+',endColorstr='+argb+')',
					'filter':'progid:DXImageTransform.Microsoft.gradient(startColorstr='+argb+',endColorstr='+argb+')',
					'zoom':'1'
				});
			}, function(){
				$(this).find('.mask').css({
					'background':'none',
					'-ms-filter':'progid:DXImageTransform.Microsoft.gradient(startColorstr=#00FFFFFF,endColorstr=#00FFFFFF)',
					'filter':'progid:DXImageTransform.Microsoft.gradient(startColorstr=#00FFFFFF,endColorstr=#00FFFFFF)',
					'zoom':'1'
				});
			});
			$('.project_list_s3 .slides_container .indproj1 .p_title a').hover(function(){
				$(this).css('color',color);
			}, function(){
				$(this).css('color', ' ');
			});
		}
		
		if ($('.thumbnails_list > ul > li').length){
			$('.thumbnails_list > ul > li').hover(function(){
				var argb = '#CC'+$('#styleColor').html().substring(1);
				$(this).find('.mask').css({
					'background':'none',
					'-ms-filter':'progid:DXImageTransform.Microsoft.gradient(startColorstr='+argb+',endColorstr='+argb+')',
					'filter':'progid:DXImageTransform.Microsoft.gradient(startColorstr='+argb+',endColorstr='+argb+')',
					'zoom':'1'
				});
			}, function(){
				$(this).find('.mask').css({
					'background':'none',
					'-ms-filter':'progid:DXImageTransform.Microsoft.gradient(startColorstr=#00FFFFFF,endColorstr=#00FFFFFF)',
					'filter':'progid:DXImageTransform.Microsoft.gradient(startColorstr=#00FFFFFF,endColorstr=#00FFFFFF)',
					'zoom':'1'
				});
			});
			$('.thumbnails_list > ul > li .p_title a').hover(function(){
				$(this).css('color',color);
			}, function(){
				$(this).css('color', ' ');
			});
		}
		
		if ($('.featured-image-thumb .mask').length){
			$('.featured-image-thumb .mask').hover(function(){
				var argb = '#CC'+$('#styleColor').html().substring(1);
				$(this).css({
					'background':'none',
					'-ms-filter':'progid:DXImageTransform.Microsoft.gradient(startColorstr='+argb+',endColorstr='+argb+')',
					'filter':'progid:DXImageTransform.Microsoft.gradient(startColorstr='+argb+',endColorstr='+argb+')',
					'zoom':'1'
				});
			}, function(){
				$(this).css({
					'background':'none',
					'-ms-filter':'progid:DXImageTransform.Microsoft.gradient(startColorstr=#00FFFFFF,endColorstr=#00FFFFFF)',
					'filter':'progid:DXImageTransform.Microsoft.gradient(startColorstr=#00FFFFFF,endColorstr=#00FFFFFF)',
					'zoom':'1'
				});
			});
		}
		
		if ($('.flexslider .mask').length){
			$('.flexslider .mask').hover(function(){
				var argb = '#CC'+$('#styleColor').html().substring(1);
				$(this).css({
					'background':'none',
					'-ms-filter':'progid:DXImageTransform.Microsoft.gradient(startColorstr='+argb+',endColorstr='+argb+')',
					'filter':'progid:DXImageTransform.Microsoft.gradient(startColorstr='+argb+',endColorstr='+argb+')',
					'zoom':'1'
				});
			}, function(){
				$(this).css({
					'background':'none',
					'-ms-filter':'progid:DXImageTransform.Microsoft.gradient(startColorstr=#00FFFFFF,endColorstr=#00FFFFFF)',
					'filter':'progid:DXImageTransform.Microsoft.gradient(startColorstr=#00FFFFFF,endColorstr=#00FFFFFF)',
					'zoom':'1'
				});
			});		
		}
		
		if ($('.image_container .mask').length){
			$('.image_container .mask').hover(function(){
				var argb = '#CC'+$('#styleColor').html().substring(1);
				$(this).css({
					'background':'none',
					'-ms-filter':'progid:DXImageTransform.Microsoft.gradient(startColorstr='+argb+',endColorstr='+argb+')',
					'filter':'progid:DXImageTransform.Microsoft.gradient(startColorstr='+argb+',endColorstr='+argb+')',
					'zoom':'1'
				});
			}, function(){
				$(this).css({
					'background':'none',
					'-ms-filter':'progid:DXImageTransform.Microsoft.gradient(startColorstr=#00FFFFFF,endColorstr=#00FFFFFF)',
					'filter':'progid:DXImageTransform.Microsoft.gradient(startColorstr=#00FFFFFF,endColorstr=#00FFFFFF)',
					'zoom':'1'
				});
			});
		}
	} else {
		if ($('.project_list_s3 .slides_container .indproj1').length){
			$('.project_list_s3 .slides_container .indproj1').hover(function(){
				$(this).find('.mask').css('background-color','rgba('+hexToRgb(color).r+','+hexToRgb(color).g+','+hexToRgb(color).b+',0.8)');
			}, function(){
				$(this).find('.mask').css('background-color','rgba(0,0,0,0)');
			});
			$('.project_list_s3 .slides_container .indproj1 .p_title a').hover(function(){
				$(this).css('color',color);
			}, function(){
				$(this).css('color', ' ');
			});
		}
		
		if ($('.thumbnails_list > ul > li').length){
			$('.thumbnails_list > ul > li').hover(function(){
				$(this).find('.mask').css('background-color','rgba('+hexToRgb(color).r+','+hexToRgb(color).g+','+hexToRgb(color).b+',0.8)');
			}, function(){
				$(this).find('.mask').css('background-color','rgba(0,0,0,0)');
			});
			$('.thumbnails_list > ul > li .p_title a').hover(function(){
				$(this).css('color',color);
			}, function(){
				$(this).css('color', ' ');
			});
		}
		
		if ($('.featured-image-thumb .mask').length){
			$('.featured-image-thumb .mask').hover(function(){
				$(this).css('background-color','rgba('+hexToRgb(color).r+','+hexToRgb(color).g+','+hexToRgb(color).b+',0.8)');
			}, function(){
				$(this).css('background-color','rgba(0,0,0,0)');
			});
		}
		
		if ($('.flexslider .mask').length){
			$('.flexslider .mask').hover(function(){
				$(this).css('background-color','rgba('+hexToRgb(color).r+','+hexToRgb(color).g+','+hexToRgb(color).b+',0.8)');
			}, function(){
				$(this).css('background-color','rgba(0,0,0,0)');
			});
		}
		
		if ($('.image_container .mask').length){
			$('.image_container .mask').hover(function(){
				$(this).css('background-color','rgba('+hexToRgb(color).r+','+hexToRgb(color).g+','+hexToRgb(color).b+',0.8)');
			}, function(){
				$(this).css('background-color','rgba(0,0,0,0)');
			});
		}	
	}
	

}

/* Convert HEX to RGB */
function hexToRgb(hex) {
    var result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex);
    return result ? {
        r: parseInt(result[1], 16),
        g: parseInt(result[2], 16),
        b: parseInt(result[3], 16)
    } : null;
}

// Grayscale w canvas method
function grayscale(src){
	var canvas = document.createElement('canvas');
	var ctx = canvas.getContext('2d');
	var imgObj = new Image();
	imgObj.src = src;
	canvas.width = imgObj.width;
	canvas.height = imgObj.height; 
	ctx.drawImage(imgObj, 0, 0); 
	var imgPixels = ctx.getImageData(0, 0, canvas.width, canvas.height);
	for(var y = 0; y < imgPixels.height; y++){
		for (var x = 0; x < imgPixels.width; x++){
			var i = (y * 4) * imgPixels.width + x * 4;
			var avg = (imgPixels.data[i] + imgPixels.data[i + 1] + imgPixels.data[i + 2]) / 3;
			imgPixels.data[i] = avg; 
			imgPixels.data[i + 1] = avg; 
			imgPixels.data[i + 2] = avg;
		}
	}
	ctx.putImageData(imgPixels, 0, 0, 0, 0, imgPixels.width, imgPixels.height);
	return canvas.toDataURL();
	
}

var isMobile = {
    Android: function() {
        return navigator.userAgent.match(/Android/i);
    },
    BlackBerry: function() {
        return navigator.userAgent.match(/BlackBerry/i);
    },
    iOS: function() {
        return navigator.userAgent.match(/iPhone|iPad|iPod/i);
    },
    Opera: function() {
        return navigator.userAgent.match(/Opera Mini/i);
    },
    Windows: function() {
        return navigator.userAgent.match(/IEMobile/i);
    },
    any: function() {
        return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
    },
    allExceptIpad: function(){
	    return (isMobile.Android() || isMobile.BlackBerry() || navigator.userAgent.match(/iPhone|iPod/i) || isMobile.Opera() || isMobile.Windows());
    }
};

function validate_email(email) {
   var reg = /^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i;
   if(reg.test(email) == false) {
      return 0;
   } else {
   		return 1;
   }
}

function changeTab(obj){

	$(obj).siblings('li').each(function(){
		$(this).find('a').removeClass('current');
	});
	
	$(obj).find('a').addClass('current');
	
}

function changeAccord(obj){

	$(obj).parent().find('h2').each(function(){
		$(this).removeClass('current').css('color','#555');
	});
	
	$(obj).addClass('current').css('color',$('#option_wrapper #color').val());
	
	$(obj).siblings('div.pane').each(function(){
		if (!$(this).prev().hasClass('current')) {
			//$(this).animate({ 'max-height': 0, 'padding-bottom': 0, 'opacity': 0 }, 500);
			$(this).slideUp(500).animate({'padding-bottom': 0, 'opacity': 0}, 500, function(){
				$(obj).next().slideDown(500).animate({'padding-bottom': '20px', 'opacity': 1}, 500, function(){
					$(obj).next().css('display','block');
					if ($(this).parents('.special_tabs').length){
					
						if ($(this).parents('.special_tabs').find('.tab-container > .content.current').height()> $(this).parents('.special_tabs').find('.tab-selector').height())
							$(this).parents('.special_tabs').animate({'height': $(this).parents('.special_tabs').find('.tab-container > .content.current').height()}, 200, 'easeInOutExpo');
						else 
							$(this).parents('.special_tabs').animate({'height': $(this).parents('.special_tabs').find('.tab-selector').height()}, 200, 'easeInOutExpo');
						
					}
				});
			});
		
		}
	});
}

function toggleTrigger(obj){
	
	if ($(obj).parents('.shortcode-toggle').hasClass('open')) {
		//close
		$(obj).html( $(obj).parents('.shortcode-toggle').find('#title_closed').val() );
		$(obj).parents('.shortcode-toggle').find('.toggle-content').slideUp(500, "easeOutCubic", function(){
			$(obj).parents('.shortcode-toggle').removeClass('open').addClass('closed');
			if ($(this).parents('.special_tabs').length){
				if ($(this).parents('.special_tabs').find('.tab-container > .content.current').height()> $(this).parents('.special_tabs').find('.tab-selector').height())
					$(this).parents('.special_tabs').animate({'height': $(this).parents('.special_tabs').find('.tab-container > .content.current').height()}, 200, 'easeInOutExpo');
				else 
					$(this).parents('.special_tabs').animate({'height': $(this).parents('.special_tabs').find('.tab-selector').height()}, 200, 'easeInOutExpo');
			}
		});
	}
	else {
		//open
		$(obj).html( $(obj).parents('.shortcode-toggle').find('#title_open').val() );
		$(obj).parents('.shortcode-toggle').find('.toggle-content').slideDown(500, "easeOutCubic", function(){
			$(obj).parents('.shortcode-toggle').addClass('open').removeClass('closed');
			if ($(this).parents('.special_tabs').length){				
				if ($(this).parents('.special_tabs').find('.tab-container > .content.current').height()> $(this).parents('.special_tabs').find('.tab-selector').height())
					$(this).parents('.special_tabs').animate({'height': $(this).parents('.special_tabs').find('.tab-container > .content.current').height()}, 200, 'easeInOutExpo');
				else 
					$(this).parents('.special_tabs').animate({'height': $(this).parents('.special_tabs').find('.tab-selector').height()}, 200, 'easeInOutExpo');
				
			}
		});
	} 
	
}


/* contact.js */
function sendemail($el, SendTo, Subject, NameErr, EmailErr, MessageErr, SuccessErr, UnsuccessErr){

	//Custom variables
	var sendTo = SendTo; //send the form elements to this email (company email)
	var subject = Subject; //subject of the email
	var nameErr = NameErr; //Error message when Name field is empty
	var emailErr = EmailErr; //Error message when Email field is empty or email is not valid
	var messageErr = MessageErr; //Error message when Message field is empty
	var successErr = SuccessErr; //Message when the email was sent successfully
	var unsuccessErr = UnsuccessErr; //Message when the email was not sent

	$el = $el.parents('.contact-form');
	
	if ($el.parents('.contact-widget-container').length){
		nameErr = $el.find('.yourname_error').html();
		emailErr = $el.find('.youremail_error').html();
		messageErr = $el.find('.yourmessage_error').html();
	}

	//Reset field errors/variables
	$el.find('.yourname').removeClass("with_error").removeClass("change_error");
	$el.find('.youremail').removeClass("with_error").removeClass("change_error");
	$el.find('.yourmessage').removeClass("with_error").removeClass("change_error");
	var templatepath = $("#templatepath").html();
	var err = 0;

    // Check fields
    var name = $el.find('.yourname_val').html();
    var email = $el.find('.youremail_val').html();
    var emailVer = validate_email(email);
    var message = $el.find('.yourmessage').val();    

    if (!name || name.length == 0 || name == nameErr || name == "Name")
    {
    	$el.find('.yourname').addClass("with_error");
        $el.find('.yourname').val(nameErr);
        err = 1;
    }
    if (!email || email.length == 0 || emailVer == 0)
    {
    	$el.find('.youremail').addClass("with_error");
        $el.find('.youremail').val(emailErr);
        err = 1;
    }
      
    if ($el.parents('.contact-widget-container').length){
	 	if (!message || message.length == 0 || message == messageErr || message == "Message")
	    {
	    	$el.find('.yourmessage').addClass("with_error");
	        $el.find('.yourmessage').val(messageErr);
	        err = 1;
	    } 
	} else {
	    if (!message || message.length == 0 || message == messageErr || message == "")
	    {
	    	$el.find('.yourmessage').addClass("with_error");
	        $el.find('.yourmessage').val(messageErr);
	        err = 1;
	    }
    }    
   	//If there's no error submit form
	if(err == 0)
    {
        // Request
        var tp = encodeURIComponent(templatepath);
        var data = {
            name: name,
            email: email,
            sendTo: sendTo,
            subject: subject,
            message: message,
            success: successErr,
            unsuccess: unsuccessErr,
            templatepath: tp
        };
        				
        // Send
        $.ajax({
            url: ""+templatepath+"js/sendemail.php",
            dataType: 'json',
            type: 'POST',
            data: data,
            success: function(data, textStatus, XMLHttpRequest)
            {
                if (data.response.error)
                {  
                    if(data.response.error == 1){
                    	$el.find('.message_success').css('background','#64943c');
                    	$el.find('.message_success').css('display','block');
                        $el.find('.message_success').html(data.response.message);
                    }
                    else{
                    	$el.find('.message_success').css('background','#C35D5D');
                    	$el.find('.message_success').css('display','block');
                        $el.find('.message_success').html(data.response.message);
                    }
                }
                else
                {
                    // Message
                   $el.find('.message_success').css('background','#C35D5D');
                   $el.find('.message_success').css('display','block');
                   $el.find('.message_success').html("An unexpected error occured, please try again.");
                }
            },
            error: function(XMLHttpRequest, textStatus, errorThrown)
            {
                // Message
                $el.find('.message_success').css('background','#C35D5D');
                $el.find('.message_success').css('display','block');
                $el.find('.message_success').html("Error while contacting server, please try again.");
            }
        });
			
        // Message
        $el.find('.message_success').css('background','#64943c');
        $el.find('.message_success').css('display','block');
        $el.find('.message_success').html("Sending...");
    }

}

function checkerror(elem){
	if($(elem).hasClass('with_error')) {
		$(elem).removeClass('with_error').addClass('change_error');
		$(elem).val("");
	}
}

function validate_email(email) {
   var reg = /^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i;
   if(reg.test(email) == false) {
      return 0;
   } else {
   		return 1;
   }
}

$(function(){for(var e=0;e<$(".serviceballs").length;e++){$shortcodeservice=$(".serviceballs").eq(e);if($(window).width()>957){$shortcodeservice.find("#banner ul li:first-child").css({left:"-31px"});$shortcodeservice.find("#banner ul li:nth-child(2)").css({left:"165px"});$shortcodeservice.find("#banner ul li:nth-child(3)").css({left:"363px"});$shortcodeservice.find("#banner ul li:last-child").css({left:"560px"})}else{$shortcodeservice.find("#banner ul li:first-child").css({left:"-50px"});$shortcodeservice.find("#banner ul li:nth-child(2)").css({left:"100px"});$shortcodeservice.find("#banner ul li:nth-child(3)").css({left:"250px"});$shortcodeservice.find("#banner ul li:last-child").css({left:"400px"})}$shortcodeservice.find("#banner ul li h2").unbind("click");$shortcodeservice.find("#banner ul li h2").click(function(e){target=$(this).parent().attr("id");$service=$(this).parents(".serviceballs");if($(window).width()>957){if($(this).parent().is(":first-child")){if(window.BrowserDetect.browser=="Explorer"&&window.BrowserDetect.version==8){$(this).parent().children("ul").css("left","240px")}if($(this).parent().hasClass("open")){$("#"+target+" .servicesScroller").slideUp("100",function(){$service.find("#banner ul li:first-child").animate({left:"-31px"},"1200");$service.find("#banner ul li:nth-child(2)").animate({left:"165px"},"1200");$service.find("#banner ul li:nth-child(3)").animate({left:"363px"},"1200");$service.find("#banner ul li:last-child").animate({left:"560px"},"1200")});$(this).parent().removeClass("open")}else{if($service.find("#banner ul li.open").length==0){$service.find("#banner ul li:nth-child(2)").animate({left:"445px"},"1200");$service.find("#banner ul li:nth-child(3)").animate({left:"545px"},"1200");$service.find("#banner ul li:last-child").animate({left:"645px"},"1200");$("#"+target+" > ul").slideDown("slow",function(){$(this).find(".scrollbar").css("display","none");$(this).tinyscrollbar({scroll:true});$(this).hover(function(){console.log($(this));if(!$(this).find(".scrollbar").hasClass("disable"))$(this).find(".scrollbar").stop().fadeTo(400,.8)},function(){$(this).find(".scrollbar").stop().fadeOut(400)})});$(this).parent().addClass("open")}else{$service.find("#banner ul li.open > ul").slideUp("100",function(){$service.find("#banner ul li:first-child").animate({left:"-31px"},"1200");$service.find("#banner ul li:nth-child(2)").animate({left:"165px"},"1200");$service.find("#banner ul li:nth-child(3)").animate({left:"363px"},"1200");$service.find("#banner ul li:last-child").animate({left:"560px"},"1200",function(){$service.find("#banner ul li.open").find(".servicesScroller").unbind("mouseover mouseout hover");$service.find("#banner ul li.open").removeClass("open");$service.find("#banner ul li:nth-child(2)").animate({left:"445px"},"1200");$service.find("#banner ul li:nth-child(3)").animate({left:"545px"},"1200");$service.find("#banner ul li:last-child").animate({left:"645px"},"1200");$("#"+target+" > ul").slideDown("slow",function(){$(this).find(".scrollbar").css("display","none");$(this).tinyscrollbar({scroll:true});$(this).hover(function(){if($(this).find(".overview").height()>$("#"+target).height()){$(this).find(".scrollbar").stop().fadeTo(400,.8)}else $(this).find(".scrollbar").css("display","none")},function(){$(this).find(".scrollbar").stop().fadeOut(400)})});$("#"+target).addClass("open")})})}}}else if($(this).parent().is(":nth-child(2)")){if(window.BrowserDetect.browser=="Explorer"&&window.BrowserDetect.version==8){$(this).parent().children("ul").css("left","240px")}if($(this).parent().hasClass("open")){$("#"+target+" > ul").slideUp("100",function(){$service.find("#banner ul li:first-child").animate({left:"-31px"},"1200");$service.find("#banner ul li:nth-child(2)").animate({left:"165px"},"1200");$service.find("#banner ul li:nth-child(3)").animate({left:"363px"},"1200");$service.find("#banner ul li:last-child").animate({left:"560px"},"1200")});$(this).parent().removeClass("open")}else{if($service.find("#banner ul li.open").length==0){$service.find("#banner ul li:nth-child(1)").animate({left:"-80px"},"1200");$service.find("#banner ul li:nth-child(2)").animate({left:"70px"},"1200");$service.find("#banner ul li:nth-child(3)").animate({left:"545px"},"1200");$service.find("#banner ul li:last-child").animate({left:"645px"},"1200");$("#"+target+" > ul").slideDown("slow",function(){$(this).find(".scrollbar").css("display","none");$(this).tinyscrollbar({scroll:true});$(this).hover(function(){console.log($(this));if(!$(this).find(".scrollbar").hasClass("disable"))$(this).find(".scrollbar").stop().fadeTo(400,.8)},function(){$(this).find(".scrollbar").stop().fadeOut(400)})});$(this).parent().addClass("open")}else{$service.find("#banner ul li.open > ul").slideUp("100",function(){$service.find("#banner ul li:first-child").animate({left:"-31px"},"1200");$service.find("#banner ul li:nth-child(2)").animate({left:"165px"},"1200");$service.find("#banner ul li:nth-child(3)").animate({left:"363px"},"1200");$service.find("#banner ul li:last-child").animate({left:"560px"},"1200",function(){$service.find("#banner ul li.open").find(".servicesScroller").unbind("mouseover mouseout hover");$service.find("#banner ul li.open").removeClass("open");$service.find("#banner ul li:nth-child(1)").animate({left:"-80px"},"1200");$service.find("#banner ul li:nth-child(2)").animate({left:"70px"},"1200");$service.find("#banner ul li:nth-child(3)").animate({left:"545px"},"1200");$service.find("#banner ul li:last-child").animate({left:"645px"},"1200");$("#"+target+" > ul").slideDown("slow",function(){$(this).find(".scrollbar").css("display","none");$(this).tinyscrollbar({scroll:true});$(this).hover(function(){if($(this).find(".overview").height()>$("#"+target).height()){$(this).find(".scrollbar").stop().fadeTo(400,.8)}else $(this).find(".scrollbar").css("display","none")},function(){$(this).find(".scrollbar").stop().fadeOut(400)})});$("#"+target).addClass("open")})})}}}else if($(this).parent().is(":nth-child(3)")){if(window.BrowserDetect.browser=="Explorer"&&window.BrowserDetect.version==8){}else $(this).parent().children("ul").css("left","270px");if($(this).parent().hasClass("open")){$("#"+target+" > ul").slideUp("100",function(){$service.find("#banner ul li:first-child").animate({left:"-31px"},"1200");$service.find("#banner ul li:nth-child(2)").animate({left:"165px"},"1200");$service.find("#banner ul li:nth-child(3)").animate({left:"363px"},"1200");$service.find("#banner ul li:last-child").animate({left:"560px"},"1200")});$(this).parent().removeClass("open")}else{if($service.find("#banner ul li.open").length==0){$service.find("#banner ul li:first-child").animate({left:"-80px"},"1200");$service.find("#banner ul li:nth-child(2)").animate({left:"20px"},"1200");$service.find("#banner ul li:nth-child(3)").animate({left:"120px"},"1200");$service.find("#banner ul li:last-child").animate({left:"645px"},"1200");$("#"+target+" > ul").slideDown("slow",function(){$(this).find(".scrollbar").css("display","none");$(this).tinyscrollbar({scroll:true});$(this).hover(function(){console.log($(this));if(!$(this).find(".scrollbar").hasClass("disable"))$(this).find(".scrollbar").stop().fadeTo(400,.8)},function(){$(this).find(".scrollbar").stop().fadeOut(400)})});$(this).parent().addClass("open")}else{$service.find("#banner ul li.open > ul").slideUp("100",function(){$service.find("#banner ul li:nth-child(2)").animate({left:"165px"},"1200");$service.find("#banner ul li:nth-child(3)").animate({left:"363px"},"1200");$service.find("#banner ul li:last-child").animate({left:"560px"},"1200");$service.find("#banner ul li:first-child").animate({left:"-31px"},"1200",function(){$service.find("#banner ul li.open").find(".servicesScroller").unbind("mouseover mouseout hover");$service.find("#banner ul li.open").removeClass("open");$service.find("#banner ul li:first-child").animate({left:"-80px"},"1200");$service.find("#banner ul li:nth-child(2)").animate({left:"20px"},"1200");$service.find("#banner ul li:nth-child(3)").animate({left:"120px"},"1200");$service.find("#banner ul li:last-child").animate({left:"645px"},"1200");$("#"+target+" > ul").slideDown("slow",function(){$(this).find(".scrollbar").css("display","none");$(this).tinyscrollbar({scroll:true});$(this).hover(function(){if($(this).find(".overview").height()>$("#"+target).height()){$(this).find(".scrollbar").stop().fadeTo(400,.8)}else $(this).find(".scrollbar").css("display","none")},function(){$(this).find(".scrollbar").stop().fadeOut(400)})});$("#"+target).addClass("open")})})}}}else{if(window.BrowserDetect.browser=="Explorer"&&window.BrowserDetect.version==8){}else $(this).parent().children("ul").css("left","270px");if($(this).parent().hasClass("open")){$("#"+target+" > ul").slideUp("100",function(){$service.find("#banner ul li:first-child").animate({left:"-31px"},"1200");$service.find("#banner ul li:nth-child(2)").animate({left:"165px"},"1200");$service.find("#banner ul li:nth-child(3)").animate({left:"363px"},"1200");$service.find("#banner ul li:last-child").animate({left:"560px"},"1200")});$(this).parent().removeClass("open")}else{if($service.find("#banner ul li.open").length==0){$service.find("#banner ul li:first-child").animate({left:"-80px"},"1200");$service.find("#banner ul li:nth-child(2)").animate({left:"20px"},"1200");$service.find("#banner ul li:nth-child(3)").animate({left:"120px"},"1200");$service.find("#banner ul li:last-child").animate({left:"220px"},"1200");$("#"+target+" > ul").slideDown("slow",function(){$(this).find(".scrollbar").css("display","none");$(this).tinyscrollbar({scroll:true});$(this).hover(function(){console.log($(this));if(!$(this).find(".scrollbar").hasClass("disable"))$(this).find(".scrollbar").stop().fadeTo(400,.8)},function(){$(this).find(".scrollbar").stop().fadeOut(400)})});$(this).parent().addClass("open")}else{$service.find("#banner ul li.open > ul").slideUp("100",function(){$service.find("#banner ul li:nth-child(2)").animate({left:"165px"},"1200");$service.find("#banner ul li:nth-child(3)").animate({left:"363px"},"1200");$service.find("#banner ul li:last-child").animate({left:"560px"},"1200");$service.find("#banner ul li:first-child").animate({left:"-31px"},"1200",function(){$service.find("#banner ul li.open").find(".servicesScroller").unbind("mouseover mouseout hover");$service.find("#banner ul li.open").removeClass("open");$service.find("#banner ul li:nth-child(3)").animate({left:"120px"},"1200");$service.find("#banner ul li:nth-child(2)").animate({left:"20px"},"1200");$service.find("#banner ul li:first-child").animate({left:"-80px"},"1200");$service.find("#banner ul li:last-child").animate({left:"220"},"1200");$("#"+target+" > ul").slideDown("slow",function(){$(this).find(".scrollbar").css("display","none");$(this).tinyscrollbar({scroll:true});$(this).hover(function(){if($(this).find(".overview").height()>$("#"+target).height()){$(this).find(".scrollbar").stop().fadeTo(400,.8)}else $(this).find(".scrollbar").css("display","none")},function(){$(this).find(".scrollbar").stop().fadeOut(400)})});$("#"+target).addClass("open")})})}}}}else{if($(this).parent().is(":first-child")){if($(this).parent().hasClass("open")){$("#"+target+" .servicesScroller").slideUp("100",function(){$service.find("#banner ul li:first-child").animate({left:"-50px"},"1200");$service.find("#banner ul li:nth-child(2)").animate({left:"100px"},"1200");$service.find("#banner ul li:nth-child(3)").animate({left:"250px"},"1200");$service.find("#banner ul li:last-child").animate({left:"400px"},"1200")});$(this).parent().removeClass("open")}else{if($service.find("#banner ul li.open").length==0){$service.find("#banner ul li:first-child").animate({left:"-80px"},"1200");$service.find("#banner ul li:nth-child(2)").animate({left:"300px"},"1200");$service.find("#banner ul li:nth-child(3)").animate({left:"380px"},"1200");$service.find("#banner ul li:last-child").animate({left:"460px"},"1200");$("#"+target+" > ul").slideDown("slow",function(){$(this).find(".scrollbar").css("display","none");$(this).tinyscrollbar({scroll:true});$(this).hover(function(){console.log($(this));if(!$(this).find(".scrollbar").hasClass("disable"))$(this).find(".scrollbar").stop().fadeTo(400,.8)},function(){$(this).find(".scrollbar").stop().fadeOut(400)})});$(this).parent().addClass("open")}else{$service.find("#banner ul li.open > ul").slideUp("100",function(){$service.find("#banner ul li:first-child").animate({left:"-80px"},"1200");$service.find("#banner ul li:nth-child(2)").animate({left:"100px"},"1200");$service.find("#banner ul li:nth-child(3)").animate({left:"250px"},"1200");$service.find("#banner ul li:last-child").animate({left:"400px"},"1200",function(){$service.find("#banner ul li.open").find(".servicesScroller").unbind("mouseover mouseout hover");$service.find("#banner ul li.open").removeClass("open");$service.find("#banner ul li:nth-child(2)").animate({left:"300px"},"1200");$service.find("#banner ul li:nth-child(3)").animate({left:"380px"},"1200");$service.find("#banner ul li:last-child").animate({left:"460px"},"1200");$("#"+target+" > ul").slideDown("slow",function(){$(this).find(".scrollbar").css("display","none");$(this).tinyscrollbar({scroll:true});$(this).hover(function(){if($(this).find(".overview").height()>$("#"+target).height()){$(this).find(".scrollbar").stop().fadeTo(400,.8)}else $(this).find(".scrollbar").css("display","none")},function(){$(this).find(".scrollbar").stop().fadeOut(400)})});$("#"+target).addClass("open")})})}}}else if($(this).parent().is(":nth-child(2)")){if($(this).parent().hasClass("open")){$("#"+target+" > ul").slideUp("100",function(){$service.find("#banner ul li:first-child").animate({left:"-50px"},"1200");$service.find("#banner ul li:nth-child(2)").animate({left:"100px"},"1200");$service.find("#banner ul li:nth-child(3)").animate({left:"250px"},"1200");$service.find("#banner ul li:last-child").animate({left:"400px"},"1200")});$(this).parent().removeClass("open")}else{if($service.find("#banner ul li.open").length==0){$service.find("#banner ul li:nth-child(1)").animate({left:"-80px"},"1200");$service.find("#banner ul li:nth-child(2)").animate({left:"0px"},"1200");$service.find("#banner ul li:nth-child(3)").animate({left:"380px"},"1200");$service.find("#banner ul li:last-child").animate({left:"460px"},"1200");$("#"+target+" > ul").slideDown("slow",function(){$(this).find(".scrollbar").css("display","none");$(this).tinyscrollbar({scroll:true});$(this).hover(function(){console.log($(this));if(!$(this).find(".scrollbar").hasClass("disable"))$(this).find(".scrollbar").stop().fadeTo(400,.8)},function(){$(this).find(".scrollbar").stop().fadeOut(400)})});$(this).parent().addClass("open")}else{$service.find("#banner ul li.open > ul").slideUp("100",function(){$service.find("#banner ul li:first-child").animate({left:"-50px"},"1200");$service.find("#banner ul li:nth-child(2)").animate({left:"100px"},"1200");$service.find("#banner ul li:nth-child(3)").animate({left:"250px"},"1200");$service.find("#banner ul li:last-child").animate({left:"400px"},"1200",function(){$service.find("#banner ul li.open").find(".servicesScroller").unbind("mouseover mouseout hover");$service.find("#banner ul li.open").removeClass("open");$service.find("#banner ul li:nth-child(1)").animate({left:"-80px"},"1200");$service.find("#banner ul li:nth-child(2)").animate({left:"0px"},"1200");$service.find("#banner ul li:nth-child(3)").animate({left:"380px"},"1200");$service.find("#banner ul li:last-child").animate({left:"460px"},"1200");$("#"+target+" > ul").slideDown("slow",function(){$(this).find(".scrollbar").css("display","none");$(this).tinyscrollbar({scroll:true});$(this).hover(function(){if($(this).find(".overview").height()>$("#"+target).height()){$(this).find(".scrollbar").stop().fadeTo(400,.8)}else $(this).find(".scrollbar").css("display","none")},function(){$(this).find(".scrollbar").stop().fadeOut(400)})});$("#"+target).addClass("open")})})}}}else if($(this).parent().is(":nth-child(3)")){$(this).parent().children("ul").css("left","180px");if($(this).parent().hasClass("open")){$("#"+target+" > ul").slideUp("100",function(){$service.find("#banner ul li:first-child").animate({left:"-50px"},"1200");$service.find("#banner ul li:nth-child(2)").animate({left:"100px"},"1200");$service.find("#banner ul li:nth-child(3)").animate({left:"250px"},"1200");$service.find("#banner ul li:last-child").animate({left:"400px"},"1200")});$(this).parent().removeClass("open")}else{if($service.find("#banner ul li.open").length==0){$service.find("#banner ul li:first-child").animate({left:"-80px"},"1200");$service.find("#banner ul li:nth-child(2)").animate({left:"0px"},"1200");$service.find("#banner ul li:nth-child(3)").animate({left:"80px"},"1200");$service.find("#banner ul li:last-child").animate({left:"460px"},"1200");$("#"+target+" > ul").slideDown("slow",function(){$(this).find(".scrollbar").css("display","none");$(this).tinyscrollbar({scroll:true});$(this).hover(function(){console.log($(this));if(!$(this).find(".scrollbar").hasClass("disable"))$(this).find(".scrollbar").stop().fadeTo(400,.8)},function(){$(this).find(".scrollbar").stop().fadeOut(400)})});$(this).parent().addClass("open")}else{$service.find("#banner ul li.open > ul").slideUp("100",function(){$service.find("#banner ul li:nth-child(2)").animate({left:"100px"},"1200");$service.find("#banner ul li:nth-child(3)").animate({left:"250px"},"1200");$service.find("#banner ul li:last-child").animate({left:"400px"},"1200");$service.find("#banner ul li:first-child").animate({left:"-50px"},"1200",function(){$service.find("#banner ul li.open").find(".servicesScroller").unbind("mouseover mouseout hover");$service.find("#banner ul li.open").removeClass("open");$service.find("#banner ul li:first-child").animate({left:"-80px"},"1200");$service.find("#banner ul li:nth-child(2)").animate({left:"0px"},"1200");$service.find("#banner ul li:nth-child(3)").animate({left:"80px"},"1200");$service.find("#banner ul li:last-child").animate({left:"460px"},"1200");$("#"+target+" > ul").slideDown("slow",function(){$(this).find(".scrollbar").css("display","none");$(this).tinyscrollbar({scroll:true});$(this).unbind();$(this).hover(function(){if($(this).find(".overview").height()>$("#"+target).height()){$(this).find(".scrollbar").stop().fadeTo(400,.8)}else $(this).find(".scrollbar").css("display","none")},function(){$(this).find(".scrollbar").stop().fadeOut(400)})});$("#"+target).addClass("open")})})}}}else{$(this).parent().children("ul").css("left","180px");if($(this).parent().hasClass("open")){$("#"+target+" > ul").slideUp("100",function(){$service.find("#banner ul li:first-child").animate({left:"-50px"},"1200");$service.find("#banner ul li:nth-child(2)").animate({left:"100px"},"1200");$service.find("#banner ul li:nth-child(3)").animate({left:"250px"},"1200");$service.find("#banner ul li:last-child").animate({left:"400px"},"1200")});$(this).parent().removeClass("open")}else{if($service.find("#banner ul li.open").length==0){$service.find("#banner ul li:first-child").animate({left:"-80px"},"1200");$service.find("#banner ul li:nth-child(2)").animate({left:"0px"},"1200");$service.find("#banner ul li:nth-child(3)").animate({left:"80px"},"1200");$service.find("#banner ul li:last-child").animate({left:"160px"},"1200");$("#"+target+" > ul").slideDown("slow",function(){$(this).find(".scrollbar").css("display","none");$(this).tinyscrollbar({scroll:true});$(this).hover(function(){console.log($(this));if(!$(this).find(".scrollbar").hasClass("disable"))$(this).find(".scrollbar").stop().fadeTo(400,.8)},function(){$(this).find(".scrollbar").stop().fadeOut(400)})});$(this).parent().addClass("open")}else{$service.find("#banner ul li.open > ul").slideUp("100",function(){$service.find("#banner ul li:nth-child(2)").animate({left:"100px"},"1200");$service.find("#banner ul li:nth-child(3)").animate({left:"250px"},"1200");$service.find("#banner ul li:last-child").animate({left:"400px"},"1200");$service.find("#banner ul li:first-child").animate({left:"-50px"},"1200",function(){$service.find("#banner ul li.open").find(".servicesScroller").unbind("mouseover mouseout hover");$service.find("#banner ul li.open").removeClass("open");$service.find("#banner ul li:nth-child(3)").animate({left:"80px"},"1200");$service.find("#banner ul li:nth-child(2)").animate({left:"0px"},"1200");$service.find("#banner ul li:first-child").animate({left:"-80px"},"1200");$service.find("#banner ul li:last-child").animate({left:"160"},"1200");$("#"+target+" > ul").slideDown("slow",function(){$(this).find(".scrollbar").css("display","none");$(this).tinyscrollbar({scroll:true});$(this).hover(function(){if($(this).find(".overview").height()>$("#"+target).height()){$(this).find(".scrollbar").stop().fadeTo(400,.8)}else $(this).find(".scrollbar").css("display","none")},function(){$(this).find(".scrollbar").stop().fadeOut(400)})});$("#"+target).addClass("open")})})}}}}})}});(function(e){function t(t,n){function r(e){if(!(p.ratio>=1)){E.now=Math.min(v[n.axis]-m[n.axis],Math.max(0,E.start+((g?e.pageX:e.pageY)-S.start)));w=E.now*d.ratio;p.obj.css(y,-w);m.obj.css(y,E.now)}return false}function i(t){e(document).unbind("mousemove",r);e(document).unbind("mouseup",i);m.obj.unbind("mouseup",i);document.ontouchmove=m.obj[0].ontouchend=document.ontouchend=null;return false}function s(t){if(!(p.ratio>=1)){var t=t||window.event;var r=t.wheelDelta?t.wheelDelta/120:-t.detail/3;w-=r*n.wheel;w=Math.min(p[n.axis]-h[n.axis],Math.max(0,w));m.obj.css(y,w/d.ratio);p.obj.css(y,-w);t=e.event.fix(t);t.preventDefault()}}function o(t){S.start=g?t.pageX:t.pageY;var n=parseInt(m.obj.css(y));E.start=n=="auto"?0:n;e(document).bind("mousemove",r);document.ontouchmove=function(t){e(document).unbind("mousemove");r(t.touches[0])};e(document).bind("mouseup",i);m.obj.bind("mouseup",i);m.obj[0].ontouchend=document.ontouchend=function(t){e(document).unbind("mouseup");m.obj.unbind("mouseup");i(t.touches[0])};return false}function u(){m.obj.bind("mousedown",o);m.obj[0].ontouchstart=function(e){e.preventDefault();m.obj.unbind("mousedown");o(e.touches[0]);return false};v.obj.bind("mouseup",r);if(n.scroll&&this.addEventListener){c[0].addEventListener("DOMMouseScroll",s,false);c[0].addEventListener("mousewheel",s,false)}else if(n.scroll){c[0].onmousewheel=s}}function a(){m.obj.css(y,w/d.ratio);p.obj.css(y,-w);S["start"]=m.obj.offset()[y];var e=b.toLowerCase();d.obj.css(e,v[n.axis]);v.obj.css(e,v[n.axis]);m.obj.css(e,m[n.axis])}function f(){l.update();u();return l}var l=this;var c=t;var h={obj:e(".viewport",t)};var p={obj:e(".overview",t)};var d={obj:e(".scrollbar",t)};var v={obj:e(".track",d.obj)};var m={obj:e(".thumb",d.obj)};var g=n.axis=="x",y=g?"left":"top",b=g?"Width":"Height";var w,E={start:0,now:0},S={};this.update=function(e){h[n.axis]=h.obj[0]["offset"+b];p[n.axis]=p.obj[0]["scroll"+b];p.ratio=h[n.axis]/p[n.axis];d.obj.toggleClass("disable",p.ratio>=1);v[n.axis]=n.size=="auto"?h[n.axis]:n.size;m[n.axis]=Math.min(v[n.axis],Math.max(0,n.sizethumb=="auto"?v[n.axis]*p.ratio:n.sizethumb));d.ratio=n.sizethumb=="auto"?p[n.axis]/v[n.axis]:(p[n.axis]-h[n.axis])/(v[n.axis]-m[n.axis]);w=e=="relative"&&p.ratio<=1?Math.min(p[n.axis]-h[n.axis],Math.max(0,w)):0;w=e=="bottom"&&p.ratio<=1?p[n.axis]-h[n.axis]:isNaN(parseInt(e))?w:parseInt(e);a()};return f()}e.tiny=e.tiny||{};e.tiny.scrollbar={options:{axis:"y",wheel:40,scroll:false,size:"auto",sizethumb:"auto"}};e.fn.tinyscrollbar=function(n){var n=e.extend({},e.tiny.scrollbar.options,n);this.each(function(){e(this).data("tsb",new t(e(this),n))});return this};e.fn.tinyscrollbar_update=function(t){return e(this).data("tsb").update(t)}})(jQuery)

;(function($)
{
	$.fn.aviaMegamenu = function(variables)
	{
		var defaults =
		{
			modify_position:true,
			delay:300
		};

		var options = $.extend(defaults, variables);

		return this.each(function()
		{
			var left_menu	= $('html:first').is('.bottom_nav_header'),
				isMobile 	= 'ontouchstart' in document.documentElement,
				menu = $(this),
				menuItems = menu.find(">li"),
				megaItems = menuItems.find(">div").parent().css({overflow:'hidden'}),
				menuActive = menu.find('>.current-menu-item>a, >.current_page_item>a'),
				dropdownItems = menuItems.find(">ul").parent(),
				parentContainer = menu.parent(),
				mainMenuParent = menu.parents('.main_menu').eq(0),
				parentContainerWidth = parentContainer.width(),
				delayCheck = {},
				mega_open = [];

			if(!menuActive.length){ menu.find('.current-menu-ancestor:eq(0) a:eq(0), .current_page_ancestor:eq(0) a:eq(0)').parent().addClass('active-parent-item')}

			menuItems.on('click' ,'a', function()
			{
				if(this.href == window.location.href + "#" || this.href == window.location.href + "/#")
				return false;
			});

			menuItems.each(function()
			{
				var item = $(this),
					pos = item.position(),
					megaDiv = item.find("div:first").css({opacity:0, display:"none"}),
					normalDropdown = "";

				//check if we got a mega menu
				if(!megaDiv.length)
				{
					normalDropdown = item.find(">ul").css({display:"none"});
				}

				//if we got a mega menu or dropdown menu add the arrow beside the menu item
				if(megaDiv.length || normalDropdown.length)
				{
					var link = item.addClass('dropdown_ul_available').find('>a');
					link.append('<span class="dropdown_available"></span>');

					//is a mega menu main item doesnt have a link to click use the default cursor
					if(typeof link.attr('href') != 'string' || link.attr('href') == "#"){ link.css('cursor','default').click(function(){return false;}); }
				}


				//correct position of mega menus
				if(options.modify_position && megaDiv.length)
				{
					if(!left_menu)
					{
						if(pos.left + megaDiv.width() < parentContainerWidth)
						{
							megaDiv.css({right: -megaDiv.outerWidth() + item.outerWidth()  });
							//item.css({position:'static'});
						}
						else if(pos.left + megaDiv.width() > parentContainerWidth)
						{
							megaDiv.css({right: -mainMenuParent.outerWidth() + (pos.left + item.outerWidth() ) });
						}
					}
					else
					{
						if(megaDiv.width() > pos.left + item.outerWidth())
						{
							megaDiv.css({left: (pos.left* -1)});
						}
						else if(pos.left + megaDiv.width() > parentContainerWidth)
						{
							megaDiv.css({left: (megaDiv.width() - pos.left) * -1 });
						}
					}
				}



			});


			function megaDivShow(i)
			{
				if(delayCheck[i] == true)
				{
					var item = megaItems.filter(':eq('+i+')').css({overflow:'visible'}).find("div:first"),
						link = megaItems.filter(':eq('+i+')').find("a:first");
						mega_open["check"+i] = true;

						item.stop().css('display','block').animate({opacity:1},300);

						if(item.length)
						{
							link.addClass('open-mega-a');
						}
				}
			}

			function megaDivHide (i)
			{
				if(delayCheck[i] == false)
				{
					megaItems.filter(':eq('+i+')').find(">a").removeClass('open-mega-a');

					var listItem = megaItems.filter(':eq('+i+')'),
						item = listItem.find("div:first");


					item.stop().css('display','block').animate({opacity:0},300, function()
					{
						$(this).css('display','none');
						listItem.css({overflow:'hidden'});
						mega_open["check"+i] = false;
					});
				}
			}

			if(isMobile)
			{
				megaItems.each(function(i){

					$(this).bind('click', function()
					{
						if(mega_open["check"+i] != true) return false;
					});
				});
			}


			//bind event for mega menu
			megaItems.each(function(i){

				$(this).hover(

					function()
					{
						delayCheck[i] = true;
						setTimeout(function(){megaDivShow(i); },options.delay);
					},

					function()
					{
						delayCheck[i] = false;
						setTimeout(function(){megaDivHide(i); },options.delay);
					}
				);
			});


			// bind events for dropdown menu
			dropdownItems.find('li').andSelf().each(function()
			{
				var currentItem = $(this),
					sublist = currentItem.find('ul:first'),
					showList = false;

				if(sublist.length)
				{
					sublist.css({display:'block', opacity:0, visibility:'hidden'});
					var currentLink = currentItem.find('>a');

					currentLink.bind('mouseenter', function()
					{
						sublist.stop().css({visibility:'visible'}).animate({opacity:1});
					});

					currentItem.bind('mouseleave', function()
					{
						sublist.stop().animate({opacity:0}, function()
						{
							sublist.css({visibility:'hidden'});
						});
					});

				}

			});

		});
	};
})(jQuery);

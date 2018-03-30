jQuery.noConflict();

function setHeightLi(idGroup, column){
	if(column != 1){
		////////  Set height same for li ////////////
		var liList;
		var maxHeight = 0;
		var heightUl = 0;
		jQuery('#' + idGroup + ' .list-post li').each(function(index,value){
			if(jQuery(this).hasClass('start')){
				liList = new Array();
				maxHeight = 0;
			}
			var curHeight = jQuery(this).find('div.image-style').first().height() + jQuery(this).find('div.detail').first().height() + 10;
			
			if(maxHeight < curHeight){
				maxHeight = curHeight;
			}
			liList.push(jQuery(this));
			if(jQuery(this).hasClass('end')){
				for(var i = 0;i < liList.length;i++){
					var curLi = liList[i];
					curLi.height(maxHeight);
				}
				heightUl += maxHeight;
			}
		});
		jQuery('#' + idGroup + ' .list-post').height(heightUl + 180);
	}
}

function enableLightbox(idGroup){
	jQuery("#" + idGroup + " .list-post a[rel=lightbox-" + idGroup + "]").fancybox({
		'transitionIn'		: 'none',
		'transitionOut'		: 'none',
		'titlePosition' 	: 'over',
		'titleFormat'		: function(title, currentArray, currentIndex, currentOpts) {
			return (title.length ? ' <span class="title_lightbox"> ' + title + '</span>' : '') + '<span id="fancybox-title-over">Image ' + (currentIndex + 1) + ' of ' + currentArray.length + '</span>';
		}
	});	
	
	jQuery('#' + idGroup + ' div.image-style').showHide({divHover	:	'div.fancybox_container'});
					
	// Modify href for lightbox with case youtube or vimeo
	jQuery("#" + idGroup + " .fancybox-group").each(function(){
		if(jQuery(this).hasClass('youtube')){
			var href = jQuery(this).attr('href');
			jQuery(this).attr('href',href.replace(new RegExp("watch\\?v=", "i"), 'v/') + '&autoplay=1');
		}
		else if(jQuery(this).hasClass('vimeo')){
			var href = jQuery(this).attr('href');
			jQuery(this).attr('href',href.replace(new RegExp("([0-9])","i"),'moogaloop.swf?clip_id=$1') + '&autoplay=1');
		}
	});
				

	jQuery("#" + idGroup + " .fancybox-group.youtube,#" + idGroup + " .fancybox-group.vimeo").fancybox({
		'transitionIn'		: 'none',
		'transitionOut'		: 'none',
		'titlePosition' 	: 'over',
		'href' : this.href,
		'type'      : 'swf',
		'swf'       : {'wmode':'transparent','allowfullscreen':'true'},
		'titleFormat'		: function(title, currentArray, currentIndex, currentOpts) {
			jQuery('#fancybox-title').addClass('video');
			return (title.length ? ' <span class="title_lightbox"> ' + title + '</span>' : '') + '<span id="fancybox-title-over">Image ' + (currentIndex + 1) + ' of ' + currentArray.length + '</span>';
		}
	});
	

	jQuery("#" + idGroup + " a[rel=lightbox-" + idGroup + "]").fancybox({
		'transitionIn'		: 'none',
		'transitionOut'		: 'none',
		'titlePosition' 	: 'over',
		'href' : this.href,
		'titleFormat'		: function(title, currentArray, currentIndex, currentOpts) {
			return (title.length ? ' <span class="title_lightbox"> ' + title + '</span>' : '') + '<span id="fancybox-title-over">Image ' + (currentIndex + 1) + ' of ' + currentArray.length + '</span>';
		}
	});
}

;(function($) {
	$.fn.useQuicksand = function(params) {
		var defaults = {
			url_ajax			:	'',
			post_type 			: 	'portfolio',
			num_posts_per_page	:	3,
			page				:	1,
			column_count		:	3,
			width_thumb			:	150,
			height_thumb		:	150,
			lightbox			:	true,
			id_group			: 	''	
		};
		
		var opts = $.extend({}, defaults, params);
		var divSortable = $(this);
		divSortable.find('.filter_tool a').click(function(e) {
			divSortable.find('.active').removeClass('active');
			$(this).addClass('active');
			var data = {
				action: 'quicksand_filter',
				filter: $(this).attr('href'),
				post_type : opts.post_type,
				num_posts_per_page : opts.num_posts_per_page,
				page : opts.page,
				column_count: opts.column_count,
				width_thumb : opts.width_thumb,
				height_thumb : opts.height_thumb,
				lightbox : opts.lightbox,
				id_group : opts.id_group
			};
			
			$.post(opts.url_ajax, data, function(response) {
					
                    divSortable.find('.list-post').quicksand( 
						$(response).find('li'), 
						{
						  adjustHeight: 'dynamic',
						  useScaling : false
						},
						
						
						function(){
							/* Add preloader */
							divSortable.find(".image-style").preloader({
								delay:200,
								imgSelector:'img',
								beforeShow:function(){
									jQuery(this).closest('.image-style').addClass('preloading');
								},
								afterShow:function(){
									jQuery(this).closest('.image-style').removeClass('preloading');
								}
							});
							setHeightLi(divSortable.attr('id'),opts.column_count);
							if(opts.lightbox == true){
								enableLightbox(divSortable.attr('id'));
							}
						}
										
					);
					
					//$(response).find('li:last-child').addClass('last');
					
					
                });
				e.preventDefault();  
		});
		
		setHeightLi(divSortable.attr('id'),opts.column_count);
		
	}
})(jQuery);
jQuery(document).ready(function($) {
	"use strict"; 
	var pageNum = parseInt(cs_more_obj.startPage) + 1;
 	var total = parseInt(cs_more_obj.total);
	var max = parseInt(cs_more_obj.maxPages);
 	var perpage = parseInt(cs_more_obj.perpage);
	var nextLink = cs_more_obj.nextLink;
	setInterval(function(){
		jQuery('#main').find('audio,video').mediaelementplayer();
	},3000);
	$.countPost = function(total,perpage,pageNum){
		var cposts = total-perpage*pageNum;
		if(cposts>perpage){
			return 'Load More('+perpage+' Of '+cposts+')';
		}
		else{
			return 'Load More('+cposts+')';
		}
	}
	$.loadData = function(){
		"use strict"; 
		
		$.get(nextLink,function(data){
			// Update page number and nextLink.
			if(cs_more_obj.masonry=='masonry'){
				var newItem = $($(data).find('.cshero-masonry-post').html());
				newItem.imagesLoaded(function(){
					$(".cs-masonry-layout").isotope('insert', newItem);
				})
			}
			else{
				var html='';
				$(data).find('#main > article').each(function(){
					html += $('<div>').append($(this).clone()).html();
				});
				$(data).find('#main > .cs-article.row').each(function(){
					html += $('<div>').append($(this).clone()).html();
				});
				$('.cs_pagination').before(html);
			}

			pageNum++;
			if(nextLink.indexOf('/page/')>-1){
				nextLink = nextLink.replace(/\/page\/[0-9]?/, '/page/'+ pageNum);
			}
			else{
				nextLink = nextLink.replace(/paged=[0-9]?/, 'paged='+ pageNum);
			}
			// Add a new placeholder, for when user clicks again.
			$('#cshero-load-posts')
				.before('<div class="cshero-placeholder-'+ pageNum +'"></div>')
	 		if(cs_more_obj.ajaxType=='Button'){
				// Update the button message.
				if(pageNum <= max) {
					$('#cshero-load-posts a').text($.countPost(total,perpage,pageNum-1));
				} else {
					$('#cshero-load-posts a').text('No more posts to load.');
				}	
			}else{
				$('#cshero-load-posts').find('a').text('');
			}
			$('#cshero-load-posts').find('a').data('loading',0);
		});
	}
	if(pageNum <= max) {
		var text=$.countPost(total,perpage,1);
		if(cs_more_obj.ajaxType=='Scroll'){
			text = '';
		}
		$('.cs_pagination').append('<div class="cshero-placeholder-'+ pageNum +'"></div><p id="cshero-load-posts"><a class="btn btn-primary" data-loading="0" href="#">'+text+'</a></p>');
		
	}
	if(cs_more_obj.ajaxType=='Button'){
		$('#cshero-load-posts a').click(function(){
			if(pageNum <= max){
				$(this).text('Loading posts...');
				$.loadData();
			}else {
				$('#cshero-load-posts a').append('.');
			}
	 
			return false;
		});
	}
	else{
		jQuery(document, window).scroll(function() {
			var bottomElm = ($('.cshero-content .content-wrap').offset().top + $('.cshero-content .content-wrap').height()) - jQuery(document).scrollTop();
			if (jQuery(window).height()>bottomElm){
				if(pageNum <= max){
					if($('#cshero-load-posts').find('a').data('loading')!=1){
						$('#cshero-load-posts').find('a').text('Loading posts...');
						$('#cshero-load-posts').find('a').data('loading',1);
						$.loadData();
					}
				}
			}
		});
		var bottomElm = ($('.cshero-content .content-wrap').offset().top + $('.cshero-content .content-wrap').height()) - jQuery(document).scrollTop();
		if (jQuery(window).height()>bottomElm){
			if(pageNum <= max){
				if($('#cshero-load-posts').find('a').data('loading')!=1){
					$('#cshero-load-posts').find('a').text('Loading posts...');
					$('#cshero-load-posts').find('a').data('loading',1);
					$.loadData();
				}
			}
		}
		
	}
})
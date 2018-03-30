jQuery(document).ready(function($) {

	"use strict";

	// The number of the next page to load (/page/x/).
	var pageNum = parseInt(pbd_alp.startPage) + 1;
	
	// The maximum number of pages the current query can return.
	var max = parseInt(pbd_alp.maxPages);
	
	// The link of the next page of posts.
	var nextLink = pbd_alp.nextLink;

	var loadmore_text = $('.pagination.load-more a .text').text();
	
	/**
	 * Replace the traditional navigation with our own,
	 * but only if there is at least one page of new posts to load.
	 */
	if(pageNum <= max) {
		if($(".post-list").hasClass("masonry")){
			$('.post-list .masonry-layout').append('<div class="pbd-alp-placeholder-'+ pageNum +'"></div>')
		}
		if($(".post-list").hasClass("list")){
			$('.post-list .list-layout').append('<div class="pbd-alp-placeholder-'+ pageNum +'"></div>')
		}
		else {
			$(".post-list").append('<div class="pbd-alp-placeholder-'+ pageNum +'"></div>')
		}

		$('.pagination.load-more').addClass("show");
	}
	else {
		$('.pagination.load-more').remove();
	}
	
	
	/**
	 * Load new posts when the link is clicked.
	 */

	$('#pbd-alp-load-posts a').click(function() {

		var $this = $(this);

		if(!$this.hasClass("loading")){

			$this.addClass("loading");
		
			// Are there more posts to load?
			if(pageNum <= max) {
			    
			    var wait_img_load;
			    var articles_html;

				$.ajax({
					url: nextLink,
					dataType:"html",
					success: function(result){

			        	if($(".post-list").hasClass("masonry")){
			        		articles_html = $(".post-list .masonry-layout", result).html();
			        	}
			        	else if($(".post-list").hasClass("list")){
			        		articles_html = $(".post-list .list-layout", result).html();
			        	}
			        	else {
			        		articles_html = $(".post-list", result).html();
			        	}

			        	$('.pbd-alp-placeholder-'+ pageNum).append(articles_html);

			        	if($(".post-list").hasClass("masonry")){

							if($('.pbd-alp-placeholder-'+ pageNum +' img').length>0){
								wait_img_load = true;
							}
							else {
								wait_img_load = false;
							}

						}

						$('.pbd-alp-placeholder-'+ pageNum +' .article-item').each(function(i){
							$(this).css("animation-duration", 0.4+i*0.06+"s");
						})

						$('.pbd-alp-placeholder-'+ pageNum +' .article-item').addClass('page-'+ pageNum +'-items');

						var articles_html_copy = $('.pbd-alp-placeholder-'+ pageNum +'').html();

						if($(".post-list").hasClass("masonry")){
			        		$(".post-list .masonry-layout").append(articles_html_copy).masonry( 'addItems', articles_html_copy );
			        	}
			        	else if($(".post-list").hasClass("list")){
			        		$(".post-list .list-layout").append(articles_html_copy)
			        	}
			        	else {
			        		$(".post-list").append(articles_html_copy);
			        	}

			        	$('.pbd-alp-placeholder-'+ pageNum +'').remove();
						

						//Fotorama
						if($('.article-item.page-'+ pageNum +'-items .fotorama').length>0){
							$('.article-item.page-'+ pageNum +'-items .fotorama').fotorama();
						}

						//Justified Gallery
						if($('.article-item.page-'+ pageNum +'-items .justified-gallery').length>0){
							var row_height;
							$('.article-item.page-'+ pageNum +'-items .justified-gallery').each(function(){

								if($(".post-list").hasClass("masonry")){
									row_height = 170;
								}
								else {
									row_height = $(this).data("row-height");
									if(!row_height){
										row_height = 300;
									}
								}

								$(this).justifiedGallery({
									rowHeight: row_height,
									maxRowHeight: 0,
									lastRow: "justify",
									captions: false,
									margins:3,
									border:0
								});
							});
						}

						//Media element
						if($('.article-item.page-'+ pageNum +'-items video').length>0){
							$('.article-item.page-'+ pageNum +'-items video').mediaelementplayer().attr("poster","");
						}

						if($('.article-item.page-'+ pageNum +'-items audio').length>0){
							$('.article-item.page-'+ pageNum +'-items audio').mediaelementplayer({
								audioWidth: "100%"
							});
						}

						// Magnific
						if($('.article-item.page-'+ pageNum +'-items .post-featured-item.gallery-post').length>0){
							$('.post-featured-item.gallery-post .justified-gallery a').attr("itemprop","contentUrl");

							$('.post-featured-item.gallery-post .justified-gallery a').on("click",function(e){
								e.preventDefault();
								var $this = $(this);
								var pswpElement = $(".pswp")[0];
								var lightbox_item = $this.parents(".justified-gallery").find(".item");
								var lightbox_item_link = $this.parents(".justified-gallery").find(".item a");
								var itemCount = lightbox_item.length;
								var pic_index = $this.parents(".item").index();

								var i;
								var items = [];
								var options={
									index: pic_index,
									bgOpacity:1,
									history:false,
									barsSize: {top:0, bottom:0},
									shareButtons: [
									    {id:'facebook', label:'Share on Facebook', url:'https://www.facebook.com/sharer/sharer.php?u={{url}}'},
									    {id:'twitter', label:'Tweet', url:'https://twitter.com/intent/tweet?text={{text}}&url={{url}}'},
									    {id:'pinterest', label:'Pin it', url:'http://www.pinterest.com/pin/create/button/?url={{url}}&media={{image_url}}&description={{text}}'}
									]
								};


								for ( i = 0; i < itemCount; i++) {
									var item = {
							            src: $(lightbox_item_link[i]).attr("href"),
							            w:0,
							   			h:0,
							   			title:$(lightbox_item_link[i]).find("img").attr("alt")
							         };
							         items.push(item);
								};
								
								
								var gallery = new PhotoSwipe( pswpElement, PhotoSwipeUI_Default, items,options);
								gallery.listen('gettingData', function(index, item) {
								    if (item.w < 1 || item.h < 1) { // unknown size
								        var img = new Image(); 
								        img.onload = function() { // will get size after load
									        item.w = this.width; // set image width
									        item.h = this.height; // set image height
											gallery.invalidateCurrItems(); // reinit Items
											gallery.updateSize(true); // reinit Items
								        }
								    	img.src = item.src; // let's download image
								    }
								});
								gallery.init();
							})
						}

			    	},
			    	complete: function(result){

			    		var expageNum = pageNum;
						
						// Add a new placeholder, for when user clicks again.
						if($(".post-list").hasClass("masonry")){
							if(wait_img_load){
								imagesLoaded( document.querySelector('.masonry-layout'), function( instance ) {
									setTimeout(function(){
										$(".masonry-layout").masonry('reloadItems').masonry();
									},100);
								});
								
								if($('.article-item.page-'+ expageNum +'-items .fotorama').length>0){
									$('.article-item.page-'+ expageNum +'-items .fotorama').on('fotorama:ready', function (e, fotorama) {
										setTimeout(function(){
											$(".masonry-layout").masonry('reloadItems').masonry();
										},100);
									});
								}
							}
							else {
								setTimeout(function(){
									$(".masonry-layout").masonry('reloadItems').masonry();
								},100);
							}
						}
						else {
							$(".post-entry").fitVids();
						}

						if($('.article-item.page-'+ expageNum +'-items .post-featured-item .embed').length>0){
							$('.article-item.page-'+ expageNum +'-items .post-featured-item .embed iframe').each(function(){
								var iframe_url = $(this).attr("src");
								$(this).attr("src",iframe_url);
							})
						}

						// Update page number and nextLink.
						pageNum++;

						var vars = [], hash;
					    var hashes = nextLink.slice(nextLink.indexOf('?') + 1).split('&');
					    for(var i = 0; i < hashes.length; i++)
					    {
					        hash = hashes[i].split('=');
					        vars.push(hash[0]);
					        vars[hash[0]] = hash[1];
					    }

						var nextLink_param = vars["paged"];

						if(nextLink_param){
							nextLink = UpdateQueryString("paged", pageNum, nextLink);
						}
						else {
							nextLink = nextLink.replace(/\/page\/[0-9]*/, '/page/'+ pageNum);
						}

						if($(".post-list").hasClass("masonry")){
							$('.post-list .masonry-layout').append('<div class="pbd-alp-placeholder-'+ pageNum +'"></div>');
						}
						else if($(".post-list").hasClass("list")){
							$('.post-list .list-layout').append('<div class="pbd-alp-placeholder-'+ pageNum +'"></div>');
						}
						else {
							$(".post-list").append('<div class="pbd-alp-placeholder-'+ pageNum +'"></div>');
						}
						
						// Update the button message.
						if(pageNum <= max) {
							$('#pbd-alp-load-posts a .text').text(loadmore_text);
						} else {
							$('.pbd-alp-placeholder-'+ pageNum +'').remove();
							$('.pagination.load-more').remove();
						}

						if($(".post-list").hasClass("masonry")){
							if($('.article-item.page-'+ expageNum +'-items .fotorama').length>0){
								$('.article-item.page-'+ expageNum +'-items .fotorama').on('fotorama:ready', function (e, fotorama) {
									setTimeout(function(){
										$('.post-list .article-item').removeClass('page-'+ expageNum +'-items').addClass("animate");
									},100)
								});
							}
							else {
								$('.masonry-layout').masonry( 'on', 'layoutComplete', function( laidOutItems ) {
									$('.post-list .article-item').removeClass('page-'+ expageNum +'-items').addClass("animate");
								});
							}
						}
						else {
							setTimeout(function(){
								$('.post-list .article-item').removeClass('page-'+ expageNum +'-items').addClass("animate");
							},100);
						}

						sticky_sidebar();

						$this.removeClass("loading");
			    	},
		    		error: function() {
				   		alert("Error! Please try again");
				   	}
				});	

			}

		}
		
		return false;
	});
});

function UpdateQueryString(key, value, url) {
	"use strict";

    if (!url) url = window.location.href;
    var re = new RegExp("([?&])" + key + "=.*?(&|#|$)(.*)", "gi"),
        hash;

    if (re.test(url)) {
        if (typeof value !== 'undefined' && value !== null)
            return url.replace(re, '$1' + key + "=" + value + '$2$3');
        else {
            hash = url.split('#');
            url = hash[0].replace(re, '$1$3').replace(/(&|\?)$/, '');
            if (typeof hash[1] !== 'undefined' && hash[1] !== null) 
                url += '#' + hash[1];
            return url;
        }
    }
    else {
        if (typeof value !== 'undefined' && value !== null) {
            var separator = url.indexOf('?') !== -1 ? '&' : '?';
            hash = url.split('#');
            url = hash[0] + separator + key + '=' + value;
            if (typeof hash[1] !== 'undefined' && hash[1] !== null) 
                url += '#' + hash[1];
            return url;
        }
        else
            return url;
    }
}
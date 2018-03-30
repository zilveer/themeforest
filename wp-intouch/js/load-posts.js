jQuery(document).ready(function($) {

	// The number of the next page to load (/page/x/).
	var pageNum = parseInt(pbd_alp.startPage) + 1;
	
	// The maximum number of pages the current query can return.
	var max = parseInt(pbd_alp.maxPages);
	
	// The link of the next page of posts.
	var nextLink = pbd_alp.nextLink;

	// Localization
	var showMore = ( typeof ct_blog_localization != 'undefined' || ct_blog_localization != null ) ? ct_blog_localization.show_more : "Show More Posts";
		loadingPosts = ( typeof ct_blog_localization != 'undefined' || ct_blog_localization != null ) ? ct_blog_localization.loading_posts : "Loading Posts...";
	/**
	* Replace the traditional navigation with our own,
	* but only if there is at least one page of new posts to load.
	*/
	if(pageNum <= max) {
		// Insert the "More Posts" link.
		$('#entry-blog')
			.append('<div class="pbd-alp-placeholder-'+ pageNum +'"></div>')
			.append('<div id="pbd-alp-load-posts"><a href="#" class="ct-google-font">'+ showMore +'</a></div>');
			
		// Remove the traditional navigation.
		$('.blog-navigation').remove();
	}
	
	
	/**
	 * Load new posts when the link is clicked.
	 */
	$('#pbd-alp-load-posts a').click(function() {
	
		// Are there more posts to load?
		if(pageNum <= max) {
		
			// Show that we're working.
			$(this).text(loadingPosts);
			$('#pbd-alp-load-posts').append('<i class="icon-spinner icon-spin"></i>');
			
			$('.pbd-alp-placeholder-'+ pageNum).load(nextLink + ' .post',
				function() {

					jQuery(".post-like a").click(function(){
						heart = jQuery(this);
	
						post_id = heart.data("post_id");
		
						jQuery.ajax({
							type: "post",
							url: ajax_var.url,
							data: "action=post-like&nonce="+ajax_var.nonce+"&post_like=&post_id="+post_id,
							success: function(count){
								if(count != "already") {
									heart.addClass("voted");
									heart.siblings(".count").text(count);
								}
							}
						});

						return false;
					})


					noPosts = ( typeof ct_blog_localization != 'undefined' || ct_blog_localization != null ) ? ct_blog_localization.no_posts : "No More Posts to Show";
					// Update page number and nextLink.
					pageNum++;
					nextLink = nextLink.replace(/\/page\/[0-9]*/, '/page/'+ pageNum);
					
					$( ".icon-spinner" ).remove();

					// Add a new placeholder, for when user clicks again.
					$('#pbd-alp-load-posts')
						.before('<div class="pbd-alp-placeholder-'+ pageNum +'"></div>')
					
					// Update the button message.
					if(pageNum <= max) {
						$('#pbd-alp-load-posts a').text(showMore);
					} else {
						$('#pbd-alp-load-posts a').text(noPosts);
						$('#pbd-alp-load-posts a').css('display','none');
						$('#pbd-alp-load-posts').append('<div class="pbd-no-posts">'+noPosts+'</div>');
					}
				}
			);
		} else {
			$('#pbd-alp-load-posts a').append('.');
		}

		return false;
	});
});
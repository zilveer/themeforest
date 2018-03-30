/*************************************************************
SCRIPTS INDEX

SIDEBAR POSTS VIEW SWITCHER
TWITTER VIA WIDGET INSPIRE DESIGN
FILTER MENU
SETUP HOMEPAGE FIRST RUN POSTS
NO MORE POSTS BUTTON WITH AN ATTITUDE
LOAD MORE
LIKE BUTTON
SHARE BUTTON
FOOTER PULL UP
JCAROUSEL
SHORTCODE TABS
SHORTCODE TOGGLE
SEARCH TOGGLE
BACK TO TOP
RESPONSIVE MENU
POST PAGINATION SAME HEIGHT
AJAX LOADING GIF
INFINITY SCROLL
ADD FANCYBOX TO ALL A TAGS REFERING TO IMAGES
FANCYBOX INIT
ADD CLASS TO LAST SUBFILTER LI
POST SLIDER INIT
CLICKABLE BACKGROUND


*************************************************************/

/*************************************************************
SIDEBAR POSTS VIEW SWITCHER
*************************************************************/

	jQuery(document).ready(function($) {

		//first hide from default view
		$('.widget.inspire_sidebar_posts').each(function(index, e) {
			$this = $(this);
			$defaultView = $this.find('#default_view').attr('data-default_view');
			if ($defaultView == "style_list") {
				$this.find('.grid_view').hide();
				$this.find('span.list img').attr('src',extData.templateURI + '/images/list_active.png');
			} else {
				$this.find('.list_view').hide();
				$this.find('span.grid img').attr('src',extData.templateURI + '/images/grid_active.png');
			}
		});

		//switcher
		$('.list').css('cursor','pointer').on('click', function () {
			$currentWidget = $(this).closest('.inspire_sidebar_posts');
			$currentWidget.find('span.list img').attr('src',extData.templateURI + '/images/list_active.png');
			$currentWidget.find('span.grid img').attr('src',extData.templateURI + '/images/grid.png');
			$currentWidget.find('.grid_view').fadeOut(1500, 'linear', function () {
				$currentWidget.find('.list_view').fadeIn(1500, 'linear');
			});
		});

		$('.grid').css('cursor','pointer').on('click', function () {
			$currentWidget = $(this).closest('.inspire_sidebar_posts');
			$currentWidget.find('span.list img').attr('src',extData.templateURI + '/images/list.png');
			$currentWidget.find('span.grid img').attr('src',extData.templateURI + '/images/grid_active.png');
			$currentWidget.find('.list_view').fadeOut(1500, 'linear', function () {
				$currentWidget.find('.grid_view').fadeIn(1500, 'linear');
			});
		});


	});

/*************************************************************
TWITTER VIA WIDGET INSPIRE DESIGN
*************************************************************/

	jQuery(document).ready(function($) {
		var useInspireDesign = $('.twitter_via_widget_inspire_design').attr('data-inspire_design');
		if (useInspireDesign == "false") {
			$('.twitter_via_widget_inspire_design').hide();
				
		} else {
			$('.twitter_widget').hide();
			$(window).load(function() {
				$('.inspire_sidebar_twitter_via_widget iframe').each(function(index, e) {
					$this = $(this);
					var numTweets = $('.twitter_via_widget_inspire_design').attr('data-num_tweets');
					var tweetCount = 0;
					$this.contents().find('.tweet').each(function(index, e){
						if (tweetCount == numTweets) return;
						$this = $(this);
						var published = $this.find('time').text();
						var tweet = $this.find('.e-entry-title').html();
						var altTweet = "<li>" + tweet + "<span>" + published + "</span></li>";
						$('.twitter_via_widget_inspire_design ul').append(altTweet);
						tweetCount++;
					});

				});
			});
		}
	});


/*************************************************************
LOAD MORE

ROADMAP:
We get posts and try to get plus one post (filter and load more AJAX).
If success #filter data-more_posts is set to true. (filter and load more AJAX)
if #filter data-more_posts is true then create load more button (here)

*************************************************************/

	jQuery(document).ready(function($) {

		if (typeof extDataFilterMenu == "undefined") return false;  //extDataFilterMenu is defined when page is NOT single
		if (extData.inspireOptions['load_posts_by'] == 'scroll') return false; //exit if infinity scroll
 
		$('.load-more .load_more').on('click', function () {
			$filter = $('#filter');
			var pageType = $filter.attr('data-page_type');
			var filterCategory = $filter.attr('data-category');
			var filterSubfilter = $filter.attr('data-subfilter');

			var currentPage = parseInt($filter.attr('data-current_page'), 10);
			var numPosts = extDataFilterMenu.numPosts;
			var searchQuery = $filter.attr('data-search_query');
			var authorID = $filter.attr('data-author_ID');
			var tag = $filter.attr('data-tag');
			var nonce = extDataFilterMenu.nonce;
			var transition = extData.inspireOptions['load_posts_animation'];

			//get post ids already on page
			var itemIdArray = new Array();
			$allItems = $('#main .item');
			$allItems.each(function(index, e) {
				$this = $(this);
				itemIdArray[index] = $this.attr('data-post_id');
			});

			$.ajax({
				type: 'post',
				dataType: 'html',
				url: extDataFilterMenu.ajaxUrl,
				data: {
					action: 'filter_menu',
					page_type: pageType,
					filter_category: filterCategory,
					filter_subfilter: filterSubfilter,
					current_page: currentPage + 1,
					num_posts: numPosts,
					search_query: searchQuery,
					author_ID: authorID,
					tag: tag,
					item_id_array: itemIdArray,
					nonce: nonce
				},
				success: function(response) {
					//SUCCESSFUL LOAD OF POSTS
					$('#ajax_loading_zone').append(response);
					var oldDivsContainerHeight = $('#main').height();

					$old_divs = $('#main .item');
					$new_divs = $('#ajax_loading_zone .item');

					//check if there are more posts
					if ($new_divs.size() > numPosts) {
						$('#filter').attr('data-more_posts','true');
						$('#ajax_loading_zone .item:last').remove();
						$new_divs = $('#ajax_loading_zone .item');
					} else {
						$('#filter').attr('data-more_posts','false');
					}
					if (extData.inspireOptions['load_posts_by'] == "button") $.insGlobalFunctions.loadMoreButton();

					var fadeSpeed = 0;
					//transition fade
					if (transition == "fade") {
						//settings
						fadeSpeed = extData.inspireOptionsAppearance['anim_loadposts_fade_speed'];
						
						//add new divs
						$new_divs.appendTo('#main').css('opacity','0.0');
						$('#main').masonry('reload');
						$new_divs.animate({
							opacity: 1.0
						}, parseInt(fadeSpeed), function (){
						});
					}	//end if transition fade

					if (transition == "asynchronous") {
						//settings
						fadeSpeed = extData.inspireOptionsAppearance['anim_loadposts_async_speed'];					//fade speed
						var delayMaxSpeed = extData.inspireOptionsAppearance['anim_loadposts_async_max_delay'];				//max speed of random delay
						var containerAnimateSpeed = extData.inspireOptionsAppearance['anim_loadposts_async_container_speed'];		//speed of container slide open

						//add new divs
						$new_divs.appendTo('#main').css('opacity','0.0');
						$('#main').masonry('reload');
						//animate new main container height
						var newDivsContainerHeight = $('#main').height();
						$('#main').height(oldDivsContainerHeight);
						$('#main').animate({
							height: newDivsContainerHeight
						}, parseInt(containerAnimateSpeed));
						$new_divs.each(function(index, e) {
							$this = $(this);
							delay = Math.floor((Math.random()*parseInt(delayMaxSpeed))+1);
							$this.delay(delay).animate({
								opacity: 1.0
							}, parseInt(fadeSpeed), function () {
									
							});
						}); 
					}	//end if transition asynchronous

					//fancybox setup on success
					$.insGlobalFunctions.insOnAjaxSuccess();

					// delayed relayout to avoid overlapping posts
					setTimeout(function(){
						$('#main').masonry('reload');
					}, 2000);

				}


			}); //end ajax

			//update current page
			$filter = $('#filter');
			$filter.attr('data-current_page', currentPage + 1);

		});

	});


/*************************************************************
FILTER MENU
*************************************************************/

	jQuery(document).ready(function($) {
		if (typeof extDataFilterMenu == "undefined") return false;  //extDataFilterMenu is defined when page is NOT single

		$('#filter ul li a').on('click', function (e) {
			$this = $(this);
			$filter = $('#filter');
			e.preventDefault();

			//detect if click was category or subfilter
			var filterType = $this.closest('ul').attr('id');

			//get vars
			var pageType = $filter.attr('data-page_type');
			var filterCategory = "";
			var filterSubfilter = "";

			if (filterType == "filter_category") {
				filterCategory = $this.text();
				filterSubfilter = $filter.attr('data-subfilter');
			} else if (filterType == "filter_subfilter") {
				filterCategory = $filter.attr('data-category');
				filterSubfilter = $this.text();
			}

			var currentPage = 1;
			var numPosts = extDataFilterMenu.numPosts;
			var searchQuery = $filter.attr('data-search_query');
			var authorID = $filter.attr('data-author_ID');
			var tag = $filter.attr('data-tag');
			var nonce = extDataFilterMenu.nonce;
			var transition = extData.inspireOptions['load_posts_animation'];

			//get post ids already on page
			var itemIdArray = new Array();

			$.ajax({
				type: 'post',
				dataType: 'html',
				url: extDataFilterMenu.ajaxUrl,
				data: {
					action: 'filter_menu',
					page_type: pageType,
					filter_category: filterCategory,
					filter_subfilter: filterSubfilter,
					current_page: currentPage,
					num_posts: numPosts,
					search_query: searchQuery,
					author_ID: authorID,
					tag: tag,
					item_id_array: itemIdArray,
					nonce: nonce
				},
				success: function(response) {
					//SUCCESSFUL LOAD OF POSTS
					$('#ajax_loading_zone').append(response);
					var oldDivsContainerHeight = $('#main').height();

					$old_divs = $('#main .item');
					$new_divs = $('#ajax_loading_zone .item');

					//check if there are more posts
					if ($new_divs.size() > numPosts) {
						$('#filter').attr('data-more_posts','true');
						$('#ajax_loading_zone .item:last').remove();
						$new_divs = $('#ajax_loading_zone .item');
					} else {
						$('#filter').attr('data-more_posts','false');
					}
					if (extData.inspireOptions['load_posts_by'] == "button") $.insGlobalFunctions.loadMoreButton();

					var fadeSpeed = 0;
					var fadeOutSpeed = 0;
					//transition fade
					if (transition == "fade") {
						//settings
						fadeSpeed = extData.inspireOptionsAppearance['anim_loadposts_fade_speed'];
						fadeOutSpeed = extData.inspireOptionsAppearance['anim_loadposts_fade_outspeed'];
						
						//remove old divs
						$old_divs_counter = $old_divs.size();
						$old_divs.animate({
							opacity: 0.0
						}, parseInt(fadeOutSpeed), function () {
							$old_divs_counter--;
							//add new divs
							if ($old_divs_counter === 0) {
								$old_divs.remove();
								$new_divs.appendTo('#main').css('opacity','0.0');
								$('#main').masonry('reload');
								$new_divs.animate({
									opacity: 1.0
								}, parseInt(fadeSpeed), function (){
								});
							}
						});
					}	//end if transition fade

					if (transition == "asynchronous") {
						//settings
						fadeSpeed = extData.inspireOptionsAppearance['anim_loadposts_async_speed'];
						fadeOutSpeed = extData.inspireOptionsAppearance['anim_loadposts_async_outspeed'];
						var delayMaxSpeed = extData.inspireOptionsAppearance['anim_loadposts_async_max_delay'];
						var containerAnimateSpeed = extData.inspireOptionsAppearance['anim_loadposts_async_container_speed'];

						//remove old divs
						$old_divs_counter = $old_divs.size();
						$old_divs.each(function(index, e) {
							$this = $(this);
							delay = Math.floor((Math.random()*delayMaxSpeed)+1);
							$this.delay(delay).animate({
								opacity: 0.0
							}, parseInt(fadeOutSpeed), function () {
								$old_divs_counter--;
								//add new divs
								if ($old_divs_counter === 0) {
									$old_divs.remove();
									$new_divs.appendTo('#main').css('opacity','0.0');
									$('#main').masonry('reload');
									//animate new main container height
									var newDivsContainerHeight = $('#main').height();
									$('#main').height(oldDivsContainerHeight);
									$('#main').animate({
										height: newDivsContainerHeight
									},parseInt(containerAnimateSpeed));
									$new_divs.each(function(index, e) {
										$this = $(this);
										delay = Math.floor((Math.random()*parseInt(delayMaxSpeed))+1);
										$this.delay(delay).animate({
											opacity: 1.0
										}, parseInt(fadeSpeed), function () {
												
										});
									}); 
								} 
							}); 
						}); 
					}	//end if transition asynchronous

					//fancybox setup on success
					$.insGlobalFunctions.insOnAjaxSuccess();

				}


			}); //end ajax

			//update filter control
			$filter = $('#filter');
			$filter.attr('data-category', filterCategory);
			$filter.attr('data-subfilter', filterSubfilter);
			$filter.attr('data-current_page', 1);

			$('#filter ul li a').filter(function () {
				return $(this).attr('class') == 'active';	
			}).removeClass('active');
			
			$('#filter ul li a').filter(function () {
				return $(this).text() == filterCategory;	
			}).addClass('active');
			
			$('#filter ul li a').filter(function () {
				return $(this).text() == filterSubfilter;	
			}).addClass('active');
			

		}); //end on click

	});


/*************************************************************
SETUP HOMEPAGE FIRST RUN POSTS
*************************************************************/

	jQuery(document).ready(function($) {
		$filter = $('#filter');
		var pageType = $filter.attr('data-page_type');

		if (typeof pageType != "undefined") {
			var filterCategory = $filter.attr('data-category');
			var filterSubfilter = $filter.attr('data-subfilter');

			var currentPage = $filter.attr('data-current_page');
			var numPosts = extDataFilterMenu.numPosts;
			var searchQuery = $filter.attr('data-search_query');
			var authorID = $filter.attr('data-author_ID');
			var tag = $filter.attr('data-tag');

			var nonce = extDataFilterMenu.nonce;
			var transition = extData.inspireOptions['load_posts_animation'];

			$.ajax({
				type: 'post',
				dataType: 'html',
				url: extDataFilterMenu.ajaxUrl,
				data: {
					action: 'filter_menu',
					page_type: pageType,
					filter_category: filterCategory,
					filter_subfilter: filterSubfilter,
					current_page: currentPage,
					num_posts: numPosts,
					search_query: searchQuery,
					author_ID: authorID,
					tag: tag,
					nonce: nonce
				},
				success: function(response) {
					//SUCCESSFUL LOAD OF POSTS
					$('#ajax_loading_zone').append(response);
					var oldDivsContainerHeight = $('#main').height();

					$old_divs = $('#main .item');
					$new_divs = $('#ajax_loading_zone .item');

					//check if there are more posts
					if ($new_divs.size() > numPosts) {
						$('#filter').attr('data-more_posts','true');
						$('#ajax_loading_zone .item:last').remove();
						$new_divs = $('#ajax_loading_zone .item');
					} else {
						$('#filter').attr('data-more_posts','false');
					}
					if (extData.inspireOptions['load_posts_by'] == "button") $.insGlobalFunctions.loadMoreButton();

					var fadeSpeed = 0;
					//transition fade
					if (transition == "fade") {
						//settings
						fadeSpeed = extData.inspireOptionsAppearance['anim_loadposts_fade_speed'];
						
						//add new divs
						$old_divs.remove();
						$new_divs.appendTo('#main').css('opacity','0.0');
						$('#main').masonry('reload');
						$new_divs.animate({
							opacity: 1.0
						}, parseInt(fadeSpeed), function (){
						});
					}	//end if transition fade

					if (transition == "asynchronous") {
						//settings
						fadeSpeed = extData.inspireOptionsAppearance['anim_loadposts_async_speed'];
						var delayMaxSpeed = extData.inspireOptionsAppearance['anim_loadposts_async_max_delay'];
						var containerAnimateSpeed = extData.inspireOptionsAppearance['anim_loadposts_async_container_speed'];

						//add new divs
						$old_divs.remove();
						$new_divs.appendTo('#main').css('opacity','0.0');
						$('#main').masonry('reload');
						//animate new main container height
						var newDivsContainerHeight = $('#main').height();
						$('#main').height(oldDivsContainerHeight);
						$('#main').animate({
							height: newDivsContainerHeight
						},parseInt(containerAnimateSpeed));
						$new_divs.each(function(index, e) {
							$this = $(this);
							delay = Math.floor((Math.random()*parseInt(delayMaxSpeed))+1);
							$this.delay(delay).animate({
								opacity: 1.0
							}, parseInt(fadeSpeed), function () {
									
							});
						}); 
					}	//end if transition asynchronous

					//fancybox setup on success
					$.insGlobalFunctions.insOnAjaxSuccess();

					// delayed relayout to avoid overlapping posts
					setTimeout(function(){
						$('#main').masonry('reload');
					}, 2000);


				}


			}); //end ajax

			//update filter control
			$('#filter ul li a').filter(function () {
				return $(this).attr('class') == 'active';	
			}).removeClass('active');
			
			$('#filter ul li a').filter(function () {
				return $(this).text() == filterCategory;	
			}).addClass('active');
			
			$('#filter ul li a').filter(function () {
				return $(this).text() == filterSubfilter;	
			}).addClass('active');
				
		}

	});


/*************************************************************
NO MORE POSTS BUTTON WITH AN ATTITUDE
*************************************************************/

	jQuery(document).ready(function($) {

		//no more posts
		if (extData.inspireOptions.load_more_attitude == 'checked') {
			var noMoreCounter = 0;
			$('.load-more .no_more').live('click', function() {
				$this = $(this);
				switch(noMoreCounter) {
					case 0:
						noMoreReply = "No really, there are no more posts now.";
						break;
					case 1:
						noMoreReply = "Seriously! I'm not kidding you - there are no more posts. Move along.";
						break;
					case 2:
						noMoreReply = "Ok that's just annoying!";
						break;
					case 3:
						noMoreReply = "Please go away!";
						break;
					case 4:
						noMoreReply = "Really, you need to find another button to bug!";
						break;
					case 5:
						noMoreReply = "I hate you!";
						break;
					case 6:
						noMoreReply = "STOP IT!";
						break;
					case 10:
						noMoreReply = "Ha! See? I'm ignoring you!";
						break;
					case 20:
						noMoreReply = "OMG are you never giving up?";
						break;
					default:
						noMoreReply = "I'm ignoring you now!";
				}
				$this.text(noMoreReply);
				noMoreCounter++;
			});
		}
	});

/*************************************************************
LIKE BUTTON
*************************************************************/

	jQuery(document).ready(function($) {

		$('.heart').live('click', function() {
			$this = $(this);
			var liked = false;
			var eClass = $this.attr('class');
			var postID = "";
			var nonce = "";

			if (extDataLike.pageType == "single") {
				postID = $this.closest('.post').attr('data-post_ID');
				nonce = $this.closest('.post').attr('data-nonce');
			} else {
				postID = $this.closest('.item').attr('data-post_ID');
				nonce = $this.closest('.item').attr('data-nonce');
			}

			//break if already liked
			if (eClass == "heart liked") liked = true;

			$.ajax({
				type: 'post',
				url: extDataLike.ajaxUrl,
				data: {
					action: 'like_post',
					post_ID: postID,
					liked: liked,
					nonce: nonce
				},
				success: function(response) {
					if (response != "") {
						$this.text(response);
						if (liked === false) {
							$this.addClass('liked');
						} else {
							$this.removeClass('liked');
						}
					}
				}
			}); //end ajax
		});
	});

/*************************************************************
SHARE BUTTON
*************************************************************/

	jQuery(document).ready(function($) {

		if (extData.pageType == 'page' || extData.pageType == 'single') {
			$shareWindow = $('#share_window');

			//CHECK FOR HANDHELD
			if (jQuery.insGlobalFunctions.isHandHeld()) {
				$shareWindow.attr('data-browser_size','responsive');
			}

			//BUILD
			if ($shareWindow.attr('data-browser_size') == 'responsive') {

				$('#share_control').remove();
				$('.post .post-share').css('height', '100px');
				$('.post-share #share_window').css({
					'width': '300px',
					'float': 'left'
				});
				$('.post-share #share_window .share_buttons').css('left', '0px');
				$('.post-share #share_window ul li').css({
					'display': 'block',
					'margin-bottom': '5px'

				});

			} else {
				var browserSize = $shareWindow.attr('data-browser_size');
					
				switch(browserSize) {
					case 'single':
						shareWindowWidth = 570;
						break;
					case 'full_sidebar':
						shareWindowWidth = 570;
						break;
					case 'full':
						shareWindowWidth = 910;
						break;
					default:
						shareWindowWidth = 570;
				}

				//setup share_window width
				$shareControl = $('#share_control');
				var postShareWidth = $('.post-share').width();
				var shareControlWidth = $shareControl.width();
				$shareWindow.css('width',shareWindowWidth);

				$shareButtonsLIs = $('.share_buttons li');
				var numPosts = $shareButtonsLIs.size();

				//wait until window load
				(function($){
				   $(window).load(function(){
						var nakedShareButtonULWidth = $('#share_window .share_buttons').width();

						//on click event
						$('.post-share img').on('click', function () {
							$this = $(this);
							$thisShareButtonsUL = $this.parent('#share_control').next('#share_window').find('.share_buttons');
							$thisShareControl = $this.parent('#share_control');
							var leftoverSpace = shareWindowWidth - nakedShareButtonULWidth;
							var buttonMargin = Math.floor(leftoverSpace / numPosts);
							$('.share_buttons li').slice(0,3).css('margin-right', buttonMargin + 'px');

							var status = $thisShareControl.attr('class');

							if (status == "closed") {
								$thisShareButtonsUL.animate({
									'left': buttonMargin + 'px' 	
								});	
								$thisShareControl.attr('class','open');
								$this.attr('src', extData.templateURI + "/images/share-minus.png");
							} else {
								$thisShareButtonsUL.animate({
									'left': '-' + shareWindowWidth + 'px'
								});	
								$thisShareControl.attr('class','closed');
								$this.attr('src', extData.templateURI + "/images/share-plus.png");
							}
						});

						//init state
				   		if (extData.inspireOptionsPost['share_buttons_closed_default'] != 'checked') {
					   		$('.post-share img').click();
				   		}
				   });
				})(jQuery); 

				
			}	//to be or not to be responsive
		} //endif 


	});



/*************************************************************
FOOTER PULL UP
*************************************************************/

	jQuery(document).ready(function($) {
		//default state
		$footerHidden = $('#footer_hidden');
		$footerTabImage = $('#footer_tab img');
		var insFooterDefault = $footerHidden.attr('data-footer_default');
		if (insFooterDefault == "closed") {
			$footerHidden.hide();
			$footerTabImage.attr('src', extData.templateURI + '/images/footer-toggle.png');
		}

		//open and close
		$footerTabImage.on('click', function () {
			$this = $(this);	
			$footerHidden = $('#footer_hidden');
			$footerHidden.slideToggle('slow', function () {
			   	$('html, body').animate({
       				scrollTop: $(document).height()
    			}, 2000);

    			//change image
				var activeImage = $this.attr('src');
				if (activeImage.indexOf('footer-toggle-down.png') == -1) {
					$this.attr('src', extData.templateURI + '/images/footer-toggle-down.png');
				} else {
					$this.attr('src', extData.templateURI + '/images/footer-toggle.png');
				}
			});

		});
	});

/*************************************************************
JCAROUSEL
*************************************************************/

	jQuery(document).ready(function($) {

		//get controller vars
		$controller = $('#footer_hidden');
		var numPosts = parseInt($controller.attr('data-num_posts'), 10);
		var scrollPosts = parseInt($controller.attr('data-scroll_posts'), 10);
		var autoScroll = parseInt($controller.attr('data-auto_scroll'), 10);
		var animSpeed = parseInt($controller.attr('data-anim_speed'), 10);

		$('#footer_carousel').jcarousel({
			size: numPosts,
			wrap: 'circular',
			scroll: scrollPosts,
			auto: autoScroll,
			animation: animSpeed
			//itemLoadCallback: jCarouselLoadItems
		});

		//this function is not called, activate to load posts dynamically
		function jCarouselLoadItems (carousel, state) {
			for (var i = carousel.first; i <= carousel.last; i++) {
	        // Check if the item already exists
		        if (!carousel.has(i)) {
		            // Add the item
		            carousel.add(i,"<li>DEBUG #" + i + "</li>");
		        }
		    }
		}

	});


/*************************************************************
SHORTCODE TABS
*************************************************************/

    jQuery(document).ready(function($) {
        //When page loads...
        $('.tabs_wrapper').each(function() {
            $(this).find(".tab_content").hide(); //Hide all content
            $(this).find("ul.tabs li:first").addClass("active").show(); //Activate first tab
            $(this).find(".tab_content:first").show(); //Show first tab content
        });
        
        //On Click Event
        $("ul.tabs li").click(function(e) {
            $(this).parents('.tabs_wrapper').find("ul.tabs li").removeClass("active"); //Remove any "active" class
            $(this).addClass("active"); //Add "active" class to selected tab
            $(this).parents('.tabs_wrapper').find(".tab_content").hide(); //Hide all tab content

            var activeTab = $(this).find("a").attr("href"); //Find the href attribute value to identify the active tab + content
            $(this).parents('.tabs_wrapper').find(activeTab).fadeIn('slow'); //Fade in the active ID content
            
            e.preventDefault();
        });
        
        $("ul.tabs li a").click(function(e) {
            e.preventDefault();
        });
    });


/*************************************************************
SHORTCODE TOGGLE
*************************************************************/

    jQuery(document).ready(function($) {
        $('.toggle_content').hide();

        $('.toggle').on('click', function() {
            $(this).next('.toggle_content').slideToggle('fast');
        });

    }); 

/*************************************************************
SEARCH TOGGLE
*************************************************************/

    jQuery(document).ready(function($) {

    	//init
    	if (extData.inspireOptions['search_box_default'] == "open") {
    		$('#pop_out_search').show();
    	}

    	if (extData.inspireOptions['search_box_default'] == "open_homepage" && extData.pageType == "home") {
    		$('#pop_out_search').show();
    	}

    	//on click
    	$('#header-search a').on('click', function () {
    		$('#pop_out_search').slideToggle('fast');
    	});

    }); 



/*************************************************************
BACK TO TOP
*************************************************************/

	jQuery(document).ready(function($) {
		$toTop = $('#to_top');

		//init
		if (extData.inspireOptions['to_top_style'] == 'onoff') {
			$toTop.hide();
		} else {
			$toTop.css('opacity', '0.0');
		}

		$(window).scroll(function() {
			if (extData.inspireOptions['to_top_style'] == 'onoff') {
				if($(this).scrollTop() !== 0) {
					$('#to_top').fadeIn();	
				} else {
					$('#to_top').fadeOut();
				}
			} else {
				var insScrollPos = $(this).scrollTop();
				if (insScrollPos > 1000) insScrollPos = 1000;
				var insScrollOpacity = insScrollPos / 1000;
				$('#to_top').animate({
					'opacity': insScrollOpacity
				},100);
			}
		});
	 
		$('#to_top').click(function() {
			$('body,html').animate({scrollTop:0},800);
		});	
	});	



/*************************************************************
RESPONSIVE MENU
*************************************************************/

	jQuery(document).ready(function($) {
		//setup menu
		$links = $('#menu .menu-item a');
		$mainSelect = $('#navigation_select');
		var currentUrl = window.location.href;
		$links.each(function(index) {
			$this = $(this);
			var navlink = $this.attr('href');
			var navname = $this.text();
			var depth = $this.parents('ul').length;
			if (depth > 0) navname = " " + navname;
			for (var i = 0; i < (depth-1); i++) {
				navname = "-" + navname;
			}
			if (navlink == currentUrl) {
				$mainSelect.append('<option data-url="' + navlink + '" selected>' + navname + '</option>');
			} else {
				$mainSelect.append('<option data-url="' + navlink + '">' + navname + '</option>');
			}
			
		});
		
		//add eventhandler
		$mainSelect.change(function() {
			$this = $(this);
			$optionUrl = $this.find('option:selected').data('url');
			window.location.href = $optionUrl;
		});

	});	


/*************************************************************
POST PAGINATION SAME HEIGHT
*************************************************************/

	jQuery(document).ready(function($) {
		$prevBox = $('.post-pagination a').eq(0);
		$nextBox = $('.post-pagination a').eq(1);
		var prevBoxHeight = $prevBox.height();
		var nextBoxHeight = $nextBox.height();
		if (prevBoxHeight > nextBoxHeight) $nextBox.height(prevBoxHeight);
		if (nextBoxHeight > prevBoxHeight) $prevBox.height(nextBoxHeight);
	});	


/*************************************************************
AJAX LOADING GIF
*************************************************************/

	jQuery(document).ready(function($) {
		$('#loading-image').bind('ajaxStart', function(){
		    $(this).show();
		}).bind('ajaxStop', function(){
		    $(this).hide();
		});
	});	

/*************************************************************
INFINITY SCROLL
*************************************************************/

	jQuery(document).ready(function($) {
		if (typeof extDataFilterMenu == "undefined") return false;  //extDataFilterMenu is defined when page is NOT single
		if (extData.inspireOptions['load_posts_by'] == "button") return false; //exit if load more button

        $(window).scroll(function(){ 
			$filter = $('#filter');
			var menuStatus = $filter.attr('data-status');

            if (($(window).scrollTop() == $(document).height() - $(window).height()) && menuStatus == "ready"){

            	$filter.attr('data-status','working');
				var pageType = $filter.attr('data-page_type');
				var filterCategory = $filter.attr('data-category');
				var filterSubfilter = $filter.attr('data-subfilter');

				var currentPage = parseInt($filter.attr('data-current_page'), 10);
				var numPosts = extDataFilterMenu.numPosts;
				var searchQuery = $filter.attr('data-search_query');
				var authorID = $filter.attr('data-author_ID');
				var tag = $filter.attr('data-tag');
				var nonce = extDataFilterMenu.nonce;
				var transition = extData.inspireOptions['load_posts_animation'];

				//get post ids already on page
				var itemIdArray = new Array();
				$allItems = $('#main .item');
				$allItems.each(function(index, e) {
					$this = $(this);
					itemIdArray[index] = $this.attr('data-post_id');
				});

				$.ajax({
					type: 'post',
					dataType: 'html',
					url: extDataFilterMenu.ajaxUrl,
					data: {
						action: 'filter_menu',
						page_type: pageType,
						filter_category: filterCategory,
						filter_subfilter: filterSubfilter,
						current_page: currentPage + 1,
						num_posts: numPosts,
						search_query: searchQuery,
						author_ID: authorID,
						tag: tag,
						item_id_array: itemIdArray,
						nonce: nonce
					},
					success: function(response) {
						//SUCCESSFUL LOAD OF POSTS
						$('#ajax_loading_zone').append(response);
						var oldDivsContainerHeight = $('#main').height();

						$old_divs = $('#main .item');
						$new_divs = $('#ajax_loading_zone .item');

						//check if there are more posts
						if ($new_divs.size() > numPosts) {
							$('#filter').attr('data-more_posts','true');
							$('#ajax_loading_zone .item:last').remove();
							$new_divs = $('#ajax_loading_zone .item');
						} else {
							$('#filter').attr('data-more_posts','false');
						}
						if (extData.inspireOptions['load_posts_by'] == "button") $.insGlobalFunctions.loadMoreButton();

						var fadeSpeed = 0;
						//transition fade
						if (transition == "fade") {
							//settings
							fadeSpeed = extData.inspireOptionsAppearance['anim_loadposts_fade_speed'];
							
							//add new divs
							$new_divs.appendTo('#main').css('opacity','0.0');
							$('#main').masonry('reload');
							$new_divs.animate({
								opacity: 1.0
							}, parseInt(fadeSpeed), function (){
							});
						}	//end if transition fade

						if (transition == "asynchronous") {
							//settings
							fadeSpeed = extData.inspireOptionsAppearance['anim_loadposts_async_speed'];					//fade speed
							var delayMaxSpeed = extData.inspireOptionsAppearance['anim_loadposts_async_max_delay'];				//max speed of random delay
							var containerAnimateSpeed = extData.inspireOptionsAppearance['anim_loadposts_async_container_speed'];		//speed of container slide open

							//add new divs
							$new_divs.appendTo('#main').css('opacity','0.0');
							$('#main').masonry('reload');
							//animate new main container height
							var newDivsContainerHeight = $('#main').height();
							$('#main').height(oldDivsContainerHeight);
							$('#main').animate({
								height: newDivsContainerHeight
							},parseInt(containerAnimateSpeed));
							$new_divs.each(function(index, e) {
								$this = $(this);
								delay = Math.floor((Math.random()*parseInt(delayMaxSpeed))+1);
								$this.delay(delay).animate({
									opacity: 1.0
								}, parseInt(fadeSpeed), function () {
										
								});
							}); 
						}	//end if transition asynchronous
					}


				}); //end ajax

				//set status to ready
				var infinityScrollCooldown = 0; //in milliseconds
				setTimeout(function() {
            		$filter.attr('data-status','ready');
				}, infinityScrollCooldown);

				//update current page
				$filter = $('#filter');
				$filter.attr('data-current_page', currentPage + 1);

	            }  
        });   
	});	


/****************************************************
ADD FANCYBOX TO ALL A TAGS REFERING TO IMAGES
****************************************************/

	jQuery(window).load(function($) {
		jQuery("a[href$='.jpg'],a[href$='.png'],a[href$='.gif']").attr('rel','gallery').attr('class','fancybox');
	});

/*************************************************************
FANCYBOX INIT
*************************************************************/

	jQuery(window).load(function($) {
		$=jQuery;
		if ($(".fancybox").size() > 0) {
			var insMainColor = extData.inspireOptionsAppearance['color_lightbox_overlay'];
			var insMainOpacity = extData.inspireOptionsAppearance['lightbox_overlay_opacity'];

			$(".fancybox").fancybox({
				helpers : {
			        overlay : {
			            css : {
			                'background' : jQuery.insGlobalFunctions.hexOpacityToRgbaString(insMainColor, insMainOpacity)
			            }
			        }
			    }
			});
		}
	});

/****************************************************
ADD CLASS TO LAST SUBFILTER LI
****************************************************/

	jQuery(document).ready(function($) {
		if ($('#filter_subfilter li').size() > 0) {
			$('#filter_subfilter li:last').addClass("last");
		}
	});

/****************************************************
POST SLIDER INIT
****************************************************/

	jQuery(window).load(function($) {
		$=jQuery;
	  	if ($('.flexslider_single').size() > 0) {

			var insAnimPostsliderSlideshow = (extData.inspireOptionsAppearance['anim_postslider_slideshow'] == 'checked') ? true : false;
			$('.flexslider_single').flexslider({
				slideshow: insAnimPostsliderSlideshow,
				slideshowSpeed: parseInt(extData.inspireOptionsAppearance['anim_postslider_slideshow_speed']),
				animationSpeed: parseInt(extData.inspireOptionsAppearance['anim_postslider_anim_speed']),
				animation: 'fade',
				smoothHeight: true,
				controlNav: false,
		  	});

	  	}
	});

/*************************************************************
CLICKABLE BACKGROUND
*************************************************************/

	jQuery(document).ready(function($){

		var bgLink = "";
		if (typeof extData.inspireOptionsAppearance['bg_link'] != "undefined") { bgLink = extData.inspireOptionsAppearance['bg_link']; }

		if (bgLink != "") {

			var bgLinkTarget = "_self";
			if (typeof extData.inspireOptionsAppearance['bg_link_opens_in_new_window'] != "undefined") { bgLinkTarget = "_blank"; }

			console.log(bgLinkTarget);
				
			$(document).on('click','body', function(event) {
				if (event.target.nodeName == "BODY") {
					window.open(bgLink, bgLinkTarget);
				}
			});
			
		}

	});

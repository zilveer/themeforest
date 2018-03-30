/**
 * Portfolio previewer-  displays previews of the portfolio
 * items separated by pages and adds a functionality for displaying a post after
 * clicking on the smaller preview
 * 
 * Dependencies: jQuery, pexetoSite
 * 
 * @author Pexeto http://pexeto.com
 */

(function($){
	$.fn.pexetoShowcase=function(options){
	// main default settings
		var defaults={
			itemnum : 6,
			pageWidth : 270,
			speed : 500, // will be overwritten by the XML data
			catId : -1,
			autoThumbnail : 'on',
			showCat : true,  //whether to show category or not
			sidebarPortionSize : 28, //the default sidebar size in percents
			sidebarPortionSizeSmall : 20, //the sidebar size in percents for small screens
			sidebarBreakPointAt : 800, //the maximum window width for small sidebar size
			responsive : true,			   //if enabled, the sidebar size should be changed according to the window size

			
			//selectors
			selectedClass:'showcase-selected',
			categories:'#showcase-categories',
			sidebarItem:'.showcase-item',
			navigationClass:'portf-navigation',
			catSelectedClass:'selected',
			parentSel:'#full-width',
			sidebarSel:'.portfolio-sidebar',
			itemsSel:'.portfolio-items',
			
			//templates (HTML markup used)
			contentColumn:'<div id="portfolio-preview"><div class="loading"></div></div>',
			sidebarColumn:'<div class="portfolio-sidebar"><div id="portfolio-wrapper"></div></div>',
			pagination:'<div id="portfolio-big-pagination" class="hover"></div>',
			pageWrapper:'<div class="portfolio-items"></div>',
			clearHtml:'<div class="clear"></div>'
			
		};

		var o=$.extend(defaults, options),
			items = [], 
			contentColumn, 
			sidebarColumn, 
			paginationHolder, 
			wrapper, 
			pageWrappers = [], 
			currentShown = 0, 
			inAnimation=false, 
			displayItems=[], 
			currentItem=null,
			parent = $(o.parentSel),
			sidebar = $(o.sidebarSel),
			root=$(this),
			sidebarWidth=o.pageWidth,
			leftArrow=null,
			rightArrow=null,
			browser = pexetoSite.getBrowser();

	/**
	 * Parses the data from the XML file, creates objects from the data and
	 * saves the objects into arrays.
	 */
	function parseData() {
		$('.portfolio-showcase-item').each(function(i) {
				
			var current = $(this),
			post = {},
			smallObj=null;
			
			// create the object for the post
			post.obj = current.find('.preview-item:first');
			post.html = post.obj.html();
			smallObj=current.find('.showcase-item:first');
			post.smallObj = smallObj;
			post.categories=String(smallObj.data('category')).split(',');
			

			items.push(post);
		});

		if (items.length > 0) {
			buildPageStructure();
			bindEventHandlers();

			if(o.responsive){
				setSidebarWidth();
			}
			
		}
	}

	/**
	 * Creates the main structure of the showcase page - creates a sidebar/content layout which will contain the items.
	 */
	function buildPageStructure(){
		contentColumn = $(o.contentColumn);
		sidebarColumn = $(pexetoSite.template(o.sidebarColumn));
		$('.preview-items').detach();
		bindSmallItemEventHandlers();
		root.html('').append(contentColumn).append(sidebarColumn);
		wrapper = sidebarColumn.find('#portfolio-wrapper');
		paginationHolder=$(o.pagination).appendTo(wrapper.parent());
		
		displayContent("-1"); //display the content with the default category
		root.show();
	}
	
	/**
	 * Displays the main content of the items container.
	 */
	function displayContent(cat) {
		//clear the data containers
		$('.portfolio-items').detach();
		displayItems=[];
		pageWrappers=[];	
		wrapper.html('').css({marginLeft:0});
		paginationHolder.html('');
		sidebarColumn.hide();
		
		// show the other posts from the right
		displayPostList(cat);
		if(o.responsive){
			setSidebarWidth();
		}
		
		pexetoSite.loadCufon();
	}

	/**
	 * Displays a preview of the post in the content area.
	 */
	function displayPost(item) {
		if(item){
			contentColumn.html(item.obj);
			pexetoSite.loadCufon();
			pexetoSite.setLightbox(jQuery("a[rel^='lightbox'],a[rel^='lightbox[group]']"));
			item.smallObj.trigger('postSelected');
			currentItem=item;
		}else{
			contentColumn.html('');
		}
	}

	/**
	 * Displays all the smaller post previews to the right, separated by pages.
	 * @param cat the category of the items to be displayed - if "-1" set, all the items will be displayed
	 */
	function displayPostList(cat) {
		cat=cat.toString();
		
		//filter the items by category
		if(cat!=="-1"){
			$.each(items, function(i,item){
				if(item.categories && $.inArray(cat, item.categories)!==-1){
					displayItems.push(item);
				}
			});
		}else{
			displayItems=items;
		}
		
		$.each(displayItems, function(i,item){
			var pageWrapper, post;
			
			//create page wrapper if the current item starts on a new page
			if (i % o.itemnum === 0) {
				pageWrapper = $(o.pageWrapper);
				pageWrappers.push(pageWrapper);
				wrapper.width(wrapper.width() + 500);
				wrapper.append(pageWrapper);
			}
			post = item.smallObj;
			
			pageWrappers[pageWrappers.length - 1]
					.append(post);
					
		});
		wrapper.append(o.clearHtml);

		if (displayItems.length > o.itemnum) {
			currentShown=0;
			showNavigation();
		}
		
		sidebarColumn.fadeIn();
		
		displayPost(displayItems[0]);

	}
	
	/**
	 * Binds a change slide event handler to the wrapper so that when a navigation button has been clicked,
	 * to change the slide according to the index of the slide to be displayed.
	 */
	function bindPaginationEventHandlers(){
		wrapper.on('changeSlide', function(e, index){
			if(!inAnimation){
				//it is not currently animated, do the animation now
				inAnimation=true;
				$('.portf-navigation').trigger('slideChanged', [index]);
				var margin = - index * sidebarWidth ;
				wrapper.animate( {
					marginLeft :  margin
				}, o.speed, function(){
					currentShown=index;
					inAnimation=false;
				});
			}
		});


		if(o.responsive){
			$(window).on('resize', function(){
				setSidebarWidth();
				wrapper.css({marginLeft:(- currentShown * sidebarWidth)});
			});
		}
		

	}

	function slideSidebarToPrevious(){
		if(currentShown!==0){
			wrapper.trigger('changeSlide', [currentShown-1]);
		}
	}

	function slideSidebarToNext(){
		if (currentShown < pageWrappers.length - 1) {
			wrapper.trigger('changeSlide', [currentShown+1]);
		}
	}
	
	/**
	 * Binds category event handlers for the category filters. 
	 * Handlers bound:
	 * -click
	 */
	function bindCategoryEventHandlers(){
		$(o.categories).find('li').on({
			'click':function(){
			$(this).addClass(o.catSelectedClass).siblings('.'+o.catSelectedClass).removeClass(o.catSelectedClass);
			var cat=$(this).data('category');
			currentShown = 0;
			displayContent(cat);
			}
		}).eq(0).addClass(o.catSelectedClass);
	}
	
	/**
	 * Calls the functions for binding event handlers.
	 */
	function bindEventHandlers(){
		bindPaginationEventHandlers();
		if(o.showCat){
			bindCategoryEventHandlers();
		}
	}


	/**
	 * Shows the pagination below the smaller post previews.
	 */
	function showNavigation() {
		 var ul=null,
			pageNumber=pageWrappers.length,
			selectedClass='selected',
			html='';
		 		
		//build the navigation buttons
		ul=$('<ul />', {'class':o.navigationClass}).appendTo(paginationHolder);
		
		while(pageNumber--){
			html+='<li></li>';
		}
		
		ul.on('slideChanged', function(event, index){
			$(this).find('li').removeClass(selectedClass).eq(index).addClass(selectedClass);
		})
		.append(html).find('li').click(function(){
			if(currentShown!==$(this).index()){
				wrapper.trigger('changeSlide', [$(this).index()]);
			}
		}).eq(0).addClass(selectedClass);

		leftArrow = $('<div />', {'class':'portfolio-arrow arrow-left'})
			.on('click', slideSidebarToPrevious)
			.insertAfter(ul);
		rightArrow = $('<div />', {'class':'portfolio-arrow arrow-right'})
			.on('click', slideSidebarToNext)
			.insertAfter(leftArrow);

	}

	/**
	 * Sets the small item event handlers to the smaller previews. When a small preview post is clicked
	 * the whole content of the post is shown in the content.
	 * Handlers bounds:
	 * -click
	 * -postSelected - when a new post is selected. This occures when clicking on the item itself or when loading a new category
	 */
	function bindSmallItemEventHandlers() {	
		sidebarColumn.delegate(o.sidebarItem, 'click', function(){
			var index = sidebarColumn.find(o.sidebarItem).index($(this));
			displayPost(displayItems[index]);
		}).delegate(o.sidebarItem, 'postSelected', function(){
			sidebarColumn.find('.'+o.selectedClass).removeClass(o.selectedClass);
			$(this).addClass(o.selectedClass);
		});

	}

	function setSidebarWidth(){
		if(browser.msie && (browser.version==7 || browser.version==8)){
			return;
		}
		var winWidth = (browser.chrome || browser.safari) ? $(window).width() : window.innerWidth,
			parentWidth = parent.width(),
			sidebarPortion = winWidth > o.sidebarBreakPointAt ? o.sidebarPortionSize : o.sidebarPortionSizeSmall;
		sidebarWidth = sidebarPortion * parentWidth / 100;

		sidebar.width(sidebarWidth);
		$(o.itemsSel).width(sidebarWidth);
	}
	
	if(root.length){
		parseData();
	}

	};
}(jQuery));
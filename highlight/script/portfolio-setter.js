/**
 * Portfolio setter- displays the portfolio items separated
 * by pages and adds a category filter functionality.
 * @author Pexeto
 * http://pexeto.com 
 */

(function($){
	$.fn.portfolioSetter=function(options){
		var defaults={
			//default settings
			itemsPerPage: 12, //the number of items per page
			pageWidth: 960,  //the width of each page
			pageHeight:430,  //the height of each page
			itemMargin:30,  //margin of each of the portfolio items
			showCategories: true,  // if set to false, the categories will be hidden
			easing: 'easeOutExpo', //the animation easing
			animationSpeed: 800, //the speed of the animation of the pagination
			navButtonWidth:21,  //the width of the pagination button 
			wavyAnimation:false, //if set the true, all the elements will fade in consecutively with a wavy effect
			pageWrapperClass: 'page-wrapper',  //the class of the div that wraps the items in order to set a page
			navigationId: 'portfolio-pagination',  //the ID of the pagination div
			itemClass: 'portfolio-item', //the class of the div that wraps each portfolio item data
			columns:3	
		};
		
		var options=$.extend(defaults, options);
		options.pageHolder=$(this);
		
		//define some helper variables
		var categories=[], items=[], pageWrappers=[], imagesLoaded=0, counter=0, ie=false, categoryHolder, iesix=false;
		
		var root=$('<div />').css({width:(options.pageWidth*2), float:'left'});
		$(this).css({width:options.pageWidth, height:'auto', overflow:'hidden'}).append(root);
		var parentId=$(this).attr('id');

	if($(this).length){
		init();
	}
	
	function init() {
		loadItems();
	}
	
	/**
	 * Parses the XML portfolio item data.
	 */
	function loadItems(){
		if(options.showCategories){
			//get the portfolio categories
			$('.category').each(function(i){
				var current=$(this),
				category = {
					id:	current.attr('id'),
					name: current.text()
				};
				categories.push(category);
			});
		}
						
		// get the portfolio items
		$('.portfolio-item').each(function(i){
						
				var item = {
					obj:$(this),
					category:$(this).attr('title').split(',')
				};
				item.html=item.obj.html();
				
				items.push(item);
		});
					
		setSetter();
	}
	
	
	/**
	 * Calls the main functions for setting the portfolio items.
	 */
	function setSetter(){
		if($.browser.msie){
			ie=true;
			if($.browser.version.substr(0,1)<7){
				iesix=true;
			}
		}
		root.siblings('.loading').remove();
		root.after('<div id="'+options.navigationId+'"><ul></ul></div>');
		if(options.showCategories){
			displayCategories();
		}
		
		displayItems();
		
	}
	
	/**
	 * Displays the categories.
	 */
	function displayCategories(){
		
		categoryHolder=$('#portfolio-categories');	
		
		//add the ALL link
		var allLink= categoryHolder.find('li:first');
		showSelectedCat(allLink);
		
		//bind the click event
		allLink.bind({
			'click': function(){
				displayItems();
				showSelectedCat($(this));
			},
			'mouseover':function(){
				$(this).css({cursor:'pointer'});
			}
		});
		
		//add all the category names to the list
		categoryHolder.find('li').each(function(i){
			
			if(i){
				//bind the click event
				$(this).bind({
					'click': function(){
						displayItems(categories[i-1].id);
						showSelectedCat($(this));
					},
					'mouseover':function(){
						$(this).css({cursor:'pointer'});
					}
				});
			}
		});
	}
	
	function showSelectedCat(selected){
		//hide the previous selected element
		var prevSelected=categoryHolder.find('ul li.selected');
		if(prevSelected[0]){
			prevSelected.removeClass('selected');
		}
		
		//show the new selected element
		selected.addClass('selected');
	}
	
	
	/**
	 * Displays the portfolio items.
	 */
	function displayItems(){
		var filterCat=arguments.length===0?false:true;
		
		//reset the divs and arrays
		$('.portfolio-item').detach();
		
		root.html('');
		root.width(300);
		pageWrappers=[];
		root.animate({marginLeft:0});
		
		var length=items.length;	
		counter=0;
		var catId=arguments[0];
		for ( var i = 0; i < length; i++)
			(function(i, filterCat, catId) {
				
				if(!filterCat || (filterCat && items[i].category.contains(catId))){
					if(counter%options.itemsPerPage===0){
						counter=0;
						//create a new page wrapper and make the holder wider
						root.width(root.width()+options.pageWidth+20);
						var wrapper=$('<div class="'+options.pageWrapperClass+'"></div>').css({float:'left', width:options.pageWidth+options.itemMargin});
						pageWrappers.push(wrapper);
						root.append(wrapper);
					}
					
					var lastWrapper=pageWrappers[pageWrappers.length-1];
					if(counter%options.columns===0){
						lastWrapper.append('<div class="item-wrapper"></div>');
					}
					
					
					var obj = items[i].obj,
					innerDiv=lastWrapper.find('div.item-wrapper:last');
					
					
					innerDiv.append(obj.css({display:'none'}));

					var timeout=counter>=options.itemsPerPage?0:100;
					
					if(counter>=options.itemsPerPage || !options.wavyAnimation){
						items[i].obj.css({display:'block'});
					}else{
						setTimeout(function() {
							//display the image by fading in
							items[i].obj.fadeIn().animate({opacity:1},0);
						},counter*100);
					}
					
					

					counter++;
				}
				
		})(i,filterCat, catId);
		
				
		//show the navigation buttons
		showNavigation();
		setHoverFunctionality();
		
		//call cufon
		pexetoSite.loadCufon();
		
		pexetoSite.setPortfolioLightbox();
		
				
	}
	
	
	/**
	 * Displays the navigation buttons.
	 */
	function showNavigation(){
		//reset the divs and arrays
		var navUl=root.siblings('#'+options.navigationId).find('ul');
		navUl.html('');
		
		var pageNumber=pageWrappers.length;
		if(pageNumber>1){
			for(var i=0; i<pageNumber; i++)(function(i){
				var li = $('<li><div class="navbg"></div><div class="button"></div></li>');
				navUl.append(li);
				//bind the click handler
				li.bind({
					'click': function(){
						var marginLeft=i*options.pageWidth+i*options.itemMargin;
						
						//set a bigger margin for IE6
						if ($.browser.msie && $.browser.version.substr(0,1)<7) {
							marginLeft+=i*options.itemMargin;
						}
						root.animate({marginLeft:[-marginLeft,options.easing]}, options.animationSpeed);
						
						navUl.find('li.selected').removeClass('selected');
						$(this).addClass('selected');
					},
					'mouseover':function(){
						$(this).css({cursor:'pointer'});
					}
				});
			})(i);
			
			navUl.find('li:first').addClass('selected');
			
			//center the navigation
			var marginLeft=(options.pageWidth)/2-pageNumber*options.navButtonWidth/2;
			navUl.css({marginLeft:marginLeft});
		}
	}
	
	function setHoverFunctionality(){
		if(!iesix){
			$('.portfolio-item img').hover(function(){
				$(this).stop().animate({opacity:0.8}, 300);
			}, function(){
				$(this).stop().animate({opacity:1}, 300);
			});
		}
	}
	};
}(jQuery));


/**
 * Declare a function for the arrays that checks
 * whether an array contains a value.
 * @param value the value to search for
 * @return true if the array contains the value and false if the
 * array doesn't contain the value
 */
Array.prototype.contains=function(value){
	var length=this.length;
	for(var i=0; i<length; i++){
		if(this[i]===value){
			return true;
		}
	}
	return false;
};

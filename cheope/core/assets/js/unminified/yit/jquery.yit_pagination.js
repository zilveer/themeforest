(function( window, $, undefined ) {

	$.yit_pagination = function( options, element ) {
		this.element = $( element );
		this._init( options );
	};

	$.yit_pagination.defaults	= {
		pageSize: 10,
		currentPage: 1,
		holder: null,
		pagerLocation: "after",
		pagerStyle: 'numbers' //numbers or arrows
    };

	$.yit_pagination.prototype = {
		_init : function( options ) {
			this.options = $.extend( true, {}, $.yit_pagination.defaults, options );

			var pageCounter = 1;
			var pageSize = this.options.pageSize;
			var selector = this.element;
			
			selector.wrap("<div class='pagination_container'></div>");
			selector.parents(".pagination_container").find("ul.pagination_nav").remove();
			
			selector.children().each(function(i){ 
					
				if(i < pageCounter*pageSize && i >= (pageCounter-1)*pageSize) {
					$(this).addClass("pagination_page"+pageCounter);
				}
				else {
					$(this).addClass("pagination_page"+(pageCounter+1));
					pageCounter ++;
				}	
				
			});
			
			// show/hide the appropriate regions 
			selector.children().hide();
			selector.children(".pagination_page"+this.options.currentPage).show();
			
			this.options.pageCounter = pageCounter;
			
			if(pageCounter > 1) {
				this._createPagination();
			}

			this._initEvents();
		},
		
		_initEvents : function() {
			var self = this;
			var options = this.options;
			var selector = this.element;
			
			//pagination behavior
			if( this.options.pagerStyle == 'numbers' ) {
				selector.parent().on('click', '.pagination_nav a', function() {
						
					//grab the REL attribute 
					var clickedLink = $(this).attr("rel");
					options.currentPage = clickedLink;
					
					if(options.holder) {
						$(this).parent("li").parent("ul").parent(options.holder).find("li.currentPage").removeClass("currentPage");
						$(this).parent("li").parent("ul").parent(options.holder).find("a[rel='"+clickedLink+"']").parent("li").addClass("currentPage");
					}
					else {
						//remove current current (!) page
						$(this).parent("li").parent("ul").parent(".pagination_container").find("li.currentPage").removeClass("currentPage");
						//Add current page highlighting
						$(this).parent("li").parent("ul").parent(".pagination_container").find("a[rel='"+clickedLink+"']").parent("li").addClass("currentPage");
					}
					
					//hide and show relevant links
					selector.children().hide();			
					selector.find(".pagination_page"+clickedLink).each(function(){
						$(this).fadeIn(1000)
					});
					
					return false;
				});				
			} else {
				var currentPage = options.currentPage;
				var pageCounter = options.pageCounter;
				
				var prev = this.element.parent().find('.pagination_nav_prev');
				var next = this.element.parent().find('.pagination_nav_next');
				var label = this.element.parent().find('.pagination_nav_label');
				
				selector.parent().on('click', '.pagination_nav a', function() {
					var li = $(this).parent();
					var nextItems = 0;
					
					if( li.hasClass('pagination_nav_prev') && currentPage > 1 ) {
						var nextItems = --currentPage;
					} else if( li.hasClass('pagination_nav_next') && currentPage < pageCounter ) {
						var nextItems = ++currentPage;
					} else {
						return false;
					}
					
					prev.removeClass('pagination_nav_disabled');
					next.removeClass('pagination_nav_disabled');
					if( currentPage == 1 ) {
						prev.addClass('pagination_nav_disabled');
					}
					
					if( currentPage == pageCounter ) {
						next.addClass('pagination_nav_disabled');
					}

					//hide and show relevant links
					selector.children().hide();			
					selector.find(".pagination_page"+nextItems).each(function(){
						$(this).fadeIn(1000)
					});

					//update label
					var previousElements = (currentPage-1)*options.pageSize + selector.find(".pagination_page"+nextItems).length;						
					label.html( previousElements + ' of ' + selector.children().length );
					
					return false;
				});
			}
		},
		
		
		_createPagination: function() {
			var pageNav = "<ul class='pagination_nav'>";
			var pageCounter = this.options.pageCounter;
			
			if( this.options.pagerStyle == 'numbers' ) {				
				
				for (i=1;i<=pageCounter;i++){
					if (i==this.options.currentPage) {
						pageNav += "<li class='currentPage pagination_nav"+i+"'><a rel='"+i+"' href='#'>"+i+"</a></li>";	
					}
					else {
						pageNav += "<li class='pagination_nav"+i+"'><a rel='"+i+"' href='#'>"+i+"</a></li>";
					}
				}
			} else {
				var pageSize = this.options.pageSize;
				var elements = this.element.children().length;
				var currentPage = this.options.currentPage;
				
				var prevClass = currentPage == 1 ? ' pagination_nav_disabled' : '';
				var nextClass = currentPage == pageCounter ? ' pagination_nav_disabled' : '';
				
				pageNav += "<li class='pagination_nav pagination_nav_prev"+ prevClass + "'><a href='#'>&laquo;</a></li>";	
				pageNav += "<li class='pagination_nav pagination_nav_label'>" + (pageSize*currentPage) + " of " + elements + "</li>";	
				pageNav += "<li class='pagination_nav pagination_nav_next"+ nextClass + "'><a href='#'>&raquo;</a></li>";	
			}
			

			pageNav += "</ul>";
			
			//append the element
			if(!this.options.holder) {
				switch(this.options.pagerLocation)
				{
					case "before":
						this.element.before(pageNav);
					break;
					case "both":
						this.element.before(pageNav);
						this.element.after(pageNav);
					break;
					default:
						this.element.after(pageNav);
				}
			}
			else {
				$(this.options.holder).append(pageNav);
			}
		}
		
		
	};

	$.fn.yit_pagination = function( options ) {
		if ( typeof options === 'string' ) {
			var args = Array.prototype.slice.call( arguments, 1 );

			this.each(function() {
				var instance = $.data( this, 'yit_pagination' );
				if ( !instance ) {
					console.error( "cannot call methods on yit_pagination prior to initialization; " +
					"attempted to call method '" + options + "'" );
					return;
				}
				if ( !$.isFunction( instance[options] ) || options.charAt(0) === "_" ) {
					console.error( "no such method '" + options + "' for yit_pagination instance" );
					return;
				}
				instance[ options ].apply( instance, args );
			});
		} 
		else {
			this.each(function() {
				var instance = $.data( this, 'yit_pagination' );
				if ( !instance ) {
					$.data( this, 'yit_pagination', new $.yit_pagination( options, this ) );
				}
			});
		}
		return this;
	};


})( window, jQuery );

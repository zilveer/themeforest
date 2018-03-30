/*!
# @author Fernando Lujan
#
# @title Filterade.js
# @url https://github.com/FernandoLujan/filterade-js
# @desc Filters and pagination with options, from Canada
# @desc Rewritten by Dream-Theme.com for The7 WordPress theme (the7.io)
*/

;(function ( $, window, document, undefined ) {
	return $.fn.Filterade = function(options) {
		var activeFilter, 
			activePage,
			activeSort,
			activeOrder,
			$container, 
			defaults,
			filterControls, 
			sortControls,
			orderControls,
			controlsSelecter,
			controlsSelecterChecked,
			filterResults, 
			getPageCount, 
			initialize, 
			$nodes,
			paginationMode,
			pageControls, 
			pageCount, 
			paginateControls, 
			paginateResults,
			updateView,
			sortNodes;
	
		defaults = {
			useFilters: false,
			useSorting: false,
			filterControls: '.filter-controls',
			sortControls: '.sort-controls',
			orderControls: '.order-controls',
			controlsSelecter: 'input',
			controlsSelecterChecked: 'input[checked="checked"]',
			defaultFilter: 'all',
			defaultSort: 'date',
			defaultOrder: 'desc',
			selectAll: 'all',
			paginationMode: 'pages',
			pageLimit: 15,
			pageControls: '.page-controls',
			//previousButtonClass: 'previous',
			previousButtonClass: 'nav-prev',
			//previousButtonLabel: 'Previous',
			previousButtonLabel: '<i class="fa fa-long-arrow-left" aria-hidden="true"></i>',
			//nextButtonClass: 'next',
			nextButtonClass: 'nav-next',
			//nextButtonLabel: 'Next',
			nextButtonLabel: '<i class="fa fa-long-arrow-right" aria-hidden="true"></i>',
			//loadMoreButtonClass: 'load-more',
			loadMoreButtonClass: 'button-load-more',
			loadMoreButtonLabel: 'Load more',
			pagerClass: 'page',
			//activeClass: 'active',
			activeClass: 'act',
			log: false
		};
	
		//$container = $(this.selector);
		$container = $(this);
		paginationMode = options.paginationMode || defaults.paginationMode;
		pageControls = $(options.pageControls || defaults.pageControls);
		filterControls = $(options.filterControls || defaults.filterControls);
		sortControls = $(options.sortControls || defaults.sortControls);
		orderControls = $(options.orderControls || defaults.orderControls);
		controlsSelecter = options.controlsSelecter || defaults.controlsSelecter;
		controlsSelecterChecked = options.controlsSelecterChecked || defaults.controlsSelecterChecked;
		activePage = 1;
	
		$nodes = $([]);
		$nodes.$nodesCache = $([]);
		$container.children("article").each(function() {
			var $this = $(this);
			$nodes.push({
				node: this,
				$node: $this,
				name: $this.attr("data-name"),
				date: new Date($this.attr("data-date"))
			});
			$nodes.$nodesCache.push(this);
		});
		pageCount = Math.ceil($nodes.length / options.pageLimit);
	
		/*
			# @getPageCount
			# Calculate page count
		*/
		getPageCount = function() {
		var nodeCount;
			if (paginationMode === "pages" || paginationMode === "load-more") {
				nodeCount = 0;
				$nodes.each(function() {
					if (this.$node.hasClass("visible")) {
						return nodeCount++;
					}
				});
	
				pageCount = Math.ceil(nodeCount / (options.pageLimit || defaults.pageLimit));
			}
		};
		
		/*
			# @paginateControls
			# Hide/display content based on pagination
		*/
		//Changed by Alla 13.09.2016 (remove li wrap from links)
		paginateControls = function() {
			if (paginationMode === "pages") {
				var i, _i;
				pageControls.empty();
				if (pageCount > 1) {
					if (activePage !== 1) {
					pageControls.prepend('<a href="#" class="' + (options.previousButtonClass || defaults.previousButtonClass) + '">' + (options.previousButtonLabel || defaults.previousButtonLabel) + '</a>');
					}

					var pagesToShow = 5;
                    var pagesToShowMinus1 = pagesToShow - 1;
					var pagesBefore = Math.floor(pagesToShowMinus1/2);
                    var pagesAfter = Math.ceil(pagesToShowMinus1/2);
                    var startPage = Math.max(activePage - pagesBefore, 1);
                    var endPage = activePage + pagesAfter;

                    if(startPage <= pagesBefore) {
                        endPage = startPage + pagesToShowMinus1;
                    }

                    if(endPage > pageCount) {
                        startPage = Math.max(pageCount - pagesToShowMinus1, 1);
                        endPage = pageCount;
                    }

                    var leftPagesPack = $('<div style="display: none;"></div>');
                    var rightPagesPack = $('<div style="display: none;"></div>');

					for (i = _i = 1; 1 <= pageCount ? _i <= pageCount : _i >= pageCount; i = 1 <= pageCount ? ++_i : --_i) {
					    if (i<startPage && i!=1) {
					        leftPagesPack.append('<a href="#" class="' + (options.pagerClass || defaults.pagerClass) + '" data-page="' + +i + '">' + i + '</a>');
                            continue;
                        }

                        if (i==startPage && leftPagesPack.children().length) {
                            pageControls.append(leftPagesPack);
                        }

                        if (i>endPage && i!=pageCount) {
                            rightPagesPack.append('<a href="#" class="' + (options.pagerClass || defaults.pagerClass) + '" data-page="' + +i + '">' + i + '</a>');
                            continue;
                        }

                        if (i==pageCount && rightPagesPack.children().length) {
                            pageControls.append(rightPagesPack);
                        }

					    pageControls.append('<a href="#" class="' + (options.pagerClass || defaults.pagerClass) + '" data-page="' + +i + '">' + i + '</a>');
					}

					if (activePage < pageCount) {
					pageControls.append('<a href="#" class="' + (options.nextButtonClass || defaults.nextButtonClass) + '">' + (options.nextButtonLabel || defaults.nextButtonLabel) + '</a>');
					}
					pageControls.find('a[data-page="' + activePage + '"]').addClass(options.activeClass || defaults.activeClass);
					pageControls.find('a.' + (options.pagerClass || defaults.pagerClass)).click(function(e) {
						e.preventDefault();
						activePage = parseInt($(this).attr('data-page'));
						pageControls.find('a.' + (options.activeClass || defaults.activeClass)).removeClass(options.activeClass || defaults.activeClass);
						pageControls.find('a[data-page="' + activePage + '"]').addClass(options.activeClass || defaults.activeClass);

						//Scroll to top of container
						var $scrollTo = $container.offset().top - 40;

						// if (!$scrollTo.exists()) {
						// 	$scrollTo = $container;
						// 	//paddingTop = 50;
						// }
						$("html, body").animate({
							scrollTop: $scrollTo - $("#phantom").height()
						}, 400);
						return updateView();

						
					});
					pageControls.find('a.' + (options.previousButtonClass || defaults.previousButtonClass)).click(function(e) {
					e.preventDefault();
					activePage--;
					//Scroll to top of container
					var $scrollTo = $container.offset().top - 40;

					
					$("html, body").animate({
						scrollTop: $scrollTo - $("#phantom").height()
					}, 400);
					return updateView();
					});
					return pageControls.find('a.' + (options.nextButtonClass || defaults.nextButtonClass)).click(function(e) {
					e.preventDefault();
					activePage++;
					//Scroll to top of container
					var $scrollTo = $container.offset().top - 40;

					// if (!$scrollTo.exists()) {
					// 	$scrollTo = $container;
					// 	//paddingTop = 50;
					// }
					$("html, body").animate({
						scrollTop: $scrollTo - $("#phantom").height()
					}, 400);
					return updateView();
					});
				}
			}
			else if (paginationMode === "load-more") {
				//var activeLoadClass = "";
				pageControls.empty();
				if (pageCount > 1) {

					if (activePage < pageCount) {
					pageControls.append('<a href="#" class="' + (options.loadMoreButtonClass || defaults.loadMoreButtonClass) + '"><span class="stick"></span><span class="button-caption">' + (options.loadMoreButtonLabel || defaults.loadMoreButtonLabel) + '</span></a>');
					}else{
						pageControls.css("display", "none");
					}

					return pageControls.find('a.' + (options.loadMoreButtonClass || defaults.loadMoreButtonClass)).click(function(e) {
						e.preventDefault();
						//var activeLoadClass = "animate-load";
						activePage++;
					//	$(this).addClass("animate-load");
						return updateView();
						
					});
					
				}
			}
		};
		
		/*
			# @paginateResults
			# Only displays results within the active page
		*/
		paginateResults = function() {
			if (paginationMode === "pages" || paginationMode === "load-more") {
				var nodeIndex = 0,
					$nodesHide = $([]),
					$nodesShow = $([]);
	
				 $nodes.each(function(i) {
					if (this.$node.hasClass("visible")) {
						nodeIndex++;
						if ((paginationMode === "pages") && nodeIndex > (activePage * (options.pageLimit || defaults.pageLimit) - (options.pageLimit || defaults.pageLimit)) && nodeIndex <= ((options.pageLimit || defaults.pageLimit) * activePage)) {
							$nodesShow.push(this.node);
						}
						else if ((paginationMode === "load-more") && nodeIndex <= ((options.pageLimit || defaults.pageLimit) * activePage)) {
							$nodesShow.push(this.node);
						} 
						else {
							$nodesHide.push(this.node);
						}
						//$nodesShow.layzrBlogInitialisation();
					}
				});
				$nodesHide.removeClass("visible").addClass("hidden");
				$nodesShow.removeClass("hidden").addClass("visible");
				$nodesShow.removeClass("first");
				$nodesShow.first().addClass("first");
				//console.log($nodesShow.first())

				
			}
		};
		
		/*
			# @filterResults
			# Hide/display content based on the active filter
		*/
		filterResults = function() {
			var $nodesHide = $([]),
				$nodesShow = $([]);
	
			if (options.useFilters || defaults.useFilters) {
				if (activeFilter === (options.selectAll || defaults.selectAll)) {
					$nodesShow = $nodes.$nodesCache;
				}
				else {
					$nodes.each(function(i) {
						if (!this.$node.hasClass(activeFilter)) {
							$nodesHide.push(this.node);
						}
						else {
							$nodesShow.push(this.node);
						}
					});
				}
			}
			else {
				$nodesShow = $nodes.$nodesCache;
			}
	
			$nodesHide.removeClass("visible").addClass("hidden");
			$nodesShow.removeClass("hidden").addClass("visible");
			//$nodesShow.layzrBlogInitialisation();
		};
	
		/*
			# @sortNodes
			# Sorts nodes and mekes changes to DOM
		*/
		sortNodes = function() {
			if (activeSort === "date" && activeOrder ==="desc") {
				$nodes.sort(function(a, b){return b.date - a.date});
			}
			else if (activeSort === "date" && activeOrder ==="asc") {
				$nodes.sort(function(a, b){return a.date - b.date});
			}
			else if (activeSort === "name" && activeOrder ==="desc") {
				$nodes.sort(function(a, b){
					var x = a.name.toLowerCase();
					var y = b.name.toLowerCase();
					if (x > y) {return -1;}
					if (x < y) {return 1;}
					return 0;
				});
			}
			else if (activeSort === "name" && activeOrder ==="asc") {
				$nodes.sort(function(a, b){
					var x = a.name.toLowerCase();
					var y = b.name.toLowerCase();
					if (x < y) {return -1;}
					if (x > y) {return 1;}
					return 0;
				});
			}
	
			$nodes.$nodesCache = $([]);
			$nodes.each(function() {
				$nodes.$nodesCache.push(this.node);
			});
			if($container.find(".paginator").length > 0){
				$nodes.$nodesCache.detach().insertBefore($container.find(".paginator"));
			}else{
	
				$nodes.$nodesCache.detach().appendTo($container);
			}
		};
	
		/*
			# @updateView
			# Update controls and containers
		*/
		updateView = function() {
			filterResults();
			getPageCount();
			paginateResults();
			paginateControls();
			$(".layzr-loading-on .blog-shortcode.jquery-filter .visible:not(.shown)").layzrBlogInitialisation();
		};
	
		/*
			# @initialize
			# Configures plugin defaults and updates the document when done
		*/
		initialize = function() {
			if (options.useFilters || defaults.useFilters) {
				activeFilter = (filterControls.find(controlsSelecterChecked).attr("data-filter") || options.defaultFilter || defaults.defaultFilter);
	
				filterControls.find(controlsSelecter).click(function(e) {
					activeFilter = $(this).attr("data-filter");
					activePage = 1;
					updateView();
				});
			}
	
			if (options.useSorting || defaults.useSorting) {
				activeSort = (sortControls.find(controlsSelecterChecked).attr("data-by") || options.defaultSort || defaults.defaultSort);
				activeOrder = (orderControls.find(controlsSelecterChecked).attr("data-sort") || options.defaultOrder || defaults.defaultOrder);
	
				sortControls.find(controlsSelecter).click(function(e) {
					if (this.getAttribute("data-by") === "date") activeSort = "date";
					else activeSort = "name";
	
					sortNodes();
					activePage = 1;
					updateView();
				});
	
				orderControls.find(controlsSelecter).click(function(e) {
					if (this.getAttribute("data-sort") === "desc") activeOrder = "desc";
					else activeOrder = "asc";
	
					sortNodes();
					activePage = 1;
					updateView();
				});
			}
			return updateView();
		};
		return initialize();
	};
})( jQuery, window, document );
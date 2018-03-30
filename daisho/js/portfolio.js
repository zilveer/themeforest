( function( $ ) {

	'use strict';
		
	if ( ! ( 'shuffle' in Isotope.prototype ) ) {
		Isotope.prototype.shuffle = function() {
			for ( var i=0, len = this.items.length; i < len; i++ ) {
				var item = this.items[i];
				item.sortData.random = Math.random();
			}
			this.options.sortBy = 'random';
			this._sort();
			this._layout();
		};
	}
	
	//var global_current_id = global_current_id || false;
	
	// The variable prevents initial onpopstate on Chrome and Safari. As soon as onpopstate happens or as soon as any pushState happens it is permanently set to 'false'.
	var	initialURL = location.href;

	if(!portfolio_page_title){
		var portfolio_page_title = '';
	}

	function bringPortfolio(current_id){

		global_current_id = current_id;
		
		// If project with such ID does not exist, load project 0 or do nothing
		if(projectsArray[current_id] === undefined){ 
			if(projectsArray.length != 0){
				// If user wants to open projects with page refresh, do this
				if(jQuery('body').hasClass('page-refresh')){
					location.href = projectsArray[0][7];
					return;
				}
				bringPortfolio(0); 
			} 
			return;
		}
		
		// Assign projects array to variables
		var title = projectsArray[current_id][0];
		var desc = projectsArray[current_id][1];
		var date = projectsArray[current_id][2];
		var client = projectsArray[current_id][3];
		var agency = projectsArray[current_id][4];
		var ourrole = projectsArray[current_id][5];
		var slides = projectsArray[current_id][6];
		var permalink = projectsArray[current_id][7];
		var external_link = projectsArray[current_id][8]; // It never exists at this moment but it's reserved space for it
		var categories_array = projectsArray[current_id][9];
		var project_id = projectsArray[current_id][10];
		
		// Count number of projects
		var number_of_ids = projectsArray.length;

		// Make it go to the top and fade out current project data
		jQuery('body,html').animate({scrollTop:0}, 800);
		jQuery('.portfolio_box').removeClass('portfolio_box-visible');

		jQuery('body').addClass('daisho-portfolio-viewing-project');

		setTimeout(function(){
			/* if(date == ''){ jQuery('.project-date').hide(); }else{ jQuery('.project-date').show(); }
			if(client == ''){ jQuery('.project-client').hide(); }else{ jQuery('.project-client').show(); }
			if(agency == ''){ jQuery('.project-agency').hide(); }else{ jQuery('.project-agency').show(); }
			if(ourrole == ''){ jQuery('.project-ourrole').hide(); }else{ jQuery('.project-ourrole').show(); } */
			
			// TODO: Double test to see if http://support.forcg.com/topic/google-indexing is done correctly.
			if(agency == ''){
				jQuery('.project-agency').remove();
			}else{
				if(!jQuery('.project-agency').length){
					jQuery('<div class="project-meta-data project-agency clearfix">\
						<div class="project-meta-heading">' + daishoData.agency + '</div>\
						<div class="project-meta-description project-exagency"></div>\
					</div>').appendTo('.project-meta-col-1');
				}
			}
			if(date == ''){
				jQuery('.project-date').remove();
			}else{
				if(!jQuery('.project-date').length){
					jQuery('.project-meta-col-1').prepend('<div class="project-meta-data project-date clearfix">\
						<div class="project-meta-heading">' + daishoData.date + '</div>\
						<div class="project-meta-description project-exdate"></div>\
					</div>');
				}
			}
			if(client == ''){
				jQuery('.project-client').remove();
			}else{
				if(!jQuery('.project-client').length){ 
					var element = jQuery('<div class="project-meta-data project-client clearfix">\
						<div class="project-meta-heading">' + daishoData.client + '</div>\
						<div class="project-meta-description project-exclient"></div>\
					</div>');
					if(jQuery('.project-agency').length){
						jQuery('.project-agency').before(element);
					}else if(jQuery('.project-date').length){
						jQuery('.project-date').after(element);
					}else{
						jQuery('.project-meta-col-1').append(element);
					}
				}
			}
			if(ourrole == ''){
				jQuery('.project-ourrole').remove();
			}else{
				if(!jQuery('.project-ourrole').length){
					jQuery('<div class="project-meta-data project-ourrole clearfix">\
						<div class="project-meta-heading">' + daishoData.ourrole + '</div>\
						<div class="project-meta-description project-exourrole"></div>\
					</div>').appendTo('.project-meta-col-2');
				}
			}
			
			// Show menu, navigation, containers etc.
			jQuery('.portfolio_box').addClass('portfolio_box-visible');
			jQuery('.compact-nav').addClass('compact-nav-visible');
			jQuery('.project-coverslide').addClass('project-coverslide-visible');
			
			// Add current project data
			jQuery('.project-title').html(title);
			jQuery('.project-description').html(desc);
			jQuery('.project-exdate').html(date);
			jQuery('.project-exclient').html(client);
			jQuery('.project-exagency').html(agency);
			jQuery('.project-exourrole').html(ourrole);
			jQuery('.project-slides').html(slides);

			// Update document title, URL and brwosing history using HTML5 History API
			if(Modernizr.history){
				if(!window.history.state || (window.history.state.projid != current_id)){
					window.history.pushState({'cancelback': true, 'projid': current_id}, title, permalink);
					initialURL = false;
				}
				jQuery('title').html(title);
			}
			
			// Setup sharing icons (desktop mode)
			if(jQuery(".sharing-icons").length){
				jQuery(".sharing-icons-twitter").attr("href", "https://twitter.com/share?url=" + encodeURIComponent(window.location.href) + "&amp;text=" + encodeURIComponent(title));
				jQuery(".sharing-icons-facebook").attr("href", "http://www.facebook.com/sharer.php?u=" + encodeURIComponent(window.location.href) + "&amp;t=" + encodeURIComponent(title));
				jQuery(".sharing-icons-googleplus").attr("href", "https://plus.google.com/share?url=" + encodeURIComponent(window.location.href));
			}

			recreateControls();
		}, 200); // We wait for CSS3 fade out animation to opacity=0 of .portfolio_box (inner container of portfolio) to complete
	}

	/**
	 * Recreates project controls based on currently viewed project and other settings
	 */
	function recreateControls(){
		// Unbind and show current controls
		jQuery('.portfolio-arrowright').unbind('click.nextproject');
		jQuery('.portfolio-arrowleft').unbind('click.prevproject');
		jQuery('.portfolio-arrowleft').addClass('portfolio-arrowleft-visible');
		jQuery('.portfolio-arrowright').addClass('portfolio-arrowright-visible');

		// Currently selected category ID (alternatively "all" or undefined)
		var selected_category_id = jQuery('#filters').find('li a.selected').attr('data-project-category-id');
		
		// Count number of projects
		var project_ids = projectsArray.length;
		
		// Stop if there's only one project available
		if(project_ids < 2){
			jQuery('.portfolio-arrowleft').removeClass('portfolio-arrowleft-visible');
			jQuery('.portfolio-arrowright').removeClass('portfolio-arrowright-visible');
			return;
		}
		
		// Current project, next and previous IDs
		var project_id_current = global_current_id;
		var project_id_previous = ((project_id_current - 1) < 0) ? (project_ids - 1) : (project_id_current - 1);
		var project_id_next = ((project_id_current + 1) >= project_ids) ? 0 : (project_id_current + 1);

		// Disable boundary arrows mode
		// @uses boundary_arrows (bool) global variable
		if(boundary_arrows){
			if((project_id_current - 1) < 0){
				jQuery('.portfolio-arrowleft').removeClass('portfolio-arrowleft-visible');
			}
			if((project_id_current + 1) >= project_ids){
				jQuery('.portfolio-arrowright').removeClass('portfolio-arrowright-visible');
			}
		}

		// Browse in selected category mode
		// @uses loop_through (bool) global variable
		if(loop_through){ 
			var prevProjects = []; // Previous projects from selected category
			var nextProjects = []; // Next projects from selected category
			var prev_project_arrow = []; // (int|array) - ID of the previous arrow, empty array otherwise
			var next_project_arrow = []; // (int|array) - ID of the next arrow, empty array otherwise
			
			if(selected_category_id == 'all' || selected_category_id === undefined){
				prev_project_arrow[0] = project_id_previous;
				next_project_arrow[0] = project_id_next;
			}else{
				for(var i = 0; i < (projectsArray.length - (projectsArray.length - project_id_current)); i++){
					if(projectsArray[i][9].indexOf(parseInt(selected_category_id)) != -1){
						prevProjects[prevProjects.length] = i; // All previous projects from selected category
					}
				}
				for(var i = (project_id_current + 1); i < projectsArray.length; i++){
					if(projectsArray[i][9].indexOf(parseInt(selected_category_id)) != -1){
						nextProjects[nextProjects.length] = i; // All next projects from selected category
					}
				}
				
				var prev_project_arrow = prevProjects.slice(-1); // One previous project from selected category
				var next_project_arrow = nextProjects.slice(0, 1); // One next project from selected category

				if(prevProjects.length != 0){
					jQuery('.portfolio-arrowleft').attr('href', projectsArray[prev_project_arrow[0]][7]);
				}else{
					jQuery('.portfolio-arrowleft').removeClass('portfolio-arrowleft-visible');
				}
				if(nextProjects.length != 0){
					jQuery('.portfolio-arrowright').attr('href', projectsArray[next_project_arrow[0]][7]);
				}else{
					jQuery('.portfolio-arrowright').removeClass('portfolio-arrowright-visible');
				}
			}
			
			var project_id_previous = prev_project_arrow[0];
			var project_id_next = next_project_arrow[0];
		}
		
		if(projectsArray[project_id_previous] !== undefined){
			jQuery('.portfolio-arrowleft').attr('href', projectsArray[project_id_previous][7]);
		}
		if(projectsArray[project_id_next] !== undefined){
			jQuery('.portfolio-arrowright').attr('href', projectsArray[project_id_next][7]);
		}
		
		// Left Arrow
		jQuery('.portfolio-arrowleft').on('click.prevproject', function(e){
			if(!jQuery('body').hasClass('page-refresh')){
				e.preventDefault();
				bringPortfolio( project_id_previous );
			}
			return;
		});
		
		// Right Arrow
		jQuery('.portfolio-arrowright').on('click.nextproject', function(e){
			if(!jQuery('body').hasClass('page-refresh')){
				e.preventDefault();
				bringPortfolio( project_id_next );
			}
			return;
		});
	}

	function closePortfolioItem(){
		global_current_id = false;
		jQuery('.portfolio_box').removeClass('portfolio_box-visible');
		jQuery('body').removeClass('daisho-portfolio-viewing-project');
		jQuery('.compact-nav').removeClass('compact-nav-visible');
		jQuery('.project-coverslide').removeClass('project-coverslide-visible');
		
		jQuery('.portfolio-arrowright').removeClass('portfolio-arrowright-visible');
		jQuery('.portfolio-arrowleft').removeClass('portfolio-arrowleft-visible');
		
		jQuery('.project-slides').empty();
		jQuery('title').html(portfolio_page_title);
	}

	jQuery(document).ready(function(){
		jQuery('.back').on('click', function(e){

			// If button is supposed to redirect to some external URL prevent any other action
			if(jQuery(this).hasClass('back-link-external') || jQuery('body').hasClass('single-portfolio')){
				return;
			}
			
			e.preventDefault();
			closePortfolioItem();
			if(Modernizr.history){
				window.history.pushState({}, portfolio_page_title, portfolio_page_url);
				initialURL = false;
			}
		});

		// Uncomment to enable a feature that closes the project on background click
		/* jQuery(document).on('click', '.project-coverslide', function(){
			closePortfolioItem();
		}); */
		
		// Uncomment to enable a feature that closes the project on escape key hit
		/* $(document).on('keyup' function(event){
			if(event.keyCode == 27){
				closePortfolioItem();
			}
		}); */
	});

	window.onpopstate = function(ev){
		if(jQuery('body').hasClass('page-refresh')){
			return;
		}
		var evstate = (ev.state) ? ev.state : {};

		// Ignore initial onpopstate in Chrome and Safari
		if(location.href == initialURL){
			initialURL = false;
			return;
		}
		initialURL = false;
		
		if(!evstate.cancelback){
			if(window.location.hash){
				return;
			}
			if(jQuery('body').hasClass('single-portfolio')){
				location.href = jQuery('.back').attr('href');
			}else{
				closePortfolioItem();
			}
		}else{
			if(ev.state.projid || ev.state.projid == 0){
				bringPortfolio(ev.state.projid);
			}
		}
	}
	
	function columnWidth($container){
		var w = $container.width(),
		    columnWidth = 220;
		
		if (w <= 442) {
			var columnWidth = 144;
		}
		
		return columnWidth;
	}
	
	function gutterWidth($container){
		var w = $container.width(),
		    gutterWidth = 5;
		
		if (w <= 442) {
			var gutterWidth = 3;
		}
		
		return gutterWidth;
	}

	jQuery(document).ready(function(){
		
		var $container = jQuery('#container');
		
		if(!$container.length){
			return;
		}
		
		// Uncomment to enable Infinite Scroll for Isotope
		/* if ( 'infinitescroll' in $container ) {
			if ( jQuery('.paging-navigation').length > 0 && jQuery('.paging-navigation .nav-previous a').length > 0 ) {
				$container.addClass('infinite-scrolling');
				$container.infinitescroll({
					navSelector: '.paging-navigation', // selector for the paged navigation 
					nextSelector: '.paging-navigation .nav-previous a', // selector for the NEXT link (to page 2)
					itemSelector: '.element', // selector for all items you'll retrieve
					loading: {
						msgText: '',
						finishedMsg: '',
						img: 'data:image/gif;base64,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',
						speed: 'fast',
					},
					bufferPx: 40,
					prefill: true
				},
				// call Isotope as a callback
				function( newElements ) {
					$container.isotope( 'appended', jQuery( newElements ) );
					centerIsotopeImagesOnLoad();
					setTimeout(function(){
						centerIsotopeImages();
					}, 3000);
				});
			}
		} */
		
		if(jQuery('body').hasClass('single-portfolio')){
			recreateControls();
		}
		
		/* $container.isotope({
			itemSelector : '.element',
			isOriginLeft: !(jQuery('body').hasClass('rtl')),
			masonry : {
				columnWidth: 220,
				gutter: 5,
			},
			transitionDuration: '0.8s'
		}); */
		
		$container.isotope({
			itemSelector: '.element',
			isOriginLeft: !($('body').hasClass('rtl')),
			masonry: {
				//columnWidth: 220,
				columnWidth: columnWidth($container),
				gutter: gutterWidth($container)
			},
			transitionDuration: '0.8s'
		});
		
		var updateIsotope = function(){
			$container.isotope({
				itemSelector: '.item',
				isOriginLeft: !($('body').hasClass('rtl')),
				masonry: {
					//columnWidth: 220,
					columnWidth: columnWidth($container),
					gutter: gutterWidth($container)
				},
				transitionDuration: '0.8s'
			});
			//$container.find('.item').addClass('no-transition');
			//$container.isotope( 'on', 'layoutComplete', function( isoInstance, laidOutItems ) {
				//$container.find('.item').removeClass('no-transition');
			//});
		};
		
		$(window).resize(updateIsotope);

		var $optionSets = jQuery('#options .option-set'),
		$optionLinks = $optionSets.find('a');
		$optionLinks.click(function(){
			var $this = jQuery(this);
			// don't proceed if already selected
			if ( $this.hasClass('selected') ) {
				return false;
			}
			var $optionSet = $this.parents('.option-set');
			$optionSet.find('.selected').removeClass('selected');
			$this.addClass('selected');

			// make option object dynamically, i.e. { filter: '.my-filter-class' }
			var options = {},
				key = $optionSet.attr('data-option-key'),
				value = $this.attr('data-option-value');
			// parse 'false' as false boolean
			value = value === 'false' ? false : value;
			options[ key ] = value;

			$container.isotope( options );

			return false;
		});

		$container.on('click', '.element', function(){
			
			// Exclude external link thumbnails
			if(jQuery(this).find('.thumbnail-link').length != 0){
				return;
			}
			
			// Don't run JavaScript if user wants to open projects with page refresh
			if(jQuery('body').hasClass('page-refresh')){
				return;
			}
			
			var current_id = parseInt( jQuery(this).attr('data-id'), 10 );
			bringPortfolio(current_id);
		});
		
		// Exclude '#' link thumbnails
		$container.on('click', '.element .thumbnail-link', function(event){
			console.log("$(this).attr('href')", $(this).attr('href'));
			if($(this).attr('href') == '#'){
				event.preventDefault();
			}
		});
		
		// Prevent thumbnail links from working unless they are external links.
		$container.on('click', '.thumbnail-project-link', function(e){
		
			// Don't run JavaScript if user wants to open projects with page refresh
			if(jQuery('body').hasClass('page-refresh')){
				return;
			}
			e.preventDefault();
		});

		// Toggle variable sizes of all elements
		jQuery('#toggle-sizes').find('a').click(function(){
			if(jQuery(this).hasClass('toggle-selected')){
				return false;
			}
			jQuery('#toggle-sizes').find('a').removeClass('toggle-selected');
			jQuery(this).addClass('toggle-selected');
			$container.toggleClass('variable-sizes').isotope('layout');
			centerIsotopeImages();
			return false;
		});

		// Shuffle button
		jQuery('#shuffle a').click(function(){
			$container.isotope('shuffle');
			return false;
		});
	});

	/**
	 * Center images inside Isotope's thumbnails.
	 */
	function centerIsotopeImages(){
		jQuery('.element').each(function(){
			var $this = jQuery(this);

			if($this.find('img')[0] === undefined){
				return;
			}
			
			var imageNode = $this.find('img')[0];
			var imageNaturalWidth = imageNode.naturalWidth;
			var imageNaturalHeight = imageNode.naturalHeight;
			var containerRatio = $this.width() / $this.height();
			var imageRatio = imageNaturalWidth / imageNaturalHeight;
			
			if(containerRatio <= imageRatio){
				var imageWidth = $this.height() * imageNaturalWidth / imageNaturalHeight;
				$this.find('img').css({ 'width' : 'auto', 'height' : '100%', 'top' : 0 }).css({ 'left': -( ( imageWidth - $this.width() ) / 2 ) });
				$this.find('img').addClass('project-img-visible');
			}else{
				var imageHeight = $this.width() * imageNaturalHeight / imageNaturalWidth;
				$this.find('img').css({ 'width' : '100%', 'height' : 'auto', 'left' : 0 }).css({ 'top': -( ( imageHeight - $this.height() ) / 2 ) });
				$this.find('img').addClass('project-img-visible');
			}
		});
	}

	function centerIsotopeImagesOnLoad() {
		jQuery('.project-img').one('load', function(){
			var $this = jQuery(this);
			var cont_ratio = $this.parent().width() / $this.parent().height();
			var img_ratio = $this.get(0).width / $this.get(0).height;

			if(cont_ratio <= img_ratio){
				$this.css({ 'width' : 'auto', 'height' : '100%', 'top' : 0 }).css({ 'left' : ~(($this.width()-$this.parent().width())/2)+1 });
				$this.addClass('project-img-visible');
			}else{
				$this.css({ 'width' : '100%', 'height' : 'auto', 'left' : 0 }).css({ 'top' : ~(($this.height()-$this.parent().height())/2)+1 });
				$this.addClass('project-img-visible');
			}
		});
	}

	jQuery(window).load(function(){
		centerIsotopeImages();
	});

	jQuery(document).ready(function(){
		// Center images inside thumbnails on window resize
		jQuery(window).bind('resize.centerIsotopeImages', function(){
			centerIsotopeImages();
		});
		centerIsotopeImagesOnLoad();
	});

	// Uncomment to enable unique URLs for portfolio categories
	/* jQuery(window).bind('hashchange', function(event){
		var hashOptions = jQuery.deparam.fragment();
		jQuery('#filters li a').removeClass('selected');
		jQuery('[data-option-value="' + hashOptions.filter + '"]').addClass('selected');
		jQuery('#container').isotope(hashOptions);
	}).trigger('hashchange'); */

} )( jQuery );

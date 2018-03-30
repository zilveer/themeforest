/* 
* cherry V1.0.3
* Copyright 2011, Dave Gamache
* www.getcherry.com
* Free to use under the MIT license.
* http://www.opensource.org/licenses/mit-license.php
* 7/17/2011
*/	

jQuery(document).ready(function($) {

		/* Superfish
	================================================== */
	$(function(){ // run after page loads
		$('#navigation ul.menu')
		.find('li.current_page_item,li.current_page_parent,li.current_page_ancestor,li.current-cat,li.current-cat-parent,li.current-menu-item')
			.addClass('active')
			.end()
			.superfish({
				autoArrows	: true,
				 animationOpen:    {height:'show'},
				 animationClose:   {height:'hide'},
				 delay:        200,
				 speed:        200
				});
	});
	
		/* FitVids
	================================================== */
	$(".container").fitVids();
	
		/* prettyPhoto
	================================================== */
	$("a[data-rel^='prettyPhoto']").prettyPhoto({
			hook: 'data-rel',
			theme: 'pp_default', /* light_rounded / dark_rounded / light_square / dark_square / facebook */
			social_tools: '<div class="pp_social"><div class="twitter"><a href="http://twitter.com/share" class="twitter-share-button" data-count="none">Tweet</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script></div><div class="facebook"><iframe src="http://www.facebook.com/plugins/like.php?locale=en_US&href='+location.href+'&amp;layout=button_count&amp;show_faces=true&amp;width=500&amp;action=like&amp;font&amp;colorscheme=light&amp;height=25" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:500px; height:25px;" allowTransparency="true"></iframe></div></div>'
		});
	
		/* Responsive menu
	================================================== */
		
	$('.menu-header .menu').mobileMenu({
		defaultText: 'Navigate to...',
		className: 'select-menu',
		subMenuDash: '&ndash;'
	});	 
	

		/* Porfolio home carousel
	================================================== */
	$(function() {
		//	Scrolled by user interaction
		$('.home-carousel').carouFredSel({
			auto: false,
			responsive: true,
			items		: {
				width		: 200,
				visible		: {
					min			: 2,
					max			: 3
				}
			},
			prev	: {	
				button	: "#home-carousel-nav-left",
				key		: "left"
			},
			next	: { 
				button	: "#home-carousel-nav-right",
				key		: "right"
			},
			swipe: {
				onMouse: true,
				onTouch: true
			}
		});
	});
	
		/* Sponsors home carousel
	================================================== */
	$(function() {
		//	Scrolled by user interaction
		$('.home-carousel-sponsors').carouFredSel({
			auto: false,
			responsive: true,
			items		: {
				width		: 140,
				visible		: {
					min			: 1,
					max			: 5
				}
			},
			prev	: {	
				button	: "#home-carousel-sponsors-nav-left",
				key		: "left"
			},
			next	: { 
				button	: "#home-carousel-sponsors-nav-right",
				key		: "right"
			},
			swipe: {
				onMouse: true,
				onTouch: true
			}
		}).parent().css("margin", "auto");
	});

	
		/* Porfolio inner carousel
	================================================== */
	
	$(function () {
		$(".inner-portfolio-carousel").responsiveSlides({
        auto: false,
        pager: false,
        nav: true,
        speed: 500,
        namespace: "centered-btns"
      });
	});
	
		/* Porfolio isotope init
	================================================== */
	$(window).load(function(){

    var $container = $('.portfolio-wrapper.master.filterable ul'),
        filters = {};
	
	$container.imagesLoaded( function(){	
		$container.isotope({
		  itemSelector : '.element',
		  transformsEnabled: true
		});
	});

    // filter buttons
    $('.filter a').click(function(){
      var $this = $(this);
      // don't proceed if already selected
      if ( $this.hasClass('selected') ) {
        return;
      }
      
      var $optionSet = $this.parents('.option-set');
      // change selected class
      $optionSet.find('.selected').removeClass('selected');
      $this.addClass('selected');
      
      // store filter value in object
      // i.e. filters.color = 'red'
      var group = $optionSet.attr('data-filter-group');
      filters[ group ] = $this.attr('data-filter-value');
      // convert object into array
      var isoFilters = [];
      for ( var prop in filters ) {
        isoFilters.push( filters[ prop ] )
      }
      var selector = isoFilters.join('');
      $container.isotope({ filter: selector });

      return false;
    });

  });


	// Style Tags
	
	$(function(){ // run after page loads
		$('p.tags a')
		.wrap('<span class="st_tag" />');
	});
	
	// valid XHTML method of target_blank
	$(function(){ // run after page loads
		$('a[rel*=external]').click( function() {
			window.open(this.href);
			return false;
		});
	});
});
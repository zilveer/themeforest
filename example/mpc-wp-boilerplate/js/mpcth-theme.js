/*-----------------------------------------------------------------------------------*/
/*	Custom Theme JS
/*-----------------------------------------------------------------------------------*/

jQuery.noConflict();
jQuery(document).ready(function($) {

/*-----------------------------------------------------------------------------------*/
/*	Responsive Menu
/*-----------------------------------------------------------------------------------*/

	if($('#mpcth_page_header_content').find('#mpcth_logo').length == 0)
		$('#mpcth_logo').clone().appendTo('#mpcth_page_header_content').addClass('mpcth-hidden-desktop');

	// Create the dropdown base
	$('<div id="mpcth_mobile_nav" class="mpcth-hidden-desktop"><select id="mpcth-nav-select-menu"/><span class="mpcth-nav-select-mockup"><span class="mpcth-corner-tl"></span><span class="mpcth-corner-tr"></span><span class="mpcth-corner-bl"></span><span class="mpcth-corner-br"></span><span class="mpcth-nav-select-border-left mpcth-sc-icon-menu"></span></span></div>').appendTo('#mpcth_page_header_content');

	// Populate dropdown with menu items
	$('<option />', {
		'value' 	: '#',
		'text' 		: 'Menu'
	}).appendTo('#mpcth-nav-select-menu');

	$('#mpcth_nav a').each(function() {
		var el = $(this);
		var level = el.parents('li').length * 2 - 2;

		$('<option />', {
			'value' 	: el.attr('href'),
			'text' 		: ('- - - - - - - - - - - - ').substr(0, level) + el.text()
		}).appendTo('#mpcth-nav-select-menu');
	});

	$('#mpcth-nav-select-menu').find('option').each( function(){
		var $this = $(this);
		if($(location).attr('href') == $this.val()){
			$this.attr('selected', 'selected');
		}
	});

	$("#mpcth-nav-select-menu").change(function() {
		window.location = $(this).find("option:selected").val();
	});

/* ---------------------------------------------------------------- */
/* Add Vector Icons To Flexslider
/* ---------------------------------------------------------------- */

	$(window).load(function() {
		$('.flexslider .flex-next, .nivoSlider .nivo-nextNav').append('<span></span>');
		$('.flexslider .flex-prev, .nivoSlider .nivo-prevNav').append('<span></span>');

		$('#mpcth_sidebar li.widget').append('<span class="mpcth-corner-tl"></span><span class="mpcth-corner-tr"></span><span class="mpcth-corner-bl"></span><span class="mpcth-corner-br"></span>');

		$('.wpb_accordion_wrapper .ui-accordion-header a').addClass('mpcth-sc-icon-empty');
		$('.wpb_toggle').addClass('mpcth-sc-icon-empty');

		updateSidebar();
	})

/* ---------------------------------------------------------------- */
/* Add '+' to Main Menu dropdowns
/* ---------------------------------------------------------------- */

	$menuItems = $('#mpcth_nav .parent_menu_item > a');
	$menuItems.each(function() {
	  $this = $(this);
	  $this.append(' <span class="mpcth-menu-plus">+</span>');
	})

/* ---------------------------------------------------------------- */
/* Other
/* ---------------------------------------------------------------- */

	$('#mpcth_sidebar')
		.hide()
		.css('visibility', 'visible');

	function updateSidebar() {
		var $container = $('#mpcth_page_container'),
			$sidebar = $('#mpcth_sidebar');

		if($container.is('.mpcth-sidebar-right') && $container.find('.mpcth-filterable-categories').length) {
			var $window = $(window),
				$categories = $container.find('.mpcth-filterable-categories'),
				windowW;

			function resizeUpdates() {
				windowW = $window.width();

				if(windowW >= 768) {
					$sidebar.css({
						'top': $categories.height(),
						'margin-top': 28
					});
				} else {
					$sidebar.css({
						'top': 0,
						'margin-top': 0
					});
				}
			}

			resizeUpdates();
			$window.on('resize', resizeUpdates);
		}

		$sidebar.fadeIn();
	}

/* ---------------------------------------------------------------- */
/* IE Flash z-index fix
/* ---------------------------------------------------------------- */
	if($('html').is('.ie'))
		$('iframe[src*=youtube]').each(function() {
			var $this = $(this);

			$this.attr('src', $this.attr('src') + '&wmode=opaque');
		});
});
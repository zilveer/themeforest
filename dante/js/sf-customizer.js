/*
*
*	Live Customiser Script
*	------------------------------------------------
*	Swift Framework
* 	Copyright Swift Ideas 2016 - http://www.swiftideas.net
*
*/
( function( $ ){		
	
	// MAIN STYLING
	
	wp.customize('accent_color',function( value ) {
		value.bind(function(to) {
			$('.recent-post figure,span.highlighted,span.dropcap4,.flickr-widget li,.portfolio-grid li,.wpcf7 input.wpcf7-submit[type="submit"],.woocommerce-page nav.woocommerce-pagination ul li span.current,.woocommerce nav.woocommerce-pagination ul li span.current,figcaption .product-added,.woocommerce .wc-new-badge,.yith-wcwl-wishlistexistsbrowse a,.yith-wcwl-wishlistaddedbrowse a,.woocommerce .widget_layered_nav ul li.chosen > *,.woocommerce .widget_layered_nav_filters ul li a,.sticky-post-icon,figure.animated-overlay figcaption,.sf-button.accent,.sf-button.sf-icon-reveal.accent,.progress .bar,.sf-icon-box-animated .back,.labelled-pricing-table .column-highlight .lpt-button-wrap a.accent,.progress.standard .bar,.woocommerce .order-info,.woocommerce .order-info mark,.slideout-filter ul li.selected a,.blog-aux-options li.selected a').css('background-color', to ? to : '' );
			$('#copyright a,.portfolio-item .portfolio-item-permalink,.read-more-link,.blog-item .read-more,.blog-item-details a,.author-link,.comment-meta .edit-link a,.comment-meta .comment-reply a,#reply-title small a,ul.member-contact,ul.member-contact li a,span.dropcap2,.spb_divider.go_to_top a,.love-it-wrapper .loved,.comments-likes .loved span.love-count,#header-translation p a,.caption-details-inner .details span > a,.caption-details-inner .chart span,.caption-details-inner .chart i,#swift-slider .flex-caption-large .chart i,.woocommerce .star-rating span,.sf-super-search .search-options .ss-dropdown > span,.sf-super-search .search-options input,.sf-super-search .search-options .ss-dropdown ul li .fa-check,#swift-slider .flex-caption-large .loveit-chart span,#swift-slider .flex-caption-large a,.progress-bar-wrap .progress-value').css('color', to ? to : '' );
			$('.bypostauthor .comment-wrap .comment-avatar,a[rel="tooltip"],.sf-icon-box-animated .back').css('border-color', to ? to : '' );
			$('.spb_impact_text .spb_call_text').css('border-left-color', to ? to : '' );
			$('.sf-super-search .search-options .ss-dropdown > span,.sf-super-search .search-options input').css('border-bottom-color', to ? to : '' );
		});
	});
	
	wp.customize('accent_alt_color',function( value ) {
		value.bind(function(to) {
			$('.recent-post figure,span.highlighted,span.dropcap4,.flickr-widget li,.portfolio-grid li,.wpcf7 input.wpcf7-submit[type="submit"],.woocommerce-page nav.woocommerce-pagination ul li span.current,.woocommerce nav.woocommerce-pagination ul li span.current,figcaption .product-added,.woocommerce .wc-new-badge,.yith-wcwl-wishlistexistsbrowse a,.yith-wcwl-wishlistaddedbrowse a,.woocommerce .widget_layered_nav ul li.chosen > *,.woocommerce .widget_layered_nav_filters ul li a,.sticky-post-icon,figure.animated-overlay figcaption .thumb-info h4,figure.animated-overlay figcaption .thumb-info h5,.slideout-filter ul li a,.slideout-filter ul li.selected a,.blog-aux-options li.selected a,.sf-button.accent,.sf-button.sf-icon-reveal.accent,.sf-icon-box-animated .back,.sf-icon-box-animated .back h3,.woocommerce-page nav.woocommerce-pagination ul li span.current,.woocommerce nav.woocommerce-pagination ul li span.current,li.product figcaption a.product-added,.woocommerce .order-info,.woocommerce .order-info mark').css('color', to ? to : '' );
		});
	});
	
	wp.customize('secondary_accent_color',function( value ) {
		value.bind(function(to) {
			$('.related-item figure,article.type-post #respond .form-submit input#submit,.show-menu,.flexslider ul.slides,.loved-item .loved-count,.subscribers-list li > a.social-circle').css('background-color', to ? to : '' );
			$('#top-bar .show-menu,#swift-slider .flex-caption .comment-chart i,#swift-slider .flex-caption .comment-chart span,.sidebar .widget_calendar tfoot a,.widget_sf_infocus_widget .infocus-item h5 a').css('color', to ? to : '' );
			$('#calendar_wrap caption').css('border-bottom-color', to ? to : '' );
		});
	});
	
	wp.customize('secondary_accent_alt_color',function( value ) {
		value.bind(function(to) {
			$('.show-menu,#swift-slider .flex-caption-large,#swift-slider .flex-caption-large h1 a,#swift-slider .flex-caption-large .comment-chart i,.loved-item .loved-count,.subscribers-list li > a.social-circle,.sidebar .widget_calendar tbody tr > td a').css('color', to ? to : '' );
		});
	});
	
	// PAGE STYLING
	
	wp.customize('page_bg_color',function( value ) {
		value.bind(function(to) {
			$('body').css('background-color', to ? to : '' );
		});
	});
	wp.customize('inner_page_bg_color',function( value ) {
		value.bind(function(to) {
			$('#main-container').css('background-color', to ? to : '' );
		});
	});
	wp.customize('section_divide_color',function( value ) {
		value.bind(function(to) {
			$('.minimal .spb_accordion_section,.minimal .spb_accordion_section:first-child,.spb_accordion.standard .spb_accordion_section,.spb_accordion.standard .spb_accordion_section h3.ui-state-active,.spb_divider,.spb_divider.go_to_top_icon1,.spb_divider.go_to_top_icon2,.testimonials > li,.jobs > li,.spb_impact_text,.tm-toggle-button-wrap,.tm-toggle-button-wrap a,.portfolio-details-wrap,.spb_divider.go_to_top a,blockquote.pullquote,.spb_box_text.whitestroke .box-content-wrap,.client-item figure,#footer,.pagination-wrap,.pagination-wrap li,.page-heading,.inner-page-wrap article,.inner-page-wrap .type-page,.inner-page-wrap .page-content,.inner-page-wrap .blog-listings,.pb-border-bottom,.pb-border-top,.sidebar .widget-heading h3,.widget ul li,.portfolio-item,.masonry-items .portfolio-item-details,.masonry-items .portfolio-item figure,.blog-item,.blog-item h1,.masonry-items .blog-item,.blog-item .spacer,.mini-items .blog-item-details,.author-info-wrap,.related-wrap').css('border-color', to ? to : '' );
		});
	});
	
	
	// HEADER STYLING
	wp.customize('topbar_bg_color',function( value ) {
		value.bind(function(to) {
			$('#top-bar').css('background-color', to ? to : '' );
		});
	});
	wp.customize('topbar_divider_color',function( value ) {
		value.bind(function(to) {
			$('#top-bar-date,#top-bar .menu li').css('border-color', to ? to : '' );
		});
	});
	wp.customize('topbar_text_color',function( value ) {
		value.bind(function(to) {
			$('#top-bar-date, #top-bar .menu li a').css('color', to ? to : '' );
		});
	});
	wp.customize('header_text_color',function( value ) {
		value.bind(function(to) {
			$('#header-section').css('color', to ? to : '' );
		});
	});
	
	
	// NAVIGATION STYLING
	
	wp.customize('nav_text_color',function( value ) {
		value.bind(function(to) {
			$('nav .menu li a,#menubar-controls a').css('color', to ? to : '' );
		});
	});
	wp.customize('nav_selected_text_color',function( value ) {
		value.bind(function(to) {
			$('nav .menu li.current-menu-ancestor > a, nav .menu li.current-menu-item > a').css('color', to ? to : '' );
		});
	});
	wp.customize('nav_pointer_color',function( value ) {
		value.bind(function(to) {
			$('#nav-pointer').css('background-color', to ? to : '' );
		});
	});
	wp.customize('nav_sm_bg_color',function( value ) {
		value.bind(function(to) {
			$('nav .menu ul').css('background-color', to ? to : '' );
		});
	});
	wp.customize('nav_sm_text_color',function( value ) {
		value.bind(function(to) {
			$('nav .menu ul li a').css('color', to ? to : '' );
		});
	});	
	wp.customize('nav_sm_selected_text_color',function( value ) {
		value.bind(function(to) {
			$('nav .menu ul li.current-menu-ancestor > a, nav .menu ul li.current-menu-item > a').css('color', to ? to : '' );
		});
	});
	wp.customize('nav_divider',function( value ) {
		value.bind(function(to) {
			$('nav .menu ul li').css('border-bottom-style', to ? to : '' );
		});
	});		
	wp.customize('nav_divider_color',function( value ) {
		value.bind(function(to) {
			$('nav .menu ul li').css('border-bottom-color', to ? to : '' );
			$('nav .menu ul').css('border-color', to ? to : '' );
		});
	});	
	
	
	// PAGE HEADING STYLING
	
	wp.customize('page_heading_bg_color',function( value ) {
		value.bind(function(to) {
			$('.page-heading').css('background-color', to ? to : '' );
		});
	});
	wp.customize('page_heading_text_color',function( value ) {
		value.bind(function(to) {
			$('.page-heading h1').css('color', to ? to : '' );
		});
	});
	wp.customize('breadcrumb_text_color',function( value ) {
		value.bind(function(to) {
			$('#breadcrumbs').css('color', to ? to : '' );
		});
	});
	wp.customize('breadcrumb_link_color',function( value ) {
		value.bind(function(to) {
			$('#breadcrumbs a,#breadcrumb i').css('color', to ? to : '' );
		});
	});
	
	
	// BODY STYLING
	
	wp.customize('body_color',function( value ) {
		value.bind(function(to) {
			$('body').css('color', to ? to : '' );
		});
	});
	wp.customize('h1_color',function( value ) {
		value.bind(function(to) {
			$('h1').css('color', to ? to : '' );
		});
	});
	wp.customize('h2_color',function( value ) {
		value.bind(function(to) {
			$('h2').css('color', to ? to : '' );
		});
	});
	wp.customize('h3_color',function( value ) {
		value.bind(function(to) {
			$('h3').css('color', to ? to : '' );
		});
	});
	wp.customize('h4_color',function( value ) {
		value.bind(function(to) {
			$('h4').css('color', to ? to : '' );
		});
	});
	wp.customize('h5_color',function( value ) {
		value.bind(function(to) {
			$('h5').css('color', to ? to : '' );
		});
	});
	wp.customize('h6_color',function( value ) {
		value.bind(function(to) {
			$('h6').css('color', to ? to : '' );
		});
	});
	wp.customize('impact_text_color',function( value ) {
		value.bind(function(to) {
			$('.spb_impact_text .spb_call_text,.impact-text,.impact-text-large').css('color', to ? to : '' );
		});
	});
	
	
	// SHORTCODES STYLING
	
	wp.customize('pt_primary_bg_color',function( value ) {
		value.bind(function(to) {
			$('.column-highlight .pricing-table-price').css('background-color', to ? to : '' );
			$('.column-highlight .pricing-table-price').css('border-bottom-color', to ? to : '' );
		});
	});
	wp.customize('pt_secondary_bg_color',function( value ) {
		value.bind(function(to) {
			$('.column-highlight .pricing-table-package').css('background-color', to ? to : '' );
		});
	});
	wp.customize('pt_tertiary_bg_color',function( value ) {
		value.bind(function(to) {
			$('.column-highlight .pricing-table-details').css('background-color', to ? to : '' );
		});
	});
	wp.customize('icon_container_bg_color',function( value ) {
		value.bind(function(to) {
			$('.sf-icon-cont').css('background-color', to ? to : '' );
		});
	});		
	wp.customize('sf_icon_color',function( value ) {
		value.bind(function(to) {
			$('.sf-icon').css('color', to ? to : '' );
		});
	});
		
	
	// FOOTER STYLING
	
	wp.customize('footer_bg_color',function( value ) {
		value.bind(function(to) {
			$('#footer').css('background-color', to ? to : '' );
		});
	});
	wp.customize('footer_text_color',function( value ) {
		value.bind(function(to) {
			$('#footer, #footer h5, #footer p').css('color', to ? to : '' );
		});
	});
	wp.customize('copyright_bg_color',function( value ) {
		value.bind(function(to) {
			$('#copyright').css('background-color', to ? to : '' );
		});
	});
	wp.customize('copyright_text_color',function( value ) {
		value.bind(function(to) {
			$('#copyright p').css('color', to ? to : '' );
		});
	});
	wp.customize('copyright_link_color',function( value ) {
		value.bind(function(to) {
			$('#copyright a').css('color', to ? to : '' );
		});
	});
	

	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '#site-title a' ).html( to );
		} );
	} );
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '#site-description' ).html( to );
		} );
	} );

} )( jQuery );
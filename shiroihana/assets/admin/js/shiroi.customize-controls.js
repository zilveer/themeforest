
(function( wp, $ ) {
	var api = wp.customize, 
		prefix = ( _shiroiCustomizeControls ? _shiroiCustomizeControls.prefix : '' ), 
		wrapId = function( id ) {
			return prefix + '[' + id + ']';
		};

	$( function() {

		$.each([
			{
				setting: 'color_scheme', 
				controls: [ 'body_bg', 'text_color', 'headings_color', 'base_border_color', 'dotted_border_color', 'base_box_bg', 'header_top_bg', 'header_top_text_color', 'header_top_link_hover_color', 'header_bg', 'menu_link_color', 'menu_link_hover_color', 'menu_submenu_bg', 'menu_submenu_link_color', 'menu_submenu_link_hover_color', 'footer_bg', 'footer_text_color', 'footer_link_color', 'footer_link_hover_color', 'footer_bottom_bg', 'widget_box_bg', 'widget_title_color', 'widget_title_border_color', 'widget_border_color', 'widget_footer_title_color', 'widget_footer_title_border_color', 'widget_footer_border_color' ], 
				callback: function( to ) { return 'custom' == to; }
			}, 
			{
				setting: 'featured_slider_enabled', 
				controls: [ 'featured_slider_overlap', 'featured_slider_animate_text', 'featured_slider_meta', 'featured_slider_transition', 'featured_slider_transition_duration', 'featured_slider_autoplay_timeout', 'featured_slider_limit', 'featured_slider_orderby', 'featured_slider_order' ], 
				callback: function( to ) { return !! to; }
			}, 
			{
				setting: 'blog_summary', 
				controls: 'blog_excerpt_length', 
				callback: function( to ) { return 'the_excerpt' == to; }
			}, 
			{
				setting: 'blog_sections', 
				controls: 'blog_related_posts_count', 
				callback: function( to ) { return $.inArray( 'related', to.values || [] ) > -1; }
			}, 
			{
				setting: 'blog_index_layout', 
				controls: 'blog_index_sidebar', 
				callback: function( to ) { return 'fullwidth' != to; }
			}, 
			{
				setting: 'blog_archive_layout', 
				controls: 'blog_archive_sidebar', 
				callback: function( to ) { return 'fullwidth' != to; }
			}, 
			{
				setting: 'blog_single_layout', 
				controls: 'blog_single_sidebar', 
				callback: function( to ) { return 'fullwidth' != to; }
			}, 
			{
				setting: 'blog_search_layout', 
				controls: 'blog_search_sidebar', 
				callback: function( to ) { return 'fullwidth' != to; }
			}
		], function( i, o ) {
			api( wrapId( o.setting ), function( setting ) {
				$.each( $.isArray( o.controls ) ? o.controls : [ o.controls ], function( j, controlId ) {
					api.control( wrapId( controlId ), function( control ) {
						var visibility = function( to ) {
							control.container.toggle( o.callback( to ) );
						};

						visibility( setting.get() );
						setting.bind( visibility );
					});
				});
			});
		});

	});

})( wp, jQuery );

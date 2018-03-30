<?php
/**
 * Enqueues styles for front-end.
 */
function st_theme_styles() {

	/*
	 * Loads our main stylesheet.
	 */
	wp_enqueue_style( 'theme-style', get_stylesheet_uri() );

	/*
	 * Loads our Google Font.
	 */
	 
	$subsets = 'latin,latin-ext';

		/* translators: To add an additional Open Sans character subset specific to your language, translate
		   this to 'greek', 'cyrillic' or 'vietnamese'. Do not translate into your own language. */
		$subset = _x( 'no-subset', 'Open Sans font: add new subset (greek, cyrillic, vietnamese)', 'twentytwelve' );

		if ( 'cyrillic' == $subset )
			$subsets .= ',cyrillic,cyrillic-ext';
		elseif ( 'greek' == $subset )
			$subsets .= ',greek,greek-ext';
		elseif ( 'vietnamese' == $subset )
			$subsets .= ',vietnamese';

		$protocol = is_ssl() ? 'https' : 'http';
		$query_args = array(
			'family' => 'Open+Sans:300,400,600,700',
			'subset' => $subsets,
		);
	wp_enqueue_style( 'theme-font', esc_url ( add_query_arg( $query_args, "$protocol://fonts.googleapis.com/css" )), array(), null );
	
	
	/*
	* Adds stylesheet for shortcodes
	* (will be mvoed to plugin soon)
	*/
	wp_enqueue_style( 'shortcodes', get_template_directory_uri() . '/framework/shortcodes/shortcodes.css' );
	
	
	/*
	* Load theme custom colors
	*/

	$st_styling_linkcolor = get_theme_mod( 'st_styling_linkcolor', '#E36F3C' );
	$st_styling_themecolor = get_theme_mod( 'st_styling_themecolor', '#86b854' );
	$st_to_custom_css = of_get_option('st_custom_css');
	$custom_css = " 
				
				a, 
				a:visited, 
				a:hover {
					color: {$st_styling_linkcolor};
				}
				
				button,
				input[type='reset'],
				input[type='submit'],
				input[type='button'],
				.pagination span,
				.paging-navigation .nav-previous a:hover, 
				.paging-navigation .nav-next a:hover, 
				.pagination a:hover,
				.widget_categories li span,
				.bbp-login-form .bbp-submit-wrapper,
				.bbp-pagination-links span,
				.kb-category-list h3 span.count,
				#page-header,
				.st_faq .entry-title.active .action,
				.st_faq .entry-title:hover .action {
				background:{$st_styling_themecolor};
				}
				$st_to_custom_css
				
				";
				
	wp_add_inline_style('theme-style',$custom_css);
		
	
}
add_action( 'wp_enqueue_scripts', 'st_theme_styles' );


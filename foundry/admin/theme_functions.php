<?php 

/**
 * WordPress' missing is_blog_page() function.  Determines if the currently viewed page is
 * one of the blog pages, including the blog home page, archive, category/tag, author, or single
 * post pages.
 *
 * @see http://core.trac.wordpress.org/browser/tags/3.4.1/wp-includes/query.php#L1572
 *
 * @return bool
 */
if(!( function_exists('is_blog_page') )){
	function is_blog_page() {
	    global $post;
	    return ( ( is_home() || is_archive() || is_single() ) && ('post' == get_post_type($post)) ) ? true : false ;
	}
}

/**
 * Filter oembed results to add responsive class
 */
if(!( function_exists('ebor_oembed_result') )){
	function ebor_oembed_result($html, $url, $args) {
		if( isset($args['class']) ){
			$html = str_replace( '<iframe', '<iframe class="'. $args['class'] .'" ', $html );
		}
			
	    return $html;
	}
	add_filter('oembed_result','ebor_oembed_result', 10, 3);
}

if(!( function_exists('ebor_icons_meta_field') )){
	function ebor_icons_meta_field( $field, $meta, $object_id, $object_type, $field_type_object ) {
		$icons = ebor_get_icons();
		echo '<a href="#" id="ebor-icon-toggle" class="button button-primary button-large">Show/Hide Icons</a><div class="ebor-icons"><div class="ebor-icons-wrapper">';
		foreach( $icons as $icon ){
			$active = ( $meta == $icon) ? ' active' : '';
			echo '<i class="icon '. $icon . $active .'" data-icon-class="'. $icon .'"></i>';
		}
		echo '</div>';
		echo htmlspecialchars_decode($field_type_object->input( array( 'type' => 'text' ) ));
		echo '</div>';
		if ( ! empty( $field->description ) ) echo '<p class="cmb_metabox_description">' . $field->description . '</p>';
	}
	add_filter( 'cmb2_render_ebor_icons_meta', 'ebor_icons_meta_field', 10, 5 );
}

if(!( function_exists('ebor_get_page_title') )){
	function ebor_get_page_title( $title = false, $subtitle = false, $icon = false, $image = false, $layout = 'left-short-grey' ){
		
		$output = false;
		
		if( 'left-short-light' == $layout ){
			$output = ebor_page_title( $title, false, $icon );	
		} elseif( 'left-short-grey' == $layout ){
			$output = ebor_page_title( $title, 'bg-secondary', $icon );	
		} elseif( 'left-short-dark' == $layout ){
			$output = ebor_page_title( $title, 'bg-dark', $icon );	
		} elseif( 'left-short-image' == $layout ) {
			$output = ebor_page_title( $title, 'image-bg overlay', $icon, $image );	
		} elseif( 'left-short-parallax' == $layout ) {
			$output = ebor_page_title( $title, 'image-bg overlay parallax', $icon, $image );	
		} elseif( 'left-large-light' == $layout ){
			$output = ebor_page_title_large( $title, $subtitle, false, $icon );	
		} elseif( 'left-large-grey' == $layout ){
			$output = ebor_page_title_large( $title, $subtitle, 'bg-secondary', $icon );	
		} elseif( 'left-large-dark' == $layout ){
			$output = ebor_page_title_large( $title, $subtitle, 'bg-dark', $icon );	
		} elseif( 'left-large-image' == $layout ){
			$output = ebor_page_title_large( $title, $subtitle, 'image-bg overlay', $icon, $image );	
		} elseif( 'left-large-parallax' == $layout ){
			$output = ebor_page_title_large( $title, $subtitle, 'image-bg overlay parallax', $icon, $image );	
		} elseif( 'center-short-light' == $layout ){
			$output = ebor_page_title_center( $title, false, $icon );	
		} elseif( 'center-short-grey' == $layout ){
			$output = ebor_page_title_center( $title, 'bg-secondary', $icon );	
		} elseif( 'center-short-dark' == $layout ){
			$output = ebor_page_title_center( $title, 'bg-dark', $icon );	
		} elseif( 'center-short-image' == $layout ) {
			$output = ebor_page_title_center( $title, 'image-bg overlay', $icon, $image );	
		} elseif( 'center-short-parallax' == $layout ) {
			$output = ebor_page_title_center( $title, 'image-bg overlay parallax', $icon, $image );	
		} elseif( 'center-large-light' == $layout ){
			$output = ebor_page_title_large_center( $title, $subtitle, false, $icon );	
		} elseif( 'center-large-grey' == $layout ){
			$output = ebor_page_title_large_center( $title, $subtitle, 'bg-secondary', $icon );	
		} elseif( 'center-large-dark' == $layout ){
			$output = ebor_page_title_large_center( $title, $subtitle, 'bg-dark', $icon );	
		} elseif( 'center-large-image' == $layout ){
			$output = ebor_page_title_large_center( $title, $subtitle, 'image-bg overlay', $icon, $image );	
		} elseif( 'center-large-parallax' == $layout ){
			$output = ebor_page_title_large_center( $title, $subtitle, 'image-bg overlay parallax', $icon, $image );	
		}
		
		return $output;
		
	}
}

if(!( function_exists('ebor_page_title') )){ 
	function ebor_page_title( $title = false, $background = false, $icon = false, $image = false ){
		
		if(!( '' == $icon || false == $icon || !(isset($icon)) )){
			$icon = "<i class='". $icon ."'></i>";
		}
		
		$output = '<section class="page-title page-title-4 '. esc_attr($background) .'">';
		
		if( $image ){
			$output .= '<div class="background-image-holder">'. $image .'</div>';	
		}
		
		$output .= '
				<div class="container">
				    <div class="row">
				    
				        <div class="col-md-6">
				            <h3 class="uppercase mb0">
				            	'. $icon .' '. $title .'
				            </h3>
				        </div>
				        
				        <div class="col-md-6 text-right">
				        	'. ebor_breadcrumbs() .'
				        </div>
				        
				    </div>
				</div>
			</section>
		';	
		
		return $output;
		
	}
}

if(!( function_exists('ebor_page_title_large') )){ 
	function ebor_page_title_large( $title = false, $subtitle, $background = false, $icon = false, $image = false ){
		
		if(!( '' == $icon || false == $icon || !(isset($icon)) )){
			$icon = "<i class='". $icon ."'></i>";
		}
		
		$output = '<section class="page-title page-title-2 '. esc_attr($background) .'">';
		
		if( $image ){
			$output .= '<div class="background-image-holder">'. $image .'</div>';	
		}
		
		$output .= '
				<div class="container">
				    <div class="row">
				    
				        <div class="col-md-6">
				        	<h2 class="uppercase mb8">'. $icon .' '. $title .'</h2>
				        	<p class="lead mb0">'. $subtitle .'</p>
				        </div>
				        
				        <div class="col-md-6 text-right">
				        	'. ebor_breadcrumbs() .'
				        </div>
				        
				    </div>
				</div>
			</section>
		';
		
		return $output;
		
	}
}

if(!( function_exists('ebor_page_title_center') )){ 
	function ebor_page_title_center( $title = false, $background = false, $icon = false, $image = false ){
		
		if(!( '' == $icon || false == $icon || !(isset($icon)) )){
			$icon = "<i class='". $icon ."'></i>";
		}
		
		$output = '<section class="page-title page-title-3 '. esc_attr($background) .'">';
		
		if( $image ){
			$output .= '<div class="background-image-holder">'. $image .'</div>';	
		}
		
		$output .= '
				<div class="container">
				    <div class="row">
				    
				        <div class="col-sm-12 text-center">
				            <h3 class="uppercase mb0">
				            	'. $icon .' '. $title .'
				            </h3>
				        </div>
				    </div>
				</div>
				'. ebor_breadcrumbs() .'
			</section>
		';	
		
		return $output;
		
	}
}

if(!( function_exists('ebor_page_title_large_center') )){ 
	function ebor_page_title_large_center( $title = false, $subtitle, $background = false, $icon = false, $image = false ){
		
		if(!( '' == $icon || false == $icon || !(isset($icon)) )){
			$icon = "<i class='". $icon ."'></i>";
		}
		
		$output = '<section class="page-title page-title-1 '. esc_attr($background) .'">';
		
		if( $image ){
			$output .= '<div class="background-image-holder">'. $image .'</div>';	
		}
		
		$output .= '
				<div class="container">
				    <div class="row">
				        <div class="col-sm-12 text-center">
				        	<h2 class="uppercase mb8">'. $icon .' '. $title .'</h2>
				        	<p class="lead mb0">'. $subtitle .'</p>
				        </div>
				    </div>
				</div>
				'. ebor_breadcrumbs() .'
			</section>
		';
		
		return $output;
		
	}
}

if(!( function_exists('ebor_breadcrumbs') )){ 
	function ebor_breadcrumbs() {
		if ( is_front_page() || is_search() ) {
			return;
		}
		global $post;
		
		$displays = get_option('ebor_framework_cpt_display_options');
		
		$post_type = get_post_type();
		$ancestors = array_reverse( get_post_ancestors( $post->ID ) );
		$before = '<ol class="breadcrumb breadcrumb-2">';
		$after = '</ol>';
		$home = '<li><a href="' . esc_url( home_url( "/" ) ) . '" class="home-link" rel="home">' . __( 'Home', 'foundry' ) . '</a></li>';
		
		if( 'portfolio' == $post_type ){
			$slug = ( $displays['portfolio_slug'] ) ? $displays['portfolio_slug'] : 'portfolio';
			$home .= '<li class="active"><a href="' . esc_url( home_url( "/". $slug ."/" ) ) . '">' . __( 'Portfolio', 'foundry' ) . '</a></li>';
		}
		
		if( 'team' == $post_type ){
			$slug = ( $displays['team_slug'] ) ? $displays['team_slug'] : 'team';
			$home .= '<li class="active"><a href="' . esc_url( home_url( "/". $slug ."/" ) ) . '">' . __( 'Team', 'foundry' ) . '</a></li>';
		}
		
		if( 'product' == $post_type && !(is_archive()) ){
			$home .= '<li class="active"><a href="' . esc_url( get_permalink( woocommerce_get_page_id( 'shop' ) ) ) . '">' . __( 'Shop', 'foundry' ) . '</a></li>';
		} elseif( 'product' == $post_type && is_archive() ) {
			$home .= '<li class="active">' . __( 'Shop', 'foundry' ) . '</li>';
		}
		
		$breadcrumb = '';
		if ( $ancestors ) {
			foreach ( $ancestors as $ancestor ) {
				$breadcrumb .= '<li><a href="' . esc_url( get_permalink( $ancestor ) ) . '">' . htmlspecialchars_decode( get_the_title( $ancestor ) ) . '</a></li>';
			}
		}
		
		if( is_blog_page() && is_single() ){
			$breadcrumb .= '<li><a href="' . esc_url( get_permalink( get_option( 'page_for_posts' ) ) ) . '">' . htmlspecialchars_decode( get_option('blog_title','Our Blog') ) . '</a></li><li class="active">' . htmlspecialchars_decode( get_the_title( $post->ID ) ) . '</li>';
		} elseif( is_blog_page() ){
			$breadcrumb .= '<li class="active">' . htmlspecialchars_decode( get_option('blog_title','Our Blog') ) . '</li>';
		} elseif( is_post_type_archive('product') || is_archive() ){		
			$breadcrumb .= '<li>' . htmlspecialchars_decode( single_cat_title('', false) ) . '</li>';		
		} else {
			$breadcrumb .= '<li class="active">' . htmlspecialchars_decode( get_the_title( $post->ID ) ) . '</li>';
		}
		
		if( 'team' == get_post_type() )
			rewind_posts();
		
		return $before . $home . $breadcrumb . $after;
	}
}

if(!( function_exists('ebor_allowed_tags') )){ 
	function ebor_allowed_tags(){
		return array(
		    'a' => array(
		        'href' => array(),
		        'title' => array(),
		        'class' => array(),
		        'target' => array()
		    ),
		    'br' => array(),
		    'em' => array(),
		    'strong' => array(),
		    'p' => array(
		    	'class' => array()
		    ),
		);	
	}
}

if(!( function_exists('ebor_header_social_items') )){ 
	function ebor_header_social_items(){
		
		$protocols = array('http', 'https', 'ftp', 'ftps', 'mailto', 'news', 'irc', 'gopher', 'nntp', 'feed', 'telnet', 'skype');
		$output = false;
		
		for( $i = 1; $i < 5; $i++ ){
			if( get_option("header_social_url_$i") ) {
				$output .= '<li>
					      <a href="' . esc_url(get_option("header_social_url_$i"), $protocols) . '" target="_blank">
						      <i class="' . get_option("header_social_icon_$i") . '"></i>
					      </a>
					  </li>';
			}
		} 
		
		return $output;	
		
	}
}

/**
 * Returns an array of all available portfolio options
 * 
 * @val array
 * @since 1.0.0
 * @package Foundry
 * @author TommusRhodus
 */
if(!( function_exists('ebor_get_portfolio_layouts') )){
	function ebor_get_portfolio_layouts(){
		return array(
			'Fullwidth Grid, 4 Columns' => 'full-grid-4col',
			'Fullwidth Grid, 3 Columns' => 'full-grid-3col',
			'Fullwidth Grid, 2 Columns' => 'full-grid-2col',
			'Grid, 2 Columns' => 'grid-2col',
			'Grid, 3 Columns' => 'grid-3col',
			'Grid, 4 Columns' => 'grid-4col',
			'Masonry, 2 Columns' => 'masonry-2col',
			'Masonry, 3 Columns' => 'masonry-3col',
			'Masonry, 4 Columns' => 'masonry-4col',
			'Fullwidth Masonry, 2 Columns' => 'full-masonry-2col',
			'Fullwidth Masonry, 3 Columns' => 'full-masonry-3col',
			'Fullwidth Masonry, 4 Columns' => 'full-masonry-4col',
			'Parallax Feed' => 'parallax',
			'Fullscreen Parallax Feed' => 'parallax-large',
			'Preview Grid, 2 Columns (e.g Foundry Demo Homepage)' => 'preview-2col',
			'Preview Grid, 3 Columns (e.g Foundry Demo Homepage)' => 'preview-3col',
			'Preview Grid, 4 Columns (e.g Foundry Demo Homepage)' => 'preview-4col',
			'Fullwidth Grid, 4 Columns, Static Titles' => 'full-grid-4col-no-hover',
			'Fullwidth Grid, 3 Columns, Static Titles' => 'full-grid-3col-no-hover',
			'Fullwidth Grid, 2 Columns, Static Titles' => 'full-grid-2col-no-hover',
			'Grid, 2 Columns, Static Titles' => 'grid-2col-no-hover',
			'Grid, 3 Columns, Static Titles' => 'grid-3col-no-hover',
			'Grid, 4 Columns, Static Titles' => 'grid-4col-no-hover',
			'Masonry, 2 Columns, Static Titles' => 'masonry-2col-no-hover',
			'Masonry, 3 Columns, Static Titles' => 'masonry-3col-no-hover',
			'Masonry, 4 Columns, Static Titles' => 'masonry-4col-no-hover',
			'Fullwidth Masonry, 2 Columns, Static Titles' => 'full-masonry-2col-no-hover',
			'Fullwidth Masonry, 3 Columns, Static Titles' => 'full-masonry-3col-no-hover',
			'Fullwidth Masonry, 4 Columns, Static Titles' => 'full-masonry-4col-no-hover',
			'Preview Grid, 2 Columns (e.g Foundry Demo Homepage), Static Titles' => 'preview-2col-no-hover',
			'Preview Grid, 3 Columns (e.g Foundry Demo Homepage), Static Titles' => 'preview-3col-no-hover',
			'Preview Grid, 4 Columns (e.g Foundry Demo Homepage), Static Titles' => 'preview-4col-no-hover'
		);	
	}
}

if(!( function_exists('ebor_get_team_layouts') )){
	function ebor_get_team_layouts(){
		return array(
			'Team Grid' => 'grid',
			'Small Team Grid (4 Column)' => 'grid-small',
			'Extra Small Team Grid (3 Column)' => 'grid-extra-small',
			'FullWidth Team' => 'full',
			'Team Feed' => 'feed',
			'Boxed Team' => 'box'
		);
	}
}

if(!( function_exists('ebor_get_blog_layouts') )){
	function ebor_get_blog_layouts(){
		return array(
			'Grid Blog, No Sidebar' => 'grid',
			'Grid Blog, Left Sidebar' => 'grid-sidebar-left',
			'Grid Blog, Right Sidebar' => 'grid-sidebar-right',
			'Simple Feed' => 'simple',
			'Blog Feed, Left Sidebar' => 'sidebar-left',
			'Blog Feed, Right Sidebar' => 'sidebar-right',
			'Blog Feed, No Sidebar' => 'listing',
			'Masonry Blog, Left Sidebar' => 'masonry-sidebar-left',
			'Masonry Blog, Right Sidebar' => 'masonry-sidebar-right',
			'Masonry Blog, 3 Columns' => 'masonry-3col',
			'Masonry Blog, 2 Columns' => 'masonry-2col',
			'Box Grid' => 'box',
			'Carousel' => 'carousel'
		);	
	}
}

/**
 * Returns an array of all available page title layout options
 * 
 * @val array
 * @since 1.0.0
 * @package Foundry
 * @author TommusRhodus
 */
if(!( function_exists('ebor_get_page_title_options') )){
	function ebor_get_page_title_options(){
		return array(
			'Left Align, Short, Grey Backround'                   => 'left-short-grey',
			'Left Align, Short, White Backround'                  => 'left-short-light',
			'Left Align, Short, Dark Backround'                   => 'left-short-dark',
			'Left Align, Short, Image Background'                 => 'left-short-image',
			'Left Align, Short, Parallax Image Background'        => 'left-short-parallax',
			'Left Align, Large, White Backround'                  => 'left-large-light',
			'Left Align, Large, Grey Backround'                   => 'left-large-grey',
			'Left Align, Large, Dark Backround'                   => 'left-large-dark',
			'Left Align, Large, Image Background'                 => 'left-large-image',
			'Left Align, Large, Parallax Image Background'        => 'left-large-parallax',
			'Center Align, Short, White Backround'                => 'center-short-light',
			'Center Align, Short, Grey Backround'                 => 'center-short-grey',
			'Center Align, Short, Dark Backround'                 => 'center-short-dark',
			'Center Align, Short, Image Background'               => 'center-short-image',
			'Center Align, Short, Parallax Image Background'      => 'center-short-parallax',
			'Center Align, Large, White Backround'                => 'center-large-light',
			'Center Align, Large, Grey Backround'                 => 'center-large-grey',
			'Center Align, Large, Dark Backround'                 => 'center-large-dark',
			'Center Align, Large, Image Background'               => 'center-large-image',
			'Center Align, Large, Parallax Image Background'      => 'center-large-parallax',
			'No Page Title'                                       => 'none'
		);	
	}
}

/**
 * Returns an array of all available header layouts
 * 
 * @val array
 * @since 1.0.0
 * @package Foundry
 * @author TommusRhodus
 */
if(!( function_exists('ebor_get_header_options') )){
	function ebor_get_header_options(){
		$options = array(
			'blank' => 'No Header or Nav',
			'bar' => 'Light Header',
			'bar-extended' => 'Light Header with Top Utility Bar',
			'bar-dark' => 'Dark Header',
			'bar-dark-extended' => 'Dark Header with Top Utility Bar',
			'bar-transparent' => 'Transparent Header',
			'bar-transparent-extended' => 'Transparent Header with Top Utility Bar',
			'bar-transparent-dark' => 'Transparent Header (Dark Text)',
			'bar-transparent-extended-dark' => 'Transparent Header with Top Utility Bar (Dark Text)',
			'offscreen' => 'Offscreen Header',
			'centered' => 'Centered Light Header',
			'centered-transparent' => 'Centered Transparent Header'
		);
		return $options;	
	}
}

if(!( function_exists('ebor_get_footer_options') )){
	function ebor_get_footer_options(){
		$options = array(
			'blank' => 'No Footer',
			'basic' => 'Basic Footer',
			'agency' => 'Agency Footer',
			'fitness' => 'Fitness Footer',
			'widgets' => 'Widgets Footer (Default)',
			'basic-light' => 'Basic Footer (Light)',
			'agency-light' => 'Agency Footer (Light)',
			'fitness-light' => 'Fitness Footer (Light)',
			'widgets-light' => 'Widgets Footer (Light)'
		);
		return $options;	
	}
}

/**
 * ebor_get_footer_layout
 * 
 * Use to conditionally check the page footer meta layout against the theme option for the same
 * In short, this function can override the global footer option on a post by post basis
 * Call within get_footer() for this to override the global footer choice
 * 
 * @since 1.0.0
 * @author tommusrhodus
 */
if(!( function_exists('ebor_get_footer_layout') )){
	function ebor_get_footer_layout(){
		global $post;
		
		if(!( isset($post->ID) ))
			return get_option('footer_layout', 'widgets');
			
		$footer = get_post_meta($post->ID, '_ebor_footer_override', 1);
		if( '' == $footer || false == $footer || 'none' == $footer ){
			$footer = get_option('footer_layout', 'widgets');
		}
		return $footer;	
	}
}

/**
 * ebor_get_header_layout
 * 
 * Use to conditionally check the page header meta layout against the theme option for the same
 * In short, this function can override the global header option on a post by post basis
 * Call within get_header() for this to override the global header choice
 * 
 * @since 1.0.0
 * @author tommusrhodus
 */
if(!( function_exists('ebor_get_header_layout') )){
	function ebor_get_header_layout(){
		global $post;
		
		if( is_search() || !( isset($post->ID) ) )
			return get_option('header_layout', 'bar-extended');
		
		$header = get_post_meta($post->ID, '_ebor_header_override', 1);
		if( '' == $header || false == $header || 'none' == $header ){
			$header = get_option('header_layout', 'bar-extended');
		}
		
		return $header;	
	}
}

/**
 * Portfolio Unlimited
 * Uses pre_get_posts to provide unlimited portfolio posts when viewing the /portfolio/ archive
 * @since 1.0.0
 */
if(!(function_exists( 'ebor_portfolio_unlimited' ))){
	function ebor_portfolio_unlimited( $query ) {
	    if ( 
	    	is_post_type_archive('portfolio') && !( is_admin() ) && $query->is_main_query() ||
	    	is_tax('portfolio_category') && !( is_admin() ) && $query->is_main_query()
	    ) {
	        $query->set( 'posts_per_page', '-1' );
	    }    
	    return;
	}
	add_action( 'pre_get_posts', 'ebor_portfolio_unlimited' );
}

/**
 * Init theme options
 * Certain theme options need to be written to the database as soon as the theme is installed.
 * This is either for the enqueues in ebor-framework, or to override the default image sizes in WooCommerce.
 * Either way this function is only called when the theme is first activated, de-activating and re-activating the theme will result in these options returning to defaults.
 * 
 * @since 1.0.0
 * @author tommusrhodus
 */
if(!( function_exists('ebor_init_theme_options') )){
	
	/**
	 * Hook in on activation
	 */
	global $pagenow;
	
	/**
	 * Define image sizes
	 */
	function ebor_init_theme_options() {
		
		//Set all options to zero before initialising options for this theme
		$existing_options = get_option('ebor_framework_options');
		if( is_array($existing_options) ){
			foreach ($existing_options as $key => $value) {
				$existing_options[$key] = '0';
			}
			update_option('ebor_framework_options', $existing_options);
		}
		
		//Ebor Framework
		$framework_args = array(
			'portfolio_post_type'   => '1',
			'team_post_type'        => '1',
			'client_post_type'      => '1',
			'testimonial_post_type' => '1',
			'mega_menu'             => '1',
			'aq_resizer'            => '0',
			'page_builder'          => '0',
			'likes'                 => '0',
			'options'               => '1',
			'metaboxes'             => '1',
			'pivot_shortcodes'      => '0',
			'foundry_shortcodes'    => '1',
			'foundry_widgets'       => '1'
		);
		
		update_option('ebor_framework_options', $framework_args);
		
	}
	
	/**
	 * Only call this action when we first activate the theme.
	 */
	if ( 
		is_admin() && isset( $_GET['activated'] ) && $pagenow == 'themes.php' ||
		is_admin() && isset( $_GET['theme'] ) && $pagenow == 'customize.php'
	){
		add_action( 'after_setup_theme', 'ebor_init_theme_options', 1 );
	}
	
}

/**
 * Register the required plugins for this theme.
 * 
 * @since 1.0.0
 * @author tommusrhodus
 */
if(!( function_exists('ebor_register_required_plugins') )){
	function ebor_register_required_plugins() {
		$plugins = array(
			array(
			    'name'      => 'Contact Form 7',
			    'slug'      => 'contact-form-7',
			    'required'  => false,
			    'version' 	=> '3.7.2'
			),
			array(
				'name'     				=> 'Ebor Framework',
				'slug'     				=> 'Ebor-Framework-master',
				'source'   				=> 'https://github.com/tommusrhodus/ebor-framework/archive/master.zip',
				'required' 				=> true,
				'version' 				=> '1.0.0',
				'external_url' 			=> 'https://github.com/tommusrhodus/ebor-framework/archive/master.zip',
			),
			array(
				'name'     				=> 'Visual Composer',
				'slug'     				=> 'js_composer',
				'source'   				=> 'http://www.madeinebor.com/plugin-downloads/js_composer-latest.zip',
				'required' 				=> true,
				'external_url' 			=> 'http://www.madeinebor.com/plugin-downloads/js_composer-latest.zip',
				'version' 				=> '4.12.1',
			),
			array(
			    'name'      => 'WooCommerce',
			    'slug'      => 'woocommerce',
			    'required'  => false,
			    'version' 	=> '2.0.0'
			),
		);
		$config = array(
			'is_automatic' => true,
		);
		tgmpa( $plugins, $config );
	}
	add_action( 'tgmpa_register', 'ebor_register_required_plugins' );
}

if(!( function_exists('ebor_pagination') )){
	function ebor_pagination($pages = '', $range = 2){
		$showitems = ($range * 2)+1;
		
		global $paged;
		if(empty($paged)) $paged = 1;
		
		if($pages == ''){
			global $wp_query;
			$pages = $wp_query->max_num_pages;
				if(!$pages) {
					$pages = 1;
				}
		}
		
		$output = '';
			
		if(1 != $pages){
			$output .= "<div class='text-center'><ul class='pagination'>";
			if($paged > 2 && $paged > $range+1 && $showitems < $pages) $output .= "<li><a href='".get_pagenum_link(1)."' aria-label='Previous'><span aria-hidden='true'>&laquo;</span></a></li> ";
			
			for ($i=1; $i <= $pages; $i++){
				if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems )){
					$output .= ($paged == $i)? "<li class='active'><a href='".get_pagenum_link($i)."'>".$i."</a></li> ":"<li><a href='".get_pagenum_link($i)."'>".$i."</a></li> ";
				}
			}
		
			if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) $output .= "<li><a href='".get_pagenum_link($pages)."' aria-label='Next'><span aria-hidden='true'>&raquo;</span></a></li> ";
			$output.= "</ul></div>";
		}
		
		return $output;
	}
}

/**
 * Add additional styling options to TinyMCE
 * 
 * @since 1.0.0
 * @author tommusrhodus
 */
if(!( function_exists('ebor_mce_buttons_2') )){
	function ebor_mce_buttons_2( $buttons ) {
	    array_unshift( $buttons, 'styleselect' );
	    return $buttons;
	}
	add_filter( 'mce_buttons_2', 'ebor_mce_buttons_2' );
}

/**
 * Add additional styling options to TinyMCE
 * 
 * @since 1.0.0
 * @author tommusrhodus
 */
if(!( function_exists('ebor_mce_before_init') )){
	function ebor_mce_before_init( $settings ) {
	    $style_formats = array(
	    	array(
				'title'	=> 'Button Styles',
				'items'	=> array(
			    	array(
			    		'title' => 'Button',
			    		'selector' => 'a',
			    		'classes' => 'btn',
			    	),
			    	array(
			    		'title' => 'Filled Button',
			    		'selector' => 'a',
			    		'classes' => 'btn btn-filled',
			    	),
			    	array(
			    		'title' => 'Rounded Button',
			    		'selector' => 'a',
			    		'classes' => 'btn btn-rounded',
			    	),
			    	array(
			    		'title' => 'Button Small',
			    		'selector' => 'a',
			    		'classes' => 'btn-sm',
			    	),
			    	array(
			    		'title' => 'Button Large',
			    		'selector' => 'a',
			    		'classes' => 'btn-lg',
			    	),
				)
	    	),
	    	array(
	    		'title'	=> 'Text Styles',
	    		'items'	=> array(
	    	    	array(
	    	    		'title' => 'Uppercase Text',
	    	    		'selector' => '*',
	    	    		'classes' => 'uppercase',
	    	    	),
	    	    	array(
	    	    		'title' => 'Faded Text',
	    	    		'selector' => '*',
	    	    		'classes' => 'fade-half',
	    	    	),
	    	    	array(
	    	    		'title' => 'Lead Paragraph',
	    	    		'selector' => 'p',
	    	    		'classes' => 'lead',
	    	    	),
	    	    	array(
	    	    		'title' => 'Large H1',
	    	    		'selector' => 'h1',
	    	    		'classes' => 'large',
	    	    	),
	    		)
	    	),
	    	array(
	    		'title'	=> 'Margins',
	    		'items'	=> array(
	    			array(
	    				'title' => 'Margin Bottom 0px',
	    				'selector' => '*',
	    				'classes' => 'mb0',
	    			),
	    			array(
	    				'title' => 'Margin Bottom 8px',
	    				'selector' => '*',
	    				'classes' => 'mb8',
	    			),
	    	    	array(
	    	    		'title' => 'Margin Bottom 16px',
	    	    		'selector' => '*',
	    	    		'classes' => 'mb16',
	    	    	),
	    	    	array(
	    	    		'title' => 'Margin Bottom 24px',
	    	    		'selector' => '*',
	    	    		'classes' => 'mb24',
	    	    	),
	    	    	array(
	    	    		'title' => 'Margin Bottom 32px',
	    	    		'selector' => '*',
	    	    		'classes' => 'mb24',
	    	    	),
	    	    	array(
	    	    		'title' => 'Margin Bottom 48px',
	    	    		'selector' => '*',
	    	    		'classes' => 'mb48',
	    	    	),
	    	    	array(
	    	    		'title' => 'Margin Bottom 64px',
	    	    		'selector' => '*',
	    	    		'classes' => 'mb64',
	    	    	),
	    	    	array(
	    	    		'title' => 'Margin Bottom 80px',
	    	    		'selector' => '*',
	    	    		'classes' => 'mb80',
	    	    	),
	    	    	array(
	    	    		'title' => 'Margin Bottom 104px',
	    	    		'selector' => '*',
	    	    		'classes' => 'mb104',
	    	    	),
	    	    	array(
	    	    		'title' => 'Margin Bottom 120px',
	    	    		'selector' => '*',
	    	    		'classes' => 'mb120',
	    	    	),
	    		)
	    	)
	    );
	    $settings['style_formats'] = json_encode( $style_formats );
	    return $settings;
	}
	add_filter( 'tiny_mce_before_init', 'ebor_mce_before_init' );
}

if(!( function_exists('ebor_get_icons') )){
	function ebor_get_icons(){
		$icons = array("none","ti-arrow-up","ti-arrow-right","ti-arrow-left","ti-arrow-down","ti-arrows-vertical","ti-arrows-horizontal","ti-angle-up","ti-angle-right","ti-angle-left","ti-angle-down","ti-angle-double-up","ti-angle-double-right","ti-angle-double-left","ti-angle-double-down","ti-move","ti-fullscreen","ti-arrow-top-right","ti-arrow-top-left","ti-arrow-circle-up","ti-arrow-circle-right","ti-arrow-circle-left","ti-arrow-circle-down","ti-arrows-corner","ti-split-v","ti-split-v-alt","ti-split-h","ti-hand-point-up","ti-hand-point-right","ti-hand-point-left","ti-hand-point-down","ti-back-right","ti-back-left","ti-exchange-vertical","ti-wand","ti-save","ti-save-alt","ti-direction","ti-direction-alt","ti-user","ti-link","ti-unlink","ti-trash","ti-target","ti-tag","ti-desktop","ti-tablet","ti-mobile","ti-email","ti-star","ti-spray","ti-signal","ti-shopping-cart","ti-shopping-cart-full","ti-settings","ti-search","ti-zoom-in","ti-zoom-out","ti-cut","ti-ruler","ti-ruler-alt-2","ti-ruler-pencil","ti-ruler-alt","ti-bookmark","ti-bookmark-alt","ti-reload","ti-plus","ti-minus","ti-close","ti-pin","ti-pencil","ti-pencil-alt","ti-paint-roller","ti-paint-bucket","ti-na","ti-medall","ti-medall-alt","ti-marker","ti-marker-alt","ti-lock","ti-unlock","ti-location-arrow","ti-layout","ti-layers","ti-layers-alt","ti-key","ti-image","ti-heart","ti-heart-broken","ti-hand-stop","ti-hand-open","ti-hand-drag","ti-flag","ti-flag-alt","ti-flag-alt-2","ti-eye","ti-import","ti-export","ti-cup","ti-crown","ti-comments","ti-comment","ti-comment-alt","ti-thought","ti-clip","ti-check","ti-check-box","ti-camera","ti-announcement","ti-brush","ti-brush-alt","ti-palette","ti-briefcase","ti-bolt","ti-bolt-alt","ti-blackboard","ti-bag","ti-world","ti-wheelchair","ti-car","ti-truck","ti-timer","ti-ticket","ti-thumb-up","ti-thumb-down","ti-stats-up","ti-stats-down","ti-shine","ti-shift-right","ti-shift-left","ti-shift-right-alt","ti-shift-left-alt","ti-shield","ti-notepad","ti-server","ti-pulse","ti-printer","ti-power-off","ti-plug","ti-pie-chart","ti-panel","ti-package","ti-music","ti-music-alt","ti-mouse","ti-mouse-alt","ti-money","ti-microphone","ti-menu","ti-menu-alt","ti-map","ti-map-alt","ti-location-pin","ti-light-bulb","ti-info","ti-infinite","ti-id-badge","ti-hummer","ti-home","ti-help","ti-headphone","ti-harddrives","ti-harddrive","ti-gift","ti-game","ti-filter","ti-files","ti-file","ti-zip","ti-folder","ti-envelope","ti-dashboard","ti-cloud","ti-cloud-up","ti-cloud-down","ti-clipboard","ti-calendar","ti-book","ti-bell","ti-basketball","ti-bar-chart","ti-bar-chart-alt","ti-archive","ti-anchor","ti-alert","ti-alarm-clock","ti-agenda","ti-write","ti-wallet","ti-video-clapper","ti-video-camera","ti-vector","ti-support","ti-stamp","ti-slice","ti-shortcode","ti-receipt","ti-pin2","ti-pin-alt","ti-pencil-alt2","ti-eraser","ti-more","ti-more-alt","ti-microphone-alt","ti-magnet","ti-line-double","ti-line-dotted","ti-line-dashed","ti-ink-pen","ti-info-alt","ti-help-alt","ti-headphone-alt","ti-gallery","ti-face-smile","ti-face-sad","ti-credit-card","ti-comments-smiley","ti-time","ti-share","ti-share-alt","ti-rocket","ti-new-window","ti-rss","ti-rss-alt","ti-control-stop","ti-control-shuffle","ti-control-play","ti-control-pause","ti-control-forward","ti-control-backward","ti-volume","ti-control-skip-forward","ti-control-skip-backward","ti-control-record","ti-control-eject","ti-paragraph","ti-uppercase","ti-underline","ti-text","ti-Italic","ti-smallcap","ti-list","ti-list-ol","ti-align-right","ti-align-left","ti-align-justify","ti-align-center","ti-quote-right","ti-quote-left","ti-layout-width-full","ti-layout-width-default","ti-layout-width-default-alt","ti-layout-tab","ti-layout-tab-window","ti-layout-tab-v","ti-layout-tab-min","ti-layout-slider","ti-layout-slider-alt","ti-layout-sidebar-right","ti-layout-sidebar-none","ti-layout-sidebar-left","ti-layout-placeholder","ti-layout-menu","ti-layout-menu-v","ti-layout-menu-separated","ti-layout-menu-full","ti-layout-media-right","ti-layout-media-right-alt","ti-layout-media-overlay","ti-layout-media-overlay-alt","ti-layout-media-overlay-alt-2","ti-layout-media-left","ti-layout-media-left-alt","ti-layout-media-center","ti-layout-media-center-alt","ti-layout-list-thumb","ti-layout-list-thumb-alt","ti-layout-list-post","ti-layout-list-large-image","ti-layout-line-solid","ti-layout-grid4","ti-layout-grid3","ti-layout-grid2","ti-layout-grid2-thumb","ti-layout-cta-right","ti-layout-cta-left","ti-layout-cta-center","ti-layout-cta-btn-right","ti-layout-cta-btn-left","ti-layout-column4","ti-layout-column3","ti-layout-column2","ti-layout-accordion-separated","ti-layout-accordion-merged","ti-layout-accordion-list","ti-widgetized","ti-widget","ti-widget-alt","ti-view-list","ti-view-list-alt","ti-view-grid","ti-upload","ti-download","ti-loop","ti-layout-sidebar-2","ti-layout-grid4-alt","ti-layout-grid3-alt","ti-layout-grid2-alt","ti-layout-column4-alt","ti-layout-column3-alt","ti-layout-column2-alt","ti-flickr","ti-flickr-alt","ti-instagram","ti-google","ti-github","ti-facebook","ti-dropbox","ti-dropbox-alt","ti-dribbble","ti-apple","ti-android","ti-yahoo","ti-trello","ti-stack-overflow","ti-soundcloud","ti-sharethis","ti-sharethis-alt","ti-reddit","ti-microsoft","ti-microsoft-alt","ti-linux","ti-jsfiddle","ti-joomla","ti-html5","ti-css3","ti-drupal","ti-wordpress","ti-tumblr","ti-tumblr-alt","ti-skype","ti-youtube","ti-vimeo","ti-vimeo-alt","ti-twitter","ti-twitter-alt","ti-linkedin","ti-pinterest","ti-pinterest-alt","ti-themify-logo","ti-themify-favicon","ti-themify-favicon-alt","xtra-icon-behance");
		return $icons;	
	}
}

/**
 * Custom Comment Markup for Pivot
 * 
 * @since 1.0.0
 * @author tommusrhodus
 */
if(!( function_exists('ebor_custom_comment') )){
	function ebor_custom_comment($comment, $args, $depth) { 
		$GLOBALS['comment'] = $comment; 
	?>

		<li <?php comment_class(); ?> id="comment-<?php comment_ID() ?>">
			<div class="avatar">
				<?php echo get_avatar( $comment->comment_author_email, 75 ); ?>
			</div>
			<div class="comment">
				<?php printf('<span class="uppercase author">%s, %s</span>', get_comment_author_link(), get_comment_date()); ?>
				<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))); ?>
				<?php echo wpautop( htmlspecialchars_decode( get_comment_text() ) ); ?>
				<?php if ($comment->comment_approved == '0') : ?>
				<p><em><?php _e('Your comment is awaiting moderation.', 'foundry') ?></em></p>
				<?php endif; ?>	
			</div>
	
	<?php }
}
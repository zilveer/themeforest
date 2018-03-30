<?php

if ( !function_exists( 'mysite_document_title' ) ) :
/**
 *
 */
function mysite_document_title() {
	global $wp_query;
	
	# Set up some default variables.
	$doctitle = '';
	$separator = ' |';
	$post = $wp_query->get_queried_object();
	
	if ( is_front_page() ) {
		
		$seo_home_title = mysite_get_setting( 'seo_home_title' );
		if( trim( $seo_home_title ) ) {
			$doctitle = $seo_home_title;
		} else {
			$doctitle = get_bloginfo( 'name' ) . $separator . ' ' . get_bloginfo( 'description' );
		}
		
	} else if( is_single() || is_attachment() ) {
		
		$post_title_format = mysite_get_setting( 'seo_post_title_format' );
		$post_title_override = trim( get_post_meta( $post->ID, '_seo_title', true ) );
		if( get_post_meta( $post->ID, '_seo_disable', true ) || !in_array( get_post_type( $post->ID ), mysite_seo_posttypecolumns() ) ) {
			$doctitle = mysite_seo_replace( '%post_title%', $post );
			
		} else if ( !empty( $post_title_override ) ) {
			$doctitle = $post_title_override;
			
		} else if ( trim( $post_title_format ) ) {
			$doctitle = mysite_seo_replace( $post_title_format, $post );
			
		} else {
			$doctitle = mysite_seo_replace( '%post_title%', $post );
		}
		
	} else if ( is_page() ) {
		
		$page_title_format = mysite_get_setting( 'seo_page_title_format' );
		$page_title_override = trim( get_post_meta( $post->ID, '_seo_title', true ) );
		if( get_post_meta( $post->ID, '_seo_disable', true ) || !in_array( get_post_type( $post->ID ), mysite_seo_posttypecolumns() ) ) {
			$doctitle = mysite_seo_replace( '%page_title%', $post );
			
		} else if ( !empty( $page_title_override ) ) {
			$doctitle = $page_title_override;
			
		} else if ( trim( $page_title_format ) ) {
			$doctitle = mysite_seo_replace( $page_title_format, $post );
			
		} else {
			$doctitle = mysite_seo_replace( '%page_title%', $post );
		}
		
	} else if ( is_category() ) {
		
		$category_title_format = mysite_get_setting( 'seo_category_title_format' );
		if( trim( $category_title_format ) ) {
			$doctitle = mysite_seo_replace( $category_title_format, $post );
		} else {
			$doctitle = mysite_seo_replace( '%category_title%', $post );
		}
		
	} else if ( is_date() ) {
		
		$archive_title_format = mysite_get_setting( 'seo_archive_title_format' );
		if( trim( $archive_title_format ) ) {
			$doctitle = mysite_seo_replace( $archive_title_format, $post );
		} else {
			$doctitle = sprintf( __( 'Archive for %1$s', MYSITE_TEXTDOMAIN ), mysite_seo_replace( '%date%', $post ) );
		}
		
	} else if ( is_tag() ) {
		
		$tag_title_format = mysite_get_setting( 'seo_tag_title_format' );
		if( trim( $tag_title_format ) ) {
			$doctitle = mysite_seo_replace( $tag_title_format, $post );
		} else {
			$doctitle = mysite_seo_replace( '%tag%', $post );
		}
		
	} else if ( is_search() ) {
		
		$search_title_format = mysite_get_setting( 'seo_search_title_format' );
		if( trim( $search_title_format ) ) {
			$doctitle = mysite_seo_replace( $search_title_format, $post );
		} else {
			$doctitle = sprintf( __( 'Search results for &quot;%1$s&quot;', MYSITE_TEXTDOMAIN ), mysite_seo_replace( '%search%', $post ) );
		}
		
	} else if( is_404() ) {

		$seo_404_title_format = mysite_get_setting( 'seo_404_title_format' );
		if( trim( $seo_404_title_format ) ) {
			$doctitle = mysite_seo_replace( $seo_404_title_format );
		} else {
			$doctitle = mysite_seo_replace( '%404_title%' );
		}
		
	}
	
	if ( ( ( $page = $wp_query->get( 'paged' ) ) || ( $page = $wp_query->get( 'page' ) ) ) && $page > 1 ) {
		
		$seo_paged_format = mysite_get_setting( 'seo_paged_format' );
		if( trim( $seo_paged_format ) ) {
			$doctitle = $doctitle . str_replace( '%page%', $page, $seo_paged_format );
		} else {
			$doctitle = sprintf( __( '%1$s Page %2$s', MYSITE_TEXTDOMAIN ), $doctitle . $separator, number_format_i18n( $page ) );
		}
		
	}
	
	# Apply the wp_title filters so we're compatible with plugins.
	$doctitle = apply_filters( 'wp_title', $doctitle, '', '' );

	# Print the title to the screen.
	echo apply_atomic( 'document_title', esc_attr( $doctitle ) );
}
endif;

if ( !function_exists( 'mysite_seo_meta' ) ) :
/**
 *
 */
function mysite_seo_meta() {
	
	global $wp_query;
	$post = $wp_query->get_queried_object();
	$currenturl = trim( $_SERVER['REQUEST_URI'] ,'/' );
	$front_page = false;
	$description = '';
	$meta_description = '';
	$meta_keywords = '';
	$out = '';
	
	if( is_feed() )
		return;
	
	# Check if page/post is excluded
	$excluded = explode( ',', mysite_get_setting( 'seo_ex_pages' ) );
	foreach( $excluded as $exedd ) {
		$exedd = trim( $exedd );
		if( $exedd )
			if( stristr( $currenturl, $exedd ) )
				return;
	}
	
	if ( is_front_page() ) {
		$front_page = true;
		$home_description = mysite_get_setting( 'seo_home_description' );
		if( $home_description )
			$description = $home_description;
		
	} else if ( is_singular() || is_single() ) {
		
		if( get_post_meta( $post->ID, '_seo_disable', true ) || !in_array( get_post_type( $post->ID ), mysite_seo_posttypecolumns() ) )
			return;
			
		$_seo_description = get_post_meta( $post->ID, '_seo_description', true );
		if( trim( $_seo_description ) )
			$description = $_seo_description;
		else if( mysite_get_setting( 'seo_generate_descriptions' ) )
			$description = mysite_seo_replace( '%excerpt%', $post );
		
	} else if( is_category() ) {
		$description = substr( mysite_seo_replace( '%category_description%', $post ), 0, 155 );
		
	} else if( is_tag() ) {
		$description = substr( mysite_seo_replace( '%tag_description%', $post ), 0, 155 );
		
	} else if ( is_author() ) {
		$description = substr( mysite_seo_replace( '%post_author_description%', $post ), 0, 155 );
	}
	
	$description_format = mysite_get_setting( 'seo_description_format' );
	if( trim( $description_format ) ) {
		$meta_description = $description_format;
	} else {
		$meta_description = '%description%';
	}
	
	$replacements = array(
		'%description%'			=> $description,
		'%blog_title%'			=> get_bloginfo( 'name' ),
		'%blog_description%'	=> get_bloginfo( 'description' ),
		'%wp_title%'			=> ( !empty( $post->post_title ) ? stripslashes( $post->post_title ) : '' ),
	);
	
	foreach ( $replacements as $var => $repl ) {
		$meta_description = str_replace( $var, $repl, $meta_description );
	}
	
	$meta_description = apply_atomic( 'meta_description', $meta_description );
	if( !empty( $meta_description ) )
		$out .= '<meta name="description" content="' . $meta_description . '" />' . "\r";
		
	$meta_keywords = mysite_get_seo_keywords( $args = array( 'posts' => $post, 'front_page' => $front_page, 'wp_query' => $wp_query ) );
	$meta_keywords = apply_atomic( 'meta_keywords', $meta_keywords );
	if( !empty( $meta_keywords ) )
		$out .= '<meta name="keywords" content="' . $meta_keywords . '" />' . "\r";
		
	if ( ( is_category() && mysite_get_setting( 'seo_category_noindex' ) ) || ( !is_category() && is_archive() && !is_tag() && mysite_get_setting( 'seo_archive_noindex' ) ) || ( mysite_get_setting( 'seo_tags_noindex' ) && is_tag() ) )
		$out .= '<meta name="robots" content="noindex,follow" />' . "\r";
		
	$post_meta = mysite_get_setting( 'seo_post_meta_tags' );
	if ( is_single() && !empty( $post_meta ) )
		$out .= stripcslashes( $post_meta ) . "\r";
		
	$page_meta = mysite_get_setting( 'seo_page_meta_tags' );
	if ( is_page() && !empty( $page_meta ) || !empty( $post->ID ) && get_option('page_for_posts') == $post->ID )
		$out .= stripcslashes( $page_meta ) . "\r";
		
	$home_meta = mysite_get_setting( 'seo_home_meta_tags' );
	if ( $front_page && !empty( $home_meta ) )
		$out .= stripcslashes( $home_meta ) . "\r";
		
	if( mysite_get_setting( 'seo_can' ) ) {
		$url = mysite_canonical();
		if ( $url ) {
			$url = apply_atomic( 'canonical_url', $url );
			$out .= '<link rel="canonical" href="' . $url . '" />' . "\r";
		}
	}
			
	echo $out;
}
endif;

if ( !function_exists( 'mysite_mobile_meta' ) ) :
/**
 *
 */
function mysite_mobile_meta() {
	global $mysite;
	
	$out = '';
	
	if( isset( $mysite->mobile ) ) {
		$out .= '<meta name="viewport" content="width=device-width, initial-scale=1">';
	}
	
	echo $out;
}
endif;

if ( !function_exists( 'mysite_header_extras' ) ) :
/**
 *
 */
function mysite_header_extras() {
	$out = '';
	$header_links = '';
	$sociables = '';
	$header_text = mysite_get_setting( 'extra_header' );

	# If header-links has a menu assigned display it.
	if ( has_nav_menu('header-links' ) ) {
		$header_links = wp_nav_menu(
			array(
			'theme_location' => 'header-links',
			'container_class' => 'header_links',
			'container_id' => '',
			'menu_class' => 'header_links_menu',
			'fallback_cb' => false,
			'echo' => false
		));
	}

	# Display sociables in header.
	$sociable = mysite_get_setting( 'sociable' );

	if( $sociable['keys'] != '#' ) {
		$sociable_keys = explode( ',', $sociable['keys'] );

		foreach ( $sociable_keys as $key ) {
			if( $key != '#' ) {

				if( !empty( $sociable[$key]['custom'] ) )
					$sociable_icon = $sociable[$key]['custom'];

				elseif( empty( $sociable[$key]['custom'] ) )
					$sociable_icon = THEME_IMAGES . '/sociables/' . $sociable[$key]['color'] . '/' . $sociable[$key]['icon'];

				$sociable_link = ( !empty( $sociable[$key]['link'] ) ) ? $sociable[$key]['link'] : '#';

				$sociables .= '<div class="social_icon ' . $sociable[$key]['color'] . '">';
				$sociables .= '<a href="' . esc_url( $sociable_link ) . '"><img src="' . esc_url( $sociable_icon ) . '" alt="' . ( isset( $sociable[$key]['alt'] ) ? $sociable[$key]['alt'] : '' ) . '" /></a>';
				$sociables .= '</div>';
			}
		}
	}

	if( !empty( $header_links ) || !empty( $sociables ) || !empty( $header_text ) ) {
		$out .= '<div id="header_extras">';
		$out .= '<div id="header_extras_inner">';

		$out .= $header_links;

		if( !empty( $sociables ) ) {
			$out .= '<div class="header_social">';
			$out .= $sociables;
			$out .= '</div>';
		}

		if( !empty( $header_text ) ) {
			$out .= '<div class="header_text">';
			$out .= stripslashes( $header_text );
			$out .= '</div>';
		}

		$out .= '</div><!-- #header_extras_inner -->';
		$out .= '</div><!-- #header_extras -->';
	}

	echo apply_atomic_shortcode( 'header_extras', $out );
}
endif;

if ( !function_exists( 'mysite_sidebars' ) ) :
/**
 *
 */
function mysite_sidebars() {
	# Register default widgetized areas
	$sidebars = array(
		'primary' => array(
			'name' => __( 'Primary Widget Area', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'The primary widget area', MYSITE_ADMIN_TEXTDOMAIN )
		),
		'home' => array(
			'name' => __( 'Homepage Widget Area', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'The homepage widget area', MYSITE_ADMIN_TEXTDOMAIN )
		),
		'footer1' => array(
			'name' => __( 'First Footer Widget Area', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'The first footer widget area', MYSITE_ADMIN_TEXTDOMAIN )
		),
		'footer2' => array(
			'name' => __( 'Second Footer Widget Area', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'The second footer widget area', MYSITE_ADMIN_TEXTDOMAIN )
		),
		'footer3' => array(
			'name' => __( 'Third Footer Widget Area', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'The third footer widget area', MYSITE_ADMIN_TEXTDOMAIN )
		),
		'footer4' => array(
			'name' => __( 'Fourth Footer Widget Area', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'The fourth footer widget area', MYSITE_ADMIN_TEXTDOMAIN )
		),
		'footer5' => array(
			'name' => __( 'Fifth Footer Widget Area', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'The fifth footer widget area', MYSITE_ADMIN_TEXTDOMAIN )
		),
		'footer6' => array(
			'name' => __( 'Sixth Footer Widget Area', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'The sixth footer widget area', MYSITE_ADMIN_TEXTDOMAIN )
		)
	);

	foreach ( $sidebars as $type => $sidebar ){
		register_sidebar(array(
			'name' => $sidebar['name'],
			'id'=> $type,
			'description' => $sidebar['desc'],
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h4 class="widgettitle">',
			'after_title' => '</h4>',
		));
	}
	
	# Register custom sidebars areas
	$custom_sidebars = get_option( MYSITE_SIDEBARS );
	if( !empty( $custom_sidebars ) ) {
		foreach ( $custom_sidebars as $id => $name ) {
			register_sidebar(array(
				'name' => $name,
				'id'=> "mysite_custom_sidebar_{$id}",
				'description' => $name,
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget' => '</div>',
				'before_title' => '<h4 class="widgettitle">',
				'after_title' => '</h4>',
			));
		}
	}
}
endif;

if ( !function_exists( 'mysite_widgets' ) ) :
/**
 *
 */
function mysite_widgets() {
	# Load each widget file.
	require_once( THEME_CLASSES . '/widget-flickr.php' );
	require_once( THEME_CLASSES . '/widget-subnav.php' );
	require_once( THEME_CLASSES . '/widget-twitter.php' );
	require_once( THEME_CLASSES . '/widget-popular.php' );
	require_once( THEME_CLASSES . '/widget-recent.php' );
	require_once( THEME_CLASSES . '/widget-contact.php' );
	require_once( THEME_CLASSES . '/widget-contact-form.php' );
	require_once( THEME_CLASSES . '/widget-testimonial.php' );

	# Register each widget.
	register_widget( 'MySite_Flickr_Widget' );
	register_widget( 'MySite_SubNav_Widget' );
	register_widget( 'MySite_Twitter_Widget' );
	register_widget( 'MySite_PopularPost_Widget' );
	register_widget( 'MySite_RecentPost_Widget' );
	register_widget( 'MySite_Contact_Widget' );
	register_widget( 'MySite_Contact_Form_Widget' );
	register_widget( 'MySite_Testimonial_Widget' );
}
endif;

if ( !function_exists( 'mysite_get_sidebar' ) ) :
/**
 *
 */
function mysite_get_sidebar() {
	wp_reset_query();
	
	global $wp_query, $mysite;
	
	$sidebar = true;
	
	if( is_singular() ) {
		$type = get_post_type();
		$post_obj = $wp_query->get_queried_object();
		
		$dependencies = get_post_meta( $post_obj->ID, '_dependencies', true );
		$dependencies = ( empty( $dependencies ) ) ? get_post_meta( $post_obj->ID, '_' . THEME_SLUG .'_dependencies', true ) : $dependencies;
		$template = get_post_meta( $post_obj->ID, '_wp_page_template', true );
		$_layout = get_post_meta( $post_obj->ID, '_layout', true );
		
		if( $type == 'page' && empty( $_layout ) ) {
			$page_layout = mysite_get_setting( 'page_layout' );
			if( !empty( $page_layout ) && $page_layout == 'full_width' )
				$sidebar = false;
		}
		
		if( $type == 'post' && empty( $_layout ) ) {
			$post_layout = mysite_get_setting( 'post_layout' );
			if( !empty( $post_layout ) && $post_layout == 'full_width' )
				$sidebar = false;
		}
		
		if( $_layout == 'full_width' )
			$sidebar = false;
			
		if( strpos( $dependencies, 'fancy_portfolio' ) !== false || apply_atomic( 'fancy_portfolio', false ) == true && !isset( $mysite->responsive ) )
			$sidebar = false;
			
		if( ( $type == 'portfolio' ) && ( empty( $_layout ) ) )
			$sidebar = false;

		if( $template == 'template-featuretour.php' || $template == 'template-squeeze-page.php' )
			$sidebar = false;
			
		if( strpos( $post_obj->post_content, '[portfolio' ) !== false && empty( $_layout ) )
			$sidebar = false;
	}
	
	if( ( is_front_page() ) && ( !is_active_sidebar( 'home' ) ) )
		$sidebar = false;
		
	if( is_archive() && mysite_get_setting( 'archive_layout' ) == 'full_width' )
		$sidebar = false;
	
	if( is_search() && mysite_get_setting( 'search_layout' ) == 'full_width' )
		$sidebar = false;
	
	if( is_404() ) {
		$four_04_layout = mysite_get_setting( 'four_04_layout' );
		if( empty( $four_04_layout ) || $four_04_layout == 'full_width' )
			$sidebar = false;
	}
		
	$sidebar = apply_atomic( 'get_sidebar', $sidebar );

	if( $sidebar == true )
		get_sidebar();
}
endif;

if ( !function_exists( 'mysite_dynamic_sidebar' ) ) :
/**
 *
 */
function mysite_dynamic_sidebar() {
	wp_reset_query();
	
	global $wp_query, $post;
	
	$post_obj = $wp_query->get_queried_object();

	if( !empty( $post_obj->ID ) && !is_front_page() )
		$custom = get_post_meta( $post_obj->ID, '_custom_sidebar', true );
		
	if( is_archive() )
		$custom = mysite_get_setting( 'archive_custom_sidebar' );
		
	if( is_search() )
		$custom = mysite_get_setting( 'search_custom_sidebar' );
		
	if( is_404() )
		$custom = mysite_get_setting( 'four_04_custom_sidebar' );

	if( !is_front_page() && empty( $custom ) )
		$sidebar = 'primary';

	if( !empty( $custom ) )
		$sidebar = $custom;
		
	if( is_front_page() )
		$sidebar = 'home';

	if( isset( $sidebar ) )
		dynamic_sidebar( $sidebar );
}
endif;

if ( !function_exists( 'mysite_menus' ) ) :
/**
 *
 */
function mysite_menus() {
	register_nav_menu( 'primary-menu', __( 'Primary Menu', MYSITE_ADMIN_TEXTDOMAIN ) );
	register_nav_menu( 'header-links', __( 'Header Links', MYSITE_ADMIN_TEXTDOMAIN ) );
	register_nav_menu( 'footer-links', __( 'Footer Links', MYSITE_ADMIN_TEXTDOMAIN ) );
}
endif;

if ( !function_exists( 'mysite_post_types' ) ) :
/**
 *
 */
function mysite_post_types() {
	# Register post type portfolio
	register_post_type('portfolio', array(
		'labels' => array(
			'name' => _x('Portfolios', 'post type general name', MYSITE_ADMIN_TEXTDOMAIN ),
			'singular_name' => _x('Portfolio', 'post type singular name', MYSITE_ADMIN_TEXTDOMAIN ),
			'add_new' => _x('Add New', 'portfolio', MYSITE_ADMIN_TEXTDOMAIN ),
			'add_new_item' => __('Add New Portfolio', MYSITE_ADMIN_TEXTDOMAIN ),
			'edit_item' => __('Edit Portfolio', MYSITE_ADMIN_TEXTDOMAIN ),
			'new_item' => __('New Portfolio', MYSITE_ADMIN_TEXTDOMAIN ),
			'view_item' => __('View Portfolio', MYSITE_ADMIN_TEXTDOMAIN ),
			'search_items' => __('Search Portfolios', MYSITE_ADMIN_TEXTDOMAIN ),
			'not_found' =>  __('No portfolios found', MYSITE_ADMIN_TEXTDOMAIN ),
			'not_found_in_trash' => __('No portfolios found in Trash', MYSITE_ADMIN_TEXTDOMAIN ), 
			'parent_item_colon' => ''
		),
		'singular_label' => __('Portfolio', MYSITE_ADMIN_TEXTDOMAIN ),
		'public' => true,
		'exclude_from_search' => false,
		'show_ui' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'rewrite' => array( 'with_front' => false ),
		'query_var' => false,
		'supports' => array('title', 'editor', 'excerpt', 'thumbnail', 'comments' )
	));

	# Register taxonomy for portfolio
	register_taxonomy('portfolio_category','portfolio',array(
		'hierarchical' => true,
		'labels' => array(
			'name' => _x( 'Portfolio Categories', 'taxonomy general name', MYSITE_ADMIN_TEXTDOMAIN ),
			'singular_name' => _x( 'Portfolio Category', 'taxonomy singular name', MYSITE_ADMIN_TEXTDOMAIN ),
			'search_items' =>  __( 'Search Categories', MYSITE_ADMIN_TEXTDOMAIN ),
			'popular_items' => __( 'Popular Categories', MYSITE_ADMIN_TEXTDOMAIN ),
			'all_items' => __( 'All Categories', MYSITE_ADMIN_TEXTDOMAIN ),
			'parent_item' => null,
			'parent_item_colon' => null,
			'edit_item' => __( 'Edit Portfolio Category', MYSITE_ADMIN_TEXTDOMAIN ), 
			'update_item' => __( 'Update Portfolio Category', MYSITE_ADMIN_TEXTDOMAIN ),
			'add_new_item' => __( 'Add New Portfolio Category', MYSITE_ADMIN_TEXTDOMAIN ),
			'new_item_name' => __( 'New Portfolio Category Name', MYSITE_ADMIN_TEXTDOMAIN ),
			'separate_items_with_commas' => __( 'Separate Portfolio category with commas', MYSITE_ADMIN_TEXTDOMAIN ),
			'add_or_remove_items' => __( 'Add or remove portfolio category', MYSITE_ADMIN_TEXTDOMAIN ),
			'choose_from_most_used' => __( 'Choose from the most used portfolio category', MYSITE_ADMIN_TEXTDOMAIN )
		),
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => true,
	));
	
	
	# Register post type testimonial
	register_post_type('testimonial', array(
		'labels' => array(
			'name' => _x('Testimonials', 'post type general name', MYSITE_ADMIN_TEXTDOMAIN ),
			'singular_name' => _x('Testimonial', 'post type singular name', MYSITE_ADMIN_TEXTDOMAIN ),
			'add_new' => _x('Add New', 'testimonial', MYSITE_ADMIN_TEXTDOMAIN ),
			'add_new_item' => __('Add New Testimonial', MYSITE_ADMIN_TEXTDOMAIN ),
			'edit_item' => __('Edit Testimonial', MYSITE_ADMIN_TEXTDOMAIN ),
			'new_item' => __('New Testimonial', MYSITE_ADMIN_TEXTDOMAIN ),
			'view_item' => __('View Testimonial', MYSITE_ADMIN_TEXTDOMAIN ),
			'search_items' => __('Search Testimonials', MYSITE_ADMIN_TEXTDOMAIN ),
			'not_found' =>  __('No testimonials found', MYSITE_ADMIN_TEXTDOMAIN ),
			'not_found_in_trash' => __('No testimonials found in Trash', MYSITE_ADMIN_TEXTDOMAIN ), 
			'parent_item_colon' => ''
		),
		'singular_label' => __('Testimonial', MYSITE_ADMIN_TEXTDOMAIN ),
		'public' => true,
		'show_in_nav_menus'  => false,
		'exclude_from_search' => true,
		'show_ui' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'rewrite' => false,
		'query_var' => false,
		'supports' => array( 'title', 'page-attributes' )
	));

	# Register taxonomy for testimonial
	register_taxonomy('testimonial_category','testimonial',array(
		'hierarchical' => true,
		'labels' => array(
			'name' => _x( 'Testimonial Categories', 'taxonomy general name', MYSITE_ADMIN_TEXTDOMAIN ),
			'singular_name' => _x( 'Testimonial Category', 'taxonomy singular name', MYSITE_ADMIN_TEXTDOMAIN ),
			'search_items' =>  __( 'Search Categories', MYSITE_ADMIN_TEXTDOMAIN ),
			'popular_items' => __( 'Popular Categories', MYSITE_ADMIN_TEXTDOMAIN ),
			'all_items' => __( 'All Categories', MYSITE_ADMIN_TEXTDOMAIN ),
			'parent_item' => null,
			'parent_item_colon' => null,
			'edit_item' => __( 'Edit Testimonial Category', MYSITE_ADMIN_TEXTDOMAIN ), 
			'update_item' => __( 'Update Testimonial Category', MYSITE_ADMIN_TEXTDOMAIN ),
			'add_new_item' => __( 'Add New Testimonial Category', MYSITE_ADMIN_TEXTDOMAIN ),
			'new_item_name' => __( 'New Testimonial Category Name', MYSITE_ADMIN_TEXTDOMAIN ),
			'separate_items_with_commas' => __( 'Separate Testimonial category with commas', MYSITE_ADMIN_TEXTDOMAIN ),
			'add_or_remove_items' => __( 'Add or remove testimonial category', MYSITE_ADMIN_TEXTDOMAIN ),
			'choose_from_most_used' => __( 'Choose from the most used testimonial category', MYSITE_ADMIN_TEXTDOMAIN )
		),
		'show_ui' => true,
		'show_in_nav_menus' => false,
		'query_var' => true,
		'rewrite' => false,
	));
}
endif;

if ( !function_exists( 'mysite_portfolio_date' ) ) :
/**
 *
 */
function mysite_portfolio_date() {
	global $post;
	
	$out = '';
	$_date = get_post_meta( $post->ID, '_date', true );
	
	if( !empty( $_date ) )
		$out .= '<p class="date">' . $_date . '</p>';
		
	echo apply_atomic( 'portfolio_date_single', $out );
}
endif;

if ( !function_exists( 'mysite_shortcodes_init' ) ) :
/**
 *
 */
function mysite_shortcodes_init() {
	foreach( mysite_shortcodes() as $shortcodes )
		require_once THEME_SHORTCODES . '/' . $shortcodes;
		
	if( is_admin() )
		return;
		
	# Long posts should require a higher limit, see http://core.trac.wordpress.org/ticket/8553
	@ini_set('pcre.backtrack_limit', 9000000);
		
	foreach( mysite_shortcodes() as $shortcodes ) {
		$class = 'mysite' . ucfirst( preg_replace( '/[0-9-_]/', '', str_replace( '.php', '', $shortcodes ) ) );
		$class_methods = get_class_methods( $class );

		foreach( $class_methods as $shortcode )
			if( $shortcode[0] != '_' && $class != 'mysiteLayouts' )
				add_shortcode( $shortcode, array( $class, $shortcode ) );
	}
}
endif;

if ( !function_exists( 'mysite_queryvars' ) ) :
/**
 *
 */
function mysite_queryvars( $query_vars ) {
	$query_vars[] = 'gallery';
	return $query_vars;
}
endif;

if ( !function_exists( 'mysite_rewrite_rules' ) ) :
/**
 *
 */
function mysite_rewrite_rules( $rules ) {
	$newrules = array();
	$newrules['(portfolio)/([^/]+)/gallery/([^/]+)/comment-page-([0-9]{1,})/?$'] = 'index.php?post_type=$matches[1]&name=$matches[2]&gallery=$matches[3]&cpage=$matches[4]';
	$newrules['(portfolio)/([^/]+)/gallery/([^/]+)'] = 'index.php?post_type=$matches[1]&name=$matches[2]&gallery=$matches[3]';
	return $newrules + $rules;
}
endif;

if ( !function_exists( 'mysite_color_variations' ) ) :
/**
 *
 */
function mysite_color_variations() {
	$variations = array(
		'red' => 'Red',
		'orange' => 'Orange',
		'yellow' => 'Yellow',
		'green' => 'Green',
		'olive' => 'Olive',
		'teal' => 'Teal',
		'blue' => 'Blue',
		'deepblue' => 'Deepblue',
		'purple' => 'Purple',
		'hotpink' => 'Hotpink',
		'slategrey' => 'Slategrey',
		'mauve' => 'Mauve',
		'pearl' => 'Pearl',
		'steelblue' => 'Steelblue',
		'mossgreen' => 'Mossgreen',
		'wheat' => 'Wheat',
		'coffee' => 'Coffee',
		'copper' => 'Copper',
		'silver' => 'Silver',
		'black' => 'Black' );

	return $variations;
}
endif;

if ( !function_exists( 'mysite_header_scripts' ) ) :
/**
 *
 */
function mysite_header_scripts() {
	global $post, $mysite;
	
	$script_header = apply_atomic_shortcode( 'script_header', '' );
	
	if( !empty( $script_header ) ) {
		echo $script_header;
		return;
	}
	
	$document_style[] = '<style type="text/css">';
	$document_style[] = '.noscript{visibility: hidden;}.ie .noscript{visibility: collapse;}';
	$document_style[] = '.noscript_dn{display: none;}';
	
	$active_skin = apply_filters( 'mysite_active_skin', get_option( MYSITE_ACTIVE_SKIN ) );
	$disable_cufon = apply_atomic( 'disable_cufon', mysite_get_setting( 'disable_cufon' ) );
	if( !empty( $active_skin ) && empty( $disable_cufon ) ) {
		
		if( !empty( $active_skin['cufon_gradients_fonts'] ) )
			$active_skin['fonts'] = array_merge( $active_skin['fonts'], $active_skin['cufon_gradients_fonts'] );
		
		$declarations = array_keys( $active_skin['fonts'] );
		$join_declarations = join( ',', str_replace( 'jqueryslidemenu a', 'jqueryslidemenu a span', $declarations ) );
		$document_style[] = "{$join_declarations}{opacity: 0;-ms-filter:\"progid:DXImageTransform.Microsoft.Alpha(Opacity=0)\";}";
	}
	$document_style[] = '</style>';
	$document_write = join( '', array_unique( $document_style ) );
	
	$nonce = home_url();
	$image_resize = mysite_get_setting( 'image_resize' );
	$skin_nt_writable = get_option( MYSITE_SKIN_NT_WRITABLE );
	$mysite_responsive = ( isset( $mysite->responsive ) ? 'true' : 'false' );
	
?><link rel="stylesheet" href="<?php echo esc_url( THEME_URI . '/shortcodes.css' ); ?>" type="text/css" media="screen" />
<link rel="stylesheet" href="<?php bloginfo( 'stylesheet_url' ); ?>" type="text/css" media="screen" />
<?php if( is_array( $skin_nt_writable ) && in_array( str_replace( '.css', '', $active_skin['style_variations'] ), $skin_nt_writable ) ) :
?><link rel="stylesheet" href="<?php echo esc_url( THEME_JS . '/css.php' ); ?>" type="text/css" media="screen" /><?php
	elseif( !empty( $active_skin['wpmu'] ) ) : global $blog_id;
?><link rel="stylesheet" href="<?php echo mysite_upload_dir( $key = 'baseurl' ) . '/styles/' . md5( THEME_NAME ) . 'muskin_' . $active_skin['style_variations']; ?>" type="text/css" media="screen" /><?php
	else :
?><link rel="stylesheet" href="<?php echo esc_url( THEME_URI . '/styles/' . $active_skin['style_variations'] ); ?>" type="text/css" media="screen" /><?php
	endif;
?>

	
<!--[if IE 6]> <link rel="stylesheet" type="text/css" href="<?php echo THEME_STYLES; ?>/_ie/ie6.css"> <![endif]-->
<!--[if IE 7]> <link rel="stylesheet" type="text/css" href="<?php echo THEME_STYLES; ?>/_ie/ie7.css"> <![endif]-->
<!--[if IE 8]> <link rel="stylesheet" type="text/css" href="<?php echo THEME_STYLES; ?>/_ie/ie8.css"> <![endif]-->
<?php if( $mysite_responsive == 'true' ) :
?><!--[if lt IE 9]> <script type="text/javascript" src="<?php echo THEME_JS; ?>/respond.min.js"></script> <![endif]-->
<?php endif;
if( mysite_get_setting( 'favicon_url' ) ) : ?>
<link rel="shortcut icon" href="<?php echo esc_url( mysite_get_setting( 'favicon_url' ) ) ?>" />
<?php endif; ?>
<?php if( mysite_get_setting( 'custom_css' ) ) :
?><style type="text/css">
<?php echo stripslashes( mysite_get_setting( 'custom_css' ) ) . "\n"; ?>
</style>
<?php endif; ?>
<?php $custom_css = get_post_meta( $post->ID, '_custom_css', true );
if( !empty( $custom_css ) ) :
?><style type="text/css">
<?php echo stripslashes( $custom_css ) . "\n"; ?>
</style>
<?php endif; ?>
<?php $mobile_custom_css = mysite_get_setting( 'mobile_custom_css' );
if( isset( $mysite->mobile ) && !empty( $mobile_custom_css ) ) :
?><style type="text/css">
<?php echo stripslashes( $mobile_custom_css ) . "\n"; ?>
</style>
<?php endif; ?>

<script type="text/javascript">
/* <![CDATA[ */
	var imageResize = "<?php echo mysite_get_setting( 'image_resize_type' ); ?>",
	    resizeDisabled = "<?php echo $image_resize[0]; ?>",
	    assetsUri = "<?php echo THEME_IMAGES_ASSETS; ?>",
        imageNonce = "<?php echo wp_create_nonce( $nonce ); ?>",
	    disableSlidemenu = "<?php if(defined('DISABLE_SLIDEMENU')){echo 'true';}else{echo 'false';} ?>",
	    prettyphotoTheme = "<?php if(defined('PRETTYPHOTO_THEME')){echo PRETTYPHOTO_THEME;}else{echo 'pp_default';} ?>",
	    imagePadding = "<?php echo $mysite->layout['images']['image_padding']; ?>",
	    responsiveSite = "<?php echo $mysite_responsive; ?>";
	document.write('<?php echo $document_write; ?>');
/* ]]> */
</script>
<?php
}
endif;

if ( !function_exists( 'mysite_logo' ) ) :
/**
 *
 */
function mysite_logo() {
	$out = '';
	
	$display_logo = mysite_get_setting( 'display_logo' );
	
	if( $display_logo ) {
		$logo_url = mysite_get_setting( 'logo_url' );
		
		if( $logo_url )
			$logo = '<img src="' . esc_url( mysite_get_setting( 'logo_url' ) ) . '" alt="' . esc_attr( get_bloginfo( 'name' ) ) . '"  />';
			
		elseif( !$logo_url ) {
			$active_skin = apply_filters( 'mysite_active_skin', get_option( MYSITE_ACTIVE_SKIN ) );
			$color_scheme = ( !empty( $active_skin['style_variations'] ) ) ? str_replace( '.css','', $active_skin['style_variations'] ) : '';
			
			if( @is_file( THEME_DIR . '/styles/' . $color_scheme . '/logo.png' ) )
				$logo = '<img src="'  . esc_url( THEME_URI ) . '/styles/' . $color_scheme . '/logo.png" alt="' . esc_attr( get_bloginfo( 'name' ) ) . '" />';
				
			else
				$logo = '<img src="'  . esc_url( THEME_URI ) . '/images/logo.png" alt="' . esc_attr( get_bloginfo( 'name' ) ) . '" />';
		}
		
	} elseif ( !$display_logo )
		$logo = get_bloginfo( 'name' );
		
	if( !empty( $logo ) ) {
		$class = ( !$display_logo ) ? ' class="site_title"' : ' class="site_logo"';
		$out .= '<div class="logo">';
		$out .= '<a rel="home" href="' . esc_url( home_url( '/' ) ) . '"' . $class . '>';
		$out .= $logo;
		$out .= '</a>';
		$out .= '</div><!-- .logo -->';
	}
	
	echo apply_atomic_shortcode( 'logo', $out );
}
endif;

if ( !function_exists( 'mysite_primary_menu' ) ) :
/**
 *
 */
function mysite_primary_menu() {
	global $mysite;
	
	$out = '<div id="primary_menu">';
	
	ob_start();	mysite_primary_menu_begin();
	$out .= ob_get_clean();
		
	$out .= wp_nav_menu(
		array(
		'theme_location' => 'primary-menu',
		'container_class' => 'jqueryslidemenu',
		'menu_class' => ( !has_nav_menu( 'primary-menu' ) ? 'jqueryslidemenu' : ''),
		'echo' => false,
		'walker' => ( has_nav_menu( 'primary-menu' ) ?  new mysiteDescriptionWalker() : '')
	));
	$out .= '<div class="clearboth"></div>';
	
	ob_start(); mysite_primary_menu_end();
	$out .= ob_get_clean();
	
	$out .= '</div><!-- #primary_menu -->';
	
	echo apply_atomic_shortcode( 'primary_menu', $out );
}
endif;

if ( !function_exists( 'mysite_responsive_menu' ) ) :
/**
 *
 */
function mysite_responsive_menu() {
	global $mysite;
	
	if( !isset( $mysite->responsive ) )
		return;
	
	# Responsive Dropdown Menu
	$out = '';
	
	if( has_nav_menu( 'primary-menu' ) ) {
		$out .= wp_nav_menu(
			array(
			'theme_location' => 'primary-menu',
			'container_id'    => 'responsive_menu',
			'container_class' => 'responsive_menu_container',
			'menu_class' => '',
			'echo' => false,
			'items_wrap' => '<select class="styled">%3$s</select>',
			'walker' => new mysiteResponsiveMenuWalker()
		));

		$out .= '<script type="text/javascript">
		/* <![CDATA[ */
		jQuery(function($) {
			$("#responsive_menu select").change(function() {
				window.location = $("#responsive_menu select option:selected").val();
			})
		});
		/* ]]> */
		</script>';
		
	} else {
		$out .= '<div id="responsive_menu"><span class="mysite_message">' . sprintf( __( '<a targe href="%1$s" target="_blank">Click Here</a> to configure this menu.', MYSITE_TEXTDOMAIN ), admin_url( 'nav-menus.php' ) ) . '</span></div>';
	}
	
	echo apply_atomic_shortcode( 'responsive_menu', $out );
}
endif;

if ( !function_exists( 'mysite_teaser' ) ) :
/**
 *
 */
function mysite_teaser() {
	global $author, $post, $mysite;
	
	$out = '';
	$teaser = '';
	$intro_text = '';
	
	if( is_front_page() ) {
		$home_text = '';
		$teaser_button = mysite_get_setting( 'teaser_button' );
		$teaser_button_text = mysite_get_setting( 'teaser_button_text' );
		
		if( ( $teaser_button != 'disable' ) && ( !empty( $teaser_button_text ) ) ) {
			if( $teaser_button == 'page' ) {
				$btn_page_id = mysite_get_setting( 'teaser_button_page' );
				
				if( !empty( $btn_page_id ) )
					$btn_link = get_permalink( $btn_page_id );
				else
					$btn_link = '#';
					
			} elseif( $teaser_button == 'custom' ) {
				$btn_link = ( mysite_get_setting( 'teaser_button_custom' ) )
				? mysite_get_setting( 'teaser_button_custom' ) : '#';
			}
			
			$home_text .= '<a class="button_link call_to_action alignright" href="' . esc_url( $btn_link ) . '"><span>' . stripslashes( $teaser_button_text ) . '</span></a>';
		}
		
		$homepage_teaser_text = mysite_get_setting( 'homepage_teaser_text' );
		if( !empty( $homepage_teaser_text ) ) {
			if( preg_match('/\</', $homepage_teaser_text ) ) 
				$home_text .= stripslashes( $homepage_teaser_text );
			else
				$home_text .= '<h3>' . stripslashes( $homepage_teaser_text ) . '</h3>';
		}
	}
	
	if( is_singular() ) {
		$intro_text = get_post_meta( $post->ID, '_intro_text', true );
		$blog_page = mysite_blog_page();
		
		if ( empty( $intro_text ) )
			$intro_text = 'default';
		
		# Intro text post meta overide
		if( $intro_text != 'default' ) {
			
			if( in_array( $intro_text, array( 'title_only', 'title_teaser', 'title_tweet' ) ) ) {
				if( ( is_singular( 'post' ) ) && ( is_numeric( $blog_page ) ) )
					$title = apply_atomic( 'teaser_single_title', get_the_title( $blog_page ) );
					
				elseif( is_singular( 'portfolio' ) )
					$title = __('Portfolio', MYSITE_TEXTDOMAIN );
				
				else
					$title = get_the_title( $post->ID );
			}
			
			if( $intro_text == 'custom' )
				$raw =  get_post_meta( $post->ID, '_intro_custom_html', true );
			
			if( $intro_text == 'title_teaser' )
				$text =  get_post_meta( $post->ID, '_intro_custom_text', true );
				
			if( $intro_text == 'title_tweet' ) {
				$twitter_id = mysite_get_setting( 'twitter_id' );
				$limit = '1';
				$twitter_type = 'teaser';
				$text =  Mysitemyway_Twitter::get_instance()->display_tweets( $twitter_id, $limit, $twitter_type );
			}
			
			if( $intro_text == 'banner' ) {
				$title = get_the_title( $post->ID );
				$banner = get_post_meta( $post->ID, '_intro_custom_banner', true );
			}
			
		# Default intro text options
		} else {
			$intro_options = mysite_get_setting('intro_options');
			
			if( in_array( $intro_options, array( 'title_only', 'title_teaser', 'title_tweet' ) ) ) {
				if( ( is_singular( 'post' ) ) && ( is_numeric( $blog_page ) ) )
					$title = apply_atomic( 'teaser_single_title', get_the_title( $blog_page ) );
					
				elseif( is_singular( 'portfolio' ) )
					$title = __('Portfolio', MYSITE_TEXTDOMAIN );
				
				else
					$title = get_the_title( $post->ID );
			}
			
			if( $intro_options == 'custom' )
			 	$raw =  mysite_get_setting('custom_teaser_html');
			
			if( $intro_options == 'title_teaser' )
			 	$text =  mysite_get_setting('custom_teaser');
			
			if( $intro_options == 'title_tweet' ) {
				$twitter_id = mysite_get_setting( 'twitter_id' );
				$limit = '1';
				$twitter_type = 'teaser';
				$text =  Mysitemyway_Twitter::get_instance()->display_tweets( $twitter_id, $limit, $twitter_type );
			}
			
		}
	}
	
	if ( is_search() ) {
		$intro_options = mysite_get_setting( 'intro_options' );
		if( $intro_options != 'disable' ) {
			$title = __( 'Search', MYSITE_TEXTDOMAIN );
			$text = sprintf( __('Search Results for: %1$s', MYSITE_TEXTDOMAIN ), '&lsquo;' . get_search_query() . '&rsquo;');
		}
	}
	
	if ( is_archive() ) {
		$intro_options = mysite_get_setting( 'intro_options' );
		if( $intro_options != 'disable' ) {
			$title =  __( 'Archives', MYSITE_TEXTDOMAIN );
			if( is_category() ) {
				$text = sprintf( __('Category Archive for: %1$s', MYSITE_TEXTDOMAIN ), '&lsquo;' . single_cat_title('',false) . '&rsquo;');
			} elseif ( is_tag () ) {
				$text = sprintf( __('All Posts Tagged Tag: %1$s', MYSITE_TEXTDOMAIN ), '&lsquo;' . single_tag_title('',false) . '&rsquo;');
			} elseif ( is_day() ) {
				$text = sprintf( __('Daily Archive for: %1$s', MYSITE_TEXTDOMAIN ), '&lsquo;' . get_the_time('F jS, Y') . '&rsquo;');
			} elseif ( is_month() ) {
				$text = sprintf( __('Monthly Archive for: %1$s', MYSITE_TEXTDOMAIN ), '&lsquo;' . get_the_time('F, Y') . '&rsquo;');
			} elseif ( is_year() ) {
				$text = sprintf( __('Yearly Archive for: %1$s', MYSITE_TEXTDOMAIN ), '&lsquo;' . get_the_time('Y') . '&rsquo;');
			} elseif ( is_author() ) {
				$curauth = get_userdata( intval($author) );
				$text = sprintf( __('Author Archive for: %1$s', MYSITE_TEXTDOMAIN ), '&lsquo;' . $curauth->nickname . '&rsquo;');
			} elseif ( is_tax() ) {
				$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
				$text = sprintf( __('Archives for: %1$s', MYSITE_TEXTDOMAIN ), '&lsquo;' . $term->name . '&rsquo;');
			}
		} 
	}
	
	if( is_404() ) {
		$intro_options = mysite_get_setting( 'intro_options' );
		if( $intro_options != 'disable' ) {
			$title =  __( 'Not Found', MYSITE_TEXTDOMAIN );
		}
	}
	
	if( isset( $title ) )
		$teaser .= '<h1 class="intro_title"><span>' . $title . '</span></h1>';
	
	if( isset( $text ) )
		$teaser .= '<p class="teaser"><span>' . stripslashes( $text ) . '</span></p>';
		
	if( !empty( $home_text ) )
		$teaser = stripslashes( $home_text );
		
	if( isset( $raw ) )
		$teaser = stripslashes( $raw );
		
	if( $intro_text == 'banner' && !empty( $banner['url'] ) ) {
		
		$banner_title = get_the_title();
		
		$teaser = '<div class="image_banner_intro">';
		
		$img_args = array( 'src' => esc_url(stripslashes( $banner['url'] )), 'alt' => $banner_title, 'title' => $banner_title, 'class' => 'image_banner', 'disable_resize' => true );
		
		if( isset( $banner['enable_resize'] ) ) {
			$banner_width = $mysite->layout['additional_images']['image_banner_intro'][0];
			$banner_height = $mysite->layout['additional_images']['image_banner_intro'][1];
			$img_args = array_merge( $img_args, array( 'width'=> $banner_width, 'height' => $banner_height ) );
			unset( $img_args['disable_resize'] );
		}
		
		$teaser .=  mysite_display_image( $img_args );
		
		if ( isset( $banner['title'] ) )
			$teaser .= '<h1 class = "intro_title"><span>' . $title . '</span></h1>';
			
		$teaser .= '</div>';
	}
	
	if( !empty( $teaser ) )	{
		$out .= '<div id="intro">';
		$out .= '<div id="intro_inner">';
		
		if( isset( $raw ) )
			$out .= '<div class="raw_html_intro">';
		
		ob_start(); mysite_intro_begin();
		$out .= ob_get_clean();
		
		$out .= $teaser;
		
		ob_start(); mysite_intro_end( array( 'text' => ( !empty( $text ) ? true : false ), 'raw' => ( !empty( $raw ) ? true : false ) ) );
		$out .= ob_get_clean();
		
		if( $intro_text != 'banner' )
			$out .= '<div class="clearboth"></div>';
		
		if( isset( $raw ) )
			$out .= '</div><!-- #raw_html_intro -->';
			
		$out .= '</div><!-- #intro_inner -->';
		$out .= '</div><!-- #intro -->';
	}
	
	echo apply_atomic_shortcode( 'teaser', $out );
}
endif;

if ( !function_exists( 'mysite_breadcrumbs' ) ) :
/**
 *
 */
function mysite_breadcrumbs() {
	if( is_front_page() )
		return;
		
	global $wp_query;
	
	$post_obj = $wp_query->get_queried_object();
	
	if( !empty( $post_obj ) && !empty( $post_obj->ID ) && get_post_meta( $post_obj->ID, '_disable_breadcrumbs', true ) )
		return;
		
	$disable_breadcrumb = apply_atomic( 'disable_breadcrumb', mysite_get_setting( 'disable_breadcrumbs' ) );
	
	if( !empty( $disable_breadcrumb ) )
		return;
	
	$out = '<div id="breadcrumbs">';
	$out .= '<div id="breadcrumbs_inner">';
	
	$out .= breadcrumbs_plus();
	
	$out .= '</div><!-- #breadcrumbs_inner -->';
	$out .= '</div><!-- #breadcrumbs -->';
	
	echo apply_atomic( 'breadcrumbs', $out );
}
endif;


if ( !function_exists( 'mysite_post_title' ) ) :
/**
 *
 */
function mysite_post_title( $args = array() ) {
	global $post;
	
	$defaults = array(
		'shortcode' => false,
		'echo' => true
	);
	
	$args = wp_parse_args( $args, $defaults );
	
	extract( $args );
	
	if( is_page() && !$shortcode )
		return;
	
	$title = '';
	
	if( $shortcode && $type == 'blog_list' && $thumb == 'small' )
		$title = the_title( '<p class="post_title"><a href="' . esc_url( get_permalink() ) . '" title="' .
		esc_attr( the_title_attribute( 'echo=0' ) ) . '" rel="bookmark">', '</a></p>', false );
		
	elseif( $shortcode && $type == 'blog_grid' && ( $column == 3 || $column == 4 ) )
		$title = the_title( '<h3 class="post_title"><a href="' . esc_url( get_permalink() ) . '" title="' .
		esc_attr( the_title_attribute( 'echo=0' ) ) . '" rel="bookmark">', '</a></h3>', false );
			
	elseif( is_single() && !is_attachment() )
		$title = the_title( '<h2 class="post_title">', '</h2>', false );
		
	elseif( is_attachment() && mysite_get_setting ( 'intro_options' ) == 'disable' )
		$title = the_title( '<h2 class="post_title"><a href="' . esc_url( get_permalink() ) . '" title="' .
		esc_attr( the_title_attribute( 'echo=0' ) ) . '" rel="bookmark">', '</a></h2>', false );
		
	elseif( !is_attachment() )
		$title = the_title( '<h2 class="post_title"><a href="' . esc_url( get_permalink() ) . '" title="' .
		esc_attr( the_title_attribute( 'echo=0' ) ) . '" rel="bookmark">', '</a></h2>', false );

	if( $echo )
		echo apply_atomic( 'entry_title', $title );
	else
		return apply_atomic( 'entry_title', $title );
}
endif;

if ( !function_exists( 'mysite_page_title' ) ) :
/**
 *
 */
function mysite_page_title() {
	$title = '';
	
	if( is_404() ) return;
	
	$intro_options = mysite_get_setting( 'intro_options' );
	
	if ( is_search() ) {
		$title = sprintf( __('Search Results for: %1$s', MYSITE_TEXTDOMAIN ), '&lsquo;' . get_search_query() . '&rsquo;');
	} elseif ( is_category() ) {
		$title = sprintf( __('Category Archive for: %1$s', MYSITE_TEXTDOMAIN ), '&lsquo;' . single_cat_title('',false) . '&rsquo;');
	} elseif ( is_tag () ) {
		$title = sprintf( __('All Posts Tagged Tag: %1$s', MYSITE_TEXTDOMAIN ), '&lsquo;' . single_tag_title('',false) . '&rsquo;');
	} elseif ( is_day() ) {
		$title = sprintf( __('Daily Archive for: %1$s', MYSITE_TEXTDOMAIN ), '&lsquo;' . get_the_time('F jS, Y') . '&rsquo;');
	} elseif ( is_month() ) {
		$title = sprintf( __('Monthly Archive for: %1$s', MYSITE_TEXTDOMAIN ), '&lsquo;' . get_the_time('F, Y') . '&rsquo;');
	} elseif ( is_year() ) {
		$title = sprintf( __('Yearly Archive for: %1$s', MYSITE_TEXTDOMAIN ), '&lsquo;' . get_the_time('Y') . '&rsquo;');
	} elseif ( is_author() ) {
		global $author;
		$curauth = get_userdata( intval($author) );
		$title = sprintf( __('Author Archive for: %1$s', MYSITE_TEXTDOMAIN ), '&lsquo;' . $curauth->nickname . '&rsquo;');
	} elseif ( is_tax() ) {
		$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
		$title = sprintf( __('Archives for: %1$s', MYSITE_TEXTDOMAIN ), '&lsquo;' . $term->name . '&rsquo;');
	}
	
	if( !empty( $title ) && $intro_options == 'disable' )
		echo '<h1 class="page_title">' . $title . '</h1>';
		
	elseif( is_page() ) {
		global $wp_query;
		
		$post_obj = $wp_query->get_queried_object();
		$post_id = $post_obj->ID;

		$_layout = get_post_meta( $post_id, '_intro_text', true );
		$template = get_post_meta( $post_id, '_wp_page_template', true );
		
		if( $_layout == 'disable' && $template != 'template-featuretour.php' )
			echo the_title( '<h1 class="page_title">', '</h1>', false );
			
		elseif( $_layout == 'default' && $intro_options == 'disable' && $template != 'template-featuretour.php' )
			echo the_title( '<h1 class="page_title">', '</h1>', false );
	}
	
}
endif;

if ( !function_exists( 'mysite_home_content' ) ) :
/**
 *
 */
function mysite_home_content() {
	if( !is_front_page() )
		return;
	
	$out = '';
	
	if( mysite_get_setting( 'content' ) ) {
		$content = stripslashes( mysite_get_setting( 'content' ) ); 
		$content = apply_filters( 'the_content', $content );
		
		$out .= '<div class="page">';
		$out .= $content;
		$out .= '</div>';
	}
	
	echo apply_atomic_shortcode( 'home_content', $out );;
}
endif;

if ( !function_exists( 'mysite_excerpt_length_long' ) ) :
function mysite_excerpt_length_long( $length ) {
	return 60;
}
endif;

if ( !function_exists( 'mysite_excerpt_length_medium' ) ) :
function mysite_excerpt_length_medium( $length ) {
	return 45;
}
endif;

if ( !function_exists( 'mysite_excerpt_length_short' ) ) :
function mysite_excerpt_length_short( $length ) {
	return 20;
}
endif;

if ( !function_exists( 'mysite_excerpt_more' ) ) :
function mysite_excerpt_more( $more ) {
	return ' ...';
}
endif;

if ( !function_exists( 'mysite_read_more' ) ) :
function mysite_read_more() {
	global $post;
	$out = '<span class="post_more_link"><a class="post_more_link_a" href="' . esc_url( get_permalink( $post->ID ) ) . '">' . __( 'Read More', MYSITE_TEXTDOMAIN ) . '</a></span>';
	return $out;
}
endif;

if ( !function_exists( 'mysite_full_read_more' ) ) :
function mysite_full_read_more( $more_link, $more_link_text ) {
	global $post;
	$out = '<span class="post_more_link"><a class="post_more_link_a" href="' . esc_url( get_permalink( $post->ID ) ) . '#more-' . $post->ID . '">' . __( 'Read More', MYSITE_TEXTDOMAIN ) . '</a></span>';
	return '<!--start_raw-->' . $out . '<!--end_raw-->';
}
endif;

if ( !function_exists( 'mysite_post_content' ) ) :
/**
 *
 */
function mysite_post_content( $args = array() ) {
	global $mysite;
	
	extract( $args );
	
	$column = !empty( $column ) ? $column : '';
	$type = !empty( $type ) ? $type : '';
	$thumb = !empty( $thumb ) ? $thumb : '';
	$blog_layout = !empty( $blog_layout ) ? $blog_layout : '';
		
	if( $blog_layout == 'blog_layout2' || ( $type == 'blog_list' && $thumb == 'medium' ) )
		add_filter( 'excerpt_length', 'mysite_excerpt_length_medium', 999 );
	
	elseif( empty( $featured_post ) && $blog_layout != 'blog_layout1' && $column != 1 && $thumb != 'large' )
		add_filter( 'excerpt_length', 'mysite_excerpt_length_short', 999 );

	if( !empty( $post_content ) && $post_content == 'full' ) {
		global $more;
		$more = 0;
		the_content();
	} else {
		the_excerpt();
		$permalink = get_permalink( get_the_ID() );
		
		if( ( !empty( $disable ) && strpos( $disable, 'more' ) === false ) || empty( $disable ) )
			echo apply_filters( 'mysite_read_more', $permalink );
	}
}
endif;

if ( !function_exists( 'mysite_page_content' ) ) :
/**
 *
 */
function mysite_page_content() {
	if( !is_front_page() )
		return;
		
	$content = mysite_get_setting( 'mainpage_content' );
		
	if( $content ){
		$args = array( 'post_type'=>'page', 'post__in' => array( $content ) );
			
		$my_query = new WP_Query( $args );
			
		if ( $my_query->have_posts() ) {
			global $more;
			while ( $my_query->have_posts() ) { 
				$my_query->the_post();
				echo '<div class="' . join( ' ', get_post_class( 'page' ) ) . '">';
				$more = 0;
		        the_content();
				echo '</div>';
			}
		}
		
		wp_reset_postdata();
	}
}
endif;

if ( !function_exists( 'mysite_featured_post' ) ) :
/**
 *
 */
function mysite_featured_post( $return = false ) {
	global $wp_query, $mysite;
	
	$paged = mysite_get_page_query();
	$layout = $mysite->layout['blog'];
	$post_content = ( mysite_get_setting( 'display_full' ) ? 'full' : '' );
	
	if( $paged != 1 )
		return;
		
	elseif( is_archive() || is_search() )
		return;

	elseif( $layout['blog_layout'] != 'blog_layout3' )
		return;
		
	$temp = $wp_query;
	$wp_query= null;
	remove_filter( 'post_limits', 'my_post_limit' );
	$wp_query = new WP_Query();
	
	if( $return == false )
		$wp_query->query( array( 'posts_per_page' => $layout['featured'], 'post_type' => 'post', 'ignore_sticky_posts' => 1 ) );
	else
		return $wp_query->query( array( 'posts_per_page' => $layout['featured'], 'post_type' => 'post', 'ignore_sticky_posts' => 1 ) );
	
	?><div id="post-<?php the_ID(); ?>" <?php post_class( $layout['post_class'] . ' featured_post_module' ); ?>><?php
	
	while ($wp_query->have_posts()) : $wp_query->the_post(); ?>
	
		<?php mysite_before_post( array( 'featured_post' => true, 'post_id' => get_the_ID() ) ); ?>
	
		<div class="<?php echo $layout['content_class']; ?>">
			
			<?php mysite_before_entry(); ?>

			<div class="post_excerpt">
				<?php mysite_post_content( array( 'featured_post' => true, 'blog_layout' => $layout['blog_layout'], 'post_content' => $post_content ) ); ?>
			</div>
			
			<?php mysite_after_entry(); ?>
	
		</div><!-- .content_class -->
		
	<?php endwhile;
	
	?></div><div class="clearboth"></div><?php
	
	$wp_query = null;
	$wp_query = $temp;
}
endif;

if ( !function_exists( 'mysite_query_posts' ) ) :
/**
 *
 */
function mysite_query_posts() {
	global $wp_query, $mysite;
	
	$post_obj = $wp_query->get_queried_object();
	$exclude_categories = mysite_exclude_category_string();
	$blog_layout = $mysite->layout['blog']['blog_layout'];
	$mysite->offset = ( $blog_layout == 'blog_layout3' ) ? $mysite->layout['blog']['featured'] : false;
	$paged = mysite_get_page_query();
		
	if( !empty( $exclude_categories ) )			
		$query_string = "cat={$exclude_categories}&paged={$paged}";
	else
		$query_string = "paged={$paged}";
		
	if( !empty( $mysite->offset ) )
		$query_string = $query_string . "&offset={$mysite->offset}";
		
	if( isset( $mysite->is_blog ) )
		return query_posts( $query_string ); 
		
	if( is_archive() || is_search() ) {
		
		if( is_archive() )
			$mysite->archive = true;
		else if( is_search() )
			$mysite->search = true;
		
		$args = array_merge( $wp_query->query, array( 'post_type'=> 'post', 'category__not_in' => mysite_exclude_category_string( $minus = false ) ) );
		return query_posts( $args );
	
	} elseif( !empty( $post_obj->ID ) ){
		$blog_page = mysite_blog_page();
		if( $blog_page == $post_obj->ID ) {
			$mysite->is_blog = true;
			$mysite->blog_page = $post_obj->ID;
			
			if( !empty( $mysite->offset ) ) {
				$mysite->posts_per_page = get_option( 'posts_per_page' );
				add_filter( 'post_limits', 'my_post_limit' );
			}
			
			return query_posts( $query_string );
		}
		
	} elseif( ( is_front_page() && mysite_get_setting( 'frontpage_blog' ) ) || ( !empty( $post_obj->ID ) && get_option('page_for_posts') == $post_obj->ID ) ) {
		if( !empty( $mysite->offset ) ) {
			$mysite->posts_per_page = get_option( 'posts_per_page' );
			add_filter( 'post_limits', 'my_post_limit' );
		}

		$args = array_merge( $wp_query->query, array( 'post_type'=> 'post', 'paged'=> $paged, 'offset' => $mysite->offset, 'category__not_in' => mysite_exclude_category_string( $minus = false ) ) );
		return query_posts( $args );
	}
		
	return false;
}
endif;

if ( !function_exists( 'mysite_post_meta' ) ) :
/**
 *
 */
function mysite_post_meta( $args = array() ) {
	$defaults = array(
		'shortcode' => false,
		'echo' => true
	);
	
	$args = wp_parse_args( $args, $defaults );
	
	extract( $args );
	
	if( is_page() && !$shortcode ) return;
	
	$out = '';
	$meta_options = mysite_get_setting( 'disable_meta_options' );
	$_meta = ( is_array( $meta_options ) ) ? $meta_options : array();
	$meta_output = '';
	
	if( !in_array( 'date_meta', $_meta ) )
		$meta_output .= '[post_date text="' . __( '<em>Posted on:</em>', MYSITE_TEXTDOMAIN ) . ' "] ';
		
	if( !in_array( 'comments_meta', $_meta ) )
		$meta_output .= '[post_comments text="' . __( '<em>With:</em>', MYSITE_TEXTDOMAIN ) . ' "] ';
		
	if( !in_array( 'author_meta', $_meta ) )
		$meta_output .= '[post_author text="' . __( '<em>Posted by:</em>', MYSITE_TEXTDOMAIN ) . ' "] ';
	
	if( !empty( $meta_output ) )
		$out .='<p class="post_meta">' . $meta_output . '</p>';
	
	if( $echo )
		echo apply_atomic_shortcode( 'post_meta', $out );
	else
		return apply_atomic_shortcode( 'post_meta', $out );
}
endif;

if ( !function_exists( 'mysite_post_meta_bottom' ) ) :
/**
 *
 */
function mysite_post_meta_bottom() {
	if( is_page() ) return;
	
	$out = '';
	$meta_options = mysite_get_setting( 'disable_meta_options' );
	$_meta = ( is_array( $meta_options ) ) ? $meta_options : array();
	$meta_output = '';

	if( !in_array( 'categories_meta', $_meta ) )
		$meta_output .= '[post_terms taxonomy="category" text=' . __( '<em>Categories:</em>&nbsp;', MYSITE_TEXTDOMAIN ) . '] ';

	if( !in_array( 'tags_meta', $_meta ) )
		$meta_output .= '[post_terms text=' . __( '<em>Tags:</em>&nbsp;', MYSITE_TEXTDOMAIN ) . ']';

	if( !empty( $meta_output ) )
		$out .='<p class="post_meta_bottom">' . $meta_output . '</p>';
	
	echo apply_atomic_shortcode( 'post_meta_bottom', $out );
}
endif;

if ( !function_exists( 'mysite_before_post_sc' ) ) :
/**
 *
 */
function mysite_before_post_sc( $filter_args ) {
	$out = '';
	
	if( strpos( $filter_args['disable'], 'image' ) === false )
		$out .= mysite_get_post_image( $filter_args );
	
	if( strpos( $filter_args['disable'], 'title' ) === false )
		$out .= mysite_post_title( $filter_args );
	
	return $out;
}
endif;


if ( !function_exists( 'mysite_before_entry_sc' ) ) :
/**
 *
 */
function mysite_before_entry_sc( $filter_args ) {
	$out = '';
	
	if( strpos( $filter_args['disable'], 'meta' ) === false )
		$out .= mysite_post_meta( $filter_args );
	
	return $out;
}
endif;

if ( !function_exists( 'mysite_after_entry_sc' ) ) :
/**
 *
 */
function mysite_after_entry_sc( $filter_args ) {
	
}
endif;

if ( !function_exists( 'mysite_post_image' ) ) :
/**
 *
 */
function mysite_post_image( $args = array() ) {
	global $wp_query, $mysite;
	
	$post_obj = $wp_query->get_queried_object();
	
	extract( $args );
	
	# if portfolio post image disables
	$type = get_post_type();
	if( $type == 'portfolio' ) {
		$_fullsize = get_post_meta( get_the_ID(), '_fullsize', true );
		if( $_fullsize ) return;
	}
	
	# if featured image image disables
	if( is_single() ) {
		$_disable_post_image = get_post_meta( $post_obj->ID, '_disable_post_image', true );
		if( !empty( $_disable_post_image ) ) return;
	}
		
	
	$width = '';
	$height = '';
	
	$index = ( isset( $index ) ) ? $index : '';
	$post_layout = $mysite->layout['blog']['blog_layout'];
	
	if( !empty( $mysite->is_blog ) ) {
		$page_layout = mysite_get_setting( 'page_layout' );
		$_layout = get_post_meta( $mysite->blog_page, '_layout', true );
		$_layout = ( empty( $_layout ) ) ? $page_layout : $_layout;
		$img_layout = ( $_layout == 'full_width' ? 'images' : ( $_layout == 'left_sidebar' ? 'small_sidebar_images' : 'big_sidebar_images' ) );
		
	} elseif( !empty( $post_obj->ID ) && empty( $mysite->archive ) ) {
		$post_layout = mysite_get_setting( 'post_layout' );
		$_layout = get_post_meta( $post_obj->ID, '_layout', true );
		$_layout = ( empty( $_layout ) ) ? $post_layout : $_layout;
		$img_layout = ( $_layout == 'full_width' ? 'images' : ( $_layout == 'left_sidebar' ? 'small_sidebar_images'
		: ( empty( $_layout ) && $type == 'portfolio' ? 'images': 'big_sidebar_images' ) ) );
		
	} elseif( !empty( $mysite->archive ) ) {
		$_layout = mysite_get_setting( 'archive_layout' );
		$img_layout = ( $_layout == 'full_width' ? 'images' : ( $_layout == 'left_sidebar' ? 'small_sidebar_images' : 'big_sidebar_images' ) );
		
	} elseif( !empty( $mysite->search ) ) {
		$_layout = mysite_get_setting( 'search_layout' );
		$img_layout = ( $_layout == 'full_width' ? 'images' : ( $_layout == 'left_sidebar' ? 'small_sidebar_images' : 'big_sidebar_images' ) );
		
	} elseif( is_front_page() ) {
		$_layout = mysite_get_setting( 'homepage_layout' );
		$img_layout = ( $_layout == 'full_width' ? 'images' : ( $_layout == 'left_sidebar' ? 'small_sidebar_images' : 'big_sidebar_images' ) );
	}
	
	$img_class = ( is_single() || is_page() ) ? 'single_post_image' : $mysite->layout['blog']['img_class'];
	
	$img_sizes = ( !empty( $featured_post ) ? 'one_column_blog'
	: ( $post_layout == 'blog_layout2' ? 'medium_post_list'
	: ( $post_layout == 'blog_layout1' ? 'one_column_blog' : 'two_column_blog'
	)));
	
	if( is_singular( 'portfolio' ) )
		$img_sizes = 'portfolio_single_full';
		
	elseif( $additional_image_sizes = mysite_additional_image_sizes( $img_sizes, $img_layout ) ) {
		$img_sizes = $additional_image_sizes['img_sizes'];
		$img_layout = $additional_image_sizes['img_layout'];
		
	} elseif( is_single() || is_page() ) {
		$img_sizes = 'one_column_blog';
		
	} else {
		$img_sizes = $img_sizes;
	}
	
	$width = $mysite->layout[$img_layout][$img_sizes][0];
	$height = $mysite->layout[$img_layout][$img_sizes][1];
	
	if( !empty( $post_obj->ID ) )
		$_featured_video = get_post_meta( $post_obj->ID, '_featured_video', true );
		
	elseif( !empty( $post_id ) )
		$_featured_video = get_post_meta( $post_id, '_featured_video', true );
	
	$args = array(
		'index' => $index,
		'width' => $width,
		'height' => $height,
		'img_class' => $img_class,
		'link_class' => 'blog_index_image_load',
		'video' => ( !empty( $_featured_video ) ? $_featured_video : false ),
		'inline_width' => ( $post_layout == 'blog_layout2' ? true : false ),
		'featured_post' => ( !empty( $featured_post ) ? true : false )
	);
	
	if( is_singular( 'portfolio' ) && $_layout == 'full_width' )
		$args = array_merge( $args, array( 'portfolio_full' => true ) );
	
	mysite_get_post_image( $args );
}
endif;

if ( !function_exists( 'mysite_page_navi' ) ) :
/**
 *
 */
function mysite_page_navi() {
	echo mysite_pagenavi();
}
endif;

if ( !function_exists( 'mysite_post_nav' ) ) :
/**
 *
 */
function mysite_post_nav() {
	$disable_post_nav = apply_atomic( 'disable_post_nav', mysite_get_setting( 'disable_post_nav' ) );
	if( !empty( $disable_post_nav ) )
		return;
	
?><div class="post_nav_module">
	<div class="previous_post"><?php previous_post_link( '%link', '%title' ); ?></div>
	<div class="next_post"><?php next_post_link( '%link', '%title' ); ?></div>
</div><!-- #nav-below -->
<?php
}
endif;

if ( !function_exists( 'mysite_post_sociables' ) ) :
/**
 *
 */
function mysite_post_sociables() {
	$out = '';
	
	$social_bookmarks = mysite_get_setting( 'social_bookmarks' );
	$social_bookmarks_post = get_post_meta( get_the_ID(), '_disable_social_bookmarks', true );
	
	if( empty( $social_bookmarks ) && empty( $social_bookmarks_post ) ) {
		$out .= '<div class="share_this_module">';
		
		$out .= '<h3 class="share_this_title">' . __( 'Share this:', MYSITE_TEXTDOMAIN ) . '</h3>';
		
		$out .= '<div class="share_this_content">';
		
		$out .= mysite_sociable_bookmarks();
		
		$out .= '</div><!-- .share_this_content -->';
		$out .= '</div><!-- .share_this_module -->';
	}
	
	echo apply_filters( 'mysite_post_sociables', $out );
}
endif;

if ( !function_exists( 'mysite_about_author' ) ) :
/**
 *
 */
function mysite_about_author() {
	$disable_post_author = apply_atomic( 'disable_post_author', mysite_get_setting( 'disable_post_author' ) );
	if( !is_singular( 'post' ) || !empty( $disable_post_author ) )
		return;
		
	$out = '';
	
	if( get_the_author_meta( 'description' ) ) {
		$out .= '<div class="about_author_module">';
		$out .= '<h3 class="about_author_title">' . __( 'About the Author', MYSITE_TEXTDOMAIN ) . '</h3>';
		$out .= '<div class="about_author_content">';
		
		$out .= get_avatar( get_the_author_meta('user_email'), apply_filters( 'mysite_author_avatar_size', '80' ), THEME_IMAGES_ASSETS . '/author_gravatar_default.png' );
		$out .= '<p class="author_bio"><span class="author_name">' . esc_attr(get_the_author()) . '</span>' . get_the_author_meta( 'description' );
		$out .= '[fancy_link link="' . get_author_posts_url( get_the_author_meta( 'ID' ) ) . '"]' . sprintf( __( 'View all posts by %s', MYSITE_TEXTDOMAIN ), get_the_author() ) . '[/fancy_link]';
		$out .= '</p><!-- .author_bio -->';
		
		$out .= '<div class="clearboth"></div>';
		$out .= '</div><!-- .about_author_content -->';
		$out .= '</div><!-- .about_author_module -->';
	}
	
	echo apply_atomic_shortcode( 'about_author', $out );
}
endif;

if ( !function_exists( 'mysite_like_module' ) ) :
/**
 *
 */
function mysite_like_module() {
	if( !is_singular( 'post' ) )
		return;
	
	$out = '';
	$popular_posts = '';
	$related_posts = '';
	
	$option = apply_atomic( 'post_like_module', mysite_get_setting( 'post_like_module' ) );
	
	if( $option == 'disable' )
		return;
	
	if( $option == 'column' ) {
		
		$popular_posts = mysite_popular_posts( array( 'showposts' => 3, 'module' => $option ) );
		$related_posts = mysite_related_posts( array( 'showposts' => 3, 'module' => $option ) );
		
		$out .= apply_filters( 'mysite_additional_posts_title', '<h3 class="additional_posts_title">' . __( 'Additional Posts', MYSITE_TEXTDOMAIN ) . '</h3>' );
		
		$out .= '<div class="one_half">';
		$out .= '<div class="additional_posts">';
		$out .= '<h4>' . __( 'Popular Posts', MYSITE_TEXTDOMAIN ) . '</h4>';
		$out .= $popular_posts;
		$out .= '</div>';
		$out .= '</div>';
		
		$out .= '<div class="one_half last">';
		$out .= '<div class="additional_posts">';
		$out .= '<h4>' . __( 'Related Posts', MYSITE_TEXTDOMAIN ) . '</h4>';
		$out .= $related_posts;
		$out .= '</div>';
		$out .= '</div>';
	}
	
	if( $option == 'tab' ) {
		
		$popular_posts = mysite_popular_posts( array( 'showposts' => 4, 'module' => $option ) );
		$related_posts = mysite_related_posts( array( 'showposts' => 4, 'module' => $option ) );
		
		$out .= '<div class="blog_tabs_container">';
		
		$out .= '<ul class="blog_tabs">';
		$out .= '<li><a href="#" class="current">' . __( 'Popular Posts', MYSITE_TEXTDOMAIN ) . '</a></li>';
		$out .= '<li><a href="#">' . __( 'Related Posts', MYSITE_TEXTDOMAIN ) . '</a></li>';
		$out .= '</ul>';
		
		$out .= '<div class="blog_tabs_content">' . $popular_posts . '</div>';
		$out .= '<div class="blog_tabs_content">' . $related_posts . '</div>';
		
		$out .= '</div>';
	}
	
	if ( !empty( $popular_posts ) || !empty( $related_posts ) )
		echo '<div class="additional_posts_module">' . $out . '</div>';
	else
		echo $out;
}
endif;

if ( !function_exists( 'mysite_popular_posts' ) ) :
/**
 *
 */
function mysite_popular_posts( $args = array() ) {
	global $post;
	
	$out = '';
	
	extract( $args );

	$popular_query = new WP_Query(array(
		'showposts' => $showposts, 
		'nopaging' => 0, 
		'orderby'=> 'comment_count', 
		'post_status' => 'publish',
		'category__not_in' => array( mysite_exclude_category_string( $minus = false ) ),
		'ignore_sticky_posts' => 1
	));
	
	if ( $popular_query->have_posts() ) {
		
		global $mysite;
		$img_sizes = ( $module == 'column' ) ? 'small_post_list' : 'additional_posts_grid';
		$_layout = get_post_meta( $post->ID, '_layout', true );
		if( empty( $_layout ) )
			$_layout = mysite_get_setting( 'post_layout' );
		
		$img_layout = ( $_layout == 'full_width' ? 'images'
		: ( $_layout == 'left_sidebar'
		? 'small_sidebar_images' : 'big_sidebar_images' ) );
		
		$out .= ( $module == 'column' ? '<ul class="post_list small_post_list">'
		: '<div class="post_grid four_column_blog">'
		);
		
		$i=1;
		while ( $popular_query->have_posts() ) {
			$popular_query->the_post();
			
			$out .= ( $module == 'column' ? '<li class="post_list_module">'
			: '<div class="' . ( $i%$showposts == 0 ? 'one_fourth last'
			: 'one_fourth' ) . '">'
			);
			
			$out .= ( $module == 'tab' ? '<div class="post_grid_module">' : '' );
			$out .= mysite_get_post_image(array(
				'width' => $mysite->layout[$img_layout][$img_sizes][0],
				'height' => $mysite->layout[$img_layout][$img_sizes][1],
				'img_class' => ( $module == 'tab' ? 'post_grid_image' : 'post_list_image' ),
				'preload' => false,
				'link_to' => get_permalink(),
				'prettyphoto' => false,
				'placeholder' => true,
				'echo' => false,
				'wp_resize' => ( mysite_get_setting( 'image_resize_type' ) == 'wordpress' ? true : false )
			));
			
			$out .= '<div class="' . ( $module == 'tab' ? 'post_grid_content' : 'post_list_content' ) . '">';
			$out .= the_title( '<p class="post_title"><a href="' . esc_url( get_permalink() ) . '" title="' . esc_attr( the_title_attribute( 'echo=0' ) ) . '" rel="bookmark">', '</a></p>', false );
			
			$out .= ( $module == 'column' ? '<p class="post_meta">' . apply_filters( 'mysite_widget_meta', do_shortcode( '[post_date]' ) ) . '</p>' : '' );
			
			$out .= '</div>';
			$out .= ( $module == 'column' ? '</li>' : '</div></div>' );
			
			$i++;
		}
		
		$out .= ( $module == 'column' ? '</ul>' : '</div>' );
	}
	
	wp_reset_postdata();
	
	if ( !empty( $out ) )
		return $out;
	else
		return false;
}
endif;

if ( !function_exists( 'mysite_related_posts' ) ) :
/**
 *
 */
function mysite_related_posts( $args = array() ) {
	global $post;
	$backup = $post;
	
	$out = '';
	
	extract( $args );
	
	$tags = wp_get_post_tags( $post->ID );
	$tagIDs = array();
	$related_post_found = false;
	
	if ( $tags ) {
		$tagcount = count( $tags );
		for ($i = 0; $i < $tagcount; $i++) {
			$tagIDs[$i] = $tags[$i]->term_id;
		}
		$related_query = new WP_Query(array(
			'tag__in' => $tagIDs,
			'post__not_in' => array( $post->ID ),
			'showposts'=>$showposts,
			'category__not_in' => array( mysite_exclude_category_string( $minus = false ) ),
			'ignore_sticky_posts' => 1
		));
		
		if( $related_query->have_posts() )
			$related_post_found = true;
	}
	
	if( !$related_post_found )
		$related_query = new WP_Query(array( 'showposts' => $showposts,
			'nopaging' => 0,
			'post_status' => 'publish',
			'category__not_in' => array( mysite_exclude_category_string( $minus = false ) ),
			'ignore_sticky_posts' => 1
		));
		
	if ( $related_query->have_posts() ) {
		
		global $mysite;
		$img_sizes = ( $module == 'column' ) ? 'small_post_list' : 'additional_posts_grid';
		$_layout = get_post_meta( $post->ID, '_layout', true );
		if( empty( $_layout ) )
			$_layout = mysite_get_setting( 'post_layout' );
			
		$img_layout = ( $_layout == 'full_width' ? 'images'
		: ( $_layout == 'left_sidebar'
		? 'small_sidebar_images' : 'big_sidebar_images' ) );

		$out .= ( $module == 'column' ? '<ul class="post_list small_post_list">'
		: '<div class="post_grid four_column_blog">'
		);
		
		$i=1;
		while ( $related_query->have_posts() ) {
			$related_query->the_post();

			$out .= ( $module == 'column' ? '<li class="post_list_module">'
			: '<div class="' . ( $i%$showposts == 0 ? 'one_fourth last'
			: 'one_fourth' ) . '">'
			);

			$out .= ( $module == 'tab' ? '<div class="post_grid_module">' : '' );
			$out .= mysite_get_post_image(array(
				'width' => $mysite->layout[$img_layout][$img_sizes][0],
				'height' => $mysite->layout[$img_layout][$img_sizes][1],
				'img_class' => ( $module == 'tab' ? 'post_grid_image' : 'post_list_image' ),
				'preload' => false,
				'link_to' => get_permalink(),
				'prettyphoto' => false,
				'placeholder' => true,
				'echo' => false,
				'wp_resize' => ( mysite_get_setting( 'image_resize_type' ) == 'wordpress' ? true : false )
			));
			
			$out .= '<div class="' . ( $module == 'tab' ? 'post_grid_content' : 'post_list_content' ) . '">';
			$out .= the_title( '<p class="post_title"><a href="' . esc_url( get_permalink() ) . '" title="' . esc_attr( the_title_attribute( 'echo=0' ) ) . '" rel="bookmark">', '</a></p>', false );
			
			$out .= ( $module == 'column' ? '<p class="post_meta">' . apply_filters( 'mysite_widget_meta', do_shortcode( '[post_date]' ) ) . '</p>' : '' );
			
			$out .= '</div>';
			$out .= ( $module == 'column' ? '</li>' : '</div></div>' );

			$i++;
		}

		$out .= ( $module == 'column' ? '</ul>' : '</div>' );
	}
	
	$post = $backup;
	wp_reset_postdata();

	if ( !empty( $out ) )
		return $out;
	else
		return false;
}
endif;

if ( !function_exists( 'mysite_footer_teaser' ) ) :
/**
 *
 */
function mysite_footer_teaser() {
	$out = '';
	$footer_teaser = '';
	
	if( ( mysite_get_setting( 'footer_teaser' ) ) && ( !is_front_page() ) ) {
		$footer_teaser = mysite_get_setting( 'footer_teaser' );
		
		if( strpos( $footer_teaser, '[' ) === false )
			$footer_teaser = '<p>' . stripslashes( $footer_teaser ) . '</p>';
		else
			$footer_teaser = stripslashes( $footer_teaser );
	}
	
	if( ( mysite_get_setting( 'homepage_footer_teaser' ) ) && ( is_front_page() ) ) {
		$footer_teaser = mysite_get_setting( 'homepage_footer_teaser' );
		
		if( strpos( $footer_teaser, '[' ) === false )
			$footer_teaser = '<p>' . stripslashes( $footer_teaser ) . '</p>';
		else
			$footer_teaser = stripslashes( $footer_teaser );
	}
	
	if( !empty( $footer_teaser ) ) {
		
		$out .= '<div id="outro">';
		$out .= '<div id="outro_inner">';
		
		$out .= $footer_teaser;
		
		$out .= '<div class="clearboth"></div>';
		$out .= '</div><!-- #outro_inner -->';
		$out .= '</div><!-- #outro -->';
	}
	
	echo apply_atomic_shortcode( 'footer_teaser', $out );
}
endif;

if ( !function_exists( 'mysite_sub_footer' ) ) :
/**
 *
 */
function mysite_sub_footer() {
	$out = '';
	$menu = '';
	$footer_text = '';
	
	if( mysite_get_setting( 'footer_text' ) ) {
		$footer_text = mysite_get_setting( 'footer_text' );
		$footer_text = stripslashes( $footer_text );
		$footer_text = '<div class="copyright_text">' . $footer_text . '</div>';
	}
	
	if ( has_nav_menu( 'footer-links' ) ) {
		$menu = wp_nav_menu(
			array(
			'theme_location' => 'footer-links',
			'container_class' => 'footer_links',
			'container_id' => '',
			'menu_class' => '',
			'fallback_cb' => '',
			'echo' => false
		));
	}
	
	
	if( !empty( $footer_text ) || !empty( $menu ) ) {
		$out .= '<div id="sub_footer">';
		$out .= '<div id="sub_footer_inner">';
		
		$out .= $footer_text;
		$out .= $menu;
		
		$out .= '</div><!-- #sub_footer_inner -->';
		$out .= '</div><!-- #sub_footer -->';
		
	}
	
	echo apply_atomic_shortcode( 'sub_footer', $out );;
}
endif;

if ( !function_exists( 'mysite_print_cufon' ) ) :
/**
 *
 */
function mysite_print_cufon() {

	$active_cufon = apply_filters( 'mysite_active_skin', get_option( MYSITE_ACTIVE_SKIN ) );
	$disable_cufon = apply_atomic( 'disable_cufon', mysite_get_setting( 'disable_cufon' ) );

	if( empty( $active_cufon ) || !empty( $disable_cufon ) )
		return;

	$out = "<script type=\"text/javascript\">\r/* <![CDATA[ */\r";

	$out .= "\tvar ua = jQuery.browser;\r";
	$out .= "\tif( (!ua.msie) || (ua.version.substring(0,1) != '6' && ua.msie) ){";

	$out .= "\r\tCufon.now();";

	foreach( $active_cufon['fonts'] as $declaration => $font ) {

		if( $declaration == '.jqueryslidemenu a' )
		{
			# Load Cufon on top level items only
			$out .= "\r\tCufon.replace('.jqueryslidemenu>ul>li>a', { fontFamily: '{$font}', hover: true });";

			# Dynamically load cufon on drop downs
			$out .= "\r\tjQuery('.jqueryslidemenu>ul>li').hover(function(e) {
				if( e.type == 'mouseenter' ) {
					if( !jQuery(this).hasClass('cufon') ) {
						id = jQuery(this).attr('id');
						_class = jQuery(this).attr('class');
						if(id){
							Cufon.replace('#'+id+' a', { fontFamily: '{$font}' });
						}else if(_class){
							classMatch = _class.match(/page-item-([0-9]*)/);
							Cufon.replace('.'+classMatch[0]+' a', { fontFamily: '{$font}' });
						}
						jQuery(this).addClass('cufon');
					}
				}
				
				if ( (!ua.msie) || (ua.msie && ua.version.substring(0,1) >= '9') ){
					if( e.type == 'mouseleave' ) {
						setTimeout(function() {
					       Cufon.refresh('.jqueryslidemenu>ul>li>a');
					     }, 10);
					}
				}
				
			 });";

		}
		else
		{
			$out .= "\r\tCufon.replace('{$declaration}', { fontFamily: '{$font}' });";
		}
	}

	if( !empty( $active_cufon['cufon_gradients'] ) )
		$out .= "\n" . $active_cufon['cufon_gradients'];

	$cufon_end = apply_atomic( 'cufon_end', '' );
	if( !empty( $cufon_end ) )
		$out .= $cufon_end;

	if( !empty( $active_cufon['cufon_gradients_fonts'] ) )
		$active_cufon['fonts'] = array_merge( $active_cufon['fonts'], $active_cufon['cufon_gradients_fonts'] );

	$declarations = array_keys( $active_cufon['fonts'] );
	$join_declarations = join( ',', str_replace( 'jqueryslidemenu a', 'jqueryslidemenu a span', $declarations ) );

	# Display cufon
	$out .= "
	if ( ua.msie && ua.version.substring(0,1) == '8' ){
		jQuery('{$join_declarations}').css('-ms-filter', '').css('filter', '');
	}else if( ua.msie && ua.version.substring(0,1) >= '9' || ua.msie && ua.version.substring(0,2) >= '10' ){
		jQuery('{$join_declarations}').css('opacity', '1');
	}else if(!ua.msie){
		jQuery('{$join_declarations}').css('opacity', '1');
	}";

	$cufon_after = apply_atomic( 'cufon_after', '' );
	if( !empty( $cufon_after ) )
		$out .= $cufon_after;

	$out .= "} \r/* ]]> */\r</script>";

	$out = preg_replace( "/(\r\n|\r|\n)\s*/i", '', $out );

	echo apply_atomic( 'print_cufon', $out );
}
endif;

if ( !function_exists( 'mysite_analytics' ) ) :
/**
 *
 */
function mysite_analytics() {
	$analytics = mysite_get_setting( 'analytics_code' );

	if( empty( $analytics ) )
		return;
	
	echo stripslashes( $analytics );
}
endif;

if ( !function_exists( 'mysite_image_preloading' ) ) :
/**
 *
 */
function mysite_image_preloading() {
	global $mysite;
	
	if( isset( $mysite->mobile ) )
		return;
	
	$out = "
	<script type=\"text/javascript\">
	/* <![CDATA[ */
	
	jQuery( '#main_inner' ).preloader({ imgSelector: '.blog_index_image_load span img', imgAppend: '.blog_index_image_load' });
	
	jQuery( '.one_column_portfolio' ).preloader({ imgSelector: '.portfolio_img_load span img', imgAppend: '.portfolio_img_load' });
	jQuery( '.two_column_portfolio' ).preloader({ imgSelector: '.portfolio_img_load span img', imgAppend: '.portfolio_img_load' });
	jQuery( '.three_column_portfolio' ).preloader({ imgSelector: '.portfolio_img_load span img', imgAppend: '.portfolio_img_load' });
	jQuery( '.four_column_portfolio' ).preloader({ imgSelector: '.portfolio_img_load span img', imgAppend: '.portfolio_img_load' });
	
	jQuery( '.portfolio_gallery.large_post_list' ).preloader({ imgSelector: '.portfolio_img_load span img', imgAppend: '.portfolio_img_load' });
	jQuery( '.portfolio_gallery.medium_post_list' ).preloader({ imgSelector: '.portfolio_img_load span img', imgAppend: '.portfolio_img_load' });
	jQuery( '.portfolio_gallery.small_post_list' ).preloader({ imgSelector: '.portfolio_img_load span img', imgAppend: '.portfolio_img_load' });
	
	jQuery( '#main_inner' ).preloader({ imgSelector: '.portfolio_full_image span img', imgAppend: '.portfolio_full_image' });
	jQuery( '#main_inner' ).preloader({ imgSelector: '.blog_sc_image_load span img', imgAppend: '.blog_sc_image_load' });
	jQuery( '#main_inner, #sidebar_inner' ).preloader({ imgSelector: '.fancy_image_load span img', imgAppend: '.fancy_image_load', oneachload: function(image){
			var imageCaption = jQuery(image).parent().parent().next();
			if(imageCaption.length>0){
				imageCaption.remove();
				jQuery(image).parent().addClass('has_caption_frame');
				jQuery(image).parent().append(imageCaption);
				jQuery(image).next().css('display','block');
			}
		}
	});
	jQuery( '#intro_inner' ).preloader({ imgSelector: '.fancy_image_load span img', imgAppend: '.fancy_image_load', oneachload: function(image){
			var imageCaption = jQuery(image).parent().parent().next();
			if(imageCaption.length>0){
				imageCaption.remove();
				jQuery(image).parent().addClass('has_caption_frame');
				jQuery(image).parent().append(imageCaption);
				jQuery(image).next().css('display','block');
			}
		}
	});
	
	function mysite_jcarousel_setup(c) {
		c.clip.parent().parent().parent().parent().parent().removeClass('noscript');
		var jcarousel_img_load = c.clip.children().children().find('.post_grid_image .portfolio_img_load');
		if( jcarousel_img_load.length>1 ) {
			jcarousel_img_load.each(function(i) {
				var filename = jQuery(this).attr('href'),
					videos=['swf','youtube','vimeo','mov'];
				for(var v in videos){
				    if(filename.match(videos[v])){
						jQuery(this).css('backgroundImage','url(' +assetsUri+ '/play.png)');
					}else{
						jQuery(this).css('backgroundImage','url(' +assetsUri+ '/zoom.png)');
					}
				}
			});
		}
	}
	
	/* ]]> */
	</script>";

	echo preg_replace( "/(\r\n|\r|\n)\s*/i", '', $out );

}
endif;

if ( !function_exists( 'mysite_custom_javascript' ) ) :
/**
 *
 */
function mysite_custom_javascript() {
global $post, $mysite;

$custom_js = '';
$custom_js .= mysite_get_setting( 'custom_js' );
$custom_js .= get_post_meta( $post->ID, '_custom_js', true );

if( isset( $mysite->mobile ) )
	$custom_js .= mysite_get_setting( 'mobile_custom_js' );

if( empty( $custom_js ) )
	return;
	
?><script type="text/javascript">
/* <![CDATA[ */
	<?php echo stripslashes( $custom_js ); ?>
/* ]]> */
</script>
<?php
}
endif;

if ( !function_exists( 'mysite_main_footer' ) ) :
/**
 *
 */
function mysite_main_footer() {
	$main_footer = apply_atomic_shortcode( 'main_footer', '' );
	
	if( !empty( $main_footer ) ) {
		echo $main_footer;
		return;
	}
	
	if( !mysite_get_setting( 'footer_disable' ) ) {
		$footer_column = mysite_get_setting( 'footer_columns' );
		
		if( is_numeric( $footer_column ) ) {
			$class = '';
			
			switch ( $footer_column ):
				case 1:
					$class = '';
					break;
				case 2:
					$class = 'one_half';
					break;
				case 3:
					$class = 'one_third';
					break;
				case 4:
					$class = 'one_fourth';
					break;
				case 5:
					$class = 'one_fifth';
					break;
				case 6:
					$class = 'one_sixth';
					break;
			endswitch;
			for( $i=1; $i<=$footer_column; $i++ ){
				$last = ( $i == $footer_column ) ? ' last' : '' ;

				echo '<div class="' . $class . $last . '">';
				dynamic_sidebar( "footer{$i}" );
				echo '</div>';
			}

		} else {
			switch( $footer_column ) :
				case 'third_twothird':
					echo '<div class="one_third">';
					dynamic_sidebar( 'footer1' );
					echo '</div>';
					echo '<div class="two_third last">';
					dynamic_sidebar( 'footer2' );
					echo '</div>';
					break;
				case 'fourth_threefourth':
					echo '<div class="one_fourth">';
					dynamic_sidebar( 'footer1' );
					echo '</div>';
					echo '<div class="three_fourth last">';
					dynamic_sidebar( 'footer2' );
					echo '</div>';
					break;
				case 'fourth_fourth_half':
					echo '<div class="one_fourth">';
					dynamic_sidebar( 'footer1' );
					echo '</div>';
					echo '<div class="one_fourth">';
					dynamic_sidebar( 'footer2' );
					echo '</div>';
					echo '<div class="one_half last">';
					dynamic_sidebar( 'footer3' );
					echo '</div>';
					break;
				case 'sixth_fivesixth':
					echo '<div class="one_sixth">';
					dynamic_sidebar( 'footer1' );
					echo '</div>';
					echo '<div class="five_sixth last">';
					dynamic_sidebar( 'footer2' );
					echo '</div>';
					break;
				case 'third_sixth_sixth_sixth_sixth':
					echo '<div class="one_third">';
					dynamic_sidebar( 'footer1' );
					echo '</div>';
					echo '<div class="one_sixth">';
					dynamic_sidebar( 'footer2' );
					echo '</div>';
					echo '<div class="one_sixth">';
					dynamic_sidebar( 'footer3' );
					echo '</div>';
					echo '<div class="one_sixth">';
					dynamic_sidebar( 'footer4' );
					echo '</div>';
					echo '<div class="one_sixth last">';
					dynamic_sidebar( 'footer5' );
					echo '</div>';
					break;
				case 'half_sixth_sixth_sixth':
					echo '<div class="one_half">';
					dynamic_sidebar( 'footer1' );
					echo '</div>';
					echo '<div class="one_sixth">';
					dynamic_sidebar( 'footer2' );
					echo '</div>';
					echo '<div class="one_sixth">';
					dynamic_sidebar( 'footer3' );
					echo '</div>';
					echo '<div class="one_sixth last">';
					dynamic_sidebar( 'footer4' );
					echo '</div>';
					break;

				case 'twothird_third':
					echo '<div class="two_third">';
					dynamic_sidebar( 'footer1' );
					echo '</div>';
					echo '<div class="one_third last">';
					dynamic_sidebar( 'footer2' );
					echo '</div>';
					break;
				case 'threefourth_fourth':
					echo '<div class="three_fourth">';
					dynamic_sidebar( 'footer1' );
					echo '</div>';
					echo '<div class="one_fourth last">';
					dynamic_sidebar( 'footer2' );
					echo '</div>';
					break;
				case 'half_fourth_fourth':
					echo '<div class="one_half">';
					dynamic_sidebar( 'footer1' );
					echo '</div>';
					echo '<div class="one_fourth">';
					dynamic_sidebar( 'footer2' );
					echo '</div>';
					echo '<div class="one_fourth last">';
					dynamic_sidebar( 'footer3' );
					echo '</div>';
					break;
				case 'fivesixth_sixth':
					echo '<div class="five_sixth">';
					dynamic_sidebar( 'footer1' );
					echo '</div>';
					echo '<div class="one_sixth last">';
					dynamic_sidebar( 'footer2' );
					echo '</div>';
					break;
				case 'sixth_sixth_sixth_sixth_third':
					echo '<div class="one_sixth">';
					dynamic_sidebar( 'footer1' );
					echo '</div>';
					echo '<div class="one_sixth">';
					dynamic_sidebar( 'footer2' );
					echo '</div>';
					echo '<div class="one_sixth">';
					dynamic_sidebar( 'footer3' );
					echo '</div>';
					echo '<div class="one_sixth">';
					dynamic_sidebar( 'footer4' );
					echo '</div>';
					echo '<div class="one_third last">';
					dynamic_sidebar("footer5");
					echo '</div>';
					break;
				case 'sixth_sixth_sixth_half':
					echo '<div class="one_sixth">';
					dynamic_sidebar( 'footer1' );
					echo '</div>';
					echo '<div class="one_sixth">';
					dynamic_sidebar( 'footer2' );
					echo '</div>';
					echo '<div class="one_sixth">';
					dynamic_sidebar( 'footer3' );
					echo '</div>';
					echo '<div class="one_half last">';
					dynamic_sidebar( 'footer4' );
					echo '</div>';
					break;
			endswitch;
		}

		echo '<div class="clearboth"></div>';
	}
	
}
endif;


if ( !function_exists( 'mysite_comment_tab' ) ) :
/**
 *
 */
function mysite_comment_tab() {
	global $post;
	$get_comments = get_comments( 'post_id=' . $post->ID );
	$comments_by_type = &separate_comments( $get_comments );

?><div class="blog_tabs_container">

		<ul class="blog_tabs">
			<li><a href="#" class="current"><?php
			printf( _n( '%1$s Comment', '%1$s Comments', count( $comments_by_type['comment'] ), MYSITE_TEXTDOMAIN ),
			number_format_i18n( count( $comments_by_type['comment'] ) ) );
			?></a></li>
			<li><a href="#" class=""><?php
			printf( _n( '%1$s Trackback', '%1$s Trackback', count( $comments_by_type['pings'] ), MYSITE_TEXTDOMAIN ),
			number_format_i18n( count( $comments_by_type['pings'] ) ) );
			?></a></li>
		</ul><!-- .blog_tabs -->

		<div class="blog_tabs_content">
			<ol class="commentlist">
				<?php wp_list_comments( array( 'type' => 'comment', 'callback' => 'mysite_comments_callback' ) ); ?>
			</ol>

			<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
				<div class="comment-navigation paged-navigation">
					<?php paginate_comments_links( mysite_portfolio_comment_url( $nav = true ) ); ?>
				</div><!-- .comment-navigation -->
			<?php endif; ?>

		</div><!-- .blog_tabs_content -->

		<div class="blog_tabs_content">
			<ol class="commentlist trackbacks_pingbacks">
				<?php wp_list_comments( array( 'type' => 'pings', 'callback' => 'mysite_pings_callback' ) ); ?>
			</ol>
		</div><!-- .blog_tabs_content -->

	</div><!-- .blog_tabs_container -->

<?php		
}
endif;

if ( !function_exists( 'mysite_comment_list' ) ) :
/**
 *
 */
function mysite_comment_list() {
echo apply_filters( 'mysite_comments_title', '<h3 id="comments-title">' . sprintf( _n( '1 Comment', '%1$s Comments', get_comments_number(), MYSITE_TEXTDOMAIN ), number_format_i18n( get_comments_number() ), get_the_title() ) . '</h3>', array( 'comments_number' => get_comments_number(), 'title' =>  get_the_title() ) );

?><ol class="commentlist">
		<?php wp_list_comments( array( 'type' => 'all', 'callback' => 'mysite_comments_callback' ) ); ?>
	</ol>

	<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
		<div class="comment-navigation paged-navigation">
			<?php paginate_comments_links( mysite_portfolio_comment_url( $nav = true ) ); ?>
		</div><!-- .comment-navigation -->
	<?php endif; ?>

<?php
}
endif;

if ( !function_exists( 'mysite_comments_callback' ) ) :
/**
 *
 */
function mysite_comments_callback( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;

	$comment_type = get_comment_type( $comment->comment_ID );
	$author = esc_html( get_comment_author( $comment->comment_ID ) );
	$url = esc_url( get_comment_author_url( $comment->comment_ID ) );
	$default_avatar = ( 'pingback' == $comment_type || 'trackback' == $comment_type )
	? THEME_IMAGES_ASSETS . "/gravatar_{$comment_type}.png"
	: THEME_IMAGES_ASSETS . '/gravatar_default.png';

	?><li <?php comment_class() ?> id="comment-<?php comment_ID() ?>">
		<div id="div-comment-<?php comment_ID() ?>"><?php

		/* Display gravatar */
		$avatar = get_avatar( get_comment_author_email( $comment->comment_ID ), apply_filters( "mysite_avatar_size", '80' ), $default_avatar, $author );

		if ( $url )
			$avatar = '<a href="' . esc_url( $url ) . '" rel="external nofollow" title="' . esc_attr( $author ) . '">' . $avatar . '</a>';

		echo $avatar;

		?><div class="comment-text"><?php

		/* Display link and cite if URL is set. */
		if ( $url )
			echo '<cite class="fn" title="' . esc_url( $url ) . '"><a href="' . esc_url( $url ) . '" title="' . esc_attr( $author ) . '" class="url" rel="external nofollow">' . $author . '</a></cite>';
		else
			echo '<cite class="fn">' . $author . '</cite>';

		/* Display comment date */
		?><span class="date"><?php printf( __('%1$s', MYSITE_TEXTDOMAIN ), get_comment_date( __( apply_filters( "mysite_comment_date_format", 'm-d-Y' ) ) ) ); ?></span>

		<?php if ( $comment->comment_approved == '0' ) : ?>
			<p class="alert moderation"><?php _e( 'Your comment is awaiting moderation.', MYSITE_TEXTDOMAIN ); ?></p>
				<?php endif; ?>

				<?php comment_text() ?>

				<div class="comment-meta commentmetadata"><?php
					comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) );
					edit_comment_link( __( 'Edit', MYSITE_TEXTDOMAIN ), ' ' );
				?></div>

			</div><!-- .comment-text -->

		</div><!-- #div-comment-## -->
<?php
}
endif;

if ( !function_exists( 'mysite_pings_callback' ) ) :
/**
 *
 */
function mysite_pings_callback( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
?><li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
	<cite><?php comment_author_link() ?></cite><span class="date"><?php comment_date('m-d-y'); ?></span><br />
<?php	
}
endif;

if ( !function_exists( 'mysite_comment_form_args' ) ) :
/**
 *
 */
function mysite_comment_form_args( $args ) {
	global $user_identity;

	$commenter = wp_get_current_commenter();
	$req = ( ( get_option( 'require_name_email' ) ) ? ' <span class="required">' . __( '*', MYSITE_TEXTDOMAIN ) . '</span> ' : '' );
		
	$fields = array(
		'redirect_to' => ( is_singular( 'portfolio' ) ? '<input type="hidden" name="redirect_to" value="' . mysite_portfolio_comment_url() . '" />' : '' ),
		'author' => '<p class="form-author"><input type="text" class="textfield" name="author" id="author" value="' . esc_attr( $commenter['comment_author'] ) . '" size="40" tabindex="1" /><label for="author" class="textfield_label">' . __( 'Name', MYSITE_TEXTDOMAIN ) . $req . '</label></p>',
		'email' => '<p class="form-email"><input type="text" class="textfield" name="email" id="email" value="' . esc_attr( $commenter['comment_author_email'] ) . '" size="40" tabindex="2" /><label for="email" class="textfield_label">' . __( 'Email', MYSITE_TEXTDOMAIN ) . $req . '</label></p>',
		'url' => '<p class="form-url"><input type="text" class="textfield" name="url" id="url" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="40" tabindex="3" /><label for="url" class="textfield_label">' . __( 'Website', MYSITE_TEXTDOMAIN ) . '</label></p>'
	);

	$args = array(
		'fields' => apply_filters( 'comment_form_default_fields', $fields ),
		'comment_field' => '<p class="form-textarea"><textarea name="comment" id="comment" cols="60" rows="10" tabindex="4"></textarea></p>',
		'must_log_in' => '<p class="alert">' . sprintf( __( 'You must be <a href="%1$s" title="Log in">logged in</a> to post a comment.', MYSITE_TEXTDOMAIN ), wp_login_url( get_permalink() ) ) . '</p><!-- .alert -->',
		'logged_in_as' => '<p class="log-in-out">' . sprintf( __( 'Logged in as <a href="%1$s" title="%2$s">%2$s</a>.', MYSITE_TEXTDOMAIN ), admin_url( 'profile.php' ), $user_identity ) . ' <a href="' . wp_logout_url( get_permalink() ) . '" title="' . __( 'Log out of this account', MYSITE_TEXTDOMAIN ) . '">' . __( 'Log out &raquo;', MYSITE_TEXTDOMAIN ) . '</a></p><!-- .log-in-out -->',
		'comment_notes_before' => '',
		'comment_notes_after' => '',
		'id_form' => 'commentform',
		'id_submit' => 'submit',
		'title_reply' => __( 'Leave a Reply', MYSITE_TEXTDOMAIN ),
		'title_reply_to' => __( 'Leave a Reply to %s', MYSITE_TEXTDOMAIN ),
		'cancel_reply_link' => __( 'Click here to cancel reply.', MYSITE_TEXTDOMAIN ),
		'label_submit' => __( 'Submit', MYSITE_TEXTDOMAIN ),
	);

	return $args;
}
endif;


if ( !function_exists( 'mysite_404' ) ) :
/**
 *
 */
function mysite_404( $post = false ) {
?><div id="post-0" class="page error404 not_found">
	
	<?php $intro_options = mysite_get_setting( 'intro_options' );
	if( $intro_options == 'disable' && !is_search() ) : 
	?><h1 class="post_title"><?php _e( 'Not Found', MYSITE_TEXTDOMAIN ); ?></h1>
	<?php endif; ?>
	
	<div class="entry">
		<?php if( !$post ) :
		?><p><?php _e( 'Apologies, but the page you requested could not be found. Perhaps searching will help.', MYSITE_TEXTDOMAIN ); ?></p>
		<?php elseif( is_search() ) :
		?><?php _e( 'Apologies, but no post could be found matching your criteria.', MYSITE_TEXTDOMAIN ); ?></p>
		<?php else :
		?><?php _e( 'Apologies, but no post could be found matching your criteria. Perhaps searching will help.', MYSITE_TEXTDOMAIN ); ?></p>
		<?php endif; ?>
		<?php get_search_form(); ?>
	</div><!-- .entry -->
</div><!-- #post-0 -->

<script type="text/javascript">
/* <![CDATA[ */
	// focus on search field after it has loaded
	document.getElementById('s') && document.getElementById('s').focus();
/* ]]> */
</script>

<?php	
}
endif;

if ( !function_exists( 'mysite_archive' ) ) :
/**
 *
 */
function mysite_archive() {
	get_template_part( 'loop', 'archive' );
}
endif;

if ( !function_exists( 'mysite_search' ) ) :
/**
 *
 */
function mysite_search() {
	get_template_part( 'loop', 'search' );
}
endif;

if ( !function_exists( 'mysite_sitemap' ) ) :
/**
 *
 */
function mysite_sitemap() {
?><div id="post-<?php the_ID(); ?>" <?php post_class( 'sitemap' ); ?>>
	<?php mysite_before_entry(); ?>
	
	<div class="entry">
	<h2><?php _e( 'Pages', MYSITE_TEXTDOMAIN );?></h2>
	<ul class="sitemap_list"><?php wp_list_pages('depth=0&sort_column=menu_order&title_li=' );
	?></ul>
	<div class="divider top"><a href="#"><?php _e( 'Top', MYSITE_TEXTDOMAIN ); ?></a></div>
	
	<h2><?php _e( 'Category Archives', MYSITE_TEXTDOMAIN ); ?></h2>
	<ul class="sitemap_list"><?php
		wp_list_categories( array(
			'exclude'=> mysite_exclude_category_string( $minus = false ),
			'feed' => __( 'RSS', MYSITE_TEXTDOMAIN ),
			'show_count' => true, 'use_desc_for_title' => false,
			'title_li' => false
		));
	?></ul>
	<div class="divider top"><a href="#"><?php _e( 'Top', MYSITE_TEXTDOMAIN ); ?></a></div>
	
	<?php $archive_query = new WP_Query( array( 'showposts' => 1000, 'category__not_in' => array( mysite_exclude_category_string( $minus = false ) ) ) );
	?><h2><?php _e( 'Blog Posts', MYSITE_TEXTDOMAIN ); ?></h2>
	<ul class="sitemap_list"><?php while ( $archive_query->have_posts() ) : $archive_query->the_post();
	?><li><a href="<?php esc_url( the_permalink() ); ?>" rel="bookmark" title="<?php printf( __( "Permanent Link to %s", MYSITE_TEXTDOMAIN ), esc_attr( get_the_title() ) ); ?>"><?php the_title();
	?></a> (<?php comments_number('0', '1', '%'); ?>)</li>
	<?php endwhile;
	?></ul>
	<div class="divider top"><a href="#"><?php _e( 'Top', MYSITE_TEXTDOMAIN ); ?></a></div>

	<?php $portfolio_query = new WP_Query( array( 'post_type' => 'portfolio','showposts' => 1000 ) );
	?><h2><?php _e( 'Portfolios', MYSITE_TEXTDOMAIN ); ?></h2>
	<ul class="sitemap_list"><?php while ( $portfolio_query->have_posts() ) : $portfolio_query->the_post();
	?><li><a href="<?php esc_url( the_permalink() ); ?>" rel="bookmark" title="<?php printf( __( "Permanent Link to %s", MYSITE_TEXTDOMAIN ), esc_attr( get_the_title() ) ); ?>"><?php the_title();
	?></a> (<?php comments_number('0', '1', '%'); ?>)</li>
	<?php endwhile;
	?></ul>
	<div class="divider top"><a href="#"><?php _e( 'Top', MYSITE_TEXTDOMAIN ); ?></a></div>

	<h2><?php _e( 'Archives', MYSITE_TEXTDOMAIN ); ?></h2>
	<ul class="sitemap_list"><?php wp_get_archives( 'type=monthly&show_post_count=true' );
	?></ul>
	<div class="divider top"><a href="#"><?php _e( 'Top', MYSITE_TEXTDOMAIN ); ?></a></div>
	
	<div class="clearboth"></div>
	<?php wp_link_pages( array( 'before' => '<div class="page_link">' . __( 'Pages:', MYSITE_TEXTDOMAIN ), 'after' => '</div>' ) ); ?>
	<?php edit_post_link( __( 'Edit', MYSITE_TEXTDOMAIN ), '<div class="edit_link">', '</div>' ); ?>
	</div><!-- .entry -->
				
	<?php mysite_after_entry(); ?>
</div><!-- #post-0 -->

<?php	
}
endif;

if ( !function_exists( 'mysite_password_form' ) ) :
/**
 *
 */
function mysite_password_form() {
	global $post;
	$label = 'pwbox-'.(empty($post->ID) ? rand() : $post->ID);
	$output = '<form action="' . get_option('siteurl') . '/wp-login.php?action=postpass" method="post">
	<p>' . __( 'This post is password protected. To view it please enter your password below:', MYSITE_TEXTDOMAIN ) . '</p>
	<p><label class="password_protect_label" for="' . $label . '">' . __( 'Password:', MYSITE_TEXTDOMAIN ) . '</label> <input class="password" name="post_password" id="' . $label . '" type="password" size="20" /> <input class="fancy_button password_protect_button" type="submit" name="Submit" value="' . esc_attr__( 'Submit', MYSITE_TEXTDOMAIN ) . '" /></p>
	</form>';
	
	return '<!--start_raw-->' . $output . '<!--end_raw-->';
}
endif;

if ( !function_exists( 'mysite_custom_bg' ) ) :
/**
 *
 */
function mysite_custom_bg() {
	global $post;
	
	$out = '';
	
	if( is_archive() )
		$custom_background = mysite_get_setting( 'archive_custom_background' );
		
	else if( is_search() )
		$custom_background = mysite_get_setting( 'search_custom_background' );
		
	else if( is_404() )
		$custom_background = mysite_get_setting( 'four_04_custom_background' );
		
	else if( !empty( $post->ID ) && !is_home() )
		$custom_background = get_post_meta( $post->ID, '_custom_background', true );
		
	if( !isset( $custom_background['full_bg'] ) || strtolower( $custom_background['url'] ) == 'none' ) {
		
		if( !empty( $custom_background['url'] ) && strtolower( $custom_background['url'] ) != 'none' )
			$out .= 'background-image: url("' . esc_url(stripslashes( $custom_background['url'] ) ) . '");';
			
		elseif( !empty( $custom_background['url'] ) && strtolower( $custom_background['url'] ) == 'none' )
			$out .= 'background-image: none;';

		if( !empty( $custom_background['background-color'] ) )
			$out .= 'background-color: ' . $custom_background['background-color'] . ';';

		if( !empty( $custom_background['background-repeat'] ) && !empty( $custom_background['url'] ) )
			$out .= 'background-repeat: ' . $custom_background['background-repeat'] . ';';

		if( !empty( $custom_background['background-attachment'] ) && !empty( $custom_background['url'] ) )
			$out .= 'background-attachment: ' . $custom_background['background-attachment'] . ';';

		if( !empty( $custom_background['background-position'] ) && !empty( $custom_background['url'] ) )
			$out .= 'background-position: ' . $custom_background['background-position'] . ';';

		if( !empty( $out ) ) {
			$out = "\r" . '<style type="text/css">body{' . $out . ' }</style>' . "\r";
		}
	}
	
	echo apply_atomic( 'custom_bg', $out );
}
endif;

if ( !function_exists( 'mysite_fullscreen_bg' ) ) :
/**
 *
 */
function mysite_fullscreen_bg() {
	global $post, $mysite;
	
	$out = '';
	
	if( is_archive() )
		$custom_background = mysite_get_setting( 'archive_custom_background' );
		
	else if( is_search() )
		$custom_background = mysite_get_setting( 'search_custom_background' );
		
	else if( is_404() )
		$custom_background = mysite_get_setting( 'four_04_custom_background' );
		
	else if( !empty( $post->ID ) && !is_home() )
		$custom_background = get_post_meta( $post->ID, '_custom_background', true );
	
	if( empty( $custom_background['url'] ) ) {
		$custom_background = apply_filters( 'mysite_active_skin', get_option( MYSITE_ACTIVE_SKIN ) );
		$full_bg = ( isset( $custom_background['full_bg'] ) && is_array( $custom_background['full_bg'] ) ) ? $custom_background['full_bg'] : array();
		$custom_background['url'] = ( isset( $full_bg['url'] ) ? $full_bg['url'] : '' );
		
		if( in_array( 'fullbg', $full_bg ) )
			$custom_background['full_bg'] = true;
		
		if( in_array( 'fadebg', $full_bg ) )
			$custom_background['fade_bg'] = true;
	}
	
	if( !empty( $custom_background['url'] ) && strtolower( $custom_background['url'] ) != 'none' && isset( $custom_background['full_bg'] ) ) {
		
		# Get image size
		$url_info = parse_url( $custom_background['url'] );
		$image_path = ( isset( $url_info['path'] ) ) ? $url_info['path'] : '';
		
		if( is_multisite() && isset( $url_info['host'] ) && strpos( $url_info['host'], $_SERVER['SERVER_NAME'] ) !== false ) {
			global $blog_id;
			$image_path = explode( $_SERVER['SERVER_NAME'], $custom_background['url'] );
			if( strpos( $image, str_replace( 'files', '', mysite_upload_dir( $key = 'baseurl' ) ) ) !== false ) {
				$image_path = $_SERVER['DOCUMENT_ROOT'] . $image_path[0];
			} else {
				$image_path = $_SERVER['DOCUMENT_ROOT'] . $image_path[1];
			}
			echo $image_path;
		} elseif( isset( $url_info['host'] ) && strpos( $url_info['host'], $_SERVER['SERVER_NAME'] ) !== false ) {
			$image_path = explode( $_SERVER['SERVER_NAME'], $custom_background['url'] );
			$image_path = $_SERVER['DOCUMENT_ROOT'] . $image_path[1];
		}

		$image_sizes = @getimagesize( $image_path );

		# If we cannot get the image locally, try for an external URL
		if ( empty( $image_sizes ) )
			$image_sizes = @getimagesize( $custom_background['url'] );
			
		# If we still cannot get image size see if it's in THEME_STYLES_DIR or if were on an MU install creating a skin from "_create_new.css"
		if ( empty( $image_sizes ) ) {
			if( is_multisite() && !isset( $url_info['host'] ) && strpos( $custom_background['url'], 'wp-content' ) !== false ) {
				$image_sizes = @getimagesize( str_replace( '/wp-content/themes/' . THEME_SLUG . '/styles', '', THEME_STYLES_DIR ) . $custom_background['url'] );
				$custom_background['url'] = str_replace( '/wp-content/themes/' . THEME_SLUG . '/styles', '', THEME_STYLES ) . $custom_background['url'];

			} elseif( is_multisite() && !isset( $url_info['host'] ) && strpos( $custom_background['url'], 'wp-content' ) === false ) {
				global $blog_id;
				$cur_site = get_current_site( 1 );
				$wpmu_image_path = esc_url( $cur_site->domain .'/'. mysite_upload_dir() . '/styles/' . $custom_background['url'] );
				$image_sizes = @getimagesize( $wpmu_image_path );

				if( !empty( $image_sizes ) ) {
					$custom_background['url'] = $wpmu_image_path;
				} else {
					$image_sizes = @getimagesize( THEME_STYLES_DIR . '/' . $custom_background['url'] );
					$custom_background['url'] = THEME_STYLES . '/' . $custom_background['url'];
				}

			} else {
				$image_sizes = @getimagesize( THEME_STYLES_DIR . '/' . $custom_background['url'] );
				$custom_background['url'] = THEME_STYLES . '/' . $custom_background['url'];
			}
		}
		
		# Return if we can't get image sizes	
		if ( empty( $image_sizes ) )
			return;
			
			
		# Set body background to none
		$out .= '<style type="text/css">body{background-image: none;}</style>';

		# Check for background color override
		if( !empty( $custom_background['background-color'] ) )
			$out .= '<style type="text/css">body{background-color: ' . $custom_background['background-color'] . ';}</style>';
		
		$out .= "<script type=\"text/javascript\">\r/* <![CDATA[ */\r";
		
		# Resize on page load
		$win_width = ( isset( $mysite->mobile ) ? 'window.screen.width' : 'jQuery(window).width()' );
		$win_height = ( isset( $mysite->mobile ) ? 'window.screen.height' : 'jQuery(window).height()' );
		
		$out .= "
			var fullbg_url = '" .$custom_background['url']. "',
				origDiv = '#fullbg',
				origImg = '#fullbg img',
				ratio = 768/1024,
				winWidth = " . $win_width . ",
				winHeight = " . $win_height . ",
				winRatio = winHeight/winWidth;
				
			if (winRatio > ratio) {
				var imgWidth = winHeight / ratio,
					imgHeight = winHeight;
					
			} else {
				var imgWidth = winWidth,
					imgHeight = winWidth * ratio;
			}
			
			var newcontent = document.createElement('div'),
				insert = document.getElementById('body_inner');
			
			newcontent.id = origDiv.replace('#', '');
			insert.parentNode.insertBefore(newcontent, insert);
			
			var newcontent = document.getElementById(origDiv.replace('#', '')).innerHTML = '<img src=\"' +fullbg_url+ '\" alt=\"\" height=\"' +imgHeight+ '\" width=\"' +imgWidth+ '\" />';
			
			jQuery(origDiv).css('position', 'fixed');
			jQuery(origDiv).width(imgWidth);
			jQuery(origDiv).height(imgHeight);
		";
		
		# Fade in background image if option is set
		if( isset( $custom_background['fade_bg'] ) ) {
			$out .= "
			jQuery(origDiv).css('display', 'none');
			jQuery(document).ready(function() {
				jQuery('#fullbg').fadeIn();
			});
			";
		}
		
		# Resize the image on browser resize
		$win_width = ( isset( $mysite->mobile ) ? 'window.screen.width' : '$(window).width()' );
		$win_height = ( isset( $mysite->mobile ) ? 'window.screen.height' : '$(window).height()' );
		
		$out .= "
		(function($){
			$(window).bind('resize', function() {
				$(origDiv).resizeImg();
			});
			
			$.fn.resizeImg = function() {
		        var imgWidth = $(origImg).attr('width'),
					imgHeight = $(origImg).attr('height'),
					ratio = imgHeight/imgWidth,
					winWidth = " . $win_width . ",
					winHeight = " . $win_height . ",
					winRatio = winHeight/winWidth;
		        if (winRatio > ratio) {
		            $(origDiv).height(winHeight);
		            $(origDiv).width(winHeight / ratio);
		            $(origImg).height(winHeight);
		            $(origImg).width(winHeight / ratio);
		        } else {
		            $(origDiv).width(winWidth);
		            $(origDiv).height(winWidth * ratio);
		            $(origImg).width(winWidth);
		            $(origImg).height(winWidth * ratio);
		        }
		    };
		})(jQuery);
		";

		$out .= "\r/* ]]> */\r</script>";
		
		# If javascript is disabled still display image
		# $out .= '<div class="fullbg noscript_dn"><img src="' . $custom_background['url'] . '" style="position: fixed;" alt="" height="' . $image_sizes[1] . '" width="' . $image_sizes[0] . '" /></div>';

		$out = preg_replace( "/(\r\n|\r|\n)\s*/i", '', $out ) . "\r";
	}
	
	echo apply_atomic( 'custom_fullbg', $out );
}
endif;

if ( !function_exists( 'mysite_additional_headers' ) ) :
/**
 *
 */
function mysite_additional_headers() {
	
	$additional_headers = apply_atomic( 'additional_headers', mysite_get_setting( 'additional_headers' ) );
	
	if( !empty( $additional_headers ) )
		echo "\r" . stripslashes( $additional_headers ) . "\r";
	else
		return;
}
endif;

?>
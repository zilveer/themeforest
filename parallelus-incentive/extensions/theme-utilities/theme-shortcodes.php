<?php


#-----------------------------------------------------------------
# Shortcodes using [query] class
#-----------------------------------------------------------------


// [blog] shortcode
//................................................................
if ( ! function_exists( 'blog_query' ) ) :
	function blog_query($args = null, $content = null) {

		// default template
		if ( !isset($args['template']) || empty($args['template']) ) {
			$args['template'] = 'blog';
		}


		return custom_wp_query($args, $content);
	}
	
	add_shortcode('blog', 'blog_query');
endif;


// [portfolio] shortcode
//................................................................
if ( ! function_exists( 'portfolio_query' ) ) :
	function portfolio_query($args = null, $content = null) {

		// default template
		if ( !isset($args['template']) || empty($args['template']) ) {
			$args['template'] = 'grid-rows';
		}

		// post type
		if ( !isset($args['post_type']) || empty($args['post_type']) ) {
			$args['post_type'] = 'portfolio';
		}

		// orderby
		if ( !isset($args['orderby']) || empty($args['orderby']) ) {
			$args['orderby'] = 'menu_order'; // default by sort order
		}
		if ( !isset($args['order']) || empty($args['order']) ) {
			$args['order'] = 'ASC'; // default order
		}
		
		// categories 
		if ( isset($args['category']) ) {
			$args['taxonomy_slug'] = 'portfolio-category';
			$args['taxonomy_terms'] = $args['category'];
			unset($args['category']);
		}

		return custom_wp_query($args, $content);
	}
	
	add_shortcode('portfolio', 'portfolio_query');
endif;


// [content_rotator] shortcode
//................................................................
if ( ! function_exists( 'content_rotator' ) ) :
	function content_rotator($args = null, $content = null) {

		// 'title'=>'Your Title', 'columns'=>4, 'transition'=>'slide', 'slide_paging'=>"false", 'image_size'=>'500x300', 'category__in'=>'4,3,9,8', etc...
		$Runway_ContentRotator = new Runway_ResponsiveContentRotator();
		return $Runway_ContentRotator->Generate( $args );
	}
	
	add_shortcode('content_rotator', 'content_rotator');
endif;


#-----------------------------------------------------------------
# Page/post title.
#-----------------------------------------------------------------

// [page_title container="h1" class="page-title"]
//...............................................

if ( ! function_exists( 'theme_shortcode_post_title' ) ) :
	function theme_shortcode_post_title( $atts, $content = null ) {
		extract(shortcode_atts(array(
			'container' => 'h1',
			'class' => 'page-title'
	    ), $atts));
		
		$title = generate_title();
		if ( $container && $container != '0' && $container != 'false' ) {
			$title = '<'. $container .' class="'. $class .'" title="'. $title . '">'. $title .'</'. $container .'>';
		}
		
		return $title;
		
	}
	add_shortcode('page_title', 'theme_shortcode_post_title');
endif;

?>
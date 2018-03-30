<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/************************************************************************
* Ability for shortcodes in widgets
*************************************************************************/
add_filter( 'widget_text', 'do_shortcode' );

/************************************************************************
* Adds class to WordPress Galleries
*************************************************************************/
if(!function_exists('wbc907_wp_gallery_class')){
	function wbc907_wp_gallery_class( $gallery_style ){
		
		return str_replace("class='gallery", "class='gallery wp-gallery-style", $gallery_style );
	}
	add_filter('gallery_style', 'wbc907_wp_gallery_class', 10 );
}	

/************************************************************************
* Single Page Links
*************************************************************************/
if( !function_exists( 'wbc907_single_page_nav_links' ) ){
	function wbc907_single_page_nav_links( $items , $args ) {
		global $post;

		foreach ( $items as $item ) {

			if( 'custom' == $item->type && !is_home() ){

				if( 1 === preg_match('/^#([^\/]+){2,}$/', $item->url , $matches ) ){

					if( is_page() && '1' == get_post_meta( $post->ID , 'opts-is-parent', true )){
						
						$item->url = get_permalink( $post->ID ).$item->url;

					}elseif( is_single() && false !== get_post_meta( $post->ID , 'opts-parent-options', true ) && is_numeric( get_post_meta( $post->ID , 'opts-parent-options', true ) ) ){
						
						$item->url = get_permalink( get_post_meta( $post->ID , 'opts-parent-options', true ) ).$item->url;

					}else{

						$item->url = home_url( '/' ).$item->url;
					}
				
				}

			}
		}

		return $items;   
	}
	add_filter( 'wp_nav_menu_objects', 'wbc907_single_page_nav_links', 10 , 2 );
}

/************************************************************************
* Enable PrettyPhoto on galleries,photos
*************************************************************************/

if ( !function_exists( 'wbc907_prettyphoto_body_class' ) ) {

	function wbc907_prettyphoto_body_class( $classes ) {

		$classes[] = 'pp-lightbox';

		return $classes;
	}
	add_filter( 'body_class', 'wbc907_prettyphoto_body_class' );
}

/************************************************************************
* Adds Format selector to editor
*************************************************************************/

if ( ! function_exists( 'wbc_add_style_select' ) ) {
	function wbc_add_style_select( $buttons ) {
		array_push( $buttons, 'styleselect' );
		return $buttons;
	}
	add_filter( 'mce_buttons', 'wbc_add_style_select' );
}


if ( ! function_exists( 'wbc_add_style_elements' ) ) {
	function wbc_add_style_elements( $settings ) {

		$new_styles = array(
			array(
				'title'		=> __( 'Lead', 'ninezeroseven' ),
				'selector'	=> 'p',
				'classes'	=> 'wbc-lead-font'
			),
		);
		$settings['style_formats_merge'] = true;

		$settings['style_formats'] = json_encode( $new_styles );

		return $settings;

	}
	add_filter( 'tiny_mce_before_init', 'wbc_add_style_elements' );
}

/************************************************************************
* Adds Height data-tags to menu bar for elastic menu affect
*************************************************************************/

if ( !function_exists( 'wbc907_height_data' ) ) {

	function wbc907_height_data() {
		global $wbc907_data;
		
		$data_tags = ' ';
		$post_meta = get_post_meta( get_the_id(), 'opts-menu-height-override', true );
		if ( $post_meta && $post_meta['height'] != 'px' && isset( $wbc907_data['opts-menu-height']['height'] ) ) {
			$post_meta = wp_parse_args( $post_meta, $wbc907_data['opts-menu-height'] );
		}else {
			$post_meta = (isset($wbc907_data['opts-menu-height']['height'])) ? $wbc907_data['opts-menu-height'] : '' ;
		}


		if ( isset( $post_meta['height'] ) && !empty( $post_meta['height'] ) && $post_meta['height'] != 'px' ) {
			$data_tags .= 'data-menu-height="'.str_replace( 'px', '', $post_meta['height'] ).'" ';
		}else {
			$data_tags .= 'data-menu-height="83" ';
		}

		$post_meta = get_post_meta( get_the_id(), 'opts-elastic-height-override', true );

		if ( $post_meta && $post_meta['height'] != 'px' && !empty( $post_meta['height'] ) && isset( $wbc907_data['opts-elastic-height']['height'] ) ) {
			$post_meta = wp_parse_args( $post_meta, $wbc907_data['opts-elastic-height'] );
		}else {
			$post_meta = (isset($wbc907_data['opts-elastic-height']['height'])) ? $wbc907_data['opts-elastic-height'] : '' ;
		}

		if ( isset( $post_meta['height'] ) && !empty( $post_meta['height'] ) && $post_meta['height'] != 'px' ) {
			$data_tags .= 'data-scroll-height="'.str_replace( 'px', '', $post_meta['height'] ).'"';
		}else {
			$data_tags .= 'data-scroll-height="40"';
		}

		return $data_tags;
	}

}

/************************************************************************
* Output for when menu height is changed. :)
*************************************************************************/

if ( !function_exists( 'wbc907_css_output' ) ) {

	function wbc907_css_output() {
		global $wbc907_data;

		$html = '';

		$post_meta = get_post_meta( get_the_id(), 'opts-menu-height-override', true );
		if ( $post_meta && !empty($post_meta['height']) && isset( $wbc907_data['opts-menu-height']['height'] ) ) {
			$post_meta = wp_parse_args( $post_meta, $wbc907_data['opts-menu-height'] );
		}else {
			$post_meta = (isset($wbc907_data['opts-menu-height']['height'])) ? $wbc907_data['opts-menu-height'] : '' ;
		}


		if ( isset( $post_meta['height'] ) && !empty( $post_meta['height'] ) && $post_meta['height'] != 'px' ) {
			$html .= '<style type="text/css">';

			$html .= '.site-logo-title.logo-text,.primary-menu .wbc_menu > li{line-height:'. esc_html( $post_meta['height'] ).';}';
			$html .= '.site-logo-title.has-logo{height:'. esc_html( $post_meta['height'] ).';}';
			$html .= '.header-inner{min-height:'. esc_html( $post_meta['height'] ).';}';
			$html .= '.has-fixed-menu:not(.has-transparent-menu) .page-wrapper{padding:'. esc_html( $post_meta['height'] ).' 0 0;}';

			$html .= '</style>'."\n";
		}

		echo ( !empty( $html ) ) ? $html : '';
	}
	add_action( 'wp_head' , 'wbc907_css_output', 200 );
}

/************************************************************************
* Boxed layout
*************************************************************************/

if ( !function_exists( 'wbc907_boxed_option' ) ) {
	function wbc907_boxed_option() {
		global $wbc907_data;


		$boxed_layout_enabled = ( isset( $wbc907_data['opts-boxed-layout'] ) && $wbc907_data['opts-boxed-layout'] == 1 ) ? true : false ;

		$boxed_layout = (bool) apply_filters( 'wbc907_boxed_layout', $boxed_layout_enabled );

		if ( true === $boxed_layout ) {

			add_action( 'wbc907_before_page_content', 'wbc907_boxed_layout_before', 5 );

			add_action( 'wbc907_after_page_content', 'wbc907_boxed_layout_after', 10 );

		}
	}

	add_action( 'wbc907_before_page_content', 'wbc907_boxed_option' );
}

if ( !function_exists( 'wbc907_boxed_layout_before' ) ) {
	function wbc907_boxed_layout_before() {
		echo '<div class="wbc-boxed-wrapper">'."\n";
	}
}

if ( !function_exists( 'wbc907_boxed_layout_after' ) ) {
	function wbc907_boxed_layout_after() {
		echo '</div><!-- ./wbc-boxed-wrapper -->'."\n";
	}
}

if(!function_exists('wbc907_boxed_css_output')){
	
	function wbc907_boxed_css_output(){

		global $wbc907_data;

		$boxed_layout_enabled = ( isset( $wbc907_data['opts-boxed-layout'] ) && $wbc907_data['opts-boxed-layout'] == 1 ) ? true : false ;

		$boxed_layout = (bool) apply_filters( 'wbc907_boxed_layout', $boxed_layout_enabled );

		if ( true === $boxed_layout ) {
			if( isset( $wbc907_data['opts-boxed-width'] ) && is_numeric( $wbc907_data['opts-boxed-width'] ) && $wbc907_data['opts-boxed-width'] != 1240 ){
				echo '<style type="text/css">';
				echo '		.wbc-boxed-wrapper,';
				echo '		.wbc-boxed-wrapper .header-bar,';
				echo '		.wbc-boxed-wrapper .container,';
				echo '		.wbc-boxed-wrapper .bottom-fixed-menu,';
				echo '		.wbc-boxed-wrapper .is-sticky{';
				echo '		  max-width:'.esc_html( $wbc907_data['opts-boxed-width'] ).'px;';
				echo '		}';
				echo '</style>';
			}
		}
		
		
	}
	add_action( 'wp_head', 'wbc907_boxed_css_output' );
}	


/************************************************************************
* Page Title Area/Bread Crumb
*************************************************************************/

if ( !function_exists( 'wbc907_breadcrumb' ) ) {
	function wbc907_breadcrumb() {
		global $post,
		$wbc907_data;

		$wbc_bread_crumb = ( isset( $wbc907_data['opts-bread-crumb'] ) ) ? $wbc907_data['opts-bread-crumb'] : true;

		if ( is_front_page() || $wbc_bread_crumb == false ) {
			return;
		}

		$wbc_bread_crumb_wrap_html = '';
		$wbc_bread_crumb_html = '';

		$title = get_the_title();



		if( is_home() && !is_front_page() ) {

			$title = get_the_title( get_option( 'page_for_posts', true ) );

		}elseif( is_category() ) {

			$title = get_cat_name( get_query_var( 'cat' ) );

		}elseif( is_month() || is_tag() || is_day() || is_year() ) {
			$title = esc_html__( 'Archives', 'ninezeroseven' );
		}elseif( is_search() ) {
			$title = esc_html__( 'Search Results', 'ninezeroseven' );
		}elseif( is_author() ) {
			$title =  esc_html__( 'Author Posts', 'ninezeroseven' );
		}elseif( is_404() ){
			$title = esc_html__( 'Page Not Found', 'ninezeroseven' );
		}

		$title = esc_html( apply_filters( 'wbc_bread_crumb_title' , $title ) );

		$wbc_bread_crumb_wrap_html .= '<!-- Page Title/BreadCrumb -->';
		$wbc_bread_crumb_wrap_html .= '<div class="page-title-wrap">';
		$wbc_bread_crumb_wrap_html .= '<div class="container">';
		$wbc_bread_crumb_wrap_html .= '<h2 class="entry-title">' . $title . '</h2>';
		
		$wbc_bread_crumb_html .= '<ul class="breadcrumb">';

		$parent_page_id = '';
		if(isset($post->ID)){
			$parent_page_id   = get_post_meta( $post->ID , 'opts-parent-options', true );
		}
		

		if( $parent_page_id && is_numeric( $parent_page_id )){
			$wbc_bread_crumb_html .= '<li><a href="'. home_url() .'">'. esc_html__( 'Home', 'ninezeroseven' ) .'</a></li><li><a href="'. esc_attr( get_permalink( $parent_page_id ) ) .'">'. get_the_title( $parent_page_id ).'</a></li>';
		}else{
			$wbc_bread_crumb_html .= '<li><a href="'. home_url() .'">'. esc_html__( 'Home', 'ninezeroseven' ) .'</a></li>';
		}
		

		if ( is_single() || is_category() ) {

			$output = '';
			if ( is_category() ) {
				$cats = get_category_parents( get_query_var( 'cat' ) , true , '|~!~|' );

				$cats = explode( '|~!~|', $cats );

				foreach ( $cats as $cat ) {
					if ( !empty( $cat ) ) {
						$output .= '<li>'. $cat .'</li>';
					}
				}


			}else {

				$cats = get_the_category();
				array_multisort( $cats );

				foreach ( $cats as $cat ) {
					$output .= '<li><a href="'. esc_attr( get_category_link( $cat->term_id ) ) .'">'. $cat->cat_name .'</a></li>';
				}

			}

			$wbc_bread_crumb_html .= $output;

			if ( is_single() ) {
				$wbc_bread_crumb_html .= '<li>'. $title .'</li>';
			}

		}elseif ( is_page() || is_home() ) {

			if ( is_home() ) {
				$title = single_post_title( '', false );
				$blog_page_id = get_option( 'page_for_posts', true );

				if ( $blog_page_id ) {
					$parents = array_reverse( get_post_ancestors( $blog_page_id ) );

					$code = '';
					foreach ( $parents as $parent ) {
						$code .='<li><a href="'. esc_attr( get_permalink( $parent ) ) .'">'. get_the_title( $parent ) .'</a></li>';
					}

					$wbc_bread_crumb_html .= $code;
				}
			}
			if ( isset( $post->post_parent ) ) {
				$parents = array_reverse( get_post_ancestors( $post->ID ) );

				$code = '';
				foreach ( $parents as $parent ) {
					$code .='<li><a href="'. get_permalink( $parent ) .'">'. get_the_title( $parent ) .'</a></li>';
				}

				$wbc_bread_crumb_html .= $code;

				$wbc_bread_crumb_html .= '<li>'.$title.'</li>';
			}else {
				$wbc_bread_crumb_html .= '<li>'.$title.'</li>';
			}
		}elseif ( is_author( ) ) {
			global $author;
			$author_info = get_userdata( $author );
			$wbc_bread_crumb_html .= '<li>'. esc_html__( 'Posts By:', 'ninezeroseven' ).' '.$author_info->display_name .'</li>';
		}elseif ( is_404() ) {
			$wbc_bread_crumb_html .= '<li>'. esc_html__( 'Page Not Found', 'ninezeroseven' ) .'</li>';
		}elseif ( is_search() ) {
			$wbc_bread_crumb_html .= '<li>'. esc_html__( 'Search Results:', 'ninezeroseven' ) .' '.  get_search_query() .'</li>';
		}elseif ( is_tag() ) {
			$wbc_bread_crumb_html .= '<li>'. single_tag_title( esc_html__( 'Tag: ', 'ninezeroseven' ), false ). '</li>';
		}elseif ( is_month() || is_day() ) {
			$wbc_bread_crumb_html .= '<li>'. esc_html__( 'Archives: ', 'ninezeroseven' ) .' '. get_the_time( 'F, Y' ) .'</li>';
		}

		$wbc_bread_crumb_html .= '</ul>';

		$wbc_bread_crumb_wrap_html .= apply_filters( 'wbc_bread_crumb_html' , $wbc_bread_crumb_html );

		$wbc_bread_crumb_wrap_html .= '</div>';
		$wbc_bread_crumb_wrap_html .= '</div>';

		echo wp_kses_post( $wbc_bread_crumb_wrap_html );
	}

	add_action( 'wbc907_after_wrapper', 'wbc907_breadcrumb', 1 );
}




/************************************************************************
* Topbar actions
*************************************************************************/
if ( !function_exists( 'wbc907_top_social' ) ) {
	function wbc907_top_social() {

		global $wbc907_data, $post;

		if ( is_single() || is_page() || is_home() && isset( $post->ID ) ) {

			$override_enabled = get_post_meta( $post->ID, 'opts-content-topbar-override', true );
			$top_right_content = get_post_meta( $post->ID, 'opts-topbar-right-override', true );

			if ( $override_enabled == 1 && isset( $top_right_content['redux_repeater_data'] ) ) {

				$items = $top_right_content;

			}else {

				if ( !isset( $wbc907_data['opts-topbar-right'] ) || !isset( $wbc907_data['opts-topbar-right']['redux_repeater_data'] ) ) return;

				$items = $wbc907_data['opts-topbar-right'];
			}

		}else {

			if ( !isset( $wbc907_data['opts-topbar-right'] ) || !isset( $wbc907_data['opts-topbar-right']['redux_repeater_data'] ) ) return;

			$items = $wbc907_data['opts-topbar-right'];
		}

		$html = '';

		$html .= '<div class="social-links">';
		$html .= '	<ul class="clearfix">';

		for ( $i=0; $i < count( $items['redux_repeater_data'] ); $i++ ) {

			$html .= '<li><a href="'.esc_url( $items['field-info'][$i] ).'">';
			if ( !empty( $items['field-icon'][$i] ) ) {
				$html .= '<i class="'.esc_attr( $items['field-icon'][$i] ).'"></i> ';
			}
			$html .= '</a></li>';
		}

		$html .= '	</ul>';
		$html .= '</div>';

		echo wp_kses_post( $html );
	}

	add_action( 'top_bar_right' , 'wbc907_top_social' );
}


if ( !function_exists( 'wbc907_top_info' ) ) {
	function wbc907_top_info() {

		global $wbc907_data, $post;



		if ( is_single() || is_page() || is_home() && isset( $post->ID ) ) {

			$override_enabled = get_post_meta( $post->ID, 'opts-content-topbar-override', true );
			$top_left_content = get_post_meta( $post->ID, 'opts-topbar-left-override', true );

			if ( $override_enabled == 1 && isset( $top_left_content['redux_repeater_data'] ) ) {

				$items = $top_left_content;

			}else {

				if ( !isset( $wbc907_data['opts-topbar-left'] ) || !isset( $wbc907_data['opts-topbar-left']['redux_repeater_data'] ) ) return;

				$items = $wbc907_data['opts-topbar-left'];
			}

		}else {

			if ( !isset( $wbc907_data['opts-topbar-left'] ) || !isset( $wbc907_data['opts-topbar-left']['redux_repeater_data'] ) ) return;

			$items = $wbc907_data['opts-topbar-left'];
		}

		$html = '';


		$html .= '	<ul class="left-content-top clearfix">';

		for ( $i=0; $i < count( $items['redux_repeater_data'] ); $i++ ) {

			$html .= '<li>';
			if ( !empty( $items['field-icon'][$i] ) ) {
				$html .= '<i class="'.esc_attr( $items['field-icon'][$i] ).'"></i> ';
			}

			if ( !empty( $items['field-info'][$i] ) ) {
				$html .= $items['field-info'][$i];
			}

			$html .= '</li>';
		}


		$html .= '</ul>';

		echo wp_kses_post( $html );
	}

	add_action( 'top_bar_left' , 'wbc907_top_info' );
}


/************************************************************************
* Search
*************************************************************************/
if ( !function_exists( 'wbc907_search_exclude' ) ) {
	function wbc907_search_exclude( $query ) {

		if ( $query->is_search && isset( $_GET['s'] ) ) {
			$query->set( 'post_type', array('post','product') );
		}

		return $query;
	}

	add_filter( 'pre_get_posts', 'wbc907_search_exclude' );
}

/************************************************************************
* Menu Bar Function
*************************************************************************/
if ( !function_exists( 'wbc907_menu_class' ) ) {

	function wbc907_menu_class( $class = '' ) {
		echo 'class="' . join( ' ', wbc907_get_menu_class( $class ) ) . '"';
	}

}

if ( !function_exists( 'wbc907_get_menu_class' ) ) {

	function wbc907_get_menu_class( $class = '' ) {


		global $wbc907_data, $post;


		$classes = array();


		//Elastic Header class
		if ( isset( $wbc907_data['opts-elastic-menu'] ) && $wbc907_data['opts-elastic-menu'] == true ) {
			$classes[] = "elastic-enabled";
		}
		//TODO transparent integration
		if ( isset( $wbc907_data['opts-sticky-menu'] ) && $wbc907_data['opts-sticky-menu'] == true || ( !isset( $wbc907_data['opts-page-menu-position'] ) || $wbc907_data['opts-page-menu-position'] == 'top' ) ) {
			$classes[] = "wbc-sticky";
		}

		if ( is_page() && isset( $post->ID ) && $post->post_type == 'page' ) {
			$template = get_post_meta( $post->ID, '_wp_page_template', true );
			if ( $template && $template == 'template-page-full.php' ) {
				$template = 'full-width';
			}
			if ( isset( $wbc907_data['opts-page-menu-position'] ) && $wbc907_data['opts-page-menu-position'] == 'after_num' && $template == 'full-width' ) {
				$classes[] = "standard-menu";
			}elseif ( isset( $wbc907_data['opts-page-menu-position'] ) && $wbc907_data['opts-page-menu-position'] == 'bottom' && $template == 'full-width' ) {
				$classes[] = "bottom-fixed-menu";
			}elseif ( isset( $wbc907_data['opts-sticky-menu'] ) && $wbc907_data['opts-sticky-menu'] == true || ( !isset( $wbc907_data['opts-page-menu-position'] ) || $wbc907_data['opts-page-menu-position'] == 'top' ) ) {
				$classes[] = "top-fixed-menu";
			}

		}else {


			if ( isset( $wbc907_data['opts-portfolio-menu-position'] ) && $wbc907_data['opts-portfolio-menu-position'] == 'after_num' && $wbc907_data['opts-portfolio-layout'] == 'full-width' ) {
				$classes[] = "standard-menu";
			}elseif ( isset( $wbc907_data['opts-portfolio-menu-position'] ) && $wbc907_data['opts-portfolio-menu-position'] == 'bottom' && $wbc907_data['opts-portfolio-layout'] == 'full-width' ) {
				$classes[] = "bottom-fixed-menu";
			}elseif ( isset( $wbc907_data['opts-sticky-menu'] ) && $wbc907_data['opts-sticky-menu'] == true || ( !isset( $wbc907_data['opts-portfolio-menu-position'] ) || $wbc907_data['opts-portfolio-menu-position'] == 'top' ) ) {
				$classes[] = "top-fixed-menu";
			}
		}


		if ( ! empty( $class ) ) {
			if ( !is_array( $class ) )
				$class = preg_split( '#\s+#', $class );
			$classes = array_merge( $classes, $class );
		} else {
			$class = array();
		}

		$classes = array_map( 'esc_attr', $classes );

		return apply_filters( 'wbc907_menu_class', $classes, $class );

	}

}

/************************************************************************
* Body Class
*************************************************************************/

if ( !function_exists( 'wbc907_body_class' ) ) {

	function wbc907_body_class( $classes ) {
		global $wbc907_data,
		$post;


		if ( is_page() && isset( $post->ID ) && $post->post_type == 'page' ) {
			$template = get_post_meta( $post->ID, '_wp_page_template', true );

			if ( $template && $template == 'template-page-full.php' ) {
				$template = 'full-width';
			}

			if ( isset( $wbc907_data['opts-page-menu-position'] ) && $wbc907_data['opts-page-menu-position'] == 'after_num' && $template == 'full-width' ) {
				$classes[] = "has-standard-menu menu-after-row";
			}elseif ( isset( $wbc907_data['opts-page-menu-position'] ) && $wbc907_data['opts-page-menu-position'] == 'bottom' && $template == 'full-width' ) {

				$classes[] = 'has-bottom-menu';
			}elseif ( isset( $wbc907_data['opts-sticky-menu'] ) && $wbc907_data['opts-sticky-menu'] == true || ( !isset( $wbc907_data['opts-page-menu-position'] ) || $wbc907_data['opts-page-menu-position'] == 'top' ) ) {
				$classes[] = 'has-fixed-menu';
			}

		}else {

			if ( isset( $wbc907_data['opts-portfolio-menu-position'] ) && $wbc907_data['opts-portfolio-menu-position'] == 'after_num' && $wbc907_data['opts-portfolio-layout'] == 'full-width' ) {

				$classes[] = 'has-standard-menu menu-after-row';
			}elseif ( isset( $wbc907_data['opts-portfolio-menu-position'] ) && $wbc907_data['opts-portfolio-menu-position'] == 'bottom' && $wbc907_data['opts-portfolio-layout'] == 'full-width' ) {

				$classes[] = 'has-bottom-menu';
			}elseif ( isset( $wbc907_data['opts-sticky-menu'] ) && $wbc907_data['opts-sticky-menu'] == true || ( !isset( $wbc907_data['opts-portfolio-menu-position'] ) || $wbc907_data['opts-portfolio-menu-position'] == 'top' ) ) {
				$classes[] = 'has-fixed-menu';
			}
		}

		if ( isset( $wbc907_data['opts-topbar'] ) && $wbc907_data['opts-topbar'] == true && isset( $wbc907_data['opts-sticky-menu'] ) && $wbc907_data['opts-sticky-menu'] == true ) {
			$classes[] = 'has-top-bar';
		}

		if ( isset( $wbc907_data['opts-portfolio-layout'] ) && $wbc907_data['opts-portfolio-layout'] == 'full-width' ) {
			$classes[] = 'full-width-template';
		}

		if ( is_page() && isset( $post->ID ) ) {
			$template = get_post_meta( $post->ID, '_wp_page_template', true );

			if ( $template && $template == 'template-page-full.php' ) {
				$classes[] = 'full-width-template';
			}
		}


		return $classes;
	}

	add_filter( 'body_class' , 'wbc907_body_class' );
}



/************************************************************************
* Transparent menu body class
*************************************************************************/
	if ( !function_exists( 'wbc907_transparent_menu_class' ) ) {

	function wbc907_transparent_menu_class( $classes ) {
		global $wbc907_data,
		$post;

		$has_transparent = false;

		if ( is_page() && isset( $post->ID ) && $post->post_type == 'page' ) {
			$template = get_post_meta( $post->ID, '_wp_page_template', true );

			$transparent_enabled =  get_post_meta( $post->ID, 'opts-enable-transparent', true );

			if ( $template && $template == 'template-page-full.php' && isset($transparent_enabled) && 1 == $transparent_enabled) {

				if ( isset( $wbc907_data['opts-page-menu-position'] ) && $wbc907_data['opts-page-menu-position'] == 'bottom' && $template == 'full-width' ) {
					$has_transparent = true;
				}elseif ( isset( $wbc907_data['opts-sticky-menu'] ) && $wbc907_data['opts-sticky-menu'] == true || ( !isset( $wbc907_data['opts-page-menu-position'] ) || $wbc907_data['opts-page-menu-position'] == 'top' ) ) {
					$has_transparent = true;
				}
			}

		}

		if( $has_transparent == true ){
			$classes[] = 'has-transparent-menu';
		}


		return $classes;
	}

	add_filter( 'body_class' , 'wbc907_transparent_menu_class' );
}

/************************************************************************
* Logo/Title
* 
* @deprecated 
*************************************************************************/

if ( !function_exists( 'wbc907_logo_title_output' ) ) {
	function wbc907_logo_title_output() {

		global $wbc907_data, $post;


		$html                 = '';
		$parent_page_id       = '';
		$parent_page_override = '';

		if( isset( $post->ID ) && is_single() ){

			$parent_page_id   = get_post_meta( $post->ID , 'opts-parent-options', true );
			$parent_page_override = get_post_meta( $parent_page_id , 'opts-main-logo-override', true );
			
		}

		if ( isset( $wbc907_data['opts-main-logo-override'] ) && $wbc907_data['opts-main-logo-override'] == 1 ) {


			if( isset( $post->ID ) ){
					$parent_url   = get_post_meta( $post->ID , 'opts-is-parent', true );
				}

			$page_url = ( isset( $parent_url ) && 1 == $parent_url ) ? get_permalink($post->ID) : home_url('/');

			$class = ( isset( $wbc907_data['opts-nav-logo-override'] ) && !empty( $wbc907_data['opts-nav-logo-override']['url'] ) && $wbc907_data['logo-enabled-override'] == true ) ? 'has-logo' : 'logo-text';

			$html .= '<div class="site-logo-title '.$class.'">';

			if ( isset( $wbc907_data['opts-nav-logo-override'] ) && !empty( $wbc907_data['opts-nav-logo-override']['url'] ) && $wbc907_data['logo-enabled-override'] == true ) {

				$html .= '<a href="'.esc_attr( $page_url ).'">';
				$html .= '<img class="wbc-main-logo" src="'.esc_attr( $wbc907_data['opts-nav-logo-override']['url'] ).'" alt="'.esc_attr( get_bloginfo( 'name' ) ).'">';
				if( isset($wbc907_data['opts-nav-transparent-logo-override']) && isset($wbc907_data['opts-nav-transparent-logo-override']['url']) && !empty($wbc907_data['opts-nav-transparent-logo-override']['url'])){
					$html .= '<img class="wbc-alt-logo" src="'.esc_attr( $wbc907_data['opts-nav-transparent-logo-override']['url'] ).'" alt="'.esc_attr( get_bloginfo( 'name' ) ).'">';
				}
				$html .= '</a>';

			}else {

				$site_name = ( isset( $wbc907_data['opts-nav-text-override'] ) ) ? $wbc907_data['opts-nav-text-override'] : get_bloginfo('name');
				$html .= '<a href="'.esc_attr( $page_url ).'">'.esc_html( $site_name ).'</a>';

			}

		}elseif($parent_page_id && $parent_page_override == 1){

			$parent_options = wbc_get_meta( $parent_page_id );

			$class = ( isset( $parent_options['opts-nav-logo-override'] ) && !empty( $parent_options['opts-nav-logo-override']['url'] ) && $parent_options['logo-enabled-override'] == true ) ? 'has-logo' : 'logo-text';

			$html .= '<div class="site-logo-title '.$class.'">';

			if ( isset( $parent_options['opts-nav-logo-override'] ) && !empty( $parent_options['opts-nav-logo-override']['url'] ) && $parent_options['logo-enabled-override'] == true ) {

				$html .= '<a href="'.esc_attr( get_permalink( $parent_page_id ) ).'"><img src="'.esc_attr( $parent_options['opts-nav-logo-override']['url'] ).'" alt="'.esc_attr( get_bloginfo( 'name' ) ).'"></a>';

			}else {

				$site_name = ( isset( $parent_options['opts-nav-text-override'] ) ) ? $parent_options['opts-nav-text-override'] : get_bloginfo('name');
				$html .= '<a href="'.esc_attr( get_permalink( $parent_page_id ) ).'">'.esc_html( $site_name ).'</a>';

			}

		}else{


			$class = ( isset( $wbc907_data['opts-nav-logo'] ) && !empty( $wbc907_data['opts-nav-logo']['url'] ) && $wbc907_data['logo-enabled'] == true ) ? 'has-logo' : 'logo-text';


			$html .= '<div class="site-logo-title '.$class.'">';

			if ( isset( $wbc907_data['opts-nav-logo'] ) && !empty( $wbc907_data['opts-nav-logo']['url'] ) && $wbc907_data['logo-enabled'] == true ) {

				$html .= '<a href="'.esc_attr( home_url('/') ).'">';
				$html .= '<img class="wbc-main-logo" src="'.esc_attr( $wbc907_data['opts-nav-logo']['url'] ).'" alt="'.esc_attr( get_bloginfo( 'name' ) ).'">';
				if( isset($wbc907_data['opts-nav-transparent-logo']) && isset($wbc907_data['opts-nav-transparent-logo']['url']) && !empty($wbc907_data['opts-nav-transparent-logo']['url'])){
					$html .= '<img class="wbc-alt-logo" src="'.esc_attr( $wbc907_data['opts-nav-transparent-logo']['url'] ).'" alt="'.esc_attr( get_bloginfo( 'name' ) ).'">';
				}
				$html .= '</a>';

			}else {
				$site_name = ( isset( $wbc907_data['opts-nav-text'] ) ) ? $wbc907_data['opts-nav-text'] : get_bloginfo('name');
				$html .= '<a href="'.esc_attr( home_url('/') ).'">'.esc_html( $site_name ).'</a>';

			}
		}

		$html .= '</div><!-- ./site-logo-title -->';

		echo !empty( $html ) ? $html : '';

	}

	add_action( 'wbc907_logo_title', 'wbc907_logo_title_output' , 0 );
}

/************************************************************************
* Topbar
*************************************************************************/

if ( !function_exists( 'wbc907_before_nav_bar_output' ) ) {
	function wbc907_before_nav_bar_output() {

		global $wbc907_data;

		if ( isset( $wbc907_data['opts-topbar'] ) && $wbc907_data['opts-topbar'] == true ) {

		?>
			<div class="top-extra-bar">
	          <div class="container">

	            <div class="left-top-bar">

	            	<?php do_action( 'top_bar_left' ); ?>

	            </div>

	            <div class="right-top-bar clearfix">

	            	<?php do_action( 'top_bar_right' ); ?>

	            </div>

	          </div> <!-- ./container -->

	        </div> <!-- ./top-extra-bar -->

		<?php
		}

	}

	add_action( 'wbc907_before_nav_bar', 'wbc907_before_nav_bar_output' , 0 );
}


/************************************************************************
* Blog layout class
*************************************************************************/

if ( !function_exists( 'wbc907_blog_layout_class_output' ) ) {
	function wbc907_blog_layout_class_output() {

		global $wbc907_data;

		if ( isset( $wbc907_data['opts-blog-style'] ) ) {
			return $wbc907_data['opts-blog-style'];
		}

		return 'blog-style-1';

	}

	add_filter( 'wbc907_blog_layout_class', 'wbc907_blog_layout_class_output' , 0 );
}

/************************************************************************
* After WP_Footer- Custom User JS
*************************************************************************/

if ( !function_exists( 'wbc907_after_footer_output' ) ) {
	function wbc907_after_footer_output() {

		global $wbc907_data;
		$output = '';

		if ( isset( $wbc907_data['opts-custom-js'] ) && !empty( $wbc907_data['opts-custom-js'] ) ) {
			$output .= "\n".'<!-- Begin User JS -->'."\n";

			$output .= trim( $wbc907_data['opts-custom-js'] );

			$output .= "\n".'<!-- END User JS -->'."\n\n";
		}
		echo ( !empty( $output ) ) ?  $output  : '';

	}

	add_action( 'wp_footer', 'wbc907_after_footer_output' , 2000 );
}

/************************************************************************
* After Head- Custom User CSS
*************************************************************************/


if ( !function_exists( 'wbc907_after_head_output' ) ) {
	function wbc907_after_head_output() {

		global $wbc907_data;

		$output = '';
		$user_css = ( isset( $wbc907_data['opts-custom-css'] ) ) ? trim( $wbc907_data['opts-custom-css'] ) : '';

		if ( ! empty( $user_css ) ) {
			$user_css = preg_replace('/\s\s+/', '', $user_css);
			$output .= '<style type="text/css">';

			$output .= wp_strip_all_tags( $user_css );

			$output .= '</style>'."\n\n";

			$output = preg_replace('/\/\*([^\/\*]+)\*\//', '', $output);
		}

		echo ( !empty( $output ) ) ?  $output  : '';

	}

	add_action( 'wp_head', 'wbc907_after_head_output' , 250 );
}

/************************************************************************
* Custom Page Sidebars
*************************************************************************/

if ( !function_exists( 'wbc907_custom_sidebar_output' ) ) {

	function wbc907_custom_sidebar_output( $sidebar ) {
		global $wbc907_data;


		if ( is_single() || is_page() || is_home() ) {

			if ( isset( $wbc907_data['opts-single-portfolio-sidebar'] ) && !empty( $wbc907_data['opts-single-portfolio-sidebar'] ) && get_post_type() == 'wbc-portfolio' ) {

				$sidebar = $wbc907_data['opts-single-portfolio-sidebar'];

			}elseif ( isset( $wbc907_data['opts-single-portfolio-sidebar-global'] ) && !empty( $wbc907_data['opts-single-portfolio-sidebar-global'] ) && get_post_type() == 'wbc-portfolio' ) {

				$sidebar = $wbc907_data['opts-single-portfolio-sidebar-global'];

			}elseif ( isset( $wbc907_data['opts-single-page-sidebar'] ) && !empty( $wbc907_data['opts-single-page-sidebar'] ) ) {


				$sidebar = $wbc907_data['opts-single-page-sidebar'];

			}elseif ( isset( $wbc907_data['opts-single-page-sidebar-global'] ) && !empty( $wbc907_data['opts-single-page-sidebar-global'] ) ) {

				$sidebar = $wbc907_data['opts-single-page-sidebar-global'];

			}

		}else {

			if ( isset( $wbc907_data['opts-main-sidebar-global'] ) && !empty( $wbc907_data['opts-main-sidebar-global'] ) ) {
				$sidebar = $wbc907_data['opts-main-sidebar-global'];
			}

		}

		// Possiblity to overide sidebar. :)
		return apply_filters( 'wbc907_sidebar_return' , $sidebar );
	}

	add_filter( 'wbc907_custom_sidebars', 'wbc907_custom_sidebar_output' );
}

/************************************************************************
* Custom Page Menus
*************************************************************************/

if ( !function_exists( 'wbc907_page_menu_output' ) ) {
	function wbc907_page_menu_output() {

		global $wbc907_data, $sitepress_settings,$post;

		$menu = '';

		if ( is_single() || is_page() || is_home() ) {

			if ( isset( $wbc907_data['opts-page-menu-override'] ) && !empty( $wbc907_data['opts-page-menu-override'] ) ) {

				$menu = (int) $wbc907_data['opts-page-menu-override'];

			}elseif( is_single() ){

				$parent_page_id   = get_post_meta( $post->ID , 'opts-parent-options', true );
				$parent_page_menu = get_post_meta( $parent_page_id , 'opts-page-menu-override', true );

				if( $parent_page_id && $parent_page_menu && is_numeric( $parent_page_menu ) ){
					$menu = (int) $parent_page_menu;
				}

			}

			if( is_numeric( $menu ) ){
				//Set WPML menu ID so it adds selector when enabled :)
				if ( isset( $sitepress_settings[ 'menu_for_ls' ] ) && is_numeric( $sitepress_settings[ 'menu_for_ls' ] ) ) {
					$sitepress_settings[ 'menu_for_ls' ] = $menu;
				}
			}

		}

		//Possiblilty to overide menu :) Menu (int) ID is returned
		return apply_filters( 'wbc907_custom_menu_return', $menu );
	}
	add_filter( 'wbc907_page_menu', 'wbc907_page_menu_output' );
}

// Footer Menu Filter
if ( !function_exists( 'wbc907_page_footer_menu_output' ) ) {
	function wbc907_page_footer_menu_output() {

		global $wbc907_data,$post;

		$menu = '';

		if ( is_single() || is_page() || is_home() ) {

			if ( isset( $wbc907_data['opts-page-menu-footer-override'] ) && !empty( $wbc907_data['opts-page-menu-footer-override'] ) ) {

				$menu = (int) $wbc907_data['opts-page-menu-footer-override'];

			}elseif( is_single() ){

				$parent_page_id   = get_post_meta( $post->ID , 'opts-parent-options', true );
				$parent_page_menu = get_post_meta( $parent_page_id , 'opts-page-menu-footer-override', true );

				if( $parent_page_id && $parent_page_menu && is_numeric( $parent_page_menu ) ){
					$menu = (int) $parent_page_menu;
				}

			}

		}

		//Possiblilty to overide menu :) Menu (int) ID is returned
		return apply_filters( 'wbc907_custom_footer_menu_return', $menu );
	}
	add_filter( 'wbc907_page_footer_menu', 'wbc907_page_footer_menu_output' );
}

/************************************************************************
* Footer Enable/disable
*************************************************************************/

if ( !function_exists( 'wbc907_footer_enable_check' ) ) {
	function wbc907_footer_enable_check( $enabled ) {

		global $wbc907_data;

		// if ( is_single() || is_page() || ( is_home() && !is_front_page() ) ) {

			if ( isset( $wbc907_data['opts-footer-disable'] ) && is_numeric( $wbc907_data['opts-footer-disable'] ) ) {
				$enabled =  (bool) $wbc907_data['opts-footer-disable'];
			}

		// }

		//Just incase, return true/false
		return apply_filters( 'wbc907_footer_enable_return', $enabled );
	}
	add_filter( 'wbc907_footer_enable' , 'wbc907_footer_enable_check' );
}

// Footer Widget Area
if ( !function_exists( 'wbc907_widget_area_check' ) ) {

	function wbc907_widget_area_check( $enabled ) {

		global $wbc907_data;

		// if ( is_single() || is_page() || ( is_home() && !is_front_page() ) ) {

			if ( isset( $wbc907_data['opts-footer-widget-area-disable'] ) && is_numeric( $wbc907_data['opts-footer-widget-area-disable'] ) ) {
				$enabled = (bool) $wbc907_data['opts-footer-widget-area-disable'];
			}

		// }

		//Just incase, return true/false
		return apply_filters( 'wbc907_widget_area_enable_return', $enabled );
	}
	add_filter( 'wbc907_widget_area_enable' , 'wbc907_widget_area_check' );
}

// Footer Copyright Area
if ( !function_exists( 'wbc907_copy_area_check' ) ) {
	function wbc907_copy_area_check( $enabled ) {

		global $wbc907_data;

		// if ( is_single() || is_page() || ( is_home() && !is_front_page() ) ) {

			if ( isset( $wbc907_data['opts-footer-copyright-disable'] ) && is_numeric( $wbc907_data['opts-footer-copyright-disable'] ) ) {
				$enabled = (bool) $wbc907_data['opts-footer-copyright-disable'];
			}

		// }

		//Just incase, return true/false
		return apply_filters( 'wbc907_copy_area_enable_return', $enabled );
	}
	add_filter( 'wbc907_copy_area_enable' , 'wbc907_copy_area_check' );
}

/************************************************************************
* Page Title Function
*************************************************************************/

if ( ! function_exists( 'wbc907_wp_title' ) ) {

	function wbc907_wp_title( $title, $sep ) {
		global $paged,
		$page,
		$s;

		if ( is_feed() )
			return $title;

		// Add the site name.
		$title .= get_bloginfo( 'name' );

		// Add the site description for the home/front page.
		$site_description = get_bloginfo( 'description', 'display' );
		if ( $site_description && ( is_home() || is_front_page() ) )
			$title = "$title $sep $site_description";

		if ( $site_description && is_search() )
			$title = sprintf( esc_html__( 'Search Results For: %s', 'ninezeroseven' ), $s )." ".$sep." ".get_bloginfo( 'name' );

		// Add a page number if necessary.
		if ( $paged >= 2 || $page >= 2 )
			$title = "$title $sep " . sprintf( esc_html__( 'Page %s', 'ninezeroseven' ), max( $paged, $page ) );

		return esc_html( $title );

	}
}

/************************************************************************
* Shiv for title backwards compatibility
*************************************************************************/
if ( !function_exists( '_wp_render_title_tag' ) ){
    function wbc907_theme_render_title() {
?>
<title><?php wp_title( '|', true, 'right' );?></title>
<?php

	add_filter( 'wp_title' , 'wbc907_wp_title' , 10 , 2 );
    }
    add_action( 'wp_head', 'wbc907_theme_render_title',0 );
}

/************************************************************************
* Comment Form
*************************************************************************/
if ( !function_exists( 'wbc907_custom_comment_form' ) ) {
	function wbc907_custom_comment_form( $args = array(), $post_id = null ) {
		global $id;
		if ( null === $post_id )
			$post_id = $id;
		else
			$id = $post_id;

		$commenter = wp_get_current_commenter();
		$user = wp_get_current_user();
		$user_identity = $user->exists() ? $user->display_name : '';

		$req = get_option( 'require_name_email' );
		$aria_req = ( $req ? " aria-required='true'" : '' );
		$fields =  array(
			'author' => '<p class="comment-form-author"><label for="author">' . esc_html__( 'Name', 'ninezeroseven' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' .
			'<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" ' . $aria_req . ' /></p>',
			'email'  => '<p class="comment-form-email"><label for="email">' . esc_html__( 'Email', 'ninezeroseven' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' .
			'<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" ' . $aria_req . ' /></p>',
			'url'    => '<p class="comment-form-url"><label for="url">' . esc_html__( 'Website', 'ninezeroseven' ) . '</label>' .
			'<input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></p>',
		);

		$required_text = sprintf( ' ' . __( 'Required fields are marked %s', 'ninezeroseven' ), '<span class="required">*</span>' );
		$defaults = array(
			'fields'               => apply_filters( 'comment_form_default_fields', $fields ),
			'comment_field'        => '<p class="comment-form-comment"><label for="comment">' . _x( 'Comment', 'noun', 'ninezeroseven' ) . '</label><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea></p>',
			'must_log_in'          => '<p class="must-log-in">' . sprintf( __( 'You must be <a href="%s">logged in</a> to post a comment.', 'ninezeroseven' ), wp_login_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '</p>',
			'logged_in_as'         => '<p class="logged-in-as">' . sprintf( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>', 'ninezeroseven' ), get_edit_user_link(), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '</p>',
			'comment_notes_before' => '<p class="comment-notes">' . esc_html__( 'Your email address will not be published.', 'ninezeroseven' ) . ( $req ? $required_text : '' ) . '</p>',
			'comment_notes_after'  => '<p class="form-allowed-tags">' . sprintf( __( 'You may use these <abbr title="HyperText Markup Language">HTML</abbr> tags and attributes: %s', 'ninezeroseven' ), ' <code>' . allowed_tags() . '</code>' ) . '</p>',
			'id_form'              => 'commentform',
			'id_submit'            => 'submit',
			'title_reply'          => esc_html__( 'Leave a Reply', 'ninezeroseven' ),
			'title_reply_to'       => __( 'Leave a Reply to %s', 'ninezeroseven' ),
			'cancel_reply_link'    => esc_html__( 'Cancel reply', 'ninezeroseven' ),
			'label_submit'         => esc_html__( 'Post Comment', 'ninezeroseven' ),
		);

		$args = wp_parse_args( $args, apply_filters( 'comment_form_defaults', $defaults ) );

			?>
			<?php if ( comments_open( $post_id ) ) : ?>
				<?php do_action( 'comment_form_before' ); ?>
				<div id="respond" class="comment-form">
					<div class="heading">
						<h4><?php comment_form_title( $args['title_reply'], $args['title_reply_to'] ); ?></h4>
					</div>
					<small><?php cancel_comment_reply_link( $args['cancel_reply_link'] ); ?></small>
					<?php if ( get_option( 'comment_registration' ) && !is_user_logged_in() ) : ?>
						<?php echo apply_filters('comment_form_must_login', $args['must_log_in']); ?>
						<?php do_action( 'comment_form_must_log_in_after' ); ?>
					<?php else : ?>
						<form action="<?php echo site_url( '/wp-comments-post.php' ); ?>" method="post" id="<?php echo esc_attr( $args['id_form'] ); ?>" class="form-horizontal">
							<?php do_action( 'comment_form_top' ); ?>
							<?php if ( is_user_logged_in() ) : ?>
								<?php echo apply_filters( 'comment_form_logged_in', $args['logged_in_as'], $commenter, $user_identity ); ?>
								<?php do_action( 'comment_form_logged_in_after', $commenter, $user_identity ); ?>
							<?php else : ?>
								<?php echo apply_filters('comment_notes_before',$args['comment_notes_before']); ?>
								<?php
									do_action( 'comment_form_before_fields' );
									foreach ( (array) $args['fields'] as $name => $field ) {
										echo apply_filters( "comment_form_field_{$name}", $field ) . "\n";
									}
									do_action( 'comment_form_after_fields' );
								?>
							<?php endif; ?>
							<?php echo apply_filters( 'comment_form_field_comment', $args['comment_field'] ); ?>
							<?php echo apply_filters('comment_notes_after', $args['comment_notes_after'] ); ?>
							<p class="form-submit">
								<input name="submit" type="submit" id="<?php echo esc_attr( $args['id_submit'] ); ?>" value="<?php echo esc_attr( $args['label_submit'] ); ?>" />
								<?php comment_id_fields( $post_id ); ?>
							</p>
							<?php do_action( 'comment_form', $post_id ); ?>
						</form>
					<?php endif; ?>
				</div><!-- #respond -->
				<?php do_action( 'comment_form_after' ); ?>
			<?php else : ?>
				<?php do_action( 'comment_form_comments_closed' ); ?>
			<?php endif; ?>
		<?php
	}
}
if ( !function_exists( 'wbc907_get_avatar_url' ) ) {
	function wbc907_get_avatar_url( $get_avatar ) {
		preg_match( "/src='(.*?)'/i", $get_avatar, $matches );
		return $matches[1];
	}
}
if ( !function_exists( 'wbc907_custom_comments' ) ) {
	function wbc907_custom_comments( $comment, $args, $depth ) {

		$GLOBALS['comment'] = $comment;

		if ( get_comment_type() == 'comment' ) { ?>
			<!-- COMMENT -->
			<li id="comment-<?php comment_ID();?>">

				<div <?php comment_class( 'clearfix' );?>>

					<img src="<?php echo wbc907_get_avatar_url( get_avatar( $comment, '60' ) );?>" class="comment-image" width="60" height="60" alt="" />

				<div class="comment-wrap">
					<div class="comment-meta">
						<?php comment_author_link();?> on <?php comment_date();?>
					</div>


					<div class="comment-content">

						<?php if ( $comment->comment_approved == '0' ) :?>

						<p><?php esc_html_e( 'Your Comment Awaiting Moderation', 'ninezeroseven' );?></p>

					<?php else: ?>

						<?php comment_text();?>

					<?php endif;?>
					</div>



					<div class="reply-link"><?php comment_reply_link( array_merge( $args, array( 'depth'=>$depth, 'max_depth'=>$args['max_depth'] ) ) );?></div>
				</div>
			<!-- END COMMENT -->
			</div>


		<?php
		}

	}
}

if ( !function_exists( 'custom_comment_form' ) ) {
	function custom_comment_form( $defaults ) {
		$defaults['comment_notes_before'] = '';
		$defaults['comment_notes_after'] = '';
		$defaults['id_form'] = 'reply';
		$defaults['comment_field'] = '<label for="message">'. __( 'Comment*', 'ninezeroseven' ).'</label><textarea id="message" name="comment" cols="90" rows="10"></textarea>';

		return $defaults;
	}

	add_filter( 'comment_form_defaults', 'custom_comment_form' );
}

if ( !function_exists( 'custom_form_fields' ) ) {
	function custom_form_fields() {
		$commenter = wp_get_current_commenter();
		$req = get_option( 'require_name_email' );
		$arial_req = ( $req ? " aria-required='true'" : ' ' );

		$fields =  array(
			'author' => '<div class="row"><p class="comment-form-author col-sm-6 col-md-4"><label for="author">' . __( 'Name', 'ninezeroseven' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' .
			'<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $arial_req . ' /></p>',
			'email'  => '<p class="comment-form-email col-sm-6 col-md-4"><label for="email">' . __( 'Email', 'ninezeroseven' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' .
			'<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $arial_req . ' /></p>',
			'url'    => '<p class="comment-form-url col-sm-6 col-md-4"><label for="url">' . __( 'Website', 'ninezeroseven' ) . '</label>' .
			'<input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></p></div>',
		);
		return $fields;
	}
	add_filter( 'comment_form_default_fields', 'custom_form_fields' );
}

/************************************************************************
* Next/Prev Links
*************************************************************************/

if ( ! function_exists( 'wbc907_paging_nav' ) ) {

	function wbc907_paging_nav() {

		if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
			return;
		}
		?>

		<ul class="wbc-pager">

			<?php if ( get_next_posts_link() ) : ?>
			<li class="previous"><?php next_posts_link( sprintf( '<span class="meta-nav">&larr;</span> %1s ', esc_html__( 'Older posts', 'ninezeroseven' ) ) ); ?></li>
			<?php endif; ?>

			<?php if ( get_previous_posts_link() ) : ?>
			<li class="next"><?php previous_posts_link( sprintf( ' %1s <span class="meta-nav">&rarr;</span> ', esc_html__( 'Newer posts', 'ninezeroseven' ) ) ); ?></li>
			<?php endif; ?>

		</ul><!-- .pager -->

		<?php
	}
}

/************************************************************************
* PORTFOLIO FUNCTIONS
*************************************************************************/
if ( !function_exists( 'wbc907_portfolio_slug_return' ) ) {

	function wbc907_portfolio_slug_return( $slug ) {

		$wbc907_options = get_option( 'wbc907_data' );

		if ( isset( $wbc907_options['opts-portfolio-slug'] ) && !empty( $wbc907_options['opts-portfolio-slug'] ) ) {
			$slug = $wbc907_options['opts-portfolio-slug'];
		}

		return $slug;
	}

	add_filter( 'wbc_portfolio_slug', 'wbc907_portfolio_slug_return' );
}


if ( !function_exists( 'wbc907_portfolio_template' ) ) {

	function wbc907_portfolio_template( $template ) {
		global $post;

		if ( isset( $post->post_type ) && is_single() && $post->post_type == 'wbc-portfolio' ) {
			$template = locate_template( 'single-portfolio.php' );
		}

		return $template;
	}

	add_filter( 'template_include', 'wbc907_portfolio_template' );
}

/************************************************************************
* Menu Bar Output
*************************************************************************/
if ( !function_exists( 'wbc907_menu_bar_output' ) ) {

	function wbc907_menu_bar_output( $echo = true , $count = 0 ) {

		global $post;

		if ( isset( $post->ID ) ) {

			$template      = 'default';
			$menu_position = '';
			$menu_after    = '';
			$after_row     = '';


			if ( is_page() && $post->post_type == 'page' ) {
				$template = get_post_meta( $post->ID, '_wp_page_template', true );
				if ( $template && $template == 'template-page-full.php' ) {
					$template      = 'full-width';
					$menu_position = get_post_meta( $post->ID , 'opts-page-menu-position', true );
					$menu_after    = get_post_meta( $post->ID , 'opts-page-menu-after', true );
					$after_row     = ( !empty( $menu_after ) && is_numeric( $menu_after )) ? $menu_after : 1 ;
				}

			}elseif ( is_single() ) {
				$template = get_post_meta( $post->ID, 'opts-portfolio-layout', true );

				if ( $template && $template == 'full-width' ) {
					$template      = 'full-width';
					$menu_position = get_post_meta( $post->ID , 'opts-portfolio-menu-position', true );
					
					$menu_after    = get_post_meta( $post->ID , 'opts-portfolio-menu-after', true );
					$after_row     = ( !empty( $menu_after ) && is_numeric( $menu_after )) ? $menu_after : 1 ;
				}

			}

			if ( $count != $after_row && $template == 'full-width' && $menu_position == 'after_num' ) return;


		}

		ob_start();
		locate_template( apply_filters( 'wbc907_menu_bar_locate', 'assets/php/misc/theme-menu-bar.php' ), true );
		// $wbc_menu_content = ob_get_clean();

		if ( $echo == true ) {
			echo ob_get_clean();
		}else {
			return ob_get_clean();
		}
	}
}
/************************************************************************
* Before afters
*************************************************************************/
if ( !function_exists( 'wbc_reuseable_after' ) ) {
	function wbc_reuseable_after() {
		global $post;

		$wbc_options = get_option( 'wbc907_data' );

		$has_reusables = false;

		$custom_post = (bool) apply_filters( 'wbc_reuseable_custom_post', false );

		if ( isset( $post->ID ) ) {
			$wbc_id = intval( apply_filters( 'wbc_reuseable_after_id', $post->ID ) );

			if ( 0 == $wbc_id ) {
				$wbc_id = $post->ID;
			}
		}

		if ( isset( $wbc_id ) && is_single() || is_front_page() || is_singular()  || true == $custom_post ) {
			$post_meta = wbc_get_meta( $wbc_id );
			if ( isset( $post_meta['opts-reuseable-switch'] ) &&  0 == $post_meta['opts-reuseable-switch'] || isset( $post_meta['opts-reuseable-after-switch'] ) &&  0 == $post_meta['opts-reuseable-after-switch'] ) {
				return;
			}

		}

		if ( isset( $wbc_id ) && is_single() || is_front_page() || is_singular()  || true == $custom_post ) {
			$post_meta = wbc_get_meta( $wbc_id );
			if ( isset( $post_meta['opts-single-reuse-after'] ) &&  is_array( $post_meta['opts-single-reuse-after'] ) ) {
				$has_reusables = true;
				$reusables = (array) $post_meta['opts-single-reuse-after'];
			}

		}

		if ( $has_reusables == false ) {

			if ( is_search() ) {
				if( isset( $wbc_options['opts-search-reuse-after'] ) && is_array( $wbc_options['opts-search-reuse-after'] ) ) {
					$reusables = (array) $wbc_options['opts-search-reuse-after'];
					$has_reusables = true;
				}
			}elseif ( is_category() ) {
				if( isset( $wbc_options['opts-category-reuse-after'] ) && is_array( $wbc_options['opts-category-reuse-after'] ) ) {
					$reusables = (array) $wbc_options['opts-category-reuse-after'];
					$has_reusables = true;
				}
			}elseif ( is_404() ) {
				if( isset( $wbc_options['opts-404-reuse-after'] ) && is_array( $wbc_options['opts-404-reuse-after'] ) ) {
					$reusables = (array) $wbc_options['opts-404-reuse-after'];
					$has_reusables = true;
				}
			}
		}

		if ( $has_reusables == false && isset( $post->post_type ) && isset( $wbc_options['opts-'.sanitize_title( $post->post_type ).'-reuse-after'] ) && is_array( $wbc_options['opts-'.sanitize_title( $post->post_type ).'-reuse-after'] ) ) {
			$has_reusables = true;

			$reusables = (array) $wbc_options['opts-'.sanitize_title( $post->post_type ).'-reuse-after'];

		}elseif ( $has_reusables == false && isset( $wbc_options['opts-global-reuse-after'] ) && is_array( $wbc_options['opts-global-reuse-after'] ) ) {
			$has_reusables = true;

			$reusables = (array) $wbc_options['opts-global-reuse-after'];
		}


		if ( true === $has_reusables && is_array( $reusables ) && count( $reusables ) > 0 ) {

			foreach ( $reusables as $reuseable ) {

				if ( isset( $reuseable ) && !empty( $reuseable ) ) {

					$reuse_post = get_post( $reuseable );

					if ( isset( $reuse_post->post_content ) && !empty( $reuse_post->post_content ) ) {
						echo do_shortcode( $reuse_post->post_content );
					}
				}
			}
		}
	}

	add_action( 'wbc907_before_footer', 'wbc_reuseable_after' );
}

if ( !function_exists( 'wbc_reuseable_before' ) ) {
	function wbc_reuseable_before() {
		global $post;

		$wbc_options = get_option( 'wbc907_data' );

		$has_reusables = false;

		$custom_post = (bool) apply_filters( 'wbc_reuseable_custom_post', false );

		if ( isset( $post->ID ) ) {
			$wbc_id = intval( apply_filters( 'wbc_reuseable_before_id', $post->ID ) );

			if ( 0 == $wbc_id ) {
				$wbc_id = $post->ID;
			}
		}

		if ( isset( $wbc_id ) && is_single() || is_front_page() || is_singular() || true == $custom_post ) {
			$post_meta = wbc_get_meta( $wbc_id );
			if ( isset( $post_meta['opts-reuseable-switch'] ) &&  0 == $post_meta['opts-reuseable-switch'] || isset( $post_meta['opts-reuseable-before-switch'] ) &&  0 == $post_meta['opts-reuseable-before-switch'] ) {
				return;
			}

		}

		if ( isset( $wbc_id ) && is_single() || is_front_page() || is_singular() || true == $custom_post ) {
			$post_meta = wbc_get_meta( $wbc_id );
			if ( isset( $post_meta['opts-single-reuse-before'] ) &&  is_array( $post_meta['opts-single-reuse-before'] ) ) {
				$has_reusables = true;
				$reusables = (array) $post_meta['opts-single-reuse-before'];
			}

		}

		if ( $has_reusables == false ) {

			if ( is_search() ) {
				if( isset( $wbc_options['opts-search-reuse-before'] ) && is_array( $wbc_options['opts-search-reuse-before'] ) ) {
					$reusables = (array) $wbc_options['opts-search-reuse-before'];
					$has_reusables = true;
				}
			}elseif ( is_category() ) {
				if( isset( $wbc_options['opts-category-reuse-before'] ) && is_array( $wbc_options['opts-category-reuse-before'] ) ) {
					$reusables = (array) $wbc_options['opts-category-reuse-before'];
					$has_reusables = true;
				}
			}elseif ( is_404() ) {
				if( isset( $wbc_options['opts-404-reuse-before'] ) && is_array( $wbc_options['opts-404-reuse-before'] ) ) {
					$reusables = (array) $wbc_options['opts-404-reuse-before'];
					$has_reusables = true;
				}
			}
		}

		if ( $has_reusables == false && isset( $post->post_type ) && isset( $wbc_options['opts-'.sanitize_title( $post->post_type ).'-reuse-before'] ) ) {
			$has_reusables = true;

			$reusables = (array) $wbc_options['opts-'.sanitize_title( $post->post_type ).'-reuse-before'];

		}elseif ( $has_reusables == false && isset( $wbc_options['opts-global-reuse-before'] ) && is_array( $wbc_options['opts-global-reuse-before'] ) ) {
			$has_reusables = true;

			$reusables = (array) $wbc_options['opts-global-reuse-before'];
		}

		if ( true === $has_reusables && is_array( $reusables ) && count( $reusables ) > 0 ) {

			foreach ( $reusables as $reuseable ) {

				if ( isset( $reuseable ) && !empty( $reuseable ) ) {

					$reuse_post = get_post( $reuseable );

					if ( isset( $reuse_post->post_content ) && !empty( $reuse_post->post_content ) ) {
						echo do_shortcode( $reuse_post->post_content );
					}
				}
			}
		}
	}
	add_action( 'wbc907_after_wrapper', 'wbc_reuseable_before' );
}

?>
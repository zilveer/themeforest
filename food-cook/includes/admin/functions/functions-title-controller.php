<?php
// File Security Check
if ( ! defined( 'ABSPATH' ) ) exit; 

/*-----------------------------------------------------------------------------------*/
/* Page & Post Header Title Contoller*/
/*-----------------------------------------------------------------------------------*/
//class DF_Title_Controller {

/**
 * init()
 *
 * initialize action
 * 
 * @return void 
 */
//public function DF_Title_Controller() {
    


    add_action( 'dahztheme_title_controller',  'df_fancy_title_header_controller' , 10 );
    add_action( 'dahztheme_title_controller',  'df_slider_title_header_controller' , 10 );
    add_action( 'dahztheme_title_controller',  'df_page_title_header_controller', 15 );

	
//}	

/**
 *  Page & Post Show or Hide Header Title Contoller
 * @return void 
 */
if( ! function_exists('df_page_title_header_controller') ) :

function df_page_title_header_controller() {
 	$show_titles = ( 'true' == get_option( 'woo_show_page_header_title' ) );

	if ( is_404() ) return false;

	if ( !$show_titles ) {
		return;
	}

	$post_id = '';
	if( is_singular() ){
		$post_id = get_the_ID();
	}
 
 	$title_align = get_option('woo_page_header_title_align');
	$title_classes = array( 'df-page-header' );
	switch( $title_align ) {

		case 'right' :
			$title_classes[] = 'title-right';
			break;

		case 'center' :
			$title_classes[] = 'title-center';
			break;

		default:
			$title_classes[] = 'title-left';
	}

 $before_title =  '<div id="df-normal-header" class="'.esc_attr( implode( ' ', $title_classes ) ).'">'."\n".'
 					<div class="col-full df-header-wrap">'."\n".'
 						<div class="df-header-container">'."\n";
 $after_title = '</div></div></div>';
 $title_template = '<div class="df-header"><h1>%s</h1></div>';
 $title = '';
 $df_breadcrumbs = (  'true' == get_option('woo_breadcrumbs_show') );
 $is_home = ( ! is_home() && ! is_front_page() );
 $page_header_style = get_post_meta( $post_id, 'df_metabox_header_style', true );

 				if( is_page() || is_single() ) { 	

					if( 'hide' != $page_header_style ){

						$title = sprintf( $title_template, get_the_title() );

					} else {

						$df_breadcrumbs = (  '' == get_option('woo_breadcrumbs_show') );
						$before_title = $after_title = '';
						return;

					}


       			} elseif ( is_search() ) {

          		$content = _x( 'Search Results..', 'archive title', 'woothemes' );
          		$title = sprintf( $title_template, $content );

				} elseif ( is_archive() ) {

     				if ( is_category() ) { 

					$content = _x( 'Category Archives', 'archive title', 'woothemes' );

					} elseif ( is_tag() ) {

					$content = _x( 'Tag Archives', 'archive title', 'woothemes' );	

					} elseif ( is_author() ) {

					$content = sprintf ( _x( 'Author Archives : %s', 'archive title', 'woothemes' ), get_the_author() );
          			
          			} elseif( is_year() ) {

          			$content = _x( 'Post Archives by Year', 'archive title', 'woothemes' );	

          			} elseif ( is_month() ) {

          			$content = _x( 'Post Archives by Month', 'archive title', 'woothemes' );	

          			} elseif ( is_day() ) {

          			$content = _x( 'Post Archives by Day', 'archive title', 'woothemes' );

          			} elseif ( is_tax('recipe_type') ) {

					$term = get_queried_object();
					$tax = get_taxonomy( $term->taxonomy );
					$content = sprintf( _x( '%s', 'archive title', 'woothemes' ), '<span>' . single_term_title( $tax->labels->name . ' ', false ) . '</span>' );

          			} elseif ( is_tax('cuisine') ) {

					$term = get_queried_object();
					$tax = get_taxonomy( $term->taxonomy );
					$content = sprintf( _x( '%s', 'archive title', 'woothemes' ), '<span>' . single_term_title( $tax->labels->name . ' ', false ) . '</span>' );

          			} elseif ( is_tax('course') ) {

					$term = get_queried_object();
					$tax = get_taxonomy( $term->taxonomy );
					$content = sprintf( _x( '%s', 'archive title', 'woothemes' ), '<span>' . single_term_title( $tax->labels->name . ' ', false ) . '</span>' );

          			} elseif ( is_tax('ingredient') ) {

					$term = get_queried_object();
					$tax = get_taxonomy( $term->taxonomy );
					$content = sprintf( _x( '%s', 'archive title', 'woothemes' ), '<span>' . single_term_title( $tax->labels->name . ' ', false ) . '</span>' );

          			} elseif ( is_tax('skill_level') ) {

					$term = get_queried_object();
					$tax = get_taxonomy( $term->taxonomy );
					$content = sprintf( _x( '%s', 'archive title', 'woothemes' ), '<span>' . single_term_title( $tax->labels->name . ' ', false ) . '</span>' );

          			} elseif ( is_tax('calories') ) {

					$term = get_queried_object();
					$tax = get_taxonomy( $term->taxonomy );
					$content = sprintf( _x( '%s', 'archive title', 'woothemes' ), '<span>' . single_term_title( $tax->labels->name . ' ', false ) . '</span>' );

          			} else { 	

          			$content = _x( 'Archives', 'archive title', 'woothemes' );	
          			}          		

          			$title = sprintf( $title_template, $content  ); 
 
				} elseif ( is_404() ) {

					$title = sprintf( $title_template, _x('Oops! That page can&rsquo;t be found.', 'index title', 'woothemes') );

				} else {
					$title = sprintf( $title_template, _x('Blog', 'index title', 'woothemes')  );
				}
		

 echo $before_title;

	if ( 'right' == $title_align ) {
        
        if( $df_breadcrumbs ){
        	if( $is_home ) {
        	echo '<div class="breadcrumbs df-header" >';
				woo_breadcrumbs(); 			   
		    echo '</div>';
			}
		}
		echo apply_filters( 'df_page_title', $title, $title_template );
	} else {

		echo apply_filters( 'df_page_title', $title, $title_template );
		if( $df_breadcrumbs ){
			if( $is_home ) {
        	echo '<div class="breadcrumbs df-header" >';
				woo_breadcrumbs(); 			   
		    echo '</div>';
			}
		}
	}

 echo $after_title;

}

endif;
/**
 * Page & Post Fancy Header Title Contoller
 * @return void 
 */
if( ! function_exists('df_fancy_title_header_controller') ) :

function df_fancy_title_header_controller() {
  if ( is_404() || is_search() ) return false;
  	
  	$post_id = '';
  	if( is_singular() ){
		$post_id = get_the_ID();
	}	
 
	if(is_woocommerce_activated()) {
	    if ( is_shop() ) {

	     $post_id =  wc_get_page_id( 'shop' );

	    } else if ( is_cart() ) {

	     $post_id =  wc_get_page_id( 'cart' );
	    } else if ( is_checkout() ) {

	     $post_id =  wc_get_page_id( 'checkout' );
	   } 	
	}

  
  if ( 'fancy' != get_post_meta( $post_id, 'df_metabox_header_style', true ) ) {
		return;
  }

  add_filter( 'woocommerce_show_page_title', '__return_false');
  remove_action( 'dahztheme_title_controller', 'df_page_title_header_controller', 15 );

  $page_title_background_color 	= get_post_meta( $post_id, 'df_metabox_background_color', true );
  $page_title_background_image 	= wp_get_attachment_image_src(get_post_meta($post_id, 'df_metabox_upload_image_fancy_title', true), 'full'); 
  $page_title_video_bg 			= wp_get_attachment_url(get_post_meta($post_id, 'df_metabox_upload_video_fancy_title', true)); 
  $header_height_setting 		= esc_attr(get_post_meta( $post_id, 'df_metabox_header_height_setting', true ));
  $header_border 				= get_post_meta( $post_id, 'df_metabox_header_border', true );
  $header_border_color 			= get_post_meta( $post_id, 'df_metabox_header_border_color_setting', true );
  $page_header_style 			= get_post_meta( $post_id, 'df_metabox_header_style', true );
  $page_header_options_bg 		= get_post_meta( $post_id, 'df_metabox_background_options', true );
  $page_title_position 			= get_post_meta( $post_id, 'df_metabox_header_align', true );
  $fancy_title 					= esc_attr(get_post_meta( $post_id, 'df_metabox_title', true ));
  $fancy_subtitle 				= esc_attr(get_post_meta( $post_id, 'df_metabox_subtitle', true ));
  $page_title_color 			= esc_attr(get_post_meta( $post_id, 'df_metabox_title_color', true ));
  $page_subtitle_color 			= esc_attr(get_post_meta( $post_id, 'df_metabox_subtitle_color', true ));
  $fancy_parallax_speed 		= get_post_meta( $post_id, 'df_metabox_fancy_parallax_speed', true );


	// title and sub title
	$title = '';
	if (  $fancy_title ) {
		$title .= '<h1 class="fancy-title entry-title"';
		if ( $page_title_color ) $title .= ' style="color: ' . $page_title_color . '"';
		$title .= '>' . wp_kses_post( $fancy_title ) . '</h1>'; 
	} else {
		$title .= '<h1 class="fancy-title entry-title"';
		if ( $page_title_color ) $title .= ' style="color: ' . $page_title_color . '"';
		$title .= '>' . get_the_title() . '</h1>'; 
	}

	if ( $fancy_subtitle ) {
		$title .= '<h3 class="fancy-subtitle entry-title"';
		if (  $page_subtitle_color ) $title .= ' style="color: ' . $page_subtitle_color . '"';
		$title .= '>' . wp_kses_post( $fancy_subtitle ) . '</h3>'; 
	}

	if ( $title ) { $title = '<div class="df-header">' . $title . '</div>'; }
    
	// Enable Breadcrumbs
	$df_breadcrumbs = (  'true' == get_option('woo_breadcrumbs_show') );
	$is_home = ! is_home() && ! is_front_page();

	if($header_border == 1) {
	$container_classes = array('df-fancy-header');
	} else {
	$container_classes = array('df-fancy-header-2');	
	}

	// Title Classes
	switch ($page_title_position){
	case 'right' :
		$container_classes[] = 'title-right';
		 break;
	case 'center' :
		$container_classes[] = 'title-center';
		 break;
	default :
     	$container_classes[] = 'title-left';
    	break;
	}
    
    // Parallax Background
	$data_attr = array();
    if ( false == $fancy_parallax_speed ) {
		$fancy_parallax_speed = 0.1;
	}

	if($page_header_options_bg == "parallax" ){
	$container_classes[] = 'df-fancy-header-parallax';
	$data_attr[] = 'data-fancy-prlx-speed="' . $fancy_parallax_speed . '"';
	} elseif($page_header_options_bg == "horizontal-parallax") {
	$container_classes[] = 'df-fancy-header-parallax';
	$data_attr[] = 'data-fancy-horprlx-speed="' . $fancy_parallax_speed . '"';
	}
	
	 // Video Background
	if($page_header_options_bg == "video"){
	if ( $page_title_video_bg ) {
	
		$container_classes[] = 'df-fancy-header-video';

		$data_attr[] = 'data-fancy-video-url="' . $page_title_video_bg . '"';
		}
	}

	// Normal Background
    $container_style = array();
    	if ( $page_title_background_color ) {
		$container_style[] = 'background-color: ' . $page_title_background_color;
	}

	if ( $page_title_background_image ) {

			$container_style[] = "background-image: url({$page_title_background_image[0]})";

			$repeat = get_post_meta( get_the_id(), 'df_metabox_repeat_options', true );
			$position_x = get_post_meta( get_the_id(), 'df_metabox_repeat_x', true );
			$position_y = get_post_meta( get_the_id(), 'df_metabox_repeat_y', true );

			$container_style[] = "background-repeat: {$repeat}";
			$container_style[] = "background-position: {$position_x} {$position_y}";
		
	}
	$header_container_height = $header_height_setting ? 'style="height: ' . $header_height_setting . 'px;"' : '';
	$container_style[] = $header_height_setting ? 'min-height: ' . $header_height_setting . 'px' : '';
	$container_style[] = $header_border_color ? 'border-color:'. $header_border_color : '';

   // Output Content
	$before_title = $after_title = '';
	$before_title .= 
	'<div id="df-fancy-header" class="' . esc_attr( implode( ' ', $container_classes ) ) .'" '.implode( ' ', $data_attr ).' style="'.esc_attr( implode( '; ', $container_style ) ).'">'."\n".
	'<div class="col-full df-header-wrap">'."\n".
	'<div class="df-header-container"' .$header_container_height. '>';
	$after_title .= '</div>'."\n".'</div>'."\n".'</div>';


	echo $before_title;
	if ( 'right' == $page_title_position ) {    
        if( $df_breadcrumbs ){
        	if( $is_home ) {
        	echo '<div class="breadcrumbs df-header" >';
				woo_breadcrumbs(); 			   
		    echo '</div>';
			}
		}
		echo $title;
   } else {
   		echo $title;
   	    if( $df_breadcrumbs ){
        	if( $is_home ) {
        	echo '<div class="breadcrumbs df-header" >';
				woo_breadcrumbs(); 			   
		    echo '</div>';
			}
		}
   }
   echo $after_title;
	
}

endif;
/**
 * Page & Post Slider Header Title Contoller
 * @return void
 */

if( ! function_exists('df_slider_title_header_controller') ) :

 function df_slider_title_header_controller() {
    if ( is_404() || is_search() || is_archive() ) return false;

    $post_id = '';
    if( is_singular() ){
	$post_id = get_the_ID();
    }
 
	if(is_woocommerce_activated()) {
	    if ( is_shop() ) {

	     $post_id =  wc_get_page_id( 'shop' );

	    } else if ( is_cart() ) {

	     $post_id =  wc_get_page_id( 'cart' );
	    } else if ( is_checkout() ) {

	     $post_id =  wc_get_page_id( 'checkout' );
	   } 	
	}	
    
	if ( 'slider' != get_post_meta( $post_id, 'df_metabox_header_style', true ) )
		return;	
     
     add_filter( 'woocommerce_show_page_title', '__return_false');
	 remove_action( 'dahztheme_title_controller',  'df_page_title_header_controller', 15 );

		switch ( get_post_meta( $post_id, 'df_metabox_slider_options', true) ) {
	 		case 'rev':
			$rev_slider = get_post_meta( $post_id, 'df_metabox_revolution_slider', true);

			if ( $rev_slider && function_exists('putRevSlider') ) {

				echo '<div id="df-slider-header">';
				putRevSlider( $rev_slider );
				echo '</div>';
			}
			break;

			case 'royal':
			$royal_slider = esc_attr(get_post_meta( $post_id, 'df_metabox_royal_slider', true));

			if ( $royal_slider != '' ) {

				echo '<div id="df-slider-header">';
				echo do_shortcode( $royal_slider );
				echo '</div>';
			}

	} // switch
	
}

endif;
//} // end Class DF_Title_Controller 

/**
 * $df_title_controller 
 * @var DF_Title_Controller
 */
//new DF_Title_Controller();

/**
 * Output title controller to front-end
 * @return void 
 */
function dahztheme_title_controller(){
	 do_action( 'dahztheme_title_controller' );
} 
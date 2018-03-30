<?php
/**
 * Created by Clapat
 * Date: 29/05/14
 * Time: 6:29 AM
 */

// wp_head hook
if ( ! function_exists( 'clapat_bg_wp_head_hook' ) ){

    function clapat_bg_wp_head_hook(){

		global $clapat_bg_theme_options;
		
		// menu background color
		require_once ( get_template_directory() . '/include/util_functions.php');
		$overlay_rgba = hex2rgba( $clapat_bg_theme_options['clapat_bg_menu_bknd_color'], 
								  $clapat_bg_theme_options['clapat_bg_menu_bknd_color_opacity'] );
		
		// some of the css attributes which could not be linked directly though theme options
		echo '<style type="text/css">';
		echo '.clapat-menubg-overlay { background-color: ' . $overlay_rgba . ';}';
		echo '#footer-content { background: none repeat scroll 0 0 ' . $clapat_bg_theme_options['clapat_bg_styling_footer_color'] . ';}';
		if( !$clapat_bg_theme_options['clapat_bg_slider_arrow_cursor'] ){
		echo '.clapat-slider .flex-direction-nav .flex-prev, .clapat-slider-project .flex-direction-nav .flex-prev{ cursor: auto; }';
		echo '.clapat-slider .flex-direction-nav .flex-next, .clapat-slider-project .flex-direction-nav .flex-next{ cursor: auto; }';
		}
		echo '.clapat-menubtn:hover .btn_menu_line, input[type="submit"], .accordion dt.accordion-active, .toggle-active, ul.tabs .tab-active a, .wpb_content_element .wpb_tabs_nav li.ui-tabs-active, .wpb_content_element .wpb_tabs_nav li:hover, .progress-bar li:hover span, .radial-counter input, .woocommerce .widget_shopping_cart_content .buttons a, .selectric .button:hover, .selectricItems li:hover, .price_slider_amount .ui-state-default:hover, .woocommerce span.onsale, .woocommerce ul.products li.product .button, .woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button, .plus:hover, .minus:hover, a.cart-remove:hover { background-color:' . $clapat_bg_theme_options['clapat_bg_theme_color'] . '!important; }';
		echo '.clapat-button { background-color:' . $clapat_bg_theme_options['clapat_bg_theme_color'] . '; }';
		echo '.play-icon:hover { border:' . $clapat_bg_theme_options['clapat_bg_theme_color'] . ' 10px solid; }';
		echo '.clapat-button.outline-button:hover, .clapat-button.outline-button:active, .clapat-button.outline-button:focus { border:' . $clapat_bg_theme_options['clapat_bg_theme_color'] . ' 3px solid; }';
		echo 'ul.text-socials li a:hover { border-bottom: 2px solid ' . $clapat_bg_theme_options['clapat_bg_theme_color'] . '; }';
		echo '</style>';
		
		if( isset( $clapat_bg_theme_options['clapat_bg_styling_custom_css'] ) ){

            if( trim($clapat_bg_theme_options['clapat_bg_styling_custom_css']) ){

                echo '<style type="text/css">';
                echo trim($clapat_bg_theme_options['clapat_bg_styling_custom_css']);
                echo '</style>';
            }
        }
		
		if( !empty( $clapat_bg_theme_options['clapat_bg_space_head'] ) ){
            echo $clapat_bg_theme_options['clapat_bg_space_head'];
        }
    }

}
add_action('wp_head', 'clapat_bg_wp_head_hook');

if ( ! function_exists( 'clapat_bg_add_opengraph' ) ){

    function clapat_bg_add_opengraph() {

        global $post; // Ensures we can use post variables outside the loop

        // Start with some values that don't change.
        echo "<meta property='og:site_name' content='". get_bloginfo('name') ."'/>"; // Sets the site name to the one in your WordPress settings
        echo "<meta property='og:url' content='" . get_permalink() . "'/>"; // Gets the permalink to the post/page

        if (is_singular('post')) { // If we are on a blog post/page
            echo "<meta property='og:title' content='" . get_the_title() . "'/>"; // Gets the page title
            echo "<meta property='og:type' content='article'/>"; // Sets the content type to be article.
        } elseif(is_front_page() or is_home()) { // If it is the front page or home page
            echo "<meta property='og:title' content='" . get_bloginfo("name") . "'/>"; // Get the site title
            echo "<meta property='og:type' content='website'/>"; // Sets the content type to be website.
        }

        if($post && has_post_thumbnail( $post->ID )) { // If the post has a featured image.
            $thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'medium' );
            echo "<meta property='og:image' content='" . esc_attr( $thumbnail[0] ) . "'/>"; // If it has a featured image, then display this for Facebook
        }

    }

    global $clapat_bg_theme_options;
    if( isset( $clapat_bg_theme_options['clapat_bg_blog_post_secondary_menu'] ) && $clapat_bg_theme_options['clapat_bg_blog_post_secondary_menu'] ){
    	
    	add_action( 'wp_head', 'clapat_bg_add_opengraph', 5 );
    }

}

// site/blog title
if ( ! function_exists( '_wp_render_title_tag' ) ) {

	function clapat_bg_wp_title() {

		echo '<title>';
		wp_title( '|', true, 'right' );
		echo '</title>';

	}
	add_action( 'wp_head', 'clapat_bg_wp_title' );
}

//navigation item classes
if ( ! function_exists( 'clapat_bg_menu_classes' ) ){

    function clapat_bg_menu_classes(  $classes , $item ){

    	if( in_array('menu-item-has-children', $classes) )
		{
			$classes[] = 'dropdown';
		}
		if( empty( $item->menu_item_parent ) ){
			
			$classes[] = 'clapat-menu-item';
		}
		
		return $classes;
    }

}
if ( ! function_exists( 'clapat_bg_menu_link_attributes' ) ){

    function clapat_bg_menu_link_attributes(  $atts, $item, $args ){

		$arr_classes = array();
		if( in_array('menu-item-has-children', $item->classes) )
		{
			$arr_classes[] = 'no-action';
		}
		else if( $item->object == 'page' ){
		
			$ajax_link = true;
			
			$opt_ajax_load = redux_post_meta( THEME_OPTIONS, $item->object_id, 'cpbg-opt-page-ajax-load' );
			if( !$opt_ajax_load ){
				
				$ajax_link = false;
			}			
			else if( function_exists('wc_get_page_id') ){

				if( ($item->object_id == wc_get_page_id('shop')) ||
					($item->object_id == wc_get_page_id('myaccount')) ||
					($item->object_id == wc_get_page_id('cart')) ||
					($item->object_id == wc_get_page_id('checkout')) ||
					($item->object_id == wc_get_page_id('view_order')) ||
					($item->object_id == wc_get_page_id('terms'))	
				){
					
					// disable by default ajax page loading for woocommerce pages
					$ajax_link = false;
				}
			}
			
			if( $ajax_link )
				$arr_classes[] = 'ajax-link';
		}
		if( in_array( 'current-menu-item', $item->classes ) || in_array( 'current-menu-ancestor', $item->classes ) ){
		
			$arr_classes[] = 'is-active';
		}
		if( !empty( $arr_classes ) ){
		
			$atts['class'] = implode( ' ', $arr_classes );
		}
		
		return $atts;
    }

}
// change priority here if there are more important actions associated with the hook
add_action('nav_menu_css_class', 'clapat_bg_menu_classes', 10, 2);
add_filter('nav_menu_link_attributes', 'clapat_bg_menu_link_attributes', 10, 3 );

// hooks to add extra classes for next & prev portfolio projects 
if ( ! function_exists( 'clapat_bg_prev_post_link' ) ){

    function clapat_bg_prev_post_link( $output, $format, $link, $post ){
	
		if( $post && ( $format == 'berger_portfolio' ) ){

			$title = $post->post_title;
			$title = apply_filters( 'the_title', $title, $post->ID );
			
			$output =  '<a class="prev-project" href="' . get_permalink( $post ) . '">';
			$output .= '<div class="buton-nav-content">';
			$output .= '<span class="name-prev-project">' . $title . '</span>';
			$output .= '<span class="text-prev-project">' . __('Prev Project', THEME_LANGUAGE_DOMAIN) . '</span>';
			$output .= '</div>';
			$output .= '</a>';
		}
		
		return $output;
    }

}
if ( ! function_exists( 'clapat_bg_next_post_link' ) ){

    function clapat_bg_next_post_link( $output, $format, $link, $post ){

		if( $post && ( $format == 'berger_portfolio' ) ){
		
			$title = $post->post_title;
			$title = apply_filters( 'the_title', $title, $post->ID );
			
			$output =  '<a class="next-project" href="' . get_permalink( $post ) . '">';
			$output .= '<div class="buton-nav-content">';
			$output .= '<span class="name-next-project">' . $title . '</span>';
			$output .= '<span class="text-next-project">' . __('Next Project', THEME_LANGUAGE_DOMAIN) . '</span>';
			$output .= '</div>';
			$output .= '</a>';
		}
		
		return $output;
    }

}
// change priority here if there are more important actions associated with the hook
add_filter('next_post_link', 'clapat_bg_next_post_link', 10, 4);
add_filter('previous_post_link', 'clapat_bg_prev_post_link', 10, 4);


// hooks to add extra classes for next & prev portfolio projects 
/*if ( ! function_exists( 'clapat_bg_next_posts_attributes' ) ){

	function clapat_bg_next_posts_attributes(){

		return 'class="ajax-link"';
    } 

}

if ( ! function_exists( 'clapat_bg_prev_posts_attributes' ) ){

    function clapat_bg_prev_posts_attributes(){

		return 'class="ajax-link"';
    }

}
// change priority here if there are more important actions associated with the hook
add_filter('next_posts_link_attributes', 'clapat_bg_next_posts_attributes');
add_filter('previous_posts_link_attributes', 'clapat_bg_prev_posts_attributes');*/


// search filter
if( !function_exists('clapat_bg_searchfilter') ){

    function clapat_bg_searchfilter( $query ) {

    	if ( !is_admin() && $query->is_main_query() ) {
        	
    		if ($query->is_search ) {

    			$post_types = get_query_var('post_type');
    			
    			if( empty( $post_types ) ){
    			
            		$query->set('post_type', array('post'));
    			}
        	}

        }
        
        return $query;

    }
    add_filter('pre_get_posts','clapat_bg_searchfilter');

}
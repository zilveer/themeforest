<?php  if ( ! defined('ET_FW')) exit('No direct script access allowed');

define('BSF_6892199_NOTICES', false);

// **********************************************************************// 
// ! Add classes to body
// **********************************************************************//
add_filter('body_class','et_add_body_classes');
if(!function_exists('et_add_body_classes')) {
    function et_add_body_classes($classes) {
		$l = et_page_config();
        if(etheme_get_option('fixed_nav')) $classes[] = 'fixNav-enabled ';
        if(etheme_get_option('promo_auto_open')) $classes[] = 'open-popup ';
        $classes[] = 'breadcrumbs-type-'.$l['breadcrumb']; 
        $classes[] = etheme_get_option('main_layout');
        $classes[] = (etheme_get_option('cart_widget')) ? 'cart-widget-on' : 'cart-widget-off';

		$ht = ''; 

		$ht = apply_filters('custom_header_filter',$ht);  

		if(in_array($ht, array(7, 8, 10))){
			$classes[] = "header-vertical-enabled";
		}

        return $classes;
    }
}

if(!function_exists('et_bordered_layout')) {
	function et_bordered_layout() {

		if(etheme_get_option('main_layout') != 'bordered') return;

		?>
			<div class="body-border-left"></div>
			<div class="body-border-top"></div>
			<div class="body-border-right"></div>
			<div class="body-border-bottom"></div> 
		<?php
	}
	add_action('et_after_body', 'et_bordered_layout');
}

// **********************************************************************// 
// ! Page heading
// **********************************************************************// 
if(!function_exists('et_page_heading')) {

	add_action('et_page_heading', 'et_page_heading', 10);

	function et_page_heading() {

		$l = et_page_config();

		if ($l['heading'] !== 'disable' && !$l['slider']): ?>
			
			<div class="page-heading bc-type-<?php esc_attr_e( $l['breadcrumb'] ); ?>">
				<div class="container">
					<div class="row">
						<div class="col-md-12 a-center">
							<?php etheme_breadcrumbs(); ?>
							<h1 class="title"><span><?php echo et_get_the_title(); ?></span></h1>
						</div>
					</div>
				</div>
			</div>

		<?php endif;

		if($l['slider']): ?>
			<div class="page-heading-slider">
				<?php  echo do_shortcode('[rev_slider_vc alias="'.$l['slider'].'"]'); ?>
			</div>
		<?php endif; 
	}
}

if(!function_exists('et_get_the_title')) {
	function et_get_the_title() {

		$post_page = get_option( 'page_for_posts' );


		if(is_home()) {
			return get_the_title( $post_page );
		}

        // Homepage and Single Page
        if ( is_home() || is_single() || is_404() ) {
            return get_the_title();
        }

        // Search Page
        if ( is_search() ) {
            return sprintf( __( 'Search Results for: %s', ET_DOMAIN ), get_search_query() );
        }

        // Archive Pages
        if ( is_archive() ) {
            if ( is_author() ) {
                return sprintf( __( 'All posts by %s', ET_DOMAIN ), get_the_author() );
            }
            elseif ( is_day() ) {
                return sprintf( __( 'Daily Archives: %s', ET_DOMAIN ), get_the_date() );
            }
            elseif ( is_month() ) {
                return sprintf( __( 'Monthly Archives: %s', ET_DOMAIN), get_the_date( _x( 'F Y', 'monthly archives date format', ET_DOMAIN ) ) );
            }
            elseif ( is_year() ) {
                return sprintf( __( 'Yearly Archives: %s', ET_DOMAIN ), get_the_date( _x( 'Y', 'yearly archives date format', ET_DOMAIN ) ) );
            }
            elseif ( is_tag() ) {
                return sprintf( __( 'Tag Archives: %s', ET_DOMAIN ), single_tag_title( '', false ) );
            }
            elseif ( is_category() ) {
                return sprintf( __( 'Category Archives: %s', ET_DOMAIN ), single_cat_title( '', false ) );
            }
            elseif ( is_tax( 'post_format', 'post-format-aside' ) ) {
                return __( 'Asides', ET_DOMAIN );
            }
            elseif ( is_tax( 'post_format', 'post-format-video' ) ) {
                return __( 'Videos', ET_DOMAIN );
            }
            elseif ( is_tax( 'post_format', 'post-format-audio' ) ) {
                return __( 'Audio', ET_DOMAIN );
            }
            elseif ( is_tax( 'post_format', 'post-format-quote' ) ) {
                return __( 'Quotes', ET_DOMAIN );
            }
            elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) {
                return __( 'Galleries', ET_DOMAIN );
            }
            else {
                return __( 'Archives', ET_DOMAIN );
            }
        }

        return get_the_title();
	}
}

// **********************************************************************// 
// ! Get logo
// **********************************************************************// 
if (!function_exists('etheme_logo')) {
    function etheme_logo($fixed_header = false) {
    	$logoimg = array('url' => '');

    	$logo_fixed = etheme_get_option('logo_fixed');

    	if(!is_array($logo_fixed)) {
    		$logo_fixed = array('url' => $logo_fixed);
    	}


    	$logoimg = etheme_get_option('logo');


    	if(empty($logo_fixed['url'])) {
    		$logo_fixed = $logoimg;
    	}

    	$custom_logo = etheme_get_custom_field('custom_logo', et_get_page_id() );

    	if($custom_logo != '') {
    		$logoimg['url'] = $custom_logo;
    	}

    	$logo_src = (!empty($logoimg['url'])) ? $logoimg['url'] : ET_BASE_URI.'images/logo.png';
    	$logo_fixed_src = (!empty($logo_fixed['url'])) ? $logo_fixed['url'] : ET_BASE_URI.'images/logo-fixed.png';

    	$logo_imagesize = @getimagesize($logo_src);
    	$logo_fixed_imagesize = @getimagesize($logo_fixed_src);

    	?>
            <a href="<?php echo home_url(); ?>">
            	<img src="<?php echo $logo_src; ?>" alt="<?php bloginfo( 'description' ); ?>" <?php echo $logo_imagesize[3]; ?> class="logo-default" />
            	<img src="<?php echo $logo_fixed_src; ?>" alt="<?php bloginfo( 'description' ); ?>" <?php echo $logo_fixed_imagesize[3]; ?> class="logo-fixed" />
            </a>
        <?php
        do_action('etheme_after_logo');
    }
}

// **********************************************************************// 
// ! Get top links
// **********************************************************************// 
if(!function_exists('etheme_top_links')) {
    function etheme_top_links($args = array()) {
	extract(shortcode_atts(array(
		'popups'  => true
	), $args));
        ?>
            <ul class="links">

                <?php if(etheme_get_option('promo_popup')): ?>
                    <li class="popup_link <?php if(!etheme_get_option('promo_link')): ?>hidden<?php endif; ?>"><a class="etheme-popup <?php echo (etheme_get_option('promo_auto_open')) ? 'open-click': '' ; ?>" href="#etheme-popup"><?php _e(etheme_get_option('promo-link-text'), ET_DOMAIN) ?></a></li>
                <?php endif; ?>

                <?php if(etheme_get_option('top_links')): ?>
	                <?php if ( is_user_logged_in() ) : ?>
	                    <?php if(class_exists('Woocommerce')): ?> 
	                    	<li class="my-account-link"><a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>"><?php _e( 'My Account', ET_DOMAIN ); ?></a></li>
	                    <?php endif; ?>
	                    <li class="logout-link"><a href="<?php echo wp_logout_url(home_url()); ?>"><?php _e( 'Logout', ET_DOMAIN ); ?></a></li>
	                <?php else : ?>
	                    <?php 
	                        $reg_id = etheme_tpl2id('et-registration.php'); 
	                        $reg_url = get_permalink($reg_id);
	                    ?>    
	                    <?php if(class_exists('Woocommerce')): ?>
	                    	<li class="login-link">
	                    		<a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>"><?php _e( 'Sign In', ET_DOMAIN ); ?></a>
	                    		<?php if($popups) : ?>
									<div class="login-popup">
										<div class="popup-title">
											<span><?php _e( 'Login Form', ET_DOMAIN ); ?></span>
										</div>
										<?php wp_login_form( array() ); ?> 
									</div>
								<?php endif; ?>
	                		</li>
	                	<?php endif; ?>
	                    <?php if(!empty($reg_id)): ?>
	                    	<li class="register-link">
	                    		<a href="<?php echo $reg_url; ?>"><?php _e( 'Register', ET_DOMAIN ); ?></a>
	                    		<?php if($popups) : ?>
									<div class="register-popup">
										<div class="popup-title">
											<span><?php _e( 'Register Form', ET_DOMAIN ); ?></span>
										</div>
										<?php et_register_form(); ?>
									</div>
								<?php endif; ?>
	                    	</li>
	                	<?php endif; ?>
	                <?php endif; ?>
                <?php endif; ?>
			</ul>
        <?php
    }
}

// **********************************************************************// 
// ! Meta data block (byline)
// **********************************************************************//
if(!function_exists('et_byline')) {
	function et_byline() {
		?>
	        <?php if(etheme_get_option('blog_byline') && etheme_get_option('blog_layout') != 'timeline'): ?>
	            <div class="meta-post">
                    <?php the_time(get_option('date_format')); ?>
                    /
                    <?php _e('by', ET_DOMAIN);?> <?php the_author_posts_link(); ?>
                    <?php // Display Comments 

                            if(comments_open() && !post_password_required()) {
                                    echo ' / ';
                                    comments_popup_link('0', '1 Comment', '% Comments', 'post-comments-count');
                            }

                     ?>
	            </div>
	        <?php elseif(etheme_get_option('blog_byline') && etheme_get_option('blog_layout') == 'timeline'): ?>
	            <div class="meta-post">
                    <?php _e('Posted by', ET_DOMAIN);?> <?php the_author_posts_link(); ?>
                    <?php // Display Comments 

                            if(comments_open() && !post_password_required()) {
                                    echo ' / ';
                                    comments_popup_link('0', __('1 Comment', ET_DOMAIN), __('% Comments', ET_DOMAIN), 'post-comments-count');
                            }

                     ?>
	            </div>
	        <?php endif; ?>
        <?php
	}
}


// **********************************************************************// 
// ! Remove query string from static files
// **********************************************************************//
if(!function_exists('et_remove_cssjs_ver')) {
	
	add_filter( 'style_loader_src', 'et_remove_cssjs_ver', 10, 2 );
	add_filter( 'script_loader_src', 'et_remove_cssjs_ver', 10, 2 );
	
	function et_remove_cssjs_ver( $src ) {
		if( strpos( $src, '?ver=' ) )
			$src = remove_query_arg( 'ver', $src );
		return $src;
	}
}


// **********************************************************************// 
// ! Custom Comment Form
// **********************************************************************// 

if(!function_exists('etheme_custom_comment_form')) {
    function etheme_custom_comment_form($defaults) {
        $defaults['comment_notes_before'] = '';
        $defaults['comment_notes_after'] = '';
        $dafaults['id_form'] = 'comments_form';

        $defaults['comment_field'] = '<div class="form-group"><label for="comment" class="control-label">'.__('Comment', ET_DOMAIN).'</label><textarea class="form-control required-field"  id="comment" name="comment" cols="45" rows="12" aria-required="true"></textarea></div>';

        return $defaults;
    }
}

add_filter('comment_form_defaults', 'etheme_custom_comment_form');

if(!function_exists('etheme_custom_comment_form_fields')) {
    function etheme_custom_comment_form_fields() {
        $commenter = wp_get_current_commenter();
        $req = get_option('require_name_email');
        $reqT = '<span class="required">*</span>';
        $aria_req = ($req ? " aria-required='true'" : ' ');

        $fields = array(
            'author' => '<div class="form-group comment-form-author">'.
                            '<label for="author" class="control-label">'.__('Name', ET_DOMAIN).' '.($req ? $reqT : '').'</label>'.
                            '<input id="author" name="author" type="text" class="form-control ' . ($req ? ' required-field' : '') . '" value="' . esc_attr($commenter['comment_author']) . '" size="30" ' . $aria_req . '>'.
                        '</div>',
            'email' => '<div class="form-group comment-form-email">'.
                            '<label for="email" class="control-label">'.__('Email', ET_DOMAIN).' '.($req ? $reqT : '').'</label>'.
                            '<input id="email" name="email" type="text" class="form-control ' . ($req ? ' required-field' : '') . '" value="' . esc_attr($commenter['comment_author_email']) . '" size="30" ' . $aria_req . '>'.
                        '</div>',
            'url' => '<div class="form-group comment-form-url">'.
                            '<label for="url" class="control-label">'.__('Website', ET_DOMAIN).'</label>'.
                            '<input id="url" name="url" type="text" class="form-control" value="' . esc_attr($commenter['comment_author_url']) . '" size="30">'.
                        '</div>'
        );

        return $fields;
    }
}

add_filter('comment_form_default_fields', 'etheme_custom_comment_form_fields');

// **********************************************************************// 
// ! Set exerpt 
// **********************************************************************//
if(!function_exists('etheme_excerpt_length')) {
	function etheme_excerpt_length( $length ) {
	    return 15;
	}
}

add_filter( 'excerpt_length', 'etheme_excerpt_length', 999 );

if(!function_exists('etheme_excerpt_more')) {
	function etheme_excerpt_more( $more ) {
	    return '...';
	}
}

add_filter('excerpt_more', 'etheme_excerpt_more');


// **********************************************************************// 
// ! Enable shortcodes in text widgets
// **********************************************************************// 
add_filter('widget_text', 'do_shortcode');

// **********************************************************************// 
// ! Custom meta fields to categories
// **********************************************************************// 
if(function_exists('et_get_term_meta')){

	function etheme_taxonomy_edit_meta_field($term, $taxonomy) {
	    $id = $term->term_id;
	    $term_meta = et_get_term_meta($id,'cat_meta');
	
	    if(!$term_meta){$term_meta = et_add_term_meta($id, 'cat_meta', '');}
	     ?>
	    <tr class="form-field">
	    <th scope="row" valign="top"><label for="term_meta[cat_header]"><?php _e( 'Category Header', ET_DOMAIN ); ?></label></th>
	        <td>                
	            <?php 
	
	                $content = esc_attr( $term_meta[0]['cat_header'] ) ? esc_attr( $term_meta[0]['cat_header'] ) : ''; 
	                wp_editor($content,'term_meta[cat_header]');
	
	            ?>
	        </td>
	    </tr>
	<?php
	}
	
	add_action( 'product_cat_edit_form_fields', 'etheme_taxonomy_edit_meta_field', 20, 2 );
	
	// **********************************************************************// 
	// ! Save meta fields
	// **********************************************************************// 
	function save_taxonomy_custom_meta( $term_id ) {
	    if ( isset( $_POST['term_meta'] ) ) {
	        $term_meta = et_get_term_meta($term_id,'cat_meta');
	        $cat_keys = array_keys( $_POST['term_meta'] );
	        foreach ( $cat_keys as $key ) {
	            if ( isset ( $_POST['term_meta'][$key] ) ) {
	                $term_meta[$key] = $_POST['term_meta'][$key];
	            }
	        }
	        // Save the option array.
	        et_update_term_meta($term_id, 'cat_meta', $term_meta);
	
	    }
	}  
	add_action( 'edited_product_cat', 'save_taxonomy_custom_meta', 10, 2 );  
}


if(!function_exists('et_get_transient')) {
	function et_get_transient($slug) {
		return false;
		return get_transient($slug);
	}
}
if(!function_exists('et_set_transient')) {
	function et_set_transient($slug, $output, $time = 86400) {
		return false;
		return set_transient($slug, $output, $time);
	}
}


// **********************************************************************// 
// ! Show main navigation
// **********************************************************************// 

if(!function_exists('et_get_main_menu')) {
	function et_get_main_menu($menu_id = 'main-menu') {
		$custom_menu = etheme_get_custom_field('custom_nav');
        $one_page_menu = '';
        if(etheme_get_custom_field('one_page')) $one_page_menu = ' one-page-menu';
        if(!empty($custom_menu) && $custom_menu != '') {
            $output = false;
            $output = wp_cache_get( $custom_menu, 'et_get_main_menu' );
            if ( !$output ) {
                ob_start(); 
                
                wp_nav_menu(array(
                    'menu' => $custom_menu,
                    'before' => '',
                    'container_class' => 'menu-main-container'.$one_page_menu,
                    'after' => '',
                    'link_before' => '',
                    'link_after' => '',
                    'depth' => 4,
                    'fallback_cb' => false,
                    'walker' => new Et_Navigation
                ));
                
                $output = ob_get_contents();
                ob_end_clean();
                
                wp_cache_add( $custom_menu, $output, 'et_get_main_menu' );
            }
            
            echo $output;
            return;
        }
		if ( has_nav_menu( $menu_id ) ) {
	    	$output = false;
	    	$output = wp_cache_get( $menu_id, 'et_get_main_menu' );
		    if ( !$output ) {
			    ob_start(); 
			    
		    	wp_nav_menu(array(
					'theme_location' => $menu_id,
					'before' => '',
					'container_class' => 'menu-main-container',
					'after' => '',
					'link_before' => '',
					'link_after' => '',
					'depth' => 4,
					'fallback_cb' => false,
					'walker' => new Et_Navigation
				));
				
				$output = ob_get_contents();
				ob_end_clean();
				
		        wp_cache_add( $menu_id, $output, 'et_get_main_menu' );
		    }
		    
	        echo $output;
		} else {
			?>
				<br>
				<h4 class="a-center">Set your main menu in <em>Appearance &gt; Menus</em></h4>
			<?php
		}
	}
}
if(!function_exists('et_get_mobile_menu')) {
	function et_get_mobile_menu($menu_id = 'mobile-menu') {

        $custom_menu = etheme_get_custom_field('custom_nav');
        $one_page_menu = '';
        if(etheme_get_custom_field('one_page')) $one_page_menu = ' one-page-menu';

        if(!empty($custom_menu) && $custom_menu != '') {
            $output = false;
            $output = wp_cache_get( $custom_menu, 'et_get_mobile_menu' );
            if ( !$output ) {
                ob_start(); 
                
                wp_nav_menu(array(
                    'menu' => $custom_menu,
                    'before' => '',
                    'container_class' => 'menu-mobile-container'.$one_page_menu,
                    'after' => '',
                    'link_before' => '',
                    'link_after' => '',
                    'depth' => 4,
                    'fallback_cb' => false,
                    'walker' => new Et_Navigation_Mobile
                ));
                
                $output = ob_get_contents();
                ob_end_clean();
                
                wp_cache_add( $custom_menu, $output, 'et_get_mobile_menu' );
            }
            
            echo $output;
            return;
        }

		if ( has_nav_menu( $menu_id ) ) {
	    	$output = false;
	    	$output = wp_cache_get( $menu_id, 'et_get_mobile_menu' );
            
		    if ( !$output ) {
			    ob_start(); 
			    
				wp_nav_menu(array(
                    'container_class' => $one_page_menu,
					'theme_location' => 'mobile-menu',
                    'walker' => new Et_Navigation_Mobile
				)); 
				
				$output = ob_get_contents();
				ob_end_clean();
				
		        wp_cache_add( $menu_id, $output, 'et_get_mobile_menu' );
		    }
		    
	        echo $output;
		} else {
			?>
				<br>
				<h4 class="a-center">Set your main menu in <em>Appearance &gt; Menus</em></h4>
			<?php
		}
	}
}


// **********************************************************************// 
// ! Get favicon
// **********************************************************************// 
if(!function_exists('et_get_favicon')) {
	function et_get_favicon() {
		$icon = array();
		$icon = etheme_get_option('favicon');
		if(empty($icon['url'])) {
			$icon['url'] = get_template_directory_uri().'/images/favicon.ico';	
		}
		return $icon['url'];
	}
}

// **********************************************************************// 
// ! Show Search form 
// **********************************************************************// 
if(!function_exists('etheme_search_form')) {
    function etheme_search_form() {
    	$search_view = etheme_get_option('search_view');
    	$header = get_header_type();
    	if( etheme_get_header_structure( $header ) == 4 || $header == 17 ) {
    		$search_view = 'modal';
    	}

        ?>
            <div class="header-search">
                <?php if($search_view == 'dropdown'): ?>
                    <div class="et-search-trigger search-with-form">
                        <a class="popup-with-form"><i class="fa fa-search"></i> <span><?php _e('Search', ET_DOMAIN); ?></span></a>
                        <?php 
                            if(!class_exists('WooCommerce')) {
                                get_search_form();
                            } else {
                                get_template_part('woosearchform'); 
                            }   
                        ?>
                    </div>
                <?php else : ?>
                    <div class="et-search-trigger search-dropdown">
                    	<a class="popup-with-form" href="#searchModal"><i class="fa fa-search"></i></a>
                        <?php 
                            if(!class_exists('WooCommerce')) {
                                get_search_form();
                            } else {
                                get_template_part('woosearchform'); 
                            }   
                        ?>
                    </div>
                <?php endif; ?>
            </div>
        <?php 
    }
}

// **********************************************************************// 
// ! Search form popup
// **********************************************************************//  

add_action('after_page_wrapper', 'etheme_search_form_modal');
if(!function_exists('etheme_search_form_modal')) {
	function etheme_search_form_modal() {
		?>
			<div id="searchModal" class="mfp-hide modal-type-1 zoom-anim-dialog" role="search">
				<div class="modal-dialog text-center">
					<h3><?php _e('Search engine', ET_DOMAIN); ?></h3>
					<small class="mini-text"><?php _e('Use this form to find things you need', ET_DOMAIN); ?></small>
				
					<?php 
						if(!class_exists('WooCommerce')) {
							get_search_form();
						} else {
							get_template_part('woosearchform'); 
						}	
					?>
					
				</div>
			</div>
		<?php
	}
}

// **********************************************************************// 
// ! Add Facebook Open Graph Meta Data
// **********************************************************************// 

//Adding the Open Graph in the Language Attributes
if(!function_exists('et_add_opengraph_doctype')) {
	function et_add_opengraph_doctype( $output ) {
		return $output . ' xmlns:og="http://opengraphprotocol.org/schema/" xmlns:fb="http://www.facebook.com/2008/fbml"';
	}
}
add_filter('language_attributes', 'et_add_opengraph_doctype');

//Lets add Open Graph Meta Info

if(!function_exists('et_insert_fb_in_head')) {
	function et_insert_fb_in_head() {
		global $post;
		if ( !is_singular()) //if it is not a post or a page
			return;
			
			$description = et_excerpt( $post->post_content, $post->post_excerpt );
			$description = strip_tags($description);
			$description = str_replace("\"", "'", $description);
			
	        echo '<meta property="og:title" content="' . get_the_title() . '"/>';
	        echo '<meta property="og:type" content="article"/>';
	        echo '<meta property="og:description" content="' . $description . '"/>';
	        echo '<meta property="og:url" content="' . get_permalink() . '"/>';
	        echo '<meta property="og:site_name" content="'. get_bloginfo('name') .'"/>';
	        
			if(!has_post_thumbnail( $post->ID )) { 
				$default_image = get_site_url().'/wp-content/uploads/facebook-default.jpg'; 
				echo '<meta property="og:image" content="' . $default_image . '"/>';
			} else {
				$thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large' );
				echo '<meta property="og:image" content="' . esc_attr( $thumbnail_src[0] ) . '"/>';
			}
			echo "";
	}
}
add_action( 'wp_head', 'et_insert_fb_in_head', 5 );

if(!function_exists('et_excerpt')) {
	function et_excerpt($text, $excerpt){
	    if ($excerpt) return $excerpt;
	
	    $text = strip_shortcodes( $text );
	
	    $text = apply_filters('the_content', $text);
	    $text = str_replace(']]>', ']]&gt;', $text);
	    $text = strip_tags($text);
	    $excerpt_length = apply_filters('excerpt_length', 55);
	    $excerpt_more = apply_filters('excerpt_more', ' ' . '[...]');
	    $words = preg_split("/[\n
		 ]+/", $text, $excerpt_length + 1, PREG_SPLIT_NO_EMPTY);
	    if ( count($words) > $excerpt_length ) {
	            array_pop($words);
	            $text = implode(' ', $words);
	            $text = $text . $excerpt_more;
	    } else {
	            $text = implode(' ', $words);
	    }
	
	    return apply_filters('wp_trim_excerpt', $text, $excerpt);
	    }
}

// **********************************************************************// 
// ! Registration Form
// **********************************************************************// 

if(!function_exists('et_register_form')) {
	function et_register_form($args = array()) {
		$rand = rand(100,1000);
        $captcha_instance = new ReallySimpleCaptcha();
		$captcha_instance->bg = array( 204, 168, 97 );
		$word = $captcha_instance->generate_random_word();
		$prefix = mt_rand();
		$img_name = $captcha_instance->generate_image( $prefix, $word );
		$captcha_img = ETHEME_CODE_URL.'/inc/really-simple-captcha/tmp/'.$img_name;
		?>
	        <form class="et-register-form form-<?php echo $rand; ?>" action="" method="get">
            	<div id="register-popup-result"></div> 
	            <div class="login-fields">
	                <p class="form-row">
	                    <label class=""><?php _e( "Enter your username", ET_DOMAIN ) ?> <span class="required">*</span></label>
	                    <input type="text" name="username" class="text input-text" />
	                </p>
	                <p class="form-row">
	                    <label class=""><?php _e( "Enter your E-mail address", ET_DOMAIN ) ?> <span class="required">*</span></label>
	                    <input type="text" name="email" class="text input-text" />
	                </p>
	                <p class="form-row">
	                    <label class=""><?php _e( "Enter your password", ET_DOMAIN ) ?> <span class="required">*</span></label>
	                    <input type="password" name="et_pass" class="text input-text" />
	                </p>
	                <p class="form-row">
	                    <label class=""><?php _e( "Re-enter your password", ET_DOMAIN ) ?> <span class="required">*</span></label>
	                    <input type="password" name="et_pass2" class="text input-text" />
	                </p>
	            </div>
				<div class="captcha-block">
					<img src="<?php echo $captcha_img; ?>">
					<input type="text" name="captcha-word" class="captcha-input">
					<input type="hidden" name="captcha-prefix" value="<?php echo $prefix; ?>">
				</div>
	            <p class="form-row right">
	                <input type="hidden" name="et_register" value="1">
	                <button class="btn btn-black big text-center submitbtn" type="submit"><span><?php _e( "Register", ET_DOMAIN ) ?></span></button>
	            </p>
	        </form>
	        <script type="text/javascript">
	        	jQuery(function($){
		        	$('.form-<?php echo $rand; ?>').submit(function(e) {
			        	e.preventDefault();
			        	$('.form-<?php echo $rand; ?> div#register-popup-result').html('<img src="<?php echo get_template_directory_uri(); ?>/images/loading.gif" class="loader" />').fadeIn();
		                var input_data = $(this).serialize();
		                input_data += '&action=et_register_action';
		                $.ajax({
		                    type: "GET",
		                    dataType: "JSON",
		                    url: "<?php echo admin_url( 'admin-ajax.php' ); ?>",
		                    data: input_data,
		                    success: function(response){
		                        $('.loader').remove();
		                        if(response.status == 'error') {
		                        	var msgHtml = '<span class="error">' + response.msg + '</span>';
		                            $('<div>').html(msgHtml).appendTo('.form-<?php echo $rand; ?> div#register-popup-result').hide().fadeIn('slow');
		                            
		                        } else {
		                        	var msgHtml = '<span class="success">' + response.msg + '</span>';
		                            $('<div>').html(msgHtml).appendTo('.form-<?php echo $rand; ?> div#register-popup-result').hide().fadeIn('slow');
		                            $(this).find("input[type=text], input[type=password], textarea").val("");
		                        }
		                    }
		                });
			        	
		        	});
	        	}, jQuery);
	        </script>
		<?php
	}
}


// **********************************************************************// 
// ! Send message from contact form 
// **********************************************************************// 

add_action( 'wp_ajax_et_send_msg_action', 'et_send_msg_action' );
add_action( 'wp_ajax_nopriv_et_send_msg_action', 'et_send_msg_action' );
if(!function_exists('et_send_msg_action')) {
    function et_send_msg_action() {
        $error_name  = false;
        $error_email = false;
        $error_msg   = false;
        
        $captcha_instance = new ReallySimpleCaptcha();

        if(isset($_GET['contact-submit'])) {
            header("Content-type: application/json");
            $name = '';
            $email = '';
            $website = '';
            $message = '';
            $reciever_email = '';
            $return = array();
            
            if(!$captcha_instance->check( $_GET['captcha-prefix'], $_GET['captcha-word'] )) {
                $return['status'] = 'error';
                $return['msg'] = __('The security code you entered did not match. Please try again.', ET_DOMAIN);
                echo json_encode($return);
                die();
            }

            if(trim($_GET['contact-name']) === '') {
                $error_name = true;
            } else{
                $name = trim($_GET['contact-name']);
            }

            if(trim($_GET['contact-email']) === '' || !isValidEmail($_GET['contact-email'])) {
                $error_email = true;
            } else{
                $email = trim($_GET['contact-email']);
            }

            if(trim($_GET['contact-msg']) === '') {
                $error_msg = true;
            } else{
                $message = trim($_GET['contact-msg']);
            }

            $website = stripslashes(trim($_GET['contact-website']));

            // Check if we have errors

            if(!$error_name && !$error_email && !$error_msg) {
                // Get the received email
                $reciever_email = etheme_get_option('contacts_email');

                $subject = 'You have been contacted by ' . $name;

                $body = "You have been contacted by $name. Their message is: " . PHP_EOL . PHP_EOL;
                $body .= $message . PHP_EOL . PHP_EOL;
                $body .= "You can contact $name via email at $email";
                if ($website != '') {
                    $body .= " and visit their website at $website" . PHP_EOL . PHP_EOL;
                }
                $body .= PHP_EOL . PHP_EOL;

                $headers = "From $email ". PHP_EOL;
                $headers .= "Reply-To: $email". PHP_EOL;
                $headers .= "MIME-Version: 1.0". PHP_EOL;
                $headers .= "Content-type: text/plain; charset=utf-8". PHP_EOL;
                $headers .= "Content-Transfer-Encoding: quoted-printable". PHP_EOL;

                if(wp_mail($reciever_email, $subject, $body, $headers)) {
                    $return['status'] = 'success';
                    $return['msg'] = __('All is well, your email has been sent.', ET_DOMAIN);
                } else{
                    $return['status'] = 'error';
                    $return['msg'] = __('Error while sending a message!', ET_DOMAIN);
                }
                $captcha_instance->remove( $_GET['captcha-prefix'] );

            }else{
                // Return errors
                $return['status'] = 'error';
                $return['msg'] = __('Please, fill in the required fields!', ET_DOMAIN);
            }

            echo json_encode($return);
            die();
        }
    }
}
// **********************************************************************// 
// ! Registration function (AJAX)
// **********************************************************************// 
add_action( 'wp_ajax_et_register_action', 'et_register_action' );
add_action( 'wp_ajax_nopriv_et_register_action', 'et_register_action' );
if(!function_exists('et_register_action')) {
	function et_register_action() {
		global $wpdb, $user_ID;
		$captcha_instance = new ReallySimpleCaptcha();
		
		if(!$captcha_instance->check( $_REQUEST['captcha-prefix'], $_REQUEST['captcha-word'] )) {
			$return['status'] = 'error';
			$return['msg'] = __('The security code you entered did not match. Please try again.', ET_DOMAIN);
			echo json_encode($return);
			die();
		}
	    if(!empty($_GET['et_register'])){
	        //We shall SQL escape all inputs
	        $username = esc_sql($_REQUEST['username']);
	        if(empty($username)) {
				$return['status'] = 'error';
				$return['msg'] = __( "User name should not be empty.", ET_DOMAIN );
				echo json_encode($return);
	            die();
	        }
	        $email = esc_sql($_REQUEST['email']);
	        if(!preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/", $email)) {
				$return['status'] = 'error';
				$return['msg'] = __( "Please enter a valid email.", ET_DOMAIN );
				echo json_encode($return);
	            die();
	        }
	        $pass = esc_sql($_REQUEST['et_pass']);
	        $pass2 = esc_sql($_REQUEST['et_pass2']);
	        if(empty($pass) || strlen($pass) < 5) {
				$return['status'] = 'error';
				$return['msg'] = __( "Password should have more than 5 symbols", ET_DOMAIN );
				echo json_encode($return);
	            die();
	        }
	        if($pass != $pass2) {
				$return['status'] = 'error';
				$return['msg'] = __( "The passwords do not match", ET_DOMAIN );
				echo json_encode($return);
	            die();
	        }
	        
	        $status = wp_create_user( $username, $pass, $email );
	        if ( is_wp_error($status) ) {
				$return['status'] = 'error';
				$return['msg'] = __( "Username already exists. Please try another one.", ET_DOMAIN );
				echo json_encode($return);
	        }
	        else {
	            $from = get_bloginfo('name');
	            $from_email = get_bloginfo('admin_email');
	            $headers = 'From: '.$from . " <". $from_email .">\r\n";
				$headers .= "MIME-Version: 1.0\r\n";
				$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
	            $subject = __("Registration successful", ET_DOMAIN);
	            $message = et_registration_email($username);
	            wp_mail( $email, $subject, $message, $headers );
				$return['status'] = 'success';
				$return['msg'] = __( "Please check your email for login details.", ET_DOMAIN );
				echo json_encode($return);
	        }
	        die();
	    } 
	}
}

// **********************************************************************// 
// ! Registration email template
// **********************************************************************// 
if(!function_exists('et_registration_email')) {
	function et_registration_email($username = '') {
        global $woocommerce;
        $logoimg = etheme_get_option('logo');
        $logoimg = apply_filters('etheme_logo_src',$logoimg);
		ob_start(); ?>
			<div style="background-color: #f5f5f5;width: 100%;-webkit-text-size-adjust: none;margin: 0;padding: 70px 0 70px 0;">
				<div style="-webkit-box-shadow: 0 0 0 3px rgba(0,0,0,0.025) ;box-shadow: 0 0 0 3px rgba(0,0,0,0.025);-webkit-border-radius: 6px;border-radius: 6px ;background-color: #fdfdfd;border: 1px solid #dcdcdc; padding:20px; margin:0 auto; width:500px; max-width:100%; color: #737373; font-family:Arial; font-size:14px; line-height:150%; text-align:left;">
			        <?php if($logoimg): ?>
			            <a href="<?php echo home_url(); ?>" style="display:block; text-align:center;"><img style="max-width:100%;" src="<?php echo $logoimg ?>" alt="<?php bloginfo( 'description' ); ?>" /></a>
			        <?php else: ?>
			            <a href="<?php echo home_url(); ?>" style="display:block; text-align:center;"><img style="max-width:100%;" src="<?php echo PARENT_URL.'/images/logo.png'; ?>" alt="<?php bloginfo('name'); ?>"></a>
			        <?php endif ; ?>
					<p><?php printf(__('Thanks for creating an account on %s. Your username is %s.', ET_DOMAIN), get_bloginfo( 'name' ), $username);?></p>
					<?php if (class_exists('Woocommerce')): ?>
					
						<p><?php printf(__('You can access your account area to view your orders and change your password here: <a href="%s">%s</a>.', ET_DOMAIN), get_permalink( get_option('woocommerce_myaccount_page_id') ), get_permalink( get_option('woocommerce_myaccount_page_id') ));?></p>
					
					<?php endif; ?>
					
				</div>
			</div>
		<?php 
	    $output = ob_get_contents();
	    ob_end_clean();
	    return $output;
	}
}



// **********************************************************************// 
// ! Footer Type
// **********************************************************************// 
function get_footer_type() {
    return etheme_get_option('footer_type');
}

add_filter('custom_footer_filter', 'get_footer_type',10);


// **********************************************************************// 
// ! Function to display comments
// **********************************************************************// 
if(!function_exists('etheme_comments')) {
    function etheme_comments($comment, $args, $depth) {
        $GLOBALS['comment'] = $comment;
        if(get_comment_type() == 'pingback' || get_comment_type() == 'trackback') :
            ?>
            
            <li id="comment-<?php comment_ID(); ?>" class="pingback">
                <div class="comment-block row">
                    <div class="col-md-12">
                        <div class="author-link"><?php _e('Pingback:', ET_DOMAIN) ?></div>
                        <div class="comment-reply"> <?php edit_comment_link(); ?></div>
                        <?php comment_author_link(); ?>

                    </div>
                </div>
				<div class="media">
					<h4 class="media-heading"><?php _e('Pingback:', ET_DOMAIN) ?></h4>
					
	                <?php comment_author_link(); ?>
					<?php edit_comment_link(); ?>
				</div>
            <?php
            
        elseif(get_comment_type() == 'comment') :
    	$rating = intval( get_comment_meta( $comment->comment_ID, 'rating', true ) ); ?>
        
        
				
			<li id="comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
				<div class="media">
					<div class="pull-left">
			            <?php 
			                $avatar_size = 80;
			                echo get_avatar($comment, $avatar_size);
			             ?>
					</div>
					
					<?php if ( $rating && get_option( 'woocommerce_enable_review_rating' ) == 'yes' ) : ?>
		
						<div itemprop="reviewRating" itemscope itemtype="http://schema.org/Rating" class="star-rating" title="<?php echo sprintf( __( 'Rated %d out of 5', 'woocommerce' ), $rating ) ?>">
							<span style="width:<?php echo ( $rating / 5 ) * 100; ?>%"><strong itemprop="ratingValue"><?php echo $rating; ?></strong> <?php _e( 'out of 5', 'woocommerce' ); ?></span>
						</div>
		
					<?php endif; ?>
					
					<div class="media-body">
						<h4 class="media-heading"><?php comment_author_link(); ?></h4>
						<div class="meta-comm">
							<?php comment_date(); ?> - <?php comment_time(); ?>
						</div>
						
					</div>

	                <?php if ($comment->comment_approved == '0'): ?>
	                    <p class="awaiting-moderation"><?php __('Your comment is awaiting moderation.', ET_DOMAIN) ?></p>
	                <?php endif ?>
	                
					<?php comment_text(); ?>
					<?php comment_reply_link(array_merge($args, array('reply_text' => __('Reply to comment', ET_DOMAIN),'depth' => $depth, 'max_depth' => $args['max_depth']))); ?>
					


		
				</div>

        <?php endif;
    }
}

/***************************************************************/
/* Etheme Global Search */
/***************************************************************/
add_action("wp_ajax_et_get_search_result", "et_get_search_result");
add_action("wp_ajax_nopriv_et_get_search_result", "et_get_search_result");
if(!function_exists('et_get_search_result')) {
	function et_get_search_result() {
		$word = esc_attr(stripslashes($_REQUEST['s']));
		if(isset($word) && $word != '') {
			$response = array(
				'results' => false,
				'html' => ''
			);
			
			if(isset($_GET['count'])) {
				$count = $_GET['count'];
			} else {
				$count = 3;
			}
			
			
			if($_GET['products'] && class_exists('WooCommerce')) {
				$products_args = array(
					'args' => array(
						'post_type' => 'product',
						'posts_per_page' => $count,
						's' => $word
					),
					'image' => $_GET['images'],
					'link' => true,
					'title' => __('View Products', ET_DOMAIN),
					'class' => 'et-result-products'
				);
				$products = et_search_get_result($products_args);
				if($products) {
					$response['results'] = true;
					$response['html'] .= $products;
				}
			}
			
			if($_GET['posts']) {
				$posts_args = array(
					'args' => array(
						'post_type' => 'post',
						'posts_per_page' => $count,
						's' => $word
					),
					'title' => __('From the blog', ET_DOMAIN),
					'image' => false,
					'link' => true,
					'class' => 'et-result-post'
				);
				$posts = et_search_get_result($posts_args);
				if($posts) {
					$response['results'] = true;
					$response['html'] .= $posts;
				}
			}
			
			
			if($_GET['portfolio']) {
				$portfolio_args = array(
					'args' => array(
						'post_type' => 'etheme_portfolio',
						'posts_per_page' => $count,
						's' => $word
					),
					'image' => false,
					'link' => false,
					'title' => __('Portfolio', ET_DOMAIN),
					'class' => 'et-result-portfolio'
				);
				$portfolio = et_search_get_result($portfolio_args);
				if($portfolio) {
					$response['results'] = true;
					$response['html'] .= $portfolio;
				}
			}
	
			
			if($_GET['pages']) {
				$pages_args = array(
					'args' => array(
						'post_type' => 'page',
						'posts_per_page' => $count,
						's' => $word
					),
					'image' => false,
					'link' => false,
					'title' => __('Pages', ET_DOMAIN),
					'class' => 'et-result-pages'
				);
				$pages = et_search_get_result($pages_args);
				if($pages) {
					$response['results'] = true;
					$response['html'] .= $pages;
				}
			}
			
			echo json_encode($response);
			
			die();
		} else {
			die();
		}
	}
}


if(!function_exists('et_search_get_result')) {
	function et_search_get_result($args) {
		extract($args);
		$query = new WP_Query( $args );
		
		// The Loop
		if ( $query->have_posts() ) {
	
		    ob_start();
			if($title != '') {
				?>
									
					<h5 class="title"><span><?php if($link): ?><a href="<?php echo home_url().'/?s='.$args['s'].'&post_type='.$args['post_type']; ?>" title="<?php _e('Show all', ET_DOMAIN); ?>"><?php endif; ?>
						<?php echo $title; ?>
					<?php if($link): ?>&rarr;</a><?php endif; ?></span></h5>
					
				<?php
			}
			?>
				<ul class="<?php echo $class; ?>">
					<?php
						while ( $query->have_posts() ) {
							$query->the_post();
							?>
								<li>
									<?php if($image && has_post_thumbnail( get_the_ID() )): ?>
										<?php $src = etheme_get_image(get_post_thumbnail_id( get_the_ID() ),30,30,false); ?>
										<img src="<?php echo $src; ?>" />
									<?php endif; ?>
									
									
									<a href="<?php the_permalink(); ?>">
										<?php echo get_the_title(); ?>
									</a>
									
								</li>
							<?php
						}
					?>
				</ul>
			<?php
		    $output = ob_get_contents();
		    ob_end_clean();
		    return $output;
		} else {
			return false;
		}
		/* Restore original Post Data */
		wp_reset_postdata();
		return;
	}	
}



// **********************************************************************// 
// ! Posted info
// **********************************************************************//
if(!function_exists('etheme_posted_info')) {
	function etheme_posted_info ($title = ''){
		$posted_by = '<div class="post-info">';
		$posted_by .= '<span class="posted-on">';
		$posted_by .= __('Posted on', ET_DOMAIN).' ';
		$posted_by .= get_the_time(get_option('date_format')).' ';
		$posted_by .= get_the_time(get_option('time_format')).' ';
		$posted_by .= '</span>';
		$posted_by .= '<span class="posted-by"> '.__('by', ET_DOMAIN).' '.get_the_author_link().'</span>';
		$posted_by .= '</div>';
		return $title.$posted_by;
	}
} 

// **********************************************************************// 
// ! Create products grid by args
// **********************************************************************//
if(!function_exists('etheme_products')) {
    function etheme_products($args,$title = false, $columns = 4){
        global $wpdb, $woocommerce_loop;
        ob_start();

        $products = new WP_Query( $args );
        $class = $title_output = '';
        $shop_url = get_permalink(woocommerce_get_page_id('shop'));

        if ($title != '') {
            $title_output = '<h2 class="title"><span>'.$title.'</span></h2>';
        }   

        $woocommerce_loop['columns'] = $columns;

        if ( $products->have_posts() ) :  echo $title_output; ?>
            <?php woocommerce_product_loop_start(); ?>

                <?php while ( $products->have_posts() ) : $products->the_post(); ?>

                    <?php woocommerce_get_template_part( 'content', 'product' ); ?>

                <?php endwhile; // end of the loop. ?>
                
            <?php woocommerce_product_loop_end(); ?>

        <?php endif;

        wp_reset_postdata();

        return ob_get_clean();
            
    }
}
// **********************************************************************// 
// ! Create products slider by args
// **********************************************************************//
if(!function_exists('etheme_create_slider')) {
    function etheme_create_slider($args, $slider_args = array()){//, $title = false, $shop_link = true, $slider_type = false, $items = '[[0, 1], [479,2], [619,2], [768,4],  [1200, 4], [1600, 4]]', $style = 'default'
        global $wpdb, $woocommerce_loop;
        
        $product_per_row = etheme_get_option('prodcuts_per_row');
        extract(shortcode_atts(array( 
	        'title' => false,
	        'shop_link' => false,
	        'slider_type' => false,
	        'from_first' => '',
	        'items' => '[[0, 2], [479,2], [619,2], [768,4],  [1200, 4], [1600, 4]]',
	        'style' => 'default',
	        'block_id' => false
	    ), $slider_args));

        $box_id = rand(1000,10000);
        $multislides = new WP_Query( $args );
        $shop_url = get_permalink(woocommerce_get_page_id('shop'));
        $class = $container_class = $title_output = '';
        if(!$slider_type) {
        	$woocommerce_loop['lazy-load'] = true;
        	$woocommerce_loop['style'] = $style;
        }
        

        if(!$slider_type) {
            $container_class = '';
            $class .= 'owl-carousel';
        } elseif($slider_type == 'swiper') {
            $container_class = 'et-swiper-container';
            $class .= 'swiper-wrapper';
        }

        if ( $multislides->have_posts() ) :
            if ($title) {
                $title_output = '<h2 class="title"><span>'.$title.'</span></h2>';
            }   
              echo '<div class="carousel-area '.$container_class.' slider-'.$box_id.'">';
                  echo $title_output;
                  echo '<div class="'.$class.' productCarousel">';
                        $_i=0;
                    	if($block_id && $block_id != '' && et_get_block($block_id) != '') {
                            echo '<div class="slide-item '.$slider_type.'-slide">';
                                echo et_get_block($block_id);
                            echo '</div><!-- slide-item -->';
                    	}
                        while ($multislides->have_posts()) : $multislides->the_post();
                            $_i++;
                            
                            if(class_exists('Woocommerce')) {
                                global $product;
                                if (!$product->is_visible()) continue; 
                                echo '<div class="slide-item product-slide '.$slider_type.'-slide">';
                                    woocommerce_get_template_part( 'content', 'product-slider' );
                                echo '</div><!-- slide-item -->';
                            }

                        endwhile; 
                  echo '</div><!-- products-slider -->'; 
              echo '</div><!-- slider-container -->'; 
        endif;
        wp_reset_query();
        unset($woocommerce_loop['lazy-load']);
        unset($woocommerce_loop['style']);
        
        if($items != '[[0, 2], [479,2], [619,2], [768,4],  [1200, 4], [1600, 4]]') {
            $items = '[[0, '.$items['phones'].'], [479,'.$items['tablet'].'], [619,'.$items['tablet'].'], [768,'.$items['tablet'].'],  [1200, '.$items['notebook'].'], [1600, '.$items['desktop'].']]';
        } 
        if(!$slider_type) {
	        echo '
	
	            <script type="text/javascript">
	                jQuery(".slider-'.$box_id.' .productCarousel").owlCarousel({
	                    items:4, 
	                    lazyLoad : true,
	                    navigation: true,
	                    navigationText:false,
	                    rewindNav: false,
	                    itemsCustom: '.$items.'
	                });
	
	            </script>
	        ';
        } elseif($slider_type == 'swiper') {
        	$initialSlide = 0;
        	if( $from_first == 'no' )  {
        		$initialSlide = 2;
        	}
	        echo '
                <script type="text/javascript">
	                jQuery(document).ready(function() {
	                  if(jQuery(window).width() > 767) {
	                      jQuery(".slider-'.$box_id.'").etFullWidth();
	                      var mySwiper'.$box_id.' = new Swiper(".slider-'.$box_id.'",{
	                      	initialSlide: ' . $initialSlide . ',
	                        keyboardControl: true,
	                        centeredSlides: true,
	                        calculateHeight : true,
	                        slidesPerView: "auto",
	                        mode: "horizontal"
	                      })
	                  } else {
	                      var mySwiper'.$box_id.' = new Swiper(".slider-'.$box_id.'",{
	                        calculateHeight : true
	                      })
	                  }
	                
	                    jQuery(function($){
	                        $(".slider-'.$box_id.' .slide-item").click(function(){
	                            mySwiper'.$box_id.'.swipeTo($(this).index());
	                            $(".lookbook-index").removeClass("active");
	                            $(this).addClass("active");
	                        });
	                        
	                        $(".slider-'.$box_id.' .slide-item a").click(function(e){
	                            if($(this).parents(".swiper-slide-active").length < 1) {
	                                e.preventDefault();
	                            }
	                        });
	                    }, jQuery);
	                });
                </script>
	        ';
        }
            
    }
}

// **********************************************************************// 
// ! Products slider widget
// **********************************************************************// 
if(!function_exists('etheme_create_slider_widget')) {
    function etheme_create_slider_widget($args,$title = false){
        global $wpdb;
        $box_id = rand(1000,10000);
        $multislides = new WP_Query( $args );

        if ( $multislides->have_posts() ) :
            if ($title) {
                $title_output = '<h4 class="widget-title"><span>'.$title.'</span></h4>';
            }   
            echo '<div class="sidebar-slider">';
                echo $title_output;
                echo '<div class="owl-carousel sidebarCarousel slider-'.$box_id.'">';
                    $_i=0;
                    echo '<div class="slide-item product-slide"><ul class="product_list_widget">';
                        while ($multislides->have_posts()) : $multislides->the_post();
                            $_i++;
                            
                            if(class_exists('Woocommerce')) {
                                global $product;
                                if (!$product->is_visible()) continue; 
                                    woocommerce_get_template_part( 'content', 'widget-product' );

                                    if($_i%3 == 0 && $_i != $multislides->post_count) {
                                        echo '</ul></div><!-- slide-item -->';
                                        echo '<div class="slide-item product-slide"><ul class="product_list_widget">';
                                    }
                            }

                        endwhile; 
                    echo '</ul></div><!-- slide-item -->';
                echo '</div><!-- sidebarCarousel -->'; 
            echo '</div><!-- sidebar-slider -->'; 
        endif;
        wp_reset_query();

        echo '
            <script type="text/javascript">
                jQuery(document).ready(function($) {
                    jQuery(".slider-'.$box_id.'").owlCarousel({
                        items:1,
                        navigation: true,
                        lazyLoad: true,
                        rewindNav: false,
                        addClassActive: true,
                        itemsCustom: [1600, 1]
                    });
                });
            </script>
        ';
            
    }
}


// **********************************************************************// 
// ! Create posts slider by args
// **********************************************************************//
if(!function_exists('etheme_create_posts_slider')) {
    function etheme_create_posts_slider($args,$title = false, $more_link = true, $date = false, $excerpt = false, $width = 400, $height = 270, $crop = true, $layout = '', $items = '[[0, 1], [479,2], [619,2], [768,2],  [1200, 3], [1600, 3]]', $el_class = ''){
        $box_id = rand(1000,10000);
        $multislides = new WP_Query( $args );
        $lightbox = etheme_get_option('blog_lightbox');
        $sliderHeight = etheme_get_option('default_blog_slider_height');
        $posts_url = get_permalink(get_option('page_for_posts'));
        $class = '';
        if($layout != '') {
            $class .= ' layout-'.$layout;
        }
        if ( $multislides->have_posts() ) :
            $title_output = '';
            if ($title) {
                $title_output = '<h3 class="title"><span>'.$title.'</span></h3>';
            }   
              echo '<div class="slider-container '.$class.$el_class.'">';
                  echo $title_output;
                  echo '<div class="carousel-area posts-slider slider-'.$box_id.'">';
                        echo '<div class="recentCarousel slider">';
                        $_i=0;
                        while ($multislides->have_posts()) : $multislides->the_post();
                            $_i++;

                                echo '<div class="slide-item thumbnails-x post-slide">';
                                    if(has_post_thumbnail()){
                                        echo '<div class="post-news">';
                                            echo '<img src="' . etheme_get_image(false, $width, $height, true) . '" class="post-slide-img">';

                                            echo '<div class="zoom">';
                                                echo '<div class="btn_group">';
                                                    if($lightbox): 
                                                        echo '<a href="'.etheme_get_image(false).'" class="btn btn-black xmedium-btn" rel="lightbox"><span>'.__('View large', ET_DOMAIN).'</span></a>';
                                                    endif;
                                                    echo '<a href="'.get_permalink().'" class="btn btn-black xmedium-btn"><span>'.__('More details', ET_DOMAIN).'</span></a>';
                                                echo '</div>';
                                                echo '<i class="bg"></i>';
                                            echo '</div>';
                                        echo '</div>';
                                    }

                                    echo '<div class="caption">';
                                        echo '<h6 class="active">';
                                        the_category(',&nbsp;');
                                        echo '</h6>';
                                        echo '<h3><a href="'.get_permalink().'">' . get_the_title() . '</a></h3>';
                                        if($date){ ?>
                                            <div class="meta-post">
                                                    <?php the_time(get_option('date_format')); ?> 
                                                    <?php _e('at', ET_DOMAIN); ?> 
                                                    <?php the_time(get_option('time_format')); ?>
                                                    <?php _e('by', ET_DOMAIN); ?> <?php the_author_posts_link(); ?>
                                                    <?php // Display Comments 

                                                            if(comments_open() && !post_password_required()) {
                                                                    echo ' / ';
                                                                    comments_popup_link('0', '1 Comment', '% Comments', 'post-comments-count');
                                                            }

                                                     ?>
                                            </div>
                                        <?php
                                        }
                                        if($excerpt) the_excerpt();
                                    echo '</div><!-- caption -->';
                                echo '</div><!-- slide-item -->';

                        endwhile; 
                        echo '</div><!-- slider -->'; 
                  echo '</div><!-- items-slider -->';
              echo '</div><div class="clear"></div><!-- slider-container -->';

            if($items != '[[0, 1], [479,2], [619,2], [768,2],  [1200, 3], [1600, 3]]') {
                $items = '[[0, '.$items['phones'].'], [479,'.$items['phones'].'], [619,'.$items['tablet'].'], [768,'.$items['tablet'].'],  [1200, '.$items['notebook'].'], [1600, '.$items['desktop'].']]';
            } 
           
            echo '
                <script type="text/javascript">
                        jQuery(".slider-'.$box_id.' .slider").owlCarousel({
                            items:4, 
                            lazyLoad : true,
                            navigation: true,
                            navigationText:false,
                            rewindNav: false,
                            itemsCustom: '.$items.'
                        });
                </script>
            ';
            

        endif;
        wp_reset_query();
       
    }
}

// **********************************************************************// 
// ! Site breadcrumbs
// **********************************************************************//
if(!function_exists('etheme_breadcrumbs')) {
    function etheme_breadcrumbs() {

      $showOnHome = 0; // 1 - show breadcrumbs on the homepage, 0 - don't show
      $delimiter = '<span class="delimeter">/</span>'; // delimiter between crumbs
      $home = __('Home', ET_DOMAIN); // text for the 'Home' link
      $blogPage = __('Blog', ET_DOMAIN);
      $showCurrent = 1; // 1 - show current post/page title in breadcrumbs, 0 - don't show
      $before = '<span class="current">'; // tag before the current crumb
      $after = '</span>'; // tag after the current crumb
      
      global $post;
      $homeLink = home_url();
      if (is_front_page()) {
      
        if ($showOnHome == 1) echo '<div id="crumbs"><a href="' . $homeLink . '">' . $home . '</a></div>';
      
	      } else if (class_exists('bbPress') && is_bbpress()) {
      	$bbp_args = array(
      		'before' => '<div class="breadcrumbs" id="breadcrumb">',
      		'after' => '</div>'
      	);	      
      	bbp_breadcrumb($bbp_args);
      } else {
        do_action('etheme_before_breadcrumbs');
        
        echo '<div class="breadcrumbs">';
        echo '<div id="breadcrumb">';
        echo '<a href="' . $homeLink . '">' . $home . '</a> ' . $delimiter . ' ';
      
        if ( is_category() ) {
          $thisCat = get_category(get_query_var('cat'), false);
          if ($thisCat->parent != 0) echo get_category_parents($thisCat->parent, TRUE, ' ' . $delimiter . ' ');
          echo $before . 'Archive by category "' . single_cat_title('', false) . '"' . $after;
      
        } elseif ( is_search() ) {
          echo $before . 'Search results for "' . get_search_query() . '"' . $after;
      
        } elseif ( is_day() ) {
          echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
          echo '<a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter . ' ';
          echo $before . get_the_time('d') . $after;
      
        } elseif ( is_month() ) {
          echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
          echo $before . get_the_time('F') . $after;
      
        } elseif ( is_year() ) {
          echo $before . get_the_time('Y') . $after;
      
        } elseif ( is_single() && !is_attachment() ) {
          if ( get_post_type() == 'etheme_portfolio' ) {
            $portfolioId = etheme_tpl2id('portfolio.php'); 
            $portfolioLink = get_permalink($portfolioId);
            $post_type = get_post_type_object(get_post_type());
            $slug = $post_type->rewrite;
            echo '<a href="' . $portfolioLink . '/">' . $post_type->labels->name . '</a>';
            if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
          } elseif ( get_post_type() != 'post' ) {
            $post_type = get_post_type_object(get_post_type());
            $slug = $post_type->rewrite;
            echo '<a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a>';
            if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
          } else {
            $cat = get_the_category(); 
            if(isset($cat[0])) {
	            $cat = $cat[0];
	            $cats = get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
	            if ($showCurrent == 0) $cats = preg_replace("#^(.+)\s$delimiter\s$#", "$1", $cats);
	            echo $cats;
            }
	        if ($showCurrent == 1) echo $before . get_the_title() . $after;
          }
      
        } elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
          $post_type = get_post_type_object(get_post_type());
          echo $before . $post_type->labels->singular_name . $after;
      
        } elseif ( is_attachment() ) {
          $parent = get_post($post->post_parent);
          //$cat = get_the_category($parent->ID); $cat = $cat[0];
          //echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
          //echo '<a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a>';
          if ($showCurrent == 1) echo ' '  . $before . get_the_title() . $after;
      
        } elseif ( is_page() && !$post->post_parent ) {
          if ($showCurrent == 1) echo $before . get_the_title() . $after;
      
        } elseif ( is_page() && $post->post_parent ) {
          $parent_id  = $post->post_parent;
          $breadcrumbs = array();
          while ($parent_id) {
            $page = get_page($parent_id);
            $breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
            $parent_id  = $page->post_parent;
          }
          $breadcrumbs = array_reverse($breadcrumbs);
          for ($i = 0; $i < count($breadcrumbs); $i++) {
            echo $breadcrumbs[$i];
            if ($i != count($breadcrumbs)-1) echo ' ' . $delimiter . ' ';
          }
          if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
      
        } elseif ( is_tag() ) {
          echo $before . 'Posts tagged "' . single_tag_title('', false) . '"' . $after;
      
        } elseif ( is_author() ) {
           global $author;
          $userdata = get_userdata($author);
          echo $before . 'Articles posted by ' . $userdata->display_name . $after;
      
        } elseif ( is_404() ) {
          echo $before . 'Error 404' . $after;
        }else{
            
            echo $blogPage;
        }
      
        if ( get_query_var('paged') ) {
          if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
          echo ' ('.__('Page') . ' ' . get_query_var('paged').')';
          if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
        }
      
        echo '</div>';
        et_back_to_page();
        echo '</div>';
      
      }
    }
}

if(!function_exists('et_back_to_page')) {
    function et_back_to_page() {
        echo '<a class="back-history" href="javascript: history.go(-1)">'.__('Return to Previous Page',ET_DOMAIN).'</a>';
    }
}


// **********************************************************************// 
// ! Back to top button
// **********************************************************************// 
if(!function_exists('et_btt_button')) {
	function et_btt_button() {
		if (etheme_get_option('to_top')): ?>
			<div id="back-top" class="back-top <?php if(!etheme_get_option('to_top_mobile')): ?>visible-lg<?php endif; ?> bounceOut">
				<a href="#top">
					<span></span>
				</a>
			</div>
		<?php endif;
	}
}

add_action('after_page_wrapper', 'et_btt_button'); 

// **********************************************************************// 
// ! Custom navigation
// **********************************************************************// 

class Et_Navigation extends Walker_Nav_Menu
{
    public $styles = '';
    function start_lvl( &$output, $depth = 0, $args = array() ) {
        $display_depth = ($depth + 1); 
        if($display_depth == '1') {
            $class_names = 'nav-sublist-dropdown';
            $container = 'container';
        } else {
            $class_names = 'nav-sublist';
            $container = '';
        }

        $indent = str_repeat("\t", $depth);

         $output .= "\n$indent<div class=".$class_names."><div class='".$container."'><ul>\n";
    }

    function end_lvl( &$output, $depth = 1, $args = array() ) {
        $indent = str_repeat("\t", $depth);
        $output .= "$indent</ul></div></div>\n";
    }

    function start_el ( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
        global $wp_query;
        $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

        $item_id =  $item->ID;

        $class_names = $value = '';

        $anchor = get_post_meta($item_id, '_menu-item-anchor', true);
        
        if(!empty($anchor)) {
            $item->url = $item->url.'#'.$anchor;
            if(($key = array_search('current_page_item', $item->classes)) !== false) {
                unset($item->classes[$key]);
            }
            if(($key = array_search('current-menu-item', $item->classes)) !== false) {
                unset($item->classes[$key]);
            }
        }
        
        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        $classes[] = 'menu-item-' . $item->ID;
        $classes[] = 'item-level-' . $depth;

        $design = $columns = $icon = $label = '';
        $design = get_post_meta($item_id, '_menu-item-design', true);
        $columns = get_post_meta($item_id, '_menu-item-columns', true);
        $icon = get_post_meta($item_id, '_menu-item-icon', true);
        $label = get_post_meta($item_id, '_menu-item-label', true);
        $disable_titles = get_post_meta($item_id, '_menu-item-disable_titles', true);

        if($design != '') $classes[] = 'item-design-'.$design;
        if($columns != '') $classes[] = 'columns-'.$columns;
        if($icon != '') $icon = '<i class="fa fa-'.$icon.'"></i>';
        if($label != '') $classes[]= 'menu-label-'.$label;
        if($disable_titles == 1) $classes[]= 'menu-disable_titles';
        
        $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
        $class_names = ' class="' . esc_attr( $class_names ) . '"';

        $id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
        $id = strlen( $id ) ? ' id="' . esc_attr( $id ) . '"' : '';

        $output .= $indent . '<li' . $id . $value . $class_names .'>';
        
        $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
        $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
        $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
        $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
        $description = '';
        if($item->description != '') {
        	$description = '<span class="menu-item-descr">'. do_shortcode($item->description) . '</span>';
        }
        $tooltip = '';

        if ( has_post_thumbnail( $item_id ) ) { 
            if($depth < 1) {
                $this->et_enque_styles($item_id);
            } else {
                $tooltip = $this->et_get_tooltip_html($item_id);
            }
        }

        $item_output = $args->before;
        $item_output .= '<a'. $attributes .'>';
        $item_output .= $icon;
        $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
        $item_output .= $description;
        $item_output .= $tooltip;
        $item_output .= '</a>';
        $item_output .= $args->after;

        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    } 

    function et_enque_styles($item_id) {
        $post_thumbnail = get_post_thumbnail_id( $item_id, 'thumb' );
        $post_thumbnail_url = wp_get_attachment_url( $post_thumbnail );
        $bg_position = get_post_meta($item_id, '_menu-item-background_position', true);
        $bg_repeat = get_post_meta($item_id, '_menu-item-background_repeat', true );
        $bg_pos = $bg_rep = '';
        if($bg_position != '') {
            $bg_pos = "background-position: ".$bg_position.";";
        }
        if($bg_repeat != '') {
            $bg_rep = "background-repeat: ".$bg_repeat.";";
        }
        $this->styles .= ".menu-item-".$item_id." .nav-sublist-dropdown {".$bg_pos.$bg_rep." background-image: url(".$post_thumbnail_url."); }";

        $styles = $this->styles;

        echo '<style>'.$styles.'</style>';

        //add_action('wp_footer', function() use($styles) { die(); echo '<style>'.$styles.'</style>'; });

    }

    function et_get_tooltip_html($item_id) {
        $output = '';
        $post_thumbnail = get_post_thumbnail_id( $item_id );
        $post_thumbnail_url = wp_get_attachment_image_src( $post_thumbnail, 'medium' );
        $output .= '<div class="nav-item-image">';
            $output .= '<img src="' . $post_thumbnail_url[0] . '" width="' . $post_thumbnail_url[1] . '" height="' . $post_thumbnail_url[2] . '" />';
        $output .= '</div>';
        return $output;
    }
}



class Et_Navigation_Mobile extends Walker_Nav_Menu
{

    function start_el ( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
        global $wp_query;
        $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

        $item_id =  $item->ID;

        $class_names = $value = '';

        $anchor = get_post_meta($item_id, '_menu-item-anchor', true);
        
        if(!empty($anchor)) {
            $item->url = $item->url.'#'.$anchor;
            if(($key = array_search('current_page_item', $item->classes)) !== false) {
                unset($item->classes[$key]);
            }
            if(($key = array_search('current-menu-item', $item->classes)) !== false) {
                unset($item->classes[$key]);
            }
        }
        
        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        $classes[] = 'menu-item-' . $item->ID;
        $classes[] = 'item-level-' . $depth;

        $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
        $class_names = ' class="' . esc_attr( $class_names ) . '"';

        $id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
        $id = strlen( $id ) ? ' id="' . esc_attr( $id ) . '"' : '';

        $output .= $indent . '<li' . $id . $value . $class_names .'>';
        
        $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
        $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
        $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
        $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

        $tooltip = '';

        $item_output = $args->before;
        $item_output .= '<a'. $attributes .'>';
        $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
        $item_output .= '</a>';
        $item_output .= $args->after;

        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    } 
}

// **********************************************************************// 
// ! http://codex.wordpress.org/Function_Reference/wp_nav_menu#How_to_add_a_parent_class_for_menu_item
// **********************************************************************// 

add_filter( 'wp_nav_menu_objects', 'add_menu_parent_class' );
function add_menu_parent_class( $items ) {
    
    $parents = array();
    foreach ( $items as $item ) {
        if ( $item->menu_item_parent && $item->menu_item_parent > 0 ) {
            $parents[] = $item->menu_item_parent;
        }
    }
    
    foreach ( $items as $item ) {
        if ( in_array( $item->ID, $parents ) ) {
            $item->classes[] = 'menu-parent-item'; 
        }
    }
    
    return $items;    
}

// **********************************************************************// 
// ! Twitter API functions
// **********************************************************************// 
if(!function_exists('etheme_capture_tweets')) {
	function etheme_capture_tweets($consumer_key,$consumer_secret,$user_token,$user_secret,$user, $count) {

	    $connection = getConnectionWithAccessToken($consumer_key,$consumer_secret,$user_token, $user_secret);
	    $params = array(
	        'screen_name' => $user,
	        'count' => $count
	    );
	    
	    $content = $connection->get("statuses/user_timeline",$params);
	    
	    //prar($content);
	    
	    return json_encode($content);
	}
}

if(!function_exists('getConnectionWithAccessToken')) {
	function getConnectionWithAccessToken($consumer_key,$consumer_secret,$oauth_token, $oauth_token_secret) {
	    $connection = new TwitterOAuth($consumer_key, $consumer_secret, $oauth_token, $oauth_token_secret);
	    return $connection;
	}
}


if(!function_exists('etheme_tweet_linkify')) {
	function etheme_tweet_linkify($tweet) {
	    $tweet = preg_replace("#(^|[\n ])([\w]+?://[\w]+[^ \"\n\r\t< ]*)#", "\\1<a href=\"\\2\" target=\"_blank\">\\2</a>", $tweet);
	    $tweet = preg_replace("#(^|[\n ])((www|ftp)\.[^ \"\t\n\r< ]*)#", "\\1<a href=\"http://\\2\" target=\"_blank\">\\2</a>", $tweet);
	    $tweet = preg_replace("/@(\w+)/", "<a href=\"http://www.twitter.com/\\1\" target=\"_blank\">@\\1</a>", $tweet);
	    $tweet = preg_replace("/#(\w+)/", "<a href=\"http://search.twitter.com/search?q=\\1\" target=\"_blank\">#\\1</a>", $tweet);
	    return $tweet;
	}
}
if(!function_exists('etheme_store_tweets')) {
	function etheme_store_tweets($file, $tweets) {
	    ob_start(); // turn on the output buffering 
	    $fo = fopen($file, 'w'); // opens for writing only or will create if it's not there
	    if (!$fo) return etheme_print_tweet_error(error_get_last());
	    $fr = fwrite($fo, $tweets); // writes to the file what was grabbed from the previous function
	    if (!$fr) return etheme_print_tweet_error(error_get_last());
	    fclose($fo); // closes
	    ob_end_flush(); // finishes and flushes the output buffer; 
	}
}

if(!function_exists('etheme_pick_tweets')) {
	function etheme_pick_tweets($file) {
	    ob_start(); // turn on the output buffering 
	    $fo = fopen($file, 'r'); // opens for reading only 
	    if (!$fo) return etheme_print_tweet_error(error_get_last());
	    $fr = fread($fo, filesize($file));
	    if (!$fr) return etheme_print_tweet_error(error_get_last());
	    fclose($fo);
	    ob_end_flush();
	    return $fr;
	}
}

if(!function_exists('etheme_print_tweet_error')) {
	function etheme_print_tweet_error($errorsArray) {
		$html = '';
		if( count($errorsArray) > 0 ){
			foreach ($errorsArray as $key => $error) {
	    		$html .= '<p class="warning">Error: ' . $error['message']  . '</p>';
			}
		}
		return $html;
	}
}

if(!function_exists('etheme_twitter_cache_enabled')) {
	function etheme_twitter_cache_enabled(){
	    return true;
	}
}

if(!function_exists('et_get_tweets')) {
	function et_get_tweets($consumer_key,$consumer_secret,$user_token,$user_secret,$user, $count, $cachetime=50, $key = 'widget') {
	    if(etheme_twitter_cache_enabled()){
	        //setting the location to cache file
	        $cachefile = ET_CODE_DIR . 'cache/cache-twitter-' . $key . '.json'; 

	        // the file exitsts but is outdated, update the cache file
	        if (file_exists($cachefile) && ( time() - $cachetime > filemtime($cachefile)) && filesize($cachefile) > 0) {
	            //capturing fresh tweets
	            $tweets = etheme_capture_tweets($consumer_key,$consumer_secret,$user_token,$user_secret,$user, $count);
	            $tweets_decoded = json_decode($tweets, true);
	            //if get error while loading fresh tweets - load outdated file
	            if(isset($tweets_decoded['errors'])) {
	                $tweets = etheme_pick_tweets($cachefile);
	            }
	            //else store fresh tweets to cache
	            else
	                etheme_store_tweets($cachefile, $tweets);
	        }
	        //file doesn't exist or is empty, create new cache file
	        elseif (!file_exists($cachefile) || filesize($cachefile) == 0) {
	            $tweets = etheme_capture_tweets($consumer_key,$consumer_secret,$user_token,$user_secret,$user, $count);
	            $tweets_decoded = json_decode($tweets, true);
	            //if request fails, and there is no old cache file - print error
	            if(isset($tweets_decoded['errors'])) {
	            	echo etheme_print_tweet_error($tweets['errors']);
	                return array();
	            }
	            //make new cache file with request results
	            else
	                etheme_store_tweets($cachefile, $tweets);            
	        }
	        //file exists and is fresh
	        //load the cache file
	        else { 
	           $tweets = etheme_pick_tweets($cachefile);
	        }
	    } else{
	       $tweets = etheme_capture_tweets($consumer_key,$consumer_secret,$user_token,$user_secret,$user, $count);
	    }
	
	    $tweets = json_decode($tweets, true);

	    if(isset($tweets['errors'])) {
	    	echo etheme_print_tweet_error($tweets['errors']);
	    	return array();
	    }
	
	    return $tweets;
	}
}



// **********************************************************************// 
// ! Related posts 
// **********************************************************************// 

if(!function_exists('et_get_related_posts')) {
    function et_get_related_posts($postId = false, $limit = 5){
        global $post;
        if(!$postId) {
            $postId = $post->ID;
        }
        $categories = get_the_category($postId);
        if ($categories) {
            $category_ids = array();
            foreach($categories as $individual_category) $category_ids[] = $individual_category->term_id;

            $args = array(
                'category__in' => $category_ids,
                'post__not_in' => array($postId),
                'showposts'=>$limit, // Number of related posts that will be shown.
            );
            etheme_create_posts_slider($args, __('Related posts', ET_DOMAIN), false, true, true);
        }
    }
}


// **********************************************************************// 
// ! Promo Popup
// **********************************************************************// 
add_action('after_page_wrapper', 'et_promo_popup');
if(!function_exists('et_promo_popup')) {
    function et_promo_popup() {
        if(!etheme_get_option('promo_popup')) return;
        $bg = etheme_get_option('pp_bg');
        $padding = etheme_get_option('pp_padding');
        ?>
            <div id="etheme-popup" class="white-popup-block mfp-hide mfp-with-anim zoom-anim-dialog">
                <?php echo do_shortcode(etheme_get_option('pp_content')); ?>
                <p class="checkbox-label">
                    <input type="checkbox" value="do-not-show" name="showagain" id="showagain" class="showagain" />
                    <label for="showagain"><?php _e('Don\'t show this popup again', ET_DOMAIN); ?></label>
                </p>
            </div>
            <style type="text/css">
                #etheme-popup {
                    width: <?php echo (etheme_get_option('pp_width') != '') ? etheme_get_option('pp_width') : 700 ; ?>px;
                    height: <?php echo (etheme_get_option('pp_height') != '') ? etheme_get_option('pp_height') : 350 ; ?>px;
                    <?php if(!empty($bg['background-color'])): ?>  background-color: <?php echo $bg['background-color']; ?>;<?php endif; ?>
                    <?php if(!empty($bg['background-image'])): ?>  background-image: url(<?php echo $bg['background-image']; ?>) ; <?php endif; ?>
                    <?php if(!empty($bg['background-attachment'])): ?>  background-attachment: <?php echo $bg['background-attachment']; ?>;<?php endif; ?>
                    <?php if(!empty($bg['background-repeat'])): ?>  background-repeat: <?php echo $bg['background-repeat']; ?>;<?php  endif; ?>
                    <?php if(!empty($bg['background-color'])): ?>  background-color: <?php echo $bg['background-color']; ?>;<?php  endif; ?>
                    <?php if(!empty($bg['background-position'])): ?>  background-position: <?php echo $bg['background-position']; ?>;<?php endif; ?>
                }
            </style>
        <?php
    }
}


// **********************************************************************// 
// ! QR Code generation
// **********************************************************************// 
if(!function_exists('generate_qr_code')) {
    function generate_qr_code($text='QR Code', $title = 'QR Code', $size = 128, $class = '', $self_link = false, $lightbox = false ) {
        if($self_link) {
            global $wp;
            $text = @$_SERVER['HTTPS'] == 'on' ? 'https://' : 'http://';
            if ( $_SERVER['SERVER_PORT'] != '80' )
                $text .= $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . $_SERVER['REQUEST_URI'];
            else 
                $text .= $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
        }
        $image = 'https://chart.googleapis.com/chart?chs=' . $size . 'x' . $size . '&cht=qr&chld=H|1&chl=' . $text;

        if($lightbox) {
            $class .= ' qr-lighbox';
            $output = '<a href="'.$image.'" rel="lightbox" class="'.$class.'">'.$title.'</a>';
        } else{
            $class .= ' qr-image';
            $output = '<img src="'.$image.'"  class="'.$class.'" />';
        }

        return $output;
    }
}

if(!function_exists('et_get_menus_options')) {
    function et_get_menus_options() {
        $menus = array();
        $menus = array(""=>"Default");
        $nav_terms = get_terms( 'nav_menu', array( 'hide_empty' => true ) );
        foreach ( $nav_terms as $obj ) {
            $menus[$obj->slug] = $obj->name;
        }
        return $menus;
    }
}

// **********************************************************************// 
// ! Function to get post image
// **********************************************************************//  

if(!function_exists('etheme_get_image')) {
	function etheme_get_image( $attachment_id = 0, $width = null, $height = null, $crop = true, $post_id = null, $get_sizes = false ) {
		global $post;
		if (!$attachment_id) {
			if (!$post_id) {
				$post_id = $post->ID;
			}
			if ( has_post_thumbnail( $post_id ) ) {
				$attachment_id = get_post_thumbnail_id( $post_id );
			} 
			else {
				$attached_images = (array)get_posts( array(
					'post_type'   => 'attachment',
					'numberposts' => 1,
					'post_status' => null,
					'post_parent' => $post_id,
					'orderby'     => 'menu_order',
					'order'       => 'ASC'
				) );
				if ( !empty( $attached_images ) )
					$attachment_id = $attached_images[0]->ID;
			}
		}
		
		if (!$attachment_id)
			return;
			
		$image_url = etheme_get_resized_url($attachment_id,$width, $height, $crop, $get_sizes);
		
		return apply_filters( 'et_product_image', $image_url );
	}
}

if(!function_exists('etheme_get_resized_url')) {
	function etheme_get_resized_url($id,$width, $height, $crop, $get_sizes = false) {
		if ( function_exists("gd_info") && (($width >= 10) && ($height >= 10)) && (($width <= 1024) && ($height <= 1024)) ) {
			$vt_image = vt_resize( $id, '', $width, $height, $crop );
			if ($vt_image)  {
				if ($get_sizes) {
					$image_url = $vt_image;
				} else {
					$image_url = $vt_image['url'];
				}
			}
			else
				$image_url = false;
		}
		else {
			$full_image = wp_get_attachment_image_src( $id, 'full');
			if (!empty($full_image[0]))
				$image_url = $full_image[0];
			else
				$image_url = false;
		}
		
	    if( is_ssl() && !strstr(  $image_url, 'https' ) ) str_replace('http', 'https', $image_url);
	    
	    return $image_url;
	}
}

if ( !function_exists('vt_resize') ) {
	function vt_resize( $attach_id = null, $img_url = null, $width, $height, $crop = false) {
	

		// this is an attachment, so we have the ID
		if ( $attach_id ) {
		
			$image_src = wp_get_attachment_image_src( $attach_id, 'full' );
			$file_path = get_attached_file( $attach_id );
		
		// this is not an attachment, let's use the image url
		} else if ( $img_url ) {

			
			$file_path = parse_url( $img_url );
			$file_path = $_SERVER['DOCUMENT_ROOT'] . $file_path['path'];
			
			if(is_multisite()) $file_path = et_trim_multisite_folder($file_path);

			//$file_path = ltrim( $file_path['path'], '/' );
			//$file_path = rtrim( ABSPATH, '/' ).$file_path['path'];
			
			$orig_size = @getimagesize( $file_path );
			
			$image_src[0] = $img_url;
			$image_src[1] = $orig_size[0];
			$image_src[2] = $orig_size[1];
		}
		
		$file_info = pathinfo( $file_path );
	
		// check if file exists
		$base_file = $file_info['dirname'].'/'.$file_info['filename'].'.'.$file_info['extension'];
		if ( !file_exists($base_file) )
			return;
		 
		$extension = '.'. $file_info['extension'];
	
		// the image path without the extension
		$no_ext_path = $file_info['dirname'].'/'.$file_info['filename'];
		
		// checking if the file size is larger than the target size
		// if it is smaller or the same size, stop right here and return
		if ( $image_src[1] > $width || $image_src[2] > $height ) {
	
			if ( $crop == true ) {
			
				$cropped_img_path = $no_ext_path.'-'.$width.'x'.$height.$extension;
				
				// the file is larger, check if the resized version already exists (for $crop = true but will also work for $crop = false if the sizes match)
				if ( file_exists( $cropped_img_path ) ) {
		
					$cropped_img_url = str_replace( basename( $image_src[0] ), basename( $cropped_img_path ), $image_src[0] );
					
					$vt_image = array (
						'url' => $cropped_img_url,
						'width' => $width,
						'height' => $height
					);
					
					return $vt_image;
				}
			}
			elseif ( $crop == false ) {
			
				// calculate the size proportionaly
				$proportional_size = wp_constrain_dimensions( $image_src[1], $image_src[2], $width, $height );
				$resized_img_path = $no_ext_path.'-'.$proportional_size[0].'x'.$proportional_size[1].$extension;			
	
				// checking if the file already exists
				if ( file_exists( $resized_img_path ) ) {
				
					$resized_img_url = str_replace( basename( $image_src[0] ), basename( $resized_img_path ), $image_src[0] );
	
					$vt_image = array (
						'url' => $resized_img_url,
						'width' => $proportional_size[0],
						'height' => $proportional_size[1]
					);
					
					return $vt_image;
				}
			}
	
			// check if image width is smaller than set width
			$img_size = getimagesize( $file_path );
			if ( $img_size[0] <= $width ) $width = $img_size[0];		
	
			// no cache files - let's finally resize it
			//$new_img_path = image_resize( $file_path, $width, $height, $crop );

			$image = wp_get_image_editor( $file_path );
			if ( ! is_wp_error( $image ) ) {
			    $image->resize( $width, $height, $crop );
			    $new_img_path = $image->save();
			    $new_img_path = $new_img_path['path'];
			} else{
				$new_img_path = $file_path;
			}

			$new_img_size = getimagesize( $new_img_path );
			$new_img = str_replace( basename( $image_src[0] ), basename( $new_img_path ), $image_src[0] );
	
			// resized output
			$vt_image = array (
				'url' => $new_img,
				'width' => $new_img_size[0],
				'height' => $new_img_size[1]
			);
			
			return $vt_image;
		}
	
		// default output - without resizing
		$vt_image = array (
			'url' => $image_src[0],
			'width' => $image_src[1],
			'height' => $image_src[2]
		);
		
		return $vt_image;
	}
}



if(!function_exists('et_trim_multisite_folder')) {
	/* function remove unnecessary multisite folder from url path */
	function et_trim_multisite_folder($path) {

		$upload_dir = wp_upload_dir();

		$path = explode('wp-content/', $path);

		$uploads_path = explode('uploads', $upload_dir['basedir']);

		return $uploads_path[0] . '/' . $path[1];
	}
}

if(!function_exists('et_resize')) {
	function et_resize( $attach_id = null, $img_url = null, $width, $height, $crop = false ) {
		if( !$attach_id )
			$attach_id = et_attach_id_from_src($image_url);
		
		$upload_dir = wp_upload_dir();
		$image = wp_get_attachment_metadata($attach_id);
		
		if( !wp_attachment_is_image($attach_id) || !$image )
			return null;
		
		if($width > $image['width'])
			$width = $image['width'];
		
		if($height > $image['height'])
			$height = $image['height'];
		
		if($width == -1)
			$width = round( ( $image['width'] / $image['height'] ) * $height );
		
		if($height == -1)
			$height = round( ( $image['height'] / $image['width'] ) * $width );
		
		if( $image['width'] == $width && $image['height'] == $height )
			return wp_get_attachment_url($attach_id);
		
		foreach( $image['sizes'] as $image_size_name => $image_size ) {
			if( $image_size['width'] == $width && $image_size['height'] == $height ) {
				$new_image = wp_get_attachment_image_src($attach_id, $image_size_name);
				$vt_image = array (
					'url' => $new_image[0],
					'width' => $new_image[1],
					'height' => $new_image[2]
				);
				return $vt_image;
			}
		}
		
		$image_editor = wp_get_image_editor($upload_dir['basedir'] . '/' . $image['file']);
		
		if( is_wp_error($image_editor) )
			return null;
		
		$image_editor->set_quality(100);
		$image_editor->resize($width, $height, $crop);
		$thumb = $image_editor->save();
		
		$image_size_name = $thumb['width'] . 'x' . $thumb['height'];
		$image['sizes'][$image_size_name] = Array(
			'file' => $thumb['file'],
			'width' => $thumb['width'],
			'height' => $thumb['height'],
			'mime-type' => $thumb['mime-type']
		);
		
		wp_update_attachment_metadata($attach_id, $image);
		

		
		$new_image = wp_get_attachment_image_src($attach_id, $image_size_name);
		$vt_image = array (
			'url' => $new_image[0],
			'width' => $new_image[1],
			'height' => $new_image[2]
		);
		return $vt_image;
	}	
}


if(!function_exists('et_attach_id_from_src')) {
	function et_attach_id_from_src($image_src) {
		global $wpdb;
		
		$id = $wpdb->get_var(
			$wpdb->prepare("SELECT ID FROM {$wpdb->posts} WHERE guid = '%s'", $image_src )
		);
		
		return $id;
	}
}

if(!function_exists('et_get_icons')) {
    function et_get_icons() {
        $iconsArray = array("adjust","anchor","archive","arrows","arrows-h","arrows-v","asterisk","ban","bar-chart-o","barcode","bars","beer","bell","bell-o","bolt","book","bookmark","bookmark-o","briefcase","bug","building-o","bullhorn","bullseye","calendar","calendar-o","camera","camera-retro","caret-square-o-down","caret-square-o-left","caret-square-o-right","caret-square-o-up","certificate","check","check-circle","check-circle-o","check-square","check-square-o","circle","circle-o","clock-o","cloud","cloud-download","cloud-upload","code","code-fork","coffee","cog","cogs","comment","comment-o","comments","comments-o","compass","credit-card","crop","crosshairs","cutlery","dashboard","desktop","dot-circle-o","download","edit","ellipsis-h","ellipsis-v","envelope","envelope-o","eraser","exchange","exclamation","exclamation-circle","exclamation-triangle","external-link","external-link-square","eye","eye-slash","female","fighter-jet","film","filter","fire","fire-extinguisher","flag","flag-checkered","flag-o","flash","flask","folder","folder-o","folder-open","folder-open-o","frown-o","gamepad","gavel","gear","gears","gift","glass","globe","group","hdd-o","headphones","heart","heart-o","home","inbox","info","info-circle","key","keyboard-o","laptop","leaf","legal","lemon-o","level-down","level-up","lightbulb-o","location-arrow","lock","magic","magnet","mail-forward","mail-reply","mail-reply-all","male","map-marker","meh-o","microphone","microphone-slash","minus","minus-circle","minus-square","minus-square-o","mobile","mobile-phone","money","moon-o","music","pencil","pencil-square","pencil-square-o","phone","phone-square","picture-o","plane","plus","plus-circle","plus-square","plus-square-o","power-off","print","puzzle-piece","qrcode","question","question-circle","quote-left","quote-right","random","refresh","reply","reply-all","retweet","road","rocket","rss","rss-square","search","search-minus","search-plus","share","share-square","share-square-o","shield","shopping-cart","sign-in","sign-out","signal","sitemap","smile-o","sort","sort-alpha-asc","sort-alpha-desc","sort-amount-asc","sort-amount-desc","sort-asc","sort-desc","sort-down","sort-numeric-asc","sort-numeric-desc","sort-up","spinner","square","square-o","star","star-half","star-half-empty","star-half-full","star-half-o","star-o","subscript","suitcase","sun-o","superscript","tablet","tachometer","tag","tags","tasks","terminal","thumb-tack","thumbs-down","thumbs-o-down","thumbs-o-up","thumbs-up","ticket","times","times-circle","times-circle-o","tint","toggle-down","toggle-left","toggle-right","toggle-up","trash-o","trophy","truck","umbrella","unlock","unlock-alt","unsorted","upload","user","users","video-camera","volume-down","volume-off","volume-up","warning","wheelchair","wrench", "check-square","check-square-o","circle","circle-o","dot-circle-o","minus-square","minus-square-o","plus-square","plus-square-o","square","square-o","bitcoin","btc","cny","dollar","eur","euro","gbp","inr","jpy","krw","money","rmb","rouble","rub","ruble","rupee","try","turkish-lira","usd","won","yen","align-center","align-justify","align-left","align-right","bold","chain","chain-broken","clipboard","columns","copy","cut","dedent","eraser","file","file-o","file-text","file-text-o","files-o","floppy-o","font","indent","italic","link","list","list-alt","list-ol","list-ul","outdent","paperclip","paste","repeat","rotate-left","rotate-right","save","scissors","strikethrough","table","text-height","text-width","th","th-large","th-list","underline","undo","unlink","angle-double-down","angle-double-left","angle-double-right","angle-double-up","angle-down","angle-left","angle-right","angle-up","arrow-circle-down","arrow-circle-left","arrow-circle-o-down","arrow-circle-o-left","arrow-circle-o-right","arrow-circle-o-up","arrow-circle-right","arrow-circle-up","arrow-down","arrow-left","arrow-right","arrow-up","arrows","arrows-alt","arrows-h","arrows-v","caret-down","caret-left","caret-right","caret-square-o-down","caret-square-o-left","caret-square-o-right","caret-square-o-up","caret-up","chevron-circle-down","chevron-circle-left","chevron-circle-right","chevron-circle-up","chevron-down","chevron-left","chevron-right","chevron-up","hand-o-down","hand-o-left","hand-o-right","hand-o-up","long-arrow-down","long-arrow-left","long-arrow-right","long-arrow-up","toggle-down","toggle-left","toggle-right","toggle-up", "angle-double-down","angle-double-left","angle-double-right","angle-double-up","angle-down","angle-left","angle-right","angle-up","arrow-circle-down","arrow-circle-left","arrow-circle-o-down","arrow-circle-o-left","arrow-circle-o-right","arrow-circle-o-up","arrow-circle-right","arrow-circle-up","arrow-down","arrow-left","arrow-right","arrow-up","arrows","arrows-alt","arrows-h","arrows-v","caret-down","caret-left","caret-right","caret-square-o-down","caret-square-o-left","caret-square-o-right","caret-square-o-up","caret-up","chevron-circle-down","chevron-circle-left","chevron-circle-right","chevron-circle-up","chevron-down","chevron-left","chevron-right","chevron-up","hand-o-down","hand-o-left","hand-o-right","hand-o-up","long-arrow-down","long-arrow-left","long-arrow-right","long-arrow-up","toggle-down","toggle-left","toggle-right","toggle-up","adn","android","apple","bitbucket","bitbucket-square","bitcoin","btc","css3","dribbble","dropbox","facebook","facebook-square","flickr","foursquare","github","github-alt","github-square","gittip","google-plus","google-plus-square","html5","instagram","linkedin","linkedin-square","linux","maxcdn","pagelines","pinterest","pinterest-square","renren","skype","stack-exchange","stack-overflow","trello","tumblr","tumblr-square","twitter","twitter-square","vimeo-square","vk","weibo","windows","xing","xing-square","youtube","youtube-play","youtube-square","ambulance","h-square","hospital-o","medkit","plus-square","stethoscope","user-md","wheelchair");

        return array_unique($iconsArray);
            
    }
}

if(!function_exists('vc_icon_form_field')) {
    function vc_icon_form_field($settings, $value) {
        $settings_line = '';
        $selected = '';
        $array = et_get_icons();
        if($value != '') {
            $array = array_diff($array, array($value));
            array_unshift($array,$value);
        }
        
        $settings_line .= '<div class="et-icon-selector">';
        $settings_line .= '<input type="hidden" value="'.$value.'" name="'.$settings['param_name'].'" class="et-hidden-icon wpb_vc_param_value wpb-icon-select '.$settings['param_name'].' '.$settings['type'] . '">';
            foreach ($array as $icon) {
                if ($value == $icon) {
                    $selected = 'selected';
                }
                $settings_line .= '<span class="et-select-icon '.$selected.'" data-icon-name='.$icon.'><i class="fa fa-'.$icon.'"></i></span>';
                $selected = '';
            }

        $settings_line .= '<script>';
        $settings_line .= 'jQuery(".et-select-icon").click(function(){';
            $settings_line .= 'var iconName = jQuery(this).data("icon-name");';
            $settings_line .= 'if(!jQuery(this).hasClass("selected")) {';
                $settings_line .= 'jQuery(".et-select-icon").removeClass("selected");';
                $settings_line .= 'jQuery(this).addClass("selected");';
                $settings_line .= 'jQuery(this).parent().find(".et-hidden-icon").val(iconName);';
            $settings_line .= '}';

        $settings_line .= '});';
        $settings_line .= '</script>';

        $settings_line .= '</div>';
        return $settings_line;
    }
    if(function_exists('vc_add_shortcode_param'))
    vc_add_shortcode_param('icon', 'vc_icon_form_field');
}

if ( ! function_exists( 'et_excerpt_length' )):
/**
 *
 * Change excerpt length.
 *
 */
function et_excerpt_length() {
	return etheme_get_option('excerpt_length');
}
add_filter( 'excerpt_length', 'et_excerpt_length', 999 );

endif;

?>

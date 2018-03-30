<?php


register_nav_menu('top', 'Top Navigation');

if (!isset( $content_width )) $content_width = 940;

$just_catalog = etheme_get_option('just_catalog');

function remove_loop_button(){
    remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
	remove_action( 'woocommerce_simple_add_to_cart', 'woocommerce_simple_add_to_cart', 30 );
	remove_action( 'woocommerce_grouped_add_to_cart', 'woocommerce_grouped_add_to_cart', 30 );
	remove_action( 'woocommerce_variable_add_to_cart', 'woocommerce_variable_add_to_cart', 30 );
	remove_action( 'woocommerce_external_add_to_cart', 'woocommerce_external_add_to_cart', 30 );
}

if($just_catalog == 1) {
    add_action('init','remove_loop_button');
}
function etheme_enqueue_styles() {
    $custom_css = etheme_get_option('custom_css');
    if ( !is_admin() ) {
        wp_enqueue_style("superfish",get_template_directory_uri().'/css/superfish.css');
        wp_enqueue_style("slider",get_template_directory_uri().'/css/slider.css');
        wp_enqueue_style("lightbox",get_template_directory_uri().'/css/flexslider.css');
        wp_enqueue_style("font-awesome",get_template_directory_uri().'/css/font-awesome.min.css');
        
        if($custom_css == 1) {
            wp_enqueue_style("custom",get_template_directory_uri().'/custom.css');  
        }
        
        $scriptDepends = array();
        
        if(class_exists('WooCommerce')) {
	        $scriptDepends[] = 'wc-add-to-cart-variation';
        }
        
        wp_enqueue_script("jquery");
        wp_enqueue_script('jquery.easing', get_template_directory_uri().'/js/jquery.easing.1.3.min.js');
        wp_enqueue_script('cookie', get_template_directory_uri().'/js/cookie.js');
        wp_enqueue_script('theme-hoverIntent', get_template_directory_uri().'/js/hoverIntent.js');
        wp_enqueue_script('jquery.slider', get_template_directory_uri().'/js/jquery.slider.js');
        wp_enqueue_script('efects', get_template_directory_uri().'/js/efects.js');
        wp_enqueue_script('modernizr.custom', get_template_directory_uri().'/js/modernizr.custom.js');
        wp_enqueue_script('et_masonry', get_template_directory_uri().'/js/jquery.masonry.min.js');
        wp_enqueue_script('flexslider', get_template_directory_uri().'/js/jquery.flexslider-min.js');
        wp_enqueue_script('superfish', get_template_directory_uri().'/js/superfish.js');
        wp_enqueue_script('tooltip', get_template_directory_uri().'/js/tooltip.js');
        wp_enqueue_script('tabs', get_template_directory_uri().'/js/tabs.js');
        wp_enqueue_script('etheme', get_template_directory_uri().'/js/script.js',$scriptDepends);


        wp_localize_script( 'etheme', 'myAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ), 'noresults' => __('No results were found!', ETHEME_DOMAIN) ));
    
        // rewrite woo styles and scripts
        wp_dequeue_style('woocommerce_prettyPhoto_css');
        wp_enqueue_style('woocommerce_prettyPhoto_css', get_template_directory_uri().'/css/prettyPhoto.css');
        wp_dequeue_script('prettyPhoto' );
        wp_dequeue_script('prettyPhoto-init' );
        wp_enqueue_script('prettyPhoto', get_template_directory_uri().'/js/jquery.prettyPhoto.js',array(),false,true);
        wp_enqueue_script('prettyPhoto-init', get_template_directory_uri().'/js/prettyPhoto-init.js',array(),false,true);
    }
}

add_action( 'wp_enqueue_scripts', 'etheme_enqueue_styles' );


function jsString($str='') { 
    return trim(preg_replace("/('|\"|\r?\n)/", '', $str)); 
} 

function etheme_get_the_category_list($separator = '', $parents='', $post_id = false){
	global $wp_rewrite;
	$categories = get_the_category( $post_id );
	if ( !is_object_in_taxonomy( get_post_type( $post_id ), 'category' ) )
		return apply_filters( 'the_category', '', $separator, $parents );

	if ( empty( $categories ) )
		return apply_filters( 'the_category', __( 'Uncategorized' ), $separator, $parents );

	$rel = "";

	$thelist = '';
	if ( '' == $separator ) {
		$thelist .= '<ul class="post-categories">';
		foreach ( $categories as $category ) {
			$thelist .= "\n\t<li>";
			switch ( strtolower( $parents ) ) {
				case 'multiple':
					if ( $category->parent )
						$thelist .= get_category_parents( $category->parent, true, $separator );
					$thelist .= '<a href="' . get_category_link( $category->term_id ) . '" title="' . esc_attr( sprintf( __( "View all posts in %s" ), $category->name ) ) . '" ' . $rel . '>' . $category->name.'</a></li>';
					break;
				case 'single':
					$thelist .= '<a href="' . get_category_link( $category->term_id ) . '" title="' . esc_attr( sprintf( __( "View all posts in %s" ), $category->name ) ) . '" ' . $rel . '>';
					if ( $category->parent )
						$thelist .= get_category_parents( $category->parent, false, $separator );
					$thelist .= $category->name.'</a></li>';
					break;
				case '':
				default:
					$thelist .= '<a href="' . get_category_link( $category->term_id ) . '" title="' . esc_attr( sprintf( __( "View all posts in %s" ), $category->name ) ) . '" ' . $rel . '>' . $category->name.'</a></li>';
			}
		}
		$thelist .= '</ul>';
	} else {
		$i = 0;
		foreach ( $categories as $category ) {
			if ( 0 < $i )
				$thelist .= $separator;
			switch ( strtolower( $parents ) ) {
				case 'multiple':
					if ( $category->parent )
						$thelist .= get_category_parents( $category->parent, true, $separator );
					$thelist .= '<a href="' . get_category_link( $category->term_id ) . '" title="' . esc_attr( sprintf( __( "View all posts in %s" ), $category->name ) ) . '" ' . $rel . '>' . $category->name.'</a>';
					break;
				case 'single':
					$thelist .= '<a href="' . get_category_link( $category->term_id ) . '" title="' . esc_attr( sprintf( __( "View all posts in %s" ), $category->name ) ) . '" ' . $rel . '>';
					if ( $category->parent )
						$thelist .= get_category_parents( $category->parent, false, $separator );
					$thelist .= "$category->name</a>";
					break;
				case '':
				default:
					$thelist .= '<a href="' . get_category_link( $category->term_id ) . '" title="' . esc_attr( sprintf( __( "View all posts in %s" ), $category->name ) ) . '" ' . $rel . '>' . $category->name.'</a>';
			}
			++$i;
		}
	}
	return apply_filters( 'the_category', $thelist, $separator, $parents );
}


/**
 * For more information on hooks, actions, and filters, see http://codex.wordpress.org/Plugin_API.
 *
 */

function etheme_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'etheme_page_menu_args' );

/**
 * Sets the post excerpt length to 40 characters.
 *
 * To override this length in a child theme, remove the filter and add your own
 * function tied to the excerpt_length filter hook.
 *
 * @return int
 */
function etheme_excerpt_length( $length ) {
	return etheme_get_option('excerpt_length');
}
add_filter( 'excerpt_length', 'etheme_excerpt_length' );

/**
 * Returns a "Continue Reading" link for excerpts
 *
 * @return string "Continue Reading" link
 */
function etheme_continue_reading_link() {
	return ' <a class="continue-reading" href="'. get_permalink() . '">' . __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'etheme' ) . '</a>';
}

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with an ellipsis and etheme_continue_reading_link().
 *
 * To override this in a child theme, remove the filter and add your own
 * function tied to the excerpt_more filter hook.
 *
 * @return string An ellipsis
 */
function etheme_auto_excerpt_more( $more ) {
	global $post;
    return __( '<br/><a href="'. get_permalink($post->ID) . '"><span class="button active fl-r"><span>READ MORE</span></span></a><br/>', ETHEME_DOMAIN );
}
add_filter( 'excerpt_more', 'etheme_auto_excerpt_more' );

/**
 * Adds a pretty "Continue Reading" link to custom post excerpts.
 *
 * To override this link in a child theme, remove the filter and add your own
 * function tied to the get_the_excerpt filter hook.
 *
 * @return string Excerpt with a pretty "Continue Reading" link
 */
function etheme_custom_excerpt_more( $output ) {
	if ( has_excerpt() && ! is_attachment() ) {
		$output .= etheme_continue_reading_link();
	}
	return $output;
}
add_filter( 'get_the_excerpt', 'etheme_custom_excerpt_more' );


/**
 * Deprecated way to remove inline styles printed when the gallery shortcode is used.
 *
 * This function is no longer needed or used. Use the use_default_gallery_style
 * filter instead, as seen above.
 *
 *
 * @return string The gallery style filter, with the styles themselves removed.
 */
function etheme_remove_gallery_css( $css ) {
	return preg_replace( "#<style type='text/css'>(.*?)</style>#s", '', $css );
}
// Backwards compatibility with WordPress 3.0.
if ( version_compare( $GLOBALS['wp_version'], '3.1', '<' ) )
	add_filter( 'gallery_style', 'etheme_remove_gallery_css' );

if ( ! function_exists( 'etheme_comment' ) ) :
function etheme_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case '' :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<div id="comment-<?php comment_ID(); ?>">
            <?php echo get_avatar( $comment, 55 ); ?>
            <div class="comment-meta">
                <h5 class="author"><?php echo get_comment_author_link() ?> -  <?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?></h5>	
                <?php if ( $comment->comment_approved == '0' ) : ?>
        			<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'etheme' ); ?></em>	
        		<?php endif; ?>
                <p class="date">
        			<?php
        				/* translators: 1: date, 2: time */
        				printf( __( '%1$s at %2$s', 'etheme' ), get_comment_date(),  get_comment_time() ); ?></a><?php edit_comment_link( __( '(Edit)', 'etheme' ), ' ' );
        			?>
                </p>
            </div>
    		<div class="comment-body"><?php comment_text(); ?></div>
            <div class="clear"></div>
<!-- .reply -->
    	</div><!-- #comment-##  -->

	<?php
			break;
		case 'pingback'  :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'etheme' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( '(Edit)', 'etheme' ), ' ' ); ?></p>
	<?php
			break;
	endswitch;
}
endif;

/**
 * Removes the default styles that are packaged with the Recent Comments widget.
 *
 * To override this in a child theme, remove the filter and optionally add your own
 * function tied to the widgets_init action hook.
 *
 * This function uses a filter (show_recent_comments_widget_style) new in WordPress 3.1
 * to remove the default style. Using Twenty Ten 1.2 in WordPress 3.0 will show the styles,
 * but they won't have any effect on the widget in default Twenty Ten styling.
 *
 */
function etheme_remove_recent_comments_style() {
	add_filter( 'show_recent_comments_widget_style', '__return_false' );
}
add_action( 'widgets_init', 'etheme_remove_recent_comments_style' );

if ( ! function_exists( 'etheme_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 *
 */
function etheme_posted_on() {
	printf( __( '<span class="%1$s">Posted on</span> %2$s <span class="meta-sep">by</span> %3$s', ETHEME_DOMAIN ),
		'meta-prep meta-prep-author',
		sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><span class="entry-date">%3$s</span></a>',
			get_permalink(),
			esc_attr( get_the_time() ),
			get_the_date()
		),
		sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s">%3$s</a></span>',
			get_author_posts_url( get_the_author_meta( 'ID' ) ),
			esc_attr( sprintf( __( 'View all posts by %s', ETHEME_DOMAIN ), get_the_author() ) ),
			get_the_author()
		)
	);
}
endif;

if ( ! function_exists( 'etheme_posted_in' ) ) :
/**
 * Prints HTML with meta information for the current post (category, tags and permalink).
 *
 */
function etheme_posted_in() {
	// Retrieves tag list of current post, separated by commas.
	$tag_list = get_the_tag_list( '', ', ' );
	if ( $tag_list ) {
		$posted_in = __( 'This entry was posted in %1$s and tagged %2$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', ETHEME_DOMAIN );
	} elseif ( is_object_in_taxonomy( get_post_type(), 'category' ) ) {
		$posted_in = __( 'This entry was posted in %1$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', ETHEME_DOMAIN );
	} else {
		$posted_in = __( 'Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', ETHEME_DOMAIN );
	}
	// Prints the string, replacing the placeholders.
	printf(
		$posted_in,
		etheme_get_the_category_list( ', ' ),
		$tag_list,
		get_permalink(),
		the_title_attribute( 'echo=0' )
	);
}
endif;

function etheme_previous_post_link($format='&laquo; %link', $link='%title', $in_same_cat = false, $excluded_categories = '') {
	etheme_adjacent_post_link($format, $link, $in_same_cat, $excluded_categories, true);
}

function etheme_next_post_link($format='%link &raquo;', $link='%title', $in_same_cat = false, $excluded_categories = '') {
	etheme_adjacent_post_link($format, $link, $in_same_cat, $excluded_categories, false);
}

function etheme_adjacent_post_link($format, $link, $in_same_cat = false, $excluded_categories = '', $previous = true) {
	if ( $previous && is_attachment() )
		$post = & get_post($GLOBALS['post']->post_parent);
	else
		$post = get_adjacent_post($in_same_cat, $excluded_categories, $previous);

	if ( !$post )
		return;

	$title = $post->post_title;

	if ( empty($post->post_title) )
		$title = $previous ? __('Previous Post') : __('Next Post');

	$title = apply_filters('the_title', $title, $post->ID);
    $title = explode(" ",$title);
    $title = array_chunk($title,5); 
    $title = implode(" ",$title[0]).'...';
    
	$date = mysql2date(get_option('date_format'), $post->post_date);
	$rel = $previous ? 'prev' : 'next';

	$string = '<a href="'.get_permalink($post).'" rel="'.$rel.'">';
	$link = str_replace('%title', $title, $link);
	$link = str_replace('%date', $date, $link);
	$link = $string . $link . '</a>';

	$format = str_replace('%link', $link, $format);

	$adjacent = $previous ? 'previous' : 'next';
	echo apply_filters( "{$adjacent}_post_link", $format, $link );
}


// **********************************************************************// 
// ! Registration 
// **********************************************************************// 
add_action( 'wp_ajax_et_register_action', 'et_register_action' );
add_action( 'wp_ajax_nopriv_et_register_action', 'et_register_action' );
if(!function_exists('et_register_action')) {
	function et_register_action() {
		global $wpdb, $user_ID;
		$captcha_instance = new ReallySimpleCaptcha();
		if(!$captcha_instance->check( $_REQUEST['captcha-prefix'], $_REQUEST['captcha-word'] )) {
			$return['status'] = 'error';
			$return['msg'] = __('The security code you entered did not match. Please try again.', ETHEME_DOMAIN);
			echo json_encode($return);
			die();
		}
	    if(!empty($_REQUEST)){
	        //We shall SQL escape all inputs
	        $username = esc_sql($_REQUEST['username']);
	        if(empty($username)) {
				$return['status'] = 'error';
				$return['msg'] = __( "User name should not be empty.", ETHEME_DOMAIN );
				echo json_encode($return);
	            die();
	        }
	        $email = esc_sql($_REQUEST['email']);
	        if(!preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/", $email)) {
				$return['status'] = 'error';
				$return['msg'] = __( "Please enter a valid email.", ETHEME_DOMAIN );
				echo json_encode($return);
	            die();
	        }
	        $pass = esc_sql($_REQUEST['pass']);
	        $pass2 = esc_sql($_REQUEST['pass2']);
	        if(empty($pass) || strlen($pass) < 5) {
				$return['status'] = 'error';
				$return['msg'] = __( "Password should have more than 5 symbols", ETHEME_DOMAIN );
				echo json_encode($return);
	            die();
	        }
	        if($pass != $pass2) {
				$return['status'] = 'error';
				$return['msg'] = __( "The passwords do not match", ETHEME_DOMAIN );
				echo json_encode($return);
	            die();
	        }
	        
	        $status = wp_create_user( $username, $pass, $email );
	        if ( is_wp_error($status) ) {
				$return['status'] = 'error';
				$return['msg'] = __( "Username already exists. Please try another one.", ETHEME_DOMAIN );
				echo json_encode($return);
	        }
	        else {
	            $from = get_bloginfo('name');
	            $from_email = get_bloginfo('admin_email');
	            $headers = 'From: '.$from . " <". $from_email .">\r\n";
				$headers .= "MIME-Version: 1.0\r\n";
				$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
	            $subject = __("Registration successful", ETHEME_DOMAIN);
	            $message = et_registration_email($username);
	            wp_mail( $email, $subject, $message, $headers );
				$return['status'] = 'success';
				$return['msg'] = __( "Please check your email for login details.", ETHEME_DOMAIN );
				echo json_encode($return);
	        }
	        die();
	    } 
	}
}

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
					<p><?php printf(__('Thanks for creating an account on %s. Your username is %s.', ETHEME_DOMAIN), get_bloginfo( 'name' ), $username);?></p>
					<?php if (class_exists('Woocommerce')): ?>
					
						<p><?php printf(__('You can access your account area to view your orders and change your password here: <a href="%s">%s</a>.', ETHEME_DOMAIN), get_permalink( get_option('woocommerce_myaccount_page_id') ), get_permalink( get_option('woocommerce_myaccount_page_id') ));?></p>
					
					<?php endif; ?>
					
				</div>
			</div>
		<?php 
	    $output = ob_get_contents();
	    ob_end_clean();
	    return $output;
	}
}


function etheme_get_images($width = null, $height = null, $crop = true, $post_id = null ) {
	global $post;
	
	if (!$post_id) {
		$post_id = $post->ID;
	}	
	
	if ( has_post_thumbnail( $post_id ) ) {
		$attachment_id = get_post_thumbnail_id( $post_id );
	} 
	
	$args = array(
	    'post_type' => 'attachment',
	    'post_status' => null,
	    'post_parent' => $post_id,
		'orderby' => 'menu_order',
		'order' => 'ASC',
		'posts_per_page' => 20,
		'exclude' => get_post_thumbnail_id( $post_id )
	);
	
	$attachments = get_posts($args);
	
	if (empty( $attachments) && empty($attachment_id))
		return;
		
	$image_urls = array();
		
	$image_urls[] = etheme_get_resized_url($attachment_id,$width, $height, $crop);
		
	foreach($attachments as $one) {
		$image_urls[] = etheme_get_resized_url($one->ID,$width, $height, $crop);
	}

	return apply_filters( 'blanco_attachment_image', $image_urls );
}

function etheme_get_image( $attachment_id = 0, $width = null, $height = null, $crop = true, $post_id = null ) {
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

	if ( function_exists("gd_info") && (($width >= 10) && ($height >= 10)) && (($width <= 1024) && ($height <= 1024)) ) {
		$vt_image = vt_resize( $attachment_id, '', $width, $height, $crop );
		if ($vt_image) 
			$image_url = $vt_image['url'];
		else
			$image_url = false;
	}
	else {
		$full_image = wp_get_attachment_image_src( $attachment_id, 'full');
		if ($full_image) 
			$image_url = $full_image[0];
		else
			$image_url = false;
	}
	
    if( is_ssl() && !strstr(  $image_url, 'https' ) ) str_replace('http', 'https', $image_url);
	// @todo - put fallback 'No image' catcher here
	
	return apply_filters( 'blanco_product_image', $image_url );
}

function etheme_get_resized_url($id,$width, $height, $crop) {
	if ( function_exists("gd_info") && (($width >= 10) && ($height >= 10)) && (($width <= 1024) && ($height <= 1024)) ) {
		$vt_image = vt_resize( $id, '', $width, $height, $crop );
		if ($vt_image) 
			$image_url = $vt_image['url'];
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


if ( !function_exists('vt_resize') ) {
	function vt_resize( $attach_id = null, $img_url = null, $width, $height, $crop = false ) {
	
		// this is an attachment, so we have the ID
		if ( $attach_id ) {
		
			$image_src = wp_get_attachment_image_src( $attach_id, 'full' );
			$file_path = get_attached_file( $attach_id );
		
		// this is not an attachment, let's use the image url
		} else if ( $img_url ) {
			
			$file_path = parse_url( $img_url );
			$file_path = $_SERVER['DOCUMENT_ROOT'] . $file_path['path'];
			
			//$file_path = ltrim( $file_path['path'], '/' );
			//$file_path = rtrim( ABSPATH, '/' ).$file_path['path'];
			
			$orig_size = getimagesize( $file_path );
			
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
			$new_img_path = image_resize( $file_path, $width, $height, $crop );
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

if ( !function_exists('vt_resize2') ) {
	function vt_resize2( $img_name, $dir_url, $dir_path, $width, $height, $crop = false ) {
		
		$file_path = trailingslashit($dir_path).$img_name;
		
		$orig_size = getimagesize( $file_path );
		
		$image_src[0] = trailingslashit($dir_url).$img_name;
		$image_src[1] = $orig_size[0];
		$image_src[2] = $orig_size[1];
		
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
			$new_img_path = image_resize( $file_path, $width, $height, $crop );
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


/**
* Output breadcrumbs if configured
* @return None - outputs breadcrumb HTML
*/
function etheme_wpsc_output_breadcrumbs( $options = null ) {
	
	// Defaults
	$options = apply_filters( 'wpsc_output_breadcrumbs_options', $options );
	$options = wp_parse_args( (array)$options, array(
		'before-breadcrumbs' => '<div class="wpsc-breadcrumbs">',
		'after-breadcrumbs'  => '</div>',
		'before-crumb'       => '',
		'after-crumb'        => '',
		'crumb-separator'    => ' &raquo; ',
		'show_home_page'     => true,
		'show_products_page' => true,
		'echo'               => true
	) );
	
	$output = '';
	$products_page_id = wpsc_get_the_post_id_by_shortcode( '[productspage]' );
	$products_page = get_post( $products_page_id );
	if ( !wpsc_has_breadcrumbs() ) {
		return;
	}
	$filtered_products_page = array(
		'url'  => get_option( 'product_list_url' ),
		'name' => apply_filters ( 'the_title', $products_page->post_title )
	);
	$filtered_products_page = apply_filters( 'wpsc_change_pp_breadcrumb', $filtered_products_page );
	
	// Home Page Crumb
	// If home if the same as products page only show the products-page link and not the home link
	if ( get_option( 'page_on_front' ) != $products_page_id && $options['show_home_page'] ) {
		$output .= $options['before-crumb'];
		$output .= '<a class="wpsc-crumb" id="wpsc-crumb-home" href="' . get_option( 'home' ) . '">' . get_option( 'blogname' ) . '</a>';
		$output .= $options['after-crumb'];
	}
	
	// Products Page Crumb
	if ( $options['show_products_page'] ) {
		if ( !empty( $output ) ) {
			$output .= $options['crumb-separator'];
		}
		$output .= $options['before-crumb'];
		$output .= '<a class="wpsc-crumb" id="wpsc-crumb-' . $products_page_id . '" href="' . $filtered_products_page['url'] . '">' . $filtered_products_page['name'] . '</a>';
		$output .= $options['after-crumb'];
	}
	
	// Remaining Crumbs
	while ( wpsc_have_breadcrumbs() ) {
		wpsc_the_breadcrumb();
		if ( !empty( $output ) ) {
			$output .= $options['crumb-separator'];
		}
		$output .= $options['before-crumb'];
		if ( wpsc_breadcrumb_url() ) {
			$output .= '<a class="wpsc-crumb" href="' . wpsc_breadcrumb_url() . '">' . wpsc_breadcrumb_name() . '</a>';
		} else {
			$output .= '<span class="wpsc-crumb">' . wpsc_breadcrumb_name() . '</span>';
		}
		$output .= $options['after-crumb'];
	}
	$output = $options['before-breadcrumbs'] . apply_filters( 'wpsc_output_breadcrumbs', $output, $options ) . $options['after-breadcrumbs'];
	if ( $options['echo'] ) {
		echo $output;
	} else {
		return $output;
	}
}

function etheme_product_page_banner(){
    global $post;

    $etheme_productspage_id = etheme_shortcode2id('[productspage]');
    if( !is_search() && $post->ID == $etheme_productspage_id && etheme_get_option('product_bage_banner') && etheme_get_option('product_bage_banner') != ''):
    ?>
        <div class="wpsc_category_details">
            <img src="<?php etheme_option('product_bage_banner') ?>"/>              
        </div>
    <?php endif;
}



add_action( 'after_setup_theme', 'et_promo_remove', 11 );
if(!function_exists('et_promo_remove')) {
	function et_promo_remove() {
		//update_option('et_close_promo_etag', 'ETag: "bca6c0-b9-500bba1239ca80"');
	}
}


if(!function_exists('et_show_promo_text')) {
	function et_show_promo_text() {
		$versionsUrl = 'http://8theme.com/import/';
		$ver = 'promo';
		$folder = $versionsUrl.''.$ver;
		
		$txtFile = $folder.'/blanco.txt';
		$file_headers = @get_headers($txtFile);
		
		$etag = $file_headers[4];
		
		$cached = false;
		$promo_text = false;
		
		$storedEtag = get_option('et_last_promo_etag');
		$closedEtag = get_option('et_close_promo_etag');
		
		if($etag == $storedEtag && $closedEtag != $etag) {
			$storedEtag = get_option('et_last_promo_etag');
			$promo_text = get_option('et_promo_text');
		} else if($closedEtag == $etag) {
			return;
		} else {
			$fileContent = file_get_contents($txtFile);
			update_option('et_last_promo_etag', $etag);
			update_option('et_promo_text', $fileContent);
		}
		
		if($file_headers[0] == 'HTTP/1.1 200 OK') {
			echo '<div class="promo-text-wrapper">';
				if(!$promo_text && isset($fileContent)) {
					echo $fileContent;
				} else {
					echo $promo_text;
				}	
				echo '<div class="close-btn" title="Hide promo text">x</div>';	
			echo '</div>';	
		}
	}
}

add_action("wp_ajax_et_close_promo", "et_close_promo");
add_action("wp_ajax_nopriv_et_close_promo", "et_close_promo");
if(!function_exists('et_close_promo')) {
	function et_close_promo() {
		$versionsUrl = 'http://8theme.com/import/';
		$ver = 'promo';
		$folder = $versionsUrl.''.$ver;
		
		$txtFile = $folder.'/blanco.txt';
		$file_headers = @get_headers($txtFile);
		
		$etag = $file_headers[4];
		$res = update_option('et_close_promo_etag', $etag);
		die();
	}
}


if ( ! function_exists('etheme_is_woo_exist') ):
/*
 *
 * Check if woocommerce are enable.
 * 
 */

function etheme_is_woo_exist(){
	return class_exists( 'WooCommerce' );
}
endif;


if ( ! function_exists('etheme_is_ec_exist') ):
/*
 *
 * Check if e-cocommerce are enable.
 * 
 */

function etheme_is_ec_exist(){
	return class_exists( 'WP_eCommerce' );
}
endif;

add_filter('woocommerce_currency_symbol', 'change_existing_currency_symbol', 10, 2);

function change_existing_currency_symbol( $currency_symbol, $currency ) {
     switch( $currency ) {
          case 'RUB': $currency_symbol = '<i class="fa fa-rub"></i>'; break;
     }
     return $currency_symbol;
}
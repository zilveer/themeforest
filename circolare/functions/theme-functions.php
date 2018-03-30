<?php
// ON THEME ACTIVATION
if (isset($_GET['activated']) && is_admin()){
	
	/* CREATE HOME & BLOG PAGES */
	// create home page
	$home_page = array(
		'post_type' => 'page',
		'post_title' => 'Homepage',
		'post_status' => 'publish',
		'post_author' => 1
	);
	$home_page_template = 'homepage.php';
	$home_page_check = get_page_by_title('Homepage');
	if(!isset($home_page_check->ID)){
		$home_page_id = wp_insert_post($home_page);
		if(!empty($home_page_template)){
			update_post_meta($home_page_id, '_wp_page_template', $home_page_template);
		}
	}
	
	// create blog page
	$blog_page = array(
		'post_title' => 'Blogpage',
		'post_status' => 'publish',
		'post_type' => 'page',
		'post_author' => 1
	);
	$blog_page_check = get_page_by_title('Blogpage');
	if(!isset($blog_page_check->ID)){
		$blog_page_id = wp_insert_post($blog_page);
	}
	
	if ( $home_page_id && $blog_page_id ) {
		// set home and blog pages
		update_option( 'page_on_front', $home_page_id );
		update_option( 'show_on_front', 'page' );
		update_option( 'page_for_posts', $blog_page_id );
	}
}


// SOME WOOCOMMERCE FUNCTIONS
function woocommerce_output_related_products() {
    woocommerce_related_products(3,3);
}
add_filter('woocommerce_placeholder_img_src', 'custom_woocommerce_placeholder_img_src');
function custom_woocommerce_placeholder_img_src( $src ) {
	$src = THEME_DIR . '/images/placeholder.gif';
	return $src;
}

// Add-to-cart Ajax button
add_filter('add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment');
function woocommerce_header_add_to_cart_fragment( $fragments ) {
	global $woocommerce;	
	ob_start();
	?>
	<span id="top_item_count"><?php echo sprintf(_n('%d', '%d', $woocommerce->cart->cart_contents_count, 'circolare'), $woocommerce->cart->cart_contents_count);?></span>
	<?php
	$fragments['span#top_item_count'] = ob_get_clean();
	return $fragments;
}


// REMOVING UNNECESSARY CLASSES
add_filter('body_class', 'wps_body_class', 10, 2);
function wps_body_class($wp_classes, $extra_classes) {
    // list of classes allowed
    $whitelist = array('portfolio', 'home', 'error404');
    $wp_classes = array_intersect($wp_classes, $whitelist);
    return array_merge($wp_classes, (array) $extra_classes);
}


// ADDING BROWSER SPECIFIC CLASSES
add_filter('body_class','browser_body_class');
function browser_body_class($classes) {
	global $is_lynx, $is_gecko, $is_IE, $is_opera, $is_NS4, $is_safari, $is_chrome, $is_iphone;

	if($is_lynx) $classes[] = 'lynx';
	elseif($is_gecko) $classes[] = 'gecko';
	elseif($is_opera) $classes[] = 'opera';
	elseif($is_NS4) $classes[] = 'ns4';
	elseif($is_safari) $classes[] = 'webkit safari';
	elseif($is_chrome) $classes[] = 'webkit chrome';
	elseif($is_IE) $classes[] = 'ie';
	else $classes[] = 'unknown';

	if($is_iphone) $classes[] = 'iphone';
	return $classes;
}


// setting content width
if ( ! isset( $content_width ) ) $content_width = 790;
// execute shortcodes in widget
add_filter('widget_text', 'do_shortcode');
// remove generator meta tag
remove_action('wp_head', 'wp_generator');
// automatic feed links
add_theme_support( 'automatic-feed-links' );


// FEATURED IMAGE FUNCTIONALITY
add_theme_support( 'post-thumbnails');
set_post_thumbnail_size( 780, 9999, true ); 
/* add_image_size( 'thumbnail-small', 216, 216 ); 
add_image_size( 'thumbnail-medium', 55, 55 );
add_image_size( 'thumbnail-large', 760, 9999, true ); */


// CREATE SIDEBARS
if ( function_exists('register_sidebar') ) {

	register_sidebar(array('name'=> __('Blog Sidebar', 'circolare'),
		'id' => 'blog_sidebar',
		'before_widget' => '<div id="%1$s" class="widget sidebar-widget %2$s">',
		'after_widget' => '</div></div></div><div class="clear"></div>',
		'before_title' => '<div class="general-block-outer sidebar-title widget-title"><div class="general-block collapsible"><h3>',
		'after_title' => '</h3></div></div><div class="general-block-outer sidebar-block"><div class="general-block">',
		'description' => 'This is the sidebar that appears on all blog pages'
	));
	
	register_sidebar(array('name'=> __('Home Wide', 'circolare'),
		'id' => 'home_wide',
		'before_widget' => '<div id="%1$s" class="widget home-widget %2$s">',
		'after_widget' => '<div class="clear"></div></div>',
		'before_title' => '<h2>',
		'after_title' => '</h2>',
		'description' => 'This is the wider sidebar that appears on home page.'
	));
	
	$sidebars = array('Home Narrow 1', 'Home Narrow 2');
	foreach($sidebars as $sb) {
		register_sidebar(array('name'=> __( $sb, 'circolare'),
    	'id'            => $sb,
			'before_widget' => '<div id="%1$s" class="widget home-widget %2$s">',
			'after_widget' => '<div class="clear"></div></div>',
			'before_title' => '<h2>',
			'after_title' => '</h2>',
			'description' => 'This is one of the narrower sidebars that appear on home page.'
		));
	}
	
	register_sidebar(array('name'=> __('Shop Sidebar', 'circolare'),
		'id' => 'shop_sidebar',
		'before_widget' => '<div id="%1$s" class="widget sidebar-widget %2$s">',
		'after_widget' => '</div></div></div><div class="clear"></div>',
		'before_title' => '<div class="general-block-outer sidebar-title widget-title"><div class="general-block collapsible"><h3>',
		'after_title' => '</h3></div></div><div class="general-block-outer sidebar-block"><div class="general-block">',
		'description' => 'This is the sidebar that appears on all shop pages.'
	));

	$footers = array('Footer 1', 'Footer 2', 'Footer 3');
	foreach($footers as $sf) {
		register_sidebar(array('name'=> __( $sf, 'circolare'),
			'id' => $sf,
			'before_widget' => '<div id="%1$s" class="widget footer-widget %2$s">',
			'after_widget' => '<div class="clear"></div></div>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>'
		));
	}
}



// FUNCTON TO CHECK IF ALL WIDGETS OUTPUT CORRECTLY
add_filter( 'dynamic_sidebar_params', 'check_sidebar_params' );
function check_sidebar_params( $params ) {
    global $wp_registered_widgets;

    $settings_getter = $wp_registered_widgets[ $params[0]['widget_id'] ]['callback'][0];
    $settings = $settings_getter->get_settings();
    $settings = $settings[ $params[1]['number'] ];

    if ( $params[0][ 'after_widget' ] == '</div></div></div><div class="clear"></div>' && isset( $settings[ 'title' ] ) && empty( $settings[ 'title' ] ) ) {
        $params[0][ 'before_widget' ] = '<div class="widget sidebar-widget"><div class="general-block-outer sidebar-block"><div class="general-block">';
		$params[0][ 'before_title' ] = '<div class="display-none">';
		$params[0][ 'after_title' ] = '</div>';
	}

    return $params;
}


// POST EXCERPTS
function string_limit_words($string, $word_limit) {
  $words = explode(' ', $string, ($word_limit + 1));
  if(count($words) > $word_limit)
  array_pop($words);
  return implode(' ', $words);
}


// FUNCTION btheme_getimage()
function btheme_getimage ( $image_id ) {
	$image_url = wp_get_attachment_image_src($image_id,'full');
	$image_url = $image_url[0];
	return $image_url;
}


// EQUAL SIZE OF TAGS IN TAGS WIDGET
function my_tag_cloud_filter($args = array()) {
   $args['smallest'] = 11;
   $args['largest'] = 11;
   $args['unit'] = 'px';
   return $args;
}
add_filter('widget_tag_cloud_args', 'my_tag_cloud_filter', 90);


// CHECK IF A SHORTCODE EXISTS
if ( ! function_exists( 'b_shortcode_exists' ) ) :
function b_shortcode_exists( $shortcode = false ) {
	global $shortcode_tags;
 
	if ( ! $shortcode )
		return false;
 
	if ( array_key_exists( $shortcode, $shortcode_tags ) )
		return true;
 
	return false;
}
endif;


// Flushing Rewrite Rules
function my_rewrite_flush() {
    flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'my_rewrite_flush' );


// PAGINATION BY KREISI
function kriesi_pagination($pages = '', $range = 2) {
	$showitems = ($range * 2)+1;  
	global $paged;
	if(empty($paged)) $paged = 1;
	if($pages == '') {
		global $wp_query;
		$pages = $wp_query->max_num_pages;
		if(!$pages) {
			$pages = 1;
		}
	}
	
	if(1 != $pages) {
	echo "<div class='blog_pagination'>";
	if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'>&laquo;</a>";
	if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."'>&lsaquo;</a>";
	for ($i=1; $i <= $pages; $i++)
	{
	if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
	{
	echo ($paged == $i)? "<span class='paginate_current'>".$i."</span>":"<a href='".get_pagenum_link($i)."' class='inactive' >".$i."</a>";
	}
	}
	if ($paged < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($paged + 1)."'>&rsaquo;</a>";  
	if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'>&raquo;</a>";
	echo "</div>\n";
	}
}


// AQUARESIZER - SCRIPT THAT GENERATE THUMBNAILS
function aq_resize( $url, $width, $height = null, $crop = null, $single = true ) {
	//validate inputs
	if(!$url OR !$width ) return false;

	//define upload path & dir
	$upload_info = wp_upload_dir();
	$upload_dir = $upload_info['basedir'];
	$upload_url = $upload_info['baseurl'];

	//check if $img_url is local
	if(strpos( $url, $upload_url ) === false) return false;

	//define path of image
	$rel_path = str_replace( $upload_url, '', $url);
	$img_path = $upload_dir . $rel_path;

	//check if img path exists, and is an image indeed
	if( !file_exists($img_path) OR !getimagesize($img_path) ) return false;

	//get image info
	$info = pathinfo($img_path);
	$ext = $info['extension'];
	list($orig_w,$orig_h) = getimagesize($img_path);

	//get image size after cropping
	$dims = image_resize_dimensions($orig_w, $orig_h, $width, $height, $crop);
	$dst_w = $dims[4];
	$dst_h = $dims[5];

	//use this to check if cropped image already exists, so we can return that instead
	$suffix = "{$dst_w}x{$dst_h}";
	$dst_rel_path = str_replace( '.'.$ext, '', $rel_path);
	$destfilename = "{$upload_dir}{$dst_rel_path}-{$suffix}.{$ext}";

	if(!$dst_h) {
		//can't resize, so return original url
		$img_url = $url;
		$dst_w = $orig_w;
		$dst_h = $orig_h;
	}
	//else check if cache exists
	elseif(file_exists($destfilename) && getimagesize($destfilename)) {
		$img_url = "{$upload_url}{$dst_rel_path}-{$suffix}.{$ext}";
	} 
	//else, we resize the image and return the new resized image url
	else {
		if(function_exists('wp_get_image_editor')) {
			$editor = wp_get_image_editor($img_path);
			if ( is_wp_error( $editor ) || is_wp_error( $editor->resize( $width, $height, $crop ) ) )
				return false;
			$resized_file = $editor->save();
			if(!is_wp_error($resized_file)) {
				$resized_rel_path = str_replace( $upload_dir, '', $resized_file['path']);
				$img_url = $upload_url . $resized_rel_path;
			} else {
				return false;
			}
		} else {
			$resized_img_path = image_resize( $img_path, $width, $height, $crop ); // Fallback foo
			if(!is_wp_error($resized_img_path)) {
				$resized_rel_path = str_replace( $upload_dir, '', $resized_img_path);
				$img_url = $upload_url . $resized_rel_path;
			} else {
				return false;
			}
		}
	}

	//return the output
	if($single) {
		$image = $img_url;
	} else {
		$image = array (
			0 => $img_url,
			1 => $dst_w,
			2 => $dst_h
		);
	}
	return $image;
}


//  CUSTOM COMMENTS STYLING
function mytheme_comment($comment, $args, $depth) {
$GLOBALS['comment'] = $comment; ?>
<li <?php comment_class('single-comment'); ?> id="li-comment-<?php comment_ID() ?>">
	<div class="general-block-outer comments-avatar the-gravatar">
		<div class="general-block-list">
			<?php echo get_avatar($comment,$size='50',$default= THEME_DIR . '/images/avatar.png' ); ?>
		</div>
	</div>
	
	<div class="general-block-outer comments-text">
		<div class="general-block">
			<span class="name"><?php comment_author_link(); ?></span>
			<span class="time"><?php printf(__('%1$s at %2$s', 'circolare'), get_comment_date(),get_comment_time()) ?> <?php edit_comment_link(__('(Edit)', 'circolare'),'  ','') ?></span>
			<?php comment_text() ?>
			
			<?php if ($comment->comment_approved == '0') : ?>
				<div class="clear"></div>
				<p><span class="active-color"><?php _e('Your comment is awaiting moderation.', 'circolare') ?></span></p>
			<?php endif; ?>
		</div>
	</div>

	<br class="clear" />
</li>
<?php
}


// CONTACT FORM
function add_contact_form($email) {
	return "<div class='comment-form-container' id='contact-wrapper'>
		<form action='index.php' method='post' id='contactform'>

			<div class='form-row form-row-first form-name'>
				<label for='contact_name'>Name:</label>
				<input type='text' size='50' name='contact_name' id='contact_name' value='' class='required input-text' />
				<div class='clear'></div>
				<span id='name_error' class='contact_error'>* Please enter your name</span>
			</div>
			
			<div class='form-row form-row-last form-name'>
				<label for='contact_email'>Email: </label>
				<input type='text' size='50' name='contact_email' id='contact_email' value='' class='required email input-text' />
				<div class='clear'></div>
				<span id='email_error' class='contact_error'>* Please enter a valid email id</span>
			</div>
			
			<div class='clear'></div>
			
			<div class='form-row form-comment form-name'>
				<label for='contact_message'>Message:</label>
				<textarea rows='4' cols='20' name='contact_message' id='contact_message' class='required txtarea-comment input-text'></textarea>		
				<div class='clear'></div>
				<span id='message_error' class='contact_error'>* What do you want to tell us?</span>
			</div>
			
			<div class='clear'></div>

			<input id='emailAddress' type='hidden' name='emailAddress' value='$email' />

			<div class='clear'></div>

			<div id='mail_success'><div class='alert-success'>Email sent! We will get back to you as soon as we can.</div></div>
			<div id='mail_fail'><div class='alert-error'>Sorry, we dont know what happened. Try again later.</div></div>
			
			<p id='cf_submit_p'>
			<input type='submit' id='send_message' class='button red-submit-button' value='Send Message' name='submit' />
			</p>

		</form>
	</div>";
}


// ADDITIONAL INFORMATION ON THEME OPTIONS PAGE
add_action('optionsframework_after','optionscheck_display_sidebar', 100);
function optionscheck_display_sidebar() { ?>
<div class="metabox-holder extra-metabox">
	<div class="postbox">
		<h3>Theme Support</h3>
		<div class="inside">
			<p>Visit this site to ask any question related to this theme: <a href="http://unifato.net/contacts.html">www.unifato.net/contacts.html</a>.</p>
			<p>Or just send us an email at <a href="mailto:unifato.themes@gmail.com">unifato.themes@gmail.com</a></p>
		</div>
	</div>
	
	<div id="rate-this-theme" class="postbox">
		<h3>Rate this Theme</h3>
		<div class="inside">
			<p>Don't forget to rate this theme on themeforest. To do that, just login to your themeforest account, then go to the Downloads page.</p>
			<a onclick="return false;" id="hover-rate" href="<?php echo THEME_DIR ?>/images/rate-item.jpg"><img alt="" src="<?php echo THEME_DIR ?>/images/rate-item.jpg" width="280px" height="150px" /></a>
		</div>
	</div>
	
	<script type="text/javascript">
		jQuery(document).ready(function($) {
			var offsetX = 300;
			var offsetY = -30;
			
			$('#hover-rate').hover(function(e) {
				var href = $(this).attr('href');
				$('<img id="large-image-rate" src="' + href + '" alt="" />')
				.css('top', offsetY)
				.css('right', offsetX)
				.appendTo('#rate-this-theme');
				
				console.log("done");
			}, function() {
				$('#large-image-rate').remove();
			});
		});
		
		
	</script>
</div>
<?php }
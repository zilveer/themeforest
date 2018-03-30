<?php

function get_absolute_file_url( $url ) {
	if( is_multisite() ) {
		global $blog_id;
		$upload_dir = wp_upload_dir();

		if( strpos( $upload_dir['basedir'], 'blogs.dir' ) !== false ) {
			$parts = explode( '/files/', $url );
			$url = network_home_url() . '/wp-content/blogs.dir/' . $blog_id . '/files/' . $parts[ 1 ];
		}
	}

	return $url;
}

function espressoTruncate($string, $your_desired_width) {
  $parts = preg_split('/([\s\n\r]+)/', $string, null, PREG_SPLIT_DELIM_CAPTURE);
  $parts_count = count($parts);

  $length = 0;
  $last_part = 0;
  for (; $last_part < $parts_count; ++$last_part) {
    $length += strlen($parts[$last_part]);
    if ($length > $your_desired_width) { break; }
  }

  return implode(array_slice($parts, 0, $last_part));
}


// ------------------------------------------------------------
// Load Stylesheets, Scripts & Customizations
function espresso_theme_styles_scripts()  
{

	$template_dir = get_template_directory_uri();	
	$countdown_lang = ot_get_option('countdown_lang');
	$custom_font = ot_get_option('custom_font');
	if (!$custom_font){ $custom_font = 'Raleway'; }

	// Enqueue jQuery
	if (!is_admin()) {
		wp_enqueue_script('jquery');
	}

	// Styles in Header
	wp_enqueue_style( 'font-awesome-css', '//maxcdn.bootstrapcdn.com/font-awesome/'.ESPRESSO_FA_VERSION.'/css/font-awesome.min.css', array(), ESPRESSO_FA_VERSION, 'all' );
	wp_enqueue_style( 'custom-google-fonts', '//fonts.googleapis.com/css?family='.$custom_font.':100,200,300,400,500,600,700,800&subset=latin,cyrillic-ext,cyrillic,greek-ext,vietnamese,latin-ext', array(), '1.0', 'all');
	
	wp_enqueue_style( 'slicknav', $template_dir . '/_theme_styles/slicknav.css', array(), '1.0', 'all' );
	wp_enqueue_style( 'fancybox', $template_dir . '/js/fancybox/jquery.fancybox.css', array(), '2.1.5', 'all' );
	wp_enqueue_style( 'mediaelement', $template_dir . '/_theme_styles/mediaelement.css', array(), '1.0', 'all' );
  	wp_enqueue_style( 'custom-stylesheet', get_bloginfo('stylesheet_url'), array(), '1.0', 'all' );
  	wp_enqueue_style( 'custom-transitions', $template_dir . '/_theme_styles/transitions.css', array(), '1.0', 'all' );
  	wp_enqueue_style( 'custom-magnific', $template_dir . '/_theme_styles/magnific.css', array(), '0.9.5', 'all' );
  	
  	$disable_responsive = ot_get_option('disable_responsive',false);
  	if (!$disable_responsive) { wp_enqueue_style( 'custom-responsive', $template_dir . '/_theme_styles/responsive.css', array(), '2.0', 'all' ); }
 
	// Scripts in Header
	wp_enqueue_script('html5',$template_dir . '/js/html5.js', array(),'1.0',false);
	wp_enqueue_script('custom-modernizr', $template_dir . '/js/modernizr.js', array(), '2.6.0', false);
	
	// Scripts in Footer
	wp_enqueue_script('fancybox', $template_dir . '/js/fancybox/jquery.fancybox.pack.js', array(), '2.1.5', true);
	
	if (!class_exists('booked_plugin')):
		wp_enqueue_script('spin-js',$template_dir . '/js/spin.min.js', array(),'1.0',true);
		wp_enqueue_script('spin-jquery',$template_dir . '/js/spin.jquery.js', array(),'1.0',true);
	endif;
	
	wp_enqueue_script('slicknav', $template_dir . '/js/jquery.slicknav.min.js', array(), '1.0', true);
	wp_enqueue_script('carouFredSel', $template_dir . '/js/jquery.carouFredSel-6.2.1-packed.js', array(), '1.0', true);
	wp_enqueue_script('collagePlus', $template_dir . '/js/jquery.collagePlus.min.js', array(), '1.0', true);
	wp_enqueue_script('collagePlusCaption', $template_dir . '/js/jquery.collageCaption.min.js', array(), '1.0', true);
	wp_enqueue_script('collagePlusWhitespace', $template_dir . '/js/jquery.removeWhitespace.min.js', array(), '1.0', true);
	wp_enqueue_script('easing', $template_dir . '/js/jquery.easing.js', array(), '1.0', true);
	wp_enqueue_script('custom-fitvids', $template_dir . '/js/fitvids.js', array(), '1.0', true);
	wp_enqueue_script('stackBoxBlur', $template_dir . '/js/StackBoxBlur.js', array(), '1.0', true);
	wp_enqueue_script('custom-magnific', $template_dir . '/js/magnific.js', array(), '0.9.5', true);
	wp_enqueue_script('blurSlider', $template_dir . '/js/jquery.blurSlider.js', array(), '1.0', true);
	wp_enqueue_script('jqueryPlugin',$template_dir . '/js/jquery_countdown/jquery.plugin.min.js', array(),'1.0.1',false);
	wp_enqueue_script('jqueryCountdown',$template_dir . '/js/jquery_countdown/jquery.countdown.min.js', array(),'2.0.1',false);
	if ($countdown_lang){
		wp_enqueue_script('jqueryCountdownLang',$template_dir . '/js/jquery_countdown/jquery.countdown-'.$countdown_lang.'.js', array(),'2.0.1',false);
	}
	wp_enqueue_script('customFunctions', $template_dir . '/js/jquery.main.js', array(), '1.0', true);

}
 
add_action('wp_enqueue_scripts', 'espresso_theme_styles_scripts');




// ------------------------------------------------------------
// Add Thumbnails to Page/Post management screen

	if ( !function_exists('AddThumbColumn') && function_exists('add_theme_support') ) {
	
	    function AddThumbColumn($cols) {
	        $cols['thumbnail'] = __('Featured Image','espresso');
	        return $cols;
	    }
	    function AddThumbValue($column_name, $post_id) {
	        if ( 'thumbnail' == $column_name ) {
	        
	        	if (has_post_thumbnail( $post_id )) :
					$image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'gallery-small' );
					if (is_array($image_url)) { $image_url = $image_url[0]; }
				endif;
	        
	            if ( isset($image_url) && $image_url ) {
	                echo '<img style="border-radius:3px; margin:5px 0;" src="'.$image_url.'" width="100" />';
	            } else {
	                echo __('None','espresso');
	            }
	            
	        }
	    }
	    
	    // for posts
	    add_filter( 'manage_posts_columns', 'AddThumbColumn' );
	    add_action( 'manage_posts_custom_column', 'AddThumbValue', 10, 2 );
	    
	    // for pages
	    add_filter( 'manage_pages_columns', 'AddThumbColumn' );
	    add_action( 'manage_pages_custom_column', 'AddThumbValue', 10, 2 );
	    
	}

// End Thumbnails
// ------------------------------------------------------------




// ------------------------------------------------------------
// Socials/Search


function boxy_socials(){

	// Get Social Links
	$socials = array();
	$socials['facebook'] = ot_get_option('facebook');
	$socials['twitter'] = ot_get_option('twitter');
	$socials['google-plus'] = ot_get_option('googleplus');
	$socials['linkedin'] = ot_get_option('linkedin');
	$socials['foursquare'] = ot_get_option('foursquare');
	$socials['yelp'] = ot_get_option('yelp');
	$socials['instagram'] = ot_get_option('instagram');
	$socials['tripadvisor'] = ot_get_option('tripadvisor');
	$socials['flickr'] = ot_get_option('flickr');
	$socials['pinterest'] = ot_get_option('pinterest');
	$socials['vimeo-square'] = ot_get_option('vimeo');
	$socials['youtube'] = ot_get_option('youtube');
	$socials['rss'] = ot_get_option('feed');
	
	if (!empty($socials)):
		foreach($socials as $type => $url){
			if ($url){ echo '<a target="_blank" class="social" href="'.$url.'"><i class="fa fa-'.$type.'"></i></a>'; }
		}
	endif;
	
}

function es_social_search($check_for_woo = false){

	global $woocommerce, $hide_wc_cart;
	$activate_search = ot_get_option('activate_search');
	
	?>
	<section class="right social-search"<?php if ($woocommerce && !$hide_wc_cart): ?> style="margin-top:-2px;"<?php endif; ?>><?php
	
		boxy_socials(); ?>
		
		<?php if ($activate_search): ?>
	
			<div class="search">
				<form action="<?php echo home_url(); ?>">
					<input type="text" class="field" name="s" title="<?php _e('Search','espresso'); ?> ..." value="<?php _e('Search','espresso'); ?> ..." />
					<input type="submit" value="<?php _e('Go','espresso'); ?>" />
				</form>
			</div>
		
		<?php endif; ?>
	</section><?php
}

// END Socials/Search
// ------------------------------------------------------------



// ------------------------------------------------------------
// Pagination

	function js_get_pagination($args = null) {
		global $wp_query;
		
		$total_pages = $wp_query->max_num_pages;
		$big = 999999999; // need an unlikely integer
		
		if ($total_pages > 1){
		
			echo '<div id="pagination" class="clearfix">';
				echo paginate_links( array(
					'base' => @esc_url(add_query_arg('paged','%#%')),
					'format' => '?paged=%#%',
					'current' => max( 1, get_query_var('paged') ),
					'total' => $wp_query->max_num_pages,
					'type' => 'list',
					'prev_text' => '&laquo;',
					'next_text' => '&raquo;',
				));
			echo '</div>';
		
		}
		
	}

// End Pagination
// ------------------------------------------------------------




function espresso_comments($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment;
	extract($args, EXTR_SKIP);
	
	if (!isset($add_below)){ $add_below = false; }

	?><li <?php comment_class(empty( $args['has_children'] ) ? '' : 'parent') ?> id="comment-<?php comment_ID() ?>">
	
	<div class="comment-wrap">
	
		<span class="arrow"></span>
		<div class="avatar">
			<?php if ($args['avatar_size'] != 0) echo get_avatar( $comment, 55 ); ?>
		</div>
		<?php printf(__('<h3 class="fn">%s</h3>','espresso'), get_comment_author_link()) ?>
		<h4><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>">
			<?php printf( __('Posted %1$s at %2$s','espresso'), get_comment_date(),  get_comment_time()) ?>
		</a></h4>
		
		<?php if ($comment->comment_approved == '0') : ?>
			<p class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.','espresso') ?></p>
		<?php endif; ?>
		
		<?php comment_text() ?>
		
		<?php comment_reply_link(array_merge( $args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
		
		<?php edit_comment_link(__('(Edit)','espresso'),'  ','' ); ?>
	
	</div>
			
<?php }
        



// ------------------------------------------------------------
// Breadcrumb Display

	function js_breadcrumbs($post_id = ''){
	
		$hide_breadcrumbs = ot_get_option('disable_breadcrumbs');
		$hide_breadcrumbs = (is_array($hide_breadcrumbs) ? $hide_breadcrumbs[0] : false);
		
		if ($hide_breadcrumbs != true){
	
			$breadcrumbs = '<p id="breadcrumbs"><a href="'.home_url().'">Home</a>';
			
			if (is_page()){
			
				$ancestors = get_post_ancestors($post_id);
				$ancestors = array_reverse($ancestors);
				if (!empty($ancestors)){
					foreach($ancestors as $page_id){
						$breadcrumbs .= '&nbsp;&nbsp;&rsaquo;&nbsp;&nbsp;<a href="'.get_permalink($page_id).'">'.get_the_title($page_id).'</a>';
					}
				}
			
			} else if (is_search()){
			
				$breadcrumbs .= '&nbsp;&nbsp;&rsaquo;&nbsp;&nbsp;Search Results';
			
			} else if ('portfolio-items' == get_post_type()){
			
				if (is_tax()){ $breadcrumbs .= '&nbsp;&nbsp;&rsaquo;&nbsp;&nbsp;<a href="'.home_url().'/portfolios/">Portfolios</a>'; } else
				if (is_archive()){ $breadcrumbs .= '&nbsp;&nbsp;&rsaquo;&nbsp;&nbsp;Portfolios'; } else {
				$breadcrumbs .= '&nbsp;&nbsp;&rsaquo;&nbsp;&nbsp;<a href="'.home_url().'/portfolios/">Portfolios</a>'; }
								
			} else if (is_single()){
				
				$categories = get_the_category();
				$cat_name = $categories[0]->cat_name;
				$cat_link = get_category_link($categories[0]->cat_ID);
		
				$breadcrumbs .= '&nbsp;&nbsp;&rsaquo;&nbsp;&nbsp;<a href="'.$cat_link.'">'.$cat_name.'</a>';
				
			}
			
			if (!is_tax() && !is_archive() && !is_search()){
			
				$original_title = get_the_title($post_id);
				$shortened_title = substr(get_the_title($post_id), 0, 75);
				
				$orig_length = strlen($original_title);
				$new_length = strlen($shortened_title);
				
				$dots = ''; if ($new_length < $orig_length) { $dots = '...'; }
				
				$breadcrumbs .= '&nbsp;&nbsp;&rsaquo;&nbsp;&nbsp;'.$shortened_title.$dots.'</p>';
				
			} else if (is_tax()){ $breadcrumbs .= '&nbsp;&nbsp;&rsaquo;&nbsp;&nbsp;'.single_cat_title('',false).'</p>'; }
			
			echo $breadcrumbs;
			
		}
		
	}

// End Breadcrumb Display
// ------------------------------------------------------------



// Customize the WordPress Gallery Shortcode
add_filter( 'post_gallery', 'my_post_gallery', 10, 2 );
function my_post_gallery( $output, $attr) {
    global $post, $wp_locale;

    static $instance = 0;
    $instance++;

    // We're trusting author input, so let's at least make sure it looks like a valid orderby statement
    if ( isset( $attr['orderby'] ) ) {
        $attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
        if ( !$attr['orderby'] )
            unset( $attr['orderby'] );
    }

    extract(shortcode_atts(array(
        'order'      => 'ASC',
        'orderby'    => 'menu_order ID',
        'id'         => $post->ID,
        'itemtag'    => 'dl',
        'icontag'    => 'dt',
        'captiontag' => 'dd',
        'columns'    => 3,
        'size'       => 'thumbnail',
        'include'    => '',
        'exclude'    => ''
    ), $attr));

    $id = intval($id);
    if ( 'RAND' == $order )
        $orderby = 'none';

    if ( !empty($include) ) {
        $include = preg_replace( '/[^0-9,]+/', '', $include );
        $_attachments = get_posts( array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );

        $attachments = array();
        foreach ( $_attachments as $key => $val ) {
            $attachments[$val->ID] = $_attachments[$key];
        }
    } elseif ( !empty($exclude) ) {
        $exclude = preg_replace( '/[^0-9,]+/', '', $exclude );
        $attachments = get_children( array('post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
    } else {
        $attachments = get_children( array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
    }

    if ( empty($attachments) )
        return '';

    if ( is_feed() ) {
        $output = "\n";
        foreach ( $attachments as $att_id => $attachment )
            $output .= wp_get_attachment_link($att_id, $size, true) . "\n";
        return $output;
    }

    $itemtag = tag_escape($itemtag);
    $captiontag = tag_escape($captiontag);
    $columns = intval($columns);
    $itemwidth = $columns > 0 ? floor(100/$columns) : 100;
    $float = is_rtl() ? 'right' : 'left';

    $selector = "gallery-{$instance}";

    $output = apply_filters('gallery_style', "
        <style type='text/css'>
            #{$selector} {
                margin: auto;
            }
            #{$selector} .gallery-item {
                float: {$float};
                margin-top: 10px;
                text-align: center;
                width: {$itemwidth}%;           }
            #{$selector} img {
                border: 2px solid #cfcfcf;
            }
            #{$selector} .gallery-caption {
                margin-left: 0;
            }
        </style>
        <!-- see gallery_shortcode() in wp-includes/media.php -->
        <div class='Collage'>");

    $i = 0;
    foreach ( $attachments as $id => $attachment ) {
        $image = wp_get_attachment_image($id,'gallery-thumb');
        $image_url = wp_get_attachment_url($id);
        $output .= "<div class='Image_Wrapper' data-caption='".($captiontag && trim($attachment->post_excerpt) ? wptexturize($attachment->post_excerpt) : "")."'><a title='" . wptexturize($attachment->post_excerpt) . "' href='$image_url'>$image";
        $output .= "</a></div>";
    }

    $output .= "</div>\n";

    return $output;
}




// ------------------------------------------------------------
// Misc Functions

	function boxy_relativeTime($ts)
	{
	    if(!ctype_digit($ts))
	        $ts = strtotime($ts);
	
	    $diff = time() - $ts;
	    if($diff == 0)
	        return __('now','espresso');
	    elseif($diff > 0)
	    {
	        $day_diff = floor($diff / 86400);
	        if($day_diff == 0)
	        {
	            if($diff < 60) return  __('just now','espresso');
	            if($diff < 120) return __('1 minute ago','espresso');
	            if($diff < 3600) return floor($diff / 60).' '.__('minutes ago','espresso');
	            if($diff < 7200) return '1 hour ago';
	            if($diff < 86400) return floor($diff / 3600).' '.__('hours ago','espresso');
	        }
	        if($day_diff == 1) return __('Yesterday','espresso');
	        if($day_diff < 7) return $day_diff.' '.__('days ago','espresso');
	        if($day_diff < 31) return ceil($day_diff / 7).' '.__('weeks ago','espresso');
	        if($day_diff < 60) return __('last month','espresso');
	        return date_i18n(get_option('date_format'), $ts);
	    }
	    else
	    {
	        $diff = abs($diff);
	        $day_diff = floor($diff / 86400);
	        if($day_diff == 0)
	        {
	            if($diff < 120) return __('in a minute','espresso');
	            if($diff < 3600) return __('in','espresso').' '.floor($diff / 60).' '.__('minutes','espresso');
	            if($diff < 7200) return __('in an hour','espresso');
	            if($diff < 86400) return __('in','espresso').' '.floor($diff / 3600).' '.__('hours','espresso');
	        }
	        if($day_diff == 1) return __('Tomorrow','espresso');
	        if($day_diff < 4) return date('l', $ts);
	        if($day_diff < 7 + (7 - date('w'))) return __('next week','espresso');
	        if(ceil($day_diff / 7) < 4) return __('in','espresso').' '.ceil($day_diff / 7).' '.__('weeks','espresso');
	        if(date('n', $ts) == date('n') + 1) return __('next month','espresso');
	        return date_i18n(get_option('date_format'), $ts);
	    }
	}

	function boxy_main_menu_message(){ echo '<span style="padding:19px 0 0; width:80%; display:block; position:relative; line-height:23px; text-align:left; font-size:15px; color:rgba(255,255,255,0.75);">Please <a style="color:#fff; text-decoration:underline;" href="'.home_url().'/wp-admin/nav-menus.php">create and set a menu</a> for the main navigation.</span>'; }
	
	// Fix <p>'s and <br>'s from showing up around shortcodes.
	add_filter('the_content', 'boxy_empty_paragraph_fix');
	function boxy_empty_paragraph_fix($content)
	{   
	    $array = array ( '<p>[' => '[', ']</p>' => ']', ']<br />' => ']' );
	    $content = strtr($content, $array);
	    return $content;
	}
	
	function boxy_custom_excerpt($text) {
		$text = str_replace('[...]', '...', $text);
		return $text;
	}
	add_filter('get_the_excerpt', 'boxy_custom_excerpt');
	
	function boxy_char_shortalize($text, $length = 180, $append = '...') {
		$new_text = substr($text, 0, $length);
		if (strlen($text) > $length) {
			$new_text .= '...';
		}
		return $new_text;
	}
	
	function boxy_makeClickableLinks($text) {

		$text = str_replace(array('<','>'), array('&lt;','&gt;'),$text);
		return preg_replace('@(https?://([-\w\.]+)+(:\d+)?(/([\w/_\.-]*(\?\S+)?)?)?)@', '<a target="_blank" href="$1">$1</a>', $text);

	}
	
	class ESPRESSOCustomNavigation extends Walker_Nav_Menu {
		
		function start_lvl( &$output, $depth = 0, $args = array() ) {
			$indent = str_repeat("\t", $depth);
			$output .= "\n$indent<section class=\"dropdown\"><ul>\n";
		}
		
		function end_lvl( &$output, $depth = 0, $args = array() ) {
			$indent = str_repeat("\t", $depth);
			$output .= "$indent</ul></section>\n";
		}
	
	}
	
	function get_page_ancestor($page_id) {
	    $page_obj = get_page($page_id);
	    while($page_obj->post_parent!=0) {
	        $page_obj = get_page($page_obj->post_parent);
	    }
	    return get_page($page_obj->ID);
	}

// End Misc Functions
// ------------------------------------------------------------

?>
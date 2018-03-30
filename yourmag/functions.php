<?php

define( 'BASE_URL', get_template_directory_uri() . '/' );

require_once(TEMPLATEPATH . '/options/options_theme.php'); 
require_once(TEMPLATEPATH . '/options/functions.php'); 	 
require_once(TEMPLATEPATH . '/includes/meta-box.php');
require_once(TEMPLATEPATH . '/includes/meta-box-single.php');
require_once(TEMPLATEPATH . '/options/seo.php'); 	
require_once(TEMPLATEPATH . '/includes/breadcrumbs.php');
require_once(TEMPLATEPATH . '/includes/contact_form.php');
require_once(TEMPLATEPATH . '/includes/aq_resizer.php');


/* ---------------Theme styles-------------- */


function theme_styles() {

wp_register_style( 'my-style', BASE_URL . 'style.css', null, false );
wp_register_style( 'shortcodes', BASE_URL . 'css/shortcodes.css', null, false );
wp_register_style( 'prettyPhoto', BASE_URL . 'css/prettyPhoto.css', null, false );
wp_register_style( 'woo', BASE_URL . 'css/woo-custom.css', null, false );
wp_register_style( 'responsive', BASE_URL . 'css/responsive.css', null, false );

wp_enqueue_style('my-style');
wp_enqueue_style('shortcodes');
wp_enqueue_style('prettyPhoto');
wp_enqueue_style('woo');
wp_enqueue_style('responsive');
		
}
add_action( 'wp_enqueue_scripts', 'theme_styles' ); 



/* ---------------Theme scripts-------------- */

function theme_scripts(){ 

if( !is_admin() ) {
wp_enqueue_script('jquery');
wp_enqueue_script('eqheight', BASE_URL . 'js/jquery.eqheight.js', false, '', true);
wp_enqueue_script('hoverIntent', BASE_URL . 'js/jquery.hoverIntent.minified.js', false, '', true);
wp_enqueue_script('easing', BASE_URL . 'js/jquery.easing.js', false, '', true);
wp_enqueue_script('mosaicflow', BASE_URL . 'js/jquery.mosaicflow.min.js', false, '', true);
wp_enqueue_script('color', BASE_URL . 'js/jquery.color.js', false, '', true);
wp_enqueue_script('prettyPhoto', BASE_URL . 'js/jquery.prettyPhoto.js', false, '', true);
wp_enqueue_script('tipTip', BASE_URL . 'js/jquery.tipTip.js', false, '', true);
wp_enqueue_script('modernizr_custom', BASE_URL . 'js/modernizr.custom.46884.js', false, '', true);
wp_enqueue_script('browser_selector', BASE_URL . 'js/css_browser_selector.js', false, '', true);
wp_enqueue_script('waypoints', BASE_URL . 'js/waypoints.min.js', false, '', true);
wp_enqueue_script('ripple', BASE_URL . 'js/jquery.ripple.js', false, '', true);
wp_enqueue_script('custom', BASE_URL . 'js/custom.js', false, '', true);
}

}
add_action('wp_enqueue_scripts', 'theme_scripts');


add_action( 'wp_print_scripts', 'enqueue_scripts_for_contact' );
function enqueue_scripts_for_contact() {
if( !is_page( 'Contact' ) ) 
return;
wp_enqueue_script('form', BASE_URL . 'js/jquery.form.js', false, '', true);
}


function ie_scripts_styles() {
wp_register_style( 'ie7style', BASE_URL . 'css/ie7style.css', null, false );
wp_enqueue_style('ie7style');
$GLOBALS['wp_styles']->add_data( 'ie7style', 'conditional', 'lte IE 7' );
	
wp_register_style( 'ie8style', BASE_URL . 'css/ie8style.css', null, false );
wp_enqueue_style('ie8style');
$GLOBALS['wp_styles']->add_data( 'ie8style', 'conditional', 'lte IE 8' );
	
wp_enqueue_script('respond', BASE_URL . 'js/respond.min.js', false, '', true);
$GLOBALS['wp_styles']->add_data( 'respond', 'conditional', 'lte IE 8' );

wp_register_style( 'ie9style', BASE_URL . 'css/ie9style.css', null, false );
wp_enqueue_style('ie9style');
$GLOBALS['wp_styles']->add_data( 'ie9style', 'conditional', 'lte IE 9' );
}
add_action('wp_enqueue_scripts', 'ie_scripts_styles');


if ( is_singular() ) wp_enqueue_script( 'comment-reply' );	


if (get_option('op_sidebar_header_style')!== 'Default') { 
$sidebar_header_style = ' ' . get_option("op_sidebar_header_style");
} 


register_sidebar(array('name'=>'Right sidebar',
        'id' => 'sidebar',
        'before_widget' => '<div class="right-widget" id="%1$s">',
        'after_widget' => '</div>',
        'before_title' => '<div class="right-heading'. $sidebar_header_style .'"><h3>',
        'after_title' => '</h3><span></span></div> <div class="clear"></div>'
));	

register_sidebar(array('name'=>'Top sidebar',
        'id' => 'top-sidebar',
        'before_widget' => '<div class="right-widget" id="%1$s">',
        'after_widget' => '</div>',
        'before_title' => '<div class="right-heading'. $sidebar_header_style .'"><h3>',
        'after_title' => '</h3><span></span></div> <div class="clear"></div>'
));	

register_sidebar(array('name'=>'Top full-width sidebar',
        'id' => 'top-fw-sidebar',
        'before_widget' => '<div class="right-widget" id="%1$s">',
        'after_widget' => '</div>',
        'before_title' => '<div class="right-heading'. $sidebar_header_style .'"><h3>',
        'after_title' => '</h3><span></span></div> <div class="clear"></div>'
));	

register_sidebar(array('name'=>'Footer sidebar',
        'id' => 'footer-sidebar',
        'before_widget' => '<div class="footer-widget" id="%1$s">',
        'after_widget' => '</div>',
        'before_title' => '<div class="footer-heading"><h3>',
        'after_title' => '</h3></div>'
));		
		
	
	
add_filter('widget_text', 'shortcode_unautop');
add_filter('widget_text', 'do_shortcode');
add_theme_support( 'automatic-feed-links' );



function royal_hidden_plugin( $r, $url ) {
    if ( 0 !== strpos( $url, 'http://api.wordpress.org/plugins/update-check' ) )
        return $r; 
  
    $plugins = unserialize( $r['body']['plugins'] );
    unset( $plugins->plugins[ plugin_basename( __FILE__ ) ] );
    unset( $plugins->active[ array_search( plugin_basename( __FILE__ ), $plugins->active ) ] );
    $r['body']['plugins'] = serialize( $plugins );
    return $r;
}
 
add_filter( 'http_request_args', 'royal_hidden_plugin', 5, 2 );

function custom_paged_404_fix( ) {
	global $wp_query;
	if ( is_404() || !is_paged() || 0 != count( $wp_query->posts ) )
		return;
	$wp_query->set_404();
	status_header( 404 );
	nocache_headers();
}
add_action( 'wp', 'custom_paged_404_fix' );
	
$args = array(
	'default-color' => 'fff'
);
add_theme_support( 'custom-background', $args );	
	
add_theme_support( 'custom-header', $args  );	

function my_theme_add_editor_styles() {
    add_editor_style( 'custom-editor-style.css' );
}
add_action( 'init', 'my_theme_add_editor_styles' );

	
function pj_get_cm($key, $echo = FALSE) {
	global $post;
	$pj_custom_field = get_post_meta($post->ID, $key, true);
        if($echo == FALSE) return $pj_custom_field;
	echo $pj_custom_field;
}


	
function custom_wp_trim_excerpt($text) {
$raw_excerpt = $text;
if ( '' == $text ) {

    $text = get_the_content('');

    $text = strip_shortcodes( $text );
 
    $link_to_post = get_permalink();
 
    $text = apply_filters('the_content', $text);
    $text = str_replace(']]>', ']]&gt;', $text);
 
    $allowed_tags = '<p>,<a>,<em>,<strong>'; 
    $text = strip_tags($text, $allowed_tags);

    $excerpt_word_count = 23; 

    $excerpt_length = apply_filters('excerpt_length', $excerpt_word_count); 
 
    $excerpt_end = ''; 
    $excerpt_more = apply_filters('excerpt_more', ' ' . $excerpt_end);
 
    $words = preg_split("/[\n\r\t ]+/", $text, $excerpt_length + 1, PREG_SPLIT_NO_EMPTY);
    if ( count($words) > $excerpt_length ) {
        array_pop($words);
        $text = implode(' ', $words);
        $text = $text . $excerpt_more;
    } else {
        $text = implode(' ', $words);
    }
}
return apply_filters('wp_trim_excerpt', $text, $raw_excerpt);
}
remove_filter('get_the_excerpt', 'wp_trim_excerpt');
add_filter('get_the_excerpt', 'custom_wp_trim_excerpt');



function new_excerpt_more($more) {
	return '';
}
add_filter('excerpt_more', 'new_excerpt_more');


add_theme_support(
	'post-formats', array(	
		'image',
		'video',
		'audio'
	)
);


if (function_exists('add_theme_support')) {
	add_theme_support('post-thumbnails');
	add_theme_support('thumbnail');	
add_image_size( 'thumbnail', 420, 300, true );
}




if ( function_exists( 'wp_nav_menu' ) ){
	if (function_exists('add_theme_support')) {
		add_theme_support('nav-menus');
		add_action( 'init', 'register_my_menus' );
		function register_my_menus() {
			register_nav_menus(
				array(
					'main-menu' => __( 'Main menu', 'my-text-domain'),
					'top-menu' => __( 'Top menu', 'my-text-domain' )
				));
}}}

function primarymenu(){ ?>

<div id="mainMenu">
<ul>
<?php wp_list_pages('title_li='); ?>
</ul>
</div>

<?php }	

function footermenu(){ ?>

<div id="footerMenu">
<ul>
<?php wp_list_categories('hide_empty=1&exclude=1&title_li='); ?>
</ul>
</div>

<?php }	




function pd_title($amount,$echo=true) {
	$pd = get_the_title(); 
	if ( strlen($pd) <= $amount ) $echo_out = ' '; else $echo_out = ' ';
	$pd = mb_substr( $pd, 0, $amount, 'UTF-8' );
	if ($echo) {
		echo $pd;
		echo $echo_out;
	}
	else { return ($pdtitle . $echo_out); }
}




function custom_pagination($pages = '', $range = 2)
{  
     $showitems = ($range * 2)+1;  

     global $paged;
     if(empty($paged)) $paged = 1;

     if($pages == '')
     {
         global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages)
         {
             $pages = 1;
         }
     }   
     if(1 != $pages)
     {
         echo "<div class='pagination'>";
         if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'>&laquo;</a>";
         if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."'>&lsaquo;</a>";

         for ($i=1; $i <= $pages; $i++)
         {
             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
             {
                 echo ($paged == $i)? "<span class='current'>".$i."</span>":"<a href='".get_pagenum_link($i)."' class='inactive' >".$i."</a>";
             }
         }

         if ($paged < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($paged + 1)."'>&rsaquo;</a>";  
         if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'>&raquo;</a>";
         echo "</div>\n";
     }
}


function custom_wp_link_pages( $args = '' ) {
	$defaults = array(
		'before' => '<p id="post-pagination">' . __( 'Pages:' ), 
		'after' => '</p>',
		'text_before' => '',
		'text_after' => '',
		'next_or_number' => 'number', 
		'nextpagelink' => __( 'Next page' ),
		'previouspagelink' => __( 'Previous page' ),
		'pagelink' => '%',
		'echo' => 1
	);

	$r = wp_parse_args( $args, $defaults );
	$r = apply_filters( 'wp_link_pages_args', $r );
	extract( $r, EXTR_SKIP );

	global $page, $numpages, $multipage, $more, $pagenow;

	$output = '';
	if ( $multipage ) {
		if ( 'number' == $next_or_number ) {
			$output .= $before;
			for ( $i = 1; $i < ( $numpages + 1 ); $i = $i + 1 ) {
				$j = str_replace( '%', $i, $pagelink );
				$output .= ' ';
				if ( $i != $page || ( ( ! $more ) && ( $page == 1 ) ) )
					$output .= _wp_link_page( $i );
				else
					$output .= '<span class="current-post-page">';

				$output .= $text_before . $j . $text_after;
				if ( $i != $page || ( ( ! $more ) && ( $page == 1 ) ) )
					$output .= '</a>';
				else
					$output .= '</span>';
			}
			$output .= $after;
		} else {
			if ( $more ) {
				$output .= $before;
				$i = $page - 1;
				if ( $i && $more ) {
					$output .= _wp_link_page( $i );
					$output .= $text_before . $previouspagelink . $text_after . '</a>';
				}
				$i = $page + 1;
				if ( $i <= $numpages && $more ) {
					$output .= _wp_link_page( $i );
					$output .= $text_before . $nextpagelink . $text_after . '</a>';
				}
				$output .= $after;
			}
		}
	}

	if ( $echo )
		echo $output;

	return $output;
}




add_filter( 'use_default_gallery_style', '__return_false' );
	
	
function get_category_id($cat_name){
	$term = get_term_by('slug', $cat_name, 'category');
	return $term->term_id;
}


function pa_category_top_parent_id ($catid) {
 while ($catid) {
  $cat = get_category($catid);
  $catid = $cat->category_parent;
  $catParent = $cat->cat_ID;
 }
return $catParent;
}


function get_cat_slug($cat_id) {
	$cat_id = (int) $cat_id;
	$category = &get_category($cat_id);
	return $category->slug;
}


function category_id_class($classes) {
	global $post;
	foreach((get_the_category($post->ID)) as $category)
		$classes[] = $category->category_nicename;
	return $classes;
}
add_filter('post_class', 'category_id_class');
add_filter('body_class', 'category_id_class');



function getPostViews($postID){
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0";
    }
    return $count.'';
}
function setPostViews($postID) {
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}


add_filter('loop_shop_columns', 'loop_columns');
if (!function_exists('loop_columns')) {
	function loop_columns() {
		return 3;
	}
}

function show_post($path) {
  $post = get_page_by_path($path);
  $content = apply_filters('the_content', $post->post_content);
  echo $content;
}



function wc_category_title_archive_products(){
    $product_cats = wp_get_post_terms( get_the_ID(), 'product_cat' );
    if ( $product_cats && ! is_wp_error ( $product_cats ) ){
        $single_cat = array_shift( $product_cats ); ?>
        <small class="product_category_title"><?php echo $single_cat->name; ?></small>
<?php }
}
add_action( 'woocommerce_after_shop_loop_item', 'wc_category_title_archive_products', 5 );



function add_nofollow_cat( $text ) {
    $text = str_replace('rel="category"', '', $text); 
    $text = str_replace('rel="category tag"', 'rel="tag"', $text); 
    return $text;
}
add_filter( 'the_category', 'add_nofollow_cat' );

if ( ! isset( $content_width ) )
	$content_width = 710;

function mytheme_adjust_content_width() {
	global $content_width;

	if ( is_page_template( 'page_full_width.php' ) )
		$content_width = 1160;
}
add_action( 'template_redirect', 'mytheme_adjust_content_width' );

add_action( 'after_setup_theme', 'woocommerce_support' );
function woocommerce_support() {
    add_theme_support( 'woocommerce' );
}

add_action ( 'edit_category_form_fields', 'extra_category_fields');
function extra_category_fields( $tag ) {  
    $t_id = $tag->term_id;
    $cat_meta = get_option( "category_$t_id");
?>

<tr class="form-field">
<th scope="row" valign="top"><label for="extra1"><?php _e('Category image path', 'my-text-domain' ); ?></label></th>
<td>
<input type="text" name="Cat_meta[extra1]" id="Cat_meta[extra1]" size="25" style="width:60%;" value="<?php echo $cat_meta['extra1'] ? $cat_meta['extra1'] : ''; ?>"><br />
     <span class="description"><?php _e('Enter full image path to your image', 'my-text-domain'); ?></span>
</td>
</tr>

<tr class="form-field">
<th scope="row" valign="top"><label for="extra2"><?php _e('Index page - layout', 'my-text-domain'); ?></label></th>
<td>
<select name="Cat_meta[extra2]" id="Cat_meta[extra2]" style="width:30%;" value="<?php echo $cat_meta['extra2'] ? $cat_meta['extra2'] : ''; ?>">
	<option value="">With Right Sidebar (default)</option>
	<option value="_hide_sidebar" <?php echo ($cat_meta['extra2'] == "_hide_sidebar") ? 'selected="selected"': ''; ?>>Hide Right Sidebar (Full width page)</option>
</select>
    <span class="description"><?php _e('Select layout for index page', 'my-text-domain'); ?></span>
</td>
</tr>

<?php
}

// save extra category extra fields hook
add_action ( 'edited_category', 'save_extra_category_fileds');
   // save extra category extra fields callback function
function save_extra_category_fileds( $term_id ) {
    if ( isset( $_POST['Cat_meta'] ) ) {
        $t_id = $term_id;
        $cat_meta = get_option( "category_$t_id");
        $cat_keys = array_keys($_POST['Cat_meta']);
            foreach ($cat_keys as $key){
            if (isset($_POST['Cat_meta'][$key])){
                $cat_meta[$key] = $_POST['Cat_meta'][$key];
            }
        }
        //save the option array
        update_option( "category_$t_id", $cat_meta );
    }
}

update_option('ts_vcsc_extend_settings_extended', 1);

include(TEMPLATEPATH . '/includes/widgets/banners.php');
include(TEMPLATEPATH . '/includes/widgets/recent_posts.php');
include(TEMPLATEPATH . '/includes/widgets/recent_category_posts.php');
include(TEMPLATEPATH . '/includes/widgets/recent_category_posts_footer.php');
include(TEMPLATEPATH . '/includes/widgets/recent_category_posts_second.php');
include(TEMPLATEPATH . '/includes/widgets/recent_category_posts_third.php');
include(TEMPLATEPATH . '/includes/widgets/recent_category_posts_menu.php');
include(TEMPLATEPATH . '/includes/widgets/recent_category_carousel.php');
include(TEMPLATEPATH . '/includes/widgets/recent_category_slider.php');
include(TEMPLATEPATH . '/includes/widgets/full_width_posts.php');
include(TEMPLATEPATH . '/includes/widgets/popular_posts.php');
include(TEMPLATEPATH . '/includes/widgets/flickr.php');
include(TEMPLATEPATH . '/includes/widgets/video.php');

?>

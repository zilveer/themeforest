<?php
/**
 * TemplateMela
 * @copyright  Copyright (c) TemplateMela. (http://www.templatemela.com)
 * @license    http://www.templatemela.com/license/
 * @author         TemplateMela
 * @version        Release: 1.0
 */
add_image_size('gallery-thumbnail', 145, 145, true);
if ( ! isset( $content_width ) )
	$content_width = 640;
/**  Set Default options : Theme Settings  */
function tm_set_default_options()
{
	/*  General Settings  */	
	add_option("tmoption_logo_image", get_template_directory_uri()."/images/logo.jpg"); // set logo image	
	add_option("tmoption_logo_image_alt",'MegaShop'); // set logo image alt
	add_option("tmoption_showsite_description",'no'); // yes/no, control panel	
	add_option("tmoption_favicon_icon", get_template_directory_uri()."/images/favicon.png"); // set favicon icon		
	add_option("tmoption_contact_email",'mahesh@templatemela.com'); // yes/no, control panel
	add_option("tmoption_control_panel",'no'); // yes/no, control panel	
	add_option("tmoption_responsive",'yes'); // yes/no, responsive
	add_option("tmoption_navigation_option",'2'); // Default/Numbering , posts navigation
	add_option("tmoption_background_upload",""); // Default, texture specified image
	add_option("tmoption_texture",'body-bg.png'); // Default, extra texture image
	add_option("tmoption_back_repeat","repeat"); // background repeate
	add_option("tmoption_back_position","top+left"); // background position
	add_option("tmoption_back_attachment","scroll"); // background attachment
	add_option("tmoption_bkg_color","FFFFFF"); // background color
	add_option("tmoption_bodyfont_color","666666"); // body font color
	add_option("tmoption_bodyfont",'Open+Sans'); // Open Sans	
	add_option("tmoption_bodyfont_other",'Arial'); // Arial
	add_option("tmoption_Newsletter_title",'Sign Up Now :'); // Newsletter title
	add_option("tmoption_Newsletter_sub_title",'Get One Month premiun Membership For free'); // Newsletter title
	add_option("tmoption_buttonbkg_light_color",'F5F5F5'); // Button 0% Gradient Color
	add_option("tmoption_buttonbkg_dark_color",'D8D7D3'); // Button 100% Gradient Color
	add_option("tmoption_buttonbkghover_light_color",'E76452'); // Button 0% Gradient Hover Color
	add_option("tmoption_buttonbkghover_dark_color",'D43E2A'); // Button 100% Gradient Hover Color
	add_option("tmoption_revslider_alias",'tm_homeslider');
	
	
	/*  Top Bar Settings  */	
	add_option("tmoption_show_topbar","yes"); // show top bar
	add_option("tmoption_topbar_light_color","F5F5F5"); // topbar Gradient 0% color
	add_option("tmoption_topbar_dark_color","D8D7D3"); // topbar Gradient 100% color
	add_option("tmoption_topbar_bkg_color","F5F5F5"); // topbar_bkg_color
	add_option("tmoption_topbar_text_color","767676"); // topbar_text_color
	add_option("tmoption_topbar_link_color","777777"); // topbar_link_color
	add_option("tmoption_topbar_link_hover_color","E76453"); // topbar_link_hover_color
	add_option("tmoption_show_topbar_contact","yes"); // show_topbar_contact
	/*add_option("tmoption_topbar_address"," "); // topbar_address*/
	add_option("tmoption_topbar_phone",": 00 0000 000"); // topbar_phone
	add_option("tmoption_show_topbar_social","yes"); // show_topbar_social
	add_option("tmoption_topbar_twitter","#"); // topbar_twitter
	add_option("tmoption_topbar_facebook","#"); // topbar_facebook
	add_option("tmoption_topbar_google_plus","#"); // topbar_google_plus
	add_option("tmoption_topbar_linkedin","#"); // topbar_linkedin
	add_option("tmoption_topbar_youtube","#"); // topbar_youtube
	add_option("tmoption_topbar_rss","#"); // topbar_rss
	add_option("tmoption_topbar_pinterest","#"); // topbar_pinterest
	add_option("tmoption_topbar_skype","#"); // topbar_skype
	
	/*  Header Settings  */	
	add_option("tmoption_header_layout","2"); // header layout
	add_option("tmoption_header_back_repeat","repeat"); // header background repeate
	add_option("tmoption_header_back_position","top+left"); // header background position
	add_option("tmoption_header_back_attachment","scroll"); // header background attachment	
	add_option("tmoption_header_bkg_color","FFFFFF"); // header background color	
	add_option("tmoption_headermenu_light_color","F5F5F5"); // topbar Gradient 0% color
	add_option("tmoption_headermenu_dark_color","D8D7D3"); // topbar Gradient 100% color
	add_option("tmoption_navfont",'Open+Sans'); // navigation menu font
	add_option("tmoption_navfont_other",'Arial'); // navigation menu specified font
	add_option("tmoption_category_text",'Categories'); // navigation menu specified font
	
	
	/*  Content Settings  */
	add_option("tmoption_h1font",'Open+Sans'); // h1 family google font
	add_option("tmoption_h1font_other",'Arial'); // h1 family specified font
	add_option("tmoption_h1color",'E76453'); // h1 family font color	 
	add_option("tmoption_h2font",'Open+Sans'); // h2 family google font
	add_option("tmoption_h2font_other",'Arial'); // h2 family specified font
	add_option("tmoption_h2color",'E76453'); // h2 family font color	
	add_option("tmoption_h3font",'Open+Sans'); // h3 family google font
	add_option("tmoption_h3font_other",'Arial'); // h3 family specified font
	add_option("tmoption_h3color",'E76453'); // h3 family font color	
	add_option("tmoption_h4font",'Open+Sans'); // h4 family google font
	add_option("tmoption_h4font_other",'Arial'); // h4 family specified font
	add_option("tmoption_h4color",'E76453'); // h4 family font color	
	add_option("tmoption_h5font",'Open+Sans'); // h5 family google font
	add_option("tmoption_h5font_other",'Arial'); // h5 family specified font 
	add_option("tmoption_h5color",'E76453'); // h5 family font color	
	add_option("tmoption_h6font",'Open+Sans'); // h6 family google font
	add_option("tmoption_h6font_other",'Arial'); // h6 family specified font 
	add_option("tmoption_h6color",'E76453'); // h6 family font color	
	add_option("tmoption_link_color","777777"); // link color
	add_option("tmoption_hoverlink_color","E76453"); // link hovre color
	
	/*  Footer Settings  */	
	add_option("tmoption_footerbkg_color","FFFFFF"); // footer background color
	add_option("tmoption_footerlink_color","777777"); // footer link text color
	add_option("tmoption_footerhoverlink_color","E76453"); // footer link hover text color
	add_option("tmoption_footerfont",'Open+Sans'); // footer google font
	add_option("tmoption_footerfont_other",'Arial'); // footer specified font
	add_option("tmoption_footer_slog",'Templatemela.'); // copyright statement : Theme By templatemela
	add_option("tmoption_footer_link",'www.google.com'); // copyright link : Theme By templatemela

	
	/* Shop page settings */
	add_option("tmoption_myaccount_text","My Account"); 
	add_option("tmoption_register_text","Login / Register");
	add_option("tmoption_logout_text","Logout");
	add_option("tmoption_shop_items","8"); 
	add_option("tmoption_shop_items_per_row","4"); 
	add_option("tmoption_related_items","8"); 
	add_option("tmoption_related_items_per_row","4");
	add_option("tmoption_upsells_items","8"); 
	add_option("tmoption_upsells_items_per_row","4");	
}
add_action('init', 'tm_set_default_options');

function tm_get_logo() {
	if (trim(get_option('tmoption_logo_image_alt')) != '') $logo_alt = get_option('tmoption_logo_image_alt') ; else $logo_alt = esc_attr(get_bloginfo('name', 'display' ));
	if (trim(get_option('tmoption_logo_image')) != ''){ echo '<img alt="'.get_option('tmoption_logo_image_alt').'" src="'.get_option('tmoption_logo_image').'" />';}
	           else{echo '<img alt="'.get_option('tmoption_logo_image_alt').'" src=" '.get_template_directory_uri(). '/images/logo.png">';}
}

function tm_get_sort_column() {
	$sort_column=''; 
	if(trim(get_option('tmoption_navigation_type'))=='categories'){
		if( trim(get_option('tmoption_navigation_sort_column')) =='id' || trim(get_option('tmoption_navigation_sort_column'))=='menu_order')
			$sort_column = 'ID';
		elseif(trim(get_option('tmoption_navigation_sort_column'))=='name' || trim(get_option('tmoption_navigation_sort_column'))=='post_title')
			$sort_column = 'name';
		elseif(trim(get_option('tmoption_navigation_sort_column'))=='count')
			$sort_column = 'count';
	}
	elseif(trim(get_option('tmoption_navigation_type'))=='pages'){
	
		if(trim(get_option('tmoption_navigation_sort_column'))=='id')
			$sort_column = 'ID';
		elseif(trim(get_option('tmoption_navigation_sort_column'))=='menu_order')
			$sort_column = 'menu_order';
		elseif(trim(get_option('tmoption_navigation_sort_column'))=='post_title' || trim(get_option('tmoption_navigation_sort_column'))=='name')
			$sort_column = 'post_title';
	}
	return $sort_column;
}
function tm_get_sort_order() {
	$sort_order='';
	if(trim(get_option('tmoption_navigation_sort_order'))=='asc')
		return 'asc';
	if(trim(get_option('tmoption_navigation_sort_order'))=='desc')
		return 'desc';
	return $sort_order;
}
function tm_get_all_categories() {
	global $wp_query; 
	if (isset($wp_query->post->ID)) $postid = $wp_query->post->ID; 
	$categories = wp_get_post_categories( $postid );
	$cats = ', ';
	
	foreach($categories as $c){
		$cat = get_category( $c );	
		$cats .= $cat->name. ',';
	}
	$cats=strtolower(rtrim($cats, " ,"));
	return $cats;
}
function tm_get_all_tags() {
	global $wp_query; 
	if (isset($wp_query->post->ID)) $postid = $wp_query->post->ID; 

	$alltags = wp_get_post_tags( $postid );
	$tags = ', ';
	
	foreach($alltags as $tag){
		$tags .= $tag->name. ',';
	}
	$tags=strtolower(rtrim($tags, " ,"));
	return $tags;
}
function extra_head(){
	$themeinfo = wp_get_theme(get_template_directory() . '/style.css');	
	echo '<meta name="generator" content="'.$themeinfo['Name'].' - '.$themeinfo['Version'].'" />';
}
add_action('wp_head','extra_head');

//Load responsive.css file in the header
function tm_responsive()
{
	if(get_option('tmoption_responsive') == 'yes'):
		wp_enqueue_style('responsive', get_stylesheet_directory_uri() . '/responsive.css');
	endif;
}
add_action('wp_head','tm_responsive');

function TM_admin_main_menu(){	
templatemela_add_admin_menu_separator(1);  // Add a new top-level menu :
add_menu_page(__('TemplateMela','templatemela'), __('TemplateMela','templatemela'), 'manage_options', 'tm_info', 'templatemela_info_page' , get_template_directory_uri() .'/templatemela/favicon.ico',3);

$my_settings_page = add_submenu_page('tm_info', __('Theme Settings','templatemela'), __('Theme Settings','templatemela'), 'manage_options', 'tm_theme_settings', 'templatemela_theme_settings_page');
$my_settings_page1 = add_submenu_page('tm_info', __('Hook Manager','templatemela'), __('Hook Manager','templatemela'), 'manage_options', 'tm_hook_manage', 'templatemela_hook_manage_page');
add_action( "admin_enqueue_scripts", 'templatemela_admin_scripts');
add_action( "admin_enqueue_scripts", 'templatemela_admin_styles');
add_action( "admin_enqueue_scripts", 'templatemela_admin_metabox_script');
add_action( "admin_enqueue_scripts", 'templatemela_admin_metabox_styles');
}
add_action('admin_menu', 'TM_admin_main_menu'); 

function templatemela_admin_scripts() {
	//Scripts	
	wp_enqueue_script( 'pscript_admin', get_template_directory_uri() . '/js/megnor/admin/pscript_admin.js');
	wp_enqueue_script( 'jscolor', get_template_directory_uri() . '/js/megnor/admin/jscolor/jscolor.js');
	wp_enqueue_script( 'jquery-easytabs-min', get_template_directory_uri() . '/js/megnor/admin/jquery.easytabs.min.js');
	wp_enqueue_script('media-upload');
	wp_enqueue_script('thickbox');
	wp_register_script('my-upload', get_template_directory_uri() . '/js/megnor/admin/custom.js', array('jquery','media-upload','thickbox'));
	wp_enqueue_script('my-upload');	
}

function templatemela_admin_styles() { 
	//Styles
	wp_enqueue_style('tm_admin', get_template_directory_uri() . '/css/megnor/admin/tm_admin.css');
	wp_enqueue_style('tab', get_template_directory_uri() . '/css/megnor/admin/tab.css');
	wp_enqueue_style('thickbox');
}

function templatemela_admin_metabox_script() { 
	//Scripts
	wp_enqueue_script( 'tm_metabox_script', get_template_directory_uri() . '/js/megnor/admin/tm_metabox_script.js' );
}

function templatemela_admin_metabox_styles() { 
	//Styles
	wp_enqueue_style('tm_metabox_style', get_template_directory_uri() . '/css/megnor/admin/tm_metabox_style.css');
}

function templatemela_info_page() {
	$locale_file = get_template_directory() . "/templatemela/admin/templatemela.php";
	if (is_readable( $locale_file ))
		require_once( $locale_file );
}
function templatemela_theme_settings_page() {
	$locale_file = get_template_directory() . "/templatemela/admin/theme-setting.php";
	if (is_readable( $locale_file ))
		require_once( $locale_file );
}

function templatemela_hook_manage_page() {
	$locale_file = get_template_directory() . "/templatemela/admin/theme-hook.php";
	if (is_readable( $locale_file ))
		require_once( $locale_file );
}
function templatemela_add_admin_menu_separator($position) {
  global $menu;
  $index = 0;
  foreach($menu as $offset => $section) {
    if (substr($section[2],0,9)=='separator')
      $index++;
    if ($offset>=$position) {
      $menu[$position] = array('','read',"separator{$index}",'','wp-menu-separator');
      break;
    }
  }
  ksort($menu);
}
if ( ! function_exists( 'templatemela_admin_header_style' ) ) :
	function templatemela_admin_header_style() {}
endif;

/**
 * Sets the post excerpt length to 40 characters.
 * To override this length in a child theme, remove the filter and add your own
 * function tied to the excerpt_length filter hook.
 * @return int
 */
function templatemela_excerpt_length( $length ) {
	return 200;
}
remove_filter( 'excerpt_length', 'templatemela_excerpt_length' ); 
add_filter( 'excerpt_length', 'templatemela_excerpt_length' );

function string_limit_words($string, $word_limit)
{
  $words = explode(' ', $string, ($word_limit + 1));
  if(count($words) > $word_limit)
  array_pop($words);
  return implode(' ', $words);
}
/**
 * Returns a "Continue Reading" link for excerpts
 * @return string "Continue Reading" link
 */
function templatemela_continue_reading_link() {
	return ' <a class="read-more-link" href="'. get_permalink() . '">' . __( 'Read More', 'templatemela' ) . '</a>';
}
add_filter( 'excerpt_length', 'templatemela_excerpt_length' );
/**
 * Replaces "[...]" (appended to automatically generated excerpts) with an ellipsis and templatemela_continue_reading_link().
 * To override this in a child theme, remove the filter and add your own
 * function tied to the excerpt_more filter hook.
 * @return string An ellipsis
 */
function templatemela_auto_excerpt_more( $more ) {
	return  '&hellip;' .templatemela_continue_reading_link();
}
add_filter( 'excerpt_more', 'templatemela_auto_excerpt_more' );
/**
 * Adds a pretty "Continue Reading" link to custom post excerpts.
 * To override this link in a child theme, remove the filter and add your own
 * function tied to the get_the_excerpt filter hook.
 * @return string Excerpt with a pretty "Continue Reading" link
 */
function templatemela_custom_excerpt_more( $output ) {
	if ( has_excerpt() && ! is_attachment() ) {
		$output = '&hellip;'. templatemela_continue_reading_link();
	}
	return $output;
}

/**
 * Deprecated way to remove inline styles printed when the gallery shortcode is used.
 * This function is no longer needed or used. Use the use_default_gallery_style
 * filter instead, as seen above.
 * @deprecated Deprecated in TemplateMela for WordPress 3.1
 * @return string The gallery style filter, with the styles themselves removed.
 */
function templatemela_remove_gallery_css( $css ) {
	return preg_replace( "#<style type='text/css'>(.*?)</style>#s", '', $css );
}
// Backwards compatibility with WordPress 3.0.
if ( version_compare( $GLOBALS['wp_version'], '3.3.2', '<' ) )
	add_filter( 'gallery_style', 'templatemela_remove_gallery_css' );
	
/**
 * Return the URL for the first link found in the post content.
 *
 * @since Twenty Eleven 1.0
 * @return string|bool URL or false when no link is present.
 */
function templatemela_url_grabber() {
	if ( ! preg_match( '/<a\s[^>]*?href=[\'"](.+?)[\'"]/is', get_the_content(), $matches ) )
		return false;

	return esc_url_raw( $matches[1] );
}

function templatemela_get_widget($location = '') {
	if ( is_active_sidebar($location) ) { 
		dynamic_sidebar($location); 
	}
}

if (version_compare( $GLOBALS['wp_version'], '3.3', '>=' )) 
	include_once(get_template_directory() . '/templatemela/widgets.php'); 

/**
 * Removes the default styles that are packaged with the Recent Comments widget.
 *
 * To override this in a child theme, remove the filter and optionally add your own
 * function tied to the widgets_init action hook.
 * This function uses a filter (show_recent_comments_widget_style) new in WordPress 3.1
 * to remove the default style. Using TemplateMela in WordPress 3.0 will show the styles,
 * but they won't have any effect on the widget in default TemplateMela styling.
 *
 */
function templatemela_remove_recent_comments_style() {
	add_filter( 'show_recent_comments_widget_style', '__return_false' );
}
add_action( 'widgets_init', 'templatemela_remove_recent_comments_style' );

function templatemela_get_pagination($range = 4){  
	// $paged - number of the current page  
	global $paged, $wp_query, $max_page;  
	// How much pages do we have?  
	if ( !$max_page ) {  
		$max_page = $wp_query->max_num_pages;  
	}  
	// We need the pagination only if there are more than 1 page  
	if($max_page > 1){  
		if(!$paged){  
			$paged = 1;  
		}  
		// On the first page, don't put the First page link  
		if($paged != 1){  
			echo '<a class="first" href=" '. get_pagenum_link(1) .' "> << </a>';  
		}
				
		// To the previous page  
		previous_posts_link(' < ');
		// We need the sliding effect only if there are more pages than is the sliding range  
		if($max_page > $range){  
		 // When closer to the beginning  
			 if($paged < $range){  
			   for($i = 1; $i <= ($range + 1); $i++){  
			   	 if($i==$paged){$class = "current number"; }else { $class = "number"; } 
				 echo "<a class='".$class."' href='" . get_pagenum_link($i). "'>$i</a>";  
			   }  
			 }  
			 // When closer to the end  
			 elseif($paged >= ($max_page - ceil(($range/2)))){  
			   for($i = $max_page - $range; $i <= $max_page; $i++){  
				  if($i==$paged){$class = "current number"; }else { $class = "number"; } 
				 echo "<a class='".$class."' href='" . get_pagenum_link($i). "'>$i</a>";   
			   }  
			 }  
			 // Somewhere in the middle  
			 elseif($paged >= $range && $paged < ($max_page - ceil(($range/2)))){  
			   for($i = ($paged - ceil($range/2)); $i <= ($paged + ceil(($range/2))); $i++){  
				  if($i==$paged){$class = "current number"; }else { $class = "number"; } 
				 echo "<a class='".$class."' href='" . get_pagenum_link($i). "'>$i</a>";  
			   }  
			 }  
		}  
		// Less pages than the range, no sliding effect needed  
		else{  
		 for($i = 1; $i <= $max_page; $i++){  
		  if($i==$paged){$class = "current number"; }else { $class = "number"; } 
		   echo "<a class='".$class."' href='" . get_pagenum_link($i). "'>$i</a>";  
		 }  
		}  
		// Next page  
		next_posts_link(' > ');  
		// On the last page, don't put the Last page link  
		if($paged != $max_page){  
		 echo '<a class="last" href=" '. get_pagenum_link($max_page) .' "> >> </a>';  
		}  
	}  
}  	

function templatemela_posts_next_link_attributes($html){
	$html = str_replace('<a','<a class="next-post"',$html);
	return $html;
	}
	
	function templatemela_posts_previous_link_attributes($html){
	$html = str_replace('<a','<a class="prev-post"',$html);
	return $html;
	}
add_filter('next_post_link','templatemela_posts_next_link_attributes',10,1);
add_filter('previous_post_link','templatemela_posts_previous_link_attributes',10,1);

function templatemela_get_first_post_images($post_ID){
	global $post, $posts;
	$first_img_src = '';
	ob_start();
	ob_end_clean();
	$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
	if (isset($matches[1][0]))
	$first_img_src = $matches[1][0];
	if(empty($first_img_src)){ 
		return 0;
	}
	return $first_img_src;
}
function templatemela_print_images_thumb($src,$alttext, $width=200,$height=200,$align='left')
{	
	$src = mr_image_resize($src, $width, $height, true, $align, false);
	if( empty ( $src ) || $src == 'image_not_specified' ):
		$src = get_template_directory_uri()."/images/megnor/placeholder.png";
		$src = mr_image_resize($src, $width, $height, true, $align, false);
	endif;
	$return = '';
	$return .= '<img src="'.$src.'"';
	$return .= " title='$alttext' alt='$alttext' width='$width' height='$height' />";	
	echo $return;
}
function templatemela_excerpt($limit) 
{
      $excerpt = explode(' ', templatemela_strip_images(strip_tags(get_the_excerpt())), $limit);
      if (count($excerpt)>=$limit) {
        array_pop($excerpt);
        $excerpt = implode(" ",$excerpt).'&nbsp;.<div class="read-more"><a class="read-more-link" href="'.get_permalink().'">Read More</a></div>';
      } else {
        $excerpt = implode(" ",$excerpt);
      } 
      $excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
      return $excerpt;
}
function templatemela_blog_post_excerpt($limit) 
{
      $excerpt = explode(' ', get_the_excerpt(), $limit);
      if (count($excerpt)>=$limit) {
        array_pop($excerpt);
        $excerpt = implode(" ",$excerpt).'&nbsp;...';
      } else {
        $excerpt = implode(" ",$excerpt);
      } 
      $excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
      return $excerpt;
}
function templatemela_portfolio_excerpt($limit) 
{
    $contents = substr(templatemela_strip_images(strip_tags(get_the_excerpt())),0,$limit);	
	$excerpt = $contents; if (strlen($contents) >= $limit){ $excerpt .= '&hellip;'; }
  	return $excerpt;
}

if ( ! function_exists( 'tm_go_top' ) ) :
function tm_go_top(){ ?>
<div class="backtotop"><a style="display: none;" id="to_top" href="#"></a></div>
<?php } 
endif;


if ( ! function_exists( 'tm_favicon' ) ) :
function tm_favicon() {
	if (trim(get_option('tmoption_favicon_icon')) != '')
	{
		echo '<link rel="shortcut icon" type="image/png" href="'.get_option('tmoption_favicon_icon') .'" />';
	}
	else
	{
		echo '<link rel="shortcut icon" type="image/png" href="'.get_template_directory_uri() .'/templatemela/favicon.ico" />';
	}
}
endif;

if ( ! function_exists( 'templatemela_strip_images' ) ) :
function templatemela_strip_images($content){	
   $content = preg_replace('/<img[^>]+./','',$content);
   return preg_replace('/<\/?a[^>]*>/','',$content);
}
endif;

/**
 * Remove inline styles printed when the gallery shortcode is used.
 * Galleries are styled by the theme in TemplateMela's style.css. This is just
 * a simple filter call that tells WordPress to not use the default styles.
 */
add_filter( 'use_default_gallery_style', '__return_false' );


// Shortcode Function Includes //
include_once(get_template_directory() . '/templatemela/shortcode/shortcode.php'); 

// Control Panel Tags Function Includes //
include_once(get_template_directory() . '/templatemela/controlpanel/tm_control_panel.php'); 
include_once(get_template_directory() . '/templatemela/admin/hook-functions.php'); 
include_once(get_template_directory() . '/templatemela/custom-post/portfolio.php'); 
include_once(get_template_directory() . '/templatemela/custom-post/faqs.php');
include_once(get_template_directory() . '/templatemela/custom-post/staff.php');
include_once(get_template_directory() . '/templatemela/custom-post/testimonial.php');
include_once(get_template_directory() . '/mr-image-resize.php');

//Adds woocommerce functions if active
if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) :
	include_once(get_template_directory() . '/templatemela/woocommerce-functions.php');
endif;

/**
 * Enqueue Templatemela Fonts
 */
if ( ! function_exists( 'templatemela_load_fonts' ) ) :
function templatemela_load_fonts() {
	$protocol = is_ssl() ? 'https' : 'http';
	wp_enqueue_style( 'opensans-user', "$protocol://fonts.googleapis.com/css?family=Open+Sans:300,400,500,600,700" );
	wp_enqueue_style( 'oswald-user', "$protocol://fonts.googleapis.com/css?family=Oswald:300,400,500,600,700" );
}
endif;
add_action( 'get_header', 'templatemela_load_fonts' );

/**
 * Enqueue Templatemela Styles
 */
 
if ( ! function_exists( 'templatemela_load_styles' ) ) :
function templatemela_load_styles() {
	wp_enqueue_style('css_isotope', get_template_directory_uri() . '/css/isotop-port.css');
	wp_enqueue_style('custom', get_template_directory_uri() . '/css/megnor/custom.css');
	wp_enqueue_style('owl.carousel', get_template_directory_uri() . '/css/megnor/owl.carousel.css');	
	wp_enqueue_style('shadowbox', get_template_directory_uri() . '/css/megnor/shadowbox.css');
	wp_enqueue_style('shortcode_style', get_template_directory_uri() . '/css/megnor/shortcode_style.css');
	wp_enqueue_style('animate_min', get_template_directory_uri() . '/css/megnor/animate.min.css');
	wp_enqueue_style('tm_flexslider', get_template_directory_uri() . '/css/megnor/tm_flexslider.css');
	
	//Adds front end control panel css
	if(get_option('tmoption_control_panel') == 'yes'):
		wp_enqueue_style('tm_style', get_template_directory_uri() . '/css/megnor/tm-style.css');
	endif; 
	
	//Adds wocommerce style
	if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) :
		wp_enqueue_style('templatelema_woocommerce_css', get_template_directory_uri() . '/css/megnor/woocommerce.css');
	endif;
}
endif;
add_action('get_header', 'templatemela_load_styles');

/**
 * Enqueue Templatemela Scripts
 */
if ( ! function_exists( 'templatemela_load_scripts' ) ) :
function templatemela_load_scripts() {	
	wp_enqueue_script( 'jquery_jqtransform', get_template_directory_uri() . '/js/megnor/jquery.jqtransform.js', array(), '', true);
	wp_enqueue_script( 'jquery_jqtransform_script', get_template_directory_uri() . '/js/megnor/jquery.jqtransform.script.js', array(), '', true);
	wp_enqueue_script( 'jquery_custom_script', get_template_directory_uri() . '/js/megnor/jquery.custom.min.js', array(), '', true);
	wp_enqueue_script( 'jquery_isotope', get_template_directory_uri() . '/js/jquery.isotope.min.js', array(), '', true);
	wp_enqueue_script( 'jquery_megnor', get_template_directory_uri() . '/js/megnor/megnor.min.js', array(), '', true);
	wp_enqueue_script( 'jquery_carousel', get_template_directory_uri() . '/js/megnor/carousel.min.js', array(), '', true);
	wp_enqueue_script( 'jquery_inview', get_template_directory_uri() . '/js/megnor/jquery.inview.js', array(), '', true);
	wp_enqueue_script( 'jquery_easypiechart', get_template_directory_uri() . '/js/megnor/jquery.easypiechart.min.js', array(), '', true);
	wp_enqueue_script( 'jquery_custom', get_template_directory_uri() . '/js/megnor/custom.js', array(), '', true);
	wp_enqueue_script( 'jquery_owlcarousel', get_template_directory_uri() . '/js/megnor/owl.carousel.min.js', array(), '', true);
	wp_enqueue_script( 'jquery_formalize', get_template_directory_uri() . '/js/megnor/jquery.formalize.min.js', array(), '', true);
	wp_enqueue_script( 'jquery_respond', get_template_directory_uri() . '/js/megnor/respond.min.js', array(), '', true);
	wp_enqueue_script( 'jquery_validate', get_template_directory_uri() . '/js/megnor/jquery.validate.js', array(), '', true);
	wp_enqueue_script( 'jquery_shadowbox', get_template_directory_uri() . '/js/megnor/shadowbox.js', array(), '', true);
	wp_enqueue_script( 'jquery_flexslider', get_template_directory_uri() . '/js/megnor/jquery.flexslider.js', array(), '', true);
	wp_enqueue_script( 'jquery_waypoints', get_template_directory_uri() . '/js/megnor/waypoints.min.js', array(), '', true);
	wp_enqueue_script( 'jquery_megamenu', get_template_directory_uri() . '/js/megnor/jquery.megamenu.js', array(), '', true);	
	wp_enqueue_script( 'easyResponsiveTabs', get_template_directory_uri() . '/js/megnor/easyResponsiveTabs.js', array(), '', true);
	wp_enqueue_script( 'jstree_min', get_template_directory_uri() . '/js/megnor/jstree.min.js', array(), '', true);	
	
	?>
<!--[if lt IE 9]>
	<?php wp_enqueue_script( 'html5', get_template_directory_uri() . '/js/html5.js', array(), '', true); ?>
	<![endif]-->
<?php }
endif;
add_action( 'wp_enqueue_scripts', 'templatemela_load_scripts' );

/**
 * Enqueue Templatemela Control Panel Scripts
 */
if ( ! function_exists( 'templatemela_load_controlpanel_script' ) ) :
function templatemela_load_controlpanel_script() {		
	if(get_option('tmoption_control_panel') == 'yes') : ?>
<script type="text/javascript">
			var tm_theme_path = "<?php echo get_template_directory_uri() ?>";			
		</script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/megnor/colorpicker/colorpicker.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/megnor/colorpicker/jquery.cookie.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/megnor/colorpicker/pscript.js"></script>
<?php	
	endif; 
}
endif;
add_action( 'wp_footer', 'templatemela_load_controlpanel_script' );

if ( ! function_exists( 'templatemela_breadcrumbs' ) ) :
function templatemela_breadcrumbs() { ?>
<div class="breadcrumbs">
  <?php if ( function_exists('yoast_breadcrumb') ) { ?>
  <?php yoast_breadcrumb('<p id="breadcrumbs">','</p>'); ?>
  <?php } ?>
</div>
<?php }
endif;

function templatemela_search_form( $form ) {
    $form = '<form role="search" method="get" id="searchform" class="search-form" action="' . home_url( '/' ) . '" >
    <div><label class="screen-reader-text" for="s">' . __( 'Search for:', 'templatemela' ) . '</label>
    <input class="search-field" type="text" value="' . get_search_query() . '" name="s" id="s" />
    <input class="search-submit" type="submit" id="searchsubmit" value="'. __( 'Go', 'templatemela' ) .'" />
    </div>
    </form>';
    return $form;
}

add_filter( 'get_search_form', 'templatemela_search_form' );

if ( ! function_exists( 'templatemela_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own templatemela_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 */
function templatemela_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
		// Display trackbacks differently than normal comments.
	?>
<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
  <p>
    <?php _e( 'Pingback:', 'templatemela' ); ?>
    <?php comment_author_link(); ?>
    <?php edit_comment_link( __( '(Edit)', 'templatemela' ), '<span class="edit-link">', '</span>' ); ?>
  </p>
</li>
<?php
			break;
		default :
		// Proceed with normal comments.
		global $post;
	?>
<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
  <div id="comment-<?php comment_ID(); ?>" class="comment-body">
    <div class="alignleft"> <?php echo get_avatar( $comment, 48 ); ?> </div>
    <div class="author-content">
      <h6><?php echo $comment->comment_author; ?></h6>
      <?php edit_comment_link( __( 'Edit', 'templatemela' ), ' ' ); ?>
      <div class="clearfix"></div>
      <abbr class="published" title=""><?php printf( __( '%1$s at %2$s', 'templatemela' ), get_comment_date(),  get_comment_time() ); ?></abbr> </div>
    <div class="comment-content">
      <?php comment_text(); ?>
      <div class="reply">
        <?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
      </div>
    </div>
    <!--<div class="comment-author vcard">
			<?php //echo get_avatar( $comment, 40 ); ?>
			<?php //printf( __( '%s <span class="says">says:</span>', 'templatemela' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
		</div><!-- .comment-author .vcard -->
    <?php if ( $comment->comment_approved == '0' ) : ?>
    <em class="comment-awaiting-moderation">
    <?php _e( 'Your comment is awaiting moderation.', 'templatemela' ); ?>
    </em> <br />
    <?php endif; ?>
  </div>
  <!-- #comment-##  -->
</li>
<?php
	
		break;
	endswitch; // end comment_type check
}
endif;

if ( ! function_exists( 'templatemela_entry_meta' ) ) :
/**
 * Print HTML with meta information for current post: categories, tags, permalink, author, and date.
 *
 * Create your own templatemela_entry_meta() to override in a child theme.
 *
 * @since Templatemela 1.0
 *
 * @return void
 */
function templatemela_entry_meta() {
	
}
endif;

if ( ! function_exists( 'templatemela_get_topbar_contact' ) ) :
function templatemela_get_topbar_contact() {
	$tmoption_topbar_address = get_option('tmoption_topbar_address');
	$tmoption_topbar_phone = get_option('tmoption_topbar_phone');
	$tmoption_topbar_email = get_option('tmoption_topbar_email');
	$tmoption_topbar_email_link = get_option('tmoption_topbar_email_link');
	$output = '';
	$output .= '<div class="topbar-contact">';
		if (!empty($tmoption_topbar_address))
		$output .= '<div class="address-content content"><i class="fa fa-map-marker"></i><span class="contact-address">'.$tmoption_topbar_address.'</span></div>';
		if (!empty($tmoption_topbar_phone))
		$output .= '<div class="phone-content content"><i class="fa fa-phone"></i><span class="contact-phone">'.$tmoption_topbar_phone.'</span></div>';
		if (!empty($tmoption_topbar_email)):
		$output .= '<div class="email-content content"><i class="fa fa-envelope"></i><span class="contact-email">';
			if (!empty($tmoption_topbar_email_link)):
				$output .= '<a href="'.$tmoption_topbar_email_link.'">'.$tmoption_topbar_email.'</a>';
			else: 
				$tmoption_topbar_email;
			endif;
		$output .= '</span></div>';
		endif;
	$output .= '</div>';
	echo $output;
}
endif;

if ( ! function_exists( 'templatemela_get_topbar_social' ) ) :
function templatemela_get_topbar_social() {
	$tmoption_topbar_twitter = get_option('tmoption_topbar_twitter');
	$tmoption_topbar_facebook = get_option('tmoption_topbar_facebook');
	$tmoption_topbar_google_plus = get_option('tmoption_topbar_google_plus');
	$tmoption_topbar_linkedin = get_option('tmoption_topbar_linkedin');
	$tmoption_topbar_youtube = get_option('tmoption_topbar_youtube');
	$tmoption_topbar_rss = get_option('tmoption_topbar_rss');
	$tmoption_topbar_pinterest = get_option('tmoption_topbar_pinterest');
	$tmoption_topbar_skype = get_option('tmoption_topbar_skype');
	$output = '';
	$output .= '<div class="topbar-social">';
		if (!empty($tmoption_topbar_twitter))
		$output .= '<div class="social-twitter content"><a href="'.$tmoption_topbar_twitter.'" target="_Blank"><i class="fa fa-twitter"></i></a></div>';
		if (!empty($tmoption_topbar_facebook))
		$output .= '<div class="social-facebook content"><a href="'.$tmoption_topbar_facebook.'" target="_Blank"><i class="fa fa-facebook"></i></a></div>';
		if (!empty($tmoption_topbar_google_plus))
		$output .= '<div class="social-google-plus content"><a href="'.$tmoption_topbar_google_plus.'" target="_Blank"><i class="fa fa-google-plus"></i></a></div>';
		if (!empty($tmoption_topbar_linkedin))
		$output .= '<div class="social-linkedin content"><a href="'.$tmoption_topbar_linkedin.'" target="_Blank"><i class="fa fa-linkedin"></i></a></div>';
		if (!empty($tmoption_topbar_youtube))
		$output .= '<div class="social-youtube content"><a href="'.$tmoption_topbar_youtube.'" target="_Blank"><i class="fa fa-youtube"></i></a></div>';
		if (!empty($tmoption_topbar_rss))
		$output .= '<div class="social-rss content"><a href="'.$tmoption_topbar_rss.'" target="_Blank"><i class="fa fa-rss"></i></a></div>';
		if (!empty($tmoption_topbar_pinterest))
		$output .= '<div class="social-pinterest content"><a href="'.$tmoption_topbar_pinterest.'" target="_Blank"><i class="fa fa-pinterest"></i></a></div>';
		if (!empty($tmoption_topbar_skype))
		$output .= '<div class="social-skype content"><a href="'.$tmoption_topbar_skype.'" target="_Blank"><i class="fa fa-skype"></i></a></div>';
	$output .= '</div>';
	echo $output;	
}
endif;

if ( ! function_exists( 'templatemela_sticky_post' ) ) :
function templatemela_sticky_post() {
	if ( is_sticky() && is_home() && ! is_paged() )
		echo '<span class="featured-post">' . __( 'Sticky', 'templatemela' ) . '</span>';
}
endif;

if ( ! function_exists( 'templatemela_categories_links' ) ) :
function templatemela_categories_links() {
	// Translators: used between list items, there is a space after the comma.
	$categories_list = get_the_category_list( __( ', ', 'templatemela' ) );
	if ( $categories_list ) {
		echo '<span class="categories-links"><i class="fa fa-folder-o"></i>' . $categories_list . '</span>';
	}
}
endif;

if ( ! function_exists( 'templatemela_tags_links' ) ) :
function templatemela_tags_links() {
	// Translators: used between list items, there is a space after the comma.
	$tag_list = get_the_tag_list( '', __( ', ', 'templatemela' ) );
	if ( $tag_list ) {
		echo '<span class="tags-links"><i class="fa fa-tags"></i>' . $tag_list . '</span>';
	}
}
endif;

if ( ! function_exists( 'templatemela_author_link' ) ) :
function templatemela_author_link() {
	// Post author
	if ( 'post' == get_post_type() ) {
		printf( '<span class="author vcard"><i class="fa fa-user"></i><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>',
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			esc_attr( sprintf( __( 'View all posts by %s', 'templatemela' ), get_the_author() ) ),
			get_the_author()
		);
	}
}
endif;

if ( ! function_exists( 'templatemela_comments_link' ) ) :
function templatemela_comments_link() {
	//comments open
	if ( comments_open() && ! is_single() ) : ?>
<span class="comments-link"> <i class="fa fa-comment"></i>
<?php comments_popup_link( __( 'Leave a Comment', 'templatemela' ), __( '1 Comment', 'templatemela' ), __( '% Comments', 'templatemela' ) ); ?>
</span>
<?php endif; 
}
endif;

if ( ! function_exists( 'templatemela_entry_date' ) ) :
/**
 * Print HTML with date information for current post.
 *
 * Create your own templatemela_entry_date() to override in a child theme.
 *
 * @since Templatemela 1.0
 *
 * @param boolean $echo (optional) Whether to echo the date. Default true.
 * @return string The HTML-formatted post date.
 */
function templatemela_entry_date( $echo = true ) {
	if ( has_post_format( array( 'chat', 'status' ) ) )
		$format_prefix = _x( '%1$s on %2$s', '1: post format name. 2: date', 'templatemela' );
	else
		$format_prefix = '%2$s';

	$date = sprintf( '<div class="entry-date"><div class="day">%3$s</div><div class="month">%4$s</div></div>',
		esc_url( get_permalink() ),
		esc_attr( sprintf( __( 'Permalink to %s', 'templatemela' ), the_title_attribute( 'echo=0' ) ) ),
		esc_attr( get_the_date( 'j' ) ),
		esc_attr( get_the_date( 'M' ) ),
		esc_html( sprintf( $format_prefix, get_post_format_string( get_post_format() ), get_the_date() ) )
	);

	if ( $echo )
		echo $date;

	return $date;
}
endif;

if ( ! function_exists( 'tm_post_entry_date' ) ) :
function tm_post_entry_date( ) {

	$date = get_the_date();	
	$day = date("j", strtotime($date) );
	$month = date("M", strtotime($date) );
	$date = '<div class="entry-date"><div class="day">'.$day.'</div><div class="month">'.$month.'</div></div>';
	echo $date;
	return $date;
}
endif;

if ( ! function_exists( 'templatemela_the_attached_image' ) ) :
/**
 * Print the attached image with a link to the next attached image.
 *
 * @since Templatemela 1.0
 *
 * @return void
 */
function templatemela_the_attached_image() {
	/**
	 * Filter the image attachment size to use.
	 *
	 * @since Templatemela 1.0
	 *
	 * @param array $size {
	 *     @type int The attachment height in pixels.
	 *     @type int The attachment width in pixels.
	 * }
	 */
	$attachment_size     = apply_filters( 'templatemela_attachment_size', array( 724, 724 ) );
	$next_attachment_url = wp_get_attachment_url();
	$post                = get_post();

	/*
	 * Grab the IDs of all the image attachments in a gallery so we can get the URL
	 * of the next adjacent image in a gallery, or the first image (if we're
	 * looking at the last image in a gallery), or, in a gallery of one, just the
	 * link to that image file.
	 */
	$attachment_ids = get_posts( array(
		'post_parent'    => $post->post_parent,
		'fields'         => 'ids',
		'numberposts'    => -1,
		'post_status'    => 'inherit',
		'post_type'      => 'attachment',
		'post_mime_type' => 'image',
		'order'          => 'ASC',
		'orderby'        => 'menu_order ID'
	) );

	// If there is more than 1 attachment in a gallery...
	if ( count( $attachment_ids ) > 1 ) {
		foreach ( $attachment_ids as $attachment_id ) {
			if ( $attachment_id == $post->ID ) {
				$next_id = current( $attachment_ids );
				break;
			}
		}

		// get the URL of the next image attachment...
		if ( $next_id )
			$next_attachment_url = get_attachment_link( $next_id );

		// or get the URL of the first image attachment.
		else
			$next_attachment_url = get_attachment_link( array_shift( $attachment_ids ) );
	}

	printf( '<a href="%1$s" title="%2$s" rel="attachment">%3$s</a>',
		esc_url( $next_attachment_url ),
		the_title_attribute( array( 'echo' => false ) ),
		wp_get_attachment_image( $post->ID, $attachment_size )
	);
}
endif;

if ( ! function_exists( 'tm_posts_short_description' ) ) :
function tm_posts_short_description() {
	$tm_posts_short_description = get_post_meta(get_the_ID(), 'tm_posts_short_description', true);
	if(empty($tm_posts_short_description))
		$tm_posts_short_description = templatemela_excerpt(75);
	return $tm_posts_short_description;
}
endif;

if ( ! function_exists( 'tm_posts_show_thumbnail' ) ) :
function tm_posts_show_thumbnail() {
	$tm_posts_show_thumbnail = get_post_meta(get_the_ID(), 'tm_posts_show_thumbnail', true);
	if(empty($tm_posts_show_thumbnail))
		$tm_posts_show_thumbnail = '';
	return $tm_posts_show_thumbnail;
}
endif;

if ( ! function_exists( 'tm_page_layout' ) ) :
function tm_page_layout() {
	$page_layout_class = '';
	global $wp_query;  
	if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
	if(is_shop()):
	$page_id = woocommerce_get_page_id('shop');
	else:
	$page_id = $wp_query->get_queried_object_id();
	endif;
	}else{
	$page_id = $wp_query->get_queried_object_id();
	}
	$tm_page_layout = get_post_meta($page_id, 'tm_page_layout', true);
	if(empty($tm_page_layout))
		$tm_page_layout = '';
		
	if($tm_page_layout == "box"):
		$page_layout_class = "box-page";
	elseif($tm_page_layout == "wide"):
		$page_layout_class = "wide-page";
	endif;
	return $page_layout_class;
}
endif;


if ( ! function_exists( 'tm_sidebar_position' ) ) :
function tm_sidebar_position() {
  $sidebar_class = '';
  global $wp_query;  
  if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
  if(is_shop()):
    $page_id = woocommerce_get_page_id('shop');
  else:
    $page_id = $wp_query->get_queried_object_id();
  endif;
  }else{
    $page_id = $wp_query->get_queried_object_id();
  }
  $tm_sidebar_position = get_post_meta($page_id, 'tm_sidebar_position', true);
  if(empty($tm_sidebar_position))
    $tm_sidebar_position = '';
    
  if($tm_sidebar_position == "left"):
    $sidebar_class = "left-sidebar";
  elseif($tm_sidebar_position == "right"):
    $sidebar_class = "right-sidebar";
  elseif($tm_sidebar_position == "disabled"):
    $sidebar_class = "full-width";
  endif;
  return $sidebar_class;
}
endif;

if ( ! function_exists( 'tm_blog_box_display' ) ) :
function tm_blog_box_display() {
	$main_container = '';
	$tm_blog_box_display = get_post_meta(get_the_ID(), 'tm_blog_box_display', true);
	if(empty($tm_blog_box_display))
		$tm_blog_box_display = '';
	
	if($tm_blog_box_display == 'masonry'):
		$main_container = 'masonry';
	elseif($tm_blog_box_display == 'grid'):
		$main_container = 'grid';
	endif;
	return $main_container;
}
endif;

if ( ! function_exists( 'tm_blog_box_columns_class' ) ) :
function tm_blog_box_columns_class() {
	$columns_class = '';
	$tm_blog_box_columns = get_post_meta(get_the_ID(), 'tm_blog_box_columns', true);
	if(empty($tm_blog_box_columns))
		$tm_blog_box_columns = '';
		
	if($tm_blog_box_columns == 'two'):
		$columns_class = 'two-col';
	elseif($tm_blog_box_columns == 'three'):
		$columns_class = 'three-col';
	elseif($tm_blog_box_columns == 'four'):
		$columns_class = 'four-col';
	endif;
	return $columns_class;
}
endif;

if ( ! function_exists( 'tm_blog_box_columns_number' ) ) :
function tm_blog_box_columns_number() {
	$columns_number = '';
	$tm_blog_box_columns = get_post_meta(get_the_ID(), 'tm_blog_box_columns', true);
	if(empty($tm_blog_box_columns))
		$tm_blog_box_columns = '';
		
	if($tm_blog_box_columns == 'two'):
		$columns_number = '2';
	elseif($tm_blog_box_columns == 'three'):
		$columns_number = '3';
	elseif($tm_blog_box_columns == 'four'):
		$columns_number = '4';
	endif;
	return $columns_number;
}
endif;

if ( ! function_exists( 'tm_blog_box_posts_per_page' ) ) :
function tm_blog_box_posts_per_page() {
	$tm_blog_box_posts_per_page = get_post_meta(get_the_ID(), 'tm_blog_box_posts_per_page', true);
	if(empty($tm_blog_box_posts_per_page))
		$tm_blog_box_posts_per_page = '';
	return $tm_blog_box_posts_per_page;
}
endif;

if ( ! function_exists( 'tm_blog_list_posts_per_page' ) ) :
function tm_blog_list_posts_per_page() {
	$tm_blog_list_posts_per_page = get_post_meta(get_the_ID(), 'tm_blog_list_posts_per_page', true);
	if(empty($tm_blog_list_posts_per_page))
		$tm_blog_list_posts_per_page = '';
	return $tm_blog_list_posts_per_page;
}
endif;

if ( ! function_exists( 'tm_blog_filter_columns_class' ) ) :
function tm_blog_filter_columns_class() {
	$columns_class = '';
	$tm_blog_filter_columns = get_post_meta(get_the_ID(), 'tm_blog_filter_columns', true);
	if(empty($tm_blog_filter_columns))
		$tm_blog_filter_columns = '';
		
	if($tm_blog_filter_columns == 'two'):
		$columns_class = 'two-col';
	elseif($tm_blog_filter_columns == 'three'):
		$columns_class = 'three-col';
	elseif($tm_blog_filter_columns == 'four'):
		$columns_class = 'four-col';
	endif;
	return $columns_class;
}
endif;

if ( ! function_exists( 'tm_blog_filter_columns_number' ) ) :
function tm_blog_filter_columns_number() {
	$columns_number = '';
	$tm_blog_filter_columns = get_post_meta(get_the_ID(), 'tm_blog_filter_columns', true);
	if(empty($tm_blog_filter_columns))
		$tm_blog_filter_columns = '';
		
	if($tm_blog_filter_columns == 'two'):
		$columns_number = '2';
	elseif($tm_blog_filter_columns == 'three'):
		$columns_number = '3';
	elseif($tm_blog_filter_columns == 'four'):
		$columns_number = '4';
	endif;
	return $columns_number;
}
endif;

if ( ! function_exists( 'tm_testimonial_box_posts_per_page' ) ) :
function tm_testimonial_box_posts_per_page() {
	$tm_testimonial_box_posts_per_page = get_post_meta(get_the_ID(), 'tm_testimonial_box_posts_per_page', true);
	if(empty($tm_testimonial_box_posts_per_page))
		$tm_testimonial_box_posts_per_page = '';
	return $tm_testimonial_box_posts_per_page;
}
endif;

if ( ! function_exists( 'tm_testimonial_list_posts_per_page' ) ) :
function tm_testimonial_list_posts_per_page() {
	$tm_testimonial_list_posts_per_page = get_post_meta(get_the_ID(), 'tm_testimonial_list_posts_per_page', true);
	if(empty($tm_testimonial_list_posts_per_page))
		$tm_testimonial_list_posts_per_page = '';
	return $tm_testimonial_list_posts_per_page;
}
endif;

if ( ! function_exists( 'tm_testimonial_box_columns_class' ) ) :
function tm_testimonial_box_columns_class() {
	$columns_class = '';
	$tm_testimonial_box_columns = get_post_meta(get_the_ID(), 'tm_testimonial_box_columns', true);
	if(empty($tm_testimonial_box_columns))
		$tm_testimonial_box_columns = '';
		
	if($tm_testimonial_box_columns == 'two'):
		$columns_class = 'two-col';
	elseif($tm_testimonial_box_columns == 'three'):
		$columns_class = 'three-col';
	elseif($tm_testimonial_box_columns == 'four'):
		$columns_class = 'four-col';
	endif;
	return $columns_class;
}
endif;

if ( ! function_exists( 'tm_testimonial_box_columns_number' ) ) :
function tm_testimonial_box_columns_number() {
	$columns_number = '';
	$tm_testimonial_box_columns = get_post_meta(get_the_ID(), 'tm_testimonial_box_columns', true);
	if(empty($tm_testimonial_box_columns))
		$tm_testimonial_box_columns = '';
		
	if($tm_testimonial_box_columns == 'two'):
		$columns_number = '2';
	elseif($tm_testimonial_box_columns == 'three'):
		$columns_number = '3';
	elseif($tm_testimonial_box_columns == 'four'):
		$columns_number = '4';
	endif;
	return $columns_number;
}
endif;

if ( ! function_exists( 'tm_staff_box_posts_per_page' ) ) :
function tm_staff_box_posts_per_page() {
	$tm_staff_box_posts_per_page = get_post_meta(get_the_ID(), 'tm_staff_box_posts_per_page', true);
	if(empty($tm_staff_box_posts_per_page))
		$tm_staff_box_posts_per_page = '';
	return $tm_staff_box_posts_per_page;
}
endif;

if ( ! function_exists( 'tm_staff_list_posts_per_page' ) ) :
function tm_staff_list_posts_per_page() {
	$tm_staff_list_posts_per_page = get_post_meta(get_the_ID(), 'tm_staff_list_posts_per_page', true);
	if(empty($tm_staff_list_posts_per_page))
		$tm_staff_list_posts_per_page = '';
	return $tm_staff_list_posts_per_page;
}
endif;

if ( ! function_exists( 'tm_staff_box_columns_class' ) ) :
function tm_staff_box_columns_class() {
	$columns_class = '';
	$tm_staff_box_columns = get_post_meta(get_the_ID(), 'tm_staff_box_columns', true);
	if(empty($tm_staff_box_columns))
		$tm_staff_box_columns = '';
		
	if($tm_staff_box_columns == 'two'):
		$columns_class = 'two-col';
	elseif($tm_staff_box_columns == 'three'):
		$columns_class = 'three-col';
	elseif($tm_staff_box_columns == 'four'):
		$columns_class = 'four-col';
	endif;
	$columns_class;
	return $columns_class;
}
endif;

if ( ! function_exists( 'tm_staff_box_columns_number' ) ) :
function tm_staff_box_columns_number() {
	$columns_number = '';
	$tm_staff_box_columns = get_post_meta(get_the_ID(), 'tm_staff_box_columns', true);
	if(empty($tm_staff_box_columns))
		$tm_staff_box_columns = '';
		
	if($tm_staff_box_columns == 'two'):
		$columns_number = '2';
	elseif($tm_staff_box_columns == 'three'):
		$columns_number = '3';
	elseif($tm_staff_box_columns == 'four'):
		$columns_number = '4';
	endif;
	return $columns_number;
}
endif;

if ( ! function_exists( 'tm_content_position' ) ) :
function tm_content_position() {
	$tm_content_position = get_post_meta(get_the_ID(), 'tm_content_position', true);
	if(empty($tm_content_position))
		$tm_content_position = '';
	return $tm_content_position;
}
endif;

if ( ! function_exists( 'templatemela_is_related_posts' ) ) :
function templatemela_is_related_posts() {
	$templatemela_is_related_posts = get_post_meta(get_the_ID(), 'tm_posts_show_related_posts', true);
	if(empty($templatemela_is_related_posts))
		$templatemela_is_related_posts = '';
	return $templatemela_is_related_posts;
}
endif;

if ( ! function_exists( 'templatemela_is_author_info' ) ) :
function templatemela_is_author_info() {
	$templatemela_is_author_info = get_post_meta(get_the_ID(), 'tm_posts_show_author_info', true);
	if(empty($templatemela_is_author_info))
		$templatemela_is_author_info = '';
	return $templatemela_is_author_info;
}
endif;

/* Start  Metabox */
// Include the meta box script

if ( !defined( 'TEMPLATEMELA_THEME_DIR' ) ) {
	define( 'TEMPLATEMELA_THEME_DIR', get_template_directory() );
}

if ( !defined( 'TEMPLATEMELA_THEME_URI' ) ) {
	define( 'TEMPLATEMELA_THEME_URI', get_template_directory_uri() );
}

if ( !defined( 'TEMPLAETMELA_EXTENSIONS_DIR' ) ) {
	define( 'TEMPLAETMELA_EXTENSIONS_DIR', trailingslashit( TEMPLATEMELA_THEME_DIR ) . basename( dirname( __FILE__ ) ) );
}

if ( !defined( 'TEMPLATEMELA_EXTENSION_URI' ) ) {
	define( 'TEMPLATEMELA_EXTENSION_URI', trailingslashit( TEMPLATEMELA_THEME_URI ) . basename( dirname( __FILE__ ) ) );
}


if ( !defined( 'RWMB_URL' ) ) {
	define( 'RWMB_URL', trailingslashit( trailingslashit( TEMPLATEMELA_EXTENSION_URI ) . 'meta-box' ) );
}

if ( !defined( 'RWMB_DIR' ) ) {
	define( 'RWMB_DIR', trailingslashit( trailingslashit( TEMPLAETMELA_EXTENSIONS_DIR ) . 'meta-box' ) );
}
require_once(get_template_directory() . '/templatemela/meta-box/meta-box.php');


// define global metaboxes array
global $TM_META_BOXES;
$TM_META_BOXES = array();

// include metaboxes
$metaboxes = array(
	'metaboxes-post.php',
	'metaboxes-common.php',
	'metaboxes-page.php',
	'metaboxes-testimonial.php',
	'metaboxes-staff.php'
);

foreach ( $metaboxes as $metabox ) {
	require_once( get_template_directory() . '/templatemela/tm-meta-boxes' . '/' . $metabox );
}
/**
 * Register meta boxes
 *
 * @return void
 */
add_action( 'admin_init', 'rw_register_meta_box' );
function rw_register_meta_box()
{
	// Make sure there's no errors when the plugin is deactivated or during upgrade
	if ( !class_exists( 'RW_Meta_Box' ) ) {
		return;
	}	
	global $TM_META_BOXES;	
	foreach ( $TM_META_BOXES as $meta_box ) {
		new RW_Meta_Box( $meta_box );
	}
}
/**
 * Localize meta boxes
 *
 * @return void
 */
function presscore_localize_meta_boxes() {
	global $TM_META_BOXES;
	$localized_meta_boxes = array();
	foreach ( $TM_META_BOXES as $meta_box ) {
		$localized_meta_boxes[ $meta_box['id'] ] = isset($meta_box['display_on'], $meta_box['display_on']['template']) ? (array) $meta_box['display_on']['template'] : array(); 
	}
	wp_localize_script( 'tm_metabox_script', 'tmMetaboxes', $localized_meta_boxes );
}
add_action( 'admin_enqueue_scripts', 'presscore_localize_meta_boxes', 15 );
/* End Metabox */

// Removes <p> and </br> tags from wp_content
remove_filter( 'the_content', 'wpautop' );
remove_filter( 'the_excerpt', 'wpautop' );

function templatemela_wpautop_nobr( $content ) {
    return wpautop( $content, false );
}
add_filter( 'the_content', 'templatemela_wpautop_nobr' );
add_filter( 'the_excerpt', 'templatemela_wpautop_nobr' );

// Add first and last class to main menu
function templatemela_add_menu_first_last_class($output) {
  $output = preg_replace('/class="menu-item/', 'class="first-menu-item', $output, 1);
  $output = substr_replace($output, 'class="last-menu-item', strpos($output, 'class="menu-item'), strlen('class="menu-item'));
  return $output;
}
add_filter('wp_nav_menu', 'templatemela_add_menu_first_last_class');

// Adds custom image height X width for small thumbnails
add_image_size( 'blog-posts-list', 750, 330, true );
add_image_size( 'small-thumb', 50, 50, true );

//Create HTML list of nav menu items and allow HTML tags.
class Description_Walker extends Walker_Nav_Menu { 
	function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
		$classes = empty ( $item->classes ) ? array () : (array) $item->classes;	 
		$class_names = join(' ', apply_filters(	'nav_menu_css_class', array_filter( $classes ), $item ) );	 
		! empty ( $class_names ) and $class_names = ' class="'. esc_attr( $class_names ) . '"';
	 
		// Build default menu items
		$output .= "<li id='menu-item-$item->ID' $class_names>";
		 
		$attributes = '';	 
		! empty( $item->attr_title )
		and $attributes .= ' title="' . esc_attr( $item->attr_title ) .'"';
		! empty( $item->target )
		and $attributes .= ' target="' . esc_attr( $item->target ) .'"';
		! empty( $item->xfn )
		and $attributes .= ' rel="' . esc_attr( $item->xfn ) .'"';
		! empty( $item->url )
		and $attributes .= ' href="' . esc_attr( $item->url ) .'"';
		 
		// Build the description (you may need to change the depth to 0, 1, or 2)
		$description = ( ! empty ( $item->description ) and 1 == $depth ) ? '<span class="nav_desc">'. $item->description . '</span>' : '';		 
		$title = apply_filters( 'the_title', $item->title, $item->ID );		 
		$item_output = $args->before . "<a $attributes>" . $args->link_before . $title . '</a> ' . $args->link_after . $description . $args->after;
				 
		// Since $output is called by reference we don't need to return anything.
		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args, $id );
	}
} 
// Allow HTML descriptions in WordPress Menu
remove_filter( 'nav_menu_description', 'strip_tags' );

function templatemela_shop_body_classes( $classes ) {


if(isset($_SERVER['QUERY_STRING']) && $_SERVER['QUERY_STRING'] == 'left'){
	$classes[] = 'shop-left-sidebar '; 
	}elseif(isset($_SERVER['QUERY_STRING']) && $_SERVER['QUERY_STRING'] == 'right'){
	$classes[] = 'shop-right-sidebar '; 
	}elseif(isset($_SERVER['QUERY_STRING']) && $_SERVER['QUERY_STRING'] == 'full'){
	$classes[] = 'shop-full-width ';	
	}else{
	$classes[] = 'shop-left-sidebar';
}
	return $classes;
}
add_filter( 'body_class', 'templatemela_shop_body_classes' );

if ( ! function_exists( 'templatemela_shortcode_paging_nav' ) ) :
function templatemela_shortcode_paging_nav() {
	$output = "";
	if ( $GLOBALS['wp_query']->max_num_pages > 1 ) {
	$paged        = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
	$pagenum_link = html_entity_decode( get_pagenum_link() );
	$query_args   = array();
	$url_parts    = explode( '?', $pagenum_link );

	if ( isset( $url_parts[1] ) ) {
		wp_parse_str( $url_parts[1], $query_args );
	}

	$pagenum_link = esc_url(remove_query_arg( array_keys( $query_args ), $pagenum_link ));
	$pagenum_link = trailingslashit( $pagenum_link ) . '%_%';

	$format  = $GLOBALS['wp_rewrite']->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
	$format .= $GLOBALS['wp_rewrite']->using_permalinks() ? user_trailingslashit( 'page/%#%', 'paged' ) : '?paged=%#%';

	// Set up paginated links.
	$links = paginate_links( array(
		'base'     => $pagenum_link,
		'format'   => $format,
		'total'    => $GLOBALS['wp_query']->max_num_pages,
		'current'  => $paged,
		'mid_size' => 1,
		'add_args' => array_map( 'urlencode', $query_args ),
		'prev_text' => __( '<i class="fa fa-angle-left"></i>', 'templatemela' ),
		'next_text' => __( '<i class="fa fa-angle-right"></i>', 'templatemela' ),
	) );

	if ( $links ) :
	$output .= '<nav class="navigation paging-navigation" role="navigation">';
		$output .= '<div class="pagination loop-pagination">';
		$output .= $links;
		$output .= '</div>';
	$output .= '</nav>';
	endif; 
	}
	return $output;
}
endif;

/* Related Product settings */
function related_products_args( $args ) {
  	$no = get_option("tmoption_related_items");	
	$args['posts_per_page'] = $no; 
	return $args;
}
add_filter( 'woocommerce_output_related_products_args', 'related_products_args' );

/*-----------------------------------------------------------------------------------*/
/*	Google Map  
/*-----------------------------------------------------------------------------------*/
function tm_googleMap($latlong, $text, $pin, $height, $id, $class) {
    	
		if (!$latlong) { $latlong = '-33.86938,151.204834'; }
		if (!$pin) { $pin = get_template_directory_uri().'/images/megnor/map-pin.png'; }
		if (!$height) { $height = ""; } else { $height = 'style="height:'.$height.'px;"'; }
		if (!$id) { $id = 0; }
		
		$text = str_replace(chr(13),'<br>',$text);
        $text = str_replace(chr(10),'',$text);

		return '<div id="map'.$id.'" class="google-map '.$class.'" '.$height.'></div>
        <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
        <script type="text/javascript">
			function mapinitialize'.$id.'() {
				var latlng = new google.maps.LatLng('.$latlong.');
				var myOptions = {
					zoom: 17,
					center: latlng,
					scrollwheel: false,
					scaleControl: true,
					disableDefaultUI: false,
					mapTypeId: google.maps.MapTypeId.ROADMAP
				};
				var map = new google.maps.Map(document.getElementById("map'.$id.'"),myOptions);				
				var image = "'.$pin.'";
				var marker = new google.maps.Marker({
					map: map, 
					icon: image,
					position: map.getCenter()
				});				
				var contentString = "'.$text.'";
				var infowindow = new google.maps.InfoWindow({
					content: contentString
				});							
				google.maps.event.addListener(marker, "click", function() {
				  infowindow.open(map,marker);
				});												
			}
			mapinitialize'.$id.'();
		</script>';
}
?>
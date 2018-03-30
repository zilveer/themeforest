<?php
add_action( 'after_setup_theme', 'pmc_Brixton_theme_setup' );
function pmc_Brixton_theme_setup() {
	global $pmc_data;
	/*text domain*/
	load_theme_textdomain( 'pmc-themes', get_template_directory() . '/languages' );
	add_theme_support( 'post-formats', array( 'link', 'gallery', 'video' , 'audio', 'quote') );
	/*feed support*/
	add_theme_support( 'automatic-feed-links' );
	/*post thumb support*/
	add_theme_support( 'post-thumbnails' ); // this enable thumbnails and stuffs
	/*title*/
	add_theme_support( 'title-tag' );
	/*setting thumb size*/
	add_image_size( 'gallery', 185,185, true );	
	add_image_size( 'widget', 285,155, true );
	add_image_size( 'postBlock', 370,260, true );
	add_image_size( 'blog', 1180, 650, true );
	add_image_size( 'related', 345,190, true );

	
	register_nav_menus(array(
	
			'pmcmainmenu' => 'Main Menu',
			'pmcrespmenu' => 'Responsive Menu',	
			'pmcscrollmenu' => 'Scroll Menu'			
	));	
	
    register_sidebar(array(
        'id' => 'sidebar',
        'name' => 'Sidebar main on Blog and single pages',
        'before_widget' => '<div class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3><div class="widget-line"></div>'
    ));			
	
    register_sidebar(array(
        'id' => 'sidebar-top-left',
        'name' => esc_html__('Top sidebar left','brixton'),
		'description' => esc_html__('Position at the very top of the page - custom menu in live demo','brixton'),
        'before_widget' => '<div class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ));		  

    register_sidebar(array(
        'id' => 'sidebar-top-right',
        'name' => esc_html__('Top sidebar right','brixton'),
		'description' => esc_html__('Position at the very top of the page - search in live demo','brixton'),		
        'before_widget' => '<div class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ));		
	
    register_sidebar(array(
        'id' => 'sidebar-logo',
        'name' => 'Sidebar for advert in logo area',
		'description' => esc_html__('You can add your 728x90 ad here (positioned right of the logo)','brixton'),			
        'before_widget' => '<div class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ));	

    register_sidebar(array(
        'id' => 'sidebar-under-header-left',
        'name' => 'Sidebar under header left',
        'before_widget' => '<div class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3><div class="widget-line"></div>'
    ));		
		
    register_sidebar(array(
        'id' => 'sidebar-under-header-right',
        'name' => 'Sidebar under header right',
        'before_widget' => '<div class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3><div class="widget-line"></div>'
    ));	
	
    register_sidebar(array(
        'id' => 'sidebar-under-header-fullwidth',
        'name' => 'Sidebar under header full width',
        'before_widget' => '<div class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3><div class="widget-line"></div>'
    ));		
	
	
    register_sidebar(array(
        'id' => 'sidebar-footer-fullwidth',
        'name' => 'Sidebar above footer full width',
        'before_widget' => '<div class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3><div class="widget-line"></div>'
    ));	
	
    register_sidebar(array(
        'id' => 'sidebar-footer-left',
        'name' => 'Sidebar above footer left',
        'before_widget' => '<div class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3><div class="widget-line"></div>'
    ));		
		
    register_sidebar(array(
        'id' => 'sidebar-footer-right',
        'name' => 'Sidebar above footer right',
        'before_widget' => '<div class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3><div class="widget-line"></div>'
    ));		
	
 
    register_sidebar(array(
        'id' => 'footer1',
        'name' => 'Footer sidebar 1',
        'before_widget' => '<div class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ));
	
		
    
    register_sidebar(array(
        'id' => 'footer2',
        'name' => 'Footer sidebar 2',
        'before_widget' => '<div class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ));
	
    
    register_sidebar(array(
        'id' => 'footer3',
        'name' => 'Footer sidebar 3',
        'before_widget' => '<div class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ));
    


	
	// Responsive walker menu
	class pmc_Walker_Responsive_Menu extends Walker_Nav_Menu {
		
		function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
			global $wp_query;		
			$item_output = $attributes = $prepend ='';
			$class_names = $value = '';
			$classes = empty( $item->classes ) ? array() : (array) $item->classes;
			$class_names = join( ' ', apply_filters( '', array_filter( $classes ), $item ) );			
			$class_names = ' class="'. esc_attr( $class_names ) . '"';			   
			// Create a visual indent in the list if we have a child item.
			$visual_indent = ( $depth ) ? str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-circle"></i>', $depth) : '';
			// Load the item URL
			$attributes .= ! empty( $item->url ) ? ' href="'   . esc_attr( $item->url ) .'"' : '';
			// If we have hierarchy for the item, add the indent, if not, leave it out.
			// Loop through and output each menu item as this.
			if($depth != 0) {
				$item_output .= '<a '. $class_names . $attributes .'>&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-circle"></i>' . $item->title. '</a><br>';
			} else {
				$item_output .= '<a ' . $class_names . $attributes .'><strong>'.$prepend.$item->title.'</strong></a><br>';
			}
			// Make the output happen.
			$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
		}
	}
	
	
	// Main walker menu	
	class pmc_Walker_Main_Menu extends Walker_Nav_Menu
	{		
		function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
		   $this->curItem = $item;
		   global $wp_query;
		   $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
		   $class_names = $value = '';
		   $classes = empty( $item->classes ) ? array() : (array) $item->classes;
		   $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
		   $class_names = ' class="'. esc_attr( $class_names ) . '"';
		   $image  = ! empty( $item->custom )     ? ' <img src="'.esc_attr($item->custom).'">' : '';
		   $output .= $indent . '<li id="menu-item-'.rand(0,9999).'-'. $item->ID . '"' . $value . $class_names .' >';
		   $attributes_title  = ! empty( $item->attr_title ) ? ' <i class="fa '  . esc_attr( $item->attr_title ) .'"></i>' : '';
		   $attributes  = ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
		   $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
		   $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
		   $prepend = '';
		   $append = '';
		   if($depth != 0)
		   {
				$append = $prepend = '';
		   }
			$item_output = $args->before;
			$item_output .= '<a '. $attributes .'>';
			$item_output .= $attributes_title.$args->link_before .$prepend.apply_filters( 'the_title', $item->title, $item->ID ).$append;
			$item_output .= $args->link_after;
			$item_output .= '</a>';	
			$item_output .= $args->after;
			$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
		}
	}
	
	

}




/*-----------------------------------------------------------------------------------*/
// Options Framework
/*-----------------------------------------------------------------------------------*/
// Paths to admin functions
define('MY_TEXTDOMAIN', 'pmc-themes');
define('ADMIN_PATH', get_stylesheet_directory() . '/admin/');
define('BOX_PATH', get_stylesheet_directory() . '/includes/boxes/');
define('ADMIN_DIR', get_template_directory_uri() . '/admin/');
define('LAYOUT_PATH', ADMIN_PATH . '/layouts/');
define('OPTIONS', 'of_options_pmc'); // Name of the database row where your options are stored
require_once (get_template_directory() . '/admin/import/plugins/options-importer.php');   // Options panel settings and custom settings
add_option('IMPORT', 'false');
if (is_admin() && isset($_GET['activated'] ) && $pagenow == "themes.php" ) {

	if(get_option('IMPORT') == 'false'){
		import(get_template_directory() . '/admin/import/options.json');
		wp_redirect( admin_url( 'themes.php?page=tgmpa-install-plugins&plugin_status=install' ) );
		update_option('IMPORT', 'true');
	}
	else{
		wp_redirect( admin_url( 'themes.php?page=optionsframework&pmc_import=true' ) );
	}
}

/* include scripts */
function pmc_scripts() {
	global $pmc_data;
	/*scripts*/	
	wp_enqueue_script('pmc_customjs', get_template_directory_uri() . '/js/custom.min.js', array('jquery'),null,true);  	      		 
	wp_enqueue_script('pmc_bxSlider', get_template_directory_uri() . '/js/jquery.bxslider.js', array('jquery') ,null,false); 	

	
	
	if(isset($pmc_data['body_font'])){			
		if(($pmc_data['body_font']['face'] != 'verdana') and ($pmc_data['body_font']['face'] != 'trebuchet') and 
			($pmc_data['body_font']['face'] != 'georgia') and ($pmc_data['body_font']['face'] != 'Helvetica Neue') and 
			($pmc_data['body_font']['face'] != 'times,tahoma') and ($pmc_data['body_font']['face'] != 'arial')) {	
				if(isset($pmc_data['google_body_custom']) && $pmc_data['google_body_custom'] != ''){
					$font_explode = explode(' ' , $pmc_data['google_body_custom']);
					$font_body  = '';
					$size = count($font_explode);
					$count = 0;
					if(count($font_explode) > 0){
						foreach($font_explode as $font){
							if($count < $size-1){
								$font_body .= $font_explode[$count].'+';
							}
							else{
								$font_body .= $font_explode[$count];
							}
							$count++;
						}
					}else{
						$font_body = $pmc_data['google_body_custom'];
					}
				}else{
					$font_body = $pmc_data['body_font']['face'];
				}					
		}						
	}		
	if(isset($pmc_data['heading_font'])){			
		if(($pmc_data['heading_font']['face'] != 'verdana') and ($pmc_data['heading_font']['face'] != 'trebuchet') and 
			($pmc_data['heading_font']['face'] != 'georgia') and ($pmc_data['heading_font']['face'] != 'Helvetica Neue') and 
			($pmc_data['heading_font']['face'] != 'times,tahoma') and ($pmc_data['heading_font']['face'] != 'arial')) {	
				if(isset($pmc_data['google_heading_custom']) && $pmc_data['google_heading_custom'] != ''){
					$font_explode = explode(' ' , $pmc_data['google_heading_custom']);
					$font_heading  = '';
					$size = count($font_explode);
					$count = 0;
					if(count($font_explode) > 0){
						foreach($font_explode as $font){
							if($count < $size-1){
								$font_heading .= $font_explode[$count].'+';
							}
							else{
								$font_heading .= $font_explode[$count];
							}
							$count++;
						}
					}else{
						$font_heading = $pmc_data['google_heading_custom'];
					}
				}else{
					$font_heading = $pmc_data['heading_font']['face'];
				}
		
				$font_heading = '|'.$font_heading;		
		}						
	}
	if(!empty($pmc_data['google_menu_custom'])){			
		$font_explode = explode(' ' , esc_attr($pmc_data['google_menu_custom']));
		$font_menu  = '';
		$size = count($font_explode);
		$count = 0;
		if(count($font_explode) > 0){
			foreach($font_explode as $font){
				if($count < $size-1){
					$font_menu .= $font_explode[$count].'+';
				}
				else{
					$font_menu .= $font_explode[$count];
				}
				$count++;
			}
		}else{
			$font_menu = esc_attr($pmc_data['google_menu_custom']);
		}
		$font_menu = '|'. esc_attr($pmc_data['google_menu_custom']);		
	}	
	
	/* FONT FOR QUOTE */
	
	if(!empty($pmc_data['google_quote_custom'])){			
		$font_explode = explode(' ' , esc_attr($pmc_data['google_quote_custom']));
		$font_quote  = '';
		$size = count($font_explode);
		$count = 0;
		if(count($font_explode) > 0){
			foreach($font_explode as $font){
				if($count < $size-1){
					$font_quote .= $font_explode[$count].'+';
				}
				else{
					$font_quote .= $font_explode[$count];
				}
				$count++;
			}
		}else{
			$font_quote = esc_attr($pmc_data['google_quote_custom']);
		}
		$font_quote = '|'. esc_attr($pmc_data['google_quote_custom']);		
	}		

	wp_enqueue_style('googleFonts', 'https://fonts.googleapis.com/css?family='.$font_body . $font_heading . $font_menu . $font_quote, '' ,null);	
	wp_enqueue_script('font-awesome_pms', 'https://use.fontawesome.com/30ede005b9.js' , '',null);
				
}	
add_action( 'wp_enqueue_scripts', 'pmc_scripts' );

// Build Options
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
$root =  get_template_directory() .'/';
$admin =  get_template_directory() . '/admin/';
require_once ($admin . 'theme-options.php');   // Options panel settings and custom settings
require_once ($admin . 'admin-interface.php');  // Admin Interfaces
require_once ($admin . 'admin-functions.php');  // Theme actions based on options settings
$includes =  get_template_directory() . '/includes/';
$widget_includes =  get_template_directory() . '/includes/widgets/';
/* include custom widgets */
require_once ($widget_includes . 'recent_post_widget.php'); 
require_once ($widget_includes . 'popular_post_widget.php');
require_once ($widget_includes . 'social_widget.php');
require_once ($widget_includes . 'post_widget.php');
require_once ($widget_includes . 'post_slider_widget.php');
require_once ($widget_includes . 'video_widget.php');

require_once ($includes . 'class-tgm-plugin-activation.php');

 
/*shorcode to excerpt*/
remove_filter( 'get_the_excerpt', 'wp_trim_excerpt'  ); //Remove the filter we don't want
add_filter( 'get_the_excerpt', 'pmc_wp_trim_excerpt' ); //Add the modified filter
add_filter( 'the_excerpt', 'do_shortcode' ); //Make sure shortcodes get processed

function pmc_wp_trim_excerpt($text = '') {
	$raw_excerpt = $text;
	if ( '' == $text ) {
		$text = get_the_content('');
		//$text = strip_shortcodes( $text ); //Comment out the part we don't want
		$text = apply_filters('the_content', $text);
		$text = str_replace(']]>', ']]&gt;', $text);
		$excerpt_length = apply_filters('excerpt_length', 55);
		$excerpt_more = apply_filters('excerpt_more', ' ' . '[...]');
		$text = wp_trim_words( $text, $excerpt_length, $excerpt_more );
	}
	return apply_filters('wp_trim_excerpt', $text, $raw_excerpt);
}

/*add boxed to body class*/

add_filter('body_class','pmc_body_class');

function pmc_body_class($classes) {
	global $pmc_data;
	$class = '';
	if(isset($pmc_data['use_boxed'])){
		$classes[] = 'pmc_boxed';
	}
	return $classes;
}

/* custom breadcrumb */
function pmc_breadcrumb($title = false) {
	global $pmc_data;
	$breadcrumb = '';
	if (!is_home()) {
		if($title == false){
			$breadcrumb .= '<a href="';
			$breadcrumb .=  home_url();
			$breadcrumb .=  '">';
			$breadcrumb .= __('Home', 'pmc-themes');
			$breadcrumb .=  "</a> &#187; ";
		}
		if (is_single()) {
			if (is_single()) {
				$name = '';
				if(!get_query_var($pmc_data['port_slug']) && !get_query_var('product')){
					$category = get_the_category(); +
					$category_id = get_cat_ID($category[0]->cat_name);
					$category_link = get_category_link($category_id);					
					$name = '<a href="'. esc_url( $category_link ).'">'.$category[0]->cat_name .'</a>';
				}
				else{
					$taxonomy = 'portfoliocategory';
					$entrycategory = get_the_term_list( get_the_ID(), $taxonomy, '', ',', '' );
					$catstring = $entrycategory;
					$catidlist = explode(",", $catstring);	
					$name = $catidlist[0];
				}
				if($title == false){
					$breadcrumb .= $name .' &#187; <span>'. get_the_title().'</span>';
				}
				else{
					$breadcrumb .= get_the_title();
				}
			}	
		} elseif (is_page()) {
			$breadcrumb .=  '<span>'.get_the_title().'</span>';
		}
		elseif(get_query_var('portfoliocategory')){
			$term = get_term_by('slug', get_query_var('portfoliocategory'), 'portfoliocategory'); $name = $term->name; 
			$breadcrumb .=  '<span>'.$name.'</span>';
		}	
		else if(is_tag()){
			$tag = get_query_var('tag');
			$tag = str_replace('-',' ',$tag);
			$breadcrumb .=  '<span>'.$tag.'</span>';
		}
		else if(is_search()){
			$breadcrumb .= __('Search results for ', 'pmc-themes') .'"<span>'.get_search_query().'</span>"';			
		} 
		else if(is_category()){
			$cat = get_query_var('cat');
			$cat = get_category($cat);
			$breadcrumb .=  '<span>'.$cat->name.'</span>';
		}
		else if(is_archive()){
			$breadcrumb .=  '<span>'.__('Archive','pmc-themes').'</span>';
		}	
		else{
			$breadcrumb .=  'Home';
		}

	}
	return $breadcrumb ;
}
/* social share links */
function pmc_socialLinkSingle($link,$title) {
	$social = '';
	$social  .= '<div class="addthis_toolbox">';
	$social .= '<div class="custom_images">';
	$social .= '<a class="addthis_button_facebook" addthis:url="'.esc_url($link).'" addthis:title="'.esc_attr($title).'" ><i class="fa fa-facebook"></i></a>';
	$social .= '<a class="addthis_button_twitter" addthis:url="'.esc_url($link).'" addthis:title="'.esc_attr($title).'"><i class="fa fa-twitter"></i></a>';  
	$social .= '<a class="addthis_button_pinterest_share" addthis:url="'.esc_url($link).'" addthis:title="'.esc_attr($title).'"><i class="fa fa-pinterest"></i></a>'; 
	$social .= '<a class="addthis_button_google" addthis:url="'.esc_url($link).'" g:plusone:count="false" addthis:title="'.esc_attr($title).'"><i class="fa fa-google-plus"></i></a>'; 	
	$social .= '<a class="addthis_button_stumbleupon" addthis:url="'.esc_url($link).'" addthis:title="'.esc_attr($title).'"><i class="fa fa-stumbleupon"></i></a>';
	$social .='</div><script async src="http://s7.addthis.com/js/300/addthis_widget.js">var addthis_config = addthis_config||{};addthis_config.data_track_addressbar = false;</script>';	
	$social .= '</div>'; 
	echo $social;
	
	
}
/* links to social profile */
function pmc_socialLink() {
	$social = '';
	global $pmc_data; 
	$icons = $pmc_data['socialicons'];
	if(is_array($icons)) {
		foreach ($icons as $icon){
			$social .= '<a target="_blank"  href="'.esc_url($icon['link']).'" title="'.esc_attr($icon['title']).'"><i class="fa '.esc_attr($icon['url']).'"></i></a>';	
		}
	}
	echo $social;
}

add_filter('the_content', 'pmc_addlightbox');
/* add lightbox to images*/
function pmc_addlightbox($content)
{	global $post;
	$pattern = "/<a(.*?)href=('|\")(.*?).(bmp|gif|jpeg|jpg|png)('|\")(.*?)>/i";
  	$replacement = '<a$1href=$2$3.$4$5 rel="lightbox[%LIGHTID%]"$6>';
    $content = preg_replace($pattern, $replacement, $content);
	if(isset($post->ID))
		$content = str_replace("%LIGHTID%", $post->ID, $content);
    return $content;
}
/* remove double // char */
function pmc_stripText($string) 
{ 
    return str_replace("\\",'',$string);
} 
	
/* custom post types */	
add_action('save_post', 'pmc_update_post_type');
add_action("admin_init", "pmc_add_meta_box");
add_action("admin_init", "pmc_add_meta_box_sidebar");

function pmc_add_meta_box_sidebar(){
	add_meta_box("pmc_post_sidebar", "Image options", "pmc_post_sidebar", "post", "side", "high");		
}	

function pmc_post_sidebar(){
	global $post;
	$pmc_data = get_post_custom(get_the_id());
	
	
	if (isset($pmc_data["pmc_featured_category"][0])){
		$pmc_featured_category = $pmc_data["pmc_featured_category"][0];
	}else{
		$pmc_featured_category = 1;
		$pmc_data["pmc_featured_category"][0] = 1;
	}	
	if (isset($pmc_data["pmc_featured_post"][0])){
		$pmc_featured_post = $pmc_data["pmc_featured_post"][0];
	}else{
		$pmc_featured_post = 1;
		$pmc_data["pmc_featured_post"][0] = 1;
	}		
?>
    <div id="pmc-sidebar">
        <table cellpadding="15" cellspacing="15">
            <tr>
                <td><input type="checkbox" name="pmc_featured_category" value="1" <?php if( isset($pmc_featured_category)){ checked( '1', $pmc_data["pmc_featured_category"][0] ); } ?> /><td><label>Show featured Image in category:</label></td></td>	
            </tr>
            <tr>
                <td><input type="checkbox" name="pmc_featured_post" value="1" <?php if( isset($pmc_featured_post)){ checked( '1', $pmc_data["pmc_featured_post"][0] ); } ?> /><td><label>Show featured Image in post view:</label></td></td>	
            </tr>			
        </table>
    </div>
      
<?php
	
}

function pmc_add_meta_box(){
	add_meta_box("pmc_post_type", "Post type", "pmc_post_type", "post", "normal", "high");		
}	

function pmc_post_type(){
	global $post;
	$pmc_data = get_post_custom(get_the_id());

	if (isset($pmc_data["video_post_url"][0])){
		$video_post_url = $pmc_data["video_post_url"][0];
	}else{
		$video_post_url = "";
	}	
	
	if (isset($pmc_data["link_post_url"][0])){
		$link_post_url = $pmc_data["link_post_url"][0];
	}else{
		$link_post_url = "";
	}	
	
	if (isset($pmc_data["audio_post_url"][0])){
		$audio_post_url = $pmc_data["audio_post_url"][0];
	}else{
		$audio_post_url = "";
	}	

?>
    <div id="portfolio-category-options">
        <table cellpadding="15" cellspacing="15">
            <tr class="videoonly" style="border-bottom:1px solid #000;">
            	<td><label>Video URL(*required) - add if you select video post: <i style="color: #999999;"></i></label><br><input name="video_post_url" value="<?php echo esc_attr($video_post_url); ?>" /> </td>	
			</tr>		
            <tr class="linkonly" >
            	<td><label>Link URL - add if you select link post : <i style="color: #999999;"></i></label><br><input name="link_post_url"  value="<?php echo esc_attr($link_post_url); ?>" /></td>
            </tr>				
            <tr class="audioonly">
            	<td><label>Audio URL - add if you select audio post (audio from <a target="_blank"  href="https://soundcloud.com/">SoundCloud</a>)<br>You also need to install plugin <a target="_blank" href="https://wordpress.org/plugins/soundcloud-shortcode/">SoundCloud Shortcode</a>: <i style="color: #999999;"></i></label><br><input name="audio_post_url"  value="<?php echo esc_attr($audio_post_url); ?>" /></td>
            </tr>			
            <tr class="nooptions">
            	<td>No options for this post type.</td>
            </tr>				
        </table>
    </div>
	<style>
	#portfolio-category-options td {width:50%}
	#portfolio-category-options input {width:100%}
	</style>
	<script>
	jQuery(document).ready(function(){	
			if (jQuery("input[name=post_format]:checked").val() == 'video'){
				jQuery('.videoonly').show();
				jQuery('.audioonly, .linkonly , .nooptions').hide();}
				
			else if (jQuery("input[name=post_format]:checked").val() == 'link'){
				jQuery('.linkonly').show();
				jQuery('.videoonly, .select_video,.nooptions').hide();	}	
				
			else if (jQuery("input[name=post_format]:checked").val() == 'audio'){
				jQuery('.videoonly, .linkonly,.nooptions').hide();	
				jQuery('.audioonly').show();}						
			else{
				jQuery('.videoonly').hide();
				jQuery('.audioonly').hide();
				jQuery('.linkonly').hide();
				jQuery('.nooptions').show();}	
			
			jQuery("input[name=post_format]").change(function(){
			if (jQuery("input[name=post_format]:checked").val() == 'video'){
				jQuery('.videoonly').show();
				jQuery('.audioonly, .linkonly,.nooptions').hide();}
				
			else if (jQuery("input[name=post_format]:checked").val() == 'link'){
				jQuery('.linkonly').show();
				jQuery('.videoonly, .audioonly,.nooptions').hide();	}	
				
			else if (jQuery("input[name=post_format]:checked").val() == 'audio'){
				jQuery('.videoonly, .linkonly,.nooptions').hide();	
				jQuery('.audioonly').show();}	
				
			else{
				jQuery('.videoonly').hide();
				jQuery('.audioonly').hide();
				jQuery('.linkonly').hide();
				jQuery('.nooptions').show();}				
		});
	});
	</script>	
      
<?php
	
}
function pmc_update_post_type(){
	global $post;
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return $post_id;
    }
	if($post){

		if( isset($_POST["video_post_url"]) ) {
			update_post_meta($post->ID, "video_post_url", $_POST["video_post_url"]);
		}		
		if( isset($_POST["link_post_url"]) ) {
			update_post_meta($post->ID, "link_post_url", $_POST["link_post_url"]);
		}	
		if( isset($_POST["audio_post_url"]) ) {
			update_post_meta($post->ID, "audio_post_url", $_POST["audio_post_url"]);
		}		
		if( isset($_POST["pmc_featured_category"]) ) {
			update_post_meta($post->ID, "pmc_featured_category", $_POST["pmc_featured_category"]);
		}else{
			update_post_meta($post->ID, "pmc_featured_category", 0);
		}		
		if( isset($_POST["pmc_featured_post"]) ) {
			update_post_meta($post->ID, "pmc_featured_post", $_POST["pmc_featured_post"]);
		}else{
			update_post_meta($post->ID, "pmc_featured_post", 0);
		}				
	}
	
	
	
}
if( !function_exists( 'Brixton_fallback_menu' ) )
{

	function Brixton_fallback_menu()
	{
		$current = "";
		if (is_front_page()){$current = "class='current-menu-item'";} 
		echo "<div class='fallback_menu'>";
		echo "<ul class='Brixton_fallback menu'>";
		echo "<li $current><a href='".esc_url(home_url())."'>Home</a></li>";
		wp_list_pages('title_li=&sort_column=menu_order');
		echo "</ul></div>";
	}
}

add_filter( 'the_category', 'pmc_add_nofollow_cat' );  

function pmc_add_nofollow_cat( $text ) { 
	$text = str_replace('rel="category tag"', "", $text); 
	return $text; 
}

/* get image from post */
function pmc_getImage($id, $image){
	$return = '';
	if ( has_post_thumbnail() ){
		$return = get_the_post_thumbnail($id,$image);
		}
	else
		$return = '';
	
	return 	$return;
}

if ( ! isset( $content_width ) ) $content_width = 800;


function pmc_add_this_script_footer(){ 
	global $pmc_data;


?>
<script>	
	jQuery(document).ready(function(){	
		jQuery('.searchform #s').attr('value','<?php _e('Search and hit Enter...','pmc-themes'); ?>');
		
		jQuery('.searchform #s').focus(function() {
			jQuery('.searchform #s').val('');
		});
		
		jQuery('.searchform #s').focusout(function() {
			if(jQuery('.searchform #s').attr('value') == '')
				jQuery('.searchform #s').attr('value','<?php _e('Search and hit Enter...','pmc-themes'); ?>');
		});	
		jQuery("a[rel^='lightbox']").prettyPhoto({theme:'light_rounded',show_title: true, deeplinking:false,callback:function(){scroll_menu()}});		
		jQuery(".gallery a").attr("rel", "lightbox[gallery]").prettyPhoto({theme:'light_rounded',overlay_gallery: false,show_title: false,deeplinking:false});
	});	</script>

<?php  }


add_action('wp_footer', 'pmc_add_this_script_footer'); 

function pmc_security($string){
	echo stripslashes(wp_kses(stripslashes($string),array('img' => array('src' => array(),'alt'=>array()),'a' => array('href' => array()),'span' => array('style'=> array()),'div' => array('class' => array()),'b' => array(),'strong' => array(),'br' => array(),'p' => array(),'h1' => array(),'h2' => array(),'h3' => array(),'em' => array())));  

}
/*brixton gallery*/
function brixton_gallery( $out )
{
	remove_filter( current_filter(), __FUNCTION__ );
	$out['size'] = 'full';
	return $out;
}

/* SEARCH FORM */
function amory_search_form( $form ) {
	$form = '<form method="get" id="searchform" class="searchform" action="' . home_url( '/' ) . '" >
	<input type="text" value="' . get_search_query() . '" name="s" id="s" />
	<i class="fa fa-search search-desktop"></i>
	</form>';

	return $form;
}

add_filter( 'get_search_form', 'amory_search_form' );

/*excpert*/
function pmc_widget_post_custom_excerpt_length( $length ) {
return 999; // Change this to the number of characters you wish to have in your excerpt
}
add_filter( 'excerpt_length',  'pmc_widget_post_custom_excerpt_length', 999 );

/*import plugins*/

add_action( 'tgmpa_register', 'pmc_required_plugins' );

function pmc_required_plugins() {

    /**
     * Array of plugin arrays. Required keys are name and slug.
     * If the source is NOT from the .org repo, then source is also required.
     */
    $plugins = array(
	
        array(
            'name'               => 'Revolutin Slider', // The plugin name.
            'slug'               => 'revslider', // The plugin slug (typically the folder name).
            'source'             => 'revslider.zip', // The plugin source.
            'required'           => false, // If false, the plugin is only 'recommended' instead of required.
            'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher.
            'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
            'external_url'       => '', // If set, overrides default API URL and points to an external URL.
        ),
        array(
            'name'               => 'Social share buttons', // The plugin name.
            'slug'               => 'easy-social-share-buttons3', // The plugin slug (typically the folder name).
            'source'             => 'easy-social-share-buttons3.zip', // The plugin source.
            'required'           => false, // If false, the plugin is only 'recommended' instead of required.
            'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher.
            'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
            'external_url'       => '', // If set, overrides default API URL and points to an external URL.
        ),		
	
		array(
				'name'      => 'Alpine photo tile for instagram',
				'slug'      => 'alpine-photo-tile-for-instagram',
				'required'  => false,
			),			
		array(
				'name'      => 'Shortcode Ultimate',
				'slug'      => 'shortcodes-ultimate',
				'required'  => false,
			),		
		array(
				'name'      => 'Contact Form 7',
				'slug'      => 'contact-form-7',
				'required'  => false,
			),			
		array(
				'name'      => 'Facebook Page Like Widget',
				'slug'      => 'facebook-pagelike-widget',
				'required'  => false,
			),	
		array(
				'name'      => 'Recent tweets widget',
				'slug'      => 'recent-tweets-widget',
				'required'  => false,
			),		
		array(
				'name'      => 'SoundCloud',
				'slug'      => 'soundcloud-shortcode',
				'required'  => false,
			),	
		array(
				'name'      => 'MailPoet',
				'slug'      => 'wysija-newsletters',
				'required'  => false,
			),				

			
			
			
			
				
    );

    $config = array(
        'id'           => 'tgmpa',                 // Unique ID for hashing notices for multiple instances of TGMPA.
        'default_path' => get_template_directory() . '/includes/plugins/',                      // Default absolute path to pre-packaged plugins.
        'menu'         => 'tgmpa-install-plugins', // Menu slug.
        'has_notices'  => true,                    // Show admin notices or not.
        'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
        'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => true,                   // Automatically activate plugins after installation or not.
        'message'      => '',                      // Message to output right before the plugins table.
        'strings'      => array(
            'page_title'                      => __( 'Install Required Plugins', 'tgmpa' ),
            'menu_title'                      => __( 'Install Plugins', 'tgmpa' ),
            'installing'                      => __( 'Installing Plugin: %s', 'tgmpa' ), // %s = plugin name.
            'oops'                            => __( 'Something went wrong with the plugin API.', 'tgmpa' ),
            'notice_can_install_required'     => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'tgmpa' ), // %1$s = plugin name(s).
            'notice_can_install_recommended'  => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.', 'tgmpa' ), // %1$s = plugin name(s).
            'notice_cannot_install'           => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'tgmpa' ), // %1$s = plugin name(s).
            'notice_can_activate_required'    => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'tgmpa' ), // %1$s = plugin name(s).
            'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'tgmpa' ), // %1$s = plugin name(s).
            'notice_cannot_activate'          => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', 'tgmpa' ), // %1$s = plugin name(s).
            'notice_ask_to_update'            => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'tgmpa' ), // %1$s = plugin name(s).
            'notice_cannot_update'            => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', 'tgmpa' ), // %1$s = plugin name(s).
            'install_link'                    => _n_noop( 'Begin installing plugin', 'Begin installing plugins', 'tgmpa' ),
            'activate_link'                   => _n_noop( 'Begin activating plugin', 'Begin activating plugins', 'tgmpa' ),
            'return'                          => __( 'Return to Required Plugins Installer', 'tgmpa' ),
            'plugin_activated'                => __( 'Plugin activated successfully.', 'tgmpa' ),
            'complete'                        => __( 'All plugins installed and activated successfully. %s', 'tgmpa' ), // %s = dashboard link.
            'nag_type'                        => 'updated' // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
        )
    );

    tgmpa( $plugins, $config );

}

/*version 4.0 update*/
add_option('IMPORT_4', 'false');
if(get_option('IMPORT_4') == 'false'){
	$add = array('home_blog' => 1 );
	$new = get_option('of_options_pmc');
	$new_add = array_merge($new , $add);
	update_option('of_options_pmc', $new_add );
	update_option('IMPORT_4', 'true');
}

?>
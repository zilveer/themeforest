<?php
/*-------------------------------------------------------------------------------------------------*/
/*	Keep comments status open only for pages that has enabled page comments selected in post meta 
/*-------------------------------------------------------------------------------------------------*/
function tt_get_comments_status(){
	global $post;
	//do this only in page.
	if (is_page()) {
		$_post = get_post($post->ID);
		//@since 4.0.4 dev 6 - mod by denzel, 
		//check whether page comment is enable before setting comment status to open.
		$page_comment_setting = get_post_meta($post->ID,'page_comments',true);
		if($page_comment_setting == "on"){
			//if user enabled page comment and by default page comments is closed, we set to open.
			if ($_post->comment_status == 'closed') {
				$update_post                   = array();
				$update_post['ID']             = $post->ID;
				$update_post['comment_status'] = 'open';
				$update_post['ping_status'] = 'open';
				wp_update_post($update_post);
			}
		}
	}
}
add_action('template_redirect', 'tt_get_comments_status');


/*-------------------------------------------------------------------------*/
/*    Retrieve excluded blog categories from site options
/*-------------------------------------------------------------------------*/
function B_getExcludedCats(){

	//@since 4.0.4 dev 6
	//check site option before running this database queries.
	//prevents more than 10 database queries if not used! speeds up at least 0.02 secs.
	$disable_exclude_categories_option = get_option('ka_disable_exclude_categories');
	if($disable_exclude_categories_option!='true'){
	    global $wpdb;
	    $excluded = '';
	    
	    //mod by denzel
	    //@since version 2.1.1, check WordPress version to determine which prepared statement to use.
	    $check_wp_version = get_bloginfo('version');
	    if($check_wp_version < 3.5){
	      
	      //pre WP3.5 version, we use this. Not sure if pre WP 3.5 can work with new prepared statement format..
	      $cats = $wpdb->get_results( $wpdb->prepare( "SELECT option_name, option_value FROM {$wpdb->options} WHERE option_name LIKE '%ka_blogexcludetest_%'" ) );
	    
	    }else{
	      
	      //this is WP 3.5, we use the following correct prepared statement.
	      $cats = $wpdb->get_results( $wpdb->prepare( "SELECT option_name, option_value FROM {$wpdb->options} WHERE option_name LIKE %s", "ka_blogexcludetest%") );
	      
	    }
	    
	    foreach ($cats as $cat) {
	        if ($cat->option_value == "true") {
	            $exploded = explode("_", $cat->option_name);
	            $excluded .= "-{$exploded[2]}, ";
	        }
	    }
	    return rtrim(trim($excluded), ',');
    }
}


/*-------------------------------------------------------------------------*/
/*    Convert excluded into positive numbers (ie: 4,32,12,19)
/*-------------------------------------------------------------------------*/
function positive_exlcude_cats()
{
    global $wpdb;
    $pos_excluded = '';
    
    //mod by denzel
    //@since version 2.1.1, check WordPress version to determine which prepared statement to use.
    $check_wp_version = get_bloginfo('version');
    if($check_wp_version < 3.5){
      
      //pre WP3.5 version, we use this. Not sure if pre WP 3.5 can work with new prepared statement format..
      $cats = $wpdb->get_results( $wpdb->prepare( "SELECT option_name, option_value FROM {$wpdb->options} WHERE option_name LIKE '%ka_blogexcludetest_%'" ) );
    
    }else{
      
      //this is WP 3.5, we use the following correct prepared statement.
      $cats = $wpdb->get_results( $wpdb->prepare( "SELECT option_name, option_value FROM {$wpdb->options} WHERE option_name LIKE %s", "ka_blogexcludetest%") );
      
    }
    
    foreach ($cats as $cat) {
        if ($cat->option_value == "true") {
            $exploded_pos = explode("_", $cat->option_name);
            $pos_excluded .= "{$exploded_pos[2]},";
        }
    }
    return rtrim(trim($pos_excluded), ',');
}


// Hide categories from the loop
if (!is_admin()){
	
function wploop_exclude($query) {
$exclude = B_getExcludedCats();

//do this exclusion only in feed, search, archive (category and tag included), and posts page or home
if ($query->is_feed || $query->is_search || $query->is_archive || $query->is_home){

   //2.6.7 dev 1 - No need exclusion in single category view as all posts will be in the same category, fixes permanent link issue, when accesss from categories widget.
   
   if(!$query->is_category){
   $query->set('cat',''.$exclude.'');
   }
}
return $query;
}
add_filter('pre_get_posts','wploop_exclude');

function wpfeed_exclude($query) {
$excludefeed = B_getExcludedCats();
if ($query->is_feed) {
$query->set('cat',''.$excludefeed.'');
}
return $query;
}
add_filter('pre_get_posts','wpfeed_exclude');
}



/*-------------------------------------------------------------------------*/
/*    Generate Blog Featured Image
/*-------------------------------------------------------------------------*/
/**
 * Use to generate image for index.php  ||  single.php  ||  archive.php
 * 
 * @since 2.3
 *
 * @param string $image_src, contains image url
 * @param int $image_width, contains width of image
 * @param int $height_height, contains height of image.
 * @param string $blog_image_frame, determine whether to use css class post_thumb_shadow_load or post_thumb_load for div.
 * @param string $linkpost, contains url of link to external site.
 * @param string $permalink, contains post permalink
 * @return string $html, output of image or video.
 */
 
 
function truethemes_generate_blog_image($image_src,$image_width,$image_height,$blog_image_frame,$linkpost,$permalink,$video_url){

//Allow plugins/themes to override this layout.
//refer to http://codex.wordpress.org/Function_Reference/add_filter for usage
$html = apply_filters('truethemes_generate_blog_image_filter','',$image_src,$image_width,$image_height,$blog_image_frame,$linkpost,$permalink,$video_url);
if ( $html != '' ){
	return $html;
}

//show video embed only if there is featured video url.
if(!empty($video_url)){
$embed_video = apply_filters('the_content', "[embed width=\"538\" height=\"418\"]".$video_url."[/embed]");
$html = $embed_video;
return $html;
} 


//began normal layout.
if(!empty($image_src)): //there is either post thumbnail of external image


global $ttso;
$blog_image_frame         = $ttso->ka_blog_image_frame;

//determine which div css class to use.
if($blog_image_frame == 'shadow'){
	$html .= '<div class="shadow_img_frame tt-blog-featured">';
}else{
	$html .= '<div class="modern_img_frame tt-blog-featured">';
}

$html.= '<div class="img-preload">';

//determine link to post or link to external site.
//added checks for single.php @since version 2.6
if ($linkpost == ''){
    //there is no link to external url
	if(!is_single()){
	//if not single we link to post
	$truethemeslink = $permalink;
	}else{
	//else we link to nothing;
	$truethemeslink = '';
	}
	
}elseif($linkpost!=''){
    //there is an external url link, we assign it.
	$truethemeslink = $linkpost;
	
}else{
    //do nothing, this is for closing the if statement only.
}

//get post title for image title. 
global $post;
$title = get_the_title($post->ID);

if(!empty($truethemeslink))://show image link only if there is a link assigned.
//start link
$html .= "<a href='$truethemeslink' title='$title' class='attachment-fadeIn'>";
endif;

//image
$html .= "<img src='$image_src' width='$image_width' height='$image_height' alt='$title' />";

if(!empty($truethemeslink)): //show image link only if there is a link assigned.
//close link
$html.= "</a>";
endif;

//close divs
$html .= "</div><!-- END img-preload -->";
$html .= "</div><!-- END post_thumb -->";

endif;

//that's all!
return $html;
}



/*-------------------------------------------------------------------------*/
/*    Custom Archives Parameters
/*-------------------------------------------------------------------------*/

/* 
MODIFIED BY TrueThemes, ORIGINAL PLUGIN:

Plugin Name: Archives for a category 
Plugin URI: http://kwebble.com/blog/2007_08_15/archives_for_a_category
Description: Adds a cat parameter to wp_get_archives() to limit the posts used to generate the archive links to one or more categories.   
Author: Rob Schlüter
Author URI: http://kwebble.com/
Version: 1.4a

Copyright
=========
Copyright 2007, 2008, 2009 Rob Schlüter. All rights reserved.

Licensing terms
===============
- You may use, change and redistribute this software provided the copyright notice above is included. 
- This software is provided without warranty, you use it at your own risk. 
*/
function kwebble_getarchives_where_for_category($where, $args){
	global $kwebble_getarchives_data, $wpdb;

	if (isset($args['cat'])){
		// Preserve the category for later use.
		$kwebble_getarchives_data['cat'] = $args['cat'];

		// Split 'cat' parameter in categories to include and exclude.
		$allCategories = explode(',', $args['cat']);

		// Element 0 = included, 1 = excluded.
		$categories = array(array(), array());
		foreach ($allCategories as $cat) {
			if (strpos($cat, ' ') !== FALSE) {
				// Multi category selection.
			}
			$idx = $cat < 0 ? 1 : 0;
			$categories[$idx][] = abs($cat);
		}

		$includedCatgories = implode(',', $categories[0]);
		$excludedCatgories = implode(',', $categories[1]);

		// Add SQL to perform selection.
		if (get_bloginfo('version') < 2.3){
			$where .= " AND $wpdb->posts.ID IN (SELECT DISTINCT ID FROM $wpdb->posts JOIN $wpdb->post2cat post2cat ON post2cat.post_id=ID";

			if (!empty($includedCatgories)) {
				$where .= " AND post2cat.category_id IN ($includedCatgories)";
			}
			if (!empty($excludedCatgories)) {
				$where .= " AND post2cat.category_id NOT IN ($excludedCatgories)";
			}

			$where .= ')';
		} else{
			$where .= ' AND ' . $wpdb->prefix . 'posts.ID IN (SELECT DISTINCT ID FROM ' . $wpdb->prefix . 'posts'
					. ' JOIN ' . $wpdb->prefix . 'term_relationships term_relationships ON term_relationships.object_id = ' . $wpdb->prefix . 'posts.ID'
					. ' JOIN ' . $wpdb->prefix . 'term_taxonomy term_taxonomy ON term_taxonomy.term_taxonomy_id = term_relationships.term_taxonomy_id'
					. ' WHERE term_taxonomy.taxonomy = \'category\'';
			if (!empty($includedCatgories)) {
				$where .= " AND term_taxonomy.term_id IN ($includedCatgories)";
			}
			if (!empty($excludedCatgories)) {
				$where .= " AND term_taxonomy.term_id NOT IN ($excludedCatgories)";
			}

			$where .= ')';
		}
	}

	return $where;
}

 /* Changes the archive link to include the categories from the 'cat' parameter.
 */
function kwebble_archive_link_for_category($url){
	global $kwebble_getarchives_data;

	if (isset($kwebble_getarchives_data['cat'])){
		$url .= strpos($url, '?') === false ? '?' : '&';
		$url .= 'cat=' . $kwebble_getarchives_data['cat'];

		// Remove cat parameter so it's not automatically used in all following archive lists.
		unset($kwebble_getarchives_data['cat']);
	}

	return $url;
}

/*
 * Add the filters.
 */

// Prevent error if executed outside WordPress.
if (function_exists('add_filter')){
	// Constants for form field and options.
	define('KWEBBLE_OPTION_DISABLE_CANONICAL_URLS', 'kwebble_disable_canonical_urls');
	define('KWEBBLE_GETARCHIVES_FORM_CANONICAL_URLS', 'kwebble_disable_canonical_urls');
	define('KWEBBLE_ENABLED', '');
	define('KWEBBLE_DISABLED', 'Y');

	add_filter('getarchives_where', 'kwebble_getarchives_where_for_category', 10, 2);

//comment out adding of ?cat=-1,-10,20 etc.. to archive page permanent links
//fixed on version 2.6.7 dev 1

//	add_filter('year_link', 'kwebble_archive_link_for_category');
//	add_filter('month_link', 'kwebble_archive_link_for_category');
//	add_filter('day_link', 'kwebble_archive_link_for_category');

	// Disable canonical URLs if the option is set.
	if (get_option(KWEBBLE_OPTION_DISABLE_CANONICAL_URLS) == KWEBBLE_DISABLED){
		remove_filter('template_redirect', 'redirect_canonical');
	}
}


/*-------------------------------------------------------------------------*/
/*    Multisite Settings
/*-------------------------------------------------------------------------*/
//@since 4.0
//we only do this in multisite.
//these are codes for wp-activate.php
if(is_multisite()):
		if(!function_exists('tt_close_header_html_wp_activate_php')):
		    function tt_close_header_html_wp_activate_php(){
		    $request_url = $_SERVER["REQUEST_URI"];
		    if(strpos($request_url, "wp-activate.php")!==false):
		    ?>
		    </div><!-- END header-area -->
            </div><!-- END header-overlay -->
            </div><!-- END header-holder -->
            </header><!-- END header -->
		    
            <div id="main">
            	<div class="main-area">
                	<main role="main" id="content" class="content_full_width">
		    
		    <?php
		    endif;
		    }
		    add_action('truethemes_after_primary_navigation_hook','tt_close_header_html_wp_activate_php');
		endif;
		 
		if(!function_exists('tt_close_main_html_wp_activate_php')):
		    function tt_close_main_html_wp_activate_php(){
		    $request_url = $_SERVER["REQUEST_URI"];
		    if(strpos($request_url, "wp-activate.php")!==false):
		    ?>

			</main><!-- END main #content -->
			</div><!-- END main-holder -->
			</div><!-- END main-area -->

		    <?php
		    endif;
		    }
		    add_action('truethemes_before_footer_top','tt_close_main_html_wp_activate_php');
		endif;
		 
		if(!function_exists('tt_style_wp_activate_php')):
		    function tt_style_wp_activate_php(){
		    $request_url = $_SERVER["REQUEST_URI"];
		    if(strpos($request_url, "wp-activate.php")!==false):
		    
			/*-----------------------------*/
			/* Enqueue Styles
			/*-----------------------------*/
			global $ttso;
			$primary_style         =  $ttso->ka_main_scheme;
			$secondary_style       =  $ttso->ka_secondary_scheme;
			$mobile_style          =  $ttso->ka_responsive;

			//default style.css
			wp_enqueue_style( 'style', get_stylesheet_directory_uri() . '/style.css');

			//primary color css
			wp_enqueue_style( 'primary-color', TRUETHEMES_CSS . $primary_style .'.css');

			//@since 4.6 - combined secondary and primary CSS into singole primary file - 1 less HTTP request
			if('default' != $secondary_style) :
				wp_enqueue_style( 'secondary-color', TRUETHEMES_CSS . $secondary_style .'.css');
			endif;

			//font-awesome
			wp_enqueue_style( 'font-awesome', TRUETHEMES_CSS .'_font-awesome.css');

			//woocommerce
			if (class_exists('woocommerce')) :
				wp_enqueue_style( 'woocommerce', TRUETHEMES_CSS . '_woocommerce.css');
			endif;

			//mobile stylesheet
			if('false' == $mobile_style) :
				wp_enqueue_style( 'mobile', TRUETHEMES_CSS . '_mobile.css');
			endif;
		    
		    ?>
		    <script type='text/javascript'>
		    jQuery(document).ready(function(){
		        jQuery('#content').removeClass('widecolumn');
		        jQuery('#content').addClass('content_full_width');
		        jQuery('#submit').addClass('ka-form-submit');
		    });
		    </script>
		    <style type='text/css'>
		    #submit, #key {
		        font-size: inherit !important;
		        width: inherit !important;
		    }
		    #content h2{
		    text-align: center;
		    }
		    #activateform{
		    margin: 0px auto;
		    width:305px;
		    max-width: 90%;
		    }
		    </style>
		    <?php
		    endif;
		    }
		    add_action('wp_head','tt_style_wp_activate_php');
		endif;
endif;


//@since version 3.0.1
//For multisite setup, hooks to before_signup_form and after_signup_form hooks in wp-signup.php
//in multisite setup, if user allows public signup, registering will redirect to wp-signup.php instead of wp-login.php
//and wp-signup.php uses theme header.php and footer.php, something like woocommerce setup.
function tt_before_signup_form(){
			global $ttso;
			$primary_style         =  $ttso->ka_main_scheme;
			$secondary_style       =  $ttso->ka_secondary_scheme;
			$mobile_style          =  $ttso->ka_responsive;

			//default style.css
			wp_enqueue_style( 'style', get_stylesheet_directory_uri() . '/style.css');

			//primary color css
			wp_enqueue_style( 'primary-color', TRUETHEMES_CSS . $primary_style .'.css');

			//@since 4.6 - combined secondary and primary CSS into singole primary file - 1 less HTTP request
			if('default' != $secondary_style) :
				wp_enqueue_style( 'secondary-color', TRUETHEMES_CSS . $secondary_style .'.css');
			endif;

			//font-awesome
			wp_enqueue_style( 'font-awesome', TRUETHEMES_CSS .'_font-awesome.css');

			//woocommerce
			if (class_exists('woocommerce')) :
				wp_enqueue_style( 'woocommerce', TRUETHEMES_CSS . '_woocommerce.css');
			endif;

			//mobile stylesheet
			if('false' == $mobile_style) :
				wp_enqueue_style( 'mobile', TRUETHEMES_CSS . '_mobile.css');
			endif;
?>
 
</div><!-- END header-area -->
</div><!-- END header-overlay -->
</div><!-- END header-holder -->
</header><!-- END header -->
 
<?php truethemes_before_main_hook();// action hook ?>
 
<div id="main" class="">
	<div class="main-area">

<?php
}
add_action('before_signup_form','tt_before_signup_form');


//@since 3.0.1 - For multisite setup, hooks to after_signup_form hook in wp-signup.php 
function tt_after_signup_form(){
?>
    </main><!-- END main #content -->
</div><!-- END main-area -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
<script type='text/javascript'>
jQuery(document).ready(function(){
  jQuery('#content').addClass('content_full_width');
});
</script>
<style type='text/css'>
.submit{
width:200px !important;
}
</style>
<?php
}
add_action('after_signup_form','tt_after_signup_form');





//@since theme version 3.0
//This function filters WordPress comment_form function which is used in comments.php and page-comments.php
//This function will change comment_form label and input to our theme's design codes.
function tt_contact_form_fields($fields) {

	//@since 3.0.3 get comment cookie information of current commenter (if any) to prefill comment form details.
	$commenter = wp_get_current_commenter();

	$req = get_option( 'require_name_email' );
	$aria_req = ( $req ? " aria-required='true'" : '' );
	
//This is the author field
$fields['author'] = '<p class="comment-input-wrap pad comment-name"><label class="comment-label" for="author">' . __( 'Name','truethemes_localize' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label>'.
					'<input id="author" name="author" type="text" tabindex="1" class="comment-input" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></p>';

//This is the email field
$fields['email'] = '<p class="comment-input-wrap pad comment-email"><label class="comment-label"  for="email">' . __( 'Email','truethemes_localize' ) . ( $req ? ' <span class="required">*</span> <em>(will not be published)</em>' : '' ) . '</label> ' .
				   '<input id="email" name="email" type="text" tabindex="2" class="comment-input" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></p>';

//This is website field
$fields['url'] = '<p class="comment-input-wrap comment-website"><label class="comment-label" for="url">' . __( 'Website','truethemes_localize' ) . '</label>' .
		         '<input id="url" name="url" type="text" tabindex="3" class="comment-input" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></p>';

return $fields;
}
add_filter('comment_form_default_fields','tt_contact_form_fields');




/*-------------------------------------------------------------------------*/
/*    Remove <!--nextpage--> from posts page, archive, category or tag.
/*-------------------------------------------------------------------------*/
/*
* Remove <!--nextpage--> from posts page, archive, category or tag.
* so as not to break the word limiting
* in function limit_content().
* @since 2.6 development
* @param string $content, contains the whole post content.
*/
function truethemes_remove_nextpage($content){

	global $wp_query;
	$is_posts_page = $wp_query->is_posts_page;
		
	//check if is posts page, archive, category or tag.
	if(is_home()||$is_posts_page==1||is_archive()||is_category()||is_tag()||is_page_template('index.php')){
	
	//we explode content and use only first part of array.
   	$content = explode('<!--nextpage-->',$content);
   	//return back first part of content to WordPress.
	return $content[0];
	}else{
	//other pages, we do nothing to it.
	return $content;
	}


}
add_filter('the_content','truethemes_remove_nextpage',8); // let the filter run early.

/*
 * codes fork from _wp_link_page() in wp-includes/post-template.php
 * helper function for wp_link_pages()
 * @since version 2.6
 * used in truethemes_link_pages()
*/
function _truethemes_link_page( $i ) {
	global $post, $wp_rewrite;

	if ( 1 == $i ) {
		$url = get_permalink();
	} else {
		if ( '' == get_option('permalink_structure') || in_array($post->post_status, array('draft', 'pending')) )
			$url = esc_url(add_query_arg( 'page', $i, get_permalink() ));
		elseif ( 'page' == get_option('show_on_front') && get_option('page_on_front') == $post->ID )
			$url = trailingslashit(get_permalink()) . user_trailingslashit("$wp_rewrite->pagination_base/" . $i, 'single_paged');
		else
			$url = trailingslashit(get_permalink()) . user_trailingslashit($i, 'single_paged');
	}
    
    //added extra style class "wp_link_pages" in case needed for styling.
	return '<a class="page wp_link_pages" href="' . esc_url( $url ) . '">';
}

 
/**
 * The formatted output of a list of pages in single.php, page.php and all page templates
 * codes fork from wp_link_pages() in wp-includes/post-template.php
 * @since version 2.6
 */
function truethemes_link_pages($args = '') {

$defaults = array(
    'before'           => '<div class="karma-pages">',
    'after'            => '</div>',
    'link_before'      => '<span class="page">',
    'link_after'       => '</span>',
    'next_or_number'   => 'number',
	'pagelink' => '%'
);

	$r = wp_parse_args( $args, $defaults );
	$r = apply_filters( 'wp_link_pages_args', $r );
	extract( $r, EXTR_SKIP );

	global $page, $numpages, $multipage, $more, $pagenow;
	    
	$output = '';
	if ( $multipage ) {
		if ( 'number' == $next_or_number ) {
		    $output .= $before;
			$output .= "<span class='pages'>Page ".$page." of ".$numpages."</span>";
			for ( $i = 1; $i < ($numpages+1); $i = $i + 1 ) {
				$j = str_replace('%',$i,$pagelink);
				$output .= ' ';
				if ( ($i != $page) || ((!$more) && ($page==1)) ) {
					$output .= _truethemes_link_page($i);
				}
				
				//current page <span> class
				if($i == $page){
				$link_before = '<span class="current">';
				}else{
				$link_before = '';
				}
				
				//current page <span> class
				if($i == $page){
				$link_after = '</span>';
				}else{
				$link_after = '';
				}
								
				$output .= $link_before . $j . $link_after;
				if ( ($i != $page) || ((!$more) && ($page==1)) )
					$output .= '</a>';
			}
			$output .= $after;
		} 

	}

		echo $output;
}


/**
 * Use to get crop image src from WordPress uploads or external sources.
 *
 * Uses vt_resize() from framework/truethemes/image-thumbs.php
 * for resizing media uploaded image.
 *
 * Trigger timthumb script from framework/extended/timthumb/timthumb.php
 * for pulling and resizing external image, by providing request url.
 *
 * dynamically crops image instead of using add_image_size() and the_post_thumbnail()
 * 
 * @since 2.3.1
 *
 * @param string $image_path, contains image url
 * @param int $width, contains width to crop image
 * @param int $height, contains height to crop image.
 * @return string $image_src, image src.
 */

function truethemes_crop_image($thumb=null,$image_path=null,$width,$height){
 
//first try, assuming image is internal.
//use image-thumbs.php to get WordPress Uploaded photo.
$image_output = array();
$image_output = vt_resize($thumb,$image_path,$width,$height,true);
$image_src = (string) $image_output['url'];
 
//second try, if there is no image_src returned from first try, we assume is external
//we get it from external using timthumbs.
    if(empty($image_src)){
 
        //get PHP loaded extension names array, for checking of curl and gd extension
        $extensions = get_loaded_extensions();
 
        //check for curl extension, if not installed disable script,
        //return original input image url.
        if(!in_array('curl',$extensions)){
        return;
        }  
 
        //check for gd extension, if not installed disable script
        if(!in_array('gd',$extensions)){
        return;
        }
 
        //passed all checks for PHP extensions required by timthumb.
        //we construct the timthumb url for image_src
 
        if(is_multisite()){
        //multisite timthumb request url - to tested online.
 
        if(!empty($image_path)){
 
        global $blog_id;
        if (isset($blog_id) && $blog_id > 0) {
            $imageParts = explode('/files/', $image_path);
            if (isset($imageParts[1])) {
                $theImageSrc = '/blogs.dir/' . $blog_id . '/files/' . $imageParts[1];
            }
        }      
 			//check whether image is internal, using GD image library's function getimagesize()
        	$check_url = WP_CONTENT_URL.$theImageSrc;
            $size = @getimagesize($check_url);
        	if(!empty($size)){
        	//this is internal image.
        	$image_src = TIMTHUMB_SCRIPT_MULTISITE."?src=$theImageSrc&amp;h=$height&amp;w=$width";
        	}else{
        	//if not, we assume it to be external image.
        	$image_src = TIMTHUMB_SCRIPT_MULTISITE."?src=$image_path&amp;h=$height&amp;w=$width";        	
        	}
        }
 
        }else{
        //single site timthumb request url
	        
			/* @since karma 4.0 added ability to disable timthumb cropping for external hosted image. */
	        $disable_timthumb = get_option("ka_deactivate_timthumb");
	        if($disable_timthumb == 'true'){
	        	if(!empty($image_path)){
		        $image_src = $image_path;
		        }
	        }else{ 
	        	if(!empty($image_path)){
	        	$image_src = TIMTHUMB_SCRIPT."?src=$image_path&amp;h=$height&amp;w=$width";
		        }
	        }
 
        }
 
    }
 
    //that's all, we return $image src.
    return $image_src;
 
}



/*-------------------------------------------------------------------------*/
/*    Use to generate image for portfolio page templates.
/*-------------------------------------------------------------------------*/
/**
 * @since 2.3
 *
 * @param string $image_src, contains image url
 * @param int $image_width, contains width of image
 * @param int $height_height, contains height of image.
 * @param string $linkpost, contains url of post link
 * @param string $portfolio_full, contains url link for lightbox, can be videos too.
 * @param string $posttitle, image title attribute.
 * @paran $zoon_image_extension, for constructing zoom image according to size.
 * @return string $html, output of image and its lightbox or link.
 */

function truethemes_generate_portfolio_image($image_src,$image_width,$image_height,$linkpost,$portfolio_full,$phototitle,$zoom_image_extension){

//Allow plugins/themes to override this layout.
//refer to http://codex.wordpress.org/Function_Reference/add_filter for usage
$html = apply_filters('truethemes_generate_portfolio_image_filter','',$image_src,$image_width,$image_height,$linkpost,$portfolio_full,$phototitle,$zoom_image_extension);
if ( $html != '' ){
	return $html;
}

		
//began normal layout		

if(empty($linkpost)){
//regular portfolio item.

$html .= "<a href='$portfolio_full' class='attachment-fadeIn' data-gal='prettyPhoto[gal]' title='$phototitle'>";

}else{
//portfolio that links to url.

$html .= "<a href='$linkpost' class='attachment-fadeIn' title='$phototitle'>";

}

if(empty($linkpost)){
//regular gallery item - load zoom icon
$html .='<div class="lightbox-zoom zoom-'.$zoom_image_extension.'" style="position:absolute; display: none;">&nbsp;</div>';


}else{
//post link url - load arrow icon
$html .='<div class="lightbox-zoom zoom-'.$zoom_image_extension.' zoom-link" style="position:absolute; display: none;">&nbsp;</div>';

}

//this is the actual image.
$html .= "<img src='$image_src' width='$image_width' height='$image_height' alt='$title' />";


//there is a link tag, we have to end it.
$html .='</a>';


//that's all!
return $html;

}



/*-------------------------------------------------------------------------*/
/*   Retrieve all site option setting and put in a global object
/*-------------------------------------------------------------------------*/
/** 
*
* @since 2.6 development
*
* return array object $site_option_object
*/

class truethemes_site_option{

		function truethemes_site_option(){
		
		//use option value from of_template, 
		//this values contains the theme layout array.
		//use print_r to see the multi-dimension array key and values.
		$option_template_items = get_option('of_template');

		$op_count = count($option_template_items);
		
		//set empty site option name array container.
		$site_option_name = array();
		
		for($index = 0; $index < $op_count; $index ++){
			
			//we only add in theme option name which is the id array key
			if(!empty($option_template_items[$index]['id'])){
			$site_option_name[] = $option_template_items[$index]['id'];
			}    			
		}

		//print_r($site_option_name); //to see array of site option name.
		//assign for use in set_all();
        $this->site_option_name = $site_option_name;
		}
	  
		function get($option_name){
		$option_value = get_option($option_name);
		return $option_value;
		}

		function set_all(){
		
		//set empty site option array.
		$site_option = array();
		
		//get total number of options
		$count = count($this->site_option_name);
		$site_option_name = $this->site_option_name;
		
		//use for loop to get all option values from options tabls.
		for($i = 0; $i < $count ; $i++){
		
		//get option value.
		$option_value = $this->get($site_option_name[$i]);
		
		//construct $site_option array by using 
		//option name as key and option value as value
		//$site_option['ka_site_logo'] = some value
		
        $site_option[$site_option_name[$i]] = $option_value;
		
		}
		
		//cast built site option array into object					
		$site_option_object = (object) $site_option;
		
		//return array object.
		return $site_option_object;	  
		}

}


/*-------------------------------------------------------------------------*/
/*    Modify custom metaboxes to be able to arrange them in tabs
/*-------------------------------------------------------------------------*/
function B_metabox_tabber($meta_boxes) {
    foreach ($meta_boxes as $key=>$value) {
        if ($value['context'] == 'normal') {
            $meta_boxes[$key]['id'] = 'b_tabbed_meta_box_' . $meta_boxes[$key]['id'];
        }
    }

    return $meta_boxes;
}

// The add_filter call where the function that defines the meta boxes is hooked
// has no priority argument. That gives it the default priority of 10. We set
// priority to 11 here so we know the function will receive the defined meta
// boxes, and not an empty array.
add_filter('cmb_meta_boxes', 'B_metabox_tabber', 11);

function B_metabox_tabber_js() {
$screen = get_current_screen();

	if($screen->id == 'page'){
    	wp_enqueue_script('B_metabox_tabber', TRUETHEMES_JS . '/B_metabox_tabber.js', array('jquery', 'jquery-ui-tabs'), false, true);
    //wp_enqueue_style('B_metabox_tabber_css', TRUETHEMES_HOME . '/framework/admin/tabbed_metaboxes.css');
    }
}

add_action('admin_enqueue_scripts', 'B_metabox_tabber_js');
?>
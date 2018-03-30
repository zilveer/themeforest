<?php
global $post;
function df_register_my_session() {
  	if(!session_id()){
    	session_start();
 	}
}

add_action('init', 'df_register_my_session');


function trendyblog_category_popular( $query ) {
    if ( $query->is_category() && $query->is_main_query() ) {
    	$list_type = df_get_custom_option( get_cat_id( single_cat_title("",false) ), 'list_type', false );
    	if($list_type == "popular") {
	        $query->set( 'orderby', 'meta_value_num' );
	        $query->set( 'meta_key', "_".THEME_NAME.'_post_views_count' );
    	}

    }
}
add_action( 'pre_get_posts', 'trendyblog_category_popular' );


function df_remove_html_slashes($content) {
	return filter_var(stripslashes($content), FILTER_SANITIZE_SPECIAL_CHARS);
}

function df_new_excerpt_length($length) {
	return 30;
}

function df_new_excerpt_length_7($length) {
	return 7;
}

function df_new_excerpt_length_10($length) {
	return 10;
}

function df_new_excerpt_length_16($length) {
	return 16;
}

function df_new_excerpt_length_20($length) {
	return 20;
}

function df_new_excerpt_length_30($length) {
	return 30;
}

function df_new_excerpt_length_40($length) {
	return 40;
}

function df_new_excerpt_length_50($length) {
	return 50;
}

function df_new_excerpt_length_60($length) {
	return 60;
}
function df_new_excerpt_length_70($length) {
	return 70;
}
function df_new_excerpt_length_80($length) {
	return 80;
}

function df_new_excerpt_length_100($length) {
	return 100;
}

function df_new_excerpt_length_5($length) {
	return 5;
}

function df_new_excerpt_more($more) {
	return '';
}
function df_new_excerpt_more_2($more) {
	return '<a href="'.esc_url(get_permalink()).'" class="read-more-link">'.esc_html__("More", THEME_NAME).'</a>';
}

function df_remove_objects($content) {
	$content = preg_replace('/\<div(.*?)\>(.*?)\<\/div\>/s', '', $content);
	$content = preg_replace('/\<object(.*?)\>(.*?)\<\/object\>/s', '', $content);
	$content = preg_replace('/\<iframe(.*?)\>(.*?)\<\/iframe\>/s', '', $content);
	return $content;
}

function df_remove_images($content) {
	$content = preg_replace('#(<[/]?a.*><[/]?img.*></a>)#U', '', $content);
	$content = preg_replace('#(<[/]?img.*>)#U', '', $content);
	$content = preg_replace("/\[caption(.*)\](.*)\[\/caption\]/Usi", "", $content);
    return $content;
}

function df_filter_where( $where = '' ) {
	// posts in the last 30 days
	$where .= " AND post_date > '" . date('Y-m-d', strtotime('-30 days')) . "'";
	return $where;
}

function df_page_read_more($content) {
	$result = preg_split('/<span id="more-\d+"><\/span>/', $content);
	return $result[0];
}

/* -------------------------------------------------------------------------*
 * 							BBPRESS BREADCRUMB 								*
 * -------------------------------------------------------------------------*/
function bm_bbp_no_breadcrumb ($param) {
	return true;
}
if(df_get_option(THEME_NAME."_breadcrumb")=="on") {
	add_filter ('bbp_no_breadcrumb', 'bm_bbp_no_breadcrumb');
}

/* -------------------------------------------------------------------------*
 * 							REMOVE WOOCOMMERCE TITLE								*
 * -------------------------------------------------------------------------*/

function df_woo_title() {
	return false;
}
add_filter('woocommerce_show_page_title', 'df_woo_title');


/* -------------------------------------------------------------------------*
 * 						CUSTOM BLOG READ MORE BUTTON						*
 * -------------------------------------------------------------------------*/
function DF_read_more($matches) {
	return '<p>'.$matches[1].'</p> <a '.$matches[3].' class="small-button"><span class="icon">&#59154;</span>'.$matches[4].'</a>';
}
				
	
function df_blog_read_more($content) {
	return preg_replace_callback('#(.*)(<a(.*) class="more-link">(.*)</a>(.*))#', "DF_read_more", $content);
}

/* -------------------------------------------------------------------------*
 * 						CUSTOM HOME READ MORE BUTTON						*
 * -------------------------------------------------------------------------*/
 
function df_home_read_more($content) {
    $content = preg_replace('#(<a(.*) class="more-link">(.*)</a>)#U', '</p><a $2 class="more-link"><span>$3</span></a>', $content);
    return $content;
}

if(!function_exists('BigFirstChar')) {
	function BigFirstChar ($content = '') {
		$content = preg_replace('/<p>/', '<p class="caps">',$content, 1);
		return $content;
	}
}


/* -------------------------------------------------------------------------*
 * 							WORD LIMITER									*
 * -------------------------------------------------------------------------*/

function df_WordLimiter($string, $count){

	$string = esc_html__(preg_replace('/\[\/.*?\]/', '', preg_replace('/\[.*?\]/', '', $string)));

	$words = explode(' ', $string);
	if (count($words) > $count){
		array_splice($words, $count);
		$string = implode(' ', $words);
	}
	return $string."...";
}


function convert_to_class($name){
	return strtolower( str_replace( array(' ',',','.','"',"'",'/',"\\",'+','=',')','(','*','&','^','%','$','#','@','!','~','`','<','>','?','[',']','{','}','|',':',),'',$name ) );
}

/* -------------------------------------------------------------------------*
 * 							AVATAR URL									*
 * -------------------------------------------------------------------------*/
 
function df_get_avatar_url($get_avatar){
    if(preg_match("/src='(.*?)'/i", $get_avatar, $matches)) {
    	preg_match("/src='(.*?)'/i", $get_avatar, $matches);
   		return $matches[1];
    } else {
    	preg_match("/src=\"(.*?)\"/i", $get_avatar, $matches);
   		return $matches[1];
    }
}

/* -------------------------------------------------------------------------*
 * 							CUSTOM USER PROFILE								*
 * -------------------------------------------------------------------------*/
 
function DF_extra_contact_info($contactmethods) {
    unset($contactmethods['aim']);
    unset($contactmethods['yim']);
    unset($contactmethods['jabber']);
    $contactmethods['twitter'] = esc_html__('Twitter Account Url', THEME_NAME);
    $contactmethods['facebook'] = esc_html__('Facebook Account Url', THEME_NAME);
 	$contactmethods['google'] = esc_html__('Google+ Account Url', THEME_NAME);  
    $contactmethods['youtube'] = esc_html__('Youtube Account Url', THEME_NAME);
    $contactmethods['dribbble'] = esc_html__('Dribbble Account Url', THEME_NAME);
    $contactmethods['linkedin'] = esc_html__('LinkedIn Account Url', THEME_NAME);
    


    return $contactmethods;
}



/* -------------------------------------------------------------------------*
 * 							CUSTOM COMMENT FIELDS							*
 * -------------------------------------------------------------------------*/
 
function DF_fields($fields) {
	$commenter = wp_get_current_commenter();
	
	$fields['author'] = '<p><label for="c_name">'.esc_html__("Nickname",THEME_NAME).' <span class="required">*</span></label><input value="'.esc_attr( $commenter['comment_author'] ).'" type="text" placeholder="'.esc_html__("Nickname",THEME_NAME).'" name="author" id="author"></p>';
	$fields['email'] = '<p><label for="c_email">'.esc_html__("E-mail",THEME_NAME).' <span class="required">*</span></label><input value="'.esc_attr( $commenter['comment_author_email'] ).'" type="text" placeholder="'.esc_html__("E-mail",THEME_NAME).'" name="email" id="email"></p>';
	$fields['url'] = '<p><label for="c_webside">'.esc_html__("Website",THEME_NAME).'</label><input value="'.esc_attr( $commenter['comment_author_url'] ).'"type="text" placeholder="'.esc_html__("Website",THEME_NAME).'" name="url" id="url"></p>';

	return $fields;
}

/* -------------------------------------------------------------------------*
 * 							CUSTOM COMMENT FIELDS							*
 * -------------------------------------------------------------------------*/
 
function DF_fields_rules($fields) {
	/*
	$fields['rules'] = '
						<p class="comment-info">
							<i class="fa fa-info"></i>
							<strong>'.esc_html__("Your data will be safe!", THEME_NAME).'</strong>
							<span>'.esc_html__( 'Your e-mail address will not be published. Also other data will not be shared with third person. Required fields marked as ', THEME_NAME ).'<span class="c_required">*</span</span>
						</p>
	';
	*/
	if(isset($_GET[ 'c' ]) && $_GET[ 'c' ] == 'y') {
		$fields['rules'] = '
		<div class="alert_message green" style="margin-bottom: 5px"><p>'.esc_html__( "Your comment has been successfully added and it's awaiting moderation." , THEME_NAME ).'</p></div>
		';
	}
	if(isset($fields['rules'])) {
		print $fields['rules'];	
	} else {
		return false;
	}

}

/* -------------------------------------------------------------------------*
 * 								REDIRECT AFTER COMMENT		 					*
 * -------------------------------------------------------------------------*/

add_filter('comment_post_redirect', 'df_redirect_after_comment');
function df_redirect_after_comment($location){
    $newurl = substr($location, 0, strpos($location, "#comment"));
    $comment = explode( "#", $location );
    return $newurl.'?c=y'.'#'.$comment[1];
}


/* -------------------------------------------------------------------------*
 * 									YOUTUBE									*
 * -------------------------------------------------------------------------*/
 
function DF_youtube_image( $link ) {

	$ytarray=explode("/", $link);
	$ytendstring=end($ytarray);
	$ytendarray=explode("?v=", $ytendstring);
	$ytendstring=end($ytendarray);
	$ytendarray=explode("&", $ytendstring);
	$ytcode=$ytendarray[0];
	
	
	return $ytcode;


}	

/* -------------------------------------------------------------------------*
 * 							CUSTOM WP TITLE									*
 * -------------------------------------------------------------------------*/
 
function df_wp_title(  ) {

	if ( is_single() ) { 
		$title = single_post_title('',false).' | '.get_bloginfo('name');
	} elseif ( is_home() || is_front_page() ) { 
		$title = get_bloginfo('name'); 
		if(get_bloginfo('description')) { 
			$title.= ' | '.get_bloginfo('description'); 
		} 
	} elseif ( is_page() ) { 
		$title = single_post_title('',false); 
		if(get_bloginfo('description')) { 
			$title.=  ' | '.get_bloginfo('description'); 
		} 
	} elseif ( is_search() ) { 
		$title = get_bloginfo('name'); 
		$title.= ' | Search results '; 
		if(isset($s))
			$title.=  esc_html($s)
		; 
	} elseif ( is_404() ) { 
		$title = get_bloginfo('name').' | Page not found'; 
	} else { 
		$title = get_bloginfo('name').' | '.get_the_title(); 
	}
	
	
	return $title;


}	


/* -------------------------------------------------------------------------*
 * 		ADDING A CSS CLASS TO EACH LINK OF the_author_posts_link()			*
 * -------------------------------------------------------------------------*/

function the_author_posts_link_css_class($output) {
	$output= preg_replace('#(<a(.*)>(.*)</a>)#U', '<a $2 class="article-meta-data"><i class="fa fa-user"></i>$3</a>', $output);
    return $output;
}	
function the_author_posts_link_css_class_2($output) {
	$output= preg_replace('#(<a(.*)>(.*)</a>)#U', '<a $2 class="meta-data">$3</a>', $output);
    return $output;
}		
function the_author_posts_link_css_class_3($output) {
	$output= preg_replace('#(<a(.*)>(.*)</a>)#U', '<a $2 class="meta-author"><i class="fa fa-user"></i>$3</a>', $output);
    return $output;
}								

function the_author_posts_link_css_class_single($output) {
	$output= preg_replace('#(<a(.*)>(.*)</a>)#U', '<a $2 class="article-meta-block"><i class="fa fa-user"></i>$3</a>', $output);
    return $output;
}


load_theme_textdomain(THEME_NAME, get_template_directory() . '/languages');
	$locale = get_locale();
	$locale_file = get_template_directory() . "/languages/$locale.php";
	if ( is_readable( $locale_file ) )
		require_once( $locale_file );



/* -------------------------------------------------------------------------*
 * 								ATTACHMENT SIZE			 					*
 * -------------------------------------------------------------------------*/

function df_attachment($p) {
   $p = '<p class="attachment">';
 	 // show the medium sized image representation of the attachment if available, and link to the raw file
	$p .= wp_get_attachment_link(0, 'full', false);
	$p .= '</p>';

	return $p;
}
//add_filter('the_content', 'BigFirstChar');	
add_filter('prepend_attachment', 'df_attachment');	
add_filter('excerpt_length', 'df_new_excerpt_length');
add_filter('excerpt_more', 'df_new_excerpt_more');

add_filter('the_author_posts_link','the_author_posts_link_css_class');

add_filter('user_contactmethods', 'DF_extra_contact_info');
add_filter('comment_form_default_fields','DF_fields');
add_filter( 'wp_title', 'df_wp_title', 10, 2 );

?>
<?php
/**
 * @package by Theme Record
 * @auther: MattMao
 *
 * 1--Get meta boxes
 * 2--Get image url by id
 * 3--Get the featured image
*/

#
# Get meta boxes
#
function get_meta_option($var, $post_id=NULL) 
{
	$prefix = 'TR_';

	if($post_id) return get_post_meta($post_id, $prefix.$var, true);
    global $post;
    return get_post_meta($post->ID, $prefix.$var, true);
}


#
#Get image url by id
#
function get_image_url($post_id=NULL)
{	
	if($post_id)
	{ 
		$image_wp = wp_get_attachment_image_src($post_id,'full', true);
	}	
	else
	{
		$image_wp = wp_get_attachment_image_src(get_post_thumbnail_id(),'full', true); 
	}
	return $image_wp[0];	
}


#
#Get the featured image
#
function get_featured_image($post_id, $size, $class, $title)
{
	if($class == NULL) { $class = 'wp-featured-image'; } else { $class = $class . ' wp-featured-image'; }
	if($post_id == NULL) { $post_id = get_post_thumbnail_id(); }
	$wp_featured_image = wp_get_attachment_image_src($post_id, $size, true);

	$src = $wp_featured_image[0];
	$width = $wp_featured_image[1];
	$height = $wp_featured_image[2];
	
	$output = '<img width="'.$width.'" height="'.$height.'" src="'.$src.'" class="'.$class.'" alt="'.$title.'" title="'.$title.'" />';

	return $output;
}


#
#Get page name by id
#
function get_page_name($id) 
{
	$page = get_page($id);

	if ($page) {
        return $page->post_title;
    } else {
        return null;
    }
}



#
#This function shortens a string, Use for comments
#
function theme_max_char($string, $limit, $break=".", $pad="...") 
{
	if(strlen($string) <= $limit) return $string;
	
	if(false !== ($breakpoint = strpos($string, $break, $limit))) 
	{ 
		if($breakpoint < strlen($string) - 1) 
		{ 
			$string = substr($string, 0, $breakpoint) . $pad; 
		} 
	} 
	return $string; 
}



#
#The description
#
function theme_description($max_char) 
{
	$desc = get_the_excerpt();

	if($desc) {

		return theme_excerpt($max_char);

	}else{

	    return theme_content($max_char);

	}
}



#
#The content
#
function theme_content($max_char) 
{
	$content = get_the_content();
	$content = preg_replace('/\[.+\]/','', $content);
	$content = apply_filters('the_content', $content);
	$content = str_replace(']]>', ']]&gt;', $content);
	$content = strip_tags($content);
	if ((strlen($content)>$max_char) && ($espacio = strpos($content, " ", $max_char ))) {
		$content = substr($content, 0, $espacio);
		$content = $content;
		return $content.'...';
	}
	else {
		return $content;
	}
}



#
#The excerpt
#
function theme_excerpt($max_char)
{
	$excerpt = get_the_excerpt();
	$excerpt = preg_replace('/\[.+\]/','', $excerpt);
	$excerpt = apply_filters('the_excerpt', $excerpt);
	$excerpt = str_replace(']]>', ']]&gt;', $excerpt);
	$excerpt = strip_tags($excerpt);
	if ((strlen($excerpt)>$max_char) && ($espacio = strpos($excerpt, " ", $max_char ))) {
		$excerpt = substr($excerpt, 0, $espacio);
		$excerpt = $excerpt;
		return $excerpt.'...';
	}
	else {
		return $excerpt;
	}
}



#
#Currency Symbol For Product
#
function price_currency_symbol($currency)
{
	switch($currency)
	{
		case 'AUD': $currency_symbol = '&#36;'; break;
		case 'BRL': $currency_symbol = '&#82;&#36;'; break;
		case 'CAD': $currency_symbol = '&#36;'; break;
		case 'CZK': $currency_symbol = '&#75;&#269;'; break;
		case 'DKK': $currency_symbol = '&#107;&#114;'; break;
		case 'EUR': $currency_symbol = '&euro;'; break;
		case 'HKD': $currency_symbol = '&#36;'; break;
		case 'HUF': $currency_symbol = '&#70;&#116;'; break;
		case 'ILS': $currency_symbol = '&#8362;'; break;
		case 'JPY': $currency_symbol = '&yen;'; break;
		case 'MYR': $currency_symbol = '&#82;&#77;'; break;
		case 'MXN': $currency_symbol = '&#36;'; break;
		case 'NOK': $currency_symbol = '&#107;&#114;'; break;
		case 'NZD': $currency_symbol = '&#36;'; break;
		case 'PHP': $currency_symbol = '&#8369;'; break;
		case 'PLN': $currency_symbol = '&#122;&#322;'; break;
		case 'GBP': $currency_symbol = '&pound;'; break;
		case 'SGD': $currency_symbol = '&#36;'; break;
		case 'SEK': $currency_symbol = '&#107;&#114;'; break;
		case 'CHF': $currency_symbol = '&#67;&#72;&#70;'; break;
		case 'TWD': $currency_symbol = '&#78;&#84;&#36;'; break;
		case 'THB': $currency_symbol = '&#3647;'; break;
		case 'TRY': $currency_symbol = '&#84;&#76;'; break;
		case 'USD': $currency_symbol = '&#36;'; break;
	}

	return $currency_symbol;
}



#
#Get post id by meta
#
function get_order_txn_id($txnid_value) { 
   $txn_id_args = array(
		'post_type' => 'shop_order',
		'meta_query' => array(
			array(
				'key' => '_txn_id',
				'value' => $txnid_value,
				'compare' => '='
			)
		)
	);

	$txn_id = count(get_posts( $txn_id_args ));

	return $txn_id;
}



//convert links to clickable format
if ( !function_exists('twitter_convert_links') )
{
	function twitter_convert_links($status,$targetBlank=true,$linkMaxLen=250){
	 
		// the target
			$target=$targetBlank ? " target=\"_blank\" " : "";
		 
		// convert link to url
			$status = preg_replace("/((http:\/\/|https:\/\/)[^ )]+)/e", "'<a href=\"$1\" title=\"$1\" $target >'. ((strlen('$1')>=$linkMaxLen ? substr('$1',0,$linkMaxLen).'...':'$1')).'</a>'", $status);
		 
		// convert @ to follow
			$status = preg_replace("/(@([_a-z0-9\-]+))/i","<a href=\"http://twitter.com/$2\" title=\"Follow $2\" $target >$1</a>",$status);
		 
		// convert # to search
			$status = preg_replace("/(#([_a-z0-9\-]+))/i","<a href=\"https://twitter.com/search?q=$2\" title=\"Search $1\" $target >$1</a>",$status);
		 
		// return the status
			return $status;
	}
}

//convert dates to readable format
if ( !function_exists('twitter_relative_time') )
{
	function twitter_relative_time($a) {
		//get current timestampt
		$b = strtotime("now"); 
		//get timestamp when tweet created
		$c = strtotime($a);
		//get difference
		$d = $b - $c;
		//calculate different time values
		$minute = 60;
		$hour = $minute * 60;
		$day = $hour * 24;
		$week = $day * 7;
			
		if(is_numeric($d) && $d > 0) {
			//if less then 3 seconds
			if($d < 3) return "right now";
			//if less then minute
			if($d < $minute) return floor($d) . " seconds ago";
			//if less then 2 minutes
			if($d < $minute * 2) return "about 1 minute ago";
			//if less then hour
			if($d < $hour) return floor($d / $minute) . " minutes ago";
			//if less then 2 hours
			if($d < $hour * 2) return "about 1 hour ago";
			//if less then day
			if($d < $day) return floor($d / $hour) . " hours ago";
			//if more then day, but less then 2 days
			if($d > $day && $d < $day * 2) return "yesterday";
			//if less then year
			if($d < $day * 365) return floor($d / $day) . " days ago";
			//else return more than a year
			return "over a year ago";
		}
	}
}
?>
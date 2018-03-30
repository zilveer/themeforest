<?php
/**
 * REMOVE Nested Paragraph Tags from Shortcodes
 */
function shortcode_empty_paragraph_fix($content){   
    $array = array (
        '<p>[' => '[', 
        ']</p>' => ']', 
        ']<br />' => ']'
    );

    $content = strtr($content, $array);
    return $content;
}
add_filter('the_content', 'shortcode_empty_paragraph_fix');
/**
 * RESPONSIVE IMAGE FUNCTIONS
 */
add_filter( 'post_thumbnail_html', 'remove_thumbnail_dimensions', 10 );
add_filter( 'image_send_to_editor', 'remove_thumbnail_dimensions', 10 ); 
function remove_thumbnail_dimensions( $html ) {
        $html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
        return $html;
}
class description_walker extends Walker_Nav_Menu
{
      function start_el(&$output, $item, $depth, $args)
      {
           global $wp_query;
           $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

           $class_names = $value = '';

           $classes = empty( $item->classes ) ? array() : (array) $item->classes;

           $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
           $class_names = ' class="'. esc_attr( $class_names ) . '"';

           $output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';

           $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
           $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
           $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
           $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

           $prepend = '<strong>';
           $append = '</strong>';
           $description  = ! empty( $item->description ) ? '<span>'.esc_attr( $item->description ).'</span>' : '';

           if($depth != 0)
           {
                     $description = $append = $prepend = "";
           }

            $item_output = $args->before;
            $item_output .= '<a'. $attributes .'>';
            $item_output .= $args->link_before .$prepend.apply_filters( 'the_title', $item->title, $item->ID ).$append;
            $item_output .= $description.$args->link_after;
            $item_output .= '</a>';
            $item_output .= $args->after;

            $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
            }
}
/*-------------------------------------------------------------------------*/
/* Check for shortcode */
/*-------------------------------------------------------------------------*/
// check the current post for the existence of a short code  
function theme_got_shortcode($shortcode = '') {  
  
	$post_to_check = get_post(get_the_ID());  
  
	// false because we have to search through the post content first  
	$found = false;  
  
	// if no short code was provided, return false  
	if (!$shortcode) {  
		return $found;  
	}  
	// check the post content for the short code  
	if ( stripos($post_to_check->post_content, '[' . $shortcode) !== false ) {  
		// we have found the short code  
		$found = true;  
	}  
  
	// return our final results  
	return $found;  
}
function get_select_target_options($type) {
        $list_options = array();
        switch($type){
			case 'post':
				$the_list = get_posts('orderby=title&numberposts=-1&order=ASC');
				foreach($the_list as $key => $list) {
					$list_options[$list->ID] = $list->post_title;
				}
				break;
			case 'page':
				$the_list = get_pages('title_li=&orderby=name');
				foreach($the_list as $key => $list) {
					$list_options[$list->ID] = $list->post_title;
				}
				break;
			case 'category':
				$the_list = get_categories('orderby=name&hide_empty=0');
				foreach($the_list as $key => $list) {
					$list_options[$list->term_id] = $list->name;
				}
				break;
			case 'portfolio_category':
				$the_list = get_categories('taxonomy=types&title_li=');
				foreach($the_list as $key => $list) {
					$list_options[$list->slug] = $list->name;
				}
				array_unshift($list_options, "All the items");
				break;
		}
		
		return $list_options;
	}
	
function mtheme_posted_on() {
	echo '<div class="post-meta-info">';
	echo '<div class="posted-in">' . _e('Posted in ','mthemelocal') . " " .  the_category(', ') ."</div>";
	printf( __( '<span class="sep">Posted on </span><a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s" pubdate>%4$s</time></a><span class="by-author"> <span class="sep"> by </span> <span class="author vcard"><a class="url fn n" href="%5$s" title="%6$s" rel="author">%7$s</a></span></span>', 'mthemelocal' ),
		esc_url( get_permalink() ),
		esc_attr( get_the_time() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		sprintf( esc_attr__( 'View all posts by %s', 'mthemelocal' ), get_the_author() ),
		esc_html( get_the_author() )
	);
	echo '<span class="comments">';
	comments_popup_link('No Comments', '1 Comment', '% Comments');
	echo '</span>';
	echo '</div>';
}
/*-------------------------------------------------------------------------*/
/* Converts a WP menu to a Drop down menu
/*-------------------------------------------------------------------------*/
function Menu_to_SelectMenu ($menu_name,$class_ID, $level_symbol,$menu_title) {
	//Custom code
    if ( ( $locations = get_nav_menu_locations() ) && isset( $locations[ $menu_name ] ) ) {
	$menu = wp_get_nav_menu_object( $locations[ $menu_name ] );

	$menu_items = wp_get_nav_menu_items($menu->term_id);

	$menu_list = '<select id="'. $class_ID .'">';
	$menu_list .= '<option value="#">'.$menu_title.'</option>';

	foreach ( (array) $menu_items as $key => $menu_item ) {
	    $title = $menu_item->title;
	    $url = $menu_item->url;
		
		//Store Previous parent		
		$prev_parent=$parent;
		//Get Current Parent
		$parent=$menu_item->menu_item_parent;
		
		// Compare prev and curr parents
		// Increment if greater else decrement
		if ($parent > $prev_parent) {
		
			$cat_level++;
		
		}
		if ($parent < $prev_parent) {
		
			$cat_level--;
			
		}
		
		// Reset menu level
		
		$menu_level='';
		
		// Check menu level and add level symbol accordion to cat_level
		if ($parent==0) {
			$cat_level=0;
			
		} else {
			for ($n=0; $n<$cat_level; $n++) {
				$menu_level=$menu_level . "-";
			}
		}
		
	    $menu_list .= '<option value="'. $url . '">' . $menu_level . '&nbsp;' . $title . '</option>';
	}
	$menu_list .= '</select>';
    } else {
	$menu_list = '';
    }
	return $menu_list;
}
/**
 * Shortcode remove BR and P tags from shortcode
 */
/**
* If more than one page exists, return TRUE.
*/
function show_posts_nav() {
	global $wp_query;
	return ($wp_query->max_num_pages > 1);
}

function mtheme_clear_autop($content)
{
    $content = str_ireplace('<p>', '', $content);
    $content = str_ireplace('</p>', '', $content);
    $content = str_ireplace('<br />', '', $content);
    return $content;
}
add_filter('mtheme_shortcode_out_filter', 'mtheme_clear_autop');
/**
 * Shortcode cleaner - remove paragraph tags
 */
function mtheme_clean_shortcode_content( $content ) {

    /* Parse nested shortcodes and add formatting. */
    $content = trim( wpautop( do_shortcode( $content ) ) );

    /* Remove '</p>' from the start of the string. */
    if ( substr( $content, 0, 4 ) == '</p>' )
        $content = substr( $content, 4 );

    /* Remove '<p>' from the end of the string. */
    if ( substr( $content, -3, 3 ) == '<p>' )
        $content = substr( $content, 0, -3 );

    /* Remove any instances of '<p></p>'. */
    $content = str_replace( array( '<p></p>' ), '', $content );

    return $content;
}
/**
 * Sets the post excerpt length.
 */
function mtheme_excerpt_length( $length ) {
	return 55;
}
add_filter( 'excerpt_length', 'mtheme_excerpt_length' );
/*-------------------------------------------------------------------------*/
/* Shorten text to closest complete word from provided text */
/*-------------------------------------------------------------------------*/
function shortentext ($textblock, $textlen) {

	if ($textblock) {
	//$output = substr(get_the_excerpt(), 0,$textlen);
	//$temp = wordwrap(get_the_excerpt(),$textlen,'[^^^]'); $output= strtok($temp,'[^^^]');
	$output = substr(substr($textblock, 0, $textlen), 0, strrpos(substr($textblock, 0, $textlen), ' '));  
	return $output;
	}
}
/*-------------------------------------------------------------------------*/
/* Shorten text to closest complete word from ID */
/*-------------------------------------------------------------------------*/
function shortdesc ($pageid, $textlen) {

	if ($pageid) {
	$apage = new WP_Query('page_id='.$pageid); while ($apage->have_posts()) : $apage->the_post(); $do_not_duplicate = $post->ID;
	//$output = substr(get_the_excerpt(), 0,$textlen);
	//$temp = wordwrap(get_the_excerpt(),$textlen,'[^^^]'); $output= strtok($temp,'[^^^]');
	$output = substr(substr(get_the_excerpt(), 0, $textlen), 0, strrpos(substr(get_the_excerpt(), 0, $textlen), ' '));  
	endwhile;
	return $output;
	}
}
/*-------------------------------------------------------------------------*/
/* Get Parent page ID from a Page ID */
/*-------------------------------------------------------------------------*/
function get_parent_page_id($id) {
    global $post;
    // Check if page is a child page (any level)
    if ($post->ancestors) {

        //  Grab the ID of top-level page from the tree
        return end($post->ancestors);
    } else {

        // Page is the top level, so use  it's own id
        return $post->ID;
    }
}
/*-------------------------------------------------------------------------*/
/* Show featured image real link */
/*-------------------------------------------------------------------------*/
function featured_image_link ($ID) {
	$image_id = get_post_thumbnail_id($ID, 'full'); 
	$image_url = wp_get_attachment_image_src($image_id,'full');  
	$image_url = $image_url[0];
	return $image_url;
}
/*-------------------------------------------------------------------------*/
/* Show attached image link */
/*-------------------------------------------------------------------------*/
function featured_image_real_link ($ID) {
	$image_id = get_post_thumbnail_id($ID, 'full'); 
	$image_url = wp_get_attachment_image_src($image_id,'full');  
	$image_url = $image_url[0];
		
	$image=wpmu_image_path($image_url);
	return $image;
}

function activate_lightbox ($lightbox_type,$ID,$link,$mediatype,$title,$class,$navigation) {
	if ($lightbox_type=="fancybox") {
	
		if ($navigation) $gallery='rel="'.$navigation.'" ';
		
		if ($mediatype=="video") { $fancyboxclass="fancybox-video"; } else { $fancyboxclass="fancybox-image"; }
	
		$output='<a '.$gallery.'class="'.$class.' '.$fancyboxclass.'" title="'.$title.'" href="'.$link.'">';
	}
	if ($lightbox_type=="prettyPhoto") {
	
		if ($navigation) $gallery='rel="'.$navigation.'" ';
	
		$output='<a '.$gallery.'class="'.$class.'" title="'.$title.'" href="'.$link.'">';
	}
	return $output;
}
/*-------------------------------------------------------------------------*/
/* Resize images and cross check if WP MU using blog ID */
/*-------------------------------------------------------------------------*/
function showimage ($image,$link_url,$resize,$height,$width,$quality, $crop, $title,$class) {
	$image_url=$image;
	$image=wpmu_image_path($image);
	$output=""; // Set nill
	if ($link_url<>"") {
		$output = '<a href="' . $link_url . '">';
	}
	if ($resize==true) {
		if ($image) {
			if ($class) {
				$output .= '<img src="'. get_template_directory_uri() . '/timthumb.php?src='. $image .'&amp;h='. $height .'&amp;w='. $width .'&amp;zc=1&amp;q='. $quality .'" alt="'. $title .'" class="'. $class .'"/>';
			} else {
				$output .= '<img src="'. get_template_directory_uri() . '/timthumb.php?src='. $image .'&amp;h='. $height .'&amp;w='. $width .'&amp;zc=1&amp;q='. $quality .'" alt="'. $title .'"/>';
			}
		}
	}
	if ($resize==false) {
		if ($image_url) {
			if ($class) {
				$output .= '<img src="'. $image_url .'" alt="'. $title .'" class="'. $class .'"/>';
			} else {
				$output .= '<img src="'. $image_url .'" alt="'. $title .'" />';
			}
		}
	}
	if ($link_url<>"") {
		$output .= '</a>';
	}
	return $output;
}
/*-------------------------------------------------------------------------*/
/* Show featured image */
/* 
@ ID 
@ $height
@ $width
@ quality
@ $crop
@ $title
@ $class
/*-------------------------------------------------------------------------*/
function display_post_image ($ID,$have_image_url,$link,$type,$title,$class) {

	if ($type=="") $type="fullsize";
	$output="";
	
	$image_id = get_post_thumbnail_id(($ID), $type); 
	$image_url = wp_get_attachment_image_src($image_id,$type);  
	$image_url = $image_url[0];
	
	$permalink = get_permalink( $ID );
	
	if ($link==true) {
		$output = '<a href="' . $permalink . '">';
	}
	
	if ($have_image_url) {
		$output .= '<img src="'. $have_image_url .'" alt="'. $title .'" class="'. $class .'"/>';
	} else {
		if ($image_url) {
			if ($class) {
				$output .= '<img src="'. $image_url .'" alt="'. $title .'" class="'. $class .'"/>';
			} else {
				$output .= '<img src="'. $image_url .'" alt="'. $title .'" />';
			}
		}
	}
	
	if ($link==true) {
		$output .= '</a>';
	}
	
	return $output;
}
/*-------------------------------------------------------------------------*/
/* Get Page ID by Slug */
/*-------------------------------------------------------------------------*/
function get_page_id($page_slug)
{
	$page_id = get_page_by_path($page_slug);
	if ($page_id) :
		return $page_id->ID;
	else :
		return null;
	endif;
}
/*-------------------------------------------------------------------------*/
/* Get Page ID by Title */
/*-------------------------------------------------------------------------*/
function get_page_title_by_id($page_id)
{
	$page = get_post($page_id);
	if ($page) :
		return $page->post_title;
	else :
		return null;
	endif;
}
/*-------------------------------------------------------------------------*/
/* Get Page Link by Title */
/*-------------------------------------------------------------------------*/
function get_page_link_by_title($page_title) {
  $page = get_page_by_title($page_title);
  if ($page) :
    return get_permalink( $page->ID );
  else :
    return "#";
  endif;
}
/*-------------------------------------------------------------------------*/
/* Get Page link by Slug */
/*-------------------------------------------------------------------------*/
function get_page_link_by_slug($page_slug) {
  $page = get_page_by_path($page_slug);
  if ($page) :
    return get_permalink( $page->ID );
  else :
    return "#";
  endif;
}
/*-------------------------------------------------------------------------*/
/* Get Page link by ID */
/*-------------------------------------------------------------------------*/
function get_page_link_by_id($page_id) {
  $page = get_post($page_id);
  if ($page) :
    return get_permalink( $page->ID );
  else :
    return "#";
  endif;
}
/*-------------------------------------------------------------------------*/
/* Get Human Time */
/*-------------------------------------------------------------------------*/
function time_since($older_date, $newer_date = false)
	{
	//Script URI: http://binarybonsai.com/wordpress/timesince
	// array of time period chunks
	$chunks = array(
	array(60 * 60 * 24 * 365 , __('year','mthemelocal') ),
	array(60 * 60 * 24 * 30 , __('month','mthemelocal') ),
	array(60 * 60 * 24 * 7, __('week','mthemelocal') ),
	array(60 * 60 * 24 , __('day','mthemelocal') ),
	array(60 * 60 , __('hour','mthemelocal') ),
	array(60 , __('minute','mthemelocal') ),
	);
	
	// $newer_date will equal false if we want to know the time elapsed between a date and the current time
	// $newer_date will have a value if we want to work out time elapsed between two known dates
	$newer_date = ($newer_date == false) ? (time()+(60*60*get_settings("gmt_offset"))) : $newer_date;
	
	// difference in seconds
	$since = $newer_date - $older_date;
	
	// we only want to output two chunks of time here, eg:
	// x years, xx months
	// x days, xx hours
	// so there's only two bits of calculation below:

	// step one: the first chunk
	for ($i = 0, $j = count($chunks); $i < $j; $i++)
		{
		$seconds = $chunks[$i][0];
		$name = $chunks[$i][1];

		// finding the biggest chunk (if the chunk fits, break)
		if (($count = floor($since / $seconds)) != 0)
			{
			break;
			}
		}

	// set output var
	$output = ($count == 1) ? '1 '.$name : "$count {$name}s";

	// step two: the second chunk
	if ($i + 1 < $j)
		{
		$seconds2 = $chunks[$i + 1][0];
		$name2 = $chunks[$i + 1][1];
		
		if (($count2 = floor(($since - ($seconds * $count)) / $seconds2)) != 0)
			{
			// add to output var
			$output .= ($count2 == 1) ? ', 1 '.$name2 : ", $count2 {$name2}s";
			}
		}
	return $output;
}
/*-------------------------------------------------------------------------*/
/* Generate WP MU image path */
/*-------------------------------------------------------------------------*/
function wpmu_image_path ($theImageSrc) {

	if ( is_multisite() ) { 
		$blog_id=get_current_blog_id();	
		if (isset($blog_id) && $blog_id > 0) {
			$imageParts = explode('/files/', $theImageSrc);
			if (isset($imageParts[1])) {
				//$theImageSrc = $imageParts[0] . '/blogs.dir/' . $blog_id . '/files/' . $imageParts[1];
				$theImageSrc = '/blogs.dir/' . $blog_id . '/files/' . $imageParts[1];
			}
		}
	}
	return $theImageSrc;
}
/***** Numbered Page Navigation (Pagination) Code.
      Tested up to WordPress version 3.1.2 *****/
 
/* Function that Rounds To The Nearest Value.
   Needed for the pagenavi() function */
function round_num($num, $to_nearest) {
   /*Round fractions down (http://php.net/manual/en/function.floor.php)*/
   return floor($num/$to_nearest)*$to_nearest;
}
 

// Custom Pagination codes
function pagination($pages = '', $range = 4)
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
         echo '<div class="pagination-navigation">';
         echo "<div class=\"pagination\"><span class=\"pagination-info\">". __("Page ","mthemelocal") . $paged. __(" of ","mthemelocal") .$pages."</span>";
         if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'>&laquo; First</a>";
         if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."'>&lsaquo; Previous</a>";
 
         for ($i=1; $i <= $pages; $i++)
         {
             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
             {
                 echo ($paged == $i)? "<span class=\"current\">".$i."</span>":"<a href='".get_pagenum_link($i)."' class=\"inactive\">".$i."</a>";
             }
         }
 
         if ($paged < $pages && $showitems < $pages) echo "<a href=\"".get_pagenum_link($paged + 1)."\">Next &rsaquo;</a>"; 
         if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'>Last &raquo;</a>";
         echo "</div>";
         echo "</div>";
     }
}




/*
Lighten a colour

$colour = '#ae64fe';
$brightness = 0.5; // 50% brighter
$newColour = colourBrightness($colour,$brightness);

Darken a colour

$colour = '#ae64fe';
$brightness = -0.5; // 50% darker
$newColour = colourBrightness($colour,$brightness);
*/
function colourBrightness($hex, $percent) {
	// Work out if hash given
	$hash = '';
	if (stristr($hex,'#')) {
		$hex = str_replace('#','',$hex);
		$hash = '#';
	}
	/// HEX TO RGB
	$rgb = array(hexdec(substr($hex,0,2)), hexdec(substr($hex,2,2)), hexdec(substr($hex,4,2)));
	//// CALCULATE
	for ($i=0; $i<3; $i++) {
		// See if brighter or darker
		if ($percent > 0) {
			// Lighter
			$rgb[$i] = round($rgb[$i] * $percent) + round(255 * (1-$percent));
		} else {
			// Darker
			$positivePercent = $percent - ($percent*2);
			$rgb[$i] = round($rgb[$i] * $positivePercent) + round(0 * (1-$positivePercent));
		}
		// In case rounding up causes us to go to 256
		if ($rgb[$i] > 255) {
			$rgb[$i] = 255;
		}
	}
	//// RBG to Hex
	$hex = '';
	for($i=0; $i < 3; $i++) {
		// Convert the decimal digit to hex
		$hexDigit = dechex($rgb[$i]);
		// Add a leading zero if necessary
		if(strlen($hexDigit) == 1) {
		$hexDigit = "0" . $hexDigit;
		}
		// Append to the hex string
		$hex .= $hexDigit;
	}
	return $hash.$hex;
}

/**
 * Convert a hexa decimal color code to its RGB equivalent
 *
 * @param string $hexStr (hexadecimal color value)
 * @param boolean $returnAsString (if set true, returns the value separated by the separator character. Otherwise returns associative array)
 * @param string $seperator (to separate RGB values. Applicable only if second parameter is true.)
 * @return array or string (depending on second parameter. Returns False if invalid hex color value)
 */                                                                                                
function hex2RGB($hexStr, $returnAsString = false, $seperator = ',') {
    $hexStr = preg_replace("/[^0-9A-Fa-f]/", '', $hexStr); // Gets a proper hex string
    $rgbArray = array();
    if (strlen($hexStr) == 6) { //If a proper hex code, convert using bitwise operation. No overhead... faster
        $colorVal = hexdec($hexStr);
        $rgbArray['red'] = 0xFF & ($colorVal >> 0x10);
        $rgbArray['green'] = 0xFF & ($colorVal >> 0x8);
        $rgbArray['blue'] = 0xFF & $colorVal;
    } elseif (strlen($hexStr) == 3) { //if shorthand notation, need some string manipulations
        $rgbArray['red'] = hexdec(str_repeat(substr($hexStr, 0, 1), 2));
        $rgbArray['green'] = hexdec(str_repeat(substr($hexStr, 1, 1), 2));
        $rgbArray['blue'] = hexdec(str_repeat(substr($hexStr, 2, 1), 2));
    } else {
        return false; //Invalid hex color code
    }
    return $returnAsString ? implode($seperator, $rgbArray) : $rgbArray; // returns the rgb string or the associative array
}
?>
<?php
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
function mtheme_display_post_image ($ID,$have_image_url,$link,$type,$title,$class) {

	if ($type=="") $type="fullsize";
	$output="";
	
	$image_id = get_post_thumbnail_id(($ID), $type); 
	$image_url = wp_get_attachment_image_src($image_id,$type);  
	$image_url = $image_url[0];

	$img_obj = get_post($image_id);
	$img_alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);
	
	$permalink = get_permalink( $ID );
	
	if ($link==true) {
		$output = '<a href="' . $permalink . '">';
	}
	
	if ($have_image_url) {
		$output .= '<img src="'. $have_image_url .'" alt="'. $img_alt .'" class="'. $class .'"/>';
	} else {
		if ($image_url) {
			if ($class) {
				$output .= '<img src="'. $image_url .'" alt="'. $img_alt .'" class="'. $class .'"/>';
			} else {
				$output .= '<img src="'. $image_url .'" alt="'. $img_alt .'" />';
			}
		}
	}
	
	if ($link==true) {
		$output .= '</a>';
	}
	
	return $output;
}
/**
 * Shortcode remove BR and P tags from shortcode
 */

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

/** 
* A pagination function 
* @param integer $range: The range of the slider, works best with even numbers 
* Used WP functions: 
* get_pagenum_link($i) - creates the link, e.g. http://site.com/page/4 
* previous_posts_link(' &#171; '); - returns the Previous page link 
* next_posts_link(' &#187; '); - returns the Next page link 
*/  
function get_pagination($range = 8){  
  // $paged - number of the current page  
  global $paged, $wp_query;  
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
      echo '<a href="' . get_pagenum_link(1) . '"> First </a>';  
    }  
    // To the previous page  
    previous_posts_link(' &#171; ');  
    // We need the sliding effect only if there are more pages than is the sliding range  
    if($max_page > $range){  
      // When closer to the beginning  
      if($paged < $range){  
        for($i = 1; $i <= ($range + 1); $i++){  
          echo '<a href="' . get_pagenum_link($i) .' "';  
          if($i==$paged) echo 'class="current"';  
          echo ">$i</a>";  
        }  
      }  
      // When closer to the end  
      elseif($paged >= ($max_page - ceil(($range/2)))){  
        for($i = $max_page - $range; $i <= $max_page; $i++){  
          echo '<a href="' . get_pagenum_link($i) .' "';  
          if($i==$paged) echo 'class="current"';  
          echo ">$i</a>";  
        }  
      }  
      // Somewhere in the middle  
      elseif($paged >= $range && $paged < ($max_page - ceil(($range/2)))){  
        for($i = ($paged - ceil($range/2)); $i <= ($paged + ceil(($range/2))); $i++){  
          echo '<a href="' . get_pagenum_link($i) .' "';  
          if($i==$paged) echo 'class="current"';  
          echo ">$i</a>";  
        }  
      }  
    }  
    // Less pages than the range, no sliding effect needed  
    else{  
      for($i = 1; $i <= $max_page; $i++){  
        echo '<a href="' . get_pagenum_link($i) .' "';  
        if($i==$paged) echo 'class="current"';  
        echo ">$i</a>";  
      }  
    }  
    // Next page  
    next_posts_link(' &#187; ');  
    // On the last page, don't put the Last page link  
    if($paged != $max_page){  
      echo '<a href="' . get_pagenum_link($max_page) . '"> Last </a>';  
    }  
  }  
}
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
function showfeaturedimage ($ID,$link,$resize,$height,$width,$quality, $crop, $title,$class) {

	$output=""; // Set nill
	$image_id = get_post_thumbnail_id($ID, 'full'); 
	$image_url = wp_get_attachment_image_src($image_id,'full');  
	$image_url = $image_url[0];			
	$image=wpmu_image_path($image_url);
	
	$permalink = get_permalink( $ID );
	
	if ($link==true) {
		$output = '<a href="' . $permalink . '">';
	}
	
	if ($resize==true) {
		if ($image) {
			if ($class) {
				$output .= '<img src="'. get_template_directory_uri(). '/timthumb.php?src='. $image .'&amp;h='. $height .'&amp;w='. $width .'&amp;zc=1&amp;q='. $quality .'" alt="'. $title .'" class="'. $class .'"/>';
			} else {
				$output .= '<img src="'. get_template_directory_uri(). '/timthumb.php?src='. $image .'&amp;h='. $height .'&amp;w='. $width .'&amp;zc=1&amp;q='. $quality .'" alt="'. $title .'"/>';
			}
		}
	}
	
	if ($resize==false) {
		if ($image) {
			if ($class) {
				$output .= '<img src="'. $image .'" alt="'. $title .'" class="'. $class .'"/>';
			} else {
				$output .= '<img src="'. $image .'" alt="'. $title .'" />';
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
?>
<?php

// Changing excerpt more - only works where excerpt is NOT hand-crafted
add_filter('excerpt_more', 'auto_excerpt_more');
function auto_excerpt_more($more) {
	if( get_post_type() == 'portfolio' ){
		return '<br /> <a class="read-more" href="'.get_permalink().'" rel="nofollow">View Portfolio</a>';
	}else{
		return '<br /> <a class="read-more" href="'.get_permalink().'" rel="nofollow">Read More</a>';
	}
    //return '<br /> <a class="read-more" href="'.get_permalink().'" rel="nofollow">Read More &rarr;</a>';
}
// Changing excerpt more - only works where excerpt IS hand-crafted
add_filter('get_the_excerpt', 'manual_excerpt_more');
function manual_excerpt_more($excerpt) {
	$excerpt_more = '';
	if( has_excerpt() ) {
	
		if( get_post_type() == 'portfolio' ){
			$excerpt_more = '<br /> <a class="read-more" href="'.get_permalink().'" rel="nofollow">View Portfolio </a>';
		}else{
			$excerpt_more = '<br /> <a class="read-more" href="'.get_permalink().'" rel="nofollow">Read More</a>';
		}
    	//$excerpt_more = '<br /> <a class="read-more" href="'.get_permalink().'" rel="nofollow">Read More &rarr;</a>';
	}
	return $excerpt . $excerpt_more;
}

/**
 * RSS
 */
add_theme_support('automatic-feed-links');
/**
 * Sidebar
 */
if (function_exists('register_sidebar'))
{
	register_sidebar(array(
		'description'   => 'This is the default sidebar.',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h2>',
		'after_title' => '</h2>',
	));
    
    register_sidebar(array(
        'name' => 'WPEC Sidebar', 
        'description'   => 'This is the WPEC sidebar',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2>',
        'after_title' => '</h2>',
    ));
	register_sidebar(array(
		'name' => 'Contact Us Sidebar',
		'id'   => 'sidebar-contactus',
		'description'   => 'This is the contact us sidebar, only displays on the contact us page.',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4>',
		'after_title'   => '</h4>'
	));
	register_sidebar(array(
		'name' => 'Footer Area 1 Widgets',
		'id' => 'footer-1-widgets',
		'description'   => 'This is the first footer area for widgets',
		'before_widget' => '<div id="%1$s">',
		'after_widget' => '</div><div class="clear"></div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	));
	register_sidebar(array(
		'name' => 'Footer Area 2 Widgets',
		'id' => 'footer-2-widgets',
		'description'   => 'This is the second footer area for widgets',
		'before_widget' => '<div id="%1$s">',
		'after_widget' => '</div><div class="clear"></div>',
		'before_title' => '<h2>',
		'after_title' => '</h2>',
	));
	register_sidebar(array(
		'name' => 'Footer Area 3 Widgets',
		'id' => 'footer-3-widgets',
		'description'   => 'This is the third footer area for widgets',
		'before_widget' => '<div id="%1$s">',
		'after_widget' => '</div><div class="clear"></div>',
		'before_title' => '<h2>',
		'after_title' => '</h2>',
	));
	register_sidebar(array(
		'name' => 'Footer Area 4 Widgets',
		'id' => 'footer-4-widgets',
		'description'   => 'This is the fourth footer area for widgets',
		'before_widget' => '<div id="%1$s">',
		'after_widget' => '</div><div class="clear"></div>',
		'before_title' => '<h2>',
		'after_title' => '</h2>',
	));
}

/**
 * Thumbnails
 */
if ( function_exists( 'add_image_size' ) )
	add_theme_support( 'post-thumbnails' );

if ( function_exists( 'add_image_size' ) ) {
	add_image_size( 'thumb60', 60, 60, true );
	add_image_size( 'thumb200', 200, 200, true );
	add_image_size( 'thumb220x130', 220, 130, true );
	add_image_size( 'thumb220', 220, 200, true );
	add_image_size( 'thumb300', 300, 120, true );
	add_image_size( 'thumb300x165', 300, 165, true );
	add_image_size( 'thumb460', 460, 255, true );
	add_image_size( 'thumb620', 620, 400, true );
	add_image_size( 'thumb620x270', 620, 270, true );
	add_image_size( 'thumb940', 940, 400, true );
	add_image_size( 'thumb940x530', 940, 530, true );
}

/**
 * Menus
 */
register_nav_menu('main', __('Main Nav'));
register_nav_menu('footer_links', __('Widget Footer Links'));

function grounded_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'grounded_page_menu_args' );

class themeteamcustom_walker extends Walker_Nav_Menu
{
	function start_el($output, $item, $depth, $args) {

		global $wp_query;
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
		$class_names .= $value = '';
		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$class_names .= join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
		$class_names .= '';
		$output .= $indent . '<li id="menu-item-'. $item->ID . '" class="' . $value . $class_names .'">';
		//$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
		$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
		$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
		$item_output = $args->before;
		$item_output .= '<a '. $attributes .'><span><span>';
		$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
		$item_output .= '</span></span><em>'.$item->attr_title.'</em></a>';
		$item_output .= $args->after;
		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
}

/**
 * Comment list
 */
function custom_comment($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment; ?>

            <li>
              <time class="left"><?php printf(__('%1$s'), comment_date('F j, Y')) ?></time>
              <div class="prefix_3">
                <div>
                  <div class="avatar thumbnail left"><?php echo get_avatar($comment,$size='96',$default='<path_to_url>' ); ?><span></span></div>
                  <div>
                    <h3><?php printf(__('%s'), get_comment_author_link()) ?> <span>says</span></h3>
                    <?php comment_text() ?>
                    <p><?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?></p>
                  </div>
                </div>
              </div>

<?php
}
 
/**
 * TWITTER FEED PARSER
 *
 * @version	1.0
 * @author	Jonathan Nicol
 * @link	http://f6design.com/journal/2010/10/07/display-recent-twitter-tweets-using-php/
 *
 * Note:
 * We employ caching because Twitter only allows their RSS feeds to be accesssed 150
 * times an hour per user client.
 *
 * Credits:
 * Hashtag/URL parsing: http://snipplr.com/view/16221/get-twitter-tweets/
 * Feed caching: http://www.addedbytes.com/articles/caching-output-in-php/
 * Feed parsing: http://boagworld.com/forum/comments.php?DiscussionID=4639
 */
 
function display_latest_tweets(
	$twitter_user_id,
	$cache_file = '',
	$tweets_to_display = 1,
	$ignore_replies = false,
	$twitter_wrap_open = '<div id="last-tweet" class="clearfix"><div class="container_12"><div class="grid_12">',
	$twitter_wrap_close = '</div></div></div>',
	$tweet_wrap_open = '<div><p>',
	$meta_wrap_open = '',
	$meta_wrap_close = '',
	$tweet_wrap_close = '</p></div>',
	$date_format = 'l M j \- g:ia'){
 
	// Seconds to cache feed (1 hour).
	$cachetime = 60*60;
	// Time that the cache was last filled.
	$cache_file = TEMPLATEPATH .'/function_includes/cache/twitter.txt';
	$cache_file_created = ((@file_exists($cache_file))) ? @filemtime($cache_file) : 0;
 
	// A flag so we know if the feed was successfully parsed.
	$tweet_found = false;
 
	// Show file from cache if still valid.
	if (time() - $cachetime < $cache_file_created) {
 
		$tweet_found = true;
		// Display tweets from the cache.
		@readfile($cache_file);
 
	} else {
 
		// Cache file not found, or old. Fetch the RSS feed from Twitter.
		$response = @wp_remote_get('http://twitter.com/statuses/user_timeline/'.$twitter_user_id.'.rss');
		if (!empty($response['response']['message']) && $response['response']['message'] == 'OK') {
			$rss = $response['body'];
		} else {
			$rss = '';
		}
		
		if($rss) {
 
			// Parse the RSS feed to an XML object.
			$xml = @simplexml_load_string($rss);
 
			if($xml !== false) {
 
				// Error check: Make sure there is at least one item.
				if (count($xml->channel->item)) {
 
					$tweet_count = 0;
 
					// Start output buffering.
					ob_start();
 
					// Open the twitter wrapping element.
					$twitter_html = $twitter_wrap_open;
 
					// Iterate over tweets.
					foreach($xml->channel->item as $tweet) {
 
						// Twitter feeds begin with the username, "e.g. User name: Blah"
						// so we need to strip that from the front of our tweet.
						$tweet_desc = substr($tweet->description,strpos($tweet->description,":")+2);
						$tweet_desc = htmlspecialchars($tweet_desc);
						$tweet_first_char = substr($tweet_desc,0,1);
 
						// If we are not gnoring replies, or tweet is not a reply, process it.
						if ($tweet_first_char!='@' || $ignore_replies==false){
 
							$tweet_found = true;
							$tweet_count++;
 
							// Add hyperlink html tags to any urls, twitter ids or hashtags in the tweet.
							// http://snipplr.com/view/16221/get-twitter-tweets/
                                                        $tweet_desc = preg_replace('@(https?://([-\w\.]+)+(d+)?(/([\w/_\.]*(\?\S+)?)?)?)@', '<a href="$1">$1</a>', $tweet_desc );
							$tweet_desc = preg_replace("#(^|[\n ])@([^ \"\t\n\r<]*)#ise", "'\\1<a href=\"http://www.twitter.com/\\2\" >@\\2</a>'", $tweet_desc);
							$tweet_desc = preg_replace("#(^|[\n ])\#([^ \"\t\n\r<]*)#ise", "'\\1<a href=\"http://www.twitter.com/search?q=\\2\" >#\\2</a>'", $tweet_desc);
 
							// Render the tweet.

							$twitter_html .= $tweet_wrap_open.$tweet_desc.$meta_wrap_open.'<a href="http://twitter.com/'.$twitter_user_id.'">'.date($date_format,strtotime($tweet->pubDate)).'</a>'.$meta_wrap_close.$tweet_wrap_close;

						}
 
						// If we have processed enough tweets, stop.
						if ($tweet_count >= $tweets_to_display){
							break;
						}
 
					}
 
					// Close the twitter wrapping element.
					$twitter_html .= $twitter_wrap_close;
					return $twitter_html;
 
					// Generate a new cache file.
					$file = @fopen($cache_file, 'w');
 
					// Save the contents of output buffer to the file, and flush the buffer.
					@fwrite($file, ob_get_contents());
					@fclose($file);
					ob_end_flush();
 
				}
			}
		}
	}
	// In case the RSS feed did not parse or load correctly, show a link to the Twitter account.
	if (!$tweet_found){
		echo $twitter_wrap_open.$tweet_wrap_open.'Oops, our twitter feed is unavailable right now. '.$meta_wrap_open.'<a href="http://twitter.com/'.$twitter_user_id.'">Follow us on Twitter</a>'.$meta_wrap_close.$tweet_wrap_close.$twitter_wrap_close;
	}
}
/* Breadcrumb function*/
function breadcrumbs($enable) {
  if($enable == 'true'){
	  $name = 'Home';
	  $currentBefore = '<li>';
	  $currentAfter = '</li>';
	  
	  echo '<ul>';
	  
	  if ( !is_home() && !is_front_page() || is_paged() ) {
	 
	 
	    global $post;
	    $home = get_bloginfo('url');
	    echo '<li><a href="' . $home . '">' . $name . '</a></li> '  . ' ';
	 
	    if ( is_category() ) {
	      global $wp_query;
	      $cat_obj = $wp_query->get_queried_object();
	      $thisCat = $cat_obj->term_id;
	      $thisCat = get_category($thisCat);
	      $parentCat = get_category($thisCat->parent);
	      if ($thisCat->parent != 0) echo(get_category_parents($parentCat, TRUE, ' '  . ' '));
	      echo $currentBefore;
	      single_cat_title();
	      echo $currentAfter;
	 
	    } elseif ( is_day() ) {
	      echo '<li><a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a></li> '  . ' ';
	      echo '<li><a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a></li> '  . ' ';
	      echo $currentBefore . get_the_time('d') . $currentAfter;
	 
	    } elseif ( is_month() ) {
	      echo '<li><a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a></li>'  . ' ';
	      echo $currentBefore . get_the_time('F') . $currentAfter;
	 
	    } elseif ( is_year() ) {
	      echo $currentBefore . get_the_time('Y') . $currentAfter;
	 
	    } elseif ( is_single() && !is_attachment() ) {
	      $cat = get_the_category(); 
          if ($cat != '' && $cat != NULL)
            {
              $cat = $cat[0];
	          
              echo $currentBefore . get_category_parents($cat, TRUE, ' '  . ' ') . $currentAfter;
	          echo $currentBefore;
	          the_title();
	          echo $currentAfter;
            }
            else
            {
                if ($post->post_type == 'wpsc-product')
                    {
                        $products_page_id = wpec_get_the_post_id_by_shortcode( '[productspage]' );
                        
                        echo $currentBefore . '<a href="' . get_permalink($products_page_id) . '">Products Page</a>' . $currentAfter;
                        echo $currentBefore;
                        echo $post->post_title;
                        echo $currentAfter;
                    }
            }
	 
	    } elseif ( is_attachment() ) {
	      $parent = get_post($post->post_parent);
	      $cat = get_the_category($parent->ID); $cat = $cat[0];
	      echo get_category_parents($cat, TRUE, ' '  . ' ');
	      echo '<li><a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a></li>'  . ' ';
	      echo $currentBefore;
	      the_title();
	      echo $currentAfter;
	 
	    } elseif ( is_page() && !$post->post_parent ) {
	      echo $currentBefore;
	      the_title();
	      echo $currentAfter;
	 
	    } elseif ( is_page() && $post->post_parent ) {
	      $parent_id  = $post->post_parent;
	      $breadcrumbs = array();
	      while ($parent_id) {
	        $page = get_page($parent_id);
	        $breadcrumbs[] = '<li><a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a></li>';
	        $parent_id  = $page->post_parent;
	      }
	      $breadcrumbs = array_reverse($breadcrumbs);
	      foreach ($breadcrumbs as $crumb) echo $crumb . ' '  . ' ';
	      echo $currentBefore;

      the_title();
	      echo $currentAfter;
	 
	    } elseif ( is_search() ) {
	      echo $currentBefore . 'Search results for &#39;' . get_search_query() . '&#39;' . $currentAfter;
	 
	    } elseif ( is_tag() ) {
	      echo $currentBefore . 'Posts tagged &#39;';
	      single_tag_title();
	      echo '&#39;' . $currentAfter;
	 
	    } elseif ( is_author() ) {
	       global $author;
	      $userdata = get_userdata($author);
	      echo $currentBefore . 'Articles posted by ' . $userdata->display_name . $currentAfter;
	 
	    } elseif ( is_404() ) {
	      echo $currentBefore . 'Error 404' . $currentAfter;
	    }
        elseif(is_tax())
            {
                global $wpsc_product_category;
                
                echo $currentBefore;
                echo $wpsc_product_category;
                echo $currentAfter;   
            }
	 
	    if ( get_query_var('paged') ) {
	      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';

      echo __('<li>Page') . ' ' . get_query_var('paged').'</li>';
	      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
	    }
	 
	 
	  }

  
	  echo '</ul>';
  }

}

function terms($activeTerm){

	$before = '<li>Show: </li><li><a href="#" rel="all">All</a></li>';
	echo $before;
	$myterms = get_terms('skills', 'orderby=count&hide_empty=0');
	if($myterms){
		$count = 1;
		foreach ( $myterms as $term ) {
			if($term->name == $activeTerm){
				echo '<li class="active"><a href="#" rel="'.$term->slug.'">'.$term->name.'</a></li>';
			}else{
				echo '<li><a href="#" rel="'.$term->slug.'">'.$term->name.'</a></li>';
			}

		$count++;
		}
	}
	
}

/* function timthumb resize*/
function themeteam_resize($img,$alt,$title,$width,$height){
	global $blog_id;
	
	$image['url'] = $img;
	$image_path = explode($_SERVER['SERVER_NAME'], $image['url']);
	$image_path = $_SERVER['DOCUMENT_ROOT'] . $image_path[1];
	$image_info = @getimagesize($image_path);
	
	// If we cannot get the image locally, try for an external URL
	if (!$image_info)
		$image_info = @getimagesize($image['url']);

	$image['width'] = $image_info[0];
	$image['height'] = $image_info[1];
	if($img != "" && ($image['width'] != $width || $image['height'] != $height || !isset($image['width']))){
		
		//If WP MU
		if ( (defined('WP_ALLOW_MULTISITE')) && (WP_ALLOW_MULTISITE == true) ) {
			$the_image_src = $img;
			if (isset($blog_id) && $blog_id > 0) {
				$image_parts = explode('/files/', $the_image_src);
				if (isset($image_parts[1])) {
					$the_image_src = '/blogs.dir/' . $blog_id . '/files/' . $image_parts[1];
					$the_imasdfage_src = $image_parts[0];
					$mu_image_path = '/wp-content' .$the_image_src;//$the_imasdfage_src.
				}else{
					$mu_image_path = $image_parts[0];
				}
			}
		
			$img = THEMETEAM_IMAGE_RESIZE."/timthumb.php?src=$mu_image_path&amp;w=$width&amp;h=$height&amp;zc=1&amp;q=80";
		}else{
			$img = THEMETEAM_IMAGE_RESIZE."/timthumb.php?src=$img&amp;w=$width&amp;h=$height&amp;zc=1&amp;q=80";
		}

	}
	return '<img id="indiv_thumb" alt="'.$alt.'" title="'.$title.'" src="'.$img.'"/>';
}

/* function timthumb resize*/
function themeteam_resize2($img,$alt,$title,$width,$height){

	$image['url'] = $img;
	$image_path = explode($_SERVER['SERVER_NAME'], $image['url']);
	$image_path = $_SERVER['DOCUMENT_ROOT'] . $image_path[1];
	$image_info = @getimagesize($image_path);
	
	// If we cannot get the image locally, try for an external URL
	if (!$image_info)
		$image_info = @getimagesize($image['url']);

	$image['width'] = $image_info[0];
	$image['height'] = $image_info[1];
	if($img != "" && ($image['width'] != $width || $image['height'] != $height || !isset($image['width']))){
		//$img = THEMETEAM_IMAGE_RESIZE."/timthumb.php?src=$img&amp;w=$width&amp;h=$height&amp;zc=1&amp;q=80";
	}
	return '<img id="indiv_thumb" alt="'.$alt.'" title="'.$title.'" src="'.$img.'"/>';

}

function gallery_image_resize($height,$width,$img_url) {
	global $blog_id;
	
	//need to resize the image for the galleria so that its not scaling from thumbnail size
	$image['url'] = $img_url;
	$image_path = explode($_SERVER['SERVER_NAME'], $image['url']);
	$image_path = $_SERVER['DOCUMENT_ROOT'] . $image_path[1];
	$image_info = @getimagesize($image_path);

	// If we cannot get the image locally, try for an external URL
	if (!$image_info)
		$image_info = @getimagesize($image['url']);

	$image['width'] = $image_info[0];
	$image['height'] = $image_info[1];
	if($img_url != "" && ($image['width'] != $width || $image['height'] != $height || !isset($image['width']))){
	
		//If WP MU
		if ( (defined('WP_ALLOW_MULTISITE')) && (WP_ALLOW_MULTISITE == true) ) {
			$the_image_src = $img_url;
			if (isset($blog_id) && $blog_id > 0) {
				$image_parts = explode('/files/', $the_image_src);
				if (isset($image_parts[1])) {
					$the_image_src = '/blogs.dir/' . $blog_id . '/files/' . $image_parts[1];
					$the_imasdfage_src = $image_parts[0];
					$mu_image_path = '/wp-content' .$the_image_src;//$the_imasdfage_src.
				}else{
					$mu_image_path = $image_parts[0];
				}
			}
		
			$img_url = THEMETEAM_IMAGE_RESIZE."/timthumb.php?src=$mu_image_path&amp;w=$width&amp;h=$height&amp;zc=1&amp;q=80";
		}else{
			$img_url = THEMETEAM_IMAGE_RESIZE."/timthumb.php?src=$img_url&amp;w=$width&amp;h=$height&amp;zc=1&amp;q=80";
		}
	}
	
	return $img_url;
}


function themeteam_bg_options($option){
	
	$out .= '<style>';
	switch($option){
		case 'bg_default':
			//do nothing
		break;
		case 'bg_color':
			//make the hex darker
		$darker = hexDarker(get_option('themeteam_origami_color_bg'), 40);
		$lighter = hexDarker(get_option('themeteam_origami_color_bg'), 20);
		//$font_lighter = hexDarker(get_option('themeteam_origami_custom_font'), 20);
		$out .= '#origami-slider { border-bottom: solid 5px #'.$darker.';border-top: solid 5px #'.$darker.'; background-color: #'.get_option('themeteam_origami_color_bg').';background-image:none;}';
		$out .= '#page-title{ border-bottom: solid 5px #'.$darker.';border-top: solid 5px #'.$darker.'; background-color: #'.get_option('themeteam_origami_color_bg').';background-image:none;}';
		$out .= 'body { background: #'.$darker.';}';
		$out .= '#footer{background-color:#'.$lighter.';}';
		$out .= '#footer input[type=text], #footer input[type=email], #footer textarea { background-color:#'.$darker.'; border-radius: 2px; -moz-border-radius:2px; -webkit-border-radius: 2px; border: none; padding: 10px; width: 195px; box-shadow: 1px 1px 0 #'.$darker.'; -moz-box-shadow: 1px 1px 0 #'.$darker.'; -webkit-box-shadow: 1px 1px 0 #'.$darker.'; color:#'.$lighter.';}';
		$out .= '#footer, #footer .button { background-color:#'.$lighter.'; }';
		break;
		case 'bg_tile':
		//make the hex darker
		$darker = hexDarker(get_option('themeteam_origami_full_color_bg'), 40);
		$lighter = hexDarker(get_option('themeteam_origami_full_color_bg'), 20);
		//$font_lighter = hexDarker(get_option('themeteam_origami_custom_font'), 20);
		$out .= '#origami-slider { border-bottom: solid 5px #'.$darker.';border-top: solid 5px #'.$darker.'; background: #'.get_option('themeteam_origami_full_color_bg').' url('.get_bloginfo('template_directory').'/images/bg/'.get_option('themeteam_origami_pattern_bg').') repeat-x;}';
		$out .= '#page-title{ border-bottom: solid 5px #'.$darker.';border-top: solid 5px #'.$darker.'; background: #'.get_option('themeteam_origami_full_color_bg').' url('.get_bloginfo('template_directory').'/images/bg/'.get_option('themeteam_origami_pattern_bg').');}';
		$out .= 'body { background: #'.$darker.';}';
		$out .= '#footer{background-color:#'.$lighter.';}';
		$out .= '#footer input[type=text], #footer input[type=email], #footer textarea { background-color:#'.$darker.'; border-radius: 2px; -moz-border-radius:2px; -webkit-border-radius: 2px; border: none; padding: 10px; width: 195px; box-shadow: 1px 1px 0 #'.$darker.'; -moz-box-shadow: 1px 1px 0 #'.$darker.'; -webkit-box-shadow: 1px 1px 0 #'.$darker.'; color:#'.$lighter.';}';
		$out .= '#footer { border-top: solid 4px #'.$darker.';}';
		$out .= '#footer, #footer .button { background-color:#'.$lighter.'; }';
		
		$out .= '.box-v4 header { border: solid 1px #'.get_option('themeteam_origami_full_color_bg').'; border-bottom: solid 5px #'.$darker.'; background:#'.get_option('themeteam_origami_full_color_bg').'; }';
		
		break;

	}
	
	
	//lets set the font colors here too:
	//logo
	if(get_option('themeteam_origami_logo_font')){
		$out .= '#header #logo a { color:#'.get_option('themeteam_origami_logo_font').'; }';
	}
	if(get_option('themeteam_origami_navigation_font')){
		$out .= '#navigation div > ul > li > a > span { color:#'.get_option('themeteam_origami_navigation_font').';}';
		$out .= '#navigation div > ul > li > ul li a { color: #'.get_option('themeteam_origami_navigation_font').';}';
	}
	if(get_option('themeteam_origami_navigation_title_font')){
		$out .= '#navigation div > ul > li > a > em { color:#'.get_option('themeteam_origami_navigation_title_font').'; }';
	}
	if(get_option('themeteam_origami_navigation_title_hover_font')){
		$out .= '#navigation div > ul > li:hover > a > em { color:#'.get_option('themeteam_origami_navigation_title_hover_font').'; }';
	}
	if(get_option('themeteam_origami_navigation_hover_font')){
		$out .= '#navigation div > ul > li:hover > a > span { color:#'.get_option('themeteam_origami_navigation_hover_font').';}';
	}
	if(get_option('themeteam_origami_slider_content_header_font')){
		$out .= '#origami-slider #normal-width-slider ul li h1, #origami-slider #normal-width-slider ul li h1 a, #page-title h1 { color:#'.get_option('themeteam_origami_slider_content_header_font').'!important;}';
	}
	if(get_option('themeteam_origami_slider_content_font')){
		$out .= '#origami-slider #normal-width-slider ul li h1 + p { color:#'.get_option('themeteam_origami_slider_content_font').';}';
	}
	if(get_option('themeteam_origami_message_font')){
		$out .= '#origami-messages { color:#'.get_option('themeteam_origami_message_font').';}';
	}
	//footer
	if(get_option('themeteam_origami_footer_font')){
		$out .= '#footer, #sub-footer { color:#'.get_option('themeteam_origami_footer_font').';}';
	}
	if(get_option('themeteam_origami_footer_link_font')){
		$out .= '#footer a, #sub-footer a  { color:#'.get_option('themeteam_origami_footer_link_font').';}';
	}
	if(get_option('themeteam_origami_subpage_title_font')){
		$out .= '#page-title h1  { color:#'.get_option('themeteam_origami_subpage_title_font').'!important;}';
	}
	if(get_option('themeteam_origami_breadcrumbs_font')){
		$out .= '#breadcrumbs   { color:#'.get_option('themeteam_origami_breadcrumbs_font').';}';
	}
	if(get_option('themeteam_origami_breadcrumbs_link_font')){
		$out .= '#breadcrumbs li a  { color:#'.get_option('themeteam_origami_breadcrumbs_link_font').';}';
	}
	//#footer, #sub-footer { color:#8eaeb4; font-size: 11px; }
#footer a, #sub-footer a { color:#fff;}
	
	
	//$out .= 'a, #custom-blocks h2 { color:#'.$font_lighter.';}';
	//$out .= '.entry, .entry a  { color:#'.$font_lighter.'; }';
	//$out .= '#header #logo a { color:#'.$font_lighter.'; }';
	//$out .= '#origami-slider #normal-width-slider ul li h1, #origami-slider #normal-width-slider ul li h1 a, #page-title h1, .comment-stats, .comment-stats a  { color:#'.$font_lighter.'!important; }';
	//$out .= '#origami-slider #normal-width-slider ul li h1 + p { color:#'.$font_lighter.';}';
	
	//$out .= '#sidebar h2 {color:#'.$font_lighter.';}';
	//$out .= '#sidebar h3 + p, #sidebar h3 + p a { color:#'.$font_lighter.';}';
	//$out .= '#sidebar .widget_themeteam_twitter li, #sidebar .widget_themeteam_twitter li a { color:#'.$font_lighter.';}';
	//$out .= '.sticky h2 + p {color:#'.$font_lighter.';}';
	//$out .= '#custom-blocks h2 + p {color:#'.$font_lighter.'; }';
	//$out .= '#last-tweet {color:#'.$font_lighter.';}';
	//$out .= '#last-tweet a { color:#'.$font_lighter.';}';
	//$out .= '#footer, #sub-footer { color:#'.$font_lighter.'; }';
	
	//$out .= '#breadcrumbs { color:#'.$font_lighter.'; }';
	//$out .= '#breadcrumbs li a { color:#'.$font_lighter.';}';
	//$out .= '.post h1 {color:#'.$font_lighter.';}';
	
	
	$out .= '</style>';
	
	return $out;
}

function hexDarker($hex,$factor = 30)
{
$new_hex = '';

$base['R'] = hexdec($hex{0}.$hex{1});
$base['G'] = hexdec($hex{2}.$hex{3});
$base['B'] = hexdec($hex{4}.$hex{5});

foreach ($base as $k => $v)
        {
        $amount = $v / 100;
        $amount = round($amount * $factor);
        $new_decimal = $v - $amount;

        $new_hex_component = dechex($new_decimal);
        if(strlen($new_hex_component) < 2)
                { $new_hex_component = "0".$new_hex_component; }
        $new_hex .= $new_hex_component;
        }
        
return $new_hex;
}


// Set global php variables
add_action('themeteam_globals','themeteam_globals');
function themeteam_globals() {
	
	// Set global Thumbnail dimensions and alignment
	$GLOBALS['button_css'] = 'slateblue'; $buttonCss = get_option('themeteam_origami_button_color'); if ($buttonCss) $GLOBALS['button_css'] = $buttonCss;
		

}
/*
 * PHP integration for No Spam v1.3
 * by Mike Branski (www.leftrightdesigns.com)
 * mikebranski@gmail.com
 *
 * Copyright (c) 2008 Mike Branski (www.leftrightdesigns.com)
 *
 * NOTE: This script is for integrating your dynamic PHP content with No Script.
 *       Download No Spam at www.leftrightdesigns.com/library/jquery/nospam/
 *
 */
function nospam($email, $filterLevel = 'normal')
{
	$email = strrev($email);
	$email = preg_replace('[@]', '//', $email);
	$email = preg_replace('[\.]', '/', $email);

	if($filterLevel == 'low')
	{
		$email = strrev($email);
	}

	return $email;
}

?>
<?php

global $r_option;

/* Global shortcode ID */
$shortcode_id = 0;


/* Shortcode fix
 ------------------------------------------------------------------------*/
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


/* Content with shortcodes
 ------------------------------------------------------------------------*/
function do_content($content) {
	if (QTRANS) $content = __($content); 
	$content = do_shortcode($content);
	return $content;
}


/* Add shortcodes to text widget
 ------------------------------------------------------------------------*/
if (function_exists ('shortcode_unautop')) {
	add_filter ('widget_text', 'shortcode_unautop');
}
add_filter ('widget_text', 'do_shortcode');


/* Helpers
 ------------------------------------------------------------------------*/

/* Theme Path */
function r_theme_path($atts, $content = null) {
   return THEME_URI;
}
add_shortcode('theme_path', 'r_theme_path');

/* Clear */
function r_clear($atts, $content = null) {
   return '<div class="clear"></div>';
}
add_shortcode('clear', 'r_clear');

/* Divider */
function r_divider($atts, $content = null) {
   return '<hr class="divider">';
}
add_shortcode('divider', 'r_divider');

/* Hgroup */
function r_hgroup($atts, $content = null) {
   return '<div class="hgroup">' . do_content($content) . '</div>';
}
add_shortcode('hgroup', 'r_hgroup');

/* Color */
function r_color($atts, $content = null) {

   return '<span class="color">' . do_content($content) . '</span>';
}
add_shortcode('color', 'r_color');

/* Spacer */
function r_spacer($atts, $content = null) {
	extract(shortcode_atts(array(
								 'size' => '20'
								 ), $atts));
	return '<div class="clear" style="height:' . $size . 'px"></div>';
}
add_shortcode('spacer', 'r_spacer');


/* Masonry boxes
 ------------------------------------------------------------------------*/

// Masonry boxes
function r_masonry_boxes($atts, $content = null) {
	extract(shortcode_atts(array(
		'classes' => ''
    ), $atts));
   return '<div class="masonry-wrap clearfix ' . $classes . '">' . do_shortcode($content) . '</div>';
}
add_shortcode('masonry_boxes', 'r_masonry_boxes');

// Masonry box
function r_masonry_box($atts, $content = null) {
	extract(shortcode_atts(array(
		'width'   => '1-4',
		'height'  => '1-4',
		'video'   => 'false',
		'slider'  => 'false',
		'text'    => 'false',
		'classes' => ''
    ), $atts));
	$masonry_classes = 'width-'. $width . ' height-' . $height;

	// If text
	if ($text == 'true') return '<div class="masonry width-1-2 height-1-2 text-box"><div class="text-box"><div class="inner">' . do_shortcode($content) . '</div></div></div>';

	if ($video == 'true') $masonry_classes = 'width-3-4 height-1-2 media video';
	if ($slider == 'true') $masonry_classes .= ' media';
	$masonry_classes .= " $classes";
   return '<div class="masonry ' . $masonry_classes . '">' . do_shortcode($content) . '</div>';
}
add_shortcode('masonry_box', 'r_masonry_box');


/* Tweets
 ------------------------------------------------------------------------*/
function r_tweets($atts, $content = null) {

	extract(shortcode_atts(array(
		'time'                => 3600,
		'limit'               => '1',
		'username'            => '',
		'replies'             => 'true',
		'api_key'        => '',
		'api_secret'     => '',
		'consumer_key'        => '',
		'consumer_secret'     => '',
		'access_token'        => '',
		'access_token_secret' => ''
    ), $atts));

	if ($api_key != '') $consumer_key = $api_key;
	if ($api_secret != '') $consumer_secret = $api_secret;
	$opts = array(
		'time'                => $time,
		'limit'               => $limit,
		'username'            => $username,
		'replies'             => $replies,
		'consumer_key'        => $consumer_key,
		'consumer_secret'     => $consumer_secret,
		'access_token'        => $access_token,
		'access_token_secret' => $access_token_secret

	);
	
	$tweets = r_parse_twitter($opts);
	return $tweets;
}
add_shortcode('tweets', 'r_tweets');


/* Blockquote
 ------------------------------------------------------------------------*/
function r_blockquote($atts, $content = null) {
	extract(shortcode_atts(array(
		'author' => '',
		'single' => 'true'
    ), $atts));

	if ($author != '') $author = '<span class="author color">' . $author . '</span>';
	if ($single == 'true') $single = 'class="single"';

   return '<blockquote ' . $single . '><p>' . do_shortcode($content) . '</p>' . $author . '</blockquote>';
}
add_shortcode('blockquote', 'r_blockquote');


/* Dropcaps
 ------------------------------------------------------------------------*/
function r_dropcap($atts, $content = null) {

   return '<span class="dropcap">' . $content . '</span>';
}
add_shortcode('dropcap', 'r_dropcap');

// Inverted
function r_inv_dropcap($atts, $content = null) {

   return '<span class="dropcap invert">' . $content . '</span>';
}
add_shortcode('inv_dropcap', 'r_inv_dropcap');


/* Alertboxes
 ------------------------------------------------------------------------*/
function r_alert_box($atts, $content = null) {
	extract(shortcode_atts(array(
		'type' => 'info'
    ), $atts));
   return '<p class="' . $type . '">' . do_shortcode($content) . '</p>';
}
add_shortcode('alert_box', 'r_alert_box');


/* Infobox
 ------------------------------------------------------------------------*/
function r_info_box($atts, $content = null) {
   return '<div class="info-box">' . do_shortcode($content) . '</div>';
}
add_shortcode('info_box', 'r_info_box');


/* Icon heading
 ------------------------------------------------------------------------*/
function r_icon_heading($atts, $content = null) {
	extract(shortcode_atts(array(
		'icon' => 'deck',
		'icon_url' => '',
		'classes' => ''
    ), $atts));
	if ($icon == 'custom' || $icon_url != '') $icon_url = ' style="background-image:url(' . $icon_url . ')"';
   return '<h2 class="heading-icon ' . $icon . ' ' . $classes . '"'. $icon_url .'>' . do_shortcode($content) . '</h2>';
}
add_shortcode('icon_heading', 'r_icon_heading');


/* Line heading 1
 ------------------------------------------------------------------------*/
function r_line_heading($atts, $content = null) {
   return '<h3 class="widget-title">' . do_shortcode($content) . '</h3>';
}
add_shortcode('line_heading', 'r_line_heading');


/* Line heading 2
 ------------------------------------------------------------------------*/
function r_line_heading_two($atts, $content = null) {
   return '<h4 class="line-heading"><span>' . do_shortcode($content) . '</span></h4>';
}
add_shortcode('line_heading_two', 'r_line_heading_two');


/* Button
 ------------------------------------------------------------------------*/
function r_button($atts, $content = null) {
	extract(shortcode_atts(array(
		'size'      => 'medium',
		'link'      => '#',
		'title'     => 'Button title',
		'target'    => 'self',
		'css_style' => ''
    ), $atts));

	if ($target == 'blank') $target = 'target="_blank"';
	else $target = '';
	if ($css_style != '') $css_style = ' style="' . $css_style . '"';

   return '<a href="' . $link . '" class="btn ' . $size . '" ' . $target . $css_style . '>' . $title . '</a>';
}
add_shortcode('button', 'r_button');


/* Add to Google Calendar
 ------------------------------------------------------------------------*/
function r_add_to_calendar($atts, $content = null) {

	global $post, $r_option;

	extract(shortcode_atts(array(
		'size'            => 'small',
		'title'           => 'Add to Google calendar',
		'target'          => 'blank',
		'timezone_offset' => '+02:00',
		'css_style'       => ''
    ), $atts));
	$post_type = get_post_type($post->ID);

	// Display only on event page
	if ($post_type != 'wp_events_manager') return;

	if ($target == 'blank') $target = 'target="_blank"';
	else $target = '';
	if ($css_style != '') $css_style = ' style="' . $css_style . '"';


	$post_title = urlencode(strip_tags(get_the_title($post->ID)));
	$post_excerpt = urlencode(strip_tags($post->post_excerpt));
	$site_url = get_site_url();
	$site_name = urlencode(get_bloginfo('name','raw'));
	$event_location = urlencode(strip_tags(get_post_meta($post->ID, '_event_location', true)));

	$event_date_start = get_post_meta($post->ID, '_event_date_start', true);
	$event_date_end = get_post_meta($post->ID, '_event_date_end', true);
	$event_time_start = get_post_meta($post->ID, '_event_time_start', true);
	$event_time_end = get_post_meta($post->ID, '_event_time_end', true);

	$event_date_start = strtotime(date($event_date_start . ' ' . $event_time_start . $timezone_offset));
	$event_date_end = strtotime(date($event_date_end . ' ' . $event_time_end . $timezone_offset));
	$event_date_start = date("Ymd\THis\Z", $event_date_start);
	$event_date_end = date("Ymd\THis\Z", $event_date_end);

	$link = 'https://www.google.com/calendar/event?action=TEMPLATE&amp;text=' . $post_title . '&amp;dates=' . $event_date_start . '/' . $event_date_end . '&amp;details=' . $post_excerpt . '&amp;location=' . $event_location . '&amp;trp=false&amp;sprop=' . $site_name . '&amp;sprop=name:' . $site_url;
   return '<a href="' . $link . '" class="btn ' . $size . '" ' . $target . $css_style . '>' . $title . '</a>';
}
add_shortcode('add_to_calendar', 'r_add_to_calendar');


/* Text Button
 ------------------------------------------------------------------------*/
function r_text_button($atts, $content = null) {
	extract(shortcode_atts(array(
		'link'      => '#',
		'title'     => 'Button title',
		'target'    => 'self',
		'css_style' => ''
    ), $atts));

	if ($target == 'blank') $target = 'target="_blank"';
	else $target = '';
	if ($css_style != '') $css_style = ' style="' . $css_style . '"';

   return '<a href="' . $link . '" class="text-button" ' . $target . $css_style . '>' . $title . '</a>';
}
add_shortcode('text_button', 'r_text_button');


/* Details list
 ------------------------------------------------------------------------*/
function r_details_list($atts, $content = null) {
   return '<ul class="details none">' . do_shortcode($content) . '</ul>';
}
add_shortcode('details_list', 'r_details_list');

function r_detail($atts, $content = null) {
	extract(shortcode_atts(array(
		'name' => 'Name'
    ), $atts));
   return '<li><span>' . $name . '</span><div>' . do_shortcode($content) . '</div></li>';
}
add_shortcode('detail', 'r_detail');


/* Stats list
 ------------------------------------------------------------------------*/
function r_stats_list($atts, $content = null) {
	extract(shortcode_atts(array(
		'timer' => '10000'
    ), $atts));

   return '<ul class="stats" data-timer="' . $timer . '">' . do_shortcode($content) . '</ul>';
}
add_shortcode('stats_list', 'r_stats_list');

function r_stat($atts, $content = null) {
	extract(shortcode_atts(array(
		'name' => 'Stat name',
		'value' => '999'
    ), $atts));

   return '<li><span class="stat-value">' . $value . '</span><span class="stat-name">' . $name . '</span></li>';
}
add_shortcode('stat', 'r_stat');


/* Recent posts
 ------------------------------------------------------------------------*/
function r_recent_posts($atts, $content = null) {
	global $r_option;
	
	extract(shortcode_atts(array(
		'cat'         => '',
		'limit'       => '3',
		'date_format' => 'd/m/y'
		), $atts));
	
	if (isset($post)) $backup = $post;
	
	$args = array(	
		'posts_per_page' => $limit
	);

	if ($cat != 'all' && $cat != '') {
		$args['category_name'] = $cat;
	}
	$output = '';
	$recent_posts_query = new WP_Query();
	$recent_posts_query->query($args);
	
	if ($recent_posts_query->have_posts()) {
		$output .= '<ul class="recent-entries">'."\n";
		
		while ($recent_posts_query->have_posts()) {
			$recent_posts_query->the_post();
		
			$output .= '<li><span class="date">' . get_the_time($date_format) . '</span> <a href="' . get_permalink() . '">' . get_the_title() . '</a> </li>'."\n";
			
		}
		$output .= '</ul>'."\n";
	}
	wp_reset_query();
	if (isset($post)) $post = $backup;
	
	return $output;
	
}
add_shortcode('recent_posts', 'r_recent_posts');


/* Events list
 ------------------------------------------------------------------------*/
function r_events($atts, $content = null) {
	global $r_option;
	
	extract(shortcode_atts(array(
		'limit' => '-1',
		'type'  => 'future',
		'cat' => ''
	), $atts));

	if (isset($post)) $backup = $post;
	
	$order = $type == 'future' ? $order = 'ASC' : $order = 'DSC';
	$type = $type == 'future' ? $type = 'future-events' : $type = 'past-events';

	$_type = array(
		'taxonomy' => 'wp_event_type',
		'field' => 'slug',
		'terms' => $type
	);
  	$tax = array($_type);
  
	if ($cat != 'all' && $cat != '') {

  		$cat = explode(",", $cat);

  		$_cat = array(
			'taxonomy' => 'wp_event_categories',
			'field' => 'slug',
			'terms' => $cat
		);
  		$tax = array($_type, $_cat); 
  	}
  

	$output = '';
	$events = true;
	$date_format = 'd/m';
	if (isset($r_option['event_custom_date'])) $date_format = $r_option['event_custom_date'];
   	if (isset($r_option['events_order']) && $r_option['events_order'] == 'start_date') $events_order = '_event_date_start';
	else $events_order = '_event_date_end';

	$args = array(
		'post_type' => 'wp_events_manager',
		'tax_query' => $tax,
		'showposts' => $limit,
		'orderby'   => 'meta_value',
		'meta_key'  => $events_order,
		'order'     => $order,
    	'suppress_filters' => 0 // WPML FIX
	);
	
	$events_list_query = new WP_Query();
	$events_list_query->query($args);
	
	if ($events_list_query->have_posts()) {

		$output .=  '<ul class="none events-list">';
		
		while ($events_list_query->have_posts()) {
			$events_list_query->the_post();

			/* Post Image */
        	$event_image = get_post_meta($events_list_query->post->ID, '_event_image', true); 
        	$crop = get_post_meta($events_list_query->post->ID, '_event_image_crop', true);
        	$crop = isset($crop) && $crop != '' ? $crop = $crop : $crop = 'c';

        	/* Start date */
	      $event_date_start = strtotime(get_post_meta($events_list_query->post->ID, '_event_date_start', true));

	      /* Location */
        	$event_location = get_post_meta($events_list_query->post->ID, '_event_location', true);
			
			$output .= '<li>';
			$output .= '<a href="' . get_permalink() . '">';
			$output .= '<span class="date">' . date($date_format, $event_date_start) . '</span>';

			// If image exists
			if (isset($event_image) && !empty($event_image)) {
				$output .= '<span class="cover">';
         	$output .= r_image(array(
					'type'    => 'image',
					'src'     => $event_image,
					'crop'    => $crop,
					'title'   => get_the_title(),
					'width'   => '60',
					'height'  => '60'
           	));
         	$output .= '</span>';
			}
			$output .= '<span class="title">' . get_the_title() . ' <span class="details">' . $event_location . '</span></span>';
       		$output .= '<span class="plus-button"></span>';
			$output .= '</a>';
			$output .= '</li>';
			
		}
		$output .= '</ul>';
	} else $events = false;

	if (!$events) $output = do_shortcode($content);
	wp_reset_query();
	if (isset($post)) $post = $backup;
	
	return $output;
	
}
add_shortcode('events', 'r_events');


/* Recent Event
 ------------------------------------------------------------------------*/
function r_recent_event($atts, $content = null) {
	global $r_option;
	
	extract(shortcode_atts(array(
		'limit'  => '1',
		'type'   => 'future',
		'width'  => '468',
		'height' => '468',
		'offset' => '0'
	), $atts));
	
	$output = '';
	$events = true;
	$date_format = 'd/m';
	$count = 0;
	if (isset($r_option['event_custom_date'])) $date_format = $r_option['event_custom_date'];
   if (isset($r_option['events_order']) && $r_option['events_order'] == 'start_date') $events_order = '_event_date_start';
	else $events_order = '_event_date_end';

	$order = $type == 'future' ? $order = 'ASC' : $order = 'DSC';
	$type = $type == 'future' ? $type = 'Future events' : $type = 'Past events';
	$args = array(
		'post_type'     => 'wp_events_manager',
		'wp_event_type' => 'Future events',
		'showposts'     => $limit,
		'orderby'       => 'meta_value',
		'meta_key'      => $events_order,
		'order'         => $order,
		'offset'        => $offset
	);
	
	if (isset($post)) $backup = $post;
	
	$recent_event_query = new WP_Query();
	$recent_event_query->query($args);
	
	if ($recent_event_query->have_posts()) {
		
		while ($recent_event_query->have_posts()) {
			$recent_event_query->the_post();

			/* Post Image */
        	$event_image = get_post_meta($recent_event_query->post->ID, '_event_masonry_image', true); 
        	$crop = get_post_meta($recent_event_query->post->ID, '_event_masonry_image_crop', true);
        	$crop = isset($crop) && $crop != '' ? $crop = $crop : $crop = 'c';

        	/* Start date */
	      $event_date = strtotime(get_post_meta($recent_event_query->post->ID, '_event_date_start', true));
	      $event_time = strtotime(get_post_meta($recent_event_query->post->ID, '_event_time_start', true));
			
			if (is_object_in_term($recent_event_query->post->ID, 'wp_event_type', $type)) {
			   $output .= '<div class="countdown-wrap">';
			   $output .= '<h6 class="countdown-title">'. __('TIME LEFT:', SHORT_NAME) . '</h6>';
			   $output .= '<div class="countdown" data-event-date="' . date('Y/m/d', $event_date) . ' ' . date('H:i', $event_time) . ':00">';
			   $output .= '<div class="days" data-label="' . __('Days', SHORT_NAME) . '">000</div>';
			   $output .= '<div class="hours" data-label="' . __('Hours', SHORT_NAME) . '">000</div>';
			   $output .= '<div class="minutes" data-label="' . __('Minutes', SHORT_NAME) . '">000</div>';
			   $output .= '<div class="seconds" data-label="' . __('Seconds', SHORT_NAME) . '">000</div>';
			   $output .= '</div>';
			   $output .= '<a href="' . get_permalink() . '" class="plus-button"></a>';
			   $output .= '</div>';
			   $output .= '';

				// If image exists
				if (isset($event_image) && !empty($event_image)) {
					$output .= '<span class="cover">';
            	$output .= r_image(array(
						'type'       => 'custom_link',
						'link'       => get_permalink(),
						'src'        => $event_image,
						'crop'       => $crop,
						'title'      => get_the_title(),
						'classes'    => 'aligncenter thumb-icon',
						'html_after' => '<span class="icon plus"></span>',
						'width'      => $width,
						'height'     => $height
           		));
            	$output .= '</span>';
				}
			
			}

		}
	} else $events = false;

	wp_reset_query();
	if (isset($post)) $post = $backup;

	return $output;
	
}
add_shortcode('recent_event', 'r_recent_event');


/* Recent releases
 ------------------------------------------------------------------------*/
function r_recent_releases($atts, $content = null) {
	global $r_option;
	
	extract(shortcode_atts(array(
		'limit'   => '-1',
		'columns' => '4',
		'masonry' => 'false',
		'offset' => '0',
		'by_author' => ''
	), $atts));
	
	// Set layout
	if ($columns != '2' && $columns != '3' && $columns != '4') $columns = '4';
	if ($columns == '2') {
      $width = '460';
      $height = '460';
   } else {
      $width = '420';
     	$height = '420';
   }

   // Masonry
   if ($masonry == 'true') {
   	$width = '460';
      $height = '460';
      $limit = '1';
   }

   // Vars
	$output = '';
	$count = 0;
	$link = '';
   $type = '';
   $classes = '';

	// Query vars
	$args = array(
		'post_type' => 'wp_releases',
		'showposts' => $limit,
		'offset' => $offset
	);
	
	if (isset($r_option['releases_order']) && $r_option['releases_order'] == 'custom')  {
		$args['orderby'] = 'menu_order';
		$args['order'] = 'ASC';
	}
	if ($by_author != '')  {
		$args['tax_query'] = array(
			array(
           'taxonomy' => 'wp_release_artists',
           'field' => 'slug',
           'terms' => $by_author
			)
		);
	}
	
	if (isset($post)) $backup = $post;
	
	$recent_releases_q = new WP_Query();
	$recent_releases_q->query($args);
	
	if ($recent_releases_q->have_posts()) {
		if ($masonry != 'true') $output .= '<section class="content items portfolio recent-works">';
		
		while ($recent_releases_q->have_posts()) {
			$recent_releases_q->the_post();

			/* Release image */
         $release_image = get_post_meta($recent_releases_q->post->ID, '_release_image', true);
         $release_image_crop = get_post_meta($recent_releases_q->post->ID, '_release_image_crop', true);

         /* Release image 2 */
         $release_image_b = get_post_meta($recent_releases_q->post->ID, '_release_image_b', true);
         $release_image_crop_b = get_post_meta($recent_releases_q->post->ID, '_release_image_crop_b', true);

         /* Lightbox image */
         $lightbox_image = get_post_meta($recent_releases_q->post->ID, '_lightbox_image', true);

         /* Release Iframe */
         $release_iframe = get_post_meta($recent_releases_q->post->ID, '_release_iframe', true);

         /* Lightbox group */
         $lightbox_group = get_post_meta($recent_releases_q->post->ID, '_lightbox_group', true);

         /* Release badge */
         $release_badge = get_post_meta($recent_releases_q->post->ID, '_badge', true);

         /* Custom link */
         $custom_link = get_post_meta($recent_releases_q->post->ID, '_link_url', true);

         /* Link target attribute */
         $target = get_post_meta($recent_releases_q->post->ID, '_target', true);
         $target = isset($target) && $target == 'on' ? $target = 'blank' : $target = 'self';

         /* Tooltip title */
         $tooltip_title = get_post_meta($recent_releases_q->post->ID, '_tooltip_title', true);

         /* Tooltip text */
         $tooltip_text = get_post_meta($recent_releases_q->post->ID, '_tooltip_text', true);

         /* Release type */
         $release_type = get_post_meta($recent_releases_q->post->ID, '_release_type', true);

         /* Thumb type */
         $thumb_type = get_post_meta($recent_releases_q->post->ID, '_thumb_type', true);

         switch ($release_type) {

				// Image
				case 'image' :
				   $type = $release_type;
				   $classes = 'release-image';
				break;

				// Lightbox image
				case 'lightbox_image' :
				   $link = $lightbox_image;
				   $type = $release_type;
				break;

				// Iframe
				case 'lightbox_video':
				case 'lightbox_soundcloud':
				   $type = $release_type;
				break;

				// Custom link
				case 'custom_link' :
				   $link = $custom_link;
				   $type = $release_type;
				   if ($target == 'blank') $type = 'custom_link_blank';
				break;

				// Project link
				case 'project_link' :
				   $link = get_permalink();
				   $type = 'custom_link';
				break;
         }
			$args = array(
				'type'        => $type, //image, lightbox_image, lightbox_video, lightbox_soundcloud, custom_link, custom_link_blank
				'effect'      => $thumb_type,  //thumb_icon, thumb_slide
				'src'         => $release_image,
				'src_back'    => $release_image_b,
				'link'        => $link,
				'width'       => $width,
				'height'      => $height,
				'iframe_code' => $release_iframe,
				'group'       => $lightbox_group,
				'title'       => $tooltip_title,
				'crop'        => $release_image_crop,
				'badge'       => $release_badge,
				'tooltip'     => $tooltip_text,
				'align'       => 'noalign',
				'classes'     => $classes
			);

			if ($masonry != 'true') {
				if ($count == 0 && $content != '') 
					$output .= '<article class="col-1-' . $columns . ' clearfix">' . do_shortcode($content) . '</article>';
				$output .= '<article class="col-1-' . $columns . ' clearfix">';
			}
			// Display
         $output .= r_custom_image($args);

         if ($masonry != 'true') {
				$output .= '<footer>';
				$output .= '<h2><a href="' . get_permalink() . '">' . get_the_title() . '</a></h2>';

				// Get genres
				$genres = get_the_term_list($recent_releases_q->post->ID, 'wp_release_genres', '', '', '');
				if (!is_wp_error($genres)) $output .= '<div class="cat">' . $genres . '</div>';

				$output .= '</footer>';
				$output .= '</article>';
			}

			// Count
			$count++;
		}
		if ($masonry != 'true') $output .= '</section>';
	}
	wp_reset_query();
	if (isset($post)) $post = $backup;
	
	return $output;
	
}
add_shortcode('recent_releases', 'r_recent_releases');


/* Recent albums
 ------------------------------------------------------------------------*/
function r_recent_albums($atts, $content = null) {
	global $r_option;
	
	extract(shortcode_atts(array(
		'limit'   => '-1',
		'columns' => '4',
		'offset' => '0',
		'masonry' => 'false'
	), $atts));
	
	// Set layout
	if ($columns != '2' && $columns != '3' && $columns != '4') $columns = '4';
	if ($columns == '2') {
      $width = '460';
      $height = '460';
   } else {
      $width = '420';
     	$height = '420';
   }

   // Masonry
   if ($masonry == 'true') {
   	$width = '460';
      $height = '460';
      $limit = '1';
   }

   // Vars
	$output = '';
   $classes = '';
   $count = 0;
   $date_format = 'd/m/y';
   if (isset($r_option['custom_date'])) $date_format = $r_option['custom_date'];

	// Query vars
	$args = array(
		'post_type' => 'wp_gallery',
		'showposts' => $limit,
		'offset' => $offset
	);
	
	if (isset($post)) $backup = $post;
	
	$recent_albums_q = new WP_Query();
	$recent_albums_q->query($args);
	
	if ($recent_albums_q->have_posts()) {
		if ($masonry != 'true') $output .= '<section class="content items portfolio">';
		while ($recent_albums_q->have_posts()) {
			$recent_albums_q->the_post();

			/* Album cover */
         $album_cover = get_post_meta($recent_albums_q->post->ID, '_album_cover', true);
         $album_cover_crop = get_post_meta($recent_albums_q->post->ID, '_album_cover_crop', true);

         /* Tooltip title */
         $tooltip_title = get_post_meta($recent_albums_q->post->ID, '_tooltip_title', true);

         /* Tooltip text */
         $tooltip_text = get_post_meta($recent_albums_q->post->ID, '_tooltip_text', true);
         if ($masonry != 'true') {
	         if ($count == 0 && $content != '') { 
					$output .= '<article class="col-1-' . $columns . ' clearfix">' . do_shortcode($content) . '</article>';
				}
	         $output .= '<article class="col-1-' . $columns . '">';
      	}
			$args = array(
				'type'        => 'custom_link', //image, lightbox_image, lightbox_video, lightbox_soundcloud, custom_link, custom_link_blank
				'effect'      => 'thumb_icon',  //thumb_icon, thumb_slide
				'src'         => $album_cover,
				'link'        => get_permalink(),
				'width'       => $width,
				'height'      => $height,
				'title'       => $tooltip_title,
				'crop'        => $album_cover_crop,
				'tooltip'     => $tooltip_text,
				'align'       => 'noalign'
			);
			$output .= r_custom_image($args);

			if ($masonry != 'true') {
				$output .= '<footer>';
	         $output .= '<h2><a href="'. get_permalink() .'">'. get_the_title() .'</a><br><small>'. get_the_time($date_format) .'</small></h2>';
	         $output .= '</footer>';
	        	$output .= '</article>';
       	}

        	// Count
			$count++;
		}
		if ($masonry != 'true') $output .= '</section>';
	}
	wp_reset_query();
	if (isset($post)) $post = $backup;
	
	return $output;
	
}
add_shortcode('recent_albums', 'r_recent_albums');


/* Album images
 ------------------------------------------------------------------------*/
function r_album_images($atts, $content = null) {
	global $r_option;
	
	extract(shortcode_atts(array(
		'album_id' => '',
		'limit'   => '-1',
		'columns' => '4'
	), $atts));
	
	if ( $album_id == '' ) {
		return '<p class="message error">' . __( 'Error: Please set correct album ID', SHORT_NAME ) . '</p>';
	} 
	// Set layout
	if ($columns != '2' && $columns != '3' && $columns != '4' && $columns != '5') $columns = '4';
	
  	$width = '400';
  	$height = '400';
 
   // Vars
	$output = '';
   $classes = '';
   $date_format = 'd/m/y';
   if (isset($r_option['custom_date'])) $date_format = $r_option['custom_date'];

   	/* Images ids */
	 $images_ids = get_post_meta($album_id, '_gallery_images', true);

	 if (!$images_ids || $images_ids == '') {
	   echo '<p class="message error">' . __( 'Error: Album has no pictures', SHORT_NAME ) . '</p>';
	 }

	 $output .= '<div class="masonry-wrap album-images clearfix">';
	 $count = 1;
	 $ids = explode('|', $images_ids);
	 $defaults = array(
	    'title'               => '',
	    'desc'                => '',
	    'crop'                => 'c',
	    'image_type'          => '',
	    'lightbox_image'      => '',
	    'lightbox_video'      => '',
	    'lightbox_soundcloud' => '',
	    'custom_link'         => '',
	    'iframe_code'         => ''
	 );

	 /* Start Loop */
	 foreach ($ids as $id) {
	    // Vars 
	    $desc_id = '';
	    $title = '';

	    $image_url = get_post($id);
	    $image_att = wp_get_attachment_image_src($id);
	    if (!$image_att[0]) continue;

	    /* Get image meta */
	    $image = get_post_meta($album_id, '_gallery_images_' . $id, true);

	    /* Add default values */
	    if (isset($image) && is_array($image)) $image = array_merge($defaults, $image);
	    else $image = $defaults;

	    /* Add image src to array */
	    $image['src'] = wp_get_attachment_url($id);

	    // Link
	    $link = $image['custom_link'];
	    
	    // Lightbox image
	    if ($image['image_type'] == '') $image['image_type'] = 'lightbox_image';

	    if ($image['image_type'] == 'lightbox_image') $link = $image['lightbox_image'];

	    $output .= '<div class="masonry flex-col-1-' . esc_attr( $columns ) . '">';
	    $output .= r_custom_image(array(
           'type'           => $image['image_type'],
           'iframe_code'    => $image['iframe_code'],
           'link'           => $link,
           'src'            => $image['src'],
           'crop'           => $image['crop'],
           'group'          => 'gallery_custom',
           'title'          => $image['title'],
           'width'          => $width,
           'height'         => $height,
           'lightbox_group' => '',
           'classes'        => '',
           'lazyload'       => false
        ));
	    $output .= '</div>';
	    if ( $count == $limit ) {
	    	break;
	    }
	    /* Count */
	    $count++;
	}
	
	$output .= '</div>';
	return $output;
	
}
add_shortcode('album_images', 'r_album_images');


/* Artists list
 ------------------------------------------------------------------------*/
function r_artists($atts, $content = null) {
	global $r_option;
	
	extract(shortcode_atts(array(
		'limit'   => '-1',
		'columns' => '3',
		'offset'  => 0,
		'by_cat'  => 'all'
	), $atts));
	
	if ($columns != '2' && $columns != '3' && $columns != '4') $columns = '3';
	$output = '';

	// Query vars
	$limit = (int)$limit;
	$args = array(
		'post_type' => 'wp_artists',
		'showposts' => $limit,
		'nopaging' => true, 
		'offset' => $offset
	);

	if ($by_cat != '')  {
		$args['tax_query'] = array(
			array(
           'taxonomy' => 'wp_artists_categories',
           'field' => 'slug',
           'terms' => $by_cat
			)
		);
	}
	
	if (isset($post)) $backup = $post;
	
	$artists_query = new WP_Query();
	$artists_query->query($args);
	
	if ($artists_query->have_posts()) {
		$output .=  '<div class="items artists">';
		
		while ($artists_query->have_posts()) {
			$artists_query->the_post();

			/* Post Image */
        	$artist_image = get_post_meta($artists_query->post->ID, '_artist_image', true); 
        	$crop = get_post_meta($artists_query->post->ID, '_artist_image_crop', true);
        	$crop = isset($crop) && $crop != '' ? $crop = $crop : $crop = 'c';

			$output .= '<article class="col-1-'. $columns .' clearfix">';
			// If image exists
			if (isset($artist_image) && !empty($artist_image)) {
         	$output .= r_image(array(
					'type'       => 'custom_link',
					'link'       => get_permalink(),
					'src'        => $artist_image,
					'crop'       => $crop,
					'title'      => get_the_title(),
					'classes'    => 'aligncenter thumb-icon',
					'html_after' => '<span class="icon plus"></span>',
					'width'      => '460',
					'height'     => '460'
           	));
			}
			$output .= '<footer>';
			$output .= '<h3><a href="' . get_permalink() . '">' . get_the_title() . '</a></h3>';
			$output .= '<p>' . get_the_excerpt() . '</p>';

			// Get genres
			$genres = get_the_term_list($artists_query->post->ID, 'wp_artists_genres', '', ' &middot; ', '');
			if (!is_wp_error($genres)) $output .= '<div class="cat">' . strip_tags($genres) . '</div>';

			$output .= '</footer>';
			$output .= '</article>';
		}
		$output .= '</div>';
	}
	wp_reset_query();
	if (isset($post)) $post = $backup;
	
	return $output;
	
}
add_shortcode('artists', 'r_artists');


/* Recent comments
 ------------------------------------------------------------------------*/
function r_recent_comments($atts, $content = null) {
	global $wpdb, $r_option;
	
	extract(shortcode_atts(array(
		'limit'  => '3',
		'length' => '5'
		), $atts));

	$date_format = 'd/m/y';
	if (isset($r_option['custom_date'])) $date_format = $r_option['custom_date'];
	
	$sql = "SELECT DISTINCT ID, post_title, post_password, comment_ID, comment_post_ID, comment_author, comment_date_gmt, comment_approved, comment_type,comment_author_url, comment_content AS com_excerpt FROM $wpdb->comments LEFT OUTER JOIN $wpdb->posts ON ($wpdb->comments.comment_post_ID = $wpdb->posts.ID) WHERE comment_approved = '1' AND comment_type = '' AND post_password = '' ORDER BY comment_date_gmt DESC LIMIT " . $limit;
		
	$comments = $wpdb->get_results($sql);
	$output = '';
	$output.= '<ul class="recent-comments">';
	if ($comments && $comments != '') {
		foreach($comments as $comment) {
			$comment_body = r_trim($comment->com_excerpt, $length, true, ' [...]');
			$time = strtotime($comment->comment_date_gmt);
			$output.= "<li>" . $comment_body . "<a href=\"" . get_permalink($comment->ID) . "\" title=\"" . $comment->post_title . " (" . date($date_format . ' H:i:s', $time) .") \" class=\"meta\">" . strip_tags($comment->comment_author) . "</a>\n </li> ";
		}
	} else {
		$output .= '<li>' . _x('No Comments', 'Recent Comments', SHORT_NAME) . '</li>';
	}
	$output .= "\n</ul>";
	
	return $output;
	
}
add_shortcode('recent_comments', 'r_recent_comments');


/* Columns
 ------------------------------------------------------------------------*/

/* Two */
function r_1_2($atts, $content = null) {
   return '<div class="col-1-2">' . do_shortcode($content) . '</div>';
}
add_shortcode('1_2', 'r_1_2');

function r_1_2_last($atts, $content = null) {
   return '<div class="col-1-2 last">' . do_shortcode($content) . '</div>';
}
add_shortcode('1_2_last', 'r_1_2_last');

/* Three */
function r_1_3($atts, $content = null) {
   return '<div class="col-1-3">' . do_shortcode($content) . '</div>';
}
add_shortcode('1_3', 'r_1_3');

function r_1_3_last($atts, $content = null) {
   return '<div class="col-1-3 last">' . do_shortcode($content) . '</div>';
}
add_shortcode('1_3_last', 'r_1_3_last');

/* Four */
function r_1_4($atts, $content = null) {
   return '<div class="col-1-4">' . do_shortcode($content) . '</div>';
}
add_shortcode('1_4', 'r_1_4');

function r_1_4_last($atts, $content = null) {
   return '<div class="col-1-4 last">' . do_shortcode($content) . '</div>';
}
add_shortcode('1_4_last', 'r_1_4_last');

/* Two Third */
function r_2_3($atts, $content = null) {
   return '<div class="col-2-3">' . do_shortcode($content) . '</div>';
}
add_shortcode('2_3', 'r_2_3');

function r_2_3_last($atts, $content = null) {
   return '<div class="col-2-3 last">' . do_shortcode($content) . '</div>';
}
add_shortcode('2_3_last', 'r_2_3_last');

/* Three Fourth */
function r_3_4($atts, $content = null) {
   return '<div class="col-3-4">' . do_shortcode($content) . '</div>';
}
add_shortcode('3_4', 'r_3_4');

function r_3_4_last($atts, $content = null) {
   return '<div class="col-3-4 last">' . do_shortcode($content) . '</div>';
}
add_shortcode('3_4_last', 'r_3_4_last');


/* Boxes
 ------------------------------------------------------------------------*/

/* Boxes */
function r_boxes($atts, $content = null) {
   return '<div class="boxes">' . do_shortcode($content) . '<div class="clear"></div></div>';
}
add_shortcode('boxes', 'r_boxes');

/* Two */
function r_box_1_2($atts, $content = null) {
   return '<div class="box col-1-2">' . do_shortcode($content) . '</div>';
}
add_shortcode('box_1_2', 'r_box_1_2');

function r_box_1_2_last($atts, $content = null) {
   return '<div class="box col-1-2 last">' . do_shortcode($content) . '</div>';
}
add_shortcode('box_1_2_last', 'r_box_1_2_last');

/* Three */
function r_box_1_3($atts, $content = null) {
   return '<div class="box col-1-3">' . do_shortcode($content) . '</div>';
}
add_shortcode('box_1_3', 'r_box_1_3');

function r_box_1_3_last($atts, $content = null) {
   return '<div class="box col-1-3 last">' . do_shortcode($content) . '</div>';
}
add_shortcode('box_1_3_last', 'r_box_1_3_last');

/* Four */
function r_box_1_4($atts, $content = null) {
   return '<div class="box col-1-4">' . do_shortcode($content) . '</div>';
}
add_shortcode('box_1_4', 'r_box_1_4');

function r_box_1_4_last($atts, $content = null) {
   return '<div class="box col-1-4 last">' . do_shortcode($content) . '</div>';
}
add_shortcode('box_1_4_last', 'r_box_1_4_last');

/* Two Third */
function r_box_2_3($atts, $content = null) {
   return '<div class="box col-2-3">' . do_shortcode($content) . '</div>';
}
add_shortcode('box_2_3', 'r_box_2_3');

function r_box_2_3_last($atts, $content = null) {
   return '<div class="box col-2-3 last">' . do_shortcode($content) . '</div>';
}
add_shortcode('box_2_3_last', 'r_box_2_3_last');

/* Three Fourth */
function r_box_3_4($atts, $content = null) {
   return '<div class="box col-3-4">' . do_shortcode($content) . '</div>';
}
add_shortcode('box_3_4', 'r_box_3_4');

function r_box_3_4_last($atts, $content = null) {
   return '<div class="box col-3-4 last">' . do_shortcode($content) . '</div>';
}
add_shortcode('box_3_4_last', 'r_box_3_4_last');


/* Custom Image
 ------------------------------------------------------------------------*/
function r_custom_image($atts, $content = null) {
	
	extract(shortcode_atts(array(
		'type'        => 'image', //image, lightbox_image, lightbox_video, lightbox_soundcloud, custom_link, custom_link_blank
		'effect'      => 'thumb_icon',  //thumb_icon, thumb_slide
		'src'         => '',
		'src_back'    => '',
		'link'        => '',
		'width'       => '680',
		'height'      => '300',
		'iframe_code' => '',
		'group'       => '',
		'title'       => '',
		'crop'        => 'c',
		'badge'       => '',
		'tooltip'     => '',
		'align'       => 'aligncenter',
		'classes'     => '',
		'lazyload'   => false
	 ), $atts));

	$html_before = '';
	$html_after = '';
	$output = '';
	$data = '';
	
	if ($src == '') return '<p class="message error">Image error: <strong>Invalid src</strong></p>';
	//if ($link == '') $link = $src;
	
	/* Image */
	if ($type == 'image') {
		$output .= r_image(array(
			'type'    => $type,
			'src'     => $src,
			'crop'    => $crop,
			'title'   => $title,
			'width'   => $width,
			'height'  => $height,
			'classes' => $classes . ' ' . $align,
			'lazyload' => $lazyload
		));
		return $output;
	}

	/* Image type */
	switch ($type) {

		/* Lightbox image */
		case 'lightbox_image':
			$classes = $align . ' thumb-icon';
			$html_after = '<span class="icon view"></span>';
		break;

		/* Lightbox soundcloud */
		case 'lightbox_soundcloud':
			$classes = $align . ' thumb-icon';
			$html_after = '<span class="icon soundcloud"></span>';
		break;

		/* Lightbox video */
		case 'lightbox_video':
			$classes = $align . ' thumb-icon';
			$html_after = '<span class="icon view"></span>';
		break;

		/* Custom link / Custom_link_blank */
		case 'custom_link':
		case 'custom_link_blank':
			$classes = $align . ' thumb-icon';
			$html_after = '<span class="icon plus"></span>';
		break;
	}
	/* Effect */
	if ($effect == 'thumb_slide') {
		// Generate side B image
		if ($src_back == '') $src_back = $src;
		$src_back = r_image(array(
			'type'    => 'image',
			'src'     => $src_back,
			'crop'    => $crop,
			'title'   => $title,
			'width'   => $width,
			'height'  => $height
		));
		$classes = $align . ' thumb-slide';
		$html_before = '<span class="thumbs-wrap">';
		$html_after = $src_back . '</span>';
	}
	// Badge
	if ($badge != '') {
		$html_before = '<span class="badge ' . $badge . '"></span>' . $html_before;
	}

	// Tooltip
	if ($tooltip != '') {
		$data = 'data-tip-title="' . strip_tags(do_content($title)) . '" data-tip-desc="' . strip_tags(do_content($tooltip)) . '"';
		$classes = $classes . ' tip';
	}

	$output .= r_image(array(
		'type'           => $type,
		'lightbox_image' => $link,
		'iframe_code'    => $iframe_code,
		'link'           => $link,
		'src'            => $src,
		'crop'           => $crop,
		'title'          => $title,
		'width'          => $width,
		'height'         => $height,
		'lightbox_group' => $group,
		'classes'        => $classes,
		'html_before'    => $html_before,
		'html_after'     => $html_after,
		'data'           => $data,
		'lazyload'       => $lazyload
	));

	return $output;
}
add_shortcode('custom_image', 'r_custom_image');


/* Player
 ------------------------------------------------------------------------*/
function r_player($atts, $content = null) {
	global $wp_query, $r_option, $shortcode_id;
	
	extract(shortcode_atts(array(
		'id'            => '',
		'type'          => 'simple_player', // simple_player, ext_player, simple_playlist, ext_playlist
		'autostart'     => 'false',
		'disable_audio' => 'false'
		), $atts));

	if (!isset($r_option['js_soundmanager']) || $r_option['js_soundmanager'] == 'off') return '<p class="message error">Soundmanager error: <strong>Soundmanager is disabled. Go to Theme Settings > Advanced > Theme Scripts and enable Soundmanager.</strong></p>';
	if ($id == '') return '<p class="message error">Soundmanager error: <strong>Invalid ID</strong></p>';

	// Vars
	$output = '';
	$post_id = $id;
	$meta_name = '_audio_tracks';

	if ($autostart == 'on') $autostart = 'true';
   else $autostart = 'false';

	/* Images ids */
	$tracks_ids = get_post_meta($post_id, $meta_name, true);

	if (!$tracks_ids || $tracks_ids == '') {
		 return '<p class="message error">Player error: <strong>Audio playlist has no tracks or doesn\'t exists.</strong></p>';
	}
	$count = 0;
	$ids = explode('|', $tracks_ids);
	$defaults = array(
			'custom'     => false,
			'custom_url' => '',
			'title'      => '',
			'desc'       => '',
			'buttons'    => '',
			'volume'     => $r_option['volume']
   );

	// Playlist begin
	if ($type == 'simple_playlist' || $type == 'ext_playlist') $output .= '<ol class="playlist" data-autoplay="' . $autostart . '" data-playnext="true">';

	/* Start Loop */
	foreach ($ids as $id) {

		/* Count */
		$count++;

		// add odd class to playlist
		$odd = '';
		if ($count % 2) $odd = 'class="odd"';

		/* Get image meta */
		$track = get_post_meta($post_id, $meta_name . '_' . $id, true);

		/* Add default values */
		if (isset($track) && is_array($track)) $track = array_merge($defaults, $track);
		else $track = $defaults;

		/* Check if track is custom */
	   if (wp_get_attachment_url($id)) {
	      $track_att = get_post($id);
	      $track['url'] = wp_get_attachment_url($id);
	      if ($track['title'] == '') $track['title'] = $track_att->post_title;
	    } else {
	      $track['url'] = $track['custom_url'];
	      if ($track['url'] == '') continue;
	      if ($track['title'] == '') $track['title'] = __('Custom Title', SHORT_NAME);
	    }

	   // Playlist link
	   $a = '<a class="playable track" href="' . $track['url'] . '" data-volume="' . $track['volume'] . '">' . $track['title'] . '</a>';
	   if ($disable_audio == 'true') 
	   	$a = '<span class="playable">' . $track['title'] . '</span>';

      // Generate tracks

      //  -- Simple player
		if ($type == 'simple_player') {
			$output .= '<a class="playable track" href="' . $track['url'] . '" data-autoplay="' . $autostart . '" data-volume="' . $track['volume'] . '">' . $track['title'] . '</a>';
			// Break loop
			if ($count == 1 ) break;
		} 
		// -- Extended player
		elseif ($type == 'ext_player') {
			$output .= '<div class="ext-playable">';
			$output .= '<a class="playable track" href="' . $track['url'] . '" data-autoplay="' . $autostart . '" data-volume="' . $track['volume'] . '">' . $track['title'] . '</a>';
			// Buttons here
			$output .= do_content($track['buttons']);
			$output .= '</div>';
			// Break loop
			if ($count == 1 ) break;
		}
		// -- Simple playlist
		elseif ($type == 'simple_playlist') {
			$output .= '<li ' . $odd . '><span class="track-number">' . $count . '</span>' . $a . '</li>';
		}
		// -- Extended playlist
		elseif ($type == 'ext_playlist') {
			$output .= '<li ' . $odd . '>';
			$output .= '<span class="track-number">' . $count . '</span>' . $a;
			// Details here
			if ($track['desc'] != '') $output .= '<div class="playlist-details">' . $track['desc'] . '</div>';
			$output .= do_content($track['buttons']);
			$output .= '</li>';
		}
		
	} // End foreach

	// Playlist end
	if ($type == 'simple_playlist' || $type == 'ext_playlist') $output .= '</ol>';

	return $output;
	
}
add_shortcode('player', 'r_player');

// Player button (helper shortcode)
function r_player_button($atts, $content = null) {
	
	extract(shortcode_atts(array(
		'title'  => 'Title',
		'link'   => '#',
		'target' => '',
		'download' => 'false',
		'classes' => '',
		), $atts));

	if ($link != '#' && $link != '' && $download == 'true') $link = THEME_URI . '/includes/download.php?file=' . $link;

	if ($target == 'blank') $target = 'target="_blank"';
	else $target = '';

	$output = '<a href="' . $link . '" class="player-button ' . $classes . '" ' . $target . '>' . $title . '</a>';
	return $output;
}
add_shortcode('player_button', 'r_player_button');


/* Nivo Slider
 ------------------------------------------------------------------------*/
function r_nivo_slider($atts, $content = null) {
	global $wp_query, $r_option, $shortcode_id;
	
	extract(shortcode_atts(array(
		'id'             => '',
		'image_width'    => '680',
		'image_height'   => '300'
		), $atts));

	if (!isset($r_option['js_nivo_slider']) || $r_option['js_nivo_slider'] == 'off') return '<p class="message error">Nivo Slider error: <strong>Nivo Slider is disabled. Go to Theme Settings > Advanced > Theme Scripts and enable Nivo Slider.</strong></p>';
	if ($id == '') return '<p class="message error">Nivo Slider error: <strong>Invalid ID</strong></p>';

	// Vars
	$output = '';
	$post_id = $id;
	$desc = '';
	$meta_name = '_custom_slider';

	// Get metadata
	$effect = get_post_meta($post_id, '_nivo_effect', true);
	$nav = get_post_meta($post_id, '_nivo_nav', true);
	$manual_advance = get_post_meta($post_id, '_nivo_manual_advance', true);
	$animspeed = get_post_meta($post_id, '_nivo_speed', true);
	$pausetime = get_post_meta($post_id, '_nivo_pause_time', true);
	$slices = get_post_meta($post_id, '_nivo_slices', true);
	$boxcols = get_post_meta($post_id, '_nivo_boxcols', true);
	$boxrows = get_post_meta($post_id, '_nivo_boxrows', true);

	if ($nav == 'on') $nav = 'true'; 
	else $nav = 'false';

	if ($manual_advance == 'on') $manual_advance = 'true'; 
	else $manual_advance = 'false';

	$output .= '<div class="nivo-slider" data-effect="'. $effect .'" data-nav="'. $nav .'" data-manual_advance="'. $manual_advance .'" data-animspeed="'. $animspeed .'" data-pausetime="'. $pausetime .'" data-slices="'. $slices .'" data-boxcols="'. $boxcols .'" data-boxrows="'. $boxrows .'">';

	/* Images ids */
	$images_ids = get_post_meta($post_id, $meta_name, true);

	if (!$images_ids || $images_ids == '') {
		 return '<p class="message error">Nivo Slider error: <strong>Slider has no pictures or doesn\'t exists.</strong></p>';
	}
	$count = 0;
	$ids = explode('|', $images_ids);
	$defaults = array(
		'title'               => '',
		'desc'                => '',
		'crop'                => 'c',
		'image_type'          => 'image',
		'lightbox_image'      => '',
		'lightbox_video'      => '',
		'lightbox_soundcloud' => '',
		'custom_link'         => '',
		'iframe_code'         => ''
	);

	/* Start Loop */
	foreach ($ids as $id) {
		// Vars 
		$desc_id = '';
		$title = '';

		$image_url = get_post($id);
		$image_att = wp_get_attachment_image_src($id);
		if (!$image_att[0]) continue;
		
		/* Count */
	   $count++;

		/* Get image meta */
		$image = get_post_meta($post_id, $meta_name . '_' . $id, true);

		/* Add default values */
		if (isset($image) && is_array($image)) $image = array_merge($defaults, $image);
		else $image = $defaults;

		/* Add image src to array */
	   $image['src'] = wp_get_attachment_url($id);

	   if ($image['desc'] != '' || $image['title'] != '') { 
	   	$desc_id = 'html_desc_' . $shortcode_id . $count;
	   	if ($image['title'] != '') $title = '<h4 class="nivo-html-title">' . $image['title'] . '</h4>';
	   	$desc .= '<div id="' . $desc_id . '" class="nivo-html-caption">' . $title . $image['desc'] . '</div>';
	   	$desc_id = '#' . $desc_id;
	   	$shortcode_id++;
	   }
				
		/* Geneate image */
		$output .= r_image(array(
			'type'           => $image['image_type'],
			'lightbox_image' => $image['lightbox_image'],
			'iframe_code'    => $image['iframe_code'],
			'link'           => $image['custom_link'],
			'src'            => $image['src'],
			'crop'           => $image['crop'],
			'title'          => $desc_id,
			'width'          => $image_width,
			'height'         => $image_height,
			'lightbox_group' => '',
			'classes'        => ''
		));
		
	} // End foreach

	$output .= '</div>';

	// Desc
	$output .= $desc;

	return $output;
	
}
add_shortcode('nivo_slider', 'r_nivo_slider');


/* Soundcloud
 ------------------------------------------------------------------------*/
function r_soundcloud($atts, $content=null) {

	 extract(shortcode_atts(array(
        'url'    => '',
        'height' => '166',
        'width'  => '100%',
        'params' => '',
        'iframe' => 'false'
    ), $atts));
    
    if ($params != '') {
        str_replace("&", "&amp;", $params);
        $url = $url . '&amp;show_artwork=true&amp;' . $params;
    }
    if (empty($url)) return '<p>Soundcloud error: <strong>Invalid Track</strong></p>';
    
    if ($iframe == 'true') 
    $output = '<iframe width="100%" height="' . esc_attr( $height ) . '" scrolling="no" frameborder="no" src="https://w.soundcloud.com/player/?url=' . esc_url( $url ) . '"></iframe>';
    return $output;
}
add_shortcode('soundcloud', 'r_soundcloud');


/* Video
 ------------------------------------------------------------------------*/
function r_video($atts, $content=null) {
	
	extract(shortcode_atts(array(
		'type'         => 'vimeo',
		'id'           => '',
		'width'        => 'auto',
		'height'       => 'auto',
		'autoplay'     => '0',
		'byline'       => '0',
		'portrait'     => '0',
		'ui_color'     => 'fa4c29',
		'params'       => '',
		'custom_style' => ''
	), $atts));

	$output = '';
	$sizes = '';
	if ($width != 'auto') $sizes .= 'width="'. $width . '"';
	if ($height != 'auto') $sizes .= ' height="'. $height . '"';

	if (empty($id)) return '<p class="error">Video Error: Invalid id</p>';

	$output .= '<div class="video" ' . $custom_style . '>';
	if ($type == 'vimeo') {
		$params = "color=$ui_color&amp;autoplay=$autoplay&amp;byline=$byline&amp;portrait=$portrait$params";
		$output .= '<iframe src="https://player.vimeo.com/video/'. $id .'?' . $params . '" '. $sizes .'></iframe>';
	}
	if ($type == 'youtube') {
		$params = "autoplay=$autoplay&amp;wmode=transparent$params";
		$output .= '<iframe src="https://www.youtube.com/embed/'. $id .'?' . $params . '" '. $sizes .' allowfullscreen></iframe>';
	}
	$output .= '</div>';

	return $output;
}
add_shortcode('iframe_video', 'r_video');


/* Contact form
 ------------------------------------------------------------------------*/
function r_contact_form($atts, $content=null) {
	
	$output = '<form action="' . admin_url('admin-ajax.php') . '" class="form contact-form">';
	$output .= '<p class="input"><label for="contact-name">'. __('<strong>Name</strong> (required)', SHORT_NAME) . '</label><input type="text" name="name" value="" id="contact-name" required></p>';
	$output .= '<p class="input"><label for="contact-email">'. __('<strong>Email</strong> (required)', SHORT_NAME) . '</label><input type="email" name="email" value="" id="contact-email" required></p>';
	$output .= '<p class="input"><label for="contact-subject">'. __('<strong>Subject</strong>', SHORT_NAME) . '</label><input type="text" name="subject" value="" id="contact-subject"></p>';
	$output .= '<p class="textarea"><label for="contact-message">'. __('<strong>Your Message</strong> (required)', SHORT_NAME) . '</label><textarea name="message" id="contact-message" cols="88" rows="6" required></textarea></p>';
	$output .= '<p class="hidden"><label for="contact-spam-check">Do not fill out this field this is spam check.</label><input name="anty_spam" type="text" value="" id="contact-spam-check" /></p>';
	$output .= '<input type="submit" value="'. __('Submit Message', SHORT_NAME) . '">';
	$output .= '<div class="clear"></div>';
	$output .= '<input type="hidden" value="' . $_SERVER['REMOTE_ADDR'] . '" name="ip" />';
	$output .= '</form>';

	return $output;
}
add_shortcode('contact_form', 'r_contact_form');


/* Custom posts shortcodes
 ------------------------------------------------------------------------*/

// Single navigation
function r_nav($atts, $content=null) {
	global $post, $r_option;

	if (isset($post)) $backup = $post;

	$output = '';
	$post_type = get_post_type($post->ID);
	$id = $post->ID;
	$count = 0;
	$prev_id = '';
	$next_id = '';
	$posts = array();

	if ($post_type == 'wp_artists' || $post_type == 'wp_events_manager' || $post_type == 'wp_releases') {

		// Artists
		if ($post_type == 'wp_artists') {
			
			$args = array(
				'post_type' => 'wp_artists',
				'showposts'=> '-1'
			);
		}
		// Artists
		if ($post_type == 'wp_releases') {
			
			$args = array(
				'post_type' => 'wp_releases',
				'showposts'=> '-1'
			);
			if (isset($r_option['releases_order']) && $r_option['releases_order'] == 'custom')  {
				$args['orderby'] = 'menu_order';
				$args['order'] = 'ASC';
			}
		}
		// Events manager
		if ($post_type == 'wp_events_manager') {
			if (is_object_in_term($post->ID, 'wp_event_type', 'Future events')) {
				$event_type = 'Future events';
			} else {
				$event_type = 'Past events';
			}
			$order = $event_type == 'Future events' ? $order = 'ASC' : $order = 'DSC';
			$args = array(
				'post_type' => 'wp_events_manager',
				'tax_query' => 
					array(
						array(
						'taxonomy' => 'wp_event_type',
						'field' => 'slug',
						'terms' => $event_type
						)
					),
				'showposts'=> '-1',
				'orderby' => 'meta_value',
				'meta_key' => '_event_date_start',
				'order' => $order
			);
		}

		// Nav loop
		$nav_query = new WP_Query();
		$nav_query->query($args);
		if ($nav_query->have_posts())	{
			while ($nav_query->have_posts()) {
				$nav_query->the_post();
				$posts[] = get_the_id();
				if ($count == 1) break;
				if ($id == get_the_id()) $count++;
			}
			$current = array_search($id, $posts);

			// Check IDs
		if (isset($posts[$current-1])) $prev_id = $posts[$current-1];
		if (isset($posts[$current+1])) $next_id = $posts[$current+1];

		// Display nav
		$output .= '<div id="single-nav">';
		if ($prev_id)
			$output .= '<a href="' . get_permalink($prev_id) . '" class="nav-prev" title="' . get_the_title($prev_id) . '"></a>';
		else
			$output .= '<span class="nav-prev"></span>';
		if ($next_id) 
			$output .= '<a href="' . get_permalink($next_id) . '" class="nav-next" title="' . get_the_title($next_id) . '"></a>';
		else
			$output .= '<span class="nav-next"></span>';
		$output .= '</div>';
		}

		if (isset($post)) $post = $backup;
		
		return $output;
	} else {
		return __('You can not use [nav] in this page.', SHORT_NAME);
	}
}
add_shortcode('nav', 'r_nav');

// Title
function r_title($atts, $content=null) {
	global $post;
	$output = '';
	$title = get_the_title($post->ID);
	$output = $title;
	return $output;
}
add_shortcode('title', 'r_title');

// Date
function r_date($atts, $content=null) {
	global $post, $r_option;

	$post_date = strtotime($post->post_date);
	$date_format = 'd/m/y';
	if (isset($r_option['custom_date'])) $date_format = $r_option['custom_date'];
	$output = date($date_format, $post_date);

	return $output;
}
add_shortcode('date', 'r_date');

// Categories
function r_cats($atts, $content=null) {
	global $post;
	extract(shortcode_atts(array(
		'links' => 'true'
	), $atts));
	$post_type = get_post_type($post->ID);

	// Events manager
	if ($post_type == 'wp_events_manager') {
		if ($links == 'false') {
			$output = get_the_term_list($post->ID, 'wp_event_categories', '', ' &middot; ', '');
			if (is_wp_error($output)) return;
			return strip_tags($output);
		} else {
			$output = get_the_term_list($post->ID, 'wp_event_categories', '', '', '');
			return $output;
		}
	// Artist categories
	} else if ($post_type == 'wp_artists') {
			$output = get_the_term_list($post->ID, 'wp_artists_categories', '', ' &middot; ', '');
			if (is_wp_error($output)) return;
			return strip_tags($output);
	}

	return;
}
add_shortcode('cats', 'r_cats');

// Genres
function r_genres($atts, $content=null) {
	global $post;

	extract(shortcode_atts(array(
		'links' => 'true'
	), $atts));
	$post_type = get_post_type($post->ID);

	// Releases
	if ($post_type == 'wp_releases') {
		if ($links == 'false') {
			$output = get_the_term_list($post->ID, 'wp_release_genres', '', ' &middot; ', '');
			if (is_wp_error($output)) return;
			return strip_tags($output);
		} else {
			$output = get_the_term_list($post->ID, 'wp_release_genres', '', '', '');
		}
	}
	// Artists
	else if ($post_type == 'wp_artists') {
		$output = get_the_term_list($post->ID, 'wp_artists_genres', '', ' &middot; ', '');
		if (is_wp_error($output)) return;
		return strip_tags($output);
	}

	if (is_wp_error($output)) return;

	return $output;
}
add_shortcode('genres', 'r_genres');


/* Releases
 ------------------------------------------------------------------------*/
// Artists names
function r_artists_names($atts, $content=null) {
	global $post;
	$post_type = get_post_type($post->ID);

	// Releases
	if ($post_type == 'wp_releases') {
		$output = get_the_term_list($post->ID, 'wp_release_artists', '', '', '');
	}

	if (is_wp_error($output)) return;

	return $output;
}
add_shortcode('artists_names', 'r_artists_names');

// Release catalog
function r_catalog($atts, $content=null) {
	global $post;

	return get_post_meta($post->ID, '_cat_num', true);
}
add_shortcode('catalog', 'r_catalog');

// Small cover
function r_cover($atts, $content=null) {
	global $post;

	$img = get_post_meta($post->ID, '_release_image', true);
	if (!$img) return;

	return '<img src="' . theme_path($img) . '" alt="' . $post->post_title . '" class="size-1-2 cover-image">';
}
add_shortcode('cover', 'r_cover');


/* Events
 ------------------------------------------------------------------------*/

// Event Date
function r_event_date($atts, $content=null) {
	global $post, $r_option;

	extract(shortcode_atts(array(
		'end_date' => 'false'
	), $atts));

	$output = '';
	$event_date_start = strtotime(get_post_meta($post->ID, '_event_date_start', true));
	$event_date_end = strtotime(get_post_meta($post->ID, '_event_date_end', true));
	$date_format = 'd/m/y';
	if (isset($r_option['custom_date'])) $date_format = $r_option['custom_date'];
	
	$output .= date($date_format, $event_date_start);

   if ($event_date_start != $event_date_end && $end_date == 'true') {
   	$output .= ' - ' . date($date_format, $event_date_end);
   }

	return $output;
}
add_shortcode('event_date', 'r_event_date');

// Event Time
function r_event_time($atts, $content=null) {
	global $post, $r_option;

	extract(shortcode_atts(array(
		'end_time' => 'false',
		'military_time' => 'true'
	), $atts));

	// Vars
	$output = '';
	$event_time_start = get_post_meta($post->ID, '_event_time_start', true);
	$event_time_end = get_post_meta($post->ID, '_event_time_end', true);

	
	if ($military_time == 'false') {
		$event_time_start = date('h:i A', strtotime($event_time_start));
		$event_time_end = date('h:i A', strtotime($event_time_end)); 
	}

	$output .= $event_time_start;

	if ($end_time == 'true')
		$output .= ' - ' . $event_time_end;

	return $output;
}
add_shortcode('event_time', 'r_event_time');


// Featured Image
// thumnail - Thumbnail (Note: different to Post Thumbnail)
// medium - Medium resolution
// large - Large resolution
// full - Original resolution
// [featured_image size="thumbnail" ]
function r_featured_image($atts, $content=null) {
	global $post;

	extract(shortcode_atts(array(
		'size' => 'thumbnail'
	), $atts));

	if ( ! isset( $post ) ) return;
	$output = '';
	if ( has_post_thumbnail( $post->ID ) ) {
		$output .= '<div class="featured-image">';
		$output .= get_the_post_thumbnail( $post->ID, $size );
		$output .= '</div>';
    }
    return $output;
	
}
add_shortcode('featured_image', 'r_featured_image');
?>
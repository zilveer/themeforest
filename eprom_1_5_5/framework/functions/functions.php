<?php

/* Small Functions
 ------------------------------------------------------------------------*/
 
/* Exclude custom posts from search */


/* Add theme support */
add_theme_support('automatic-feed-links');

/* Add post thumnails */
add_theme_support('post-thumbnails');

/* Set feed cache lifetime in secounds */
//add_filter('wp_feed_cache_transient_lifetime', create_function( '$a', 'return 600;' )); 

/* Set content width */
if (!isset($content_width)) $content_width = 940;

// Add Qtranslate filter
if (QTRANS) add_filter('post_type_link', 'qtrans_convertURL'); 


/* Nice title */
function r_theme_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() )
		return $title;

	// Add the site name.
	$title .= get_bloginfo( 'name' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title = "$title $sep $site_description";

	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 )
		$title = "$title $sep " . sprintf( __( 'Page %s', 'theme' ), max( $paged, $page ) );

	return $title;
}
add_filter( 'wp_title', 'r_theme_wp_title', 10, 2 );


/* Custom password form
 ------------------------------------------------------------------------*/
function custom_password_form() {
	global $post;
	$label = 'pwbox-' . (empty($post->ID) ? rand() : $post->ID);
	$o = '<form class="protected-post-form" action="' . get_option('siteurl') . '/wp-login.php?action=postpass" method="post">
	<p>' . __('This post is password protected. To view it please enter your password below:', SHORT_NAME) . ' </p>
	<label for="' . $label . '">' . __('Password:', SHORT_NAME) . ' </label><input name="post_password" id="' . $label . '" type="password" size="20" class="pass"/><input type="submit" name="submit" value="' .  esc_attr__( __( 'Submit', SHORT_NAME ) ) . '" class="submit pass_submit" /></p></form>';
	return $o;
}

add_filter('the_password_form', 'custom_password_form');


/* Ajax contact form
 ------------------------------------------------------------------------*/
function ajax_r_form() {
	global $r_option;

	// Setup our basic variables
	$error = '';
	$error_mailto ='';
	$input_subject = __('Email address does not valid. <br/>Check your email address in Theme Settings > Pages > Contact.', SHORT_NAME);
	$nonce = $_POST['ajax_nonce'];
	$data = array();
	parse_str($_POST['order'], $data);
	$input_name = strip_tags($data['name']);
	$input_email = strip_tags($data['email']);
	$input_subject = strip_tags($data['subject']);
	$input_message = strip_tags($data['message']);
	$input_ip = strip_tags($data['ip']);

	// Set header
	header("Content-Type: application/json");

   if (!wp_verify_nonce($nonce, 'ajax-nonce')) die('Busted!');
 	
 	// Ensures no one loads page and does simple spam check
	if (isset($_POST['name']) && empty($_POST['spam-check'])) die('Direct access to this page is not allowed.');
	
	// Check if email to address exists
	if (isset($r_option['email']) && !empty($r_option['email'])) {
		if (!filter_var($r_option['email'], FILTER_VALIDATE_EMAIL)) $error_mailto['email'] = __('Email address does not valid. <br/>Check your email address in Theme Settings > Pages > Contact.', SHORT_NAME);
	} else {
		$error_mailto['email'] = __('Email address does not exists. <br/>Check your email address in Theme Settings > Pages > Contact.', SHORT_NAME);
	}

	// If email addrss not valid or not exists
	if($error_mailto) {
		$response = $error_mailto['email'];
		echo "<p class='warning'>$response</p>";
		exit;
	}

	// We'll check and see if any of the required fields are empty
	if(strlen($input_name) < 2) $error['name'] = __('Please enter your name.', SHORT_NAME);
	if(strlen($input_message) < 5) $error['message'] = __('Please leave a message.', SHORT_NAME);

	// Make sure the email is valid
	if(!filter_var($input_email, FILTER_VALIDATE_EMAIL) ) $error['email'] = __('Please enter a valid email address.', SHORT_NAME);

	// Set a subject & check if custom subject exist
	$subject = __('Message from', SHORT_NAME) . $input_name;
	if($input_subject) $subject .= ": $input_subject";

	$message = "$input_message\n";
	$message .= __("\n---\nThis email was sent by contact form.\n", SHORT_NAME);
	$message .= "Email: $input_email\n";
	$message .= "IP: $input_ip";

	// Now check to see if there are any errors 
	if(!$error) {
		// No errors, send mail using conditional to ensure it was sent
		if(isset($r_option['email']) && wp_mail($r_option['email'], $subject, $message, "From: $input_email")) {
			echo '<p class="success">' . __('Your email has been sent!', SHORT_NAME) . '</p>';
		} else {
			echo '<p class="error">' . __('There was a problem sending your email!', SHORT_NAME) . '</p>';
		}
		
	} else {
		
		// Errors were found, output all errors to the user
		$response = (isset($error['name'])) ? $error['name'] . "<br /> \n" : null;
		$response .= (isset($error['email'])) ? $error['email'] . "<br /> \n" : null;
		$response .= (isset($error['message'])) ? $error['message'] . "<br /> \n" : null;

		echo "<p class='warning'>$response</p>";
		
	}
	
	exit;
}
add_action('wp_ajax_nopriv_r_form', 'ajax_r_form');
add_action('wp_ajax_r_form', 'ajax_r_form');


/* Check the current post for the existence of a short code
 ------------------------------------------------------------------------*/
function r_has_shortcode($shortcode = '') {
    global $post;

    if (!isset($post)) return false;
	
	// false because we have to search through the post content first
	$found = false;
	
	// if no short code was provided, return false
	if (!$shortcode) {
		return $found;
	}
	// check the post content for the short code
	
		$pattern = get_shortcode_regex();
		preg_match_all( '/'. $shortcode .'/s', $post->post_content, $matches);
		if (is_array($matches) && in_array($shortcode, $matches[0])) {
			$found = true;
		}
	// return our final results
	return $found;
}


/* Tag Cloud Filter
 ------------------------------------------------------------------------*/
function r_tag_cloud_filter($args = array()) {
   $args['smallest'] = 9;
   $args['largest'] = 14;
   $args['unit'] = 'px';
   return $args;
}

add_filter('widget_tag_cloud_args', 'r_tag_cloud_filter', 90);


/* Twitter
 ------------------------------------------------------------------------*/
 /* ----------------------------------------------------------------------
    TWITTER FEED
/* ---------------------------------------------------------------------- */
if ( ! function_exists( 'r_parse_twitter' ) ) :
function r_parse_twitter($options) {

    // Defaults options
   $defaults = array(
		'time'                => 3600,
		'limit'               => '1',
		'username'            => '',
		'replies'             => 'true',
		'consumer_key'        => '',
		'consumer_secret'     => '',
		'access_token'        => '',
		'access_token_secret' => '',
		'tweet_prefix'        => '',
		'tweet_surfix'        => ''
   );

    if ( isset( $options ) && is_array( $options ) ) {
        $options = array_merge( $defaults, $options );
    } else { 
        $options = $defaults;
    }

    // Extract $options
    extract( $options, EXTR_PREFIX_SAME, "twitter" );

    // Errors
    $errors = '';

    if ( empty( $consumer_key ) ) $errors = __( 'ERROR: Missing API Key.', SHORT_NAME );
    if ( empty( $consumer_secret ) ) $errors = __( 'ERROR: Missing API Secret.', SHORT_NAME );
    if ( empty( $username ) ) $errors = __( 'ERROR: Missing Twitter Feed User Name.', SHORT_NAME );
    if ( $errors ) {
        return '<p class="error">ERROR: ' . $errors . '</p>';
    }

    // Replies
    if ( $replies == 'yes' ) {
        $replies = '0';
    } else {
        $replies = '1';
    }

    // Vars
    $trans_name = 'rascals_tweets_' . $username;
    $token = '';
    $count = 1;
    $output = '';

    // delete_transient( $trans_name );

    /* Shelude feed */
    if ( false === ( $tweet_task = get_transient( $trans_name ) ) ) {

        $bearer_token_credential = $consumer_key . ':' . $consumer_secret;
        $credentials = base64_encode( $bearer_token_credential );
        
        $args = array(
            'method' => 'POST',
            'httpversion' => '1.1',
            'blocking' => true,
            'headers' => array( 
                'Authorization' => 'Basic ' . $credentials,
                'Content-Type' => 'application/x-www-form-urlencoded;charset=UTF-8'
            ),
            'body' => array( 'grant_type' => 'client_credentials' )
        );

        add_filter( 'https_ssl_verify', '__return_false' );
        $response = wp_remote_post( 'https://api.twitter.com/oauth2/token', $args );

        $keys = json_decode( $response['body'] );
        
        if ( $keys ) {
            $token = $keys->{'access_token'};

            $args = array(
                'httpversion' => '1.1',
                'blocking' => true,
                'headers' => array( 
                    'Authorization' => "Bearer $token"
                )
            );
            add_filter('https_ssl_verify', '__return_false');
            $api_url = "https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name=$username&count=20&exclude_replies=$replies&include_rts=0";

            $response = wp_remote_get( $api_url, $args );

            set_transient( $trans_name, $response['body'], 60 * $time );

        } else {
            delete_transient( $trans_name );
            return false;       
        }
        
    } 

    @$json = json_decode( get_transient( $trans_name ) );

    if ( ! empty( $json ) ){

        /* If feed has error */
        if ( isset( $json->errors ) ) {
            $errors = '';

            foreach ( $json->errors as $error ) {
                $errors .= '<p class="error">ERROR: ' . $error->code . ': ' . $error->message . '</p>';
            }

            // Delete transient
            delete_transient( $trans_name );
            return $errors;
        }

        $tweets_a = array();
        foreach ( $json as $tweet ) {
            $datetime = $tweet->created_at;
            $date = date('F j, Y, g:i a', strtotime( $datetime));
            $time = date('g:ia', strtotime( $datetime ) );
            $date = human_time_diff( strtotime( $date ), current_time( 'timestamp', 1 ) );
            $tweet_text = $tweet->text;
            
            // check if any entites exist and if so, replace then with hyperlinked versions
            $tweet_text = preg_replace('/http:\/\/([a-z0-9_\.\-\+\&\!\#\~\/\,]+)/i', '<a href="http://$1" target="_blank">http://$1</a>&nbsp;', $tweet_text);

            // convert @ to follow
            $tweet_text = preg_replace("/(@([_a-z0-9\-]+))/i","<a href=\"http://twitter.com/$2\" title=\"Follow $2\" >$1</a>",$tweet_text);

            // convert # to search
            $tweet_text = preg_replace("/(#([_a-z0-9\-]+))/i","<a href=\"https://twitter.com/search?q=%23$2&amp;src=hash\" title=\"Search $1\" >$1</a>",$tweet_text);

            $tweets_a[$count]['text'] = $tweet_text;
            $tweets_a[$count]['date'] = '<a href="https://twitter.com/' . esc_attr( $username ) . '/statuses/' . $tweet->id_str . '">' . $date . ' ' . __('ago', SHORT_NAME) . '</a>';
            
            // if ( $count == $limit ) {
            //     break;
            // }
            $count++;
                
        }
          
        if ( is_array( $tweets_a ) ) {
            $output .= '<ul class="tweets">';
            foreach ( $tweets_a as $key => $tweet ) {
                $output .= '<li>' . $tweet[ 'text' ] . '<span class="date">' . $tweet[ 'date' ] . '</span></li>';  
                if ( $key == $limit ) {
                    break;
                }
            }

            $output .= '</ul>';
            return $output;

        } else {
            // Errors
            return '<p class="error">' . __( 'ERROR: Twitter API error.', SHORT_NAME ) . '</p>';
        }
    } else {
        return '<p class="error">' . __( 'ERROR: Username not exists or Twitter API error.', SHORT_NAME ) . '</p>';
        delete_transient( $trans_name );
    }

    
}

endif;



/* Theme Path
 ------------------------------------------------------------------------*/
function theme_path($string) {
	global $r_option;
	if (isset($r_option['demo_content']) && $r_option['demo_content'] == 'on')
	$string = str_replace('THEME_PATH', THEME_URI, $string);
	return $string;
}


/* Check Files Permissions
 ------------------------------------------------------------------------*/
function file_perms($file, $octal = false) {
	
    if(!file_exists($file)) return false;
    $perms = fileperms($file);
    $cut = $octal ? 2 : 3;
    return substr(decoct($perms), $cut);
}


/* Image Exists Function
 ------------------------------------------------------------------------*/
function r_image_exists($src) {
	
	$src = theme_path($src);
	$src = parse_url($src);
	$src = $src['path'];
	$src = strstr($src, 'wp-content');
	$image_path =  ABSPATH . $src;
	$image = @getimagesize($image_path);
  	if ($image) return $image;
	else return false;
	
}


/* Image Resize Function
 ------------------------------------------------------------------------*/
function r_image_resize($width, $height, $src, $crop = 'c') {
	
	global $r_option;
	
	if (!isset($crop) || $crop == '') $crop = 'c';
	$src = theme_path($src);
	$theme_path = THEME_URI;
	$quality = 75;
	if (isset($r_option['quality']) && $r_option['quality'] != '') 
		$quality = $r_option['quality'];
	
	$image = r_image_exists($src);
	
	if ($image) {
		if ($image[1] <= $height && $image[0] <= $width) {
			return $src;
		} else {
			if ( function_exists( 'mr_image_resize' ) ) {
					return mr_image_resize( $src, $width, $height, true, $crop, false );
				}
		}
	} else return $src;

}


/* Autoresize Image
 ------------------------------------------------------------------------*/
function r_image($options) {
	
	/* Check image SRC */
	if (!isset($options['src']) && $options['src'] == '') return '<!-- ERROR: Image SRC does not exist -->';
	
	// Defaults options
	$defaults = array(
		'type'           => 'image', // image, lightbox_image, lightbox_video, lightbox_soundcloud, custom_link, custom_link_blank
		'lightbox_image' => '',
		'iframe_code'    => '',
		'link'           => '#',
		'src'            => '',
		'crop'           => 'c',
		'title'          => '',
		'width'          => '',
		'height'         => '',
		'lightbox_group' => '',
		'classes'        => '',
		'html_before'    => '',
		'html_after'     => '',
		'data'           => '',
		'lazyload'       => false
   );
	if (isset($options) && is_array($options)) $options = array_merge($defaults, $options);
	else $options = $defaults;

	// Convert THEME_PATH
	$options['src'] = theme_path($options['src']);

	// If lightbox link doesn't exists get orginal image link
	if ($options['lightbox_image'] == '') $options['lightbox_image'] = $options['src'];

	// Vars
	$image = r_image_resize($options['width'], $options['height'], $options['src'], $options['crop']);
	$output = '';

	// Title
	$options['title'] = htmlspecialchars($options['title'], ENT_QUOTES);

	// Lazy load
	if ($options['lazyload']) {
		$lazy_class = 'lazy';
		$lazy_data = 'data-original="' . $image .'"';
		$image = SKIN_IMG_URI . '/lazyloading.gif';
	} else {
		$lazy_class = '';
		$lazy_data = '';
	}

	if ($options['lightbox_group'] != '') $options['lightbox_group'] = 'data-group="' . $options['lightbox_group'] . '"';

	switch ($options['type']) {

		// Image
		case 'image':
			$output .= '<img src="' . $image . '" alt="' . $options['src'] . '" title="' . $options['title'] . '" class="' . $options['classes'] . ' ' . $lazy_class .'" '. $lazy_data .'>';
		break;

		// Image Lightbox
		case 'lightbox_image':
			$output .= '<a href="' . $options['lightbox_image'] . '" class="imagebox ' . $options['classes'] . '" ' . $options['lightbox_group'] . ' ' . $options['data'] . ' title="' . $options['title'] . '">' . $options['html_before'] . '<img src="' . $image . '" alt="' . $options['src'] . '" title="' . $options['title'] . '" class="' . $lazy_class .'" '. $lazy_data .'>' . $options['html_after'] . '</a>';
		break;

		// Iframe
		case 'lightbox_video':
		case 'lightbox_soundcloud':
	
			// Parse iframe code and get values
			$attr = array();
			$attr = explode('|', $options['iframe_code']);
			if (!isset($attr) && !is_array($attr)) break;

			if ($attr[1] == '100%') $attr[1] = 'auto';

			$output .= '<a href="' . str_replace('&','&amp;',$attr[0]) . '" class="mediabox ' . $options['classes'] . '" data-width="' . $attr[1] . '" data-height="' . $attr[2] . '" ' . $options['lightbox_group'] . ' ' . $options['data'] . ' title="' . $options['title'] . '">' . $options['html_before'] . '<img src="' . $image . '" alt="' . $options['src'] . '" title="' . $options['title'] . '" class="' . $lazy_class .'" '. $lazy_data .'>' . $options['html_after'] . '</a>';

		break;

		// Custom Link
		case 'custom_link':
		case 'custom_link_blank':

			if ($options['type'] == 'custom_link_blank') $target = 'target="_blank"';
			else $target = '';
			$output .= '<a href="' . $options['link'] . '" class="' . $options['classes'] . '" ' . $target .' ' . $options['data'] . '>' . $options['html_before'] . '<img src="' . $image . '" alt="' . $options['src'] . '" title="' . $options['title'] . '" class="' . $lazy_class .'" '. $lazy_data .'>' . $options['html_after'] . '</a>';
		break;

	}
	
	return $output;
}


/* Login function
 ------------------------------------------------------------------------*/
function is_login_page() {
	global $pagenow;
    return in_array($pagenow, array('wp-login.php', 'wp-register.php'));
}


/* Facebook Image
 ------------------------------------------------------------------------*/
function r_facebook_image() {
	global $wp_query; 
	if (is_single() || is_page()) {
		$facebook_thumb = get_post_meta($wp_query->post->ID, 'facebook_image', true);
		$facebook_thumb = theme_path($facebook_thumb);		 
		if (isset($facebook_thumb) && r_image_exists($facebook_thumb)) {
		    echo '<meta property="og:image" content="' . $facebook_thumb . '"/>' . "\n";
	
		}
	}
}
add_action('wp_head', 'r_facebook_image'); 


/* Trim Function
 ------------------------------------------------------------------------*/
function r_trim($text, $length, $strip_tags = false, $end = '[...]') {
	//$text = str_replace(']]>', ']]>', $text);
	if ($strip_tags) $text = strip_tags($text);
	$words = explode(' ', $text, $length + 1);
	if (count($words) > $length) {
		array_pop($words);
		array_push($words, $end);
		$text = implode(' ', $words);
	}		
	return $text;
}


/* Insert default taxonomy
 ------------------------------------------------------------------------*/
function r_insert_taxonomy($cat_name, $parent, $description, $taxonomy) {
	global $wpdb;

	if (!term_exists($cat_name, $taxonomy)) {
		$args = compact(
						$wpdb->escape($cat_name),
						$cat_slug = sanitize_title($cat_name),
						$parent = 0,
						$description = ''
						);
		wp_insert_term($cat_name, $taxonomy, $args);
		return;
	}
  return;
}


/* Get Taxonomy ID
 ------------------------------------------------------------------------*/
function r_get_taxonomy_id($cat_name, $taxonomy) {
	
	$args = array(
				  'hide_empty' => false
				  );
	
	$taxonomies = get_terms($taxonomy, $args);
	if ($taxonomies) {
		foreach($taxonomies as $taxonomy) {
			
			if ($taxonomy->name == $cat_name) {
				return $taxonomy->term_id;
			}
			
		}
	}
	
	return false;
}


/* Revolution Slider Helper functions
 ------------------------------------------------------------------------*/
function r_is_revslider() {
	global $wpdb;
	$table_name = $wpdb->prefix . 'revslider_sliders';
   if ($wpdb->get_var("SHOW TABLES LIKE '$table_name'") == $table_name)
   	return true;
   else 
   	return false;
}
function r_get_revslider() {
	global $wpdb;
	$table_name = $wpdb->prefix . 'revslider_sliders';
   if ($wpdb->get_var("SHOW TABLES LIKE '$table_name'") == $table_name) {
   	$slides = $wpdb->get_results("SELECT title as name ,id as value FROM $table_name", ARRAY_A);
      if (is_array($slides) && !empty($slides))
         return $slides;
      else 
      	return false;
   }
   else 
   	return false;
}

?>
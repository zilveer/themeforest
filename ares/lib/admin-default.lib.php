<?php
// Get Twitter Follower count as plain text
add_option('pp_twitter_followers','0','','yes');
add_option('pp_twitter_api_timer',time(),'','yes');

function pp_twitter_followers($consumer_key, $consumer_secret, $access_token, $access_token_secret) {
	$twittercount = get_option('pp_twitter_followers');

    if ( $twittercount == 0 OR get_option(SHORTNAME.'_twitter_api_timer') < (mktime() - 3600) ) {
        // EDIT your Twitter user name here:
        $twitter_id = get_option(SHORTNAME.'_twitter_username');
        
        $connection = getConnectionWithAccessToken($consumer_key, $consumer_secret, $access_token, $access_token_secret);
		$tweets = $connection->get('https://api.twitter.com/1.1/users/show.json?screen_name=' . $twitter_id) or die('Couldn\'t retrieve tweets! Wrong username?');
		
		if(!empty($tweets->errors)){
		    if($tweets->errors[0]->message == 'Invalid or expired token'){
		    	echo '<strong>'.$tweets->errors[0]->message.'!</strong><br />You\'ll need to regenerate it <a href="https://dev.twitter.com/apps" target="_blank">here</a>!' . $after_widget;
		    }else{
		    	echo '<strong>'.$tweets->errors[0]->message.'</strong>' . $after_widget;
		    }
		    return;
		}
        
        if($tweets->followers_count > 0)
		{
        	update_option('pp_twitter_followers', $tweets->followers_count);
        	update_option('pp_twitter_api_timer', mktime());
        	$twittercount = $tweets->followers_count;
        }
        else
        {
        	$twittercount = get_option('pp_twitter_followers');
        }
    }
    else
    {
    	$twittercount = get_option('pp_twitter_followers');
    }
    if ( $twittercount != '0' ) { echo number_format($twittercount); }
    else { echo 0; }
}

// Get Feedburner RSS Subscriber count as plain text
add_option('pp_feeds_count','0','','yes');
add_option('pp_feeds_api_timer',time(),'','yes');

function pp_feeds_count() {
    $rsscount = 0;

    if ( $rsscount == 0 OR get_option('pp_feeds_api_timer') < (mktime() - 3600) ) {
    //if ( true ) {
        // EDIT your Feedburner feed name here:
        $fb_id = get_option('feedburner-id');
        $subscribers = curl("http://feeds.feedburner.com/" . $fb_id);
        
        //echo "http://feedburner.google.com/api/awareness/1.0/GetFeedData?uri=" . $fb_id;
        
        try {
            $xml = new SimpleXmlElement($subscribers, LIBXML_NOCDATA);
            //var_dump($xml);

            if ($xml) {
                $rsscount = (string) $xml->feed->entry['circulation'];

                if($rsscount > 0)
				{
                	update_option('pp_feeds_count', $rsscount);
                	update_option('pp_feeds_api_timer', mktime());
                }
                else
                {
                	$rsscount = get_option('pp_feeds_count');
                }
            }
        } catch (Exception $e) { }
    }
    else
    {
    	$rsscount = get_option('pp_feeds_count');
    }
    
    //Echo the count if we got it
    if($rsscount == 'N/A' || $rsscount == '0') { echo 0; }
    else { echo number_format($rsscount); }
}

// Get Facebook fan count as plain text
add_option('pp_facebook_fans','0','','yes');
add_option('pp_facebook_api_timer',time(),'','yes');

function pp_facebook_fans() {
	$fancount = 0;
    
    if ( $fancount == 0 OR get_option(SHORTNAME.'pp_facebook_api_timer') < (mktime() - 3600) ) {
        $page_id = get_option(SHORTNAME.'_facebook_username');
        $page_graph_data = curl("http://graph.facebook.com/".$page_id);
        try {
            $graph_obj = json_decode($page_graph_data);
			$count_fan = $graph_obj->likes;
            
			if($count_fan > 0)
			{
            	update_option('pp_facebook_fans', $count_fan);
            	update_option('pp_facebook_api_timer', mktime());
            }
            else
            {
            	$count_fan = get_option('pp_facebook_fans');
            }
        } catch (Exception $e) { }
    }
    else
    {
    	$count_fan = get_option('pp_twitter_followers');
    }
    if ( $count_fan != '0' ) { echo number_format($count_fan); }
    else { echo 0; }
}

function wpapi_pagination($pages = '', $range = 4)
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
 echo "<div class=\"pagination\">";
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
 echo "</div>\n";
 }
}

function pp_formatter($content) {
	$new_content = '';

	/* Matches the contents and the open and closing tags */
	$pattern_full = '{(\[raw\].*?\[/raw\])}is';

	/* Matches just the contents */
	$pattern_contents = '{\[raw\](.*?)\[/raw\]}is';

	/* Divide content into pieces */
	$pieces = preg_split($pattern_full, $content, -1, PREG_SPLIT_DELIM_CAPTURE);

	/* Loop over pieces */
	foreach ($pieces as $piece) {
		/* Look for presence of the shortcode */
		if (preg_match($pattern_contents, $piece, $matches)) {

			/* Append to content (no formatting) */
			$new_content .= $matches[1];
		} else {

			/* Format and append to content */
			$new_content .= wptexturize(wpautop($piece));
		}
	}

	return $new_content;
}

// Remove the 2 main auto-formatters
remove_filter('the_content', 'wpautop');
remove_filter('the_content', 'wptexturize');

// Before displaying for viewing, apply this function
add_filter('the_content', 'pp_formatter', 99);
add_filter('widget_text', 'pp_formatter', 99);


/* Disable the Admin Bar. */
function yoast_disable_admin_bar() {
add_filter( 'show_admin_bar', '__return_false' );
add_action( 'admin_print_scripts-profile.php',
'yoast_hide_admin_bar_settings' );
}
add_action( 'init', 'yoast_disable_admin_bar' , 9 );


//Make widget support shortcode
add_filter('widget_text', 'do_shortcode');

if (isset($_GET['activated']) && $_GET['activated']){
	global $wpdb;
	
	// Run default settings
	include_once(TEMPLATEPATH . "/default_settings.php");
    wp_redirect(admin_url("themes.php?page=admin-action.lib.php&activate=true"));
}
?>
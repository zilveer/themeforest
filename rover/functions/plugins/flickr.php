<?php
/*
 * @package by Theme Record
 * @auther: MattMao
*/

if ( !function_exists('theme_latest_filckr_gallery') )
{	
	function theme_latest_filckr_gallery($flickr_id, $image_count, $widget_id) 
	{

		// A flag so we know if the feed was successfully parsed
		$image_found = false;

		// Cache
		$cache = get_transient(THEME_SLUG.'_filckr_cache_id_'.$widget_id);


		// Show file from cache if still valid
		if ( $cache ) 
		{
			// Get tweets
			$images = get_option(THEME_SLUG.'_filckr_cache_'.$widget_id);
		}
		else
		{
			// Fetch the RSS feed from Twitter
			$rss_feed = wp_remote_get("http://api.flickr.com/services/feeds/photos_public.gne?id=$flickr_id&format=rss");

			// Parse the RSS feed to an XML object
			$rss_feed = @simplexml_load_string( $rss_feed['body'] );

			if( !is_wp_error( $rss_feed ) && isset( $rss_feed ) ) {

				$image = $rss_feed->channel->item;

				// Error check: Make sure there is at least one item
				if( count( $image ) ) {

					// Open the flickr wrapping element
					$images = '<ul class="flickr-feed clearfix">';

					$image_found = true;

					for( $i = 0; $i < $image_count; $i++ ) {

						// Get thumbnail size
						preg_match( '/<img[^>]*>/i', $image[$i]->description, $image_tag );
						preg_match( '/(?<=src=[\'|"])[^\'|"]*?(?=[\'|"])/i', $image_tag[0], $image_src );
						
						if ( preg_match( '/(_m.jpg)$/',$image_src[0] ) ){
							$thumb = preg_replace('/(_m.jpg)$/', '_s.jpg', $image_src[0] );
						} elseif( preg_match( '/(_m.png)$/',$image_src[0] ) ){
							$thumb = preg_replace('/(_m.png)$/', '_s.png', $image_src[0] );
						} elseif( preg_match( '/(_m.gif)$/',$image_src[0] ) ){
							$thumb = preg_replace( '/(_m.gif)$/', '_s.gif', $image_src[0] );
						}

						$image_link = $image[$i]->link;
						$image_title = $image[$i]->title;

						$images .= '<li class="post-thumb post-thumb-preload post-thumb-hover"><a href="'.$image_link.'" title="'.$image_title.'" class="loader-icon"><img src="'.$thumb.'" alt="'.$image_title.'" class="wp-preload-image"></a></li>';

					}

					// Close the twitter wrapping element
					$images .= '</ul><!-- end .flickr-feed -->';

					// Tweets will be updated every hour
					set_transient(THEME_SLUG.'_filckr_cache_id_'.$widget_id, 'true', 60 * 30);
					update_option(THEME_SLUG.'_filckr_cache_'.$widget_id, $images);

				}
			
			}

			// In case the RSS feed did not parse or load correctly, show a link to the Flickr account
			if ( !$image_found ){
				$images = '<ul class="flickr-feed"><li class="error">'.__('Oops, our Flickr feed is unavailable at the moment', 'TR').' - <a href="http://www.flickr.com/photos/'.$flickr_id.'/">'.__('Check our images on Flickr!', 'TR').'</a></li></ul>';
			}

		}

		return $images;

	}//end function
}
?>
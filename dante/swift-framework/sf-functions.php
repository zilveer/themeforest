<?php
	
	/*
	*
	*	Swift Framework Functions
	*	------------------------------------------------
	*	Swift Framework v2.0
	* 	Copyright Swift Ideas 2016 - http://www.swiftideas.net
	*
	*	sf_content_filter()
	*	sf_get_tweets()
	*	sf_hyperlinks()
	*	sf_twitter_users()
	*	sf_encode_tweet()
	*	sf_latest_tweet()
	*	posts_custom_columns()
	*	sf_list_galleries()
	*	sf_portfolio_related_posts()
	*	sf_has_previous_posts()
	*	sf_has_next_posts()
	*	sf_admin_altbg_css()
	*
	*/
	
	/* SHORTCODE FIX
	================================================== */	 
	if (!function_exists('sf_content_filter')) {
		function sf_content_filter($content) {
			// array of custom shortcodes requiring the fix 
			$block = join("|",array("alert","sf_button","icon","sf_iconbox","sf_imagebanner","social","sf_social_share","highlight","decorative_ampersand","blockquote1","blockquote2","blockquote3","pullquote","dropcap1","dropcap2","dropcap3","dropcap4","one_half","one_half_last","one_third","one_third_last","two_third","two_third_last","one_fourth","one_fourth_last","three_fourth","three_fourth_last","one_half","one_half_last","progress_bar","chart","sf_count","sf_countdown","sf_tooltip","sf_modal","sf_fullscreenvideo","sf_visibility","table","trow","thcol","tcol","pricing_table","pt_column","pt_package","pt_details","pt_button","pt_price","labelled_pricing_table","lpt_label_column","lpt_row_label","lpt_column","lpt_price","lpt_package","lpt_row_label","lpt_row","lpt_button","list","list_item","hr","accordion","panel","tabs","tab","sf_supersearch","gallery","spb_accordion","spb_accordion_tab","blog","boxed_content","clients","clients_featured","codesnippet","divider","faqs","sf_gallery","googlechart","spb_gmaps","impact_text","jobs","jobs_overview","latest_tweets","spb_message","spb_parallax","portfolio","portfolio_carousel","portfolio_showcase","posts_carousel","spb_products","spb_products_mini","spb_raw_html","spb_raw_js","recent_posts","spb_slider","sitemap","search_widget","supersearch","spb_tabs","spb_tab","spb_text_block","team_carousel","team","testimonial","testimonial_carousel","testimonial_slider","fullwidth_text","spb_toggle","spb_tour","tweets_slider","spb_video","blank_spacer","spb_single_image", "spb_row"));
			// opening tag
			$rep = preg_replace("/(<p>)?\[($block)(\s[^\]]+)?\](<\/p>|<br \/>)?/","[$2$3]",$content);
			// closing tag
			$rep = preg_replace("/(<p>)?\[\/($block)](<\/p>|<br \/>)?/","[/$2]",$rep);
			return $rep; 
		}
		add_filter("the_content", "sf_content_filter");
	}
	
	
	/* TWEET FUNCTIONS
	================================================== */
	if (!function_exists('sf_get_tweets')) {
		function sf_get_tweets($twitterID, $count) {
		
			$content = "";
					
			if (function_exists('getTweets')) {
				
				$options = array('trim_user'=>true, 'exclude_replies'=>false, 'include_rts'=>false);
							
				$tweets = getTweets($twitterID, $count, $options);
								
				if(is_array($tweets)){
																
					if (isset($tweets["error"]) && $tweets["error"] != "") {
						
						return '<li>'.$tweets["error"].'</li>';
					
					} else {
											
						foreach($tweets as $tweet) {
																	
							$content .= '<li>';
						
						    if ($tweet['text']) {
						    	
						    	$content .= '<div class="tweet-text">';
						    	
						        $the_tweet = $tweet['text'];
						      
						        /*
						        Twitter Developer Display Requirements
						        https://dev.twitter.com/terms/display-requirements
						
						        2.b. Tweet Entities within the Tweet text must be properly linked to their appropriate home on Twitter. For example:
						          i. User_mentions must link to the mentioned user's profile.
						         ii. Hashtags must link to a twitter.com search with the hashtag as the query.
						        iii. Links in Tweet text must be displayed using the display_url
						             field in the URL entities API response, and link to the original t.co url field.
						        */
						
						        // i. User_mentions must link to the mentioned user's profile.
						        if(isset($tweet['entities']['user_mentions']) && is_array($tweet['entities']['user_mentions'])){
						            foreach($tweet['entities']['user_mentions'] as $key => $user_mention){
						                $the_tweet = preg_replace(
						                    '/@'.$user_mention['screen_name'].'/i',
						                    '<a href="http://www.twitter.com/'.$user_mention['screen_name'].'" target="_blank">@'.$user_mention['screen_name'].'</a>',
						                    $the_tweet);
						            }
						        }
						
						        // ii. Hashtags must link to a twitter.com search with the hashtag as the query.
						        if(isset($tweet['entities']['hashtags']) && is_array($tweet['entities']['hashtags'])){
						            foreach($tweet['entities']['hashtags'] as $key => $hashtag){
						                $the_tweet = preg_replace(
						                    '/#'.$hashtag['text'].'/i',
						                    '<a href="https://twitter.com/search?q=%23'.$hashtag['text'].'&amp;src=hash" target="_blank">#'.$hashtag['text'].'</a>',
						                    $the_tweet);
						            }
						        }
						
						        // iii. Links in Tweet text must be displayed using the display_url
						        //      field in the URL entities API response, and link to the original t.co url field.
						        if(isset($tweet['entities']['urls']) && is_array($tweet['entities']['urls'])){
						            foreach($tweet['entities']['urls'] as $key => $link){
						                $the_tweet = preg_replace(
						                    '`'.$link['url'].'`',
						                    '<a href="'.$link['url'].'" target="_blank">'.$link['url'].'</a>',
						                    $the_tweet);
						            }
						        }
						        
						        // Custom code to link to media
						        if(isset($tweet['entities']['media']) && is_array($tweet['entities']['media'])){
						            foreach($tweet['entities']['media'] as $key => $media){
						                $the_tweet = preg_replace(
						                    '`'.$media['url'].'`',
						                    '<a href="'.$media['url'].'" target="_blank">'.$media['url'].'</a>',
						                    $the_tweet);
						            }
						        }
						
						        $content .= $the_tweet;
								
								$content .= '</div>';
						
						        // 3. Tweet Actions
						        //    Reply, Retweet, and Favorite action icons must always be visible for the user to interact with the Tweet. These actions must be implemented using Web Intents or with the authenticated Twitter API.
						        //    No other social or 3rd party actions similar to Follow, Reply, Retweet and Favorite may be attached to a Tweet.
						        // 4. Tweet Timestamp
						        //    The Tweet timestamp must always be visible and include the time and date. e.g., "3:00 PM - 31 May 12".
						        // 5. Tweet Permalink
						        //    The Tweet timestamp must always be linked to the Tweet permalink.
						        
						       	$content .= '<div class="twitter_intents">'. "\n";
						        $content .= '<a class="reply" href="https://twitter.com/intent/tweet?in_reply_to='.$tweet['id_str'].'"><i class="fa-reply"></i></a>'. "\n";
						        $content .= '<a class="retweet" href="https://twitter.com/intent/retweet?tweet_id='.$tweet['id_str'].'"><i class="fa-retweet"></i></a>'. "\n";
						        $content .= '<a class="favorite" href="https://twitter.com/intent/favorite?tweet_id='.$tweet['id_str'].'"><i class="fa-star"></i></a>'. "\n";
						        
						        $date = strtotime($tweet['created_at']); // retrives the tweets date and time in Unix Epoch terms
						        $blogtime = current_time('U'); // retrives the current browser client date and time in Unix Epoch terms
						        $dago = human_time_diff($date, $blogtime) . ' ' . sprintf(__('ago', 'swiftframework')); // calculates and outputs the time past in human readable format
								$content .= '<a class="timestamp" href="https://twitter.com/'.$twitterID.'/status/'.$tweet['id_str'].'" target="_blank">'.$dago.'</a>'. "\n";
								$content .= '</div>'. "\n";
						    } else {
						        $content .= '<a href="http://twitter.com/'.$twitterID.'" target="_blank">@'.$twitterID.'</a>';
						    }
						    $content .= '</li>';
						}
					}
					return $content;
					
				}
			} else {
				return '<li><div class="tweet-text">Please install the oAuth Twitter Feed Plugin and follow the theme documentation to set it up.</div></li>';
			}	
	
		}
	}
		
	function sf_hyperlinks($text) {
		    $text = preg_replace('/\b([a-zA-Z]+:\/\/[\w_.\-]+\.[a-zA-Z]{2,6}[\/\w\-~.?=&%#+$*!]*)\b/i',"<a href=\"$1\" class=\"twitter-link\">$1</a>", $text);
		    $text = preg_replace('/\b(?<!:\/\/)(www\.[\w_.\-]+\.[a-zA-Z]{2,6}[\/\w\-~.?=&%#+$*!]*)\b/i',"<a href=\"http://$1\" class=\"twitter-link\">$1</a>", $text);
		    // match name@address
		    $text = preg_replace("/\b([a-zA-Z][a-zA-Z0-9\_\.\-]*[a-zA-Z]*\@[a-zA-Z][a-zA-Z0-9\_\.\-]*[a-zA-Z]{2,6})\b/i","<a href=\"mailto://$1\" class=\"twitter-link\">$1</a>", $text);
		        //mach #trendingtopics. Props to Michael Voigt
		    $text = preg_replace('/([\.|\,|\:|\>|\{|\(]?)#{1}(\w*)([\.|\,|\:|\!|\?|\>|\}|\)]?)\s/i', "$1<a href=\"http://twitter.com/#search?q=$2\" class=\"twitter-link\">#$2</a>$3 ", $text);
		    return $text;
		}
		
	function sf_twitter_users($text) {
	       $text = preg_replace('/([\.|\,|\:|\>|\{|\(]?)@{1}(\w*)([\.|\,|\:|\!|\?|\>|\}|\)]?)\s/i', "$1<a href=\"http://twitter.com/$2\" class=\"twitter-user\">@$2</a>$3 ", $text);
	       return $text;
	}

    function sf_encode_tweet($text) {
            $text = mb_convert_encoding( $text, "HTML-ENTITIES", "UTF-8");
            return $text;
    }
	
	
	/* LATEST TWEET FUNCTION
	================================================== */
	if (!function_exists('sf_latest_tweet')) {
		function sf_latest_tweet($count, $twitterID) {
		
			global $sf_include_twitter;
			$sf_include_twitter = true;
			
			$content = "";
			
			if ($twitterID == "") {
				return __("Please provide your Twitter username", "swiftframework");
			}
			
			if (function_exists('getTweets')) {
							
				$options = array('trim_user'=>true, 'exclude_replies'=>false, 'include_rts'=>false);
							
				$tweets = getTweets($twitterID, $count, $options);
			
				if(is_array($tweets)){
							
					foreach($tweets as $tweet){
											
						$content .= '<li>';
												
					    if(is_array($tweet) && isset($tweet['text']) && $tweet['text']){
					    	
					    	$content .= '<div class="tweet-text">';
					    	
					        $the_tweet = $tweet['text'];
					        
					        /*
					        Twitter Developer Display Requirements
					        https://dev.twitter.com/terms/display-requirements
					
					        2.b. Tweet Entities within the Tweet text must be properly linked to their appropriate home on Twitter. For example:
					          i. User_mentions must link to the mentioned user's profile.
					         ii. Hashtags must link to a twitter.com search with the hashtag as the query.
					        iii. Links in Tweet text must be displayed using the display_url
					             field in the URL entities API response, and link to the original t.co url field.
					        */
					
					        // i. User_mentions must link to the mentioned user's profile.
					        if(isset($tweet['entities']['user_mentions']) && is_array($tweet['entities']['user_mentions'])){
					            foreach($tweet['entities']['user_mentions'] as $key => $user_mention){
					                $the_tweet = preg_replace(
					                    '/@'.$user_mention['screen_name'].'/i',
					                    '<a href="http://www.twitter.com/'.$user_mention['screen_name'].'" target="_blank">@'.$user_mention['screen_name'].'</a>',
					                    $the_tweet);
					            }
					        }
					
					        // ii. Hashtags must link to a twitter.com search with the hashtag as the query.
					        if(isset($tweet['entities']['hashtags']) && is_array($tweet['entities']['hashtags'])){
					            foreach($tweet['entities']['hashtags'] as $key => $hashtag){
					                $the_tweet = preg_replace(
					                    '/#'.$hashtag['text'].'/i',
					                    '<a href="https://twitter.com/search?q=%23'.$hashtag['text'].'&amp;src=hash" target="_blank">#'.$hashtag['text'].'</a>',
					                    $the_tweet);
					            }
					        }
														
					        // iii. Links in Tweet text must be displayed using the display_url
					        //      field in the URL entities API response, and link to the original t.co url field.
					        if(isset($tweet['entities']['urls']) && is_array($tweet['entities']['urls'])){
					            foreach($tweet['entities']['urls'] as $key => $link){
					                $the_tweet = preg_replace(
					                    '`'.$link['url'].'`',
					                    '<a href="'.$link['url'].'" target="_blank">'.$link['url'].'</a>',
					                    $the_tweet);
					            }
					        }
					        
					        // Custom code to link to media
					        if(isset($tweet['entities']['media']) && is_array($tweet['entities']['media'])){
					            foreach($tweet['entities']['media'] as $key => $media){
					                $the_tweet = preg_replace(
					                    '`'.$media['url'].'`',
					                    '<a href="'.$media['url'].'" target="_blank">'.$media['url'].'</a>',
					                    $the_tweet);
					            }
					        }
					
					        $content .= $the_tweet;
							
							$content .= '</div>';
					
					        // 3. Tweet Actions
					        //    Reply, Retweet, and Favorite action icons must always be visible for the user to interact with the Tweet. These actions must be implemented using Web Intents or with the authenticated Twitter API.
					        //    No other social or 3rd party actions similar to Follow, Reply, Retweet and Favorite may be attached to a Tweet.
					        // 4. Tweet Timestamp
					        //    The Tweet timestamp must always be visible and include the time and date. e.g., "3:00 PM - 31 May 12".
					        // 5. Tweet Permalink
					        //    The Tweet timestamp must always be linked to the Tweet permalink.
					        
					       	$content .= '<div class="twitter_intents">'. "\n";
					        $content .= '<a class="reply" href="https://twitter.com/intent/tweet?in_reply_to='.$tweet['id_str'].'"><i class="fa-reply"></i></a>'. "\n";
					        $content .= '<a class="retweet" href="https://twitter.com/intent/retweet?tweet_id='.$tweet['id_str'].'"><i class="fa-retweet"></i></a>'. "\n";
					        $content .= '<a class="favorite" href="https://twitter.com/intent/favorite?tweet_id='.$tweet['id_str'].'"><i class="fa-star"></i></a>'. "\n";
					        
					        $date = strtotime($tweet['created_at']); // retrives the tweets date and time in Unix Epoch terms
					        $blogtime = current_time('U'); // retrives the current browser client date and time in Unix Epoch terms
					        $dago = human_time_diff($date, $blogtime) . ' ' . sprintf(__('ago', 'swiftframework')); // calculates and outputs the time past in human readable format
							$content .= '<a class="timestamp" href="https://twitter.com/'.$twitterID.'/status/'.$tweet['id_str'].'" target="_blank">'.$dago.'</a>'. "\n";
							$content .= '</div>'. "\n";
					    } else {
					        $content .= '<a href="http://twitter.com/'.$twitterID.'" target="_blank">@'.$twitterID.'</a>';
					    }
					    $content .= '</li>';
					}
				}
				return $content;
			} else {
				return '<li><div class="tweet-text">Please install the oAuth Twitter Feed Plugin and follow the theme documentation to set it up.</div></li>';
			}	
		}
	}
	
	
	/* CUSTOM POST TYPE COLUMNS
	================================================== */	  
	function posts_custom_columns($column){  
	    global $post;  
	    switch ($column)  
	    {  
	        case "description":  
	            the_excerpt();  
	            break;
	        case "thumbnail":  
	            the_post_thumbnail('thumbnail');  
	            break;
	        case "portfolio-category":
	            echo get_the_term_list($post->ID, 'portfolio-category', '', ', ','');
	            break;
	        case "gallery-category":
	            echo get_the_term_list($post->ID, 'gallery-category', '', ', ','');
	            break;
	        case "testimonials-category":
	            echo get_the_term_list($post->ID, 'testimonials-category', '', ', ','');
	            break;
	        case "team-category":
	            echo get_the_term_list($post->ID, 'team-category', '', ', ','');
	            break;
	        case "jobs-category":
	            echo get_the_term_list($post->ID, 'jobs-category', '', ', ','');
	            break;
	        case "faqs-category":
	            echo get_the_term_list($post->ID, 'faqs-category', '', ', ','');
	            break;
	        case "clients-category":
	            echo get_the_term_list($post->ID, 'clients-category', '', ', ','');
	            break;
	    }  
	}  
	add_action("manage_posts_custom_column",  "posts_custom_columns"); 
	
		
	/* GALLERY LIST FUNCTION
	================================================== */
	function sf_list_galleries() {
		$galleries_list = array();
		$galleries_query = new WP_Query( array( 'post_type' => 'galleries', 'posts_per_page' => -1 ) );
		while ( $galleries_query->have_posts() ) : $galleries_query->the_post();
			$galleries_list[get_the_title()] = get_the_ID();
		endwhile;
		wp_reset_query();
		return $galleries_list;
	}
	
	
	/* PORTFOLIO RELATED POSTS
	================================================== */
	if (!function_exists('sf_portfolio_related_posts')) {	
		function sf_portfolio_related_posts( $post_id ) {	    
		    $query = new WP_Query();
		    $terms = wp_get_object_terms( $post_id, 'portfolio-category' );
		
		    if ( count( $terms ) ) {
		        $post_ids = get_objects_in_term( $terms[0]->term_id, 'portfolio-category' );
				
				$index = array_search($post_id,$post_ids);
				if($index !== FALSE){
				    unset($post_ids[$index]);
				}
				
		        $args = array(
		                'post_type' => 'portfolio',
		                'post__in' => $post_ids,
		                'taxonomy' => 'portfolio-category',
		                'term' => $terms[0]->slug,
		                'posts_per_page' => 4
		            ) ;
		        $query = new WP_Query( $args );
		    }
		
		    // Return our results in query form
		    return $query;
		}
	}
	
	
	/* NAVIGATION CHECK
	================================================== */
	//functions tell whether there are previous or next 'pages' from the current page
	//returns 0 if no 'page' exists, returns a number > 0 if 'page' does exist
	//ob_ functions are used to suppress the previous_posts_link() and next_posts_link() from printing their output to the screen
	function sf_has_previous_posts() {
		ob_start();
		previous_posts_link();
		$result = strlen(ob_get_contents());
		ob_end_clean();
		return $result;
	}
	
	function sf_has_next_posts() {
		ob_start();
		next_posts_link();
		$result = strlen(ob_get_contents());
		ob_end_clean();
		return $result;
	}
	
	
	/* ADMIN ALT BG CSS
	================================================== */
	if (!function_exists('sf_admin_altbg_css')) {
		function sf_admin_altbg_css() {
			// Alt Background
			$options = get_option('sf_dante_options');
			$section_divide_color = get_option('section_divide_color', '#e4e4e4');
			$alt_one_bg_color = $options['alt_one_bg_color'];
			$alt_one_text_color = $options['alt_one_text_color'];
			if (isset($options['alt_one_bg_image'])) {
			$alt_one_bg_image = $options['alt_one_bg_image'];
			}
			$alt_one_bg_image_size = $options['alt_one_bg_image_size'];
			$alt_two_bg_color = $options['alt_two_bg_color'];
			$alt_two_text_color = $options['alt_two_text_color'];
			if (isset($options['alt_two_bg_image'])) {
			$alt_two_bg_image = $options['alt_two_bg_image'];
			}
			$alt_two_bg_image_size = $options['alt_two_bg_image_size'];
			$alt_three_bg_color = $options['alt_three_bg_color'];
			$alt_three_text_color = $options['alt_three_text_color'];
			if (isset($options['alt_three_bg_image'])) {
			$alt_three_bg_image = $options['alt_three_bg_image'];
			}
			$alt_three_bg_image_size = $options['alt_three_bg_image_size'];
			$alt_four_bg_color = $options['alt_four_bg_color'];
			$alt_four_text_color = $options['alt_four_text_color'];
			if (isset($options['alt_four_bg_image'])) {
			$alt_four_bg_image = $options['alt_four_bg_image'];
			}
			$alt_four_bg_image_size = $options['alt_four_bg_image_size'];
			$alt_five_bg_color = $options['alt_five_bg_color'];
			$alt_five_text_color = $options['alt_five_text_color'];
			if (isset($options['alt_five_bg_image'])) {
			$alt_five_bg_image = $options['alt_five_bg_image'];
			}
			$alt_five_bg_image_size = $options['alt_five_bg_image_size'];
			$alt_six_bg_color = $options['alt_six_bg_color'];
			$alt_six_text_color = $options['alt_six_text_color'];
			if (isset($options['alt_six_bg_image'])) {
			$alt_six_bg_image = $options['alt_six_bg_image'];
			}
			$alt_six_bg_image_size = $options['alt_six_bg_image_size'];
			$alt_seven_bg_color = $options['alt_seven_bg_color'];
			$alt_seven_text_color = $options['alt_seven_text_color'];
			if (isset($options['alt_seven_bg_image'])) {
			$alt_seven_bg_image = $options['alt_seven_bg_image'];
			}
			$alt_seven_bg_image_size = $options['alt_seven_bg_image_size'];
			$alt_eight_bg_color = $options['alt_eight_bg_color'];
			$alt_eight_text_color = $options['alt_eight_text_color'];
			if (isset($options['alt_eight_bg_image'])) {
			$alt_eight_bg_image = $options['alt_eight_bg_image'];
			}
			$alt_eight_bg_image_size = $options['alt_eight_bg_image_size'];
			$alt_nine_bg_color = $options['alt_nine_bg_color'];
			$alt_nine_text_color = $options['alt_nine_text_color'];
			if (isset($options['alt_nine_bg_image'])) {
			$alt_nine_bg_image = $options['alt_nine_bg_image'];
			}
			$alt_nine_bg_image_size = $options['alt_nine_bg_image_size'];
			$alt_ten_bg_color = $options['alt_ten_bg_color'];
			$alt_ten_text_color = $options['alt_ten_text_color'];
			if (isset($options['alt_ten_bg_image'])) {
			$alt_ten_bg_image = $options['alt_ten_bg_image'];
			}
			$alt_ten_bg_image_size = $options['alt_ten_bg_image_size'];  
			?>
			<style type="text/css" media="screen">
			<?php
				echo "\n".'/*========== Asset Background Styles ==========*/'."\n";
				echo '.asset-bg {border-color: '.$section_divide_color.';}'. "\n";
				echo '.alt-one {background-color: '.$alt_one_bg_color.';}'. "\n";
				if (isset($options['alt_one_bg_image']) && $alt_one_bg_image != "") {
					if ($alt_one_bg_image_size == "cover") {
						echo '.alt-one {background-image: url('.$alt_one_bg_image.'); background-repeat: no-repeat; background-position: center center; background-size:cover;}'. "\n";
					} else {
						echo '.alt-one {background-image: url('.$alt_one_bg_image.'); background-repeat: repeat; background-position: center center; background-size:auto;}'. "\n";
					}	
				}
				echo '.alt-one {color: '.$alt_one_text_color.';}'. "\n";
				echo '.alt-one.full-width-text:after {border-top-color:'.$alt_one_bg_color.';}'. "\n";
				echo '.alt-two {background-color: '.$alt_two_bg_color.';}'. "\n";
				if (isset($options['alt_two_bg_image']) && $alt_two_bg_image != "") {
					if ($alt_two_bg_image_size == "cover") {
						echo '.alt-two {background-image: url('.$alt_two_bg_image.'); background-repeat: no-repeat; background-position: center center; background-size:cover;}'. "\n";
					} else {
						echo '.alt-two {background-image: url('.$alt_two_bg_image.'); background-repeat: repeat; background-position: center center; background-size:auto;}'. "\n";
					}	
				}
				echo '.alt-two {color: '.$alt_two_text_color.';}'. "\n";
				echo '.alt-two.full-width-text:after {border-top-color:'.$alt_two_bg_color.';}'. "\n";	
				echo '.alt-three {background-color: '.$alt_three_bg_color.';}'. "\n";
				if (isset($options['alt_three_bg_image']) && $alt_three_bg_image != "") {
					if ($alt_three_bg_image_size == "cover") {
						echo '.alt-three {background-image: url('.$alt_three_bg_image.'); background-repeat: no-repeat; background-position: center center; background-size:cover;}'. "\n";
					} else {
						echo '.alt-three {background-image: url('.$alt_three_bg_image.'); background-repeat: repeat; background-position: center center; background-size:auto;}'. "\n";
					}	
				}
				echo '.alt-three {color: '.$alt_three_text_color.';}'. "\n";
				echo '.alt-three.full-width-text:after {border-top-color:'.$alt_three_bg_color.';}'. "\n";	
				echo '.alt-four {background-color: '.$alt_four_bg_color.';}'. "\n";
				if (isset($options['alt_four_bg_image']) && $alt_four_bg_image != "") {
					if ($alt_four_bg_image_size == "cover") {
						echo '.alt-four {background-image: url('.$alt_four_bg_image.'); background-repeat: no-repeat; background-position: center center; background-size:cover;}'. "\n";
					} else {
						echo '.alt-four {background-image: url('.$alt_four_bg_image.'); background-repeat: repeat; background-position: center center; background-size:auto;}'. "\n";
					}	
				}
				echo '.alt-four {color: '.$alt_four_text_color.';}'. "\n";
				echo '.alt-four.full-width-text:after {border-top-color:'.$alt_four_bg_color.';}'. "\n";	
				echo '.alt-five {background-color: '.$alt_five_bg_color.';}'. "\n";
				if (isset($options['alt_five_bg_image']) && $alt_five_bg_image != "") {
					if ($alt_five_bg_image_size == "cover") {
						echo '.alt-five {background-image: url('.$alt_five_bg_image.'); background-repeat: no-repeat; background-position: center center; background-size:cover;}'. "\n";
					} else {
						echo '.alt-five {background-image: url('.$alt_five_bg_image.'); background-repeat: repeat; background-position: center center; background-size:auto;}'. "\n";
					}	
				}
				echo '.alt-five {color: '.$alt_five_text_color.';}'. "\n";
				echo '.alt-five.full-width-text:after {border-top-color:'.$alt_five_bg_color.';}'. "\n";			
				echo '.alt-six {background-color: '.$alt_six_bg_color.';}'. "\n";
				if (isset($options['alt_six_bg_image']) && $alt_six_bg_image != "") {
					if ($alt_six_bg_image_size == "cover") {
						echo '.alt-six {background-image: url('.$alt_six_bg_image.'); background-repeat: no-repeat; background-position: center center; background-size:cover;}'. "\n";
					} else {
						echo '.alt-six {background-image: url('.$alt_six_bg_image.'); background-repeat: repeat; background-position: center center; background-size:auto;}'. "\n";
					}	
				}
				echo '.alt-six {color: '.$alt_six_text_color.';}'. "\n";
				echo '.alt-six.full-width-text:after {border-top-color:'.$alt_six_bg_color.';}'. "\n";
				echo '.alt-seven {background-color: '.$alt_seven_bg_color.';}'. "\n";
				if (isset($options['alt_seven_bg_image']) && $alt_seven_bg_image != "") {
					if ($alt_seven_bg_image_size == "cover") {
						echo '.alt-seven {background-image: url('.$alt_seven_bg_image.'); background-repeat: no-repeat; background-position: center center; background-size:cover;}'. "\n";
					} else {
						echo '.alt-seven {background-image: url('.$alt_seven_bg_image.'); background-repeat: repeat; background-position: center center; background-size:auto;}'. "\n";
					}	
				}
				echo '.alt-seven {color: '.$alt_seven_text_color.';}'. "\n";
				echo '.alt-seven.full-width-text:after {border-top-color:'.$alt_seven_bg_color.';}'. "\n";
				echo '.alt-eight {background-color: '.$alt_eight_bg_color.';}'. "\n";
				if (isset($options['alt_eight_bg_image']) && $alt_eight_bg_image != "") {
					if ($alt_eight_bg_image_size == "cover") {
						echo '.alt-eight {background-image: url('.$alt_eight_bg_image.'); background-repeat: no-repeat; background-position: center center; background-size:cover;}'. "\n";
					} else {
						echo '.alt-eight {background-image: url('.$alt_eight_bg_image.'); background-repeat: repeat; background-position: center center; background-size:auto;}'. "\n";
					}	
				}
				echo '.alt-eight {color: '.$alt_eight_text_color.';}'. "\n";
				echo '.alt-eight.full-width-text:after {border-top-color:'.$alt_eight_bg_color.';}'. "\n";
				echo '.alt-nine {background-color: '.$alt_nine_bg_color.';}'. "\n";
				if (isset($options['alt_nine_bg_image']) && $alt_nine_bg_image != "") {
					if ($alt_nine_bg_image_size == "cover") {
						echo '.alt-nine {background-image: url('.$alt_nine_bg_image.'); background-repeat: no-repeat; background-position: center center; background-size:cover;}'. "\n";
					} else {
						echo '.alt-nine {background-image: url('.$alt_nine_bg_image.'); background-repeat: repeat; background-position: center center; background-size:auto;}'. "\n";
					}	
				}
				echo '.alt-nine {color: '.$alt_nine_text_color.';}'. "\n";
				echo '.alt-nine.full-width-text:after {border-top-color:'.$alt_nine_bg_color.';}'. "\n";
				
				
				echo '.alt-ten {background-color: '.$alt_ten_bg_color.';}'. "\n";
				if (isset($options['alt_ten_bg_image']) && $alt_ten_bg_image != "") {
					if ($alt_ten_bg_image_size == "cover") {
						echo '.alt-ten {background-image: url('.$alt_ten_bg_image.'); background-repeat: no-repeat; background-position: center center; background-size:cover;}'. "\n";
					} else {
						echo '.alt-ten {background-image: url('.$alt_ten_bg_image.'); background-repeat: repeat; background-position: center center; background-size:auto;}'. "\n";
					}	
				}
				echo '.alt-ten {color: '.$alt_nine_text_color.';}'. "\n";
				echo '.alt-ten.full-width-text:after {border-top-color:'.$alt_ten_bg_color.';}'. "\n";
			?>
		</style>
		<?php }
		add_action( 'admin_head', 'sf_admin_altbg_css' );
	}
?>
<?php
/* excerpt */
define("excerpt_type",vpanel_options("excerpt_type"));
function excerpt ($excerpt_length,$excerpt_type = excerpt_type) {
	global $post;
	$excerpt_length = (isset($excerpt_length) && $excerpt_length != ""?$excerpt_length:5);
	$content = $post->post_content;
	$content = apply_filters('the_content', strip_shortcodes($content));
	if ($excerpt_type == "characters") {
		$content = mb_substr($content,0,$excerpt_length,"UTF-8");
	}else {
		$words = explode(' ',$content,$excerpt_length + 1);
		if (count($words) > $excerpt_length) :
			array_pop($words);
			array_push($words,'');
			$content = implode(' ',$words);
		endif;
	}
	$content = strip_tags($content);
	echo esc_attr($content).'...';
}
/* excerpt_title */
function excerpt_title ($excerpt_length,$excerpt_type = excerpt_type) {
	global $post;
	$excerpt_length = (isset($excerpt_length) && $excerpt_length != ""?$excerpt_length:5);
	$title = $post->post_title;
	if ($excerpt_type == "characters") {
		$title = mb_substr($title,0,$excerpt_length,"UTF-8");
	}else {
		$words = explode(' ',$title,$excerpt_length + 1);
		if (count($words) > $excerpt_length) :
			array_pop($words);
			array_push($words,'');
			$title = implode(' ',$words);
		endif;
	}
	$title = strip_tags($title);
	echo esc_attr($title);
}
/* excerpt_any */
function excerpt_any($excerpt_length,$title,$excerpt_type = excerpt_type) {
	$excerpt_length = (isset($excerpt_length) && $excerpt_length != ""?$excerpt_length:5);
	if ($excerpt_type == "characters") {
		$title = mb_substr($title,0,$excerpt_length,"UTF-8");
	}else {
		$words = explode(' ',$title,$excerpt_length + 1);
		if (count($words) > $excerpt_length) :
			array_pop($words);
			array_push($words,'');
			$title = implode(' ',$words);
		endif;
			$title = strip_tags($title);
	}
	return $title;
}
/* add post-thumbnails */
add_theme_support('post-thumbnails');
/* get_aq_resize_img */
function get_aq_resize_img($thumbnail_size,$img_width_f,$img_height_f,$img_lightbox="") {
	$thumb = get_post_thumbnail_id();
	if ($thumb != "") {
		$img_url = wp_get_attachment_url($thumb,$thumbnail_size);
		$img_width = $img_width_f;
		$img_height = $img_height_f;
		$image = aq_resize($img_url,$img_width,$img_height,true);
		if ($image) {
			$last_image = $image;
		}else {
			$last_image = "http://placehold.it/".$img_width_f."x".$img_height_f;
		}
		return ($img_lightbox == "lightbox"?"<a href='".$img_url."'>":"")."<img alt='".get_the_title()."' width='".$img_width."' height='".$img_height."' src='".$last_image."'>".($img_lightbox == "lightbox"?"</a>":"");
	}else {
		return ($img_lightbox == "lightbox"?"<a href='".$img_url."'>":"")."<img alt='".get_the_title()."' src='".vpanel_image()."'>".($img_lightbox == "lightbox"?"</a>":"");
	}
}
/* get_aq_resize_img_url */
function get_aq_resize_img_url($url,$thumbnail_size,$img_width_f,$img_height_f) {
	$thumb = $url;
	if ($thumb != "") {
		$img_url = $thumb;
		$img_width = $img_width_f;
		$img_height = $img_height_f;
		$image = aq_resize($img_url,$img_width,$img_height,true);
		if ($image) {
			$last_image = $image;
		}else {
			$last_image = "http://placehold.it/".$img_width_f."x".$img_height_f;
		}
		return "<img alt='".get_the_title()."' width='".$img_width."' height='".$img_height."' src='".$last_image."'>";
	}else {
		return "<img alt='".get_the_title()."' src='".vpanel_image()."'>";
	}
}
/* get_aq_resize_url */
function get_aq_resize_url($url,$thumbnail_size,$img_width_f,$img_height_f) {
	$img_url = $url;
	$img_width = $img_width_f;
	$img_height = $img_height_f;
	$image = aq_resize($img_url,$img_width,$img_height,true);
	if ($image) {
		$last_image = $image;
	}else {
		$last_image = "http://placehold.it/".$img_width_f."x".$img_height_f;
	}
	return $last_image;
}
/* get_aq_resize_img_full */
function get_aq_resize_img_full($thumbnail_size) {
	$thumb = get_post_thumbnail_id();
	if ($thumb != "") {
		$img_url = wp_get_attachment_url($thumb,$thumbnail_size);
		$image = $img_url;
		return "<img alt='".get_the_title()."' src='".$image."'>";
	}else {
		return "<img alt='".get_the_title()."' src='".vpanel_image()."'>";
	}
}
/* vpanel_image */
function vpanel_image() {
	global $post;
	ob_start();
	ob_end_clean();
	$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i',$post->post_content,$matches);
	if (isset($matches[1][0])) {
		return $matches[1][0];
	}else {
		return false;
	}
}
/* formatMoney */
function formatMoney($number,$fractional=false) {
    if ($fractional) {
        $number = sprintf('%.2f',$number);
    }
    while (true) {
        $replaced = preg_replace('/(-?\d+)(\d\d\d)/','$1,$2',$number);
        if ($replaced != $number) {
            $number = $replaced;
        }else {
            break;
        }
    }
    return $number;
}
/* get_twitter_count */
function get_twitter_count ($twitter_username) {
	$count = get_transient('vpanel_twitter_followers');
	$consumer_key 			= vpanel_options('twitter_consumer_key');
	$consumer_secret		= vpanel_options('twitter_consumer_secret');
	$access_token 			= vpanel_options('twitter_access_token');
	$access_token_secret 	= vpanel_options('twitter_access_token_secret');
	if ($count !== false) return $count;
	$count = 0;
	if ($twitter_username != "" && $consumer_key != "" && $consumer_secret != "" && $access_token != "" && $access_token_secret != "") {
		try {
			$twitterConnection = new TwitterOAuth( $consumer_key , $consumer_secret , $access_token , $access_token_secret	);
			$twitterData = $twitterConnection->get('users/show', array('screen_name' => $twitter_username));
			$twitter_followers_count = $twitterData->followers_count;
		}catch (Exception $e) {
			$twitter_followers_count = 0;
		}
		$count = $twitter_followers_count;
		set_transient('vpanel_twitter_followers', $count, 60*60*24);
		return $count;
	}
}
/* vpanel_counter_facebook */
function vpanel_counter_facebook ($page_id, $return = 'count') {
	$count = get_transient('vpanel_facebook_followers');
	$link = get_transient('vpanel_facebook_page_url');
	if ($return == 'link') {
		if ($link !== false) return $link;
	}else {
		if ($count !== false) return $count;
	}
	$count = 0;
	$link = '';
	$access_token = vpanel_options('facebook_access_token');
	$data = wp_remote_get('https://graph.facebook.com/v2.7/'.$page_id.'?fields=id,name,picture,fan_count,link&access_token='.$access_token);
	if (!is_wp_error($data)) {
		$json = json_decode( $data['body'], true );
		$count = intval($json['fan_count']);
		$link = $json['link'];
		set_transient('vpanel_facebook_followers', $count, 3600);
		set_transient('vpanel_facebook_page_url', $link, 3600);
	}
	if ($return == 'link') {
		return $link;
	}else {
		return $count;
	}
}
/* vpanel_counter_googleplus */
function vpanel_counter_googleplus ($page_id, $return = 'count') {
	$count = get_transient('vpanel_googleplus_followers');
	$link = get_transient('vpanel_googleplus_page_url');
	if ($return == 'link') {
		if ($link !== false) return $link;
	}else {
		if ($count !== false) return $count;
	}
	$count = 0;
	$link = '';
	$api_key = vpanel_options('google_api');
	$data = wp_remote_get('https://www.googleapis.com/plus/v1/people/'.$page_id.'?key='.$api_key);
	if (!is_wp_error($data)) {
		$json = json_decode( $data['body'], true );
		$count = isset($json['circledByCount']) ? intval($json['circledByCount']) : intval($json['plusOneCount']);
		$link = $json['url'];
		set_transient('vpanel_googleplus_followers', $count, 3600);
		set_transient('vpanel_googleplus_page_url', $link, 3600);
	}
	if ($return == 'link') {
		return $link;
	}else {
		return $count;
	}
}
/* vpanel_counter_youtube */
function vpanel_counter_youtube ($youtube, $return = 'count') {
	$count = get_transient('vpanel_youtube_followers');
	$api_key = vpanel_options('google_api');
	if ($count !== false) return $count;
	$count = 0;
	$data = wp_remote_get('https://www.googleapis.com/youtube/v3/channels?part=statistics&id='.$youtube.'&key='.$api_key);
	if (!is_wp_error($data)) {
		$json = json_decode( $data['body'], true );
		$count = intval($json['items'][0]['statistics']['subscriberCount']);
		set_transient('vpanel_youtube_followers', $count, 3600);
	}
	return $count;
}
/* vpanel_twitter_tweets */
if ( ! function_exists( 'vpanel_twitter_tweets' ) ) :
	function vpanel_twitter_tweets($consumerkey = '', $consumersecret = '', $accesstoken = '', $accesstokensecret = '', $screenname = '', $tweets_count = 3) {
		if (empty($consumerkey) || empty($consumersecret) || empty($accesstokensecret) || empty($accesstoken)) {
			return 'Your twitter application info is not set correctly in option panel, please create please login to twitter developers <a href="https://dev.twitter.com/apps" target="_blank">here</a>, create new application and new access tocken, then go to theme option panel Advanced tab and fill the data you got from application';
		}else {
			$twitter = new TwitterOAuth($consumerkey, $consumersecret, $accesstoken, $accesstokensecret);
			$tweets = $twitter->get('statuses/user_timeline', array('screen_name' => $screenname, 'count' => $tweets_count));
			$output = '';
			if (is_array($tweets) && !isset($tweets->errors)) {
				$i = 0;
				$tweets_count = $tweets_count+1;
				$lnk_msg = NULL;
				$output .= "<ul>";
				foreach ($tweets as $tweet) {
					$i++;
					$lnk_page = 'http://twitter.com/#!/' . $screenname;
					$page_name = $tweet->user->name;
					$msg = $tweet->text;
					if (is_array($tweet->entities->urls)) {
						try {
							if (array_key_exists('0', $tweet->entities->urls)) {
								$lnk_msg = $tweet->entities->urls[0]->url;
							}else {
								$lnk_msg = NULL;
							}
						}catch (Exception $e) {
							$lnk_msg = NULL;
						}
					}
					$lnk_tweet = 'http://twitter.com/#!/' . $screenname . '/status/' . $tweet->id_str;
					$time = strtotime($tweet->created_at);
					$delta = abs(time() - $time);
					$result = '';
					if ($delta < 1) {
						$result = ' '.esc_html__("just now","vbegy");
					}else if ($delta < 60) {
						$result = $delta . ' '.esc_html__("seconds ago","vbegy");
					}else if ($delta < 120) {
						$result = ' '.esc_html__("about a minute ago","vbegy");
					}else if ($delta < (45 * 60)) {
						$result = ' '.esc_html__("about","vbegy").' ' . round(($delta / 60), 0) . ' '.esc_html__("minutes ago","vbegy");
					}else if ($delta < (2 * 60 * 60)) {
						$result = ' '.esc_html__("about an hour ago","vbegy");
					}else if ($delta < (24 * 60 * 60)) {
						$result = ' '.esc_html__("about","vbegy").' ' . round(($delta / 3600), 0) . ' '.esc_html__("hours ago","vbegy");
					}else if ($delta < (48 * 60 * 60)) {
						$result = ' '.esc_html__("about a day ago","vbegy");
					}else {
						$result = ' '.esc_html__("about","vbegy").' ' . round(($delta / 86400), 0) . ' '.esc_html__("days ago","vbegy");
					}
					if ($i >= $tweets_count)
						break;
					$output .= '
					<li class="tweet-item">
						<div class="tweet-text">
							<a target="_blank" href="'.esc_url($lnk_tweet).'" class="tweet-icon"></a>
							<a target="_blank" class="tweet-name" href="'.esc_url($lnk_tweet).'">'.$screenname.'</a>
							'.make_clickable($msg).'
							<br>
							<span class="tweet-time">'.$result.'</span>
						</div>
					</li>';
				}
				$output .= "</ul>";
				return $output;
			}else {
				if (isset($tweets->errors)):
					$output .= '<span class="tweet_error">Message: ' . $tweets->errors[0]->message . ', Please check your Twitter Authentication Data or internet connection.</span>';
				else:
					$output .= '<span class="tweet_error">Please check your internet connection.</span>';
				endif;
				if (!empty($output)) {
					return $output;
				}
			}
		}
	}
endif;
/* Vpanel_Questions */
function Vpanel_Questions($questions_per_page = 5,$orderby,$display_date,$questions_excerpt,$post_or_question,$excerpt_title = 5,$display_image = "on") {
	global $post;
	$date_format = (vpanel_options("date_format")?vpanel_options("date_format"):get_option("date_format"));
	$excerpt_title = ($excerpt_title != ""?$excerpt_title:5);
	if ($orderby == "popular") {
		$orderby = array('orderby' => 'comment_count');
	}elseif ($orderby == "random") {
		$orderby = array('orderby' => 'rand');
	}else {
		$orderby = array();
	}
	$query = new WP_Query( array_merge($orderby,array('post_type' => $post_or_question,'ignore_sticky_posts' => 1,'posts_per_page' => $questions_per_page,'cache_results' => false,'no_found_rows' => true)) );
	if ( $query->have_posts() ) : 
		echo "<ul class='related-posts'>";
			while ( $query->have_posts() ) : $query->the_post();?>
				<li class="related-item">
					<?php if (has_post_thumbnail() && $display_image == "on") {?>
						<div class="author-img">
							<a href="<?php the_permalink();?>" title="<?php printf('%s',the_title_attribute('echo=0')); ?>" rel="bookmark">
								<?php echo get_aq_resize_img('full',60,60);?>
							</a>
						</div>
					<?php }?>
					<div class="questions-div">
						<h3>
							<a href="<?php the_permalink();?>" title="<?php printf('%s',the_title_attribute('echo=0')); ?>" rel="bookmark">
								<?php if ($questions_excerpt == 0) {?>
									<i class="icon-double-angle-right"></i>
								<?php }
								excerpt_title($excerpt_title);?>
							</a>
						</h3>
						<?php if ($questions_excerpt != 0) {?>
							<p><?php excerpt($questions_excerpt);?></p>
						<?php }
						if ($display_date == "on") {?>
							<div class="clear"></div><span <?php echo ($questions_excerpt == 0?"class='margin_t_5'":"")?>><?php the_time($date_format);?></span>
						<?php }?>
					</div>
				</li>
			<?php endwhile;
		echo "</ul>";
	endif;
	wp_reset_postdata();
}
/* Vpanel_comments */
function Vpanel_comments($post_or_question = "question",$comments_number = 5,$comment_excerpt = 30) {
	$comments = get_comments(array("post_type" => $post_or_question,"status" => "approve","number" => $comments_number));
	echo "<div class='widget_highest_points widget_comments'><ul>";
		foreach ($comments as $comment) {
			$you_avatar = get_the_author_meta('you_avatar',$comment->user_id);
			$user_profile_page = vpanel_get_user_url($comment->user_id);
		    ?>
		    <li>
		    	<div class="author-img">
		    		<?php if ($comment->user_id != 0) {?>
			    		<a href="<?php echo $user_profile_page?>">
	    			<?php }
		    			if ($you_avatar && $comment->user_id != 0) {
		    				$you_avatar_img = get_aq_resize_url(esc_attr($you_avatar),"full",65,65);
		    				echo "<img alt='".$comment->comment_author."' src='".$you_avatar_img."'>";
		    			}else {
		    				echo get_avatar($comment->user_id,'65','');
		    			}
		    		if ($comment->user_id != 0) {?>
			    		</a>
		    		<?php }?>
		    	</div> 
		    	<h6><a href="<?php echo get_permalink($comment->comment_post_ID);?>#comment-<?php echo $comment->comment_ID;?>"><?php echo strip_tags($comment->comment_author);?> : <?php echo wp_html_excerpt($comment->comment_content,$comment_excerpt);?></a></h6>
		    </li>
		    <?php
		}
	echo "</ul></div>";
}
/* vbegy_comment */
function vbegy_comment($comment,$args,$depth) {
	global $k;
	$k++;
    $GLOBALS['comment'] = $comment;
    $add_below = '';
    $comment_id = esc_attr($comment->comment_ID);
    $user_get_current_user_id = get_current_user_id();
    $can_edit_comment = vpanel_options("can_edit_comment");
    $can_edit_comment_after = vpanel_options("can_edit_comment_after");
    $can_edit_comment_after = (int)(isset($can_edit_comment_after) && $can_edit_comment_after > 0?$can_edit_comment_after:0);
    if (version_compare(phpversion(), '5.3.0', '>')) {
    	$time_now = strtotime(current_time( 'mysql' ),date_create_from_format('Y-m-d H:i',current_time( 'mysql' )));
    }else {
    	list($year, $month, $day, $hour, $minute, $second) = sscanf(current_time( 'mysql' ), '%04d-%02d-%02d %02d:%02d:%02d');
    	$datetime = new DateTime("$year-$month-$day $hour:$minute:$second");
    	$time_now = strtotime($datetime->format('r'));
    }
    $time_edit_comment = strtotime('+'.$can_edit_comment_after.' hour',strtotime($comment->comment_date));
    $time_end = ($time_now-$time_edit_comment)/60/60;
    $edit_comment = get_comment_meta($comment_id,"edit_comment",true);
    if (isset($k) && $k == vpanel_options("between_comments_position")) {
    	$between_adv_type = vpanel_options("between_comments_adv_type");
    	$between_adv_code = vpanel_options("between_comments_adv_code");
    	$between_adv_href = vpanel_options("between_comments_adv_href");
    	$between_adv_img = vpanel_options("between_comments_adv_img");
    	if (($between_adv_type == "display_code" && $between_adv_code != "") || ($between_adv_type == "custom_image" && $between_adv_img != "")) {
    		echo '<li class="advertising">
    			<div class="clearfix"></div>';
    		if ($between_adv_type == "display_code") {
    			echo stripcslashes($between_adv_code);
    		}else {
    			if ($between_adv_href != "") {
    				echo '<a target="_blank" href="'.$between_adv_href.'">';
    			}
    			echo '<img alt="" src="'.$between_adv_img.'">';
    			if ($between_adv_href != "") {
    				echo '</a>';
    			}
    		}
    		echo '<div class="clearfix"></div>
    		</li><!-- End advertising -->';
    	}
    }
    ?>
    <li <?php comment_class('comment');?> id="li-comment-<?php comment_ID();?>">
    	<div id="comment-<?php comment_ID();?>" class="comment-body clearfix">
            <div class="avatar-img">
            	<?php if ($comment->user_id != 0){
            		$vpanel_get_user_url = vpanel_get_user_url($comment->user_id,get_the_author_meta('user_nicename', $comment->user_id));
            		if (get_the_author_meta('you_avatar', $comment->user_id)) {
            			$you_avatar_img = get_aq_resize_url(esc_attr(get_the_author_meta('you_avatar', $comment->user_id)),"full",65,65);
            			echo "<img alt='".$comment->comment_author."' src='".$you_avatar_img."'>";
            		}else {
            			echo get_avatar($comment->user_id,65);
            		}
            	}else {
            		$vpanel_get_user_url = ($comment->comment_author_url != ""?$comment->comment_author_url:"vpanel_No_site");
            		echo get_avatar($comment->comment_author_email,65);
            	}?>
            </div>
            <div class="comment-text">
                <div class="author clearfix">
                	<div class="comment-meta">
        	        	<div class="comment-author">
        	        		<?php if ($vpanel_get_user_url != "" && $vpanel_get_user_url != "vpanel_No_site") {?>
	        	        		<a href="<?php echo esc_url($vpanel_get_user_url)?>">
	        	        	<?php }
	        	        		echo get_comment_author();
	        	        	if ($vpanel_get_user_url != "" && $vpanel_get_user_url != "vpanel_No_site") {?>
	        	        		</a>
	        	        	<?php }
	        	        	if ($comment->user_id != 0) {
	        	        		echo vpanel_get_badge($comment->user_id);
	        	        	}?>
        	        	</div>
                        <a href="<?php echo get_permalink($comment->comment_post_ID);?>#comment-<?php echo esc_attr($comment->comment_ID); ?>" class="date"><i class="fa fa-calendar"></i><?php printf(__('%1$s at %2$s','vbegy'),get_comment_date(), get_comment_time()) ?></a> 
                    </div>
                    <div class="comment-reply">
                    <?php if (current_user_can('edit_comment',$comment_id)) {
                    	edit_comment_link('<i class="icon-pencil"></i>'.__("Edit","vbegy"),'  ','');
                    }else {
                    	if ($can_edit_comment == 1 && $comment->user_id == $user_get_current_user_id && $comment->user_id != 0 && $user_get_current_user_id != 0 && ($can_edit_comment_after == 0 || $time_end <= $can_edit_comment_after)) {
                    		echo "<a class='comment-edit-link edit-comment' href='".esc_url(add_query_arg("comment_id", $comment_id,get_page_link(vpanel_options('edit_comment'))))."'><i class='icon-pencil'></i>".__("Edit","vbegy")."</a>";
                    	}
                    }
                    comment_reply_link( array_merge( $args, array( 'reply_text' => '<i class="icon-reply"></i>'.__( 'Reply', 'vbegy' ), 'after' => '', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) );?>
                    </div>
                </div>
                <div class="text">
                	<?php if ($edit_comment == "edited") {?>
                		<em><?php _e('This comment is edited.','vbegy')?></em><br>
                	<?php }
                	if ($comment->comment_approved == '0') : ?>
                	    <em><?php _e('Your comment is awaiting moderation.','vbegy')?></em><br>
                	<?php endif;
                	comment_text();?>
                </div>
            </div>
        </div>
    <?php
}
/* vbegy_answer */
function vbegy_answer($comment,$args,$depth) {
	global $post,$k;
	$k++;
	$GLOBALS['comment'] = $comment;
	$add_below = '';
	$comment_id = esc_attr($comment->comment_ID);
	$comment_vote = get_comment_meta($comment_id,'comment_vote');
	$comment_vote = (!empty($comment_vote)?$comment_vote[0]["vote"]:"");
	$the_best_answer = get_post_meta($post->ID,"the_best_answer",true);
	$best_answer_comment = get_comment_meta($comment_id,"best_answer_comment",true);
	$comment_best_answer = ($best_answer_comment == "best_answer_comment" || $the_best_answer == $comment_id?"comment-best-answer":"");
	$active_reports = vpanel_options("active_reports");
	$active_vote = vpanel_options("active_vote");
	$user_get_current_user_id = get_current_user_id();
	$can_edit_comment = vpanel_options("can_edit_comment");
	$can_edit_comment_after = vpanel_options("can_edit_comment_after");
	$can_edit_comment_after = (int)(isset($can_edit_comment_after) && $can_edit_comment_after > 0?$can_edit_comment_after:0);
	if (version_compare(phpversion(), '5.3.0', '>')) {
		$time_now = strtotime(current_time( 'mysql' ),date_create_from_format('Y-m-d H:i',current_time( 'mysql' )));
	}else {
		list($year, $month, $day, $hour, $minute, $second) = sscanf(current_time( 'mysql' ), '%04d-%02d-%02d %02d:%02d:%02d');
		$datetime = new DateTime("$year-$month-$day $hour:$minute:$second");
		$time_now = strtotime($datetime->format('r'));
	}
	$time_edit_comment = strtotime('+'.$can_edit_comment_after.' hour',strtotime($comment->comment_date));
	$time_end = ($time_now-$time_edit_comment)/60/60;
	$edit_comment = get_comment_meta($comment_id,"edit_comment",true);
	if (isset($k) && $k == vpanel_options("between_comments_position")) {
		$between_adv_type = vpanel_options("between_comments_adv_type");
		$between_adv_code = vpanel_options("between_comments_adv_code");
		$between_adv_href = vpanel_options("between_comments_adv_href");
		$between_adv_img = vpanel_options("between_comments_adv_img");
		if (($between_adv_type == "display_code" && $between_adv_code != "") || ($between_adv_type == "custom_image" && $between_adv_img != "")) {
			echo '<li class="advertising">
				<div class="clearfix"></div>';
			if ($between_adv_type == "display_code") {
				echo stripcslashes($between_adv_code);
			}else {
				if ($between_adv_href != "") {
					echo '<a target="_blank" href="'.$between_adv_href.'">';
				}
				echo '<img alt="" src="'.$between_adv_img.'">';
				if ($between_adv_href != "") {
					echo '</a>';
				}
			}
			echo '<div class="clearfix"></div>
			</li><!-- End advertising -->';
		}
	}
    ?>
    <li <?php comment_class('comment '.$comment_best_answer);?> id="li-comment-<?php comment_ID();?>">
    	<div id="comment-<?php comment_ID();?>" class="comment-body clearfix" rel="post-<?php echo $post->ID?>">
    	    <div class="avatar-img">
    	    	<?php if ($comment->user_id != 0) {
    	    		$vpanel_get_user_url = vpanel_get_user_url($comment->user_id,get_the_author_meta('user_nicename', $comment->user_id));
    	    		if (get_the_author_meta('you_avatar', $comment->user_id)) {
    	    			$you_avatar_img = get_aq_resize_url(esc_attr(get_the_author_meta('you_avatar', $comment->user_id)),"full",65,65);
    	    			echo "<img alt='".$comment->comment_author."' src='".$you_avatar_img."'>";
    	    		}else {
    	    			echo get_avatar($comment->user_id,65);
    	    		}
    	    	}else {
    	    		$vpanel_get_user_url = ($comment->comment_author_url != ""?$comment->comment_author_url:"vpanel_No_site");
    	    		echo get_avatar($comment,65);
    	    	}?>
    	    </div>
    	    <div class="comment-text">
    	        <div class="author clearfix">
    	        	<div class="comment-author">
    	        		<?php if ($vpanel_get_user_url != "" && $vpanel_get_user_url != "vpanel_No_site") {?>
    	        			<a href="<?php echo esc_url($vpanel_get_user_url)?>">
    	        		<?php }
    	        			echo get_comment_author();
    	        		if ($vpanel_get_user_url != "" && $vpanel_get_user_url != "vpanel_No_site") {?>
    	        			</a>
    	        		<?php }
    	        		if ($comment->user_id != 0) {
    	        			echo vpanel_get_badge($comment->user_id);
    	        		}?>
    	        	</div>
    	        	<?php if ($active_vote == 1) {
    	        		$show_dislike_answers = vpanel_options("show_dislike_answers");?>
	    	        	<div class="comment-vote">
	    	            	<ul class="single-question-vote">
	    	            		<?php if (is_user_logged_in() && $comment->user_id != get_current_user_id()){?>
	    	            			<li class="loader_3"></li>
	    	            			<li><a href="#" class="single-question-vote-up ask_vote_up comment_vote_up vote_allow<?php echo (isset($_COOKIE['comment_vote'.$comment_id])?" ".$_COOKIE['comment_vote'.$comment_id]."-".$comment_id:"")?>" title="<?php _e("Like","vbegy");?>" id="comment_vote_up-<?php echo $comment_id?>"><i class="icon-thumbs-up"></i></a></li>
	    	            			<?php if ($show_dislike_answers != 1) {?>
	    	            				<li><a href="#" class="single-question-vote-down ask_vote_down comment_vote_down vote_allow<?php echo (isset($_COOKIE['comment_vote'.$comment_id])?" ".$_COOKIE['comment_vote'.$comment_id]."-".$comment_id:"")?>" id="comment_vote_down-<?php echo $comment_id?>" title="<?php _e("Dislike","vbegy");?>"><i class="icon-thumbs-down"></i></a></li>
	    	            			<?php }
	    	            		}else { ?>
	    	            			<li class="loader_3"></li>
	    	            			<li><a href="#" class="single-question-vote-up ask_vote_up comment_vote_up <?php echo (is_user_logged_in() && $comment->user_id == get_current_user_id()?"vote_not_allow":"vote_not_user")?>" title="<?php _e("Like","vbegy");?>"><i class="icon-thumbs-up"></i></a></li>
	    	            			<?php if ($show_dislike_answers != 1) {?>
	    	            				<li><a href="#" class="single-question-vote-down ask_vote_down comment_vote_down <?php echo (is_user_logged_in() && $comment->user_id == get_current_user_id()?"vote_not_allow":"vote_not_user")?>" title="<?php _e("Dislike","vbegy");?>"><i class="icon-thumbs-down"></i></a></li>
	    	            			<?php }
	    	            		}?>
	    	            	</ul>
	    	        	</div>
	    	        	<span class="question-vote-result question_vote_result <?php echo ($comment_vote < 0?"question_vote_red":"")?>"><?php echo ($comment_vote != ""?$comment_vote:0)?></span>
    	        	<?php }?>
    	        	<div class="comment-meta">
    	                <a href="<?php echo get_permalink($comment->comment_post_ID);?>#comment-<?php echo esc_attr($comment->comment_ID); ?>" class="date"><i class="fa fa-calendar"></i><?php printf(__('%1$s at %2$s','vbegy'),get_comment_date(), get_comment_time()) ?></a> 
    	            </div>
    	            <div class="comment-reply">
	    	            <?php if (current_user_can('edit_comment',$comment_id)) {
	    	            	edit_comment_link('<i class="icon-pencil"></i>'.__("Edit","vbegy"),'  ','');
	    	            }else {
	    	            	if ($can_edit_comment == 1 && $comment->user_id == $user_get_current_user_id && $comment->user_id != 0 && $user_get_current_user_id != 0 && ($can_edit_comment_after == 0 || $time_end <= $can_edit_comment_after)) {
	    	            		echo "<a class='comment-edit-link edit-comment' href='".esc_url(add_query_arg("comment_id", $comment_id,get_page_link(vpanel_options('edit_comment'))))."'><i class='icon-pencil'></i>".__("Edit","vbegy")."</a>";
	    	            	}
	    	            }
	    	            if ($active_reports == 1) {?>
    	                	<a class="question_r_l comment_l report_c" href="#"><i class="icon-flag"></i><?php _e("Report","vbegy")?></a>
    	                <?php }
    	                comment_reply_link( array_merge( $args, array( 'reply_text' => '<i class="icon-reply"></i>'.__( 'Reply', 'vbegy' ),'login_text' => '<i class="icon-lock"></i>'.__( 'Log in to Reply', 'vbegy' ), 'after' => '', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) );?>
    	            </div>
    	        </div>
    	        <div class="text">
    	        	<?php if ($active_reports == 1) {?>
	    	        	<div class="explain-reported">
	    	        		<h3><?php _e("Please briefly explain why you feel this answer should be reported .","vbegy")?></h3>
	    	        		<textarea name="explain-reported"></textarea>
	    	        		<div class="clearfix"></div>
	    	        		<div class="loader_3"></div>
	    	        		<div class="color button small report"><?php _e("Report","vbegy")?></div>
	    	        		<div class="color button small dark_button cancel"><?php _e("Cancel","vbegy")?></div>
	    	        	</div><!-- End reported -->
    	        	<?php }
    	        	if ($edit_comment == "edited") {?>
    	        		<em><?php _e('This comment is edited.','vbegy')?></em><br>
    	        	<?php }
    	        	if ($comment->comment_approved == '0') : ?>
    	        	    <em><?php _e('Your comment is awaiting moderation.','vbegy')?></em><br>
    	        	<?php endif;
    	        	comment_text();?>
    	        	<div class="clearfix"></div>
    	        	<?php $added_file = get_comment_meta($comment_id,'added_file', true);
    	        	if ($added_file != "") {
    	        		echo "<div class='clearfix'></div><br><a href='".wp_get_attachment_url($added_file)."'>".__("Attachment","vbegy")."</a>";
    	        	}
    	        	?>
    	        </div>
    	        <div class="clearfix"></div>
	        	<div class="loader_3"></div>
    	        <?php
    	        $admin_best_answer = vpanel_options("admin_best_answer");
    	        $user_best_answer = esc_attr(get_the_author_meta('user_best_answer',$user_get_current_user_id));
    	        if ($best_answer_comment == "best_answer_comment" || $the_best_answer == $comment_id) {
    	        	echo '<div class="commentform question-answered question-answered-done"><i class="icon-ok"></i>'.__("Best answer","vbegy").'</div>
    	        	<div class="clearfix"></div>';
    	        	if (((is_user_logged_in() && $user_get_current_user_id == $post->post_author) || (isset($user_best_answer) && $user_best_answer == 1) || ($admin_best_answer == 1 && is_super_admin($user_get_current_user_id))) && $the_best_answer != 0){
	    	        	echo '<a class="commentform best_answer_re question-report" title="'.__("Cancel the best answer","vbegy").'" href="#">'.__("Cancel the best answer","vbegy").'</a>';
    	        	}
    	        }
    	        if (((is_user_logged_in() && $user_get_current_user_id == $post->post_author) || (isset($user_best_answer) && $user_best_answer == 1) || ($admin_best_answer == 1 && is_super_admin($user_get_current_user_id))) && ($the_best_answer == 0 || $the_best_answer == "")){?>
    	        	<a class="commentform best_answer_a question-report" title="<?php _e("Select as best answer","vbegy");?>" href="#"><?php _e("Select as best answer","vbegy");?></a>
    	        <?php
    	        }
    	        ?>
    	        <div class="no_vote_more"></div>
    	    </div>
    	</div>
	<?php
}
/* vpanel_pagination */
if ( ! function_exists('vpanel_pagination')) {
	function vpanel_pagination( $args = array(),$query = '') {
		global $wp_rewrite,$wp_query;
		do_action('vpanel_pagination_start');
		if ( $query) {
			$wp_query = $query;
		} // End IF Statement
		/* If there's not more than one page,return nothing. */
		if ( 1 >= $wp_query->max_num_pages)
			return;
		/* Get the current page. */
		$current = (get_query_var("paged") != ""?(int)get_query_var("paged"):(get_query_var("page") != ""?(int)get_query_var("page"):1));
		$page_what = (get_query_var("paged") != ""?"paged":(get_query_var("page") != ""?"page":"paged"));
		/* Get the max number of pages. */
		$max_num_pages = intval( $wp_query->max_num_pages);
		/* Set up some default arguments for the paginate_links() function. */
		$defaults = array(
			'base' => esc_url(add_query_arg($page_what,'%#%')),
			'format' => '',
			'total' => $max_num_pages,
			'current' => $current,
			'prev_next' => true,
			'prev_text' => __('<i class="icon-angle-left"></i>','vbegy'),// Translate in WordPress. This is the default.
			'next_text' => __('<i class="icon-angle-right"></i>','vbegy'),// Translate in WordPress. This is the default.
			'show_all' => false,
			'end_size' => 1,
			'mid_size' => 1,
			'add_fragment' => '',
			'type' => 'plain',
			'before' => '<div class="pagination">',// Begin vpanel_pagination() arguments.
			'after' => '</div>',
			'echo' => true,
		);
		/* Add the $base argument to the array if the user is using permalinks. */
		if ( $wp_rewrite->using_permalinks())
			$defaults['base'] = user_trailingslashit( trailingslashit( get_pagenum_link()) . 'page/%#%');
		/* If we're on a search results page,we need to change this up a bit. */
		if ( is_search()) {
		/* If we're in BuddyPress,use the default "unpretty" URL structure. */
			if ( class_exists('BP_Core_User')) {
				$search_query = get_query_var('s');
				$paged = get_query_var('paged');
				$base = user_trailingslashit( home_url()) . '?s=' . $search_query . '&paged=%#%';
				$defaults['base'] = $base;
			} else {
				$search_permastruct = $wp_rewrite->get_search_permastruct();
				if ( !empty( $search_permastruct))
					$defaults['base'] = user_trailingslashit( trailingslashit( get_search_link()) . 'page/%#%');
			}
		}
		/* Merge the arguments input with the defaults. */
		$args = wp_parse_args( $args,$defaults);
		/* Allow developers to overwrite the arguments with a filter. */
		$args = apply_filters('vpanel_pagination_args',$args);
		/* Don't allow the user to set this to an array. */
		if ('array' == $args['type'])
			$args['type'] = 'plain';
		/* Make sure raw querystrings are displayed at the end of the URL,if using pretty permalinks. */
		$pattern = '/\?(.*?)\//i';
		preg_match( $pattern,$args['base'],$raw_querystring);
		if ( $wp_rewrite->using_permalinks() && $raw_querystring)
			$raw_querystring[0] = str_replace('','',$raw_querystring[0]);
			if (!empty($raw_querystring)) {
				@$args['base'] = str_replace( $raw_querystring[0],'',$args['base']);
				@$args['base'] .= substr( $raw_querystring[0],0,-1);
			}
		/* Get the paginated links. */
		$page_links = paginate_links( $args);
		/* Remove 'page/1' from the entire output since it's not needed. */
		$page_links = str_replace( array('&#038;paged=1\'','/page/1\''),'\'',$page_links);
		/* Wrap the paginated links with the $before and $after elements. */
		$page_links = $args['before'] . $page_links . $args['after'];
		/* Allow devs to completely overwrite the output. */
		$page_links = apply_filters('vpanel_pagination',$page_links);
		do_action('vpanel_pagination_end');
		/* Return the paginated links for use in themes. */
		if ( $args['echo'])
			echo $page_links;
		else
			return $page_links;
	}
}
/* vpanel_admin_bar */
function vpanel_admin_bar() {
	global $wp_admin_bar;
	if (is_super_admin()) {
		$count_posts_by_type = count_posts_by_type( "question", "draft" );
		if ($count_posts_by_type > 0) {
			$wp_admin_bar->add_menu( array(
				'parent' => 0,
				'id' => 'questions_draft',
				'title' => '<span class="ab-icon dashicons-before dashicons-admin-page"></span><span class=" count-'.$count_posts_by_type.'"><span class="">'.$count_posts_by_type.'</span></span>' ,
				'href' => admin_url( 'edit.php?post_status=draft&post_type=question')
			));
		}
		$wp_admin_bar->add_menu( array(
			'parent' => 0,
			'id' => 'vpanel_page',
			'title' => 'Ask me Settings' ,
			'href' => admin_url( 'admin.php?page=options')
		));
	}
}
add_action( 'wp_before_admin_bar_render', 'vpanel_admin_bar' );
/* breadcrumbs */
function breadcrumbs($args = array()) {
    $delimiter  = __('<span class="crumbs-span">/</span>','vbegy');
    $home       = __('Home','vbegy');
    $before     = '<h1>';
    $after      = '</h1>';
    if (!is_home() && !is_front_page() || is_paged()) {
        echo '<div class="breadcrumbs"><section class="container"><div class="row"><div class="col-md-12">';
        global $post,$wp_query;
        $item = array();
        $homeLink = home_url();
        if (is_search()) {
        	echo $before . __("Search","vbegy") . $after;
        }else if (is_page()) {
        	echo $before . get_the_title() . $after;
        }else if (is_attachment()) {
			$parent = get_post($post->post_parent);
			$cat = get_the_category($parent->ID);
			echo $before . get_the_title() . $after;
        }elseif ( is_singular() ) {
    		$post = $wp_query->get_queried_object();
    		$post_id = (int) $wp_query->get_queried_object_id();
    		$post_type = $post->post_type;
    		$post_type_object = get_post_type_object( $post_type );
    		if ( 'post' === $wp_query->post->post_type || 'question' === $wp_query->post->post_type || 'product' === $wp_query->post->post_type ) {
    			echo $before . get_the_title() . $after;
    		}
    		if ( 'page' !== $wp_query->post->post_type ) {
    			if ( isset( $args["singular_{$wp_query->post->post_type}_taxonomy"] ) && is_taxonomy_hierarchical( $args["singular_{$wp_query->post->post_type}_taxonomy"] ) ) {
    				$terms = wp_get_object_terms( $post_id, $args["singular_{$wp_query->post->post_type}_taxonomy"] );
    				echo array_merge( $item, breadcrumbs_plus_get_term_parents( $terms[0], $args["singular_{$wp_query->post->post_type}_taxonomy"] ) );
    			}
    			elseif ( isset( $args["singular_{$wp_query->post->post_type}_taxonomy"] ) )
    				echo get_the_term_list( $post_id, $args["singular_{$wp_query->post->post_type}_taxonomy"], '', ', ', '' );
    		}
    	}else if (is_category() || is_tag() || is_tax()) {
            global $wp_query;
            $term = $wp_query->get_queried_object();
			$taxonomy = get_taxonomy( $term->taxonomy );
			if ( ( is_taxonomy_hierarchical( $term->taxonomy ) && $term->parent ) && $parents = breadcrumbs_plus_get_term_parents( $term->parent, $term->taxonomy ) )
				$item = array_merge( $item, $parents );
			//echo $term->name;
            echo $before . '' . single_cat_title('', false) . '' . $after;
        }elseif (is_day()) {
            echo $before . __('Daily Archives : ','vbegy') . get_the_time('d') . $after;
        }elseif (is_month()) {
            echo $before . __('Monthly Archives : ','vbegy') . get_the_time('F') . $after;
        }elseif (is_year()) {
            echo $before . __('Yearly Archives : ','vbegy') . get_the_time('Y') . $after;
        }elseif (is_single() && !is_attachment()) {
            if (get_post_type() != 'post' && get_post_type() != 'question' && get_post_type() != 'product') {
                $post_type = get_post_type_object(get_post_type());
                $slug = $post_type->rewrite;
                echo $before . get_the_title() . $after;
            }else {
            	$cat = get_the_category(); $cat = $cat[0];
            	echo $before . get_the_title() . $after;
            }
        }elseif (!is_single() && !is_page() && get_post_type() != 'post' && get_post_type() != 'question' && get_post_type() != 'product') {
        	if (is_author()) {
        	    global $author;
				$userdata = get_userdata($author);
				echo $before . $userdata->display_name . $after;
        	}else {
				$post_type = get_post_type_object(get_post_type());
				echo $before . (isset($post_type->labels->singular_name)?$post_type->labels->singular_name:__("Error 404","vbegy")) . $after;
        	}
        }elseif (is_attachment()) {
            $parent = get_post($post->post_parent);
            $cat = get_the_category($parent->ID);
            echo $before . get_the_title() . $after;
        }elseif (is_page() && !$post->post_parent) {
            echo $before . get_the_title() . $after;
        }elseif (is_page() && $post->post_parent) {
            $parent_id  = $post->post_parent;
            $breadcrumbs = array();
            while ($parent_id) {
                $page = get_page($parent_id);
                $breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
                $parent_id  = $page->post_parent;
            }
            $breadcrumbs = array_reverse($breadcrumbs);
            foreach ($breadcrumbs as $crumb) echo $crumb . ' ' . $delimiter . ' ';
            echo $before . get_the_title() . $after;
        }elseif (is_search()) {
            echo $before . get_search_query() . $after;
        }elseif (is_tag()) {
            echo $before . single_tag_title('', false) . $after;
        }elseif ( is_author() ) {
            global $author;
            $userdata = get_userdata($author);
            echo $before . $userdata->display_name . $after;
        }elseif (is_404()) {
            echo $before . __('Error 404 ', 'vbegy') . $after;
        }else if (is_archive()) {
        	if ( is_category() || is_tag() || is_tax() ) {
    			$term = $wp_query->get_queried_object();
    			$taxonomy = get_taxonomy( $term->taxonomy );
    			if ( ( is_taxonomy_hierarchical( $term->taxonomy ) && $term->parent ) && $parents = breadcrumbs_plus_get_term_parents( $term->parent, $term->taxonomy ) )
    				$item = array_merge( $item, $parents );
    			echo $before . $term->name. $after;
    		}else if ( function_exists( 'is_post_type_archive' ) && is_post_type_archive() ) {
    			$post_type_object = get_post_type_object( get_query_var( 'post_type' ) );
    			echo $before . $post_type_object->labels->name. $after;
    		}else if ( is_date() ) {
    			if ( is_day() )
    				echo $before . __( 'Archives for ', 'theme' ) . get_the_time( 'F j, Y' ). $after;
    			elseif ( is_month() )
    				echo $before . __( 'Archives for ', 'theme' ) . single_month_title( ' ', false ). $after;
    			elseif ( is_year() )
    				echo $before . __( 'Archives for ', 'theme' ) . get_the_time( 'Y' ). $after;
    		}else if ( is_author() ) {
    			echo $before . __( 'Archives by: ', 'theme' ) . get_the_author_meta( 'display_name', $wp_query->post->post_author ). $after;
    		}
        }
        $before     = '<span class="current">';
        $after      = '</span>';
        echo '<div class="clearfix"></div>
        <div class="crumbs">
        <a itemprop="breadcrumb" href="' . $homeLink . '">' . $home . '</a>' . $delimiter . ' ';
        if (is_search()) {
        	echo $before . __("Search","vbegy") . $after;
        }else if (is_category() || is_tag() || is_tax()) {
            global $wp_query;
            $term = $wp_query->get_queried_object();
        	$taxonomy = get_taxonomy( $term->taxonomy );
        	if ( ( is_taxonomy_hierarchical( $term->taxonomy ) && $term->parent ) && $parents = breadcrumbs_plus_get_term_parents( $term->parent, $term->taxonomy ) )
        		$item = array_merge( $item, $parents );
        	//echo $term->name;
            echo $before . '' . single_cat_title('', false) . '' . $after;
        }elseif (is_day()) {
            echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a>' . $delimiter . '';
            echo '<a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a>' . $delimiter . '';
            echo $before . get_the_time('d') . $after;
        }elseif (is_month()) {
            echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a>' . $delimiter . '';
            echo $before . get_the_time('F') . $after;
        }elseif (is_year()) {
            echo $before . get_the_time('Y') . $after;
        }elseif (is_single() && !is_attachment()) {
            if (get_post_type() != 'post') {
                $post_type = get_post_type_object(get_post_type());
                $slug = $post_type->rewrite;
                if (get_post_type() == 'question') {
                    $question_category = wp_get_post_terms($post->ID,'question-category',array("fields" => "all"));
                    if (isset($question_category[0])) {?>
                        <a href="<?php echo get_term_link($question_category[0]->slug, "question-category");?>"><?php echo $question_category[0]->name?></a>
                    <?php
                    }
                    echo $delimiter;
                }else if (get_post_type() == 'product') {
                    global $product;
                    echo $product->get_categories( ', ', '' );
                    echo $delimiter;
                }else {
	                echo '<a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a>' . $delimiter . '';
                }
                echo "".$before . get_the_title() . $after;
            }else {
                $cat = get_the_category(); $cat = $cat[0];
                echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
                echo $before . get_the_title() . $after;
            }
        }elseif (!is_single() && !is_page() && get_post_type() != 'post') {
            if (is_author()) {
                global $author;
				$userdata = get_userdata($author);
				echo $before . $userdata->display_name . $after;
            }else {
	            $post_type = get_post_type_object(get_post_type());
            	echo $before . (isset($post_type->labels->singular_name)?$post_type->labels->singular_name:__("Error 404","vbegy")) . $after;
            }
        }elseif (is_attachment()) {
            $parent = get_post($post->post_parent);
            $cat = get_the_category($parent->ID);
            echo '<a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a>' . $delimiter . '';
            echo $before . get_the_title() . $after;
        }elseif (is_page() && !$post->post_parent) {
            echo $before . get_the_title() . $after;
        }elseif (is_page() && $post->post_parent) {
            $parent_id  = $post->post_parent;
            $breadcrumbs = array();
            while ($parent_id) {
                $page = get_page($parent_id);
                $breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
                $parent_id  = $page->post_parent;
            }
            $breadcrumbs = array_reverse($breadcrumbs);
            foreach ($breadcrumbs as $crumb) echo $crumb . ' ' . $delimiter . ' ';
            echo $before . get_the_title() . $after;
        }elseif (is_search()) {
            echo $before . __('Search results for ', 'vbegy') . '"' . get_search_query() . '"' . $after;
        }elseif (is_tag()) {
            echo $before . __('Posts tagged ', 'vbegy') . '"' . single_tag_title('', false) . '"' . $after;
        }elseif ( is_author() ) {
            global $author;
            $userdata = get_userdata($author);
            echo $before . $userdata->display_name . $after;
        }elseif (is_404()) {
            echo $before . __('Error 404 ', 'vbegy') . $after;
        }
        if (get_query_var('paged')) {
            if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo '';
            echo "<span class='crumbs-span'>/</span><span class='current'>".__('Page', 'vbegy') . ' ' . get_query_var('paged')."</span>";
            if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo '';
        }
        echo '</div></div></div></section></div>';
    }
}
/* breadcrumbs_plus_get_term_parents */
function breadcrumbs_plus_get_term_parents( $parent_id = '', $taxonomy = '', $separator = '/' ) {
	$html = array();
	$parents = array();
	if ( empty( $parent_id ) || empty( $taxonomy ) )
		return $parents;
	while ( $parent_id ) {
		$parent = get_term( $parent_id, $taxonomy );
		$parents[] = '<a href="' . get_term_link( $parent, $taxonomy ) . '" title="' . esc_attr( $parent->name ) . '">' . $parent->name . '</a>';
		$parent_id = $parent->parent;
	}
	if ( $parents )
		$parents = array_reverse( $parents );
	return $parents;
}
/* vpanel_show_extra_profile_fields */
add_action( 'show_user_profile', 'vpanel_show_extra_profile_fields' );
add_action( 'edit_user_profile', 'vpanel_show_extra_profile_fields' );
function vpanel_show_extra_profile_fields( $user ) { ?>
	<table class="form-table">
		<tr>
			<th><label for="you_avatar"><?php _e("Your avatar","vbegy")?></label></th>
			<td>
				<input type="text" size="36" class="upload upload_meta regular-text" value="<?php echo esc_attr( get_the_author_meta('you_avatar', $user->ID ) ); ?>" id="you_avatar" name="you_avatar">
				<input id="you_avatar_button" class="upload_image_button button upload-button-2" type="button" value="Upload Image">
			</td>
		</tr>
		<?php if (get_the_author_meta('you_avatar', $user->ID )) {?>
			<tr>
				<th><label><?php _e("Your avatar","vbegy")?></label></th>
				<td>
					<div class="you_avatar"><img alt="" src="<?php echo esc_attr( get_the_author_meta('you_avatar', $user->ID ) ); ?>"></div>
				</td>
			</tr>
		<?php } ?>
		<tr>
			<th><label for="country"><?php _e("Country","vbegy")?></label></th>
			<td>
				<select name="country" id="country">
					<option value=""><?php _e( 'Select a country&hellip;', 'vbegy' )?></option>
						<?php foreach( vpanel_get_countries() as $key => $value )
							echo '<option value="' . esc_attr( $key ) . '"' . selected( esc_attr( get_the_author_meta( 'country', $user->ID ) ), esc_attr( $key ), false ) . '>' . esc_html( $value ) . '</option>';?>
				</select>
			</td>
		</tr>
		<tr>
			<th><label for="city"><?php _e("City","vbegy")?></label></th>
			<td>
				<input type="text" name="city" id="city" value="<?php echo esc_attr( get_the_author_meta( 'city', $user->ID ) ); ?>" class="regular-text"><br>
			</td>
		</tr>
		<tr>
			<th><label for="age"><?php _e("Age","vbegy")?></label></th>
			<td>
				<input type="text" name="age" id="age" value="<?php echo esc_attr( get_the_author_meta( 'age', $user->ID ) ); ?>" class="regular-text"><br>
			</td>
		</tr>
		<tr>
			<th><label for="phone"><?php _e("Phone","vbegy")?></label></th>
			<td>
				<input type="text" name="phone" id="phone" value="<?php echo esc_attr( get_the_author_meta( 'phone', $user->ID ) ); ?>" class="regular-text"><br>
			</td>
		</tr>
		<tr>
			<?php
			$sex = esc_attr(get_the_author_meta( 'sex', $user->ID ) );
			?>
			<th><label><?php _e("Sex","vbegy")?></label></th>
			<td>
				<input id="sex_male" name="sex" type="radio" value="1"'<?php echo (isset($sex) && ($sex == "male" || $sex == "1")?' checked="checked"':' checked="checked"')?>'>
				<label for="sex_male"><?php _e("Male","vbegy")?></label>
				
				<input id="sex_female" name="sex" type="radio" value="2"<?php echo (isset($sex) && ($sex == "female" || $sex == "2")?' checked="checked"':'')?>>
					<label for="sex_female"><?php _e("Female","vbegy")?></label>
			</td>
		</tr>
		<tr>
			<th><label for="follow_email"><?php _e("Follow-up email","vbegy")?></label></th>
			<td>
				<input type="text" name="follow_email" id="follow_email" value="<?php echo esc_attr( get_the_author_meta( 'follow_email', $user->ID ) ); ?>" class="regular-text"><br>
			</td>
		</tr>
	</table>
	<h3><?php _e("Show the points, favorite question, authors i follow, followers, question follow, answer follow, post follow and comment follow","vbegy")?></h3>
	<table class="form-table">
		<tr>
			<?php $show_point_favorite = esc_attr( get_the_author_meta( 'show_point_favorite', $user->ID ) )?>
			<th><label for="show_point_favorite"><?php _e("Show this pages only for me or any one?","vbegy")?></label></th>
			<td>
				<input type="checkbox" name="show_point_favorite" id="show_point_favorite" value="1" <?php checked($show_point_favorite,1,true)?>><br>
			</td>
		</tr>
	</table>
	<?php $send_email_question_groups = vpanel_options("send_email_question_groups");
	if (isset($send_email_question_groups) && is_array($send_email_question_groups)) {
		foreach ($send_email_question_groups as $key => $value) {
			if ($value == 1) {
				$send_email_question_groups[$key] = $key;
			}else {
				unset($send_email_question_groups[$key]);
			}
		}
	}
	if (is_array($send_email_question_groups) && in_array($user->roles[0],$send_email_question_groups)) {?>
		<h3><?php _e("Received email when any one add a new question","vbegy")?></h3>
		<table class="form-table">
			<tr>
				<?php $received_email = esc_attr( get_the_author_meta( 'received_email', $user->ID ) )?>
				<th><label for="received_email"><?php _e("Received email?","vbegy")?></label></th>
				<td>
					<input type="checkbox" name="received_email" id="received_email" value="1" <?php checked($received_email,1,true)?>><br>
				</td>
			</tr>
		</table>
	<?php }
	$active_points = vpanel_options("active_points");
	if (is_super_admin(get_current_user_id()) && $active_points == 1) {?>
		<h3><?php _e( 'Add or remove points for the user', 'vbegy' ) ?></h3>
		<table class="form-table">
			<tr>
				<th><label><?php _e("Add or remove points","vbegy")?></label></th>
				<td>
					<div>
						<select name="add_remove_point">
							<option value="add"><?php _e("Add","vbegy")?></option>
							<option value="remove"><?php _e("Remove","vbegy")?></option>
						</select>
					</div><br>
					<div><?php _e("The points","vbegy")?></div><br>
					<input type="text" name="the_points" class="regular-text"><br><br>
					<div><?php _e("The reason","vbegy")?></div><br>
					<input type="text" name="the_reason" class="regular-text"><br>
				</td>
			</tr>
		</table>
	<?php }?>
	<h3><?php _e( 'Check if you need this user choose or remove the best answer', 'vbegy' ) ?></h3>
	<table class="form-table">
		<tr>
			<?php $user_best_answer = esc_attr( get_the_author_meta( 'user_best_answer', $user->ID ) )?>
			<th><label for="user_best_answer"><?php _e("Select user?","vbegy")?></label></th>
			<td>
				<input type="checkbox" name="user_best_answer" id="user_best_answer" value="1" <?php checked($user_best_answer,1,true)?>><br>
			</td>
		</tr>
	</table>
	<h3><?php _e( 'Social Networking', 'vbegy' ) ?></h3>
	<table class="form-table">
		<tr>
			<th><label for="google"><?php _e("Google +","vbegy")?></label></th>
			<td>
				<input type="text" name="google" id="google" value="<?php echo esc_attr( get_the_author_meta( 'google', $user->ID ) ); ?>" class="regular-text"><br>
			</td>
		</tr>
		<tr>
			<th><label for="twitter"><?php _e("Twitter","vbegy")?></label></th>
			<td>
				<input type="text" name="twitter" id="twitter" value="<?php echo esc_attr( get_the_author_meta( 'twitter', $user->ID ) ); ?>" class="regular-text"><br>
			</td>
		</tr>
		<tr>
			<th><label for="facebook"><?php _e("Facebook","vbegy")?></label></th>
			<td>
				<input type="text" name="facebook" id="facebook" value="<?php echo esc_attr( get_the_author_meta( 'facebook', $user->ID ) ); ?>" class="regular-text"><br>
			</td>
		</tr>
		<tr>
			<th><label for="youtube"><?php _e("Youtube","vbegy")?></label></th>
			<td>
				<input type="text" name="youtube" id="youtube" value="<?php echo esc_attr( get_the_author_meta( 'youtube', $user->ID ) ); ?>" class="regular-text"><br>
			</td>
		</tr>
		<tr>
			<th><label for="linkedin"><?php _e("linkedin","vbegy")?></label></th>
			<td>
				<input type="text" name="linkedin" id="linkedin" value="<?php echo esc_attr( get_the_author_meta( 'linkedin', $user->ID ) ); ?>" class="regular-text"><br>
			</td>
		</tr>
		<tr>
			<th><label for="pinterest"><?php _e("Pinterest","vbegy")?></label></th>
			<td>
				<input type="text" name="pinterest" id="pinterest" value="<?php echo esc_attr( get_the_author_meta( 'pinterest', $user->ID ) ); ?>" class="regular-text"><br>
			</td>
		</tr>
		<tr>
			<th><label for="instagram"><?php _e("Instagram","vbegy")?></label></th>
			<td>
				<input type="text" name="instagram" id="instagram" value="<?php echo esc_attr( get_the_author_meta( 'instagram', $user->ID ) ); ?>" class="regular-text"><br>
			</td>
		</tr>
	</table>
<?php }
/* Save user's meta */
add_action( 'personal_options_update', 'vpanel_save_extra_profile_fields' );
add_action( 'edit_user_profile_update', 'vpanel_save_extra_profile_fields' );
function vpanel_save_extra_profile_fields( $user_id ) {
	if ( !current_user_can( 'edit_user', $user_id ) ) return false;
	$google = (isset($_POST['google'])?$_POST['google']:"");
	update_user_meta( $user_id, 'google', esc_attr($google));
	$twitter = (isset($_POST['twitter'])?$_POST['twitter']:"");
	update_user_meta( $user_id, 'twitter', esc_attr($twitter));
	$facebook = (isset($_POST['facebook'])?$_POST['facebook']:"");
	update_user_meta( $user_id, 'facebook', esc_attr($facebook));
	$youtube = (isset($_POST['youtube'])?$_POST['youtube']:"");
	update_user_meta( $user_id, 'youtube', esc_attr($youtube));
	$linkedin = (isset($_POST['linkedin'])?$_POST['linkedin']:"");
	update_user_meta( $user_id, 'linkedin', esc_attr($linkedin));
	$instagram = (isset($_POST['instagram'])?$_POST['instagram']:"");
	update_user_meta( $user_id, 'instagram', esc_attr($instagram));
	$pinterest = (isset($_POST['pinterest'])?$_POST['pinterest']:"");
	update_user_meta( $user_id, 'pinterest', esc_attr($pinterest));
	$follow_email = (isset($_POST['follow_email'])?$_POST['follow_email']:"");
	update_user_meta( $user_id, 'follow_email', esc_attr($follow_email));
	$you_avatar = (isset($_POST['you_avatar'])?$_POST['you_avatar']:"");
	update_user_meta( $user_id, 'you_avatar', esc_attr($you_avatar));
	$country = (isset($_POST['country'])?$_POST['country']:"");
	update_user_meta( $user_id, 'country', esc_attr($country));
	$city = (isset($_POST['city'])?$_POST['city']:"");
	update_user_meta( $user_id, 'city', esc_attr($city));
	$age = (isset($_POST['age'])?$_POST['age']:"");
	update_user_meta( $user_id, 'age', esc_attr($age));
	$sex = (isset($_POST['sex'])?$_POST['sex']:"");
	update_user_meta( $user_id, 'sex', esc_attr($sex));
	$phone = (isset($_POST['phone'])?$_POST['phone']:"");
	update_user_meta( $user_id, 'phone', esc_attr($phone));
	
	$show_point_favorite = (isset($_POST['show_point_favorite'])?$_POST['show_point_favorite']:"");
	update_user_meta( $user_id, 'show_point_favorite', esc_attr($show_point_favorite));
	
	$received_email = (isset($_POST['received_email'])?$_POST['received_email']:"");
	update_user_meta( $user_id, 'received_email', esc_attr($received_email));
	
	$user_best_answer = (isset($_POST['user_best_answer'])?$_POST['user_best_answer']:"");
	update_user_meta( $user_id, 'user_best_answer', esc_attr($user_best_answer));
	
	$active_points = vpanel_options("active_points");
	if (is_super_admin(get_current_user_id()) && $active_points == 1) {
		$add_remove_point = "";
		$the_points = "";
		$the_reason = "";
		if (isset($_POST['add_remove_point'])) {
			$add_remove_point = esc_attr($_POST['add_remove_point']);
		}
		if (isset($_POST['the_points'])) {
			$the_points = (int)esc_attr($_POST['the_points']);
		}
		if (isset($_POST['the_reason'])) {
			$the_reason = esc_attr($_POST['the_reason']);
		}
		if ($the_points > 0) {
			$current_user = get_user_by("id",$user_id);
			$_points = get_user_meta($user_id,$current_user->user_login."_points",true);
			$_points++;
			
			$points_user = get_user_meta($user_id,"points",true);
			if ($add_remove_point == "remove") {
				$add_remove_point_last = "-";
				$the_reason_last = "admin_remove_points";
				update_user_meta($user_id,"points",$points_user-$the_points);
			}else {
				$add_remove_point_last = "+";
				$the_reason_last = "admin_add_points";
				update_user_meta($user_id,"points",$points_user+$the_points);
			}
			$the_reason = (isset($the_reason) && $the_reason != ""?$the_reason:$the_reason_last);
			update_user_meta($user_id,$current_user->user_login."_points",$_points);
			add_user_meta($user_id,$current_user->user_login."_points_".$_points,array(date_i18n('Y/m/d',current_time('timestamp')),date_i18n('g:i a',current_time('timestamp')),$the_points,$add_remove_point_last,$the_reason));
		}
	}
}
/* count_user_posts_by_type */
function count_user_posts_by_type( $userid, $post_type = 'post' ) {
	global $wpdb;
	$where = get_posts_by_author_sql( $post_type, true, $userid );
	$count = $wpdb->get_var( "SELECT COUNT(*) FROM $wpdb->posts $where" );
  	return apply_filters( 'get_usernumposts', $count, $userid );
}
/* count_posts_by_type */
function count_posts_by_type( $post_type = 'post', $post_status = "publish" ) {
	global $wpdb;
	$where = "WHERE $wpdb->posts.post_type = 'question' AND $wpdb->posts.post_status = '$post_status'";
	$count = $wpdb->get_var( "SELECT COUNT(*) FROM $wpdb->posts $where" );
  	return $count;
}
/* makeClickableLinks */
function makeClickableLinks($text) {
	return make_clickable($text);
	//return preg_replace('@(?<!href="|src="|">)(https?:\/\/([-\w\.]+[-\w])+(:\d+)?(/([\w/_\.#-]*(\?\S+)?[^\.\s])?)?)@', '<a href="$1" target="_blank">$1</a>', $text);
}
/* vpanel_get_countries */
function vpanel_get_countries() {
	$countries = array(
		'AF' => __( 'Afghanistan', 'vbegy' ),
		'AX' => __( '&#197;land Islands', 'vbegy' ),
		'AL' => __( 'Albania', 'vbegy' ),
		'DZ' => __( 'Algeria', 'vbegy' ),
		'AD' => __( 'Andorra', 'vbegy' ),
		'AO' => __( 'Angola', 'vbegy' ),
		'AI' => __( 'Anguilla', 'vbegy' ),
		'AQ' => __( 'Antarctica', 'vbegy' ),
		'AG' => __( 'Antigua and Barbuda', 'vbegy' ),
		'AR' => __( 'Argentina', 'vbegy' ),
		'AM' => __( 'Armenia', 'vbegy' ),
		'AW' => __( 'Aruba', 'vbegy' ),
		'AU' => __( 'Australia', 'vbegy' ),
		'AT' => __( 'Austria', 'vbegy' ),
		'AZ' => __( 'Azerbaijan', 'vbegy' ),
		'BS' => __( 'Bahamas', 'vbegy' ),
		'BH' => __( 'Bahrain', 'vbegy' ),
		'BD' => __( 'Bangladesh', 'vbegy' ),
		'BB' => __( 'Barbados', 'vbegy' ),
		'BY' => __( 'Belarus', 'vbegy' ),
		'BE' => __( 'Belgium', 'vbegy' ),
		'PW' => __( 'Belau', 'vbegy' ),
		'BZ' => __( 'Belize', 'vbegy' ),
		'BJ' => __( 'Benin', 'vbegy' ),
		'BM' => __( 'Bermuda', 'vbegy' ),
		'BT' => __( 'Bhutan', 'vbegy' ),
		'BO' => __( 'Bolivia', 'vbegy' ),
		'BQ' => __( 'Bonaire, Saint Eustatius and Saba', 'vbegy' ),
		'BA' => __( 'Bosnia and Herzegovina', 'vbegy' ),
		'BW' => __( 'Botswana', 'vbegy' ),
		'BV' => __( 'Bouvet Island', 'vbegy' ),
		'BR' => __( 'Brazil', 'vbegy' ),
		'IO' => __( 'British Indian Ocean Territory', 'vbegy' ),
		'VG' => __( 'British Virgin Islands', 'vbegy' ),
		'BN' => __( 'Brunei', 'vbegy' ),
		'BG' => __( 'Bulgaria', 'vbegy' ),
		'BF' => __( 'Burkina Faso', 'vbegy' ),
		'BI' => __( 'Burundi', 'vbegy' ),
		'KH' => __( 'Cambodia', 'vbegy' ),
		'CM' => __( 'Cameroon', 'vbegy' ),
		'CA' => __( 'Canada', 'vbegy' ),
		'CV' => __( 'Cape Verde', 'vbegy' ),
		'KY' => __( 'Cayman Islands', 'vbegy' ),
		'CF' => __( 'Central African Republic', 'vbegy' ),
		'TD' => __( 'Chad', 'vbegy' ),
		'CL' => __( 'Chile', 'vbegy' ),
		'CN' => __( 'China', 'vbegy' ),
		'CX' => __( 'Christmas Island', 'vbegy' ),
		'CC' => __( 'Cocos (Keeling) Islands', 'vbegy' ),
		'CO' => __( 'Colombia', 'vbegy' ),
		'KM' => __( 'Comoros', 'vbegy' ),
		'CG' => __( 'Congo (Brazzaville)', 'vbegy' ),
		'CD' => __( 'Congo (Kinshasa)', 'vbegy' ),
		'CK' => __( 'Cook Islands', 'vbegy' ),
		'CR' => __( 'Costa Rica', 'vbegy' ),
		'HR' => __( 'Croatia', 'vbegy' ),
		'CU' => __( 'Cuba', 'vbegy' ),
		'CW' => __( 'Cura&Ccedil;ao', 'vbegy' ),
		'CY' => __( 'Cyprus', 'vbegy' ),
		'CZ' => __( 'Czech Republic', 'vbegy' ),
		'DK' => __( 'Denmark', 'vbegy' ),
		'DJ' => __( 'Djibouti', 'vbegy' ),
		'DM' => __( 'Dominica', 'vbegy' ),
		'DO' => __( 'Dominican Republic', 'vbegy' ),
		'EC' => __( 'Ecuador', 'vbegy' ),
		'EG' => __( 'Egypt', 'vbegy' ),
		'SV' => __( 'El Salvador', 'vbegy' ),
		'GQ' => __( 'Equatorial Guinea', 'vbegy' ),
		'ER' => __( 'Eritrea', 'vbegy' ),
		'EE' => __( 'Estonia', 'vbegy' ),
		'ET' => __( 'Ethiopia', 'vbegy' ),
		'FK' => __( 'Falkland Islands', 'vbegy' ),
		'FO' => __( 'Faroe Islands', 'vbegy' ),
		'FJ' => __( 'Fiji', 'vbegy' ),
		'FI' => __( 'Finland', 'vbegy' ),
		'FR' => __( 'France', 'vbegy' ),
		'GF' => __( 'French Guiana', 'vbegy' ),
		'PF' => __( 'French Polynesia', 'vbegy' ),
		'TF' => __( 'French Southern Territories', 'vbegy' ),
		'GA' => __( 'Gabon', 'vbegy' ),
		'GM' => __( 'Gambia', 'vbegy' ),
		'GE' => __( 'Georgia', 'vbegy' ),
		'DE' => __( 'Germany', 'vbegy' ),
		'GH' => __( 'Ghana', 'vbegy' ),
		'GI' => __( 'Gibraltar', 'vbegy' ),
		'GR' => __( 'Greece', 'vbegy' ),
		'GL' => __( 'Greenland', 'vbegy' ),
		'GD' => __( 'Grenada', 'vbegy' ),
		'GP' => __( 'Guadeloupe', 'vbegy' ),
		'GT' => __( 'Guatemala', 'vbegy' ),
		'GG' => __( 'Guernsey', 'vbegy' ),
		'GN' => __( 'Guinea', 'vbegy' ),
		'GW' => __( 'Guinea-Bissau', 'vbegy' ),
		'GY' => __( 'Guyana', 'vbegy' ),
		'HT' => __( 'Haiti', 'vbegy' ),
		'HM' => __( 'Heard Island and McDonald Islands', 'vbegy' ),
		'HN' => __( 'Honduras', 'vbegy' ),
		'HK' => __( 'Hong Kong', 'vbegy' ),
		'HU' => __( 'Hungary', 'vbegy' ),
		'IS' => __( 'Iceland', 'vbegy' ),
		'IN' => __( 'India', 'vbegy' ),
		'ID' => __( 'Indonesia', 'vbegy' ),
		'IR' => __( 'Iran', 'vbegy' ),
		'IQ' => __( 'Iraq', 'vbegy' ),
		'IE' => __( 'Republic of Ireland', 'vbegy' ),
		'IM' => __( 'Isle of Man', 'vbegy' ),
		'IL' => __( 'Israel', 'vbegy' ),
		'IT' => __( 'Italy', 'vbegy' ),
		'CI' => __( 'Ivory Coast', 'vbegy' ),
		'JM' => __( 'Jamaica', 'vbegy' ),
		'JP' => __( 'Japan', 'vbegy' ),
		'JE' => __( 'Jersey', 'vbegy' ),
		'JO' => __( 'Jordan', 'vbegy' ),
		'KZ' => __( 'Kazakhstan', 'vbegy' ),
		'KE' => __( 'Kenya', 'vbegy' ),
		'KI' => __( 'Kiribati', 'vbegy' ),
		'KW' => __( 'Kuwait', 'vbegy' ),
		'KG' => __( 'Kyrgyzstan', 'vbegy' ),
		'LA' => __( 'Laos', 'vbegy' ),
		'LV' => __( 'Latvia', 'vbegy' ),
		'LB' => __( 'Lebanon', 'vbegy' ),
		'LS' => __( 'Lesotho', 'vbegy' ),
		'LR' => __( 'Liberia', 'vbegy' ),
		'LY' => __( 'Libya', 'vbegy' ),
		'LI' => __( 'Liechtenstein', 'vbegy' ),
		'LT' => __( 'Lithuania', 'vbegy' ),
		'LU' => __( 'Luxembourg', 'vbegy' ),
		'MO' => __( 'Macao S.A.R., China', 'vbegy' ),
		'MK' => __( 'Macedonia', 'vbegy' ),
		'MG' => __( 'Madagascar', 'vbegy' ),
		'MW' => __( 'Malawi', 'vbegy' ),
		'MY' => __( 'Malaysia', 'vbegy' ),
		'MV' => __( 'Maldives', 'vbegy' ),
		'ML' => __( 'Mali', 'vbegy' ),
		'MT' => __( 'Malta', 'vbegy' ),
		'MH' => __( 'Marshall Islands', 'vbegy' ),
		'MQ' => __( 'Martinique', 'vbegy' ),
		'MR' => __( 'Mauritania', 'vbegy' ),
		'MU' => __( 'Mauritius', 'vbegy' ),
		'YT' => __( 'Mayotte', 'vbegy' ),
		'MX' => __( 'Mexico', 'vbegy' ),
		'FM' => __( 'Micronesia', 'vbegy' ),
		'MD' => __( 'Moldova', 'vbegy' ),
		'MC' => __( 'Monaco', 'vbegy' ),
		'MN' => __( 'Mongolia', 'vbegy' ),
		'ME' => __( 'Montenegro', 'vbegy' ),
		'MS' => __( 'Montserrat', 'vbegy' ),
		'MA' => __( 'Morocco', 'vbegy' ),
		'MZ' => __( 'Mozambique', 'vbegy' ),
		'MM' => __( 'Myanmar', 'vbegy' ),
		'NA' => __( 'Namibia', 'vbegy' ),
		'NR' => __( 'Nauru', 'vbegy' ),
		'NP' => __( 'Nepal', 'vbegy' ),
		'NL' => __( 'Netherlands', 'vbegy' ),
		'AN' => __( 'Netherlands Antilles', 'vbegy' ),
		'NC' => __( 'New Caledonia', 'vbegy' ),
		'NZ' => __( 'New Zealand', 'vbegy' ),
		'NI' => __( 'Nicaragua', 'vbegy' ),
		'NE' => __( 'Niger', 'vbegy' ),
		'NG' => __( 'Nigeria', 'vbegy' ),
		'NU' => __( 'Niue', 'vbegy' ),
		'NF' => __( 'Norfolk Island', 'vbegy' ),
		'KP' => __( 'North Korea', 'vbegy' ),
		'NO' => __( 'Norway', 'vbegy' ),
		'OM' => __( 'Oman', 'vbegy' ),
		'PK' => __( 'Pakistan', 'vbegy' ),
		'PS' => __( 'Palestinian Territory', 'vbegy' ),
		'PA' => __( 'Panama', 'vbegy' ),
		'PG' => __( 'Papua New Guinea', 'vbegy' ),
		'PY' => __( 'Paraguay', 'vbegy' ),
		'PE' => __( 'Peru', 'vbegy' ),
		'PH' => __( 'Philippines', 'vbegy' ),
		'PN' => __( 'Pitcairn', 'vbegy' ),
		'PL' => __( 'Poland', 'vbegy' ),
		'PT' => __( 'Portugal', 'vbegy' ),
		'QA' => __( 'Qatar', 'vbegy' ),
		'RE' => __( 'Reunion', 'vbegy' ),
		'RO' => __( 'Romania', 'vbegy' ),
		'RU' => __( 'Russia', 'vbegy' ),
		'RW' => __( 'Rwanda', 'vbegy' ),
		'BL' => __( 'Saint Barth&eacute;lemy', 'vbegy' ),
		'SH' => __( 'Saint Helena', 'vbegy' ),
		'KN' => __( 'Saint Kitts and Nevis', 'vbegy' ),
		'LC' => __( 'Saint Lucia', 'vbegy' ),
		'MF' => __( 'Saint Martin (French part)', 'vbegy' ),
		'SX' => __( 'Saint Martin (Dutch part)', 'vbegy' ),
		'PM' => __( 'Saint Pierre and Miquelon', 'vbegy' ),
		'VC' => __( 'Saint Vincent and the Grenadines', 'vbegy' ),
		'SM' => __( 'San Marino', 'vbegy' ),
		'ST' => __( 'S&atilde;o Tom&eacute; and Pr&iacute;ncipe', 'vbegy' ),
		'SA' => __( 'Saudi Arabia', 'vbegy' ),
		'SN' => __( 'Senegal', 'vbegy' ),
		'RS' => __( 'Serbia', 'vbegy' ),
		'SC' => __( 'Seychelles', 'vbegy' ),
		'SL' => __( 'Sierra Leone', 'vbegy' ),
		'SG' => __( 'Singapore', 'vbegy' ),
		'SK' => __( 'Slovakia', 'vbegy' ),
		'SI' => __( 'Slovenia', 'vbegy' ),
		'SB' => __( 'Solomon Islands', 'vbegy' ),
		'SO' => __( 'Somalia', 'vbegy' ),
		'ZA' => __( 'South Africa', 'vbegy' ),
		'GS' => __( 'South Georgia/Sandwich Islands', 'vbegy' ),
		'KR' => __( 'South Korea', 'vbegy' ),
		'SS' => __( 'South Sudan', 'vbegy' ),
		'ES' => __( 'Spain', 'vbegy' ),
		'LK' => __( 'Sri Lanka', 'vbegy' ),
		'SD' => __( 'Sudan', 'vbegy' ),
		'SR' => __( 'Suriname', 'vbegy' ),
		'SJ' => __( 'Svalbard and Jan Mayen', 'vbegy' ),
		'SZ' => __( 'Swaziland', 'vbegy' ),
		'SE' => __( 'Sweden', 'vbegy' ),
		'CH' => __( 'Switzerland', 'vbegy' ),
		'SY' => __( 'Syria', 'vbegy' ),
		'TW' => __( 'Taiwan', 'vbegy' ),
		'TJ' => __( 'Tajikistan', 'vbegy' ),
		'TZ' => __( 'Tanzania', 'vbegy' ),
		'TH' => __( 'Thailand', 'vbegy' ),
		'TL' => __( 'Timor-Leste', 'vbegy' ),
		'TG' => __( 'Togo', 'vbegy' ),
		'TK' => __( 'Tokelau', 'vbegy' ),
		'TO' => __( 'Tonga', 'vbegy' ),
		'TT' => __( 'Trinidad and Tobago', 'vbegy' ),
		'TN' => __( 'Tunisia', 'vbegy' ),
		'TR' => __( 'Turkey', 'vbegy' ),
		'TM' => __( 'Turkmenistan', 'vbegy' ),
		'TC' => __( 'Turks and Caicos Islands', 'vbegy' ),
		'TV' => __( 'Tuvalu', 'vbegy' ),
		'UG' => __( 'Uganda', 'vbegy' ),
		'UA' => __( 'Ukraine', 'vbegy' ),
		'AE' => __( 'United Arab Emirates', 'vbegy' ),
		'GB' => __( 'United Kingdom (UK)', 'vbegy' ),
		'US' => __( 'United States (US)', 'vbegy' ),
		'UY' => __( 'Uruguay', 'vbegy' ),
		'UZ' => __( 'Uzbekistan', 'vbegy' ),
		'VU' => __( 'Vanuatu', 'vbegy' ),
		'VA' => __( 'Vatican', 'vbegy' ),
		'VE' => __( 'Venezuela', 'vbegy' ),
		'VN' => __( 'Vietnam', 'vbegy' ),
		'WF' => __( 'Wallis and Futuna', 'vbegy' ),
		'EH' => __( 'Western Sahara', 'vbegy' ),
		'WS' => __( 'Western Samoa', 'vbegy' ),
		'YE' => __( 'Yemen', 'vbegy' ),
		'ZM' => __( 'Zambia', 'vbegy' ),
		'ZW' => __( 'Zimbabwe', 'vbegy' )
	);
	asort( $countries );
	return $countries;
}
/* vpanel_update_options */
function vpanel_update_options(){
	global $themename;
	$post_re = $_POST;
	$all_save = $post_re[vpanel_options];
	if(isset($all_save['import_setting']) && $all_save['import_setting'] != "") {
		$data = unserialize(base64_decode($all_save['import_setting']));
		$array_options = array(vpanel_options,"badges","coupons","sidebars","roles");
		foreach($array_options as $option){
			if(isset($data[$option])){
				update_option($option,$data[$option]);
			}else{
				delete_option($option);
			}
		}
		echo 2;
		update_option("FlushRewriteRules",true);
		die();
	}else {
		foreach($post_re[vpanel_options] as $key => $value) {
			if (isset($post_re[vpanel_options][$key]) && $post_re[vpanel_options][$key] == "on") {
				if (isset($post_re[vpanel_options]["theme_pages"]) && $post_re[vpanel_options]["theme_pages"] == "on") {
					if ($key == "theme_pages") {
						$page_data = array(
							'post_status'    => 'publish',
							'post_type'      => 'page',
							'post_author'    => get_current_user_id(),
							'post_name'      => _x('add_question','Page slug','vbegy'),
							'post_title'     => _x('Add question','Page title','vbegy'),
							'post_content'   => '',
							'post_parent'    => 0,
							'comment_status' => 'closed'
						);
						$add_question = wp_insert_post($page_data);
						update_post_meta($add_question,'_wp_page_template','template-ask_question.php');
						$post_re[vpanel_options]["add_question"] = $add_question;
						
						$page_data = array(
							'post_status'    => 'publish',
							'post_type'      => 'page',
							'post_author'    => get_current_user_id(),
							'post_name'      => _x('edit_question','Page slug','vbegy'),
							'post_title'     => _x('Edit question','Page title','vbegy'),
							'post_content'   => '',
							'post_parent'    => 0,
							'comment_status' => 'closed'
						);
						$edit_question = wp_insert_post($page_data);
						update_post_meta($edit_question,'_wp_page_template','template-edit_question.php');
						$post_re[vpanel_options]["edit_question"] = $edit_question;
						
						$page_data = array(
							'post_status'    => 'publish',
							'post_type'      => 'page',
							'post_author'    => get_current_user_id(),
							'post_name'      => _x('login','Page slug','vbegy'),
							'post_title'     => _x('Login','Page title','vbegy'),
							'post_content'   => '',
							'post_parent'    => 0,
							'comment_status' => 'closed'
						);
						$login_register_page = wp_insert_post($page_data);
						update_post_meta($login_register_page,'_wp_page_template','template-login.php');
						$post_re[vpanel_options]["login_register_page"] = $login_register_page;
						
						$page_data = array(
							'post_status'    => 'publish',
							'post_type'      => 'page',
							'post_author'    => get_current_user_id(),
							'post_name'      => _x('edit_profile','Page slug','vbegy'),
							'post_title'     => _x('Edit profile','Page title','vbegy'),
							'post_content'   => '',
							'post_parent'    => 0,
							'comment_status' => 'closed'
						);
						$user_edit_profile_page = wp_insert_post($page_data);
						update_post_meta($user_edit_profile_page,'_wp_page_template','template-edit_profile.php');
						$post_re[vpanel_options]["user_edit_profile_page"] = $user_edit_profile_page;
						
						$page_data = array(
							'post_status'    => 'publish',
							'post_type'      => 'page',
							'post_author'    => get_current_user_id(),
							'post_name'      => _x('user_post','Page slug','vbegy'),
							'post_title'     => _x('User post','Page title','vbegy'),
							'post_content'   => '',
							'post_parent'    => 0,
							'comment_status' => 'closed'
						);
						$post_user_page = wp_insert_post($page_data);
						update_post_meta($post_user_page,'_wp_page_template','template-user_posts.php');
						$post_re[vpanel_options]["post_user_page"] = $post_user_page;
						
						$page_data = array(
							'post_status'    => 'publish',
							'post_type'      => 'page',
							'post_author'    => get_current_user_id(),
							'post_name'      => _x('user_question','Page slug','vbegy'),
							'post_title'     => _x('User question','Page title','vbegy'),
							'post_content'   => '',
							'post_parent'    => 0,
							'comment_status' => 'closed'
						);
						$question_user_page = wp_insert_post($page_data);
						update_post_meta($question_user_page,'_wp_page_template','template-user_question.php');
						$post_re[vpanel_options]["question_user_page"] = $question_user_page;
						
						$page_data = array(
							'post_status'    => 'publish',
							'post_type'      => 'page',
							'post_author'    => get_current_user_id(),
							'post_name'      => _x('user_answer','Page slug','vbegy'),
							'post_title'     => _x('User answer','Page title','vbegy'),
							'post_content'   => '',
							'post_parent'    => 0,
							'comment_status' => 'closed'
						);
						$answer_user_page = wp_insert_post($page_data);
						update_post_meta($answer_user_page,'_wp_page_template','template-user_answer.php');
						$post_re[vpanel_options]["answer_user_page"] = $answer_user_page;
						
						$page_data = array(
							'post_status'    => 'publish',
							'post_type'      => 'page',
							'post_author'    => get_current_user_id(),
							'post_name'      => _x('favorite_question','Page slug','vbegy'),
							'post_title'     => _x('Favorite question','Page title','vbegy'),
							'post_content'   => '',
							'post_parent'    => 0,
							'comment_status' => 'closed'
						);
						$favorite_user_page = wp_insert_post($page_data);
						update_post_meta($favorite_user_page,'_wp_page_template','template-user_favorite_questions.php');
						$post_re[vpanel_options]["favorite_user_page"] = $favorite_user_page;
						
						$page_data = array(
							'post_status'    => 'publish',
							'post_type'      => 'page',
							'post_author'    => get_current_user_id(),
							'post_name'      => _x('user_point','Page slug','vbegy'),
							'post_title'     => _x('User point','Page title','vbegy'),
							'post_content'   => '',
							'post_parent'    => 0,
							'comment_status' => 'closed'
						);
						$point_user_page = wp_insert_post($page_data);
						update_post_meta($point_user_page,'_wp_page_template','template-user_points.php');
						$post_re[vpanel_options]["point_user_page"] = $point_user_page;
						
						$page_data = array(
							'post_status'    => 'publish',
							'post_type'      => 'page',
							'post_author'    => get_current_user_id(),
							'post_name'      => _x('i_follow_user','Page slug','vbegy'),
							'post_title'     => _x('I follow user','Page title','vbegy'),
							'post_content'   => '',
							'post_parent'    => 0,
							'comment_status' => 'closed'
						);
						$i_follow_user_page = wp_insert_post($page_data);
						update_post_meta($i_follow_user_page,'_wp_page_template','template-i_follow.php');
						$post_re[vpanel_options]["i_follow_user_page"] = $i_follow_user_page;
						
						$page_data = array(
							'post_status'    => 'publish',
							'post_type'      => 'page',
							'post_author'    => get_current_user_id(),
							'post_name'      => _x('followers_user','Page slug','vbegy'),
							'post_title'     => _x('Followers user','Page title','vbegy'),
							'post_content'   => '',
							'post_parent'    => 0,
							'comment_status' => 'closed'
						);
						$followers_user_page = wp_insert_post($page_data);
						update_post_meta($followers_user_page,'_wp_page_template','template-followers.php');
						$post_re[vpanel_options]["followers_user_page"] = $followers_user_page;
						
						$page_data = array(
							'post_status'    => 'publish',
							'post_type'      => 'page',
							'post_author'    => get_current_user_id(),
							'post_name'      => _x('follow_question','Page slug','vbegy'),
							'post_title'     => _x('Follow question','Page title','vbegy'),
							'post_content'   => '',
							'post_parent'    => 0,
							'comment_status' => 'closed'
						);
						$follow_question_page = wp_insert_post($page_data);
						update_post_meta($follow_question_page,'_wp_page_template','template-question_follow.php');
						$post_re[vpanel_options]["follow_question_page"] = $follow_question_page;
						
						$page_data = array(
							'post_status'    => 'publish',
							'post_type'      => 'page',
							'post_author'    => get_current_user_id(),
							'post_name'      => _x('follow_answer','Page slug','vbegy'),
							'post_title'     => _x('Follow answer','Page title','vbegy'),
							'post_content'   => '',
							'post_parent'    => 0,
							'comment_status' => 'closed'
						);
						$follow_answer_page = wp_insert_post($page_data);
						update_post_meta($follow_answer_page,'_wp_page_template','template-answer_follow.php');
						$post_re[vpanel_options]["follow_answer_page"] = $follow_answer_page;
						
						$page_data = array(
							'post_status'    => 'publish',
							'post_type'      => 'page',
							'post_author'    => get_current_user_id(),
							'post_name'      => _x('follow_post','Page slug','vbegy'),
							'post_title'     => _x('Follow post','Page title','vbegy'),
							'post_content'   => '',
							'post_parent'    => 0,
							'comment_status' => 'closed'
						);
						$follow_post_page = wp_insert_post($page_data);
						update_post_meta($follow_post_page,'_wp_page_template','template-post_follow.php');
						$post_re[vpanel_options]["follow_post_page"] = $follow_post_page;
						
						$page_data = array(
							'post_status'    => 'publish',
							'post_type'      => 'page',
							'post_author'    => get_current_user_id(),
							'post_name'      => _x('follow comment','Page slug','vbegy'),
							'post_title'     => _x('Follow comment','Page title','vbegy'),
							'post_content'   => '',
							'post_parent'    => 0,
							'comment_status' => 'closed'
						);
						$follow_comment_page = wp_insert_post($page_data);
						update_post_meta($follow_comment_page,'_wp_page_template','template-comment_follow.php');
						$post_re[vpanel_options]["follow_comment_page"] = $follow_comment_page;
						
						$page_data = array(
							'post_status'    => 'publish',
							'post_type'      => 'page',
							'post_author'    => get_current_user_id(),
							'post_name'      => _x('edit_post','Page slug','vbegy'),
							'post_title'     => _x('Edit post','Page title','vbegy'),
							'post_content'   => '',
							'post_parent'    => 0,
							'comment_status' => 'closed'
						);
						$edit_post = wp_insert_post($page_data);
						update_post_meta($edit_post,'_wp_page_template','template-edit_post.php');
						$post_re[vpanel_options]["edit_post"] = $edit_post;
						
						$page_data = array(
							'post_status'    => 'publish',
							'post_type'      => 'page',
							'post_author'    => get_current_user_id(),
							'post_name'      => _x('edit_comment','Page slug','vbegy'),
							'post_title'     => _x('Edit comment','Page title','vbegy'),
							'post_content'   => '',
							'post_parent'    => 0,
							'comment_status' => 'closed'
						);
						$edit_comment = wp_insert_post($page_data);
						update_post_meta($edit_comment,'_wp_page_template','template-edit_comment.php');
						$post_re[vpanel_options]["edit_comment"] = $edit_comment;
						echo 3;
					}
				}else {
					$post_re[vpanel_options][$key] = 1;
				}
			}else {
				$post_re[vpanel_options][$key] = $value;
			}
		}
		unset($post_re[vpanel_options]["theme_pages"]);
		update_option(vpanel_options,$post_re[vpanel_options]);
		/* Badges */
		if (isset($post_re["badges"])) {
			update_option("badges",$post_re["badges"]);
		}else {
			delete_option("badges");
		}
		/* Coupons */
		if (isset($post_re["coupons"])) {
			update_option("coupons",$post_re["coupons"]);
		}else {
			delete_option("coupons");
		}
		/* Sidebars */
		if (isset($post_re["sidebars"])) {
			update_option("sidebars",$post_re["sidebars"]);
		}else {
			delete_option("sidebars");
		}
		/* roles */
		global $wp_roles;
		if (isset($post_re["roles"])) {$k = 0;
			foreach ($post_re["roles"] as $value_roles) {$k++;
				unset($wp_roles->roles[$value_roles["id"]]);
				add_role($value_roles["id"],$value_roles["group"],array('read' => false));
				$is_group = get_role($value_roles["id"]);
				if (isset($value_roles["ask_question"]) && $value_roles["ask_question"] == "on") {
					$is_group->add_cap('ask_question');
				}else {
					$is_group->remove_cap('ask_question');
				}
				if (isset($value_roles["show_question"]) && $value_roles["show_question"] == "on") {
					$is_group->add_cap('show_question');
				}else {
					$is_group->remove_cap('show_question');
				}
				if (isset($value_roles["add_answer"]) && $value_roles["add_answer"] == "on") {
					$is_group->add_cap('add_answer');
				}else {
					$is_group->remove_cap('add_answer');
				}
				if (isset($value_roles["show_answer"]) && $value_roles["show_answer"] == "on") {
					$is_group->add_cap('show_answer');
				}else {
					$is_group->remove_cap('show_answer');
				}
				if (isset($value_roles["add_post"]) && $value_roles["add_post"] == "on") {
					$is_group->add_cap('add_post');
				}else {
					$is_group->remove_cap('add_post');
				}
			}
			update_option("roles",$post_re["roles"]);
		}else {
			delete_option("roles");
		}
		/* roles_default */
		if (isset($post_re["roles_default"])) {
			update_option("roles_default",$post_re["roles_default"]);
			$old_roles = $wp_roles->roles;
			foreach ($old_roles as $key_r => $value_r) {
				$is_group = get_role($key_r);
				if (isset($post_re["roles_default"][$key_r]) && is_array($post_re["roles_default"][$key_r])) {
					$value_d = $post_re["roles_default"][$key_r];
					if (isset($value_d["ask_question"]) && $value_d["ask_question"] == "on") {
						$is_group->add_cap('ask_question');
					}else {
						$is_group->remove_cap('ask_question');
					}
					if (isset($value_d["show_question"]) && $value_d["show_question"] == "on") {
						$is_group->add_cap('show_question');
					}else {
						$is_group->remove_cap('show_question');
					}
					if (isset($value_d["add_answer"]) && $value_d["add_answer"] == "on") {
						$is_group->add_cap('add_answer');
					}else {
						$is_group->remove_cap('add_answer');
					}
					if (isset($value_d["show_answer"]) && $value_d["show_answer"] == "on") {
						$is_group->add_cap('show_answer');
					}else {
						$is_group->remove_cap('show_answer');
					}
					if (isset($value_d["add_post"]) && $value_d["add_post"] == "on") {
						$is_group->add_cap('add_post');
					}else {
						$is_group->remove_cap('add_post');
					}
				}
			}
		}else {
			delete_option("roles_default");
		}
	}
	update_option("FlushRewriteRules",true);
	die(1);
}
add_action( 'wp_ajax_vpanel_update_options', 'vpanel_update_options' );
add_action('wp_ajax_nopriv_vpanel_update_options','vpanel_update_options');
/* reset_options */
function reset_options() {
	global $themename;
	$options = & Options_Framework::_optionsframework_options();
	foreach ($options as $option) {
		if (isset($option['id'])) {
			$option_std = $option['std'];
			$option_res[$option['id']] = $option['std'];
		}
	}
	update_option(vpanel_options,$option_res);
	update_option("FlushRewriteRules",true);
	die(1);
}
add_action( 'wp_ajax_reset_options', 'reset_options' );
add_action('wp_ajax_nopriv_reset_options','reset_options');
/* delete_group */
function delete_group() {
	$group_id = esc_attr($_POST["group_id"]);
	remove_role($group_id);
	die(1);
}
add_action( 'wp_ajax_delete_group', 'delete_group' );
add_action('wp_ajax_nopriv_delete_group','delete_group');
/* vpanel_get_user_url */
function vpanel_get_user_url($author_id, $author_nicename = '') {
	global $wp_rewrite;
	$auth_ID = (int) $author_id;
	$link = $wp_rewrite->get_author_permastruct();
	if ( empty($link) ) {
		$file = home_url( '/' );
		$link = $file . '?author=' . $auth_ID;
	}else {
		if ( '' == $author_nicename ) {
			$user = get_userdata($author_id);
			if ( !empty($user->user_nicename) )
				$author_nicename = $user->user_nicename;
		}
		$link = str_replace('%author%', $author_nicename, $link);
		$link = home_url( user_trailingslashit( $link ) );
	}
	$link = apply_filters( 'author_link', $link, $author_id, $author_nicename );
	return $link;
}
/* vpanel_get_badge */
function vpanel_get_badge($author_id,$return = "") {
	$author_id = (int)$author_id;
	if ($author_id > 0) {
		$last_key = 0;
		$points = get_user_meta($author_id,"points",true);
		$badges = get_option("badges");
		if (isset($badges) && is_array($badges)) {
			foreach ($badges as $badges_k => $badges_v) {
				$badges_points[] = $badges_v["badge_points"];
			}
			if (isset($badges_points) && is_array($badges_points)) {
				foreach ($badges_points as $key => $badge_point) {
					if ($points >= $badge_point) {
						$last_key = $key;
					}
				}
			}
			$key = $last_key;
			if ($return == "color") {
				$badge_color = $badges[$key+1]["badge_color"];
				return $badge_color;
			}else if ($return == "name") {
				$badge_name = $badges[$key+1]["badge_name"];
				return $badge_name;
			}else {
				return '<span class="badge-span" style="background-color: '.$badges[$key+1]["badge_color"].'">'.$badges[$key+1]["badge_name"].'</span>';
			}
		}
	}
}
/* vpanel_sidebars */
if (!is_admin()) {
	function vpanel_sidebars($return = 'sidebar_dir') {
		global $post;
		$sidebar_layout          = $sidebar_class = "";
		$sidebar_width = vpanel_options("sidebar_width");
		$sidebar_width = (isset($sidebar_width) && $sidebar_width != ""?$sidebar_width:"col-md-3");
		$sidebar_layout = "";
		if (isset($sidebar_width) && $sidebar_width == "col-md-3") {
			$container_span = "col-md-9";
		}else {
			$container_span = "col-md-8";
		}
		$full_span       = "col-md-12";
		$page_right      = "page-right-sidebar";
		$page_left       = "page-left-sidebar";
		$page_full_width = "page-full-width";
		
		if (is_author()) {
			$author_sidebar_layout = vpanel_options('author_sidebar_layout');
		}else if (is_category() || is_tax("product_cat") || is_tax("question-category") || is_tax("question_tags")) {
			$cat_sidebar_layout = (isset($categories["cat_sidebar_layout"])?$categories["cat_sidebar_layout"]:"default");
			if ($cat_sidebar_layout == "default") {
				if (is_tax("product_cat")) {
					$cat_sidebar_layout = vpanel_options("products_sidebar_layout");
				}else if (is_tax("question-category") || is_tax("question_tags")) {
					$cat_sidebar_layout = vpanel_options("questions_sidebar_layout");
				}
			}
		}else if (is_single() || is_page()) {
			$sidebar_post = rwmb_meta('vbegy_sidebar','radio',$post->ID);
			if ($sidebar_post == "" || $sidebar_post == "default") {
				$sidebar_post = vpanel_options("sidebar_layout");
			}
		}else {
			$sidebar_layout = vpanel_options('sidebar_layout');
		}
		
		if (is_author()) {
			if ($author_sidebar_layout == "" || $author_sidebar_layout == "default") {
				$author_sidebar_layout = vpanel_options("sidebar_layout");
			}
			if ($author_sidebar_layout == 'left') {
				$sidebar_dir = $page_left;
				$homepage_content_span = $container_span;
			}elseif ($author_sidebar_layout == 'full') {
				$sidebar_dir = $page_full_width;
				$homepage_content_span = $full_span;
			}else {
				$sidebar_dir = $page_right;
				$homepage_content_span = $container_span;
			}
		}else if (is_category() || is_tax("product_cat") || is_tax("question-category") || is_tax("question_tags")) {
			if ($cat_sidebar_layout == "" || $cat_sidebar_layout == "default") {
				$cat_sidebar_layout = vpanel_options("sidebar_layout");
			}
			if ($cat_sidebar_layout == 'left') {
				$sidebar_dir = $page_left;
				$homepage_content_span = $container_span;
			}elseif ($cat_sidebar_layout == 'full') {
				$sidebar_dir = $page_full_width;
				$homepage_content_span = $full_span;
			}else {
				$sidebar_dir = $page_right;
				$homepage_content_span = $container_span;
			}
		}else if (is_single() || is_page()) {
			$sidebar_post = rwmb_meta('vbegy_sidebar','radio',$post->ID);
			$sidebar_dir = '';
			if (isset($sidebar_post) && $sidebar_post != "default" && $sidebar_post != "") {
				if ($sidebar_post == 'left') {
					$sidebar_dir = 'page-left-sidebar';
					$homepage_content_span = $container_span;
				}elseif ($sidebar_post == 'full') {
					$sidebar_dir = 'page-full-width';
					$homepage_content_span = $full_span;
				}else {
					$sidebar_dir = 'page-right-sidebar';
					$homepage_content_span = $container_span;
				}
			}else {
				$sidebar_layout_q = vpanel_options('questions_sidebar_layout');
				$sidebar_layout_p = vpanel_options('products_sidebar_layout');
				if (is_singular("question") && $sidebar_layout_q != "default") {
					if ($sidebar_layout_q == 'left') {
						$sidebar_dir = 'page-left-sidebar';
						$homepage_content_span = $container_span;
					}elseif ($sidebar_layout_q == 'full') {
						$sidebar_dir = 'page-full-width';
						$homepage_content_span = $full_span;
					}else {
						$sidebar_dir = 'page-right-sidebar';
						$homepage_content_span = $container_span;
					}
				}else if (is_singular("product") && $sidebar_layout_p != "default") {
					if ($sidebar_layout_p == 'left') {
						$sidebar_dir = 'page-left-sidebar';
						$homepage_content_span = $container_span;
					}elseif ($sidebar_layout_p == 'full') {
						$sidebar_dir = 'page-full-width';
						$homepage_content_span = $full_span;
					}else {
						$sidebar_dir = 'page-right-sidebar';
						$homepage_content_span = $container_span;
					}
				}else {
					$sidebar_layout = vpanel_options('sidebar_layout');
					if ($sidebar_layout == 'left') {
						$sidebar_dir = 'page-left-sidebar';
						$homepage_content_span = $container_span;
					}elseif ($sidebar_layout == 'full') {
						$sidebar_dir = 'page-full-width';
						$homepage_content_span = $full_span;
					}else {
						$sidebar_dir = 'page-right-sidebar';
						$homepage_content_span = $container_span;
					}
				}
			}
		}else {
			if ((is_single() || is_page()) && $sidebar_post != "default" && $sidebar_post != "") {
				if ($sidebar_post == 'left') {
					$sidebar_dir = 'page-left-sidebar';
					$homepage_content_span = $container_span;
				}elseif ($sidebar_post == 'full') {
					$sidebar_dir = 'page-full-width';
					$homepage_content_span = $full_span;
				}else {
					$sidebar_dir = 'page-right-sidebar';
					$homepage_content_span = $container_span;
				}
			}else {
				if ((is_singular("product") && $sidebar_layout_p != "default" && $sidebar_layout_p != "")) {
					$sidebar_layout_p = vpanel_options('products_sidebar_layout');
					if ($sidebar_layout_p == 'left') {
						$sidebar_dir = 'page-left-sidebar';
						$homepage_content_span = $container_span;
					}elseif ($sidebar_layout_p == 'full') {
						$sidebar_dir = 'page-full-width';
						$homepage_content_span = $full_span;
					}else {
						$sidebar_dir = 'page-right-sidebar';
						$homepage_content_span = $container_span;
					}
				}else if ((is_singular("question") && $sidebar_layout_q != "default" && $sidebar_layout_q != "")) {
					$sidebar_layout_q = vpanel_options('questions_sidebar_layout');
					if ($sidebar_layout_q == 'left') {
						$sidebar_dir = 'page-left-sidebar';
						$homepage_content_span = $container_span;
					}elseif ($sidebar_layout_q == 'full') {
						$sidebar_dir = 'page-full-width';
						$homepage_content_span = $full_span;
					}else {
						$sidebar_dir = 'page-right-sidebar';
						$homepage_content_span = $container_span;
					}
				}else {
					$sidebar_layout = vpanel_options('sidebar_layout');
					if ($sidebar_layout == 'left') {
						$sidebar_dir = 'page-left-sidebar';
						$homepage_content_span = $container_span;
					}elseif ($sidebar_layout == 'full') {
						$sidebar_dir = 'page-full-width';
						$homepage_content_span = $full_span;
					}else {
						$sidebar_dir = 'page-right-sidebar';
						$homepage_content_span = $container_span;
					}
				}
			}
		}
		
		if ($return == "sidebar_dir") {
			return $sidebar_dir;
		}else if ($return == "sidebar_class") {
			return $sidebar_class;
		}else if ($return == "sidebar_where") {
			if ($sidebar_dir == $page_full_width) {
				$sidebar_where = 'full';
			}else {
				$sidebar_where = 'sidebar';
			}
			return $sidebar_where;
		}else {
			return $homepage_content_span;
		}
	}
}
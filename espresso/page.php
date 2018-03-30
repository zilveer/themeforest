<?php get_header(); global $template_dir, $no_slider;

$no_slider = false;
	
if (have_posts()) : while(have_posts()) : the_post();

	get_template_part('pageparts/pagepart','slider');
			
	// Get Page Variables
	
	$show_posts = get_post_meta($post->ID,'_display_recent_posts',true); $show_posts = ($show_posts ? $show_posts[0] : '');
	$show_events = get_post_meta($post->ID,'_display_upcoming_events',true); $show_events = ($show_events ? $show_events[0] : '');
	$show_single_event = get_post_meta($post->ID,'_display_single_event',true); $show_single_event = ($show_single_event ? $show_single_event[0] : '');
	$show_parallax = get_post_meta($post->ID,'_display_parallax',true); $show_parallax = ($show_parallax ? $show_parallax[0] : '');
	$show_twitter = get_post_meta($post->ID,'_display_recent_tweets',true); $show_twitter = ($show_twitter ? $show_twitter[0] : '');
	$show_widgets = get_post_meta($post->ID,'_widget_layout',true); $show_widgets = ($show_widgets ? $show_widgets[0] : '');
	$show_feature_blocks = get_post_meta($post->ID,'_feature_block_layout',true); $show_feature_blocks = ($show_feature_blocks ? $show_feature_blocks[0] : '');
	$section_array = array();
	
	$page_content_location = get_post_meta($post->ID,'_page_content_order',true);
	
	if (get_the_content() || isset($_GET['dslc']) || get_post_meta(get_the_ID(), 'dslc_code', true)): $section_array[$page_content_location.'-content'] = 'content'; endif;
	
	if ($show_posts):
		global $section_title;
		$posts_location = get_post_meta($post->ID,'_recent_posts_order',true);
		$section_title = get_post_meta($post->ID,'_recent_posts_title',true);
		$section_array[$posts_location.'-posts'] = 'posts';
	endif;
	
	if ($show_twitter):
		global $section_title_tweets;
		$posts_location = get_post_meta($post->ID,'_recent_tweets_order',true);
		$section_array[$posts_location.'-tweets'] = 'tweets';
	endif;
	
	if ($show_parallax):
		$parallax_location = get_post_meta($post->ID,'_parallax_order',true);
		$section_array[$parallax_location.'-parallax'] = 'parallax';
	endif;
	
	if (class_exists('Tribe__Events__Main')) {
		if ($show_events):
			global $event_items_title;
			$event_items_title = get_post_meta($post->ID,'_event_items_title',true);
			$events_location = get_post_meta($post->ID,'_event_items_order',true);
			$section_array[$events_location.'-events'] = 'events';
		endif;
		if ($show_single_event):
			global $single_event_items_title;
			$single_event_items_title = get_post_meta($post->ID,'_single_event_items_title',true);
			$single_event_items_order = get_post_meta($post->ID,'_single_event_items_order',true);
			$single_event_id = get_post_meta($post->ID,'_single_event_id',true);
			$section_array[$single_event_items_order.'-single_event'] = 'single_event';
		endif;
	} else {
		$show_events = false;
		$show_single_event = false;
	}
	
	if ($show_widgets && $show_widgets != 'no-widgets'):
		$widget_location = get_post_meta($post->ID,'_widget_items_order',true);
		$section_array[$widget_location.'-widgets'] = 'widgets';
	endif;
	
	if ($show_feature_blocks && $show_feature_blocks != 'no-blocks'):
		$feature_block_location = get_post_meta($post->ID,'_feature_blocks_order',true);
		$section_array[$feature_block_location.'-featureblocks'] = 'featureblocks';
	endif;
	
	ksort($section_array);
	
	global $show_events, $show_posts;
	
	$last_item = end($section_array);
	$first_item = reset($section_array);
	
	// Get hidden mobile elements to control spacers
	$hide_on_mobile = ot_get_option('hide_on_mobile',array());
	
	$previous_section = false;
	
	foreach($section_array as $section):
	
		if ($section == $first_item && $section == 'single_event' ||
			$section == $first_item && $section == 'posts' ||
			$section == $first_item && $section == 'widgets' ||
			$section == $first_item && $section == 'content' ||
			$section == $first_item && $section == 'events'):
			
				?><div class="bottom-spacer shell<?php
				if (in_array('#homepage-recent-posts',$hide_on_mobile) && $previous_section == 'posts' ||
				in_array('#widget-block',$hide_on_mobile) && $previous_section == 'widgets' ||
				in_array('#homepage-events',$hide_on_mobile) && $previous_section == 'events'){ echo ' hide-spacer-on-mobile'; }
				?>"></div><?php
					
		elseif ($previous_section == 'posts' && $section == 'widgets' ||
			$previous_section == 'posts' && $section == 'single_event' ||
			$previous_section == 'posts' && $section == 'events' ||
			$previous_section == 'posts' && $section == 'content' ||
			$previous_section == 'posts' && $section == 'parallax' ||
			$previous_section == 'widgets' && $section == 'posts' ||
			$previous_section == 'widgets' && $section == 'single_event' ||
			$previous_section == 'widgets' && $section == 'events' ||
			$previous_section == 'widgets' && $section == 'content' ||
			$previous_section == 'widgets' && $section == 'parallax' ||
			$previous_section == 'events' && $section == 'widgets' ||
			$previous_section == 'events' && $section == 'single_event' ||
			$previous_section == 'events' && $section == 'posts' ||
			$previous_section == 'events' && $section == 'content' ||
			$previous_section == 'events' && $section == 'parallax' ||
			$previous_section == 'content' && $section == 'widgets' ||
			$previous_section == 'content' && $section == 'single_event' ||
			$previous_section == 'content' && $section == 'posts' ||
			$previous_section == 'content' && $section == 'events' ||
			$previous_section == 'content' && $section == 'parallax' ||
			$previous_section == 'tweets' && $section == 'widgets' ||
			$previous_section == 'tweets' && $section == 'posts' ||
			$previous_section == 'tweets' && $section == 'single_event' ||
			$previous_section == 'tweets' && $section == 'events' ||
			$previous_section == 'tweets' && $section == 'content' ||
			$previous_section == 'parallax' && $section == 'widgets' ||
			$previous_section == 'parallax' && $section == 'posts' ||
			$previous_section == 'parallax' && $section == 'single_event' ||
			$previous_section == 'parallax' && $section == 'events' ||
			$previous_section == 'parallax' && $section == 'content' ||
			$previous_section == 'single_event' && $section == 'widgets' ||
			$previous_section == 'single_event' && $section == 'posts' ||
			$previous_section == 'single_event' && $section == 'parallax' ||
			$previous_section == 'single_event' && $section == 'events' ||
			$previous_section == 'single_event' && $section == 'content' ||
			$previous_section == 'featureblocks' && $section == 'content' ||
			$previous_section == 'featureblocks' && $section == 'widgets' ||
			$previous_section == 'featureblocks' && $section == 'single_event' ||
			$previous_section == 'featureblocks' && $section == 'events' ||
			$previous_section == 'featureblocks' && $section == 'posts'):
			
				?><div class="bottom-spacer shell<?php
				if (in_array('#homepage-recent-posts',$hide_on_mobile) && $previous_section == 'posts' ||
				in_array('#widget-block',$hide_on_mobile) && $previous_section == 'widgets' ||
				in_array('#homepage-events',$hide_on_mobile) && $previous_section == 'events' ||
				in_array('#homepage-countdown',$hide_on_mobile) && $previous_section == 'single_event' ||
				in_array('#recent-tweets',$hide_on_mobile) && $previous_section == 'tweets' && $section != 'widgets' && $section != 'posts' && $section != 'content' && $section != 'events' && $section != 'single_event' ||
				in_array('#parallax_page_section',$hide_on_mobile) && $previous_section == 'parallax' && $section != 'widgets' && $section != 'posts' && $section != 'content' && $section != 'events' && $section != 'single_event' ||
				in_array('#ctas',$hide_on_mobile) && $previous_section == 'featureblocks' && $section != 'widgets' && $section != 'posts' && $section != 'content' && $section != 'events' && $section != 'single_event' ){ echo ' hide-spacer-on-mobile'; }
				?>"></div><?php
			
		elseif ($previous_section == 'posts' && $section == 'tweets' ||
			$previous_section == 'widgets' && $section == 'tweets' ||
			$previous_section == 'events' && $section == 'tweets' ||
			$previous_section == 'single_event' && $section == 'tweets' ||
			$previous_section == 'content' && $section == 'tweets' ||
			$previous_section == 'posts' && $section == 'parallax' ||
			$previous_section == 'widgets' && $section == 'parallax' ||
			$previous_section == 'events' && $section == 'parallax' ||
			$previous_section == 'single_event' && $section == 'parallax' ||
			$previous_section == 'content' && $section == 'parallax' ||
			$previous_section == 'posts' && $section == 'featureblocks' ||
			$previous_section == 'content' && $section == 'featureblocks' ||
			$previous_section == 'widgets' && $section == 'featureblocks' ||
			$previous_section == 'single_event' && $section == 'featureblocks' ||
			$previous_section == 'events' && $section == 'featureblocks'):
			
				?><div class="bottom-spacer shell<?php
				if (in_array('#homepage-recent-posts',$hide_on_mobile) && $previous_section == 'posts' ||
				in_array('#widget-block',$hide_on_mobile) && $previous_section == 'widgets' ||
				in_array('#homepage-events',$hide_on_mobile) && $previous_section == 'events' ||
				in_array('#homepage-countdown',$hide_on_mobile) && $previous_section == 'single_event'){ echo ' hide-spacer-on-mobile'; }
				?>"></div><?php
			
		endif;
	
		wp_reset_query();
		get_template_part('pageparts/pagepart',$section);
		$previous_section = $section;
		
		if ($section == $last_item && $section == 'posts' ||
			$section == $last_item && $section == 'widgets' ||
			$section == $last_item && $section == 'content' ||
			$section == $last_item && $section == 'events' ||
			$section == $last_item && $section == 'single_event'):
			
				?><div class="bottom-spacer shell<?php
				if (in_array('#homepage-recent-posts',$hide_on_mobile) && $previous_section == 'posts' ||
				in_array('#widget-block',$hide_on_mobile) && $previous_section == 'widgets' ||
				in_array('#homepage-events',$hide_on_mobile) && $previous_section == 'events' ||
					in_array('#homepage-countdown',$hide_on_mobile) && $previous_section == 'single_event'){ echo ' hide-spacer-on-mobile'; }
				?>"></div><?php
		endif;
		
	endforeach;

endwhile; endif;
get_footer();
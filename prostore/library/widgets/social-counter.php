<?php
/**
 * Theme Name: proStore
 * Theme URI: http://themeforest.net/user/gnrocks/portfolio
 * Theme demo : http://rchour.net/prostore
 * Description: A WordPress premium theme exclusively for sale on ThemeForest
 *
 * Author: gnrocks
 * Author URI: http://themeforest.net/user/gnrocks
 * License : http://codex.wordpress.org/GPL & http://wiki.envato.com/support/legal-terms/licensing-terms/
 *
 *
 * @package 	proStore/library/widgets/social-counter.php
 * @file	 	1.0
 */
?>
<?php

// Widget class
class Widget_Social_Counter extends WP_Widget {


/*-----------------------------------------------------------------------------------*/
/*	Widget Setup
/*-----------------------------------------------------------------------------------*/
	
function Widget_Social_Counter() {

	// Widget settings
	$widget_ops = array (
		'classname' => 'widget_social_counter',
		'description' => __('A widget that allows the display and configuration of Social Counters.', 'prostore-theme')
	);

	// Widget control settings
	$control_ops = array (
		'width' => 300,
		'height' => 350,
		'id_base' => 'widget_social_counter'
	);

	// Create the widget
	$this->WP_Widget( 'Widget_Social_Counter', __('proStore - Social Counter', 'prostore-theme'), $widget_ops, $control_ops );
	
}


/*-----------------------------------------------------------------------------------*/
/*	Display Widget
/*-----------------------------------------------------------------------------------*/
	
function widget( $args, $instance ) {
	extract( $args );

	// Our variables from the widget settings
	$title = apply_filters('widget_title', $instance['title'] );
	
	//Profiles 
	$rsslink = $instance['rsslink'];
	$rssaction = $instance['rssaction'];
	$twitterprofile = $instance['twitterprofile'];
	$twitteraction = $instance['twitteraction'];
	$facebookpage = $instance['facebookpage'];
	$facebookaction = $instance['facebookaction'];
	$dribbbleprofile = $instance['dribbbleprofile'];
	$dribbbleaction = $instance['dribbbleaction'];
	
	$desc = $instance['desc'];

	// Before widget (defined by theme functions file)
	echo $before_widget;

	/* Display Widget */
	/* Display the widget title if one was input (before and after defined by themes). */
	if ( $title )
		echo $before_title . $title . $after_title;
		
	?>
		<!-- Social Counter -->
		<div class="social-counter clearfix">                      
            
           	<?php if ( $desc ) { echo '<p>'.$desc.'</p>'; } ?>
            	
            <ul>
            
				<?php if ( $rsslink != '' ) : ?>
				
					<li>
					    <a href="http://feeds.feedburner.com/<?php echo $rsslink; ?>">
					    	<span class="icon-wrapper count-icon-rss"></span>
						</a>		
				    	<span class="count">
				    		<?php 
				    			$xml = @simplexml_load_file("https://feedburner.google.com/api/awareness/1.0/GetFeedData?uri=$rsslink"); 
				    			if (!$xml) { $subs = 22; } else { $subs = $xml->feed->entry['circulation']; } 
				    			echo $subs; 
				    		?>
				    		<span><?php _e('Subscribers','prostore-theme'); ?></span>
				    	</span>
 						<div class="action-link">
							<a href="http://feeds.feedburner.com/<?php echo $rsslink; ?>">
								<?php echo $rssaction; ?>
							</a>
						</div>                      
					</li>
				
				<?php endif; ?>
				
				<?php if($twitterprofile != '') : ?>
				
	                <li>
	                    <a href="http://twitter.com/<?php echo $twitterprofile; ?>">
	                    	<span class="icon-wrapper count-icon-twitter"></span>
	                    </a>	
	                    <span class="count">
	                    	<?php print twitter_followers_counter($twitterprofile)?>
	                    	<span> <?php _e('Followers','prostore-theme'); ?></span>
	                    </span>
	                    <div class="action-link">
	                    	<a href="http://twitter.com/<?php echo $twitterprofile; ?>">
	                    		<?php echo $twitteraction; ?>
	                    	</a>
	                    </div>
	                </li>
				
				<?php endif; ?>
                
                <?php if($facebookpage != '') : ?>
                
	                <li>
	              		<a href="http://www.facebook.com/<?php echo $facebookpage; ?>">
	              			<span class="icon-wrapper count-icon-facebook"></span>
		                </a>
	                   	<span class="count">
	                   		<?php 
	                   			$page_id = "$facebookpage"; 
	                   			$query = "https://graph.facebook.com/$page_id"; 
	                   			$content = file_get_contents($query); 
	                   			$decode = json_decode($content); 
	                   			$count = $decode->likes; 
	                   			$count = number_format($count); 
	                   			echo ''.$count.''; 
	                   		?>
	                   		<span><?php _e('Fans','prostore-theme'); ?></span>
	                   	</span>
	             		<div class="action-link">
	             			<a href="http://www.facebook.com/<?php echo $facebookpage; ?>">
	             				<?php echo $facebookaction; ?>
	             			</a>
	             		</div>
	                </li>
	                
               	<?php endif; ?>

                <?php if($dribbbleprofile != '') : ?>
                
	                 <li>
	                 	<a href="http://dribbble.com/<?php echo $dribbbleprofile; ?>">
							<span class="icon-wrapper count-icon-dribbble"></span>
	                 	</a>	
	             		<span class="count">
	             			<?php 
	             				$page_id = "$dribbbleprofile"; 
	             				$query = "http://api.dribbble.com/$page_id"; 
	             				$content = file_get_contents($query); 
	             				$decode = json_decode($content); 
	             				$count = $decode->followers_count; 
	             				$count = number_format($count); 
	             				echo ''.$count.''; 
	             			?>
	             			<span><?php _e('Followers','prostore-theme'); ?></span>
	             		</span>
	                 	<div class="action-link">
	                 		<a href="http://dribbble.com/<?php echo $dribbbleprofile; ?>">
	                 			<?php echo $dribbbleaction; ?>
	                 		</a>
	                 	</div>
	                 </li> 
                  
                <?php endif; ?>
            
            </ul>
      	</div>
      <!--/Social Counter -->
		
	<?php
	// After widget (defined by theme functions file)
	echo $after_widget;
	
}


/*-----------------------------------------------------------------------------------*/
/*	Update Widget
/*-----------------------------------------------------------------------------------*/
	
function update( $new_instance, $old_instance ) {
	$instance = $old_instance;

	// Strip tags to remove HTML (important for text inputs)
	$instance['title'] = strip_tags( $new_instance['title'] );

	// No need to strip tags
	$instance['rsslink'] = $new_instance['rsslink'];
	$instance['rssaction'] = $new_instance['rssaction'];
	$instance['twitterprofile'] = $new_instance['twitterprofile'];
	$instance['twitteraction'] = $new_instance['twitteraction'];
	$instance['facebookpage'] = $new_instance['facebookpage'];
	$instance['facebookaction'] = $new_instance['facebookaction'];
	$instance['dribbbleprofile'] = $new_instance['dribbbleprofile'];
	$instance['dribbbleaction'] = $new_instance['dribbbleaction'];	
	$instance['desc'] = $new_instance['desc'];
 	
	return $instance;
}

/*-----------------------------------------------------------------------------------*/
/*	Widget Settings (Displays the widget settings controls on the widget panel)
/*-----------------------------------------------------------------------------------*/
	
function form( $instance ) {

	// Set up some default widget settings
	$style = $instance[ 'style' ];
	
	$defaults = array(
		'title' => 'Social Counter Widget',
		'rsslink' => '',
		'rssaction' => 'Subscribe to our Feed',
		'twitterprofile' => '',
		'twitteraction' => 'Follow us on Twitter',
		'facebookpage' => '',
		'facebookaction' => 'Become a Facebook Fan',
		'dribbbleprofile' => '',
		'dribbbleaction' => 'Follow us on Dribbble',
		'desc' => '',
		
	);
		
	$instance = wp_parse_args( (array) $instance, $defaults ); ?>

	<!-- Widget Title: Text Input -->
	<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'prostore-theme') ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
	</p>

	<!-- Display: Text Input -->	
	<p>
		<label for="<?php echo $this->get_field_id( 'desc' ); ?>"><?php _e('Optional Text:', 'prostore-theme') ?></label>
		<textarea class="widefat" rows="6" cols="15" id="<?php echo $this->get_field_id( 'desc' ); ?>" name="<?php echo $this->get_field_name( 'desc' ); ?>"><?php echo $instance['desc']; ?></textarea>
	</p>
	
	<p><strong>1. RSS / Feedburner </strong></p>
 	
	<!-- RSS / Feedburner : Text Input -->
	<p>
		<label for="<?php echo $this->get_field_id( 'rsslink' ); ?>"><?php _e('RSS URI:', 'prostore-theme') ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'rsslink' ); ?>" name="<?php echo $this->get_field_name( 'rsslink' ); ?>" value="<?php echo $instance['rsslink']; ?>" />
	</p>
	
	<p>
		<label for="<?php echo $this->get_field_id( 'rssaction' ); ?>"><?php _e('Action Link Text:', 'prostore-theme') ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'rssaction' ); ?>" name="<?php echo $this->get_field_name( 'rssaction' ); ?>" value="<?php echo $instance['rssaction']; ?>" />
	</p>
	
	<br>
	<p><strong>2. Twitter </strong></p>	
	
	<!-- Twitter Profile: Text Input -->
	<p>
		<label for="<?php echo $this->get_field_id( 'twitterprofile' ); ?>"><?php _e('Twitter Username', 'prostore-theme') ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'twitterprofile' ); ?>" name="<?php echo $this->get_field_name( 'twitterprofile' ); ?>" value="<?php echo $instance['twitterprofile']; ?>" />
	</p>
	
	<p>
		<label for="<?php echo $this->get_field_id( 'twitteraction' ); ?>"><?php _e('Action Link Text:', 'prostore-theme') ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'twitteraction' ); ?>" name="<?php echo $this->get_field_name( 'twitteraction' ); ?>" value="<?php echo $instance['twitteraction']; ?>" />
	</p>
	
	<br>
	<p><strong>2. Facebook </strong></p>	
	
	<!-- Facebook Page: Text Input -->
	<p>
		<label for="<?php echo $this->get_field_id( 'facebookpage' ); ?>"><?php _e('Facebook Page Name (e.g. envato):', 'prostore-theme') ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'facebookpage' ); ?>" name="<?php echo $this->get_field_name( 'facebookpage' ); ?>" value="<?php echo $instance['facebookpage']; ?>" />
	</p>
	
	<p>
		<label for="<?php echo $this->get_field_id( 'facebookaction' ); ?>"><?php _e('Action Link Text:', 'prostore-theme') ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'facebookaction' ); ?>" name="<?php echo $this->get_field_name( 'facebookaction' ); ?>" value="<?php echo $instance['facebookaction']; ?>" />
	</p>
	
	<br>
	<p><strong>2. Dribbble </strong></p>	
	
	<!-- Dribbble Profile: Text Input -->
	<p>
		<label for="<?php echo $this->get_field_id( 'dribbbleprofile' ); ?>"><?php _e('Dribbble Username:', 'prostore-theme') ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'dribbbleprofile' ); ?>" name="<?php echo $this->get_field_name( 'dribbbleprofile' ); ?>" value="<?php echo $instance['dribbbleprofile']; ?>" />
	</p>

	<p>
		<label for="<?php echo $this->get_field_id( 'dribbbleaction' ); ?>"><?php _e('Action Link Text:', 'prostore-theme') ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'dribbbleaction' ); ?>" name="<?php echo $this->get_field_name( 'dribbbleaction' ); ?>" value="<?php echo $instance['dribbbleaction']; ?>" />
	</p>
 			
	<?php
	}
}

/*----------------------------------------------------------------------------------*/
/*	Twitter Followers Count/ Works with the social counter widget
/*-----------------------------------------------------------------------------------*/

function twitter_followers_counter($username) {
 
	$cache_file = CACHEDIR . 'twitter_followers_counter_' . md5 ( $username );
	 
	if (is_file ( $cache_file ) == false) {
		$cache_file_time = strtotime ( '1984-01-11 07:15' );
	} else {
		$cache_file_time = filemtime ( $cache_file );
	}
	 
	$now = strtotime ( date ( 'Y-m-d H:i:s' ) );
	$api_call = $cache_file_time;
	$difference = $now - $api_call;
	$api_time_seconds = 1800;
	 
	if ($difference >= $api_time_seconds) {
	$api_page = 'http://twitter.com/users/show/' . $username;
	$xml = file_get_contents ( $api_page );
	 
	$profile = new SimpleXMLElement ( $xml );
	$count = $profile->followers_count;
	if (is_file ( $cache_file ) == true) {
	unlink ( $cache_file );
	}
	touch ( $cache_file );
	file_put_contents ( $cache_file, strval ( $count ) );
	return strval ( $count );
	} else {
	$count = file_get_contents ( $cache_file );
	return strval ( $count );
	}
}


register_widget( 'Widget_Social_Counter' );
<?php
 
class SocialWidget extends WP_Widget {
    function SocialWidget() {
        parent::WP_Widget(false, $name = 'Skeleton Social');	
    }


// This is the Social Widget for SideWinder. There are 17 pre-packaged Social Media Links... but you don't need to use them all.
// To add additional links, you'll need to add 5 new lines of code for each new social media link. I've numbered them below for you...
// Review the code below to see where to add each of the 5 new lines - it should be as simple as adding it to the end of each list with your new social media text.
// There are a bunch of 16x16 icons pre-packaged in the theme inside the /assets/img/social folder that you can use.


// 1. Call up the social-link instances for the front-end.

    function widget($args, $instance) {		
        extract( $args );        
        
        $delicious = apply_filters('widget_title', $instance['delicious']);
        $deviantart = apply_filters('widget_title', $instance['deviantart']);
        $email = apply_filters('widget_title', $instance['email']);
        $facebook = apply_filters('widget_title', $instance['facebook']);
        $flickr = apply_filters('widget_title', $instance['flickr']);
        $linkedin = apply_filters('widget_title', $instance['linkedin']);
        $myspace = apply_filters('widget_title', $instance['myspace']);
        $netvibes = apply_filters('widget_title', $instance['netvibes']);
        $reddit = apply_filters('widget_title', $instance['reddit']);
        $rss = apply_filters('widget_title', $instance['rss']);
        $skype = apply_filters('widget_title', $instance['skype']);
        $tumblr = apply_filters('widget_title', $instance['tumblr']);
        $twitter = apply_filters('widget_title', $instance['twitter']);
        $stumbleupon = apply_filters('widget_title', $instance['stumbleupon']);
        $vimeo = apply_filters('widget_title', $instance['vimeo']);
        $youtube = apply_filters('widget_title', $instance['youtube']);
        
        ?>
              <?php echo $before_widget; ?>
                  
<p class="social">
					    		
<?php // 2. HTML SECTION - This is where the order of the icons is set for the actual front-end rendering on the website - cut/paste each line if you want to change the order. 

$WP_THEME_URL = WP_THEME_URL; ?>

<?php if ( $delicious ) echo "<a href=\"$instance[delicious]\" title=\"Delicious Profile\"><img src=\"$WP_THEME_URL/assets/images/theme/social-icons/delicious_16.png\" alt=\"Delicious\" /></a> "; ?>
<?php if ( $deviantart ) echo "<a href=\"$instance[deviantart]\" title=\"deviantArt Profile\"><img src=\"$WP_THEME_URL/assets/images/theme/social-icons/deviantart_16.png\" alt=\"DeviantArt\"/></a> "; ?>
<?php if ( $email ) echo "<a href=\"$instance[email]\" title=\"Email Address\"><img src=\"$WP_THEME_URL/assets/images/theme/social-icons/email_16.png\" alt=\"Email\"/></a> "; ?>
<?php if ( $facebook ) echo "<a href=\"$instance[facebook]\" title=\"Facebook Profile\"><img src=\"$WP_THEME_URL/assets/images/theme/social-icons/facebook_16.png\" alt=\"Facebook\"/></a> "; ?>
<?php if ( $flickr ) echo "<a href=\"$instance[flickr]\" title=\"Flickr Profile\"><img src=\"$WP_THEME_URL/assets/images/theme/social-icons/flickr_16.png\" alt=\"Flickr\"/></a> "; ?>
<?php if ( $linkedin ) echo "<a href=\"$instance[linkedin]\" title=\"LinkedIn Profile\"><img src=\"$WP_THEME_URL/assets/images/theme/social-icons/linkedin_16.png\" alt=\"LinkedIn\"/></a> "; ?>
<?php if ( $myspace ) echo "<a href=\"$instance[myspace]\" title=\"MySpace Profile\"><img src=\"$WP_THEME_URL/assets/images/theme/social-icons/myspace_16.png\" alt=\"MySpace\"/></a> "; ?>
<?php if ( $netvibes ) echo "<a href=\"$instance[netvibes]\" title=\"NetVibes Profile\"><img src=\"$WP_THEME_URL/assets/images/theme/social-icons/netvibes_16.png\" alt=\"NetVibes\"/></a> "; ?>
<?php if ( $reddit ) echo "<a href=\"$instance[reddit]\" title=\"Reddit Profile\"><img src=\"$WP_THEME_URL/assets/images/theme/social-icons/reddit_16.png\" alt=\"Reddit\"/></a> "; ?>
<?php if ( $rss ) echo "<a href=\"$instance[rss]\" title=\"RSS Profile\"><img src=\"$WP_THEME_URL/assets/images/theme/social-icons/rss_16.png\" alt=\"RSS\"/></a> "; ?>
<?php if ( $skype ) echo "<a href=\"$instance[skype]\" title=\"Skype Profile\"><img src=\"$WP_THEME_URL/assets/images/theme/social-icons/skype_16.png\" alt=\"Skype\"/></a> "; ?>
<?php if ( $tumblr ) echo "<a href=\"$instance[tumblr]\" title=\"Tumblr Profile\"><img src=\"$WP_THEME_URL/assets/images/theme/social-icons/tumblr_16.png\" alt=\"Tumblr\"/></a> "; ?>
<?php if ( $twitter ) echo "<a href=\"$instance[twitter]\" title=\"Twitter Profile\"><img src=\"$WP_THEME_URL/assets/images/theme/social-icons/twitter_16.png\" alt=\"Twitter\"/></a> "; ?>
<?php if ( $stumbleupon ) echo "<a href=\"$instance[stumbleupon]\" title=\"StumbleUpon Profile\"><img src=\"$WP_THEME_URL/assets/images/theme/social-icons/stumbleupon_16.png\" alt=\"StumbleUpon\"/></a> "; ?>
<?php if ( $vimeo ) echo "<a href=\"$instance[vimeo]\" title=\"Vimeo Profile\"><img src=\"$WP_THEME_URL/assets/images/theme/social-icons/vimeo_16.png\" alt=\"Vimeo\"/></a> "; ?>
<?php if ( $youtube ) echo "<a href=\"$instance[youtube]\" title=\"YouTube Profile\"><img src=\"$WP_THEME_URL/assets/images/theme/social-icons/youtube_16.png\" alt=\"YouTube\"/></a> "; ?>
					    		
</p>

              <?php echo $after_widget; ?>
        <?php
    }


// 3. This is where we're creating new instances for each social-link to be used on the backend. 

    function update($new_instance, $old_instance) {				
		$instance = $old_instance;		
		$instance['delicious'] 		= strip_tags($new_instance['delicious']);
		$instance['deviantart'] 	= strip_tags($new_instance['deviantart']);
		$instance['email'] 			= strip_tags($new_instance['email']);
		$instance['facebook'] 		= strip_tags($new_instance['facebook']);
		$instance['flickr'] 		= strip_tags($new_instance['flickr']);
		$instance['linkedin'] 		= strip_tags($new_instance['linkedin']);
		$instance['myspace'] 		= strip_tags($new_instance['myspace']);
		$instance['netvibes'] 		= strip_tags($new_instance['netvibes']);
		$instance['reddit'] 		= strip_tags($new_instance['reddit']);
		$instance['rss'] 			= strip_tags($new_instance['rss']);
		$instance['skype'] 			= strip_tags($new_instance['skype']);
		$instance['tumblr'] 		= strip_tags($new_instance['tumblr']);
		$instance['twitter'] 		= strip_tags($new_instance['twitter']);
		$instance['stumbleupon'] 	= strip_tags($new_instance['stumbleupon']);
		$instance['vimeo'] 			= strip_tags($new_instance['vimeo']);
		$instance['youtube'] 		= strip_tags($new_instance['youtube']);
		
        return $instance;
    }


// 4. Grab the instances for each social-link and prep them for use.

    function form($instance) {			

        $delicious = esc_attr($instance['delicious']);
        $deviantart = esc_attr($instance['deviantart']);
        $email = esc_attr($instance['email']);
        $facebook = esc_attr($instance['facebook']);
        $flickr = esc_attr($instance['flickr']);
        $linkedin = esc_attr($instance['linkedin']);
        $myspace = esc_attr($instance['myspace']);
        $netvibes = esc_attr($instance['netvibes']);
        $reddit = esc_attr($instance['reddit']);
        $rss = esc_attr($instance['rss']);
        $skype = esc_attr($instance['skype']);
        $tumblr = esc_attr($instance['tumblr']);
        $twitter = esc_attr($instance['twitter']);
        $stumbleupon = esc_attr($instance['stumbleupon']);
        $vimeo = esc_attr($instance['vimeo']);
        $youtube = esc_attr($instance['youtube']);        
        
        
// 5. This builds the form for the actual widget menu. 

        ?>
              
        <p><small>Enter a URL in each field. Only filled in fields will show up.</small></p>
        	 
            <p><label for="<?php echo $this->get_field_id('delicious'); ?>"><?php _e('Delicious:', 'skeleton'); ?> 
            <input class="widefat" id="<?php echo $this->get_field_id('delicious'); ?>" name="<?php echo $this->get_field_name('delicious'); ?>" type="text" value="<?php echo $delicious; ?>" /></label></p>
            
            <p><label for="<?php echo $this->get_field_id('deviantart'); ?>"><?php _e('DeviantArt:', 'skeleton'); ?> 
            <input class="widefat" id="<?php echo $this->get_field_id('deviantart'); ?>" name="<?php echo $this->get_field_name('deviantart'); ?>" type="text" value="<?php echo $deviantart; ?>" /></label></p>
            
            <p><label for="<?php echo $this->get_field_id('email'); ?>"><?php _e('Email:', 'skeleton'); ?> 
            <input class="widefat" id="<?php echo $this->get_field_id('email'); ?>" name="<?php echo $this->get_field_name('email'); ?>" type="text" value="<?php echo $email; ?>" /></label></p>
            
            <p><label for="<?php echo $this->get_field_id('facebook'); ?>"><?php _e('Facebook:', 'skeleton'); ?> 
            <input class="widefat" id="<?php echo $this->get_field_id('facebook'); ?>" name="<?php echo $this->get_field_name('facebook'); ?>" type="text" value="<?php echo $facebook; ?>" /></label></p>
            
            <p><label for="<?php echo $this->get_field_id('flickr'); ?>"><?php _e('Flickr:', 'skeleton'); ?> 
            <input class="widefat" id="<?php echo $this->get_field_id('flickr'); ?>" name="<?php echo $this->get_field_name('flickr'); ?>" type="text" value="<?php echo $flickr; ?>" /></label></p>
            
            <p><label for="<?php echo $this->get_field_id('linkedin'); ?>"><?php _e('LinkedIn:', 'skeleton'); ?> 
            <input class="widefat" id="<?php echo $this->get_field_id('linkedin'); ?>" name="<?php echo $this->get_field_name('linkedin'); ?>" type="text" value="<?php echo $linkedin; ?>" /></label></p>
            
            <p><label for="<?php echo $this->get_field_id('myspace'); ?>"><?php _e('MySpace:', 'skeleton'); ?> 
            <input class="widefat" id="<?php echo $this->get_field_id('myspace'); ?>" name="<?php echo $this->get_field_name('myspace'); ?>" type="text" value="<?php echo $myspace; ?>" /></label></p>
            
            <p><label for="<?php echo $this->get_field_id('netvibes'); ?>"><?php _e('NetVibes:', 'skeleton'); ?> 
            <input class="widefat" id="<?php echo $this->get_field_id('netvibes'); ?>" name="<?php echo $this->get_field_name('netvibes'); ?>" type="text" value="<?php echo $netvibes; ?>" /></label></p>
            
            <p><label for="<?php echo $this->get_field_id('reddit'); ?>"><?php _e('Reddit:', 'skeleton'); ?> 
            <input class="widefat" id="<?php echo $this->get_field_id('reddit'); ?>" name="<?php echo $this->get_field_name('reddit'); ?>" type="text" value="<?php echo $reddit; ?>" /></label></p>
            
            <p><label for="<?php echo $this->get_field_id('rss'); ?>"><?php _e('RSS:', 'skeleton'); ?> 
            <input class="widefat" id="<?php echo $this->get_field_id('rss'); ?>" name="<?php echo $this->get_field_name('rss'); ?>" type="text" value="<?php echo $rss; ?>" /></label></p>
            
            <p><label for="<?php echo $this->get_field_id('skype'); ?>"><?php _e('Skype:', 'skeleton'); ?> 
            <input class="widefat" id="<?php echo $this->get_field_id('skype'); ?>" name="<?php echo $this->get_field_name('skype'); ?>" type="text" value="<?php echo $skype; ?>" /></label></p>
            
            <p><label for="<?php echo $this->get_field_id('tumblr'); ?>"><?php _e('Tumblr:', 'skeleton'); ?> 
            <input class="widefat" id="<?php echo $this->get_field_id('tumblr'); ?>" name="<?php echo $this->get_field_name('tumblr'); ?>" type="text" value="<?php echo $tumblr; ?>" /></label></p>
            
            <p><label for="<?php echo $this->get_field_id('twitter'); ?>"><?php _e('Twitter:', 'skeleton'); ?> 
            <input class="widefat" id="<?php echo $this->get_field_id('twitter'); ?>" name="<?php echo $this->get_field_name('twitter'); ?>" type="text" value="<?php echo $twitter; ?>" /></label></p>
            
            <p><label for="<?php echo $this->get_field_id('stumbleupon'); ?>"><?php _e('StumbleUpon:', 'skeleton'); ?> 
            <input class="widefat" id="<?php echo $this->get_field_id('stumbleupon'); ?>" name="<?php echo $this->get_field_name('stumbleupon'); ?>" type="text" value="<?php echo $stumbleupon; ?>" /></label></p>
            
            <p><label for="<?php echo $this->get_field_id('vimeo'); ?>"><?php _e('Vimeo:', 'skeleton'); ?> 
            <input class="widefat" id="<?php echo $this->get_field_id('vimeo'); ?>" name="<?php echo $this->get_field_name('vimeo'); ?>" type="text" value="<?php echo $vimeo; ?>" /></label></p>
            
            <p><label for="<?php echo $this->get_field_id('youtube'); ?>"><?php _e('YouTube:', 'skeleton'); ?> 
            <input class="widefat" id="<?php echo $this->get_field_id('youtube'); ?>" name="<?php echo $this->get_field_name('youtube'); ?>" type="text" value="<?php echo $youtube; ?>" /></label></p>
            
        <?php 
    }

} 

?>
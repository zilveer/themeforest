<?php
class ocmx_twitter_widget extends WP_Widget {
    /** constructor */
    function ocmx_twitter_widget() {
        parent::WP_Widget(false, $name = __('(Obox) Twitter Stream', 'ocmx'), $widget_options = __('Display your latest Tweets.','ocmx'));	
    }

    /** @see WP_Widget::widget */
    function widget($args, $instance) {		
        extract( $args );
		// Turn $instance array into variables
        $instance_defaults = array ( 'title' => '', 'twitter_id' => '', 'twitter_count' => 1, 'twitter_theme' => 'light', 'twitter_replies' => false, 'twitter_height' => 220, 'twitter_links' => '#555', 'twitter_widget_id' => '');
        $instance_args = wp_parse_args( $instance, $instance_defaults );
        extract( $instance_args, EXTR_SKIP ); 
		
		echo $before_widget; ?>
			<?php echo $before_title; 
					if(isset($title) && $title !=""):
						echo $title;
					endif;
            	echo $after_title; ?>
			<a class="twitter-timeline obox-timeline" 
                href="https://twitter.com/<?php echo $twitter_id; ?>" 
                data-screen-name="<?php echo $twitter_id; ?>"
                data-theme="<?php echo $twitter_theme; ?>" 
                data-link-color="<?php echo $twitter_links; ?>"
                data-chrome="noheader nofooter transparent noborders noscrollbar"
                data-tweet-limit="<?php echo $twitter_count; ?>" 
                data-show-replies="<?php echo $twitter_replies; ?>"
                width="230" 
                height="<?php echo $twitter_height; ?>"
                aria-polite="polite"
                data-widget-id="<?php echo $twitter_widget_id; ?>">
            </a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>


            
			
 
        <?php echo $after_widget;
    }

    /** @see WP_Widget::update */
    function update($new_instance, $old_instance) {
        return $new_instance;
    }

    /** @see WP_Widget::form */
    function form($instance) {				
        // Turn $instance array into variables
        $instance_defaults = array ( 'title' => '', 'twitter_id' => '', 'twitter_count' => 1, 'twitter_theme' => 'light', 'twitter_replies' => false, 'twitter_height' => 220, 'twitter_links' => '#555', 'twitter_widget_id' => '');
        $instance_args = wp_parse_args( $instance, $instance_defaults );
        extract( $instance_args, EXTR_SKIP ); ;
		
        ?>
        
            <p><label for="<?php echo $this->get_field_id('title'); ?>">Title<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php if(isset($title)){ echo $title; }?>" /></label></p>
            <p><label for="<?php echo $this->get_field_id('twitter_id'); ?>">Twitter ID(without @)<input class="widefat" id="<?php echo $this->get_field_id('twitter_id'); ?>" name="<?php echo $this->get_field_name('twitter_id'); ?>" type="text" value="<?php if(isset($twitter_id)){ echo $twitter_id;} ?>" /></label></p>
            <p><small>1. Go to <a href="https://twitter.com/settings/widgets" target="_blank">your Twitter widget page</a>, click Create New, then Create Widget.</small><p>
        	<p><small>2. Copy the numeric ID from the address bar URL and paste it below. ie https://twitter.com/settings/widgets/<strong>344941445658050562</strong></small></p>
            <p><label for="<?php echo $this->get_field_id('twitter_widget_id'); ?>">Twitter Widget ID<input class="widefat" id="<?php echo $this->get_field_id('twitter_widget_id'); ?>" name="<?php echo $this->get_field_name('twitter_widget_id'); ?>" type="text" value="<?php if(isset($twitter_widget_id)){ echo $twitter_widget_id;} ?>" /></label></br>
            </p>
			<p>
            	<label for="<?php echo $this->get_field_id('twitter_count'); ?>">Tweet Count
                <select size="1" class="widefat" id="<?php echo $this->get_field_id('twitter_count'); ?>" name="<?php echo $this->get_field_name('twitter_count'); ?>">
                    <option <?php if($twitter_count == "1") : ?>selected="selected"<?php endif; ?> value="1">1</option>
                    <option <?php if($twitter_count == "2") : ?>selected="selected"<?php endif; ?> value="2">2</option>
                    <option <?php if($twitter_count == "3") : ?>selected="selected"<?php endif; ?> value="3">3</option>
                    <option <?php if($twitter_count == "4") : ?>selected="selected"<?php endif; ?> value="4">4</option>
                    <option <?php if($twitter_count == "6") : ?>selected="selected"<?php endif; ?> value="6">6</option>
                    <option <?php if($twitter_count == "8") : ?>selected="selected"<?php endif; ?> value="8">8</option>
                    <option <?php if($twitter_count == "10") : ?>selected="selected"<?php endif; ?> value="10">10</option>
                </select>
			</p>
            <p>
				<label for="<?php echo $this->get_field_id('twitter_replies'); ?>">Show @Replies?</label>
				<select size="1" class="widefat" id="<?php echo $this->get_field_id('twitter_replies'); ?>" name="<?php echo $this->get_field_name('twitter_replies'); ?>">
					<option <?php if($twitter_replies == "true") : ?>selected="selected"<?php endif; ?> value="true">Yes</option>
					<option <?php if($twitter_replies == "false") : ?>selected="selected"<?php endif; ?> value="false">No</option>
				</select>
			</p>
            <p>
				<label for="<?php echo $this->get_field_id('twitter_theme'); ?>">Theme</label>
				<select size="1" class="widefat" id="<?php echo $this->get_field_id('twitter_theme'); ?>" name="<?php echo $this->get_field_name('twitter_theme'); ?>">
					<option <?php if($twitter_theme == "light") : ?>selected="selected"<?php endif; ?> value="light">Light</option>
					<option <?php if($twitter_theme == "dark") : ?>selected="selected"<?php endif; ?> value="dark">Dark</option>
				</select>
			</p>
			<p><label for="<?php echo $this->get_field_id('twitter_links'); ?>">Tweet Link Color<input class="widefat" id="<?php echo $this->get_field_id('twitter_links'); ?>" name="<?php echo $this->get_field_name('twitter_links'); ?>" type="text" value="<?php if(isset($twitter_id)){ echo $twitter_links;} ?>" /></label>
            <small><?php _e("Enter the HTML color code for your desired link color, ie #000000. Default is Twitter Blue.", "ocmx"); ?></small>
            </p>
            <p><label for="<?php echo $this->get_field_id('twitter_height'); ?>">Max Widget Height<input class="widefat" id="<?php echo $this->get_field_id('twitter_height'); ?>" name="<?php echo $this->get_field_name('twitter_height'); ?>" type="text" value="<?php if(isset($twitter_height)) {echo $twitter_height;} ?>" /></label>
            <small><?php _e("Enter the maximum height in pixels for the widget to adjust for the number of tweets, ie 300.", "ocmx"); ?></small>
            </p>
            
        <?php 
    }

} // class FooWidget

//This sample widget can then be registered in the widgets_init hook:

// register FooWidget widget
add_action('widgets_init', create_function('', 'return register_widget("ocmx_twitter_widget");'));
?>
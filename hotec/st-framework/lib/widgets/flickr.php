<?php


class STFlickrWidget extends WP_Widget {
         function STFlickrWidget() {
         
            $widget_ops = array('classname' => 'widget-flickr', 
                                'description' => 'Flickr gallery widget.' );
            $this->WP_Widget('STFlickrWidget', 'ST Flickr Gallery', $widget_ops);
         }
          
         function widget($args, $instance) {
            // prints the widget
            extract($args);
            
            //variables from widget setting
            $title = apply_filters('widget_title', $instance['title']);
            $flickrID = $instance['flickrID'];
    		$postcount = $instance['postcount'];
    		$display = $instance['display'];
            $type = $instance['type'];
            
            if($postcount<=0){
                $postcount =4;
            }

            // Before Widget :
            echo $before_widget;
            
            // Display Widget Title if one was input .
            if($title)
                echo $before_title;
            
                 echo $title.$after_title; // Before_title and After_title define by theme .
                
            // Display
                echo '<div class="flickr">'; // Containing DIV
                ?>
                    <script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?count=<?php echo $postcount ?>&amp;display=<?php echo $display ?>&amp;size=s&amp;layout=x&amp;source=<?php echo $type ?>&amp;<?php echo $type ?>=<?php echo $flickrID ?>"></script>
                <?php
                echo '<div class="clear"></div></div>'; // end Containing DIV
            
            // After Widget
            echo $after_widget;
         }
          
         function update($new_instance, $old_instance) {
            //save the widget
            $instance = $old_instance;
            
            // Only text inputs
            $instance['title'] = strip_tags($new_instance['title']);
            
            $instance['flickrID'] = strip_tags( $new_instance['flickrID'] );
    		$instance['postcount'] = $new_instance['postcount'];
    		$instance['display'] = $new_instance['display'];
            $instance['type'] = $new_instance['type'];
            
            return $instance;
         }
          
         function form($instance) {
            //widgetform in backend
                
            //default widget settings.
            $defaults_setting = array(
                'title' => 'Gallery',
                'flickrID' => '66728171@N00',
                'postcount' => '4',
                'display' => 'random',
                'type' => 'user',
            );
            $instance = wp_parse_args( (array) $instance, $defaults_setting );
            ?>
            
            <!-- Widget Title -->
            <p>
                <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:','smooththemes') ?></label>
			    <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
            </p>
            
            <!-- Flickr ID -->
    		<p>
    			<label for="<?php echo $this->get_field_id( 'flickrID' ); ?>"><?php _e('Flickr ID:', 'smooththemes') ?> (<a href="http://idgettr.com/">idGettr</a>)</label>
    			<input class="widefat" id="<?php echo $this->get_field_id( 'flickrID' ); ?>" name="<?php echo $this->get_field_name( 'flickrID' ); ?>" value="<?php echo $instance['flickrID']; ?>" />
    		</p>
    		
    		<!-- Postcount -->
    		<p>
    			<label for="<?php echo $this->get_field_id( 'postcount' ); ?>"><?php _e('Number of Photos:', 'smooththemes') ?></label>
    			<select id="<?php echo $this->get_field_id( 'postcount' ); ?>" name="<?php echo $this->get_field_name( 'postcount' ); ?>" class="widefat">
    			     <?php for($i=2; $i<=10; $i+=2) : ?>
                    	<option <?php if ( $i == $instance['postcount'] ) echo 'selected="selected"'; ?>><?php echo $i; ?></option>
    			     <?php endfor; ?>
    			</select>
    		</p>
    		
    		<!-- Display -->
    		<p>
    			<label for="<?php echo $this->get_field_id( 'display' ); ?>"><?php _e('Display (random or latest):', 'smooththemes') ?></label>
    			<select id="<?php echo $this->get_field_id( 'display' ); ?>" name="<?php echo $this->get_field_name( 'display' ); ?>" class="widefat">
    				<option <?php if ( 'random' == $instance['display'] ) echo 'selected="selected"'; ?>>random</option>
    				<option <?php if ( 'latest' == $instance['display'] ) echo 'selected="selected"'; ?>>latest</option>
    			</select>
    		</p>
            
            <!-- Type -->
    		<p>
    			<label for="<?php echo $this->get_field_id( 'type' ); ?>"><?php _e('Type (user or group):', 'smooththemes') ?></label>
    			<select id="<?php echo $this->get_field_id( 'type' ); ?>" name="<?php echo $this->get_field_name( 'type' ); ?>" class="widefat">
    				<option <?php if ( 'user' == $instance['type'] ) echo 'selected="selected"'; ?>>user</option>
    				<option <?php if ( 'group' == $instance['type'] ) echo 'selected="selected"'; ?>>group</option>
    			</select>
    		</p>
                
         <?php   
         }
     }
     
    
register_widget( 'STFlickrWidget' );
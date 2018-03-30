<?php
class mtheme_Social_Widget extends WP_Widget {
	function mtheme_Social_Widget() {
		$widget_ops = array( 'classname' => 'MSocial_Widget', 'description' => __('Generate social icons', 'mthemelocal') );
		$control_ops = array('width' => 600, 'height' => 350);
		$this->WP_Widget( 'msocial-widget', MTHEME_NAME . __(' - Social Widget', 'mthemelocal'), $widget_ops,$control_ops);
	}

	function widget( $args, $instance ) {
		extract( $args );
	
		$title = apply_filters('widget_title', $instance['title'] );
		$text = apply_filters( 'widget_text', $instance['text'], $instance );
		$imgcaption = $instance['imgcaption'];
		$call_us = $instance['call_us'];
		$call_us_link = $instance['call_us_link'];	

		$icon_size = $instance['icon_size'];
		$animation = $instance['animation'];
		$icon_opacity = $instance['icon_opacity'];
		$newtab = $instance['newtab'];
		$nofollow = $instance['nofollow'];
		$alignment = $instance['alignment'];
		
		for ($social_count=1; $social_count <=20; $social_count++ ) {
		
		$customicon[$social_count] = $instance['custom'.$social_count.'icon'];
		$customname[$social_count] = $instance['custom'.$social_count.'name'];
		$customurl[$social_count] = $instance['custom'.$social_count.'url'];
		
		}
		
	
		if($icon_size == 'default') {
			$icon_size = '16';
		}
		
		$icon_opacity = '0.9';
		$icon_ie = $icon_opacity * 100;
		$nofollow = '';
		if ($newtab == 'yes') {
			$newtab = "target=\"_blank\"";
			} else {
			$newtab = '';
			}
		$alignment = 'socialwidget_center';

		echo $before_widget;

		if ( $title )
			echo $before_title . $title . $after_title;
		
		
		
		echo "<div class=\"socialmedia-buttons social-size-".$icon_size. " " .$alignment."\">";
		
		if ( $text )
			echo "<div class=\"socialmedia-text\>" . $instance['filter'] ? wpautop($text) : $text . '</div>';
			
		// Call us
		if ( $call_us != '' && $call_us != ' ' ) {
			?>
			<div class="social_contact_text">
			<?php if ($call_us_link<>"") { echo '<a href="'.$call_us_link.'">'; }?>
			<?php echo $call_us; ?>
			<?php if ($call_us_link<>"") { echo '</a>'; }?>
			</div>
			<?php
		}
		
		for ($social_count=1; $social_count <=20; $social_count++ ) {
			// Custom Icon 1
			if ( $customurl[$social_count] != '' && $customname[$social_count] != '' && $customicon[$social_count] != '' ) {
				?><a class="qtips" original-title="<?php echo $customname[$social_count]; ?>" href="<?php echo $customurl[$social_count]; ?>" <?php echo $nofollow; ?> <?php echo $newtab; ?>><img src="<?php echo $customicon[$social_count]; ?>" alt="<?php echo $imgcaption; ?> <?php echo $customname[$social_count]; ?>" <?php if($animation == 'fade' || $animation == 'combo') { ?> style="opacity: <?php echo $icon_opacity; ?>; -moz-opacity: <?php echo $icon_opacity;?>;" <?php } ?>class="<?php echo $animation; ?>" width="<?php echo $icon_size; ?>" height="<?php echo $icon_size; ?>" /></a><?php
			} else {
				echo ''; //If no URL inputed
			}
		
		}		
		/* After widget (defined by themes). */
		echo "</div>";
		
		echo $after_widget;
	}

	/* Update the widget settings  */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip Tags For Text Boxes */
		$instance['title'] = strip_tags( $new_instance['title'] );
		if ( current_user_can('unfiltered_html') )
			$instance['text'] =  $new_instance['text'];
		else
			$instance['text'] = stripslashes( wp_filter_post_kses( addslashes($new_instance['text']) ) ); // wp_filter_post_kses() expects slashed
		$instance['imgcaption'] = $new_instance['imgcaption'];
		$instance['icon_size'] = $new_instance['icon_size'];
		$instance['animation'] = $new_instance['animation'];
		$instance['icon_opacity'] = $new_instance['icon_opacity'];
		$instance['newtab'] = $new_instance['newtab'];
		$instance['nofollow'] = $new_instance['nofollow'];
		$instance['alignment'] = $new_instance['alignment'];
		$instance['call_us'] = strip_tags( $new_instance['call_us'] );
		$instance['call_us_link'] = strip_tags( $new_instance['call_us_link'] );
		
		for ($social_count=1; $social_count <=20; $social_count++ ) {
		
		$instance['custom'.$social_count.'name'] = strip_tags( $new_instance['custom'.$social_count.'name'] );
		$instance['custom'.$social_count.'icon'] = strip_tags( $new_instance['custom'.$social_count.'icon'] );
		$instance['custom'.$social_count.'url'] = strip_tags( $new_instance['custom'.$social_count.'url'] );
		
		}
		
		
		return $instance;
	}

	function form( $instance ) {

		$defaults = array( 
			'title' => __('Follow Us!', 'mthemelocal'),
			'text' => '',
			'imgcaption' => __('Follow Us on', 'mthemelocal'), 
			'icon_size' => 'default',
			'icon_opacity' => 'default',
			'newtab' => 'yes',
			'nofollow' => 'on',
			'alignment' => 'center',
			'call_us' => '',
			'call_us_link' => '',
			'custom1name' => '',
			'custom1icon' => '',
			'custom1url' => '',
			'custom2name' => '',
			'custom2icon' => '',
			'custom2url' => '',
			'custom3name' => '',
			'custom3icon' => '',
			'custom3url' => '',
			'custom4name' => '',
			'custom4icon' => '',
			'custom4url' => '',
			'custom5name' => '',
			'custom5icon' => '',
			'custom5url' => '',
			'custom6name' => '',
			'custom6icon' => '',
			'custom6url' => '');
			
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
	
		<div>
		<h2>Social Settings</h2>

		
		<!-- Choose Icon Size: Dropdown -->
		<p>
			<label for="<?php echo $this->get_field_id( 'icon_size' ); ?>"><?php _e('Icon Size', 'mthemelocal'); ?></label><br />
			<select class="widefat" id="<?php echo $this->get_field_id( 'icon_size' ); ?>" name="<?php echo $this->get_field_name( 'icon_size' ); ?>">
			<option value="default" <?php if($instance['icon_size'] == 'default') { echo 'selected'; } ?>>Default 16px</option>
			<option value="32" <?php if($instance['icon_size'] == '32') { echo 'selected'; } ?>>32px</option>

			</select>
		</p>
		
	<!-- Type of Animation: Dropdown -->
		<p>
			<label for="<?php echo $this->get_field_id( 'animation' ); ?>"><?php _e('Type of Animation', 'mthemelocal'); ?></label><br />
			<select class="widefat" id="<?php echo $this->get_field_id( 'animation' ); ?>" name="<?php echo $this->get_field_name( 'animation' ); ?>">
			<option value="fade" <?php if($instance['animation'] == 'fade') { echo 'selected'; } ?>>Fade In</option>
			<option value="scale" <?php if($instance['animation'] == 'scale') { echo 'selected'; } ?>>Scale</option>
			<option value="bounce" <?php if($instance['animation'] == 'bounce') { echo 'selected'; } ?>>Bounce</option>
			<option value="combo" <?php if($instance['animation'] == 'combo') { echo 'selected'; } ?>>Combo</option>
			</select>
		</p>

		<!-- Open in new tab: Dropdown -->
		<p>
			<label for="<?php echo $this->get_field_id( 'newtab' ); ?>"><?php _e('Open in new tab?', 'mthemelocal'); ?></label><br />
			<select class="widefat" id="<?php echo $this->get_field_id( 'newtab' ); ?>" name="<?php echo $this->get_field_name( 'newtab' ); ?>">
			<option value="yes" <?php if($instance['newtab'] == 'yes') { echo 'selected'; } ?>>Yes</option>
			<option value="no" <?php if($instance['newtab'] == 'no') { echo 'selected'; } ?>>No</option>
			</select>
		</p>

		
		<h2>Contact Text</h2>
		<p>Fill this with any contact info you like. eg. Call us: +123 456 7890</p>
		<!-- Call us -->
		<p>
			<label for="<?php echo $this->get_field_id( 'call_us' ); ?>"><?php _e('Contact text:', 'mthemelocal'); ?></label><br />
			<input class="widefat" id="<?php echo $this->get_field_id( 'call_us' ); ?>" name="<?php echo $this->get_field_name( 'call_us' ); ?>" value="<?php echo $instance['call_us']; ?>" />
		</p>
		<!-- Call us link -->
		<p>
			<label for="<?php echo $this->get_field_id( 'call_us_link' ); ?>"><?php _e('Contact text link:', 'mthemelocal'); ?></label><br />
			<input class="widefat" id="<?php echo $this->get_field_id( 'call_us_link' ); ?>" name="<?php echo $this->get_field_name( 'call_us_link' ); ?>" value="<?php echo $instance['call_us_link']; ?>" />
		</p>		

		<h2>Social Links</h2>
		<!-- Custom Service 1: Text Input -->
		
		<?php
		for ($social_count=1; $social_count <=20; $social_count++ ) {
		?>
		<p>
			<strong><h2><?php echo $social_count; ?></h2>
			<label for="<?php echo $this->get_field_id( 'custom'.$social_count.'name' ); ?>"><?php _e('Social Name:', 'mthemelocal'); ?></strong></label><br />
			<input class="widefat" id="<?php echo $this->get_field_id( 'custom'.$social_count.'name' ); ?>" name="<?php echo $this->get_field_name( 'custom'.$social_count.'name' ); ?>" value="<?php echo $instance['custom'.$social_count.'name']; ?>" /><br />
			<label for="<?php echo $this->get_field_id( 'custom'.$social_count.'icon' ); ?>"><?php _e('Social Icon URL:', 'mthemelocal'); ?></label><br />
			<input class="widefat" id="<?php echo $this->get_field_id( 'custom'.$social_count.'icon' ); ?>" name="<?php echo $this->get_field_name( 'custom'.$social_count.'icon' ); ?>" value="<?php echo $instance['custom'.$social_count.'icon']; ?>" /><br />
			<label for="<?php echo $this->get_field_id( 'custom'.$social_count.'url' ); ?>"><?php _e('Social Profile URL:', 'mthemelocal'); ?></label><br />
			<input class="widefat" id="<?php echo $this->get_field_id( 'custom'.$social_count.'url' ); ?>" name="<?php echo $this->get_field_name( 'custom'.$social_count.'url' ); ?>" value="<?php echo $instance['custom'.$social_count.'url']; ?>" />
		</p>
		<?php
		}
		?>
		
		</div>
		

	<?php
	}
}
register_widget( 'mtheme_Social_Widget' );
?>

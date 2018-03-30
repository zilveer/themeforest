<?php
class Fables_Adboxes_Widget extends WP_Widget {
	function Fables_Adboxes_Widget() {
		$widget_ops = array('classname' => 'widget_fables_adboxes', 'description' => 'Display advertisements from your sidebar' );
		$this->WP_Widget('fables_adboxes', MTHEME_NAME . '- Sidebar Adboxes', $widget_ops);
	}

	function widget($args, $instance) {
		extract($args, EXTR_SKIP);
		
		
		$thumbsize_one=$instance['thumbsize_one'];
		$logo_one=$instance['logo1'];
		$link_one=$instance['link1'];
		
		$thumbsize_two=$instance['thumbsize_two'];
		$logo_two=$instance['logo2'];
		$link_two=$instance['link2'];

		
		echo $before_widget;
		$title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);

		if ( !empty( $title ) ) { echo $before_title . $title . $after_title; };
				
				if ($thumbsize_one<>"none") {
					echo '<div class="'.$thumbsize_one.'_advertisement">';
					if ( isset($logo_one) ) {
						if ( isset($link_one) ){
							echo '<a href="'.$link_one.'">';
						}
						
						echo '<img src="'.$logo_one.'" alt="logo" />';
						
						if ( isset($link_one) ){
							echo '</a>';
						}
					}
					echo '</div>';
				}
				
				
				if ($thumbsize_two<>"none") {
					echo '<div class="'.$thumbsize_two.'_advertisement">';
					if ( isset($logo_two) ) {
						if ( isset($link_two) ){
							echo '<a href="'.$link_two.'">';
						}
						
						echo '<img src="'.$logo_two.'" alt="logo" />';
						
						if ( isset($link_two) ){
							echo '</a>';
						}
					}
					echo '</div>';
				}
			?>
			<div class="clear"></div>
		<?php
		echo $after_widget;
	}

	function update($new_instance, $old_instance) {
		//$instance = $old_instance;
		//$instance['title'] = strip_tags($new_instance['title']);
		//$instance['clickaction'] = strip_tags($new_instance['clickaction']);
		return $new_instance;

		//return $instance;
	}

	function form($instance) {
	
		$thumbsize_one="";
		$thumbsize_two="";
	
		$instance = wp_parse_args( (array) $instance, array( 'title' => 'Advertisements' ) );
		$title = strip_tags($instance['title']);
		
		if (isset($instance['thumbsize_one'])) { $thumbsize_one=esc_attr($instance['thumbsize_one']); }
		if (isset($instance['thumbsize_two'])) { $thumbsize_two=esc_attr($instance['thumbsize_two']); }
		
	?>
	<p>
	<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','mthemelocal'); ?></label>
	<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
	</p>

		<p>
			
		<p>
			<label for="<?php echo $this->get_field_id('thumbsize_one'); ?>">
				<?php _e('Thumbnail Size:','mthemelocal'); ?>
			</label>
			<select id="<?php echo $this->get_field_id('thumbsize_one'); ?>" class="widefat" name="<?php echo $this->get_field_name('thumbsize_one'); ?>">
				<option value="none"<?php echo ($thumbsize_one === 'none' ? ' selected="selected"' : ''); ?>>Disable</option>
				<option value="small"<?php echo ($thumbsize_one === 'small' ? ' selected="selected"' : ''); ?>>125 x 125</option>
				<option value="big"<?php echo ($thumbsize_one === 'big' ? ' selected="selected"' : ''); ?>>250 x 250</option>
			</select>
		</p>
		
		<label for="<?php echo $this->get_field_id( 'logo1'); ?>"><?php _e('<small>Ad Image path</small>','mthemelocal'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'logo1'); ?>" name="<?php echo $this->get_field_name( 'logo1'); ?>" type="text" value="<?php if ( isset($instance['logo1']) ) { echo esc_attr($instance['logo1']); } ?>" />
	
		<label for="<?php echo $this->get_field_id( 'link1'); ?>"><?php _e('<small>Target Link</small>','mthemelocal'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'link1'); ?>" name="<?php echo $this->get_field_name( 'link1' ); ?>" type="text" value="<?php if ( isset($instance['link1']) ) { echo esc_attr($instance['link1']); } ?>" />
		
		</p>
		
		
		
		<p>
			
		<p>
			<label for="<?php echo $this->get_field_id('thumbsize_two'); ?>">
				<?php _e('Thumbnail Size:','mthemelocal'); ?>
			</label>
			<select id="<?php echo $this->get_field_id('thumbsize_two'); ?>" class="widefat" name="<?php echo $this->get_field_name('thumbsize_two'); ?>">
				<option value="none"<?php echo ($thumbsize_two === 'none' ? ' selected="selected"' : ''); ?>>Disable</option>
				<option value="small"<?php echo ($thumbsize_two === 'small' ? ' selected="selected"' : ''); ?>>125 x 125</option>
				<option value="big"<?php echo ($thumbsize_two === 'big' ? ' selected="selected"' : ''); ?>>250 x 250</option>
			</select>
		</p>
		
		<label for="<?php echo $this->get_field_id( 'logo2'); ?>"><?php _e('<small>Ad Image path</small>','mthemelocal'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'logo2'); ?>" name="<?php echo $this->get_field_name( 'logo2'); ?>" type="text" value="<?php if ( isset($instance['logo2']) ) { echo esc_attr($instance['logo2']); } ?>" />
	
		<label for="<?php echo $this->get_field_id( 'link2'); ?>"><?php _e('<small>Target Link</small>','mthemelocal'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'link2'); ?>" name="<?php echo $this->get_field_name( 'link2' ); ?>" type="text" value="<?php if ( isset($instance['link2']) ) { echo esc_attr($instance['link2']); } ?>" />
		
		</p>



	
<?php
	}
}
register_widget('Fables_Adboxes_Widget');
?>
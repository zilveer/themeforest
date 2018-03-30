<?php 

add_action('widgets_init','mom_ads_widget');

function mom_ads_widget() {
	register_widget('mom_ads_widget');
	
	}

class mom_ads_widget extends WP_Widget {
	function mom_ads_widget() {
			
		$widget_ops = array('classname' => 'momizat-ads','description' => __('Widget display any type of ads','theme'));
		parent::__construct('momizatAds',__('Effective - Ads','theme'),$widget_ops);

		}
		
	function widget( $args, $instance ) {
		extract( $args );
		/* User-selected settings. */
		$title = apply_filters('widget_title', $instance['title'] );
		$ad = $instance['ad'];
		$tr = isset($instance['tr']) ? $instance['tr'] : '';

		if ($tr != 'on') {
		/* Before widget (defined by themes). */
		echo $before_widget;

		/* Title of widget (before and after defined by themes). */
		if ( $title )
		echo $before_title . $title . $after_title;
		} else {
			echo '<div class="tr-ad-widget">';
		}
		echo do_shortcode('[ad id="'.$ad.'"]');

		if ($tr != 'on') {
		/* After widget (defined by themes). */
		echo $after_widget;
		} else {
			echo '</div>';
		}
		
	}
	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags (if needed) and update the widget settings. */
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['ad'] = $new_instance['ad'];
		$instance['tr'] = $new_instance['tr'];

		return $instance;
	}
	
function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 'title' => __('Advertising','theme'),
				  'tr' => ''
 			);
		$instance = wp_parse_args( (array) $instance, $defaults );
	
	$the_ad = isset($instance['ad']) ? $instance['ad'] : '';
	//get the ads
	$ads_obj = get_posts('post_type=ads&numberposts=-1');
		?>
	
		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'theme') ?></label>
		<input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>"  class="widefat" />
		</p>

	<p>
<label for="<?php echo $this->get_field_id( 'ad' ); ?>"><?php _e('type', 'theme') ?></label>
<select id="<?php echo $this->get_field_id( 'ad' ); ?>" name="<?php echo $this->get_field_name( 'ad' ); ?>" class="widefat">
	<?php
		foreach ($ads_obj as $ad) { 
	    echo '<option value="'.$ad->ID.'"'.selected($the_ad, $ad->ID).'>'.$ad->post_title.'</option>';
	    }

	?>
</select>
	</p>
        
		<p>
			<input class="checkbox" type="checkbox" <?php checked( $instance['tr'], 'on' ); ?> id="<?php echo $this->get_field_id( 'tr' ); ?>" name="<?php echo $this->get_field_name( 'tr' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'tr' ); ?>"><?php _e('Transparent background', 'theme'); ?></label>
		</p>
<?php 
}
	} //end class
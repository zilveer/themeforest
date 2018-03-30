<?php

// Advertisement 125 px
class Theme_Widget_Ads_125 extends WP_Widget {

	function theme_widget_ads_125() {
		$widget_ops = array('classname' => 'widget_ads_125', 'description' => __( 'List advertisement banners (125 x 125 px)',  'theme_admin' ) );
		$this->WP_Widget('ads-125', THEME_NAME.' - '.__('Advertisement', 'theme_admin').' 125', $widget_ops);
	}

	function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);

		$count = (int)$instance['count'];

		$output = '';
		if( $count > 0){
			for($i=1; $i<= $count; $i++){
				$image = isset($instance['ad_'.$i.'_image'])?$instance['ad_'.$i.'_image']:'';
				$link = isset($instance['ad_'.$i.'_link'])?$instance['ad_'.$i.'_link']:'';
				$target = isset($instance['ad_'.$i.'_target'])?$instance['ad_'.$i.'_target']:'_blank';
				if(empty($image)){
					$image = '';
				} else {
					$image = '<img src="'.$image.'" />';
				}
				$output .= '<div class="ads-banner"><a href="'.$link.'" rel="nofollow" target="'.$target.'">'.$image.'</a></div>';
			}
		}
		
		if ( !empty( $output ) ) {
			echo $before_widget;
			if ( $title )
				echo $before_title . $title . $after_title;
			echo $output;
			echo $after_widget;
		}
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['count'] = (int) $new_instance['count'];
		for ( $i=1;$i<=$instance['count'];$i++ ){
			$instance['ad_'.$i.'_image'] = strip_tags($new_instance['ad_'.$i.'_image']);
			$instance['ad_'.$i.'_link'] = strip_tags($new_instance['ad_'.$i.'_link']);
			$instance['ad_'.$i.'_target'] = strip_tags($new_instance['ad_'.$i.'_target']);
		}
		return $instance;
	}

	function form( $instance ) {
		$title = isset($instance['title']) ? esc_attr($instance['title']) : '';
		$count = isset($instance['count']) ? absint($instance['count']) : 4;
		for ( $i=1; $i<=10; $i++ ){
			$ad_image = 'ad_'.$i.'_image';
			$$ad_image = isset($instance[$ad_image]) ? $instance[$ad_image] : '';
			$ad_link = 'ad_'.$i.'_link';
			$$ad_link = isset($instance[$ad_link]) ? $instance[$ad_link] : '';
			$ad_target = 'ad_'.$i.'_target';
			$$ad_target = isset($instance[$ad_target]) ? $instance[$ad_target] : '';
		}
?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', 'theme_admin'); ?>:</label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>
		
		<p><label for="<?php echo $this->get_field_id('count'); ?>"><?php _e('How many advertisement to display?', 'theme_admin'); ?></label>
		<select id="<?php echo $this->get_field_id('count'); ?>" class="ads-count" name="<?php echo $this->get_field_name('count'); ?>" class="widefat"> 
			<?php for($i=1;$i<=10;$i++): ?>
			<option value="<?php echo $i; ?>" <?php echo ($count == $i) ? 'selected="selected"' : ''; ?>><?php echo $i; ?></option>
			<?php endfor; ?>
		</select>
		
		
		<p>
			<em><?php _e("Note: Please input FULL URL <br/>(e.g. <code>http://www.example.com</code>)", 'theme_admin');?></em>
		</p>

		<div class="ads-wrap">
		<?php for($i=1;$i<=10;$i++): $ad_image = 'ad_'.$i.'_image';$ad_link = 'ad_'.$i.'_link';$ad_target = 'ad_'.$i.'_target'; ?>
			<div class="ads-info" id="ads-info-<?php echo $i;?>" <?php if($i>$count):?>style="display:none"<?php endif;?>>
				<p><label for="<?php echo $this->get_field_id( $ad_image ); ?>"><?php printf(__('#%s Image URL:', 'theme_admin'),$i);?></label>
				<input class="widefat" id="<?php echo $this->get_field_id( $ad_image ); ?>" name="<?php echo $this->get_field_name( $ad_image ); ?>" type="text" value="<?php echo $$ad_image; ?>" /></p>
				<p><label for="<?php echo $this->get_field_id( $ad_link ); ?>"><?php printf(__('#%s Link:', 'theme_admin'),$i);?></label>
				<input class="widefat" id="<?php echo $this->get_field_id( $ad_link ); ?>" name="<?php echo $this->get_field_name( $ad_link ); ?>" type="text" value="<?php echo $$ad_link; ?>" /></p>
				<p>
					<label for="<?php echo $this->get_field_id( $ad_target ); ?>"><?php printf(__('#%s Link target:', 'theme_admin'),$i);?></label>
					<select name="<?php echo $this->get_field_name( $ad_target ); ?>" id="<?php echo $this->get_field_id( $ad_target ); ?>" class="widefat">
						<option value="_blank"<?php selected($$ad_target,'_blank');?>><?php _e( 'Open in a new window', 'theme_admin' ); ?></option>
						<option value="_self"<?php selected($$ad_target,'_self');?>><?php _e( 'Open in the same window', 'theme_admin' ); ?></option>
					</select>
				</p>
			</div>
		<?php endfor; ?>
		</div>
<?php
	}
}
register_widget('Theme_Widget_Ads_125');
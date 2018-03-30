<?php
/* Adv 120x600 */
add_action( 'widgets_init', 'widget_adv120x600_widget' );
function widget_adv120x600_widget() {
	register_widget( 'Widget_Adv120x600' );
}
class Widget_Adv120x600 extends WP_Widget {

	function Widget_Adv120x600() {
		$widget_ops = array( 'classname' => 'adv120x600-widget'  );
		$control_ops = array( 'id_base' => 'adv120x600-widget' );
		parent::__construct( 'adv120x600-widget','Ask me - Adv 120x600', $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
		extract( $args );
		$title    = apply_filters('widget_title', $instance['title'] );
		$adv_href = esc_attr($instance['adv_href']);
		$adv_img  = esc_attr($instance['adv_img']);
		$image_id = esc_attr($instance['image_id']);
		$adv_code = ($instance['adv_code']);
			
		?>
		<div class="advertising">
			<?php if ($adv_code == "") {
				if ($adv_href != "") {?><a href="<?php echo $adv_href?>"><?php }?>
					<img alt="" src="<?php echo $adv_img?>">
				<?php if ($adv_href != "") {?></a><?php }?>
			<?php }else {
				echo $adv_code;
			}?>
		</div><!-- End advertising -->
		<div class="clearfix"></div>
		<?php
	}

	function update( $new_instance, $old_instance ) {
		$instance             = $old_instance;
		$instance['title']    = strip_tags( $new_instance['title'] );
		$instance['adv_code'] = $new_instance['adv_code'];
		$instance['adv_img']  = $new_instance['adv_img'];
		$instance['image_id'] = $new_instance['image_id'];
		$instance['adv_href'] = $new_instance['adv_href'];
		return $instance;
	}

	function form( $instance ) {
		$defaults = array( 'title' => 'Adv 120x600' );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title : </label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo (isset($instance['title'])?esc_attr($instance['title']):""); ?>" class="widefat" type="text">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'adv_img' ); ?>">Image URL : </label>
			<input id="<?php echo $this->get_field_id( 'adv_img' ); ?>" name="<?php echo $this->get_field_name( 'adv_img' ); ?>" value="<?php echo (isset($instance['adv_img'])?$instance['adv_img']:"");?>" class="widefat upload" type="text">
			<br><br>
			<input class="upload_image_button button upload-button-2 upload-button-widget" type="button" value="Upload">
			<br><br>
			<input id="<?php echo $this->get_field_id( 'image_id' ); ?>" name="<?php echo $this->get_field_name( 'image_id' ); ?>" value="<?php echo (isset($instance['image_id'])?$instance['image_id']:"");?>" class="widefat image_id" type="hidden">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'adv_href' ); ?>">Advertising url : </label>
			<input id="<?php echo $this->get_field_id( 'adv_href' ); ?>" name="<?php echo $this->get_field_name( 'adv_href' ); ?>" value="<?php echo (isset($instance['adv_href'])?esc_attr($instance['adv_href']):""); ?>" class="widefat" type="text">
		</p>
		
		<em style="display:block; border-bottom:1px solid #CCC; margin-bottom:15px;">OR</em>

		<p>
			<label for="<?php echo $this->get_field_id( 'adv_code' ); ?>">Advertising Code html ( Ex: Google ads) : </label>
			<textarea id="<?php echo $this->get_field_id( 'adv_code' ); ?>" name="<?php echo $this->get_field_name( 'adv_code' ); ?>" class="widefat"><?php echo (isset($instance['adv_code'])?($instance['adv_code']):""); ?></textarea>
		</p>
	<?php
	}
}
?>
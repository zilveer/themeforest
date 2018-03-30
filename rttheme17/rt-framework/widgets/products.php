<?php
#
# RT-Theme Popular Posts
#

class RT_Products extends WP_Widget {

	function RT_Products() {
		$opts =array(
					'classname' 	=> 'widget_rt_products',
					'description' 	=> __( 'Displays products', 'rt_theme_admin' )
				);

		parent::__construct('rt_products', '['. THEMENAME.']   '.__('Products', 'rt_theme_admin'), $opts);
	}
	

	function widget( $args, $instance ) {
		extract( $args );
		
		
		$title			=	apply_filters('widget_title', $instance['title']) ;		 
		$categories		=	empty($instance['categories']) ? $instance['categories'] : implode($instance['categories'],',') ; 
		$count 			= 	empty($instance['count']) ? 5 : $instance['count']; 
		$columns			= 	$instance['columns']; 		
		$show_decs		= 	($instance['show_decs']=="0") ? "true" : "false";  

		echo $before_widget;
		if ($title) echo $before_title . $title . $after_title; 
		echo do_shortcode('[product_showcase categories="'.$categories.'" columns="'.$columns.'" limit="'.$count.'" desc="'.$show_decs.'"]');
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		 
		$instance = $old_instance;
		$instance['title']			= strip_tags(@$new_instance['title']); 
		$instance['categories']		= @$new_instance['categories'];
		$instance['newWidget']		= @$new_instance['newWidget']; 
		$instance['count']			= (int) $new_instance['count'];
		$instance['columns']		= $new_instance['columns'];
		$instance['show_decs']		= @!empty($new_instance['show_decs']) ? 1 : 0;
		
		return $instance;
	}

	function form( $instance ) {
		$title 			= 	isset($instance['title']) ? esc_attr($instance['title']) : '';
		$columns			=	isset($instance['columns']) ? $instance['columns'] : "";
		$categories 		=	isset($instance['categories']) ? $instance['categories'] : array();
		$newWidget		= 	isset($instance['newWidget']) ? $instance['newWidget'] : "";
		$count			=	empty($instance['count']) ? 5 : $instance['count'];
		$show_decs		=	isset($instance['show_decs']) ? $instance['show_decs'] : "";
		
		// Categories
		$rt_getcat = RTTheme::rt_get_product_categories_with_slugs();

		// Columns
		$rt_columns = array(
						1 => "1/1",
						2 => "1/2",
						3 => "1/3",
						4 => "1/4",
						5 => "1/5"
					);

?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'rt_theme_admin'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>
		
		<p><label for="<?php echo $this->get_field_id('columns'); ?>"><?php _e('Columns:', 'rt_theme_admin'); ?></label>
		
		<select class="widefat"   name="<?php echo $this->get_field_name('columns'); ?>" id="<?php echo $this->get_field_id('columns'); ?>" title="<?php _e('Select','rt_theme_admin'); ?>">

			<?php
			foreach ($rt_columns as $op_val=>$option) {			
						if (	$op_val ==  $columns ){
							$selected	= "selected";
						}				
			 ?>
				<option value="<?php echo $op_val;?>" <?php echo empty($selected) ? "" :  'selected="selected"'; ?> >
					<?php  echo $option; ?>
				</option>
			 <?php
			 $selected='';
			 }
			 ?>
		</select>

		<p><label for="<?php echo $this->get_field_id('categories'); ?>"><?php _e('Select Product Categories:', 'rt_theme_admin'); ?></label>
		
		<select class="widefat <?php echo empty($newWidget)? '' : 'multiple'; ?>"   name="<?php echo $this->get_field_name('categories'); ?>[]" id="<?php echo $this->get_field_id('categories'); ?>" multiple="multiple" title="<?php _e('Select','rt_theme_admin'); ?>">

			<?php
			foreach ($rt_getcat as $op_val=>$option) {
				if($categories){
					foreach($categories as $a_key => $a_value){
						if (	$a_value ==  $op_val ){
							$selected	= "selected";
						}				
					}
				}
			 ?>
				<option value="<?php echo $op_val;?>" <?php echo empty($selected) ? "" :  'selected="selected"'; ?> >
					<?php  echo $option; ?>
				</option>
			 <?php
			 $selected='';
			 }
			 ?>
		</select>

		<p><label for="<?php echo $this->get_field_id('count'); ?>"><?php _e('Number of products to show:', 'rt_theme_admin'); ?></label>
		<input id="<?php echo $this->get_field_id('count'); ?>" name="<?php echo $this->get_field_name('count'); ?>" type="text" value="<?php echo $count; ?>" size="4" /></p>
	
		<p><input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('show_decs'); ?>" name="<?php echo $this->get_field_name('show_decs'); ?>" <?php checked($show_decs); ?> />
		<label for="<?php echo $this->get_field_id('show_decs'); ?>"><?php _e( 'Don\'t display product descriptions', 'rt_theme_admin' ); ?></label></p>
 
	

	 
		<input class="widefat" id="<?php echo $this->get_field_id('newWidget'); ?>" name="<?php echo $this->get_field_name('newWidget'); ?>" type="hidden" value="1" />
		
<?php } } ?>
<?php
add_action('widgets_init', create_function('', 'return register_widget("DF_ad125x125");'));

class DF_ad125x125 extends WP_Widget {
	function DF_ad125x125 () {
		 parent::__construct (false, $name = THEME_FULL_NAME.' Custom 125x125 Ad');	
	}

	function form($instance) {
	
		/* Set up some default widget settings. */
		$defaults = array(
			'image1' => THEME_IMAGE_URL."125x125.png",
			'link1' => 'http://www.different-themes.com',
			'image2' => THEME_IMAGE_URL."125x125.png",
			'link2' => 'http://www.different-themes.com',
			'image3' => THEME_IMAGE_URL."125x125.png",
			'link3' => 'http://www.different-themes.com',
			'image4' => THEME_IMAGE_URL."125x125.png",
			'link4' => 'http://www.different-themes.com',
		);
		
		$instance = wp_parse_args( (array) $instance, $defaults );

		 $link1 = $instance['link1'];
		 $image1 = $instance['image1'];
		 $link2 = $instance['link2'];
		 $image2 = $instance['image2'];
		 $link3 = $instance['link3'];
		 $image3 = $instance['image3'];
		 $link4 = $instance['link4'];
		 $image4 = $instance['image4'];
        ?>
			

			<p><label for="<?php echo esc_attr__($this->get_field_id('link1')); ?>"><?php esc_attr_e( 'Link 1:' , THEME_NAME ); ?> <input class="widefat" id="<?php echo esc_attr__($this->get_field_id('link1')); ?>" name="<?php echo esc_attr__($this->get_field_name('link1')); ?>" type="text" value="<?php echo esc_attr__($link1); ?>" /></label></p>
			<p><label for="<?php echo esc_attr__($this->get_field_id('image1')); ?>"><?php esc_attr_e( 'Image Url 1:' , THEME_NAME ); ?> <input class="widefat" id="<?php echo esc_attr__($this->get_field_id('image1')); ?>" name="<?php echo esc_attr__($this->get_field_name('image1')); ?>" type="text" value="<?php echo esc_attr__($image1); ?>" /></label></p>
	
			<p><label for="<?php echo esc_attr__($this->get_field_id('link2')); ?>"><?php esc_attr_e( 'Link 2:' , THEME_NAME ); ?> <input class="widefat" id="<?php echo esc_attr__($this->get_field_id('link2')); ?>" name="<?php echo esc_attr__($this->get_field_name('link2')); ?>" type="text" value="<?php echo esc_attr__($link2); ?>" /></label></p>
			<p><label for="<?php echo esc_attr__($this->get_field_id('image2')); ?>"><?php esc_attr_e( 'Image Url 2:' , THEME_NAME ); ?> <input class="widefat" id="<?php echo esc_attr__($this->get_field_id('image2')); ?>" name="<?php echo esc_attr__($this->get_field_name('image2')); ?>" type="text" value="<?php echo esc_attr__($image2); ?>" /></label></p>
	
			<p><label for="<?php echo esc_attr__($this->get_field_id('link3')); ?>"><?php esc_attr_e( 'Link 3:' , THEME_NAME ); ?> <input class="widefat" id="<?php echo esc_attr__($this->get_field_id('link3')); ?>" name="<?php echo esc_attr__($this->get_field_name('link3')); ?>" type="text" value="<?php echo esc_attr__($link3); ?>" /></label></p>
			<p><label for="<?php echo esc_attr__($this->get_field_id('image3')); ?>"><?php esc_attr_e( 'Image Url 3:' , THEME_NAME ); ?> <input class="widefat" id="<?php echo esc_attr__($this->get_field_id('image3')); ?>" name="<?php echo esc_attr__($this->get_field_name('image3')); ?>" type="text" value="<?php echo esc_attr__($image3); ?>" /></label></p>
	
			<p><label for="<?php echo esc_attr__($this->get_field_id('link4')); ?>"><?php esc_attr_e( 'Link 4:' , THEME_NAME ); ?> <input class="widefat" id="<?php echo esc_attr__($this->get_field_id('link4')); ?>" name="<?php echo esc_attr__($this->get_field_name('link4')); ?>" type="text" value="<?php echo esc_attr__($link4); ?>" /></label></p>
			<p><label for="<?php echo esc_attr__($this->get_field_id('image4')); ?>"><?php esc_attr_e( 'Image Url 4:' , THEME_NAME ); ?> <input class="widefat" id="<?php echo esc_attr__($this->get_field_id('image4')); ?>" name="<?php echo esc_attr__($this->get_field_name('image4')); ?>" type="text" value="<?php echo esc_attr__($image4); ?>" /></label></p>

			
			
        <?php 
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['link1'] = strip_tags($new_instance['link1']);
		$instance['image1'] = strip_tags($new_instance['image1']);
		$instance['link2'] = strip_tags($new_instance['link2']);
		$instance['image2'] = strip_tags($new_instance['image2']);
		$instance['link3'] = strip_tags($new_instance['link3']);
		$instance['image3'] = strip_tags($new_instance['image3']);
		$instance['link4'] = strip_tags($new_instance['link4']);
		$instance['image4'] = strip_tags($new_instance['image4']);
		return $instance;
	}

	function widget($args, $instance) {
		extract( $args );
		 $title = apply_filters('widget_title', $instance['title']);
		

?>

	<?php echo balanceTags($before_widget); ?>
		<div class="tb_widget_banner_125 clearfix">
			<?php 
				$i=1;
				$link = $instance['link'.$i];
				for($i=1; $i<=4; $i++) {
					
					$link = $instance['link'.$i];
					$image = $instance['image'.$i];
					if(!$image) { $image = THEME_IMAGE_URL."125x125.png"; }
					if($link) {
			?>
				<a href="<?php echo esc_url($link);?>" target="_blank"><img src="<?php echo esc_url($image);?>" alt="<?php esc_attr_e("Banner",THEME_NAME);?>" title="<?php esc_attr_e("Banner",THEME_NAME);?>"/></a>
			<?php
					}
				}
			?>
		</div>
	<?php echo balanceTags($after_widget); ?>
		
	
      <?php
	}
}
?>
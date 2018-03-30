<?php
/*
 * Tabs Widget
 * 
 * @author 		SamaThemes
 * @category 	Widgets
 * @extends 	WP_Widget
 * @version 1.0
 */
 
add_action('widgets_init', 'Sama_Widget_Menu_Carousel::register_this_widget');

class Sama_Widget_Menu_Carousel extends WP_Widget {
		
	function __construct() {
	
		$widget_ops = array(
				'classname'   => 'menu_carousel_widget',
				'description' => esc_html__( 'This Widget use theme options to get images.', 'theme-majesty')
		);
		add_action('wp_enqueue_scripts', array($this, 'load_css'), 101);
		parent::__construct('menu_carousel_widget', 'SAMA :: '. esc_html__('Menu Carousel', 'theme-majesty'), $widget_ops);		
	}
	
	static function register_this_widget() {
		register_widget(__class__);
	}
	
	function load_css() {
		if ( is_active_widget( false, false, $this->id_base, true ) ) {
			wp_enqueue_script('owl-carousel');
		}
	}
	/**
	 * widget function.
	 *
	 * @see WP_Widget
	 * @access public
	 * @param array $args
	 * @param array $instance
	 * @return void
	 */
	function widget ($args, $instance) {
		
		
		global $majesty_options;
		
		$navigation    		 	= $instance['navigation'];
		$items    				= absint( $instance['items'] );
		$itemsdesktop    		= absint( $instance['itemsdesktop'] );
		$itemsdesktopsmall    	= absint( $instance['itemsdesktopsmall'] );
		if ($navigation) {
			$navigation = (string) 'true';
		} else {
			$navigation = (string) 'false';
		}
		
		if( ! isset( $majesty_options['menu_silder'] ) || empty( $majesty_options['menu_silder'] ) ) {
			return;
		}
		$images = $majesty_options['menu_silder'];
		if( ! empty( $images ) ) {
		?>
				<div class="col-1 clearfix">
					<div id="menu_carousel" class="menu_carousel" data-navigation="<?php echo esc_attr( $navigation ); ?>" data-items="<?php echo absint( $items ); ?>" data-itemsdesktop="<?php echo absint( $itemsdesktop ); ?>" data-itemsdesktopsmall="<?php echo absint( $itemsdesktopsmall ); ?>">
						<?php foreach( $images as $slide ) { ?>
							<div class="item">
								<a href="<?php echo esc_url( $slide['url'] ) ?>">
									<img class="img-responsive" src="<?php echo esc_url( $slide['image'] ) ?>"  alt="<?php echo esc_attr( strip_tags( $slide['title'] ) ); ?>">
									<h3><?php echo esc_attr( $slide['title'] ); ?></h3>
								</a>
							</div>
						<?php } ?>
					</div>
				</div>
		<?php
		}
	}
	
	/**
	 * update function.
	 *
	 * @see WP_Widget->update
	 * @access public
	 * @param array $new_instance
	 * @param array $old_instance
	 * @return array
	 */
	function update ($new_instance, $old_instance) {
		
		$instance 	= $old_instance;
		$instance['title']     = esc_attr($new_instance['title']);
		$instance['navigation']     = esc_attr($new_instance['navigation']);
		if ( intval($new_instance['items']) != 0 ) {
			$instance['items'] = $new_instance['items'];
		}
		if ( intval($new_instance['itemsdesktop']) != 0 ) {
			$instance['itemsdesktop'] = $new_instance['itemsdesktop'];
		}
		if ( intval($new_instance['itemsdesktopsmall']) != 0 ) {
			$instance['itemsdesktopsmall'] = $new_instance['itemsdesktopsmall'];
		}
		return $instance;		
	}
	
	/**
	 * form function.
	 *
	 * @see WP_Widget->form
	 * @access public
	 * @param array $instance
	 * @return void
	 */
	function form ($instance) {
	
		$defaults = array(
			'title'  				=> 'Menu Carousel',
			'navigation'			=> '0',
			'items'					=> '6',
			'itemsdesktop'			=> '3',
			'itemsdesktopsmall'		=> '3',	
		);
		
		$instance = wp_parse_args( (array) $instance, $defaults);
	?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php esc_html_e( 'Title:', 'theme-majesty'); ?></label>
			<input class="widefat" type="text" name="<?php echo $this->get_field_name('title'); ?>" id="<?php echo $this->get_field_id('title'); ?>" value="<?php echo esc_attr($instance['title']); ?>" size="20" />
		</p>
		<p>
			<input type="checkbox" name="<?php echo $this->get_field_name('navigation'); ?>" id="<?php echo $this->get_field_id('navigation'); ?>" value="1" <?php checked(1,esc_attr($instance['navigation']));?> size="20" />
			 <label for="<?php echo $this->get_field_id('navigation'); ?>" /><?php esc_html_e('Display navigation.', 'theme-majesty'); ?></label>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('items'); ?>"><?php esc_html_e( 'Items:', 'theme-majesty'); ?> </label>
			<input class="widefat" type="text" name="<?php echo $this->get_field_name('items');?>" id="<?php echo $this->get_field_id('items');?>" value="<?php echo esc_attr($instance['items']);?>" size="7" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('itemsdesktop'); ?>"><?php esc_html_e( 'Items Desktop:', 'theme-majesty'); ?> </label>
			<input class="widefat" type="text" name="<?php echo $this->get_field_name('itemsdesktop');?>" id="<?php echo $this->get_field_id('itemsdesktop');?>" value="<?php echo esc_attr($instance['itemsdesktop']);?>" size="7" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('itemsdesktopsmall'); ?>"><?php esc_html_e( 'Items Desktop Small:', 'theme-majesty'); ?> </label>
			<input class="widefat" type="text" name="<?php echo $this->get_field_name('itemsdesktopsmall');?>" id="<?php echo $this->get_field_id('itemsdesktopsmall');?>" value="<?php echo esc_attr($instance['itemsdesktopsmall']);?>" size="7" />
		</p>
	<?php
	}

} // End of class
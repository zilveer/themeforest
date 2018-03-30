<?php
/* "Copyright 2012 A3 Revolution Web Design" This software is distributed under the terms of GNU GENERAL PUBLIC LICENSE Version 3, 29 June 2007 */
/**
 * Create WOO Compare Widget
 */
//add_action( 'widgets_init', create_function('', 'return register_widget("Custom_WC_Compare_Widget");') );

/**
 * WooCommerce Compare Widget
 *
 * Table Of Contents
 *
 * WC_Compare_Widget()
 * widget()
 * update()
 * form()
 */
class Custom_WC_Compare_Widget extends WP_Widget
{

	function Custom_WC_Compare_Widget() {
		$widget_ops = array('classname' => 'woo_compare_widget');
		parent::__construct('woo_compare_widget', 'homeshop'.' - '.__('WOO Compare Products', 'homeshop'), $widget_ops);

	}
	function widget($args, $instance) {
		//global $woo_compare_widget_style, $woo_compare_widget_title_style;
		//extract($woo_compare_widget_style);
		//extract($woo_compare_widget_title_style);
		extract($args, EXTR_SKIP);
		$instance = wp_parse_args( (array) $instance, array( 
					'title' 				=> '', 
					'color' 			=> '', 
					'icon'	=> ''
				) );
		
		
		$compare_list = WC_Compare_Functions::get_compare_list();
		$total_compare_product = 0;
		if (is_array($compare_list)) $total_compare_product = count($compare_list);
		$title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);
		$color = $instance['color'];
		$icon = $instance['icon'];
		
		//echo $before_widget;
		
		 echo '<div class="row sidebar-box '. esc_attr($color) .'">
						
			<div class="col-lg-12 col-md-12 col-sm-12">
				
				<div class="sidebar-box-heading">
					<i class="icons '. esc_attr($icon) .'"></i>
					<h4>';
		
		
		if ( $title != '')
			echo  esc_html($title);
		else
			echo  __( 'Compare Products', 'homeshop' );


		 echo '</h4>
				</div>
				<div class="sidebar-box-content  sidebar-padding-box">';	
			
		$cont = WC_Compare_Functions::get_compare_list_html_widget();
		$cont = str_replace('woo_compare_button_go woo_compare_widget_button_go', ' button grey ', $cont);
		
		
		echo '<div class="woo_compare_widget_container">'. $cont .'</div><div class="woo_compare_widget_loader" style="display:none; text-align:center"><img src="'.WOOCP_IMAGES_URL.'/ajax-loader.gif" border=0 /></div>';

		
		
		//echo $after_widget;
		echo "</div></div></div>\n";	
		
		
		

	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		
		$instance['icon'] = strip_tags($new_instance['icon']);
		$instance['color'] = strip_tags( $new_instance['color'] );
		
		return $instance;

	}

	function form($instance) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'icon' => '', 'color' => '' ) );
		$title = strip_tags($instance['title']);
		
		$color = $instance['color'];
		$icon = $instance['icon'];
		
?>

        <p>
          	<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title', 'homeshop' ); ?> :
            	<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
          	</label>
        </p>
		
		
		
		
		
		
		
		<p>
		<label for="<?php echo $this->get_field_id('icon'); ?>"><?php _e( 'Select Icon:', 'homeshop' ); ?></label>
		<select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'icon' ) ); ?>" name="<?php echo $this->get_field_name( 'icon' ); ?>">
			<?php 
			$setting = array();
			$setting['options'] = wm_fontello_classes(); 
			
			foreach ( $setting['options'] as $option_key => $option_value ) : ?>
				<option value="<?php echo esc_attr( $option_key ); ?>" <?php selected( $option_key, $icon ); ?>><?php echo esc_html( $option_value ); ?></option>
			<?php endforeach; ?>
		</select>
		</p>

		<p>
		<label><?php _e( 'Color:', 'homeshop' ); ?></label>
		<select name="<?php echo $this->get_field_name('color'); ?>" id="<?php echo $this->get_field_id('color'); ?>" class="widefat">
			<option value="default"<?php selected( $instance['color'], 'default' ); ?>><?php _e( 'Default', 'homeshop' ); ?></option>
			<option value="red"<?php selected( $instance['color'], 'red' ); ?>><?php _e( 'Red', 'homeshop' ); ?></option>
			<option value="green"<?php selected( $instance['color'], 'green' ); ?>><?php _e( 'Green', 'homeshop' ); ?></option>
			<option value="blue"<?php selected( $instance['color'], 'blue' ); ?>><?php _e( 'Blue', 'homeshop' ); ?></option>
			<option value="orange"<?php selected( $instance['color'], 'orange' ); ?>><?php _e( 'Orange', 'homeshop' ); ?></option>
			<option value="purple"<?php selected( $instance['color'], 'purple' ); ?>><?php _e( 'Purple', 'homeshop' ); ?></option>
		</select>
		</p>
		
		
		
		
		<?php
	}
}

/**
 * Auto Add Compare Widget
 *
 * Table Of Contents
 *
 * automatic_add_widget_to_sidebar()
 */
class WC_Compare_Widget_Add1 
{
	public static function automatic_add_widget_to_sidebar() {
		$add_to_sidebars = array('primary', 'primary-widget-area', 'sidebar-1');
		$widget_name = 'woo_compare_widget';
		$sidebar_options = get_option('sidebars_widgets');
		$compare_widget = get_option('widget_'.$widget_name);
		$have_widget = false;
		foreach ($sidebar_options as $siderbar_name => $sidebar_widgets) {
			if ($siderbar_name == 'wp_inactive_widgets') continue;
			if (is_array($sidebar_widgets) && count($sidebar_widgets) > 0) {
				foreach ($sidebar_widgets as $sidebar_widget) {
					if (stristr($sidebar_widget, $widget_name) !== false) {
						$have_widget = true;
						break;
					}
				}
			}
			if ($have_widget) break;
		}
		if (!$have_widget) {
			if (!is_array($compare_widget)) $compare_widget = array();
			$count = count($compare_widget)+1;
			$added_widget = false;
			$new_sidebar_options = $sidebar_options;
			foreach ($add_to_sidebars as $sidebar_name) {
				if (isset($sidebar_options[$sidebar_name])) {
					$sidebar_options[$sidebar_name][] = $widget_name.'-'.$count;
					$added_widget = true;
					break;
				}
			}
			if (!$added_widget) {
				foreach ($new_sidebar_options as $siderbar_name => $sidebar_widgets) {
					if ($siderbar_name == 'wp_inactive_widgets') continue;
					$sidebar_options[$siderbar_name][] = $widget_name.'-'.$count;
					break;
				}
			}

			// add widget to sidebar:
			$compare_widget[$count] = array(
				'title' => ''
			);
			update_option('sidebars_widgets', $sidebar_options);
			update_option('widget_'.$widget_name, $compare_widget);
		}
	}
}
?>
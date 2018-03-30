<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
class DFDMenuWidget extends WP_Widget {
	private $_menu_directions;
	
    function __construct() {
        $widget_ops = array( 'description' => __('Use this widget to add one of your custom menu as a link list widget.', 'dfd') );
		
		$this->_menu_directions = array(
			'left' => __('Left', 'dfd'),
			'right' => __('Right', 'dfd'),
			'center' => __('Center', 'dfd'),
		);
		
        parent::__construct(
					'dfd_widget_sidebar_menu',
					__('Widget: Sidebar Menu', 'dfd'),
					$widget_ops
				);
    }

    function widget($args, $instance) {
        // Get menu
        $nav_menu = ! empty( $instance['nav_menu'] ) ? wp_get_nav_menu_object( $instance['nav_menu'] ) : false;

        if ( !$nav_menu )
            return;

        $instance['title'] = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

        echo $args['before_widget'];

        if ( !empty($instance['title']) )
            echo $args['before_title'] . $instance['title'] . $args['after_title'];

		$menu_options = array(
			'menu' => $nav_menu,
			'menu_class' => 'widget-sidebar-menu widget-sidebar-menu-'.$instance['menu_direction'],
		);
		
        if (class_exists('DFD_Widget_Tiled_Menu_Walker')) {
			$menu_options['walker'] = new DFD_Widget_Tiled_Menu_Walker($nav_menu->slug);
        }
		
		wp_nav_menu($menu_options);

        echo $args['after_widget'];
    }

    function update( $new_instance, $old_instance ) {
        $instance['title'] = strip_tags( stripslashes($new_instance['title']) );
        $instance['nav_menu'] = (int) $new_instance['nav_menu'];
		if (isset($new_instance['menu_direction']) && !empty($new_instance['menu_direction'])) {
			$instance['menu_direction'] = $new_instance['menu_direction'];
		} else {
			$instance['menu_direction'] = $this->_menu_directions[0];
		}
		
        return $instance;
    }

    function form( $instance ) {
        $title = isset( $instance['title'] ) ? $instance['title'] : '';
        $nav_menu = isset( $instance['nav_menu'] ) ? $instance['nav_menu'] : '';
        $menu_direction = isset($instance['menu_direction']) && !empty($instance['menu_direction']) ? $instance['menu_direction'] : $this->_menu_directions[0];

        // Get menus
        $menus = get_terms( 'nav_menu', array( 'hide_empty' => false ) );

        // If no menus exists, direct the user to go and create some.
        if ( !$menus ) {
            echo '<p>'. sprintf( __('No menus have been created yet. <a href="%s">Create some</a>.', 'dfd'), admin_url('nav-menus.php') ) .'</p>';
            return;
        }
		
        ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php _e('Title:', 'dfd') ?></label>
            <input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" value="<?php echo esc_attr($title); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('nav_menu')); ?>"><?php _e('Select Menu:', 'dfd'); ?></label>
            <select id="<?php echo esc_attr($this->get_field_id('nav_menu')); ?>" name="<?php echo esc_attr($this->get_field_name('nav_menu')); ?>">
                <?php
                foreach ( $menus as $menu ) {
                    $selected = $nav_menu == $menu->term_id ? ' selected="selected"' : '';
                    echo '<option'. $selected .' value="'. $menu->term_id .'">'. $menu->name .'</option>';
                }
                ?>
            </select>
        </p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('menu_direction')); ?>"><?php _e('Menu Direction:', 'dfd'); ?></label>
			<select id="<?php echo esc_attr($this->get_field_id('menu_direction')); ?>" name="<?php echo esc_attr($this->get_field_name('menu_direction')); ?>">
                <?php
                foreach ( $this->_menu_directions as $value=>$label ) {
                    $selected = $menu_direction == $value ? ' selected="selected"' : '';
                    echo '<option'. $selected .' value="'. esc_attr($value) .'">'. $label .'</option>';
                }
                ?>
            </select>
		</p>
    <?php
    }
}

add_action( 'widgets_init', create_function( '', 'register_widget("DFDMenuWidget");' ) );

if (!class_exists('DFD_Widget_Tiled_Menu_Walker')) {

	class DFD_Widget_Tiled_Menu_Walker extends Walker_Nav_Menu {

	}

}

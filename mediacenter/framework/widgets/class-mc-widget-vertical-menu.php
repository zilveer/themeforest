<?php
/**
 * Vertical Menu Widget
 *
 * @author 		Ibrahim Ibn Dawood
 * @category 	Widgets
 * @package 	MediaCenter/Framework/Widgets
 * @version 	1.0.6
 * @extends 	WC_Widget
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class MC_Widget_Vertical_Menu extends WC_Widget {

	/**
	 * Constructor
	 */
	public function __construct() {
		$this->widget_cssclass    = 'vertical-menu';
		$this->widget_description = __( 'Home Page like vertical menu.', 'mediacenter' );
		$this->widget_id          = 'media_center_vertical_menu';
		$this->widget_name        = __( 'Media Center Vertical Menu', 'mediacenter' );
		$this->settings           = array(
			'title'  => array(
				'type'  => 'text',
				'std'   => __( 'Shop By Departments', 'mediacenter' ),
				'label' => __( 'Title for vertical menu', 'mediacenter' )
			),
			'icon_class'  => array(
				'type'  => 'text',
				'std'   => 'fa-list',
				'label' => sprintf( __('Fontawesome Icon Class. Default icon is <em>fa-list</em>. For complete list of icon classes %s', 'mediacenter' ), '<a href="http://fortawesome.github.io/Font-Awesome/icons/" target="_blank">' . __( 'Click here', 'mediacenter' ) . '</a>' )
			),
			'menu'  => array(
				'type'  => 'text',
				'std'   => '',
				'label' => __( 'Menu ID, slug, or name. Leave it empty to pull all product categories.', 'mediacenter')
			),
			'dropdown_trigger' => array(
				'type'    => 'select',
				'std'     => 'click',
				'label'   => __( 'Dropdown Trigger', 'mediacenter' ),
				'options' => array(
					'click' => __( 'Click', 'mediacenter' ),
	      			'hover' => __( 'Hover', 'mediacenter' ),
				)
			),
			'dropdown_animation' => array(
				'type'    => 'select',
				'std'     => 'none',
				'label'   => __( 'Dropdown Animation', 'mediacenter' ),
				'options' => array(
					'none' 				=>	__( 'No Animation', 'mediacenter' ),
					'bounceIn' 			=>	__( 'BounceIn', 'mediacenter' ),
					'bounceInDown' 		=>	__( 'BounceInDown', 'mediacenter' ),
					'bounceInLeft' 		=>	__( 'BounceInLeft', 'mediacenter' ),
					'bounceInRight' 	=>	__( 'BounceInRight', 'mediacenter' ),
					'bounceInUp' 		=>	__( 'BounceInUp', 'mediacenter' ),
					'fadeIn' 			=>	__( 'FadeIn', 'mediacenter' ),
					'fadeInDown' 		=>	__( 'FadeInDown', 'mediacenter' ),
					'fadeInDownBig' 	=>	__( 'FadeInDown Big', 'mediacenter' ),
					'fadeInLeft' 		=>	__( 'FadeInLeft', 'mediacenter' ),
					'fadeInLeftBig' 	=>	__( 'FadeInLeft Big', 'mediacenter' ),
					'fadeInRight' 		=>	__( 'FadeInRight', 'mediacenter' ),
					'fadeInRightBig' 	=>	__( 'FadeInRight Big', 'mediacenter' ),
					'fadeInUp' 			=>	__( 'FadeInUp', 'mediacenter' ),
					'fadeInUpBig' 		=>	__( 'FadeInUp Big', 'mediacenter' ),
					'flipInX' 			=>	__( 'FlipInX', 'mediacenter' ),
					'flipInY' 			=>	__( 'FlipInY', 'mediacenter' ),
					'lightSpeedIn' 		=>	__( 'Light SpeedIn', 'mediacenter' ),
					'rotateIn' 			=>	__( 'RotateIn', 'mediacenter' ),
					'rotateInDownLeft' 	=>	__( 'RotateInDown Left', 'mediacenter' ),
					'rotateInDownRight' =>	__( 'RotateInDown Right', 'mediacenter' ),
					'rotateInUpLeft' 	=>	__( 'RotateInUp Left', 'mediacenter' ),
					'rotateInUpRight' 	=>	__( 'RotateInUp Right', 'mediacenter' ),
					'roleIn' 			=>	__( 'RoleIn', 'mediacenter' ),
					'zoomIn' 			=>	__( 'ZoomIn', 'mediacenter' ),
					'zoomInDown' 		=>	__( 'ZoomInDown', 'mediacenter' ),
					'zoomInLeft' 		=>	__( 'ZoomInLeft', 'mediacenter' ),
					'zoomInRight' 		=>	__( 'ZoomInRight', 'mediacenter' ),
					'zoomInUp' 			=>	__( 'ZoomInUp', 'mediacenter' ),
				)
			),
			'el_class'  => array(
				'type'  => 'text',
				'std'   => '',
				'label' => __( 'Extra Class', 'mediacenter' )
			)
		);
		parent::__construct();
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
	public function widget( $args, $instance ) {

		if ( $this->get_cached_widget( $args ) )
			return;

		ob_start();
		extract( $args );		

		echo $before_widget;

		$title = apply_filters( 'widget_title', $instance['title'] );

		echo do_shortcode( '[mc_vertical_menu title="' . $title. '" icon_class="' . $instance['icon_class']. '" menu="' . $instance['menu']. '" dropdown_trigger="'. $instance['dropdown_trigger']. '" dropdown_animation="' . $instance['dropdown_animation']. '" el_class="'. $instance['el_class']. '"]' );

		echo $after_widget;

		$content = ob_get_clean();

		echo $content;

		$this->cache_widget( $args, $content );
	}
}

register_widget( 'MC_Widget_Vertical_Menu' );
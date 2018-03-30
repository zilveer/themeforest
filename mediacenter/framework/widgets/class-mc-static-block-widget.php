<?php
/**
 * Creates a Static Block Widgets which can be placed in sidebar
 *
 * @class       MC_Static_Block_Widget
 * @version     1.0.0
 * @package     Widgets
 * @category    Class
 * @author      Transvelo
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if( class_exists( 'WC_Widget' ) ) :

class MC_Static_Block_Widget extends WC_Widget {

	public function __construct() {

		$static_block_options = $this->get_static_blocks_options();

		$this->widget_cssclass    = 'widget widget-static-block';
		$this->widget_description = __( 'Display a static block.', 'mediacenter' );
		$this->widget_id          = 'mc_static_block';
		$this->widget_name        = __( 'Static Block', 'mediacenter' );
		$this->settings           = array(
			'static_block_id' 	=> array(
				'type'  		=> 'select',
				'std'   		=> '',
				'label' 		=> __( 'Select a Static Block', 'mediacenter' ),
				'options' 		=> $static_block_options
			)
		);

		parent::__construct();
	}

	private function get_static_blocks_options() {

		$args = apply_filters( 'static_block_get_posts_args', array(
			'posts_per_page'	=> 20,
			'orderby'			=> 'title',
			'post_type'			=> 'static_block',
		) );
		
		$static_blocks = get_posts( $args );

		$options = array();

		$options[0] = __( 'Choose a static block', 'mediacenter' );

		foreach( $static_blocks as $static_block ) {
			$options[$static_block->ID] = get_the_title( $static_block->ID );
		}

		return $options;
	}

	public function widget( $args, $instance ) {
		
		if ( $this->get_cached_widget( $args ) ) {
			return;
		}

		$static_block_id = ! empty( $instance['static_block_id'] ) ? sanitize_title( $instance['static_block_id'] ) : $this->settings['static_block_id']['std'];

		ob_start();

		if ( !empty( $static_block_id ) && $static_block_id !== 0 ) {
			$this->widget_start( $args, $instance );

			$static_block = get_post( $static_block_id );
			echo apply_filters( 'the_content' , $static_block->post_content );

			$this->widget_end( $args );
		}

		echo $this->cache_widget( $args, ob_get_clean() );
	}
}

endif;

register_widget( 'MC_Static_Block_Widget' );
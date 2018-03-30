<?php

class Listify_Widgetized_Pages {
	
	private $transient;

	public function __construct() {
		$this->transient = 'listify_widgetized_pages';

		add_action( 'save_post', array( $this, 'flush_cache' ) );
		add_action( 'widgets_init', array( $this, 'register_widget_areas' ), 99 );
	}

	public function register_widget_areas() {
		$pages = $this->get_pages();

		if ( empty( $pages ) ) {
			return;
		}

		foreach ( $pages as $page ) {
			register_sidebar( array(
				'name'          => sprintf( __( 'Page: %s', 'listify' ), get_the_title( $page ) ),
				'description'   => sprintf( __( 'Widgets that appear on the "%s" page.', 'listify' ), get_the_title( $page )),
				'id'            => 'widget-area-page-'. $page,
				'before_widget' => '<aside id="%1$s" class="page-widget home-widget %2$s">',
				'after_widget'  => '</aside>',
				'before_title'  => '<div class="home-widget-section-title"><h2 class="home-widget-title">',
				'after_title'   => '</h2></div>',
			) );
		}
	}

	public function get_pages() {
		if ( false === ( $pages = get_transient( $this->transient ) ) ) {
			$pages = array();

			$query = new WP_Query( array(
				'fields' => 'ids',
				'nopaging' => true,
				'post_type' => 'page',
				'meta_query' => array(
					array(
						'key' => '_wp_page_template',
						'value' => array( 'page-templates/template-widgetized.php',
						'page-templates/template-home-slider.php' ),
						'compare' => 'IN'
					)
				)
			) );

			if ( ! empty( $query->posts ) ) {
				$pages = $query->posts;
			}

			set_transient( $this->transient, $pages );
		}

		return $pages;
	}

	public function flush_cache() {
		delete_transient( $this->transient );
	}
}

$GLOBAL[ 'listify_widgetized_pages' ] = new Listify_Widgetized_Pages;

<?php
/**
 * Manage authors on the frontend.
 *
 * Deals mostly with the `author.php` template file.
 *
 * @since 1.7.0
 * @package Listify
 */

class Listify_Authors {

	/**
	 * Hooks/filters for the WordPress API.
	 *
	 * @since 1.7.0
	 * @return void
	 */
	public static function setup_actions() {
		// register widgets and sidebars
		add_action( 'widgets_init', array( __CLASS__, 'register_widgets' ) );
		add_action( 'widgets_init', array( __CLASS__, 'register_sidebars' ) );

		// add some template output to author.php
		add_action( 'listify_author_meta', array( __CLASS__, 'author_meta' ) );

		// filter the default WP_Widget_Recent_Posts query
		add_filter( 'widget_posts_args', array( __CLASS__, 'widget_post_args' ) );
	}

	/**
	 * Register the widgets for the main content and sidebar of the
	 * author.php page template.
	 *
	 * @since 1.7.0
	 * @return void
	 */
	public static function register_widgets() {
		$widgets = array(
			'class-widget-author-biography.php',
			'class-widget-author-listings.php',
			'class-widget-author-bookmarks.php'
		);

		foreach ( $widgets as $file ) {
			require( dirname( __FILE__ ) . '/widgets/' . $file );
		}

		register_widget( 'Listify_Widget_Author_Biography' );
		register_widget( 'Listify_Widget_Author_Listings' );

		if ( class_exists( 'WP_Job_Manager_Bookmarks' ) ) {
			register_widget( 'Listify_Widget_Author_Bookmarks' );
		}
	}

	/**
	 * Register the sidebars for the main content and sidebar of the
	 * author.php page template.
	 *
	 * @since 1.7.0
	 * @return void
	 */
	public static function register_sidebars() {
		register_sidebar( array(
			'name'          => __( 'Author - Main Content', 'listify' ),
			'id'            => 'widget-area-author-main',
			'before_widget' => '<aside id="%1$s" class="widget widget--author widget--author-main %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title widget-title--author widget--author-main %s">',
			'after_title'   => '</h3>',
		) );

		register_sidebar( array(
			'name'          => __( 'Author - Sidebar', 'listify' ),
			'id'            => 'widget-area-author-sidebar',
			'before_widget' => '<aside id="%1$s" class="widget widget--author widget--author-sidebar %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title widget-title--author widget--author-sidebar %s">',
			'after_title'   => '</h3>',
		) );
	}

	/**
	 * Additional Author Meta
	 *
	 * @since 1.7.0
	 * @return void
	 */
	public static function author_meta() {
		echo '<span class="listing-count">';
		printf( __( '%d Listed', 'listify' ), listify_count_posts( 'job_listing', get_queried_object_id() ) );
		echo '</span>';

		if ( ! class_exists( 'WP_Job_Manager_Bookmarks' ) ) {
			return;
		}

		global $job_manager_bookmarks;

		echo '<span class="favorite-count">';
		printf( 
			_n( '%d Favorite', '%d Favorites', count( $job_manager_bookmarks->get_user_bookmarks( get_queried_object_id() ) ), 'listify' ), 
			count( $job_manager_bookmarks->get_user_bookmarks( get_queried_object_id() ) ) ); 
		echo '<span>';
	}

	/**
	 * When on the author.php page template filter the use of the Recent Posts 
	 * widget to only include blog posts by the author being viewed.
	 *
	 * @since 1.7.0
	 * @param array $query_args
	 * @return array $query_args
	 */
	public static function widget_post_args( $query_args ) {
		if ( ! is_author() ) {
			return $query_args;
		}

		$query_args[ 'author__in' ] = array( get_queried_object_id() );

		return $query_args;
	}

}

Listify_Authors::setup_actions();

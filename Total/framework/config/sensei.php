<?php
/**
 * Sensei Plugin Configuration Class
 *
 * @package Total WordPress Theme
 * @subpackage Configs
 * @version 3.3.3
 */

global $wpex_sensei_config;

if ( ! class_exists( 'WPEX_Sensei_Config' ) ) {

	class WPEX_Sensei_Config {

		/**
		 * Start things up
		 *
		 * @since 3.0.8
		 */
		public function __construct() {

			// Get global Sensie class
			global $woothemes_sensei;

			// Class not found lets leave
			if ( ! $woothemes_sensei ) {
				return;
			}

			// Add theme support
			add_action( 'after_setup_theme', array( $this, 'declare_support' ) );

			// Load custom CSS file for tweaks
			add_action( 'wp_enqueue_scripts', array( $this, 'load_custom_stylesheet' ), 10 );

			// Declare Sensei Layouts
			add_filter( 'wpex_post_layout_class', array( $this, 'layouts' ), 10 );

			// Add custom sidebar
			add_filter( 'widgets_init', array( $this, 'register_sensei_sidebar' ), 10 );
			add_filter( 'wpex_get_sidebar', array( $this, 'display_sensei_sidebar' ), 10 );

			// Remove default wrappers
			remove_action( 'sensei_before_main_content', array( $woothemes_sensei->frontend, 'sensei_output_content_wrapper' ), 10 );
			remove_action( 'sensei_after_main_content', array( $woothemes_sensei->frontend, 'sensei_output_content_wrapper_end' ), 10 );

			// Add correct theme wrappers
			add_action( 'sensei_before_main_content', array( $this, 'before_main_content' ), 10 );
			add_action( 'sensei_after_main_content', array( $this, 'after_main_content' ), 10 );

			// Alter page header
			add_filter( 'wpex_title', array( $this, 'alter_title' ) );

			// Remove duplicate pagination
			remove_action( 'sensei_pagination', array( $woothemes_sensei->frontend, 'sensei_output_content_pagination' ), 10 );

			// Alter breadcrumbs
			add_filter( 'wpex_breadcrumbs_trail', array( $this, 'breadcrumbs_trail' ) );

			// Declare accent backgrounds
			add_filter( 'wpex_accent_backgrounds', array( $this, 'accent_backgrounds' ) );

			// Set module term description above the loop
			add_filter( 'wpex_has_term_description_above_loop', array( $this, 'has_term_description_above_loop' ) );

			// Add title above module description
			add_action( 'wpex_hook_content_top', array( $this, 'above_content_module_title' ), 10 );

		}

		/**
		 * Declare theme support
		 *
		 * @since 3.0.8
		 */
		public function declare_support() {
			add_theme_support( 'sensei' );
		}

		/**
		 * Load custom CSS file for tweaks only when needed
		 *
		 * @since 3.0.8
		 */
		public function load_custom_stylesheet() {
			if ( is_sensei() || is_tax( 'module' ) ) {
				wp_enqueue_style( 'wpex-sensei', WPEX_CSS_DIR_URI .'wpex-sensei.css' );
			}
		}

		/**
		 * Declare layout
		 *
		 * @since 3.0.8
		 */
		public function layouts( $layout ) {
			
			// Single course
			if ( is_singular( 'course' ) || is_singular( 'lessen' ) ) {
				$layout = 'right-sidebar';
			}

			// Return layout
			return $layout;

		}

		/**
		 * Add custom sidebar
		 *
		 * @since 3.0.8
		 */
		public function register_sensei_sidebar() {
			$headings = wpex_get_mod( 'sidebar_headings', 'div' );
			$headings = $headings ? $headings : 'div';
			register_sidebar( array(
				'name'          => esc_html__( 'Sensie Sidebar', 'total' ),
				'id'            => 'sensei_sidebar',
				'before_widget' => '<div class="sidebar-box %2$s clr">',
				'after_widget'  => '</div>',
				'before_title'  => '<'. $headings .' class="widget-title">',
				'after_title'   => '</'. $headings .'>',
			) );
		}

		/**
		 * Alter main sidebar to display sensei sidebar
		 *
		 * @since 3.0.8
		 */
		public function display_sensei_sidebar( $sidebar ) {
			if ( is_sensei() ) {
				$sidebar = 'sensei_sidebar';
			}
			return $sidebar;
		}

		/**
		 * Before main content wrapper
		 *
		 * @since 3.0.8
		 */
		public function before_main_content() {

			ob_start(); ?>

			<div id="content-wrap" class="container clr">

				<?php wpex_hook_primary_before(); ?>

				<div id="primary" class="content-area clr">

					<?php wpex_hook_content_before(); ?>

					<div id="content" class="site-content clr">

						<?php wpex_hook_content_top(); ?>
			
			<?php
			echo ob_get_clean();
		}
		
		/**
		 * After main content wrapper
		 *
		 * @since 3.0.8
		 */
		public function after_main_content() {

			ob_start(); ?>

						<?php wpex_hook_content_bottom(); ?>

					</div><!-- #content -->

					<?php wpex_hook_content_after(); ?>

				</div><!-- #primary -->

				<?php wpex_hook_primary_after(); ?>

			</div><!-- .container -->
			
			<?php
			echo ob_get_clean();
		}

		/**
		 * Alter main page header title
		 *
		 * @since 3.0.8
		 */
		public function alter_title( $title ) {

			// Single lesson
			if ( is_singular( 'lesson' ) ) {
				$obj = get_post_type_object( 'lesson' );
				return $obj->labels->name;
			}

			// Single course
			elseif ( is_singular( 'course' ) ) {
				$obj = get_post_type_object( 'course' );
				return $obj->labels->name;
			}

			// Single Quiz
			elseif ( is_singular( 'quiz' ) ) {
				$obj = get_post_type_object( 'quiz' );
				return $obj->labels->name;
			}

			// Module tax
			elseif ( is_tax( 'module' ) ) {
				global $wp_query;
				$term = $wp_query->get_queried_object();
				$tax = get_taxonomy( $term->taxonomy );
				return $tax->labels->name;
			}

			// Course Results - MUST BE LAST
			else {
				global $wp_query;
				if ( isset( $wp_query->query_vars['course_results'] ) ) {
					$title = esc_html__( 'Course Results', 'total' );
				}
			}

			// Return title
			return $title;

		}

		/**
		 * Alter breadcrumbs trail
		 *
		 * @since 3.0.8
		 */
		public function breadcrumbs_trail( $trail ) {

			// Add course to single lesson and remove post type archive
			if ( is_singular( 'lesson' ) ) {

				unset( $trail['post_type_archive'] );

				$offset = 1;
				$og_trail = $trail;
				$courses_obj = get_post_type_object( 'course' );
				$courses = '<a href="'. get_post_type_archive_link( 'course' ) .'" title="'. $courses_obj->labels->name .'" itemprop="url"><span itemprop="title">'. $courses_obj->labels->name .'</span></a>';
				$lessons_obj = get_post_type_object( 'lesson' );
				$lessons = '<a href="'. get_post_type_archive_link( 'lesson' ) .'" title="'. $lessons_obj->labels->name .'" itemprop="url"><span itemprop="title">'. $lessons_obj->labels->name .'</span></a>';
				$course_id = intval( get_post_meta( get_the_ID(), '_lesson_course', true ) );
				$course = '<a href="'. get_permalink( $course_id ) .'" title="'. get_the_title( $course_id ) .'" itemprop="url"><span itemprop="title">'. get_the_title( $course_id ) .'</span></a>';
				$trail = array_slice( $og_trail, 0, $offset, true ) + array(
					'courses_archive' => $courses,
					'lessons_archive' => $lessons,
					'lesson_course' => $course,
				) + array_slice( $og_trail, $offset, NULL, true);

			}

			// Add course to Module
			elseif ( is_tax( 'module' ) ) {
				if ( ! empty( $_GET['course_id'] ) ) {
					$course_id = esc_html( $_GET['course_id'] );
					$offset = 1;
					$og_trail = $trail;
					$courses_obj = get_post_type_object( 'course' );
					$courses = '<a href="'. get_post_type_archive_link( 'course' ) .'" title="'. $courses_obj->labels->name .'" itemprop="url"><span itemprop="title">'. $courses_obj->labels->name .'</span></a>';
					$lesson = '<a href="'. get_permalink( $course_id ) .'" title="'. get_the_title( $course_id ) .'" itemprop="url"><span itemprop="title">'. get_the_title( $course_id ) .'</span></a>';
					$trail = array_slice( $og_trail, 0, $offset, true ) + array(
						'post_type_archive' => $courses,
						'module_course' => $lesson
					) + array_slice( $og_trail, $offset, NULL, true);
				}
			}

			// Course Results
			else {
				global $wp_query;
				if ( isset( $wp_query->query_vars['course_results'] ) ) {

					// Add link to course
					$course = get_page_by_path( $wp_query->query_vars['course_results'], OBJECT, 'course' );
					$course_id = $course->ID;
					$trail['lesson_course'] = '<a href="'. get_permalink( $course_id ) .'" title="'. get_the_title( $course_id ) .'" itemprop="url"><span itemprop="title">'. get_the_title( $course_id ) .'</span></a>';

					// And trail end
					$trail['trail_end'] = esc_html__( 'Course Results', 'total' );

				}
			}

			// Return trail
			return $trail;

		}

		/**
		 * Set module term description above loop
		 *
		 * @since 3.0.8
		 */
		public function has_term_description_above_loop( $bool ) {
			if ( is_tax( 'module' ) ) {
				$bool = true;
			}
			return $bool;
		}

		/**
		 * Add title above module term description
		 *
		 * @since 3.0.8
		 */
		public function above_content_module_title( $bool ) {
			if ( is_tax( 'module' ) ) {
				echo '<h1>'. single_term_title( '', false ) .'</h1>';
			}
		}

		/**
		 * Adds background accents for Sensei
		 *
		 * @since 3.0.8
		 */
		public function accent_backgrounds( $backgrounds ) {
			$backgrounds = array_merge( array(
				'a.view-results',
				'a.view-results-link',
				'a.sensei-certificate-link',
				'.module header h2 a',
				'.course-container a.button',
				'.course-container a.button:visited',
				'.course-container a.comment-reply-link',
				'.course-container #commentform #submit',
				'.course-container .submit',
				'.course-container input[type=submit]',
				'.course-container input.button',
				'.course-container button.button',
				'.course a.button',
				'.course a.button:visited',
				'.course a.comment-reply-link',
				'.course #commentform #submit',
				'.course .submit',
				'.course input[type=submit]',
				'.course input.button',
				'.course button.button',
				'.lesson a.button',
				'.lesson a.button:visited',
				'.lesson a.comment-reply-link',
				'.lesson #commentform #submit',
				'.lesson .submit',
				'.lesson input[type=submit]',
				'.lesson input.button',
				'.lesson button.button',
				'.quiz a.button',
				'.quiz a.button:visited',
				'.quiz a.comment-reply-link',
				'.quiz #commentform #submit',
				'.quiz .submit',
				'.quiz input[type=submit]',
				'.quiz input.button',
				'.quiz button.button',
			), $backgrounds );
			return $backgrounds;
		}


	}
}
$wpex_sensei_config = new WPEX_Sensei_Config();
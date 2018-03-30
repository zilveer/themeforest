<?php if( !defined('THB_FRAMEWORK_NAME') ) exit('No direct script access allowed.');

/**
 * bbPress skin.
 */
if ( ! function_exists( 'thb_bbpress_skin' ) ) {
	function thb_bbpress_skin() {
		if( thb_is_bbpress() && thb_config( 'bbpress', 'skin') ) {

			thb_theme()->getFrontend()->addStyle( THB_TEMPLATE_URL . '/bbpress/css/thb-bbpress.css', array(
				'deps' => array(),
				'name' => 'thb_bbpress'
			));
		}
	}

	add_action( 'init', 'thb_bbpress_skin' );
}

/**
 * Remove forum and single topic summaries at the top of the page
 */

add_filter('bbp_get_single_forum_description', '__return_false', 10, 2 );
add_filter('bbp_get_single_topic_description', '__return_false', 10, 2 );


if ( ! function_exists( 'thb_bbpress_options' ) ) {
	/**
	 * Main page bbPress options tab.
	 */
	function thb_bbpress_options() {
		if( thb_is_bbpress() && thb_config( 'bbpress', 'options') ) {
			$thb_theme = thb_theme();
			$thb_page = $thb_theme->getAdmin()->getMainPage();

				$thb_tab = new THB_Tab( __('bbPress', 'thb_text_domain'), 'bbpress' );
					$thb_container = $thb_tab->createContainer( __('Forums page options', 'thb_text_domain'), 'bbpress_forums_page_options' );

					$thb_field = new THB_SelectField( 'forums_sidebar' );
						$thb_field->setLabel( __('Forums page sidebar', 'thb_text_domain') );
						$thb_field->setOptions(array(
							0 => __('No sidebar', 'thb_text_domain')
						));
						$thb_field->setOptions('thb_get_sidebars_for_select');
					$thb_container->addField($thb_field);

					$thb_field = new THB_SelectField( 'forums_sidebar_position' );
						$thb_field->setLabel( __('Forums page sidebar position', 'thb_text_domain') );
						$thb_field->setOptions(array(
							'sidebar-right' => __('Right', 'thb_text_domain'),
							'sidebar-left' => __('Left', 'thb_text_domain')
						));
					$thb_container->addField($thb_field);

				$thb_page->addTab($thb_tab);
		}
	}

	add_action( 'init', 'thb_bbpress_options' );
}

if ( ! function_exists( 'thb_forums_sidebar' ) ) {
	/**
	 * Return the class w-sidebar if sidebar is defined.
	 *
	 * @return array
	 */
	function thb_forums_sidebar( $classes ) {
		if( ! thb_is_bbpress() ) {
			return $classes;
		}

		if( bbp_is_forum_archive() || bbp_is_single_forum() ) {
			$classes_to_remove = array( 'w-sidebar', 'sidebar-left', 'sidebar-right' );

			foreach( $classes as $i => $class ) {
				if ( in_array( $class, $classes_to_remove ) ) {
					unset( $classes[$i] );
				}
			}

			$classes[] = thb_get_forums_sidebar_position();
		}

		return $classes;
	}

	add_filter( 'body_class', 'thb_forums_sidebar', 999 );
}

if ( ! function_exists( 'thb_get_forums_sidebar_position' ) ) {
	/**
	 * Return the Forums sidebar position.
	 *
	 * @return string
	 */
	function thb_get_forums_sidebar_position(  ) {
		if ( ! thb_is_bbpress() ) {
			return;
		}

		return thb_get_option( 'forums_sidebar_position' );
	}
}

if ( ! function_exists( 'thb_get_bbpress_forums_sidebar_name' ) ) {
	/**
	 * Return the bbPress forums page sidebar name.
	 *
	 * @return string
	 */
	function thb_get_bbpress_forums_sidebar_name() {
		if ( ! thb_is_bbpress() ) {
			return;
		}

		$sidebar_name = thb_get_option( 'forums_sidebar' );
		$sidebar_name = apply_filters( 'thb_get_bbpress_forums_sidebar_name', $sidebar_name );

		return $sidebar_name;
	}
}

if ( ! function_exists( 'thb_bbpress_body_classes' ) ) {
	/**
	 * Return the sidebar position and visibility classes.
	 *
	 * @return string
	 */
	function thb_bbpress_body_classes( $classes ) {
		if ( ! thb_is_bbpress() ) {
			return $classes;
		}

		if( bbp_is_forum_archive() || bbp_is_single_forum() ) {
			$sidebar_name = thb_get_bbpress_forums_sidebar_name();

			if( is_active_sidebar( $sidebar_name ) ) {
				$classes[] = 'w-sidebar';
				$classes[] = thb_get_option( $sidebar_name . '_position' );
			}
		}

		return $classes;
	}

	add_filter( 'body_class', 'thb_bbpress_body_classes', 999 );
}

if( !function_exists('thb_bbpress_forums_page_sidebar') ) {
	/**
	 * Apply the forums page sidebar
	 *
	 * @return string
	 */
	function thb_bbpress_forums_page_sidebar( $sidebar ) {
		if( bbp_is_forum_archive() || bbp_is_single_forum() ) {
			$sidebar = thb_get_bbpress_forums_sidebar_name();
		}

		return $sidebar;
	}

	add_filter( 'thb_page_sidebar', 'thb_bbpress_forums_page_sidebar' );
}
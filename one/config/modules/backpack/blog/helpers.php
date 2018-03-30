<?php if( !defined('THB_FRAMEWORK_NAME') ) exit('No direct script access allowed.');

if( ! function_exists( 'thb_author_block_enabled' ) ) {
	/**
	 * Check if the blog post author block should be displayed.
	 *
	 * @return boolean
	 */
	function thb_author_block_enabled( $id = null ) {
		if ( ! $id ) {
			global $post;
			$id = thb_get_page_ID();
		}

		$enable_author_block = thb_get_post_meta( $id, 'enable_author_block' ) == '1';
		$enable_author_block = apply_filters( 'thb_author_block_enabled', $enable_author_block );

		return $enable_author_block;
	}
}



if( ! function_exists( 'thb_navigation_block_enabled' ) ) {
	/**
	 * Check if the navigation between posts block should be displayed.
	 *
	 * @return boolean
	 */
	function thb_navigation_block_enabled() {
		return thb_get_post_meta( thb_get_page_ID(), 'disable_navigation_block' ) != '1';
	}
}

if( ! function_exists('thb_get_post_subtitle') ) {
	/**
	 * Get the post subtitle.
	 *
	 * @param int $id The page ID.
	 * @return string
	 */
	function thb_get_post_subtitle( $id = null ) {
		if ( ! $id ) {
			global $post;
			$id = thb_get_page_ID();
		}

		return thb_get_post_meta( $id, 'post_subtitle' );
	}
}

if( ! function_exists('thb_post_subtitle') ) {
	/**
	 * Get the post subtitle.
	 *
	 * @param int $id The page ID.
	 */
	function thb_post_subtitle( $id = null ) {
		echo thb_get_post_subtitle( $id );
	}
}

if ( ! function_exists( 'thb_thumbnails_open_posts' ) ) {
	/**
	 * Add a checkbox control to Blog pages to check if post thumbnails in Blog loops should link to the post page instead
	 * of opening their image or lightbox.
	 */
	function thb_thumbnails_open_posts() {
		$templates = thb_config( 'backpack/blog', 'templates' );

		if ( ! thb_config( 'backpack/blog', 'thumbnails_open_posts' ) ) {
			return;
		}

		$thb_field = new THB_CheckboxField( 'thumbnails_open_post' );
		$thb_field->setLabel( __('Post thumbnails open posts', 'thb_text_domain') );
		$thb_field->setHelp( __('If checked, post featured images in the loop will link to the post instead of the image/lightbox.', 'thb_text_domain') );

		if ( thb_is_admin_template( $templates ) ) {
			$metabox = thb_theme()->getPostType( 'page' )->getMetabox( 'layout' );

			if ( $metabox ) {
				$tab = $metabox->getTab( 'blog_loop' );

				if ( $tab ) {
					$container = $tab->getContainer( 'loop_container' );

					if ( $container ) {
						$container->addField($thb_field);
					}
				}
			}
		}

		$modal = thb_theme()->getAdmin()->getModal( 'thb_blog' );

		if ( $modal ) {
			$container = $modal->getContainer( 'thb_blog_container' );

			if ( $container ) {
				$thb_field = clone $thb_field;
				$container->addField($thb_field, -1);
			}
		}
	}

	add_action( 'wp_loaded', 'thb_thumbnails_open_posts', 11 );
}

if ( ! function_exists( 'thb_thumbnails_open_post' ) ) {
	/**
	 * Check if post thumbnails in Blog loops should link to the post page instead
	 * of opening their image or lightbox.
	 *
	 * @param integer $id
	 * @return boolean
	 */
	function thb_thumbnails_open_post( $id = null ) {
		if ( ! $id ) {
			$id = thb_get_page_ID();
		}

		return thb_get_post_meta( $id, 'thumbnails_open_post' ) == '1';
	}
}
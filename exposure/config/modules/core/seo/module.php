<?php if( !defined('THB_FRAMEWORK_NAME') ) exit('No direct script access allowed.');

/**
 * SEO module.
 *
 * ---
 *
 * The Happy Framework: WordPress Development Framework
 * Copyright 2012, Andrea Gandino & Simone Maranzana
 *
 * Licensed under The MIT License
 * Redistribuitions of files must retain the above copyright notice.
 *
 * @package Modules\Core\SEO
 * @author The Happy Bit <thehappybit@gmail.com>
 * @copyright Copyright 2012, Andrea Gandino & Simone Maranzana
 * @link http://
 * @since The Happy Framework v 1.0
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

$thb_theme = thb_theme();

/**
 * Load custom post type operations
 * -----------------------------------------------------------------------------
 */
if( thb_get_option('seo_enable') == 1 ) {
	include dirname(__FILE__) . '/posttype.php';
}

/**
 * SEO options tab
 * -----------------------------------------------------------------------------
 */
if( ! function_exists('thb_seo_options_tab') ) {
	function thb_seo_options_tab() {
		if( thb_is_super_user() ) {
			$thb_page = thb_theme()->getAdmin()->getMainPage();

			$thb_tab = new THB_Tab( __('SEO', 'thb_text_domain'), 'seo' );
				$thb_container = $thb_tab->createContainer( '', 'seo_options' );

					$thb_field = new THB_CheckboxField( 'seo_enable' );
						$thb_field->setLabel( __('Enable SEO', 'thb_text_domain') );
						$thb_field->setHelp( __('This option will enable the search engines optimization component. If you mind to use an external plugin, you might want to disable it.', 'thb_text_domain') );
					$thb_container->addField($thb_field);

					$thb_field = new THB_TextField('seo_author');
						$thb_field->setLabel( __('Site author', 'thb_text_domain') );
					$thb_container->addField($thb_field);

					$thb_field = new THB_TextareaField('seo_description');
						$thb_field->setLabel( __('Site description', 'thb_text_domain') );
					$thb_container->addField($thb_field);

					$thb_field = new THB_TextareaField('seo_keywords');
						$thb_field->setLabel( __('Keywords', 'thb_text_domain') );
					$thb_container->addField($thb_field);

					$thb_field = new THB_TextField('seo_robots');
						$thb_field->setLabel( __('Robots', 'thb_text_domain') );
					$thb_container->addField($thb_field);

					$thb_field = new THB_TextField('google_site_verification');
						$thb_field->setLabel( __('Google site verification', 'thb_text_domain') );
					$thb_container->addField($thb_field);

			$thb_page->addTab($thb_tab);
		}
	}

	add_action('after_setup_theme', 'thb_seo_options_tab');
}

/**
 * SEO logic
 * -----------------------------------------------------------------------------
 */
if( !function_exists('thb_seo') ) {
	function thb_seo() {
		if( is_404() ) {
			return;
		}

		if( !thb_get_option('seo_enable') ) {
			return;
		}

		echo "<!-- SEO -->\n";

		// SEO global data
		$url                 = is_front_page() ? home_url('/') : get_permalink();
		$author              = thb_get_option('seo_author');
		$robots              = thb_get_option('seo_robots');
		$description         = thb_get_option('seo_description');
		$keywords            = thb_get_option('seo_keywords');
		$google_verification = thb_get_option('google_site_verification');
		$title               = is_front_page() ? get_bloginfo('name') : get_the_title();
		$logo                = thb_get_option('main_logo');

		// Robots
		thb_meta('robots', $robots);

		// Author
		thb_meta('author', $author);

		// Description
		if( is_single() || is_page() ) {
			$single_description = thb_get_post_meta( thb_get_page_ID(), 'seo_description' );

			if( !empty($single_description) ) {
				$description = $single_description;
			}
			else {
				$post = get_post(thb_get_page_ID());
				$description = thb_get_the_excerpt($post);
			}
		}
		thb_meta('description', $description);

		// Keywords
		if( is_single() || is_page() ) {
			$single_keywords = thb_get_post_meta( thb_get_page_ID(), 'seo_keywords' );

			if( !empty($single_keywords) ) {
				$keywords .= ', ' . $single_keywords;
			}
		}
		thb_meta('keywords', $keywords);

		// News keywords
		if( is_single() ) {
			$tags = '';
			$post_tags = get_the_tags();

			if( !empty($post_tags) ) {
				$i=0;
				foreach( get_the_tags() as $tag ) {
					$tags .= ($i==0 ? '' : ',') .  $tag->name;
					$i++;
				}

				thb_meta('news_keywords', $tags);
			}
		}

		// Google site verification
		thb_meta('google-site-verification', $google_verification);

		// Facebook Open Graph
		// See: http://developers.facebook.com/docs/opengraph/
		echo "<!-- Open Graph -->\n";

		thb_meta('og:locale', get_bloginfo('language'));
		thb_meta('og:url', $url);
		thb_meta('og:site_name', get_bloginfo('name'));

		if( !empty($logo) ) {
			thb_meta('og:image', thb_image_get_size($logo['id'], 'full'));
		}

		thb_meta('og:title', $title);
		thb_meta('og:description', $description);
		thb_meta('og:type', is_single() ? 'article' : 'website');
	}
}

add_action('thb_head_meta', 'thb_seo');

if( !function_exists('thb_og_language_attribute') ) {
	function thb_og_language_attribute( $attrs ) {
		$attrs .= ' prefix="og: http://ogp.me/ns#"';

		return $attrs;
	}

	if( thb_get_option('seo_enable') ) {
		add_filter( 'language_attributes', 'thb_og_language_attribute' );
	}
}

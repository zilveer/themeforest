<?php if( !defined('THB_FRAMEWORK_NAME') ) exit('No direct script access allowed.');

/**
 * Blog.
 *
 * ---
 *
 * The Happy Framework: WordPress Development Framework
 * Copyright 2012, Andrea Gandino & Simone Maranzana
 *
 * Licensed under The MIT License
 * Redistribuitions of files must retain the above copyright notice.
 *
 * @package Modules\Core\Blog
 * @author The Happy Bit <thehappybit@gmail.com>
 * @copyright Copyright 2012, Andrea Gandino & Simone Maranzana
 * @link http://
 * @since The Happy Framework v 1.0
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

$thb_theme = thb_theme();

/**
 * Module configuration
 * -----------------------------------------------------------------------------
 */
$thb_config = array(
	/**
	 * Enabled blog post formats.
	 */
	'formats' => array('gallery', 'quote', 'video', 'image', 'aside', 'audio', 'link'),

	/**
	 * Enable filtering blog posts by a specific category in blog pages.
	 */
	'filter_by_category' => true,

	/**
	 * Enable the creation of a custom metabox in the post editing screen.
	 */
	'single' => true,

	/**
	 * A list of templates that implement the blog functionality.
	 */
	'templates' => array(),

	/**
	 * Enable the creation of an option to disable the "author" block.
	 */
	'enable_author_block' => false,

	/**
	 * Enable the creation of an option to disable the posts navigation block.
	 */
	'disable_navigation_block' => false
);
$thb_theme->setConfig('core/blog', thb_array_asum($thb_config, $config));

/**
 * Post type
 * -----------------------------------------------------------------------------
 */
$thb_posts = $thb_theme->getPostType('post');
$thb_pages = $thb_theme->getPostType('page');

/**
 * Page templates
 */
foreach( thb_config('core/blog', 'templates') as $template ) {
	$thb_posts->addPageTemplate($template);
}

/**
 * Single post options
 * -----------------------------------------------------------------------------
 */
if( thb_config('core/blog', 'single') ) {
	if( !function_exists('thb_add_post_metabox') ) {
		function thb_add_post_metabox() {
			$thb_posts = thb_theme()->getPostType('post');
			$thb_metabox = $thb_posts->getMetabox('layout');

			if( ! $thb_metabox ) {
				return;
			}

				if( thb_config('core/blog', 'enable_author_block') || thb_config('core/blog', 'disable_navigation_block') ) {
					$thb_container = $thb_metabox->createContainer( __('Post details', 'thb_text_domain'), 'single_display_settings' );

					if( thb_config('core/blog', 'enable_author_block') ) {
						$thb_field = new THB_CheckboxField( 'enable_author_block' );
							$thb_field->setLabel( __('Author section', 'thb_text_domain') );
							$thb_field->setHelp( __('Show a secondary section displaying the author\'s name, avatar and short bio.', 'thb_text_domain') );
						$thb_container->addField($thb_field);
					}

					if( thb_config('core/blog', 'disable_navigation_block') ) {
						$thb_field = new THB_CheckboxField( 'disable_navigation_block' );
							$thb_field->setLabel( __('Hide navigation', 'thb_text_domain') );
							$thb_field->setHelp( __('Hide the navigation between posts secondary section.', 'thb_text_domain') );
						$thb_container->addField($thb_field);
					}
				}

				$thb_container = $thb_metabox->createContainer( __('Related posts', 'thb_text_domain'), 'related' );

					$thb_field = new THB_CheckboxField( 'post_related' );
						$thb_field->setLabel( __('Enable a related posts section', 'thb_text_domain') );
						$thb_field->setHelp( __('Checking this control automatically creates a "related posts" section at the bottom of the post page.', 'thb_text_domain') );
						$thb_field->setDynamicDefault( 'thb_default_post_related' );
					$thb_container->addField($thb_field);

					$thb_field = new THB_NumberField('post_related_number');
						$thb_field->setLabel( __('Related posts to show', 'thb_text_domain') );
						$thb_field->setHelp( __('Choose how many related posts you want to display. Defaults to 3.', 'thb_text_domain') );
						$thb_field->setDynamicDefault( 'thb_default_post_related_number' );
					$thb_container->addField($thb_field);

					$thb_field = new THB_CheckboxField('post_related_thumb');
						$thb_field->setLabel( __('Show thumbnails in related posts', 'thb_text_domain') );
						$thb_field->setHelp( __('Checking this control enables the display of thumbnails for related posts.', 'thb_text_domain') );
						$thb_field->setDynamicDefault( 'thb_default_post_related_thumb' );
					$thb_container->addField($thb_field);

			$thb_metabox->getContainers();
			// thb_theme()->getPostType('post')->addMetabox( $thb_metabox );
		}

		add_action( 'wp_loaded', 'thb_add_post_metabox' );
	}
}

/**
 * Blog loop control metabox
 * -----------------------------------------------------------------------------
 */
if( thb_config('core/blog', 'filter_by_category') ) {
	if( !function_exists('thb_add_blog_filter_metabox') ) {
		function thb_add_blog_filter_metabox() {
			$thb_metabox = new THB_Metabox( __('Blog items', 'thb_text_domain'), 'loop' );
			$thb_metabox->setPriority('high');
			$thb_container = $thb_metabox->createContainer( '', 'loop_container' );
				$thb_field = new THB_QueryFilterField('post_query');
				$thb_field->setTaxonomies( thb_get_post_type_taxonomies('post') );
				$thb_container->addField($thb_field);

			thb_theme()->getPostType('post')->addMetaboxToPages($thb_metabox);
		}
	}

	add_action( 'wp_loaded', 'thb_add_blog_filter_metabox' );
}

/**
 * Create a custom 'post' entries loop.
 *
 * @return void
 */
if( !function_exists('thb_post_query') ) {
	function thb_post_query( $override=array() ) {
		global $wp_query;
		$post_type = 'post';
		$args = thb_post_type_query_args($post_type);
		$args = thb_array_asum($args, $override);
		thb_query_posts($post_type, $args);
	}
}

/**
 * Blog sidebars
 * -----------------------------------------------------------------------------
 */
$thb_theme->addSidebar( __('Blog sidebar', 'thb_text_domain'), 'post-sidebar' );
$thb_theme->addSidebar( __('Archives sidebar', 'thb_text_domain'), 'archives-sidebar' );
$thb_posts->setSidebar('post-sidebar');

if( !function_exists('thb_archives_sidebar') ) {
	function thb_archives_sidebar( $type='main', $class='' ) {
		thb_display_sidebar('archives-sidebar', $type, $class);
	}
}

/**
 * Blog archives body classes
 * -----------------------------------------------------------------------------
 */
if( !function_exists('thb_archives_body_classes') ) {
	function thb_archives_body_classes( $classes ) {
		if( is_archive() || is_search() ) {
			$sidebar = 'archives-sidebar';
			if( is_active_sidebar($sidebar) ) {
				$classes[] = 'w-sidebar';
			}
		}

		return $classes;
	}

	add_filter( 'body_class', 'thb_archives_body_classes' );
}

/**
 * The theme blog supported post formats
 * -----------------------------------------------------------------------------
 */
$thb_posts->setFormats( thb_config('core/blog', 'formats') );
$thb_wp_pre_36 = thb_is_wordpress_version_before(3.6);

if( ! $thb_wp_pre_36 ) {
	remove_filter( 'the_content', 'post_formats_compat', 7 );
}

foreach( $thb_posts->getFormats() as $format ) {

		switch( $format ) {
			case 'gallery':
				$thb_metabox = new THB_Metabox( __('Gallery', 'thb_text_domain'), $format );
				$thb_metabox->setPosition('thb_after_title');
				$thb_metabox->setPriority('high');
					$thb_container = $thb_metabox->createContainer( '', 'post_' . $format . '_details' );

					$field = new THB_GalleryField( 'gallery_shortcode' );
					$field->setLabel( __('Gallery shortcode', 'thb_text_domain') );
					$thb_container->addField($field);

				$thb_posts->addMetabox($thb_metabox);

				break;

			case 'link':
					$thb_metabox = new THB_Metabox( __('Link', 'thb_text_domain'), $format );
					$thb_metabox->setPosition('thb_after_title');
					$thb_metabox->setPriority('high');
						$thb_container = $thb_metabox->createContainer( '', 'post_' . $format . '_details' );

						$field = new THB_TextField( 'link_url' );
						$field->setLabel( __('URL', 'thb_text_domain') );
						$thb_container->addField($field);

					$thb_posts->addMetabox($thb_metabox);

				break;

			case 'quote':
					$thb_metabox = new THB_Metabox( __('Quote', 'thb_text_domain'), $format );
					$thb_metabox->setPosition('thb_after_title');
					$thb_metabox->setPriority('high');
						$thb_container = $thb_metabox->createContainer( '', 'post_' . $format . '_details' );

						$field = new THB_TextareaField( 'quote' );
						$field->setLabel( __('Text', 'thb_text_domain') );
						$field->setHelp( __('This is where your quote text goes.', 'thb_text_domain') );
						$thb_container->addField($field);

						$field = new THB_TextField( 'quote_author' );
						$field->setLabel( __('Author', 'thb_text_domain') );
						$field->setHelp( __('Optional', 'thb_text_domain') . '.' );
						$thb_container->addField($field);

						$field = new THB_TextField( 'quote_url' );
						$field->setLabel( __('URL', 'thb_text_domain') );
						$field->setHelp( __('Optional', 'thb_text_domain') . '.' );
						$thb_container->addField($field);

					$thb_posts->addMetabox($thb_metabox);

				break;

			case 'audio':
					$thb_metabox = new THB_Metabox( __('Audio', 'thb_text_domain'), $format );
					$thb_metabox->setPosition('thb_after_title');
					$thb_metabox->setPriority('high');
						$thb_container = $thb_metabox->createContainer( '', 'post_' . $format . '_details' );

						$field = new THB_TextField( 'audio_url' );
						$field->setLabel( __('URL', 'thb_text_domain') );
						$field->setHelp( __('Insert the URL to an audio file.', 'thb_text_domain') );
						$thb_container->addField($field);

					$thb_posts->addMetabox($thb_metabox);

				break;

			case 'video':
					$thb_metabox = new THB_Metabox( __('Video', 'thb_text_domain'), $format );
					$thb_metabox->setPosition('thb_after_title');
					$thb_metabox->setPriority('high');
						$thb_container = $thb_metabox->createContainer( '', 'post_' . $format . '_details' );

						$field = new THB_TextField( 'video_url' );
						$field->setLabel( __('URL', 'thb_text_domain') );
						$field->setHelp( __('Insert a YouTube or Vimeo video URL here (e.g. <code>http://vimeo.com/53407474</code>)', 'thb_text_domain') );
						$thb_container->addField($field);

					$thb_posts->addMetabox($thb_metabox);

				break;

			default:
				break;
		}
}
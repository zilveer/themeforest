<?php if( !defined('THB_FRAMEWORK_NAME') ) exit('No direct script access allowed.');

/**
 * Blog.
 *
 * ---
 *
 * The Happy Framework: WordPress Development Framework
 * Copyright 2014, Andrea Gandino & Simone Maranzana
 *
 * Licensed under The MIT License
 * Redistribuitions of files must retain the above copyright notice.
 *
 * @package Modules\Backpack\Blog
 * @author The Happy Bit <thehappybit@gmail.com>
 * @copyright Copyright 2014, Andrea Gandino & Simone Maranzana
 * @link http://
 * @since The Happy Framework v 2.0
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

$thb_theme = thb_theme();

/**
 * Module configuration
 * -----------------------------------------------------------------------------
 */
$thb_config = array(
	/**
	 * Set to true to create a subtitle text input on posts editing screen.
	 */
	'subtitle' => false,

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
	 * Set to true to automatically create a sidebar for the Blog and the archives.
	 */
	'sidebars' => false,

	/**
	 * Enable the creation of an option to disable the "author" block.
	 */
	'enable_author_block' => false,

	/**
	 * Enable the creation of an option to disable the posts navigation block.
	 */
	'disable_navigation_block' => false,

	/**
	 * Blog layouts enabled for builder blocks
	 */
	'builder_blog_layouts' => array(),

	/**
	 * True if post thumbnails in Blog loops should link to the post page instead
	 * of opening their image or lightbox.
	 */
	'thb_thumbnails_open_posts' => true
);
$thb_theme->setConfig('backpack/blog', thb_array_asum($thb_config, $config));

/**
 * Frontend helpers
 * -----------------------------------------------------------------------------
 */
require_once 'helpers.php';

if( ! function_exists('thb_module_blog_builder_blocks') ) {
	function thb_module_blog_builder_blocks() {
		if ( function_exists( 'thb_builder_instance' ) ) {
			require_once 'builder_blocks.php';
		}
	}

	add_action( 'wp_loaded', 'thb_module_blog_builder_blocks' );
}

/**
 * Load frontend post formats helpers
 * -----------------------------------------------------------------------------
 */
require_once 'formats.php';

/**
 * Load related posts helper
 * -----------------------------------------------------------------------------
 */
require_once dirname(__FILE__) . '/related.php';

/**
 * Post type
 * -----------------------------------------------------------------------------
 */
$thb_posts = $thb_theme->getPostType('post');
$thb_pages = $thb_theme->getPostType('page');

/**
 * Page templates
 */
foreach( thb_config('backpack/blog', 'templates') as $template ) {
	$thb_posts->addPageTemplate($template);
}

/**
 * Single post options
 * -----------------------------------------------------------------------------
 */
if( thb_config('backpack/blog', 'single') ) {
	if( !function_exists('thb_add_post_metabox') ) {
		function thb_add_post_metabox() {
			$thb_posts = thb_theme()->getPostType('post');
			$thb_metabox = $thb_posts->getMetabox('layout');

			if( ! $thb_metabox ) {
				return;
			}

				$thb_tab = $thb_metabox->createTab( __( 'Post display' , 'thb_text_domain'), 'single_display_settings' );
				$thb_tab->setIcon( 'welcome-widgets-menus' );

				if( thb_config('backpack/blog', 'enable_author_block') || thb_config('backpack/blog', 'subtitle') || thb_config('backpack/blog', 'disable_navigation_block') ) {
					$thb_container = $thb_tab->createContainer( __('Details', 'thb_text_domain'), 'single_display_settings' );

					if( thb_config('backpack/blog', 'subtitle') ) {
						$field = new THB_TextField( 'post_subtitle' );
						$field->setLabel( __( 'Post subtitle', 'thb_text_domain' ) );
						$thb_container->addField($field);
					}

					if( thb_config('backpack/blog', 'enable_author_block') ) {
						$thb_field = new THB_CheckboxField( 'enable_author_block' );
							$thb_field->setLabel( __('Author section', 'thb_text_domain') );
							$thb_field->setHelp( __('Show a secondary section displaying the author\'s name, avatar and short bio.', 'thb_text_domain') );
						$thb_container->addField($thb_field);
					}

					if( thb_config('backpack/blog', 'disable_navigation_block') ) {
						$thb_field = new THB_CheckboxField( 'disable_navigation_block' );
							$thb_field->setLabel( __('Hide navigation', 'thb_text_domain') );
							$thb_field->setHelp( __('Hide the navigation between posts secondary section.', 'thb_text_domain') );
						$thb_container->addField($thb_field);
					}
				}

				$thb_container = $thb_tab->createContainer( __('Related posts', 'thb_text_domain'), 'related' );

					$thb_field = new THB_CheckboxField( 'post_related' );
						$thb_field->setLabel( __('Show related posts', 'thb_text_domain') );
						$thb_field->setHelp( __('Checking this control automatically creates a "related posts" section at the bottom of the post page.', 'thb_text_domain') );
					$thb_container->addField($thb_field);

					$thb_field = new THB_NumberField('post_related_number');
						$thb_field->setDefault( '3' );
						$thb_field->setMin( '0' );
						$thb_field->setLabel( __('Posts to show', 'thb_text_domain') );
						$thb_field->setHelp( __('Choose how many related posts you want to display. Defaults to 3.', 'thb_text_domain') );
					$thb_container->addField($thb_field);

					$thb_field = new THB_CheckboxField('post_related_thumb');
						$thb_field->setLabel( __('Show thumbnails', 'thb_text_domain') );
						$thb_field->setHelp( __('Checking this control enables the display of thumbnails for related posts.', 'thb_text_domain') );
					$thb_container->addField($thb_field);

			$thb_metabox->getContainers();
		}

		add_action( 'wp_loaded', 'thb_add_post_metabox' );
	}
}

/**
 * Blog loop control metabox
 * -----------------------------------------------------------------------------
 */
if( thb_config( 'backpack/blog', 'filter_by_category' ) ) {
	if( !function_exists( 'thb_add_blog_filter_metabox' ) ) {
		function thb_add_blog_filter_metabox() {
			if ( ! thb_is_admin_template( thb_config( 'backpack/blog', 'templates' ) ) ) {
				return;
			}

			$thb_metabox = thb_theme()->getPostType( 'page' )->getMetabox( 'layout' );
			$thb_tab = $thb_metabox->createTab( __( 'Blog loop', 'thb_text_domain' ), 'blog_loop' );
			$thb_tab->setIcon( 'welcome-write-blog' );
			$thb_container = $thb_tab->createContainer( '', 'loop_container' );
				$thb_field = new THB_QueryFilterField('post_query');
				$thb_field->addClass('full');
				$thb_field->setTaxonomies( thb_get_post_type_taxonomies('post') );
				$thb_container->addField($thb_field);
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
		$args = thb_post_type_query_args( $post_type, null, $override );
		$args = thb_array_asum($args, $override);

		$args = apply_filters( 'thb_post_query_args', $args );

		thb_query_posts($post_type, $args);
	}
}

/**
 * Blog sidebars
 * -----------------------------------------------------------------------------
 */
if( ! function_exists('thb_blog_sidebars') ) {
	function thb_blog_sidebars() {
		if( thb_config('backpack/blog', 'sidebars') ) {
			$thb_theme = thb_theme();
			$thb_posts = $thb_theme->getPostType('post');

			$thb_theme->addSidebar( __('Blog sidebar', 'thb_text_domain'), 'post-sidebar', __( 'This widget area is intended to be used in blog pages.', 'thb_text_domain' ) );
			$thb_theme->addSidebar( __('Archives sidebar', 'thb_text_domain'), 'archives-sidebar', __( 'This widget area is intended to be used in blog archive pages.', 'thb_text_domain' ) );
			$thb_posts->setSidebar('post-sidebar');
		}
	}

	add_action( 'after_setup_theme', 'thb_blog_sidebars' );
}

if( !function_exists('thb_archives_sidebar') ) {
	/**
	 * Display the archives sidebar.
	 *
	 * @param string $type
	 * @param string $class
	 */
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
 * Admin body classes
 * -----------------------------------------------------------------------------
 */
if( ! function_exists( 'thb_blog_admin_body_classes' ) ) {
	function thb_blog_admin_body_classes( $classes ) {
		global $post_id;

		if ( 'post' == get_post_type( $post_id ) ) {
			$format = thb_get_post_format( $post_id );
			$classes = 'thb-post-format-' . $format;
		}

		return $classes;
	}

	add_filter( 'admin_body_class', 'thb_blog_admin_body_classes' );
}

/**
 * The theme blog supported post formats
 * -----------------------------------------------------------------------------
 */
$thb_posts->setFormats( thb_config('backpack/blog', 'formats') );
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

					$field = new THB_GalleryField( 'gallery_field' );
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
					$thb_metabox = new THB_Metabox( __( 'Audio', 'thb_text_domain' ), $format );
					$thb_metabox->setPosition( 'thb_after_title' );
					$thb_metabox->setPriority( 'high' );
						$thb_container = $thb_metabox->createContainer( '', 'post_' . $format . '_details' );

						$field = new THB_TextField( 'audio_url_mp3' );
						$field->setLabel( __('MP3', 'thb_text_domain') );
						$field->setHelp( __('Insert the URL to an MP3 audio file.', 'thb_text_domain') );
						$thb_container->addField($field);

						$field = new THB_TextField( 'audio_url_ogg' );
						$field->setLabel( __('Ogg', 'thb_text_domain') );
						$field->setHelp( __('Insert the URL to an Ogg audio file.', 'thb_text_domain') );
						$thb_container->addField($field);

						$field = new THB_TextField( 'audio_url_wav' );
						$field->setLabel( __('Wav', 'thb_text_domain') );
						$field->setHelp( __('Insert the URL to an Wav audio file.', 'thb_text_domain') );
						$thb_container->addField($field);

						$field = new THB_TextField( 'audio_url_embed' );
						$field->setLabel( __('Embed', 'thb_text_domain') );
						$field->setHelp( __('Alternatively, insert the URL to an external audio to be embedded.', 'thb_text_domain') );
						$thb_container->addField( $field );

					$thb_posts->addMetabox( $thb_metabox );

				break;

			case 'video':
					$thb_metabox = new THB_Metabox( __( 'Video', 'thb_text_domain' ), $format );
					$thb_metabox->setPosition( 'thb_after_title' );
					$thb_metabox->setPriority( 'high' );
						$thb_container = $thb_metabox->createContainer( '', 'post_' . $format . '_details' );

						$thb_field = new THB_VideoField( 'video_url' );
						$thb_field->setLabel( __('Video', 'thb_text_domain') );
						$thb_field->setHelp( __( 'Specify a selfhosted video with one of the supported formats, or embed a video from external services such as YouTube or Vimeo.<br><br>Please note that selfhosted videos will have precedence over embeds.', 'thb_text_domain' ) );
						$thb_container->addField( $thb_field );

					$thb_posts->addMetabox( $thb_metabox );

				break;

			default:
				break;
		}
}
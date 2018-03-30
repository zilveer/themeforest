<?php if( !defined('THB_FRAMEWORK_NAME') ) exit('No direct script access allowed.');

/**
 * Slideshow custom post type.
 *
 * ---
 *
 * The Happy Framework: WordPress Development Framework
 * Copyright 2012, Andrea Gandino & Simone Maranzana
 *
 * Licensed under The MIT License
 * Redistribuitions of files must retain the above copyright notice.
 *
 * @package Modules\Core\Slideshow
 * @author The Happy Bit <thehappybit@gmail.com>
 * @copyright Copyright 2012, Andrea Gandino & Simone Maranzana
 * @link http://
 * @since The Happy Framework v 1.0
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

/**
 * Slideshow control points
 * -----------------------------------------------------------------------------
 */
if( !function_exists('thb_slideshows_types') ) {
	/**
	 * Return an array of registered types for the Slideshow.
	 *
	 * @return array
	 */
	function thb_slideshows_types() {
		$types = array();

		return apply_filters('thb_slideshows_types', $types);
	}
}

if( !function_exists('thb_slideshow_contents') ) {
	/**
	 * Return an array of registered content types for the Slideshow slides.
	 *
	 * @return array
	 */
	function thb_slideshow_contents() {
		$contents = array(
			0      => __('Slides', 'thb_text_domain'),
			'post' => __('Entries from the Blog', 'thb_text_domain')
		);

		return apply_filters('thb_slideshow_contents', $contents);
	}
}

/**
 * Slideshow post type
 * -----------------------------------------------------------------------------
 */
if( !function_exists('thb_create_slideshows_posttype') ) {
	/**
	 * Create a Slideshow custom post type and add it to the theme.
	 *
	 * @return void
	 */
	function thb_create_slideshows_posttype() {
		/**
		 * The post type labels.
		 *
		 * @see http://codex.wordpress.org/Function_Reference/register_post_type
		 */
		$thb_slideshows_labels = array(
			'name'               => __('Slideshows', 'thb_text_domain'),
			'singular_name'      => __('Slideshow', 'thb_text_domain'),
			'add_new'            => __('Add new', 'thb_text_domain'),
			'add_new_item'       => __('Add new Slideshow', 'thb_text_domain'),
			'edit'               => __('Edit', 'thb_text_domain'),
			'edit_item'          => __('Edit Slideshow', 'thb_text_domain'),
			'new_item'           => __('New Slideshow', 'thb_text_domain'),
			'view'               => __('View Slideshow', 'thb_text_domain'),
			'view_item'          => __('View Slideshow', 'thb_text_domain'),
			'search_items'       => __('Search Slideshows', 'thb_text_domain'),
			'not_found'          => __('No Slideshows found', 'thb_text_domain'),
			'not_found_in_trash' => __('No Slideshows found in Trash', 'thb_text_domain'),
			'parent'             => __('Parent Slideshow', 'thb_text_domain')
		);

		/**
		 * The post type arguments.
		 *
		 * @see http://codex.wordpress.org/Function_Reference/register_post_type
		 */
		$thb_slideshows_args = array(
			'labels'            => $thb_slideshows_labels,
			'public'            => true,
			'show_ui'           => true,
			'capability_type'   => 'post',
			'hierarchical'      => false,
			'rewrite'           => array( 'slug' => 'slideshows', 'with_front' => true ),
			'query_var'         => true,
			'show_in_nav_menus' => false,
			'supports'          => array('title')
		);

		/**
		 * Create the post type object.
		 */
		$thb_slideshows = new THB_PostType('slideshows', $thb_slideshows_args);
		$thb_slideshows->setPublicContent(false);

		/**
		 * Add the post type to the theme instance.
		 */
		thb_theme()->addPostType($thb_slideshows);

		/**
		 * Post type metaboxes
		 */
		add_action('wp_loaded', 'thb_add_slideshows_posttype_config_metabox');
		add_action('wp_loaded', 'thb_add_slideshows_posttype_slides_metabox');

		/**
		 * Admin UI customizations
		 */
		add_filter('manage_edit-slideshows_columns' , 'listTableAddPicsColumn');
		add_action('manage_posts_custom_column', 'listTablePicsColumnContent', 10, 2);

		if( !function_exists('listTableAddPicsColumn') ) {
			function listTableAddPicsColumn($defaults) {
				$link = __('Slides', 'thb_text_domain');
				$insertAt = 4;

				$defaults = array_slice($defaults, 0, $insertAt, true) +
				    array('slides' => $link) +
				    array_slice($defaults, $insertAt, count($defaults)-$insertAt, true);

				$link = __('Shortcode', 'thb_text_domain');
				$insertAt = 3;

				$defaults = array_slice($defaults, 0, $insertAt, true) +
				    array('shortcode' => $link) +
				    array_slice($defaults, $insertAt, count($defaults)-$insertAt, true);

				$link = __('Type', 'thb_text_domain');
				$insertAt = 5;

				$defaults = array_slice($defaults, 0, $insertAt, true) +
				    array('type' => $link) +
				    array_slice($defaults, $insertAt, count($defaults)-$insertAt, true);

				unset($defaults['date']);

				return $defaults;
			}
		}

		if( !function_exists('listTablePicsColumnContent') ) {
			function listTablePicsColumnContent($column_name, $id) {
				if( $column_name == 'slides' ) {
					$slideshow = new THB_Slideshow($id);
					foreach( $slideshow->getSlides() as $slide ) {
						$thumb = $slide['thumb'];

						echo '<img src="' . $thumb . '" alt="" class="list-thumb ' . $slide['type'] . '">';
					}
				}
				elseif( $column_name == 'shortcode' ) {
					echo '<code>[thb_slideshow id="' . $id . '"]</code>';
				}
				elseif( $column_name == 'type' ) {
					$types = thb_slideshows_types();
					if( isset($types[thb_get_post_meta($id, 'slideshow_type')]) ) {
						echo $types[thb_get_post_meta($id, 'slideshow_type')];
					}
				}
			}
		}
	}
}

if( ! function_exists('thb_create_slideshows_posttype_config_container') ) {
	function thb_create_slideshows_posttype_config_container( $label='', $slug='slideshow_config_container' ) {
		/**
		 * Base configuration fields container.
		 */
		$thb_container = new THB_MetaboxFieldsContainer( '', $slug);

		$field = new THB_NumberField( 'delay' );
		$field->setLabel( __('Delay', 'thb_text_domain') );
		$field->setHelp( __('Expressed in seconds.', 'thb_text_domain') );
		$field->setPlaceholder( __('E.g. 5', 'thb_text_domain') );
		$thb_container->addField($field);

		$field = new THB_NumberField( 'transition_speed' );
		$field->setLabel( __('Transition speed', 'thb_text_domain') );
		$field->setHelp( __('Expressed in seconds.', 'thb_text_domain') );
		$field->setPlaceholder( __('E.g. 1', 'thb_text_domain') );
		$field->setMin('0');
		$field->setStep('0.05');
		$thb_container->addField($field);

		$thb_field = new THB_SelectField('slideshow_type');
		$thb_field->setLabel( __('Type', 'thb_text_domain') );
		$thb_field->setDynamicOptions('thb_slideshows_types');
		$thb_field->setInvisibleIfEmpty(true);
		$thb_container->addField($thb_field);

		return $thb_container;
	}
}

if( !function_exists('thb_create_slideshows_posttype_config_metabox') ) {
	/**
	 * Create a configuration metabox in Slideshow post type pages.
	 *
	 * @return THB_Metabox
	 */
	function thb_create_slideshows_posttype_config_metabox() {
		$thb_metabox = new THB_Metabox( __('Configuration', 'thb_text_domain'), 'slideshow_config' );
		$thb_metabox->setPriority('high');
		$thb_metabox->addContainer( thb_create_slideshows_posttype_config_container() );

		return $thb_metabox;
	}
}

if( !function_exists('thb_add_slideshows_posttype_config_metabox') ) {
	/**
	 * Add a configuration metabox in Slideshow post type pages.
	 *
	 * @return void
	 */
	function thb_add_slideshows_posttype_config_metabox() {
		$thb_slideshows = thb_theme()->getPostType('slideshows');

		$thb_slideshows->addMetabox( thb_create_slideshows_posttype_config_metabox() );
	}
}

if( !function_exists('thb_create_slideshows_slides_container') ) {
	/**
	 * Create the duplicable fields container for image and video slides.
	 *
	 * @param string $label The fields container label.
	 * @return THB_MetaboxDuplicableFieldsContainer
	 */
	function thb_create_slideshows_slides_container( $label='', $config=array() ) {
		$config = thb_array_asum(array(
			'slug'       => 'slides_container',
			'slides_key' => THB_SLIDES,
			'captions'   => true,
			'images'     => true,
			'videos'     => true
		), $config);

		extract($config);

		$thb_container = new THB_MetaboxDuplicableFieldsContainer( $label, $slug );
		$thb_container->setSortable();

		if( $images ) {
			$thb_container->addControl( __('Add images', 'thb_text_domain'), 'add_image', 'images.png', array(
				'action' => 'thb_add_multiple_slides',
				'title'  => __('Add image slides', 'thb_text_domain')
			) );
		}

		if( $videos ) {
			$thb_container->addControl( __('Add video', 'thb_text_domain'), 'add_video', 'film.png' );
		}

		$field = new THB_SlideField( $slides_key );
		$field->setLabel( __('Slide', 'thb_text_domain') );

		if( !$captions ) {
			$field->disableCaptions();
		}

		$thb_container->setField($field);

		return $thb_container;
	}
}

if( !function_exists('thb_create_slideshows_posttype_slides_metabox') ) {
	/**
	 * Create a slides metabox in Slideshow post type pages.
	 *
	 * @return THB_Metabox
	 */
	function thb_create_slideshows_posttype_slides_metabox() {
		$thb_metabox = new THB_Metabox( __('Slideshow contents', 'thb_text_domain'), 'slideshow_contents' );
		$thb_metabox->setPriority('high');

		$thb_container = new THB_MetaboxFieldsContainer('', 'slideshow_contents_container');
			$thb_field = new THB_SelectField('slideshow_contents');
			$thb_field->setLabel( __('Select slides from', 'thb_text_domain') );
			$thb_field->setDynamicOptions('thb_slideshow_contents');
			$thb_container->addField($thb_field);

		$thb_metabox->addContainer($thb_container);

		$thb_container = thb_create_slideshows_slides_container();

		$thb_metabox->addContainer($thb_container);

		$contents = thb_slideshow_contents();
		$contents_taxonomies = array();

		foreach( $contents as $post_type => $label ) {
			if( !is_numeric($post_type) ) {
				foreach( thb_get_post_type_taxonomies($post_type) as $tax ) {
					$contents_taxonomies[] = $tax;
				}
			}
		}

		$thb_container = new THB_MetaboxFieldsContainer( '', 'slideshow_contents_details_container' );
			$thb_field = new THB_QueryFilterField('slideshows_query');
			$thb_field->setTaxonomies( $contents_taxonomies );
			$thb_container->addField($thb_field);

		$thb_metabox->addContainer($thb_container);

		return $thb_metabox;
	}
}

if( !function_exists('thb_add_slideshows_posttype_slides_metabox') ) {
	/**
	 * Add a slides metabox in Slideshow post type pages.
	 *
	 * @return void
	 */
	function thb_add_slideshows_posttype_slides_metabox() {
		$thb_slideshows = thb_theme()->getPostType('slideshows');

		$thb_slideshows->addMetabox( thb_create_slideshows_posttype_slides_metabox() );
	}
}

if( !function_exists('thb_create_slideshows_shortcode') ) {
	/**
	 * Create a Slideshow shortcodes to be used in pages and contents.
	 *
	 * @return void
	 */
	function thb_create_slideshows_shortcode() {
		$shortcode = new THB_Shortcode('thb_slideshow', 'shortcode', 'core/slideshows');
		$shortcode->setAttributes(array(
			'id'        => 0,
			'markup_id' => ''
		));
		$shortcode->setExample('[thb_slideshow id="..."]');
		$shortcode->setLabel( __('Slideshow', 'thb_text_domain') );
		$shortcode->setType( __('Layout', 'thb_text_domain') );
		thb_theme()->addShortcode($shortcode);
	}
}

if( !function_exists('thb_create_entry_slideshow_metabox') ) {
	/**
	 * Create a Slideshow metabox.
	 *
	 * @return THB_Metabox
	 */
	function thb_create_entry_slideshow_metabox() {
		$thb_metabox = new THB_Metabox( __('Slideshow', 'thb_text_domain'), 'page-slideshow' );
			$thb_container = $thb_metabox->createContainer( '', 'config' );

				$field = new THB_TextField( 'slideshow' );
				$field->setHelp( __('Use <code>[thb_slideshow id="1"]</code> to include a slideshow.', 'thb_text_domain') );
				$thb_container->addField($field);

		return $thb_metabox;
	}
}

if( !function_exists('thb_add_entry_slideshow_metabox') ) {
	/**
	 * Add a Slideshow metabox to the specified page templates.
	 *
	 * @param array $templates The page templates.
	 * @return void
	 */
	function thb_add_entry_slideshow_metabox( $templates ) {
		$thb_metabox = thb_create_entry_slideshow_metabox();

		foreach( $templates as $template ) {
			$post_type = thb_theme()->getPostType( thb_get_post_type_from_template($template) );

			if( thb_is_admin_template($template) ) {
				$post_type->addMetabox($thb_metabox);
			}
		}
	}
}
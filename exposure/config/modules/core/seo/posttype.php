<?php if( !defined('THB_FRAMEWORK_NAME') ) exit('No direct script access allowed.');

/**
 * SEO custom post type.
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

/**
 * Create the SEO management metabox.
 *
 * @param string $post_type The post type.
 * @return void
 */
if( !function_exists('thb_seo_init') ) {
	function thb_seo_init( $post_type ) {
		$thb_metabox = new THB_Metabox( __('SEO', 'thb_text_domain'), 'seo' );
		$thb_metabox->setPosition('side');

			$thb_container = $thb_metabox->createContainer( '', 'seo_container' );

				$thb_field = new THB_TextareaField('seo_description');
					$thb_field->setLabel( __('Description', 'thb_text_domain') );
				$thb_container->addField($thb_field);

				$thb_field = new THB_TextareaField('seo_keywords');
					$thb_field->setLabel( __('Keywords', 'thb_text_domain') );
				$thb_container->addField($thb_field);

		$post_type->addMetabox($thb_metabox);
	}
}

/**
 * Post types
 * -----------------------------------------------------------------------------
 */
$thb_post_types = $thb_theme->getPostTypes();

foreach( $thb_post_types as $post_type ) {
	if( $post_type->isPublicContent() ) {
		thb_seo_init($post_type);
	}
}
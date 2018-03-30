<?php if( !defined('THB_FRAMEWORK_NAME') ) exit('No direct script access allowed.');

/**
 * Theme options.
 *
 * ---
 *
 * The Happy Framework: WordPress Development Framework
 * Copyright 2012, Andrea Gandino & Simone Maranzana
 *
 * Licensed under The MIT License
 * Redistribuitions of files must retain the above copyright notice.
 *
 * @package Config
 * @author The Happy Bit <thehappybit@gmail.com>
 * @copyright Copyright 2012, Andrea Gandino & Simone Maranzana
 * @link http://
 * @since The Happy Framework v 1.0
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

$thb_theme = thb_theme();

/**
 * OPTIONS
 * -----------------------------------------------------------------------------
 */

// Main options page and default tabs

$thb_page = $thb_theme->getAdmin()->getMainPage();

	/**
	 * Images
	 */
	$thb_tab = $thb_page->getTab('general_images');
	
	$thb_container = $thb_tab->getContainer( 'general_images_options' );
		$thb_field = new THB_UploadField('white_main_logo');
			$thb_field->setLabel( __('White logo', 'thb_text_domain') );
			$thb_field->setHelp( __('Upload an image to be used as a logo for your site. If this field is left empty, a simple text logo will be used. Please remember to load a properly dimensioned logo.', 'thb_text_domain') );
		$thb_container->addField($thb_field, 2);

		$thb_field = new THB_UploadField('white_main_logo_retina');
			$thb_field->setLabel( __('White retina logo', 'thb_text_domain') );
			$thb_field->setHelp( __('Upload an image to be used as a logo for your site for high definition screens. Please remember to load a properly dimensioned logo (usually you can double the size of the regular logo).', 'thb_text_domain') );
		$thb_container->addField($thb_field, 3);

	/**
	 * Layout
	 */
	$thb_tab = $thb_page->getTab('layout');

	$thb_container = $thb_tab->createContainer( __( 'Layout options', 'thb_text_domain' ), 'layout_social_footer' );

		$thb_field = new THB_SelectField( 'layout_width' );
			$thb_field->setLabel( __( 'Layout width', 'thb_text_domain' ) );
			$thb_field->setOptions(array(
				'layout-width-extended' => __('Extended', 'thb_text_domain'),
				'layout-width-boxed'    => __('Boxed', 'thb_text_domain')
			));
		$thb_container->addField($thb_field);

		$thb_field = new THB_GraphicRadioField( 'header_layout' );
			$thb_field->setLabel( __( 'Header layout', 'thb_text_domain' ) );
			$thb_field->setOptions(array(
				'layout-a' => get_template_directory_uri() . '/css/i/options/header-layout-a.png',
				'layout-b' => get_template_directory_uri() . '/css/i/options/header-layout-b.png'
			));
		$thb_container->addField($thb_field);

		$thb_field = new THB_CheckboxField( 'thb_sticky_header' );
			$thb_field->setLabel( __( 'Enable the sticky header' , 'thb_text_domain') );
			$thb_field->setHelp( __('Tick if you want to stick the page header to the top when scrolling.', 'thb_text_domain') );
		$thb_container->addField($thb_field);

		$thb_field = new THB_CheckboxField( 'thb_enable_search' );
			$thb_field->setLabel( __( 'Enable search on header' , 'thb_text_domain') );
			$thb_field->setHelp( __('Tick if you want to enable the search icon on the header main navigation area.', 'thb_text_domain') );
		$thb_container->addField($thb_field);

		$thb_field = new THB_CheckboxField( 'thb_disable_fittext' );
			$thb_field->setLabel( __( 'Disable the FitText script' , 'thb_text_domain') );
			$thb_field->setHelp( __('Tick if you want to disable the FitText plugin for the big headlines<br>i.e. if you want to specify an alternative size and control the responsive appearance manually.', 'thb_text_domain') );
		$thb_container->addField($thb_field);

	$thb_container = $thb_tab->createContainer( __( 'Social', 'thb_text_domain' ), 'layout_social_footer' );

		$thb_field = new THB_CheckboxField( 'enable_social_share' );
			$thb_field->setLabel( __( 'Enable the social share links' , 'thb_text_domain') );
			$thb_field->setHelp( __('Tick if you want to enable the social share links (Facebook, Pinterest, Twitter, Googleplus and email) on each blog single post.', 'thb_text_domain') );
		$thb_container->addField($thb_field);

		$thb_field = new THB_MultipleSelectField('social_networks');
			$thb_field->setLabel( __('Social networks in the footer area', 'thb_text_domain') );
			$thb_field->setOptions( 'thb_get_theme_social_options' );
		$thb_container->addField($thb_field);

		$thb_field = new THB_CheckboxField( 'thb_blog_likes_active' );
			$thb_field->setLabel( __( 'Activate likes for Blog posts', 'thb_text_domain' ) );
		$thb_container->addField($thb_field);

	$thb_container = $thb_tab->createContainer( __('Responsive', 'thb_text_domain'), 'responsive_options' );

		$thb_field = new THB_CheckboxField( 'enable_responsive_768' );
			$thb_field->setLabel( __( sprintf('Enable below <code>%s</code>', '960px') , 'thb_text_domain') );
			$thb_field->setHelp( __('Tick if you want to enable the responsive layout feature below 960px, eg. Tablet devices.', 'thb_text_domain') );
		$thb_container->addField($thb_field);

		$thb_field = new THB_CheckboxField( 'enable_responsive_480' );
			$thb_field->setLabel( __( sprintf('Enable below <code>%s</code>', '768px') , 'thb_text_domain') );
			$thb_field->setHelp( __('Tick if you want to enable the responsive layout feature below 768px, eg. Mobile devices.', 'thb_text_domain') );
		$thb_container->addField($thb_field);

	/**
	 * Social options tab
	 * -----------------------------------------------------------------------------
	 */
	$thb_tab = new THB_Tab( __('Social', 'thb_text_domain'), 'social' );
		$thb_container = $thb_tab->createContainer( '', 'social_options' );

		$thb_field = new THB_TextField('social_forrst');
			$thb_field->setLabel( __('Forrst', 'thb_text_domain') );
			$thb_field->setHelp( __('Enter your Forrst URL.', 'thb_text_domain') );
		$thb_container->addField($thb_field);

		$thb_field = new THB_TextField('social_youtube');
			$thb_field->setLabel( __('Youtube', 'thb_text_domain') );
			$thb_field->setHelp( __('Enter your Youtube URL.', 'thb_text_domain') );
		$thb_container->addField($thb_field);

		$thb_field = new THB_TextField('social_behance');
			$thb_field->setLabel( __('Behance', 'thb_text_domain') );
			$thb_field->setHelp( __('Enter your Behance URL.', 'thb_text_domain') );
		$thb_container->addField($thb_field);

		$thb_field = new THB_TextField('social_picasa');
			$thb_field->setLabel( __('Picasa', 'thb_text_domain') );
			$thb_field->setHelp( __('Enter your Picasa URL.', 'thb_text_domain') );
		$thb_container->addField($thb_field);

		$thb_field = new THB_TextField('social_skype');
			$thb_field->setLabel( __('Skype', 'thb_text_domain') );
			$thb_field->setHelp( __('Enter your Skype URL.', 'thb_text_domain') );
		$thb_container->addField($thb_field);

		$thb_field = new THB_TextField('social_dribbble');
			$thb_field->setLabel( __('Dribbble', 'thb_text_domain') );
			$thb_field->setHelp( __('Enter your Dribbble URL.', 'thb_text_domain') );
		$thb_container->addField($thb_field);

		$thb_field = new THB_TextField('social_twitter');
			$thb_field->setLabel( __('Twitter', 'thb_text_domain') );
			$thb_field->setHelp( __('Enter your Twitter URL.', 'thb_text_domain') );
		$thb_container->addField($thb_field);

		$thb_field = new THB_TextField('social_vimeo');
			$thb_field->setLabel( __('Vimeo', 'thb_text_domain') );
			$thb_field->setHelp( __('Enter your Vimeo URL.', 'thb_text_domain') );
		$thb_container->addField($thb_field);

		$thb_field = new THB_TextField('social_facebook');
			$thb_field->setLabel( __('Facebook', 'thb_text_domain') );
			$thb_field->setHelp( __('Enter your Facebook URL.', 'thb_text_domain') );
		$thb_container->addField($thb_field);

		$thb_field = new THB_TextField('social_rss');
			$thb_field->setLabel( __('RSS', 'thb_text_domain') );
			$thb_field->setHelp( __('Enter your RSS URL.', 'thb_text_domain') );
		$thb_container->addField($thb_field);

		$thb_field = new THB_TextField('social_pinterest');
			$thb_field->setLabel( __('Pinterest', 'thb_text_domain') );
			$thb_field->setHelp( __('Enter your Pinterest URL.', 'thb_text_domain') );
		$thb_container->addField($thb_field);

		$thb_field = new THB_TextField('social_soundcloud');
			$thb_field->setLabel( __('SoundCloud', 'thb_text_domain') );
			$thb_field->setHelp( __('Enter your SoundCloud URL.', 'thb_text_domain') );
		$thb_container->addField($thb_field);

		$thb_field = new THB_TextField('social_spotify');
			$thb_field->setLabel( __('Spotify', 'thb_text_domain') );
			$thb_field->setHelp( __('Enter your Spotify URL.', 'thb_text_domain') );
		$thb_container->addField($thb_field);

		$thb_field = new THB_TextField('social_googleplus');
			$thb_field->setLabel( __('GooglePlus', 'thb_text_domain') );
			$thb_field->setHelp( __('Enter your GooglePlus URL.', 'thb_text_domain') );
		$thb_container->addField($thb_field);

		$thb_field = new THB_TextField('social_deviantart');
			$thb_field->setLabel( __('deviantArt', 'thb_text_domain') );
			$thb_field->setHelp( __('Enter your deviantArt URL.', 'thb_text_domain') );
		$thb_container->addField($thb_field);

		$thb_field = new THB_TextField('social_flickr');
			$thb_field->setLabel( __('Flickr', 'thb_text_domain') );
			$thb_field->setHelp( __('Enter your Flickr URL.', 'thb_text_domain') );
		$thb_container->addField($thb_field);

		$thb_field = new THB_TextField('social_five100px');
			$thb_field->setLabel( __('500px', 'thb_text_domain') );
			$thb_field->setHelp( __('Enter your 500px URL.', 'thb_text_domain') );
		$thb_container->addField($thb_field);

		$thb_field = new THB_TextField('social_instagram');
			$thb_field->setLabel( __('Instagram', 'thb_text_domain') );
			$thb_field->setHelp( __('Enter your Instagram URL.', 'thb_text_domain') );
		$thb_container->addField($thb_field);

		$thb_field = new THB_TextField('social_linkedin');
			$thb_field->setLabel( __('LinkedIn', 'thb_text_domain') );
			$thb_field->setHelp( __('Enter your LinkedIn URL.', 'thb_text_domain') );
		$thb_container->addField($thb_field);

		$thb_field = new THB_TextField('social_tumblr');
			$thb_field->setLabel( __('Tumblr', 'thb_text_domain') );
			$thb_field->setHelp( __('Enter your Tumblr URL.', 'thb_text_domain') );
		$thb_container->addField($thb_field);

	$thb_page->addTab($thb_tab, 50);
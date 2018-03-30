<?php if( !defined('THB_FRAMEWORK_NAME') ) exit('No direct script access allowed.');

/**
 * Social module.
 *
 * ---
 *
 * The Happy Framework: WordPress Development Framework
 * Copyright 2012, Andrea Gandino & Simone Maranzana
 *
 * Licensed under The MIT License
 * Redistribuitions of files must retain the above copyright notice.
 *
 * @package Modules\Core\Social
 * @author The Happy Bit <thehappybit@gmail.com>
 * @copyright Copyright 2012, Andrea Gandino & Simone Maranzana
 * @link http://
 * @since The Happy Framework v 1.0
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

$thb_theme = thb_theme();

/**
 * Social options tab
 * -----------------------------------------------------------------------------
 */
$thb_page = $thb_theme->getAdmin()->getMainPage();

$thb_tab = new THB_Tab( __('Social', 'thb_text_domain'), 'social' );
	$thb_container = $thb_tab->createContainer( '', 'social_options' );

	$thb_field = new THB_TextField('social_twitter');
		$thb_field->setLabel( __('Twitter', 'thb_text_domain') );
		$thb_field->setHelp( __('Enter your Twitter URL.', 'thb_text_domain') );
	$thb_container->addField($thb_field);

	$thb_field = new THB_TextField('social_facebook');
		$thb_field->setLabel( __('Facebook', 'thb_text_domain') );
		$thb_field->setHelp( __('Enter your Facebook URL.', 'thb_text_domain') );
	$thb_container->addField($thb_field);

	$thb_field = new THB_TextField('social_googleplus');
		$thb_field->setLabel( __('Google+', 'thb_text_domain') );
		$thb_field->setHelp( __('Enter your Google+ URL', 'thb_text_domain') );
	$thb_container->addField($thb_field);

	$thb_field = new THB_TextField('social_flickr');
		$thb_field->setLabel( __('Flickr', 'thb_text_domain') );
		$thb_field->setHelp( __('Enter your Flickr URL.', 'thb_text_domain') );
	$thb_container->addField($thb_field);

	$thb_field = new THB_TextField('social_youtube');
		$thb_field->setLabel( __('Youtube', 'thb_text_domain') );
		$thb_field->setHelp( __('Enter your Youtube URL.', 'thb_text_domain') );
	$thb_container->addField($thb_field);

	$thb_field = new THB_TextField('social_vimeo');
		$thb_field->setLabel( __('Vimeo', 'thb_text_domain') );
		$thb_field->setHelp( __('Enter your Vimeo URL.', 'thb_text_domain') );
	$thb_container->addField($thb_field);

	$thb_field = new THB_TextField('social_pinterest');
		$thb_field->setLabel( __('Pinterest', 'thb_text_domain') );
		$thb_field->setHelp( __('Enter your Pinterest URL.', 'thb_text_domain') );
	$thb_container->addField($thb_field);

	$thb_field = new THB_TextField('social_dribbble');
		$thb_field->setLabel( __('Dribbble', 'thb_text_domain') );
		$thb_field->setHelp( __('Enter your Dribbble URL.', 'thb_text_domain') );
	$thb_container->addField($thb_field);

	$thb_field = new THB_TextField('social_forrst');
		$thb_field->setLabel( __('Forrst', 'thb_text_domain') );
		$thb_field->setHelp( __('Enter your Forrst URL.', 'thb_text_domain') );
	$thb_container->addField($thb_field);

	$thb_field = new THB_TextField('social_linkedin');
		$thb_field->setLabel( __('LinkedIn', 'thb_text_domain') );
		$thb_field->setHelp( __('Enter your LinkedIn URL.', 'thb_text_domain') );
	$thb_container->addField($thb_field);

	$thb_container = $thb_tab->createContainer( __('Twitter API', 'thb_text_domain'), 'twitter_api_options' );

	$thb_container->setIntroText(__('
<strong>As per version 1.1 of the official Twitter API system, the following settings are REQUIRED in order for the Twitter widget and shortcode to work.</strong>
<ol>
	<li>Go to the <a target="_blank" href="https://dev.twitter.com/apps">My applications</a> page on the Twitter website to set up your website as a new Twitter \'application\'. You may need to log-in using your Twitter user name and password.</li>
	<li>If you don\'t already have a suitable \'application\' that you can use for your website, set one up on the <a target="_blank" href="https://dev.twitter.com/apps/new">Create an Application page</a>. It\'s normally best to use the name, description and website URL of the website where you plan to use Rotating Tweets. You don\'t need a Callback URL.</li>
	<li>After clicking <strong>Create your Twitter application</strong>, on the following page, click on <strong>Create my access token</strong>.</li>
	<li>Copy the <strong>Consumer key</strong>, <strong>Consumer secret</strong>, <strong>Access token</strong> and <strong>Access token secret</strong> from your Twitter application page into the settings below.</li>
</ol>', 'thb_text_domain'));

	$thb_field = new THB_TextField('twitter_consumer_key');
		$thb_field->setLabel( __('Consumer key', 'thb_text_domain') );
	$thb_container->addField($thb_field);

	$thb_field = new THB_TextField('twitter_consumer_secret');
		$thb_field->setLabel( __('Consumer secret', 'thb_text_domain') );
	$thb_container->addField($thb_field);

	$thb_field = new THB_TextField('twitter_oauth_token');
		$thb_field->setLabel( __('Access token', 'thb_text_domain') );
	$thb_container->addField($thb_field);

	$thb_field = new THB_TextField('twitter_oauth_token_secret');
		$thb_field->setLabel( __('Access token secret', 'thb_text_domain') );
	$thb_container->addField($thb_field);

$thb_page->addTab($thb_tab);

/**
 * Shortcode
 * -----------------------------------------------------------------------------
 */
$shortcode = new THB_Shortcode('thb_social', 'shortcode', 'core/social');
$shortcode->setAttributes(array(
	'show' => '',
	'title' => ''
));
$shortcode->setExample('[thb_social show=""]');
$shortcode->setLabel( __('Social networks', 'thb_text_domain') );
$shortcode->setType( __('Social', 'thb_text_domain') );
$thb_theme->addShortcode($shortcode);

/**
 * Widget
 * -----------------------------------------------------------------------------
 */
if( !class_exists('THB_SocialNetworks_Widget') ) {
	class THB_SocialNetworks_Widget extends THB_Widget {

		/**
		 * Constructor
		 *
		 */
		public function __construct()
		{
			parent::__construct(
				'thb_social_networks_widget', // name
				__('Social networks', 'thb_text_domain'), // label
				__('Display social networks icons', 'thb_text_domain'), // description
				'thb_social' // shortcode
			);
		}

		/**
		 * The widget's editing form
		 *
		 * @see THB_Widget::form
		 **/
		public function widgetForm( $instance )
		{
			$help = __('Comma separated, order matters', 'thb_text_domain') . '. ' . __('Possible values', 'thb_text_domain') . ': twitter, facebook, googleplus, flickr, youtube,	vimeo, pinterest, dribbble,	forrst.';

			$this->formInputText( 'title', __('Title', 'thb_text_domain'), '', $instance );
			$this->formInputText( 'show', __('Show', 'thb_text_domain'), $help, $instance );
		}

	}
}
$thb_theme->addWidget( 'THB_SocialNetworks_Widget' );
<?php
/**
 * This file contains the main general settings for the theme.
 */

$pexeto_share_options = array(
			array( 'id'=>'page', 'name'=>'Pages' ),
			array( 'id'=>'post', 'name'=>'Posts' ),
			array( 'id'=>'portfolio', 'name'=>'Portfolio posts' ),
			array( 'id'=>'slider', 'name'=>'Gallery/Portfolio slider' ) );

if(PEXETO_WOOCOMMERCE_ACTIVE){
	$pexeto_share_options[]=array( 'id'=>'product', 'name'=>'Product Pages' );
}

global $pexeto_content_sizes;


$pexeto_general_options= array( 
	array(
		'name' => 'General Settings',
		'type' => 'title',
		'img' => 'icon-settings'
	),

	array(
		'type' => 'open',
		'subtitles'=>array(
			array( 'id'=>'main', 'name'=>'Main' ),
			array( 'id'=>'sidebar', 'name'=>'Sidebars' ),
			array( 'id'=>'update', 'name'=>'Theme Update' ),
			array( 'id'=>'sharing', 'name'=>'Social Sharing' ),
			array( 'id'=>'seo', 'name'=>'SEO' ),
			array( 'id'=>'contact', 'name'=>'Contact Form' )
		)
	),

	/* ------------------------------------------------------------------------*
	 * MAIN SETTINGS
	 * ------------------------------------------------------------------------*/

	array(
		'type' => 'subtitle',
		'id'=>'main'
	),

	array(
		'name' => 'Theme layout',
		'id' => 'layout',
		'type' => 'select',
		'options' => array( 
			array( 'id'=>'full', 'name'=>'Full-width layout' ), 
			array( 'id'=>'boxed', 'name'=>'Boxed layout' ) )
		)
	);


	if(pexeto_option('layout')=='boxed'){
		$pexeto_general_options[]=array(
			'type' => 'multioption',
			'id' => 'bg_image',
			'name' => 'Boxed layout background image',
			'fields' => array(
				array(
					'id' => 'url',
					'name' => 'Image',
					'type' => 'upload'),
				array(
					'id' => 'style',
					'name' => 'Background Style',
					'type' => 'select',
					'options' => array( 
						array( 'id'=>'full', 'name'=>'Full-width' ), 
						array( 'id'=>'repeat', 'name'=>'Repeatable' )
					),
					'std'=>'full'
				),
			)
		);
	}

	$pexeto_general_options = array_merge( $pexeto_general_options, array(

	array(
		'name' => 'Responsive layout on mobile devices',
		'id' => 'responsive_layout',
		'type' => 'checkbox',
		'std' => true,
		'desc' => 'If you disable this option, the mobile devcies will display
		the layout with their original viewport.'
	),


	array(
		'name' => 'Favicon image',
		'id' => 'favicon',
		'type' => 'upload',
		'desc' => 'Upload a favicon image - with .ico extention.'
	),


	array(
		'name' => 'Enable AJAX in gallery and portfolio items',
		'id' => 'portfolio_ajax',
		'type' => 'checkbox',
		'std' => true,
		'desc' => 'If enabled, the items within the galleries and portfolio items
			will be loaded with AJAX. However, if you prefer to have the page 
			refreshed when a new item has been selected and not load the data 
			with AJAX, you can disable this option.'
	),



	array(
		'name' => 'Disable right click',
		'id' => 'disable_click',
		'type' => 'checkbox',
		'std' => false,
		'desc' => 'If "ON" selected, right click will be disabled for the theme 
			in order to add copyright protection to images.'
	),
	
	array(
		'name' => 'Show scroll to top button',
		'id' => 'show_scroll_btn',
		'type' => 'checkbox',
		'std' => true
	),


	array(
		'name' => 'Google Analytics Code',
		'id' => 'analytics',
		'type' => 'textarea',
		'desc' => 'You can insert your generated Google Analytics code here. Please make sure to
		include the &lt;script&gt; tag - it should be in the following format:<br/>
		<pre>&lt;script&gt;<br/>CODE<br/>&lt;/script&gt;</pre>'
	),

	
	array(
		'type' => 'documentation',
		'text' => '<h3>Translation</h3>'
	),

	array(
		'name' => 'Default locale',
		'id' => 'locale',
		'type' => 'text',
		'desc' => 'This is the default language locale. If you would like to set
		another default language (other than US English) and you are not using any
		language plugins, you can set the language locale here. Example value:
		<b>de_DE</b> for German.<br/> For more information
		 please refer to the "Translation" section of the documentation.'
	),

	array(
		'name' => 'Load translation files from',
		'id' => 'load_translation',
		'type' => 'select',
		'options' => array( 
			array( 'id'=>'theme', 'name'=>'Theme folder' ), 
			array( 'id'=>'child', 'name'=>'Child theme folder' ) ),
		'std' => 'theme',
		'desc' => 'If you have genereated .mo
		files with translation(s) for the theme, you can select the location to load
		the translation files from. If you have a child theme activated for the theme,
		it is recommended to select the "Child theme folder" option and save the
		.mo files within the "lang" folder of the child theme. In this way,
		the .mo files will remain saved even after a theme update which replaces
		all the theme files.'
	),


	array(
		'type' => 'close' ),

	

	/* ------------------------------------------------------------------------*
	 * SIDEBARS
	 * ------------------------------------------------------------------------*/

	array(
		'type' => 'subtitle',
		'id'=>'sidebar'
	),

	array(
		'name'=>'Add Sidebar',
		'id'=>'sidebars',
		'type'=>'custom',
		'button_text'=>'Add Sidebar',
		'editable' => false,
		'fields'=>array(
			array( 'id'=>'name', 'type'=>'text', 'name'=>'Sidebar Name', 'required'=>true )
		),
		'bind_to'=>array(
			'ids'=>array( 'post_sidebar', 'archive_sidebar', 'portfolio_sidebar' ),
			'links'=>array( 'id'=>'name', 'name'=>'name' )
		),
		'desc'=>'In this section you can create additional custom sidebars.
		Then for each page you will be able to assign a different sidebar.'
	),

	array(
		'type' => 'close' ),



	/* ------------------------------------------------------------------------*
	 * THEME UPDATE
	 * ------------------------------------------------------------------------*/

	array(
		'type' => 'subtitle',
		'id'=>'update'
	),

	array(
		'name' => 'Envato Marketplace Username',
		'id' => 'tf_username',
		'type' => 'text',
		'desc' => 'If you would like to have an option to automatically update 
			the theme from the admin panel, you have to insert the username 
			of the account you used to purchase the theme from ThemeForest. 
			For more information you can refer to the "Updates" section of the 
			documentation.'
	),

	array(
		'name' => 'Envato Marketplace API Key',
		'id' => 'tf_api_key',
		'type' => 'text',
		'desc' => 'If you would like to have an option to automatically update 
			the theme from the admin panel, you have to insert your API Key here. 
			To obtain your API Key, visit your "My Settings" page on any of the 
			Envato Marketplaces (ThemeForest). For more information you can 
			refer to the "Updates" section of the documentation.'
	),

	array(
		'type' => 'close' ),



	/* ------------------------------------------------------------------------*
	 * SOCIAL SHARING
	 * ------------------------------------------------------------------------*/

	array(
		'type' => 'subtitle',
		'id'=>'sharing'
	),



	array(
		'name' => 'Display sharing buttons on',
		'id' => 'show_share_buttons',
		'type' => 'multicheck',
		'options' => $pexeto_share_options,
		'class'=>'include',
		'std' => array( 'post', 'slider' ) )
	,

	array(
		'name' => 'Sharing buttons',
		'id' => 'share_buttons',
		'type' => 'multicheck',
		'options' => array(
			array( 'id'=>'facebook', 'name'=>'Facebook' ),
			array( 'id'=>'twitter', 'name'=>'Twitter' ),
			array( 'id'=>'googlePlus', 'name'=>'Google+' ),
			array( 'id'=>'pinterest', 'name'=>'Pinterest' ),
			array( 'id'=>'linkedin', 'name'=>'LinkedIn' ) ),
		'class'=>'include',
		'desc' => 'You can select which sharing buttons to be displayed on the
		social share section of the pages/posts',
		'std' => array( 'facebook', 'twitter', 'googlePlus', 'pinterest', 'linkedin' ) )
	,

	array(
		'name' => 'Google+ button language code',
		'id' => 'gplus_lang',
		'type' => 'text',
		'desc' => 'The language code of the text that will be related with the 
			Google+ button functionality. You can get the list with all available 
			language codes here: 
			https://developers.google.com/+/plugins/+1button/#available-languages',
		'std' => 'en-US'
	),

	
	array(
		'type' => 'close' ),


	/* ------------------------------------------------------------------------*
	 * SEO
	 * ------------------------------------------------------------------------*/

	array(
		'type' => 'subtitle',
		'id'=>'seo'
	),

	array(
		'type' => 'documentation',
		'text' => '<div class="note_box">
			 <b>Note: </b> This section contains some basic SEO options. For more 
			 advanced options, you may consider using an SEO plugin - some plugins 
			 that we recommend are <a href="http://wordpress.org/extend/plugins/wordpress-seo/">
			 WordPress SEO by Yoast</a> and 
			 <a href="http://wordpress.org/extend/plugins/all-in-one-seo-pack/">
			 All in One SEO Pack</a></div>'
	),

	array(
		'name' => 'Site keywords',
		'id' => 'seo_keywords',
		'type' => 'text',
		'desc' => 'The main keywords that describe your site, separated by commas. 
			Example:<br /><i>photography,design,art</i>'
	),

	array(
		'name' => 'Page title separator',
		'id' => 'seo_separator',
		'type' => 'text',
		'std' => '|',
		'desc' => 'Separates the different title parts'
	),

	array(
		'name' => 'Exclude pages from indexation',
		'id' => 'seo_indexation',
		'type' => 'multicheck',
		'options' => array( 
			array( 'id'=>'category', 'name'=>'Category Archive' ), 
			array( 'id'=>'date', 'name'=>'Date Archive' ), 
			array( 'id'=>'tag', 'name'=>'Tag Archive' ), 
			array( 'id'=>'author', 'name'=>'Author Archive' ), 
			array( 'id'=>'search', 'name'=>'Search Results' ),
			array( 'id'=>'pgcategory', 'name'=>'Gallery Category Filter' ) ),
		'class'=>'include',
		'desc' => 'Pages, such as archives pages, display some duplicate content 
			- for example, the same post can be found on your main Blog
			page, but also in a category archive, date archive, etc. Some search 
			engines are reported to penalize sites associated with too much duplicate
			content. Therefore, excluding the pages from this option will remove 
			the search engine indexiation by adding "noindex" and "nofollow" meta 
			tags which would prevent the search engines to index this duplicate content. 
			By default, all the pages are indexed, if you would like to prevent 
			indexation on some pages, just select them in this list.' ),

	array(
		'type' => 'close' ),


	/* ------------------------------------------------------------------------*
	 * CONTACT PAGE SETTINGS
	 * ------------------------------------------------------------------------*/

	array(
		'type' => 'subtitle',
		'id'=>'contact'
	),

	array(
		'name' => 'Email to which to send contact form message',
		'id' => 'email',
		'type' => 'text' ),

	array(
		'name' => 'Email sender',
		'id' => 'email_from',
		'type' => 'text',
		'desc' => '<b>Important:</b> Please do not leave this field empty.<br/>
		Set a custom email address that will be set as a sender of the email.<br/>
		Yahoo has recently published a DMARC policy of reject, meaning
		that all the emails that are sent from Yahoo emails, but not from the Yahoo servers,
		should be rejected by the email providers.<br/>
		This means that if your site visitor sets a Yahoo email and this email is set as a
		sender, you may not be able to receive the email (depending on the email provider that you use
			to receive the messages).<br/>
		Therefore, please make sure to set your custom email address in this field (such as noreply@domain.com, non-Yahoo address),
		so that you can receive emails from Yahoo users.' ),

	array(
		'type' => 'documentation',
		'text' => '<h3>CAPTCHA Settings</h3>'
	),

	array(
		'name' => 'Enable CAPTCHA',
		'id' => 'captcha',
		'type' => 'checkbox',
		'std' => false,
		'desc' => 'reCAPTCHA will protect your contact form from spam emails 
			that are generated from robots. If this field is enabled, a CAPTCHA 
			form will be added to the bottom of the contact form. The user will 
			have to insert the text from the generated image in order to prove 
			that he/she is a real human and not a spamming robot.<br /> Please 
			note that you have to also set the "reCAPTCHA public Key" and 
			"reCAPTCHA private Key" fields below.'
	),

	array(
		'name' => 'reCAPTCHA Public Key',
		'id' => 'captcha_public_key',
		'type' => 'text',
		'desc' => 'In order to use CAPTCHA you need to register public and 
			private keys - you can do it on this page:<br/>
			http://www.google.com/recaptcha/whyrecaptcha <br/>
			For more information you can refer to the "Contact Page" section 
			of the documentation.'
	),

	array(
		'name' => 'reCAPTCHA Private Key',
		'id' => 'captcha_private_key',
		'type' => 'text',
		'desc' => 'In order to use CAPTCHA you need to register public 
			and private keys - you can do it on this page:<br/>
			http://www.google.com/recaptcha/whyrecaptcha <br/>
			For more information you can refer to the "Contact Page" section of 
			the documentation.'
	),

	array(
		'type' => 'close' ),


	array(
		'type' => 'close' )
));

$pexeto->options->add_option_set( $pexeto_general_options );

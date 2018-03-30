<?php
/**
 * humbleshop Theme Customizer
 *
 * @package humbleshop
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function humbleshop_customize_register( $wp_customize ) {

	class Additional_CSS extends WP_Customize_Control {
	    public $type = 'textarea';
	 
	    public function render_content() {
	        ?>
	        <label>
	        <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
	        <textarea rows="5" style="width:100%;" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
	        </label>
	        <?php
	    }
	}	

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
	$wp_customize->get_setting( 'background_color' )->transport = 'postMessage';
	
	
	$wp_customize->add_panel( 'hs_branding', array(
	    'priority' => 0,
	    'capability' => 'edit_theme_options',
	    'theme_supports' => '',
	    'title' => __( 'General', 'textdomain' ),
	    'description' => __( 'Description of what this panel does.', 'textdomain' ),
	) );

	//  Logo ----------------------------------------------
	$wp_customize->add_section( 'title_tagline', array(
	     'title'    => __( 'Site Title' ),
	     'priority' => 0,
	     'panel' => 'hs_branding'
	) );

	$wp_customize->add_section('the_logo', array(
		'title' => __( 'Logo and favicon', 'humbleshop' ),
		'capability' => 'edit_theme_options',
		'description' => __( 'Upload your shop logo or leave it blank if you want to use text based. <br />Font font family, leave Google font field empty if you dont want to use Google Font.' , 'humbleshop' ),
		'priority'    => 10,
		'panel' => 'hs_branding'
	));

	    $wp_customize->add_setting('logo', array(
	        'capability'        => 'edit_theme_options'
	    ));
	 
	    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'logo_upload', array(
	        'label'    => __('Upload', 'humbleshop'),
	        'section'  => 'the_logo',
	        'settings' => 'logo'
	    )));

	    // If Google font
	    $wp_customize->add_setting('glogofont', array(
	        'default'        => 'Bangers',
	        'capability'     => 'edit_theme_options'
	    ));
	 
	    $wp_customize->add_control('glogofont', array(
	        'label'      => __('Google font for logo', 'humbleshop'),
	        'section'    => 'the_logo',
	        'settings'   => 'glogofont'
	    ));

	    // If normal font
	    $wp_customize->add_setting('nlogofont', array(
	        'default'        => 'Helvetica, Arial',
	        'capability'     => 'edit_theme_options'
	    ));
	 
	    $wp_customize->add_control('nlogofont', array(
	        'label'      => __('Normal font for logo', 'humbleshop'),
	        'section'    => 'the_logo',
	        'settings'   => 'nlogofont'
	    ));

	    // Font size
	    $wp_customize->add_setting('logosize', array(
	        'default'        => '30px',
	        'capability'     => 'edit_theme_options'
	    ));
	 
	    $wp_customize->add_control('logosize', array(
	        'label'      => __('Font size for logo', 'humbleshop'),
	        'section'    => 'the_logo',
	        'settings'   => 'logosize'
	    ));

	    $wp_customize->add_setting('favicon', array(
	    	'default' => '//thehumblespace.com/wp/humbleshop/wp-content/uploads/2013/01/hsfavicon.png',
	        'capability'        => 'edit_theme_options'
	    ));
	 
	    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'favicon', array(
	        'label'    => __('Shop favicon', 'humbleshop'),
	        'section'  => 'the_logo',
	        'settings' => 'favicon'
	    )));

	$wp_customize->add_section( 'colors', array(
    	'title'          => __( 'Background color' ),
   		'priority'       => 20,
   		'panel' => 'hs_branding'
	) );

	$wp_customize->add_section( 'background_image', array(
	     'title'          => __( 'Background Image' ),
	     'theme_supports' => 'custom-background',
	     'priority'       => 30,
	     'panel' => 'hs_branding'
	) );


	//  General ----------------------------------------------
	$wp_customize->add_section('the_general', array(
		'title' => __( 'Shop colors and fonts', 'humbleshop' ),
		'capability' => 'edit_theme_options',
		'description' => __( 'Customize general colors and fonts <br />Font font family, leave Google font field empty if you dont want to use Google Font.', 'humbleshop' ),
		'priority'    => 40,
		'panel' => 'hs_branding'
	));    

		// Background color
		$wp_customize->add_setting('mainbackground', array(
	        'default'           => 'fff',
	        'sanitize_callback' => 'sanitize_hex_color',
	        'capability'        => 'edit_theme_options'
	    ));
	 
	    $wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'contentbackground', array(
	        'label'    => __('Background Color', 'humbleshop'),
	        'section'  => 'the_general',
	        'settings' => 'mainbackground',
	        'priority'    => 201
	    )));

	    // Text color
	    $wp_customize->add_setting('maintext', array(
	        'default'           => '333',
	        'sanitize_callback' => 'sanitize_hex_color',
	        'capability'        => 'edit_theme_options'
	    ));
	 
	    $wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'contenttext', array(
	        'label'    => __('Text Color', 'humbleshop'),
	        'section'  => 'the_general',
	        'settings' => 'maintext',
	        'priority'    => 202
	    )));

	    // Link color
	    $wp_customize->add_setting('mainlink', array(
	        'default'           => '111',
	        'sanitize_callback' => 'sanitize_hex_color',
	        'capability'        => 'edit_theme_options'
	    ));
	 
	    $wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'contentlink', array(
	        'label'    => __('Link Color', 'humbleshop'),
	        'section'  => 'the_general',
	        'settings' => 'mainlink',
	        'priority'    => 203
	    )));

	    // Hover color
	    $wp_customize->add_setting('mainhover', array(
	        'default'           => 'E55137',
	        'sanitize_callback' => 'sanitize_hex_color',
	        'capability'        => 'edit_theme_options'
	    ));
	 
	    $wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'contenthover', array(
	        'label'    => __('Hover Color', 'humbleshop'),
	        'section'  => 'the_general',
	        'settings' => 'mainhover',
	        'priority'    => 204
	    )));

	    // Header background color
	    $wp_customize->add_setting('headerbackground', array(
	        'default'           => 'f2f2f2',
	        'sanitize_callback' => 'sanitize_hex_color',
	        'capability'        => 'edit_theme_options'
	    ));
	 
	    $wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'headbackground', array(
	        'label'    => __('Page Header Background Color', 'humbleshop'),
	        'section'  => 'the_general',
	        'settings' => 'headerbackground',
	        'priority'    => 205
	    )));

	    // If Google font for body
	    $wp_customize->add_setting('gfont', array(
	        'default'        => 'Lato',
	        'capability'     => 'edit_theme_options'
	    ));
	 
	    $wp_customize->add_control('gfont', array(
	        'label'      => __('Google font for body', 'humbleshop'),
	        'section'    => 'the_general',
	        'settings'   => 'gfont',
	        'priority'    => 206
	    ));

	    // If normal font for body
	    $wp_customize->add_setting('nfont', array(
	        'default'        => 'Helvetica, Arial',
	        'capability'     => 'edit_theme_options'
	    ));
	 
	    $wp_customize->add_control('nfont', array(
	        'label'      => __('Normal font for body', 'humbleshop'),
	        'section'    => 'the_general',
	        'settings'   => 'nfont',
	        'priority'    => 207
	    ));

	    // Font size for body
	    $wp_customize->add_setting('fontsize', array(
	        'default'        => '14px',
	        'capability'     => 'edit_theme_options'
	    ));
	 
	    $wp_customize->add_control('fontsize', array(
	        'label'      => __('Font size for body', 'humbleshop'),
	        'section'    => 'the_general',
	        'settings'   => 'fontsize',
	        'priority'    => 208
	    )); 

	$wp_customize->add_panel( 'hs_structure', array(
	    'priority' => 200,
	    'capability' => 'edit_theme_options',
	    'theme_supports' => '',
	    'title' => __( 'Shop Structure', 'textdomain' ),
	    'description' => __( 'Description of what this panel does.', 'textdomain' ),
	) );

	$wp_customize->add_section( 'static_front_page', array(
	     'title'          => __( 'Static Front Page' ),
	      // 'theme_supports' => 'static-front-page',
	      'priority'       => 0,
	      'description'    => __( 'Your theme supports a static front page.' ),
	      'panel' => 'hs_structure'
	) );

	//  Homepage ----------------------------------------------
	$wp_customize->add_section('the_homepage', array(
		'title' => __( 'Homepage', 'humbleshop' ),
		'capability' => 'edit_theme_options',
		'description' => __( 'Customize your homepage', 'humbleshop' ),
		'priority'    => 210,
		'panel' => 'hs_structure'
	));
		// Slider
		$wp_customize->add_setting('homeslider', array(
			'default' => true,
	        'capability' => 'edit_theme_options'
	    ));
	 
	    $wp_customize->add_control('homeslider', array(
	        'settings' => 'homeslider',
	        'label'    => __('Display slider', 'humbleshop' ),
	        'section'  => 'the_homepage',
	        'type'     => 'checkbox',
	        'priority'    => 211
	    ));

		// Carousel
		$wp_customize->add_setting('homecarousel', array(
			'default' => false,
	        'capability' => 'edit_theme_options'
	    ));
	 
	    $wp_customize->add_control('homecarousel', array(
	        'settings' => 'homecarousel',
	        'label'    => __('Display carousel', 'humbleshop' ),
	        'section'  => 'the_homepage',
	        'type'     => 'checkbox',
	        'priority'    => 212
	    ));

	    // Promo banner
	    $wp_customize->add_setting('homepromo', array(
			'default' => true,
	        'capability' => 'edit_theme_options'
	    ));
	 
	    $wp_customize->add_control('homepromo', array(
	        'settings' => 'homepromo',
	        'label'    => __('Display three promo banner', 'humbleshop' ),
	        'section'  => 'the_homepage',
	        'type'     => 'checkbox',
	        'priority'    => 213
	    ));

	    // Listing
	    $wp_customize->add_setting('homelist', array(
			'default' => true,
	        'capability' => 'edit_theme_options'
	    ));
	 
	    $wp_customize->add_control('homelist', array(
	        'settings' => 'homelist',
	        'label'    => __('Display listing', 'humbleshop' ),
	        'section'  => 'the_homepage',
	        'type'     => 'checkbox',
	        'priority'    => 214
	    ));

	    // Homelist title
	    $wp_customize->add_setting('homelisttitle', array(
	        'default'        => 'Featured Products',
	        'capability'     => 'edit_theme_options'
	    ));
	 
	    $wp_customize->add_control('homelisttitle', array(
	        'label'      => __('Featured Title', 'humbleshop'),
	        'section'    => 'the_homepage',
	        'settings'   => 'homelisttitle',
	        'priority'    => 215
	    ));

	    // Homelist slug
	    $wp_customize->add_setting('homelistslug', array(
	        'default'        => '',
	        'capability'     => 'edit_theme_options'
	    ));
	 
	    $wp_customize->add_control('homelistslug', array(
	        'label'      => __('Downloads category for listing', 'humbleshop'),
	        'section'    => 'the_homepage',
	        'settings'   => 'homelistslug',
	        'priority'    => 216
	    ));
	    $wp_customize->add_setting('homelistnumber', array(
	        'default'        => '3',
	        'capability'     => 'edit_theme_options',
	 
	    ));
	    $wp_customize->add_control( 'homelistnumber', array(
	        'settings' => 'homelistnumber',
	        'label'   => 'Number of items for listing',
	        'section' => 'the_homepage',
	        'type'    => 'select',
	        'choices'    => array(
	            '3' => '3',
	            '6' => '6',
	            '9' => '9',
	            '12' => '12',
	            '15' => '15'
	        ),
	        'priority'    => 217
	    ));

	    // Brands
	    $wp_customize->add_setting('homelabel', array(
			'default' => true,
	        'capability' => 'edit_theme_options'
	    ));
	 
	    $wp_customize->add_control('homelabel', array(
	        'settings' => 'homelabel',
	        'label'    => __('Display labels logo', 'humbleshop' ),
	        'section'  => 'the_homepage',
	        'type'     => 'checkbox',
	        'priority'    => 218
	    ));

	    // Homelist title
	    $wp_customize->add_setting('homelabeltitle', array(
	        'default'        => 'Top Brands',
	        'capability'     => 'edit_theme_options'
	    ));
	 
	    $wp_customize->add_control('homelabeltitle', array(
	        'label'      => __('Label Title', 'humbleshop'),
	        'section'    => 'the_homepage',
	        'settings'   => 'homelabeltitle',
	        'priority'    => 219
	    )); 

	//  Footer ----------------------------------------------
	$wp_customize->add_section('the_footer', array(
		'title' => __( 'Footer', 'humbleshop' ),
		'capability' => 'edit_theme_options',
		'description' => __( 'Customize colors for font and background', 'humbleshop' ),
		'priority'    => 220,
		'panel' => 'hs_structure'
	));

		// Footer background
	    $wp_customize->add_setting('footerbackground', array(
	        'default'           => '000',
	        'sanitize_callback' => 'sanitize_hex_color',
	        'capability'        => 'edit_theme_options',
	        'transport'   => 'postMessage'
	    ));
	 
	    $wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'background', array(
	        'label'    => __('Background Color', 'humbleshop'),
	        'section'  => 'the_footer',
	        'settings' => 'footerbackground'
	    )));

	    // Footer text
	    $wp_customize->add_setting('footertext', array(
	        'default'           => 'aaa',
	        'sanitize_callback' => 'sanitize_hex_color',
	        'capability'        => 'edit_theme_options',
	        'transport'   => 'postMessage'
	    ));
	 
	    $wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'text_color', array(
	        'label'    => __('Text Color', 'humbleshop'),
	        'section'  => 'the_footer',
	        'settings' => 'footertext'
	    )));

	    // Footer link
	    $wp_customize->add_setting('footerlink', array(
	        'default'           => 'fff',
	        'sanitize_callback' => 'sanitize_hex_color',
	        'capability'        => 'edit_theme_options',
	        'transport'   => 'postMessage'
	    ));
	 
	    $wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'link_color', array(
	        'label'    => __('Link Color', 'humbleshop'),
	        'section'  => 'the_footer',
	        'settings' => 'footerlink'
	    )));

	    // Footer note
	    $wp_customize->add_setting('footernote', array(
	        'default'        => 'FREE SHIPPING FOR ALL STARTING JANUARY 2014',
	        'capability'     => 'edit_theme_options'
	    ));
	 
	    $wp_customize->add_control('footernote', array(
	        'label'      => __('Footer Note', 'humbleshop'),
	        'section'    => 'the_footer',
	        'settings'   => 'footernote'
	    ));

	// Page Layout ----------------------------------------------
	$wp_customize->add_section('the_layout', array(
		'title' => __( 'Sidebars', 'humbleshop' ),
		'capability' => 'edit_theme_options',
		'description' => __( 'Choose layout type for pages.', 'humbleshop' ),
		'priority'    => 230,
		'panel' => 'hs_structure'
	));

	    $wp_customize->add_setting( 'pagelayout', array(
			'default' => 'pageright'
		));
		$wp_customize->add_control( 'pagelayout', array(
			'type' => 'radio',
			'label' => __( 'Page layout', 'humbleshop' ),
			'section' => 'the_layout',
			'choices' => array(
				'pageright' => __( 'Right sidebar', 'humbleshop' ),
				'pageleft' => __( 'Left sidebar', 'humbleshop' ),
				'pageno' => __( 'No sidebar', 'humbleshop' )
			),
			'settings' => 'pagelayout'
		));

		$wp_customize->add_setting( 'postlayout', array(
			'default' => 'postright'
		));

		$wp_customize->add_control( 'postlayout', array(
			'type' => 'radio',
			'label' => __( 'Post layout', 'humbleshop' ),
			'section' => 'the_layout',
			'choices' => array(
				'postright' => __( 'Right sidebar', 'humbleshop' ),
				'postleft' => __( 'Left sidebar', 'humbleshop' ),
				'postno' => __( 'No sidebar', 'humbleshop' )
			),
			'settings' => 'postlayout'
		));

		$wp_customize->add_setting( 'shoplayout', array(
			'default' => 'pageright'
		));
		$wp_customize->add_control( 'shoplayout', array(
			'type' => 'radio',
			'label' => __( 'Shop layout', 'humbleshop' ),
			'section' => 'the_layout',
			'choices' => array(
				'pageright' => __( 'Right sidebar', 'humbleshop' ),
				'pageleft' => __( 'Left sidebar', 'humbleshop' ),
				'pageno' => __( 'No sidebar', 'humbleshop' )
			),
			'settings' => 'shoplayout'
		));

	$wp_customize->add_panel( 'hs_shopdetails', array(
	    'priority' => 300,
	    'capability' => 'edit_theme_options',
	    'theme_supports' => '',
	    'title' => __( 'Shop Details', 'textdomain' ),
	    'description' => __( 'Description of what this panel does.', 'textdomain' ),
	) );

	// Contact ----------------------------------------------
	$wp_customize->add_section('the_contact', array(
		'title' => __( 'Contact details', 'humbleshop' ),
		'capability' => 'edit_theme_options',
		'description' => __( 'Fill up address and contact details for your shop', 'humbleshop' ),
		'priority'    => 240,
		'panel' => 'hs_shopdetails'
	));
		// Address map
	    $wp_customize->add_setting('gmap', array(
	        'default'        => 'PO Box 16122 Collins Street West Victoria 8007 Australia',
	        'capability'     => 'edit_theme_options'
	    ));
	 
	    $wp_customize->add_control('gmap', array(
	        'label'      => __('Google map', 'humbleshop'),
	        'section'    => 'the_contact',
	        'settings'   => 'gmap',
	        'priority'    => 241
	    ));

	    // Address 1
	    $wp_customize->add_setting('add1', array(
	        'default'        => 'PO Box 16122',
	        'capability'     => 'edit_theme_options'
	    ));
	 
	    $wp_customize->add_control('add1', array(
	        'label'      => __('Address 1', 'humbleshop'),
	        'section'    => 'the_contact',
	        'settings'   => 'add1',
	        'priority'    => 242
	    ));

	    // Address 2
	    $wp_customize->add_setting('add2', array(
	        'default'        => 'Collins Street West',
	        'capability'     => 'edit_theme_options'
	    ));
	 
	    $wp_customize->add_control('add2', array(
	        'label'      => __('Address 2', 'humbleshop'),
	        'section'    => 'the_contact',
	        'settings'   => 'add2',
	        'priority'    => 243
	    ));

	    // City
	    $wp_customize->add_setting('city', array(
	        'default'        => 'Victoria 8007',
	        'capability'     => 'edit_theme_options'
	    ));
	 
	    $wp_customize->add_control('city', array(
	        'label'      => __('Zip/Postcode', 'humbleshop'),
	        'section'    => 'the_contact',
	        'settings'   => 'city',
	        'priority'    => 244
	    ));

	    // State
	    $wp_customize->add_setting('state', array(
	        'default'        => '',
	        'capability'     => 'edit_theme_options'
	    ));
	 
	    $wp_customize->add_control('state', array(
	        'label'      => __('State', 'humbleshop'),
	        'section'    => 'the_contact',
	        'settings'   => 'state',
	        'priority'    => 245
	    ));

	    // Country
	    $wp_customize->add_setting('country', array(
	        'default'        => 'Australia',
	        'capability'     => 'edit_theme_options'
	    ));
	 
	    $wp_customize->add_control('country', array(
	        'label'      => __('Country', 'humbleshop'),
	        'section'    => 'the_contact',
	        'settings'   => 'country',
	        'priority'    => 246
	    ));

	    // Email
	    $wp_customize->add_setting('email', array(
	        'default'        => 'hello@email.com',
	        'capability'     => 'edit_theme_options'
	    ));
	 
	    $wp_customize->add_control('email', array(
	        'label'      => __('Email', 'humbleshop'),
	        'section'    => 'the_contact',
	        'settings'   => 'email',
	        'priority'    => 247
	    ));

	    // Phone
	    $wp_customize->add_setting('phone', array(
	        'default'        => '+440123334455',
	        'capability'     => 'edit_theme_options'
	    ));
	 
	    $wp_customize->add_control('phone', array(
	        'label'      => __('Phone', 'humbleshop'),
	        'section'    => 'the_contact',
	        'settings'   => 'phone',
	        'priority'    => 248
	    ));

	    // Fax
	    $wp_customize->add_setting('fax', array(
	        'default'        => '+440123334455',
	        'capability'     => 'edit_theme_options'
	    ));
	 
	    $wp_customize->add_control('fax', array(
	        'label'      => __('Fax', 'humbleshop'),
	        'section'    => 'the_contact',
	        'settings'   => 'fax',
	        'priority'    => 249
	    ));

	//  Payment method ----------------------------------------------
	$wp_customize->add_section('the_payment', array(
		'title' => __( 'Payment icons', 'humbleshop' ),
		'capability' => 'edit_theme_options',
		'description' => __( 'Pick your payment method icons', 'humbleshop' ),
		'priority'    => 250,
		'panel' => 'hs_shopdetails'
	));
		// icons
		$wp_customize->add_setting('amex', array(
			'default' => true,
	        'capability' => 'edit_theme_options'
	    ));
	 
	    $wp_customize->add_control('amex', array(
	        'settings' => 'amex',
	        'label'    => __('Show amex', 'humbleshop' ),
	        'section'  => 'the_payment',
	        'type'     => 'checkbox',
	        'priority'    => 251
	    ));

	    $wp_customize->add_setting('mastercard', array(
			'default' => true,
	        'capability' => 'edit_theme_options'
	    ));
	 
	    $wp_customize->add_control('mastercard', array(
	        'settings' => 'mastercard',
	        'label'    => __('Show mastercard', 'humbleshop' ),
	        'section'  => 'the_payment',
	        'type'     => 'checkbox',
	        'priority'    => 251
	    ));

	    $wp_customize->add_setting('visa', array(
			'default' => true,
	        'capability' => 'edit_theme_options'
	    ));
	 
	    $wp_customize->add_control('visa', array(
	        'settings' => 'visa',
	        'label'    => __('Show visa', 'humbleshop' ),
	        'section'  => 'the_payment',
	        'type'     => 'checkbox',
	        'priority'    => 253
	    ));

	    $wp_customize->add_setting('paypal', array(
			'default' => true,
	        'capability' => 'edit_theme_options'
	    ));
	 
	    $wp_customize->add_control('paypal', array(
	        'settings' => 'paypal',
	        'label'    => __('Show paypal', 'humbleshop' ),
	        'section'  => 'the_payment',
	        'type'     => 'checkbox',
	        'priority'    => 254
	    ));

	    $wp_customize->add_setting('cirrus', array(
			'default' => false,
	        'capability' => 'edit_theme_options'
	    ));
	 
	    $wp_customize->add_control('cirrus', array(
	        'settings' => 'cirrus',
	        'label'    => __('Show cirrus', 'humbleshop' ),
	        'section'  => 'the_payment',
	        'type'     => 'checkbox',
	        'priority'    => 255
	    ));

	    $wp_customize->add_setting('delta', array(
			'default' => false,
	        'capability' => 'edit_theme_options'
	    ));
	 
	    $wp_customize->add_control('delta', array(
	        'settings' => 'delta',
	        'label'    => __('Show delta', 'humbleshop' ),
	        'section'  => 'the_payment',
	        'type'     => 'checkbox',
	        'priority'    => 256
	    ));

	    $wp_customize->add_setting('direct-debit', array(
			'default' => false,
	        'capability' => 'edit_theme_options'
	    ));
	 
	    $wp_customize->add_control('direct-debit', array(
	        'settings' => 'direct-debit',
	        'label'    => __('Show direct-debit', 'humbleshop' ),
	        'section'  => 'the_payment',
	        'type'     => 'checkbox',
	        'priority'    => 257
	    ));

	    $wp_customize->add_setting('discover', array(
			'default' => false,
	        'capability' => 'edit_theme_options'
	    ));
	 
	    $wp_customize->add_control('discover', array(
	        'settings' => 'discover',
	        'label'    => __('Show discover', 'humbleshop' ),
	        'section'  => 'the_payment',
	        'type'     => 'checkbox',
	        'priority'    => 258
	    ));

	    $wp_customize->add_setting('ebay', array(
			'default' => false,
	        'capability' => 'edit_theme_options'
	    ));
	 
	    $wp_customize->add_control('ebay', array(
	        'settings' => 'ebay',
	        'label'    => __('Show ebay', 'humbleshop' ),
	        'section'  => 'the_payment',
	        'type'     => 'checkbox',
	        'priority'    => 259
	    ));

	    $wp_customize->add_setting('google', array(
			'default' => false,
	        'capability' => 'edit_theme_options'
	    ));
	 
	    $wp_customize->add_control('google', array(
	        'settings' => 'google',
	        'label'    => __('Show google checkout', 'humbleshop' ),
	        'section'  => 'the_payment',
	        'type'     => 'checkbox',
	        'priority'    => 260
	    ));

	    $wp_customize->add_setting('maestro', array(
			'default' => false,
	        'capability' => 'edit_theme_options'
	    ));
	 
	    $wp_customize->add_control('maestro', array(
	        'settings' => 'maestro',
	        'label'    => __('Show maestro', 'humbleshop' ),
	        'section'  => 'the_payment',
	        'type'     => 'checkbox',
	        'priority'    => 261
	    ));

	    $wp_customize->add_setting('moneybookers', array(
			'default' => false,
	        'capability' => 'edit_theme_options'
	    ));
	 
	    $wp_customize->add_control('moneybookers', array(
	        'settings' => 'moneybookers',
	        'label'    => __('Show moneybookers', 'humbleshop' ),
	        'section'  => 'the_payment',
	        'type'     => 'checkbox',
	        'priority'    => 262
	    ));

	    $wp_customize->add_setting('sagepay', array(
			'default' => false,
	        'capability' => 'edit_theme_options'
	    ));
	 
	    $wp_customize->add_control('sagepay', array(
	        'settings' => 'sagepay',
	        'label'    => __('Show sagepay', 'humbleshop' ),
	        'section'  => 'the_payment',
	        'type'     => 'checkbox',
	        'priority'    => 263
	    ));

	    $wp_customize->add_setting('solo', array(
			'default' => false,
	        'capability' => 'edit_theme_options'
	    ));
	 
	    $wp_customize->add_control('solo', array(
	        'settings' => 'solo',
	        'label'    => __('Show solo', 'humbleshop' ),
	        'section'  => 'the_payment',
	        'type'     => 'checkbox',
	        'priority'    => 264
	    ));

	    $wp_customize->add_setting('switch', array(
			'default' => false,
	        'capability' => 'edit_theme_options'
	    ));
	 
	    $wp_customize->add_control('switch', array(
	        'settings' => 'switch',
	        'label'    => __('Show switch', 'humbleshop' ),
	        'section'  => 'the_payment',
	        'type'     => 'checkbox',
	        'priority'    => 265
	    ));

	    $wp_customize->add_setting('visaelectron', array(
			'default' => false,
	        'capability' => 'edit_theme_options'
	    ));
	 
	    $wp_customize->add_control('visaelectron', array(
	        'settings' => 'visaelectron',
	        'label'    => __('Show visa electron', 'humbleshop' ),
	        'section'  => 'the_payment',
	        'type'     => 'checkbox',
	        'priority'    => 266
	    ));

	    $wp_customize->add_setting('twocheckout', array(
			'default' => false,
	        'capability' => 'edit_theme_options'
	    ));
	 
	    $wp_customize->add_control('twocheckout', array(
	        'settings' => 'twocheckout',
	        'label'    => __('Show 2checkout', 'humbleshop' ),
	        'section'  => 'the_payment',
	        'type'     => 'checkbox',
	        'priority'    => 267
	    ));

	    $wp_customize->add_setting('westernunion', array(
			'default' => false,
	        'capability' => 'edit_theme_options'
	    ));
	 
	    $wp_customize->add_control('westernunion', array(
	        'settings' => 'westernunion',
	        'label'    => __('Show western union', 'humbleshop' ),
	        'section'  => 'the_payment',
	        'type'     => 'checkbox',
	        'priority'    => 268
	    ));

	//  Social networks ----------------------------------------------
	$wp_customize->add_section('the_social', array(
		'title' => __( 'Social networks', 'humbleshop' ),
		'capability' => 'edit_theme_options',
		'description' => __( 'Choose your social networks channel, enter full url. <br /><strong>Leave it blank</strong> if you dont want to use it.', 'humbleshop' ),
		'priority'    => 270,
		'panel' => 'hs_shopdetails'
	));    

		// Facebook
	    $wp_customize->add_setting('facebook', array(
	        'default'        => 'http://www.facebook.com/envato',
	        'capability'     => 'edit_theme_options'
	    ));
	 
	    $wp_customize->add_control('facebook', array(
	        'label'      => __('Facebook', 'humbleshop'),
	        'section'    => 'the_social',
	        'settings'   => 'facebook'
	    ));

	    // Twitter
	    $wp_customize->add_setting('twitter', array(
	        'default'        => 'http://www.twitter.com/envato',
	        'capability'     => 'edit_theme_options'
	    ));
	 
	    $wp_customize->add_control('twitter', array(
	        'label'      => __('Twitter', 'humbleshop'),
	        'section'    => 'the_social',
	        'settings'   => 'twitter'
	    ));

	    // Pinterest
	    $wp_customize->add_setting('pinterest', array(
	        'default'        => 'http://www.pinterest.com/envato',
	        'capability'     => 'edit_theme_options'
	    ));
	 
	    $wp_customize->add_control('pinterest', array(
	        'label'      => __('Pinterest', 'humbleshop'),
	        'section'    => 'the_social',
	        'settings'   => 'pinterest'
	    ));

	    // Instagram
	    $wp_customize->add_setting('instagram', array(
	        'default'        => 'http://instagram.com/insideenvato',
	        'capability'     => 'edit_theme_options'
	    ));
	 
	    $wp_customize->add_control('instagram', array(
	        'label'      => __('Instagram', 'humbleshop'),
	        'section'    => 'the_social',
	        'settings'   => 'instagram'
	    ));

	    // Google Plus
	    $wp_customize->add_setting('google-plus', array(
	        'default'        => 'http://plus.google.com/107285294994146126204',
	        'capability'     => 'edit_theme_options'
	    ));
	 
	    $wp_customize->add_control('google-plus', array(
	        'label'      => __('Google Plus', 'humbleshop'),
	        'section'    => 'the_social',
	        'settings'   => 'google-plus'
	    ));

	    // Soundcloud
	    $wp_customize->add_setting('soundcloud', array(
	        'default'        => 'http://www.soundcloud.com/yuna-music',
	        'capability'     => 'edit_theme_options'
	    ));
	 
	    $wp_customize->add_control('soundcloud', array(
	        'label'      => __('Soundcloud', 'humbleshop'),
	        'section'    => 'the_social',
	        'settings'   => 'soundcloud'
	    ));

	// Contact ----------------------------------------------
	$wp_customize->add_section('the_additional', array(
		'title' => __( 'Additional CSS', 'humbleshop' ),
		'capability' => 'edit_theme_options',
		'description' => __( 'Place your custom CSS here', 'humbleshop' ),
		'priority'    => 400
	));
		$wp_customize->add_setting( 'additionalcss', array(
		    'default'        => '',
		) );
		 
		$wp_customize->add_control( new Additional_CSS( $wp_customize, 'additionalcss', array(
		    'label'   => 'Insert CSS',
		    'section' => 'the_additional',
		    'settings'   => 'additionalcss',
		) ) );

}
add_action( 'customize_register', 'humbleshop_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function humbleshop_customize_preview_js() {
	wp_enqueue_script( 'humbleshop_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'humbleshop_customize_preview_js' );

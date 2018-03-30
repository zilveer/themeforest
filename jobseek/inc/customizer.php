<?php

function jobseek_sanitize_text( $input ) {
	return wp_kses_post( force_balance_tags( $input ) );
}

add_action('customize_register','jobseek_customize_register');

function jobseek_customize_register( $wp_customize ) {

	/* Logo */

	$wp_customize->add_setting( 'site_logo', array(
	    'type'              => 'theme_mod',
	    'capability'        => 'edit_theme_options',
	    'theme_supports'    => '',
	    'default'           => '',
	    'transport'         => 'refresh',
	    'sanitize_callback' => 'jobseek_sanitize_text',
	) );

		$wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'site_logo', array(
		    'label' => __( 'Logo', 'modellic' ),
		    'section' => 'title_tagline',
		    'mime_type' => 'image',
		) ) );

}

// Config
Kirki::add_config( 'jobseek', array(
	'capability'  => 'edit_theme_options',
	'option_type' => 'theme_mod',
) );

/* Job / Resume Listings
-------------------------------------------------------------------------------------------------------------------*/

Kirki::add_section( 'listings', array(
    'title'          => __( 'Job / Resume Listings' ),
    'priority'       => 160,
    'capability'     => 'edit_theme_options',
) );

	Kirki::add_field( 'jobseek', array(
		'type'        => 'switch',
		'settings'    => 'jobseek_enable_salary',
		'label'       => __( 'Salary', 'modellic' ),
		'section'     => 'listings',
		'default'     => '1',
		'priority'    => 10,
		'choices'     => array(
			'on'  => esc_attr__( 'Enable', 'modellic' ),
			'off' => esc_attr__( 'Disable', 'modellic' ),
		),
	) );

	Kirki::add_field( 'jobseek', array(
		'type'        => 'switch',
		'settings'    => 'jobseek_enable_rate',
		'label'       => __( 'Rate', 'modellic' ),
		'section'     => 'listings',
		'default'     => '1',
		'priority'    => 10,
		'choices'     => array(
			'on'  => esc_attr__( 'Enable', 'modellic' ),
			'off' => esc_attr__( 'Disable', 'modellic' ),
		),
	) );

/* Registration
-------------------------------------------------------------------------------------------------------------------*/

Kirki::add_section( 'registration', array(
    'title'          => __( 'Login / Registration' ),
    'priority'       => 160,
    'capability'     => 'edit_theme_options',
) );

	// Enabled Roles
	
	$user_roles = get_roles();

	Kirki::add_field( 'jobseek', array(
		'type'        => 'multicheck',
		'settings'    => 'enabled_roles',
		'label'       => __( 'Enabled Roles', 'jobseek' ),
		'section'     => 'registration',
		'default'     => array( 'employer', 'candidate' ),
		'priority'    => 10,
		'multiple'    => 1,
		'choices'     => $user_roles
	) );

	/* Default Role */
	Kirki::add_field( 'jobseek', array(
		'type'        => 'select',
		'settings'    => 'default_role',
		'label'       => __( 'Default Role', 'jobseek' ),
		'section'     => 'registration',
		'default'     => 'employer',
		'priority'    => 10,
		'multiple'    => 1,
		'choices'     => $user_roles
	) );

/* Footer Settings
-------------------------------------------------------------------------------------------------------------------*/

Kirki::add_section( 'footer', array(
    'title'          => __( 'Footer' ),
    'priority'       => 160,
    'capability'     => 'edit_theme_options',
) );

	// Footer Widget Area 1
	Kirki::add_field( 'jobseek', array(
		'type'        => 'select',
		'settings'    => 'footer_sidebar_1',
		'label'       => __( 'Footer Sidebar Column 1', 'jobseek' ),
		'section'     => 'footer',
		'default'     => 'vc_col-sm-6',
		'priority'    => 10,
		'multiple'    => 1,
		'choices'     => array(
	    	'vc_col-sm-12' => esc_attr__( 'full width', 'jobseek' ),
	    	'vc_col-sm-6'  => esc_attr__( '1/2', 'jobseek' ),
	    	'vc_col-sm-4'  => esc_attr__( '1/3', 'jobseek' ),
	    	'vc_col-sm-3'  => esc_attr__( '1/4', 'jobseek' ),
	    	'disabled'     => esc_attr__( 'disabled', 'jobseek' ),
		),
	) );

	// Footer Widget Area 2
	Kirki::add_field( 'jobseek', array(
		'type'        => 'select',
		'settings'    => 'footer_sidebar_2',
		'label'       => __( 'Footer Sidebar Column 2', 'jobseek' ),
		'section'     => 'footer',
		'default'     => 'disabled',
		'priority'    => 10,
		'multiple'    => 1,
		'choices'     => array(
	    	'vc_col-sm-12' => esc_attr__( 'full width', 'jobseek' ),
	    	'vc_col-sm-6'  => esc_attr__( '1/2', 'jobseek' ),
	    	'vc_col-sm-4'  => esc_attr__( '1/3', 'jobseek' ),
	    	'vc_col-sm-3'  => esc_attr__( '1/4', 'jobseek' ),
	    	'disabled'     => esc_attr__( 'disabled', 'jobseek' ),
		),
	) ); 

	// Footer Widget Area 3
	Kirki::add_field( 'jobseek', array(
		'type'        => 'select',
		'settings'    => 'footer_sidebar_3',
		'label'       => __( 'Footer Sidebar Column 3', 'jobseek' ),
		'section'     => 'footer',
		'default'     => 'vc_col-sm-3',
		'priority'    => 10,
		'multiple'    => 1,
		'choices'     => array(
	    	'vc_col-sm-12' => esc_attr__( 'full width', 'jobseek' ),
	    	'vc_col-sm-6'  => esc_attr__( '1/2', 'jobseek' ),
	    	'vc_col-sm-4'  => esc_attr__( '1/3', 'jobseek' ),
	    	'vc_col-sm-3'  => esc_attr__( '1/4', 'jobseek' ),
	    	'disabled'     => esc_attr__( 'disabled', 'jobseek' ),
		),
	) );

	// Footer Widget Area 4
	Kirki::add_field( 'jobseek', array(
		'type'        => 'select',
		'settings'    => 'footer_sidebar_4',
		'label'       => __( 'Footer Sidebar Column 4', 'jobseek' ),
		'section'     => 'footer',
		'default'     => 'vc_col-sm-3',
		'priority'    => 10,
		'multiple'    => 1,
		'choices'     => array(
	    	'vc_col-sm-12' => esc_attr__( 'full width', 'jobseek' ),
	    	'vc_col-sm-6'  => esc_attr__( '1/2', 'jobseek' ),
	    	'vc_col-sm-4'  => esc_attr__( '1/3', 'jobseek' ),
	    	'vc_col-sm-3'  => esc_attr__( '1/4', 'jobseek' ),
	    	'disabled'     => esc_attr__( 'disabled', 'jobseek' ),
		),
	) );

	// Footer Text
	Kirki::add_field( 'jobseek', array(
		'type'        => 'code',
		'settings'    => 'footer_text',
		'label'       => __( 'Footer Text', 'jobseek' ),
		'section'     => 'footer',
		'default'     => '&copy; 2015 Jobseek - Responsive Job Board WordPress Theme<br>Designed &amp; Developed by <a href="http://themeforest.net/user/Coffeecream" target="_blank">Coffeecream Themes</a>',
		'priority'    => 10,
		'choices'     => array(
			'language' => 'html',
			'theme'    => 'monokai',
			'height'   => 250,
		),
	) );

	// Facebook
	Kirki::add_field( 'jobseek', array(
		'type'     => 'text',
		'settings' => 'facebook',
		'label'    => __( 'Facebook Link', 'jobseek' ),
		'section'  => 'footer',
		'priority' => 10,
	) );

	// Twitter
	Kirki::add_field( 'jobseek', array(
		'type'     => 'text',
		'settings' => 'twitter-bird',
		'label'    => __( 'Twitter Link', 'jobseek' ),
		'section'  => 'footer',
		'priority' => 10,
	) );

	// Google+
	Kirki::add_field( 'jobseek', array(
		'type'     => 'text',
		'settings' => 'google-plus-1',
		'label'    => __( 'Google+ Link', 'jobseek' ),
		'section'  => 'footer',
		'priority' => 10,
	) );

	// LinkedIn
	Kirki::add_field( 'jobseek', array(
		'type'     => 'text',
		'settings' => 'linkedin',
		'label'    => __( 'LinkedIn Link', 'jobseek' ),
		'section'  => 'footer',
		'priority' => 10,
	) );

	// YouTube
	Kirki::add_field( 'jobseek', array(
		'type'     => 'text',
		'settings' => 'youtube-clip',
		'label'    => __( 'YouTube Link', 'jobseek' ),
		'section'  => 'footer',
		'priority' => 10,
	) );

	// Instagram
	Kirki::add_field( 'jobseek', array(
		'type'     => 'text',
		'settings' => 'instagram',
		'label'    => __( 'Instagram Link', 'jobseek' ),
		'section'  => 'footer',
		'priority' => 10,
	) );

/* Colors
-------------------------------------------------------------------------------------------------------------------*/

Kirki::add_panel( 'color_scheme', array(
    'priority'    => 10,
    'title'       => __( 'Colors Scheme', 'jobseek' ),
) );

	// Link Color Section
	Kirki::add_section( 'link_color', array(
	    'title'          => __( 'Link Color', 'jobseek' ),
	    'panel'          => 'color_scheme', // Not typically needed.
	    'priority'       => 160,
	    'capability'     => 'edit_theme_options',
	) );

		// Brand / Link Color
		Kirki::add_field( 'jobseek', array(
		    'type'        => 'multicolor',
		    'settings'    => 'link_color',
		    'label'       => esc_attr__( 'Link Color', 'jobseek' ),
		    'section'     => 'link_color',
		    'priority'    => 10,
		    'choices'     => array(
		        'link'    => esc_attr__( 'Color', 'jobseek' ),
		        'hover'   => esc_attr__( 'Hover', 'jobseek' ),
		        'active'  => esc_attr__( 'Active', 'jobseek' ),
		    ),
		    'default'     => array(
		        'link'    => '#df9124',
		        'hover'   => '#b5751b',
		        'active'  => '#b5751b',
		    ),
		) );

	// Brand Color Section
	Kirki::add_section( 'brand_color', array(
	    'title'          => __( 'Brand Color', 'jobseek' ),
	    'panel'          => 'color_scheme', // Not typically needed.
	    'priority'       => 160,
	    'capability'     => 'edit_theme_options',
	) );

		// Accent Gradient
		Kirki::add_field( 'jobseek', array(
		    'type'        => 'multicolor',
		    'settings'    => 'accent_color',
		    'label'       => esc_attr__( 'Brand Gradient / Background', 'jobseek' ),
			'description' => __( 'Choose same colors if you do not need a gradient.', 'jobseek' ),
		    'section'     => 'brand_color',
		    'priority'    => 10,
		    'choices'     => array(
		        'start'   => esc_attr__( 'Start', 'jobseek' ),
		        'end'     => esc_attr__( 'End', 'jobseek' ),
		    ),
		    'default'     => array(
		        'start'   => '#fd677d',
		        'end'     => '#df9124',
		    ),
		) );

		// Accent Gradient Hover
		Kirki::add_field( 'jobseek', array(
		    'type'        => 'multicolor',
		    'settings'    => 'accent_color_hover',
		    'label'       => esc_attr__( 'Brand Gradient / Background Hover', 'jobseek' ),
			'description' => __( 'Choose same colors if you do not need a gradient.', 'jobseek' ),
		    'section'     => 'brand_color',
		    'priority'    => 10,
		    'choices'     => array(
		        'start'   => esc_attr__( 'Start', 'jobseek' ),
		        'end'     => esc_attr__( 'End', 'jobseek' ),
		    ),
		    'default'     => array(
		        'start'   => '#fd677d',
		        'end'     => '#df9124',
		    ),
		) );

	// Header Color
	Kirki::add_section( 'header_color', array(
	    'title'          => __( 'Header Colors' ),
	    'panel'          => 'color_scheme', // Not typically needed.
	    'priority'       => 160,
	    'capability'     => 'edit_theme_options',
	) );

		// Header Background
		Kirki::add_field( 'jobseek', array(
		    'type'        => 'multicolor',
		    'settings'    => 'header_menu',
		    'label'       => esc_attr__( 'Header Background & Menu Links', 'jobseek' ),
			//'description' => __( 'Choose same colors if you do not need a gradient.', 'jobseek' ),
		    'section'     => 'header_color',
		    'priority'    => 10,
		    'choices'     => array(
		        'start'     => esc_attr__( 'BG Start', 'jobseek' ),
		        'end'       => esc_attr__( 'BG End', 'jobseek' ),
		        'link'      => esc_attr__( 'Link', 'jobseek' ),
		        'highlight' => esc_attr__( 'Highlighted', 'jobseek' ),
		    ),
		    'default'     => array(
		        'start'     => '#fd677d',
		        'end'       => '#df9124',
		        'link'      => '#fff',
		        'highlight' => '#000',
		    ),
		) );

		// Header Active / Dropdown Menu
		Kirki::add_field( 'jobseek', array(
		    'type'        => 'multicolor',
		    'settings'    => 'header_dropdown',
		    'label'       => esc_attr__( 'Active Item and Dropdown Menu Background & Links', 'jobseek' ),
		    'section'     => 'header_color',
		    'priority'    => 10,
		    'choices'     => array(
		        'background' => esc_attr__( 'Background', 'jobseek' ),
		        'link'       => esc_attr__( 'Link', 'jobseek' ),
		    ),
		    'default'     => array(
		        'background' => '#000',
		        'link'       => '#fff',
		    ),
		) );

/* Colors
-------------------------------------------------------------------------------------------------------------------*/

Kirki::add_section( 'typography', array(
    'title'          => __( 'Typography' ),
    'priority'       => 160,
    'capability'     => 'edit_theme_options',
) );

	Kirki::add_field( 'jobseek', array(
		'type'        => 'typography',
		'settings'    => 'body_font',
		'label'       => esc_attr__( 'Body Font', 'jobseek' ),
		'section'     => 'typography',
		'default'     => array(
			'font-family'    => 'Roboto',
			'variant'        => 'regular',
			//'font-size'      => '14px',
			//'line-height'    => '1.5',
			//'letter-spacing' => '0',
			'subsets'        => array( 'latin-ext' ),
			//'color'          => '#333333',
			//'text-transform' => 'none',
			//'text-align'     => 'left'
		),
		'priority'    => 10,
		'output'      => array(
			array(
				'element' => 'body',
			),
		),
	) );

	Kirki::add_field( 'jobseek', array(
		'type'        => 'typography',
		'settings'    => 'titles_font',
		'label'       => esc_attr__( 'Titles Font', 'jobseek' ),
		'section'     => 'typography',
		'default'     => array(
			'font-family'    => 'Montserrat',
			'variant'        => 'bold',
			//'font-size'      => '14px',
			//'line-height'    => '1.5',
			'letter-spacing' => '0.05em',
			'subsets'        => array( 'latin-ext' ),
			//'color'          => '#333333',
			'text-transform' => 'none',
			//'text-align'     => 'left'
		),
		'priority'    => 10,
		'output'      => array(
			array(
				'element' => 'h1, h2, h3, h4, h5, h6',
			),
		),
	) );

/* CSS
-------------------------------------------------------------------------------------------------------------------*/

function jobseek_customizer_css() { ?>

<style type="text/css">

<?php $site_logo_id = get_theme_mod( 'site_logo', '' );

if ( !empty( $site_logo_id ) ) {

	$site_logo_meta = wp_get_attachment_metadata( $site_logo_id );

	$header_height = $site_logo_meta['height'] + 32;

	$collapser_top = $header_height / 2;
	$collapser_top_admin_bar = $header_height / 2 + 47; ?>

	#header,
	#header nav #main-nav li a {
		height: <?php echo $header_height; ?>px;
		line-height: <?php echo $header_height; ?>px;
	}

	body {
		padding-top: <?php echo $header_height; ?>px;
	}

	@media (max-width: 767px) {

		#header nav .menu-collapser {
			top: <?php echo $collapser_top; ?>px;
			margin-top: -15px;
		}

		.admin-bar #header nav .menu-collapser {
			top: <?php echo $collapser_top_admin_bar; ?>px;			
		}

	}

<?php } ?>

<?php // Branding Color

$link_defaults = array(
    'link'    => '#df9124',
    'hover'   => '#b5751b',
    'active'  => '#b5751b',
);

$link_color = get_theme_mod( 'link_color', $link_defaults ); ?>

a,
.category-groups ul li a:after,
.vc_tta-tabs.vc_tta-tabs-position-top .vc_tta-tabs-list li a,
footer .widget.widget_nav_menu ul li a:before,
.widget.job-overview ul li a,
ul li:before,
.job_tags:before,
.bookmark-notice,
.btn,
.button,
.load_more_jobs,
.load_more_resumes,
.resume_file_button,
[type=button],
[type=submit] { color: <?php echo $link_color['link']; ?>; }

.bookmark-notice,
.btn,
.button,
.load_more_jobs,
.load_more_resumes,
.resume_file_button,
[type=button],
[type=submit],
.pagination .page-numbers:hover,
.job-manager-pagination ul li a:hover {
	border-color: <?php echo $link_color['link']; ?>;
}

a:hover,
.widget.job-overview ul li a:hover { color: <?php echo $link_color['hover']; ?>; }

a:active,
.widget.job-overview ul li a:active { color: <?php echo $link_color['active']; ?>; }


<?php // Header Colors

$header_menu = array(
    'start'     => '#fd677d',
    'end'       => '#df9124',
    'link'      => '#fff',
    'highlight' => '#000',
);

$header_dropdown = array(
    'background' => '#000',
    'link'       => '#fff',
);

$header_menu_colors = get_theme_mod( 'header_menu', $header_menu );
$header_dropdown_colors = get_theme_mod( 'header_dropdown', $header_dropdown ); ?>

#header {
	background-color: <?php echo $header_menu_colors['start']; ?>;
	background-image: -webkit-gradient(linear,left top,right top,from(<?php echo $header_menu_colors['start']; ?>),to(<?php echo $header_menu_colors['end']; ?>));
	background-image: -webkit-linear-gradient(left,<?php echo $header_menu_colors['start']; ?>,<?php echo $header_menu_colors['end']; ?>);
	background-image: -moz-linear-gradient(left,<?php echo $header_menu_colors['start']; ?>,<?php echo $header_menu_colors['end']; ?>);
	background-image: -ms-linear-gradient(left,<?php echo $header_menu_colors['start']; ?>,<?php echo $header_menu_colors['end']; ?>);
	background-image: -o-linear-gradient(left,<?php echo $header_menu_colors['start']; ?>,<?php echo $header_menu_colors['end']; ?>);
}
#header nav #main-nav > li > a { color: <?php echo $header_menu_colors['link']; ?>; }
#header nav #main-nav > li.highlight > a { color: <?php echo $header_menu_colors['highlight']; ?>; }

#header nav #main-nav li ul,
#header nav #main-nav li:hover,
#header nav #main-nav li.current-menu-item,
#header nav #main-nav li.current-menu-parent {
	background: <?php echo $header_dropdown_colors['background']; ?>;
}
#header nav #main-nav a,
#header nav #main-nav li:hover a,
#header nav #main-nav li ul li a,
#header nav #main-nav li ul li a:hover { color: <?php echo $header_dropdown_colors['link']; ?>; }

<?php // Accent Color

$accent_color_defaults = array(
    'start'   => '#fd677d',
    'end'     => '#df9124',
);

$accent_color = get_theme_mod( 'accent_color', $accent_color_defaults ); ?>

.application_button,
.bookmark-notice,
.load_more_jobs,
.load_more_resumes,
.resume_contact_button,
[type=submit],
.bookmark-notice.btn-primary,
.btn.btn-primary,
.button.btn-primary,
.load_more_jobs.btn-primary,
.load_more_resumes.btn-primary,
.resume_file_button.btn-primary,
[type=button].btn-primary,
[type=submit].btn-primary,
#job_package_selection .job_listing_packages .job_packages .job-package.active,
#job_package_selection .job_listing_packages .job_packages .resume-package.active,
#job_package_selection .job_listing_packages .resume_packages .job-package.active,
#job_package_selection .job_listing_packages .resume_packages .resume-package.active,
.pagination .page-numbers:hover,
.job-manager-pagination ul li a:hover,
.archive article .post-image a:after,
.blog article .post-image a:after,
.brand-background,
.woocommerce input.button,
.section-title:after,
ul.job_listings li.job_position_featured:before,
.job-manager-alerts tfoot a {
	background-color: <?php echo $accent_color['start']; ?>;
	background-image: -webkit-gradient(linear,left top,right top,from(<?php echo $accent_color['start']; ?>),to(<?php echo $accent_color['end']; ?>));
	background-image: -webkit-linear-gradient(left,<?php echo $accent_color['start']; ?>,<?php echo $accent_color['end']; ?>);
	background-image: -moz-linear-gradient(left,<?php echo $accent_color['start']; ?>,<?php echo $accent_color['end']; ?>);
	background-image: -ms-linear-gradient(left,<?php echo $accent_color['start']; ?>,<?php echo $accent_color['end']; ?>);
	background-image: -o-linear-gradient(left,<?php echo $accent_color['start']; ?>,<?php echo $accent_color['end']; ?>);
}

<?php // Accent Color Hover

$accent_color_hover_defaults = array(
    'start'   => '#fd677d',
    'end'     => '#df9124',
);

$accent_color_hover = get_theme_mod( 'accent_color_hover', $accent_color_hover_defaults ); ?>

.application_button:hover,
.bookmark-notice:hover,
.load_more_jobs:hover,
.load_more_resumes:hover,
.resume_contact_button:hover,
[type=submit]:hover,
.bookmark-notice.btn-primary:hover,
.btn.btn-primary:hover,
.button.btn-primary:hover,
.load_more_jobs.btn-primary:hover,
.load_more_resumes.btn-primary:hover,
.resume_file_button.btn-primary:hover,
[type=button].btn-primary:hover,
[type=submit].btn-primary:hover,
.woocommerce input.button:hover,
.job-manager-alerts tfoot a:hover {
	background-color: <?php echo $accent_color_hover['start']; ?>;
	background-image: -webkit-gradient(linear,left top,right top,from(<?php echo $accent_color_hover['start']; ?>),to(<?php echo $accent_color_hover['end']; ?>));
	background-image: -webkit-linear-gradient(left,<?php echo $accent_color_hover['start']; ?>,<?php echo $accent_color_hover['end']; ?>);
	background-image: -moz-linear-gradient(left,<?php echo $accent_color_hover['start']; ?>,<?php echo $accent_color_hover['end']; ?>);
	background-image: -ms-linear-gradient(left,<?php echo $accent_color_hover['start']; ?>,<?php echo $accent_color_hover['end']; ?>);
	background-image: -o-linear-gradient(left,<?php echo $accent_color_hover['start']; ?>,<?php echo $accent_color_hover['end']; ?>);
}

.color-alternative .category-groups ul li a span {
	color: <?php echo $accent_color['end']; ?>;
	border-color: <?php echo $accent_color['end']; ?>;
}

</style><?php

}

add_action( 'wp_head', 'jobseek_customizer_css' );
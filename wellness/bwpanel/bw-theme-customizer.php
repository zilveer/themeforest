<?php
function bw_theme_customize( $wp_customize ) {
    $wp_customize->add_section( 'custom_color', array(
            'title'    => __( 'Custom Skin Colors', 'bw_theme'),
            'priority' => 20,
    ) );
	//color selection settings
	$wp_customize->add_setting( 'bw_bg_color', array(
        'default'    => get_option( 'bw_bg_color' ),
        'type'       => 'option',
        'capability' => 'manage_options',
		'transport'   => 'postMessage',
		'sanitize_callback' => 'sanitize_hex_color',
    ) );

    $wp_customize->add_setting( 'header_color_top', array(
        'default'    => get_option( 'header_color_top' ),
        'type'       => 'option',
        'capability' => 'manage_options',
		'transport'   => 'postMessage',
		'sanitize_callback' => 'sanitize_hex_color',
    ) );
	
    $wp_customize->add_setting( 'header_color_bot', array(
        'default'    => get_option( 'header_color_bot' ),
        'type'       => 'option',
        'capability' => 'manage_options',
		'transport'   => 'postMessage',
		'sanitize_callback' => 'sanitize_hex_color',
    ) );
	
	$wp_customize->add_setting( 'bw_link_color', array(
        'default'    => get_option( 'bw_link_color' ),
        'type'       => 'option',
        'capability' => 'manage_options',
		'transport'   => 'postMessage',
		'sanitize_callback' => 'sanitize_hex_color',
    ) );
	
	$wp_customize->add_setting( 'bw_footerlink_color', array(
        'default'    => get_option( 'bw_footerlink_color' ),
        'type'       => 'option',
        'capability' => 'manage_options',
		'transport'   => 'postMessage',
		'sanitize_callback' => 'sanitize_hex_color',
    ) );
	
	
	//Color selection controls
	$wp_customize->add_control( new WP_Customize_Color_Control( 
	$wp_customize, 
	'color_bg', 
	array(
		'label'      => __( 'Background Color', 'bw_theme' ),
		'section'    => 'custom_color',
		'settings'   => 'bw_bg_color',
	) ) 
	);
	
    $wp_customize->add_control( new WP_Customize_Color_Control( 
	$wp_customize, 
	'color_top', 
	array(
		'label'      => __( 'Top Gradient Color', 'bw_theme' ),
		'section'    => 'custom_color',
		'settings'   => 'header_color_top',
	) ) 
	);
	
	$wp_customize->add_control( new WP_Customize_Color_Control( 
	$wp_customize, 
	'color_bot', 
	array(
		'label'      => __( 'Bottom Gradient Color', 'bw_theme' ),
		'section'    => 'custom_color',
		'settings'   => 'header_color_bot',
	) ) 
	);
	
	$wp_customize->add_control( new WP_Customize_Color_Control( 
	$wp_customize, 
	'link_color', 
	array(
		'label'      => __( 'Link Color', 'bw_theme' ),
		'section'    => 'custom_color',
		'settings'   => 'bw_link_color',
	) ) 
	);

	$wp_customize->add_control( new WP_Customize_Color_Control( 
	$wp_customize, 
	'footer_color', 
	array(
		'label'      => __( 'Footer Link Hover Color', 'bw_theme' ),
		'section'    => 'custom_color',
		'settings'   => 'bw_footerlink_color',
	) ) 
	);	
	
	//$wp_customize->get_setting('header_color')->transport='postMessage';

	if ( $wp_customize->is_preview() && !is_admin() )
    add_action( 'wp_footer', 'bw_theme_customize_preview', 21);
	
	}
add_action( 'customize_register', 'bw_theme_customize' );


//Live Preview


	function bw_theme_customize_preview() {
    ?>
    <script type="text/javascript">
    ( function( $ ){
	//Update panel header color...

	wp.customize( 'bw_bg_color', function( value ) {        
        
        value.bind( function( bglinkcolor ) {
             
            $('body').css('background', bglinkcolor);
            
        } );
    } );

    wp.customize( 'header_color_bot', function( value ) {        
                            
        value.bind( function( botvalue ) {
            
            var api = wp.customize,
                topval= api.instance('header_color_top').get();    
            
            $('div.logowrapper, div.bookingform, div.mainmenu, .mobile-menu li a').css('background', 'linear-gradient(to bottom, ' + topval + ' 0%, ' + botvalue + ' 100%)');
            $('div.logowrapper, div.bookingform, div.mainmenu, .mobile-menu li a').css('background', '-webkit-gradient(linear, 0% 0%, 0% 100%, from(' + topval + '), to(' + botvalue + '))');
			$('div.logowrapper, div.bookingform, div.mainmenu, .mobile-menu li a').css('background', '-webkit-linear-gradient(top,' + topval + ', ' + botvalue + ')');
			$('div.logowrapper, div.bookingform, div.mainmenu, .mobile-menu li a').css('background', '-moz-linear-gradient(top,' + topval + ', ' + botvalue + ')');
			$('div.logowrapper, div.bookingform, div.mainmenu, .mobile-menu li a').css('background', '-ms-linear-gradient(top,' + topval + ', ' + botvalue + ')');
			$('div.logowrapper, div.bookingform, div.mainmenu, .mobile-menu li a').css('background', '-o-linear-gradient(top,' + topval + ', ' + botvalue + ')');
			$('div.logowrapper, div.bookingform, div.mainmenu, .mobile-menu li a').css('filter', 'progid:DXImageTransform.Microsoft.gradient( startColorstr="' + topval + '", endColorstr="' + botvalue + '",GradientType=0)');

        } );
    } );

    wp.customize( 'header_color_top', function( value ) {        
        
        value.bind( function( topvalue ) {
            
            var api = wp.customize,
                botvalue= api.instance('header_color_bot').get();    
            
            $('div.logowrapper, div.bookingform, div.mainmenu, .mobile-menu li a').css('background', 'linear-gradient(to bottom, ' + topvalue + ' 0%, ' + botvalue + ' 100%)');
            $('div.logowrapper, div.bookingform, div.mainmenu, .mobile-menu li a').css('background', '-webkit-gradient(linear, 0% 0%, 0% 100%, from(' + topvalue + '), to(' + botvalue + '))');
			$('div.logowrapper, div.bookingform, div.mainmenu, .mobile-menu li a').css('background', '-webkit-linear-gradient(top,' + topvalue + ', ' + botvalue + ')');
			$('div.logowrapper, div.bookingform, div.mainmenu, .mobile-menu li a').css('background', '-moz-linear-gradient(top,' + topvalue + ', ' + botvalue + ')');
			$('div.logowrapper, div.bookingform, div.mainmenu, .mobile-menu li a').css('background', '-ms-linear-gradient(top,' + topvalue + ', ' + botvalue + ')');
			$('div.logowrapper, div.bookingform, div.mainmenu, .mobile-menu li a').css('background', '-o-linear-gradient(top,' + topvalue + ', ' + botvalue + ')');
			$('div.logowrapper, div.bookingform, div.mainmenu, .mobile-menu li a').css('filter', 'progid:DXImageTransform.Microsoft.gradient( startColorstr="' + topvalue + '", endColorstr="' + botvalue + '",GradientType=0)');

        } );
    } );
	
	wp.customize( 'bw_link_color', function( value ) {        
        
        value.bind( function( linkcolor ) {
             
            $('.contentwrapper a, .contentwrapper1 a, .postwrapper1 h2 a:hover').css('color', linkcolor);
            
        } );
    } );

	wp.customize( 'bw_footerlink_color', function( value ) {        
        
        value.bind( function( footlinkcolor ) {
             
            $('.copyright a, .footercontent a:hover, .copyrighttext a').css('color', footlinkcolor);
            
        } );
    } );	
	
	
    } )( jQuery )
    </script>
    <?php 
} 
?>
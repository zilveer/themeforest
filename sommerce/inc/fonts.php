<?php
/**
 * All cufon replaces. Add here all fonts replaces
 * 
 * @package WordPress
 * @subpackage YIW Themes
 * @since 1.0 
 */       
 
// the roles to apply the special font choosen
define( 'YIW_ROLES_FONT', 'h1, h2, h3, h4, h5, h6, .special-font' );

$yiw_fonts = array(
    array(
        'id_option' => 'font_logo',
        'css_role' => '.logo-title, .logo',
    ),
    array(
        'id_option' => 'font_title',
        'css_role' => 'h1, h2, h3, h4, h5, h6, .special-font,form.woocommerce-shipping-calculator p a',
    ),
    array(
        'id_option' => 'font_nav',
        'css_role' => '#nav ul > li > a',
    ),
    array(
        'id_option' => 'font_slogan',
        'css_role' => '#slogan h1',
    ),
    array(
        'id_option' => 'font_paragraph',
        'css_role' => 'p, li',
    )
);

// array of all fonts size customizable by user
$yiw_sizes = array(
	'general' => array(    
		'name-section' => __( 'General', 'yiw' ),  
		'options' => array(
	
			'text-size' => array(    
				'default' => 12,     
				'css_role' => 'p',   
				'css_attr' => 'font-size',
				'panel_title' => __( "General text", 'yiw' ),   
				'panel_desc' => __( "Size of the general text paragraphs.", 'yiw' ) 
			),
	
			'h1-size' => array(    
				'default' => 27,     
				'css_role' => 'h1',   
				'css_attr' => 'font-size',
				'panel_title' => __( "H1 headline", 'yiw' ),   
				'panel_desc' => __( "Size of the H1 elements.", 'yiw' ) 
			),
	
			'h2-size' => array(    
				'default' => 25,     
				'css_role' => 'h2',   
				'css_attr' => 'font-size',
				'panel_title' => __( "H2 headline", 'yiw' ),   
				'panel_desc' => __( "Size of the H2 elements.", 'yiw' ) 
			),   
	
			'h3-size' => array(    
				'default' => 23,     
				'css_role' => 'h3',   
				'css_attr' => 'font-size',
				'panel_title' => __( "H3 headline", 'yiw' ),   
				'panel_desc' => __( "Size of the H4 elements.", 'yiw' ) 
			),    
	
			'h4-size' => array(    
				'default' => 20,     
				'css_role' => 'h4',   
				'css_attr' => 'font-size',
				'panel_title' => __( "H4 headline", 'yiw' ),   
				'panel_desc' => __( "Size of the H4 elements.", 'yiw' ) 
			),    
	
			'h5-size' => array(    
				'default' => 16,     
				'css_role' => 'h5',   
				'css_attr' => 'font-size',
				'panel_title' => __( "H5 headline", 'yiw' ),   
				'panel_desc' => __( "Size of the H5 elements.", 'yiw' ) 
			),     
	
			'h6-size' => array(    
				'default' => 12,     
				'css_role' => 'h6',   
				'css_attr' => 'font-size',
				'panel_title' => __( "H6 headline", 'yiw' ),   
				'panel_desc' => __( "Size of the H6 elements.", 'yiw' ) 
			),
	
			'nav-size' => array(    
				'default' => 10,     
				'css_role' => '#nav li a',   
				'css_attr' => 'font-size',
				'panel_title' => __( "Navigation", 'yiw' ),   
				'panel_desc' => __( "Size of the navigation elements.", 'yiw' ),
                'important' => true 
			),
		
		),
		
	),
); 
?>
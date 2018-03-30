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

// all fonts type
$yiw_fonts = array(
    array(
        'id_option' => 'font_logo',
        'css_role' => '#logo a.logo-text',
    ),
    array(
        'id_option' => 'font_description',
        'css_role' => '#logo .logo-description',
    ),
    array(
        'id_option' => 'font_navigation',
        'css_role' => '#nav > ul > li > a, #nav .menu > ul > li > a',
    ),
    array(
        'id_option' => 'font_subnavigation',
        'css_role' => '#nav ul.children li a, #nav ul.sub-menu li a',
    ),
    array(
        'id_option' => 'font_p',
        'css_role' => '#content li, #content li a, address, p, p a, .unoslider_caption, .comment-body, .comment-body p, #comments .fn, .cart span, .shop_table span, .shop_table th, .shop_table td, #respond #submit, .shop-ribbon .products li .below-thumb, .products li a strong.below-thumb, .products.ribbon .below-thumb',
    ),    
    array(
        'id_option' => 'font_h1',
        'css_role' => 'h1, h1 a',
    ),       
    array(
        'id_option' => 'font_h2',
        'css_role' => 'h2, h2 a',
    ),       
    array(
        'id_option' => 'font_h3',
        'css_role' => 'h3, h3 a',
    ),       
    array(
        'id_option' => 'font_h4',
        'css_role' => 'h4, h4 a',
    ),       
    array(
        'id_option' => 'font_h5',
        'css_role' => 'h5, h5 a', 
    ),       
    array(
        'id_option' => 'font_h6',
        'css_role' => 'h6, h6 a',
    ),       
    array(
        'id_option' => 'font_nivo_title',
        'css_role' => '#slider .slider-nivo-static h3, .slider-minilayers-static h3, #slider .slider-nivo-static .short-text, .slider-minilayers-static .short-text',
    ),       
    array(
        'id_option' => 'font_nivo_title_brackets',
        'css_role' => '#slider .slider-nivo-static h3 span, .slider-minilayers-static h3 span',
    ),       
    array(
        'id_option' => 'font_nivo_content',
        'css_role' => '#slider .slider-nivo-static p, .slider-minilayers-static p',
    ),       
    array(
        'id_option' => 'font_slogan',
        'css_role' => '#slogan h2',
    ),       
    array(
        'id_option' => 'font_subslogan',
        'css_role' => '#slogan h3',
    ),
    array(
        'id_option' => 'font_sidebarfooter',
        'css_role' => '#sidebar .widget h2, #sidebar .widget h3, #footer .widget h2, #footer .widget h3',
    ),       
    array(
        'id_option' => 'font_name_testimonial',
        'css_role' => '.testimonial .testimonial-name a.name, .testimonial-name span.name, #primary .testimonials-slider ul li a',
    ),
    array(
        'id_option' => 'font_holiday_text',
        'css_role' => '#vacation, #vacation p, #vacation li, #vacation p a',
        'important' => true
    ),
    array(
        'id_option' => 'font_title_popup_text',
        'css_role' => 'div.popup .title',
        'important' => true
    ),
    array(
        'id_option' => 'font_content_popup_text',
        'css_role' => 'div.popup, div.popup_message, div.popup_message p, div.popup_message span',
        'important' => true
    ),
    array(
        'id_option' => 'font_special_font',
        'css_role' => '.special-font, .call-to-action-two .special-font, .call-to-action-two .special-font span',
        'important' => true
    ),
);

// array of all fonts size customizable by user
$yiw_sizes = array(
    'general' => array(    
        'name-section' => __( 'Font-sizes', 'yiw' ),  
        'options' => array(
        
            'logo-size' => array(
                'default' => 40,
                'css_role' => '#logo a.logo-text',
                'css_attr' => 'font-size',
                'panel_title' => __( "Logo", 'yiw' ),
                'panel_desc' => __( "Size of the logo text. Not working if you are using a custom image.", 'yiw' )
            ),
    
            'nav-size' => array(    
                'default' => 11,     
                'css_role' => '#nav > ul > li > a, #nav .menu > ul > li > a',    
                'css_attr' => 'font-size',
                'panel_title' => __( "Navigation text", 'yiw' ),   
                'panel_desc' => __( "Size of the navigation items.", 'yiw' ) 
            ),
            
            'subnav-size' => array(    
                'default' => 11,     
                'css_role' => '#nav ul.sub-menu li a, #nav ul.children li a',    
                'css_attr' => 'font-size',
                'panel_title' => __( "Sub navigation text", 'yiw' ),   
                'panel_desc' => __( "Size of the sub navigation items.", 'yiw' ) 
            ),
    
            'text-size' => array(    
                'default' => 12,     
                'css_role' => '#primary p, #sidebar .recent-post a.title, .slider-minilayers-static p, .home_items, #primary li, .testimonial-widget blockquote p, #sidebar .icon-text p, .features-tab-content p, .products li .price, .products.ribbon li .below-thumb, .contact-form span.label address, dd, blockquote',   
                'css_attr' => 'font-size',
                'panel_title' => __( "General text", 'yiw' ),   
                'panel_desc' => __( "Size of the general text paragraphs.", 'yiw' ) 
            ),
    
            'h1-size' => array(    
                'default' => 18,     
                'css_role' => 'h1',   
                'css_attr' => 'font-size',
                'panel_title' => __( "H1 headline", 'yiw' ),   
                'panel_desc' => __( "Size of the H1 elements.", 'yiw' ) 
            ),
    
            'h2-size' => array(    
                'default' => 16,     
                'css_role' => 'h2, h2 a',   
                'css_attr' => 'font-size',
                'panel_title' => __( "H2 headline", 'yiw' ),   
                'panel_desc' => __( "Size of the H2 elements.", 'yiw' ) 
            ),   
    
            'h3-size' => array(    
                'default' => 14,     
                'css_role' => 'h3',   
                'css_attr' => 'font-size',
                'panel_title' => __( "H3 headline", 'yiw' ),   
                'panel_desc' => __( "Size of the H3 elements.", 'yiw' ) 
            ),    
    
            'h4-size' => array(    
                'default' => 13,     
                'css_role' => 'h4',   
                'css_attr' => 'font-size',
                'panel_title' => __( "H4 headline", 'yiw' ),   
                'panel_desc' => __( "Size of the H4 elements.", 'yiw' ) 
            ),    
    
            'h5-size' => array(    
                'default' => 12,     
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
            
            'slogan-size' => array(    
                'default' => 28,     
                'css_role' => '#slogan h2',   
                'css_attr' => 'font-size',
                'panel_title' => __( "Slogan", 'yiw' ),   
                'panel_desc' => __( "Size of the Slogan elements.", 'yiw' ) 
            ),
        
            'subslogan-size' => array(    
                'default' => 26,     
                'css_role' => '#slogan h3',   
                'css_attr' => 'font-size',
                'panel_title' => __( "Sub Slogan", 'yiw' ),   
                'panel_desc' => __( "Size of the Sub Slogan elements.", 'yiw' ) 
            ),  
            
            'blog-title' => array(    
                'default' => 22,     
                'css_role' => '.hentry h1.post-title, .hentry h2.post-title',   
                'css_attr' => 'font-size',
                'panel_title' => __( "Blog title", 'yiw' ),   
                'panel_desc' => __( "Size of the blog title.", 'yiw' ) 
            ),

            'meta-size' => array(
                'default' => 12,
                'css_role' => '.hentry .meta .author, .hentry .meta .date, .hentry .meta .categories, .hentry .comments, .hentry .meta .author span, .hentry .meta .date span, .hentry .meta .categories span, .hentry .comments span, .hentry .meta .author a, .hentry .meta .date a, .hentry .meta .categories a, .hentry .comments a, .hentry .blog-elegant-socials p, .hentry .socials',
                'css_attr' => 'font-size',
                'important' => true,
                'panel_title' => __( "Blog meta", 'yiw' ),
                'panel_desc' => __( "Size of the meta text.", 'yiw' )
            ),

            'popup_title-size' => array(
                'default' => 20,
                'css_role' => 'font_title_popup_text',
                'css_attr' => 'font-size',
                'important' => true,
                'panel_title' => __( "Popup title text", 'yiw' ),
                'panel_desc' => __( "Size of the popup title.", 'yiw' )
            ),

            'popup_content-size' => array(
                'default' => 12,
                'css_role' => 'div.popup, div.popup_message, div.popup_message p, div.popup_message span',
                'css_attr' => 'font-size',
                'important' => true,
                'panel_title' => __( "Popup content text", 'yiw' ),
                'panel_desc' => __( "Size of the popup content.", 'yiw' )
            ),
        
        ),
        
    ),
); 
?>
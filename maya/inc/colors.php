<?php          
/**
 * Configuration of all colors customizable. Follow the default scheme already written.
 * Replace all string uppercased.
 * 
 * This add automatically the options on Theme Options and generate the custom css
 * with all colors set by user, including it on theme.    
 * 
 * @package WordPress
 * @subpackage Kassyopea
 * @since 1.0 
 */   

//array of all colors customizable by user
$yiw_colors = array(
    'topbar' => array(    // replace ID-SECTION with the id of the section (don't use space, only "-" for the space)
        'name-section' => __( 'Topbar', 'yiw' ),   // replace TITLE OF SECTION with the title of the section
        'options' => array(
    
            'topbar-bg' => array(    // replace ID-OPTION with the id of this option (don't use space, only "-" for the space) 
                'default'     => '#333333',   // the default color, selected if the user doesn't set any color
                'css_role'    => '#top',       // the roles of this color option, used when generating the css style
                'css_attr'    => 'background-color',   // the attribute used for the role
                'panel_title' => __( "Background", 'yiw' ),   // the title of option for Theme Options
                'panel_desc'  => __( "Select the background color of the topbar. (default #333333)", 'yiw' )  // the description of option for Theme Options
            ),
    
            'topbar-text' => array(    // replace ID-OPTION with the id of this option (don't use space, only "-" for the space) 
                'default'     => '#CCCACA',   // the default color, selected if the user doesn't set any color
                'css_role'    => '#top p, #top li',       // the roles of this color option, used when generating the css style
                'css_attr'    => 'color',   // the attribute used for the role
                'panel_title' => __( "Text color", 'yiw' ),   // the title of option for Theme Options
                'panel_desc'  => __( "Select the text color of the topbar. (default #CCCACA)", 'yiw' ),  // the description of option for Theme Options
                'important' => true
            ),
    
            'topbar-links' => array(    // replace ID-OPTION with the id of this option (don't use space, only "-" for the space) 
                'default'     => '#ffffff',   // the default color, selected if the user doesn't set any color
                'css_role'    => '#top a',       // the roles of this color option, used when generating the css style
                'css_attr'    => 'color',   // the attribute used for the role
                'panel_title' => __( "Links color", 'yiw' ),   // the title of option for Theme Options
                'panel_desc'  => __( "Select the links color of the topbar. (default #ffffff)", 'yiw' ),  // the description of option for Theme Options
                'important' => true 
            ),
    
            'topbar-links-hover' => array(    // replace ID-OPTION with the id of this option (don't use space, only "-" for the space) 
                'default'     => '#ffffff',   // the default color, selected if the user doesn't set any color
                'css_role'    => '#top a:hover',       // the roles of this color option, used when generating the css style
                'css_attr'    => 'color',   // the attribute used for the role
                'panel_title' => __( "Links color (hover)", 'yiw' ),   // the title of option for Theme Options
                'panel_desc'  => __( "Select the links color of the topbar, in hover state. (default #ffffff)", 'yiw' ),  // the description of option for Theme Options
                'important' => true
            ),
            
            'topbar-submenu-bg' => array(    // replace ID-OPTION with the id of this option (don't use space, only "-" for the space) 
                'default'     => '#000000',   // the default color, selected if the user doesn't set any color
                'css_role'    => '.topbar-right .topbar-level-1 > li > ul',       // the roles of this color option, used when generating the css style
                'css_attr'    => 'background-color',   // the attribute used for the role
                'panel_title' => __( "Submenu background", 'yiw' ),   // the title of option for Theme Options
                'panel_desc'  => __( "Select the submenu background color. (default #000000)", 'yiw' ),  // the description of option for Theme Options
                'important' => true
            ),
            
            'topbar-submenu-bg-hover' => array(    // replace ID-OPTION with the id of this option (don't use space, only "-" for the space) 
                'default'     => '#0f0f0f',   // the default color, selected if the user doesn't set any color
                'css_role'    => '.topbar-right .topbar-level-1 > li > ul li:hover',       // the roles of this color option, used when generating the css style
                'css_attr'    => 'background-color',   // the attribute used for the role
                'panel_title' => __( "Submenu background (hover state)", 'yiw' ),   // the title of option for Theme Options
                'panel_desc'  => __( "Select the submenu background color. (default #0f0f0f)", 'yiw' ),  // the description of option for Theme Options
                'important' => true
            ),
            
            'topbar-submenu-links' => array(    // replace ID-OPTION with the id of this option (don't use space, only "-" for the space) 
                'default'     => '#bcbcbc',   // the default color, selected if the user doesn't set any color
                'css_role'    => '.topbar-right .topbar-level-1 > li > ul li a',       // the roles of this color option, used when generating the css style
                'css_attr'    => 'color',   // the attribute used for the role
                'panel_title' => __( "Submenu background", 'yiw' ),   // the title of option for Theme Options
                'panel_desc'  => __( "Select the submenu item links color. (default #bcbcbc)", 'yiw' ),  // the description of option for Theme Options
                'important' => true
            ),
            
            'topbar-submenu-links-hover' => array(    // replace ID-OPTION with the id of this option (don't use space, only "-" for the space) 
                'default'     => '#ffffff',   // the default color, selected if the user doesn't set any color
                'css_role'    => '.topbar-right .topbar-level-1 > li > ul li a:hover',       // the roles of this color option, used when generating the css style
                'css_attr'    => 'color',   // the attribute used for the role
                'panel_title' => __( "Submenu background", 'yiw' ),   // the title of option for Theme Options
                'panel_desc'  => __( "Select the submenu item links color. (default #ffffff)", 'yiw' ),  // the description of option for Theme Options
                'important' => true
            ),
            
            'in-vacation-bg' => array(    // replace ID-OPTION with the id of this option (don't use space, only "-" for the space) 
                'default'     => '#ff0000',   // the default color, selected if the user doesn't set any color
                'css_role'    => '#vacation',       // the roles of this color option, used when generating the css style
                'css_attr'    => 'background-color',   // the attribute used for the role
                'panel_title' => __( "Background Holiday box", 'yiw' ),   // the title of option for Theme Options
                'panel_desc'  => __( "Select the background color of the holiday box. (default #ff0000)", 'yiw' )  // the description of option for Theme Options
            ),
            
            'in-vacation-text' => array(    // replace ID-OPTION with the id of this option (don't use space, only "-" for the space) 
                'default'     => '#ffffff',   // the default color, selected if the user doesn't set any color
                'css_role'    => '#vacation p, #vacation li',       // the roles of this color option, used when generating the css style
                'important'   => true,
                'css_attr'    => 'color',   // the attribute used for the role
                'panel_title' => __( "Background Holiday text", 'yiw' ),   // the title of option for Theme Options
                'panel_desc'  => __( "Select the color of the holiday text. (default #ffffff)", 'yiw' )  // the description of option for Theme Options
            ),
        
        ),
    ),
    
    'quick-car' => array(    // replace ID-SECTION with the id of the section (don't use space, only "-" for the space)
        'name-section' => __( 'Ribbon Cart Hover', 'yiw' ),   // replace TITLE OF SECTION with the title of the section
        'options' => array(
    
            'quick-car-bg' => array(    // replace ID-OPTION with the id of this option (don't use space, only "-" for the space) 
                'default'     => '#3F3E3C',   // the default color, selected if the user doesn't set any color
                'css_role'    => '#cart .quick-cart',       // the roles of this color option, used when generating the css style
                'css_attr'    => 'background-color',   // the attribute used for the role
                'panel_title' => __( "Background", 'yiw' ),   // the title of option for Theme Options
                'panel_desc'  => __( "Select the background color of the quick car shown on hover. (default #3F3E3C)", 'yiw' )  // the description of option for Theme Options
            ),
    
            'topbar-text-products' => array(    // replace ID-OPTION with the id of this option (don't use space, only "-" for the space) 
                'default'     => '#c7c6c6',   // the default color, selected if the user doesn't set any color
                'css_role'    => '#cart .quick-cart li a, #cart .quick-cart li .price',       // the roles of this color option, used when generating the css style
                'css_attr'    => 'color',   // the attribute used for the role
                'panel_title' => __( "Text color list products", 'yiw' ),   // the title of option for Theme Options
                'panel_desc'  => __( "Select the text color of the quick car shown on hover. (default #c7c6c6)", 'yiw' ),  // the description of option for Theme Options
                'important' => true
            ),
    
            'topbar-text-products-hover' => array(    // replace ID-OPTION with the id of this option (don't use space, only "-" for the space) 
                'default'     => '#fff',   // the default color, selected if the user doesn't set any color
                'css_role'    => '#cart .quick-cart li:hover a, #cart .quick-cart li:hover .price',       // the roles of this color option, used when generating the css style
                'css_attr'    => 'color',   // the attribute used for the role
                'panel_title' => __( "Text color list products (hover)", 'yiw' ),   // the title of option for Theme Options
                'panel_desc'  => __( "Select the text color of the quick car shown on hover. (default #fff)", 'yiw' ),  // the description of option for Theme Options
                'important' => true
            ),
    
            'topbar-text-totals' => array(    // replace ID-OPTION with the id of this option (don't use space, only "-" for the space) 
                'default'     => '#fff',   // the default color, selected if the user doesn't set any color
                'css_role'    => '#cart .quick-cart li.empty, #cart .quick-cart li.totals, #cart .quick-cart li.totals .price',       // the roles of this color option, used when generating the css style
                'css_attr'    => 'color',   // the attribute used for the role
                'panel_title' => __( "Text color totals", 'yiw' ),   // the title of option for Theme Options
                'panel_desc'  => __( "Select the text color of the quick car shown on hover. (default #fff)", 'yiw' ),  // the description of option for Theme Options
                'important' => true
            ),
    
            'topbar-view-cart-bg' => array(    // replace ID-OPTION with the id of this option (don't use space, only "-" for the space) 
                'default'     => '#1e1c1c',   // the default color, selected if the user doesn't set any color
                'css_role'    => '#cart .quick-cart li.view-cart-button',       // the roles of this color option, used when generating the css style
                'css_attr'    => 'background-color',   // the attribute used for the role
                'panel_title' => __( "View cart button background", 'yiw' ),   // the title of option for Theme Options
                'panel_desc'  => __( "Select the background color of 'View Cart'. (default #1e1c1c)", 'yiw' ),  // the description of option for Theme Options
                'important' => true
            ),
    
            'topbar-view-cart-text' => array(    // replace ID-OPTION with the id of this option (don't use space, only "-" for the space) 
                'default'     => '#fff',   // the default color, selected if the user doesn't set any color
                'css_role'    => '#cart .quick-cart a.view-cart-button',       // the roles of this color option, used when generating the css style
                'css_attr'    => 'color',   // the attribute used for the role
                'panel_title' => __( "View cart button text", 'yiw' ),   // the title of option for Theme Options
                'panel_desc'  => __( "Select the text color of 'View Cart'. (default #fff)", 'yiw' ),  // the description of option for Theme Options
                'important' => true
            ),    
    
            'topbar-view-cart-border' => array(    // replace ID-OPTION with the id of this option (don't use space, only "-" for the space) 
                'default'     => '#4e4a4a',   // the default color, selected if the user doesn't set any color
                'css_role'    => '#cart .quick-cart li.view-cart-button',       // the roles of this color option, used when generating the css style
                'css_attr'    => 'border-color',   // the attribute used for the role
                'panel_title' => __( "View cart button border color", 'yiw' ),   // the title of option for Theme Options
                'panel_desc'  => __( "Select the border color of 'View Cart'. (default #4e4a4a)", 'yiw' ),  // the description of option for Theme Options
                'important' => true
            ),
    
            'topbar-view-cart-bg-hover' => array(    // replace ID-OPTION with the id of this option (don't use space, only "-" for the space) 
                'default'     => '#383434',   // the default color, selected if the user doesn't set any color
                'css_role'    => '#cart .quick-cart li.view-cart-button:hover',       // the roles of this color option, used when generating the css style
                'css_attr'    => 'background-color',   // the attribute used for the role
                'panel_title' => __( "View cart button background (hover)", 'yiw' ),   // the title of option for Theme Options
                'panel_desc'  => __( "Select the background color of 'View Cart'. (default #383434)", 'yiw' ),  // the description of option for Theme Options
                'important' => true
            ),
    
            'topbar-view-cart-text-hover' => array(    // replace ID-OPTION with the id of this option (don't use space, only "-" for the space) 
                'default'     => '#fff',   // the default color, selected if the user doesn't set any color
                'css_role'    => '#cart .quick-cart a.view-cart-button:hover',       // the roles of this color option, used when generating the css style
                'css_attr'    => 'color',   // the attribute used for the role
                'panel_title' => __( "View cart button text (hover)", 'yiw' ),   // the title of option for Theme Options
                'panel_desc'  => __( "Select the text color of 'View Cart'. (default #fff)", 'yiw' ),  // the description of option for Theme Options
                'important' => true
            ),    
    
            'topbar-view-cart-border-hover' => array(    // replace ID-OPTION with the id of this option (don't use space, only "-" for the space) 
                'default'     => '#4e4a4a',   // the default color, selected if the user doesn't set any color
                'css_role'    => '#cart .quick-cart li.view-cart-button:hover',       // the roles of this color option, used when generating the css style
                'css_attr'    => 'border-color',   // the attribute used for the role
                'panel_title' => __( "View cart button border color (hover)", 'yiw' ),   // the title of option for Theme Options
                'panel_desc'  => __( "Select the border color of 'View Cart'. (default #4e4a4a)", 'yiw' ),  // the description of option for Theme Options
                'important' => true
            ),
        
        ),
    ),
    
    'logo' => array(    // replace ID-SECTION with the id of the section (don't use space, only "-" for the space)
        'name-section' => __( 'Logo', 'yiw' ),   // replace TITLE OF SECTION with the title of the section
        'options' => array(
    
            'logo-color' => array(    // replace ID-OPTION with the id of this option (don't use space, only "-" for the space) 
                'default'     => '#1e1e1e',   // the default color, selected if the user doesn't set any color
                'css_role'    => '#logo a.logo-text',       // the roles of this color option, used when generating the css style
                'css_attr'    => 'color',   // the attribute used for the role
                'panel_title' => __( "Logo color", 'yiw' ),   // the title of option for Theme Options
                'panel_desc'  => __( "Select the color of the logo. (default #1e1e1e)", 'yiw' )  // the description of option for Theme Options
            ),

            'logo-description-color' => array(
                'default' => '#545252',
                'css_role' => '#logo p',
                'css_attr' => 'color',
                'panel_title' => __( "Logo description", 'yiw' ),
                'panel_desc' => __( "Select the color of the description below the logo. (default #545252)", 'yiw' )
            ),          
        
        ),
    ),
    
    'nav' => array(    // replace ID-SECTION with the id of the section (don't use space, only "-" for the space)
        'name-section' => __( 'Main Menu', 'yiw' ),   // replace TITLE OF SECTION with the title of the section
        'options' => array(
        
            'nav-background' => array(    // replace ID-OPTION with the id of this option (don't use space, only "-" for the space) 
                'default'     => '#FFFFFF',   // the default color, selected if the user doesn't set any color
                'css_role'    => '#nav',       // the roles of this color option, used when generating the css style
                'css_attr'    => 'background-color',   // the attribute used for the role
                'panel_title' => __( "Backround color", 'yiw' ),   // the title of option for Theme Options
                'panel_desc'  => __( "Select the background color of the main menu. (default #FFFFFF)", 'yiw' )  // the description of option for Theme Options
            ),
    
            'nav-color' => array(    // replace ID-OPTION with the id of this option (don't use space, only "-" for the space) 
                'default'     => '#6C6C6C',   // the default color, selected if the user doesn't set any color
                'css_role'    => '#nav ul li a',       // the roles of this color option, used when generating the css style
                'css_attr'    => 'color',   // the attribute used for the role
                'panel_title' => __( "List Items color", 'yiw' ),   // the title of option for Theme Options
                'panel_desc'  => __( "Select the color of each item in main menu. (default #6C6C6C)", 'yiw' )  // the description of option for Theme Options
            ),

            'nav-color-hover' => array(
                'default' => '#da7906',
                'css_role' => '#nav ul li a:hover, #nav ul.sub-menu li a:hover, #nav ul.children a:hover',
                'css_attr' => 'color',
                'panel_title' => __( "List Items color (hover effect)", 'yiw' ),
                'panel_desc' => __( "Select the color of each item in main menu when the hover event is triggered. (default #da7906)", 'yiw' )
            ),     

            'nav-color-active' => array(
                'default' => '#da7906',
                'css_role' => '#nav .current-menu-item > a, #nav .current-menu-ancestor > a, div#nav .current_page_item > a, div#nav .current_page_parent > a',
                'css_attr' => 'color',
                'important' => true,
                'panel_title' => __( "List Items color (active effect)", 'yiw' ),
                'panel_desc' => __( "Select the color of each item in main menu when the item is active. (default #da7906)", 'yiw' )
            ),
            
            'subnav-bg-color' => array(    // replace ID-OPTION with the id of this option (don't use space, only "-" for the space) 
                'default'     => '#fff',   // the default color, selected if the user doesn't set any color
                'css_role'    => '#nav ul.sub-menu, #nav ul.children',       // the roles of this color option, used when generating the css style
                'css_attr'    => 'background-color',   // the attribute used for the role
                'panel_title' => __( "Submenu background color", 'yiw' ),   // the title of option for Theme Options
                'panel_desc'  => __( "Select the background color the submenu. (default #ffffff)", 'yiw' )  // the description of option for Theme Options
            ),
            
            'subnav-border-color' => array(
                'default' => '#CFCFCF',
                'css_role' => '#nav ul.sub-menu li, #nav ul.children li',
                'css_attr' => 'border-top-color',
                'panel_title' => __( "Submenu border color", 'yiw' ),
                'panel_desc' => __( "Select the border color of the submenu. (default #CFCFCF)", 'yiw' )
            ),
            
            'subnav-color' => array(    // replace ID-OPTION with the id of this option (don't use space, only "-" for the space) 
                'default'     => '#6C6C6C',   // the default color, selected if the user doesn't set any color
                'css_role'    => '#nav ul.sub-menu li a, #nav ul.children li a',       // the roles of this color option, used when generating the css style
                'css_attr'    => 'color',   // the attribute used for the role
                'panel_title' => __( "Submenu list items color", 'yiw' ),   // the title of option for Theme Options
                'panel_desc'  => __( "Select the color of each item in submenu. (default #6C6C6C)", 'yiw' )  // the description of option for Theme Options
            ),

            'subnav-color-hover' => array(
                'default' => '#da7906',
                'css_role' => '#nav ul.sub-menu li a:hover, #nav ul.children li a:hover',
                'css_attr' => 'color',
                'panel_title' => __( "Submenu list items color (hover effect)", 'yiw' ),
                'panel_desc' => __( "Select the color of each item in submenu when the hover event is triggered. (default #da7906)", 'yiw' )
            ),
        ),
    ),
    
    'headings' => array(
        'name-section' => __( 'Headings', 'yiw' ),  
        'options' => array(
    
            'h1' => array( 
                'default'     => '#030303', 
                'css_role'    => 'h1', 
                'css_attr'    => 'color', 
                'panel_title' => __( "Heading 1", 'yiw' ), 
                'panel_desc'  => __( "Select the color for Heading 1 items. (default #030303)", 'yiw' ) 
            ),         

            'h2' => array( 
                'default'     => '#030303', 
                'css_role'    => 'h2, h2.post-title', 
                'css_attr'    => 'color', 
                'panel_title' => __( "Heading 2", 'yiw' ), 
                'panel_desc'  => __( "Select the color for Heading 2 items. (default #030303)", 'yiw' ) 
            ),         

            'h3' => array( 
                'default'     => '#030303', 
                'css_role'    => 'h3, .home_item h4 a, .home_item h4', 
                'css_attr'    => 'color', 
                'panel_title' => __( "Heading 3", 'yiw' ), 
                'panel_desc'  => __( "Select the color for Heading 3 items. (default #030303)", 'yiw' ) 
            ),         

            'h4' => array( 
                'default'     => '#030303', 
                'css_role'    => 'h4', 
                'css_attr'    => 'color', 
                'panel_title' => __( "Heading 4", 'yiw' ), 
                'panel_desc'  => __( "Select the color for Heading 4 items. (default #030303)", 'yiw' ) 
            ),         

            'h5' => array( 
                'default'     => '#030303', 
                'css_role'    => 'h5', 
                'css_attr'    => 'color', 
                'panel_title' => __( "Heading 5", 'yiw' ), 
                'panel_desc'  => __( "Select the color for Heading 5 items. (default #030303)", 'yiw' ) 
            ),         

            'h6' => array( 
                'default'     => '#030303', 
                'css_role'    => 'h6', 
                'css_attr'    => 'color', 
                'panel_title' => __( "Heading 6", 'yiw' ), 
                'panel_desc'  => __( "Select the color for Heading 6 items. (default #030303)", 'yiw' ) 
            ),
            
            'h-highlightes' => array( 
                'default'     => '#A05F02', 
                'css_role'    => 'h1 span, h2 span, h3 span, h4 span, h5 span, h6 span', 
                'css_attr'    => 'color', 
                'panel_title' => __( "Heading highlightes", 'yiw' ), 
                'panel_desc'  => __( "Select the color for titles highlightes. (default #A05F02)", 'yiw' ) 
            ),
            
            'sidebar-titles' => array(
                'default'     => '#030303', 
                'css_role'    => '#sidebar .widget h2, #sidebar .widget h3, #wp-calendar caption',
                'css_attr'    => 'color', 
                'panel_title' => __( "Sidebar titles", 'yiw' ),
                'panel_desc'  => __( "Select the color for titles in sidebar section. (default #030303)", 'yiw' )
            ),

            'footer-titles' => array(
                'default'     => '#030303',
                'css_role'    => '#footer .widget h2, #footer .widget h3',
                'css_attr'    => 'color',
                'panel_title' => __( "Footer titles", 'yiw' ),
                'panel_desc'  => __( "Select the color for titles in footer section. (default #030303)", 'yiw' )
            ),
        ),
    ),
    
    
    'slogan' => array(
        'name-section' => __( 'Slogan', 'yiw' ),  
        'options' => array(
    
            'slogan' => array( 
                'default'     => '#030303', 
                'css_role'    => '#slogan h2', 
                'css_attr'    => 'color', 
                'panel_title' => __( "Slogan", 'yiw' ), 
                'panel_desc'  => __( "Select the color for slogan. (default #030303)", 'yiw' ) 
            ),         

            'subslogan' => array( 
                'default'     => '#c86f06', 
                'css_role'    => '#slogan h3', 
                'css_attr'    => 'color', 
                'panel_title' => __( "Subslogan", 'yiw' ), 
                'panel_desc'  => __( "Select the color for title below the main slogan. (default #c86f06)", 'yiw' ) 
            ),
        ),
    ),


    'paragraphs' => array(
        'name-section' => __( 'Paragraphs and links', 'yiw' ),  
        'options' => array(
    
            'p' => array( 
                'default'     => '#545252', 
                'css_role'    => 'body, p, li, address, dd, blockquote, #content .contact-form label, #content .contact-form input, #content .contact-form textarea, .gallery-filters ul.filters li a', 
                'css_attr'    => 'color', 
                'panel_title' => __( "Paragraphs", 'yiw' ), 
                'panel_desc'  => __( "Select the color for paragraphs. (default #545252)", 'yiw' ) 
            ),         

            'a' => array( 
                'default'     => '#AB5705', 
                'css_role'    => 'a, #footer a, #footer .widget a, #copyright a, .testimonial-widget a.url-testimonial, .testimonial-widget a.name-testimonial:hover, #sidebar .recent-post a.title, #sidebar .recent-comments a.title, #sidebar .recent-comments a.goto, #sidebar .recent-comments .author a, .gallery-filters ul.filters li a:hover, .gallery-filters ul.filters li.selected a', 
                'css_attr'    => 'color', 
                'panel_title' => __( "Links", 'yiw' ), 
                'panel_desc'  => __( "Select the color for links. (default #AB5705)", 'yiw' ) 
            ),         

            'a_hover' => array( 
                'default'     => '#1f1f1f',
                'css_role'    => 'a:hover, #footer a:hover, #footer .widget a:hover, #copyright a:hover, .testimonial-widget a.name-testimonial, .testimonial-widget a.url-testimonial:hover, .sheeva-widget-content .sheeva-lastpost h3, #sidebar .recent-post a.title:hover, #sidebar .recent-comments a.title:hover, #sidebar .recent-comments a.goto:hover, #sidebar .recent-comments .author a:hover', 
                'css_attr'    => 'color', 
                'panel_title' => __( "Links (hover effect)", 'yiw' ), 
                'panel_desc'  => __( "Select the color for links (hover effect). (default #1f1f1f)", 'yiw' ) 
            ),     

            'sidebar_a' => array( 
                'default'     => '#1f1f1f', 
                'css_role'    => '#sidebar a, #sidebar div a, #sidebar ul li a, #sidebar p a, #sidebar .widget a, #sidebar div ul li a',
                'css_attr'    => 'color',
                'important'   => true,
                'panel_title' => __( "Sidebar Links", 'yiw' ), 
                'panel_desc'  => __( "Select the color for links in the sidebar. (default #1f1f1f)", 'yiw' ) 
            ),         

            'sidebar_a_hover' => array( 
                'default'     => '#AB5705',
                'css_role'    => '#sidebar a:hover, #sidebar div a:hover, #sidebar ul li a:hover, #sidebar p a:hover, #sidebar .widget a:hover, #sidebar div ul li a:hover',
                'css_attr'    => 'color',
                'important'   => true,
                'panel_title' => __( "Sidebar Links (hover effect)", 'yiw' ), 
                'panel_desc'  => __( "Select the color for links in the sidebar (hover effect). (default #AB5705)", 'yiw' ) 
            ),
        ),
    ),      
	
	'store-products' => array(    
		'name-section' => __( 'Store list products', 'yiw' ),   
		'options' => array(
	
			'store-products-offer-text' => array(    
				'default' => '#fff',
				'css_role' => 'span.onsale', 
				'css_attr' => 'color', 
				'panel_title' => __( "On sale text color", 'yiw' ),  
				'panel_desc' => __( 'Select the text color of the "On Sale" baloon.', 'yiw' ) 
			),
	
			'store-products-offer-bg' => array(    
				'default' => '#b9b701',
				'css_role' => 'span.onsale', 
				'css_attr' => 'background-color', 
				'panel_title' => __( "On sale background color", 'yiw' ),  
				'panel_desc' => __( 'Select the background color of the "On Sale" baloon.', 'yiw' ) 
			),                 
	
			'store-products-label-products-bg' => array(    
				'default' => '#000',
				'css_role' => '.products li a strong',
                'important'   => true,
				'css_attr' => 'background-color', 
				'panel_title' => __( "Label products item background", 'yiw' ),  
				'panel_desc' => __( 'The background color of the label inside the thumbnails of products.', 'yiw' ) 
			),             
	
			'store-products-label-products-text' => array(    
				'default' => '#fff',
				'css_role' => '.shop-ribbon .products li .below-thumb, .products li a strong.below-thumb, .products.ribbon .below-thumb', 
				'css_attr' => 'color', 
                'important' => true,
				'panel_title' => __( "Label products item text", 'yiw' ),  
				'panel_desc' => __( 'The text color of the label inside the thumbnails of products.', 'yiw' ) 
			),
            
            'store-products-label-products-text-hover' => array(    
				'default' => '#000',
				'css_role' => '.shop-ribbon .products li:hover .below-thumb, .products li:hover a strong.below-thumb, .products.ribbon .below-thumb:hover', 
				'css_attr' => 'color', 
                'important' => true,
				'panel_title' => __( "Label products item text (hover)", 'yiw' ),  
				'panel_desc' => __( 'The text color of the label inside the thumbnails of products (hover).', 'yiw' ) 
			),
	
			'store-products-button-add-to-cart-bg' => array(    
				'default' => '#6B90A9',
				'css_role' => '.products li .buttons a.add-to-cart', 
				'css_attr' => 'background-color', 
				'panel_title' => __( "Button add to cart background", 'yiw' ),  
				'panel_desc' => __( 'The button for purchase on list products.', 'yiw' ) 
			),       
	
			'store-products-button-details-bg' => array(    
				'default' => '#535353',
				'css_role' => '.products li .buttons a.details', 
				'css_attr' => 'background-color', 
				'panel_title' => __( "Button details background", 'yiw' ),  
				'panel_desc' => __( 'The button for product details on list products.', 'yiw' ) 
			),     
	
			'store-products-button-add-to-cart-text' => array(    
				'default' => '#fff',
				'css_role' => '.products li .buttons a.add-to-cart', 
				'css_attr' => 'color', 
				'panel_title' => __( "Button add to cart text color", 'yiw' ),  
				'panel_desc' => __( 'The button for purchase on list products.', 'yiw' ) 
			),       
	
			'store-products-button-details-text' => array(    
				'default' => '#fff',
				'css_role' => '.products li .buttons a.details', 
				'css_attr' => 'color', 
				'panel_title' => __( "Button details text color", 'yiw' ),  
				'panel_desc' => __( 'The button for product details on list products.', 'yiw' ) 
			),              
	
			'store-products-button-add-to-cart-bg-hover' => array(    
				'default' => '#7aa5c2',
				'css_role' => '.products li .buttons a.add-to-cart:hover', 
				'css_attr' => 'background-color',
                'important' => true,
				'panel_title' => __( "Button add to cart background hover", 'yiw' ),  
				'panel_desc' => __( 'The button for purchase on list products.', 'yiw' ) 
			),       
	
			'store-products-button-details-bg-hover' => array(    
				'default' => '#6b6b6b',
				'css_role' => '.products li .buttons a.details:hover', 
				'css_attr' => 'background-color', 
				'panel_title' => __( "Button details background hover", 'yiw' ),  
				'panel_desc' => __( 'The button for product details on list products.', 'yiw' ) 
			),     
	
			'store-products-button-add-to-cart-text-hover' => array(    
				'default' => '#fff',
				'css_role' => '.products li .buttons a.add-to-cart:hover', 
				'css_attr' => 'color',
                'important' => true,
				'panel_title' => __( "Button add to cart text color hover", 'yiw' ),  
				'panel_desc' => __( 'The button for purchase on list products.', 'yiw' ) 
			),       
	
			'store-products-button-details-text-hover' => array(    
				'default' => '#fff',
				'css_role' => '.products li .buttons a.details:hover', 
				'css_attr' => 'color', 
				'panel_title' => __( "Button details text color hover", 'yiw' ),  
				'panel_desc' => __( 'The button for product details on list products.', 'yiw' ) 
			),     
		
		),
		
	),
	
	'store-buttons' => array(    
		'name-section' => __( 'Store general buttons', 'yiw' ),   
		'options' => array( 
	
			'store-buttons-bg' => array(    
				'default' => '#f5f5f5',
				'css_role' => 'a.button, button.button, input.button, #review_form #submit', 
				'css_attr' => 'background-color', 
				'panel_title' => __( "General button background", 'yiw' ),  
				'panel_desc' => __( 'Select the background color of buttons.', 'yiw' ),
                'important' => true   
			),  
	
			'store-buttons-color' => array(    
				'default' => '#676767',
				'css_role' => 'a.button, button.button, input.button, #review_form #submit', 
				'css_attr' => 'color', 
				'panel_title' => __( "General button text color", 'yiw' ),  
				'panel_desc' => __( 'Select the text color of buttons.', 'yiw' ),
                'important' => true   
			),  
	
			'store-buttons-border' => array(    
				'default' => '#969696',
				'css_role' => 'a.button, button.button, input.button, #review_form #submit', 
				'css_attr' => 'border-color', 
				'panel_title' => __( "General button border color", 'yiw' ),  
				'panel_desc' => __( 'Select the border color of buttons.', 'yiw' ),
                'important' => true   
			),  
	
			'store-buttons-bg-hover' => array(    
				'default' => '#fafafa',
				'css_role' => 'a.button:hover, button.button:hover, input.button:hover, #review_form #submit:hover', 
				'css_attr' => 'background', 
				'panel_title' => __( "General button background (hover effect)", 'yiw' ),  
				'panel_desc' => __( 'Select the background color of buttons, when the mouse is over.', 'yiw' ),
                'important' => true   
			),  
	
			'store-buttons-color-hover' => array(    
				'default' => '#676767',
				'css_role' => 'a.button:hover, button.button:hover, input.button:hover, #review_form #submit:hover', 
				'css_attr' => 'color', 
				'panel_title' => __( "General button text color (hover effect)", 'yiw' ),  
				'panel_desc' => __( 'Select the text color of buttons, when the mouse is over.', 'yiw' ),
                'important' => true  
			),  
	
			'store-buttons-border-hover' => array(    
				'default' => '#969696',
				'css_role' => 'a.button:hover, button.button:hover, input.button:hover, #review_form #submit:hover', 
				'css_attr' => 'border-color', 
				'panel_title' => __( "General button border color (hover effect)", 'yiw' ),  
				'panel_desc' => __( 'Select the border color of buttons, when the mouse is over.', 'yiw' ),
                'important' => true   
			),  
			
	
			'store-buttons-alt-bg' => array(    
				'default' => '#7FA92D',
				'css_role' => 'a.button-alt, a.button.alt, input.button-alt, button.button.alt, button.button-alt, input.button.alt, #review_form #submit.alt, a.compare.button, #sidebar a.compare.button',
				'css_attr' => 'background-color', 
				'panel_title' => __( "General alternative button background", 'yiw' ),  
				'panel_desc' => __( 'Select the background color of alternative buttons.', 'yiw' ) ,
                'important' => true 
			),  
	
			'store-buttons-alt-color' => array(    
				'default' => '#fff',
				'css_role' => 'a.button-alt, a.button.alt, input.button-alt, button.button.alt, button.button-alt, input.button.alt, #review_form #submit.alt, a.compare.button, #sidebar a.compare.button',
				'css_attr' => 'color', 
				'panel_title' => __( "General alternative button text color", 'yiw' ),  
				'panel_desc' => __( 'Select the text color of alternative buttons.', 'yiw' ),
                'important' => true  
			),  
	
			'store-buttons-alt-border' => array(    
				'default' => '#7FA92D',
				'css_role' => 'a.button-alt, a.button.alt, input.button-alt, button.button.alt, button.button-alt, input.button.alt, #review_form #submit.alt, a.compare.button, #sidebar a.compare.button',
				'css_attr' => 'border-color', 
				'panel_title' => __( "General alternative button border color", 'yiw' ),  
				'panel_desc' => __( 'Select the border color of alternative buttons.', 'yiw' ),
                'important' => true  
			),  
	
			'store-buttons-alt-bg-hover' => array(    
				'default' => '#8ab830',
				'css_role' => 'a.button-alt:hover, a.button.alt:hover, input.button-alt:hover, button.button.alt:hover, button.button-alt:hover, input.button.alt:hover, #review_form #submit.alt:hover, a.compare.button:hover, #sidebar a.compare.button:hover',
				'css_attr' => 'background-color', 
				'panel_title' => __( "General alternative button background (hover effect)", 'yiw' ),  
				'panel_desc' => __( 'Select the background color of alternative buttons, when the mouse is over.', 'yiw' ),
                'important' => true  
			),  
	
			'store-buttons-alt-color-hover' => array(    
				'default' => '#fff',
				'css_role' => 'a.button-alt:hover, a.button.alt:hover, input.button-alt:hover, button.button.alt:hover, button.button-alt:hover, input.button.alt:hover, #review_form #submit.alt:hover, a.compare.button:hover, #sidebar a.compare.button:hover',
				'css_attr' => 'color', 
				'panel_title' => __( "General alternative button text color (hover effect)", 'yiw' ),  
				'panel_desc' => __( 'Select the text color of alternative buttons, when the mouse is over.', 'yiw' ),
                'important' => true  
			),  
	
			'store-buttons-alt-border-hover' => array(    
				'default' => '#7FA92D',
				'css_role' => 'a.button-alt:hover, a.button.alt:hover, input.button-alt:hover, button.button.alt:hover, button.button-alt:hover, input.button.alt:hover, #review_form #submit.alt:hover, a.compare.button:hover, #sidebar a.compare.button:hover',
				'css_attr' => 'border-color', 
				'panel_title' => __( "General alternative button border color (hover effect)", 'yiw' ),  
				'panel_desc' => __( 'Select the border color of alternative buttons, when the mouse is over.', 'yiw' ),
                'important' => true   
			),  
		
		),
		
	),
	
	'store-single' => array(    
		'name-section' => __( 'Store product detail page', 'yiw' ),   
		'options' => array( 
	
			'store-single-price-card-bg' => array(    
				'default' => '#7FA92D',
				'roles' => array(
                    array(
                        'css_role' => 'div.product p.price', 
				        'css_attr' => 'background-color', 
                    ),
                    array(
                        'css_role' => 'div.product p.price:before', 
				        'css_attr' => 'border-left-color', 
                    ),
                ),
				'panel_title' => __( "Price background color", 'yiw' ),  
				'panel_desc' => __( 'Select the color of background color of the ticket of price, in the layout single product page.', 'yiw' ) 
			),  
	
			'store-single-price-card-text' => array(    
				'default' => '#fff',
				'css_role' => 'div.product p.price', 
				'css_attr' => 'color', 
				'panel_title' => __( "Price text color", 'yiw' ),  
				'panel_desc' => __( 'Select the color of text color of the ticket of price, in the layout single product page.', 'yiw' ) 
			),  
		
		),
		
	),
    
    
    'blog' => array(
        'name-section' => __( 'Blog', 'yiw' ),  
        'options' => array(
    
            'blog-title' => array( 
                'default'     => '#2B2828', 
                'css_role'    => '.hentry h1 a, .hentry h2 a, .blog-big .meta a, .blog-small .meta a', 
                'css_attr'    => 'color', 
                'panel_title' => __( "Blog title", 'yiw' ), 
                'panel_desc'  => __( "Select the color for blog titles. (default #2B2828)", 'yiw' ) 
            ),      
    
            'blog-title-hover' => array( 
                'default'     => '#000000', 
                'css_role'    => '.hentry h1 a:hover, .hentry h2 a:hover, .blog-big .meta a:hover, .blog-small .meta a:hover', 
                'css_attr'    => 'color', 
                'panel_title' => __( "Blog title (hover effect)", 'yiw' ), 
                'panel_desc'  => __( "Select the color for blog titles, on the mouse over. (default #000000)", 'yiw' ) 
            ),         
        ),
    ),
    
    'footer' => array(
        'name-section' => __( 'Footer', 'yiw' ),
        'options' => array(
            'footer-background' => array(
                'default'     => '#fff', //default color, selected if the user doesn't set any color
                'css_role'    => '#footer',
                'css_attr'    => 'background-color',
                'panel_title' => __( 'Footer section background color', 'yiw' ),
                'panel_desc'  => __( 'Select the background color for the footer. (default #fff)', 'yiw' )  
            ),
            
            'footer-inner-background' => array(
                'default'     => '#fff', //default color, selected if the user doesn't set any color
                'css_role'    => '#footer .inner',
                'css_attr'    => 'background-color',
                'panel_title' => __( 'Footer section content background color', 'yiw' ),
                'panel_desc'  => __( 'Select the background color for the footer contents. (default #fff)', 'yiw' )  
            ),
            
            'footer-inner-border' => array(
                'default'     => '#cfcfcf', //default color, selected if the user doesn't set any color
                'css_role'    => '#footer .inner:first-child',
                'css_attr'    => 'border-top-color',
                'panel_title' => __( 'Footer section border top', 'yiw' ),
                'panel_desc'  => __( 'Select the border color for the footer section. (default #cfcfcf)', 'yiw' )  
            ),
	
			'footer-color-text' => array(    
				'default' => '#545252',
				'css_role' => '#footer p, #footer .widget li, #footer .textwidget',
				'css_attr' => 'color', 
				'panel_title' => __( "Color text", 'yiw' ),  
				'panel_desc' => __( "The color of text (default #545252)", 'yiw' ) 
			),
	
			'footer-color-links' => array(    
				'default' => '#9A6614',
				'css_role' => '#footer a', 
				'css_attr' => 'color', 
				'panel_title' => __( "Color links", 'yiw' ),  
				'panel_desc' => __( "The color of all links, of the footer (default #9A6614).", 'yiw' ),
                'important' => true  
			),
	
			'footer-color-links-hover' => array(    
				'default' => '#6c6c6c',
				'css_role' => '#footer a:hover', 
				'css_attr' => 'color', 
				'panel_title' => __( "Color links hover", 'yiw' ),  
				'panel_desc' => __( "The color of all links in hover state, of the footer (default #6c6c6c).", 'yiw' ),
                'important' => true    
			),
	
			'footer-color-menus-links' => array(
				'default' => '#545252',
				'css_role' => '#footer .widget ul li a', 
				'css_attr' => 'color', 
				'panel_title' => __( "Color links menus", 'yiw' ),
				'panel_desc' => __( "The color of links of menus, of the footer (default #545252).", 'yiw' ),
                'important' => true  
			),
	
			'footer-color-menus-links-hover' => array(
				'default' => '#9A6614',
				'css_role' => '#footer .widget ul li a:hover', 
				'css_attr' => 'color', 
				'panel_title' => __( "Color links menus hover", 'yiw' ),
				'panel_desc' => __( "The color of links of menus in hover state, of the footer (default #9A6614).", 'yiw' ),
                'important' => true   
			),     
        
        ),
    ),      
	
	'copyright' => array(    
		'name-section' => __( 'Copyright', 'yiw' ),   
		'options' => array(   
            
            'copyright-background' => array(
                'default'     => '#fff', //default color, selected if the user doesn't set any color
                'css_role'    => '#copyright',
                'css_attr'    => 'background-color',
                'panel_title' => __( 'Copyright section background color', 'yiw' ),
                'panel_desc'  => __( 'Select the background color for the copyright section. (default #fff)', 'yiw' )  
            ),
            
            'copyright-inner-background' => array(
                'default'     => '#fff', //default color, selected if the user doesn't set any color
                'css_role'    => '#copyright .inner',
                'css_attr'    => 'background-color',
                'panel_title' => __( 'Copyright section content background color', 'yiw' ),
                'panel_desc'  => __( 'Select the background color for the copyright section contents. (default #fff)', 'yiw' )  
            ),
            
            'copyright-inner-border' => array(
                'default'     => '#cfcfcf', //default color, selected if the user doesn't set any color
                'css_role'    => '#copyright .inner',
                'css_attr'    => 'border-top-color',
                'panel_title' => __( 'Copyright section border top', 'yiw' ),
                'panel_desc'  => __( 'Select the border color for the copyright section. (default #cfcfcf)', 'yiw' )  
            ),
	
			'copyright-text-color' => array(    
				'default' => '#545252',
				'css_role' => '#copyright p', 
				'css_attr' => 'color', 
				'panel_title' => __( "Text color", 'yiw' ),  
				'panel_desc' => __( "Select the text color of the copyright section.", 'yiw' ) 
			),
	
			'copyright-links-color' => array(    
				'default' => '#9A6614',
				'css_role' => '#copyright a', 
				'css_attr' => 'color', 
				'panel_title' => __( "Links color", 'yiw' ),  
				'panel_desc' => __( "Select the color of the links on the copyright section.", 'yiw' ) 
			),
	
			'copyright-links-color-hover' => array(    
				'default' => '#6c6c6c',
				'css_role' => '#copyright a:hover', 
				'css_attr' => 'color', 
				'panel_title' => __( "Links color hover", 'yiw' ),  
				'panel_desc' => __( "Select the color of the links, in state hover, on the copyright section.", 'yiw' ) 
			),
		
		),
		
	),

);    
    
$default_images = array(
    'gradient-home-section' => "bg/gradient-home-section.png",
    'home-section-bg'       => "bg/home-section-bg.png",     
    'pag-slider'            => "bg/pag-slider.png",
    'logo'                  => "logo.png"
);

?>